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
            <legend>权限组的权限编辑</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">原始复选框</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="like1[write]" lay-skin="primary" title="写作" checked="">
                    <input type="checkbox" name="like1[read]" lay-skin="primary" title="阅读">
                    <input type="checkbox" name="like1[game]" lay-skin="primary" title="游戏" disabled="">
                </div>
            </div>
            {{ csrf_field() }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="updateGroupAuth">提 交</button>
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
            form.on('submit(updateGroupAuth)', function (data) {
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