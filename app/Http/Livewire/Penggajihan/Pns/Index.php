<?php

namespace App\Http\Livewire\Penggajihan\Pns;

use App\Http\Services\PenggajihanPnsService;
use App\Http\Services\PersonelPnsService;
use App\Models\PenggajihanPns;
use App\Models\PersonelPns;
use Excel;
use Livewire\Component;
use Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use DB;

class Index extends Component
{

    use LivewireAlert;
    use WithPagination;
    public $typeModalActionPenggajihanPns = 'add';

    public $golongan = [];
    public $tampung = [];
    public $personel = [];
    public $tunjangan_anak, $tunjangan_keluarga, $tunjangan_beras, $price_jabatan,
    $price_bpjs, $potongan_pensiunan, $potongan_bpjs, $potongan_tht,$price_keluarga;

    public $price_anak,$price_umum,$price_beras;

    public $price_pajak = 0;
    public $price_remon = 0;
    public $price_tpp = 0;
    public $price_sewa = 0;
    public $price_pensiunan = 0;
    public $price_tht = 0;
    public $tampung_gapok = 0;

    public $search;
    protected $queryString = ["search"];

    public $postData = [
        'id' => null,
        'id_personel' => null,
        't_anak' => null,
        't_keluarga' => null,
        't_umum' => null,
        't_beras' => null,
        't_jabatan' => null,
        'pembulatan' => null,
        'total_kotor' => null,
        'p_pensiunan' => null,
        'p_bpjs' => null,
        'p_tht' => null,
        'p_sewarumah' => 0,
        'total_bersih' => null,
        'p_pajak' => 0,
        'jml_potongan' => null,
        'remon' => 0,
        't_tpp_pns' => 0
    ];
    protected $rules = [
        'postData.pembulatan' => 'required',
        'postData.p_bpjs' => 'required',
    ];
    protected $messages = [
        'postData.pembulatan.required' => 'Pembulatan tidak boleh kosong',
        'postData.p_bpjs.required' => 'BPJS tidak boleh kosong',
    ];
    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'id_personel' => null,
            't_anak' => 0,
            't_keluarga' => 0,
            't_umum' => 0,
            't_beras' => 0,
            't_jabatan' => 0,
            'pembulatan' => 0,
            'total_kotor' => 0,
            'p_pensiunan' => 0,
            'p_bpjs' => 0,
            'p_tht' => 0,
            'p_sewarumah' => 0,
            'total_bersih' => 0,
            'p_pajak' => 0,
            'jml_potongan' => 0,
            'remon' => 0,
            't_tpp_pns' => 0
        ];
    }

    public $listeners = ['confirmedDelete', 'getPersonelPns', 'setPostPersonel'];
    public function render()
    {
        $searchValue = $this->search;

        $data = PenggajihanPns::with('PersonelId.pangkatId')->orderBy('id', 'Desc');
        $this->getPersonelPns();


        if ($this->search) {
            $data = $data->where(function ($datas) use ($searchValue) {
                $datas->where('bulan_penggajihan', 'like', '%' . $searchValue . '%');
            });
        }
        $data = $data->paginate(10);
        return view('livewire..penggajihan.pns.index', compact('data'));
    }
    public function mount()
    {
        $this->getPersonelPns();
    }
    public function addPenggajihan($type)
    {
        $this->emit('show-modal-penggajihan-pns');
    }
    public function getPersonelPns()
    {
        $personelPns = new PersonelPnsService();
        $this->personel = $personelPns->optionsPersonelPns();
    }
    public function setPostPersonel($field, $val)
    {
        $this->postData[$field] = $val;
        $this->postData['id_personel'] = $val;
        $this->selectPersonel($val);
    }
    public function format_currency()
    {
        $this->postData['t_jabatan'] = str_replace('.', '', $this->price_jabatan);

        $val = $this->postData['t_jabatan'];
        if ($val) {
            $this->price_jabatan = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_currency_tpp()
    {
        $this->postData['t_tpp_pns'] = str_replace('.', '', $this->price_tpp);

        $val = $this->postData['t_tpp_pns'];
        if ($val) {
            $this->price_tpp = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_keluarga()
    {
        $this->postData['t_keluarga'] = str_replace('.', '', $this->price_keluarga);

        $val = $this->postData['t_keluarga'];
        if ($val) {
            $this->price_keluarga = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_anak()
    {
        $this->postData['t_anak'] = str_replace('.', '', $this->price_anak);

        $val = $this->postData['t_anak'];
        if ($val) {
            $this->price_anak = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_umum()
    {
        $this->postData['t_umum'] = str_replace('.', '', $this->price_umum);

        $val = $this->postData['t_umum'];
        if ($val) {
            $this->price_umum = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_beras()
    {
        $this->postData['t_beras'] = str_replace('.', '', $this->price_beras);

        $val = $this->postData['t_beras'];
        if ($val) {
            $this->price_beras = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();

    }
    public function format_remon()
    {
        $this->postData['remon'] = str_replace('.', '', $this->price_remon);

        $val = $this->postData['remon'];
        if ($val) {
            $this->price_remon = currency_IDR($val);
        }
        $this->totalKotor();
        $this->totalBersih();
    }
    public function format_currency_bpjs()
    {
        $this->postData['p_bpjs'] = str_replace('.', '', $this->price_bpjs);

        $val = $this->postData['p_bpjs'];
        if ($val) {
            $this->price_bpjs = currency_IDR($val);
        }
        $this->potonganKotor();
        $this->totalBersih();
    }
    public function format_currency_pajak()
    {
        $this->postData['p_pajak'] = str_replace('.', '', $this->price_pajak);

        $val = $this->postData['p_pajak'];
        if ($val) {
            $this->price_pajak = currency_IDR($val);
        }
        $this->potonganKotor();
        $this->totalBersih();
    }
    public function format_currency_sewa()
    {
        $this->postData['p_sewarumah'] = str_replace('.', '', $this->price_sewa);

        $val = $this->postData['p_sewarumah'];
        if ($val) {
            $this->price_sewa = currency_IDR($val);
        }
        $this->potonganKotor();
        $this->totalBersih();
    }
    public function format_pensiunan()
    {
        $this->postData['p_pensiunan'] = str_replace('.', '', $this->price_pensiunan);

        $val = $this->postData['p_pensiunan'];
        if ($val) {
            $this->price_pensiunan = currency_IDR($val);
        }
        $this->potonganKotor();
        $this->totalBersih();
    }
    public function format_tht()
    {
        $this->postData['p_tht'] = str_replace('.', '', $this->price_tht);

        $val = $this->postData['p_tht'];
        if ($val) {
            $this->price_tht = currency_IDR($val);
        }
        $this->potonganKotor();
        $this->totalBersih();
    }
    public function selectPersonel($id)
    {
        $personel = PersonelPns::with('pangkatId')->find($id);

        // dd($personel->jumlah_anak > 1);
        //calculate tunjangan
        $this->tunjangan_anak = ((2 / 100) * $personel->gajih_pokok) * $personel->jumlah_anak ?? 0 ; 

        if ($personel->status_menikah == 1) {
            $this->tunjangan_keluarga = 10 / 100 * $personel->gajih_pokok;
        } else {
            $this->tunjangan_keluarga = 0;
        }
        if ($personel->jumlah_anak >= 1) {
            $this->tunjangan_beras = (((10 * $personel->jumlah_anak) * 7242) + ( 20 * 7242));
        } else {
            $this->tunjangan_beras =  10 * 7242;
        }
        //end calculate

        //calculate potongan gajih
        $pensiun = $personel->gajih_pokok + $this->tunjangan_anak + $this->tunjangan_keluarga;
        // $this->tunjangan_pensiunan = (4.75 / 100) * ($personel->gajih_pokok + $this->tunjangan_keluarga_tni + $this->tunjangan_anak_tni);

        $exp_pen = explode('.', $this->potongan_pensiunan = 4.75 / 100 * $pensiun);
        $exp_tht = explode('.', $this->potongan_tht = 3.25 / 100 * $pensiun);

        //end calculate

        $this->postData['t_anak'] = currency_IDR($this->tunjangan_anak);
        $this->price_anak = currency_IDR($this->tunjangan_anak);
        $this->postData['t_keluarga'] = currency_IDR($this->tunjangan_keluarga);
        $this->price_keluarga = currency_IDR($this->tunjangan_keluarga);
        $this->postData['t_umum'] = currency_IDR($personel->pangkatId->golongan);
        $this->price_umum= currency_IDR($personel->pangkatId->golongan);
        $this->postData['t_beras'] = currency_IDR($this->tunjangan_beras);
        $this->price_beras = currency_IDR($this->tunjangan_beras);
        $this->postData['p_pensiunan'] = currency_IDR($exp_pen[0]);
        $this->price_pensiunan = currency_IDR($exp_pen[0]);
        $this->postData['p_tht'] = currency_IDR($exp_tht[0]);
        $this->price_tht = currency_IDR($exp_tht[0]);

        $this->tampung_gapok = $personel->gajih_pokok;

        $this->totalKotor();

    }
    public function storePenggajihan()
    {
        $str_jabatan = str_replace(',', '', $this->postData['t_jabatan']);
        $str_beras = str_replace(',', '', $this->postData['t_beras']);
        $str_anak = str_replace(',', '', $this->postData['t_anak']);
        $str_kel = str_replace(',', '', $this->postData['t_keluarga']);
        $str_umum = str_replace(',', '', $this->postData['t_umum']);
        $str_pensiunan = str_replace(',', '', $this->postData['p_pensiunan']);
        $str_bpjs = str_replace(',', '', $this->postData['p_bpjs']);
        $str_tht = str_replace(',', '', $this->postData['p_tht']);
        $str_sewa = str_replace(',', '', $this->postData['p_sewarumah']);
        $str_pajak = str_replace(',', '', $this->postData['p_pajak']);
        $str_kotor = str_replace(',', '', $this->postData['total_kotor']);
        $str_jml_potongan = str_replace(',', '', $this->postData['jml_potongan']);
        $str_total_bersih = str_replace(',', '', $this->postData['total_bersih']);
        $str_remon = str_replace(',', '', $this->postData['remon']);
        $str_tpp = str_replace(',', '', $this->postData['t_tpp_pns']);
        $bulan = Carbon\Carbon::now()->format('m');
        $tgl = Carbon\Carbon::now()->daysInMonth;
        
        $this->validate();
        DB::beginTransaction();
        try {
            $penggajihanService = new PenggajihanPnsService();
            $this->tampung = [
                'id' => $this->postData['id'],
                'id_personel_pns' => $this->postData['id_personel'],
                'bulan_penggajihan' => $bulan,
                'gapok' => $this->tampung_gapok,
                't_keluarga' => $str_kel,
                't_anak' => $str_anak,
                't_umum' => $str_umum,
                't_jabatan' => $str_jabatan,
                't_beras' => $str_beras,
                'penghasilan_kotor' => $str_kotor,
                'pot_pembulatan' => $this->postData['pembulatan'],
                'pot_pensiunan' => $str_pensiunan,
                'pot_bpjs' => $str_bpjs,
                'pot_tht' => $str_tht,
                'pot_pajak_penghasilan' => $str_pajak,
                'pot_sewa_rmh' => $str_sewa,
                'jumlah_potongan' => $str_jml_potongan,
                'penghasilan_bersih' => $str_total_bersih,
                'remon' => $str_remon,
                't_tpp_pns' => $str_tpp
            ];
            if ($this->typeModalActionPenggajihanPns == 'add') {
                $penggajihan = $penggajihanService->create($this->tampung);
                 
                $personel = PersonelPns::find($this->postData['id_personel']);
                $no_hp = $personel->no_whatsapp;
                $bulan = Carbon\Carbon::createFromFormat('m', $penggajihan->bulan_penggajihan)->format('F');
                $link = env('URLPENGGAJIHANPNS'). '/' . $penggajihan->id;
    
                $content1 = 'Assalamualaikum warahmatullahi wabarakatu';
                $content2 = 'Halo *Bapak/Ibu ' . $personel->nama_pns . '*';
                $content3 = 'Terlampir Penggajihan Pada Aplikasi SIGAP untuk bulan' . $bulan ;
                $content4 = 'Klik Link dibawah ini untuk melihat slip gajih';
                $content5 = 'Pesan ini Otomatis , mohon tidak membalas pesan ini';

                $message = "_" . $content1 . "_
" . $content2 . "
" . $content3 . "
" . $content4 . "

" . $link . "

_" . $content5 . "_";

                sendWhatsapp($no_hp,$message);
                $this->clearPost();

            } else {
                $penggajihan = PenggajihanPns::find($this->postData['id']);
                $penggajihanService->update($penggajihan->id, $this->tampung);
            }
            $this->clearPost();
            $this->getPersonelPns();
            $this->alert('success', 'Data Penggajihan berhasil disimpan');
            $this->emit('close-modal-penggajihan-pns');
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $this->alert($th);
        }
    }
    public function totalKotor()
    {

        $str_jabatan = str_replace(',', '', $this->postData['t_jabatan']);
        $str_beras = str_replace(',', '', $this->postData['t_beras']);
        $str_anak = str_replace(',', '', $this->postData['t_anak']);
        $str_kel = str_replace(',', '', $this->postData['t_keluarga']);
        $str_umum = str_replace(',', '', $this->postData['t_umum']);
        $str_pembulatan = str_replace(',', '', $this->postData['pembulatan']);
        $str_remon = str_replace(',', '', $this->postData['remon']);
        $str_tpp = str_replace(',', '',$this->postData['t_tpp_pns']);

        (double) $total = (double) $this->tampung_gapok + (double) $str_anak + (double) $str_beras + (double) $str_kel + (double) $str_umum + (double) $str_jabatan + (double) $str_pembulatan + (double) $str_remon + (double) $str_tpp;


        $this->postData['total_kotor'] = currency_IDR($total);
        $this->totalBersih();
    }
    public function totalBersih()
    {
        $str_pensiunan = str_replace(',', '', $this->postData['p_pensiunan']);
        $str_bpjs = str_replace(',', '', $this->postData['p_bpjs']);
        $str_tht = str_replace(',', '', $this->postData['p_tht']);
        $str_sewa = str_replace(',', '', $this->postData['p_sewarumah']);
        $str_pajak = str_replace(',', '', $this->postData['p_pajak']);

        (double) $potongan = (double) $str_pensiunan + (double) $str_bpjs + (double) $str_sewa + (double) $str_tht + (double) $str_pajak;

        $total_kotor = str_replace(',', '', $this->postData['total_kotor']);
        $totalAll = (double) $total_kotor - $potongan;

        $this->postData['total_bersih'] = currency_IDR($totalAll);
    }
    public function potonganKotor()
    {
        $str_pensiunan = str_replace(',', '', $this->postData['p_pensiunan']);
        $str_bpjs = str_replace(',', '', $this->postData['p_bpjs']);
        $str_tht = str_replace(',', '', $this->postData['p_tht']);
        $str_sewa = str_replace(',', '', $this->postData['p_sewarumah']);
        $str_pajak = str_replace(',', '', $this->postData['p_pajak']);

        (double) $potongan = (double) $str_pensiunan + (double) $str_bpjs + (double) $str_sewa + (double) $str_tht + (double) $str_pajak;
        // dd($potongan);
        $this->postData['jml_potongan'] = currency_IDR($potongan);
    }
    public function deletePenggajihan($id)
    {
        $this->postData['id'] = $id;
        $this->alert('question', 'Hapus Data Penggajihan PNS ?', [
            'toast' => false,
            'timer' => null,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Hapus',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmedDelete',
            'cancelButtonText' => 'Batal',
            'confirmButtonColor' => '#EB5757',
            'customClass' => [
                'confirmButton' => 'shadow-none',
                'cancelButton' => 'shadow-none',
            ]
        ]);
    }
    public function confirmedDelete()
    {
        try {
            $penggajihanService = new PenggajihanPnsService();
            $penggajihanService->destory($this->postData['id']);
            $this->alert('success', 'Data Penggajihan berhasil dihapus');
            $this->getPersonelPns();
        } catch (\Throwable $th) {
            //throw $th;
            $this->alert('error', $th);
        }
    }

    public function editPenggajihan($id)
    {
        try {
            $edit = PenggajihanPns::with('PersonelId.pangkatId')->find($id);
            $this->typeModalActionPenggajihanPns = 'edit';
            $this->postData = [
                'id' => $edit->id,
                'id_personel' => $edit->id_personel_pns,
                'name_personel' => $edit->PersonelId->nama_pns,
                't_anak' => $edit->t_anak,
                't_keluarga' => $edit->t_keluarga,
                't_umum' => $edit->t_umum,
                't_beras' => $edit->t_beras,
                't_jabatan' => $edit->t_jabatan,
                'pembulatan' => $edit->pot_pembulatan,
                'total_kotor' => $edit->penghasilan_kotor,
                'p_pensiunan' => $edit->pot_pensiunan,
                'p_bpjs' => $edit->pot_bpjs,
                'p_tht' => $edit->pot_tht,
                'p_sewarumah' => $edit->pot_sewa_rmh,
                'p_pajak' => $edit->pot_pajak_penghasilan,
                'total_bersih' => $edit->penghasilan_bersih,
                'jml_potongan' => $edit->jumlah_potongan,
                'remon' => $edit->remon,
                't_tpp_pns' => $edit->t_tpp_pns 
            ];
            $this->postData['t_anak'] = currency_IDR($edit->t_anak);
            $this->postData['t_keluarga'] = currency_IDR($edit->t_keluarga);
            $this->postData['t_umum'] = currency_IDR($edit->t_umum);
            $this->postData['t_beras'] = currency_IDR($edit->t_beras);
            $this->postData['t_jabatan'] = currency_IDR($edit->t_jabatan);
            $this->postData['remon'] = currency_IDR($edit->remon);
            $this->postData['t_tpp_pns'] = currency_IDR($edit->t_tpp_pns);
            $this->postData['p_pajak'] = currency_IDR($edit->pot_pajak_penghasilan);
            $this->tampung_gapok = $edit['PersonelId']['pangkatId']->golongan;
            $this->price_keluarga = currency_IDR($edit->t_keluarga);
            $this->price_anak = currency_IDR($edit->t_anak);
            $this->price_umum = currency_IDR($edit->t_umum);
            $this->price_beras = currency_IDR($edit->t_beras);
            $this->price_pensiunan = currency_IDR($edit->pot_pensiunan);
            $this->price_tht = currency_IDR($edit->pot_tht);
            $this->price_jabatan = currency_IDR($edit->t_jabatan);
            $this->price_bpjs = currency_IDR($edit->pot_bpjs);
            $this->price_pajak = currency_IDR($edit->pot_pajak_penghasilan);
            $this->price_remon = currency_IDR($edit->remon);
            $this->price_tpp = currency_IDR($edit->t_tpp_pns);
            $this->price_sewa = currency_IDR($edit->pot_sewa_rmh);
            $this->postData['jml_potongan'] = currency_IDR($edit->jumlah_potongan);
            $this->postData['total_bersih'] = currency_IDR($edit->penghasilan_bersih);
            $this->postData['total_kotor'] = currency_IDR($edit->penghasilan_kotor);
            $this->emit('show-modal-penggajihan-pns', $edit, $this->typeModalActionPenggajihanPns);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}