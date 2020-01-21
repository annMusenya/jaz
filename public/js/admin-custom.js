(function ($) {
    $(document).ready(function() {
        $('#document-datatable').bootstrapTable({
           "scrollY": "200px",
			"scrollCollapse": true,
        });

        $('#subject-datatable').bootstrapTable({
           "scrollY": "200px",
			"scrollCollapse": true,
        });

        $('#deadline-datatable').bootstrapTable({
           "scrollY": "200px",
			"scrollCollapse": true,
        });

        // Change deadline label input depending on the selected academic level

        function deadlineLabel(){
            let academicLevel = $("#academic-level").val();

            switch (academicLevel){
                case "High School":
                    $("input[name='label']").val(45);
                break;
                case "Undergraduate (Years 1-2)":
                    $("input[name='label']").val(46);
                break;
                case "Undergraduate (Years 3-4)":
                    $("input[name='label']").val(47);
                break;
                case "Masters":
                    $("input[name='label']").val(48);
                break;
                case "Doctoral":
                    $("input[name='label']").val(49);
            }
        }
        deadlineLabel();

        $("#academic-level").change(function(){
            deadlineLabel();
        });

    });
})(jQuery);