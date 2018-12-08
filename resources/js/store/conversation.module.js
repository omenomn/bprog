import JwtService from "./../common/jwt.service";

import {
  GET_MESSAGES,
  GET_INTERLOCUTOR,
  SET_INTERLOCUTOR,
  SEND_MESSAGE,
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
  [GET_MESSAGES] ({ commit, state, getters, rootGetters }, interlocutor) {
  },
  [GET_INTERLOCUTOR] ({ commit, state, getters, rootGetters }, interlocutor) {
    commit(SET_INTERLOCUTOR, interlocutor)
  },
  [SEND_MESSAGE] ({ commit, state, getters, rootGetters }, message) {
    return axios.post('/api/interlocutor/' + getters.interlocutor.id + '/messages', {
        message: message,
      })
      .then(({data}) => {
      })
      .catch(({response}) => {
        context.commit(SET_ERRORS, response.data.errors)
      })
  },
}

const mutations = {
  [SET_INTERLOCUTOR] (state, interlocutor) {
    state.interlocutor = interlocutor
  },
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}