/**
 * Created by Leo on 16-7-19.
 * Updated by Leo on 18-2-27.
 */

var appUrl = "/";
var uploadUrl = appUrl + "upload/";
var uploadApi = appUrl + "file/upload";
var cutApi = appUrl + "file/cut";
var x = 0,
    y = 0,
    w = 0,
    h = 0;
var jcropApi = '';

/**上传单张图片**/
function uploadImg() {
    var obj = arguments[0];
    if (!obj) {
        obj = this;
    }
    var ar = arguments[1] || 1;
    var inputId = $(obj).attr("id");
    console.info(inputId);
    if (!inputId) {
        alert("上传控件没有定义\"id\"属性");
        return false;
    }
    $.ajaxFileUpload({
        fileElementId: inputId,
        url: uploadApi,
        dataType: 'json',
        data: { 'inputId': inputId },
        success: function(result, textStatus) {
            if (result.code != 200) {
                alert(result.message);
            } else {
                console.dir(result);
                $("#avatar").val(result.data.filename);
                var html = '<img id="jcrop" style="width:500px;height:500px;display:block" src="' + uploadUrl + result.data.filename + '">';
                $("#modal").find(".modal-body").html(html);
                $("#mask").show();
                $("#modal").show();
                x = y = w = h = 0;
                var cutWidth = Math.ceil($("#modal").width() / 2);
                var cutHeight = Math.ceil(cutWidth / 2 / ar);
                $(".modal-body").Jcrop({
                    bgOpacity: 0.4,
                    aspectRatio: ar,
                    setSelect: [0, 0, cutWidth, cutHeight],
                    onSelect: function(c) {
                        x = c.x;
                        y = c.y;
                        w = c.w;
                        h = c.h;
                    }
                }, function() {
                    jcropApi = this;
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            var msg = "服务器出错，错误内容：" + XMLHttpRequest.responseText;
            alert(msg);
        }
    });
}
/*裁剪图片*/
$(".modal-footer").find(".save").click(function() {
    $.post(cutApi, { 'path': $("#avatar").val(), 'x': x, 'y': y, 'w': w, 'h': h }, function(result) {
        if (result.code == 200) {
            $("#preview").attr('src', uploadUrl + result.data.imgname);
            //$("#avatar").val(data.data);
        } else {
            alert($result.message);
        }
    }, "json");
});