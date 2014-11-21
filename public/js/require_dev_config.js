require.config({
	baseUrl: "./js",
	paths: {
		"jquery": "bower_components/jquery/dist/jquery",
		"underscore": "bower_components/underscore/underscore",
		"backbone": "bower_components/backbone/backbone",
		"bootstrap": "bower_components/bootstrap/dist/js/bootstrap",
		"app": "custom/app",
		"helpers": "custom/helpers",
		"models": "custom/models",
		"views": "custom/views",
		"collections": "custom/collections",

		"test": "custom/models/test"

	}
})
require(["app"])