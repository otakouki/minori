<?php

define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

$userid=$_POST['user_id'];
$passwd=$_POST['password'];

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $sql = "SELECT * FROM users";
  $stmt = $pdo->query($sql);
}catch(Exception $e){
  $msg = $e->getMessage();
}
$hash = hash( "sha256" , $passwd);
// var_dump($hash);
foreach ($stmt as $row) {
  if($userid==$row['NAME']&&$hash==$row['PASSWORD']){
    $_SESSION["user_id"] = $_POST["user_id"];
    $login_success_url = "mypage.php";
    header("Location: {$login_success_url}");
    exit;
  }else {
    $msg = "ログイン失敗";
  }
}
echo $msg;

 ?>
