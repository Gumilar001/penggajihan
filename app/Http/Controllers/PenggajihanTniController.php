<?php

namespace App\Http\Controllers;

use App\Models\PenggajihanPns;
use App\Models\PenggajihanTni;
use Illuminate\Http\Request;

class PenggajihanTniController extends Controller
{
    public function cetak($id)
    {
        $view=PenggajihanTni::with('PersonelTni.pangkatTniId')->find($id);
        // dd($view);
        return view('print.penggajihan-tni', ['view' => $view]);
    }
    public function cetakPns($id)
    {
        $view=PenggajihanPns::with('PersonelId.pangkatId')->find($id);
        // dd($view);
        return view('print.penggajihan-pns', ['view' => $view]);
    }
}
