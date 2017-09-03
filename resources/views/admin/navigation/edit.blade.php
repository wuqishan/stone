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
                    <input type="text" name="title" value="{{ $navigation['title'] }}" placeholder="请输入导航名称" lay-verify="title" class="layui-input">
                </div>
            </div>
            @if($navigation['level'] !== 1)
            <div class="layui-form-item" id="style-icon">
                <label class="layui-form-label">Icon</label>
                <div class="layui-input-inline">
                    <input type="text" name="icon" value="{{ $navigation['icon'] }}" placeholder="请输入Icon" lay-verify="icon" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">显示icon的class，具体请参考 <a href="http://fontawesome.dashgame.com" target="_blank">http://fontawesome.dashgame.com</a></div>
            </div>
            @endif
            <div class="layui-form-item">
                <label class="layui-form-label">显示排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="order" value="{{ $navigation['order'] }}" placeholder="请输入排序" lay-verify="order" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">显示排序等级越小(整数)，排序越靠前</div>
            </div>
            @if($navigation['level'] === 2)
            <div class="layui-form-item" pane="" id="style-spread">
                <label class="layui-form-label">是否展开</label>
                <div class="layui-input-block">
                    <input type="checkbox" @if($navigation['spread'] === 1) checked @endif name="spread" lay-skin="switch" lay-text="是|否">
                </div>
            </div>
            @endif
            <div class="layui-form-item">
                <label class="layui-form-label">链接地址</label>
                <div class="layui-input-block">
                    <input type="text" name="href" value="{{ $navigation['href'] }}" placeholder="请输入链接地址" lay-verify="icon" class="layui-input">
                </div>
            </div>
            {{ csrf_field() }}
            {{ method_field('put') }}
            <input type="hidden" name="level" value="{{ $navigation['level'] }}">
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="updateNavigation">提 交</button>
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
                        return '导航名称不能为空';
                    }
                }
            });
            // 监听submit
            form.on('submit(updateNavigation)', function (data) {
                $.post("{{ route('navigation.update', ['navigation' => $navigation['id']]) }}", data.field, function (res) {
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