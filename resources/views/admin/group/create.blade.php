@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}"/>
@endsection

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a href="{{ route('group.index') }}" class="layui-btn layui-btn-small" id="add">
                <i class="layui-icon">&#xe60a;</i> 权限组列表
            </a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>权限组添加</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">权限组名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" placeholder="请输入权限组名称" lay-verify="title" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">权限组简介</label>
                <div class="layui-input-block">
                    <textarea name="comments" placeholder="请输入权限组简介" lay-verify="comments" class="layui-textarea"></textarea>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="addGroup">提 交</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @parent
    <script>
        layui.use(['form', 'layedit', 'laydate'], function () {
            var form = layui.form(),
                layer = layui.layer,
                $ = layui.jquery;
            form.verify({
                title: function (value, item) {
                    if (value === '' || $.trim(value) === '') {
                        return '权限组名称不能为空';
                    }
                },
                comments: function (value, item) {
                    if (value === '' || $.trim(value) === '') {
                        return '权限组简介不能为空';
                    }
                }
            });
            //监听提交
            form.on('submit(addGroup)', function (data) {
                $.post("{{ route('group.store') }}", data.field, function (res) {
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