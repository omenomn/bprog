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
	  <div id="messages-card-body" class="card-body">
			<ul 
				v-if="interlocutor && messages.length > 0"
				class="messages-list-group">
			  <li 
			  	v-for="(message, index) in messages"
			  	:class="[message.css_class]"
			  	class="messages-list-group-item"><p>{{ message.message }}</p></li>
			</ul>
			<div v-else>{{ lang.get('messages.no_messages') }}</div>
	  </div>
	</div>
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';
  import {
    GET_MESSAGES,
    SCROLL_BOTTOM,
  } from './../../../store/types.js'

	export default {
		name: 'messages',
    mixins: [LocaleMixin],
    props: ['interlocutor'],
    watch: {
    	interlocutor(interlocutor) {
        this.getMessages()
    	},
      messages(newMessages, oldMessages) {
        if (newMessages.length != oldMessages.length) {
          this.$store.dispatch('conversation/' + SCROLL_BOTTOM)          
        }
      }
    },
    computed: {    	
      messages() {
      	return this.$store.getters['conversation/messages']
      }
    },
    methods: {
    	[GET_MESSAGES]() {
      	if (this.interlocutor) {
    			this.$store.dispatch('conversation/' + GET_MESSAGES)
      	}    		
    	}
    },
    mounted() {
    	this.getMessages()

      setInterval(() => {
    		this.getMessages()
      }, 1000);
    }
	}
</script>