const upload_drop = document.querySelector('.upload-drop');

upload_drop.addEventListener('dragenter', e => {
    e.preventDefault();
});

upload_drop.addEventListener('dragover', e => {
    e.preventDefault();
});

upload_drop.addEventListener('drop', e => {
    e.preventDefault();

    // FileListオブジェクト
    const files = e.dataTransfer.files;
    // ドロップされたファイルのFileオブジェクト
    var file = files[0];
    if (!file) { return; }
    // ファイルのMIMEタイプをチェック
    //if (!file.type.match(/^image\//)) { return; }
    // FileReaderオブジェクト
    const reader = new FileReader();
    // Data URL形式でファイル・データを取得
    reader.readAsDataURL(file);
    // ファイルの読み取りが成功したときの処理
    reader.onload = () => {
        document.querySelector('.upload-drop-name').textContent = 'ファイル名: ' + file.name;
        document.querySelector('.upload-drop-size').textContent = 'ファイルサイズ: ' + file.size + ' Byte';
    };
});