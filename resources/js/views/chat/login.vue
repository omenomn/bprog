<template>
	<div class="col-md-4 offset-md-4">
		<div class="card text-white bg-dark mt-5 mb-5">
	    <div class="card-body">
        <h3 class="card-title">{{ lang.get('messages.login_form').capitalize() }}</h3>
        <div class="row">
          <div class="col-md-12">
          	<form
          		v-on:submit.prevent="login(name)">
              <div class="form-group">
              	<label for="name">{{ lang.get('messages.name').capitalize() }}</label> 
              	<input 
              		type="text" 
                  name="name"
                  v-model="name"
                  :placeholder="lang.get('messages.name').capitalize()" 
              		class="form-control">           
                <div 
                  v-if="getErrorMessage('name')"
                  class="alert alert-danger mt-1 p-1" role="alert">
                  {{ getErrorMessage('name') }}
                </div>
              </div>
              <div class="form-group">
              	<recaptcha></recaptcha>     
                <div 
                  v-if="getErrorMessage('recaptcha')"
                  class="alert alert-danger mt-1 p-1" role="alert">
                  {{ getErrorMessage('recaptcha') }}
                </div>
              </div>
      				<button 
      					type="submit" 
      					class="btn btn-block btn-primary">
                  <font-awesome-icon 
                    v-if="pending"
                    icon="spinner" spin />
      						{{ lang.get('messages.login').capitalize() }}
      				</button>
            </form>
          </div>
        </div>
	    </div>
		</div>
	</div>
</template>
<script>	

  import Recaptcha from './_components/Recaptcha';
  import { LocaleMixin } from './../../mixin/locale.js';
  import { ErrorsMixin } from './../../mixin/errors.js';
  import {
    LOGIN,
  } from './../../store/types.js'

  export default {
    name: 'login',
    mixins: [LocaleMixin, ErrorsMixin],
    components: {
    	Recaptcha,
    },
    data: function() {
      return {
        name: null,
      }
    },
    computed: {
      errors() {
        return this.$store.getters['auth/errors'] 
      },
      pending() {
        return this.$store.getters['auth/pending'] 
      },
    },
    methods: {
      login: function(name) {
        var recaptcha = $('textarea[name="g-recaptcha-response"]').val()
        this.$store
          .dispatch('auth/' + LOGIN, { name, recaptcha })
          .then(() => { 
            this.$router.push({name: 'dashboard'})
          })
      },
    },
    mounted() {
    }
	}
</script>