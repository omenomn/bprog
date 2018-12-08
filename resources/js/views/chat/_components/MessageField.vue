<template>
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
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';
  import {
    SEND_MESSAGE,
  } from './../../../store/types.js'

	export default {
		name: 'message-field',
    mixins: [LocaleMixin],
    data() {
    	return {
    		message: null,
    	}
    },
    methods: {    	
      send(message) {
        this.$store.dispatch('conversation/' + SEND_MESSAGE, message).then(() => {
          this.message = null
        })       
      }
    }
	}
</script>