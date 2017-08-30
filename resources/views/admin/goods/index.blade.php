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
        <a href="{{ route('goods.create') }}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加产品
        </a>
        <a href="#" class="layui-btn layui-btn-danger layui-btn-small" id="getSelected">
            <i class="layui-icon">&#xe640;</i> 删除选中
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-warm layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
    </blockquote>
    <blockquote class="layui-elem-quote layui-quote-nm">
        <div class="layui-inline">
            <label class="layui-form-label" style="width: 35px">名称</label>
            <div class="layui-input-block" style="margin-left: 70px">
                <input type="text" id="goodsName" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">价格</label>
            <div class="layui-input-inline" style="width: 60px;">
                <input type="text" id="priceMin" placeholder="￥" class="layui-input">
            </div>
            &nbsp;-&nbsp;
            <div class="layui-input-inline" style="width: 60px;">
                <input type="text" id="priceMax" placeholder="￥" class="layui-input">
            </div>
        </div>

    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                    <th>名称</th>
                    <th>长/宽/高 (cm)</th>
                    <th>重量 (kg)</th>
                    <th>价格 (￥)</th>
                    <th>显示</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="content">
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="admin-table-page" style="background-color: #fff;border-top: 1px solid #e2e2e2;">
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
            <td width="60">
                <input type="checkbox" data-id="@{{ item.id }}" @{{# if (item.show == '1') { }} checked @{{# } }} lay-filter="switchShow" lay-skin="switch" lay-text="是|否">
            </td>
            <td>@{{ item.created_at }}</td>
            <td width="150">
                <a href="javascript:;" data-id="@{{ item.id }}" class="layui-btn layui-btn-normal layui-btn-mini add-images"><i class="layui-icon">&#xe64a;</i> 添加图片</a>
                <a href="/admin/goods/edit/@{{ item.id }}" class="layui-btn layui-btn-warm layui-btn-mini"><i class="layui-icon">&#xe642;</i> 编辑</a>
            </td>
        </tr>
        @{{# }); }}
    </script>
    @parent
    <script type="text/javascript" src="{{ asset('admin/js/func.js') }}?v=1"></script>
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
                url: '{{ route("goods.index") }}', //地址
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
                success: function() {},
                fail: function(msg) {},
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
                var goodsIds = [];
                $('#content input[type="checkbox"]').each(function() {
                    if ($(this).prop('checked')) {
                        goodsIds.push($(this).val());
                    }
                });
                if (goodsIds.length == 0) {
                    layer.msg('请选择需要删除的商品');
                } else {
                    if (func.delSelectedGoods(goodsIds) === 0) {
                        layer.msg('商品删除成功', {shift: -1, time: 1000}, function () {
                            $('#search').click();
                        });
                    };
                }
            });

            $('#search').on('click', function() {
                var goodsName = $('#goodsName').val();
                var priceMin = $('#priceMin').val();
                var priceMax = $('#priceMax').val();
                page.get({goodsName:goodsName, priceMin: priceMin, priceMax: priceMax});
            });

            $(document).on('click', '.add-images', function() {
                // 获取商品id
                var goodsId = $(this).attr('data-id');
                // 显示商品图片的panel
                func.showUploadPanel(goodsId);
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