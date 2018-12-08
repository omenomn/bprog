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
  ONLINE,
} from './types.js'

export default new Vuex.Store({
	state: {
		lang: lang,
		users_online: [],
	  messages: [],
	},
	getters: {
	  lang (state) {
	    return state.lang
	  }, 
	  users (state) {
	    return state.users_online
	  }, 
	},
	actions: {
	  [GET_USERS] (context) {
      axios.get('/api/users-with-messages')
        .then(({data}) => {
      		context.commit(SET_USERS, data.users)
        })
        .catch(({response}) => {
        	console.log(response)
        })
	  },
	  [ONLINE] (context) {
      axios.post('/api/online', {
      	_method: 'PATCH',
      })
      .then(({data}) => {

      })
      .catch(({response}) => {
      	console.log(response)
      })
	  }
	},
	mutations: {
	  [SET_USERS] (state, users) {
	    state.users_online = users
	  },
	},
  modules: {
		auth,
		conversation,
  }
})