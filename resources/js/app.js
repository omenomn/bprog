require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex)

import VueRouter from 'vue-router';

Vue.use(VueRouter);

window.toastr = require('toastr');

toastr.options.closeButton = true;
toastr.options.closeDuration = 10;

import { library } from '@fortawesome/fontawesome-svg-core'
import { faAlignLeft } from '@fortawesome/free-solid-svg-icons'
import { faAlignJustify } from '@fortawesome/free-solid-svg-icons'
import { faSignOutAlt } from '@fortawesome/free-solid-svg-icons'
import { faShareSquare } from '@fortawesome/free-solid-svg-icons'
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { faSpinner } from '@fortawesome/free-solid-svg-icons'
import { faCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faAlignLeft)
library.add(faAlignJustify)
library.add(faSignOutAlt)
library.add(faShareSquare)
library.add(faArrowLeft)
library.add(faSpinner)
library.add(faCircle)

Vue.component('font-awesome-icon', FontAwesomeIcon)

import store from './store/index'

import App from './App.vue';
import Login from './views/chat/login.vue';
import Dashboard from './views/chat/dashboard.vue';
import DateRanges from './views/date_ranges/index.vue';

import {
  CHECK_AUTH,
} from './store/types.js'

const routes = [
	{
	  name: 'login',
	  path: '/login', 
	  component: Login,
	  beforeEnter: function (to, from, next) {
	  	if (!store.getters['auth/isAuthenticated']) {
	  		next()
	  	} else {
	  		next('/')
	  	}
		}
	},
	{
	  name: 'date-ranges',
	  path: '/date-ranges', 
	  component: DateRanges,
	},
	{
	  name: 'dashboard',
	  path: '/', 
	  component: Dashboard,
	  beforeEnter: function (to, from, next) {
	  	if (store.getters['auth/isAuthenticated']) {
	  		next()
	  	} else {
	  		next('/login')
	  	}
		}
	},
]
const router = new VueRouter({ mode: 'history', routes: routes});

router.beforeEach((to, from, next) =>
  Promise.all([store.dispatch('auth/' + CHECK_AUTH)]).then(next)
);

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
