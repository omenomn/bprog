<template>
  <div class="wrapper">
  	<users-sidebar></users-sidebar>
    <div class="container-fluid">      
      <div 
        v-if="interlocutor"
        class="row mb-0">
        <div class="col-md-12 pl-0 pr-0">
          <div class="input-group mb-0">
            <input 
              v-on:keyup.enter="send(message)"
              v-model="message"
              class="form-control form-control-lg message-input" 
              type="text" 
              :placeholder="lang.get('messages.message').capitalize()">  
            <div class="input-group-append">
              <button 
                class="btn btn-outline-secondary" 
                type="button" 
                @click="send(message)">
                <font-awesome-icon 
                  icon="share-square"/>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
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