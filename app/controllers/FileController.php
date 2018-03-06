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

    //图片压缩
    public function CompressAction(){

    }

    //文件打包成zip格式
    public function ZipAction(){

    }

    //数据导出成excel文件
    public function ExcelAction(){

    }

}

