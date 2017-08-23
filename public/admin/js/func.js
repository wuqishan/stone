/** tab.js By Beginner Emain:zheng_jinfan@126.com HomePage:http://www.zhengjinfan.cn */
var func;
layui.define(['jquery'], function(exports) {

    var $ = layui.jquery,
        Func = function() {};
    /**
     * 初始化
     */
    Func.prototype.modifyImgId = function(obj, addImgId) {
        var newImgIds
        if (obj.val() == '') {
            newImgIds = addImgId.join(',')
        } else {
            newImgIds = addImgId.join(',') + ',' + obj.val();
        }

        obj.val(newImgIds);
    };
    /**
     * 查询tab是否存在，如果存在则返回索引值，不存在返回-1
     * @param {String} 标题
     */
    Func.prototype.delImg = function(id) {
        $.get('/admin/image/delete/'+id, function(res){
            console.log(res);
        });
    };

    Func.prototype.aaa = function() {
        alert(44)
    };

    func = new Func();
});