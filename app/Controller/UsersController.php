<?php
class UsersController extends AppController
{

    public function login()
    {
        $errorMsg=null;
        //删除已有session
        $from = $this->request->query['from'];
        if($from && $from == 'logout')
        {
            $this->Session->destroy();
        }


        if($this->request->ispost())
        {
            $result = $this->User->login($this->data);
            if($result)
            {
                $user_id = $result['User']['id'];

                $this -> Session-> write('userId', $user_id);

                $this->redirect('/essays/mypage');
            }
            else
            {
                $errorMsg = 'ユーザーが存在しません。';
            }
        }
        $this->set('errorMsg',$errorMsg);
    }



    public function signup()
    {
        $errorMsg = null;
        if ($this->request->ispost())
        {
            $result = $this->User->save($this->data);
            if ($result)
            {
                $user= $this->User->find(
                    'first',
                    array(
                        'conditions'=>array(
                            'User.name'=>$this->request->data['User']['name']
                        )
                    )
                );

                $user_id = $user['User']['id'];

                $this->Session->write('userId', $user_id);

                $this->redirect('/essays/mypage');
            }
            else
            {
                $errorMsg = 'データベースに保存できませんでした。';
            }
        }

        $this->set('errorMsg', $errorMsg);
    }


}
?>
