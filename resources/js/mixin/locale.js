export const LocaleMixin = {	
  computed: {
  	lang() {
  		return this.$store.state.lang
  	},
  },
}