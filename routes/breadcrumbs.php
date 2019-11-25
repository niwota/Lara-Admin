<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('主页', route('home'));
});

//菜单
Breadcrumbs::for('menu', function ($trail) {
    $trail->parent('home');
    $trail->push('菜单管理', route('menu.index'));
});

Breadcrumbs::for('menu-edit', function ($trail) {
    $trail->parent('menu');
    $trail->push('菜单编辑');
});


//权限
Breadcrumbs::for('permission', function ($trail) {
    $trail->parent('home');
    $trail->push('权限管理', route('permission.index'));
});

Breadcrumbs::for('permission-edit', function ($trail) {
    $trail->parent('permission');
    $trail->push('权限编辑');
});


//角色
Breadcrumbs::for('role', function ($trail) {
    $trail->parent('home');
    $trail->push('角色管理', route('role.index'));
});

Breadcrumbs::for('role-edit', function ($trail) {
    $trail->parent('role');
    $trail->push('角色编辑');
});


//用户
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('用户管理', route('user.index'));
});

Breadcrumbs::for('user-profile', function ($trail) {
    $trail->parent('home');
    $trail->push('编辑资料');
});

Breadcrumbs::for('user-edit', function ($trail) {
    $trail->parent('user');
    $trail->push('用户编辑');
});