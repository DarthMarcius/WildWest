define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	App.Helpers.template = function(id) {
		return _.template($("#" + id).html());
	}
})