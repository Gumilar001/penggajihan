<?php


namespace App\Http\Services;

use App\Models\User;
use \Carbon\Carbon;
use DB;

class UserService {
    public function get($filter)
    {
        $user = User::orderByRaw(isset($filter['orderBy']) ? $filter['orderBy'] : 'user.id DESC');
        if (isset($filter['search'])) {
            $user = $user->where(function ($q) use ($filter) {
                $q->where('name', 'like', '%' . $filter['search'] . '%');
            });
        }
    }
    public function findById($id)
    {
        return User::find($id);
    }
    public function create($data)
    {
        return User::create($data);
    }
    public function destory($id)
    {
        return $this->findById($id)->delete();
    }
    public function update($id,$data)
    {
        return $this->findById($id)->update($data);
    }
    public function optionsUsers()
    {
        $data = User::with('role')->get();
;        // $data = $data->map(function ($users) {
        //     return collect($users->toArray())
        //         ->only(['id', 'name'])
        //         ->all();
        // });

        return $data;
    }
}