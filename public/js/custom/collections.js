define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	
	App.Collections.Users = Backbone.Collection.extend({
		model: App.Models.User
	});
	
	require(["views"]);
			
});