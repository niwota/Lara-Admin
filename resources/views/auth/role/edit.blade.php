@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('role-edit'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('role.index')}}" class="btn btn-success"><i class="fa fa-chevron-left"></i> 返回列表</a>
        </div>
    </div>
    <div class="card-body">
        <form class="form-horizontal needs-validation" method="post" action="@isset($role){{route('role.update',['role'=>$id])}}@else{{route('role.store')}}@endisset">
            @csrf
            @isset($role)
                @method('PUT')
            @endisset

            @include('form.text',['label'=>'角色名称','name'=>'display_name','value'=>$role['display_name']??'','attr'=>'required'])
            @include('form.text',['label'=>'标识','name'=>'name','value'=>$role['name']??'','attr'=>'required'])
            <hr />

            <div >
                <h4 class="text-center">权限分派 <span class="btn btn-success btn-all ml-3 mr-3">全选</span> <span class="btn btn-danger btn-none">取消</span></h4>
                <ul class="permission-sel mt-5 ml-5">
                    @foreach ($permissionsTree ?? [] as $item)
                    <li>
                        <label class="checkbox-inline"><input type="checkbox" @if(isset($role) && $role->hasPermissionTo($item['name'])) checked @endif name="permissions[]" value="{{$item['id']}}" /> <span>{{$item['display_name']}}</span></label>
                        <ul @if(array_depth($item['children']??[])<4) class="nav ml-5" @endif >
                            @foreach($item['children'] ?? [] as $val)
                            <li class="mr-4">
                                <label class="checkbox-inline"><input type="checkbox" @if(isset($role) && $role->hasPermissionTo($val['name'])) checked @endif name="permissions[]" value="{{$val['id']}}" /> <span>{{$val['display_name']}}</span></label>
                                <ul class="nav ml-5">
                                    @foreach ($val['children'] ?? [] as $v)
                                    <li class="mr-4">
                                        <label class="checkbox-inline"><input type="checkbox" @if(isset($role) && $role->hasPermissionTo($v['name'])) checked @endif name="permissions[]" value="{{$v['id']}}" /> <span>{{$v['display_name']}}</span></label>
                                    </li>
                                    @endforeach
                                </ul>  
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group text-center" style="margin-top:40px;">
                <input type="submit" class="btn btn-primary" value=" 保存 ">
            </div>
        </form>
    </div>
</div>

@endsection