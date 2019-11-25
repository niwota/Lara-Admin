<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = User::create([
            'username'=>'admin',
            'nickname'=>'厚礼谢',
            'password'=>bcrypt('admin')
        ]);

        $role = Role::create([
            'name'=>'super-admin',
            'display_name'=>'超级管理员'
        ]);

        $user->assignRole('super-admin');

        Permission::insert([
            [
                'name' => 'other',
                'pid' => 0,
                'guard_name' => 'web',
                'display_name' => '其他'
            ],
            [
                'name' => 'user.profile',
                'pid' => 1,
                'guard_name' => 'web',
                'display_name' => '个人资料编辑	'
            ],
            [
                'name' => 'user.profile-save',
                'pid' => 1,
                'guard_name' => 'web',
                'display_name' => '个人资料保存'
            ]
        ]);

        Menu::insert([
            [
                'name' => '后台管理',
                'uri' => '',
                'icon' => 'fa fa-home',
                'permission' => 'admin',
                'pid' => 0
            ],
            [
                'name' => '菜单管理',
                'uri' => 'menu.index',
                'icon' => 'far fa-circle',
                'permission' => 'menu.index',
                'pid' => 1
            ],
            [
                'name' => '用户管理',
                'uri' => 'user.index',
                'icon' => 'far fa-circle',
                'permission' => 'user.index',
                'pid' => 1
            ],
            [
                'name' => '角色管理',
                'uri' => 'role.index',
                'icon' => 'far fa-circle',
                'permission' => 'role.index',
                'pid' => 1
            ],
            [
                'name' => '权限管理',
                'uri' => 'permission.index',
                'icon' => 'far fa-circle',
                'permission' => 'permission.index',
                'pid' => 1
            ]
        ]);
    }
}
