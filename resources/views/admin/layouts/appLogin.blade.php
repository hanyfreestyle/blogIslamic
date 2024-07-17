<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('adminConfig.title')}}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">



@yield('StyleFile')
<!-- Theme style -->
    <link rel="stylesheet" href="{{ defAdminAssets('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('css/custom_login.css') }}">

    @yield('StyleCode')
</head>

<body class="hold-transition login-page">
@yield('content')


<!-- jQuery -->
<script src="{{ defAdminAssets('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ defAdminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@yield('JsFile')
@yield('JsCode')
</body>
</html>
