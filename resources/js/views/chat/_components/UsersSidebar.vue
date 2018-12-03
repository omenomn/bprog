<template>
  <nav id="sidebar" class="">
		<div class="sidebar-header">
      <div id="dismiss" class="">
        <font-awesome-icon 
          icon="arrow-left"/>
      </div>
		  <h3>{{ lang.get('messages.users').capitalize() }}</h3>
		</div>
		<ul class="list-unstyled components text-white">
		  <li v-for="(user, index) in users">
		    <a @click.prevent="open(user.id)" href="#">{{ user.login }} <span v-if="user.unread_messages > 0" class="badge badge-warning ">{{ user.unread_messages }}</span></a>
		  </li>
		</ul>
  </nav>
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';

	export default {
		name: 'users-sidebar',
    mixins: [LocaleMixin],
    computed: {
    	users() {
        return _.orderBy(this.$store.getters['usersOnline'], ['last_message'], ['desc'])
    	}
    },
    methods: {
    	open(id) {
    		console.log(id)
    	},
    },
    mounted() {      
      $('#dismiss, .overlay').on('click', function () {
          $('#sidebar').removeClass('active');
          $('.overlay').removeClass('active');
      });
    }
	}
</script>