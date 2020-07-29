<?php
// Create connection
function connect(){
  $servername = "";
  $username = "";
  $password = "";
  $dbname = "heroku_f02742e3b22d69c";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $conn->query("use surveyResults");
  return $conn;
}



function addTable($name, $rows){
  $sql = "create table IF NOT EXISTS ".$name." (ID INT PRIMARY KEY AUTO_INCREMENT, ";
  foreach ($rows as $key => $value) {
    $sql .= $value." TINYTEXT";
    if(count($rows)-1 == $key){
      $sql .= ");";
    }else{
      $sql .= ", ";
    }
  }
  echo $sql;
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
  $result = $db->query($sql);
  $rows = array();
  while($row = $result->fetch_assoc()){
    array_push($rows, $row);
  }
  return $rows;
}

function run($sql){
  $db = connect();
  $ret = $db->query($sql);
  $res = false;
  if(!$ret){
      echo $db->error;
  }else{
    //echo "sql executed";
    $res = true;
  }
  $db->close();
  return $res;
}
?>
