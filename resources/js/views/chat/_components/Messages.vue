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
    <div 
      v-if="interlocutor"
      class="card-footer">
      <div 
        class="input-group mb-0">
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
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';
  import {
    GET_MESSAGES,
    READ_MESSAGES,
  } from './../../../store/types.js'

	export default {
		name: 'messages',
    mixins: [LocaleMixin],
    props: ['interlocutor'],
    watch: {
    		messages(messages) {
    			var notReadMessages = _.filter(messages, function(o) { return !o.is_read; });

    			if (notReadMessages.length > 0) {
    				this.$store.dispatch('conversation/' + READ_MESSAGES)
    			}
    		}
    },
    computed: {     
      messages() {
        return this.$store.getters['conversation/messages']
      },
    },
    methods: {
    },
    mounted() {

    }
	}
</script>