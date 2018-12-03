<template>
  <div>
    <router-view></router-view>
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
