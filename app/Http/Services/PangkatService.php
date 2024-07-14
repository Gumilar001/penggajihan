<?php

namespace App\Http\Services;
use App\Models\Pangkat;
use App\Models\PersonelPns;
use \Carbon\Carbon;
use DB;
class PangkatService {
    public function get($filter)
    {
        $pangkat = Pangkat::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'pangkat.id DESC');
        if(isset($filter['search'])){
            $pangkat = $pangkat->where(function ($q) use ($filter){
                $q->where('nama_pangkat','like','%'. $filter['search']. '%');
            });
        }
    }
    public function create($data)
    {
        return Pangkat::create($data);
    }
    public function findById($id)
    {
        return Pangkat::find($id);
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }
    public function destory($id)
    {
        return $this->findById($id)->delete();
    }
    public function findJenis($type)
    {
        $data = Pangkat::where('jenis', $type)->get();

        return $data;
    }
    public function optionsPangkat($jenis=null)
    {
        $data = Pangkat::get();
        if($jenis) {
            $data = $this->findJenis($jenis);
        }
        $data = $data->map(function ($jeniss){
            return collect($jeniss->toArray())
            ->only(['id','nama_pangkat','jenis'])
            ->all();
        });
        return $data;
    }
}