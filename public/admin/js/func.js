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
            title: '上传商品图片列表',
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['800px', '380px'], //宽高
            content: $('#uploadTpl').html()
        });

        var loading = layer.load(1, {shade: [0.1,'#000']});
        // 获取初始化的图片数据
        $.get('/admin/image/'+goodsId, function(res){
            if (res.code === 0) {
                Func.prototype.showTr(res.data, goodsId);
            }
            layer.close(loading);
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
            var tr = '<tr id="upload-'+v.id+'"><td>'+v.origin_name+'</td><td>'+v.size+'</td>'+
                '<td><a href="javascript:func.delImg('+goodsId+', '+v.id+')" class="layui-btn layui-btn-mini layui-btn-danger">删除</a></td></tr>';
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

    Func.prototype.delSelectedGoods = function(goods_ids)
    {
        var result = 0;
        $.get('/admin/goods/delete/'+goods_ids, function(res){
            result = res.code;
        });

        return result;
    }

    Func.prototype.modifyShow = function (goods_id, if_show)
    {
        var result = 0;
        $.get('/admin/goods/update_show/'+goods_id+'/'+if_show, function(res){
            result = res.code;
        });

        return result;
    }
    
    func = new Func();
});