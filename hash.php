<?php
// ハッシュ値を計算する前の文字列
$str = "ecc";

// hash関数
var_dump(hash("sha256", $str) . "<br>");

// md5関数
var_dump(md5($str) . "<br>");

// sha1関数
var_dump(sha1($str) . "<br>");
