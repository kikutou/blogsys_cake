<?php
/**
 * Created by PhpStorm.
 * User: luguangyun
 * Date: 16/08/04
 * Time: 19:21
 */
class CommentsController extends AppController
{
    public $uses = array('User','Essay','Comment');


/*    public function comm()
    {
        $errorMsg = null;
        //在session中保存essay_id
        $essay_id = $this->request->query['essay_id'];

        if(!$essay_id)
        {
            $this->redirect('/essays/mypage');
        }

        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
                )
            )
        );

        $comments = $this->Comment->find(
            'all',
            array(
                'conditions'=>array(
                    'Comment.essay_id'=>$essay_id
                ),
            )
        );


        foreach ($comments as &$comment){

            $commentContent = &$comment['Comment'];
            $user_id = $commentContent['user_id'];
            $user = $this->User->find(
                'first',
                array(
                    'conditions' => array(
                        'id' => $user_id,
                    )
                )
            );

            $user_name = $user['User']['name'];

            $commentContent['user_name'] = $user_name;

        }

        print '<pre>';
        print_r($comments);
        print '</pre>';
        exit();

        $this->set('result',$essay);
        $this->set('comments',$comments);

    }*/

    public function comm()
    {
        $errorMsg = null;
        //在session中保存essay_id
        $essay_id = $this->request->query['essay_id'];

        if(!$essay_id)
        {
            $this->redirect('/essays/mypage');
        }

        $essay = $this->Essay->find(
            'first',
            array(
                'conditions'=>array(
                    'Essay.id'=>$essay_id
                )
            )
        );

        $comments = $this->Comment->find(
            'all',
            array(
                'conditions'=>array(
                    'Comment.essay_id'=>$essay_id
                ),
            )
        );

        $this->set('result',$essay);
        $this->set('comments',$comments);

    }



    public function addcomm()
    {
        $essay_id = $this->request->query['id'];
        $errorMsg = null;
        if($this->request->ispost())
        {
            $result = $this->Comment->save($this->data);
            if($result)
            {
                $this->redirect('comm?id='.$essay_id);
            }
            else
                {
                    $errorMsg = 'データベースに保存できませんでした。';
                }
        }
        $this->set('errorMsg',$errorMsg);
        $this->set('user_id',$this->Auth->user('id'));
        $this->set('essay_id',$essay_id);

    }






}


?>