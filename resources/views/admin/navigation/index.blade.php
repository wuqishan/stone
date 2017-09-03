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
            @foreach($parents as $v)
                <li @if($loop->first) class="layui-this" @endif>{{ $v['title'] }}</li>
            @endforeach
        </ul>
        <div class="layui-tab-content">
            @foreach($parents as $v)
                <div class="layui-tab-item @if($loop->first) layui-show @endif">
                    <div class="layui-form">
                        <table class="layui-table">
                            <colgroup>
                                <col width="50">
                                <col>
                                <col width="160">
                                <col width="60">
                                <col width="90">
                                <col width="60">
                                <col>
                                <col width="160">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>分类名称</th>
                                <th>Icon</th>
                                <th>Level</th>
                                <th>默认展开</th>
                                <th>排序</th>
                                <th>链接地址</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allNodes[$loop->index] as $node)
                            <tr>
                                <td>{{ $node['id'] }}</td>
                                <td>│{{ $node['html'] }} {{ $node['title'] }}</td>
                                <td>{{ $node['icon'] }}</td>
                                <td>{{ $node['level'] }}</td>
                                <td>@if($node['spread'] === 0) 闭合 @else 展开 @endif</td>
                                <td>{{ $node['order'] }}</td>
                                <td>{{ $node['href'] }}</td>
                                <td>
                                    <a href="{{ route('navigation.edit', ['navigation' => $node['id']]) }}" class="layui-btn layui-btn-warm layui-btn-mini"><i class="layui-icon">&#xe642;</i> 编辑</a>
                                    <a href="javascript:;" data-id="{{ $node['id'] }}" class="layui-btn layui-btn-danger layui-btn-mini delete-nav"><i class="layui-icon">&#xe640;</i> 删除</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
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
            layer = layui.layer,
                $ = layui.jquery;

            $('.delete-nav').click(function() {
                var thisNav = $(this);
                layer.confirm('您确定删除该导航分类？', {btn: ['确定','删除']}, function(index){
                    $.post("/admin/navigation/"+thisNav.attr('data-id'), {'_method': 'delete', '_token': '{{ csrf_token() }}'}, function (res) {
                        var msg = '';
                        if (res.code === 0) {
                            layer.msg('导航分类删除成功', {time: 1000}, function () {
                                thisNav.parents('tr').remove();
                            });
                        } else {
                            layer.msg('导航分类删除失败', {time: 1000});
                        }
                    });
                    layer.close(index);
                });


//                alert($(this).attr('data-id'));
            });

        });
    </script>
@endsection
