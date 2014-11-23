define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
		
	App.Models.User = Backbone.Model.extend({
		
		initialize: function() {
           this.parseName();
        },
		
		parseName: function() {
			this.set( {userName: this.get("userName").toLowerCase()} );
			if ( this.get("userName").indexOf(".") >= 0 ){
				var path = this.get("userName").split(".");
				this.set({userName: path[0] + " " + path[1]});
			}
		}
		
	});
	
	App.Models.UserLogs = Backbone.Model.extend();
	
	App.Models.Issue = Backbone.Model.extend();
	
	require(["collections"]);
	
});