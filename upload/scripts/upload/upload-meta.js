{
    'use strict'

    class UploadMeta {

        constructor(attrs) {
            this.attrs = attrs;
            this.meta = {};
            this.initialize();
        }

        initialize() {
            for (const element in this.attrs) {
                const el = document.querySelector(element);

                this.attrs[element].forEach(i => {
                    const name = i.name;
                    const type = i.type;
                    const classList = i.classList;
                    this.create(el, name, type, classList);
                });
            }
        }

        create(el, name, type, classList) {
            const upload_meta_title = document.createElement('div');
            upload_meta_title.classList.add('upload-meta-title');
            upload_meta_title.textContent = name;
            el.appendChild(upload_meta_title);

            const upload_meta_value = document.createElement('div');
            upload_meta_value.classList.add('upload-meta-value');
            el.appendChild(upload_meta_value);

            switch (type) {
                case 'text':
                    const input_text = new InputText(type);
                    input_text.class(classList);
                    upload_meta_value.appendChild(input_text.element());
                    this.meta[name] = input_text.value();
                    break;
                case 'radio':
                    const input_radio = new InputRadio(type);
                    input_radio.class(classList);
                    upload_meta_value.appendChild(input_radio.element());
                    this.meta[name] = input_radio.value();
                    break;
            }
        }

        value(name) {
            return this.meta[name];
        }

    }

    window.UploadMeta = UploadMeta;

    class Input {
        constructor(type) {
            console.log(type);
            this.initialize(type);
        }

        initialize(type) {
            this.el = document.createElement('input');
            if (type)
                this.el.type = type;
        }

        element() {
            return this.el;
        }

        class(classList) {
            this.el.classList.add(classList);
        }
    }

    class InputText extends Input {

        value() {
            return this.el.value;
        }

    }

    class InputRadio extends Input {

        initialize() {
            this.el = document.createElement('div');
            this.el.classList('upload-file-meta-radio');
        }

    }
}