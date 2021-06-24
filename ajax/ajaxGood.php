<?php

//DB接続情報
header('charset=utf-8');
define('HOST', 'localhost');
define('USR', 'root');
define('PASS', '');
define('DB', 'test');


session_start();



if (!isset($_SESSION['USERID'])) {
    // 送られてきたセッションIDを使う予定
    $_SESSION['USERID'] = 0;
}
?>

<?php

    //DBに接続出来なかったときの処理
if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
    // print('データベースに接続できません');
}else{
    // print("接続できました。");
}
  
    // 文字コード設定
    mysqli_set_charset($conn, 'utf8');
    // いいね済みか確認するSQL
    $sql = 'SELECT * FROM likes WHERE ContentID = 5 AND USERID = 0';

    $res = mysqli_query($conn, $sql);
    
    //戻ってきたレコード件数を取得
    $num_rows = mysqli_num_rows($res);

    //すでにいいね登録済なら削除する
    if($num_rows>0){
        $sql = 'DELETE FROM likes WHERE ContentID = 5 AND USERID = 0';
        $res = mysqli_query($conn, $sql);//実行
    
        
    //いいねが登録されていなければレコードを登録する
    }else if($num_rows==0){
        $sql = 'INSERT INTO  likes VALUES(5,0)';
        $res = mysqli_query($conn, $sql);//実行
    }
   
    //いいね数を取得して表示する
    $sql = 'SELECT COUNT(Contentid) FROM likes WHERE CONTENTID=5';
    $stmt = mysqli_prepare($conn, $sql);//実行準備
    mysqli_stmt_execute($stmt);//プリペアドステートメントを実行
    mysqli_stmt_bind_result($stmt, $LIKECOUNT);

    mysqli_stmt_fetch($stmt);
        echo $LIKECOUNT;

//終了処理
mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>