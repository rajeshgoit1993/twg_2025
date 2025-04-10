<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Sentinel;
use Validator;
use Mail;
use App\Packages;
use App\Query;
use App\rates;
use App\Icons;
use App\State;
use App\City;
use App\PackageHotel;
use App\ImportantNotes;
use App\PackageImageGallery;
use App\PkgPaymentPolicy;
use App\PkgCancelPolicy;
use App\PkgVisa;
use App\Transport;
use App\Quotation;
use App\QuotationHeader;
use App\QuotationFooter;
use App\Helpers\CustomHelpers;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;
use App\User;
use App\Voucher;
use DB;
use App\ActivateService;
class QueryController extends Controller
{
 
  public $mail_from_ids="tourquotes@theworldgateway.com"; 
  public $mail_to_cc="helpdesk@theworldgateway.com"; 
  public $mail_from_id="reservations@theworldgaeway.com";   
  public function index()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

      $employee_id=Sentinel::getUser()->id;
    
      if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
              ['lead_verified','=','1'],
              ['quo_send','=','0'],
              ["webnotation","=",env("WEBSITENAME")],
              ['delete_status','=',1]])
            
               ->where(function ($queries) {
               $queries->whereIn('status', ['na','interested','quote_sent'])
               ->orWhereNull('status');
               }
               )
               ->orderBy('created_at', 'desc')
               ->get();
      else:
        $queries = Query::where([
              ['lead_verified','=','1'],
              ['quo_send','=','0'],
              ['assign_id','=',$employee_id],
              ["webnotation","=",env("WEBSITENAME")],
              ['delete_status','=',1]])
            
               ->where(function ($queries) {
               $queries->whereIn('status', ['na','interested','quote_sent'])
               ->orWhereNull('status');
               }
               )
               ->orderBy('created_at', 'desc')
               ->get();
         
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.list',['queries'=>$queries,'employee'=>$employee]);

     else:
       return response()->view('error.404', [], 404);
     endif;

    }
    public function quote_accept(Request $request)
    {
         $id=CustomHelpers::custom_decrypt($request->quote_id);
         $data=Option1Quotation::find($id); 
         if($data):
          $data->accept_status=1;
          $data->save();
             return redirect()->back()->with("success","Quote Accepted");
         else:
           return redirect()->back()->with("error","Not Accepted");
         endif;
    }
    public function quote_reject(Request $request)
    {
         $id=CustomHelpers::custom_decrypt($request->quote_id);
         $data=Option1Quotation::find($id); 
         if($data):
          $data->accept_status=2;
          $data->save();
             return redirect()->back()->with("error","Quote Rejected");
         else:
           return redirect()->back()->with("error","Not Accepted");
         endif;
    }
    public function enquiry()
    {
     $check_data=ActivateService::where('services','=','leads')->first();
     if($check_data->activation==1):

       $queries = Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',1]])
            
               ->where(function ($queries) {
               $queries->whereIn('status', ['interested','not_interested','call_later','phone_not_reachable','wrong_number','destination_changed'])
               ->orWhereNull('status');
               }
               )
               ->orderBy('created_at', 'desc')
               ->get();
      return view('query.enquiry',['queries'=>$queries]);
      else:
       return response()->view('error.404', [], 404);
     endif;   
    }
     public function saved_quotation()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

      $employee_id=Sentinel::getUser()->id;
      
      if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['del_status','=',1],['send_option','=',0]])
                  ->orderBy('created_at', 'desc')
                  ->get();
     
      else:
       $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['assign_id','=',$employee_id],['del_status','=',1],['send_option','=',0]])
                  ->orderBy('created_at', 'desc')
                  ->get();
  
      endif;
      
        return view('query.saved_quotation',compact("data"));
        else:
       return response()->view('error.404', [], 404);
        endif;
    }
    public function quotation()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

      $employee_id=Sentinel::getUser()->id;
      
      if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['del_status','=',1]])
                  ->orderBy('created_at', 'desc')
                  ->get();
     
      else:
       $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['assign_id','=',$employee_id],['del_status','=',1]])
                  ->orderBy('created_at', 'desc')
                  ->get();
  
      endif;
      
        return view('query.quotation',compact("data"));
        else:
       return response()->view('error.404', [], 404);
        endif;
    }
    public function leads_follow_up()
    {
     $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
     if($check_data_lm->activation==1):
     $employee_id=Sentinel::getUser()->id;

     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
               ->whereIn('status', ['rates_negotiation','payment_follow_up'])
              ->orderBy('created_at', 'desc')
              ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                 ->whereIn('status', ['rates_negotiation','payment_follow_up'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.leadsfollowup.index',['queries'=>$queries,'employee'=>$employee]); 

      else:
       return response()->view('error.404', [], 404);
      endif;
     
    }
    public function payment()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):
       $employee_id=Sentinel::getUser()->id;

     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
              ->whereIn('status', ['advance_received','balance_payment'])
                  ->orderBy('created_at', 'desc')
              ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                 ->whereIn('status', ['advance_received','balance_payment'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.payment.index',['queries'=>$queries,'employee'=>$employee]); 
      else:
       return response()->view('error.404', [], 404);
     endif;

     
    }
    public function confirmation()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

       $employee_id=Sentinel::getUser()->id;

     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
               ->whereIn('status', ['full_payment_received'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                 ->whereIn('status', ['full_payment_received'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.confirmation.index',['queries'=>$queries,'employee'=>$employee]); 
     else:
       return response()->view('error.404', [], 404);
     endif;

    }
    public function cancelled_leads()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

       $employee_id=Sentinel::getUser()->id;

     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
               ->whereIn('status', ['booked_with_other','tour_cancelled','quote_rejected','no_response'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                  ->whereIn('status', ['booked_with_other','tour_cancelled','quote_rejected','no_response'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.cancelleads.index',['queries'=>$queries,'employee'=>$employee]); 
      else:
       return response()->view('error.404', [], 404);
      endif;
    }
    public function vouchers()
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

       $employee_id=Sentinel::getUser()->id;
    
     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
               ->whereIn('status', ['issue_vouchers','vouchers_issued','any_refund'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                  ->whereIn('status', ['issue_vouchers','vouchers_issued','any_refund'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.voucher.index',['queries'=>$queries,'employee'=>$employee]); 
      else:
       return response()->view('error.404', [], 404);
      endif;
    }
    public function post_tour(Request $request)
    {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):
      $employee_id=Sentinel::getUser()->id;

     if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['delete_status','=',1]])
               ->whereIn('status', ['tour_completed'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      else:
          $queries = Query::where([
                  ['webnotation','=',env("WEBSITENAME")],
                  ['assign_id','=',$employee_id],
                  ['delete_status','=',1]])
                  ->whereIn('status', ['tour_completed'])
                  ->orderBy('created_at', 'desc')
                  ->get();
      endif;  
        $role = Sentinel::findRoleById(15);
        
        $employee = $role->users()->with('roles')->get();
        
        return view('query.tourcomplete.index',['queries'=>$queries,'employee'=>$employee]);

        else:
       return response()->view('error.404', [], 404);
        endif; 
    }
    public function send_voucher_file(Request $request)
    {
     
     $this->validate($request,[
            "voucher"=>"required"]);
      $vouchers=$request->file('voucher');
      $filenames=[];
      foreach($vouchers as $voucher):
       $filename= uniqid(). $voucher->getClientOriginalName();
       $path = '/uploads/voucher/'.$filename;
        //move the file to correct location
       $voucher->move(public_path().'/uploads/voucher/', $filename);
       $filenames[]=$filename;
      endforeach;
      $data=Query::find($request->lead_id);
      $voucher_data=new Voucher;
      $voucher_data->lead_id=$request->lead_id;
      $voucher_data->voucher=serialize($filenames);
     
    
     if($voucher_data->save()):
     Mail::send('query.voucher.mail',compact("data"),function($message) use ($data,$filenames)
       {
      $message->from($this->mail_from_id);
      $message->to($data->email)->subject("Reservation Voucher");
      foreach($filenames as $filen):
        $file_path=public_path().'/'.('uploads/voucher/'.$filen);
        $message->attach($file_path);
       endforeach;
      });
     return redirect()->back()->with("success","Vouchers have been sent successfully");
      endif;
    }
    public function voucherlist(Request $request)
    {
      $data=Voucher::where('lead_id','=',$request->id)->get();
      if(count($data)!="" && count($data)!="0"):
        $output="";
        $output.="<table class='table table-striped'><tr>
        <th>S.No.</th>
        <th>Voucher List</th>
        <th>Date</th>
        </tr>";
        $i=0;
        foreach($data as $datas):
          $voucher=unserialize($datas->voucher);
          $date = date("d M Y H:i", strtotime($datas->created_at));
          foreach($voucher as $vouchers):
             $i++;
             $path=url('/public/uploads/voucher/'.$vouchers);
             $output.="<tr>
             <td>$i</td>
             <td><a href='$path' download>Download</a></td>
              <td>$date</td>";
           
             $output.="</tr>";
          endforeach;
         
        endforeach;
         $output.="</table>";
        echo "$output";
      else:
        echo "Data Not Found";
      endif;
    }
    public function resend(Request $request)
    {
      $data=Voucher::where('lead_id','=',$request->id)->get();
      $to=CustomHelpers::get_query_field($request->id,'email');
      if(count($data)!="" && count($data)!="0"):
       $vouchers_data=[];
        foreach($data as $datas):
          $voucher=unserialize($datas->voucher);
          
          foreach($voucher as $vouchers):
           $vouchers_data[]=$vouchers; 
          endforeach;
         
        endforeach;
          Mail::send('query.voucher.mail',compact("data"),function($message) use ($to,$vouchers_data)
       {

      $message->from($this->mail_from_id);
      $message->to($to)->subject("Reservation Voucher");
      foreach($vouchers_data as $filen):
        $file_path=public_path().'/'.('uploads/voucher/'.$filen);
        $message->attach($file_path);
       endforeach;
      });
       echo "successfully sended";
      else:
        echo "Data Not Found";
      endif;
    }
    public function deleted_leads()
    {
      $check_data=ActivateService::where('services','=','leads')->first();
      if($check_data->activation==1):
       $queries=Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',0]])
          
                  ->orderBy('created_at', 'desc')
                  ->get();
    
      return view('query.deleteleads.index',['queries'=>$queries]);
      else:
       return response()->view('error.404', [], 404);
      endif;
    }
    public function recover_lead(Request $request)
    {
     $query_id=$request->id;
     $assign_data1=Option1Quotation::where('query_reference','=',$query_id)->first();
      if(count($assign_data1)!="" && count($assign_data1)!="0"):
      $assign_data1->del_status=1;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($query_id);
      if(count($assign_data2)!="" && count($assign_data2)!="0"):
      $assign_data2->delete_status=1;
      $assign_data2->save();
      endif;
    }
    public function add_quotation()
    {
        return view('query.create');
    }
    public  function quo_first($id)
    {
     $data=Query::find($id);
     if (Sentinel::check())
     {
      if(Sentinel::getUser()->roles()->first()->slug == 'employee')
      {
        $user_id=Sentinel::getUser()->id;
        if($user_id!=$data->assign_id)
        {
         return redirect()->back()->with("error","Unassigned this quote");
        }
      }
      }
     return view('query.quo_first',compact("data"));
    }

    public function querys_days(request $request)
    {
      $select_day=$request->select_day;
      
     
      $days=$request->days;
      for($i=1;$i<=$days;$i++)
      {
      
           echo "<option value='Day ".$i."'>  Day $i</option>  ";
     
      }
    }
    public function option1(Request $request)
    { 
      $main_query=Query::find($request->query_id);
      $main_query->quo_send="1";
      $main_query->assign_id=Sentinel::getUser()->id;
      $main_query->save();
      
      $data=Option1Quotation::where("query_reference","=",$request->query_id)->first();
      if(count($data)=="0")
      {
       $data=new Option1Quotation;
      }
      $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
       $data->accept_status=0;
       $data->quote_view=0;
      endif;
     
      $unique_code=bin2hex(openssl_random_pseudo_bytes(10));
      $data->query_reference=$request->query_id;
      $data->name=$request->guest_name;
      $data->mobile=$request->guest_no;
      $data->email=$request->guest_email;
      $data->package_name=$request->package_name;
      $data->destination=$request->destination;
      $data->adult=$request->adult;
      $data->child=$request->child;
      $data->infant=$request->infant;
      $data->nationality=$request->nationality;
      $data->best_time_call=$request->best_time_call;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option1_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option1_price=serialize($request->price);
      $data->option1_accommodation=serialize($request->accommodation);
      $data->option1_transport=$request->transport;
      $data->option1_transport_description=$request->transport_description;
      $data->option1_flight=serialize($request->flight);
      $data->option1_description=$request->description;
      $data->option1_highlights=$request->highlights;
      $data->option1_inclusions=$request->inclusions;
      $data->option1_exclusions=$request->exclusions;
      
      $data->option1_dayItinerary=serialize($request->dayItinerary);
      $data->option1_visa=$request->visa;
      $data->option1_package_visa=serialize($request->package_visa);
      $data->option1_visa_policies=$request->visa_policies;
      $data->option1_package_payment=serialize($request->package_payment);
      $data->option1_payment_policies=$request->payment_policies;
      $data->option1_package_can=serialize($request->package_can);
      $data->option1_cancellation=$request->cancellation;
      $data->option1_package_impnotes=serialize($request->package_impnotes);
      $data->option1_extra_imp=$request->extra_imp;
      $data->option1_validaty=$request->validaty;
      $data->option1_quotation_header=serialize($request->quotation_header);
      $data->option1_quotation_header_extra=$request->quotation_header_extra;
      $data->option1_quotation_footer=serialize($request->quotation_footer);
      $data->option1_quotation_footer_extra=$request->quotation_footer_extra;
      $data->package_service =  serialize($request->package_service);
        if(env("WEBSITENAME")==1):
        $data->webnotation =1;
        elseif(env("WEBSITENAME")==0):
        $data->webnotation =0;
         endif;
       $data->source=$request->source;
       $data->unique_code=$unique_code;
       $data->assign_id=Sentinel::getUser()->id;
       $data->status="1";
       $year=date("Y");
       $month=date("m");
       $date=date("d");

       if($data->save())
        {
        //

      //
         $reference="91".date("Y").$date.$month.$data->id;
        
         $to=$request->guest_email;
         $data=Option1Quotation::find($data->id);
         $data->quo_ref=$reference;
         $data->save();
         $send_option=$request->send_option;
         if($send_option=="0"):
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$reference)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
               });

      //
       endif;
      //


      $data_option2=new Option2Quotation; 
      $data_option2->quotation_ref_no=$reference; 
      $data_option2->query_reference=$request->query_id;
      $data_option2->custom_package_name=$request->custom_package_name;
      $data_option2->duration=$request->duration;
      $data_option2->unique_code=$unique_code;
      $data_option2->save(); 
      $data_option3=new Option3Quotation; 
      $data_option3->quotation_ref_no=$reference; 
      $data_option3->query_reference=$request->query_id;
      $data_option3->custom_package_name=$request->custom_package_name;
      $data_option3->duration=$request->duration;
      $data_option3->unique_code=$unique_code;
      $data_option3->save(); 
      $data_option4=new Option4Quotation;
      $data_option4->quotation_ref_no=$reference; 
      $data_option4->query_reference=$request->query_id;
      $data_option4->custom_package_name=$request->custom_package_name;
      $data_option4->duration=$request->duration;
      $data_option4->unique_code=$unique_code;
      $data_option4->save();  
          
          //
      $send_option=$request->send_option;
         if($send_option=="0"):

        $data=Option1Quotation::find($data->id);      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;  
         //
 
           



        }

    }
    public function send_custom_quote(Request $request)
    {
      $quote_id=$request->quote_id;
      $quote_no=$request->quote_no;
      $ref_no=$request->ref_no;
      
      $assign_data1=Option1Quotation::where('query_reference','=',$ref_no)->first();
      if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($ref_no);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;

      if($quote_no=="1"):
        $data=Option1Quotation::find($quote_id);
        if($data):
          //mail
          $data->send_option=1;
          $data->accept_status=0;
          $data->quote_view=0;
          $data->save();
          $to=$data->email;
          $reference=$data->quo_ref;
          Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$reference)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
               });
          //message
       
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
            //

        else:
        return redirect ('/quotation')->with('message', "Data Not Found");
        endif;

      elseif($quote_no=="2"):
        $data=Option2Quotation::find($quote_id);
        if($data):
          $data->send_option=1;
          $data->save();
          //
         $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
        
         $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail2',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                  $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
          //
        $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
            //
          //
        else:
        return redirect ('/quotation')->with('message', "Data Not Found");
        endif;  
      elseif($quote_no=="3"):
         $data=Option3Quotation::find($quote_id);
        if($data):
           //
          $data->send_option=1;
          $data->save();
         $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
        
       $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail3',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
        //
        $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
            //
        else:
        return redirect ('/quotation')->with('message', "Data Not Found");
        endif;
      elseif($quote_no=="4"): 
      $data=Option4Quotation::find($quote_id);
        if($data):
          //
          $data->send_option=1;
          $data->save();
         $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         
             $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail4',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
         //
        $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
            //
        else:
        return redirect ('/quotation')->with('message', "Data Not Found");
        endif; 
      endif;
      // return redirect ('/quotation')->with('message', "Thank you ! Quotation has been sent successfully On E-Mail.");
    }
    public function option1_store(Request $request)
    {
      $main_query=Query::find($request->query_id);
      $main_query->quo_send="1";
      $main_query->assign_id=Sentinel::getUser()->id;
      $main_query->save();

      $id=$request->custom_id;
     
      $data=Option1Quotation::where('quo_ref',$id)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
       $data->accept_status=0;
       $data->quote_view=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->name=$request->guest_name;
      $data->mobile=$request->guest_no;
      $data->email=$request->guest_email;
      $data->package_name=$request->package_name;
      $data->destination=$request->destination;
      $data->adult=$request->adult;
      $data->child=$request->child;
      $data->infant=$request->infant;
      $data->nationality=$request->nationality;
      $data->best_time_call=$request->best_time_call;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option1_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option1_price=serialize($request->price);
      $data->option1_accommodation=serialize($request->accommodation);
      $data->option1_transport=$request->transport;
      $data->option1_transport_description=$request->transport_description;
      $data->option1_flight=serialize($request->flight);
      $data->option1_description=$request->description;
      $data->option1_highlights=$request->highlights;
      $data->option1_inclusions=$request->inclusions;
      $data->option1_exclusions=$request->exclusions;
      
      $data->option1_dayItinerary=serialize($request->dayItinerary);
      $data->option1_visa=$request->visa;
      $data->option1_package_visa=serialize($request->package_visa);
      $data->option1_visa_policies=$request->visa_policies;
      $data->option1_package_payment=serialize($request->package_payment);
      $data->option1_payment_policies=$request->payment_policies;
      $data->option1_package_can=serialize($request->package_can);
      $data->option1_cancellation=$request->cancellation;
      $data->option1_package_impnotes=serialize($request->package_impnotes);
      $data->option1_extra_imp=$request->extra_imp;
      $data->option1_validaty=$request->validaty;
      $data->option1_quotation_header=serialize($request->quotation_header);
      $data->option1_quotation_header_extra=$request->quotation_header_extra;
      $data->option1_quotation_footer=serialize($request->quotation_footer);
      $data->option1_quotation_footer_extra=$request->quotation_footer_extra;
      $data->package_service =  serialize($request->package_service);
      $data->source=$request->source;
      $data->assign_id=Sentinel::getUser()->id;
       $data->status="1";
        if(env("WEBSITENAME")==1):
        $data->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
        $data->webnotation = 0;
         endif;
       if($data->save())
       {

         $send_option=$request->send_option;
         if($send_option=="0"):
         
         $data=Option1Quotation::find($data->id);
         $to=$data->email;
         $ref_no=$data->quo_ref;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });

        
         // 
        $data=Option1Quotation::find($data->id);

       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail .');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //
      
        }
    }
    public function option2(Request $request)
    { 
      
      $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();

      if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($request->query_id);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;
      $data=Option2Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;

      endif;
      $data->query_reference=$request->query_id;
      $data->quotation_ref_no=$request->quotation_ref_no;
     
      $data->custom_package_name=$request->custom_package_name;
      $data->option2_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option2_price=serialize($request->price);
      $data->option2_accommodation=serialize($request->accommodation);
      $data->option2_transport=$request->transport;
      $data->option2_transport_description=$request->transport_description;
      $data->option2_flight=serialize($request->flight);
      $data->option2_description=$request->description;
      $data->option2_highlights=$request->highlights;
      $data->option2_inclusions=$request->inclusions;
      $data->option2_exclusions=$request->exclusions;
      $data->duration=$request->duration;
      $data->option2_dayItinerary=serialize($request->dayItinerary);
      $data->option2_visa=$request->visa;
      $data->option2_package_visa=serialize($request->package_visa);
      $data->option2_visa_policies=$request->visa_policies;
      $data->option2_package_payment=serialize($request->package_payment);
      $data->option2_payment_policies=$request->payment_policies;
      $data->option2_package_can=serialize($request->package_can);
      $data->option2_cancellation=$request->cancellation;
      $data->option2_package_impnotes=serialize($request->package_impnotes);
      $data->option2_extra_imp=$request->extra_imp;
      $data->option2_validaty=$request->validaty;
      $data->option2_quotation_header=serialize($request->quotation_header);
      $data->option2_quotation_header_extra=$request->quotation_header_extra;
      $data->option2_quotation_footer=serialize($request->quotation_footer);
      $data->option2_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
        $data->status="1";
       if($data->save()){

        //
        $send_option=$request->send_option;
         if($send_option=="0"):
         $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         $data=Option2Quotation::find($data->id);
         $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail2',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
          //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //
        }

    }
    public function option3(Request $request)
    { 
     
      $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();

      if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($request->query_id);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;
      $data=Option3Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->quotation_ref_no=$request->quotation_ref_no;

      $data->custom_package_name=$request->custom_package_name;
      $data->option3_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option3_price=serialize($request->price);
      $data->option3_accommodation=serialize($request->accommodation);
      $data->option3_transport=$request->transport;
      $data->option3_transport_description=$request->transport_description;
      $data->option3_flight=serialize($request->flight);
      $data->option3_description=$request->description;
      $data->option3_highlights=$request->highlights;
      $data->option3_inclusions=$request->inclusions;
      $data->option3_exclusions=$request->exclusions;
      $data->duration=$request->duration;
      $data->option3_dayItinerary=serialize($request->dayItinerary);
      $data->option3_visa=$request->visa;
      $data->option3_package_visa=serialize($request->package_visa);
      $data->option3_visa_policies=$request->visa_policies;
      $data->option3_package_payment=serialize($request->package_payment);
      $data->option3_payment_policies=$request->payment_policies;
      $data->option3_package_can=serialize($request->package_can);
      $data->option3_cancellation=$request->cancellation;
      $data->option3_package_impnotes=serialize($request->package_impnotes);
      $data->option3_extra_imp=$request->extra_imp;
      $data->option3_validaty=$request->validaty;
      $data->option3_quotation_header=serialize($request->quotation_header);
      $data->option3_quotation_header_extra=$request->quotation_header_extra;
      $data->option3_quotation_footer=serialize($request->quotation_footer);
      $data->option3_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
        $data->status="1";
       if($data->save()){

        //
        $send_option=$request->send_option;
         if($send_option=="0"):
         $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         $data=Option3Quotation::find($data->id);
       $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail3',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
        //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //
        }

    }
    public function option4(Request $request)
    { 
       $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();

      if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($request->query_id);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;
      $data=Option4Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->quotation_ref_no=$request->quotation_ref_no;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option4_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option4_price=serialize($request->price);
      $data->option4_accommodation=serialize($request->accommodation);
      $data->option4_transport=$request->transport;
      $data->option4_transport_description=$request->transport_description;
      $data->option4_flight=serialize($request->flight);
      $data->option4_description=$request->description;
      $data->option4_highlights=$request->highlights;
      $data->option4_inclusions=$request->inclusions;
      $data->option4_exclusions=$request->exclusions;
      
      $data->option4_dayItinerary=serialize($request->dayItinerary);
      $data->option4_visa=$request->visa;
      $data->option4_package_visa=serialize($request->package_visa);
      $data->option4_visa_policies=$request->visa_policies;
      $data->option4_package_payment=serialize($request->package_payment);
      $data->option4_payment_policies=$request->payment_policies;
      $data->option4_package_can=serialize($request->package_can);
      $data->option4_cancellation=$request->cancellation;
      $data->option4_package_impnotes=serialize($request->package_impnotes);
      $data->option4_extra_imp=$request->extra_imp;
      $data->option4_validaty=$request->validaty;
      $data->option4_quotation_header=serialize($request->quotation_header);
      $data->option4_quotation_header_extra=$request->quotation_header_extra;
      $data->option4_quotation_footer=serialize($request->quotation_footer);
      $data->option4_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
        $data->status="1";
       if($data->save()){
         //
        $send_option=$request->send_option;
         if($send_option=="0"):
         $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         $data=Option4Quotation::find($data->id);
             $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail4',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
//
         //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //

        }

    }
    public function copy_option1(Request $request)
    { 
      $main_query=Query::find($request->query_id);
      $main_query->quo_send="1";
      $main_query->save();

      $unique_code=bin2hex(openssl_random_pseudo_bytes(10));
      $data=Option1Quotation::where("query_reference","=",$request->query_id)->get()->first();
      if($data=='')
      {
       $data=new Option1Quotation;
      }
      
      $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->name=$request->guest_name;
      $data->mobile=$request->guest_no;
      $data->email=$request->guest_email;
      $data->package_name=$request->package_name;
      $data->destination=$request->destination;
      $data->adult=$request->adult;
      $data->child=$request->child;
      $data->infant=$request->infant;
      $data->nationality=$request->nationality;
      $data->best_time_call=$request->best_time_call;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option1_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->admin_remarks=$request->admin_remarks;
      $data->remarks=$request->remarks;
      $data->option1_price=serialize($request->price);
      $data->option1_accommodation=serialize($request->accommodation);
      $data->option1_transport=$request->transport;
      $data->option1_transport_description=$request->transport_description;
      $data->option1_flight=serialize($request->flight);
      $data->option1_description=$request->description;
      $data->option1_highlights=$request->highlights;
      $data->option1_inclusions=$request->inclusions;
      $data->option1_exclusions=$request->exclusions;
      
      $data->option1_dayItinerary=serialize($request->dayItinerary);
      $data->option1_visa=$request->visa;
      $data->option1_package_visa=serialize($request->package_visa);
      $data->option1_visa_policies=$request->visa_policies;
      $data->option1_package_payment=serialize($request->package_payment);
      $data->option1_payment_policies=$request->payment_policies;
      $data->option1_package_can=serialize($request->package_can);
      $data->option1_cancellation=$request->cancellation;
      $data->option1_package_impnotes=serialize($request->package_impnotes);
      $data->option1_extra_imp=$request->extra_imp;
      $data->option1_validaty=$request->validaty;
      $data->option1_quotation_header=serialize($request->quotation_header);
      $data->option1_quotation_header_extra=$request->quotation_header_extra;
      $data->option1_quotation_footer=serialize($request->quotation_footer);
      $data->option1_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
      $data->unique_code=$unique_code;
      $data->package_service =  serialize($request->package_service);
        if(env("WEBSITENAME")==1):
        $data->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
        $data->webnotation = 0;
         endif;
      $data->status="1";
       $year=date("Y");
       $month=date("m");
       $date=date("d");
       if($data->save())
         {
      //
        $reference="91".date("Y").$date.$month.$data->id;
        
         $to=$request->guest_email;
         $data=Option1Quotation::find($data->id);
         $data->quo_ref=$reference;
         $data->save();
        $send_option=$request->send_option;
         if($send_option=="0"):
          
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$reference)
               {
                   $message1->from($this->mail_from_ids);
                    $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
               });
      
      endif;    

          //
      $data_option2=new Option2Quotation; 
      $data_option2->quotation_ref_no=$reference; 
      $data_option2->query_reference=$request->query_id;
      $data_option2->custom_package_name=$request->custom_package_name;
      $data_option2->duration=$request->duration;
      
      $quotation2_data=Option2Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first();
     
      if($quotation2_data!="" && count($quotation2_data)!="0")
      {
        
      
      $data_option2->option2_price_type=$quotation2_data->option2_price_type;
      $data_option2->anything=$quotation2_data->anything;
      $data_option2->remarks=$quotation2_data->remarks;
      $data_option2->admin_remarks=$quotation2_data->admin_remarks;
      $data_option2->option2_price=$quotation2_data->option2_price;
      $data_option2->option2_accommodation=$quotation2_data->option2_accommodation;
      $data_option2->option2_transport=$quotation2_data->option2_transport;
      $data_option2->option2_transport_description=$quotation2_data->option2_transport_description;
      $data_option2->option2_flight=$quotation2_data->option2_flight;
      $data_option2->option2_description=$quotation2_data->option2_description;
      $data_option2->option2_highlights=$quotation2_data->option2_highlights;
      $data_option2->option2_inclusions=$quotation2_data->option2_inclusions;
      $data_option2->option2_exclusions=$quotation2_data->option2_exclusions;
      
      $data_option2->option2_dayItinerary=$quotation2_data->option2_dayItinerary;
      $data_option2->option2_visa=$quotation2_data->option2_visa;
      $data_option2->option2_package_visa=$quotation2_data->option2_package_visa;
      $data_option2->option2_visa_policies=$quotation2_data->option2_visa_policies;
      $data_option2->option2_package_payment=$quotation2_data->option2_package_payment;
      $data_option2->option2_payment_policies=$quotation2_data->option2_payment_policies;
      $data_option2->option2_package_can=$quotation2_data->option2_package_can;
      $data_option2->option2_cancellation=$quotation2_data->option2_cancellation;
      $data_option2->option2_package_impnotes=$quotation2_data->option2_package_impnotes;
      $data_option2->option2_extra_imp=$quotation2_data->option2_extra_imp;
      $data_option2->option2_validaty=$quotation2_data->option2_validaty;
      $data_option2->option2_quotation_header=$quotation2_data->option2_quotation_header;
      $data_option2->option2_quotation_header_extra=$quotation2_data->option2_quotation_header_extra;
      $data_option2->option2_quotation_footer=$quotation2_data->option2_quotation_footer;
      $data_option2->option2_quotation_footer_extra=$quotation2_data->option2_quotation_footer_extra;
      }
      $data_option2->unique_code=$unique_code;
      $data_option2->save(); 
      $data_option3=new Option3Quotation; 
      $data_option3->quotation_ref_no=$reference; 
      $data_option3->query_reference=$request->query_id;
      $data_option3->custom_package_name=$request->custom_package_name;
      $data_option3->duration=$request->duration;
      $quotation3_data=Option3Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first(); 
       if($quotation3_data!="" && count($quotation3_data)!="0")
      {
        
      $data_option3->option3_price_type=$quotation3_data->option3_price_type;
      $data_option3->anything=$quotation3_data->anything;
      $data_option3->remarks=$quotation3_data->remarks;
      $data_option3->admin_remarks=$quotation3_data->admin_remarks;
      $data_option3->option3_price=$quotation3_data->option3_price;
      $data_option3->option3_accommodation=$quotation3_data->option3_accommodation;
      $data_option3->option3_transport=$quotation3_data->option3_transport;
      $data_option3->option3_transport_description=$quotation3_data->option3_transport_description;
      $data_option3->option3_flight=$quotation3_data->option3_flight;
      $data_option3->option3_description=$quotation3_data->option3_description;
      $data_option3->option3_highlights=$quotation3_data->option3_highlights;
      $data_option3->option3_inclusions=$quotation3_data->option3_inclusions;
      $data_option3->option3_exclusions=$quotation3_data->option3_exclusions;
      
      $data_option3->option3_dayItinerary=$quotation3_data->option3_dayItinerary;
      $data_option3->option3_visa=$quotation3_data->option3_visa;
      $data_option3->option3_package_visa=$quotation3_data->option3_package_visa;
      $data_option3->option3_visa_policies=$quotation3_data->option3_visa_policies;
      $data_option3->option3_package_payment=$quotation3_data->option3_package_payment;
      $data_option3->option3_payment_policies=$quotation3_data->option3_payment_policies;
      $data_option3->option3_package_can=$quotation3_data->option3_package_can;
      $data_option3->option3_cancellation=$quotation3_data->option3_cancellation;
      $data_option3->option3_package_impnotes=$quotation3_data->option3_package_impnotes;
      $data_option3->option3_extra_imp=$quotation3_data->option3_extra_imp;
      $data_option3->option3_validaty=$quotation3_data->option3_validaty;
      $data_option3->option3_quotation_header=$quotation2_data->option3_quotation_header;
      $data_option3->option3_quotation_header_extra=$quotation3_data->option3_quotation_header_extra;
      $data_option3->option3_quotation_footer=$quotation3_data->option3_quotation_footer;
      $data_option3->option3_quotation_footer_extra=$quotation3_data->option3_quotation_footer_extra;
      $data_option3->source=$quotation3_data->source;
      }
      $data_option3->unique_code=$unique_code;
      $data_option3->save(); 
      $data_option4=new Option4Quotation;
      $data_option4->quotation_ref_no=$reference; 
      $data_option4->query_reference=$request->query_id;
      $data_option4->custom_package_name=$request->custom_package_name;
      $data_option4->duration=$request->duration;
      $quotation4_data=Option4Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first(); 
       if($quotation4_data!="" && count($quotation4_data)!="0")
      {
        $data_option4->option4_price_type=$quotation4_data->option4_price_type;
        $data_option4->anything=$quotation4_data->anything;
        $data_option4->remarks=$quotation4_data->remarks;
        $data_option4->admin_remarks=$quotation4_data->admin_remarks;
      $data_option4->option4_price=$quotation4_data->option4_price;
      $data_option4->option4_accommodation=$quotation4_data->option4_accommodation;
      $data_option4->option4_transport=$quotation4_data->option4_transport;
      $data_option4->option4_transport_description=$quotation4_data->option4_transport_description;
      $data_option4->option4_flight=$quotation4_data->option4_flight;
      $data_option4->option4_description=$quotation4_data->option4_description;
      $data_option4->option4_highlights=$quotation4_data->option4_highlights;
      $data_option4->option4_inclusions=$quotation4_data->option4_inclusions;
      $data_option4->option4_exclusions=$quotation4_data->option4_exclusions;
      
      $data_option4->option4_dayItinerary=$quotation4_data->option4_dayItinerary;
      $data_option4->option4_visa=$quotation4_data->option4_visa;
      $data_option4->option4_package_visa=$quotation4_data->option4_package_visa;
      $data_option4->option4_visa_policies=$quotation4_data->option4_visa_policies;
      $data_option4->option4_package_payment=$quotation4_data->option4_package_payment;
      $data_option4->option4_payment_policies=$quotation4_data->option4_payment_policies;
      $data_option4->option4_package_can=$quotation4_data->option4_package_can;
      $data_option4->option4_cancellation=$quotation4_data->option4_cancellation;
      $data_option4->option4_package_impnotes=$quotation4_data->option4_package_impnotes;
      $data_option4->option4_extra_imp=$quotation4_data->option4_extra_imp;
      $data_option4->option4_validaty=$quotation4_data->option4_validaty;
      $data_option4->option4_quotation_header=$quotation4_data->option4_quotation_header;
      $data_option4->option4_quotation_header_extra=$quotation4_data->option4_quotation_header_extra;
      $data_option4->option4_quotation_footer=$quotation4_data->option4_quotation_footer;
      $data_option4->option4_quotation_footer_extra=$quotation4_data->option4_quotation_footer_extra;
      $data_option4->source=$quotation4_data->source;
      }  
      $data_option4->unique_code=$unique_code;
      $data_option4->save();  
      
      //
      $send_option=$request->send_option;
         if($send_option=="0"):
        $data=Option1Quotation::find($data->id);      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect ('/quotation')->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //


        }

      
  
    }
    public function quotation_details_first($id) {
     $unique_code=$id;
    
     $data1=Option1Quotation::where('unique_code','=',$unique_code)->first();
   
     $data2=Option2Quotation::where('unique_code','=',$unique_code)->first();

    $data3=Option3Quotation::where('unique_code','=',$unique_code)->first();
   
     $data4=Option4Quotation::where('unique_code','=',$unique_code)->first();
   
    if(Sentinel::check()) {

    if(Sentinel::getUser()->roles()->first()->slug == 'super_admin' || Sentinel::getUser()->roles()->first()->slug == 'administrator' || Sentinel::getUser()->roles()->first()->slug == 'employee') {
      

      if($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="0" && $data3!="" && $data3!="0" && $data3->status=="0" && $data4!="" && $data4!="0" && $data4->status=="0"):
      return view("query.quotation_webpage.first",compact("data1"));
      elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="0" && $data4!="" && $data4!="0" && $data4->status=="0"):
      return view("query.quotation_webpage.second",compact("data2","data1"));
      elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="1" && $data4!="" && $data4!="0" && $data4->status=="0"):
      return view("query.quotation_webpage.three",compact("data3","data2","data1"));
      elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="1" && $data4!="" && $data4!="0" && $data4->status=="1"):
      
      return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
      else:
      return redirect('/');
      endif;
      }
    }
    else
    {

    
    if($data1!="" && $data1!="0" && $data1->send_option=="1"  && $data2!="" && $data2!="0" && $data2->send_option=="0" && $data3!="" && $data3!="0" && $data3->send_option=="0" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
    $data1->quote_view=1;
      $data1->save();
     return view("query.quotation_webpage.first",compact("data1"));

    elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="0" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
      $data1->quote_view=1;
      $data1->save();
      return view("query.quotation_webpage.second",compact("data2","data1"));

    elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="1" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
        $data1->quote_view=1;
        $data1->save();
       return view("query.quotation_webpage.three",compact("data3","data2","data1"));

    elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="1" && $data4!="" && $data4!="0" && $data4->send_option=="1"):
       
       $data1->quote_view=1;
       $data1->save();
       return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
     
    else:
        return redirect('/');
    endif;
   }

    }
    

    public function quotation_details_second($id)
    {
      $unique_code=$id;
      $data2=Option2Quotation::where('unique_code','=',$unique_code)->first();
       if(count($data2)!="" && count($data2)!="0"):
         $data1=Option1Quotation::where('id','=',$data2->quotation_ref_no)->first();
      return view("query.quotation_webpage.second",compact("data2","data1"));
      else:
        return redirect('/');
      endif;
     
     
    }
    public function quotation_details_three($id)
    {
      $unique_code=$id;
      $data3=Option3Quotation::where('unique_code','=',$unique_code)->first();
      if(count($data3)!="" && count($data3)!="0"):
         $data1=Option1Quotation::where('id','=',$data3->quotation_ref_no)->first();
         $data2=Option2Quotation::where('quotation_ref_no','=',$data3->quotation_ref_no)->first();
      return view("query.quotation_webpage.three",compact("data3","data2","data1"));
      else:
        return redirect('/');
      endif;

    }

    public function quotation_details_four($id)
    {
      $unique_code=$id;
      $data4=Option4Quotation::where('unique_code','=',$unique_code)->first();
      if(count($data4)!="" && count($data4)!="0"):
         $data1=Option1Quotation::where('id','=',$data4->quotation_ref_no)->first();
         $data2=Option2Quotation::where('quotation_ref_no','=',$data4->quotation_ref_no)->first();
         $data3=Option3Quotation::where('quotation_ref_no','=',$data4->quotation_ref_no)->first();
      return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
      else:
        return redirect('/');
      endif;

    }

    public function mail_test()
    {
      $to="rapidexholidays@gmail.com";
      //$data=Option1Quotation::find('28');
      $data=Option1Quotation::find('13');;
        //mail sending to client
         Mail::send('query.mail.test',compact('data')
           
           , function($message1) use ($to)
               {
                   $message1->from('tourquotes@theworldgateway.com');
                   $message1->to($to)->subject("Thanks for your enquiry.")->bcc('helpdesk@theworldgateway.com');
                  
               });
    }
    public function mail_test1()
    {
      $data=Option1Quotation::find('13');
      $email=$this->get_hide_mail($data->email);

      $this->quote_sms($data->mobile,$email,$data->quo_ref);
      return view('query.mail.test',compact('data'));
    }
    public function get_hide_mail($email)
    {
       
             $email = $email;

        $em = explode("@",$email);
        $name = $em[0];
        $len = strlen($name);
        $showLen = floor($len/2);
        $str_arr = str_split($name);
        for($ii=$showLen;$ii<$len;$ii++){
         $str_arr[$ii] = '*';
        }
        $em[0] = implode('',$str_arr); 
        $new_name = implode('@',$em);

        return $new_name;
    }
    public function quote_sms($mobile,$name,$ref)
    {
      $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";

      $number=$mobile;
      $number = preg_replace('/\s/', '', $number);
      $mobile_code="91";
     
      $numbers = array($mobile_code.$number);
      
      $sender = urlencode('UPDATE');
      
    
      $message = rawurlencode(" We have sent the Tour quote on your email-id. Click on the link to check your quote: $ref");
      $numbers = implode(',', $numbers);
      
      $response=$this->sendSms($apiKey,$numbers, $message, $sender);
      $response=json_decode($response);
     
    if($response->status=="success")
    {
       return "success";
    }
    elseif ($response->status=="failure") 
    {
      return "Fail";
    }

     //status
    }

    public function sendSms($apiKey,$numbers,$message, $sender)
    {

      // Prepare data for POST request
      $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
    }

    public function quo_copy($id)
    {
     $data=Query::find($id);
     return view('query.quo_second',compact("data")); 
    }
    public function edit_quation($id,$id2)
    {
    
    $data=Query::find($id2);
    $rates =rates::all();
    $paymentPolicy = PkgPaymentPolicy::where('status','1')->get();
    $cancelPolicy = PkgCancelPolicy::where('status','1')->get();
    $visaPolicy = PkgVisa::where('status','1')->get();
    $imp_notes=ImportantNotes::all();
    $package_hotel=PackageHotel::all();
    $transport=Transport::all();
    $quotation_header=QuotationHeader::all();
    $quotation_footer=QuotationFooter::all();
    $reference_data=Option1Quotation::where('quo_ref',$id)->get()->first();
    $reference_data2=Option2Quotation::where('quotation_ref_no',$id)->get()->first();
    $reference_data3=Option3Quotation::where('quotation_ref_no',$id)->get()->first(); 
    $reference_data4=Option4Quotation::where('quotation_ref_no',$id)->get()->first(); 
    $custom_id=$id;
    $icons    =Icons::all();
    return view('query.quotationedit.edit',compact("data","rates","paymentPolicy","cancelPolicy","visaPolicy","imp_notes","package_hotel","transport","quotation_header","quotation_footer","reference_data","custom_id","reference_data2","reference_data3","reference_data4",'icons'));  
    }
    public function copy_reference($id,Request $request)
    {
      $id=$id;
      $data=Query::find($id);
      $rates =rates::all();
      $paymentPolicy = PkgPaymentPolicy::where('status','1')->get();
      $cancelPolicy = PkgCancelPolicy::where('status','1')->get();
      $visaPolicy = PkgVisa::where('status','1')->get();
      $imp_notes=ImportantNotes::all();
      $package_hotel=PackageHotel::all();
      $transport=Transport::all();
      $quotation_header=QuotationHeader::all();
      $quotation_footer=QuotationFooter::all();
      $icons    =Icons::all();
      $select_type=$request->select_type;
      $custom_id="";
      if($select_type=="1"):
      $reference_data=Option1Quotation::where('quo_ref',$request->q_reference_no)->get()->first();
      
      if($reference_data):
      return view('query.edit_reference.edit',compact("data","rates","paymentPolicy","cancelPolicy","visaPolicy","imp_notes","package_hotel","transport","quotation_header","quotation_footer","reference_data","custom_id",'icons'));  
      else:
        return redirect()->back()->with('warning', 'Enter Correct Quotation Reference Id');   ;
      endif;
      

      elseif($select_type=="2"):
     
      $reference_data=Packages::where('title',$request->q_reference_no)->first();
          if($reference_data!=''):
      return view('query.edit_reference.edit_package_name',compact("data","rates","paymentPolicy","cancelPolicy","visaPolicy","imp_notes","package_hotel","transport","quotation_header","quotation_footer","reference_data","custom_id",'icons'));  
      else:
        return redirect()->back()->with('warning', 'Enter Correct Package Name');   ;
      endif;
      endif;
      
       
    }
    public function quo_new($id)
    {
      $data=Query::find($id);

      $rates    =rates::all();
      $paymentPolicy = PkgPaymentPolicy::where('status','1')->get();
      $cancelPolicy = PkgCancelPolicy::where('status','1')->get();
      $visaPolicy = PkgVisa::where('status','1')->get();
      $imp_notes=ImportantNotes::all();
      $package_hotel=PackageHotel::all();
      $transport=Transport::all();
      $quotation_header=QuotationHeader::all();
      $quotation_footer=QuotationFooter::all();
      $icons    =Icons::all();
      return view('query.create',compact("data","rates","paymentPolicy","cancelPolicy","visaPolicy","imp_notes","package_hotel","transport","quotation_header","quotation_footer",'icons'));  
    }
    public function saveQuery(Request $request){
     

       
       /* $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required'              
                          
        ]);

        $query = new Query;
        if(Sentinel::check()){
            $query->userId = Sentinel::getUser()->id;

        }

        $query->packageId = $request->packageId;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->mobile = $request->mobile;
        $query->message = $request->message;


        if($query->save()){
            return redirect ('/packages-detail/'.Crypt::encrypt(['id'=>$request->packageId]))->with('message', 'Thanks You! Your query has been submitted.');
        }*/

    $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'time_call' => 'required',
            'city_of_residence' => 'required',
            'country_of_residence' => 'required',
            'destinations' => 'required', 
            'date_arrival' => 'required'               
                          
        ]); 
     
    $query = new Query;
    $query->packageId = $request->packageId;
    $query->name = $request->name;
    $query->email = $request->email;
    $query->mobile = $request->mobile;
    $query->message = $request->message;
    $query->city_of_residence = $request->city_of_residence;
    $query->country_of_residence = $request->country_of_residence;
    $query->destinations = $request->destinations;
    $query->date_arrival = $request->date_arrival;
    $query->duration = $request->duration;
    $query->span_value_adult = $request->span_value_adult;
    $query->span_value_child = $request->span_value_child;
    $query->span_value_infant = $request->span_value_infant;
    $query->hotel_pre = $request->hotel_pre;
    $query->exp_budget = $request->exp_budget;
    $query->time_call = $request->time_call;
    $query->accept_value = $request->accept_value;
    $query->package_name = $request->package_name;
      if(env("WEBSITENAME")==1):
    $query->webnotation = 1;
    elseif(env("WEBSITENAME")==0):
    $query->webnotation = 0;
    endif;

       if($query->save()){
            return redirect ('/packages-detail/'.Crypt::encrypt(['id'=>$request->packageId]))->with('message', 'Thanks You! Your query has been submitted.');
        }



    }
    public function query_status(Request $request)
    {
        $id=$request->id;
        $status=$request->status_value;

        $data=Query::find($id);
        $data->status=$status;
        $data->save();
    }
    public function role_assign(Request $request)
    {
        $id=$request->id;
        $assign_id=$request->assign_id;

        $data=Query::find($id);
        $data->assign_id=$assign_id;
        $data->save();
        $data1=Option1Quotation::where("query_reference","=",$id)->first();
        if($data1):
        $data1->assign_id=$assign_id;
        $data1->save();
        endif;
    }
   
   public function lead_varified(Request $request)
    {
        $id=$request->id;
        $status=$request->status_value;

        $data=Query::find($id);
        $data->lead_verified=$status;
        $data->save();
    }
    public function lead_unvarified(Request $request)
    {
        $id=$request->id;
        

        $data=Query::find($id);
        $data->lead_verified=0;
        $data->save();
    }
    public function enq_data(Request $request)
    {

        $id=$request->id;
         
        $data=Query::find($id);

        $package_name=CustomHelpers::get_package_name($data->packageId);

        echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Name</strong></div>
            <div class='col-md-9 col-xs-8'>$data->name</div>
          </div>";

         echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Contact Number</strong></div>
            <div class='col-md-9 col-xs-8'>$data->mobile</div>
          </div>";

         echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Email Id</strong></div>
            <div class='col-md-9 col-xs-8'>$data->email</div>
          </div>";

         echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Residence City</strong></div>
            <div class='col-md-9 col-xs-8'>$data->city_of_residence</div>
          </div>";

           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Country</strong></div>
            <div class='col-md-9 col-xs-8'>$data->country_of_residence</div>
          </div>";

           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Destination</strong></div>
            <div class='col-md-9 col-xs-8'>$data->destinations</div>
          </div>";

           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Arrival Date</strong></div>
            <div class='col-md-9 col-xs-8'>$data->date_arrival</div>
          </div>";
        $day_s=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
        if(strlen($day_s)>1)
        {
          $i= (string)$day_s ;
          $day_s=$i[1];
        }
           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Duration</strong></div>
            <div class='col-md-9 col-xs-8'>$day_s Days</div>
          </div>";
          
           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Travellers</strong></div>
            <div class='col-md-9 col-xs-8'>$data->span_value_adult Adults, $data->span_value_child Childs, $data->span_value_infant Infants </div>
          </div>";


          echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Hotel Preference</strong></div>
            <div class='col-md-9 col-xs-8'>$data->hotel_pre Star</div>
          </div>";
        
     


          echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Expected Budget</strong></div>
            <div class='col-md-9 col-xs-8'>$data->exp_budget </div>
          </div>";

           echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Best Time To Call</strong></div>
            <div class='col-md-9 col-xs-8'>$data->time_call </div>
          </div>";


          echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Message</strong></div>
            <div class='col-md-9 col-xs-8'>$data->message </div>
          </div>";


          echo "<div class='row'>
            <div class='col-md-3 col-xs-4'><strong>Package Name</strong></div>
            <div class='col-md-9 col-xs-8'>$package_name</div>
          </div>";
          
          


    }

    public function add_customer_detail()
    {
      $check_data=ActivateService::where('services','=','leads')->first();
     if($check_data->activation==1):
         $package_data = Packages::all();
        //return view('query.list',['queries'=>$queries]);
         if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee')):
        return view('query.addquery',['package_data'=>$package_data]);
    else:
       return redirect("/enquiry");
    endif;
    else:
       return response()->view('error.404', [], 404);
    endif;
    }
    public function change_package(Request $request)
    {
      $package_data = Packages::all();
      $data="";
    foreach($package_data as $packages ):
    $data.="<option value='$packages->id'>$packages->title</option>";
     endforeach;
     echo "$data";
    }
    public function saveQuery1(Request $request){

       
     

    $this->validate($request, [
             'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'time_call' => 'required',
            'city_of_residence' => 'required',
            'country_of_residence' => 'required',
            'destinations' => 'required', 
            'date_arrival' => 'required'                 
                          
        ]); 
         
    $query = new Query;
    $query->packageId = $request->packageId;
    $query->name = $request->name;
    $query->email = $request->email;
    $query->mobile = $request->mobile;
    $query->message = $request->message;
    $query->city_of_residence = $request->city_of_residence;
    $query->country_of_residence = $request->country_of_residence;
    $query->destinations = $request->destinations;
    $query->date_arrival = $request->date_arrival;
    $query->duration = $request->duration;
    $query->span_value_adult = $request->span_value_adult;
    $query->span_value_child = $request->span_value_child;
    $query->span_value_infant = $request->span_value_infant;
    $query->hotel_pre = $request->hotel_pre;
    $query->exp_budget = $request->exp_budget;
    $query->time_call = $request->time_call;
    $query->accept_value = $request->accept_value;
    if(env("WEBSITENAME")==1):
    $query->webnotation = 1;
    elseif(env("WEBSITENAME")==0):
    $query->webnotation = 0;
    endif;
    


       if($query->save()){
            return redirect ('/enquiry')->with('message', 'Thanks You! Your query has been submitted.');
        }



    }
     public function saveQuery2(Request $request){

       
      

    $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'time_call' => 'required',
            'city_of_residence' => 'required',
            'country_of_residence' => 'required',
            'destinations' => 'required', 
            'date_arrival' => 'required'                 
                          
        ]);     
    $query = new Query;
    $query->packageId = $request->packageId;
    $query->name = $request->name;
    $query->email = $request->email;
    $query->mobile = $request->mobile;
    $query->message = $request->message;
    $query->city_of_residence = $request->city_of_residence;
    $query->country_of_residence = $request->country_of_residence;
    $query->destinations = $request->destinations;
    $query->date_arrival = $request->date_arrival;
    $query->duration = $request->duration;
    $query->span_value_adult = $request->span_value_adult;
    $query->span_value_child = $request->span_value_child;
    $query->span_value_infant = $request->span_value_infant;
    $query->hotel_pre = $request->hotel_pre;
    $query->exp_budget = $request->exp_budget;
    $query->time_call = $request->time_call;
    $query->accept_value = $request->accept_value;
    if(env("WEBSITENAME")==1):
    $query->webnotation = 1;
    elseif(env("WEBSITENAME")==0):
    $query->webnotation = 0;
    endif;


       if($query->save()){
    return redirect ('/contact-us')->with('message', 'Thanks You! Your query has been submitted.');
        }




    }
    public function disable_quotation($id)
    {
       $data=Option1Quotation::where("quo_ref","=",$id)->first();

       if($data):
        $query_data=Query::find($data->query_reference);
        if($query_data):
         $query_data->delete_status=0;
         $query_data->save();
        endif;
         $data->del_status=0;
         $data->save();
         return redirect("/quotation")->with("success",'Quote Deleted');
       else:
       return redirect("/quotation")->with("success",'Data Not Found');
       endif;
    }
    public function detele_quotation($id)
    {
        
      $query_data=Query::find($id);
      if(count($query_data)!="" && count($query_data)!="0"):
         Query::destroy($id);
       $data1=Option1Quotation::where("query_reference","=",$id)->first();
       if(count($data1)!="" && count($data1)!="0"):
       $data2=Option2Quotation::where("query_reference","=",$id)->first();
      $data3=Option3Quotation::where("query_reference","=",$id)->first();
      $data4=Option4Quotation::where("query_reference","=",$id)->first();
     Option1Quotation::destroy($data1->id);
     Option2Quotation::destroy($data2->id);
     Option3Quotation::destroy($data3->id);
     Option4Quotation::destroy($data4->id);
       endif;
      endif;

     return redirect()->back()->with("success","Deleted Successfully");
    }
    public function detele_query($id)
    {
        $data=Query::find($id);

        if($data):
          $quotation_data=Option1Quotation::where('query_reference','=',$data->id)->first();
          if(count($quotation_data)!="" && count($quotation_data)!="0"):
          $quotation_data->del_status=0;
          $quotation_data->save();
          endif;
         //Query::destroy($id);
          $data->delete_status=0;
          $data->save();
         return redirect()->back();
        endif;
    }

  

  
}
