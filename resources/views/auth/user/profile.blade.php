@extends('layouts.layout')

@section('breadcrumbs',Breadcrumbs::render('user-profile'))

@section('content')
<div class="card card-default">
    <div class="card-header text-center">
        个人资料编辑
    </div>
    <div class="card-body">
        <form class="form-horizontal needs-validation" method="post" action="{{route('user.profile-save')}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('form.text',['label'=>'用户名','name'=>'username','value'=>$user['username']??'','attr'=>'required'])
            @include('form.text',['label'=>'昵称','name'=>'nickname','value'=>$user['nickname']??'','attr'=>'required'])
            @include('form.text',['type'=>'password','id'=>'password','label'=>'密码','name'=>'password','value'=>''])
            @include('form.text',['type'=>'password','id'=>'password_confirmation','label'=>'确认密码','name'=>'password_confirmation','value'=>''])
            @include('form.avatar')
            <hr />
            <div class="form-group text-center" style="margin-top:40px;">
                <input type="submit" class="btn btn-primary" value=" 保存 ">
            </div>
        </form>
    </div>
</div>

@endsection