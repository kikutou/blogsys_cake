<?php

class EssaysController extends AppController
{

    public $uses = array('User','Essay','Comment');
    //public $layout = false;
    public function beforeFilter()
    {
        $this->Auth->allow('index');
        //$this->Auth->allow('ajax_mypage');
        $this->Auth->allow('ajax_index');
    }



    /*
     * function ajax_index()の詳細設計書：
     *
     * １、$this->autoRender = false 設定
     * ２、ajax請求かとか確認
     *      if($this->request->is('ajax')){
     *          UserModel,EssayModelから$users arrayを作ります;fields:User.id,User.name,essay_num
     *
     *          (1)UserModelから$users arrayのUser.idとUser.name fieldsを検索する。
     *              conditions:User.delete_flog = 0;
     *              fields:User.id,User.name;
     *          (2)foreach ($users as &$user),
     *              $userInfo = &$user['User'];
     *              $userInfoに$essays_num　fieldsを追加する。$userInfo['essay_num'] = $essays_num
     *                  $essays_num = $this->Essay->find(
                            'count',
                            array(
                                'conditions' => array(
                                'Essay.user_id' => $user_id,
                                'Essay.delete_flag' => 0,
                                )
                        );
                ruturn json_encode($users);
            }
     *      else {
     *          return errorMsg
     *      }
     *
     * */



    public function ajax_index()
    {
        $this->autoRender = false;
        if($this->request->is('ajax'))
        {
            //通过userModel查找userid与username
            $users = $this->User->find(
                'all',
                array(
                    'conditions' => array(
                        'User.delete_flag' => 0,
                    ),
                    'fields' => array(
                        'User.id',
                        'User.name'
                    ),
                )
            );
            //数组中添加元素
            //$essays_arr = array();
            //$essays_arr[] = $essays_num;
            //向数组$userInfo,添加$userInfo['essay_num'] = $essays_num元素.
            foreach ($users as &$user){
                $userInfo = &$user['User'];
                $user_id = $user['User']['id'];
                //相同user的文章数.
                $essays_num = $this->Essay->find(
                    'count',
                    array(
                        'conditions' => array(
                            'Essay.user_id' => $user_id,
                            'Essay.delete_flag' => 0,
                        )
                    )
                );
                $userInfo['essay_num'] = $essays_num;
            }
            return json_encode($users);
        }
    }


    public function index()
    {
        //查找userid,username,与userde文章数.
        /*$sql = "SELECT users.id, users.name, COUNT(essays.id) AS count
                FROM users, essays WHERE users.id=essays.user_id AND users.delete_flag=0 AND                     essays.delete_flag=0 GROUP BY users.id;";
        $return = $this->User->query($sql);*/

        $essays = $this->Essay->find(
            'all',
            array(
                'conditions'=>array(
                    'Essay.delete_flag'=>'0'
                )
            )
        );
        $this->set('essays',$essays);
        if($this->Auth->user('id'))
        {
            $this->set('user','$this->Auth->user(\'id\')');
        }
    }





    public function ajax_mypage()
    {
        $this->autoRender = false;
        if($this->request->is('ajax'))
        {
            $essays = $this->Essay->find(
                'all',
                array(
                    'conditions' => array(
                        'Essay.user_id' => $this->Auth->user('id'),
                        'Essay.delete_flag' => '0'
                    ),
                    'fields' => array(
                        'Essay.id',
                        'Essay.title'
                    )
                )
            );
            foreach ($essays as &$essay){
                $essayInfo = &$essay['Essay'];
                $essay_id = $essay['Essay']['id'];

                //相同user的文章数.
                $comment_num = $this->Comment->find(
                    'count',
                    array(
                        'conditions' => array(
                            'Comment.essay_id' => $essay_id,
                            'Comment.delete_flag' => '0',
                        )
                    )
                );
                $essayInfo['comment_num'] = $comment_num;
            }
            return json_encode($essays);
        }
    }


    public function mypage()
    {
        $essays = $this->Essay->find(
            'all',
            array(
                'conditions'=>array(
                    'Essay.user_id'=>$this->Auth->user('id'),
                    'Essay.delete_flag'=>'0'
                )
            )
        );
        $user = $this->User->find(
            'first',
            array(
                'conditions'=>array(
                    'User.id'=>$this->Auth->user('id'),
                    'User.delete_flag'=>'0'
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


    public function ajax_delete()
    {
        $this->autoRender = false;
/*      与else作用一样
        $ajax_response = array(
            'response_code' => 2,
            'message' => '失敗しました。'
        );*/

        if($this->request->is('ajax')) {
            $essay_id = $this->data['id'];

            $this->Essay->id = $essay_id;
            $result = $this->Essay->saveField('delete_flag','1');

            if ($result)
            {
                $ajax_response['response_code'] = 1;
                $ajax_response['message'] = '削除は成功しました。';
            }else{
                $ajax_response['response_code'] = 4;
                $ajax_response['message'] = 'DBにエラーが発生しました。';
            }
        }else{
            $ajax_response['response_code'] = 3;
            $ajax_response['message'] = 'ajaxの形式ではありません。';
        }

        return json_encode($ajax_response);

    }


/*    public function delete()
    {
        $errorMsg = null;
        $essay_id = $this->request->query['id'];
        //确定数据库中是否存在本文件
        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id,
                    'Essay.delete_flag'=>'0'
                )
            )
        );
        //文件存在，取文件信息set到前台
        if($essay){
            $this->set('result',$essay);
        }
        $this->Essay->id = $this->request->data['Essay']['id'];
        $this->Essay->id = $delete_data['id'];
        $essay_id = $this->request->data['Essay']['id'];
        $result = $this->Essay->saveField('delete_flag','1');
        if (isset($result))
            {
                $this->redirect('mypage');
            }
        else
            {
                $errorMsg = 'データベースに削除できませんでした。';
            }
        $this->set('errorMsg', $errorMsg);
    }*/


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
                        'Essay.id'=>$essay_id,
                        'Essay.delete_flag'=>'0'
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
                        'Essay.id'=>$essay_id,
                        'Essay.delete_flag'=>'0'
                    )
                )
            );
            $this->set('result',$essay);
        }
    }


}

?>
