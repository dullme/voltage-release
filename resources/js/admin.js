/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('project-create', require('./components/project/CreateProjectComponent').default);
Vue.component('project-typical-create', require('./components/project/CreateProjectTypicalComponent').default);
