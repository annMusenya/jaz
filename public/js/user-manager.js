(function ($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

		$("button.suspend-user").click(function(){
            let userId = $("input[name='user_id']").val();
            $.ajax({
                url: "/suspend-user/"+userId,
                method: "post",
                beforeSend: function(){
                    $(this).html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
                },
                complete: function(){
                    $(this).html("Suspend");
                },
                success: function(response){
                    if(response["success"]){
                        new Noty({
                            text: "<div class='roundy'>"+response["message"]+"</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }else{
                        new Noty({
                            text: "<div class='roundy'>An error has occurred while suspending this user account.</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });


        $("button.restore-user").click(function(){
            let userId = $("input[name='user_id']").val();
            $.ajax({
                url: "/restore-user/"+userId,
                method: "post",
                beforeSend: function(){
                    $(this).html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
                },
                complete: function(){
                    $(this).html("Suspend");
                },
                success: function(response){
                    if(response["success"]){
                        new Noty({
                            text: "<div class='roundy'>"+response["message"]+"</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }else{
                        new Noty({
                            text: "<div class='roundy'>An error has occurred while restoring this user account.</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });
		
    });
})(jQuery);