<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMailable;
use App\Role; use App\Permission; 
use App\Academic; use App\Document;
use App\Subjects; use App\Deadline; 
use App\Citation; use App\Additional; 
use App\User; use App\Orders; 
use App\Files; use App\Payments;
use App\Discounts; use App\Reviews;

class CustomerController extends Controller
{
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
       $this->middleware('customer')->except('index','login','register','api','authenticateCustomer','resetPassword','activateBidding','acceptJob','rejectJob','rejectOrder','revised','deliver','approve','setRevision','assign','placeBid','directAssign','setToDone','postMessage','setToCancelled','uploadFile','requestPay'); 
    }
    
     /**
     *  Authenticate Customer
     *  @param Request $request
     */

    public function authenticateCustomer(Request $request)
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
     
            if($category == 3){
                if(Auth::guard('')->attempt($credentials)){
                     return ["message"=>"success"];
                }else{
                    return ["credentials"=>"Wrong Email or Password"];
                }
            }else{
                 return ["account"=>"You need a customer account to access."];
            }

        }

    }

    public function resetPassword(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(),[
            
            'password' => ['required',function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Old Password didn\'t match');
                }
            }],

            'new_password' => ['required','min:8','different:password']

        ]);

        if ($validator->fails()){

            $passwordError = $validator->errors()->get('password');
            $confirmError = $validator->errors()->get('new_password');
            
            return ["old-password" => $passwordError,"new-password" => $confirmError];

        }else{

            if(Hash::check($request->password, $user->password)){
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();

                auth()->logout();

                return ["success"=>true,"message"=>"Password successfully changed. Your account will logout so that you can login using the new password."];

            } else {

                return ["error"=>"Something went wrong. Try again later."];
                
            }
        }

    }


    public function login()
    {
        return view('auth/login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/login');
    }

    public function index()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $academicLevels = Academic::all();
        $documents = Document::all();
        $popularDocs = Document::where('id','<=','5')->get();
        $otherDocs = Document::where('id','>','5')->get();
        $popular= Subjects::where('category','=', 'Most Popular')->get();
        $humanities = Subjects::where('category','=', 'Humanities')->get();
        $socialSciences = Subjects::where('category','=', 'Social Sciences')->get();
        $businessManagement = Subjects::where('category','=', 'Business and Management')->get();
        $naturalSciences = Subjects::where('category','=', 'Natural Sciences')->get();
        $formalSciences = Subjects::where('category','=', 'Formal Sciences')->get();
        $appliedSciences = Subjects::where('category','=', 'Applied Sciences')->get();
        $others = Subjects::where('category','=', 'Other')->get();
        $highSchoolDeadlines = Deadline::where('label','=','45')->get();
        $underGrad1Deadlines = Deadline::where('label','=','46')->get();
        $underGrad2Deadlines = Deadline::where('label','=','47')->get();
        $mastersDeadlines = Deadline::where('label','=','48')->get();
        $doctoralDeadlines = Deadline::where('label','=','49')->get();
        $additionals = Additional::all();
        $deadlines = array($highSchoolDeadlines,$underGrad1Deadlines,$underGrad2Deadlines,$mastersDeadlines,$doctoralDeadlines);
        $subjects = Subjects::all();
        $citations = Citation::all();
        $content = array('levels'=>$academicLevels,'documents'=>$documents,'deadlines'=>$deadlines,'subjects'=>$subjects,'additionals'=>$additionals);
        
        return view('main/customer/new-order', compact('content','academicLevels','deadlines','popularDocs','otherDocs','citations','popular','humanities','socialSciences','businessManagement','naturalSciences','formalSciences','appliedSciences','others','highSchoolDeadlines','underGrad1Deadlines','underGrad2Deadlines','mastersDeadlines','doctoralDeadlines','userDetails','userId'));
    }

    public function uploadFile(Request $request)
    {
        $userId = Auth::id();
        $file = $request->file('file')[0];
        $filenameWithExt = $file->getClientOriginalName();
        $filesize = $file->getClientSize();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = storage_path();
        if($userId){
            if($request->hasFile('file')){
                Files::create([
                    'uploader_id' => $userId,
                    'order_id' => time(),
                    'filename' => $fileNameToStore,
                    'filetype' => $extension,
                    'filesize' => $filesize,
                    'display_name' => $filename,
                    'restriction' => 3,
                    'description' => $request->get('file_description'),
                    ]); 
                    Storage::put('instructions',$file); 
                    return ["success" => true, "message" => "Your file has been successfully uploaded."];
            } else {
                return ["error" => true, "message"=>"Something went wrong. Try again later."];
            }
        } else {
            return ["error" => true, "message"=>"You must be logged in. Login or create account."];
        }
    }
	
    public function newOrder()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $username = $userDetails["name"];
        $userEmail = $userDetails["email"];

        $this->validate(request(),[
            'topic' => 'max:255',
            'instructions' => 'max:500',
            'file' => 'mimes:doc,pdf,docx,zip'
        ]);

        $plagiarism = false;
        $powerpoint = "None";
        $excel = "None";
        
        Orders::create(array_merge(request(['academic_level','paper_type','word_spacing','pages','writer','deadline_period','subject','topic','citation','references','instructions','price_amount']),
                    ['customer_id'=>$userId],
                    ['customer_name'=>$username],
                    ['customer_email' => $userEmail],
                    ['powerpoint'=>$powerpoint],
                    ['excel' => $excel],
                    ['plagiarism'=>$plagiarism])
                );
        return back();
    }

    public function rates(){
        $academicLevels = Academic::all();
        $documents = Document::all();
        $additionals = Additional::all();
        $deadlines = Deadline::all();
        $subjects = Subjects::all();

        return view('main/customer/steps/rates', compact('academicLevels','documents','additionals','deadlines','subjects') );
    }

    public function finished()
    {   
        $userDetails = Auth::user();
        $userId = Auth::id();
        $finishedOrders = Orders::where('order_status','=',6)->where('customer_id',$userId)->get();
        $finishedCount = $finishedOrders->count();
        $documents = Document::all()->pluck("name");
        return view('main/customer/finished',compact('userDetails','userId','finishedOrders','finishedCount','documents'));
    }

    public function cancelled()
    {   
        $userDetails = Auth::user();
        $userId = Auth::id();
        $cancelledOrders = Orders::where('order_status','=',2)->get();
        $cancelledCount = $cancelledOrders->count();
        $documents = Document::all()->pluck("name");
        return view('main/customer/cancelled',compact('userDetails','userId','documents','cancelledOrders','cancelledCount'));
    }

    public function payments()
    {   $userDetails = Auth::user();
        $userId = Auth::id();

        $orderPayments = Payments::where('user_id',$userId)->where('status',1)->where('type',1)->get();
        $walletPayments = Payments::where('user_id',$userId)->where('status',2)->where('type',1)->get();
        $payments = Payments::where('user_id',$userId)->get();
        $paymentCount = $payments->count();
        return view('main/customer/payments',compact('userDetails','userId','payments','paymentCount','orderPayments','walletPayments'));
    }

    public function referrals()
    {   
        $userDetails = Auth::user();
        $userId = Auth::id();
        return view('main/customer/referrals',compact('userDetails','userId'));
    }

    public function settings()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        return view('main/customer/settings',compact('userDetails','userId'));
    }

    public function help()
    {   
        $userDetails = Auth::user();
        $userId = Auth::id();
        return view('main/customer/help',compact('userDetails','userId'));
    }

    public function review(Request $request,$id)
    {
        Reviews::create([
            'order_id' => $id,
            'writer_id' => $request->input('writer_id'),
            'rating' => $request->input('rating'),
            'feedback' => $request->input('feedback')
        ]);

        return back();
    }


    public function myAccount()
    {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $dateCreated = User::where('id',$userId)->pluck("created_at")->first();

        $date = $dateCreated->format('d F Y');

        return view('main/customer/my-account',compact('userDetails','userId','date'));

    }

    public function api()
    {
        $documents = Document::all();
        $subjects = Subjects::all();
        $deadlines = Deadline::all();
        $citations = Citation::all();
        $discounts = Discounts::all();
        $levels = Academic::all();
        $api = ["academic"=>$levels,"documents"=>$documents,"subjects"=>$subjects,"deadline"=>$deadlines,"citations"=>$citations];
        return view('main.customer.api',compact('api'));

    }

}
