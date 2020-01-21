(function ($) {
    $(document).ready(function(){
       $("input[name='phone']").intlTelInput({
           nationalMode: true,
           preferredCountries: [ "us", "gb","Au","Ca" ],
		   initialCountry: "auto",
			geoIpLookup: function(callback) {
			$.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
			var countryCode = (resp && resp.country) ? resp.country : "";
			callback(countryCode);
    });
  },
       });
	
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });

       $('.reveal-text').click(function(){
        $(".reveal-text").toggleClass("show hide");
        $(".reveal-text").text("hide");
        let input = $("#password");
        if(input.attr("type") == "password"){
            input.attr("type","text");
        }else{
            input.attr("type","password");
            $(".reveal-text").text("show"); 
        }
        });	

       function countryCode(){
            let countryData = $("input[name='phone']").intlTelInput("getSelectedCountryData");
            let countryName = countryData.name;
            
            return $("input[name='country']").val(countryName);
       }
       countryCode();

       $("input[name='phone']").on("countrychange",function(){
           countryCode();
       });

       $("#register-btn").click(function(e){
           e.preventDefault();
            $.ajax({
                url: "/admin/register",
                method: "POST",
                dataType: "json",
                data: $("#admin-register-form").serialize(),
                success: function(response){
                    if(response == "success"){

                        alert("success");

                    }else{
                        if(response["name"]){
                            $("#name-error").html("*"+response["name"]);
                        }
                        if(response["email"]){
                            $("#email-error").html("*"+response["email"]);
                        }
                        if(response["phone"]){
                            $("#phone-error").html("*"+response["phone"]);
                        }
                        if(response["password"]){
                            $("#password-error").html("*"+response["password"]);
                        }

                    }
                }
        });

       $("input[name='customCheck1']").click(function(){
            alert("click");
       });

       });
    })
})(jQuery);