/** func.js 工具js */

var func;

layui.define(['jquery'], function(exports) {

    var $ = layui.jquery,
        layer = layui.layer,
        Func = function() { };

    /**
     * 修改当前上传的图片ID
     *
     * @param obj
     * @param changeIds
     * @param type
     */
    Func.prototype.modifyImgId = function(obj, changeIds, type)
    {
        var newImgIds;
        var originIds = obj.val();
        if (type === 'add') {
            if (obj.val() === '') {
                newImgIds = changeIds.join(',')
            } else {
                newImgIds = changeIds.join(',') + ',' + originIds;
            }
        } else {
            originIds = originIds.split(',');
            $.each(originIds, function(i, v) {
                if (v === changeIds) {
                    originIds.splice(i, 1);
                }
            });

            newImgIds = originIds.join(',');
        }


        obj.val(newImgIds);
    };

    /**
     * 删除已经上传的图片
     *
     * @param id
     */
    Func.prototype.delImg = function(id)
    {
        $.get('/admin/image/delete/'+id, function(res){
            if (res.code === 0) {
                $('#upload-'+id).remove();
                Func.prototype.modifyImgId($('#image_id'), id, 'del');
            }
        });
    };



    func = new Func();
});