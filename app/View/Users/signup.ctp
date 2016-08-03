<?php
//  if($errorMsg){
//    echo $this->Html->para('errorMsg',$errorMsg);
//  }

if($this->Session->check('Message.auth'))
  echo $this->Session->flash('auth');

  echo $this->Form->create('User', array('type'=>'post','url'=>'signup'));
  echo $this->Form->label('User.name','名前');
  echo $this->Form->text('User.name');
  echo $this->Form->error('User.name');

  echo $this->Form->label('User.nation','民族');
  echo $this->Form->text('User.nation');
  echo $this->Form->error('User.nation');

  echo $this->Form->label('User.blood','血液型');
  echo $this->Form->select(
      'User.blood',
      array(
          '0'=>'A',
          '1'=>'B',
          '2'=>'AB',
          '3'=>'0',
          '4'=>'HR'
      ),
      array(
          'empty'=>'血液型をせんたくしてください'
      )
  );
  echo $this->Form->error('User.blood');

  echo $this->Form->label('User.birthday','生年月日');

  echo $this->Form->year('User.birthday',1900, date('Y'),array('empty' => '----','required'=>''));
  echo $this->Form->month('User.birthday', array('monthNames' => false, 'empty' => '----','required'=>''));
  echo $this->Form->day('User.birthday', array('empty' => '----','required'=>''));
  echo $this->Form->error('User.birthday');

  echo $this->Form->label('User.hobby','興味');
  echo $this->Form->text('User.hobby');
  echo $this->Form->error('User.hobby');

  echo $this->Form->radio('User.gender',array('0'=> "男",'1' => "女"),array('legend'=>"性別選択"));
  echo $this->Form->error('User.gender');

  echo $this->Form->label('User.password','パスワード');
  echo $this->Form->password('User.password');
  echo $this->Form->error('User.password');

  echo $this->Form->label('User.passconfirm','パスワード確認');
  echo $this->Form->password('User.passconfirm');
  echo $this->Form->error('User.passconfirm');

  echo $this->Form->submit('サインアップ');

  echo $this->Form->end();


?>
