<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    //
    public function index(Menu $menu)
	{
		$menuTree = $menu->menuTree();
		return view('auth.menu.index',compact('menuTree'));
	}

	public function edit($id)
	{
		$topMenu =  Menu::select('id','name')->where('pid',0)->where('id','<>',$id)->pluck('name','id')->toArray();
		$menu = Menu::findOrFail($id)->toArray();

		return view('auth.menu.edit',compact(['topMenu','menu','id']));
	}

	public function create(){
		$topMenu =  Menu::select('id','name')->where('pid',0)->pluck('name','id')->toArray();
		return view('auth.menu.edit',compact(['topMenu']));
	}

	public function store(Request $request)
	{
		$this->ruleValidate($request);

		$res = Menu::create($request->all());
		if($res){
			Cache::forget('menuTree1');
			Cache::forget('menuTree2');
			return redirect(route('menu.index'))->with('success', '菜单添加成功');
		}else{
			return back()->withErrors('添加失败');
		}
		
	}

	public function update(Request $request,$id)
	{
		$this->ruleValidate($request);

		$res = Menu::where('id',$id)->update($request->except('_token','_method'));
		if($res){
			Cache::forget('menuTree1');
			Cache::forget('menuTree2');
			return redirect(route('menu.index'))->with('success', '菜单编辑成功');
		}else{
			return back()->withErrors('编辑失败');
		}
	}

	public function destroy($id)
	{
		$res = Menu::where('id',$id)->delete();
		if($res){
			Cache::forget('menuTree1');
			Cache::forget('menuTree2');
			return ['msg'=>'success'];
		}else{
			return ['errmsg'=>'删除失败！'];
		}

	}

	protected function ruleValidate(Request $request)
	{
		$this->validate($request,
			[
				'name' => 'required',
				'order' => 'required|numeric'
			],
			[
				'name.required' => '菜单名称不能为空',
				'order.required' => '排序字段不能为空',
				'order.numeric'	=> '排序字段必须为数字'
			]);
	}

}
