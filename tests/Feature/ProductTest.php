<?php

namespace Tests\Feature;

use App\Models\Cate;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTest extends TestCase
{
    // 加入重置資料庫的Trait
    use RefreshDatabase;

    /**
     * 測試查看product 列表的JSON結構
     *
     * @return void
     */

    public function testFindAllProduct()
    {
        // 建立假資料
        User::factory(3)->create();
        Cate::factory(5)->create();
        Product::factory(10)->create();

        // 建立權限
        $permission = Permission::create([
            'name' => 'product-list'
        ]);

        // 建立角色
        $role = Role::create([
            'name' => 'ProductListTester',
        ]);

        // 把權限分配給角色
        $role->syncPermissions($permission);

        // 建立user
        $user = User::create([
            'name' => 'Admin',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('1111'),
            'remember_token' => Str::random(10),
        ]);

        // user分配角色
        $user->assignRole('ProductListTester');

        // 取得token並登入
        $token = JWTAuth::fromUser($user);

        // 使用GET請求
        $response = $this->json('GET', 'api/products?token=' . $token);
        // 當發生例外錯誤時顯示錯誤訊息
        $this->withoutExceptionHandling();

        $resultStructure = [
            'data' => [
                '*' => [
                    'id',
                    'cate_name',
                    'operator_name',
                    'enabled',
                    'created_at',
                    'updated_at'
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total'
            ]
        ];

        $response->assertStatus(200)
            ->assertJsonStructure($resultStructure);
    }

    public function testCanCreateProduct()
    {
        // 建立權限
        $permission = Permission::create([
            'name' => 'product-create'
        ]);

        // 建立角色
        $role = Role::create([
            'name' => 'ProductCreateTester',
        ]);

        // 把權限分配給角色
        $role->syncPermissions($permission);

        // 建立user
        $user = User::create([
            'name' => 'Admin',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('1111'),
            'remember_token' => Str::random(10),
        ]);

        // user分配角色
        $user->assignRole('ProductCreateTester');

        // 取得token並登入
        $token = JWTAuth::fromUser($user);

        $cate = Cate::factory()->create();

        $formData = [
            'cate_id' => $cate->id,
            'name' => 'test',
            'description' => 'test描述'
        ];

        // 使用POST請求
        $response = $this->json('POST', 'api/products?token=' . $token, $formData);
        // 當發生例外錯誤時顯示錯誤訊息
        $this->withoutExceptionHandling();

        $response->assertStatus(201)->assertJson($formData);
    }
}