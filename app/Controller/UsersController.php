<?php
class UsersController extends AppController
{


    public function beforeFilter()
    {
        $this->Auth->allow('login');
        $this->Auth->allow('signup');
    }



    //①signupを用意する。
    public function signup()
    {
        if ($this->request->ispost())
        {
            $result = $this->User->save($this->data);
            if($result)
            {
                //保存したデータで登録する。
                $this->Auth->login();
                //$this->redirect(array('action'=>'login'));
                $this->redirect('/essays/mypage');
            }
            else
            {
                $errorMsg = 'データベースに保存できませんでした。';
            }
            $this->set('errorMsg', $errorMsg);
        }
    }




    //②loginを用意する。
    public function login()
    {
        if($this->request->ispost())
        {
            if($this->Auth->login())
            {
                //登录后跳到先前访问页面
                $this->redirect($this->Auth->redirect());
                //登录后跳到mypage页
                //$this->redirect('/essays/mypage');
            }
            else
            {
                $this->Session->setFlash('ユーザー名かパスワードが違います。','default',array(),'auth');
            }
        }
    }




    //③logoutを用意する。
    public function logout()
    {
        $this->Auth->logout();
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



}
?>
