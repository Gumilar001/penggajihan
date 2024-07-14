<?php

namespace App\Http\Services;
use App\Models\PenggajihanTni;
use \Carbon\Carbon;
use DB;
class PenggajihanTniService {
    public function get($filter)
    {
        $personel = PenggajihanTni::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'personel.id DESC');
        if(isset($filter['search'])){
            $personel = $personel->where(function ($q) use ($filter){
                $q->where('nama_tni','like','%'. $filter['search']. '%');
            });
        }
    }
    public function create($data)
    {
        return PenggajihanTni::create($data);
    }
    public function findById($id)
    {
        return PenggajihanTni::find($id);
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }
    public function destory($id)
    {
        return $this->findById($id)->delete();
    }
    
}