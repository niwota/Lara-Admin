@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('user'))

@section('content')
<div class="card card-default">
    <div class="card-header">
        <div class="col-sm-12">
            <a href="{{route('user.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> 添加用户</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>昵称</th>
                    <th>头像</th>
                    <th>角色</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users?:[] as $item)
                <tr>
                    <td>
                        {{$item['id']}}
                    </td>
                    <td>
                        {{$item['username']}}
                    </td>
                    <td>
                        {{$item['nickname']}}
                    </td>
                    <td>
                        <img style="width:40px;" class="img-circle elevation-2" src="{{user_avatar($item['avatar']??'')}}" alt="">
                    </td>
                    <td>
                        {!! implode('<br>',array_column($item['roles'],'display_name') ) !!}
                    </td>
                    <td style="width: 20%;">
                        <a href="{{route('user.edit',['user'=>$item['id']])}}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="javascript:;" class="table-link text-danger delete" data-src="{{route('user.destroy',['user'=>$item['id']])}}" >
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
            {!! $users->render() !!}
        </div>
    </div>
</div>
@endsection