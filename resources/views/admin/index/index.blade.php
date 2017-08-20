@extends('admin.common.base')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/global.css') }}" media="all">
@endsection
@section('content')
    <div class="layui-layout layui-layout-admin" style="border-bottom: solid 5px #1aa094;">
        @include('admin.common.header')
        @include('admin.common.left_nav')

        <div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
            <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <i class="fa fa-dashboard" aria-hidden="true"></i>
                        <cite>控制面板</cite>
                    </li>
                </ul>
                <div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
                    <div class="layui-tab-item layui-show">
                        <iframe src="{{ url('admin/main') }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-footer footer footer-demo" id="admin-footer">
            <div class="layui-main">
                <p>2016 &copy;
                    <a href="http://m.zhengjinfan.cn/">m.zhengjinfan.cn/</a> LGPL license
                </p>
            </div>
        </div>
        <div class="site-tree-mobile layui-hide">
            <i class="layui-icon">&#xe602;</i>
        </div>
        <div class="site-mobile-shade"></div>

        @include('admin.common.lock_screen')
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript" src="{{ asset('admin/datas/nav.js') }}"></script>
    <script src="{{ asset('admin/js/index.js') }}"></script>
    <script>
        layui.use('layer', function() {
            var $ = layui.jquery,
                layer = layui.layer;

            $('#video1').on('click', function() {
                layer.open({
                    title: 'YouTube',
                    maxmin: true,
                    type: 2,
                    content: 'video.html',
                    area: ['800px', '500px']
                });
            });

        });
    </script>
@endsection

