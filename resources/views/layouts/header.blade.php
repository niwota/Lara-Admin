<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lara-Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="dropdown">
        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{user_avatar(auth()->user()->avatar)}}" class="img-responsive img-circle" >
          {{auth()->user()->username}}
        </a> --}}
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{user_avatar(auth()->user()->avatar)}}" class="user-image" style="width: 28px;border-radius: 50%;">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="mr-1">{{auth()->user()->nickname}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item text-center" href="{{route('user.profile')}}">
            <i class="far fa-edit mr-2"></i>
            编辑资料
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-center" href="{{route('logout')}}">
            <button class="btn btn-danger">退出登录</button>
          </a>
        </div>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->