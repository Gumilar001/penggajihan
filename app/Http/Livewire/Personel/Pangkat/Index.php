<?php

namespace App\Http\Livewire\Personel\Pangkat;

use App\Http\Services\PangkatService;
use App\Imports\UsersImportPangkat;
use App\Models\Pangkat;
use Excel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use DB;
use Livewire\WithFileUploads;


class Index extends Component
{

    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;

    public $search, $price_format;
    protected $queryString = ["search"];

    public $typeModalActionPangkat = 'add';

    public $fileUpload;
    public $progressUpload = 0;
    protected $listeners=['confirmedDelete'];
    public $postData = [
        'id' => null,
        'golongan' => null,
        'nama_pangkat' => '',
        'jenis' => ''
    ];
    protected $rules = [
        'postData.golongan' => 'required',
        'postData.nama_pangkat' => 'required',
        'postData.jenis' => 'required',
    ];
    protected $messages = [
        'postData.golongan.required' => 'Golongan tidak boleh kosong',
        'postData.nama_pangkat.required' => 'Nama Pangkat tidak boleh kosong',
        'postData.jenis.required' => 'Jenis PNS tidak boleh kosong',
    ];
    public function render()
    {
        $searchValue = $this->search;

        $pangkat = Pangkat::orderBy('id', 'desc');


        if ($this->search) {
            $pangkat = $pangkat->where(function ($pangkats) use ($searchValue) {
                $pangkats->where('nama_pangkat', 'like', '%' . $searchValue . '%');
            });
        }

        $pangkat = $pangkat->paginate(10);

        return view('livewire..personel.pangkat.index', compact('pangkat'));
    }
    public function clearPost()
    {
        $this->postData = [
            'id' => null,
            'golongan' => null,
            'nama_pangkat' => '',
            'jenis' => ''
        ];
    }
    public function addPersonelPangkat($type)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->clearPost();
        $this->typeModalActionPangkat = $type;
        $this->emit('show-modal-pangkat');
    }
    public function format_currency()
    {
        $this->postData['golongan'] = str_replace(',', '', $this->price_format);
        $val = $this->postData['golongan'];
        if ($val) {
            $this->price_format = currency_IDR($val);
        }
    }
    public function editPangkat($id) {
        $pangkat = Pangkat::find($id);
        $this->typeModalActionPangkat = 'edit';
        $this->postData = [
            'id' => $pangkat->id,
            'golongan' => $pangkat->golongan,
            'jenis' => $pangkat->jenis,
            'nama_pangkat' => $pangkat->nama_pangkat
        ];
        $this->price_format = currency_IDR($pangkat->golongan);
        $this->emit('show-modal-pangkat', $pangkat, $this->typeModalActionPangkat);
    }
    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $personelPnsService = new PangkatService();
            if ($this->typeModalActionPangkat == 'add') {
                $personelPnsService->create($this->postData);
            } else {
                $pns = Pangkat::find($this->postData['id']);
                $personelPnsService->update($pns->id, $this->postData);
            }
            $this->clearPost();
            $this->alert('success', 'Data Pangkat berhasil disimpan');
            $this->emit('close-modal-action-pangkat');
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $this->alert('error', $th->getMessage());
        }
    }
    public function setPostPangkat($field, $val)
    {
        $this->postData[$field] = $val;
        $tes = $this->postData['jenis'] = $val;
    }
    public function importPangkat()
    {
        $this->emit('show-modal-import');
    }
    public function removeFileUpload()
    {
        $this->fileUpload = null;
        $this->progressUpload = 0;
        $this->emit('remove-file-upload');
    }
    public function downloadTemplateImport()
    {
        return \Storage::disk('imports')->download('example_pangkat.xlsx');
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
            Excel::import(new UsersImportPangkat, $file);

            $this->emit('done-import-pangkat');
            $this->alert('success', 'Berhasil Import Pangkat');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
    public function deletePangkat($id)
    {
        $this->postData['id'] = $id;
        $this->alert('question', 'Hapus Data Pangkat ?', [
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
            $pnsService = new PangkatService();
            $pnsService->destory($this->postData['id']);
            $this->alert('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Terjadi kesalahan pada sistem');
        }
    }
}