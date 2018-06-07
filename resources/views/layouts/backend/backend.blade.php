<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/back-end/css/bootstrap.min.css">
    <link rel="stylesheet" href="/back-end/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/back-end/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/back-end/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/back-end/css/skins/vargatt.css">
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-vargatt sidebar-mini">
<div class="wrapper">

    @include('layouts.backend.navbar')
    @include('layouts.backend.sidebar')
    @yield('content')


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.6
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

</div>


<script src="/back-end/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/back-end/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/back-end/js/app.min.js"></script>
@yield('script')
<script src="//use.edgefonts.net/aclonica.js"></script>
</body>
</html>