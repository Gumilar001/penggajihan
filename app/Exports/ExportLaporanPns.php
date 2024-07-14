<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;


class ExportLaporanPns implements FromView, ShouldAutoSize
{
    private $data;

    private $month, $dateNow;

    public function __construct(array $data, string $month, string $dateNow)
    {
        $this->data = $data;
        $this->month = $month;
        $this->dateNow = $dateNow;
    }
    public function view(): View
    {
        return view('export.new-laporan-pns', [
            'data' => $this->data,
            'month' => $this->month,
            'dateNow' => $this->dateNow,
        ]);
    }
}
?>
