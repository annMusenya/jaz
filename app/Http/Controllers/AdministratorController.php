<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeWriter;
use App\Academic; use App\Document; use App\Subjects; use App\Deadline; use App\Citation; use App\Additional; 
use App\Orders;use App\User; use App\Messages; use App\Files; use App\Biddings;use App\Notifications; use App\Payments; use App\Reviews; 
use Mail;

class AdministratorController extends Controller
{

    public function __construct()
    {
       $this->middleware('admin')->except('login','register','authenticateAdmin','createAdmin','registerWriter','suspendUser','allowFileAccess');
    }  

    public function authenticateAdmin(Request $request)
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
         
                if($category == 1){
                    if(Auth::guard('')->attempt($credentials)){
                         return ["message"=>"success"];
                    }else{
                        return ["credentials"=>"Wrong Email or Password"];
                    }
                }else{
                     return ["account"=>"You need an administrator account to access."]; 
                }
    
            }

    }

    public function login()
    {
        return view('main/admin/admin-login');
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/admin/login');
    }

    public function signup()
    {
        return view('main/admin/admin-register');
    }

    public function createAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:255'],
            'email' => ['required','email'],
            'phone' => ['min:10'],
            'password' => ['required','string','min:8','confirmed']
        ]);

        if($validator->fails())
        {
            return $errors = $validator->errors();

        }else{
            User::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "role" => "Administrator",
                "country" => $request->input('country'),
                "category" => 1,
                "subscription" => 1,
                "password" => Hash::make($request->input('password'))
            ]);

            $credentials = $request->only('email','password');
        
            if(Auth::attempt($credentials)){
                return redirect('/admin');
            }else{
                return $errors = $validator->errors();
            }
        }

    }

    public function registerWriter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required','max:10'],
            'email' => ['required','email'],
            'phone' => ['required','min:10']
        ]);

        if ($validator->fails()){
            
            return $errors = $validator->errors();
            
        }else{

            $digits = 5;
            $randomId = rand(pow(10,$digits-1),pow(10, $digits)-1);
           
            User::create([
                "writer_id" => $randomId,
                "name" => $request->input('username'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "role" => "Writer",
                "country" => $request->input('country'),
                "category" => 2,
                "subscription" => 1,
                "status" => 1,
                "password" => Hash::make("Welcome2020")
            ]);

            $user = new User();
		    $user->email = $request->input('email');
		    $username = $request->input('username');
            $arr = array("user" => $username, "password" => "Welcome2020");
            
		    $user->notify(new WelcomeWriter($arr));

            return back();
            
        }

    }

    public function register()
    {
        return view('main/admin/admin-register');
    }

     public function index()
     {
        /* 
        * Order Status 
        * Pending = 0 Active = 1 Cancelled = 2 Revision = 3 Delivered = 4 Done = 5 finished = 6 Disputed = 7 Bidding = 8 Rejected = 9
        */
        $userDetails = Auth::user();
        $userId = Auth::id();
        $orderCount = Orders::orderBy('id','DESC')->count();
        $pendingOrders = Orders::orderBy('id','DESC')->where('order_status',0)->get();
        $pendingCount = $pendingOrders->count();
        $activeOrders = Orders::orderBy('id','DESC')->where('order_status',1)->get();
        $activeCount = $activeOrders->count();
        $cancelledOrders = Orders::orderBy('id','DESC')->where('order_status',2)->get();
        $cancelledCount = $cancelledOrders->count();
        $revisionOrders = Orders::orderBy('id','DESC')->where('order_status',3)->get();
        $revisionCount = $revisionOrders->count();
        $deliveredOrders = Orders::orderBy('id','DESC')->where('order_status',4)->get();
        $deliveredCount = $deliveredOrders->count();
        $doneOrders = Orders::orderBy('id','DESC')->where('order_status',5)->get();
        $doneCount = $doneOrders->count();
        $disputedOrders =  Orders::orderBy('id','DESC')->where('order_status',7)->get();
        $disputedCount = $disputedOrders->count();
        $biddingOrders = Orders::orderBy('id','DESC')->where('order_status',8)->where('payment_status',1)->get();
        $biddingCount = $biddingOrders->count();
        $allOrders = Orders::all();

        $documents = Document::all()->pluck("name");
        
        return view('main.admin.admin-home',compact('userDetails','userId','allOrders','orderCount','pendingOrders','pendingCount','activeOrders','activeCount','cancelledOrders','cancelledCount','revisionOrders','revisionCount','deliveredOrders','deliveredCount','doneOrders','doneCount','disputedOrders','disputedCount','biddingOrders','biddingCount','documents'));
    
    }
    
     public function orderDetails($id)
     {
        
        $userDetails = Auth::user();
        $userId = Auth::id();
        $order = Orders::where('id',$id)->first();
        $messages = Messages::where('order_id',$id)->orderBy('id','DESC')->get();
        $messageCount = Messages::where('order_id',$id)->count();
        $unread = Messages::where('order_id',$id)->where('status',0)->orderBy('id','DESC')->get();
        $read = Messages::where('order_id',$id)->where('status',1)->orderBy('id','DESC')->get();
        $files = Files::where('order_id',$id)->orderBy('id','DESC')->get();
        $fileCount = $files->count();
        $customerId = Orders::where('id',$id)->pluck("customer_id")->first();
        $customerName = Orders::where('id',$id)->pluck("customer_name")->first();
        $review = Reviews::where('order_id',$id)->first(); 
        $reviewCount = Reviews::where('order_id',$id)->count();
        $writers = User::where('category',2)->get();
        $writerCount = $writers->count();

        return view('main.admin.admin-order-details',compact('userDetails','userId','writerCount','id','review','customerId','customerName','reviewCount','order','unread','read','messages','messageCount','files','fileCount','writers'));
     
     }


     public function suspendUser($id)
     {
        User::find($id)->update(['subscription' => 0, 'status' => 0]);

        return ["success" => true, "message" => "You have successfully suspended this user from accessing accessing orders and placing bids on orders."];

     }

     public function restoreUser($id)
     {
        User::find($id)->update(['subscription' => 1, 'status' => 1]);

        return ["success" => true, "message" => "You have successfully restored this user. They can view available orders and bid for jobs."];

     }

     public function allowFileAccess($id)
     {
        Files::find($id)->update(['restriction' => 1]);
        
        return ["success" => true, "message" => "You have successfully allowed access of this file to all users including the assigned writer."];

     }


     public function showProfile($id)
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $accountDetails = User::where("id",$id)->first();
        $userName = User::where("id",$id)->pluck("name")->first();
        $accountId = User::where("id",$id)->pluck("id")->first();
        $userEmail = User::where("id",$id)->pluck("email")->first();
        $userPhone = User::where("id",$id)->pluck("phone")->first();
        $userRole = User::where("id",$id)->pluck("role")->first();
        $userCategory = User::where("id",$id)->pluck("category")->first();
        $userCountry = User::where("id",$id)->pluck("country")->first();
        $user = User::where("id",$id)->pluck("role")->first();
        $updated = User::where('id',$userId)->pluck("updated_at")->first();
        $date = $updated->format('d F Y');
        $clientOrders = Orders::where("customer_id",$id)->count();

        return view('main.admin.user-profile',compact('clientOrders','userDetails','userId','accountId','accountDetails','userSub','userName','userCategory','userEmail','userCountry','userRole','userPhone','date'));

     }

     public function uploadFile(Request $request, $id)
     {
           $userId = Auth::id();
           $file = $request->file('file')[0];
           $filenameWithExt = $file->getClientOriginalName();
           $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
           $filesize = $file->getClientSize();
           $extension = $file->getClientOriginalExtension();
           $fileNameToStore = $filename.'_'.time().'.'.$extension;

           $path = Storage::disk('public')->putFileAs('files',$file,$fileNameToStore);
   
           Files::create([
            'uploader_id' => $userId,
            'uploader' => $request->get('uploader'),
            'order_id' => $id,
            'filename' => $fileNameToStore,
            'filetype' => $extension,
            'filesize' => $filesize,
            'category' => 3,
            'path' => $path,
            'display_name' => $filename,
            'description' => $request->get('file_description'),
           ]);
        
           return back();

     }

     public function postMessage(Request $request,$id)
     {
        $validator = Validator::make($request->all(), [
            'subject' => ['required','max:255']
        ]);

        if($validator->fails())
        {
            return $errors = $validator->errors();

        }else{

            $writerId = Orders::where("id",$id)->pluck("writer_id")->first();
            $customerId = Orders::where("id",$id)->pluck("customer_id")->first();

            if($request->get('recipient') == "customer"){
                
                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->input('sender_id'),
                    "sender_email" => $request->input('sender_email'),
                    "sender_name" => $request->input('sender_name'),
                    "recipient_id" => $customerId,
                    "recipient" => $request->input('recipient'),
                    "department" => $request->input('department'),
                    "subject" => $request->input('subject'),
                    "message" => $request->input('message'),
                    "category" => 1,
                    "reply_to" => 1,
                    "accessibility" => 1 
                ]);

            }elseif($request->get('recipient') == "writer"){

                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->input('sender_id'),
                    "sender_email" => $request->input('sender_email'),
                    "sender_name" => $request->input('sender_name'),
                    "recipient_id" => $customerId,
                    "recipient" => $request->input('recipient'),
                    "department" => $request->input('department'),
                    "subject" => $request->input('subject'),
                    "message" => $request->input('message'),
                    "category" => 1,
                    "reply_to" => 1,
                    "accessibility" => 1
                ]);

            }else{
                
                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->input('sender_id'),
                    "sender_email" => $request->input('sender_email'),
                    "sender_name" => $request->input('sender_name'),
                    "recipient_id" => $customerId,
                    "recipient" => $request->input('recipient'),
                    "department" => $request->input('department'),
                    "subject" => $request->input('subject'),
                    "message" => $request->input('message'),
                    "category" => 1,
                    "reply_to" => 1,
                    "accessibility" => 1
                ]);

            }
            return back();
        }
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
                "order_id" => $request->input('order_id'),
                "sender_id" => $request->input('sender_id'),
                "recipient" => $request->input('recipient'),
                "sender_email" => $request->input('sender_email'),
                "sender_name" => $request->input('sender_name'),
                "department" => $request->input('department'),
                "subject" => $request->input('subject'),
                "category" => 1,
                "message" => $request->input('message')
            ]);

            return back();

        }
     }

    public function clients()
    {
        $userDetails = Auth::user();
        $clients = User::where('category',3)->get();
        $clientCount = $clients->count();
        return view('main/admin/admin-clients',compact('userDetails','clients','clientCount'));
    }

    public function writers()
    {
        $userDetails = Auth::user();
        $writers = User::where('category',2)->get();
        $writerCount = $writers->count();
        return view('main/admin/admin-writers',compact('userDetails','writers','writerCount'));
    }

    public function finished()
    {
        $userDetails = Auth::user();
        $finishedOrders = Orders::orderBy('id','DESC')->where('order_status',6)->get();
        $finishedCount = $finishedOrders->count();
        $documents = Document::all()->pluck("name");
        return view('main/admin/admin-finished',compact('userDetails','finishedOrders','finishedCount','documents'));
    }

    public function bidding()
    {
        $userDetails = Auth::user();
        $orders= Orders::where('order_status',8)->orderBy('deadline_period','asc')->get();
        $ordersOnBidding = $orders->count();
        $documents = Document::all()->pluck("name");
        return view('main/admin/admin-bidding',compact('userDetails','ordersOnBidding','orders','documents'));
    }


    public function showBids($id)
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $order = Orders::where('id',$id)->first();
        $documents = Document::all()->pluck("name");
        $bids = Biddings::where('order_id',$id)->get();

        return view('main/admin/order-bids',compact('id','userDetails','userId','order','documents','bids'));
    }

    public function payments()
    {
        $userDetails = Auth::user();
        $allPayments = Payments::orderBy('order_id','desc')->get();
        $paymentCount = $allPayments->count();

        return view('main/admin/admin-payments',compact('userDetails','allPayments','paymentCount'));

    }

    public function referrals()
    {
        $userDetails = Auth::user();
        return view('main/admin/admin-referrals',compact('userDetails'));
    }

    public function settings()
    {
        $userDetails = Auth::user();
        $academicLevels = Academic::all();
        $documents = Document::all();
        $subjects = Subjects::all();
        $deadlines = Deadline::all();
        $citations = Citation::all();
        $additionals = Additional::all();

        return view('main/admin/admin-settings', compact('userDetails','academicLevels','documents','subjects','deadlines','citations','additionals'));
    }

    public function help()
    {
        $userDetails = Auth::user();
        return view('main/admin/admin-help', compact('userDetails'));
    }

    public function addAcademic()
    {

     $this->validate(request(),[
        'name' => 'required|max:191',
        'description' => 'required',
        'rate' => 'required',
        'label' => 'required'
    ]);

     Academic::create(request(['name','description','rate','label']));

     return back();

    }

    public function addDocument()
    {

     $this->validate(request(),[
        'name' => 'required|max:191',
        'description' => 'required'
    ]);

     Document::create(request(['name','description']));

     return back();

    }

    public function addSubject()
    {

     $this->validate(request(),[
        'name' => 'required|max:191',
        'description' => 'required',
        'amount' => 'required',
        'category' => 'required'
    ]);

     Subjects::create(request(['name','description','amount','category']));

     return back();

    }

    public function addDeadline()
    {

     $this->validate(request(),[
        'name' => 'required',
        'description' => 'required',
        'hours' => 'required',
        'rate' => 'required'
    ]);

     Deadline::create(request(['name','label','description','hours','rate']));

     return back();

    }

    public function addCitation()
    {

     $this->validate(request(),[
        'name' => 'required',
        'description' => 'required'
    ]);

     Citation::create(request(['name','description']));

     return back();

    }

    public function approveMessage($id)
    {
        Messages::find($id)->update(["accessibility" => 1]);

        return back();
    }

}
