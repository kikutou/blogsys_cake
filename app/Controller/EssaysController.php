<?php

class EssaysController extends AppController
{

    public $use = array('User','Essay');

    public function index()
    {
        $essays = $this->Essay->find('all');
        $this->set('essays',$essays);
    }


    public function mypage()
    {
        $user_id = $this->Session->read('userId');

        $essays = $this->Essay->find(
            'all',
            array(
                'conditions'=>array(
                'Essay.user_id'=>$user_id
                )
            )
        );
        
        $this->set('essays',$essays);
    }


    public function add()
    {
        $errorMsg = null;
        if ($this->request->ispost())
        {
            $result = $this->Essay->save($this->data);
            if ($result)
            {
                $this->redirect('mypage');
            }
            else
            {
                $errorMsg = 'データベースに保存できませんでした。';
            }
        }

        $this->set('errorMsg', $errorMsg);
    }




    public function contents()
    {
        $essay_id = $this->request->query['id'];

        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
                )
            )
        );

        if(!$essay){
            $this->redirect('index');
        }

        $this->set('result',$essay);
    }



    public function edit()
    {
        $essay_id = $this->request->query['id'];

        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
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
