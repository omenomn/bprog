import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import Lang from 'lang.js'
import messages from './../messages'

const lang = new Lang({ messages })

import auth from './auth.module'
import conversation from './conversation.module'

import {
  GET_USERS,
  SET_USERS,
} from './types.js'

export default new Vuex.Store({
	state: {
		lang: lang,
		usersOnline: [],
	},
	getters: {
	  lang (state) {
	    return state.lang
	  }, 
	  users (state) {
	    return state.usersOnline
	  }, 
	},
	actions: {
	  [GET_USERS] (context) {
      axios.get('/api/users')
        .then(({data}) => {
      		context.commit(SET_USERS, data.users)
        })
        .catch(({response}) => {
        	console.log(response)
        })
	  }
	},
	mutations: {
	  [SET_USERS] (state, users) {
	    state.usersOnline = users
	  },
	},
  modules: {
		auth,
		conversation,
  }
})