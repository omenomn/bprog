require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex)

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import store from './store/index'

import App from './App.vue';
import Login from './views/chat/login.vue';
import Dashboard from './views/chat/dashboard.vue';

const routes = [
	{
	  name: 'login',
	  path: '/login', 
	  component: Login
	},
	{
	  name: 'dashboard',
	  path: '/', 
	  component: Dashboard
	},
]
const router = new VueRouter({ mode: 'history', routes: routes});

router.beforeEach()

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

console.log('??')

new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
