/*js表单验证:根据固定的json格式字段验证信息进行验证*/
function check(infoData) {
    for (var row in infoData) {
        if (row.hasOwnProperty("require") && row.require && (!row.input)) {
            alert('请填写' + row.label);
            break;
            return false;
        }
        if (row.hasOwnProperty("integer") && (row.input < row.integer.min || row.input > row.integer.max)) {
            alert(row.label + '只能输入' + row.integer.min + '-' + row.integer.max + '之间的整数');
            break;
            return false;
        }
        if (row.hasOwnProperty("decimal") && (row.input < row.decimal.min || row.input > row.decimal.max)) {
            alert(row.label + '只能输入' + row.decimal.min + '-' + row.decimal.max + '之间的整数');
            break;
            return false;
        }
        if (row.hasOwnProperty("string") && (row.input < row.string.min || row.input > row.string.max)) {
            alert(row.label + '的字符长度只能在' + row.string.min + '-' + row.string.max + '之间');
            break;
            return false;
        }
    }
    return infoData;
}
var jsonInfo = {
    "field1": { "label": "字段1", "require": true, "integer": { "min": 0, "max": 255 } },
    "field2": { "label": "字段2", "decimal": { "min": 0, "max": 255 } },
    "field3": { "label": "字段3", "string": { "min": 4, "max": 255 } }
};