<?php

namespace App\Http\Controllers;

use Auth;
use App\Orders;
use App\Payments;
use Illuminate\Http\Request;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;
use Redirect;

class SkrillPayment extends Controller
{
    
    public function create(Request $request)
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $userName = $userDetails['name'];
        $userEmail = $userDetails['email'];
        $userTimezone = $userDetails['country'];
        $priceTotal = $request['price_amount'];

        // Check additional cost options

        if ($request->hasFile('instructions_file')){
            $filenameWithExt = $request->file('instructions_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('instructions_file')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        } else {
            $fileNameToStore = 'no-file';
        }

        if($request['writer_sources']){
            $sources = 1;
        }else{
            $sources = 0;
        }
 
        if($request['writer_samples']){
            $samples = 1; 
        }else{
            $samples = 0;
        }

        if($request['progressive_delivery']){
            $progressive = 1;
        }else{
            $progressive = 0;
        }

        // Create a new order entry on the database

        Orders::create([
            'customer_id' => Auth::id(),
            'customer_name' => $userName,
            'customer_email' => $userEmail,
            'paper_type' => $request['paper_type'],
            'academic_level' => $request['academic_level'],
            'word_spacing' => $request['word_spacing'],
            'pages' => $request['pages'],
            'writer_category' => $request['writer'],
            'deadline_period' => $request['deadline_period'],
            'timezone' => $userTimezone,
            'subject' => $request['subject'],
            'topic' => $request['topic'],
            'instructions' => $request['instructions'],
            'citation' => $request['citation'],
            'references' => $request['references'],
            'powerpoint' => $request['powerpoint_slides'],
            'charts' => $request['charts'],
            'sources' => $sources,
            'samples' => $samples,
            'progressive' => $progressive,
            'price_amount' => $request['price_amount'],
            'filename' => $fileNameToStore
        ]);

        return Redirect::to('/skrill-payment');

    }


    public function makePayment()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $latestOrder = Orders::where('customer_id',$userId)->where('payment_status',0)->latest()->first();        


        // Create object instance of SkrillRequest
        $request = new SkrillRequest();
        $request->transaction_id = $latestOrder->id; // generate transaction id
        $request->amount = $latestOrder->price_amount;
        $request->currency = 'USD';
        $request->language = 'EN';
        $request->prepare_only = '1';
        $request->merchant_fields = 'id,payment_status,amount_paid';
        $request->customer_email = $latestOrder->customer_email;
        $request->detail1_description = 'OrderID#';
        $request->detail1_text = $latestOrder->id;
        $request->detail2_description = 'Topic';
        $request->detail2_text = $latestOrder->topic;
        $request->detail3_description = 'Subject';
        $request->detail3_text = $latestOrder->subject;
        $request->detail4_description = 'Statement';
        $request->detail4_text = "Making payment to custom-written.com for a new paper order.";
        $request->trn_id = $latestOrder->id;

        // Create object instance of SkrillClient
        $client = new SkrillClient($request);
        $sid = $client->generateSID(); //return SESSION ID

        // handle error
        $jsonSID = json_decode($sid);
        if ($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
            return $jsonSID->message;

        // do the payment
        $redirectUrl = $client->paymentRedirectUrl($sid); //return redirect url
        return Redirect::to($redirectUrl); // redirect user to Skrill payment page
    }

    public function doRefund()
    {
        // Create object instance of SkrillRequest 
        $prepare_refund_request = new SkrillRequest();
        $prepare_refund_request->transaction_id = "MNPTTX0020";
        $prepare_refund_request->amount = $priceTotal;
        $prepare_refund_request->refund_note = 'We cannot fulfill your order';
        $payment->merchant_fields = "order_id,user_id,status";
        $prepare_refund_request->customer_email = $userEmail;

        // Prepare Refund Request
        $client_prepare_refund = new SkrillClient($prepare_refund_request);
        $refund_prepare_response = $client_prepare_refund->prepareRefund();

        // Refund Requests
        $refund_request = new SkrillRequest();
        $refund_request->sid = $refund_prepare_response;

        // Prepare Refund
        $client_refund = new SkrillClient($refund_request);
        $do_refund = $client_refund->doRefund();
        var_dump($do_refund);
    }

    public function ipn(Request $request)
    {
        // skrill data - get more fields from Skrill Quick Checkout Integration Guide 7.9 (page 23)
        $transaction_id = $request->input('transaction_id');
        $mb_transaction_id = $request->input('mb_transaction_id');
        $invoice_id = $request->input('invoice_id'); // custom field
        $order_from = $request->input('order_from'); // custom field
        $customer_email = $request->input('customer_email'); // custom field
        $biller_email = $request->input('pay_from_email');
        $customer_id = $request->input('customer_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $status = $request->input('status');

        // status message
        if ($status == '-2') {
            $status_message = 'Failed';
        } else if ($status == '2') {
            $status_message = 'Processed';
        } else if ($status == '0') {
            $status_message = 'Pending';
        } else if ($status == '-1') {
            $status_message = 'Cancelled';
        }
    }

    public function paymentCompleted()
    {
        return view("/");
    }

}
