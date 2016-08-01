<?php
  if($errorMsg){
    echo $this->Html->para('errorMsg',$errorMsg);
  }
  echo $this->Form->create(false,array('type'=>'post'));
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
          '3'=>'HR'
      ),
      array(
          'empty'=>'血液型をせんたくしてください'
      )
  );
  echo $this->Form->error('User.blood');

  echo $this->Form->label('User.birthday','日期');
  echo $this->Form->dateTime('User.birthday','YMD');
  echo $this->Form->error('User.birthday','YMD');

  echo $this->Form->label('User.hobby','興味');
  echo $this->Form->text('User.hobby');
  echo $this->Form->error('User.hobby');

  echo $this->Form->radio('User.gender',array('0'=> "男",'1' => "女"),array('legend'=>"性別選択"));
  echo $this->Form->error('User.sex');

  echo $this->Form->label('User.password','パスワード');
  echo $this->Form->password('User.password');
  echo $this->Form->error('User.password');

  echo $this->Form->label('User.passconfirm','パスワード確認');
  echo $this->Form->password('User.passconfirm');
  echo $this->Form->error('User.passconfirm');

  echo $this->Form->submit('サインアップ');

  echo $this->Form->end();


?>
