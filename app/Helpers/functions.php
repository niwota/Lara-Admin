<?php

use App\Models\Menu;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

//无限极树
function unlimit_tree($data,$type,$pid=0,$level=1){
    if($type == 1){
        static $tree = [];
    }else{
        $tree = [];
    }

    foreach($data as $key => $value) {
        if($value['pid'] == $pid) {
            if($type == 1){
                $value['level'] = $level;
                $tree[] = $value;
                unlimit_tree($data,$type,$value['id'],$level+1);
            }else{
                $value['level'] = $level;
                $value['children'] = unlimit_tree($data,$type,$value['id'],$level+1);
                $tree[$value['id']] = $value;
            }
        }
    }
    return $tree;
}

//计算数组深度
function array_depth($array) {
    if(!is_array($array)) return 0;
    $max_depth = 1;
    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = array_depth($value) + 1;
            $max_depth = max($depth,$max_depth);
        }
    }
    return $max_depth;
}

//获取菜单树
function get_menu($type = 2){
    $menu = new Menu();
    $tree = $menu->menuTree($type);
    //dd($tree);
    return $tree;
}

//自定义分页
function cus_pagenation($items,$total,$perPage, $currentPage = 1, array $options = []){
    $path = Paginator::resolveCurrentPath();
    $query = request()->query();
    $list = new LengthAwarePaginator($items,$total,$perPage,$currentPage,['path'=>$path,'query'=>$query]);
    return $list;
}

function simple_pagenation(array $data){
    $items = $data['list'] ?? [];
    $total = $data['pagination']['total'] ?? 0;
    $perPage = $data['pagination']['page_size'] ?? 0;
    $currentPage = $data['pagination']['current'] ?? 1;
    return cus_pagenation($items,$total,$perPage, $currentPage);
}

//头像上传
function avatar_uploade($base64_url){
    if($base64_url){
        $filePath = 'avatar/'.Str::random(12).'.png';
        $decode64_str = substr($base64_url, strpos($base64_url, ",")+1);
        $up = Storage::disk('public')->put($filePath, base64_decode($decode64_str));
        return $up ? $filePath : '';
    }else{
        return '';
    }
}

//头像链接
function user_avatar($avatar){
    if($avatar){
        return asset('storage/'.$avatar);
    }else{
        return asset('img/avatar.png');
    }
}