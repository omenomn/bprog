<template>
	<div class="card messages-card">
	  <div class="card-header">
	    {{ lang.get('messages.chat_with').capitalize() }} Johnson
	  </div>
	  <div class="card-body">
			<ul class="messages-list-group">
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item sent"><p>What are your choices when someone puts a gun to your head?</p></li>
			  <li class="messages-list-group-item replies"><p>What are your choices when someone puts a gun to your head?</p></li>
			</ul>
	  </div>
	</div>
</template>
<script>
  import { LocaleMixin } from './../../../mixin/locale.js';

	export default {
		name: 'messages',
    mixins: [LocaleMixin],
	}
</script>