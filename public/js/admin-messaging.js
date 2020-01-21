(function ($) {
    $(document).ready(function() {
        
        function customMessage()
        {
            let recipient = $("select[name='recipient']").val();
            if(recipient == "customer"){
                $("textarea[name='message']").val("Dear Customer,\n\nWriter your message here...\n\nKind regards,\n\nSupport Team.");
            }else if(recipient == "writer"){
                $("textarea[name='message']").val("Dear Writer,\n\nWriter your message here...\n\nKind regards,\n\nSupport Team.");
            }else{
                $("textarea[name='message']").val("Dear All,\n\nWriter your message here...\n\nKind regards,\n\nSupport Team.");
            }
        }
        customMessage();

        $("select[name='recipient']").change(function(){
            customMessage();
        });

    });
})(jQuery);