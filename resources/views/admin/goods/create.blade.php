@extends('admin.common.base')

@section('css')
    @parent
@endsection

@section('content')
<div style="margin: 15px;">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>商品添加</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" action="{{ route('goods.store') }}">
        <div class="layui-form-item">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" placeholder="请输入商品名称" lay-verify="name" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                <input type="checkbox" checked="" name="show" lay-skin="switch" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">长/宽/高(cm)</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="length" placeholder="厘米" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">/</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="width" placeholder="厘米" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">/</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="height" placeholder="厘米" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">重量(kg)</label>
                <div class="layui-input-inline">
                    <input type="text" name="weight" placeholder="千克" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">价格(￥)</label>
                <div class="layui-input-inline">
                    <input type="text" name="price" placeholder="元" lay-verify="price" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-upload">
            <input type="file" value="" id="upload" multiple>
            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="preview"></div>
            </blockquote>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea name="introduce" placeholder="请输入简单介绍" class="layui-textarea"></textarea>
            </div>
        </div>
        <input type="hidden" name="image_id" lay-verify="image_id" value="1">
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


            layui.upload({
                elem: '#upload',
                url: '/upload/',
                ext:'txt',
                title: '选择图片上传',
                multiple: true,
                before: function(input){
                    console.log('文件上传中');
                },
                success: function(res){
                    console.log('上传完毕');
                },
                error: function (a) {
                    console.log(a);
                }
            });
            form.verify({
                name: function(value, item){ //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '商品名称不能为空';
                    }
                },
                price: function(value, item){ //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '商品价格不能为空';
                    }
                },
                image_id: function(value, item){ //value：表单的值、item：表单的DOM对象
                    if (value === '' || $.trim(value) === '') {
                        return '商品图片不能为空';
                    }
                }
            });
            //监听提交
            form.on('submit(addGoods)', function (data) {
                console.log(data.field);
                $.post("{{ route('goods.store') }}", data.field, function (res) {
                    console.log(res);
                    layer.msg('添加成功', {time:1000}, function(){
//                        location.reload();
                    });
                });
                return false;
            });
        });
    </script>
@endsection