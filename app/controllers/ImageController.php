<?php

class ImageController extends \Phalcon\Mvc\Controller
{
    private $result;
    public function initialize(){
        $this->result = [
            "code" => "500",
            "message"=>"服务器内部错误",
            "data"=>[]
        ];
    }
    public function indexAction()
    {
        echo "Hello World";
    }

    //上传并缩放长或高最大500;
    //是正方行图片就直接缩放至500X500并预览
    //否则将宽度限制在500,由用户自己裁剪
    public function uploadAction(){
        $acceptType=["png"=>"image/png","jpg"=>"image/jpeg"];
        if ($this->request->hasFiles()) {
                $file=$this->request->getUploadedFiles();
                $file=$file[0];
                $this->result['data']['filename']=$file->getName();
                $this->result['data']['tempname']=$file->getTempName();  
                $this->result['data']['filesize']=$file->getSize();
                $this->result['data']['filetype']=$file->getType();
                $this->result['data']['errorcode']=$file->getError();
                $this->result['data']['ctrlname']=$file->getKey();
                //文件后缀名
                $this->result['data']['extension']=$file->getExtension();
                $this->result['data']['savepath']=UPLOAD_PATH.$file->getName();

                //判断上传的文件类型
                $check=false;
                foreach($acceptType as $key=>$row){
                    if($this->result['data']['extension']==$key&&$this->result['data']['filetype']==$row){
                        $check=true;
                        break;
                    }
                }
                if(!$check){
                    $this->result['message']="上传文件类型错误，只支持jpg和png格式的图片";
                    $this->result['code']="900";
                    return json_decode($this->result);
                }
                $func="imagecreatefromjpeg";
                if($this->result['data']['extension']=='png') $func="imagecreatefrompng";
                list($srcWidth,$srcHeight)=getimagesize($this->result['data']['tempname']);
                $dstWidth=500;
                $dstHeight=floor($dstWidth/$srcWidth*$srcHeight);
                $target=imagecreatetruecolor($dstWidth,$dstHeight);
                $source = $func($this->result['data']['tempname']);
                imagecopyresampled($target,$source,0,0,0,0,$dstWidth,$dstHeight, $srcWidth, $srcHeight);
                $this->result['data']['width']=$dstWidth;
                $this->result['data']['height']=$dstHeight;
                $func=str_replace('createfrom','',$func);
                $func($target,$this->result['data']['savepath']);
                imagedestroy($target);
                //将原图复制到新建图片中
                //imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
                // 移动到指定目录
                //$file->moveTo($this->result['data']['savepath']);
        }
        if(count($this->result['data'])>0){
                $this->result['code']=200;
                $this->result['message']='成功';
        }
        return json_encode($this->result);
    }


     //图片裁切
    public function CutAction(){
        $postData=$this->request->getPost();
        if(!empty($postData['path'])){
            $this->result['code']=200;
            $filePath=realpath(UPLOAD_PATH.$postData['path']);
            $fileType=exif_imagetype($filePath);
            if($fileType!=IMAGETYPE_PNG&&$fileType!=IMAGETYPE_JPEG){
                $this->result['message']="上传文件类型错误，只支持jpg和png格式的图片";
                $this->result['code']="900";
                return json_encode($this->result);
            }
            $func="imagecreatefromjpeg";
            if($fileType==IMAGETYPE_PNG) $func="imagecreatefrompng";
            $source = $func($filePath);
            //获取图片大小
            list($srcWidth,$srcHeight) = getimagesize($filePath);
            $target = imagecreatetruecolor($postData['w'],$postData['h']);
            imagecopyresampled($target,$source,0,0,$postData['x'],$postData['y'],$postData['w'],$postData['h'],$postData['w'],$postData['h']);
            $nowString=date('Ymd');
            $randNum=mt_rand(1000,9999);
            $imgName=$nowString.$randNum.'.jpg';
            imagejpeg($target, UPLOAD_PATH.$imgName);
            imagedestroy($target);
            imagedestroy($source);
            $this->result['data']['imgname']=$imgName;
        }
        return json_encode($this->result);
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

