(function ($) {
    $(document).ready(function() {
        
        $('#payments-table').css("width","100%");

        $('#payments-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0, "orderable":false},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

    });
})(jQuery);