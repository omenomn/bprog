<template>
  <div class="wrapper">
            <input 
              v-on:keyup.enter="send(message)"
              v-model="message"
              class="form-control form-control-lg message-input" 
              type="text">
  </div>
</template>
<script>
  import UsersSidebar from './_components/UsersSidebar';
  import UsersSidebarToggle from './_components/UsersSidebarToggle';
  import Messages from './_components/Messages';
  import { LocaleMixin } from './../../mixin/locale.js';
  import {
    LOGOUT,
    SEND_MESSAGE,
    ONLINE,
  } from './../../store/types.js'

	export default {
    name: 'dashboard',		
    components: {
      UsersSidebar,
    	Messages,
      UsersSidebarToggle,
    },
    data() {
      return {
        message: null,
      }
    },
    mixins: [LocaleMixin],
    computed: {
      interlocutor() {
        return this.$store.getters['conversation/interlocutor']
      },
    },
    methods: {
      logout() {
        this.$store.dispatch('auth/' + LOGOUT).then(
          this.$router.push({name: 'login'})
        )
      },
      send(message) {
        this.$store.dispatch('conversation/' + SEND_MESSAGE, message).then(() => {
          this.message = null
        })       
      }
    },
    mounted() {
      var self = this
      setInterval(function() { 
        self.$store.dispatch(ONLINE)
      }, 5000);
    }
	}
</script>