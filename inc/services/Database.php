<?php

require_once(__DIR__ . '/../config.php');


/* REFERENCE: https://gist.github.com/n0m4dz/6b0ae1f02c71c168cf46 */

class Database extends PDO
{

  public function __construct()
  {
    parent::__construct("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }


  /**
   * @param string $sql The sql statement to prepare. Variables to be binded should be prefixed with a semicolon ':id'
   * @param array $array An Assoiciative array with the value and what to bind it to 'id' => '2'
   * @param PDO::FETCH $fetchmode The mode to get the elements.
   * @return array All returned rows
   * 
   */
  public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
  {
    $sth = $this->prepare($sql);
    foreach ($array as $key => $value) {
      $sth->bindValue("$key", $value);
    }

    if (!$sth->execute()) {
      $this->handleError();
    } else {
      return $sth->fetchAll($fetchMode);
    }
  }

  /**
   * @param string $table The name of the table you want to insert into
   * @param array $data An associative array where the key is the column and the value is the value
   * @param bool $ignore Whether the query should be ignored if it fails
   */
  public function insert($table, $data, $ignore = false)
  {
    ksort($data);

    $fieldNames = implode('`, `', array_keys($data));
    $fieldValues = ':' . implode(', :', array_keys($data));

    $pre_query = "INSERT ";
    if ($ignore == true) {
      $pre_query .= "IGNORE ";
    }

    $sth = $this->prepare($pre_query . "INTO $table (`$fieldNames`) VALUES ($fieldValues) RETURNING id");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    if (!$sth->execute()) {
      $this->handleError();
      // print_r($sth->errorInfo());
    } else {
      return $sth->fetchAll(PDO::FETCH_ASSOC)[0];
    }
  }

  /**
   * @param string $table The table you are updating
   * @param array $data An associative array where the key is the column and the value is the new value to update to
   * @param string $where Anything placed after the "where" part of the statement
   * @param array $where_binds associative array for bindings after the where statement
   */
  public function update($table, $data, $where, $where_binds)
  {
    ksort($data);

    $fieldDetails = NULL;
    foreach ($data as $key => $value) {
      $fieldDetails .= "`$key`=:$key,";
    }
    $fieldDetails = rtrim($fieldDetails, ',');

    $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    foreach ($where_binds as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    $sth->execute();
  }

  /**
   * @param string $table The table to delete from
   * @param string $where Queries placed after where
   * @param array $params Values to bind to the WHERE statement. :id is bound to 'id' => int
   */
  public function delete($table, $where, $params = array(), $limit = 1)
  {
    $sth = $this->prepare("DELETE FROM $table WHERE $where LIMIT $limit");

    foreach ($params as $key => $value) {
      $sth->bindValue("$key", $value);
    }

    if ($result = !$sth->execute()) {
      $this->handleError();
    } else {
      return true;
    }
  }

  /* count rows*/
  // public function rowsCount($table)
  // {
  //   $sth = $this->prepare("SELECT * FROM " . $table);
  //   $sth->execute();
  //   return $sth->rowCount();
  // }

  /* error check */
  private function handleError()
  {
    if ($this->errorCode() != '00000') {
      if ($this->_errorLog == true)
        //Log::write($this->_errorLog, "Error: " . implode(',', $this->errorInfo()));
        echo json_encode($this->errorInfo());
      throw new Exception("Error: " . implode(',', $this->errorInfo()));
    }
  }
}