<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    @section('css')
        <link rel="stylesheet" href="{{ asset('admin/plugins/layui/css/layui.css') }}" media="all">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.4.6.0.css') }}">
    @show

</head>
<body>

@yield('content')

@section('js')
    <script type="text/javascript" src="{{ asset('admin/plugins/layui/layui.js') }}"></script>
@show
</body>
</html>