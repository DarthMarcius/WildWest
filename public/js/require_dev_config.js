require.config({
	baseUrl: siteRoot+"/js",
	paths: {
		"jquery": siteRoot+"/js/bower_components/jquery/dist/jquery",
		"underscore": siteRoot+"/js/bower_components/underscore/underscore",
		"backbone": siteRoot+"/js/bower_components/backbone/backbone",
		"bootstrap": siteRoot+"/js/bower_components/bootstrap/dist/js/bootstrap",
		"formValidations": siteRoot+"/js/custom/formValidations",
		
		"app": siteRoot+"/js/custom/app",	
		"models": siteRoot+"/js/custom/models",
		"collections": siteRoot+"/js/custom/collections",
		"helpers": siteRoot+"/js/custom/helpers",
		"views": siteRoot+"/js/custom/views",
	}
});
require(["app"]);