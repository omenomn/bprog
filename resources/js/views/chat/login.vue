<template>
	<div class="col-md-6 offset-md-3">
		<div class="card text-white bg-dark mt-5 mb-5">
	    <div class="card-body">
        <h3 class="card-title">{{ lang.get('messages.login_form').capitalize() }}</h3>
        <div class="row">
          <div class="col-md-12">
          	<form
          		v-on:submit.prevent="login(email, password)">
              <div class="form-group">
              	<label for="email">{{ lang.get('messages.email').capitalize() }}</label> 
              	<input 
              		type="text" 
                  name="email"
                  v-model="email"
              		placeholder="email" 
              		class="form-control">           
                <div 
                  v-if="getErrorMessage('email')"
                  class="alert alert-danger mt-1 p-1" role="alert">
                  {{ getErrorMessage('email') }}
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

  export default {
    name: 'login',
    mixins: [LocaleMixin, ErrorsMixin],
    components: {
    	Recaptcha,
    },
    data: function() {
      return {
        email: null,
        password: null,
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
      login: function(email, password) {
      }
    },
    mounted() {
    }
	}
</script>