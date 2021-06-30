<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>メインページ</title>
</head>

<body>
    <input type="text" name="namae" size="40" maxlength="20">
    <input type="submit" value="検索">

    <div class="tab-wrap">
        <input id="TAB-01" type="radio" name="TAB" class="tab-switch" checked="checked" />
        <label class="tab-label" for="TAB-01">公開</label>
        <div class="tab-content">
            <?php include('./public.php'); ?>
        </div>
        <input id="TAB-02" type="radio" name="TAB" class="tab-switch" />
        <label class="tab-label" for="TAB-02">フォロー</label>
        <div class="tab-content">
            <?php include('./follow.php'); ?>
        </div>
        <input id="TAB-03" type="radio" name="TAB" class="tab-switch" />
        <label class="tab-label" for="TAB-03">グループ</label>
        <div class="tab-content">
            <?php include('./group.php'); ?>
        </div>
    </div>
</body>

</html>
