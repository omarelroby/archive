<!DOCTYPE html>
<html class="loading" data-textdirection="rtl">
<head>
    <base href="/">
    <meta charset="utf-8" />
    <title>Archive | Login </title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{url('/assets/css/pages/login/login-4.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{url('/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{url('/assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{url('/assets/media/logos/610142fad0e8blogo.png')}}" />
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

{{--  begin:: Page  --}}
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(/assets/media/shot.jpg);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img style="width: 100px;" src="{{url('/assets/media/logos/610142fad0e8blogo.png')}}">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">
                                تسجيل الدخول الي نظام الأرشفة
                            </h3>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal form-simple" method="post" action="{{ url('dashboard/boards/login/post') }}">
                            @csrf
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <input type="text" name="email" class="form-control form-control-lg input-lg" placeholder="البريد الالكتروني">
                                <div class="form-control-position">
                                    <i class="ft-mail"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="password" class="form-control form-control-lg input-lg" placeholder="كلمة المرور">
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>

                            <button type="submit" class="btn btn-brand btn-pill kt-login__btn-primary"><i class="ft-unlock"></i> تسجيل دخول</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- BEGIN VENDOR JS-->
<script src="{{url('/assets/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{url('/assets/js/app-menu.js')}}"></script>
<script src="{{url('/assets/js/app.js')}}"></script>
<!-- END ROBUST JS-->
</body>
</html>

