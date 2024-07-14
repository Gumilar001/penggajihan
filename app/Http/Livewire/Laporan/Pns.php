<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\ExportLaporanPns;
use App\Models\PenggajihanPns;
use Carbon\Carbon;
use Excel;
use Livewire\Component;

class Pns extends Component
{
    protected $listeners = ['setGeneralFilter'];
    public $search;
    protected $queryString = ["search"];
    public $generalFilter = [
        'bulan_pns_id' => null,
    ];
    public function render()
    {
        $bulan_id = $this->generalFilter['bulan_pns_id'];
        $searchValue = $this->search;
        $data = PenggajihanPns::with('PersonelId.pangkatId')->where('bulan_penggajihan', $bulan_id)->orderBy('id', 'Desc');

        if($this->search){
            $data = $data->where(function ($data) use ($searchValue) {
                $data->where('nama_tni','like', '%' . $searchValue . '%');
            });
        }
        $data = $data->paginate(10);

        return view('livewire..laporan.pns', ['data' => $data]);
    }
    public function setGeneralFilter($key, $value)
    {
        $this->generalFilter[$key] = $value;
        if ($key == "bulan") {
            $this->generalFilter['bulan_pns_id'] = null;
        }
    }
    public function export()
    {
        $this->month = Carbon::now()->format('Y-m-d');
        $month = Carbon::parse($this->month)->format('m');
        $dateNow = Carbon::parse($this->month)->format('d F Y');

        $bulan_id = $this->generalFilter['bulan_pns_id'];

        $data = PenggajihanPns::with('PersonelId.pangkatId')->where('bulan_penggajihan', $bulan_id)
        ->get()
        ->toArray();

        // dd($data);
        return Excel::download(
            new ExportLaporanPns(
                $data,
                Carbon::parse($this->month)->translatedFormat('F'),
                Carbon::parse($dateNow)->translatedFormat('d F Y'),
            ),
                'laporan_penggajihan_'.$dateNow.'.xlsx'
            );
    }
}
