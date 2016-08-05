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


    public function comm()
    {
        $errorMsg = null;
        //在session中保存essay_id
        $this->Session->write('essay_id',$this->request->query['id']);
        $essay_id = $this->Session->read('essay_id');
        if(!$essay_id)
        {
            $errorMsg = "文章を選んでください。";
            $this->set('errorMsg',$errorMsg);
        }
        else
        {
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

        $comments = $this->Comment->find(
            'all',
            array(
                'conditions'=>array(
                    'Comment.essay_id'=>$essay_id
                ),
            )
        );
        print '<pre>';
        print_r($comments);
        print '</pre>';
        exit();
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