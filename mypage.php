<!--
■個人情報
名前：
アイコン
■コメント
コメント：
■データ
使う言語など： -->
<!-- iamge,myname,mycode,mycomment -->
<?php
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

$userid = $_SESSION["user_id"];

// if(!isset($_SESSION["user_name"])) {
//     $no_login_url = "login.html";
//     header("Location: {$no_login_url}");
//     exit;
// }


// try{
//   $pdo = new PDO(DSN,DB_USER,DB_PASS);
//   $sql = "SELECT * FROM users WHERE NAME == $_SESSION['user_id']";
//   $stmt = $pdo->query($sql);
// }catch(Exception $e){
//   $msg = $e->getMessage();
// }

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
    <img class="profile_img" src="file:///C:/Users/2190492/Desktop/%E3%83%91%E3%83%BC%E3%82%BD%E3%83%8A%E3%83%AB/%E7%94%BB%E5%83%8F/%E8%89%B2%E3%80%85/%E3%83%81%E3%83%99%E3%83%83%E3%83%88%E3%82%B9%E3%83%8A%E3%82%AE%E3%83%84%E3%83%8D.jpg">
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