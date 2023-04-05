<?php

namespace App\Repositories;

use App\Models\User;
use DB;

class UserRepository
{
    public function create($user, $roles)
    {
        $user = DB::transaction(function () use ($user, $roles) {
            $user->save();
            $user->assignRole($roles);
            return $user;
        });
        return $user;
    }

    public function update(User $user, $roles)
    {
        $user = DB::transaction(function () use ($user, $roles) {
            $user->save();
            if (isset($roles)) {
                $user->roles()->sync($roles);
            } else {
                $user->roles()->detach();
            }
            return $user;
        });
        return $user;
    }

    // public function findAll($request)
// {
//     $limit = $request->limit;

    //     $query = Product::query();

    //     if (isset($request->name)) {
//         $query->where('name', 'like', $request->name . "%");
//     }

    //     return $query->orderBy('id', 'desc')
//         ->paginate($limit)
//         ->appends($request->query());
// }

    public function delete(User $user)
    {
        return $user->delete();
    }
}