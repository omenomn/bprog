import JwtService from "./../common/jwt.service";

import {
  PENDING_TOGGLE,
  PURGE_ERRORS,
  SET_ERRORS,
  SET_AUTH,
  SET_USER,
  PURGE_AUTH,
  CHECK_AUTH,
  LOGOUT,
  LOGIN,
} from './types.js'

const state = {
  errors: [],
  pending: false,
  user: null,
  isAuthenticated: !!JwtService.getToken()
}

const getters = {
  errors (state) {
    return state.errors
  }, 
  pending (state) {
    return state.pending
  }, 
  currentUser(state) {
    return state.user;
  },
  isAuthenticated(state) {
    return state.isAuthenticated;
  },
}

const actions = {
  [LOGIN] (context, credentials) {
    return new Promise((resolve) => {
      context.commit(PENDING_TOGGLE)
      context.commit(PURGE_ERRORS)

      axios.post('/api/user/login', credentials)
        .then(({data}) => {
          context.commit(SET_AUTH, data)
          resolve()
        })
        .catch(({response}) => {
          context.commit(SET_ERRORS, response.data.errors)
        })
        .then(() => {          
          grecaptcha.reset()
          context.commit(PENDING_TOGGLE)
        })
    })
  },
  [LOGOUT] (context) {
    return new Promise((resolve) => {
      context.commit(PURGE_AUTH)
      resolve()
    })
  },
  [CHECK_AUTH] (context) {
    if (JwtService.getToken()) {
      axios.defaults.headers.common["Authorization"] = 'Bearer ' + JwtService.getToken();
      axios.get('/api/user')
        .then(({data}) => {
          context.commit(SET_USER, data)
        })
        .catch(({response}) => {
          context.commit(PURGE_AUTH)
        })
    } else {
      context.commit(PURGE_AUTH);
    }
  },
}

const mutations = {
  [PENDING_TOGGLE] (state) {
    state.pending = !state.pending
  },
  [SET_ERRORS] (state, error) {
    state.errors = error
  },
  [SET_AUTH] (state, payload) {
    state.isAuthenticated = true;
    state.user = payload.user;
    state.errors = {};
    JwtService.saveToken(payload.token);
  },
  [SET_USER] (state, user) {
    state.isAuthenticated = true;
    state.user = user;
    state.errors = {};
  },
  [PURGE_AUTH] (state) {
    state.isAuthenticated = false
    state.user = null
    state.errors = {}
    JwtService.destroyToken()
  },
  [PURGE_ERRORS] (state) {
    state.errors = {}
  }
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}