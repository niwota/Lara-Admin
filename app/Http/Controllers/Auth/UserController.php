<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;

class UserController extends Controller
{
    //
    public function index(){
        $res = User::select('id','username','nickname','avatar')->with(['roles'=>function($q){
            $q->select('display_name');
        }])->orderBy('id','desc')->paginate(15)->toArray();
        if(!isset($res)){
            abort(500);
        }
        $users = cus_pagenation($res['data'],$res['total'],$res['per_page'],$res['current_page']);
        return view('auth.user.index',compact(['users']));
    }

    public function create(){
        $roles = Role::select('id','display_name','name')->get()->toArray();
        return view('auth.user.edit',compact(['roles']));
    }
    

    public function store(Request $request){
        $this->ruleValidate($request);
        $data = $request->except(['_token','password_confirmation','roles']);
        $data['password'] = bcrypt($request->password);
        $data['avatar'] = avatar_uploade($request->avatar);
        $res = User::create($data);
        $res->syncRoles($request->roles?:[]);
        if($res){
            return redirect(route('user.index'))->with('success','保存成功');
        }else{
            return back()->withErrors('添加失败');
        }
    }

    public function profile(){
        $user = auth()->user();
        return view('auth.user.profile',compact(['user']));
    }

    public function profileSave(Request $request){
        $this->ruleValidate($request);
        $user = auth()->user();
        $data = $request->except(['_token','_method','password_confirmation']);
        if($data['password'] == ''){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($request->password);
        }
        if($request->avatar){
            $data['avatar'] = avatar_uploade($request->avatar);
        }else{
            unset($data['avatar']);
        }

        if($user->update($data)){
            return redirect(route('home'))->with('success','保存成功');
        }else{
            return back()->withErrors('更新失败');
        }
        
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::select('id','name','display_name')->get()->toArray();
        return view('auth.user.edit',compact(['user','roles','id']));
    }

    public function update($id,Request $request){
        $this->ruleValidate($request);
        $user = User::findOrFail($id);
        $data = $request->except(['_token','_method','password_confirmation','roles']);
        if($data['password'] == ''){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($request->password);
        }
        if($request->avatar){
            $data['avatar'] = avatar_uploade($request->avatar);
        }else{
            unset($data['avatar']);
        }

        if($user->update($data)){
            $res = $user->syncRoles($request->roles?:[]);
            return redirect(route('user.index'))->with('success','保存成功');
        }else{
            return back()->withErrors('更新失败');
        }
    }

    public function destroy($id)
	{
        $user = User::where('id',$id)->first();
        $res = $user->delete();
		if($res){
			return ['msg'=>'success'];
		}else{
			return ['errmsg'=>'删除失败！'];
		}
	}

    public function ruleValidate(Request $request){
        $rules = [
            'username' => 'required',
            'nickname' => 'required',
            'password' => 'required|confirmed',
        ];
        $message = [
            'username.required' => '用户名不能为空',
            'nickname.required' => '昵称不能为空',
            'password.required' => '密码不能为空',
            'password.confirmed' => '密码与确认密码不一致'
        ];
        
        if($request->method()=='PUT' && $request->password == ''){
            unset($rules['password']);
        }
        $this->validate($request,$rules,$message);
    }
}
