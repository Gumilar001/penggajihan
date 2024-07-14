<?php

namespace App\Http\Services;

use App\Models\Notifikasi;

use \Carbon\Carbon;
use DB;
class NotifikasiService {
    public function create($data)
    {
        return Notifikasi::create($data);
    }
    public function findById($id)
    {
        return Notifikasi::find($id);
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