define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	
	App.Collections.Users = Backbone.Collection.extend({
		model: App.Models.User
	});
	
	App.Collections.Issues = Backbone.Collection.extend({
		model: App.Models.Issue
	});
	
	require(["views"]);
			
});