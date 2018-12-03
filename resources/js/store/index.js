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
		usersOnline: [
			{
				id: 1,
				login: 'Dandaj',
				unread_messages: 3,
				last_message: 1544035351,
			},
			{
				id: 2,
				login: 'Larry',
				unread_messages: 0,
				last_message: 1544035331,
			},
			{
				id: 3,
				login: 'Gimlie',
				unread_messages: 2,
				last_message: 1544032331,
			},
			{
				id: 4,
				login: 'Gimlie',
				unread_messages: 2,
				last_message: 1544035957,
			},
		],
	},
	getters: {
	  lang (state) {
	    return state.lang
	  }, 
	  usersOnline (state) {
	    return state.usersOnline
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