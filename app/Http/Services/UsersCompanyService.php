<?php

namespace App\Http\Services;

use \App\Models\UsersCompany;

class UsersCompanyService {
    public function findById($id)
    {
        return UsersCompany::find($id);
    }
    public function create($data)
    {
        return UsersCompany::create($data);
    }
    public function update($id,$data)
    {
        $data = $this->findById($id)->update($data);
        return $data;

    }

    public function destroy($id)
    {
        return $this->findById($id)->delete();
    }
}