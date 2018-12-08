import JwtService from "./../common/jwt.service";

import {
  GET_MESSAGES_AND_USERS,
  GET_INTERLOCUTOR,
  SET_INTERLOCUTOR,
  SEND_MESSAGE,
  SET_MESSAGES,
  READ_MESSAGES,
} from './types.js'

const state = {
  interlocutor_id: null,
}

const getters = {
  messages(state, getters, rootState) {
    var interlocutor = getters.interlocutor

    return (interlocutor != undefined ? interlocutor.messages : [])
  }, 
  interlocutor(state, getters, rootState) {

    var user = _.find(rootState.users_online, function(obj) {
      return obj.id === state.interlocutor_id;
    })

    return (user != undefined ? user : null)
  },   
}

const actions = {
  [GET_INTERLOCUTOR] ({ commit, state, getters, rootGetters }, interlocutorId) {
    commit(SET_INTERLOCUTOR, interlocutorId)
  },
  [SEND_MESSAGE] ({ commit, state, getters, rootGetters, dispatch  }, message) {
    return axios.post('/api/interlocutor/' + getters.interlocutor.id + '/messages', {
        message: message,
      })
      .then(({data}) => {
      })
      .catch(({response}) => {
        if (response.status == 422) {
          toastr.error(response.data.errors.message.capitalize())
        } else {
          console.log(response)
        }
      })
  },
  [READ_MESSAGES] ({ commit, state, getters, rootGetters, dispatch  }, message) {
    return axios.post('/api/interlocutor/' + getters.interlocutor.id + '/messages/read', {
        _method: 'PATCH',
      })
      .then(({data}) => {
      })
      .catch(({response}) => {
        console.log(response)
      })
  },
}

const mutations = {
  [SET_INTERLOCUTOR] (state, interlocutorId) {
    state.interlocutor_id = interlocutorId
  },
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}