@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('menu-edit'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('menu.index')}}" class="btn btn-success"><i class="fa fa-chevron-left"></i> 返回列表</a>
        </div>
    </div>
    <div class="card-body">
        <form class="form-horizontal" id="needs-validation" novalidate method="post" action="@isset($menu){{route('menu.update',['menu'=>$id])}}@else{{route('menu.store')}}@endisset">
            @csrf
            @isset($menu)
                @method('PUT')
            @endisset

            @include('form.select',['label'=>'上级菜单','name'=>'pid','value'=>$menu['pid']??0,'options'=>$topMenu,'vk'=>1,'selecthead'=>'Root'])
            @include('form.text',['label'=>'菜单名','name'=>'name','value'=>$menu['name']??'','attr'=>'required'])

            @include('form.iconpicker',['value'=>$menu['icon']??''])
            
            {{-- @include('form.text',['label'=>'Icon','name'=>'icon','value'=>$menu['icon']??'far fa-circle']) --}}
            @include('form.text',['label'=>'路由名','name'=>'uri','value'=>$menu['uri']??''])
            @include('form.text',['label'=>'排序','name'=>'order','value'=>$menu['order']??1,'attr'=>'required'])
            @include('form.text',['label'=>'权限','name'=>'permission','value'=>$menu['permission']??'','attr'=>'required'])
            <div class="form-group col-sm-10 text-center" style="margin-top:40px;">
                <input type="submit" class="btn btn-primary" value=" 保存 ">
            </div>
        </form>
    </div>
</div>

@endsection
