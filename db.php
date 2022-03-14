<?php
$hostName = "srv-mysql-komasys.mysql.database.azure.com";
$userName = "myadmin";
$password = "Test123!";
$databaseName = "dbkomasys";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function fetch_data($db, $tableName, $columns, $condition){
  if(empty($db)){
   $msg= "Database connection error";
  }elseif (empty($columns) || !is_array($columns)) {
   $msg="columns Name must be defined in an indexed array";
  }elseif(empty($tableName)){
    $msg= "Table Name is empty";
  }else{
    $columnName = implode(", ", $columns);
    $query = "SELECT ".$columnName." FROM $tableName WHERE $condition"." ORDER BY id DESC";
    $result = $db->query($query);
    if($result== true){ 
      if ($result->num_rows > 0) {
        $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
        $msg= $row;
      } else {
        $msg= "No Data Found"; 
      }
    }else{
      $msg= mysqli_error($db);
    }
  }
  return $msg;
 }

 function insert_data($db, $sql) {  
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  
  if(mysqli_query($db, $sql)){
    $msg= "success"; 
  } else{
    $msg= "ERROR: $sql.". mysqli_error($db);
  }
  return $msg;
 }
?>