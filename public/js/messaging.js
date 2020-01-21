(function ($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#customer-message-btn').click(function(e){
            e.preventDefault();
            let id = $("input[name='order_id']").val();
            $.ajax({
                url: "/post-message/"+id,
                method: "post",
                dataType: "json",
                data: $("#c-post-msg").serialize(),
                beforeSend: function(){
                    $(this).html('<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>');
                },
                complete: function(){
                    $(this).html('Send');
                },
                success: function(response){
                    if(response["success"]){
                        $("#create-message").modal('hide');
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
                        
                    }
                }   
            });

        });
        
        function customMessage()
        {
            let recipient = $("select[name='recipient']").val();
            if(recipient == "customer"){
                $("textarea[name='message']").val("Dear Customer,\n\nWriter your message here...\n\nKind regards,\n\nAssigned Writer.");
            }else{
                $("textarea[name='message']").val("Dear Support,\n\nWriter your message here...\n\nKind regards,\n\nAssigned Writer.");
            }
        }
        customMessage();

        $("select[name='recipient']").change(function(){
            customMessage();
        });

    });
})(jQuery);