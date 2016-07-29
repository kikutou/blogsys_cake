<?php
class UsersController extends AppController
{
    //$componentsの配列に 'Session' を追加
    public $components = array('Paginator', 'Session');

    public function login()
    {
        $errorMsg=null;
        if($this->request->ispost())
        {
            $result = $this->User->login($this->data);
            if($result)
            {
                $user_id = $this->request->data['User']['id'];
                exit(var_dump($user_id));

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
