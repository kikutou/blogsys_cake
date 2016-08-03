<?php
    //添加文件不成功时返回de错误信息。
    echo "$errorMsg";

    echo $this->Form->create(false,array('type'=>'post'));
    echo $this->Form->text(
        'Essay.user_id',
        array(
            'type'=>'hidden',
            'value'=>$user_id
        )
    );

    echo $this->Form->label('Essay.date','日付');
    echo $this->Form->text('Essay.date',array('value'=>date("Y-m-d")));


    echo $this->Form->label('Essay.title','タイトル');
    echo $this->Form->text('Essay.title');
    echo $this->Form->error('Essay.title');

    echo $this->Form->label('Essay.content','コンテンツ');
    echo $this->Form->text('Essay.content');
    echo $this->Form->error('Essay.content');

    echo $this->Form->submit('確認');

    echo $this->Form->end();

?>
<input type = "button" onclick = "history.go(-1)" value = "キャンセル">
