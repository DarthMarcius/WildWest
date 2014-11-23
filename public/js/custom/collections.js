define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	var users = [];
	
	$.ajax({
		type: "GET",
		url: "http://hack/jira/ajaxshowCountedLogs",
        success: function(data) {
			var i= 0, date;
			for (var key in data) {
				users.push({
					userId: ++i,
					userName: key,
					worklogs: []
				});
				for (var log in data[key].worklogs) {
					users[users.length-1].worklogs.push(data[key].worklogs[log]);
				}
			}
			App.Collections.users = new App.Collections.Users(users);
			App.Views.usersTable = new App.Views.UsersTable({collection: App.Collections.users});
			console.log(App.Collections.users.toJSON());
		}
	});
	
	App.Collections.Users = Backbone.Collection.extend({
		
		model: App.Models.User,
				
	});
	
	App.Collections.Issues = Backbone.Collection.extend({
		model: App.Models.Issue
	});
	
	App.Collections.users = new App.Collections.Users();
			
	require(["views"]);
			
			
});