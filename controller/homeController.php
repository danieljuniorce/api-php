<?php
  namespace Controllers;
  use \Models\Users;
  use \Core\JWT;
  class homeController
  {
    public function index()
    {
      $jwt = new JWT();

      $connect = new Users();
      $connect
        ->updateOfId('users', '1', array(
          "email" => "dada"
        ));
    }
    public function selecionar($id)
    {
      $connect = new Users();
      echo $connect->selectUserOfId($id);
    }
  }

?>
