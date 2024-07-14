<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\ExportLaporanTni;
use App\Models\PenggajihanTni;
use App\Models\PersonelTni;
use Carbon\Carbon;
use Excel;
use Livewire\Component;

class Tni extends Component
{
    protected $listeners = ['setGeneralFilter'];
    public $search, $month;
    protected $queryString = ["search"];
    public $generalFilter = [
        'bulan_id' => null,
    ];
    public function render()
    {
        $bulan_id = $this->generalFilter['bulan_id'];
        $searchValue = $this->search;
        $data = PenggajihanTni::with('PersonelTni.pangkatTniId')->where('bulan_penggajihan', $bulan_id)->orderBy('id', 'Desc');

        if($this->search){
            $data = $data->where(function ($data) use ($searchValue) {
                $data->where('nama_tni','like', '%' . $searchValue . '%');
            });
        }
        $data = $data->paginate(10);

        return view('livewire..laporan.tni', ['data' => $data]);
    }
    public function setGeneralFilter($key, $value)
    {
        $this->generalFilter[$key] = $value;
        if ($key == "bulan") {
            $this->generalFilter['bulan_id'] = null;
        }
        // dd($this->generalFilter);
    }
    public function export()
    {
        $this->month = Carbon::now()->format('Y-m-d');
        $month = Carbon::parse($this->month)->format('m');
        $dateNow = Carbon::parse($this->month)->format('d F Y');

        $bulan_id = $this->generalFilter['bulan_id'];

        $data = PenggajihanTni::with('PersonelTni.pangkatTniId')->where('bulan_penggajihan', $bulan_id)
        ->get()
        ->toArray();
        // dd($data);        

        return Excel::download(
            new ExportLaporanTni(
                $data,
                Carbon::parse($this->month)->translatedFormat('F'),
                Carbon::parse($dateNow)->translatedFormat('d F Y'),
            ),
                'laporan_penggajihan_'.$dateNow.'.xlsx'
            );
    }
}
