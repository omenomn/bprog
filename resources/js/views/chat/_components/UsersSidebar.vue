<template>
  <nav id="sidebar" class="">
		<div class="sidebar-header">
      <div id="dismiss" class="">
        <font-awesome-icon 
          icon="arrow-left"/>
      </div>
		  <h3 v-if="user">{{ user.name.capitalize() }}</h3>
		</div>
		<ul class="list-unstyled components text-white">
		  <li v-for="(user, index) in users">
		    <a @click.prevent="open(user)" href="#">{{ user.name }} <span v-if="user.unread_messages > 0" class="badge badge-warning ">{{ user.unread_messages }}</span></a>
		  </li>
		</ul>
  </nav>
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';
  import {
    GET_USERS,
    CHECK_AUTH,
    GET_INTERLOCUTOR,
  } from './../../../store/types.js'

	export default {
		name: 'users-sidebar',
    mixins: [LocaleMixin],
    computed: {
      users() {
        return _.orderBy(this.$store.getters['users'], ['last_message'], ['asc'])
      },
    	user() {
        return this.$store.getters['auth/currentUser']
    	},
    },
    methods: {
    	open(interlocutor) {
        this.$store.dispatch('conversation/' + GET_INTERLOCUTOR, interlocutor)
    	},
    },
    mounted() {      
      $('#dismiss, .overlay').on('click', function () {
          $('#sidebar').removeClass('active');
          $('.overlay').removeClass('active');
      });

      this.$store.dispatch(GET_USERS)

      setInterval(() => {
        new Promise((resolve) => {
          this.$store.dispatch('auth/' + CHECK_AUTH)
          resolve()
        }).then(() => {
          if (this.$store.getters['auth/isAuthenticated']) {
            this.$store.dispatch(GET_USERS)
          }
        })
      }, 3000);
    }
	}
</script>