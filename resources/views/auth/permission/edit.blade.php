@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('permission-edit'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('permission.index')}}" class="btn btn-success"><i class="fa fa-chevron-left"></i> 返回列表</a>
        </div>
    </div>
    <div class="card-body">
        <form class="form-horizontal needs-validation" method="post" action="@isset($permission){{route('permission.update',['permission'=>$id])}}@else{{route('permission.store')}}@endisset">
            @csrf
            @isset($permission)
                @method('PUT')
            @endisset
            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">上级权限：</label>
                <div class="col-sm-3">
                    <select name="pid" class="form-control select2 ppid">
                        <option data-level="0" value="0">ROOT</option>
                        @foreach ($pp ?? [] as $key=>$item)
                            @if ($item['level'] < 3)
                                <option data-level="{{$item['level']}}" @isset($permission) {{$permission['pid'] == $item['id'] ? 'selected' : ''}} @endisset value="{{$item['id']}}">
                                    {!!$item['level'] == 2 ? str_repeat('&nbsp;',6) : ''!!}{{$item['display_name']}}
                                </option>
                            @endif   
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            @include('form.text',['label'=>'名称','name'=>'display_name','value'=>$permission['display_name']??'','attr'=>'required'])
            @include('form.text',['label'=>'标识','name'=>'name','value'=>$permission['name']??'','attr'=>'required'])
            @if(!isset($permission))
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-right">创建restful权限：</label>
                    <div class="col-sm-3">
                        <div class="icheck-primary">
                            <input type="checkbox" name="is_create" id="is_create" value="1">
                            <label for="is_create"></label>
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-group col-sm-10 text-center" style="margin-top:40px;">
                <input type="submit" class="btn btn-primary" value=" 保存 ">
            </div>
        </form>
    </div>
</div>
@endsection

