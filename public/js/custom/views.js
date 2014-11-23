define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
	
	(function(){
		var date = new Date();
		var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		var i = 0;
		if ( date.getDay() !== 0 ) {
			date.setDate( date.getDate() + ( 7 - date.getDay() ) );
		}
		$($("#users-table thead tr td").get().reverse()).each(function() {
			i++;
			$(this).attr("data-date", date.getDate() + "/" +  (date.getMonth() + 1) );
			$(this).html( week[date.getDay()] + " " + date.getDate() + "/" +  (date.getMonth() + 1) );
			date.setDate(date.getDate()-1);
		});
		$("#users-table thead .table_name").html("");
	}());
	
	App.Views.UsersTable = Backbone.View.extend({
	
		el: $("#users-table"),
		
		initialize: function () {
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
			userView.render();
			this.$el.append("<tr class='row_dropdown'><td colspan='8'><table class='table'><tbody></tbody></table></td></tr>");
		}
		
	});
	
	App.Views.UserItem = Backbone.View.extend({
	
		tagName: "tr",
		
		template: _.template(
			'<td class="table_name user_details" data-id="<%= userId %>"><%= userName %></td>\
			<td class="table_date mon"></td>\
			<td class="table_date tue"></td>\
			<td class="table_date wed"></td>\
			<td class="table_date thu"></td>\
			<td class="table_date fri"></td>\
			<td class="table_date sat"></td>\
			<td class="table_date sun"></td>'
		),
	
		render: function () {
			this.$el.html( this.template(this.model.toJSON()) );
			this.syncDates(this.$el);
			$("#users-table").append(this.el);
			_.each(this.model.get("worklogs"), function (item) {
				var date = new Date(item.logDate);
				var week = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
				var tr = $('[data-id="' + this.model.get("userId") + '"]').parent();
				var day = week[date.getDay()];
				date = date.getDate() + "/" +  (date.getMonth() + 1);
				$(tr).find('[data-date="' + date + '"]').html( this.parseTime(item.logTimeInSeconds) );
				//$(tr).find('.' +  week[date.getDay()]).html( this.parseTime(item.logTimeInSeconds) );
			}, this);
		},
		
		showDetails: function(e) {
			new App.Views.UserDetails({id: e.currentTarget});
			new App.Views.DaysTable({id: e.currentTarget});
		},
		
		parseTime: function(sec) {
			var h = Math.floor(sec / 3600), 
				m = Math.floor( ( sec - h*3600 ) / 60 );
			if ( h === 0) {
				return m + "m";
			} else {
				if ( Math.floor(h) !== h ) {
					return h + "h " + m + "m";
				}
				return h + "h";
			}
		},
		
		syncDates: function(el) {
			var date = new Date();
			var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
			var i = 0;
			if ( date.getDay() !== 0 ) {
				date.setDate( date.getDate() + ( 7 - date.getDay() ) );
			}
			$(el.find("td:not(.table_name)").get().reverse()).each(function() {
				i++;
				$(this).attr("data-date", date.getDate() + "/" +  (date.getMonth() + 1) );
				date.setDate(date.getDate()-1);
			});
		}
	});
	
	App.Views.UserDetails = Backbone.View.extend({
	
		el: $("#users-detail-table"),
		
		template: _.template(
			'<tr><td>Summary for <span><%= name %></span> <span><%= surname%></span></td></tr>'
		),
		
		initialize: function () {
			this.model = new App.Models.UserLogs( user );
			this.render();
		},
	
		render: function () {
			$(this.id).parent().next().find("table").html( $("#users-detail-table").html() );
			this.$el.html( this.template(this.model.toJSON()) );
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
			this.renderForMobile();
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
		
		renderForMobile: function() {
			var that = this, issueView, arr, tableId, $table;
			_.each(this.collection.models, function (item) {
				arr = item.get("issues"),
				tableId = "#"+item.get("time"),
				$table = $("<table class='table'></table>");
				$(this.id).parent().next().find("table:first").append( this.template(item.toJSON()) );
				for (var i=0; i<arr.length; i++) {
					issueView = new App.Views.IssueItem({
						model: new App.Models.Issue(arr[i])
					});
					$table.append(issueView.render().el);
					$(tableId).append($table);
				}				
			}, this);
		}
		
	});
	
	require(["helpers"]);
		
});