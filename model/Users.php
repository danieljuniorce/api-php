<?php
namespace Models;
use \Core\Connect;

class Users extends Connect
{
  public function selectUsers()
  {
    return $this->select('users');
  }
}

?>
