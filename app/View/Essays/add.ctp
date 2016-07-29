<?php
    echo $this->Form->create(false,array('type'=>'post'));

    //echo $this->Form->label('Essay.user_id','ユーザーID');
    echo $this->Form->text(
        'Essay.user_id',
        array(
            'type'=>'hidden',
            'value'=>$this->Session->read('userId')
        )
    );

    echo $this->Form->label('Essay.date','日付');
    echo $this->Form->text('Essay.date',array('value'=>date("Y-m-d")));

    echo $this->Form->label('Essay.title','タイトル');
    echo $this->Form->text('Essay.title');

    echo $this->Form->label('Essay.content','コンテンツ');
    echo $this->Form->text('Essay.content');

    echo $this->Form->submit('確認');

    echo $this->Form->end();
?>
