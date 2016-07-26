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
          $this->redirect('index');
        }
        else {
          $errorMsg = 'ユーザーが存在しません。';
        }
      }
      $this->set('errorMsg',$errorMsg);
    }




    public function index() {

	  }




    public function signup(){
      $errorMsg=null;
      if($this->request->ispost()){
        $result=$this->User->save($this->data);
        if($result) {
          $this->redirect('index');
        }else {
          $errorMsg = 'データベースに保存できませんでした。';
       }
     }
     $this->set('errorMsg',$errorMsg);
   }

}

?>
