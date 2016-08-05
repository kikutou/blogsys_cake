<?php
/**
 * Created by PhpStorm.
 * User: luguangyun
 * Date: 16/08/04
 * Time: 19:58
 * 添加评论
 */
    echo "$errorMsg";
    echo $this->Form->create(false,array('type'=>'post'));
    echo $this->Form->text(
        'Comment.essay_id',
        array(
            'type' => 'hidden',
            'value' => $essay_id
        )
    );

    echo $this->Form->text(
        'Comment.user_id',
        array(
            'type' => 'hidden',
            'value' => $user_id
        )
    );

    echo $this->Form->label('Comment.date','日付');
    echo $this->Form->text(
        'Comment.date',
        array(
            'value' => date('Y-m-d')
        )
    );

    echo $this->Form->label('Comment.comment','评论');
    echo $this->Form->text('Comment.comment');


    echo $this->Form->submit('確認');
    echo $this->Form->end();

?>
 <input type = 'button' onclick = "history.go(-1)" value = 'キャンセル'>

