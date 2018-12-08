<template>
  <div class="wrapper">
  	<users-sidebar></users-sidebar>
    <div class="container-fluid">      
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <users-sidebar-toggle></users-sidebar-toggle>
          <button 
            @click="logout()"
            class="btn btn-danger">
            <font-awesome-icon 
              icon="sign-out-alt"/>
            {{ lang.get('messages.logout').capitalize() }}
          </button>
        </div>
      </nav>
      <div class="row mb-0">
        <div class="col-md-12 pl-0 pr-0">
          <messages 
            :interlocutor="interlocutor"></messages>  
        </div>  
      </div>
      <div 
        class="row mb-0">
        <div class="col-md-12 pl-0 pr-0">
          <message-field
            v-if="interlocutor"></message-field>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import UsersSidebar from './_components/UsersSidebar';
  import UsersSidebarToggle from './_components/UsersSidebarToggle';
  import Messages from './_components/Messages';
  import MessageField from './_components/MessageField';
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
      MessageField,
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
    },
    mounted() {
      var self = this
      setInterval(function() { 
        self.$store.dispatch(ONLINE)
      }, 5000);
    }
	}
</script>