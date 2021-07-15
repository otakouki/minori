<!--
mypageeditで記入した値を取得する
画像パス、名前、プログラム言語(文字列)、コメント
画像パスはファイル形式をチェックする


 -->
<?php
// データベース設定ファイルを含む
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();
$userid = $_SESSION["user_id"];

try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $sql = "SELECT * FROM users";
  $stmt = $pdo->query($sql);
}catch(Exception $e){
  $msg = $e->getMessage();
}
$statusMsg = '';

// ファイルのアップロード先
//相対パスに変えた--植田
$pas="./images/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $pas . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$lang = $_POST['lang'];
$name = $_POST['myname'];
$coment = $_POST['mycomment'];
//配列で得たプログラム言語を文字列にする
if(isset($lang) && is_array($lang)){
  $lang = implode("、",$lang);
}else{
  $lang = "プログラム言語が選択されていません";
}
// 名前
if(empty($name)){
  $name = "名無しの権平さん";
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
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
            // データベースに画像ファイル名を挿入
            //$insert = $pdo->query("select * from users");
             $insert = $pdo->query("update users set iconpass='$targetFilePath',name='$name' where userid = $userid");
             // 言語とコメントをデータベースに入れる
             // $insert2 = $pdo->query("update データベース名 set lang='$lang' coment='$coment' where userid = $userid");
          if($insert){
              $statusMsg = " ".$fileName. " が正常にアップロードされました";
          }else{
              $statusMsg = "ファイルのアップロードに失敗しました、もう一度お試しください";
          }
      }else{
          $statusMsg = "申し訳ありませんが、ファイルのアップロードに失敗しました";
      }
  }else{
      $statusMsg = '申し訳ありませんが、アップロード可能なファイル（形式）は、JPG、JPEG、PNGのみです';
  }
}else{
    $statusMsg = 'アップロードするファイルを選択してください';
}

//以下の変数をデータベースに入れる
var_dump($userid,$lang,$name,$coment);
// ステータスメッセージを表示(画像)
echo $statusMsg;

$login_success_url = "mypage.php";
header("Location: {$login_success_url}");
?>
