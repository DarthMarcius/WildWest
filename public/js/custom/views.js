define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	
	var users = [
		{"name": "name-1", "time": "8h"},
		{"name": "name-2", "time": "8h"},
		{"name": "name-3", "time": "8h"}, 
    ];
	
	App.Views.UsersTable = Backbone.View.extend({
	
		el: $("#users-table"),
		
		initialize: function () {
			this.collection = new App.Collections.Users( users );
			this.render();
		},
		
		render: function () {
			var that = this;
			_.each(this.collection.models, function (item) {
				that.renderUser(item);
			}, this);
		},

		renderUser: function (item) {
			var userView = new App.Views.UserItem({
				model: item
			});
			this.$el.append( userView.render().el);
		}
		
	});
	
	App.Views.UserItem = Backbone.View.extend({
	
		tagName: "tr",
		
		template: _.template(
			'<td><%= name %></td><td><%= time %></td>'
		),
	
		render: function () {
			this.$el.html( this.template(this.model.toJSON()) );
			return this;
		},

	});
	
	new App.Views.UsersTable();
	
	require(["helpers"]);
		
});