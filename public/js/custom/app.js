define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	window.App = {
		Helpers: {},
		Models: {},
		Collections: {},
		Views: {}
	};

	require(["helpers"]);
	require(["models"]);
	require(["views"]);
	require(["collections"]);
})