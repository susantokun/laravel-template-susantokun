// Load plugins
import helper from "./helper";
import axios from "axios";
import * as Popper from "@popperjs/core";
import dom from "../dom";

// Set plugins globally
window.helper = helper;
window.axios = axios;
window.Popper = Popper;
window.$ = dom;

// CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.post['Content-Type'] ='application/json';
    window.axios.defaults.headers.post['Accept'] ='application/json';
    window.axios.defaults.withCredentials = true;
    window.axios.defaults.headers.common = {
        'X-CSRF-TOKEN': token.content,
        'X-Requested-With': 'XMLHttpRequest'
    };
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}
