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
		time: "8h",
		data: [
			{
				time: "17-11",
				issues: [
					{
						id: "id-1",
						name: "name-1",
						logwork: "3h",
						comment: "comment-1",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/subtask_alternate.png"
					},
					{
						id: "id-2",
						name: "name-2",
						logwork: "1h",
						comment: "comment-2",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/task.png"
					}
				]
			},	
			{
				time: "18-11",
				issues: [
					{
						id: "id-3",
						name: "name-1",
						logwork: "3h",
						comment: "comment-1",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/bug.png"
					},
					{
						id: "id-4",
						name: "name-2",
						logwork: "1h",
						comment: "comment-2",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/subtask_alternate.png"
					}
				]
			},
			{
				time: "19-11",
				issues: [
					{
						id: "id-5",
						name: "name-1",
						logwork: "3h",
						comment: "comment-1",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/bug.png"
					},
					{
						id: "id-6",
						name: "name-2",
						logwork: "1h",
						comment: "comment-2",
						icon: "https://dev.osf-global.com/jira/images/icons/issuetypes/task.png"
					}
				]
			},				
		]
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
			this.$el.append("<tr class='row_dropdown'><td colspan='8'><table class='table'><tbody></tbody></table></td></tr>");
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
			new App.Views.UserDetails();
			new App.Views.DaysTable();
		}

	});
	
	App.Views.UserDetails = Backbone.View.extend({
	
		el: $("#users-detail-table"),
		
		template: _.template(
			'<tr><td>Summary for <span><%= name %></span> <span><%= surname%></span></td></tr>'
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
	
	App.Views.IssueItem = Backbone.View.extend({
	
		tagName: "tr",
		
		template: _.template(
			'<td class="issue_name"><img src="<%= icon %>" width="16" height="16"/> <%= id %>  <%= name %></td>\
			<td class="issue_worklog"><%= logwork %></td>\
			<td class="issue_comment"><%= comment %></td>'
		),
	
		render: function () {
			this.$el.html( this.template(this.model.toJSON()) );
			return this;
		}

	});
	
	App.Views.DaysTable = Backbone.View.extend({
	
		el: $("#users-detail-table"),
		
		initialize: function () {
			this.collection = new App.Collections.Issues( user.data );
			this.render();
		},
		
		template: _.template(
			'<tr><td class="issue_row" colspawn=3><table id="<%= time %>" class="day_table table">\
				<tbody><tr><td class="date"><%= time %></td></tr></tbody>\
			</table></td></tr>'
		),
		
		render: function () {
			var that = this, issueView, arr, id, $table;
			_.each(this.collection.models, function (item) {
				arr = item.get("issues"),
				id = "#"+item.get("time"),
				$table = $("<table class='table'></table>");
				this.$el.append( this.template(item.toJSON()) );
				for (var i=0; i<arr.length; i++) {
					issueView = new App.Views.IssueItem({
						model: new App.Models.Issue(arr[i])
					});
					$table.append(issueView.render().el);
					$(id).append($table);
				}				
			}, this);
		},
				
	});
	
	new App.Views.UsersTable();
	
	require(["helpers"]);
		
});