<?php
  namespace Controllers;
  use \Models\Users;
  class homeController
  {
    public function index()
    {
      $connect = new Users();
      echo $connect->selectUsers();
    }
  }

?>
