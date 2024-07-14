<?php

namespace App\Http\Livewire\Penggajihan\Tni;

use App\Http\Services\PenggajihanTniService;
use App\Http\Services\PersonelTniService;
use App\Models\PenggajihanTni;
use App\Models\PersonelTni;
use Livewire\Component;
use Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use DB;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $typeModalActionPenggajihanTni = 'add';
    public $listeners = ['setPostPersonelTni','confirmedDelete'];
    public $price_jabatan_tni = 0;
    public $price_t_umum_tni = 0;
    public $price_t_beras_tni = 0;
    public $price_t_kowan_tni = 0;
    public $price_t_anak = 0;
    public $price_keluarga = 0;
    public $price_t_pph_tni = 0;
    public $price_raymon = 0;
    public $price_p_pensiunan = 0;
    public $price_sewa_tni = 0;
    public $price_pajak_tni = 0;
    public $price_ULP = 0;
    public $personelTni = [];
    public $tampung_tni = [];
    public $tampung_gajih, $tunjangan_anak_tni, $tunjangan_keluarga_tni, $tunjangan_beras_tni,
    $price_bpjs_tni, $price_tht_tni, $potongan_pensiunan_tni, $potongan_bpjs_tni, $potongan_tht_tni;

    public $search;
    protected $queryString = ["search"];

    public $postData = [
        'id' => null,
        'id_personel' => null,
        't_anak_tni' => null,
        't_keluarga_tni' => null,
        't_umum_tni' => null,
        't_kowan_tni' => 0,
        't_pph_tni' => 0,
        't_beras_tni' => null,
        't_jabatan_tni' => 0,
        'pembulatan_tni' => null,
        'total_kotor_tni' => 0,
        'p_pensiunan_tni' => null,
        'p_bpjs_tni' => null,
        'p_tht_tni' => null,
        'p_sewarumah_tni' => 0,
        'total_bersih_tni' => 0,
        'p_pajak_tni' => 0,
        'laukpauk' => 0,
        'jml_potongan_tni' => null,
        'raymon' => 0,
    ];
    protected $rules = [
        'postData.id_personel' => 'required',
        'postData.t_beras_tni' => 'required',
        'postData.pembulatan_tni' => 'required'
    ];

    protected $messages = [
        'postData.id_personel.required' => 'Personel tidak boleh kosong',
        'postData.t_beras_tni.required' => 'Tunjangan beras tidak boleh kosong',
        'postData.pembulatan_tni.required' => 'Pembulatan tidak boleh kosong'
    ];

    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'id_personel' => null,
            't_anak_tni' => null,
            't_keluarga_tni' => null,
            't_umum_tni' => 0,
            't_kowan_tni' => 0,
            't_pph_tni' => 0,
            't_beras_tni' => null,
            't_jabatan_tni' => 0,
            'pembulatan_tni' => null,
            'total_kotor_tni' => null,
            'p_pensiunan_tni' => null,
            'p_bpjs_tni' => null,
            'p_tht_tni' => null,
            'p_sewarumah_tni' => 0,
            'total_bersih_tni' => null,
            'p_pajak_tni' => 0,
            'laukpauk' => 0,
            'jml_potongan_tni' => null,
            'raymon' => 0
        ];
    }

    public function render()
    {
        $searchValue = $this->search;
        // $tes = Carbon\Carbon::now()->daysInMonth;

        $data = PenggajihanTni::with('PersonelTni.pangkatTniId')->orderBy('id', 'Desc');
        $this->getPersonelTni();

        if ($this->search) {
            $data = $data->where(function ($datas) use ($searchValue) {
                $datas->where('bulan_penggajihan', 'like', '%' . $searchValue . '%');
            });
        }
        $data = $data->paginate(10);
        return view('livewire..penggajihan.tni.index', compact('data'));
    }
    public function mount()
    {
        $this->getPersonelTni();
    }
    public function addPenggajihanTni()
    {
        $this->getPersonelTni();
        $this->emit('show-modal-penggajihan-tni');
    }
    public function getPersonelTni()
    {
        $personeService = new PersonelTniService();
        $this->personelTni = $personeService->optionsPersonelTni();

    }
    public function setPostPersonelTni($field, $val)
    {
        $this->postData[$field] = $val;
        $this->postData['id_personel'] = $val;
        $this->selectPersonelTni($val);
    }
    public function format_umum()
    {
        $this->postData['t_umum_tni'] = str_replace('.', '', $this->price_t_umum_tni);

        $val = $this->postData['t_umum_tni'];
        if ($val) {
            $this->price_t_umum_tni = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();
    }
    public function format_beras()
    {
        $this->postData['t_beras_tni'] = str_replace('.', '', $this->price_t_beras_tni);

        $val = $this->postData['t_beras_tni'];
        if ($val) {
            $this->price_t_beras_tni = currency_IDR($val);
            $this->totalKotorTni();
            $this->totalBersihTni();

        }
    }
    public function format_raymon()
    {
        $this->postData['raymon'] = str_replace('.', '', $this->price_raymon);

        $val = $this->postData['raymon'];
        if ($val) {
            $this->price_raymon = currency_IDR($val);
            $this->totalKotorTni();
            $this->totalBersihTni();

        }
    }
    public function format_jabatan()
    {
        $this->postData['t_jabatan_tni'] = str_replace('.', '', $this->price_jabatan_tni);

        $val = $this->postData['t_jabatan_tni'];
        if ($val) {
            $this->price_jabatan_tni = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();

    }
    public function format_anak()
    {
        $this->postData['t_anak_tni'] = str_replace('.', '', $this->price_t_anak);

        $val = $this->postData['t_anak_tni'];
        if ($val) {
            $this->price_t_anak = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();
    }
    public function format_keluarga()
    {
        $this->postData['t_keluarga_tni'] = str_replace('.', '', $this->price_keluarga);

        $val = $this->postData['t_keluarga_tni'];
        if ($val) {
            $this->price_keluarga = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();
    }
    public function format_kowan()
    {
        $this->postData['t_kowan_tni'] = str_replace('.', '', $this->price_t_kowan_tni);

        $val = $this->postData['t_kowan_tni'];
        if ($val) {
            $this->price_t_kowan_tni = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();

    }
    public function format_pph()
    {
        $this->postData['t_pph_tni'] = str_replace('.', '', $this->price_t_pph_tni);

        $val = $this->postData['t_pph_tni'];
        if ($val) {
            $this->price_t_pph_tni = currency_IDR($val);
        }
        $this->totalKotorTni();
        $this->totalBersihTni();

    }
    public function format_bpjs()
    {
        $this->postData['p_bpjs_tni'] = str_replace('.', '', $this->price_bpjs_tni);

        $val = $this->postData['p_bpjs_tni'];
        if ($val) {
            $this->price_bpjs_tni = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();
    }
    public function format_pensiunan()
    {
        $this->postData['p_pensiunan_tni'] = str_replace('.', '', $this->price_p_pensiunan);

        $val = $this->postData['p_pensiunan_tni'];
        if ($val) {
            $this->price_p_pensiunan = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();
    }
    public function format_tht()
    {
        $this->postData['p_tht_tni'] = str_replace('.', '', $this->price_tht_tni);

        $val = $this->postData['p_tht_tni'];
        if ($val) {
            $this->price_tht_tni = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();

    }
        public function format_ULP()
    {
        $this->postData['ULP'] = str_replace('.', '', $this->price_ULP);

        $val = $this->postData['ULP'];
        if ($val) {
            $this->price_tht_tni = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();

    }
    public function format_sewa()
    {
        $this->postData['p_sewarumah_tni'] = str_replace('.', '', $this->price_sewa_tni);

        $val = $this->postData['p_sewarumah_tni'];
        if ($val) {
            $this->price_sewa_tni = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();


    }
    public function format_pajak()
    {
        $this->postData['p_pajak_tni'] = str_replace('.', '', $this->price_pajak_tni);

        $val = $this->postData['p_pajak_tni'];
        if ($val) {
            $this->price_pajak_tni = currency_IDR($val);
        }
        $this->potonganKotorTni();
        $this->totalBersihTni();


    }
    public function totalKotorTni()
    {
        try {
            
            $str_jabatan = str_replace(',', '', $this->postData['t_jabatan_tni']);
            $str_keluarga = str_replace(',', '', $this->postData['t_keluarga_tni']);
            $str_anak = str_replace(',', '', $this->postData['t_anak_tni']);
            $str_umum = str_replace(',', '', $this->postData['t_umum_tni']);
            $str_beras = str_replace(',', '', $this->postData['t_beras_tni']);
            $str_kowan = str_replace(',', '', $this->postData['t_kowan_tni']);
            $str_pph = str_replace(',', '', $this->postData['t_pph_tni']);
            $str_raymon = str_replace(',', '', $this->postData['raymon']);
            $pembulatan = str_replace(',', '', $this->postData['pembulatan_tni']);
            $tgl = Carbon\Carbon::now()->daysInMonth;
            $ULP = 60000 * $tgl;
            
            (double) $totalKotor = (double) $this->tampung_gajih + (double) $str_jabatan + (double) $str_keluarga + (double) $str_anak + (double) $str_umum + (double) $str_beras + (double) $str_kowan + (double) $str_pph + (double) $pembulatan + (double) $str_raymon + (double) $ULP;
            $this->postData['total_kotor_tni'] = currency_IDR($totalKotor);
            $this->totalBersihTni();
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
      
    }
    public function totalBersihTni()
    {
        $total_kotor = str_replace(',', '', $this->postData['jml_potongan_tni']);
        $penghasilan = str_replace(',', '', $this->postData['total_kotor_tni']);

        $tes =$this->postData['total_bersih_tni'] = currency_IDR(((double)$penghasilan - (double)$total_kotor ));
        // dd($tes);
    }
    public function potonganKotorTni()
    {
        $str_pensiunan = str_replace(',', '', $this->postData['p_pensiunan_tni']);
        $str_bpjs = str_replace(',', '', $this->postData['p_bpjs_tni']);
        $str_tht = str_replace(',', '', $this->postData['p_tht_tni']);
        $str_sewa = str_replace(',', '', $this->postData['p_sewarumah_tni']);
        $str_pajak = str_replace(',', '', $this->postData['p_pajak_tni']);

        (double) $potonganKotor = (double) $str_pensiunan + (double) $str_bpjs + (double) $str_tht + (double) $str_sewa + (double) $str_pajak;
        $this->postData['jml_potongan_tni'] = currency_IDR($potonganKotor);
    }

    public function selectPersonelTni($id)
    {
        $personel = PersonelTni::with('pangkatTniId')->find($id);

        $this->tunjangan_anak_tni = ((2 / 100) * $personel->gajih_pokok) * $personel->jumlah_anak ?? 0 ; 
        if ($personel->status_menikah == 1) {
            $this->tunjangan_keluarga_tni = 10 / 100 * $personel->gajih_pokok;
        } else {
            $this->tunjangan_keluarga_tni = 0;
        }
        if ($personel->jumlah_anak >= 1) {
            $this->tunjangan_beras = (((10 * $personel->jumlah_anak) * 7242) + ( 28 * 7242));
        } else {
            $this->tunjangan_beras = 18 * 7242;
        }
        $pensiun = $personel->gajih_pokok + $this->tunjangan_anak_tni + $this->tunjangan_keluarga_tni;
        // $this->tunjangan_pensiunan = (4.75 / 100) * ($personel->gajih_pokok + $this->tunjangan_keluarga_tni + $this->tunjangan_anak_tni);
        // $this->tunjangan_tht = (3.25 / 100) * ($personel->gajih_pokok + $this->tunjangan_keluarga_tni + $this->tunjangan_anak_tni);

        $exp_pen = explode('.', $this->tunjangan_pensiunan = 4.75 / 100 * $pensiun);
        $exp_tht = explode('.', $this->tunjangan_tht = 3.25 / 100 * $pensiun);
        $tgl = Carbon\Carbon::now()->daysInMonth;
        $this->ULP = 60000 * $tgl;
        $this->tampung_gajih = $personel->gajih_pokok;
        $this->postData['t_beras_tni'] = currency_IDR($this->tunjangan_beras);
        $this->price_t_beras_tni = currency_IDR($this->tunjangan_beras);
        $this->postData['p_tht_tni'] = currency_IDR($exp_tht[0]);
        $this->postData['p_pensiunan_tni'] = currency_IDR($exp_pen[0]);
        $this->price_p_pensiunan = currency_IDR($exp_pen[0]);
        $this->price_tht_tni = currency_IDR($exp_tht[0]);

        $this->postData['t_anak_tni'] = currency_IDR($this->tunjangan_anak_tni);
        $this->price_t_anak = currency_IDR($this->tunjangan_anak_tni);
        $this->postData['t_keluarga_tni'] = currency_IDR($this->tunjangan_keluarga_tni);
        $this->price_keluarga = currency_IDR($this->tunjangan_keluarga_tni);
        $this->postData['ULP'] = currency_IDR($this->ULP);
        // dd($this->postData);
        $this->totalKotorTni();
    }
    public function storePenggajihanTni()
    {
        $str_jabatan = str_replace(',', '', $this->postData['t_jabatan_tni']);
        $str_keluarga = str_replace(',', '', $this->postData['t_keluarga_tni']);
        $str_anak = str_replace(',', '', $this->postData['t_anak_tni']);
        $str_umum = str_replace(',', '', $this->postData['t_umum_tni']);
        $str_beras = str_replace(',', '', $this->postData['t_beras_tni']);
        $str_kowan = str_replace(',', '', $this->postData['t_kowan_tni']);
        $str_pph = str_replace(',', '', $this->postData['t_pph_tni']);
        $pembulatan = str_replace(',', '', $this->postData['pembulatan_tni']);
        $str_pensiunan = str_replace(',', '', $this->postData['p_pensiunan_tni']);
        $str_bpjs = str_replace(',', '', $this->postData['p_bpjs_tni']);
        $str_tht = str_replace(',', '', $this->postData['p_tht_tni']);
        $str_sewa = str_replace(',', '', $this->postData['p_sewarumah_tni']);
        $str_pajak = str_replace(',', '', $this->postData['p_pajak_tni']);
        $str_kotor = str_replace(',', '', $this->postData['total_kotor_tni']);
        $str_kotor_penghasilan = str_replace(',', '', $this->postData['jml_potongan_tni']);
        $str_bersih = str_replace(',', '', $this->postData['total_bersih_tni']);
        $str_raymon = str_replace(',', '', $this->postData['raymon']);

        $bulan = Carbon\Carbon::now()->format('m');
        $tgl = Carbon\Carbon::now()->daysInMonth;
        $str_ULP = 60000 * $tgl;
        $this->validate();
        DB::beginTransaction();
        try {
            $penggajihanTniService = new PenggajihanTniService();
            $this->tampung_tni = [
                'id' => $this->postData['id'],
                'id_personel_tni' => $this->postData['id_personel'],
                'bulan_penggajihan' => $bulan,
                'gapok' => $this->tampung_gajih,
                't_keluarga' => $str_keluarga,
                't_anak' => $str_anak,
                't_struktural' => $str_jabatan,
                't_umum' => $str_umum,
                't_beras' => $str_beras,
                't_kowan' => $str_kowan,
                't_pph' => $str_pph,
                'pot_pembulatan' => $pembulatan,
                'penghasilan_kotor' => $str_kotor,
                'p_pensiunan' => $str_pensiunan,
                'p_tht' => $str_tht,
                't_tpp' => $str_pajak,
                'p_bpjs' => $str_bpjs,
                'p_sewa_rumah' => $str_sewa,
                'jumlah_potongan' => $str_kotor_penghasilan,
                'laukpauk' => $str_ULP,
                'penghasilan_bersih' => $str_bersih,
                'raymond' => $str_raymon
            ];
            if($this->typeModalActionPenggajihanTni == 'add'){
                $penggajihan = $penggajihanTniService->create($this->tampung_tni);
                
                
                $personel = PersonelTni::find($this->postData['id_personel']);
                $no_hp = $personel->no_whatsapp;
                $bulan = Carbon\Carbon::createFromFormat('m', $penggajihan->bulan_penggajihan)->format('F');
                $link = env('URLPENGGAJIHANTNI'). '/' . $penggajihan->id;
    
                $content1 = 'Assalamualaikum warahmatullahi wabarakatu';
                $content2 = 'Halo *Bapak/Ibu ' . $personel->nama_tni . '*';
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
            }else{
                $penggajihanTniService->update($this->postData['id'], $this->tampung_tni);
            }
            $this->clearPost();
            $this->getPersonelTni();
            $this->alert('success', $this->typeModalActionPenggajihanTni == 'add' ? 'Data Penggajihan berhasil disimpan' : 'Data Penggajihan berhasil diupdate');
            $this->emit('close-modal-penggajihan-tni');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert($th);
        }
        
    }
    public function deletePenggajihanTni($id)
    {
        $this->postData['id'] = $id;
        $this->alert('question', 'Hapus Data Penggajihan TNI ?', [
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
            $penggajihanService = new PenggajihanTniService();
            $penggajihanService->destory($this->postData['id']);
            $this->alert('success', 'Data Penggajihan berhasil dihapus');
            $this->getPersonelTni();
        } catch (\Throwable $th) {
            //throw $th;
            $this->alert('error', $th);
        }
    }
    public function editPenggajihanTni($id)
    {
        try {
            $edit = PenggajihanTni::with('PersonelTni.pangkatTniId')->find($id);
            $this->typeModalActionPenggajihanTni = 'edit';
            $this->postData = [
                'id' => $edit->id,
                'id_personel' => $edit->id_personel_tni,
                'name_personel' => $edit->PersonelTni->nama_tni,
                't_anak_tni' => $edit->t_anak,
                't_keluarga_tni' => $edit->t_keluarga,
                't_umum_tni' => $edit->t_umum,
                't_beras_tni' => $edit->t_beras,
                't_jabatan_tni' => $edit->t_struktural,
                'pembulatan_tni' => $edit->pot_pembulatan,
                'total_bersih_tni' => $edit->penghasilan_bersih,
                'jml_potongan_tni' => $edit->jumlah_potongan,
                't_kowan_tni' => $edit->kowan,
                't_pph_tni' => $edit->t_pph,
                'raymon' => $edit->raymond,
                'p_bpjs_tni' => $edit->p_bpjs,
                'p_tht_tni' =>$edit->p_tht,
                'p_sewarumah_tni' => $edit->p_sewa_rumah,
                'p_pajak_tni' => $edit->t_tpp,
                'ULP' => $edit->laukpauk,
                'p_pensiunan_tni' => $edit->p_pensiunan

            ];

            $this->postData['t_anak_tni'] = currency_IDR($edit->t_anak);
            $this->postData['ULP'] = currency_IDR($edit->laukpauk);
            $this->postData['t_keluarga_tni'] = currency_IDR($edit->t_keluarga);
            $this->price_t_umum_tni = currency_IDR($edit->t_umum);
            $this->price_t_beras_tni= currency_IDR($edit->t_beras);
            $this->price_t_kowan_tni = currency_IDR($edit->t_kowan);
            $this->price_t_pph_tni = currency_IDR($edit->t_pph);
            $this->price_jabatan_tni = currency_IDR($edit->t_struktural);
            $this->price_raymon = currency_IDR($edit->raymond);
            $this->postData['total_kotor_tni'] = currency_IDR($edit->penghasilan_kotor);
            $this->price_p_pensiunan = currency_IDR($edit->p_pensiunan);
            $this->price_bpjs_tni =currency_IDR($edit->p_bpjs);
            $this->price_tht_tni = currency_IDR($edit->p_tht);
            $this->price_sewa_tni = currency_IDR($edit->p_sewa_rumah);
            $this->price_pajak_tni = currency_IDR($edit->t_tpp);
            $this->tampung_gajih = $edit['PersonelTni']['pangkatTniId']->golongan;
            $this->postData['jml_potongan_tni'] = currency_IDR($edit->jumlah_potongan);
            $this->postData['total_bersih_tni'] = currency_IDR($edit->penghasilan_bersih);


            // dd($this->postData);
            $this->emit('show-modal-penggajihan-tni', $edit, $this->typeModalActionPenggajihanTni);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}