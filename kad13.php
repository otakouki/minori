<?php
	header('charset=utf8');
	$filename = "syohin.json";

	if (file_exists($filename)) {
		$json = file_get_contents($filename);
		$json = mb_convert_encoding($json,'UTF-8','ASCII,JIS,UTF-8,EVC-JP,SJIS-WIN');
		$data = json_decode($json);

	}else{
		exit("ファイルがありません。");
	}

 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="utf-8">
   <title></title>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="css/bootstrap.min.css">

 </head>
 <body>
	 <h1>課題13 ファイル処理(JSON)</h1>
	 <?php
	 foreach ($data as $item) {
		print "<img src=./images/{$item->PHOTO}>";
		print $item->NAME;
		print "{$item->PRICE}円";
		print "<br>";
	 }

?>

 <!--ここからBootStrap用js読込-->
 <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
 </body>
 </html>
