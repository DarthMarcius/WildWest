require.config({
	baseUrl: "./js",
	paths: {
		"jquery": "bower_components/jquery/dist/jquery.min",
		"underscore": "bower_components/underscore/underscore-min",
		"backbone": "bower_components/backbone/backbone.min",
		"bootstrap": "bower_components/bootstrap/dist/js/bootstrap.min",
		"app": "custom/compressed/app.min",
		"helpers": "custom/compressed/helpers.min",
		"formValidations": "custom/compressed/formValidations",

		"models": "custom/compressed/models.min",
		"views": "custom/compressed/views.min",
		"collections": "custom/compressed/collections.min",
		//models
		
		//views
		
		//collections
	}
})
require(["app"])