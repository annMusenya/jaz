<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Assigned;
use App\Notifications\Revision;
use App\Notifications\Delivered;
use App\Notifications\Done;
use App\Notifications\requestPayment;
use App\Orders;
use App\Messages; 
use App\Files;
use App\Document;
use App\Biddings;
use App\Reviews;
use App\User;

class OrdersController extends CustomerController
{

     public function order()
     {
        /* 
        * Order Status 
        * Pending = 0 Active = 1 Cancelled = 2 Revision = 3 Delivered = 4 Done = 5 finished = 6 Disputed = 7 Bidding = 8 Rejected = 9 Reasign = 10
        */
        $userDetails = Auth::user();
        $userId = Auth::id();
        $userOrders = Orders::where('customer_id','=',$userId)->get();
        $orderCount = $userOrders->count();
        $pendingOrders = Orders::orderBy("deadline_period","asc")->where('order_status',0)->where('customer_id',$userId)->get();
        $pendingCount = $pendingOrders->count();
        $biddingOrders = Orders::orderBy('id','DESC')->where('order_status',8)->where('customer_id',$userId)->orderBy("deadline_period","asc")->get();
        $biddingCount = $biddingOrders->count();
        $activeOrders = Orders::orderBy('id','DESC')->where('order_status','=',1)->where('customer_id','=',$userId)->get();
        $activeCount = $activeOrders->count();
        $cancelledOrders = Orders::orderBy('id','DESC')->where('order_status','=',2)->where('customer_id','=',$userId)->get();
        $cancelledCount = $cancelledOrders->count();
        $revisionOrders = Orders::orderBy('id','DESC')->where('order_status','=',3)->where('customer_id','=',$userId)->get();
        $revisionCount = $revisionOrders->count();
        $rejectedOrders = Orders::orderBy('id','DESC')->where('order_status','=',9)->where('customer_id','=',$userId)->get();
        $rejectedCount = $rejectedOrders->count();
        $deliveredOrders = Orders::orderBy('id','DESC')->where('order_status','=',4)->where('customer_id','=',$userId)->get();
        $deliveredCount = $deliveredOrders->count();
        $doneOrders = Orders::orderBy('id','DESC')->where('order_status','=',5)->where('customer_id','=',$userId)->get();
        $doneCount = $doneOrders->count();
        $finishedOrders = Orders::orderBy('id','DESC')->where('order_status','=',6)->where('customer_id','=',$userId)->get();
        $finishedCount = $finishedOrders->count();
        $disputedOrders =  Orders::orderBy('id','DESC')->where('order_status','=',7)->where('customer_id','=',$userId)->get();
        $disputedCount = $disputedOrders->count();
        $documents = Document::all()->pluck("name");

        return view('main/customer/orders', compact('userDetails','pendingOrders','pendingCount','rejectedOrders','rejectedCount','biddingOrders','biddingCount','activeOrders','activeCount','cancelledOrders','cancelledCount','revisionOrders','revisionCount','deliveredOrders','deliveredCount','doneOrders','doneCount','disputedOrders','disputedCount','finishedOrders','finishedCount','orderCount','documents'));
     
      }

     public function show($id)
     {
        $userDetails = Auth::user();
        $userId = Auth::id();
        $username = Auth::user()->name;
        $order = Orders::where('id',$id)->first();

        $messages = Messages::where('order_id',$id)->where(function($query){
            $userId = Auth::id();
            $query->where("accessibility",1)->orWhere(function($q){
                $userId = Auth::id();
                $q->where("sender_id",$userId)->orWhere("recipient","customer");
            });

        })->orderBy('id','DESC')->get();

        $messageCount = $messages->count();
        $unread = Messages::where('order_id',$id)->where('status',0)->orderBy('id','DESC')->get();
        $read = Messages::where('order_id',$id)->where('status',1)->orderBy('id','DESC')->get();

        $review = Reviews::where('order_id',$id)->first();
        $reviewCount = Reviews::where('order_id',$id)->count();

        $replies = Messages::where("category",2)->where("sender_id",$userId)->orderBy("id","asc")->get();
        $files = Orders::where('id',$id)->pluck("filename")->first();

        if($files != "null")
        { 
            $filesArray = json_decode($files);
            $fileCount= count($filesArray);
		        for($i = 0; $i < $fileCount; $i++){
		        	Files::where("filename",$filesArray[$i])->update(["order_id" => $id]);
		        }
		}
		
        $orderFiles = Files::where('order_id',$id)->where(function ($query){
            $userId = Auth::id();
            $query->where("restriction",1)->orWhere("uploader_id",$userId);
        })->get();
        $orderFileCount = $orderFiles->count();
		 
        return view('main/customer/order-details',compact('userDetails','userId','id','order','unread','read','messages','messageCount','orderFileCount','orderFiles','review','reviewCount','replies'));

     }

     public function activateBidding($id)
     {
    
         Orders::find($id)->update(['order_status' => 8]);

         return ['success'=>true, 'message'=>'Bidding Activated. Writers can now see the order and bid.'];
     }

     public function acceptJob($id)
     {
        Orders::find($id)->update(["confirmation" => 1 ]);
        
        return ["success"=>true, "message" => "You have accepted our job offer. Please note, you can also return job after accepting it. Happy writing."];
     }
     
     public function rejectJob($id)
     {
        Orders::find($id)->update(["order_status" => 1 ]);

        $adminDetails = User::where("category",1)->where('role','=','Administrator')->first();
        $adminEmail = $adminDetails["email"];
        $adminName = $adminDetails["name"];

        $writer = Orders::where("id",$id)->pluck("writer_name")->first();

        $user = new User();
		$user->email = $adminEmail;
		$username = $adminName;
		$arr = array("user" => $username,"id"=>$id, "writer" => $writer);
		$user->notify(new writerReturn($arr));
        
        return ['success'=>true, 'message'=>'Thank for taking the time. We will reassign this order to another writer.'];
     
     }

    public function requestPay($id) 
    {
        
        $customerEmail = Orders::where('id',$id)->pluck("customer_email")->first();
        $customerName = Orders::where('id',$id)->pluck("customer_name")->first();
        
        $user = new User();
		$user->email = $customerEmail;
        $arr = array("user" => $customerName,"order" => $id);
        $user->notify(new requestPayment($arr));
        
        return ['success'=>true, 'message'=>'Email Sent'];

    }

     public function rejectOrder(Request $request,$id)
     {
         Orders::find($id)->update([
             'rejection_reason' => $request['reason'],
             'rejection' => $request['explanation'],
             'order_status' => 9
        ]);
		
		$user = new User();
		$userDetails = Auth::user();
		$user->email = $userDetails["email"];
		$username = $userDetails["name"];
		$arr = array("user" => $username,"id"=>$id, "reason" => $request['reason'],"explanation" => $request['explanation']);
		$user->notify(new Rejected($arr));
			
        return back();
		 
     }

     public function revised($id)
     {
        Orders::find($id)->update(['order_status' => 5 ]);
        
        $adminEmail = User::where("category",1)->where('role','=','Administrator')->pluck("email")->first();

        // Revised Mail
        $user = new User();
        $user->email = $adminEmail;
        $username = User::where("category",1)->where('role','=','Administrator')->pluck("name")->first();
        $arr = array("user" => $username, "order" => $id);
        $user->notify(new Revision($arr));

        return back();

     }

     public function deliver($id)
     {
        Orders::find($id)->update(['order_status' => 4 ]);

        $adminEmail = User::where("category",1)->where('role','=','Administrator')->pluck("email")->first();
        $customerEmail = Orders::where('id',$id)->pluck("customer_email")->first();
        $customerName = Orders::where('id',$id)->pluck("customer_name")->first();
        
        // Revised Mail
        $user = new User();
        $user->email = array($customerEmail,$adminEmail);
        $username = $customerName;
        $arr = array("user" => $username, "order" => $id);
        $user->notify(new Delivered($arr));

        return ["success"=>true,'message'=>'Order Delivered. The customer has received the final paper. The order is awaiting final customer approval.'];
        
     }

     public function approve($id)
     {
        Orders::find($id)->update(['order_status' => 6 ]);
        return ["success"=>true,'message'=>'Order Approved. Thank you, we look forward to working on another paper.'];
     }

     public function setRevision(Request $request,$id)
     {
        Orders::find($id)->update([
            'order_status' => 3,
        ]);

        $writerId = Orders::where('id',$id)->pluck("writer_id")->first();
        $writerName = Orders::where('id',$id)->pluck("writer_name")->first();
        $writerEmail = User::where('id',$writerId)->pluck("email")->first();

        $user = new User();
		$userDetails = Auth::user();
		$user->email = $writerEmail;
		$username = $writerName;
		$arr = array("user" => $username,"id"=>$id, "reason" => $request['reason'],"explanation" => $request['explanation']);
		$user->notify(new Revision($arr));
        
        return back();
     }

     public function placeBid(Request $request)
     {	
        $bidExist = Biddings::where('order_id',$request['order'])->where('writer_id',$request['writer'])->count();
        if($bidExist){
            return back();
        }else{
            $orderId = $request['order'];
			Biddings::create([
                'order_id' => $request['order'],
                'writer_id' => $request['writer'],
                'writer_name' => $request['name'],
                'writer_email' => $request['email'],
                'writer_phone' => $request['phone'],
                'writer_rating' => $request['rating'],
            ]);

            $numberOfBids = Biddings::where('order_id',$orderId)->count();
            Orders::find($orderId)->update(['bids' => $numberOfBids]);
            
            return back();
			
        }

     }

     public function assign(Request $request, $id)
     {
        $writerId = $request['id'];
        $writerName = $request['name'];
        Orders::find($id)->update(['writer_id' => $writerId,'writer_name'=>$writerName,'order_status' => 1]);
        
        $userDetails = User::where('id',$writerId)->get();

        // Assign Mail
        $user = new User();
		$userDetails = Auth::user();
		$user->email = $userDetails["email"];
		$username = $userDetails["name"];
		$arr = array("user" => $username, "order" => $id);
        $user->notify(new Assigned($arr));
        
        return redirect('/admin/order/'.$id);

     }

     public function directAssign(Request $request, $id)
     {
        $writerId = $request['writer'];
        $writerName = User::where('id',$writerId)->pluck('name')->first();

        Orders::find($id)->update([
            'writer_id' => $request['writer'],
            'writer_name'=>$writerName,
            'order_status' => 1
        ]);

        $userDetails = User::where('id',$writerId)->get();

        // Assign Mail
        $user = new User();
        $userDetails = Auth::user();
        $user->email = $userDetails["email"];
        $username = $userDetails["name"];
        $arr = array("user" => $userDetails["email"],"order" => $id);
        $user->notify(new Assigned($arr));
        
        return redirect('/admin/order/'.$id);

     }

     public function setToDone($id)
     {

        Orders::find($id)->update(['order_status' => 5 ]);

        $adminEmail = User::where("category",1)->where('role','=','Administrator')->pluck("email")->first();
        
        // Done Mail
        $user = new User();
        $user->email = $adminEmail;
        $username = User::where("category",1)->where('role','=','Administrator')->pluck("name")->first();
        $arr = array("user" => $username, "order" => $id);
        $user->notify(new Done($arr));

        return ["success" => true, "message" => "You have successfully submitted the order as done. Our support team will review and give feedback."];

     }


     public function setToCancelled($id)
     {
        Orders::find($id)->update(['order_status' => 2 ]);

        $customerEmail = Orders::where("id",$id)->pluck("customer_email")->first();
        $customerName = Orders::where("id",$id)->pluck("customer_name")->first();

        return ["success" => true, "message" => "You have successfully cancelled this order."];

     }

     public function restoreOrder($id)
     {
        Orders::find($id)->update(['order_status' => 0 ]);

        $customerEmail = Orders::where("id",$id)->pluck("customer_email")->first();
        $customerName = Orders::where("id",$id)->pluck("customer_name")->first();

        return ["success" => true, "message" => "You have successfully restored this order."];

     }

    public function postMessage(Request $request,$id)
    { 
        
        $validator = Validator::make($request->all(), [
            'subject' => ['required'],
            'message' => ['required']
        ]);

        if ($validator->fails()){
            
            $subjectError = $validator->errors()->get('subject');
            $messageError = $validator->errors()->get('message');

            return ["subject" => $subjectError,"message" => $messageError];

        } else {

            $admin = User::where("category",1)->pluck('id')->first();
            $adminName = User::where("category",1)->pluck('name')->first();
            $writer = Orders::where("id",$id)->pluck('writer_id')->first();
            $writerName = Orders::where("id",$id)->pluck('writer_name')->first();

            if ($request->recipient == "support")
            {
                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->get("sender_id"),
                    "sender_name" => $request->get("sender_name"),
                    "sender_email" => $request->get("sender_email"),
                    "department" => $request->get("department"),
                    "recipient_id" => $admin,
                    "recipient" => "support",
                    "subject" => $request->get("subject"),
                    "message" => $request->get("message"),
                    "category" => 3,
                    "status" => 0,
                    "accessibility" => 0  
                ]);

                return ["success" => true, "message" => "You have successfully send your message to Support"];

            }else{

                Messages::create([
                    "order_id" => $id,
                    "sender_id" => $request->get("sender_id"),
                    "sender_name" => $request->get("sender_name"),
                    "sender_email" => $request->get("sender_email"),
                    "recipient_id" => $writer,
                    "recipient" => "writer",
                    "subject" => $request->get("subject"),
                    "message" => $request->get("message"),
                    "category" => 3,
                    "status" => 0,
                    "accessibility" => 0 
                ]);

                return ["success" => true, "message" => "You have successfully send your message to Support"];

            }

        }

    }

    public function replyMessage(Request $request,$id)
    {
        Messages::create([
            "order_id" => $request->get("order_id"),
            "sender_id" => $request->get("sender_id"),
            "sender_name" => $request->get("sender_name"),
            "sender_email" => $request->get("sender_email"),
            "recipient" => $request->get("recipient"),
            "department" => $request->get("department"),
            "subject" => $request->get("subject"),
            "message" => $request->get("message"),
            "category" => 2,
            "status" => 0,
            "reply_to" => $id,
            "accessibility" => 0
        ]);
        return back();
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
        'uploader' => "customer", 
        'order_id' => $id,
        'filename' => $fileNameToStore,
        'filetype' => $extension,
        'filesize' => $filesize,
        'category' => 1,
        'restriction' => 0,
        'display_name' => $filename,
        'path' => $path,
        'description' => $request->get('file_description'),
       ]);
    
       return back();

    }

}

