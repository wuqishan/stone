@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}"/>
@endsection

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a href="{{ route('auth.index') }}" class="layui-btn layui-btn-small" id="add">
                <i class="layui-icon">&#xe60a;</i> 权限列表
            </a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>权限编辑</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">权限名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="{{ $auth['title'] }}" placeholder="请输入权限名称" lay-verify="title" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">权限字符串</label>
                <div class="layui-input-block">
                    <input type="text" name="auth_temp" value="{{ $auth['auth'] }}" placeholder="请输入权限字符串" lay-verify="auth" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">权限导航</label>
                <div class="layui-input-block">
                    <select name="navigation_id" lay-verify="navigation_id" lay-search>
                        <option value>选择权限所属分类</option>
                        @foreach($navigation as $nav)
                            <optgroup label="{{ $nav['title'] }}">
                                @foreach($nav['children'] as $v)
                                    <option value="{{ $v['id'] }}" @if($auth['navigation_id'] === $v['id']) selected @endif>{{ $v['title'] }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="updateAuth">提 交</button>
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
                title: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '权限名称不能为空';
                    }
                },
                auth: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '权限字符串不能为空';
                    }
                },
                navigation_id: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '权限所属导航不能为空';
                    }
                }
            });
            //监听提交
            form.on('submit(updateAuth)', function (data) {
                $.post("{{ route('auth.update', ['auth' => $auth['id']]) }}", data.field, function (res) {
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