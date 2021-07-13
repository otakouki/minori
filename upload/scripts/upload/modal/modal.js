/*
 * モーダルウインドウ
 */

{
    'use strict'

    class Modal {

        constructor(files) {
            this.files = files;
            this.click_event = this.onClick.bind(this);

            this.init();
        }

        init() {
            this.el = document.createElement('div');
            this.el.classList.add('modal-container');
            this.el.classList.add('modal-hide');

            const modal = document.createElement('div');
            modal.classList.add('modal');
            this.el.appendChild(modal);

            const modal_panel_container = document.createElement('div');
            modal_panel_container.classList.add('modal-panel-container');
            modal.appendChild(modal_panel_container);

            const modal_panel = document.createElement('div');
            modal_panel.classList.add('modal-panel');
            modal_panel_container.appendChild(modal_panel);

            this.modal_panel_close = document.createElement('div');
            this.modal_panel_close.classList.add('modal-panel-close');
            this.modal_panel_close.textContent = '閉じる';
            modal_panel.appendChild(this.modal_panel_close);

            modal.appendChild(modal_panel_container);

            this.modal_content = document.createElement('div');
            this.modal_content.classList.add('modal-content');
            modal.appendChild(this.modal_content);

            document.body.appendChild(this.el);

            this.modal_panel_close.addEventListener('click', () => {
                this.hide();
            });
        }

        show() {
            //this.el.addEventListener('click', this.click_event);
            this.el.classList.remove('modal-hide');
            document.body.classList.add('modal-show-body');
        }

        hide() {
            while (this.el.firstChild) this.el.removeChild(this.el.firstChild);
            //this.el.removeEventListener('click', this.click_event);
            this.el.classList.add('modal-hide');
            document.body.classList.remove('modal-show-body');
        }

        onClick(e) {
            this.hide();
        }

    }

    window.Modal = Modal;
}