@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}"/>
@endsection

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a href="{{ route('goods.index') }}" class="layui-btn layui-btn-small" id="add">
                <i class="layui-icon">&#xe60a;</i> 商品列表
            </a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>商品编辑</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">商品名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="{{ $goods['name'] }}" placeholder="请输入商品名称" lay-verify="name" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">是否显示</label>
                <div class="layui-input-block">
                    <input type="checkbox" @if ($goods['show']) checked @endif name="show" lay-skin="switch" lay-text="是|否">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">长/宽/高(cm)</label>
                    <div class="layui-input-inline" style="width: 100px;">
                        <input type="text" name="length" value="{{ $goods['length'] }}" placeholder="厘米" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid">/</div>
                    <div class="layui-input-inline" style="width: 100px;">
                        <input type="text" name="width" value="{{ $goods['width'] }}" placeholder="厘米" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid">/</div>
                    <div class="layui-input-inline" style="width: 100px;">
                        <input type="text" name="height" value="{{ $goods['height'] }}" placeholder="厘米" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">重量(kg)</label>
                    <div class="layui-input-inline">
                        <input type="text" name="weight" value="{{ $goods['weight'] }}" placeholder="千克" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">价格(￥)</label>
                    <div class="layui-input-inline">
                        <input type="text" name="price" value="{{ $goods['price'] }}" placeholder="元" lay-verify="price" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">简介</label>
                <div class="layui-input-block">
                    <textarea name="introduce" placeholder="请输入简单介绍" class="layui-textarea">{{ $goods['introduce'] }}</textarea>
                </div>
            </div>
            <input type="hidden" name="goods_id" value="{{ $goods['id'] }}">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="addGoods">提 交</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @parent
    <script>
        layui.use(['form', 'layedit', 'laydate', 'upload'], function () {
            var form = layui.form(),
                layer = layui.layer,
                $ = layui.jquery;
            form.verify({
                name: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '商品名称不能为空';
                    }
                },
                price: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '商品价格不能为空';
                    }
                }
            });
            //监听提交
            form.on('submit(addGoods)', function (data) {
                $.post("{{ route('goods.update') }}", data.field, function (res) {
                    var msg = '';
                    if (res.code === 0) {
                        msg = '添加成功';
                    } else {
                        msg = '添加失败';
                    }
                    layer.msg(msg, {time: 1000}, function () {
                        location.reload();
                    });
                });

                return false;
            });
        });
    </script>
@endsection