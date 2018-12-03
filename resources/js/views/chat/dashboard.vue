<template>
  <div class="wrapper">
  	<users-sidebar></users-sidebar>
    <div class="container-fluid">      
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <users-sidebar-toggle></users-sidebar-toggle>
          <button class="btn btn-danger">
            <font-awesome-icon 
              icon="sign-out-alt"/>
            {{ lang.get('messages.logout').capitalize() }}
          </button>
        </div>
      </nav>
      <div class="row mb-0">
        <div class="col-md-12 pl-0 pr-0">
          <messages></messages>  
        </div>  
      </div>
      <div class="row mb-0">
        <div class="col-md-12 pl-0 pr-0">
          <div class="input-group mb-0">
            <input 
              class="form-control form-control-lg message-input" 
              type="text" 
              :placeholder="lang.get('messages.message').capitalize()">  
            <div class="input-group-append">
              <button 
                class="btn btn-outline-secondary" 
                type="button" 
                id="button-addon2">
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

	export default {
    name: 'dashboard',		
    components: {
      UsersSidebar,
    	Messages,
      UsersSidebarToggle,
    },
    mixins: [LocaleMixin],
	}
</script>