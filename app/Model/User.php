<?php
class User extends AppModel{
  public $validate =array(
    'name' => array('rule' =>array('between',1,30),'message'=>'１−３０文字以内で入力してください。'),
    'password' =>array('rule'=>array('between',1,6),'message'=>'１−6文字以内で入力してください。')
  );

}




?>
