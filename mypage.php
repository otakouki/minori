<!--
■個人情報
名前：
アイコン
■コメント
コメント：
■データ
使う言語など： -->
<!-- 画像表示できるようになった。変更する場合はmypegeeditcheckで保存先変えて。植田 -->
<?php
// define('DSN', 'mysql:host=minori-mysql-db.celya9ihh19s.us-west-2.rds.amazonaws.com;dbname=minori');
// define('DB_USER', 'root');
// define('DB_PASS', 'it_kaihatu_minori');
// 仮入れ
$lang="なし";
$coment = "はじめまして！";
$lang1 = array();
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);
define('DSN', 'mysql:host=minori-mysql-db.celya9ihh19s.us-west-2.rds.amazonaws.com;dbname=minori');
define('DB_USER', 'root');
define('DB_PASS', 'it_kaihatu_minori');
session_start();

$userid = intval($_SESSION["user_id"]);
$icon = $_SESSION["iconpass"];

// ログイン状態を保持しているか判別
if(isset($userid)){
}else{
  header('Location:login.html');
     exit;
}


try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS,$options);
  // 個人情報
  $sql_user = "SELECT * FROM users where user_id=$userid";
  $sql_languser = "SELECT l.LANG_NAME FROM like_lang a,langlist l where a.LIKE_LANG = l.LANG_ID and a.USER_ID=$userid";
  // タブメニューに表示
  $sql_content = "SELECT * FROM content where user_id=$userid";
  $sql_likes = "SELECT * FROM likes where user_id=$userid";
  $sql_favorite = "SELECT * FROM favorite where userid=$userid";
$stmt1 = $pdo->query($sql_user);
$stmt2 = $pdo->query($sql_languser);
$stmt3 = $pdo->query($sql_content);
$stmt4 = $pdo->query($sql_likes);
$stmt5 = $pdo->query($sql_favorite);
}catch(Exception $e){
  $msg = $e->getMessage();
}
//以下をひとまとめに要素を抜き出す
// 個人情報
foreach ($stmt1 as $row1) {
  $filepath = $row1['ICONPASS'];
  $name = $row1['NAME'];
  $coment = $row1['PROFILE_COMMENT'];
  $_SESSION["coment"] = $coment;
}
$l = 0;
foreach ($stmt2 as $row2) {
  $l += 1;
  $lang1[$l] = $row2['LANG_NAME'];
}
// タブメニューに表示
// 未完成：テーブルの中身があるかどうか確かめる
foreach ($stmt3 as $row3) {
  $CONTENT_ID = $row3['CONTENT_ID'];
}
foreach ($stmt4 as $row4) {

}
foreach ($stmt5 as $row4) {

}


if(empty($filepath)){
  $filepath = "./images/newlogin.jpg";
}
// var_dump($filepath);

 // 仮入れ
// $lang="PHP";
//$coment = "はじめまして！";

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>プロフィール画面</title>
  <link rel="stylesheet" href="css/mypage.css">

</head>
<header>
  <h1>マイページ</h1>
</header>

<body>

  <!-- ハンバーガーメニュー -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/mypage.js"></script>
  <div class="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <nav class="globalMenuSp">
    <h3>メニュー</h3>
    <ul>
      <li><a href="main.php">Home</a></li>
      <li><a href="#">ファイルアップロード</a></li>
      <li><a href="login.html">ログアウト</a></li>
    </ul>
  </nav>
  <!-- プロフィールを記載 -->
  <div class="profile">
    <!-- 変数パス例  .image/xxx.jpg -->
    <img class="profile_img" src="<?php echo $filepath;?>">
    <div class="user_ID">
      <span>ID：</span>
      <span class="ID"><?php echo $userid; ?></span>
    </div>
    <div class="profile_name">
      <span>名前:</span>
      <span class="name"><?php echo $name; ?></span>
    </div>
    <div class="profile_data">
      <span>主な使用言語：</span>
      <!-- 変数langに書き換える -->
      <span class="data"><?php if($lang1 == NULL){
        echo $lang;
      }else{
        $i = count($lang1);
        $cnt = 0;
        foreach($lang1 as $lang){
          $cnt += 1;
          echo $lang;
          if($i != $cnt){
            echo ", ";
          }

        }
      } ?></span>
    </div>
  </div>
  <!-- コメント -->
  <!-- 変数comentに書き換える -->
  <div class="coment"><?php echo $coment; ?></div>
  <a href="mypageedit.php">プロフィールを編集する</a>
  <!-- 過去に上げたサイトのリンクなど -->
  <!-- タブメニュー -->
  <div class="tab">
    <ul class="tab-menu">
      <li class="tab-item active">自分の投稿</li>
      <li class="tab-item">フォロワー</li>
      <li class="tab-item">フォロー</li>
      <li class="tab-item">お気に入り</li>
    </ul>
    <!-- コンテンツ -->
    <div class="tab-box">
      <!-- 未完成：以下コンテンツの中身 -->
      <div class="tab-content show">
        <!-- 自分の投稿 -->
        <?php
          if(empty($CONTENT_ID)){
            echo "コンテンツがありません";
          }else{
            foreach ($stmt3 as $row3) {
              echo $row3['TITLE'].$row3['FILE_PASS'];
            }
          }
        ?>
      </div>
      <div class="tab-content">
        <!-- フォロワー -->
        <?php
          if(empty($CONTENT_ID)){
            echo "コンテンツがありません";
          }else{
          }
        ?>
      </div>
      <div class="tab-content">
        <!-- フォロー -->
        <?php
          if(empty($CONTENT_ID)){
            echo "コンテンツがありません";
          }else{
          }
        ?>
      </div>
      <div class="tab-content">
        <!-- お気に入り -->
        <?php
          if(empty($CONTENT_ID)){
            echo "コンテンツがありません";
          }else{
          }
        ?>
      </div>
    </div>
  </div>
</body>

</html>
