<?php

/*
 * Minori Upload API (Controller)
 */

require_once 'include/config/const.php';
require_once 'include/model/model.php';
require_once 'include/view/view.php';

/*
 * DB初期化処理
 */
$attr = array(
    'password' => 'passwd',
    'name' => 'files'
);
$model = new Model($attr);


/*
 * レスポンス処理
 */
$view = new View();

// DB接続エラー
if($model === null){
    //$view->responseError();
    http_response_code(500);
    exit();
}

// POST以外は拒否
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405);
    exit();
}

if(!isset($_FILES['file'])) {
    http_response_code(400);
    exit();
}

$ret = $model->inputFile($_FILES['file']);

if($ret !== 0){
    http_response_code(400);
    exit();
}

$view->responseJSON(200, '');

//$model->connectDB('SELECT * FROM files');

























/*
class Controller {

    // コンストラクター
    function Controller(){

    }



}

require_once 'include/config/const.php';
require_once 'include/model/model.php';
require_once 'include/view/view.php';
require_once 'include/controller/controller.php';

$_CONST = function($const_string) { return $const_string; };

$conn_string = "pgsql:
                host={$_CONST(DB_HOST)}\n
                port={$_CONST(DB_PORT)}\n
                dbname={$_CONST(DB_NAME)}\n 

                options='--client_encoding={$_CONST(DB_CLIENT_ENCODING)}'
                ";

echo($conn_string);


$dbconn = pg_connect();
pg_close($dbconn);




try{
    $dbh = new PDO($conn_string, DB_USER, DB_PASSWORD);
    $sql = 'select * from files';
    foreach ($dbh->query($sql) as $row) {
        print($row['id']);
        print($row['name'].'<br>');
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
*/