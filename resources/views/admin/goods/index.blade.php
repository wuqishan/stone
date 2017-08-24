@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/css/global.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('admin/css/table.css') }}" />
@endsection


@section('content')
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加信息
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="import">
            <i class="layui-icon">&#xe608;</i> 导入信息
        </a>
        <a href="#" class="layui-btn layui-btn-small">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 导出信息
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="getSelected">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 获取全选信息
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" lay-filter="allselector" lay-skin="primary"></th>
                    <th>名称</th>
                    <th>长/宽/高 (cm)</th>
                    <th>重量 (kg)</th>
                    <th>价格 (￥)</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="content">
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="paged" class="page">
        </div>
    </div>
</div>
<script type="text/html" id="uploadTpl">
    <div class="layui-upload">
        <div class="layui-box layui-upload-button">
            <form target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data">
                <input type="file" name="images[]" value="" id="upload-images" multiple="">
            </form>
            <span class="layui-upload-icon"><i class="layui-icon"></i>选择图片上传</span>
        </div>
        <div class="layui-upload-list">
            <table class="layui-table">
                <thead><tr><th>文件名</th><th>大小(bytes)</th><th>操作</th></tr></thead>
                <tbody id="img-list"></tbody>
            </table>
        </div>
    </div>
</script>
@endsection
@section('js')
    <!--模板-->
    <script type="text/html" id="tpl">
        @{{# layui.each(d.list, function(index, item){ }}
        <tr>
            <td><input type="checkbox" value="@{{ item.id }}" lay-skin="primary"></td>
            <td>@{{ item.name }}</td>
            <td>@{{ item.length }} / @{{ item.width }} / @{{ item.height }}</td>
            <td>@{{ item.weight }}</td>
            <td>@{{ item.price }}</td>
            <td>@{{ item.created_at }}</td>
            <td>
                <button data-id="@{{ item.id }}" class="layui-btn layui-btn-mini add-images"><i class="layui-icon">&#xe64a;</i> 添加图片</button>
                <button target="_blank" class="layui-btn layui-btn-normal layui-btn-mini">预览</button>
                <a href="javascript:;" data-name="@{{ item.name }}" data-opt="edit" class="layui-btn layui-btn-mini">编辑</a>
                <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
            </td>
        </tr>
        @{{# }); }}
    </script>
    @parent
    <script type="text/javascript" src="{{ asset('admin/js/func.js') }}"></script>
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

            paging.init({
                url: '{{ route("goods.index") }}', //地址
                elem: '#content', //内容容器
                params: { //发送到服务端的参数
                },
                type: 'GET',
                tempElem: '#tpl', //模块容器
                pageConfig: { //分页参数配置
                    elem: '#paged', //分页容器
                    pageSize: 3 //分页大小
                },
                success: function() { //渲染成功的回调
                    //alert('渲染成功');
                },
                fail: function(msg) { //获取数据失败的回调
                    //alert('获取数据失败')
                },
                complate: function() { //完成的回调
                    //alert('处理完成');
                    //重新渲染复选框
                    form.render('checkbox');
                    form.on('checkbox(allselector)', function(data) {
                        var elem = data.elem;

                        $('#content').children('tr').each(function() {
                            var $that = $(this);
                            //全选或反选
                            $that.children('td').eq(0).children('input[type=checkbox]')[0].checked = elem.checked;
                            form.render('checkbox');
                        });
                    });

                    //绑定所有编辑按钮事件
                    $('#content').children('tr').each(function() {
                        var $that = $(this);
                        $that.children('td:last-child').children('a[data-opt=edit]').on('click', function() {
                            layer.msg($(this).data('name'));
                        });
                    });
                },
            });
            //获取所有选择的列
            $('#getSelected').on('click', function() {
                var names = '';
                $('#content').children('tr').each(function() {
                    var $that = $(this);
                    var $cbx = $that.children('td').eq(0).children('input[type=checkbox]')[0].checked;
                    if($cbx) {
                        var n = $that.children('td:last-child').children('a[data-opt=edit]').data('name');
                        names += n + ',';
                    }
                });
                layer.msg('你选择的名称有：' + names);
            });

            $('#search').on('click', function() {
                parent.layer.alert('你点击了搜索按钮')
            });



            $(document).on('click', '.add-images', function() {

                var goodsId = $(this).attr('data-id');

                func.showUploadPanel();

                layui.upload({
                    elem: '#upload-images',
                    url: "{{ route('admin.image.upload', ['_token' => csrf_token()]) }}&goods_id="+goodsId,
                    ext: 'jpg|jpeg|png|gif',
                    title: '选择图片上传',
                    multiple: true,
                    before: function (input) {
                        loading = layer.load(1, {shade: [0.1,'#000']});
                    },
                    success: function (res) {
                        func.showTr(res.data, goodsId);
                        layer.close(loading);
                    }
                });
            });
        });
    </script>
@endsection