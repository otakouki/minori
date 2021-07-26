
 <?php
 session_start();

 $userid = $_POST['user_id'];
 $passwd = $_POST['password'];
 $mail = $_POST['mail'];
 $hash = hash("sha256", $passwd);
 $judge = 0;
 //新規の人用の仮表示の画像パスを入れる
 var_dump($mail);
var_dump($userid);
 var_dump($passwd);
 var_dump($hash);


  $conn = new mysqli( 'minori-mysql-db.celya9ihh19s.us-west-2.rds.amazonaws.com', 'root', 'it_kaihatu_minori', 'minori');

  if( $conn->connect_errno ) {
  	$newstr = 'サーバーに接続出来ませんでした。時間を少し空けてからお試しください。';
  }else{
    $newstr = '接続できました。';
  }


  $conn->set_charset('utf8');
    $sql = "SELECT MAIL FROM users";
    $maildata =$conn->query($sql);

    foreach ($maildata as $row) {
      $mailpas = $row['MAIL'];
      var_dump($mailpas);
      if($mailpas==$mail){
        $str = "このメールアドレスはすでに使われています";
      }else {
        $judge = 1;
      }
    }

    // INSERT
    if($judge==1){
      $sql = "INSERT INTO users (MAIL, NAME, PASSWORD) VALUES ('$mail','$userid','$hash')";
      $res = $conn->query($sql);
      if($res){
        $str = "登録に成功しました";
      }else{
        $str = "登録に失敗しました";
      }
    }

  $conn->close();
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
    <h1><?php echo($newstr) ?></h1>
  </header>
  <body>
    <!-- このページは5秒後にログイン画面にジャンプします。 -->
  </body>
  </html>
