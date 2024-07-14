<?php

namespace App\Http\Livewire\Personel\Tni;

use App\Http\Services\PangkatService;
use App\Http\Services\PersonelTniService;
use App\Imports\UsersImportPersonelTni;
use App\Models\PersonelTni;
use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Excel;
use Livewire\WithFileUploads;


class Index extends Component
{

    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    public $typeModalActionTni = 'add';
    public $isDisabledPicker = false;
    public $is_active = true;

    public $tampung, $price_format;
    public $golongan = [];

    public $fileUpload;
    public $progressUpload = 0;

    public $search;
    protected $queryString = ["search"];
    protected $listeners = ['confirmedDelete','setPostPangkat', 'setStatusMenikah', 'format_currency', 'getGolongan'];

    public $postData = [
        'id' => null,
        'nrp' => null,
        'nama_tni' => null,
        'npwp' => null,
        'tgl_lahir' => null,
        'status_menikah' => 0,
        'jumlah_anak' => 0,
        'gajih_pokok' => 0,
        'id_pangkat_tni' => null,
        'no_whatsapp' => null
    ];

    protected $rules = [
        'postData.nrp' => 'required',
        'postData.nama_tni' => 'required',
        'postData.npwp' => 'required',
        'postData.gajih_pokok' => 'required',
        'postData.no_whatsapp' => 'required'
    ];
    protected $messages = [
        'postData.nrp.required' => 'NRP PNS tidak boleh kosong',
        'postData.nama_tni.required' => 'Nama PNS tidak boleh kosong',
        'postData.npwp.required' => 'NPWP PNS tidak boleh kosong',
        'postData.gajih_pokok.required' => 'Gajih Pokok PNS tidak boleh kosong',
        'postData.no_whatsapp.required' => 'No Whatsapp PNS tidak boleh kosong',
    ];

    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'nrp' => null,
            'nama_tni' => null,
            'npwp' => null,
            'tgl_lahir' => null,
            'status_menikah' => 0,
            'jumlah_anak' => 0,
            'gajih_pokok' => null,
            'id_pangkat_tni' => null,
            'no_whatsapp' => null
        ];
    }
    public function render()
    {
        $searchValue = $this->search;
        $personel = PersonelTni::with('pangkatTniId')->orderBy('id','Desc');

        if($this->search){
            $personel = $personel->where(function ($personel) use ($searchValue) {
                $personel->where('nama_tni','like', '%' . $searchValue . '%');
            });
        }
        $personel = $personel->paginate(10);
        
        return view('livewire..personel.tni.index', compact('personel'));
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

    public function format_currency()
    {
        $this->postData['gajih_pokok'] = str_replace(',', '', $this->price_format);
        $val = $this->postData['gajih_pokok'];
        if ($val) {
            $this->price_format = currency_IDR($val);
        }
    }
    public function getGolongan($jenis = 'TNI')
    {
        $pangkatService = new PangkatService();
        $this->golongan = $pangkatService->optionsPangkat($jenis);
    }
    public function setPostPangkat($field, $val)
    {
        $this->postData[$field] = $val;
        $tes = $this->postData['id_pangkat_tni'] = $val;
    }
    public function addPersonelTni($type)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->clearPost();
        $this->typeModalActionTni = $type;
        $this->emit('show-modal-tni');
    }
    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $tniSevice = new PersonelTniService();
            if ($this->typeModalActionTni == 'add') {
                $tniSevice->create($this->postData);
            } else {
                $tni = PersonelTni::find($this->postData['id']);
                $tniSevice->update($tni->id, $this->postData);
            }
            $this->alert('success', 'Data Personel TNI berhasil disimpan');
            $this->emit('close-modal-tni');
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }
    public function deleteTni($id) {
        $this->postData['id'] = $id;
        $this->alert('question', 'Hapus Data Personel TNI ?', [
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
    public function confirmedDelete() {
        try {
            $tniService = new PersonelTniService();
            $tniService->destory($this->postData['id']);
            $this->alert('success', 'Data TNI berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function editTni($id)
    {
        try {
            $edit = PersonelTni::find($id);
            $this->typeModalActionTni = 'edit';
            if($edit->status_menikah == 1){
                $this->tampung = true;
            }else{
                $this->tampung = false;
            }
            $this->postData = [
                'id' => $edit->id,
                'nrp' => $edit->nrp,
                'nama_tni' => $edit->nama_tni,
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
            $this->emit('show-modal-tni', $edit, $this->typeModalActionTni);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }

    }

    public function importPersonelTni() {
        $this->emit('show-modal-import-tni');
    }
    public function removeFileUpload()
    {
        $this->fileUpload = null;
        $this->progressUpload = 0;
        $this->emit('remove-file-upload');
    }
    public function downloadTemplateImport()
    {
        return \Storage::disk('imports')->download('example_personel_tni.xlsx');
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
            Excel::import(new UsersImportPersonelTni, $file);

            $this->emit('done-import');
            $this->alert('success', 'Berhasil Import Personel TNI');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
}