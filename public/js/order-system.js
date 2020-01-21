(function ($) {
    $(document).ready(function(){
    
       $("select[name='subject']").click(function(){
            let subject = $(this).val();
            let category = $(this).find('option:selected').closest('optgroup').attr('label');
            let academicLevel = $("select[name='academic_level']").val();
            
            if(academicLevel == "45" && (category == "Applied Sciences" || category == "Formal Sciences" || category == "Business and Management")){
                $.confirm({
                    title: '<strong>Discipline is inapplicable</strong>',
                    content: '<p class="text-sm">This discipline is inapplicable for the current academic level. Would you like to change level to Undergraduate (yrs. 1-2)?</p>',
                    type: 'primary',
                    buttons: {
                        confirm: {
                            text: 'OK',
                            btnClass: 'btn-primary',
                            action: function(){
                                $("select[name='academic_level']").val("46");
                            }
                        },
                        cancel: function () {
                        }
                    }
                });
            }

        });

    })
})(jQuery);