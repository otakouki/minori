<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/vs.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
<script>
  hljs.initHighlightingOnLoad();
</script>
<link rel="stylesheet" href="css/main.css">

<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_CHARSET', 'utf8');

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
$result = $link->query('select c.Title,u.name,c.pass from content c, users u where c.user_id = u.userid and c.range_id = 1');
if (!$result) {
  $sql_error = $link->error;
  echo 'select failed.<br>';
  error_log($sql_error);
  die($sql_error);
} else {
  echo "select success!<br>";
}

//データ一覧
$i = 0;
while ($data = mysqli_fetch_array($result)) {
  $i = $i + 1;
  echo $data['Title'] . ':' . $data['name'];

?>
  <!-- 折りたたみ展開ボタン -->
  <div onclick="obj=document.getElementById('menu<?php echo $i; ?>').style; obj.display=(obj.display=='none')?'block':'none';">
    <a style="cursor:pointer;">▼ クリックで展開</a>
  </div>
  <!--// 折りたたみ展開ボタン -->

  <!-- ここから先を折りたたむ -->
  <div id="menu<?php echo $i; ?>" style="display:none;clear:both;">
    <code class="language-php">
      <pre>
<div class="overflow-div">
    <?php
    $filename = $data['pass'];
    // ファイルを読み込み専用でオープンする
    $fp = fopen($filename, 'r');
    // 終端に達するまでループ
    while (!feof($fp)) {
      // ファイルから一行読み込む

      $line = fgets($fp);
      $line = htmlspecialchars($line);
      // 読み込んだ行を出力する
      echo $line . '<br>';
    }
    // ファイルをクローズする
    fclose($fp);
    ?>
	</code>
    </pre>
      <button id="button<?php echo $i; ?>" value="<?php echo $data["pass"]; ?>">表示</button>
      <div><br></div>
      <div id="result<?php echo $i; ?>"></div>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

      <script>
        // jQuery
        $(function() {
          $("#button<?php echo $i; ?>").click(function(event) {
            $.ajax({
                type: "GET",
                url: "<?php echo $data['pass']; ?>",
                dataType: "html"
              })
              // Ajaxリクエストが成功した場合
              .done(function(data) {
                $("#result<?php echo $i; ?>").html(data);
              })
              // Ajaxリクエストが失敗した場合
              .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
              });
          });
        });
        // 
      </script>


  </div>
<?php
}
