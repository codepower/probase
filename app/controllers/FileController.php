<?php

class FileController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        echo "Hello World";
    }

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

    }

    //图片压缩
    public function CompressAction(){

    }

    //文件打包成zip格式
    public function ZipAction(){

    }

    //数据导出成excel文件
    public function excelAction(){

    }
}

