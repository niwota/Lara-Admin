<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Cache;

class RoleController extends Controller
{
    //
    public function index(){
        //$role = Role::find(4);
        //$permission = Permission::create(['name' => 'edit articles']);
        //$role->givePermissionTo($permission);
        //dd($role->getAllPermissions()->pluck('name')->toArray());
        $res = Role::select('id','name','display_name')->orderBy('id','desc')->paginate(15)->toArray();
        
        if(!isset($res)){
            abort(500);
        }
        $roles = cus_pagenation($res['data'],$res['total'],$res['per_page'],$res['current_page']);
        return view('auth.role.index',compact(['roles']));
    }

    public function create(){
        $permissions = Permission::select('id','pid','name','display_name')->get()->toArray();
        $permissionsTree = unlimit_tree($permissions,2);
        return view('auth.role.edit',compact(['permissionsTree']));
    }

    public function store(Request $request){
        $this->ruleValidate($request);
        $data = $request->except(['_token','permissions']);
        $role = Role::create($data);

        $res = $role->syncPermissions($request->permissions?:[]);
        if($res){
            Cache::forget('spatie.permission.cache');
            return redirect(route('role.index'))->with('success','保存成功');
        }else{
            return back()->withErrors('添加失败');
        }
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::select('id','pid','name','display_name')->get()->toArray();
        $permissionsTree = unlimit_tree($permissions,2);
        return view('auth.role.edit',compact(['role','permissionsTree','id']));
    }

    public function update($id,Request $request){
        $this->ruleValidate($request);
        $data = $request->except(['_token','_method','permissions']);
        $role = Role::findOrFail($id);
        $role->update($data);
        Cache::forget('spatie.permission.cache');
        $res = $role->syncPermissions($request->permissions?:[]);
        if($res){
            return redirect(route('role.index'))->with('success','更新成功');
        }else{
            return back()->withErrors('更新失败');
        }
    }

    public function destroy($id)
	{
		$res = Role::where('id',$id)->delete();
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
