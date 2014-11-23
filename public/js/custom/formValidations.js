define(["jquery"], function($) {
	var formValidations = function() {
		formValidations.prototype.init();
	}

	formValidations.prototype = {
		init: function() {
			this.registrationListeners();
		},
		registrationListeners: function() {
			this.loginListeners();
			this.notificateUsers();
			
		},

		notificateUsers: function() {
			var $modal = $("#notifications-modal");
			$("#jira-send-emails").click(function() {
				$.ajax({
					url: "/notificate-users",
					type : "GET",
					success: function() {
						$modal.find(".modal-body").html("Emails were sent");
						$modal.modal({
							keyboard: true
						})
					},
					error: function() {
						$modal.find(".modal-body").html("Something went wrong");
						$modal.modal({
							keyboard: true
						})
					}
				});
			});
	
		},
		
		loginListeners: function() {
			var $loginForm = $("#form-login"),
				$userName = $("#user-name-input"),
				$password = $("#password"),
                $Modal = $(".modal");
            setTimeout(function() {
                if($("#password-reminder-form").length) {
                	if($Modal.find(".modal-body b").html() == "Your username or password is invalid. Please try another one.") {
                		return
                	}
                }
                if($("#jira-send-emails").length) {
                	return
                }
                if($Modal.length) {
                    $Modal.modal({
                        keyboard: true
                    });
                }
            }, 200);
				
			

			$userName.focus(function(ev) {
				$loginForm.find("*").tooltip("destroy");
				if($(ev.target).closest(".form-group").hasClass("has-error")) {
					$(ev.target).closest(".form-group").removeClass("has-error");
					if(!App.Helpers.validateInputLength($(ev.target))) {
						$(ev.target).tooltip({
							'trigger':'manual',
							"title" : "User name need to have at least one letter, but no more than 50."
						});
						$(ev.target).tooltip("show");
					}
				}
			});

			$userName.blur(function(ev) {
				if(!App.Helpers.validateInputLength($(ev.target))) {
					$(ev.target).closest(".form-group").addClass("has-error");
				}
				
			});

			$password.focus(function(ev) {
				$loginForm.find("*").tooltip("destroy");
				if($(ev.target).closest(".form-group").hasClass("has-error")) {
					$(ev.target).closest(".form-group").removeClass("has-error");
					if(!App.Helpers.validateInputLength($(ev.target))) {
						$(ev.target).tooltip({
							'trigger':'manual',
							"title" : "Password need to have at least one letter, but no more than 50."
						});
						$(ev.target).tooltip("show");
					}
				}
			});

			$password.blur(function(ev) {
				if(!App.Helpers.validateInputLength($(ev.target))) {
					$(ev.target).closest(".form-group").addClass("has-error");
				}
				
			});
			
			$loginForm.on("submit", function(ev) {
				if($loginForm.find(".form-group").hasClass("has-error")) {
					ev.preventDefault();
					$($loginForm.find(".has-error input")[0]).focus();
				}	
			});
				
			
		},
		


	}
	formValidations();
})