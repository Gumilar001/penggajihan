<?php

namespace App\Http\Livewire\Personel\Pns;

use App\Http\Services\PangkatService;
use App\Http\Services\PersonelPnsService;
use App\Imports\UsersImportPersonelPns;
use App\Models\PersonelPns;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use DB;
use Excel;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    public $typeModalActionPns = 'add';
    public $isDisabledPicker = false;
    public $is_active = true;
    public $tampung;
    public $golongan = [];

    public $price_format;

    public $fileUpload;
    public $progressUpload = 0;
    public $search;
    protected $queryString = ["search"];
    protected $listeners = ['confirmedDelete', 'setPostPangkat', 'setStatusMenikah', 'format_currency', 'getGolongan'];

    public $postData = [
        'id' => null,
        'nrp' => null,
        'nama_pns' => null,
        'npwp' => null,
        'tgl_lahir' => null,
        'status_menikah' => 0,
        'jumlah_anak' => 0,
        'gajih_pokok' => 0,
        'id_pangkat' => null,
        'no_whatsapp' =>null
    ];

    protected $rules = [
        'postData.nrp' => 'required',
        'postData.nama_pns' => 'required',
        'postData.npwp' => 'required',
        'postData.gajih_pokok' => 'required',
        'postData.no_whatsapp' => 'required'
    ];
    protected $messages = [
        'postData.nrp.required' => 'NRP PNS tidak boleh kosong',
        'postData.nama_pns.required' => 'Nama PNS tidak boleh kosong',
        'postData.npwp.required' => 'NPWP PNS tidak boleh kosong',
        'postData.gajih_pokok.required' => 'Gajih Pokok PNS tidak boleh kosong',
        'postData.no_whatsapp.required' => 'No Whatsapp PNS tidak boleh kosong',
    ];

    public function render()
    {
        $searchValue = $this->search;

        $personel = PersonelPns::with('pangkatId')->orderBy('id', 'desc');


        if($this->search){
            $personel = $personel->where(function ($personels) use ($searchValue) {
                $personels->where('nama_pns', 'like', '%' . $searchValue . '%');
            });
        }

        $personel = $personel->paginate(10);

        return view('livewire.personel.pns.index', compact('personel'));
    }
    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'nrp' => null,
            'nama_pns' => null,
            'npwp' => null,
            'tgl_lahir' => null,
            'status_menikah' => 0,
            'jumlah_anak' => 0,
            'gajih_pokok' => null,
            'id_pangkat' => null,
            'no_whatsapp' => null
        ];
    }

    public function mount()
    {
        $this->getGolongan();
    }
    public function setStatus($value)
    {
        $this->is_active = $value;
        $this->postData['is_active'] = $value;
    }

    public function setStatusMenikah($status_menikah)
    {
        if ($status_menikah == true) {
            $this->tampung = 1;
        } else {
            $this->tampung = 0;
        }
        $this->postData['status_menikah'] = $this->tampung;
    }
    public function addPersonelPns($type)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->clearPost();
        $this->typeModalActionPns = $type;
        $this->emit('show-modal-pns');
    }
    public function format_currency()
    {
        $this->postData['gajih_pokok'] = str_replace(',', '', $this->price_format);
        $val = $this->postData['gajih_pokok'];
        if ($val) {
            $this->price_format = currency_IDR($val);
        }
    }
    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $personelPnsService = new PersonelPnsService();
            if ($this->typeModalActionPns == 'add') {
                $personelPnsService->create($this->postData);
            } else {
                $pns = PersonelPns::find($this->postData['id']);
                $personelPnsService->update($pns->id, $this->postData);
            }
            $this->clearPost();
            $this->alert('success', 'Data PNS berhasil disimpan');
            $this->emit('close-modal-action-pns');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', $th->getMessage());
        }
    }
    public function getGolongan($jenis = 'PNS')
    {
        $pangkatService = new PangkatService();
        $this->golongan = $pangkatService->optionsPangkat($jenis);
    }
    public function setPostPangkat($field, $val)
    {
        $this->postData[$field] = $val;
        $tes = $this->postData['id_pangkat'] = $val;
    }
    public function deletePns($id)
    {
        $this->postData['id'] = $id;
        $this->alert('question', 'Hapus Data Personel PNS ?', [
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
            $pnsService = new PersonelPnsService();
            $pnsService->destory($this->postData['id']);
            $this->alert('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Terjadi kesalahan pada sistem');
        }
    }
    public function editPns($id)
    {
        try {
            $edit = PersonelPns::find($id);
            $this->typeModalActionPns = 'edit';
            if($edit->status_menikah == 1){
                $this->tampung = true;
            }else{
                $this->tampung = false;
            }
            $this->postData = [
                'id' => $edit->id,
                'nrp' => $edit->nrp,
                'nama_pns' => $edit->nama_pns,
                'npwp' => $edit->npwp,
                'status_menikah' => $this->tampung,
                'jumlah_anak' => $edit->jumlah_anak,
                'tgl_lahir' => $edit->tgl_lahir,
                'id_pangkat' => $edit->id_pangkat,
                'gajih_pokok' => $edit->gajih_pokok,
                'no_whatsapp' => $edit->no_whatsapp
            ];
            $this->price_format = currency_IDR($edit->gajih_pokok);

            // dd($this->postData);
            $this->emit('show-modal-pns', $edit, $this->typeModalActionPns);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }
    public function importPersonelPns() {
        $this->emit('show-modal-import-pns');
    }
    public function removeFileUpload()
    {
        $this->fileUpload = null;
        $this->progressUpload = 0;
        $this->emit('remove-file-upload');
    }
    public function downloadTemplateImport()
    {
        return \Storage::disk('imports')->download('example_personel_pns.xlsx');
    }
    public function import()
    {
        $validatedData = $this->validate(
            ['fileUpload' => 'required|max:50000|mimes:xlsx,xls'],
            [
                'fileUpload.required' => 'Pilih File terlebih dahulu.',
                'fileUpload.mimes' => 'File tidak sesuai',
            ],
        );

        try {


            $file = $this->fileUpload;
            Excel::import(new UsersImportPersonelPns, $file);

            $this->emit('done-import-pns');
            $this->alert('success', 'Berhasil Import Personel TNI');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
}