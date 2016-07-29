<?php
    echo $this->Form->create(false,array('type'=>'post'));

    echo $this->Form->label('Essay.date','日付');
    echo $this->Form->text('Essay.date');

    echo $this->Form->label('Essay.title','タイトル');
    echo $this->Form->text('Essay.title');

    echo $this->Form->label('Essay.content','コンテンツ');
    echo $this->Form->text('Essay.content');


?>
