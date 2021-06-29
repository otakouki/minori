{
    'use strict'

    class Form {

        constructor(el){
            this.el = el;
            this.initialize();
        }
        
        initialize(){

        }

        value(){
            this.el.value;
        }

    }

    window.Form = Form;
}