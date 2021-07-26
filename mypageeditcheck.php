<!--
mypageeditで記入した値を取得する
画像パス、名前、プログラム言語(文字列)、コメント
画像パスはファイル形式をチェックする


 -->
<?php
// データベース設定ファイルを含む
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
define('DSN', 'mysql:host=minori-mysql-db.celya9ihh19s.us-west-2.rds.amazonaws.com;dbname=minori;');
define('DB_USER', 'root');
define('DB_PASS', 'it_kaihatu_minori');

session_start();
$userid = intval($_SESSION["user_id"]);

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS,$options);
  $sql = "SELECT * FROM users";
  $stmt = $pdo->query($sql);
}catch(Exception $e){
  $msg = $e->getMessage();
}
$statusMsg = '';
$statusMsgok = '';

// ファイルのアップロード先
//相対パスに変えた--植田
$pas="./images/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $pas . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$lang = $_POST['lang'];
$name = $_POST['myname'];
$coment = $_POST['mycomment'];
// var_dump($lang);
var_dump($userid);
//配列で得たプログラム言語をvalueにして配列に入れる
if(isset($lang) && is_array($lang)){
}else{
  $lang = "プログラム言語が選択されていません";
}
// 名前
if(empty($name)){
  $name = "匿名さん";
}
// コメント
if(empty($coment)){
  $coment = "コメントがありません。";
}

//var_dump($targetFilePath);

//画像アップロードの処理--ファイル形式変えたりサイトジャンプ入れるかも--植田
if(!empty($_FILES["image"]["name"])){
    // 特定のファイル形式の許可
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // サーバーにファイルをアップロード
        var_dump("名前=" . $name);
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        var_dump("通りました");

            // データベースに画像ファイル名を挿入
            //$insert = $pdo->query("select * from users");

             $insert = $pdo->query("update users set iconpass='$targetFilePath',name='$name',PROFILE_COMMENT = '$coment' where user_id = $userid");
             // 言語とコメントをデータベースに入れる

          if($insert){
              $statusMsgok = " ".$fileName. " が正常にアップロードされました";
          }else{
              $statusMsg = "ファイルのアップロードに失敗しました、もう一度お試しください";
          }
          $delete = $pdo->query("delete from like_lang where USER_ID = $userid");
          foreach ($lang as $l) {

            $insert = $pdo->query("INSERT INTO like_lang  VALUES ($userid,'$l')");
          }
      }else{
          $statusMsg = "申し訳ありません、ファイルのアップロードに失敗しました";
      }
  }else{
      $statusMsg = '申し訳ありません、アップロード可能なファイル（形式）は、JPG、JPEG、PNGのみです';
  }
}else{
    $statusMsg = 'アップロードするファイルを選択してください';
}

// ステータスメッセージを表示(画像)
if(empty($statusMsgok)){
  echo($statusMsg);
  exit;
}else{
  $login_success_url = "mypage.php";
  header("Location: {$login_success_url}");
}

?>
