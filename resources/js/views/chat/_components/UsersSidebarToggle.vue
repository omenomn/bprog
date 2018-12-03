<template>
  <button 
  	@click="toggle()"
  	type="button"
  	class="btn btn-info">
      <i class="fas fa-align-left"></i>
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