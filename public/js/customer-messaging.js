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

                        if(response["subject"]){
                            $('.subject-error').removeClass('hidden');
                            $('.subject-error').html(response["subject"]);
                        }

                        $("input[name='subject']").on('input',function(){
                            $('.subject-error').addClass('hidden');
                        });

                        if(response["message"]){
                            $('.message-error').removeClass('hidden');
                            $('.message-error').html(reponse["message"]);
                        }
                    }
                }   
            });
        });
        
        function customMessage()
        {
            let recipient = $("select[name='recipient']").val();
            if(recipient == "support"){
                $("textarea[name='message']").val("Dear Support,\n\nWriter your message here...\n\nKind regards,\n\nCustomer.");
            }else if(recipient == "writer"){
                $("textarea[name='message']").val("Dear Writer,\n\nWriter your message here...\n\nKind regards,\n\nCustomer.");
            }else{
                $("textarea[name='message']").val("Dear All,\n\nWriter your message here...\n\nKind regards,\n\nCustomer.");
            }
        }
        customMessage();

        $("select[name='recipient']").change(function(){
            customMessage();
        });

    });
})(jQuery);