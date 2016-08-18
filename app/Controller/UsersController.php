<?php
class UsersController extends AppController
{


    public function beforeFilter()
    {
        $this->Auth->allow('login');
        $this->Auth->allow('signup');
        $this->Auth->allow('testPassword');
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
                $user_delete_flag = $this->User->field(
                    'delete_flag',
                    array(
                        'name'=>$this->data['User']['name']
                    )
                );
                if($user_delete_flag != 0)
                {
                    $this->Session->setFlash(
                        'ユーザーがいません。',
                        'default',
                        array(),
                        'auth'
                    );
                }
                else
                    {
                        $this->Session->setFlash(
                            'ユーザー名かパスワードが違います。',
                            'default',array(),
                            'auth'
                        );
                    }
            }
        }
    }








    //③logoutを用意する。
    public function logout()
    {
        $this->Auth->logout();
    }


    public function testPassword(){

        //①passwordがから
        $this->data = array(
            'User' => array(
                'password' => null,
            )
        );

        $result = $this->User->save($this->data);

        print '<pre>';
        print 'passwordがなしの時の結果：';
        print_r($this->User->validationErrors['password']['0'] == '１−6文字以内で入力してください。');
        print '</pre>';



        //①passwordがから
        $this->data = array(
            'User' => array(
                'password' => '12345678',
            )
        );

        $result = $this->User->save($this->data);

        print '<pre>';
        print 'passwordが7位以上の時の結果：';
        print_r($this->User->validationErrors['password']['0'] == '１−6文字以内で入力してください。');
        print '</pre>';


        exit();


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
