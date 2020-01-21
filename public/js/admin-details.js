	(function ($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".deliverIntent,.approveIntent").css('cursor','pointer');

        let orderId = $("input[name='order_id']").val();
        let writerId = $("input[name='writer_id']").val();
        let path = window.location.pathname;
        let deadline = $("input[name='deadline']").val();
        let currTime = moment().valueOf();
        let difference = deadline - currTime;
        let duration = moment.duration(difference);
        
        $('#deadline').text(duration.days()+ "d " + duration.hours() + "hrs " + duration.minutes() + "m ");

        $(".acceptIntent").click(function(){
            let id = $(this).attr("id");
            $.ajax({
                url: "/writer/accept/"+id,
                method: "patch",
                dataType: "json",
                success:function(response){
                    if(response["success"] == true){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $(".rejectIntent").click(function(){
            let id = $(this).attr("id");
            $.ajax({
                url: "/writer/reject/"+id,
                method: "patch",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $(".doneIntent").click(function(){
            let id = $(this).attr("id");
            $.ajax({
                url: "/writer/done/"+id,
                method: "post",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $(".approveIntent").click(function(){
            let id = $(this).attr("id");
            $.ajax({
                url: "/customer/approve/"+id,
                method: "patch",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $(".deliverIntent").click(function(){
            let id = $(this).attr("id");
            $.ajax({
                url: "/order/deliver/"+id,
                method: "patch",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try again later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $("button.ask-payment").click(function(){
            let id = $(this).attr("id");
            $.confirm({
                title: '<strong class="h5">Send Email Notification</strong>',
                content: 'Send an email notification requesting the customer to pay for the order. The email will contain a payment link, for PayPal.',
                autoClose: 'cancelAction|10000',
                escapeKey: 'cancelAction',
                buttons: {
                    confirm: {
                        btnClass: 'btn-danger', 
                        text: 'Confirm',
                        action: function () {
                            $.ajax({
                                url: "/request-pay/"+id,
                                method: "post",
                                dataType: "json",
                                success:function(response){
                                    if("success"){
                                        $.alert('<div class="h5 text-success">Email Sent.</div><span class="text-muted">The customer shall receive an email notifying them to pay for the order.</span>');
                                    }else{
                                        $.alert('<div class="h6 text-warning">Email Not Sent.</div><span class="text-muted">Some error has occured while sending the email. Try again later.</span>');
                                    }
                                    
                                }
                            });
                        }
                    },
                    cancelAction: {
                        btnClass: 'btn-dark',
                        text: 'Cancel',
                        action: function () {
                            $.alert('<span class="text-muted"><div class="h4 text-danger">Email Not Sent.</div> Perhaps you can call the customer instead. Btw, click the client details section to get contact details of the client.</span>');
                        }
                    }
                }
            });
        });

        $(".activate-bidding").click(function(e){
            e.preventDefault(); 
            let id = $(this).attr("id");
            $.ajax({
                url: "/order/activate-bidding/"+id,
                method: "patch",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });

        $(".cancel-btn").click(function(e){
            let id = $(this).attr("id");
            $.ajax({
                url: "/cancel/"+id,
                method: "post",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });  
        
        $(".restore-btn").click(function(e){
            e.preventDefault();
            let id = $(this).attr("id");

            $.ajax({
                url: "/restore/"+id,
                method: "post",
                dataType: "json",
                success:function(response){
                    if(response["success"]){
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
                        new Noty({
                            text: "<div class='roundy'><strong>Error occurred. Try later!</strong></div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                        }).show();
                    }
                }
            });
        });
    });
})(jQuery);