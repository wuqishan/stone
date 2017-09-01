@extends('admin.common.base')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}"/>
@endsection

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a href="{{ route('navigation.index') }}" class="layui-btn layui-btn-small" id="add">
                <i class="layui-icon">&#xe60a;</i> 导航列表
            </a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>导航添加</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">导航名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" placeholder="请输入导航名称" lay-verify="title" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">显示排序</label>
                <div class="layui-input-block">
                    <input type="text" name="order" placeholder="请输入排序" lay-verify="order" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">父级分类</label>
                <div class="layui-input-block">
                    <select name="order" lay-filter="order">
                        <option value="0">顶级分类</option>
                        @foreach($navigation as $v)
                            <option level="{{ $v['level'] }}" value="{{ $v['id'] }}">|---{{ $v['html'] }}{{ $v['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">Icon</label>
                <div class="layui-input-block">
                    <input type="text" name="icon" placeholder="请输入Icon" lay-verify="icon" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">是否展开</label>
                <div class="layui-input-block">
                    <input type="checkbox" checked="" name="spread" lay-skin="switch" lay-text="是|否">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">链接地址</label>
                <div class="layui-input-block">
                    <input type="text" name="href" placeholder="请输入链接地址" lay-verify="icon" class="layui-input">
                </div>
            </div>
            {{ csrf_field() }}
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="addNavigation">提 交</button>
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
            form.on('submit(addNavigation)', function (data) {
                $.post("{{ route('navigation.store') }}", data.field, function (res) {
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