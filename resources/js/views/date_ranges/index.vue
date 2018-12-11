<template>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card mt-3 mb-3">
				  <div class="card-body">
				    <h5 class="card-title">{{ lang.get('messages.create_range').capitalize() }}</h5>
					  <div class="form-group">
					    <label>{{ lang.get('messages.date_from').capitalize() }}</label>
					    <input type="text" class="form-control datepicker" :placeholder="lang.get('messages.date_from').capitalize()">
					  </div>
					  <div class="form-group">
					    <label>{{ lang.get('messages.date_to').capitalize() }}</label>
					    <input type="text" class="form-control datepicker" :placeholder="lang.get('messages.date_to').capitalize()">
					  </div>
					  <button class="btn btn-primary">{{ lang.get('messages.create').capitalize() }}</button>
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<ul class="list-group">
				  <li class="list-group-item">Cras justo odio</li>
				  <li class="list-group-item">Dapibus ac facilisis in</li>
				  <li class="list-group-item">Morbi leo risus</li>
				  <li class="list-group-item">Porta ac consectetur ac</li>
				  <li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
		</div>
	</div>
</template>
<script>
  import { LocaleMixin } from './../../mixin/locale.js';

	export default {
		name: 'date-ranges',
    mixins: [LocaleMixin],
	  data() {
	  	return {
	  		date_from: null,
	  		date_to: null,
	  	}
	  },
    mounted() {
    	$.getScript('https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js')
		  .done(function( script, textStatus ) {
		    	$('.datepicker').datepicker({
					    format: 'mm/dd/yyyy',
					    startDate: '-3d'
					});
		  })
    }
	}
</script>