<?php
class MyDB extends SQLite3 {
   function __construct($db_file) {
      $this->open($db_file);
   }
}

function connect(){
  $db = new MyDB('database.db');
  if(!$db) {
     echo $db->lastErrorMsg();
  } else {
     //echo "Opened database successfully\n";
  }
  return $db;
}


function addTable($name, $rows){
  $sql = "create table IF NOT EXISTS ".$name." (ID INTEGER PRIMARY KEY AUTOINCREMENT, ";
  foreach ($rows as $key => $value) {
    $sql .= $value." TEXT";
    if(count($rows)-1 == $key){
      $sql .= ");";
    }else{
      $sql .= ", ";
    }
  }

  return $sql;
}


function addResult($table, $data){
  $keys = array();
  $values = array();
  foreach ($data as $key => $value) {
    array_push($keys, $key);
    array_push($values, '\''.$value.'\'');
  }
  $sql = "INSERT INTO ".$table." (".implode(",",$keys).") VALUES(".implode(",",$values).");";
  return $sql;
}

function getAll($table){
  $db = connect();
  $sql = "select * from ".$table.";";
  $ret = $db->query($sql);
  $rows = array();
  while($row = $ret->fetchArray(SQLITE3_ASSOC)){
    array_push($rows, $row);
  }
  return $rows;
}

function run($sql){
  $db = connect();
  $ret = $db->exec($sql);
  $res = false;
  if(!$ret){
      //echo $db->lastErrorMsg();
  }else{
    //echo "sql executed";
    $res = true;
  }
  $db->close();
  return $res;
}
 ?>
