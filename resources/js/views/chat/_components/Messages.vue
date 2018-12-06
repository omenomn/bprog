<template>
	<div class="card messages-card">
	  <div 
			v-if="interlocutor"
			class="card-header">
	    {{ lang.get('messages.chat_with').capitalize() }} {{ interlocutor.name }}
	  </div>
    <div 
      class="card-header"
      v-else>{{ lang.get('messages.select_interlocutor').capitalize() }}</div>
	  <div class="card-body">
			<ul 
				v-if="interlocutor"
				class="messages-list-group">
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			</ul>
	  </div>
	</div>
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';

	export default {
		name: 'messages',
    mixins: [LocaleMixin],
    props: ['interlocutor'],
    watch: {
    	interlocutor(interlocutor) {
    		console.log(interlocutor.id)
    	},
    },
	}
</script>