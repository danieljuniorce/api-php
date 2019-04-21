<?php
  namespace Controllers;
  use \Models\Users;
  use \Core\JWT;
  class homeController
  {
    public function index()
    {
      $connect = new Users();
      $connect
        ->create('users', array(
          "email" => "danieljuniorssce@hotmail.com",

        ));
    }

    public function selecionar($id)
    {
      $connect = new Users();
      echo $connect->selectUserOfId($id);
    }
  }

?>
