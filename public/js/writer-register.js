(function ($) {
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $("input[name='phone']").intlTelInput({
           nationalMode: true,
           preferredCountries: [ "us", "gb","Au","Ca" ]
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

       $('#writers-table').css("width","100%");

        $('#writers-table').DataTable({
            
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });

        
    });
})(jQuery);