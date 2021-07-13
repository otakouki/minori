{
    'use strict'

    class UploadModal extends Modal {

        constructor(files) {
            super();
            this.listeners = {
                progress: []
            };
            this.files = files;
        }

        upload() {
            this.files.forEach(file => {
                this.test.textContent = file.name + ' アップロード準備中';

                const form_data = new FormData();
                form_data.append('file', file);

                let xhr = new XMLHttpRequest();
                xhr.open('post', 'api/upload');

                xhr.onload = e => {
                    xhr = null;
                    const target = e.target;

                    if (target.readyStatus !== 4 && target.status !== 200) {
                        console.error('Response Error!');
                        return -1;
                    }

                    const response = target.responseText;
                    console.log(response);
                    this.test.textContent = file.name + ' アップロードが完了しました。'
                }

                // プログレス
                xhr.onprogress = e => {
                    this.test.textContent = file.name + ' アップロード中 ' + (e.loaded / e.total * 100) + '% 完了';
                }

                xhr.send(form_data);

            });
        }

        show() {
            super.show();

            this.test = document.createElement('div');
            this.modal_content.appendChild(this.test);
            this.upload();
            console.log(this.modal_content);
        }

        hide() {
            super.hide();
        }

    }

    window.UploadModal = UploadModal;
}