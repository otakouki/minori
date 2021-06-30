<?php
header('charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$upload = './upload/';
	$filename = $_FILES['upfile']['name'];
	switch ($_FILES['upfile']['error']) {
		case 1:
			exit('ファイルサイズが大きすぎます(php.ini)。');

		case 2:
			exit('ファイルサイズが大きすぎます。');

		case 3:
			exit('ファイルの一部しかアップロードされていません。');

		case 4:
			exit('ファイルが転送されませんでした。');
	}
	if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
		if (move_uploaded_file($_FILES['upfile']['tmp_name'], $upload . $filename)) {
			$message = 'アップロード成功';
		} else {
			$message = 'アップロード失敗';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>課題12</title>
</head>
<h1>課題12 ファイル処理2(ファイルのアップロード)</h1>

<body>
	<?= $message ?>

</body>

</html>