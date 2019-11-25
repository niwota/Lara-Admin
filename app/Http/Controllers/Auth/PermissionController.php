<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Cache;

class PermissionController extends Controller
{
    //
    public function index(){
        $res = Permission::select('id','name','display_name')->orderBy('id','desc')->paginate(15)->toArray();
        
        if(!isset($res)){
            abort(500);
        }
        $lists = cus_pagenation($res['data'],$res['total'],$res['per_page'],$res['current_page']);
        return view('auth.permission.index',compact(['lists']));
    }

    public function create(){
        $res = Permission::select('id','pid','display_name')->get()->toArray();
        $pp = unlimit_tree($res,1);
        return view('auth.permission.edit',compact(['pp']));
    }

    public function edit($id){
        $permission = Permission::find($id);
        $res = Permission::select('id','pid','display_name')->where('id','<>',$id)->get()->toArray();
        $pp = unlimit_tree($res,1);
        return view('auth.permission.edit',compact(['permission','pp','id']));
    }

    public function store(Request $request){
        $this->ruleValidate($request);
        $data = $request->except(['_token','is_create']);
        $guardName = $request->guard_name?:'web';
        $res = Permission::create($data);

        
        if(($request->is_create?:0) == 1){
            Permission::insert([
                [
                    'name'=>$request->name.'.index',
                    'display_name'=>$request->display_name.'列表',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ],
                [
                    'name'=>$request->name.'.create',
                    'display_name'=>$request->display_name.'创建',
                    'guard_name' => $guardName,
                    'pid'=> $res->id                  
                ],
                [
                    'name'=>$request->name.'.update',
                    'display_name'=>$request->display_name.'更新',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ],
                [
                    'name'=>$request->name.'.edit',
                    'display_name'=>$request->display_name.'编辑',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ],
                [
                    'name'=>$request->name.'.store',
                    'display_name'=>$request->display_name.'写入',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ],
                [
                    'name'=>$request->name.'.destroy',
                    'display_name'=>$request->display_name.'删除',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ],
                [
                    'name'=>$request->name.'.show',
                    'display_name'=>$request->display_name.'查看',
                    'guard_name' => $guardName,
                    'pid'=> $res->id
                ]
            ]);
        }
        
        if($res){
            Cache::forget('spatie.permission.cache');
            return redirect(route('permission.index'))->with('success','保存成功');
        }else{
            return back()->withErrors('添加失败');
        }
    }

    public function update(Request $request,$id){
        $this->ruleValidate($request);
        $data = $request->except(['_token','_method']);
        
        $res = Permission::where('id',$id)->update($data);

        if($res){
            Cache::forget('spatie.permission.cache');
            return redirect(route('permission.index'))->with('success','保存成功');
        }else{
            return back()->withErrors('编辑失败');
        }
    }

    public function destroy($id)
	{
		$res = Permission::where('id',$id)->delete();
		if($res){
            Cache::forget('spatie.permission.cache');
			return ['msg'=>'success'];
		}else{
			return ['errmsg'=>'删除失败！'];
		}
	}

    public function ruleValidate(Request $request){
        $rules = [
            'name' => 'required',
            'display_name' => 'required',
        ];
        $message = [
            'name.required' => '标识不能为空',
            'display_name.required' => '角色名不能为空',
        ];
        $this->validate($request,$rules,$message);
    }
}
