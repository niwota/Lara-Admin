@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('menu'))

@section('content')
<div class="card card-defualt">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('menu.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> 添加菜单</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>菜单名称</th>
                    <th class="text-center">路由名称</th>
                    <th class="text-center">排序</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuTree as $tree)
                <tr>
                    <td @if($tree['pid'] != 0) style="text-indent: 20px;" @endif>
                        <i class="{{$tree['icon']}}"></i> {{$tree['name']}}
                    </td>
                    <td class="text-center">
                        {{$tree['uri']}}
                    </td>
                    <td class="text-center">
                        {{$tree['order']}}
                    </td>

                    <td style="width: 20%;" class="text-center">
                        <a href="{{route('menu.edit',['menu'=>$tree['id']])}}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="javascript:;" class="table-link delete text-danger" data-src="{{route('menu.destroy',['menu'=>$tree['id']])}}" >
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-trash-alt fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection