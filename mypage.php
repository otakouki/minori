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
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

$userid = $_SESSION["user_id"];
$icon = $_SESSION["iconpass"];

// ログイン状態を保持しているか判別
if(isset($userid)){
}else{
  header('Location:login.php');
     exit;
}


try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $sql = "SELECT name,iconpass FROM users where userid=$userid";
  $stmt = $pdo->query($sql);
}catch(Exception $e){
  $msg = $e->getMessage();
}

foreach ($stmt as $row) {
  $filepath = $row['iconpass'];
  $name = $row['name'];
}
if(empty($filepath)){
  $filepath = "./images/newlogin.jpg";
}
// var_dump($filepath);

//言語、コメントを抜き出す
// try{
//   $sql = "SELECT lang,coment FROM "データベース名" where userid=$userid";
//   $stmt = $pdo->query($sql);
// }catch(Exception $e){
//   $msg = $e->getMessage();
// }
// foreach ($stmt as $row) {
//   $lang = $row['lang'];
//   $coment = $row['coment'];
// }
$lang="PHP";
$coment = "はじめまして！";
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
      <li><a href="main.php">home</a></li>
      <li><a href="#">meni2</a></li>
      <li><a href="#">Menu3</a></li>
      <li><a href="#">Menu4</a></li>
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
      <span class="data"><?php echo $lang; ?></span>
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
      <li class="tab-item">いいねタグ</li>
      <li class="tab-item">お気に入り</li>
    </ul>
    <!-- コンテンツ -->
    <div class="tab-box">
      <div class="tab-content show">コンテンツA</div>
      <div class="tab-content">コンテンツB</div>
      <div class="tab-content">コンテンツC</div>
    </div>
  </div>
</body>

</html>
