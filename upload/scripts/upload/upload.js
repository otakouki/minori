{
    'use strict'

    class UploadModel {

        constructor(attr) {
            this.attr = {
                title: attr.title,      // タイトル
                dbExp: attr.dbExp,      // データベースエクスポート (未実装)
                public: attr.public,    // 公開範囲 (true: パブリック, false: プライベート)
            };

            // ファイル登録用
            this.files = [];

            // オブザーバーイベント定義
            this.listeners = {
                set: [],
                upload: []
            };
        }

        // オブザーバー登録
        on(event, func) {
            this.listeners[event].push(func);
        }

        // オブザーバー呼び出し
        trigger(event, files) {
            this.listeners[event].forEach(func => {
                func(files);
            });
        }

        // ファイル登録
        set(files) {
            for (const i of files) {
                this.files.push(i);
            }
            this.trigger('set', this.files);
        }

        // ファイルアップロード
        upload() {
            console.log(`タイトル: ${this.attr.title.value}`);

            this.files.forEach(file => {
                const form_data = new FormData();
                form_data.append('file', file);

                const xhr = new XMLHttpRequest();
                xhr.open('post', '/api/upload');

                xhr.onload = e => {
                    const target = e.target;

                    if (target.readyStatus !== 4 && target.status !== 200) {
                        console.error('Response Error!');
                        return -1;
                    }

                    const response = target.responseText;
                    console.log(response);
                    window.alert('アップロードが完了しました。');
                }

                // プログレス
                xhr.onprogress = e => {
                    console.log(e.loaded);
                }

                xhr.send(form_data);
            });
        }

        // コメント抜き出し機能 (不具合あり)
        fileCommentParse(index) {
            this.commnet = {

            };
            const reader = new FileReader();

            reader.onload = function () {
                const s = reader.result.split('\n');
                let start = 0;
                let end = 0;
                for (let i = 0, len = s.length; i < len; i++) {
                    if (s[i].trim().startsWith('//')) {
                        console.log(`一行のコメント: ${s[i]}`);
                        const el = document.createElement('div');
                        el.textContent = `${i}行目: ${s[i]}`;
                        document.querySelector('.commnet').appendChild(el);
                    } else if (s[i].trim().startsWith('/*')) {
                        start = i;
                        for (let j = i + 1, j_len = s.length; j < j_len; j++) {
                            if (s[j].trim().startsWith('*/')) {
                                end = j + 1;
                            }
                        }
                        for (let j = start, j_len = end; j < j_len; j++) {
                            console.log(`複数行のコメント: ${s[j]}`);
                            const el = document.createElement('div');
                            el.textContent = `${j}行目: ${s[j]}`;
                            document.querySelector('.commnet').appendChild(el);
                        }
                    }
                }
            }

            reader.readAsText(this.files[index]);
        }

    }

    class UploadView {

        constructor(el) {
            this.el = el;
            //this.files = el.files;
            this.initialize();

            this.cnt = 0;
        }

        // 初期化
        initialize() {
            this.from = new Form();

            this.input = this.el.querySelector('.upload-file-input');
            this.submit = this.el.querySelector('.upload-submit-button');

            const obj = {
                title: this.el.querySelector('.upload-meta-value-input'),
                dbExp: null,
                public: true
            }
            this.model = new UploadModel(obj);
            this.handleEvents();
        }

        // イベントハンドル
        handleEvents() {
            this.input.addEventListener('change', e => {
                console.log(e);
                const files = e.target.files;
                this.model.set(files);
            }, false);

            // ドロップ&ドラッグ (未実装)
            this.input.addEventListener('dragover', e => {
                e.preventDefault();
            }, false);

            this.input.addEventListener('dragleave', e => {
                e.preventDefault();
            }, false);

            // アップロードボタン
            this.submit.addEventListener('click', e => {
                e.preventDefault();
                this.model.upload();
            });

            // ファイルが選択された時
            this.model.on('set', files => {
                const test = document.querySelector('.upload-file-data-container');
                while (test.firstChild) test.removeChild(test.firstChild);
                
                for (const file of files) {
                    console.log(file);

                    const testel = document.createElement('div');
                    testel.classList.add('upload-file-data');

                    const test2el = document.createElement('div');
                    test2el.classList.add('upload-file-name');
                    test2el.textContent = file.name;

                    const test3el = document.createElement('div');
                    test3el.classList.add('upload-file-size');
                    test3el.textContent = file.size;

                    testel.appendChild(test2el);
                    testel.appendChild(test3el);

                    test.appendChild(testel);
                }
                

                return

                //const test = document.querySelector('.upload-file-name-container');
                const test2 = document.querySelector('.upload-file-size-container');

                const testel = document.createElement('div');
                testel.classList.add('upload-file-name');
                testel.textContent = this.input.files[0].name;
                const test2el = document.createElement('div');
                test2el.classList.add('upload-file-size');
                test2el.textContent = this.input.files[0].size;


                test.appendChild(testel);
                test2.appendChild(test2el);
                testel.style.cursor = 'pointer';
                test2el.style.cursor = 'pointer';
                testel.dataset.cnt = this.cnt;
                test2el.dataset.cnt = this.cnt;
                testel.addEventListener('click', e => {
                    const i = e.target.dataset.cnt;
                    this.model.fileCommentParse(i);
                });
                test2el.addEventListener('click', e => {
                    const i = e.target.dataset.cnt;
                    this.model.fileCommentParse(i);
                });

                this.cnt++;
            });
        }

    }

    window.UploadView = UploadView;
}