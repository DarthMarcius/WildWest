define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	
	var users = [
		{"id": "1", "name": "name-1", "time": "8h"},
		{"id": "2", "name": "name-2", "time": "8h"},
		{"id": "3", "name": "name-3", "time": "8h"}, 
    ];
	
	var user = {
		id: "1", 
		name: "John",
		surname: "Smith",
		time: "8h"
	}; 
    
	
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
		
		events: {
			"click .user_details": "showDetails",
		},
		
		template: _.template(
			'<td class="table_name user_details" data-id="<%= id %>"><a ><%= name %></a></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>\
			<td class="table_date"><%= time %></td>'
		),
	
		render: function () {
			this.$el.html( this.template(this.model.toJSON()) );
			return this;
		},
		
		showDetails: function(e, id) {
			console.log(this.$el);
			console.log(e.currentTarget);
			new App.Views.UserDetails();
			//alert(id);
		}

	});
	
	App.Views.UserDetails = Backbone.View.extend({
	
		el: $("#users-detail-table"),
		
		template: _.template(
			'<tr><td>Summary for <span><%= name %></span> <span><%= surname%></span></td></tr>\
			<td>Details for:</td><td><%= name %></td>'
		),
		
		initialize: function () {
			this.model = new App.Models.User( user );
			this.render();
		},
	
		render: function () {
			this.$el.html( this.template(this.model.toJSON()) );
			return this;
		}

	});
	
	new App.Views.UsersTable();
	
	require(["helpers"]);
		
});