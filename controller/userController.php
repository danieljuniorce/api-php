<?php
  namespace Controllers;
  use \Models\Users;
  use \Core\JWT;
  class userController
  {
    private $users;
    public function __construct()
    {
      $this->users = new Users();
    }
    public function index()
    {
      echo '<table>
        <thead>
          <th>LINKS</th>
        </thead>
        <tbody>
          <tr>
          <th>http://localhost:8000/selecionar</th>
          </tr>
          <tr>
          <th>http://localhost:8000/selecionarid/$id</th>
          </tr>
          <tr>
          <th>http://localhost:8000/update/$id</th>
          </tr>
          <tr>
          <th>http://localhost:8000/create</th>
          </tr>
          <tr>
          <th>http://localhost:8000/delete/$id</th>
          </tr>
        </tbody>
      </table>';
    }
    public function criar()
    {
      $this->users
        ->create('users', array());
    }
    public function selecionar()
    {
      echo $this->users
        ->selectUsers();
    }
    public function selecionarid($id)
    {
      echo $this->users
        ->selectUserOfId($id);
    }
    public function update($id, $campos)
    {
      $this->users
        ->updateUserForId($id, $campos);
    }
    public function delete($id)
    {
      $this->users->deleteUserForId($id);
    }
  }

?>
