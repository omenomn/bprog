import Lang from 'lang.js'
import messages from './messages'

const lang = new Lang({ messages })

export default {
  install: function(Vue,) {
    Object.defineProperty(Vue.prototype, 'lang', { value: lang });
  }
}