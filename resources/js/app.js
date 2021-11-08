import { Tooltip, Toast, Popover } from 'bootstrap';
const $ = require( "jquery" );
const hljs = require('highlight.js');

let currentLanguage = 'plaintext';
import 'highlight.js/styles/github.css';
import {CodeJar} from "codejar/codejar";

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(function(){
    if($('.editor').length > 0){
        const jar = CodeJar(document.querySelector('.editor'), hljs.highlightElement);
        hljs.listLanguages().forEach((language)=>{
            if(language === 'plaintext'){
                $('#language-input').append(`<option selected value="${language}">${language.capitalize()}</option>`);
            }else{
                $('#language-input').append(`<option value="${language}">${language.capitalize()}</option>`);
            }
        });

        $('#language-input').on('change',()=>{
            let value = $(this).find("option:selected").val();
            if(value !== '' && value !== undefined){
                $('.editor').removeClass('language-'+currentLanguage).addClass('language-'+value);
                currentLanguage = value;
                jar.updateCode(localStorage.getItem("code"))
            }
        });

        jar.onUpdate(code => {
            $('#paste-input').html(code);
            localStorage.setItem("code", code)
        })
    }
});
