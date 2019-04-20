<?php
  namespace Controllers;
  use \Models\Users;
  use \Core\JWT;
  class homeController
  {
    public function index()
    {
      $jwt = new JWT();

      echo $jwt->validateJWT(
        $jwt->create(
          array(
            'id_user' => 12,
            'name_user' => 'Daniel Souza'
          )
      ));
      $connect = new Users();
      $connect->selectUsers();
    }
    public function selecionar($id)
    {
      $connect = new Users();
      echo $connect->selectUserOfId($id);
    }
  }

?>
