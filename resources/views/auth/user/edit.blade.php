@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('user-edit'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('user.index')}}" class="btn btn-success"><i class="fa fa-chevron-left"></i> 返回列表</a>
        </div>
    </div>
    <div class="card-body">
        <form class="form-horizontal needs-validation" method="post" action="@isset($user){{route('user.update',['user'=>$id])}}@else{{route('user.store')}}@endisset"  enctype="multipart/form-data">
            @csrf
            @isset($user)
                @method('PUT')
            @endisset

            @include('form.text',['label'=>'用户名','name'=>'username','value'=>$user['username']??'','attr'=>'required'])
            @include('form.text',['label'=>'昵称','name'=>'nickname','value'=>$user['nickname']??'','attr'=>'required'])
            @isset($user)
                @include('form.text',['type'=>'password','id'=>'password','label'=>'密码','name'=>'password','value'=>''])
                @include('form.text',['type'=>'password','id'=>'password_confirmation','label'=>'确认密码','name'=>'password_confirmation','value'=>''])
            @else
                @include('form.text',['type'=>'password','id'=>'password','label'=>'密码','name'=>'password','value'=>'','attr'=>'required'])
                @include('form.text',['type'=>'password','id'=>'password_confirmation','label'=>'确认密码','name'=>'password_confirmation','value'=>'','attr'=>'required'])
            @endisset

            @include('form.avatar')

            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">请选择角色：</label>
                <div class="col-sm-8">
                    <select name="roles[]" multiple class="form-control select2" >
                        @foreach ($roles??[] as $key=>$item)
                                <option @isset($user) {{$user->hasRole($item['name'])?'selected':''}} @endisset  value="{{$item['id']}}">{{$item['display_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <hr />

            {{-- <div >
                <h4 class="text-center">权限分派 <span class="btn btn-success btn-all ml-3 mr-3">全选</span> <span class="btn btn-danger btn-none">取消</span></h4>
                <ul class="permission-sel mt-5 ml-5">
                    @foreach ($permissionsTree ?? [] as $item)
                    <li>
                        <label class="checkbox-inline"><input type="checkbox" @if(isset($user) && $user->hasPermissionTo($item['name'])) checked @endif name="permissions[]" value="{{$item['id']}}" /> <span>{{$item['display_name']}}</span></label>
                        <ul @if(array_depth($item['children']??[])<4) class="nav ml-5" @endif >
                            @foreach($item['children'] ?? [] as $val)
                            <li class="mr-4">
                                <label class="checkbox-inline"><input type="checkbox" @if(isset($user) && $user->hasPermissionTo($val['name'])) checked @endif name="permissions[]" value="{{$val['id']}}" /> <span>{{$val['display_name']}}</span></label>
                                <ul class="nav ml-5">
                                    @foreach ($val['children'] ?? [] as $v)
                                    <li class="mr-4">
                                        <label class="checkbox-inline"><input type="checkbox" @if(isset($user) && $user->hasPermissionTo($v['name'])) checked @endif name="permissions[]" value="{{$v['id']}}" /> <span>{{$v['display_name']}}</span></label>
                                    </li>
                                    @endforeach
                                </ul>  
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div> --}}

            <div class="form-group text-center" style="margin-top:40px;">
                <input type="submit" class="btn btn-primary" value=" 保存 ">
            </div>
        </form>
    </div>
</div>

@endsection