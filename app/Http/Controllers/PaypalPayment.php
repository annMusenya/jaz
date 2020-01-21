<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth; use App\User;
use App\Notifications\OrderPlaced;
use App\Orders; use App\Payments; use App\Files;
use Validator;
use URL;
use Session;
use Redirect;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Presentation;

class PaypalPayment extends Controller
{

    /*
    *  Initialize new Paypal API Context
    */

    public function __construct()
    {
        // Paypal API Context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential
        (
            $paypal_conf['client_id'],
            $paypal_conf['secret']
        )
    );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
    *  Create a new payment request
    *  @param Request $request 
    */

    public function addPayment(Request $request,$id)
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $userName = $userDetails['name'];
        $userEmail = $userDetails['email'];

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        
        $item   ->setName($request->get('order_subject'))
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('amount'));

        $itemList = new itemList();
        $itemList -> setItems(array($item));

        $amount = new Amount();
        $amount ->setCurrency('USD')
                ->setTotal($request->get('amount'));
        
        $transaction = new Transaction();
        $transaction    ->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription("New Paper Order");
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls  -> setReturnUrl(URL::to('/success/'.$id))
                        -> setCancelUrl(URL::to('/orders/'.$id));

        $flowConfig = new \PayPal\Api\FlowConfig();
        $flowConfig->setLandingPageType("Billing");

        $presentation = new Presentation();
        $presentation -> setBrandName("Custom-Written.Com") -> setLocaleCode("US");

        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
        
        $webProfile = new WebProfile();
        $webProfile ->setName('custom-written.com' . uniqid())
                    ->setInputFields($inputFields)
                    ->setFlowConfig($flowConfig)
                    ->setPresentation($presentation)
                    ->setTemporary(true);
        $webProfileId = $webProfile->create($this->_api_context)->getId();
        
        // Initiate Payment

        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId);
        $payment    ->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

        try{
            
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if(\Config::get('app.debug')){

                \Session::put('error', 'Connection timeout');
                // Create a Patch request to update order payment status
                return Redirect::to('/');

            }else{

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }
        }

        // Check for Payment Approval

        foreach ($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect_url = $link->getHref();
                break;
            }
        }

        // Add payment ID to Session

        Session::put('paypal_payment_id', $payment->getId()); // Remember to Add this to the redirect page (Payments)

        if(isset($redirect_url)){
            
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Something went wrong');

        return Redirect::to('/');
    }

    /**
    *  Create a new payment request
    *  @param Request $request 
    */

    public function makePayment(Request $request)
    {     
        // User session details

        $userDetails = Auth::user();
        $userId = Auth::id();
        $userName = $userDetails['name'];
        $userEmail = $userDetails['email'];
        $userTimezone = $userDetails['country'];
        $priceTotal = $request['price_amount'];

        // Check additional cost options

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
        
        // Make Paypal Payment
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        
        $item   ->setName($request->get('topic'))
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('price_amount'));

        $itemList = new itemList();
        $itemList -> setItems(array($item));

        $amount = new Amount();
        $amount ->setCurrency('USD')
                ->setTotal($request->get('price_amount'));
        
        $transaction = new Transaction();
        $transaction    ->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription("New Paper Order");
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls  -> setReturnUrl(URL::to('/success'))
                        -> setCancelUrl(URL::to('/orders'));

        $flowConfig = new \PayPal\Api\FlowConfig();
        $flowConfig->setLandingPageType("Billing");

        $presentation = new Presentation();
        $presentation -> setBrandName("Custom-Written.Com") -> setLocaleCode("US");

        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
        
        $webProfile = new WebProfile();
        $webProfile ->setName('custom-written.com' . uniqid())
                    ->setInputFields($inputFields)
                    ->setFlowConfig($flowConfig)
                    ->setPresentation($presentation)
                    ->setTemporary(true);
        $webProfileId = $webProfile->create($this->_api_context)->getId();
        
        // Initiate Payment

        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId);
        $payment    ->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

        try{
            
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if(\Config::get('app.debug')){

                \Session::put('error','Connection timeout');
                return Redirect::to('/');

            }else{

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }
        }

        // Check for Payment Approval

        foreach ($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect_url = $link->getHref();
                break;
            }
        }

        // File Handling
		if($request->hasFile('file')){
			$files = count($_FILES['file']['name']);
			$fileArray = array();
			for($i=0;$i<$files;$i++){
				$file = $request->file('file')[$i];
				$filenameWithExt = $file->getClientOriginalName();
				$filesize = $file->getClientSize();
				$filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
				$extension = $file->getClientOriginalExtension();
				$fileNameToStore = $filename.'_'.time().'.'.$extension;
				
				array_push($fileArray,$fileNameToStore);
				
				$path = Storage::disk('public')->putFileAs('files',$file,$fileNameToStore);
		 
				Files::create([
                    'uploader_id' => $userId,
                    'uploader' => "customer",
					'order_id' => null,
					'display_name' => $filename,
					'filename' => $fileNameToStore,
					'filetype' => $extension,
					'filesize' => $filesize,
					'category' => 1, 
					'restriction' => 1,
					'path' => $path,
                    'description' => "Instructions/Guidelines",
                    'category' => 1,
				]);
			
                Storage::disk('public')->putFileAs('files',$file,$fileNameToStore);
                
			}
		}else{

            $fileArray = null;
            
		}
        

        // Create new Order with Payment ID 

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
            'writer_period' => $request['writer_deadline'],
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
            'writer_amount' => $request['writer_amount'],
            'filename' => json_encode($fileArray),
            'payment_id' => $payment->getId()
        ]);
        
        $adminEmail = User::where("category",1)->where('role','=','Administrator')->pluck("email")->first();

		$user = new User();
		$userDetails = Auth::user();
		$user->email = array($userDetails["email"],$adminEmail);
		$username = $userName;
		$arr = array("user" => $username);
		$user->notify(new OrderPlaced($arr));

        \Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)){
            
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Something went wrong');

        return Redirect::to('/');

    }

    public function getPaymentStatus(){

        $payment_id = Session::get('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            
            \Session::put('error', 'Payment failed');

            return Redirect::to('/orders');

        }else{

            $payment = Payment::get($payment_id, $this->_api_context);

            $execution = new PaymentExecution();
    
            $execution->setPayerId(Input::get('PayerID'));
    
            $result = $payment->execute($execution, $this->_api_context);
    
            if ($result->getState() == 'approved') {
    
                \Session::put('success', 'Payment successful');

                $order_amount = Orders::where('payment_id',$payment_id)->pluck('price_amount')->first();
                $amount_paid = Orders::where('payment_id',$payment_id)->pluck('amount_paid')->first();
                $order_id = Orders::where('payment_id',$payment_id)->pluck('id')->first();
                $userId = Auth::id();
                $userDetails = Auth::user();

                Orders::find($order_id)->update([
                    'payment_status' => 1,
                    'amount_paid' => $order_amount
                ]);
                
                Payments::create([
                    'payment_id' => $payment_id,
                    'order_id' => $order_id,
                    'user_id' => $userId,
                    'user_name' => $userDetails["name"],
                    'user_email' => $userDetails["email"],
                    'type' => 1,
                    'total_amount' => $order_amount,
                    'amount_paid' => $order_amount,
                    'means' => 'Paypal',
                    'confirmed' => 0,
                    'statement' => 'Order Payment for order #'.$order_id.' by : '.$userDetails["name"].'.',
                    'status' => 1
                ]);
				
				$user = new User();
				$userDetails = Auth::user();
				$user->email = $userDetails["email"]; 
				$username = $userDetails["name"];
				$arr = array("user" => $username,"id"=>$order_id);
				$user->notify(new OrderPlaced($arr));

                return Redirect::to('/orders/'.$order_id);
    
            }else{
                
                \Session::put('error', 'Payment failed');
                
                return Redirect::to('/orders/'.$order_id);
                
            }

        }

    }

    public function getPaymentStatusRepay($id){

        $payment_id = Session::get('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            
            \Session::put('error', 'Payment failed');

            return Redirect::to('/orders');

        }else{

            $payment = Payment::get($payment_id, $this->_api_context);

            $execution = new PaymentExecution();
    
            $execution->setPayerId(Input::get('PayerID'));
    
            $result = $payment->execute($execution, $this->_api_context);
    
            if ($result->getState() == 'approved') {
    
                \Session::put('success', 'Payment successful');

                $order_amount = Orders::where('id',$id)->pluck('price_amount')->first();

                Orders::find($id)->update([
                    'payment_status' => 1,
                    'amount_paid' => $order_amount
                ]);

                $userId = Auth::id();
                $userDetails = Auth::user();
                $amount_paid = Orders::where('id',$id)->pluck('amount_paid')->first();
                $amount_paid = Orders::where('payment_id',$payment_id)->pluck('amount_paid')->first();
                $order_id = Orders::where('payment_id',$payment_id)->pluck('id')->first();

                Payments::create([
                    'payment_id' => $payment_id,
                    'order_id' => $id,
                    'user_id' => $userId,
                    'user_name' => $userDetails["name"],
                    'user_email' => $userDetails["email"],
                    'type' => 1,
                    'total_amount' => $order_amount,
                    'amount_paid' => $order_amount,
                    'means' => 'Paypal',
                    'confirmed' => 0,
                    'statement' => 'Order Payment for order #'.$order_id.' by : '.$userDetails["name"].'.',
                    'status' => 1
                    ]);

                return Redirect::to('/orders/'.$id);
    
            }else{
                
                \Session::put('error', 'Payment failed');
				
                return Redirect::to('/orders/'.$id);
                
            }

        }

    }

}
