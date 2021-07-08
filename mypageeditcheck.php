
<?php
// データベース設定ファイルを含む
define('DSN', 'mysql:host=localhost;dbname=test');
define('DB_USER', 'root');
define('DB_PASS', 'root');

session_start();

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
//var_dump($targetFilePath);

//画像アップロードの処理--ファイル形式変えたりサイトジャンプ入れるかも--植田
if(!empty($_FILES["image"]["name"])){
    // 特定のファイル形式の許可
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // サーバーにファイルをアップロード
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
            // データベースに画像ファイル名を挿入
            //$insert = $pdo->query("select * from users");
             $insert = $pdo->query("update users set iconpass='$targetFilePath' where userid = 9");
             var_dump($insert);
          if($insert){
              $statusMsg = " ".$fileName. " が正常にアップロードされました";
          }else{
              $statusMsg = "ファイルのアップロードに失敗しました、もう一度お試しください";
          }
      }else{
          $statusMsg = "申し訳ありませんが、ファイルのアップロードに失敗しました";
      }
  }else{
      $statusMsg = '申し訳ありませんが、アップロード可能なファイル（形式）は、JPG、JPEG、PNG、GIF、PDFのみです';
  }
}else{
    $statusMsg = 'アップロードするファイルを選択してください';
}

// ステータスメッセージを表示
echo $statusMsg;
?>
