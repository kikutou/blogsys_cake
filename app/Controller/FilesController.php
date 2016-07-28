<?php

class FilesController extends AppController
{
    public $name = 'Files';
    public $user = array('User','File');

    public function index()
    {
        $result = $this->File->find("all");
        $this->set('result',$result);
    }


    public function mypage()
    {

    }


    public function contents()
    {
        if($this->request->isget())
        {
            $file_id = $this->request->query['id'];
            $result = $this->File->find(
                'first',
                array(
                    'conditions'=>array(
                        'File.id'=>$file_id
                    )
                )
            );
            $this->set('result',$result);
        }
    }


    //跳转页面的相对路径
    public function localhost()
    {
        FilesController::localhost();
    }


}

?>
