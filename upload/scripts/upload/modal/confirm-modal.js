/*
 * 確認画面 (モーダルウインドウ)
 */

{
    'use strict'

    class ConfirmModal extends Modal {

        constructor() {
            super();
        }

        show() {
            super.show();

            const confirm_container = document.createElement('div');
            confirm_container.classList.add('modal-confirm-container');
            this.modal_content.appendChild(confirm_container);

            const confirm = document.createElement('div');
            confirm.classList.add('modal-confirm');
            confirm_container.appendChild(confirm);

            const confirm_title = document.createElement('div');
            confirm_title.classList.add('modal-confirm-title');
            confirm_title.textContent = 'アップロードしますか?';
            confirm.appendChild(confirm_title);

            const confirm_yes = document.createElement('button');
            confirm_yes.classList.add('modal-confirm-yes');
            confirm_yes.textContent = 'はい';
            confirm.appendChild(confirm_yes);

            const confirm_no = document.createElement('button');
            confirm_no.classList.add('modal-confirm-no');
            confirm_no.textContent = 'いいえ';
            confirm.appendChild(confirm_no);

            confirm_yes.addEventListener('click', () => {
                super.hide();
                const modal = new UploadModal();
                modal.show();
            });

            confirm_no.addEventListener('click', () => {
                super.hide();
            });
        }

        hide() {
            super.hide();
        }

    }

    window.ConfirmModal = ConfirmModal;
}