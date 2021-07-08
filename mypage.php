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

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  //ueserid仮で指定してる
  $sql = "SELECT iconpass FROM users where userid=9";
  $stmt = $pdo->query($sql);

}catch(Exception $e){
  $msg = $e->getMessage();
}

foreach ($stmt as $row) {
  $filepath = $row['iconpass'];
}
var_dump($filepath);

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
      <li><a href="#">Menu1</a></li>
      <li><a href="#">Menu2</a></li>
      <li><a href="#">Menu3</a></li>
      <li><a href="#">Menu4</a></li>
      <li><a href="#">Menu5</a></li>
    </ul>
  </nav>
  <!-- プロフィールを記載 -->
  <div class="profile">
    <!-- 変数パス例  .image/xxx.jpg -->
    <img class="profile_img" src="<?php echo $filepath;?>">
    <div class="profile_name">
      <span>名前：</span>
      <span class="name"><?php echo $userid; ?></span>
    </div>
    <div class="user_ID">
      <span>ID:</span>
      <span class="ID">test123</span>
    </div>
    <div class="profile_data">
      <span>主な使用言語：</span>
      <span class="data">php</span>
    </div>
  </div>
  <!-- コメント -->
  <div class="coment">頑張る</div>
  <button type="button" class="edit" href="mypageedit.html">プロフィールを編集する</button>

  <!-- 過去に上げたサイトのリンクなど -->
  <!-- タブメニュー -->
  <div class="tab">
    <ul class="tab-menu">
      <li class="tab-item active">過去の投稿</li>
      <li class="tab-item">お気に入りサイト</li>
      <li class="tab-item">お気に入りユーザー</li>
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
