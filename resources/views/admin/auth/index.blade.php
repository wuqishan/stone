@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/global.css') }}" media="all">
@endsection

@section('content')
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="{{ route('auth.create') }}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加权限
        </a>
        <a href="#" class="layui-btn layui-btn-danger layui-btn-small" id="getSelected">
            <i class="layui-icon">&#xe640;</i> 删除选中
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-warm layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
    </blockquote>
    <blockquote class="layui-elem-quote layui-quote-nm">
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-inline">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" id="title" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">权限</label>
                <div class="layui-input-block">
                    <input type="text" id="auth" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">权限导航</label>
                <div class="layui-input-block">
                    <select id="navigation_id" lay-search>
                        <option value>选择权限所属分类</option>
                        @foreach($navigation as $nav)
                            <optgroup label="{{ $nav['title'] }}">
                                @foreach($nav['children'] as $v)
                                    <option value="{{ $v['id'] }}">{{ $v['title'] }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                    <th>名称</th>
                    <th>导航</th>
                    <th>权限</th>
                    <th width="140">创建时间</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody id="content">
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="admin-table-page" style="background-color: #fff;border-top: 1px solid #e2e2e2;"><div id="paged" class="page"></div></div>
</div>
@endsection
@section('js')
    <!--模板-->
    <script type="text/html" id="tpl">
        @{{# layui.each(d.list, function(index, item){ }}
        <tr>
            <td><input type="checkbox" value="@{{ item.id }}" lay-skin="primary"></td>
            <td>@{{ item.title }}</td>
            <td>@{{ item.navigation_title }}</td>
            <td>@{{ item.auth }}</td>
            <td>@{{ item.created_at }}</td>
            <td>
                <a href="/admin/auth/@{{ item.id }}/edit" class="layui-btn layui-btn-warm layui-btn-mini"><i class="layui-icon">&#xe642;</i> 编辑</a>
            </td>
        </tr>
        @{{# }); }}
    </script>
    @parent
    <script>
        layui.config({
            base: '/admin/js/'
        });
        layui.use(['paging', 'form', 'upload'], function() {
            var $ = layui.jquery,
                paging = layui.paging(),
                layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
                layer = layui.layer, //获取当前窗口的layer对象
                form = layui.form();

            var page = paging.init({
                url: '{{ route("auth.index") }}', //地址
                elem: '#content', //内容容器
                params: {},
                type: 'GET',
                tempElem: '#tpl', //模块容器
                openWait: true,
                pageConfig: { //分页参数配置
                    elem: '#paged', //分页容器
                    pageSize: 3, //分页大小
                    skip: true
                },
                complate: function() {
                    //重新渲染复选框
                    form.render('checkbox');
                    form.on('checkbox(allChoose)', function(data){
                        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
                        child.each(function(index, item){
                            item.checked = data.elem.checked;
                        });
                        form.render('checkbox');
                    });
                    form.on('switch(switchShow)', function(data){
                        var goodsId = $(this).attr('data-id');
                        var ifShow = this.checked ? 1 : 0;
                        if (func.modifyShow(goodsId, ifShow) === 0) {
                            layer.msg('状态修改成功');
                        }
                    });
                },
            });
            //获取所有选择的列
            $('#getSelected').on('click', function() {
                var authId = [];
                $('#content input[type="checkbox"]').each(function() {
                    if ($(this).prop('checked')) {
                        authId.push($(this).val());
                    }
                });
                if (authId.length == 0) {
                    layer.msg('请选择需要删除的权限');
                } else {
                    layer.confirm('您确定删除该权限？', {btn: ['确定','删除']}, function(index){
                        $.post("/admin/auth/"+authId.join(','), {'_method': 'delete', '_token': '{{ csrf_token() }}'}, function (res) {
                            var msg = '';
                            if (res.code === 0) {
                                layer.msg('权限删除成功', {time: 1000}, function () {
                                    $('#search').click();
                                });
                            } else {
                                layer.msg('权限删除失败', {time: 1000});
                            }
                        });
                        layer.close(index);
                    });
                }
            });

            $('#search').on('click', function() {
                var title = $('#title').val();
                var auth = $('#auth').val();
                var navigationId = $('#navigation_id').val();
                page.get({title:title, auth: auth, navigationId: navigationId});
            });
        });
    </script>
@endsection