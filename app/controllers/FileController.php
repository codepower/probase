<?php

class FileController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        echo "Hello World";
    }

    //上传并缩放长或宽最大500;
    //是正方行图片就直接缩放至500X500并预览
    //否则将宽度限制在500,由用户自己裁剪
    public function uploadAction(){
        $result=[
            'code'=>500,
            'message'=>'失败',
            'data'=>[]
        ];
        if ($this->request->hasFiles() == true) {
            $fileList=$this->request->getUploadedFiles();
            foreach ($fileList as $file) {
                // dump($file);
                /*
                object(Phalcon\Http\Request\File)#41 (8) {
                  ["_name":protected]=>
                  string(44) "test.jpg"
                  ["_tmp":protected]=>
                  string(21) "C:\Windows\php6B7.tmp"
                  ["_size":protected]=>
                  int(78029)
                  ["_type":protected]=>
                  string(10) "image/jpeg"
                  ["_realType":protected]=>
                  NULL
                  ["_error":protected]=>
                  int(0)
                  ["_key":protected]=>
                  string(5) "photo"
                  ["_extension":protected]=>
                  string(3) "jpg"
                }
                */
                $result['data']['filename']=$file->getName();
                $result['data']['tempname']=$file->getTempName();  
                $result['data']['filesize']=$file->getSize();
                $result['data']['filetype']=$file->getType();
                $result['data']['errorcode']=$file->getError();
                $result['data']['ctrlname']=$file->getKey();
                $result['data']['extension']=$file->getExtension();
                $result['data']['savepath']=UPLOAD_PATH.$file->getName();
                // 移动到指定目录
                $file->moveTo(UPLOAD_PATH.$file->getName());
                echo $file->_name;exit;
            }
        }
        if(count($result['data'])){
                $result['code']=200;
                $result['message']='成功';
        }
        return json_encode($result);
    }

     //图片裁切
    public function CutAction(){
        $result=[
            'code'=>500,
            'message'=>'失败',
            'data'=>[]
        ];
        $postData=$this->request->getPost();
        if(!empty($postData['path'])){
            $result['code']=200;
            $filePath=realpath(UPLOAD_PATH.$postData['path']);
            $source = imagecreatefromjpeg($filePath);
            //获取图片大小
            $srcWidth=1;
            $srcHeight=1;
            list($srcWidth,$srcHeight) = getimagesize($filePath);
            $ratio=$srcWidth/$srcHeight;
            $resizeWidth=500;
            $resizeHeight=500;
            if($ratio>1){
                $resizeHeight=$resizeWidth*$ratio;
            }else{
                $resizeWidth=$resizeHeight/$ratio;
            }
            $result['data']['resizeWidth']=$resizeWidth;
            $result['data']['resizeHeight']=$resizeHeight;
            $target = imagecreatetruecolor($postData['w'],$postData['h']);
            imagecopyresampled($target,$source,0,0,$postData['x'],$postData['y'],$postData['w'],$postData['h'],$resizeWidth,$resizeHeight);
            $nowString=date('Ymd');
            $randNum=mt_rand(1000,9999);
            $imgName=$nowString.$randNum.'.jpg';
            imagejpeg($target, UPLOAD_PATH.$imgName);
            imagedestroy($target);
            imagedestroy($source);
            $result['data']['imgname']=$imgName;
        }
        return json_encode($result);
    }

    //图片压缩
    public function CompressAction(){

    }

    //文件打包成zip格式
    public function ZipAction(){

    }

    //数据导出成excel文件
    public function ExcelAction(){

    }

    //生成qrcode
    public function QrcodeAction(){

    }

    //生成图片验证码
    public function CaptchaAction(){
        
    } 
}

