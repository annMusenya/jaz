(function ($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } 
        });
        function textArea(event){
            let x = event.keyCode;
            let res;

            if(x == 13)
            {
                res="<br>" + document.getElementById("text-message").value + "<br>";
            }

            return $("textarea[name='message']").val(res);
        }
        
        textArea(event);
    });
})(jQuery);