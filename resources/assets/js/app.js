
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/`;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('task-container-component', require('./components/tasks/TaskContainerComponent'));
Vue.component('form-task-component', require('./components/tasks/FormTaskComponent'));
Vue.component('task-component', require('./components/tasks/TaskComponent'));

const app = new Vue({
    el: '#app'
});
