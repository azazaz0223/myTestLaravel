<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {

        // 建立權限表
        $permissions = [
            'user-index',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-index',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-show',
            'cate-list',
            'cate-show',
            'cate-create',
            'cate-edit',
            'cate-delete',
            'product-list',
            'product-show',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create([ 'name' => $permission ]);
        }
    }
}