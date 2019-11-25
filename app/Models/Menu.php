<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'menu';

    protected $guarded = ['_token','_method'];

    /*
    * 目录树
    * $type 1，2
    * return 当$type=1时，返回无限分类二维数组，$type=2时返回无限分类树
    */
    public function menuTree($type=1)
    {
        $menuTree = [];
        if(Cache::has('menuTree'.$type)){
            $menuTree[$type] = json_decode(Cache::get('menuTree'.$type),true);
        }else{
            $menuObj = self::select('id','name','order','uri','pid','icon','permission')->orderBy('order','desc')->get()->toArray();
            $menuTree[$type] = unlimit_tree($menuObj,$type);
            Cache::forever('menuTree'.$type,json_encode($menuTree[$type]));
        }

        return $menuTree[$type];
    }
}
