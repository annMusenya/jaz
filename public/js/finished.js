(function ($) {
    $(document).ready(function() {
        $('#customer-pending,#customer-active,#customer-cancelled,#customer-delivered,#customer-revision,#customer-finished').css("width","100%");
        $('#customer-finished').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0,"orderable":false},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $("td.deadline").each(function(){
            let id = this.id;
            let deadline = $('tr#'+id).find("td#"+id).children('input[name="deadline"]').val();
            let currTime = moment().valueOf();
            let difference = deadline - currTime;
            let duration = moment.duration(difference);
            
            return $("tr#"+id).find('.deadline-countdown').html(duration.days()+ "d " + duration.hours() + "hrs " + duration.minutes() + "m ");
        });

    });
})(jQuery);