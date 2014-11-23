require.config({
	baseUrl: siteRoot+"/js",
	paths: {
		"jquery": siteRoot+"/js/bower_components/jquery/dist/jquery.min",
		"underscore": siteRoot+"/js/bower_components/underscore/underscore-min",
		"backbone": siteRoot+"/js/bower_components/backbone/backbone.min",
		"bootstrap": siteRoot+"/js/bower_components/bootstrap/dist/js/bootstrap.min",
		"app": siteRoot+"/js/custom/compressed/app.min",
		"helpers": siteRoot+"/js/custom/compressed/helpers.min",
		"formValidations": siteRoot+"/js/custom/compressed/formValidations.min",

		"models": siteRoot+"/js/custom/compressed/models.min",
		"views": siteRoot+"/js/custom/compressed/views.min",
		"collections": siteRoot+"/js/custom/compressed/collections.min",
		//models
		
		//views
		
		//collections
	}
})
require(["app"])