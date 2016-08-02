<?php

class EssaysController extends AppController
{

    public $uses = array('User','Essay');
    public $components = array('Auth');




    public function beforeFilter()
    {
        $this->Auth->allow('index');
    }



    public function index()
    {
        $essays = $this->Essay->find('all');
        $this->set('essays',$essays);

        $user_id = $this->Session->read('userId');

        if($user_id)
        {
            $this->set('user','$user_id');
        }

    }



    public function mypage()
    {
        //判断是否登录
//        $user_id = $this->Session->read('userId');
//        if(!$user_id){
//            $this->redirect('/users/login');
//        }

        $essays = $this->Essay->find(
            'all',
            array(
                'conditions'=>array(
                    'Essay.user_id'=>$user_id
                )
            )
        );

        $user = $this->User->find(
            'first',
            array(
                'conditions'=>array(
                    'User.id'=>$user_id
                )
            )
        );
            $this->set('user',$user);
            $this->set('essays',$essays);
    }



    public function add()
    {
        //判断是否登录
//        $user_id = $this->Session->read('userId');
//        if(!$user_id){
//            $this->redirect('/users/login');
//        }

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
        $this->set('user_id',$user_id);

        $this->set('errorMsg', $errorMsg);
    }



    public function delete()
    {
        //判断是否登录
//        $user_id = $this->Session->read('userId');
//        if(!$user_id)
//        {
//            $this->redirect('/users/login');
//        }

        $errorMsg = null;
        $essay_id = $this->request->query['id'];
        //确定数据库中是否存在本文件
        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
                )
            )
        );
        //文件存在，取文件信息set到前台
        if($essay){
            $this->set('result',$essay);
        }


        if ($this->request->ispost())
        {
            $essay_id = $this->request->data['Essay']['id'];
            $result = $this->Essay->delete($essay_id);
            if ($result)
            {
                $this->redirect('mypage');
            }
            else
            {
                $errorMsg = 'データベースに削除できませんでした。';
            }
        }
        $this->set('errorMsg', $errorMsg);


    }


    public function edit()
    {
        //判断是否登录
//        $user_id = $this->Session->read('userId');
//        if(!$user_id)
//        {
//            $this->redirect('/users/login');
//        }

        $errorMsg = null;
        $essay_id = $this->request->query['id'];
        //确定数据库中是否存在本文件
        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
                )
            )
        );
        //文件存在，取文件信息set到前台
        if($essay){
            $this->set('result',$essay);
        }
        //判定前台表单传值方式为post，有id字段，数据更新。
        if ($this->request->ispost())
        {
            $result = $this->Essay->save($this->data);
            if ($result)
            {
                $this->redirect('mypage');
            }
            else
            {
                $errorMsg = 'データベースに更新できませんでした。';
            }
        }
        $this->set('errorMsg', $errorMsg);
    }




    public function contents()
    {
        //判断是否登录
//        $user_id = $this->Session->read('userId');
//        if(!$user_id)
//        {
//            $this->redirect('/users/login');
//        }

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
