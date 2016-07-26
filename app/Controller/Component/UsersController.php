<?php
/**
 *
 */
class UsersController extends AppController
{
  public $name = "Users";
  public $uses = "User";
  public $autoRender = true;

  public function login()
  {
    App::uses("Sanitize","Utility");
    $name = $this->request->date("name");
    $password = $this->request->date("password");



  }
}


?>
