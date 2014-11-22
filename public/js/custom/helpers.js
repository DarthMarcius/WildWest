define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	App.Helpers.template = function(id) {
		return _.template($("#" + id).html());
	};

	App.Helpers.validateInputLength = function($input) {
		if($input.val().length > 50) {
			return false;
		}else {
			if($input.val().length > 0) {
				return true;
			}
			
		}
	};

	App.Helpers.isValidNumber = function($input) {
		if(is_int($input.val())) {
			return true;
		}else {
			return false;
		}
	};
})