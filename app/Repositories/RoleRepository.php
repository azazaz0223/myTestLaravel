<?php

namespace App\Repositories;

use DB;

class RoleRepository
{
    public function create($role, $permissions)
    {
        $role = DB::transaction(function () use ($role, $permissions) {
            $role->save();
            $role->syncPermissions($permissions);
            return $role;
        });
        return $role;
    }

// public function update(array $request, Cate $cate)
// {
//     $request['operator_id'] = auth()->user()->id;

//     return $cate->update($request);
// }

// public function findAll()
// {
//     return Cate::query()->
//         select('id', 'name', 'sort', 'created_at', 'updated_at')
//         ->orderBy('sort', 'desc')
//         ->get();
// }

// public function delete(Cate $cate)
// {
//     return $cate->delete();
// }
}