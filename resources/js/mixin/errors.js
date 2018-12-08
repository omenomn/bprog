export const ErrorsMixin = {
	methods: {
    getErrorMessage(key) {
      var errors = this.errors

      if (errors.hasOwnProperty(key)) {
      	
      	var error = errors[key]

      	if (error != null) {
      		return error.capitalize()
      	}

        return error
      } 

      return null
    },
	}
}