<?php

namespace App\Http\Services;
use App\Models\PersonelTni;
use \Carbon\Carbon;
use DB;
class PersonelTniService {
    public function get($filter)
    {
        $personel = PersonelTni::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'personel.id DESC');
        if(isset($filter['search'])){
            $personel = $personel->where(function ($q) use ($filter){
                $q->where('nama_tni','like','%'. $filter['search']. '%');
            });
        }
    }
    public function create($data)
    {
        return PersonelTni::create($data);
    }
    public function findById($id)
    {
        return PersonelTni::find($id);
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }
    public function destory($id)
    {
        return $this->findById($id)->delete();
    }
    public function optionsPersonelTni($jenis=null)
    {
        $monthNow = Carbon::now()->format('m');
        $data = PersonelTni::with('penggajianTni')->with('pangkatTniId')
        ->whereHas('penggajianTni', function($p) use($monthNow) {
            $p->where('bulan_penggajihan', '!=', $monthNow);
        })
        ->orWhereHas('penggajianTni', function($q){$q;}, '<', 1)
        ->get();
        
        $data = $data->map(function ($jeniss){
            return collect($jeniss->toArray())
            // ->only(['id','nrp','nama_tni'])
            ->all();
        });
        // dd($data);
        return $data;
    }
}