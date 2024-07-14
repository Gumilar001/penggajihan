<?php

namespace App\Http\Services;
use App\Models\PersonelPns;
use \Carbon\Carbon;
use DB;
class PersonelPnsService {
    public function get($filter)
    {
        $personel = PersonelPns::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'personel.id DESC');
        if(isset($filter['search'])){
            $personel = $personel->where(function ($q) use ($filter){
                $q->where('nama_pns','like','%'. $filter['search']. '%');
            });
        }
    }
    public function create($data)
    {
        return PersonelPns::create($data);
    }
    public function findById($id)
    {
        return PersonelPns::find($id);
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }
    public function destory($id)
    {
        return $this->findById($id)->delete();
    }
    public function optionsPersonelPns($jenis=null)
    {
        $monthNow = Carbon::now()->format('m');
        $data = PersonelPns::with('penggajian')->with('pangkatId')
        ->whereHas('penggajian', function($p) use($monthNow) {
            $p->where('bulan_penggajihan', '!=', $monthNow);
        })
        ->orWhereHas('penggajian', function($q){$q;}, '<', 1)
        ->get();
        
        $data = $data->map(function ($jeniss){
            return collect($jeniss->toArray())
            // ->only(['id','nrp','nama_pns'])
            ->all();
        });
        return $data;
    }
}