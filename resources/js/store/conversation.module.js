import JwtService from "./../common/jwt.service";

import {
  GET_MESSAGES,
  GET_INTERLOCUTOR,
  SET_INTERLOCUTOR,
  SEND_MESSAGE,
  SET_MESSAGES,
  SCROLL_BOTTOM,
} from './types.js'

const state = {
  interlocutor: null,
  messages: [],
}

const getters = {
  interlocutor (state) {
    return state.interlocutor
  }, 
  messages (state) {
    return state.messages
  }, 
}

const actions = {
  [GET_MESSAGES] ({ commit, state, getters, rootGetters, dispatch }) {
    return axios.get('/api/interlocutor/' + getters.interlocutor.id + '/messages')
      .then(({data}) => {
        commit(SET_MESSAGES, data.messages)
      })
      .catch(({response}) => {
        console.log(response)
        //commit(SET_ERRORS, response.data.errors)
      })
  },
  [GET_INTERLOCUTOR] ({ commit, state, getters, rootGetters }, interlocutor) {
    commit(SET_INTERLOCUTOR, interlocutor)
  },
  [SEND_MESSAGE] ({ commit, state, getters, rootGetters, dispatch  }, message) {
    return axios.post('/api/interlocutor/' + getters.interlocutor.id + '/messages', {
        message: message,
      })
      .then(({data}) => {
        dispatch(GET_MESSAGES)
      })
      .catch(({response}) => {
        commit(SET_ERRORS, response.data.errors)
      })
  },
  [SCROLL_BOTTOM] () {
    setTimeout(function() {
      var height = $('#messages-card-body').prop('scrollHeight')
      $('#messages-card-body').scrollTop(height);
    }, 100);
  }
}

const mutations = {
  [SET_INTERLOCUTOR] (state, interlocutor) {
    state.interlocutor = interlocutor
  },
  [SET_MESSAGES] (state, messages) {
    state.messages = messages
  },
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}