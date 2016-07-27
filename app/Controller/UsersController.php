<?php
  class UsersController extends AppController {

    public function login(){
      $errorMsg=null;

      if($this->request->ispost()){
        $name = $this->request->data['User']['name'];
        $password = $this->request->data['User']['password'];
        $user = $this->User->find('first',array('conditions'=>array('User.name'=>$name ,'User.password'=>$password)));
        // print '<pre>';
        // print_r($user);
        // print '</pre>';
        // exit();
        if($user){
          $this->redirect('/files/index');
        }
        else {
          $errorMsg = 'ユーザーが存在しません。';
        }
      }
      $this->set('errorMsg',$errorMsg);
    }






    public function signup(){
      $errorMsg=null;
      if($this->request->ispost()){

        $name = $this->request->data['User']['name'];
        $password = $this->resquest->data['User']['password'];
        $passconfirm = $this->resquest->data['User']['passconfirm'];


        if(empty($name)){
          $errorMsg = '名前を入力してください。';
        }
        else {
          $dname=$this->User->find('first',array('conditions'=>array('User.name'=>$name)));
          if($dname){
            $errorMsg = '名前が存在しました。';
          }#
        }


        if(empty($password)){
          $errorMsg = 'passwordを入力してください。';
        }


        if(empty($passconfirm)){
          $errorMsg = 'passconfirmを入力してください。';
        }


        if($password != $passconfirm){
          $errorMsg = 'passwordが間違いました。';
        }


        $user = $this->User->find('first',array('conditions'=>array('User.name'=>$name,'User.password'=>$password)));
        if($user){
          $errorMsg = 'ユーザーがいました。';
        }
        else{
          $result=$this->User->save($this->data);
          if($result){
            $this->redirect('/files/index');
          }
          else {
            $errorMsg = 'データベースに保存できませんでした。';
          }
       }
     }

     $this->set('errorMsg',$errorMsg);

}
?>
