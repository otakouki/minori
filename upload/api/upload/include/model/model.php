<?php

class Model {
    private $attr = null;
    private $dbh = null;

    function __construct($attr) {
        return;

        if(!array_key_exists('password', $attr)) {
            return null;
        }

        $this->attr = array(
            'user' => array_key_exists('user', $attr) ? $attr['user'] : 'postgres',
            'password' => $attr['password'],
            'host' => array_key_exists('host', $attr) ? $attr['host'] : 'localhost' ,
            'port' => array_key_exists('port', $attr) ? $attr['port'] : 5432,
            'name' => array_key_exists('name', $attr) ? $attr['name'] : 'postgres',
            'encoding' => array_key_exists('encoding', $attr) ? $attr['encoding'] : 'utf-8',
            'debug' => array_key_exists('debug', $attr) ? $attr['debug'] : false
        );

        if($this->attr['debug']) {
            var_dump($this->attr);
        }

        if($this->initDB() === null) {
            if($this->attr['debug']) {
                echo('Connection Error!');
            }
            return null;
        }
    }

    /*
     * DB接続処理
     */
    private function initDB() {
        $conn = "pgsql:
                host={$this->attr['host']}\n
                port={$this->attr['port']}\n
                dbname={$this->attr['name']}\n 
                options='--client_encoding={$this->attr['encoding']}'
                ";

        try {
            $this->dbh = new PDO($conn, $this->attr['user'], $this->attr['password']);
        }catch (Exception $e) {
            $this->dbh = null;
        }

        return $this->dbh;
    }

    /*
     * 
     */
    function connectDB($sql){
        $dbh = $this->dbh;
        foreach ($dbh->query($sql) as $row) {
            print($row['id']);
            print($row['name'].'<br>');
        }
    }

    /*
     * アップロード処理
     */
    function inputFile($file){
        $temp_file = $file['tmp_name'];
        $file_name = $file['name'];
        $upload_dir = 'data/' . $file_name;

        if(is_uploaded_file($temp_file) && move_uploaded_file($temp_file, $upload_dir)){
            return 0;
        }

        return -1;
    }

}