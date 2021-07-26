<?php
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);
define('DSN', 'mysql:host=minori-mysql-db.celya9ihh19s.us-west-2.rds.amazonaws.com;dbname=minori');
define('DB_USER', 'root');
define('DB_PASS', 'it_kaihatu_minori');

session_start();
$username = $_SESSION["user_name"];
$coment = $_SESSION["coment"];
$userid = intval($_SESSION["user_id"]);

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS,$options);
  $sql = "SELECT * FROM langlist";
  $sql_user = "SELECT * FROM like_lang where USER_ID = $userid";
  $stmt = $pdo->query($sql);
  $stmt1 = $pdo->query($sql_user);

}catch(Exception $e){
  $msg = $e->getMessage();
}
$l = 0;
$lang=array();
foreach ($stmt1 as $row1) {
  $l += 1;
  # code...
  $lang[$l] = $row1['LIKE_LANG'];
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
      <form enctype="multipart/form-data" method="post"  action="mypageeditcheck.php">
        <tr>
          <th>プロフィール画像:</th>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <th>名前：</th>
          <td><input type="text" name="myname" value="<?php echo $username;?>" size="24"></td>
        </tr>
        <tr>
          <th>使用言語：</th>
          <td>
            <!-- DBからプログラム言語一覧を取り出す -->
            <!-- 事前にプログラム言語を入れたテーブルをつくる必要あり -->
            <?php
            $lang1 = array();
            $i = 1;
            $j = 0;
              foreach ($stmt as $row) {
                $lang1[$j] = $row['LANG_ID']
              ?>

                <label><input type="checkbox" name="lang[]" value="<?php echo $row['LANG_ID'];?>" <?php
                if($lang1[$j] == $lang[$i]){
                  echo 'checked="checked"';
                  $i += 1;
                }?>>
                    <?php echo $row['LANG_NAME'];?></label>

                    <?php
                    $j++;
              }
              var_dump($lang[0]);
              var_dump($lang1[0]);
              ?>
          </td>
        </tr>
        <tr>
          <th>コメント：</th>
          <td><input type="text" name="mycomment" value="<?php echo $coment;?>" size="24"></td>
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
