/** func.js 工具js */

var func;

layui.define(['jquery', 'layer'], function(exports) {

    var $ = layui.jquery,
        layer = layui.layer,
        Func = function() {};

    /**
     * 显示图片上传panel
     *
     * @param id
     */
    Func.prototype.showUploadPanel = function(goodsId)
    {
        // 显示窗口
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['800px', '500px'], //宽高
            content: $('#uploadTpl').html()
        });
        // 获取初始化的图片数据
        $.get('/admin/image/'+goodsId, function(res){
            if (res.code === 0) {
                // 显示
            }
        });
    };

    /**
     * 显示图片列表Tr
     *
     * @param id
     */
    Func.prototype.showTr = function(data, goodsId)
    {
        $.each(data, function (i, v) {
            var tr = '<tr id="upload-'+v.img_id+'"><td>'+v.origin_name+'</td><td>'+v.size+'</td>'+
                '<td><a href="javascript:func.delImg('+goodsId+', '+v.img_id+')" class="layui-btn layui-btn-mini layui-btn-danger">删除</a></td></tr>';
            $('#img-list').append(tr);
        });
    };

    /**
     * 删除已经上传的图片
     *
     * @param id
     */
    Func.prototype.delImg = function(goods_id, image_id)
    {
        $.get('/admin/image/delete/'+goods_id+'/'+image_id, function(res){
            if (res.code === 0) {
                $('#upload-'+image_id).remove();
            }
        });
    };



    func = new Func();
});