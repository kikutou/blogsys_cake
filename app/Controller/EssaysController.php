<?php

class EssaysController extends AppController
{

    public $uses = array('User','Essay');

    public function beforeFilter()
    {
       $this->Auth->allow('index');
    }



    public function index()
    {
        $essays = $this->Essay->find('all');
        $this->set('essays',$essays);

        if($this->Auth->user('id'))
        {
            $this->set('user','$this->Auth->user(\'id\')');
        }
    }



    public function mypage()
    {
        $essays = $this->Essay->find(
            'all',
            array(
                'conditions'=>array(
                    'Essay.user_id'=>$this->Auth->user('id')
                )
            )
        );

        $user = $this->User->find(
            'first',
            array(
                'conditions'=>array(
                    'User.id'=>$this->Auth->user('id')
                )
            )
        );
            $this->set('user',$user);
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
        $this->set('user_id',$this->Auth->user('id'));
        $this->set('errorMsg', $errorMsg);
    }



    public function delete()
    {
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
            if (isset($result))
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
        $errorMsg = null;
        if(!isset($this->request->query['id']))
        {
            $errorMsg = '文章を選んでください。';
        }
        else
        {
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
            if($essay && $this->Auth->user('id') == $essay['Essay']['user_id'])
            {
                $this->set('result',$essay);
            }
            else
            {
                $errorMsg = "文章を選んでください。";
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
                    $errorMsg = "データベースに保存失敗しました。";
                }
            }
        }
        $this->set('errorMsg',$errorMsg);
    }




    public function contents()
    {
        $errorMsg = null;
        if(!isset($this->request->query['id']))
        {
            $errorMsg = "文章を選んでください。";
            $this->set('errorMsg',$errorMsg);
        }
        else
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
            $this->set('result',$essay);
        }
    }


}

?>
