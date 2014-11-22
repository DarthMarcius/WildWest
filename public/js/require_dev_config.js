require.config({
	baseUrl: "./js",
	paths: {
		"jquery": "bower_components/jquery/dist/jquery",
		"underscore": "bower_components/underscore/underscore",
		"backbone": "bower_components/backbone/backbone",
		"bootstrap": "bower_components/bootstrap/dist/js/bootstrap",
		"app": "custom/app",	
		"models": "custom/models",
		"collections": "custom/collections",
		"helpers": "custom/helpers",
		"views": "custom/views",
	}
});
require(["app"]);