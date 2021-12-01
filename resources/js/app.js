/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import { Form } from "vform";

import swal from "sweetalert2";

window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

window.toast = toast;

window.Form = Form;

Vue.component("users-index", require("./components/UsersIndex.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));

const app = new Vue({
    el: "#app",
});
