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

        $('.password-modal-btn').click(function(e){
            e.preventDefault();
            let userId = $(this).attr('id');
            $.ajax({
                url: "/reset-password/"+userId,
                method: "post",
                dataType: "json",
                data: $("form#customer-password").serialize(),
                success: function(response){
                    if(response["success"] == true){
                        $("#change-password").modal("toggle");
                        new Noty({
                            text: "<div class='roundy'>"+response["message"]+"</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                        setTimeout(function () {
                            window.location.href = "/logout";
                        }, 3000);
                    }else{
                        if("old-password"){
                            $(".password-error").removeClass("hidden");
                            $(".password-error").html("<strong>"+response["old-password"]+"</strong>");
                        } 
                        if("new-password"){
                            $(".new-password-error").removeClass("hidden");
                            $(".new-password-error").html("<strong>"+response["new-password"]+"</strong>");
                        }
                    }
                }

            });
        });
		
    });
})(jQuery);