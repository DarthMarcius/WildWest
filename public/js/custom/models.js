define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
		
	App.Models.User = Backbone.Model.extend();
	App.Models.Issue = Backbone.Model.extend();
	
	require(["collections"]);
	
});