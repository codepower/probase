<?php
class Utils{
    //生成时间戳加随机数的文件名
    static public function getDateRandomName(){
        $now=date('YmdHis');
        $randNum=mt_rand(1000,9999);
        return $now.$randNum;
    }

    //远程Get请求方法
    static public function curlGet($url,$data){
        $ch = curl_init();
        // get的变量
        $getData="";
        foreach($data as $key=>$value){
            if(!$getData){
                $getData.='&';
            }
            $getData.="$key=$value";
        }
        $url.="?".$getData;

        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        $output=json_decode($output,true);
        return $output;
    }

    //远程Post请求方法
    static public function curlPost($url,$data){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $output = curl_exec($ch);
        $output=json_decode($output,true);
        return $output;
    }

    //生成随机字符串
    static public function createRandomStr($length=16){
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符
        $strlen = 62;
            while($length > $strlen){
            $str .= $str;
            $strlen += 62;
        }
        $str = str_shuffle($str);
        return substr($str,0,$length);
    }

    //密码加密
    static public function encodePassword($words,$salt){
        $words=md5($salt.md5($words));
        return $words;
    }
    //手机号校验
    static public function checkMobile($mobile){
        $preg='/^1[34578]\d{9}$/';
        return $mobile&&strlen($mobile)>0&&preg_match($preg,$mobile);
    }

    //邮箱验证
    static public function checkEmail($email){
        $preg = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+/';
        return $email&&strlen($email)>0&&preg_match($preg,$email);
    }
    //验证字段
    static public function verifyField($formData){
        $msgList = [];
        foreach ($formData as $key => $row) {
            //必填判断
            if ($row['require']&&empty($row['input'])) {
                $msgList[]='请填写'.$row['label'];
            }
    
            //整数值范围判断
            if ($row['integer']&&($row['input'] < $row['integer']['min'] || $row['input']> $row['integer']['max'])) {
                $msgList[]=$row['label'].'只能输入'.$row['integer']['min'].'-'.$row['integer']['max'].'之间的整数';
            }
    
            //小数值范围判断
            if ($row['decimal']&& ($row['input']< $row['decimal']['min'] || $row['input'] > $row['decimal']['max'])) {
                $msgList[]=$row['label'].'只能输入'.$row['decimal']['min'].'-'.$row['decimal']['max'].'之间的整数';
            }
    
            $inputLength=strlen($row['input']);
            //字符长短判断
            if ($row['string'] && ($inputLength< $row['string']['min'] || $inputLength> $row['string']['max'])) {
                $msgList[]=$row['label'].'的字符长度只能在'.$row['string']['min'].'-'.$row['string']['max'].'之间';
            }
    
            //邮箱格式判断
            if (!self::checkEmail($row['input'])) {
                $msgList[]=$row['label'].'必须是邮箱格式，请填写正确的邮箱格式';
            }
    
            //手机号格式判断
            if (!self::checkMobile($row['input'])) {
                $msgList[]=$row['label'].'必须是手机号格式，请填写正确的手机号格式';
            }
        }
        return $msgList;
    }

}