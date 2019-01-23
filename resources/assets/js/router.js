import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/tasks'
        },
        {
            path: '/tasks',
            component: require('./components/tasks/TaskContainerComponent')
        }
    ]
});