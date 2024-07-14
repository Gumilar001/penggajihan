<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function summary()
    {
        return view('pages.laporan.summary.index');
    }
    public function proyek()
    {
        return view('pages.laporan.proyek.index');
    }
    public function summaryDownloadExcel()
    {
        return view('export.laporan-summary');
    }
    public function proyekDownloadExcel()
    {
        return view('export.laporan-proyek');
    }
}
