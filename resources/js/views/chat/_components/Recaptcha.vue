<template>
	<div class="g-recaptcha" 
     :data-sitekey="sitekey">
	</div>
</template>

<script>	
  export default {
    name: 'recaptcha',
    data: function() {
    	var sitekey = $('#recaptcha-sitekey-input').val()

    	return {
    		sitekey: sitekey
    	}
    },
    beforeDestroy: function() {
    },
    mounted: function() {
    	 $.getScript("//www.google.com/recaptcha/api.js?");
    },
	}
</script>