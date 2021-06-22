<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>プロフィール編集</title>
  <link rel="stylesheet" href="css/mypage.css">

</head>
<header>
  <h1>編集</h1>
</header>
<body>
  <div align="center">
    <table border="0">
      <form action="mypage.html" method="get">
        <tr>
          <th>名前：</th>
          <td><input type="text" name="myname" value="" size="24"></td>
        </tr>
        <tr>
          <th>使用言語：</th>
          <td><input type="text" name="mycode" value="" size="24"></td>
        </tr>
        <tr>
          <th>コメント：</th>
          <td><input type="text" name="mycomment" value="" size="24"></td>
        </tr>
        <tr>
          <td><input type="submit" value="編集を完了する"></td>
        </tr>
      </form>
    </table>
  </div>
</body>
</html>
