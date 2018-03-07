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

    //验证字段
    static public function verify(){

    }
}