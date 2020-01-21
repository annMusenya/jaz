<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Academic; use App\Document; use App\Subjects; use App\Deadline; use App\Citation; 
use App\Additional; use App\Orders;use App\User; use App\Messages; use App\Files;
use App\Biddings; use App\Reviews; use App\Earnings;

class WriterController extends Controller
{
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
       $this->middleware('writer')->except('login','authenticateWriter');
    }  

     /**
     *  Authenticate Admin
     *  @param Request $request
     */

    public function authenticateWriter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','email'],
            'password' => ['required']
            ]);
    
            if ($validator->fails()){
                $emailError = $validator->errors()->get('email');
                $passwordError = $validator->errors()->get('password');
                
                return ["email" => $emailError,"password" => $passwordError];
    
            }else{
    
                $credentials = $request->only('email','password');
                $email = $request->input('email');
         
                $category = User::where('email',$email)->pluck('category')->first();
         
                if($category == 2){
                    if(Auth::guard('')->attempt($credentials)){
                         return ["message"=>"success"];
                    }else{
                        return ["credentials"=>"Wrong Email or Password"];
                    }
                }else{
                     return ["account"=>"You need a writer account to access."];
                }
    
            }
    }

    /**
     * Show login form.
     *
     * @return Resources/Views/Admin/Login
     */

    public function login()
    {
        return view('main/writer/writer-login');
    }

 
     /**
    * Logout out of a session.
    *
    * @return void
    */

    public function logout()
    {
        auth()->logout();
        return redirect('/writer/login');
    }

     /**
     * Show the main page.
     *
     * @return Resources/Views/Admin/Home
     */

     public function index()
     {
        /* 
        * Order Status 
        * Pending = 0 Active = 1 Cancelled = 2 Revision = 3 Delivered = 4 Done = 5 finished = 6 Disputed = 7 unassigned = 8
        */
        $userDetails = Auth::user();
        $userId = Auth::id();
        $orderCount = Orders::orderBy('id','DESC')->count();
		$bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();
        $documents = Document::all()->pluck("name");

        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-home',compact('userDetails','userId','availableOrders','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
    
    }

    
     /**
     * Show the Assigned Orders.
     *
     * @return Resources/Views/Writer/assigned
     */

     public function assigned()
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $activeOrders = Orders::orderBy('id','DESC')->where('order_status',1)->where('writer_id',$userId)->get();
        $activeCount = $activeOrders->count();
        $documents = Document::all()->pluck("name");
        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-active',compact('userDetails','userId','activeOrders','activeCount','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
     }

     /**
     * Show the Done Orders.
     *
     * @return Resources/Views/Writer/done
     */

     public function done()
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $doneOrders = Orders::orderBy('id','DESC')->where('order_status',5)->where('writer_id',$userId)->get();
        $doneCount = $doneOrders->count();
        $documents = Document::all()->pluck("name");

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-done',compact('userDetails','userId','doneOrders','doneCount','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
     }

     /**
     * Show the Delivered Orders.
     *
     * @return Resources/Views/Writer/delivered
     */

     public function delivered()
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $deliveredOrders = Orders::orderBy('id','DESC')->where('order_status',4)->where('writer_id',$userId)->get();
        $deliveredCount = $deliveredOrders->count();
        $documents = Document::all()->pluck("name");

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-delivered',compact('userDetails','userId','deliveredOrders','deliveredCount','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
     }

     /**
     * Show the Revision Orders.
     *
     * @return Resources/Views/Writer/revision
     */

     public function revision()
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $revisionOrders = Orders::orderBy('id','DESC')->where('order_status',3)->where('writer_id',$userId)->get();
        $revisionCount = $revisionOrders->count();
        $documents = Document::all()->pluck("name");
        $writerId = Auth::id();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-revision',compact('userDetails','userId','revisionOrders','revisionCount','documents','availableCount','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
     }

     /**
     * Show the Disputed Orders.
     *
     * @return Resources/Views/Writer/disputed
     */

     public function disputed()
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $disputedOrders =  Orders::orderBy('id','DESC')->where('order_status',7)->where('writer_id',$userId)->get();
        $disputedCount = $disputedOrders->count();
        $documents = Document::all()->pluck("name");
        $writerId = Auth::id();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.writer-disputed',compact('userDetails','userId','disputedOrders','availableCount','disputedCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));

     }


     /**
     * Show the Order Details.
     *
     * @return Resources/Views/Writer/Order-Details
     * 
     */
    
     public function orderDetails($id)
     {
        $userDetails = Auth::user();
        $username = Auth::user()->name;
        $userId = Auth::id();
        $order = Orders::where('id',$id)->first();
        $messages = Messages::where('order_id',$id)->where(function($query){
            $userId = Auth::id();
            $query->where("accessibility",1)->where("category",2)->where("category",3)->orWhere(function($q){
                $userId = Auth::id();
                $q->where("recipient","writer")->orWhere("sender_id",$userId);
            });

        })->orderBy('id','DESC')->get();

        $messageCount = $messages->count();
        $unread = Messages::where('order_id',$id)->where('status',0)->orderBy('id','DESC')->get();
        $read = Messages::where('order_id',$id)->where('status',1)->orderBy('id','DESC')->get();

        $files = Files::where('order_id',$id)->where(function ($query){
            $userId = Auth::id();
            $query->where("restriction",1)->orWhere("uploader_id",$userId);
        })->get();
        $fileCount = $files->count();
        
        $bidding = Biddings::where('order_id',$id)->where('writer_id',$userId)->count();
        $isBidPlaced = Biddings::where('order_id',$id)->where('writer_id',$userId)->count();
        $review = Reviews::where('order_id',$id)->first();
        $reviewCount = Reviews::where('order_id',$id)->count();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        return view('main.writer.order-details',compact('userDetails','userId','id','order','availableCount','unread','read','review','reviewCount','messages','messageCount','files','fileCount','bidding','isBidPlaced','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
     
    }
     
     public function postMessage(Request $request,$id)
     {
        $validator = Validator::make($request->all(), [
            'subject' => ['required','max:255'],
            'message' => ['required']
        ]);

        if($validator->fails())
        {
            return $errors = $validator->errors();

        }else{

            $admin = User::where("category",1)->pluck('id')->first();

            if($request->get('recipient') == "customer"){

                $customerId = Orders::where("id",$id)->pluck("customer_id")->first();
                $customerName = Orders::where("id",$id)->pluck("customer_name")->first();

                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->input('sender_id'),
                    "sender_email" => $request->input('sender_email'),
                    "sender_name" => $request->input('sender_name'),
                    "recipient_id" => $customerId,
                    "recipient" => $request->get('recipient'),
                    "subject" => $request->input('subject'),
                    "category" => 2,
                    "message" => $request->input('message'),
                    "accessibility" => 0
                ]);

            }elseif($request->get('recipient') == "support") {

                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->input('sender_id'),
                    "sender_email" => $request->input('sender_email'),
                    "sender_name" => $request->input('sender_name'),
                    "recipient_id" => $admin,
                    "recipient" => "Support",
                    "subject" => $request->input('subject'),
                    "category" => 2,
                    "message" => $request->input('message'),
                    "accessibility" => 0
                ]);

            }
        
            return back();

        }
     }

     public function uploads(Request $request,$id)
    {
       $userId = Auth::id();
       $file = $request->file('file')[0];
       $filenameWithExt = $file->getClientOriginalName();
       $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
       $filesize = $file->getClientSize();
       $extension = $file->getClientOriginalExtension();
       $fileNameToStore = $filename.'_'.time().'.'.$extension;
    
       $path =  $request->file('file')[0]->store('files');

       Files::create([
        'uploader_id' => $userId,
        'uploader' => "writer", 
        'order_id' => $id,
        'filename' => $fileNameToStore,
        'filetype' => $extension,
        'filesize' => $filesize,
        'category' => 1,
        'display_name' => $filename,
        'path' => $path,
        'description' => $request->get('file_description'),
       ]);
    
       return back();

    }

     public function replyMessage(Request $request,$id)
     {
        $validator = Validator::make($request->all(), [
            'subject' => ['required','max:255']
        ]);

        if($validator->fails())
        {
            return $errors = $validator->errors();

        }else{

            Messages::create([
                "order_id" => $id,
                "sender_id" => $request->input('sender_id'),
                "sender_email" => $request->input('sender_email'),
                "sender_name" => $request->input('sender_name'),
                "recipient" => $request->input('recipient'),
                "department" => $request->input('department'),
                "subject" => $request->input('subject'),
                "message" => $request->input('message'),
                "category" => 2,
                "accessibility" => 1 
            ]);
            
            return back();

        }

     }

     
    /**
     * My Bids.
     *
     * @return Resources/Views/Writer/Bidding
     */


    public function bidding()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $orders= Orders::where('order_status',8)->orWhere('order_status',1)->orWhere('order_status',3)->orWhere('order_status',4)->orWhere('order_status',5)->orWhere('order_status',6)->orWhere('order_status',7)->orderBy('deadline_period','asc')->get();
        $bids = Biddings::where('writer_id',$userId)->pluck('order_id');
        $availableOrders = Orders::where('order_status',8)->pluck("id")->all();
        $writerBidding = Biddings::where('writer_id',$userId)->whereIn("order_id",$availableOrders)->pluck("order_id")->all();
        $ordersBidding = Orders::where("order_status",8)->whereIn("id",$writerBidding)->get();
        $orderCount = $orders->count();
        $writerBiddingCount = $ordersBidding->count(); 
        $documents = Document::all()->pluck("name");

        $writerId = Auth::id();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        return view('main/writer/writer-bidding',compact('userDetails','orderCount','writerBiddingCount','ordersBidding','orders','bids','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
    }


    public function finished()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $finishedOrders = Orders::orderBy('id','DESC')->where('order_status',6)->where('writer_id',$userId)->get();
        $finishedCount = $finishedOrders->count();
        $documents = Document::all()->pluck("name");

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();
        $writerId = Auth::id();

        
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

    
        return view('main/writer/writer-finished',compact('userDetails','finishedOrders','finishedCount','availableCount','documents','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
    }

    /**
     * Manage payments.
     *
     * @return Resources/Views/Writer/payments
     */


    public function payments()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $active = Orders::where('order_status',1)->where('writer_id',$userId)->count(); 
        $delivered = Orders::where('order_status',4)->where('writer_id',$userId)->count(); 
        $disputed = Orders::where('order_status',7)->where('writer_id',$userId)->count(); 
        $finished = Orders::where('order_status',6)->where('writer_id',$userId)->count(); 
        $earnings = Earnings::where('writer_id',$userId)->count();
        $writerId = Auth::id();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();


        return view('main/writer/writer-payments',compact('userDetails','earnings','active','availableCount','delivered','disputed','finished','availableNum','assignedNum','doneNum','deliveredNum','revisionNum','disputedNum'));
    }

    /**
     * Manage messages.
     *
     * @return Resources/Views/Writer/messages
     */
	 
    public function messages()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();

        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        return view('main/writer/writer-messages',compact('userDetails','availableNum','assignedNum','availableCount','doneNum','deliveredNum','revisionNum','disputedNum'));
    }


    /**
     * Manage help.
     *
     * @return Resources/Views/Writer/help
     */


    public function help()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        
        $writerId = Auth::id();
        $availableNum = Orders::where('order_status',8)->count();
        $assignedNum = Orders::where('order_status',1)->where('writer_id',$writerId)->count();
        $doneNum = Orders::where('order_status',5)->where('writer_id',$writerId)->count();
        $deliveredNum = Orders::where('order_status',4)->where('writer_id',$writerId)->count();
        $revisionNum = Orders::where('order_status',3)->where('writer_id',$writerId)->count();
        $disputedNum = Orders::where('order_status',7)->where('writer_id',$writerId)->count();
        $bidOrders = Biddings::where('writer_id',$userId)->pluck('order_id')->all();
        $availableOrders = Orders::orderBy('deadline_period','DESC')->whereNotIn("id",$bidOrders)->where('order_status',8)->get();
        $availableCount = $availableOrders->count();

        return view('main/writer/writer-help', compact('userDetails','availableNum','assignedNum','availableCount','doneNum','deliveredNum','revisionNum','disputedNum'));

    }

}
