<?php

define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

$userid = $_POST['user_id'];
$passwd = $_POST['password'];
$hash = hash("sha256", $passwd);

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = "INSERT INTO users(NAME,PASSWORD)VALUES(:name,:passwd)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':name' => $userid, ':passwd' => $hash));
} catch (Exception $e) {
  $msg = $e->getMessage();
}


// var_dump($userid, $hash);
?>
<!-- 5秒後にログイン画面にジャンプするように変更した -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>プロフィール編集</title>
  <link rel="stylesheet" href="css/mypage.css">
  <META http-equiv="Refresh" content="5;URL=login.html">
</head>
<header>
  <h1>登録が完了しました</h1>
</header>
<body>
  このページは5秒後にログイン画面にジャンプします。
</body>
</html>
