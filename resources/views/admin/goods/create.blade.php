@extends('admin.common.base')

@section('css')
    @parent
@endsection

@section('content')
<div style="margin: 15px;">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>商品添加</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="请输入商品名称" class="layui-input">
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
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="weight_min" placeholder="千克" class="layui-input">
                </div>
                <div class="layui-form-mid">-</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="weight_max" placeholder="千克" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">价格(￥)</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="price_min" placeholder="元" class="layui-input">
                </div>
                <div class="layui-form-mid">-</div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="price_max" placeholder="元" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-upload">
            <button type="button" class="layui-btn" id="test2">多图片上传</button>
            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="demo2"></div>
            </blockquote>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入简单介绍" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">提 交</button>
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

            });
            //多图片上传
//            upload.upload({
//                elem: '#test2'
//                ,url: '/upload/'
//                ,multiple: true
//                ,before: function(obj){
//                    //预读本地文件示例，不支持ie8
//                    obj.preview(function(index, file, result){
//                        $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
//                    });
//                }
//                ,done: function(res){
//                    //上传完毕
//                }
//            });

            //监听提交
            form.on('submit(demo2)', function (data) {
                layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                })
                return false;
            });
        });
    </script>
@endsection