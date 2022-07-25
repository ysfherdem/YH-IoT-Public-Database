<?php
try{
  $db = new PDO('mysql:host=localhost;dbname=yusufher_iot;charset=UTF8', 'username', 'password'); // host, dbname, charset, username, password
}catch (PDOException $e){
  echo "PDO Connection error ".$e->getMessage();
}
?>
