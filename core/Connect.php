<?php
namespace Core;
use \PDO;
class Connect extends PDO
{
  public function __construct()
  {
    global $config;
    $db = $config['DB_CONFIG'];
    parent::__construct($db['DB_DRIVER'].':host='.$db['DB_HOST'].';dbname='.$db['DB_NAME'], $db['DB_USER'], $db['DB_PASS']);
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  public function create($table, $where)
  {
    foreach ($where as $key => $value) {
      //$query .= "$key = $value, ";
      $params .= '`'.$key."`, ";
      $values .= $value.", ";
    }
    $params = \trim($params);
    $last = $params{strlen($params)-1};
    if (!strcmp($last,","))
    {
      $params = rtrim($params, 'a..z');
      $params = rtrim($params, ',');
    }
    $values = trim($values);
    $last = $values{strlen($values)-1};
    if (!strcmp($last,","))
    {
      $values = rtrim($values, 'a..z');
      $values = rtrim($values, ',');
    }

    echo (string)$query = "INSERT INTO `$table`($params) VALUES ($values)";
    
    $this->query($query);
  }

  //Select the of all data in table;
  public function selectAll($table)
  {
    $sqlResult = $this->query("SELECT * FROM `$table` ORDER BY id");

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
  //Select the of id in table
  public function selectOfId($table, $id)
  {
    $sqlResult = $this->query("SELECT * FROM $table WHERE id = '$id'");
    
    if ($sqlResult->rowCount() > 0) {
      return json_encode($sqlResult->fetch(PDO::FETCH_ASSOC));
    } else {
      return json_encode(
        array(
          'empty' => ''
        )
      );
    }
  }

  public function updateOfId($table, $id, $where)
  {
    //Concatenação dos dados enviados pelo $where;
    foreach ($where as $column => $value) {
      $query .= "$column = $value, ";
    }

    $query = trim($query);
    $last = $query{strlen($query)-1};
    if (!strcmp($last,","))
    {
      //Removendo a ultima virgula;
      $query = rtrim($query, 'a..z');
      $query = rtrim($query, ',');
    }
    //Query de update;
    $this->query("UPDATE `$table` SET $query WHERE `id` = $id");
  }

  public function deleteOfId($table, $id)
  {
    $this->query("DELETE FROM $table WHERE id = $id");
  }
}
