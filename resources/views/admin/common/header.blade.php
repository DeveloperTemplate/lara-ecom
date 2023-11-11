<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="noindex, nofollow"/>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/plugins/toastr/toastr.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    
    </div>
    <!-- loader END -->

    <style>
      .loading {
      z-index: 9999;
      position: fixed;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }
    
    
    .loading-content {
      position: absolute;
      border: 8px solid #f3f3f3; 
      border-top: 8px solid rgba(0, 0, 0, 0.9);
      border-radius: 50%;
      width: 50px;
      height: 50px;
      top: 40%;
      left: 45%;
      animation: spin .7s linear infinite;
      }
      
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000;
      }

      .ck-editor__editable {min-height: 400px;}

      .select2-container--default .select2-selection--single {
          padding-bottom: 30px;
      }
    </style>

<div id="loadingBox">
   <div id="loading-content"></div>
</div>

<div class="wrapper">
  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  {{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link text-primary" href="{{ url('admin/logout') }}">Logout</a>
      </li>
    </ul>
  </nav> --}}
  <!-- /.navbar -->

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">

    
    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
    <i class="far fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
    <div class="px-4 py-2 d-flex">
      <div>
        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" class="mt-2" width="50px" />
      </div>
      <div class="pl-3">
        <span class="d-block m-0 p-0">{{ Auth::user()->name }}</span>
        <span class="d-block m-0 p-0">{{ Auth::User()->roles()->first()->name }}</span>
        <span class="d-block m-0 p-0">{{ Auth::user()->email }}</span>
      </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="dropdown-divider"></div>
    <a href="{{ url('admin/change-password') }}" class="dropdown-item">
    <i class="fas fa-key mr-2"></i> Change Password
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{ url('admin/logout') }}" class="dropdown-item">
    <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
    </div>
    </li>
    </ul>
    </nav>