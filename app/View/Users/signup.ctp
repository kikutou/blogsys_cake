<?php
  if($errorMsg){
    echo $this->Html->para('errorMsg',$errorMsg);
  }
  echo $this->Form->create(false,array('type'=>'post'));
  echo $this->Form->label('User.name','名前');
  echo $this->Form->text('User.name');
  echo $this->Form->error('User.name');

  echo $this->Form->label('User.password','パスワード');
  echo $this->Form->password('User.password');
  echo $this->Form->error('User.password');

  echo $this->Form->submit('signup');

  echo $this->Form->end();


?>
