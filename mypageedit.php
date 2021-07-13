<?php
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $sql = "SELECT * FROM langlist";
  $stmt = $pdo->query($sql);
}catch(Exception $e){
  $msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>プロフィール編集</title>
  <link rel="stylesheet" href="css/mypage.css">

</head>
<header>
  <h1>編集</h1>
</header>
<body>
  <div align="center">
    <table border="0">
      <!-- 植田　mypageeditcheckに変更 -->
      <form enctype="multipart/form-data" method="post" action="mypageeditcheck.php">
        <tr>
          <th>プロフィール画像:</th>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <th>名前：</th>
          <td><input type="text" name="myname" value="" size="24"></td>
        </tr>
        <tr>
          <th>使用言語：</th>
          <td>
            <!-- DBからプログラム言語一覧を取り出す -->
            <!-- 事前にプログラム言語を入れたテーブルをつくる必要あり -->
            <?php
              foreach ($stmt as $row) {
                ?><label><input type="checkbox" name="lang[]" value=<?php echo $row['LANG'];?>><?php echo $row['LANG'];?></label>
              <?php } ?>
          </td>
        </tr>
        <tr>
          <th>コメント：</th>
          <td><input type="text" name="mycomment" value="" size="24"></td>
        </tr>
        <tr>
          <td><input type="submit" class="btn btn-primary" value="編集を完了する"></td>
        </tr>
        <tr><th></th><td>アップロード可能なファイル（形式）は、JPG、JPEG、PNGのみです</td></tr>
      </form>
    </table>
  </div>
</body>
</html>
