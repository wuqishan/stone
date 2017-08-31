@extends('admin.common.base')

@section('css')
    @parent
@endsection

@section('content')
    <div style="margin: 15px;">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>管理员信息</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">管理员名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" placeholder="请输入商品名称" lay-verify="name" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">是否显示</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="show" lay-skin="switch" lay-text="是|否">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">简介</label>
                <div class="layui-input-block">
                    <textarea name="introduce" placeholder="请输入简单介绍" class="layui-textarea"></textarea>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="updateAdmin">更 新</button>
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
                }
            });
            //监听提交
            form.on('submit(updateAdmin)', function (data) {
                $.post("{{ route('goods.store') }}", data.field, function (res) {
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