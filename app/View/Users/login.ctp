<?php
  if($this->Session->check('Message.auth'))
    echo $this->Session->flash('auth');

//  if($errorMsg){
//    echo $this->Html->para('errorMsg',$errorMsg);
//  }

  echo $this->Form->create(false,array('type'=>'post','action'=>'mypage'));

  echo $this->Form->label('User.name','名前');
  echo $this->Form->text('User.name');

  echo $this->Form->label('User.password','パスワード');
  echo $this->Form->password('User.password');

  echo $this->Form->submit('登録');

  echo $this->Form->end();

?>

<input type ="button" value="新規" onclick="location.href='signup'">

