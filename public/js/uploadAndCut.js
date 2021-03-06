/**
 * Created by Leo on 16-7-19.
 * Updated by Leo on 18-2-27.
 */

var appUrl = "/";
var uploadUrl = appUrl + "upload/";
var uploadApi = appUrl + "image/upload";
var cutApi = appUrl + "image/cut";
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
                if (result.data.width == result.data.height) {
                    $("#preview").attr('src', uploadUrl + result.data.filename);
                } else {
                    $("#avatar").val(result.data.filename);
                    var html = '<img id="jcrop" style="width:' + result.data.width + 'px;height:' + result.data.height + 'px;display:block" src="' + uploadUrl + result.data.filename + '">';
                    var modalTop = result.data.height >= 800 ? -444 : (0 - result.data.height / 2 - 44);
                    $("#modal").css("margin-top", modalTop);
                    $("#modal").find(".modal-body>p").html(html);
                    $("#mask").show();
                    $("#modal").show();
                    x = y = w = h = 0;
                    var cutWidth = Math.ceil($("#modal").width() / 2);
                    var cutHeight = Math.ceil(cutWidth / 2 / ar);
                    $(".modal-body>p>img").Jcrop({
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
            $("#avatar").val(uploadUrl + result.data.imgname);
            $("#mask").hide();
            $("#modal").find(".modal-body>p").html('');
            $("#modal").hide();
        } else {
            alert(result.message);
        }
    }, "json");
});
$(".modal-footer").find(".close").click(function() {
    $("#mask").hide();
    $("#modal").find(".modal-body>p").html('');
    $("#modal").hide();
});