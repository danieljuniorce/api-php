<?php
namespace Models;
use \Core\Connect;

class Users extends Connect
{
  public function selectUsers()
  {
    return $this->selectAll('users');
  }
  public function selectUserOfId($id)
  {
    return $this->selectOfId('users', $id);
  }
  public function updateUserForId($id, $campos)
  {
    return $this->updateOfId('users', $id, $campos);
  }
  public function deleteUserForId($id)
  { 
    return $this->deleteOfId('users', $id);
  }
}

?>
