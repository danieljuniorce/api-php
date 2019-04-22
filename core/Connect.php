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

  public function create($table, $campos)
  {
    $prepareSQL = [];
    //Manipulando os dados enviado pelo array no $where;
    foreach($campos as $column => $value) {
      //Prepando a coluna para utilização no prepara Ex: email = :email,
      $prepareSQL[] = "$column = :$column";
    }
    //Retirando o último caractere da string, EX: email = :email, name = :name,
    $prepareSQL = implode(',', $prepareSQL);

    //Preparando a query;
    $query = $this->prepare("INSERT INTO $table SET $prepareSQL");

    //Manipulando o array para utilizanção do envio da query;
    foreach ($campos as $column => $value) {
      $query->bindValue(":$column", $value);
    }
    //Executando a query;
    $query->execute();
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
    $query = $this->prepare("SELECT * FROM $table WHERE id = :id");
    $query->bindValue(':id', $id);
    
    $query->execute();
    if ($query->rowCount() > 0) {
      return json_encode($query->fetch(PDO::FETCH_ASSOC));
    } else {
      return json_encode(
        array(
          'empty' => ''
        )
      );
    }
  }

  public function updateOfId($table, $id, $campos)
  {
    $prepareSQL = [];
    //Manipulando os dados enviado pelo array no $where;
    foreach($campos as $colun => $value) {
      //Prepando a coluna para utilização no prepara Ex: email = :email,
      $prepareSQL[] = "$colun = :$colun";
    }
    //Retirando o último caractere da string, EX: email = :email, name = :name,
    //$prepareSQL = substr($prepareSQL, 0, -2);
    $prepareSQL = implode(',', $prepareSQL);
    //Preparando a query;
    $query = $this->prepare("UPDATE $table SET $prepareSQL WHERE id = :id");

    //Manipulando o array para utilizanção do envio da query;
    foreach ($campos as $colun => $value) {
      $query->bindValue(":$colun", $value);
    }
    //Update baseado no id do dado na tabela;
    $query->bindValue(':id', $id);
    //Executando a query;
    $query->execute();
  }

  public function deleteOfId($table, $id)
  {
    $query = $this->prepare("DELETE FROM $table WHERE id = :id");
    $query->bindValue(':id', $id);

    $query->execute();
  }
}
