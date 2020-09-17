/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.Form = Form;
window.Swal = Swal;
window.Toast = Toast;
import VueRouter from "vue-router";
import Vue from "vue";
import routes from "./routes";
import VueProgressBar from "vue-progressbar";
import { Form, HasError, AlertError } from "vform";
import Paginate from "vuejs-paginate";
import Swal from "sweetalert2";
import PassportClients from "./components/passport/Clients.vue";
import AuthorizedClients from "./components/passport/AuthorizedClients.vue";
import PersonalAccessTokens from "./components/passport/PersonalAccessTokens.vue";
import moment from "moment";
Vue.use(VueProgressBar, options);
Vue.use(VueRouter);

const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

const router = new VueRouter({
    routes,
    mode: "history"
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("paginate", Paginate);
Vue.component("passport-clients", PassportClients);
Vue.component("passport-authorized-clients", AuthorizedClients);
Vue.component("passport-personal-access-tokens", PersonalAccessTokens);

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router
});