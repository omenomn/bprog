import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import Lang from 'lang.js'
import messages from './../messages'

const lang = new Lang({ messages })

import auth from './auth.module'

export default new Vuex.Store({
	state: {
		lang: lang,
	},
	getters: {
	  lang (state) {
	    return state.lang
	  }, 
	},
	actions: {
	},
	mutations: {
	},
  modules: {
		auth,
  }
})