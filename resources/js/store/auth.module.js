const state = {
  errors: [],
  pending: false,
}

const getters = {
  errors (state) {
    return state.errors
  }, 
  pending (state) {
    return state.pending
  }, 
}

const actions = {
}

const mutations = {
  pendingToggle (state) {
    state.pending = !state.pending
  },
}

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters
}