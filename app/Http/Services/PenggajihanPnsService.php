<?php

namespace App\Http\Services;
use App\Models\PenggajihanPns;
use \Carbon\Carbon;
use DB;
class PenggajihanPnsService {
    public function get($filter)
    {
        $personel = PenggajihanPns::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'personel.id DESC');
        if(isset($filter['search'])){
            $personel = $personel->where(function ($q) use ($filter){
                $q->where('nama_pns','like','%'. $filter['search']. '%');
            });
        }
    }
    public function create($data)
    {
        return PenggajihanPns::create($data);
    }
    public function findById($id)
    {
        return PenggajihanPns::find($id);
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