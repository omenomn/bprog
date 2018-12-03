<template>
  <button 
  	@click="toggle()"
  	type="button"
  	class="btn btn-warning">
      <font-awesome-icon 
        icon="align-left"/>
      <span>Toggle Sidebar</span>
  </button>
</template>
<script>
	export default {
		name: 'users-sidebar-toggle',
		methods: {
			toggle() {
				$('#sidebar').toggleClass('active');
			},
		},
		mounted() {
		}
	}
</script>