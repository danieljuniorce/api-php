<?php
namespace Core;
use \PDO;
class Connect extends PDO
{
  public function __construct()
  {
    parent::__construct('mysql:host=localhost;dbname=dbteste', 'root', '');
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  public function select($table)
  {
    $sqlResult = $this->query("SELECT * FROM $table ORDER BY id");

    if ($sqlResult->rowCount() > 0) {
      return json_encode($sqlResult->fetchAll(PDO::FETCH_ASSOC));
    } else {
      return json_encode(
        array(
          'empty' => ''
        )
      );
    }
  }
}
