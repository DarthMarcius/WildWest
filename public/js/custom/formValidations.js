define(["jquery"], function($) {
	var formValidations = function() {
		
	}

	formValidations.prototype = {
		init: function() {
			this.registrationListeners();
		},
		registrationListeners: function() {
			console.log("hi")
		}
	}
	formValidations();
})