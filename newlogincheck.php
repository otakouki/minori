<?php

define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

$userid=$_POST['user_id'];
$passwd=$_POST['password'];
$hash = hash("sha256", $passwd);

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $sql = "INSERT INTO users(NAME,PASSWORD)VALUES(:name,:passwd)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':name'=>$userid, ':passwd'=>$hash));
  echo "とうろくできました";
}catch(Exception $e){
  $msg = $e->getMessage();
}


var_dump($userid,$hash);
echo 新規登録;
