<?php

// define('DB_HOST', 'localhost');
// define('DB_NAME', 'test');
// define('DB_USER', 'root');
// define('DB_PASSWORD', 'root');
// define('DB_CHARSET', 'utf8');

//DBを選択してコネクト
$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($link->connect_error) {
    $sql_error = $link->connect_error;
    error_log($sql_error);
    die($sql_error);
} else {
    $link->set_charset(DB_CHARSET);
    echo "connect and use success!<br>";
}

//SELECT文を発行
$result = $link->query('select c.Title,u.name from content c, users u where c.user_id = u.userid and c.range_id = 3');
if (!$result) {
    $sql_error = $link->error;
    echo 'select failed.<br>';
    error_log($sql_error);
    die($sql_error);
} else {
    echo "select success!<br>";
}

//データ一覧
while ($data = mysqli_fetch_array($result)) {
    echo '<p>' . $data['Title'] . ':' . $data['name'] . "</p>";
}

//ヒット数を表示
$duplicate_num = $result->num_rows;
echo $duplicate_num . " 件該当しました。<br>\n";

//接続をクローズ
$link->close();
echo "接続をクローズしました。";
