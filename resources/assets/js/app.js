/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router';
import App from './components/App';
import EventBus from './event-bus';
import CustomMixins from "./mixin";
import { fas } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('font-awesome-icon', FontAwesomeIcon);
library.add(fas);

Vue.use(Vuetify, {iconfont: 'faSvg'});
Vue.use(EventBus);

Vue.mixin(CustomMixins);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
