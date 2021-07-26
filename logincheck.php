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
    $_SESSION["user_name"] = $userid;
    $_SESSION["user_id"] = $row['USERID'];

    $login_success_url = "main.php";
    header("Location: {$login_success_url}");
    exit;
  }else {
    $str = "ユーザー情報またはパスワードが間違っています";
  }
}

 ?>
 <!-- 5秒後にログイン画面にジャンプするように変更した -->
 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>プロフィール編集</title>
   <!-- <link rel="stylesheet" href="css/mypage.css"> -->
   <!-- <META http-equiv="Refresh" content="5;URL=login.html"> -->
 </head>
 <header>
   <h1><?php echo($str) ?></h1>
 </header>
 <body>
   <!-- このページは5秒後にログイン画面にジャンプします。 -->
 </body>
 </html>
