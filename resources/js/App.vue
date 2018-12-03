<template>
  <div>
    <nav 
      class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/"><h3 class="mb-0 mt-0"><span class="badge badge-primary">Chat</span></h3></a>
      <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarNavAltMarkup" 
        aria-controls="navbarNavAltMarkup" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div 
        class="collapse navbar-collapse " 
        id="navbarNavAltMarkup">
        <div 
          class="navbar-nav ml-auto">
        </div>
      </div>
    </nav>
    <div class="container">
      <div>
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s
  }
  .fade-enter, .fade-leave-active {
    opacity: 0
  }
</style>

<script>
  
  export default {
    computed: {
    },
    methods: {
    },
    mounted() {
    }
  }
</script>
