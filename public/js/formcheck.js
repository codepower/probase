/*js表单验证:根据固定的json格式字段验证信息进行验证*/
/**
 * create by Leo Liu @ 2018-3-19 
 */

function checkEmail(emailInput) {
    var preg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+/;
    emailInput += '';
    return null == emailInput.match(preg);
}

function checkMobile(numberInput) {
    var preg = /^1\d\d\d{8}/;
    numberInput += '';
    return null == numberInput.match(preg);
}

function checkField(infoData) {
    var msgList = [];
    for (var k in infoData) {
        var row = infoData[k];
        //必填判断
        if (row.hasOwnProperty("require") && row.require && (!row.input)) {
            msgList.push('请填写' + row.label);
        }

        //整数值范围判断
        if (row.hasOwnProperty("integer") && (row.input < row.integer.min || row.input > row.integer.max)) {
            msgList.push(row.label + '只能输入' + row.integer.min + '-' + row.integer.max + '之间的整数');
        }

        //小数值范围判断
        if (row.hasOwnProperty("decimal") && (row.input < row.decimal.min || row.input > row.decimal.max)) {
            msgList.push(row.label + '只能输入' + row.decimal.min + '-' + row.decimal.max + '之间的整数');
        }

        //字符长短判断
        if (row.hasOwnProperty("string") && (row.input.length < row.string.min || row.input.length > row.string.max)) {
            msgList.push(row.label + '的字符长度只能在' + row.string.min + '-' + row.string.max + '之间');
        }

        //邮箱格式判断
        if (row.hasOwnProperty("email") && row.email && checkEmail(row.input)) {
            msgList.push(row.label + '必须是邮箱格式，请填写正确的邮箱格式xxxxx@xxxx.xxx');
        }

        //手机号格式判断
        if (row.hasOwnProperty("mobile") && row.mobile && checkMobile(row.input)) {
            msgList.push(row.label + '必须是手机号格式，请填写正确的手机号格式');
        }
    }
    return msgList;
}
/**调用Demo*/
var jsonInfo = {
    "field1": { "label": "主键", "require": true, "integer": { "min": 0, "max": 255 }, "mobile": true, "input": 323 },
    "field2": { "label": "金额", "decimal": { "min": 0, "max": 255 }, "input": 444 },
    "field3": { "label": "备注", "string": { "min": 4, "max": 255 }, "input": "22" }
};
var result = Field(jsonInfo);
if (result.length > 0) {
    console.dir(result.join("\r\n"));
} else {
    console.dir('验证通过');
}