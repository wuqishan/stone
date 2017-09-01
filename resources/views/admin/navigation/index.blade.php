@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/table.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/global.css') }}" />
@endsection


@section('content')
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="{{ route('navigation.create') }}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加分类
        </a>
    </blockquote>
    <div class="layui-tab layui-tab-card" style="width: 100%;">
        <ul class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>用户管理</li>
            <li>权限分配</li>
            <li>商品管理</li>
            <li>订单管理</li>
            <li>订单管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                1. 宽度足够，就不会出现右上图标；宽度不够，就会开启展开功能。
                <br>2. 如果你的宽度是自适应的，Tab会自动判断是否需要展开，并适用于所有风格。
            </div>
            <div class="layui-tab-item">2</div>
            <div class="layui-tab-item">3</div>
            <div class="layui-tab-item">4</div>
            <div class="layui-tab-item">5</div>
            <div class="layui-tab-item">6</div>
        </div>
    </div>
</div>
@endsection
@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('admin/js/func.js') }}?v=1"></script>
    <script>
        layui.config({
            base: '/admin/js/'
        });
        layui.use(['element'], function() {
            var element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块


        });
    </script>
@endsection