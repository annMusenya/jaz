<div class="col-lg-3">
    <div class="card bg-hover-gradient-blue">
        <div class="content d-flex flex-column justify-content-between p-4">
            <h3 class="mb-5"><i class="fab fa-cc-paypal"></i></h3>
            <div class="d-flex justify-content-between align-items-end">
                <div class="text-uppercase">
                    <div class="h6 text-sm">
                        @php
                            $payment_status = $order->payment_status;
                            switch($payment_status){
                                case 0:
                                    echo "Unpaid";
                                break;
                                case 1:
                                    echo "Paid";
                            }    
                        @endphp
                    </div>
                </div>
                <h4 class="mb-0">{{'$'.$order->price_amount}}</h4>
            </div>
        </div>
    </div>
</div>