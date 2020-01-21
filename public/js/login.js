(function ($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

		$('.reveal-text').click(function(){
			$(this).toggleClass("show hide");
			$(".reveal-text").text("hide");
			let input = $("#password");
			if(input.attr("type") == "password"){
				input.attr("type","text");
			}else{
				input.attr("type","password");
				$(".reveal-text").text("show"); 
			}
        });	

        $('.reveal-text-modal').click(function(){
			$(this).toggleClass("show hide");
			$(".reveal-text-modal").text("hide");
			let input = $("#password");
			if(input.attr("type") == "password"){
				input.attr("type","text");
			}else{
				input.attr("type","password");
				$(".reveal-text-modal").text("show"); 
			}
        });	
		
        $('#customer-login-btn').click(function(e){
			e.preventDefault();
			$.ajax({
				url: "/login",
				method: "post", 
				dataType: "json",
				data: $("form#customer-login").serialize(),
				beforeSend: function(){
					$("#customer-login-btn").html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
				},
				complete: function(){
					$("#customer-login-btn").html('Login');
				},
				success: function(response){ 
					if(response["message"] == "success"){ 
						window.location.href="/";
					}else{
						
						if(response["email"] != undefined && response["email"] != ""){
							$(".email-error").removeClass("hidden");
							$(".email-error").html("<strong>"+response["email"]+"</strong>");
						}
						
						if(response["password"] != undefined && response["password"] != ""){ 
							$(".password-error").removeClass("hidden");
							$(".password-error").html("<strong>"+response["password"]+"</strong>");
						}
						
						if(response["credentials"] != undefined && response["credentials"] != ""){ 
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["credentials"]);
						}
						
						if(response["account"] != undefined){
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["account"]);
						}
						
						$("input[name='email']").on('input',function(){
							$(".email-error").addClass("hidden");
						});
						
						$("input[name='password']").on('input',function(){
							$(".password-error").addClass("hidden");
						});
						
						$("input[name='email'],input[name='password']").on('input',function(){
							$(".generic-error").addClass("hidden");
						});
					}
				}
			});
		});
		
		$("#writer-login-btn").click(function(e){
			e.preventDefault();
			$.ajax({
				url: "/writer/login",
				method: "post", 
				dataType: "json",
				data: $("form#writer-login").serialize(),
				beforeSend: function(){
					$("#writer-login-btn").html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
				},
				complete: function(){
					$("#writer-login-btn").html('Login');
				},
				success: function(response){ 
					if(response["message"] == "success"){ 
						window.location.href="/writer";
					}else{
						
						if(response["email"] != undefined && response["email"] != ""){
							$(".email-error").removeClass("hidden");
							$(".email-error").html("<strong>"+response["email"]+"</strong>");
						}
						
						if(response["password"] != undefined && response["password"] != ""){ 
							$(".password-error").removeClass("hidden");
							$(".password-error").html("<strong>"+response["password"]+"</strong>");
						}
						
						if(response["credentials"] != undefined && response["credentials"] != ""){ 
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["credentials"]);
						}
						
						if(response["account"] != undefined){
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["account"]);
						}
						
						$("input[name='email']").on('input',function(){
							$(".email-error").addClass("hidden");
						});
						
						$("input[name='password']").on('input',function(){
							$(".password-error").addClass("hidden");
						});
						
						$("input[name='email'],input[name='password']").on('input',function(){
							$(".generic-error").addClass("hidden");
						});
					}
				}
			});
		});
		
		
		$('#admin-login-btn').click(function(e){
			e.preventDefault();
			$.ajax({
				url: "/admin/login",
				method: "post", 
				dataType: "json",
				data: $("form#admin-login").serialize(),
				beforeSend: function(){
					$("#admin-login-btn").html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
				},
				complete: function(){
					$("#admin-login-btn").html('Login');
				},
				success: function(response){ 
					if(response["message"] == "success"){ 
						window.location.href="/admin";
					}else{
						
						if(response["email"] != undefined && response["email"] != ""){
							$(".email-error").removeClass("hidden");
							$(".email-error").html("<strong>"+response["email"]+"</strong>");
						}
						
						if(response["password"] != undefined && response["password"] != ""){ 
							$(".password-error").removeClass("hidden");
							$(".password-error").html("<strong>"+response["password"]+"</strong>");
						}
						
						if(response["credentials"] != undefined && response["credentials"] != ""){ 
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["credentials"]);
						}
						
						if(response["account"] != undefined){
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["account"]);
						}
						
						$("input[name='email']").on('input',function(){
							$(".email-error").addClass("hidden");
						});
						
						$("input[name='password']").on('input',function(){
							$(".password-error").addClass("hidden");
						});
						
						$("input[name='email'],input[name='password']").on('input',function(){
							$(".generic-error").addClass("hidden");
						});
					}
				}
			});
		});
		
		$('#login-modal-btn').click(function(e){
			e.preventDefault();
			$.ajax({
				url: "/login",
				method: "post", 
				dataType: "json",
				data: $("form#login-popup").serialize(),
				beforeSend: function(){
					$("#login-modal-btn").html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
				},
				complete: function(){
					$("#login-modal-btn").html('Login');
				},
				success: function(response){ 
					if(response["message"] == "success"){ 
						document.location.href="/";
					}else{
						
						if(response["email"] != undefined && response["email"] != ""){
							$(".email-error").removeClass("hidden");
							$(".email-error").html("<strong>"+response["email"]+"</strong>");
						}
						
						if(response["password"] != undefined && response["password"] != ""){ 
							$(".password-error").removeClass("hidden");
							$(".password-error").html("<strong>"+response["password"]+"</strong>");
						}
						
						if(response["credentials"] != undefined && response["credentials"] != ""){ 
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["credentials"]);
						}
						
						if(response["account"] != undefined){
							$(".generic-error").removeClass("hidden");
							$(".generic-error").html(response["account"]);
						}
						
						$("input[name='email']").on('input',function(){
							$(".email-error").addClass("hidden");
						});
						
						$("input[name='password']").on('input',function(){
							$(".password-error").addClass("hidden");
						});
						
						$("input[name='email'],input[name='password']").on('input',function(){
							$(".generic-error").addClass("hidden");
						});
					}
				}
			});
		});
		
		
    });
})(jQuery);