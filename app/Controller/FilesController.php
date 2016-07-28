<?php

class FilesController extends AppController
{

    public $use = array('User','File');

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
        $file_id = $this->request->query['id'];

        $essay = $this->File->find(
            'first',
            array(
                'conditions'=>array(
                    'File.id'=>$file_id
                )
            )
        );

        if(!$essay){
            $this->redirect('index');
        }

        $this->set('result',$essay);
    }


}

?>
