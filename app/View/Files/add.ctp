<?php
    echo $this->Form->create(false,array('type'=>'post'));

    echo $this->Form->label('File.date','日付');
    echo $this->Form->text('File.date');

    echo $this->Form->label('File.object','タイトル');
    echo $this->Form->text('File.object');

    echo $this->Form->label('File.content','コンテンツ');
    echo $this->Form->text('File.content');


?>
