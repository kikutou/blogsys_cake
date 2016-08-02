<?php
class UsersController extends AppController
{

    public $components = array('Auth');



    public function beforeFilter()
    {
        $this->Auth->allow('login');
        $this->Auth->allow('signup');
    }




//    public function login()
//    {
//        $errorMsg=null;
//        //删除已有session
//        if(isset($this->request->query['from'])){
//            $from = $this->request->query['from'];
//            if($from == 'logout')
//            {
//                $this->Session->destroy();
//            }
//        }
//
//
//        if($this->request->ispost())
//        {
//            $result = $this->User->login($this->data);
//            if($result)
//            {
//                $user_id = $result['User']['id'];
//
//                $this -> Session-> write('userId', $user_id);
//
//                $this->redirect('/essays/mypage');
//            }
//            else
//            {
//                $errorMsg = 'ユーザーが存在しません。';
//            }
//        }
//        $this->set('errorMsg',$errorMsg);
//    }




    public function login()
    {
        if($this->request->ispost())
        {
            if($this->Auth->login())
            {
                $this->redirect($this->Auth->redirect());
            }
            else
            {
                $this->Session->setFlash('ユーザー名かパスワードが違います。','default',array(),'auth');
            }
        }
    }



    public function signup()
    {
        if ($this->request->ispost())
        {
            if($this->data)
            {
                $this->User->create();
                $this->User->save($this->data);
                $this->redirect(array('action'=>'mypage'));
            }
        }
    }








//    public function signup()
//    {
//        $errorMsg = null;
//        if ($this->request->ispost())
//        {
//            $result = $this->User->save($this->data);
//            if ($result)
//            {
//                $user= $this->User->find(
//                    'first',
//                    array(
//                        'conditions'=>array(
//                            'User.name'=>$this->request->data['User']['name']
//                        )
//                    )
//                );
//
//                $user_id = $user['User']['id'];
//
//                $this->Session->write('userId', $user_id);
//
//                $this->redirect('/essays/mypage');
//            }
//            else
//            {
//                $errorMsg = 'データベースに保存できませんでした。';
//            }
//        }
//
//        $this->set('errorMsg', $errorMsg);
//    }


}
?>
