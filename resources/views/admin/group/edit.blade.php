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
            <legend>权限组编辑</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">权限组名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="{{ $group['title'] }}" placeholder="请输入权限组名称" lay-verify="title" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">权限组简介</label>
                <div class="layui-input-block">
                    <textarea name="comments" placeholder="请输入权限组简介" lay-verify="comments" class="layui-textarea">{{ $group['comments'] }}</textarea>
                </div>
            </div>
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="updateGroup">提 交</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @parent
    <script>
        layui.use(['form'], function () {
            var form = layui.form(),
                layer = layui.layer,
                $ = layui.jquery;
            form.verify({
                title: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '权限组名称不能为空';
                    }
                },
                comments: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '请输入权限组简介不能为空';
                    }
                }
            });
            // 监听submit
            form.on('submit(updateGroup)', function (data) {
                $.post("{{ route('group.update', ['group' => $group['id']]) }}", data.field, function (res) {
                    var msg = '';
                    if (res.code === 0) {
                        msg = '更新成功';
                    } else {
                        msg = '更新失败';
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