(function ($) {
    $(document).ready(function() {
        $('#pending-table,#active-table,#clients-table,#cancelled-table,#done-table,#delivered-table,#revision-table,#finished-table,#bidding-table,#payments-table,#bids-table').css("width","100%");
        $('#pending-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "25%", "targets": 0},
                {"width": "25%", "targets": 1},
                {"width": "20%", "targets": 2},
                {"width": "10%", "targets": 3},
                {"width": "15%", "targets": 4},
                {"width": "2.5%", "targets": 5},
                {"width": "2.5%", "targets": 6}
              ]
        });

        $('#clients-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });

        $('#payments-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1},
                {"width": "20%", "targets": 2},
                {"width": "10%", "targets": 3},
                {"width": "15%", "targets": 4},
                {"width": "2.5%", "targets": 5},
                {"width": "2.5%", "targets": 6}
              ]
        });

        $('#active-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1},
                {"width": "20%", "targets": 2},
                {"width": "10%", "targets": 3},
                {"width": "15%", "targets": 4},
                {"width": "2.5%", "targets": 5},
                {"width": "2.5%", "targets": 6}
              ]
        });

        $('#cancelled-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1},
                {"width": "20%", "targets": 2},
                {"width": "10%", "targets": 3},
                {"width": "15%", "targets": 4},
                {"width": "2.5%", "targets": 5},
                {"width": "2.5%", "targets": 6}
              ]
        });

        $('#done-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $('#delivered-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $('#revision-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $('#finished-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "20%", "targets": 0},
                {"width": "30%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $('#bidding-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "10%", "targets": 0},
                {"width": "40%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "15%", "targets": 4,"orderable":false},
                {"width": "2.5%", "targets": 5,"orderable":false},
                {"width": "2.5%", "targets": 6,"orderable":false}
              ]
        });

        $('#bids-table').DataTable({
            "initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "30%", "targets": 0},
                {"width": "20%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "20%", "targets": 4,"orderable":false}
              ]
        });
		
	    $("#client-table").DataTable({
			"initComplete": function () {
                $('.dataTables_wrapper select').select2({
                    minimumResultsForSearch: Infinity
                });
            },
            "columnDefs": [
                {"width": "30%", "targets": 0},
                {"width": "20%", "targets": 1,"orderable":false},
                {"width": "20%", "targets": 2,"orderable":false},
                {"width": "10%", "targets": 3,"orderable":false},
                {"width": "20%", "targets": 4,"orderable":false}
            ] 
		});
		 
        $("td.deadline").each(function(){
            let id = this.id;
            let deadline = $('tr#'+id).find("td#"+id).children('input[name="deadline"]').val();
            let currTime = moment().valueOf();
            let difference = deadline - currTime;
            let duration = moment.duration(difference);
            return $("tr#"+id).find('.deadline-countdown').text(duration.days()+ "d " + duration.hours() + "hrs " + duration.minutes() + "m ");
        });
    });
})(jQuery);