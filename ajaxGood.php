<?php

//DB接続情報

define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_CHARSET', 'utf8');


session_start();

var_dump($_POST['ContentID']);
var_dump($_POST['SESSIONID']);

if (isset($_POST['ContentID'])) {
    $conid = $_POST['ContentID'];
}

if (isset($_POST['SESSIONID'])) {
    $setionid = $_POST['SESSIONID'];
}
?>

<?php



//DBに接続出来なかったときの処理
$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($link->connect_error) {
    $sql_error = $link->connect_error;
    error_log($sql_error);
    die($sql_error);
} else {
    $link->set_charset(DB_CHARSET);
    echo "connect and use success!<br>";
}
// いいね済みか確認するSQL
$result = $link->query("SELECT * FROM likes WHERE ContentID = '{$conid}' AND USERID = '{$setionid}'");

//戻ってきたレコード件数を取得
$duplicate_num = $result->num_rows;
echo $duplicate_num . "県</br>";
//すでにいいね登録済なら削除する
if ($duplicate_num > 0) {
    $result = $link->query("DELETE FROM likes WHERE ContentID = {$conid} AND USERID = {$setionid}");
    echo "既にありました";


    //いいねが登録されていなければレコードを登録する
} else if ($duplicate_num == 0) {
    $result = $link->query("INSERT INTO  likes VALUES({$conid},{$setionid})");
    echo "なかったので追加した";
}

//いいね数を取得して表示する
$result = $link->query("SELECT COUNT(Contentid) FROM likes WHERE CONTENTID={$conid}");

while ($data = mysqli_fetch_array($result)) {
    echo $data['COUNT(Contentid)'];
}

?>