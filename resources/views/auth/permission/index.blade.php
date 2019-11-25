@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('permission'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('permission.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> 添加权限</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>权限名称</th>
                    <th>标识</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $item)
                <tr>
                    <td>
                        {{$item['id']}}
                    </td>
                    <td>
                        {{$item['display_name']}}
                    </td>
                    <td>
                        {{$item['name']}}
                    </td>
                    <td style="width: 20%;">
                        <a href="{{route('permission.edit',['permission'=>$item['id']])}}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="javascript:;" class="table-link text-danger delete" data-src="{{route('permission.destroy',['permission'=>$item['id']])}}" >
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
        <div class="float-right mt-4">
            {!! $lists->render() !!}
        </div>
    </div>
</div>
@endsection