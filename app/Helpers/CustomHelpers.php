<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use DB;
use App\Icons;
use App\Packages;
use App\Quotation;
use App\Quote;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;
use App\Query;
use App\PackageImageGallery;
use App\User;
use Sentinel;
use App\PkgRatingType;
use App\transferList;
use App\EnquiryTracker;
use App\Payment;
use App\TwgPaymentMode;
use App\Passengerinfo;
use App\GatewaySetting;
use App\RefundPayments;
use App\EnqueryOTPSetting;
use App\QueryTraveller;
use App\Coupon;
use App\PkgTours;
use Session; 
use Mail;

class CustomHelpers {

  // travelling guest list
  public static function get_passengers_list($passengers) {
    $output = '';
    $a = 1;
    
    foreach ($passengers as $row => $col) {
        foreach ($col as $p => $q) {
            foreach ($q as $r) {
                $passenger_id = CustomHelpers::custom_decrypt($r);
                $passenger_data = QueryTraveller::find($passenger_id);
                if ($passenger_data != '') {
                    if ($a != 1) {
                        $output .= ',';
                    }
                    $output .= $passenger_data->firstname . ' ' . $passenger_data->lastname;
                    $a++;
                }
            }
        }
    }
    
    return $output;
  }

  // quotation user assignment nofitication
  public static function send_assign_user_notification($assign_id, $data, $from_email) {
      $email = EnqueryOTPSetting::find(2);
      if ($email->status == 1) {
          CustomHelpers::send_assign_user_notification_email($assign_id, $data, $from_email);
      }

      $sms = EnqueryOTPSetting::find(3);
      if ($sms->status == 1) {
          CustomHelpers::send_assign_user_notification_mobile($assign_id, $data);
      }
  }

  // quotation user assignment nofitication by SMS
  public static function send_assign_user_notification_mobile($assign_id, $data) {
      $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";
      $assign_user = CustomHelpers::get_master_table_data('users', 'id', (int)$assign_id, 'first_name');
      $number = $data->mobile;
      $number = preg_replace('/\s/', '', $number);
      $mobile_code = "91";
      $numbers = array($mobile_code . $number);
      $sender = urlencode('RAPTRA');
      $ref = mt_rand(10000, 99999);
      $message = rawurlencode("we have sent OTP on your Mobile No: $ref -Regards Rapidex Travels");
      $numbers = implode(',', $numbers);
      $response = CustomHelpers::sendSms($apiKey, $numbers, $message, $sender);
      $response = json_decode($response);
      
      if ($response->status == "success") {
          setcookie('otp', $ref);
          return "success";
      } elseif ($response->status == "failure") {
          return "Fail";
      }
  }

  // quotation user assignment nofitication by EMAIL
  public static function send_assign_user_notification_email($assign_id,$data,$from_email) {
    $assign_user=CustomHelpers::get_master_table_data('users','id',(int)$assign_id,'first_name');
    $to=$data->email;
    try {
      Mail::send('query.mail.assign_user.assign_user_mail',compact("data",'assign_user'),function($message) use ($to,$from_email) {
        $message->from($from_email);
        $message->to($to)->subject("Assign Your Enquiry");
        });
      }
    catch(\Exception $e) { // Using a generic exception
      }
  }

  /************************************/
  
  public static function get_tour_date($tour_date) {
    $date_arrival = $tour_date;
    $date_arrival = str_replace('/', '-', $date_arrival);
    //Explode the string into an array.
    $exploded = explode("-", $date_arrival);
    //Reverse the order.
    $exploded = array_reverse($exploded);
    $newFormat = array_map('trim', $exploded);
    //Convert it back into a string.
    $newFormat = implode("-", $newFormat);
    $newFormat = date("d M Y", strtotime($newFormat));
    //Print it out.
    echo $newFormat;
  }

  //
  public static function get_receipt_no($type,$website_no) {
    if($website_no==1)
    {
    $receipt_for='TWG';
    }
    else
    {
    $receipt_for='RTA';
    }
     if($type=='payment')
     {
    $last = Payment::whereNotNull('receipt_id')->orderBy('receipt_id', 'desc')->first();
     if($last!=''):
      $last_no=(int)$last->receipt_id+1;
       else:    
       $last_no=1; 
       
       endif; 
       $last_id=sprintf('%08d',$last_no);    
       $output=$receipt_for.$last_id;
       return $output;
     }
     elseif($type=='refund')
     {
     $last = Payment::whereNotNull('payment_id')->orderBy('payment_id', 'desc')->first();
     if($last!=''):
      $last_no=(int)$last->payment_id+1;
       else:    
       $last_no=1; 
       
       endif; 
       $last_id=sprintf('%08d',$last_no);    
       $output=$receipt_for.$last_id;
       return $output;
     }  
  }
public static function get_package_details($Packages, $return_type)
{
  $packageData = new \stdClass();  
            $packageData->id = $Packages->id;
            $packageData->title = $Packages->title;
            $packageData->package_code = $Packages->package_code;
            $packageData->category = $Packages->category;
            $packageData->country = unserialize($Packages->country);
            $packageData->continent = unserialize($Packages->continent);
            $packageData->state = unserialize($Packages->state);
            $packageData->city = unserialize($Packages->city);
            
             $cities_list=unserialize($Packages->city);
             $packageData->days = unserialize($Packages->days);
            $packageData->transport_description = $Packages->transport_description;
            $packageData->package_category = unserialize($Packages->package_category);
            $packageData->transfers = unserialize($Packages->transfers);
            $packageData->airlines = isset($Packages->airlines) ? $Packages->airlines : null;
            $packageData->activities = isset($Packages->activities) ? $Packages->activities : null; 
            $packageData->locations = isset($Packages->locations) ? $Packages->locations : null; 
            $packageData->iatalist = isset($Packages->iatalist) ? $Packages->iatalist : null;  
            //$packageData->package_location =  unserialize($Packages->package_location);
            $packageData->package_rating = $Packages->package_rating;
            $packageData->description = $Packages->description;
            $packageData->highlights = $Packages->highlights;
            $packageData->customer_rating = $Packages->customer_rating;
            $packageData->transport = $Packages->transport;
            $packageData->accommodation = unserialize($Packages->accommodation);
            $packageData->package_destination = $Packages->package_destination;
            $packageData->type_of_package = $Packages->type_of_package;
            $packageData->inclusions = $Packages->inclusions;
            $packageData->exclusions = $Packages->exclusions;
            //$packageData->transfers = $Packages->transfers;
            $packageData->tours = unserialize($Packages->tours);
            //$packageData->destinations = serialize($packageData->destinations);
            $packageData->destinations =isset($Packages->destinations) ? unserialize($Packages->destinations) : null;   
            $packageData->similar_packages = isset($Packages->similar_packages) ? unserialize($Packages->similar_packages) : null;  

            $packageData->sp_city = isset($Packages->sp_city) ? unserialize($Packages->sp_city) : null;   
            
            $packageData->flight = unserialize($Packages->flight);
            $packageData->tour_inc = unserialize($Packages->tour_inc);
            $packageData->tour_exc = unserialize($Packages->tour_exc);
            $packageData->duration = $Packages->duration;
            $packageData->sourcecity = $Packages->sourcecity;
            $packageData->select_star_rating = $Packages->select_star_rating;
            $packageData->tour_type = $Packages->tour_type;
            $packageData->tour_category = $Packages->tour_category;

            $packageData->day_itinerary = unserialize($Packages->day_itinerary);
            //$packageData->payment_policy = explode(',',$Packages->payment_policy);
            //$packageData->cancel_policy = explode(',',$Packages->cancel_policy);
            //$packageData->visa_policy = explode(',',$Packages->visa_policies);
            $packageData->payment_policy = $Packages->payment_policy;
            $packageData->cancel_policy = $Packages->cancel_policy;
            $packageData->visa_policy = $Packages->visa_policies;
           
            $packageData->pricing = isset($Packages->pricing) ? unserialize($Packages->pricing) : null;  
            $packageData->upcoming_pricing = isset($Packages->upcoming_pricing) ? unserialize($Packages->upcoming_pricing) : null;  
            $packageData->package_service =isset($Packages->package_service) ? unserialize($Packages->package_service) : null;   
            $packageData->package_suitables =isset($Packages->package_suitables) ? unserialize($Packages->package_suitables) : null;    
            $packageData->package_tags =isset($Packages->package_tags) ? unserialize($Packages->package_tags) : null; 
            $packageData->package_holiday = isset($Packages->package_holiday) ? unserialize($Packages->package_holiday) : null;  
            $packageData->meta_title = isset($Packages->meta_title) ? $Packages->meta_title : null; 
            $packageData->meta_keyword = isset($Packages->meta_keyword) ? $Packages->meta_keyword : null; 
            $packageData->meta_desc = isset($Packages->meta_desc) ? $Packages->meta_desc : null; 
            $packageData->rapidex_meta_title = isset($Packages->rapidex_meta_title) ? $Packages->rapidex_meta_title : null;
            $packageData->rapidex_meta_keyword = isset($Packages->rapidex_meta_keyword) ? $Packages->rapidex_meta_keyword : null; 
            $packageData->rapidex_meta_desc = isset($Packages->rapidex_meta_desc) ? $Packages->rapidex_meta_desc : null; 
            $packageData->status = $Packages->status;
            $packageData->onrequest = isset($Packages->onrequest) ? $Packages->onrequest : null; 
            $packageData->upcoming = isset($Packages->upcoming) ? $Packages->upcoming : null; 
            $packageData->Price_title = isset($Packages->Price_title) ? $Packages->Price_title : null; 
            $packageData->Price_type = isset($Packages->Price_type) ? $Packages->Price_type : null; 
            $packageData->confirmation_type = isset($Packages->confirmation_type) ? $Packages->confirmation_type : null; 
            $packageData->confirmation_type_upcoming = isset($Packages->confirmation_type_upcoming) ? $Packages->confirmation_type_upcoming : null;
            $packageData->upcoming_title = isset($Packages->upcoming_title) ? $Packages->upcoming_title : null; 
            $packageData->upcoming_type = isset($Packages->upcoming_type) ? $Packages->upcoming_type : null; 
            $packageData->visa = $Packages->visa;
            $packageData->package_hotel=$Packages->hotel_id;
            $packageData->visa_p = unserialize($Packages->visa_p);
            $packageData->payment_p = unserialize($Packages->payment_p);
            $packageData->can_p = unserialize($Packages->can_p);
            $packageData->importantnotes = unserialize($Packages->imp_notes);
            $packageData->extranotes = $Packages->extra_notes;
            $packageData->newprices = isset($Packages->newprices) ? $Packages->newprices : null; 
            $packageData->newprices_discounts = isset($Packages->newprices_discounts) ? $Packages->newprices_discounts : null;
            $packageData->room = $Packages->room;
            $packageData->no_of_room = $Packages->no_of_room;
            $packageData->roe = $Packages->roe;
            $packageData->indian_rate = $Packages->indian_rate;
            $packageData->total_value = $Packages->total_value;
            $packageData->adult = $Packages->adult;
            $packageData->extra_adult = $Packages->extra_adult;
            $packageData->child_with_bed = $Packages->child_with_bed;
            $packageData->child_without_bed = $Packages->child_without_bed;
            $packageData->solo_traveller = $Packages->solo_traveller;
            $packageData->infant = $Packages->infant;
            $packageData->anything = $Packages->anything;
            $packageData->currency = $Packages->currency;
            $packageData->priceremarks = $Packages->priceremarks;
             $packageData->show_status = isset($Packages->show_status) ? $Packages->show_status : null; 
            $packageData->supplier_id = isset($Packages->supplier_id) ? $Packages->supplier_id : null;  
            $packageData->supplier_remarks = isset($Packages->supplier_remarks) ? $Packages->supplier_remarks : null;  
            $packageData->livemode = isset($Packages->livemode) ? $Packages->livemode : null;  
            $packageData->acc_type = $Packages->acc_type;
            $packageData->extra_acc = isset($Packages->extra_acc) ? $Packages->extra_acc : null;   
            $packageData->accommodation = $Packages->accommodation;
            $packageData->accommodation_extra = $Packages->accommodation_extra;
            $packageData->transfers = $Packages->transfers;
           $packageData->admin_remarks = isset($Packages->admin_remarks) ? $Packages->admin_remarks : null;  
           $packageData->tour_date = isset($Packages->tour_date) ? $Packages->tour_date : null;  
           $packageData->validity_time = isset($Packages->validity_time) ? $Packages->validity_time : null;  
           $packageData->validity_show_on_frontend = isset($Packages->validity_show_on_frontend) ? $Packages->validity_show_on_frontend : null;  
           $packageData->query_reference = isset($Packages->query_reference) ? $Packages->query_reference : null;  
           $packageData->price_type = isset($Packages->price_type) ? $Packages->price_type : null;  
           $packageData->quote_price = isset($Packages->price) ? $Packages->price : null;  
           $packageData->quote_remarks = isset($Packages->remarks) ? $Packages->remarks : null; 
           $packageData->partPayment = isset($Packages->partPayment) ? $Packages->partPayment : null; 
           $packageData->part_payments = isset($Packages->part_payments) ? $Packages->part_payments : null; 
           $packageData->partPayment = isset($Packages->partPayment) ? $Packages->partPayment : null; 
           $packageData->refundPaymentCheckbox = isset($Packages->refundPaymentCheckbox) ? $Packages->refundPaymentCheckbox : null; 
           $packageData->refund_payments = isset($Packages->refund_payments) ? $Packages->refund_payments : null; 
           $packageData->directPayment = isset($Packages->directPayment) ? $Packages->directPayment : null; 
           $packageData->directPayments = isset($Packages->directPayments) ? $Packages->directPayments : null; 
           $packageData->second_directPayments = isset($Packages->second_directPayments) ? $Packages->second_directPayments : null; 
           $packageData->third_directPayments = isset($Packages->third_directPayments) ? $Packages->third_directPayments : null; 
           $packageData->quote_validaty = isset($Packages->quote_validaty) ? $Packages->quote_validaty : null;
           $packageData->validity_time = isset($Packages->validity_time) ? $Packages->validity_time : null; 
           $packageData->validity_show_on_frontend = isset($Packages->validity_show_on_frontend) ? $Packages->validity_show_on_frontend : null; 

           $packageData->quote_header = isset($Packages->quote_header) ? $Packages->quote_header : null; 
           $packageData->quote_header_extra = isset($Packages->quote_header_extra) ? $Packages->quote_header_extra : null; 
           $packageData->quote_footer = isset($Packages->quote_footer) ? $Packages->quote_footer : null; 
           $packageData->quote_footer_extra = isset($Packages->quote_footer_extra) ? $Packages->quote_footer_extra : null; 

            
             
 // dd($Packages);
$cities_list=unserialize($Packages->city);
if(count($cities_list)>0)
  {
        $PkgTours = PkgTours::where('status','1')->whereIn('location',$cities_list)->get();
  }
  else
  {
         $PkgTours = PkgTours::where('status','1')->get();
  }
if($return_type =='main_data'):
return $packageData;
elseif($return_type =='PkgTours'):
return $PkgTours;
endif;
            
}
  public static function get_gateway_settings($gateway_id) {
    $data=GatewaySetting::find($gateway_id);
   if($gateway_id==1)
          {
            if($data->environment==0)
            {
    $output=['environment'=>'TEST','mkey'=>$data->test_merchant_key,'mid'=>$data->test_merchant_mid]; 
                }
                else
                {
    $output=['environment'=>'PROD','mkey'=>$data->prd_merchant_key,'mid'=>$data->prd_merchant_mid]; 
                }
        
              }
               elseif($gateway_id==2)
              {
                if($data->environment==0)
                {
    $output=['environment'=>'TEST','mkey'=>$data->test_merchant_key,'mid'=>$data->test_merchant_mid]; 
                }
                else
                {
    $output=['environment'=>'PROD','mkey'=>$data->prd_merchant_key,'mid'=>$data->prd_merchant_mid]; 
            }
          }
          return $output;
  }

  public static function check_refund_status($quote_ref_no,$amount) {
    // $total_refunded_amount = DB::table('rt_payments')
    //        ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
    //        ->sum('amount');

    $total_refundable_amount = DB::table('refund_create')
       ->where('quote_ref_no','=',$quote_ref_no)
       ->sum('refund_amount');
 
    if($total_refundable_amount==0)
    {
    return 0;
    }
    elseif($total_refundable_amount!=0 && $total_refundable_amount<$amount)
    {
    return 1;
    }
    elseif($total_refundable_amount!=0 && $total_refundable_amount==$amount)
    {
    return 2;  
    }
  }

  /*public static function get_flight_class_name($name)
  {
    $output='';
    if($name=='economyclass')
    {
      $output='Economy';
    }
    elseif($name=='premiumeconomyclass')
    {
      $output='Premium Economy';
    }
    elseif($name=='businessclass')
    {
      $output='Business';
    }
    elseif($name=='firstclass')
    {
      $output='First';
    }
    return $output;
  }*/

  public static function get_flight_class_name($name)
  {
    // Map flight class keys to their corresponding names
    $classMap = [
        'economyclass' => 'Economy',
        'premiumeconomyclass' => 'Premium Economy',
        'businessclass' => 'Business',
        'firstclass' => 'First',
    ];

    // Return the corresponding name if it exists, otherwise return an empty string
    return $classMap[$name] ?? '';
  }


  public static function get_quote_amount($unique_code,$mode_id,$order_id)
  {
    $quote_no=Session::get($unique_code.'quoteno');
    
      $amount=Session::get($unique_code.'amount');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {

        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;
        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
        }
        
        $mode=TwgPaymentMode::find($mode_id);
        $mdr=$mode->mdr;
        $mdr_gst=$mode->gst_on_mdr;
        
        $mdr_amount=round((float)$amount*(float)$mdr/100);
        $mdr_gst_amount=round((float)$mdr_amount*(float)$mdr_gst/100);
        
        $total_amount=(int)$mdr_amount+(int)$mdr_gst_amount+(int)$amount;
        $amount=$total_amount;
        $query_id=$data->query_reference;
        $package_query=Query::find($query_id);
        $receipt_no=CustomHelpers::get_receipt_no('payment',1);
       $payment=new Payment;
       $payment->quote_id=$data->id;
       $payment->receipt_id=$receipt_no;
       $payment->quote_no=$quote_no;
       $payment->quote_ref_no=$quote_ref_no;
       $payment->order_id=$order_id;
       $payment->gateway_id=$mode->gateway_id;
       $payment->description=$package_query->service_type;
       $payment->mode_id=$mode_id;
       $payment->mdr=$mdr;
       $payment->mdr_amount=$mdr_amount;
       $payment->gat_on_mdr=$mdr_gst;
       $payment->gst_on_mdr_amount=$mdr_gst_amount;
      if (Sentinel::check()){
        $payment->payment_user_id=Sentinel::getUser()->id; 
      }
      
       if($amount<10)
       {
        $amount=10;
       }

       $payment->amount=$amount;
       $payment->save();   
    return $amount;
  }

  public static function after_success_payment($order_id,$transaction_id,$PAYMENTMODE,$TXNDATE,$BANKTXNID,$bank_name) {
    $data_payment = Payment::where('order_id', $order_id )->first();
    $quote_no=$data_payment->quote_no;
    $quote_id=$data_payment->quote_id;

    if($quote_no==1) {
        $data=Option1Quotation::find((int)$quote_id);
        $price=$data->option1_price;
        $new_price=unserialize($data->option1_price);
        $d=Passengerinfo::where('quotation_ref_no','=',$data->quo_ref)->first();
        if($d->coupon!='' && $d->coupon!=0) {
          $coupon_data=Coupon::find($d->coupon);
          $percentage=$coupon_data->value;
          $new_price['pricediscountnegative']=3;
          $new_price['coupon_id']=$d->coupon;
          $new_price['discount_coupon']=$percentage;  
        }
        if($d->coupon!='' && $d->coupon==0) {        
          $new_price['pricediscountnegative']=3;
          $new_price['discount_coupon']=0;
        }
        $unique_code=$data->unique_code;
        $price_data=CustomHelpers::get_price_part_seperate(serialize($new_price),$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
          $adult=$data->quote1_number_of_adult;
          $extra_adult=$data->extra_adult;
          $child_with_bed=$data->child_with_bed;
          $child_without_bed=$data->child_without_bed;
          $infant=$data->infant;
          $solo_traveller=$data->solo_traveller;

          $part_payments_sec=CustomHelpers::part_payments($data->part_payments,$price_data['query_pricetopay_adult']);
          
      $data->option1_price=serialize($price_data);
      $data->part_payments=serialize($part_payments_sec);
      $data->accept_status=1;
      $data->save();
      $query_id=$data->query_reference;
      $quote_ref_no=$data->quo_ref;
      $amount=$price_data['query_pricetopay_adult'];        
    } elseif($quote_no==2) {
      $quote=Option2Quotation::find((int)$quote_id);
    } elseif($quote_no==3) {
      $quote=Option3Quotation::find((int)$quote_id);
    } elseif($quote_no==4) {
      $quote=Option4Quotation::find((int)$quote_id);
    }
    
    // return  Redirect::to('/')->with('success','Payment Successful, Enjoy Reading!');
        Session::forget($unique_code.'quoteno');
        Session::forget($unique_code.'amount');
        Session::forget($unique_code.'quote1_id');
        Session::forget($unique_code.'quote2_id');
        Session::forget($unique_code.'quote3_id');
        Session::forget($unique_code.'quote4_id');

        $transaction_id = $transaction_id;
        $data_payment = Payment::where( 'order_id', $order_id )->first();
            $data_payment->status = '1';
            $data_payment->transaction_id = $transaction_id;
            $data_payment->payment_mode = $PAYMENTMODE;
            $data_payment->transaction_date = $TXNDATE;
            $data_payment->currency = $BANKTXNID;
           
            $data_payment->part_payment = $d->installment_number;
            $data_payment->bank_name = $bank_name;
            $data_payment->save();

             $user_ids=$data_payment->payment_user_id;
             if($user_ids!=0)
             {
              $user = Sentinel::findById($user_ids);
             Sentinel::login($user);
             }
            
      //
      $query_data=Query::find($query_id);
      $due_amount=CustomHelpers::get_remaining_due($quote_ref_no,$amount);
      $check_first_payment = DB::table('rt_payments')
           ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
           ->get();

      if(count($check_first_payment)<=1) {
        $query_data->status='process_booking';
      }

      $query_data->accept_quote_no=$quote_no;
      $query_data->accept_quote_id=$data->id;

      if($due_amount<=0) {
        $query_data->payment_status='Full Paid';
        if(Sentinel::check())
        {
          CustomHelpers::save_enquiry_tracker($query_id,'Full Paid',Sentinel::getUser()->id,'Full Paid',$query_id);
        }
        else
        {
          CustomHelpers::save_enquiry_tracker($query_id,'Full Paid','0','Full Paid',$query_id);
        }
    } else {
      $query_data->payment_status='Partial Paid';
      if(Sentinel::check()) {
         CustomHelpers::save_enquiry_tracker($query_id,'Partial Paid',Sentinel::getUser()->id,'Partial Paid',$query_id);
      } else {
        CustomHelpers::save_enquiry_tracker($query_id,'Partial Paid','0','Partial Paid',$query_id);
      }
    }
    $query_data->save();

    return $data_payment;
  }

  /*public static function save_enquiry_tracker($enquiry_id,$description,$user_id=NULL,$activity_type=NULL,$activity_id=NULL) {
    $data=new EnquiryTracker;
    $data->enquiry_id=$enquiry_id;
    $data->description=$description;
    $data->user_id=$user_id;
    $data->activity_type=$activity_type;
    $data->activity_id=$activity_id;
    $data->save();
  }*/

  public static function save_enquiry_tracker(
    $enquiry_id, 
    $description, 
    $user_id = null, 
    $activity_type = null, 
    $activity_id = null
  ) {
      try {
          $data = new EnquiryTracker;
          $data->enquiry_id = $enquiry_id;
          $data->description = $description;
          $data->user_id = $user_id;
          $data->activity_type = $activity_type;
          $data->activity_id = $activity_id;
          $data->save();
      } catch (\Exception $e) {
          // Log the error or handle it as needed
          \Log::error('Failed to save enquiry tracker: ' . $e->getMessage());
          // Optionally, you could rethrow or return an error status
      }
  }

  /************************************/

  /*public static function get_master_table_data($table,$where,$id,$return) {
    $data=DB::table($table)->where($where,'=',$id)->first();
    if($data!='') {
      return $data->$return;
    } else {
      return 'NA';
    }
  }*/

  /*public static function get_master_table_data($table, $whereColumn, $id, $returnColumn) {
    // Retrieve the data from the database
    $data = DB::table($table)->where($whereColumn, $id)->first();

    // Check if a record was found
    if ($data !== null) {
      // Check if the return column exists in the retrieved data
      if (isset($data->$returnColumn)) {
        return $data->$returnColumn;
      } else {
        // If the return column does not exist, log an error and return an empty string
        \Log::error("Column '$returnColumn' does not exist in table '$table'");
        return ''; // Return an empty string
      }
    } else {
      // If no record was found, log a warning and return an empty string
      \Log::warning("No record found in table '$table' where column '$whereColumn' equals '$id'");
      return ''; // Return an empty string
    }
  }*/

  public static function get_master_table_data($table, $whereColumn, $id, $returnColumn) {
    // Retrieve the data from the database
    $data = DB::table($table)->where($whereColumn, $id)->first();

    // Check if a record was found
    if ($data !== null) {
        // Check if the return column exists in the retrieved data
        if (isset($data->$returnColumn)) {
            $value = $data->$returnColumn;
            
            // Check if the value should be unserialized (if it seems like serialized data)
            if (is_string($value) && strpos($value, 'a:') === 0) {
                // Try to unserialize the value
                try {
                    $unserialized = unserialize($value);
                    if ($unserialized !== false || $value === 'b:0;') {
                        return $unserialized;
                    } else {
                        \Log::error("Failed to unserialize data from column '$returnColumn' in table '$table'.");
                        return [];
                    }
                } catch (Exception $e) {
                    \Log::error("Exception during unserialization in column '$returnColumn': " . $e->getMessage());
                    return [];
                }
            }

            // If the value is not serialized, just return it
            return $value;
        } else {
            // If the return column does not exist, log an error and return null
            \Log::error("Column '$returnColumn' does not exist in table '$table'");
            return null; // Return null to signify no valid data
        }
    } else {
        
        return null; // Return null instead of an empty string
    }
  }

  /************************************/

  /*public static function custom_encrypt($string, $key=101) {
    if(env("WEBSITENAME")==1):
      $key=110;
    else:
      $key=110;
    endif;
    $result = '';
    for($i=0, $k= strlen($string); $i<$k; $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result .= $char;
    }
    return base64_encode($result);
  }*/

  public static function custom_encrypt($string, $key = 'default_key') {
    // Adjust the key based on environment setting (corrected logic)
    $environmentKey = env("WEBSITENAME") == 1 ? 'env_key1' : 'env_key2';
    $key = $environmentKey;

    $result = '';
    $keyLength = strlen($key);

    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, $i % $keyLength, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
  }
  
  /************************************/

  /*public static function custom_decrypt($string, $key=101) {
    if(env("WEBSITENAME")==1):
      $key=110;
    else:
      $key=110;
    endif;
    $result = '';
    $string = base64_decode($string);
    for($i=0,$k=strlen($string); $i< $k ; $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
    }
    return $result;
  }*/

  public static function custom_decrypt($string, $key = 'default_key') {
    // Adjust the key based on environment setting (corrected logic)
    $environmentKey = env("WEBSITENAME") == 1 ? 'env_key1' : 'env_key2';
    $key = $environmentKey;

    $result = '';
    $string = base64_decode($string);
    $keyLength = strlen($key);

    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, $i % $keyLength, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;
  }

  /************************************/

  public static function get_base64_image($path) {
    $path = $path;
    // $type = pathinfo($path, PATHINFO_EXTENSION);
    // $data = file_get_contents($path);
    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    // return $base64;
    return $path;
  }

  /*public static function get_base64_image($path) {
    if (!file_exists($path)) {
        throw new \Exception("File does not exist: $path");
    }

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);

    if ($data === false) {
        throw new \Exception("Failed to read file: $path");
    }

    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
  }*/


  /************************************/

  /*public static function get_month_name($month) {
    $output='';
    if($month==1):
      $output='January';
    elseif($month==2):
      $output='February';
    elseif($month==3):
      $output='March';
    elseif($month==4):
      $output='April';
    elseif($month==5):
      $output='May';
    elseif($month==6):
      $output='June';
    elseif($month==7):
      $output='July'; 
    elseif($month==8):
      $output='August';
    elseif($month==9):
      $output='September';
    elseif($month==10):
      $output='October';
    elseif($month==11):
      $output='November';
    elseif($month==12):
      $output='December';
    endif;
    return $output;
  }*/

  public static function get_month_name($month) {
    $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    return $months[$month] ?? '';
  }

  /************************************/

  /*public static function get_session_query_details($quote_no,$unique_code) {
    $quote1_id=Session::get($unique_code.'quote1_id');
    $quote2_id=Session::get($unique_code.'quote2_id');
    $quote3_id=Session::get($unique_code.'quote3_id');
    $quote4_id=Session::get($unique_code.'quote4_id');
    if($quote_no==1) {
      $data=Option1Quotation::find((int)$quote1_id);
      $quote_ref_no=$data->quo_ref;
      $price=$data->option1_price;
      $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
    } elseif($quote_no==2) {
      $data=Option2Quotation::find((int)$quote2_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option2_price;
    } elseif($quote_no==3) {
      $data=Option3Quotation::find((int)$quote3_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option3_price;
    } elseif($quote_no==4) {
      $data=Option4Quotation::find((int)$quote4_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option4_price;
    }
    return $data;
  }*/

  public static function get_session_query_details($quote_no, $unique_code) {
    // Retrieve session IDs for each quote
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    // Initialize variables
    $data = null;
    $quote_ref_no = null;
    $price = null;

    // Retrieve data based on the quote number
    if ($quote_no == 1 && $quote1_id) {
        $data = Option1Quotation::find((int)$quote1_id);
        if ($data) {
            $quote_ref_no = $data->quo_ref;
            $price = $data->option1_price;
            $price_data = CustomHelpers::get_price_part_seperate(
                $data->option1_price,
                $data->quote1_number_of_adult,
                $data->extra_adult,
                $data->child_with_bed,
                $data->child_without_bed,
                $data->infant,
                $data->solo_traveller
            );
        }
    } elseif ($quote_no == 2 && $quote2_id) {
        $data = Option2Quotation::find((int)$quote2_id);
        if ($data) {
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        }
    } elseif ($quote_no == 3 && $quote3_id) {
        $data = Option3Quotation::find((int)$quote3_id);
        if ($data) {
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        }
    } elseif ($quote_no == 4 && $quote4_id) {
        $data = Option4Quotation::find((int)$quote4_id);
        if ($data) {
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }
    }

    // Return "Oops" if no data is found
    if (!$data) {
        return "Oops";
    }

    return $data;
  }

  /************************************/

  /*// Get record Name By Table Name And Record ID
  public static function getTableRecordById($id,$table,$field) {
    $query = DB::table($table)
    ->select($field)
    ->where('id', $id)
    ->first();
    return $query->$field;
  }*/

  // Get record Name By Table Name And Record ID
  public static function getTableRecordById($id, $table, $field) {
    // Perform the query to select the specified field from the table where the ID matches
    $query = DB::table($table)
        ->select($field)
        ->where('id', $id)
        ->first();

    // Check if the query result exists and contains the requested field
    if ($query && isset($query->$field)) {
        return $query->$field;
    }

    // Return "Oops" if the record doesn't exist or the field is null
    return "Oops";
  }

  /************************************/
  
  /*public static function get_package_title($id) {
    $query = DB::table('rt_packages')
    ->select('title')
    ->where('id', $id)
    ->first();
    return $query->title;
  }*/

  public static function get_package_title($id) {
    // Perform the query to select the title from the rt_packages table where the ID matches
    $query = DB::table('rt_packages')
        ->select('title')
        ->where('id', $id)
        ->first();

    // Check if the query result exists and contains the title field
    if ($query && isset($query->title)) {
        return $query->title;
    }

    // Return "Oops" if the record doesn't exist or the title is null
    return "Oops";
  }

  /************************************/
  
  /*public static function get_hotel_title($id) {
    $query = DB::table('rt_hotels')
    ->select('name')
    ->where('id', $id)
    ->first();
    return $query->name;
  }*/

  public static function get_hotel_title($id) {
    // Perform the query to select the name from the rt_hotels table where the ID matches
    $query = DB::table('rt_hotels')
        ->select('name')
        ->where('id', $id)
        ->first();

    // Check if the query result exists and contains the name field
    if ($query && isset($query->name)) {
        return $query->name;
    }

    // Return "Oops" if the record doesn't exist or the name is null
    return "Oops";
  }



  /************************************/

  /*public static function get_inclusions($id) {
    $poli = DB::table('rt_pkg_inclusions')
    ->select('name')
    ->where('id',$id)
    ->get()->first();
    return $poli->name;
  }*/

  public static function get_inclusions($id) {
   
    $inclusion = DB::table('rt_pkg_inclusions')
        ->select('name')
        ->where('id', $id)
        ->first();


    if ($inclusion && isset($inclusion->name)) {
        return $inclusion->name;
    }

    
    return "Oops";
  }

  

  public static function get_exc($id) {
    
    $exclusion = DB::table('rt_pkg_exclusions')
        ->select('name')
        ->where('id', $id)
        ->first();

    
    if ($exclusion && isset($exclusion->name)) {
        return $exclusion->name;
    }

    
    return "Oops";
  }


  // public static function get_quote_inclusions($quoteId): ?array
  // {
  //     try {
  //         $quote = DB::table('quote')
  //             ->select('inclusions')
  //             ->where('id', $quoteId)
  //             ->first();

  //         if ($quote && !empty($quote->inclusions) && $quote->inclusions !== "N;") {
  //             $inclusions = safeUnserialize($quote->inclusions);
  //             if (is_array($inclusions) && !empty($inclusions)) {
  //                 return $inclusions;
  //             }
  //             Log::warning("Inclusions data for quote ID {$quoteId} is not a valid array.");
  //             return null;
  //         }

  //         Log::warning("No inclusions found for quote ID: {$quoteId}");
  //         return null;
  //     } catch (\Exception $e) {
  //         Log::error("Error fetching inclusions for quote ID: {$quoteId} - " . $e->getMessage());
  //         return null;
  //     }
  // }

  // /**
  //  * Fetch and unserialize exclusions from the quote table for a given quote ID.
  //  *
  //  * @param int $quoteId The ID of the quote
  //  * @return array|null The array of exclusions or null if not found/invalid
  //  */
  // public static function get_quote_exclusions($quoteId): ?array
  // {
  //     try {
  //         $quote = DB::table('quote')
  //             ->select('exclusions')
  //             ->where('id', $quoteId)
  //             ->first();

  //         if ($quote && !empty($quote->exclusions) && $quote->exclusions !== "N;") {
  //             $exclusions = safeUnserialize($quote->exclusions);
  //             if (is_array($exclusions) && !empty($exclusions)) {
  //                 return $exclusions;
  //             }
  //             Log::warning("Exclusions data for quote ID {$quoteId} is not a valid array.");
  //             return null;
  //         }

  //         Log::warning("No exclusions found for quote ID: {$quoteId}");
  //         return null;
  //     } catch (\Exception $e) {
  //         Log::error("Error fetching exclusions for quote ID: {$quoteId} - " . $e->getMessage());
  //         return null;
  //     }
  // }




  /************************************/

  /*public static function get_city_seperate_code($str,$return) {
      
       $str_in_array=explode(" ",$str);
       $str_count=count($str_in_array);

       $last_str=$str_in_array[$str_count-1];
       $previous_data=str_replace($last_str,'',$str);
       if($return=='previous_data'):
         return $previous_data;
       elseif($return=='last_str'):
         return $last_str;
       endif;     
  }*/

  /*public static function get_city_separate_code($str, $returnType) {
    // Split the input string into an array based on spaces
    $strParts = explode(" ", $str);
    $partsCount = count($strParts);

    // Get the last part of the array
    $lastPart = $strParts[$partsCount - 1];
    $previousData = str_replace($lastPart, '', $str);

    // Return the requested part based on the $returnType parameter
    if ($returnType == 'previous_data') {
        return $previousData;
    } elseif ($returnType == 'last_str') {
        return $lastPart;
    }

    // Optional: return a default value or handle invalid $returnType
    return "Oops";
  }*/

  public static function get_city_seperate_code($str, $return) {
    $str_in_array = explode(" ", $str);
    $str_count = count($str_in_array);

    $last_str = $str_in_array[$str_count - 1];
    $previous_data = str_replace($last_str, '', $str);

    if ($return == 'previous_data') {
        return $previous_data;
    } elseif ($return == 'last_str') {
        return $last_str;
    }
  }
  
  /************************************/

  /*public static function get_quotation_hotel_new($city,$propertytype) {
    $city_name=$city;

    $propertytype=$propertytype;
    
    if($city_name!='' && $propertytype!=''):
     $data=DB::table('package_hotel')
          ->where([['location','like','%'.$city_name.'%'],['propertytype','like','%'.$propertytype.'%']])->get();
    elseif($city_name!='' && $propertytype==''):
    $data=DB::table('package_hotel')
          ->where('location','like','%'.$city_name.'%')->get();

    elseif($city_name=='' && $propertytype!=''):
    $data=DB::table('package_hotel')
          ->where('propertytype','like','%'.$propertytype.'%')->get();    
    endif;
   
    return $data;     
  }*/

  public static function get_quotation_hotel_new($city, $propertytype) {
    $city_name = $city;
    $propertytype = $propertytype;

    if ($city_name != '' && $propertytype != '') {
        $data = DB::table('package_hotel')
            ->where([
                ['location', 'like', '%' . $city_name . '%'],
                ['propertytype', 'like', '%' . $propertytype . '%']
            ])
            ->get();
    } elseif ($city_name != '' && $propertytype == '') {
        $data = DB::table('package_hotel')
            ->where('location', 'like', '%' . $city_name . '%')
            ->get();
    } elseif ($city_name == '' && $propertytype != '') {
        $data = DB::table('package_hotel')
            ->where('propertytype', 'like', '%' . $propertytype . '%')
            ->get();
    }

    return $data;
  }

  /************************************/
  
  /*public static function get_transfertype(Request $request) {
     $data=transferList::select("title","transport_type")->get();
     return $data;
  }*/

  public static function get_transfertype(Request $request) {
    // Retrieve all transfer types with their titles from the transferList model
    $transferTypes = transferList::select('title', 'transport_type')->get();

    return $transferTypes;
  }
  
  /************************************/

  /*public static function get_transfertype_second($transfer_type) {
     $data=transferList::where('transport_type','=',$transfer_type)->get();
     return $data;
  }*/

  public static function get_transfertype_second($transfer_type) {
    // Retrieve all transfer types that match the specified transport type
    $transferTypes = transferList::where('transport_type', $transfer_type)->get();

    return $transferTypes;
  }

  
  /************************************/

  public static function get_seperate_pass($id,$quoteno) {
    $data=Quote::find($id);
    $rooms=unserialize($data->room);

    $adult=0;
    $child=0;
    $infant=0;
    if($rooms!=''):
    foreach($rooms as $row=>$col):
    if($col['twin_adult_room']!='' && $col['twin_adult_room']!=0):
    $adult=$adult+$col['twin_adult_room'];
    endif;
    if($col['extra_adult_room']!='' && $col['extra_adult_room']!=0):
    $adult=$adult+$col['extra_adult_room'];
    endif;
     if($col['single_room']!='' && $col['single_room']!=0):
    $adult=$adult+$col['single_room'];
    endif;
    if($col['child_with_bed_room']!='' && $col['child_with_bed_room']!=0):
    $child=$child+$col['child_with_bed_room'];
    endif;
     if($col['child_without_bed_room']!='' && $col['child_without_bed_room']!=0):
    $child=$child+$col['child_without_bed_room'];
    endif;
    if($col['infant_room']!='' && $col['infant_room']!=0):
    $infant=$infant+$col['infant_room'];
    endif;
    endforeach;
    else:
    endif;
    $output=count($rooms).' Rooms ('.$adult.' Adults '.$child.' Child '.$infant.' infant )';
    return $output;
  }
  
  public static function get_month_output($type, $year_val, $traveller_type) {
    // Initialize the output with a default option
    $output = '<option selected disabled>MM</option>';
    
    // Check the type of month output
    if ($type == 'bmonth') {
        // Set the default total months to 12
        $total_month = 12;

        // If the year is the current year, set the total month to the current month
        if ($year_val == date("Y")) {
            $total_month = date("m"); 
        }
        
        // Adjust total month for child and infant traveller types
        if ($traveller_type == 'child' && $year_val == (date("Y") - 12)) {
            $total_month = date("m"); 
        } elseif ($traveller_type == 'infant' && $year_val == (date("Y") - 2)) {
            $total_month = date("m"); 
        }

        // Generate options for the months from 1 to total_month
        for ($i = 1; $i <= $total_month; $i++):
            $output .= '<option value=' . $i . '>' . CustomHelpers::get_month_name($i) . '</option>';
        endfor;
    } elseif ($type == 'imonth') {
        // Set the default total months to 12
        $total_month = 12;
        
        // If the year is the current year, set the total month to the current month
        if ($year_val == date("Y")) {
            $total_month = date("m"); 
        }
        
        // Generate options for the months from 1 to total_month
        for ($i = 1; $i <= $total_month; $i++):
            $output .= '<option value=' . $i . '>' . CustomHelpers::get_month_name($i) . '</option>';
        endfor;   
    } else {
        // Set the default start month to 1
        $start_month = 1;
        
        // If the year is the current year, set the start month to the current month
        if ($year_val == date("Y")) {
            $start_month = date("m"); 
        }
        
        // Generate options for the months from start_month to 12
        for ($i = $start_month; $i <= 12; $i++):
            $output .= '<option value=' . $i . '>' . CustomHelpers::get_month_name($i) . '</option>';
        endfor;
    }
    
    // Return the generated output
    return $output; 
  }

  public static function get_day_output($month_val, $year_val, $type, $traveller_type) {
    // Determine if the year is a leap year
    if ($year_val % 4 == 0) {
        $leap_year = 1;
    } else {
        $leap_year = 0; 
    }

    // Get the number of days in the month
    if ($year_val == date("Y") && $month_val == date("m")) {
        // If it's the current month and year, get the current day of the month
        $month_count = date("d");
    } else {
        // Determine the number of days based on the month
        if (in_array($month_val, [1, 3, 5, 7, 8, 10, 12])) {
            $month_count = 31;
        } elseif (in_array($month_val, [4, 6, 9, 11])) {
            $month_count = 30;
        } elseif ($month_val == 2 && $leap_year == 1) {
            $month_count = 29;
        } elseif ($month_val == 2 && $leap_year == 0) {
            $month_count = 28;
        }
    }

    // Initialize the output variable
    $output = '';

    // Generate the day options based on the type and traveller type
    if ($year_val == date("Y") && $month_val == date("m") && $type == 'b') {
        // If it's the current month and year, and type is 'b', generate options from current day to end of month
        for ($i = $month_count; $i <= date("t"); $i++) {
            $output .= '<option value=' . $i . '>' . $i . '</option>';
        }
    } elseif ($traveller_type == 'child' && $year_val == (date("Y") - 12) && $month_val == date("m")) {
        // If traveller type is child and the year is 12 years ago, generate options up to the current day
        for ($i = 1; $i <= date("d"); $i++) {
            $output .= '<option value=' . $i . '>' . $i . '</option>';
        }
    } elseif ($traveller_type == 'infant' && $year_val == (date("Y") - 2) && $month_val == date("m")) {
        // If traveller type is infant and the year is 2 years ago, generate options up to the current day
        for ($i = 1; $i <= date("d"); $i++) {
            $output .= '<option value=' . $i . '>' . $i . '</option>';
        }
    } else {
        // Generate options for the entire month
        for ($i = 1; $i <= $month_count; $i++) {
            $output .= '<option value=' . $i . '>' . $i . '</option>';
        }
    }

    // Return the generated output
    return $output;
  }

  public static function get_seperate_pass_payment_view($id, $quoteno, $return) {
    // Fetch the data for the given id
    $data = Option1Quotation::find($id);

    // Unserialize the room data
    $rooms = unserialize($data->room);

    // Initialize counters for adults, children, and infants
    $adult = 0;
    $child = 0;
    $infant = 0;

    // Check if rooms are not empty
    if ($rooms != ''):
        // Iterate through each room
        foreach ($rooms as $row => $col):
            // Add the number of twin adult rooms to the adult counter
            if ($col['twin_adult_room'] != '' && $col['twin_adult_room'] != 0):
                $adult += $col['twin_adult_room'];
            endif;
            
            // Add the number of extra adult rooms to the adult counter
            if ($col['extra_adult_room'] != '' && $col['extra_adult_room'] != 0):
                $adult += $col['extra_adult_room'];
            endif;

            // Add the number of single rooms to the adult counter
            if ($col['single_room'] != '' && $col['single_room'] != 0):
                $adult += $col['single_room'];
            endif;

            // Add the number of child with bed rooms to the child counter
            if ($col['child_with_bed_room'] != '' && $col['child_with_bed_room'] != 0):
                $child += $col['child_with_bed_room'];
            endif;

            // Add the number of child without bed rooms to the child counter
            if ($col['child_without_bed_room'] != '' && $col['child_without_bed_room'] != 0):
                $child += $col['child_without_bed_room'];
            endif;

            // Add the number of infant rooms to the infant counter
            if ($col['infant_room'] != '' && $col['infant_room'] != 0):
                $infant += $col['infant_room'];
            endif;
        endforeach;
    endif;

    // Check the return type
    if ($return == 'room') {
        // Return the count of rooms
        $output = count($rooms);
    } else {
        // Create the output string based on the counts of adults, children, and infants
        if ($adult > 0 && $child > 0 && $infant > 0) {
            $output = $adult . ' Adults ' . $child . ' Child ' . $infant . ' Infant';
        } elseif ($adult > 0 && $child > 0 && $infant == 0) {
            $output = $adult . ' Adults ' . $child . ' Child';
        } elseif ($adult > 0 && $child == 0 && $infant > 0) {
            $output = $adult . ' Adults ' . $infant . ' Infant';
        } elseif ($adult > 0 && $child == 0 && $infant == 0) {
            $output = $adult . ' Adults';
        }
    }

    // Return the final output
    return $output;
  }

  public static function get_package_new_price($price) {
    $price=unserialize($price);
    $data1=[
      "aircurrency" =>is_array($price) ? array_key_exists('aircurrency',$price) ? CustomHelpers::get_rate($price['aircurrency']) : 0 :0,
      "airfareadult" =>is_array($price) ? array_key_exists('airfareadult',$price) ? $price['airfareadult'] : 0 :0,
      "airfareexadult" =>is_array($price) ? array_key_exists('airfareexadult',$price) ? $price['airfareexadult'] : 0 :0,
      "airfarechildbed" =>is_array($price) ? array_key_exists('airfarechildbed',$price) ? $price['airfarechildbed'] : 0 :0,
      "airfarechildwbed" =>is_array($price) ? array_key_exists('airfarechildwbed',$price) ? $price['airfarechildwbed'] : 0 :0,
      "airfareinfant" =>is_array($price) ? array_key_exists('airfareinfant',$price) ? $price['airfareinfant'] : 0 :0,
      "airfaresingle" =>is_array($price) ? array_key_exists('airfaresingle',$price) ? $price['airfaresingle'] : 0 :0,

      "hotelcurrency" =>is_array($price) ? array_key_exists('hotelcurrency',$price) ? CustomHelpers::get_rate($price['hotelcurrency']) : 0 :0,
      "hotelfareadult" =>is_array($price) ? array_key_exists('hotelfareadult',$price) ? $price['hotelfareadult'] : 0 :0,
      "hotelfareexadult" =>is_array($price) ? array_key_exists('hotelfareexadult',$price) ? $price['hotelfareexadult'] : 0 :0,
      "hotelfarechildbed" =>is_array($price) ? array_key_exists('hotelfarechildbed',$price) ? $price['hotelfarechildbed'] : 0 :0,
      "hotelfarechildwbed" =>is_array($price) ? array_key_exists('hotelfarechildwbed',$price) ? $price['hotelfarechildwbed'] : 0 :0,
      "hotelfareinfant" =>is_array($price) ? array_key_exists('hotelfareinfant',$price) ? $price['hotelfareinfant'] : 0 :0,
      "hotelfaresingle" =>is_array($price) ? array_key_exists('hotelfaresingle',$price) ? $price['hotelfaresingle'] : 0 :0,

      "tourcurrency" =>is_array($price) ? array_key_exists('tourcurrency',$price) ? CustomHelpers::get_rate($price['tourcurrency']) : 0 :0,
      "tourfareadult" =>is_array($price) ? array_key_exists('tourfareadult',$price) ? $price['tourfareadult'] : 0 :0,
      "tourfareexadult" =>is_array($price) ? array_key_exists('tourfareexadult',$price) ? $price['tourfareexadult'] : 0 :0,
      "tourfarechildbed" =>is_array($price) ? array_key_exists('tourfarechildbed',$price) ? $price['tourfarechildbed'] : 0 :0,
      "tourfarechildwbed" =>is_array($price) ? array_key_exists('tourfarechildwbed',$price) ? $price['tourfarechildwbed'] : 0 :0,
      "tourfareinfant" =>is_array($price) ? array_key_exists('tourfareinfant',$price) ? $price['tourfareinfant'] : 0 :0,
      "tourfaresingle" =>is_array($price) ? array_key_exists('tourfaresingle',$price) ? $price['tourfaresingle'] : 0 :0,

      "transferscurrency" =>is_array($price) ? array_key_exists('transferscurrency',$price) ? CustomHelpers::get_rate($price['transferscurrency']) : 0 :0,
      "transferfareadult" =>is_array($price) ? array_key_exists('transferfareadult',$price) ? $price['transferfareadult'] : 0 :0,
      "transferfareexadult" =>is_array($price) ? array_key_exists('transferfareexadult',$price) ? $price['transferfareexadult'] : 0 :0,
      "transferfarechildbed" =>is_array($price) ? array_key_exists('transferfarechildbed',$price) ? $price['transferfarechildbed'] : 0 :0,
      "transferfarechildwbed" =>is_array($price) ? array_key_exists('transferfarechildwbed',$price) ? $price['transferfarechildwbed'] : 0 :0,
      "transferfareinfant" =>is_array($price) ? array_key_exists('transferfareinfant',$price) ? $price['transferfareinfant'] : 0 :0,
      "transferfaresingle" =>is_array($price) ? array_key_exists('transferfaresingle',$price) ? $price['transferfaresingle'] : 0 :0,

      "visacurrency" =>is_array($price) ? array_key_exists('visacurrency',$price) ? CustomHelpers::get_rate($price['visacurrency']) : 0 :0,
      "visafareadult" =>is_array($price) ? array_key_exists('visafareadult',$price) ? $price['visafareadult'] : 0 :0,
      "visafareexadult" =>is_array($price) ? array_key_exists('visafareexadult',$price) ? $price['visafareexadult'] : 0 :0,
      "visafarechildbed" =>is_array($price) ? array_key_exists('visafarechildbed',$price) ? $price['visafarechildbed'] : 0 :0,
      "visafarechildwbed" =>is_array($price) ? array_key_exists('visafarechildwbed',$price) ? $price['visafarechildwbed'] : 0 :0,
      "visafareinfant" =>is_array($price) ? array_key_exists('visafareinfant',$price) ? $price['visafareinfant'] : 0 :0,
      "visafaresingle" =>is_array($price) ? array_key_exists('visafaresingle',$price) ? $price['visafaresingle'] : 0 :0,
    ];

    $adulttotal=round($data1['aircurrency']*$data1['airfareadult'])+round($data1['hotelcurrency']*$data1['hotelfareadult'])+round($data1['tourcurrency']*$data1['tourfareadult'])+round($data1['transferscurrency']*$data1['transferfareadult'])+round($data1['visacurrency']*$data1['visafareadult']);

    $extraadulttotal=round($data1['aircurrency']*$data1['airfareexadult'])+round($data1['hotelcurrency']*$data1['hotelfareexadult'])+round($data1['tourcurrency']*$data1['tourfareexadult'])+round($data1['transferscurrency']*$data1['transferfareexadult'])+round($data1['visacurrency']*$data1['visafareexadult']);

    $childwithbedtotal=round($data1['aircurrency']*$data1['airfarechildbed'])+round($data1['hotelcurrency']*$data1['hotelfarechildbed'])+round($data1['tourcurrency']*$data1['tourfarechildbed'])+round($data1['transferscurrency']*$data1['transferfarechildbed'])+round($data1['visacurrency']*$data1['visafarechildbed']);

    $childwithoutbedtotal=round($data1['aircurrency']*$data1['airfarechildwbed'])+round($data1['hotelcurrency']*$data1['hotelfarechildwbed'])+round($data1['tourcurrency']*$data1['tourfarechildwbed'])+round($data1['transferscurrency']*$data1['transferfarechildwbed'])+round($data1['visacurrency']*$data1['visafarechildwbed']);

    $infanttotal=round($data1['aircurrency']*$data1['airfareinfant'])+round($data1['hotelcurrency']*$data1['hotelfareinfant'])+round($data1['tourcurrency']*$data1['tourfareinfant'])+round($data1['transferscurrency']*$data1['transferfareinfant'])+round($data1['visacurrency']*$data1['visafareinfant']);

    $singletotal=round($data1['aircurrency']*$data1['airfaresingle'])+round($data1['hotelcurrency']*$data1['hotelfaresingle'])+round($data1['tourcurrency']*$data1['tourfaresingle'])+round($data1['transferscurrency']*$data1['transferfaresingle'])+round($data1['visacurrency']*$data1['visafaresingle']);

    $data2=[
      "adulttotal" => $adulttotal,
      "extraadulttotal" =>$extraadulttotal,
      "childwithbedtotal" => $childwithbedtotal,
      "childwithoutbedtotal" =>$childwithoutbedtotal,
      "infanttotal" => $infanttotal,
      "singletotal" =>  $singletotal,
    ];

    $data=array_merge($data1,$data2);
     
    return $data;
  }

  public static function get_price_part_seperate($price,$adult,$extra_adult,$child_with_bed,$child_without_bed,$infant,$solo_traveller)
  {
    $price=unserialize($price);

    $data1=[
    "quote_airfare" => array_key_exists('quote_airfare',$price) ? $price['quote_airfare'] : 0 ,
    "quote_airfare_remarks" => array_key_exists('quote_airfare_remarks',$price) ? $price['quote_airfare_remarks'] : 0 , 
    "query_air_adult" => $price['query_air_adult'],
    "query_air_exadult" =>$price['query_air_exadult'],
    "query_air_childbed" => $price['query_air_childbed'],
    "query_air_childwbed" => $price['query_air_childwbed'],
    "query_air_infant" => $price['query_air_infant'],
    "query_air_single" => $price['query_air_single'],
    "quote_cruise_fare" =>array_key_exists('quote_cruise_fare',$price) ? $price['quote_cruise_fare'] : 0 ,  
    "quote_cruise_fare_remarks" =>array_key_exists('quote_cruise_fare_remarks',$price) ? $price['quote_cruise_fare_remarks'] : 0 ,  
    "query_cruise_adult" => $price['query_cruise_adult'],
    "query_cruise_exadult" => $price['query_cruise_exadult'],
    "query_cruise_childbed" => $price['query_cruise_childbed'],
    "query_cruise_childwbed" => $price['query_cruise_childwbed'],
    "query_cruise_infant" => $price['query_cruise_infant'],
    "query_cruise_single" => $price['query_cruise_single'],
    "port_charge_supplier" =>array_key_exists('port_charge_supplier',$price) ? $price['port_charge_supplier'] : 0 , 
    "port_charge_fare_remarks" =>array_key_exists('port_charge_fare_remarks',$price) ? $price['port_charge_fare_remarks'] : 0 ,
    "query_cruiseport_adult" =>array_key_exists('query_cruiseport_adult',$price) ? $price['query_cruiseport_adult'] : 0 ,
    "query_cruiseport_exadult" =>array_key_exists('query_cruiseport_exadult',$price) ? $price['query_cruiseport_exadult'] : 0 ,
    "query_cruiseport_childbed" =>array_key_exists('query_cruiseport_childbed',$price) ? $price['query_cruiseport_childbed'] : 0 , 
    "query_cruiseport_childwbed" =>array_key_exists('query_cruiseport_childwbed',$price) ? $price['query_cruiseport_childwbed'] : 0 , 
    "query_cruiseport_infant" =>array_key_exists('query_cruiseport_infant',$price) ? $price['query_cruiseport_infant'] : 0 , 
    "query_cruiseport_single" =>array_key_exists('query_cruiseport_single',$price) ? $price['query_cruiseport_single'] : 0 ,
    "gratuity_supplier" =>array_key_exists('gratuity_supplier',$price) ? $price['gratuity_supplier'] : 0 , 
    "gratuity_remarks" =>array_key_exists('gratuity_remarks',$price) ? $price['gratuity_remarks'] : 0 , 
    "query_cruisegratuity_adult" =>array_key_exists('query_cruisegratuity_adult',$price) ? $price['query_cruisegratuity_adult'] : 0 ,
    "query_cruisegratuity_exadult" =>array_key_exists('query_cruisegratuity_exadult',$price) ? $price['query_cruisegratuity_exadult'] : 0 , 
    "query_cruisegratuity_childbed" =>array_key_exists('query_cruisegratuity_childbed',$price) ? $price['query_cruisegratuity_childbed'] : 0 , 
    "query_cruisegratuity_childwbed" =>array_key_exists('query_cruisegratuity_childwbed',$price) ? $price['query_cruisegratuity_childwbed'] : 0 ,  
    "query_cruisegratuity_infant" =>array_key_exists('query_cruisegratuity_infant',$price) ? $price['query_cruisegratuity_infant'] : 0 , 
    "query_cruisegratuity_single" =>array_key_exists('query_cruisegratuity_single',$price) ? $price['query_cruisegratuity_single'] : 0 , 
    "cruise_gst_fare_supplier" =>array_key_exists('cruise_gst_fare_supplier',$price) ? $price['cruise_gst_fare_supplier'] : 0 ,
    "cruise_gst_fare_remarks" =>array_key_exists('cruise_gst_fare_remarks',$price) ? $price['cruise_gst_fare_remarks'] : 0 ,
    "query_cruisegst_adult" =>array_key_exists('query_cruisegst_adult',$price) ? $price['query_cruisegst_adult'] : 0 , 
    "query_cruisegst_exadult" =>array_key_exists('query_cruisegst_exadult',$price) ? $price['query_cruisegst_exadult'] : 0 ,
    "query_cruisegst_childbed" =>array_key_exists('query_cruisegst_childbed',$price) ? $price['query_cruisegst_childbed'] : 0 ,  
    "query_cruisegst_childwbed" => array_key_exists('query_cruisegst_childwbed',$price) ? $price['query_cruisegst_childwbed'] : 0 ,
    "query_cruisegst_infant" => array_key_exists('query_cruisegst_infant',$price) ? $price['query_cruisegst_infant'] : 0 ,
    "query_cruisegst_single" => array_key_exists('query_cruisegst_single',$price) ? $price['query_cruisegst_single'] : 0 ,
    "accommodation_fare_supplier" =>array_key_exists('accommodation_fare_supplier',$price) ? $price['accommodation_fare_supplier'] : 0 ,  
    "accommodation_fare_remarks" =>array_key_exists('accommodation_fare_remarks',$price) ? $price['accommodation_fare_remarks'] : 0 , 
    "query_hotel_adult" =>array_key_exists('query_hotel_adult',$price) ? $price['query_hotel_adult'] : 0 ,  
    "query_hotel_exadult" => array_key_exists('query_hotel_exadult',$price) ? $price['query_hotel_exadult'] : 0 ,
    "query_hotel_childbed" =>array_key_exists('query_hotel_childbed',$price) ? $price['query_hotel_childbed'] : 0 , 
    "query_hotel_childwbed" =>array_key_exists('query_hotel_childwbed',$price) ? $price['query_hotel_childwbed'] : 0 , 
    "query_hotel_infant" =>array_key_exists('query_hotel_infant',$price) ? $price['query_hotel_infant'] : 0 ,   
    "query_hotel_single" => array_key_exists('query_hotel_single',$price) ? $price['query_hotel_single'] : 0 ,  
    "sightseeing_fare_supplier" =>array_key_exists('sightseeing_fare_supplier',$price) ? $price['sightseeing_fare_supplier'] : 0 ,  
    "sightseeing_fare_remarks" =>array_key_exists('sightseeing_fare_remarks',$price) ? $price['sightseeing_fare_remarks'] : 0 ,  
    "query_tours_adult" => array_key_exists('query_tours_adult',$price) ? $price['query_tours_adult'] : 0 ,  
    "query_tours_exadult" =>array_key_exists('query_tours_exadult',$price) ? $price['query_tours_exadult'] : 0 ,   
    "query_tours_childbed" => array_key_exists('query_tours_childbed',$price) ? $price['query_tours_childbed'] : 0 , 
    "query_tours_childwbed" => array_key_exists('query_tours_childwbed',$price) ? $price['query_tours_childwbed'] : 0 , 
    "query_tours_infant" =>array_key_exists('query_tours_infant',$price) ? $price['query_tours_infant'] : 0 , 
    "query_tours_single" =>array_key_exists('query_tours_single',$price) ? $price['query_tours_single'] : 0 , 
    "transfers_fare_supplier" => array_key_exists('transfers_fare_supplier',$price) ? $price['transfers_fare_supplier'] : 0 , 
    "transfers_fare_remarks" =>array_key_exists('transfers_fare_remarks',$price) ? $price['transfers_fare_remarks'] : 0 ,  
    "query_transfer_adult" => array_key_exists('query_transfer_adult',$price) ? $price['query_transfer_adult'] : 0 ,  
    "query_transfer_exadult" =>array_key_exists('query_transfer_exadult',$price) ? $price['query_transfer_exadult'] : 0 , 
    "query_transfer_childbed" =>array_key_exists('query_transfer_childbed',$price) ? $price['query_transfer_childbed'] : 0 , 
    "query_transfer_childwbed" =>array_key_exists('query_transfer_childwbed',$price) ? $price['query_transfer_childwbed'] : 0 , 
    "query_transfer_infant" =>array_key_exists('query_transfer_infant',$price) ? $price['query_transfer_infant'] : 0 ,  
    "query_transfer_single" =>array_key_exists('query_transfer_single',$price) ? $price['query_transfer_single'] : 0 ,  
    "visa_charges_fare_supplier" => array_key_exists('visa_charges_fare_supplier',$price) ? $price['visa_charges_fare_supplier'] : 0 ,  
    "visa_charges_fare_remarks" =>array_key_exists('visa_charges_fare_remarks',$price) ? $price['visa_charges_fare_remarks'] : 0 , 
    "query_visa_adult" =>array_key_exists('query_visa_adult',$price) ? $price['query_visa_adult'] : 0 , 
    "query_visa_exadult" =>array_key_exists('query_visa_exadult',$price) ? $price['query_visa_exadult'] : 0 ,  
    "query_visa_childbed" =>array_key_exists('query_visa_childbed',$price) ? $price['query_visa_childbed'] : 0 , 
    "query_visa_childwbed" =>array_key_exists('query_visa_childwbed',$price) ? $price['query_visa_childwbed'] : 0 ,  
    "query_visa_infant" =>array_key_exists('query_visa_infant',$price) ? $price['query_visa_infant'] : 0 , 
    "query_visa_single" =>array_key_exists('query_visa_single',$price) ? $price['query_visa_single'] : 0 ,   
    "travel_insurance_fare_supplier" => array_key_exists('travel_insurance_fare_supplier',$price) ? $price['travel_insurance_fare_supplier'] : 0 ,  
    "travel_insurance_fare_remarks" => array_key_exists('travel_insurance_fare_remarks',$price) ? $price['travel_insurance_fare_remarks'] : 0 ,  
    "query_inc_adult" => array_key_exists('query_inc_adult',$price) ? $price['query_inc_adult'] : 0 , 
    "query_inc_exadult" =>array_key_exists('query_inc_exadult',$price) ? $price['query_inc_exadult'] : 0 ,  
    "query_inc_childbed" =>array_key_exists('query_inc_childbed',$price) ? $price['query_inc_childbed'] : 0 , 
    "query_inc_childwbed" =>array_key_exists('query_inc_childwbed',$price) ? $price['query_inc_childwbed'] : 0 ,   
    "query_inc_infant" =>array_key_exists('query_inc_infant',$price) ? $price['query_inc_infant'] : 0 , 
    "query_inc_single" =>array_key_exists('query_inc_single',$price) ? $price['query_inc_single'] : 0 , 
    "meals_fare_supplier" =>array_key_exists('meals_fare_supplier',$price) ? $price['meals_fare_supplier'] : 0 ,   
    "meals_fare_remarks" =>array_key_exists('meals_fare_remarks',$price) ? $price['meals_fare_remarks'] : 0 ,  
    "query_meals_adult" =>array_key_exists('query_meals_adult',$price) ? $price['query_meals_adult'] : 0 , 
    "query_meals_exadult" =>array_key_exists('query_meals_exadult',$price) ? $price['query_meals_exadult'] : 0 ,   
    "query_meals_childbed" =>array_key_exists('query_meals_childbed',$price) ? $price['query_meals_childbed'] : 0 ,
    "query_meals_childwbed" =>array_key_exists('query_meals_childwbed',$price) ? $price['query_meals_childwbed'] : 0 , 
    "query_meals_infant" =>array_key_exists('query_meals_infant',$price) ? $price['query_meals_infant'] : 0 ,  
    "query_meals_single" =>array_key_exists('query_meals_single',$price) ? $price['query_meals_single'] : 0 ,  
    "addon_service_fare_supplier" =>array_key_exists('addon_service_fare_supplier',$price) ? $price['addon_service_fare_supplier'] : 0 ,  
    "addon_service_fare_remarks" =>array_key_exists('addon_service_fare_remarks',$price) ? $price['addon_service_fare_remarks'] : 0 , 
    "query_additionalservice_adult" => array_key_exists('query_additionalservice_adult',$price) ? $price['query_additionalservice_adult'] : 0 , 
    "query_additionalservice_exadult" => array_key_exists('query_additionalservice_exadult',$price) ? $price['query_additionalservice_exadult'] : 0 ,
    "query_additionalservice_childbed" => array_key_exists('query_additionalservice_childbed',$price) ? $price['query_additionalservice_childbed'] : 0 , 
    "query_additionalservice_childwbed" =>array_key_exists('query_additionalservice_childwbed',$price) ? $price['query_additionalservice_childwbed'] : 0 , 
    "query_additionalservice_infant" =>array_key_exists('query_additionalservice_infant',$price) ? $price['query_additionalservice_infant'] : 0 , 
    "query_additionalservice_single" =>array_key_exists('query_additionalservice_single',$price) ? $price['query_additionalservice_single'] : 0 ,
    ];

     $total_adult=0;
     if(array_key_exists('query_air_adult',$price) && $price['query_air_adult']!='' && $price['query_air_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_air_adult'];
     }
      if(array_key_exists('query_cruise_adult',$price) && $price['query_cruise_adult']!='' && $price['query_cruise_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_cruise_adult'];
     }
      if(array_key_exists('query_cruiseport_adult',$price) && $price['query_cruiseport_adult']!='' && $price['query_cruiseport_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_cruiseport_adult'];
     }
      if(array_key_exists('query_cruisegratuity_adult',$price) && $price['query_cruisegratuity_adult']!='' && $price['query_cruisegratuity_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_cruisegratuity_adult'];
     }
      if(array_key_exists('query_cruisegst_adult',$price) && $price['query_cruisegst_adult']!='' && $price['query_cruisegst_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_cruisegst_adult'];
     }
      if(array_key_exists('query_hotel_adult',$price) && $price['query_hotel_adult']!='' && $price['query_hotel_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_hotel_adult'];
     }
      if(array_key_exists('query_tours_adult',$price) && $price['query_tours_adult']!='' && $price['query_tours_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_tours_adult'];
     }
      if(array_key_exists('query_transfer_adult',$price) && $price['query_transfer_adult']!='' && $price['query_transfer_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_transfer_adult'];
     }
      if(array_key_exists('query_visa_adult',$price) && $price['query_visa_adult']!='' && $price['query_visa_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_visa_adult'];
     }
      if(array_key_exists('query_inc_adult',$price) && $price['query_inc_adult']!='' && $price['query_inc_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_inc_adult'];
     }
      if(array_key_exists('query_meals_adult',$price) && $price['query_meals_adult']!='' && $price['query_meals_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_meals_adult'];
     }
      if(array_key_exists('query_additionalservice_adult',$price) && $price['query_additionalservice_adult']!='' && $price['query_additionalservice_adult']!=0)
     {
     $total_adult=$total_adult+$price['query_additionalservice_adult'];
     }
     //
     $total_exadult=0;
     if(array_key_exists('query_air_exadult',$price) && $price['query_air_exadult']!='' && $price['query_air_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_air_exadult'];
     }
      if(array_key_exists('query_cruise_exadult',$price) && $price['query_cruise_exadult']!='' && $price['query_cruise_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_cruise_exadult'];
     }
      if(array_key_exists('query_cruiseport_exadult',$price) && $price['query_cruiseport_exadult']!='' && $price['query_cruiseport_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_cruiseport_exadult'];
     }
      if(array_key_exists('query_cruisegratuity_exadult',$price) && $price['query_cruisegratuity_exadult']!='' && $price['query_cruisegratuity_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_cruisegratuity_exadult'];
     }
      if(array_key_exists('query_cruisegst_exadult',$price) && $price['query_cruisegst_exadult']!='' && $price['query_cruisegst_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_cruisegst_exadult'];
     }
      if(array_key_exists('query_hotel_exadult',$price) && $price['query_hotel_exadult']!='' && $price['query_hotel_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_hotel_exadult'];
     }
      if(array_key_exists('query_tours_exadult',$price) && $price['query_tours_exadult']!='' && $price['query_tours_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_tours_exadult'];
     }
      if(array_key_exists('query_transfer_exadult',$price) && $price['query_transfer_exadult']!='' && $price['query_transfer_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_transfer_exadult'];
     }
      if(array_key_exists('query_visa_exadult',$price) && $price['query_visa_exadult']!='' && $price['query_visa_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_visa_exadult'];
     }
      if(array_key_exists('query_inc_exadult',$price) && $price['query_inc_exadult']!='' && $price['query_inc_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_inc_exadult'];
     }
      if(array_key_exists('query_meals_exadult',$price) && $price['query_meals_exadult']!='' && $price['query_meals_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_meals_exadult'];
     }
      if(array_key_exists('query_additionalservice_exadult',$price) && $price['query_additionalservice_exadult']!='' && $price['query_additionalservice_exadult']!=0)
     {
     $total_exadult=$total_exadult+$price['query_additionalservice_exadult'];
     }
     //
     $total_childbed=0;
     if(array_key_exists('query_air_childbed',$price) && $price['query_air_childbed']!='' && $price['query_air_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_air_childbed'];
     }
      if(array_key_exists('query_cruise_childbed',$price) && $price['query_cruise_childbed']!='' && $price['query_cruise_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_cruise_childbed'];
     }
      if(array_key_exists('query_cruiseport_childbed',$price) && $price['query_cruiseport_childbed']!='' && $price['query_cruiseport_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_cruiseport_childbed'];
     }
      if(array_key_exists('query_cruisegratuity_childbed',$price) && $price['query_cruisegratuity_childbed']!='' && $price['query_cruisegratuity_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_cruisegratuity_childbed'];
     }
      if(array_key_exists('query_cruisegst_childbed',$price) && $price['query_cruisegst_childbed']!='' && $price['query_cruisegst_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_cruisegst_childbed'];
     }
      if(array_key_exists('query_hotel_childbed',$price) && $price['query_hotel_childbed']!='' && $price['query_hotel_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_hotel_childbed'];
     }
      if(array_key_exists('query_tours_childbed',$price) && $price['query_tours_childbed']!='' && $price['query_tours_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_tours_childbed'];
     }
      if(array_key_exists('query_transfer_childbed',$price) && $price['query_transfer_childbed']!='' && $price['query_transfer_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_transfer_childbed'];
     }
      if(array_key_exists('query_visa_childbed',$price) && $price['query_visa_childbed']!='' && $price['query_visa_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_visa_childbed'];
     }
      if(array_key_exists('query_inc_childbed',$price) && $price['query_inc_childbed']!='' && $price['query_inc_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_inc_childbed'];
     }
      if(array_key_exists('query_meals_childbed',$price) && $price['query_meals_childbed']!='' && $price['query_meals_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_meals_childbed'];
     }
      if(array_key_exists('query_additionalservice_childbed',$price) && $price['query_additionalservice_childbed']!='' && $price['query_additionalservice_childbed']!=0)
     {
     $total_childbed=$total_childbed+$price['query_additionalservice_childbed'];
     }
       //
     $total_childwbed=0;
     if(array_key_exists('query_air_childwbed',$price) && $price['query_air_childwbed']!='' && $price['query_air_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_air_childwbed'];
     }
      if(array_key_exists('query_cruise_childwbed',$price) && $price['query_cruise_childwbed']!='' && $price['query_cruise_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_cruise_childwbed'];
     }
      if(array_key_exists('query_cruiseport_childwbed',$price) && $price['query_cruiseport_childwbed']!='' && $price['query_cruiseport_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_cruiseport_childwbed'];
     }
      if(array_key_exists('query_cruisegratuity_childwbed',$price) && $price['query_cruisegratuity_childwbed']!='' && $price['query_cruisegratuity_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_cruisegratuity_childwbed'];
     }
      if(array_key_exists('query_cruisegst_childwbed',$price) && $price['query_cruisegst_childwbed']!='' && $price['query_cruisegst_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_cruisegst_childwbed'];
     }
      if(array_key_exists('query_hotel_childwbed',$price) && $price['query_hotel_childwbed']!='' && $price['query_hotel_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_hotel_childwbed'];
     }
      if(array_key_exists('query_tours_childwbed',$price) && $price['query_tours_childwbed']!='' && $price['query_tours_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_tours_childwbed'];
     }
      if(array_key_exists('query_transfer_childwbed',$price) && $price['query_transfer_childwbed']!='' && $price['query_transfer_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_transfer_childwbed'];
     }
      if(array_key_exists('query_visa_childwbed',$price) && $price['query_visa_childwbed']!='' && $price['query_visa_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_visa_childwbed'];
     }
      if(array_key_exists('query_inc_childwbed',$price) && $price['query_inc_childwbed']!='' && $price['query_inc_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_inc_childwbed'];
     }
      if(array_key_exists('query_meals_childwbed',$price) && $price['query_meals_childwbed']!='' && $price['query_meals_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_meals_childwbed'];
     }
      if(array_key_exists('query_additionalservice_childwbed',$price) && $price['query_additionalservice_childwbed']!='' && $price['query_additionalservice_childwbed']!=0)
     {
     $total_childwbed=$total_childwbed+$price['query_additionalservice_childwbed'];
     }
        //
     $total_infant=0;
     if(array_key_exists('query_air_infant',$price) &&  $price['query_air_infant']!='' && $price['query_air_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_air_infant'];
     }
      if(array_key_exists('query_cruise_infant',$price) &&  $price['query_cruise_infant']!='' && $price['query_cruise_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_cruise_infant'];
     }
      if(array_key_exists('query_cruiseport_infant',$price) &&  $price['query_cruiseport_infant']!='' && $price['query_cruiseport_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_cruiseport_infant'];
     }
      if(array_key_exists('query_cruisegratuity_infant',$price) &&  $price['query_cruisegratuity_infant']!='' && $price['query_cruisegratuity_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_cruisegratuity_infant'];
     }
      if(array_key_exists('query_cruisegst_infant',$price) &&  $price['query_cruisegst_infant']!='' && $price['query_cruisegst_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_cruisegst_infant'];
     }
      if(array_key_exists('query_hotel_infant',$price) &&  $price['query_hotel_infant']!='' && $price['query_hotel_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_hotel_infant'];
     }
      if(array_key_exists('query_tours_infant',$price) &&  $price['query_tours_infant']!='' && $price['query_tours_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_tours_infant'];
     }
      if(array_key_exists('query_transfer_infant',$price) &&  $price['query_transfer_infant']!='' && $price['query_transfer_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_transfer_infant'];
     }
      if(array_key_exists('query_visa_infant',$price) &&  $price['query_visa_infant']!='' && $price['query_visa_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_visa_infant'];
     }
      if(array_key_exists('query_inc_infant',$price) &&  $price['query_inc_infant']!='' && $price['query_inc_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_inc_infant'];
     }
      if(array_key_exists('query_meals_infant',$price) &&  $price['query_meals_infant']!='' && $price['query_meals_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_meals_infant'];
     }
      if(array_key_exists('query_additionalservice_infant',$price) &&  $price['query_additionalservice_infant']!='' && $price['query_additionalservice_infant']!=0)
     {
     $total_infant=$total_infant+$price['query_additionalservice_infant'];
     }
        //
     $total_single=0;
     if(array_key_exists('query_air_single',$price) && $price['query_air_single']!='' && $price['query_air_single']!=0)
     {
     $total_single=$total_single+$price['query_air_single'];
     }
      if(array_key_exists('query_cruise_single',$price) && $price['query_cruise_single']!='' && $price['query_cruise_single']!=0)
     {
     $total_single=$total_single+$price['query_cruise_single'];
     }
      if(array_key_exists('query_cruiseport_single',$price) && $price['query_cruiseport_single']!='' && $price['query_cruiseport_single']!=0)
     {
     $total_single=$total_single+$price['query_cruiseport_single'];
     }
      if(array_key_exists('query_cruisegratuity_single',$price) && $price['query_cruisegratuity_single']!='' && $price['query_cruisegratuity_single']!=0)
     {
     $total_single=$total_single+$price['query_cruisegratuity_single'];
     }
      if(array_key_exists('query_cruisegst_single',$price) && $price['query_cruisegst_single']!='' && $price['query_cruisegst_single']!=0)
     {
     $total_single=$total_single+$price['query_cruisegst_single'];
     }
      if(array_key_exists('query_hotel_single',$price) && $price['query_hotel_single']!='' && $price['query_hotel_single']!=0)
     {
     $total_single=$total_single+$price['query_hotel_single'];
     }
      if(array_key_exists('query_tours_single',$price) && $price['query_tours_single']!='' && $price['query_tours_single']!=0)
     {
     $total_single=$total_single+$price['query_tours_single'];
     }
      if(array_key_exists('query_transfer_single',$price) && $price['query_transfer_single']!='' && $price['query_transfer_single']!=0)
     {
     $total_single=$total_single+$price['query_transfer_single'];
     }
      if(array_key_exists('query_visa_single',$price) && $price['query_visa_single']!='' && $price['query_visa_single']!=0)
     {
     $total_single=$total_single+$price['query_visa_single'];
     }
      if(array_key_exists('query_inc_single',$price) && $price['query_inc_single']!='' && $price['query_inc_single']!=0)
     {
     $total_single=$total_single+$price['query_inc_single'];
     }
      if(array_key_exists('query_meals_single',$price) && $price['query_meals_single']!='' && $price['query_meals_single']!=0)
     {
     $total_single=$total_single+$price['query_meals_single'];
     }
      if(array_key_exists('query_additionalservice_single',$price) && $price['query_additionalservice_single']!='' && $price['query_additionalservice_single']!=0)
     {
     $total_single=$total_single+$price['query_additionalservice_single'];
     }
     
     $query_markup_adult=0;
     if(array_key_exists('query_markup_adult',$price) && $price['query_markup_adult']!='')
     {
      $query_markup_adult=$price['query_markup_adult'];
     }
     $query_markup_exadult=0;
     if(array_key_exists('query_markup_exadult',$price) && $price['query_markup_exadult']!='')
     {
      $query_markup_exadult=$price['query_markup_exadult'];
     }
     $query_markup_childbed=0;
      if(array_key_exists('query_markup_childbed',$price) && $price['query_markup_childbed']!='')
     {
      $query_markup_childbed=$price['query_markup_childbed'];
     }
     $query_markup_childwbed=0;
     if(array_key_exists('query_markup_childwbed',$price) && $price['query_markup_childwbed']!='')
     {
      $query_markup_childwbed=$price['query_markup_childwbed'];
     }
     $query_markup_infant=0;
      if(array_key_exists('query_markup_infant',$price) && $price['query_markup_infant']!='')
     {
     $query_markup_infant=$price['query_markup_infant'];
     }
     $query_markup_single=0;
     if(array_key_exists('query_markup_single',$price) && $price['query_markup_single']!='')
     {
     $query_markup_single=$price['query_markup_single'];
     }
     
     if(array_key_exists('pricemarkup',$price) && $price['pricemarkup']==1)
     {
      }
     elseif(array_key_exists('pricemarkup',$price) && $price['pricemarkup']==2)
     {
      $percentage_markup=$price['markup_percentage'];

      $query_markup_adult=round($total_adult*$percentage_markup/100);
      $query_markup_exadult=round($total_exadult*$percentage_markup/100);
      $query_markup_childbed=round($total_childbed*$percentage_markup/100);
      $query_markup_childwbed=round($total_childwbed*$percentage_markup/100);
      $query_markup_infant=round($total_infant*$percentage_markup/100);
      $query_markup_single=round($total_single*$percentage_markup/100);
     }
      //
     $query_discount_adult=0;
     if(array_key_exists('query_discount_adult',$price) && $price['query_discount_adult']!='')
     {
     $query_discount_adult=$price['query_discount_adult'];
     }
     $query_discount_exadult=0;
      if(array_key_exists('query_discount_exadult',$price) && $price['query_discount_exadult']!='')
     {
      $query_discount_exadult=$price['query_discount_exadult'];
     }
     $query_discount_childbed=0;
      if(array_key_exists('query_discount_childbed',$price) && $price['query_discount_childbed']!='')
     {
      $query_discount_childbed=$price['query_discount_childbed'];
     }
     $query_discount_childwbed=0;
     if(array_key_exists('query_discount_childwbed',$price) && $price['query_discount_childwbed']!='')
     {
     $query_discount_childwbed=$price['query_discount_childwbed'];
     }
     $query_discount_infant=0;
     if(array_key_exists('query_discount_infant',$price) && $price['query_discount_infant']!='')
     {
      $query_discount_infant=$price['query_discount_infant'];
     }
     $query_discount_single=0;
     if(array_key_exists('query_discount_single',$price) && $price['query_discount_single']!='')
     {
      $query_discount_single=$price['query_discount_single'];
     }
     if(array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==1)
     {
      
      
     }
     elseif(array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==2)
     {
      $discountpositive_percentage=$price['discountpositive_percentage'];

      $query_discount_adult=round(($total_adult+$query_markup_adult)*$discountpositive_percentage/100);
      $query_discount_exadult=round(($total_exadult+$query_markup_exadult)*$discountpositive_percentage/100);
      $query_discount_childbed=round(($total_childbed+$query_markup_childbed)*$discountpositive_percentage/100);
      $query_discount_childwbed=round(($total_childwbed+$query_markup_childwbed)*$discountpositive_percentage/100);
      $query_discount_infant=round(($total_infant+$query_markup_infant)*$discountpositive_percentage/100);
      $query_discount_single=round(($total_single+$query_markup_single)*$discountpositive_percentage/100);
     }
     $query_total_adult=round($total_adult+$query_markup_adult+$query_discount_adult);
     $query_total_exadult=round($total_exadult+$query_markup_exadult+$query_discount_exadult);
     $query_total_childbed=round($total_childbed+$query_markup_childbed+$query_discount_childbed);
     $query_total_childwbed=round($total_childwbed+$query_markup_childwbed+$query_discount_childwbed);
     $query_total_infant=round($total_infant+$query_markup_infant+$query_discount_infant);
     $query_total_single=round($total_single+$query_markup_single+$query_discount_single);

     $query_total_group=($query_total_adult*$adult)+($query_total_exadult*$extra_adult)+($query_total_childbed*$child_with_bed)+($query_total_childwbed*$child_without_bed)+($query_total_infant*$infant)+($query_total_single*$solo_traveller);
    
    //
     $query_discount_minus_adult=0;
     if(array_key_exists('query_discount_minus_adult',$price) && $price['query_discount_minus_adult']!='')
     {
     $query_discount_minus_adult=$price['query_discount_minus_adult'];
     }
     $query_discount_minus_exadult=0;
      if(array_key_exists('query_discount_minus_exadult',$price) && $price['query_discount_minus_exadult']!='')
     {
    $query_discount_minus_exadult=$price['query_discount_minus_exadult'];
     }
     $query_discount_minus_childbed=0;
      if(array_key_exists('query_discount_minus_childbed',$price) && $price['query_discount_minus_childbed']!='')
     {
    $query_discount_minus_childbed=$price['query_discount_minus_childbed'];
     }
     $query_discount_minus_childwbed=0;
     if(array_key_exists('query_discount_minus_childwbed',$price) && $price['query_discount_minus_childwbed']!='')
     {
     $query_discount_minus_childwbed=$price['query_discount_minus_childwbed'];
     }
     $query_discount_minus_infant=0;
     if(array_key_exists('query_discount_minus_infant',$price) && $price['query_discount_minus_infant']!='')
     {
      $query_discount_minus_infant=$price['query_discount_minus_infant'];
     }
     $query_discount_minus_single=0;
     if(array_key_exists('query_discount_minus_single',$price) && $price['query_discount_minus_single']!='')
     {
      $query_discount_minus_single=$price['query_discount_minus_single'];
     }
     if(array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==1)
     {
      
      
     }
     elseif(array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==2)
     {
      $discountnegative_percentage=$price['discountnegative_percentage'];
      $divide_val=$discountnegative_percentage+100;
      $query_discount_minus_adult=round($query_total_adult*$discountnegative_percentage/$divide_val);
      $query_discount_minus_exadult=round($query_total_exadult*$discountnegative_percentage/$divide_val);
      $query_discount_minus_childbed=round($query_total_childbed*$discountnegative_percentage/$divide_val);
      $query_discount_minus_childwbed=round($query_total_childwbed*$discountnegative_percentage/$divide_val);
      $query_discount_minus_infant=round($query_total_infant*$discountnegative_percentage/$divide_val);
      $query_discount_minus_single=round($query_total_single*$discountnegative_percentage/$divide_val);
     }
      elseif(array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==3)
     {
     
      $discountnegative_percentage=array_key_exists('discount_coupon',$price) ? $price['discount_coupon'] : 0;
     
      $divide_val=$discountnegative_percentage+100;
      $query_discount_minus_adult=round($query_total_adult*$discountnegative_percentage/$divide_val);
      $query_discount_minus_exadult=round($query_total_exadult*$discountnegative_percentage/$divide_val);
      $query_discount_minus_childbed=round($query_total_childbed*$discountnegative_percentage/$divide_val);
      $query_discount_minus_childwbed=round($query_total_childwbed*$discountnegative_percentage/$divide_val);
      $query_discount_minus_infant=round($query_total_infant*$discountnegative_percentage/$divide_val);
      $query_discount_minus_single=round($query_total_single*$discountnegative_percentage/$divide_val);

     }

      $query_total_discount_group=($query_discount_minus_adult*$adult)+($query_discount_minus_exadult*$extra_adult)+($query_discount_minus_childbed*$child_with_bed)+($query_discount_minus_childwbed*$child_without_bed)+($query_discount_minus_infant*$infant)+($query_discount_minus_single*$solo_traveller);

     // $query_total_discount_group=$query_discount_minus_adult+$query_discount_minus_exadult+$query_discount_minus_childbed+$query_discount_minus_childwbed+$query_discount_minus_infant+$query_discount_minus_single;

     //
    //  $query_discount_adult=0;
    //  if(array_key_exists('query_discount_adult',$price) && $price['query_discount_adult']!='')
    //  {
    //  $query_discount_adult=$price['query_discount_adult'];
    //  }
    //  $query_discount_exadult=0;
    //   if(array_key_exists('query_discount_exadult',$price) && $price['query_discount_exadult']!='')
    //  {
    // $query_discount_exadult=$price['query_discount_exadult'];
    //  }
    //  $query_discount_childbed=0;
    //   if(array_key_exists('query_discount_childbed',$price) && $price['query_discount_childbed']!='')
    //  {
    // $query_discount_childbed=$price['query_discount_childbed'];
    //  }
    //  $query_discount_childwbed=0;
    //  if(array_key_exists('query_discount_childwbed',$price) && $price['query_discount_childwbed']!='')
    //  {
    //  $query_discount_childwbed=$price['query_discount_childwbed'];
    //  }
    //  $query_discount_infant=0;
    //  if(array_key_exists('query_discount_infant',$price) && $price['query_discount_infant']!='')
    //  {
    //   $query_discount_infant=$price['query_discount_infant'];
    //  }
    //  $query_discount_single=0;
    //  if(array_key_exists('query_discount_single',$price) && $price['query_discount_single']!='')
    //  {
    //   $query_discount_single=$price['query_discount_single'];
    //  }
    //  if(array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==1)
    //  {
      
      
    //  }
    //  elseif(array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==2)
    //  {
    //   $percentage_markup=$price['markup_percentage'];

    //   $query_discount_adult=($total_adult+$query_markup_adult)*$percentage_markup/100;
    //   $query_discount_exadult=($total_exadult+$query_markup_exadult)*$percentage_markup/100;
    //   $query_discount_childbed=($total_childbed+$query_markup_childbed)*$percentage_markup/100;
    //   $query_discount_childwbed=($total_childwbed+$query_markup_childwbed)*$percentage_markup/100;
    //   $query_discount_infant=($total_infant+$query_markup_infant)*$percentage_markup/100;
    //   $query_discount_single=($total_single+$query_markup_single)*$percentage_markup/100;
    //  }


    //  $query_total_adult=$total_adult+$query_markup_adult+$query_discount_adult;
    //  $query_total_exadult=$total_exadult+$query_markup_exadult+$query_discount_exadult;
    //  $query_total_childbed=$total_childbed+$query_markup_childbed+$query_discount_childbed;
    //  $query_total_childwbed=$total_childwbed+$query_markup_childwbed+$query_discount_childwbed;
    //  $query_total_infant=$total_infant+$query_markup_infant+$query_discount_infant;
    //  $query_total_single=$total_single+$query_markup_single+$query_discount_single;

    //  $query_total_group=($query_total_adult*$adult)+($query_total_exadult*$extra_adult)+($query_total_childbed*$child_with_bed)+($query_total_childwbed*$child_without_bed)+($query_total_infant*$infant)+($query_total_single*$solo_traveller);
    
    //
     $query_gst_adult=0;
     if(array_key_exists('query_gst_adult',$price) && $price['query_gst_adult']!='')
     {
     $query_gst_adult=$price['query_gst_adult'];
     }
     $query_gst_exadult=0;
      if(array_key_exists('query_gst_exadult',$price) && $price['query_gst_exadult']!='')
     {
    $query_gst_exadult=$price['query_gst_exadult'];
     }
     $query_gst_childbed=0;
      if(array_key_exists('query_gst_childbed',$price) && $price['query_gst_childbed']!='')
     {
    $query_gst_childbed=$price['query_gst_childbed'];
     }
     $query_gst_childwbed=0;
     if(array_key_exists('query_gst_childwbed',$price) && $price['query_gst_childwbed']!='')
     {
     $query_gst_childwbed=$price['query_gst_childwbed'];
     }
     $query_gst_infant=0;
     if(array_key_exists('query_gst_infant',$price) && $price['query_gst_infant']!='')
     {
      $query_gst_infant=$price['query_gst_infant'];
     }
     $query_gst_single=0;
     if(array_key_exists('query_gst_single',$price) && $price['query_gst_single']!='')
     {
      $query_gst_single=$price['query_gst_single'];
     }
     if(array_key_exists('gst_percentage',$price) && $price['gst_percentage']==1)
     {
      
      
     }
     elseif(array_key_exists('gst_percentage',$price) && $price['gst_percentage']==2)
     {
       $gst_percentage=$price['gst_percentage'];
      
      $query_gst_adult=round(($query_total_adult-$query_discount_minus_adult)*$gst_percentage/100);
      $query_gst_exadult=round(($query_total_exadult-$query_discount_minus_exadult)*$gst_percentage/100);
      $query_gst_childbed=round(($query_total_childbed-$query_discount_minus_childbed)*$gst_percentage/100);
      $query_gst_childwbed=round(($query_total_childwbed-$query_discount_minus_childwbed)*$gst_percentage/100);
      $query_gst_infant=round(($query_total_infant-$query_discount_minus_infant)*$gst_percentage/100);
      $query_gst_single=round(($query_total_single-$query_discount_minus_single)*$gst_percentage/100);
      
     }
     $query_total_gst_group=($query_gst_adult*$adult)+($query_gst_exadult*$extra_adult)+($query_gst_childbed*$child_with_bed)+($query_gst_childwbed*$child_without_bed)+($query_gst_infant*$infant)+($query_gst_single*$solo_traveller);

     $query_gsttotal_adult=round($query_total_adult-$query_discount_minus_adult+$query_gst_adult);
     $query_gsttotal_exadult=round($query_total_exadult-$query_discount_minus_exadult+$query_gst_exadult);
     $query_gsttotal_childbed=round($query_total_childbed-$query_discount_minus_childbed+$query_gst_childbed);
     $query_gsttotal_childwbed=round($query_total_childwbed-$query_discount_minus_childwbed+$query_gst_childwbed);
     $query_gsttotal_infant=round($query_total_infant-$query_discount_minus_infant+$query_gst_infant);
     $query_gsttotal_single=round($query_total_single-$query_discount_minus_single+$query_gst_single);

    //TCS CALCULATION
     $query_tcs_adult=0;
     if(array_key_exists('query_tcs_adult',$price) && $price['query_tcs_adult']!='')
     {
     $query_tcs_adult=$price['query_tcs_adult'];
     }
     $query_tcs_exadult=0;
      if(array_key_exists('query_tcs_exadult',$price) && $price['query_tcs_exadult']!='')
     {
    $query_tcs_exadult=$price['query_tcs_exadult'];
     }
     $query_tcs_childbed=0;
      if(array_key_exists('query_tcs_childbed',$price) && $price['query_tcs_childbed']!='')
     {
    $query_tcs_childbed=$price['query_tcs_childbed'];
     }
     $query_tcs_childwbed=0;
     if(array_key_exists('query_tcs_childwbed',$price) && $price['query_tcs_childwbed']!='')
     {
     $query_tcs_childwbed=$price['query_tcs_childwbed'];
     }
     $query_tcs_infant=0;
     if(array_key_exists('query_tcs_infant',$price) && $price['query_tcs_infant']!='')
     {
      $query_tcs_infant=$price['query_tcs_infant'];
     }
     $query_tcs_single=0;
     if(array_key_exists('query_tcs_single',$price) && $price['query_tcs_single']!='')
     {
      $query_tcs_single=$price['query_tcs_single'];
     }
     if(array_key_exists('query_tcs_curr',$price) && $price['query_tcs_curr']==1)
     {
      
      
     }
     elseif(array_key_exists('query_tcs_curr',$price) && $price['query_tcs_curr']==2)
     {
      $tcs_percentage=$price['tcs_percentage'];

      $query_tcs_adult=round($query_gsttotal_adult*$tcs_percentage/100);
      $query_tcs_exadult=round($query_gsttotal_exadult*$tcs_percentage/100);
      $query_tcs_childbed=round($query_gsttotal_childbed*$tcs_percentage/100);
      $query_tcs_childwbed=round($query_gsttotal_childwbed*$tcs_percentage/100);
      $query_tcs_infant=round($query_gsttotal_infant*$tcs_percentage/100);
      $query_tcs_single=round($query_gsttotal_single*$tcs_percentage/100);
     }

     $query_total_tcs_group=($query_tcs_adult*$adult)+($query_tcs_exadult*$extra_adult)+($query_tcs_childbed*$child_with_bed)+($query_tcs_childwbed*$child_without_bed)+($query_tcs_infant*$infant)+($query_tcs_single*$solo_traveller);

     $query_tcstotal_adult=round($query_gsttotal_adult+$query_tcs_adult);
     $query_tcstotal_exadult=round($query_gsttotal_exadult+$query_tcs_exadult);
     $query_tcstotal_childbed=round($query_gsttotal_childbed+$query_tcs_childbed);
     $query_tcstotal_childwbed=round($query_gsttotal_childwbed+$query_tcs_childwbed);
     $query_tcstotal_infant=round($query_gsttotal_infant+$query_tcs_infant);
     $query_tcstotal_single=round($query_gsttotal_single+$query_tcs_single);
     //Pg Charges
    
     $query_pgcharges_adult=0;
     if(array_key_exists('query_pgcharges_adult',$price) && $price['query_pgcharges_adult']!='')
     {
     $query_pgcharges_adult=$price['query_pgcharges_adult'];
     }
     $query_pgcharges_exadult=0;
      if(array_key_exists('query_pgcharges_exadult',$price) && $price['query_pgcharges_exadult']!='')
     {
    $query_pgcharges_exadult=$price['query_pgcharges_exadult'];
     }
     $query_pgcharges_childbed=0;
      if(array_key_exists('query_pgcharges_childbed',$price) && $price['query_pgcharges_childbed']!='')
     {
    $query_pgcharges_childbed=$price['query_pgcharges_childbed'];
     }
     $query_pgcharges_childwbed=0;
     if(array_key_exists('query_pgcharges_childwbed',$price) && $price['query_pgcharges_childwbed']!='')
     {
     $query_pgcharges_childwbed=$price['query_pgcharges_childwbed'];
     }
     $query_pgcharges_infant=0;
     if(array_key_exists('query_pgcharges_infant',$price) && $price['query_pgcharges_infant']!='')
     {
      $query_pgcharges_infant=$price['query_pgcharges_infant'];
     }
     $query_pgcharges_single=0;
     if(array_key_exists('query_pgcharges_single',$price) && $price['query_pgcharges_single']!='')
     {
      $query_pgcharges_single=$price['query_pgcharges_single'];
     }
     if(array_key_exists('pg_charges',$price) && $price['pg_charges']==1)
     {
      
      
     }
     elseif(array_key_exists('pg_charges',$price) && $price['pg_charges']==2)
     {
      $pgcharges_percentage=1;

      $query_pgcharges_adult=round($query_tcstotal_adult*$pgcharges_percentage/100);
      $query_pgcharges_exadult=round($query_tcstotal_exadult*$pgcharges_percentage/100);
      $query_pgcharges_childbed=round($query_tcstotal_childbed*$pgcharges_percentage/100);
      $query_pgcharges_childwbed=round($query_tcstotal_childwbed*$pgcharges_percentage/100);
      $query_pgcharges_infant=round($query_tcstotal_infant*$pgcharges_percentage/100);
      $query_pgcharges_single=round($query_tcstotal_single*$pgcharges_percentage/100);
     }

     $query_total_pg_group=($query_pgcharges_adult*$adult)+($query_pgcharges_exadult*$extra_adult)+($query_pgcharges_childbed*$child_with_bed)+($query_pgcharges_childwbed*$child_without_bed)+($query_pgcharges_infant*$infant)+($query_pgcharges_single*$solo_traveller);

   
     $query_grand_adult=round($query_tcstotal_adult+$query_pgcharges_adult);
     $query_grand_exadult=round($query_tcstotal_exadult+$query_pgcharges_exadult);
     $query_grand_childbed=round($query_tcstotal_childbed+$query_pgcharges_childbed);
     $query_grand_childwbed=round($query_tcstotal_childwbed+$query_pgcharges_childwbed);
     $query_grand_infant=round($query_tcstotal_infant+$query_pgcharges_infant);
     $query_grand_single=round($query_tcstotal_single+$query_pgcharges_single);

     $query_paytotal_adult=round($query_grand_adult*$adult);
     $query_paytotal_exadult=round($query_grand_exadult*$extra_adult);
     $query_paytotal_childbed=round($query_grand_childbed*$child_with_bed);
     $query_paytotal_childwbed=round($query_grand_childwbed*$child_without_bed);
     $query_paytotal_infant=round($query_grand_infant*$infant);
     $query_paytotal_single=round($query_grand_single*$solo_traveller);

    $query_pricetopay_adult=$query_paytotal_adult+$query_paytotal_exadult+$query_paytotal_childbed+$query_paytotal_childwbed+$query_paytotal_infant+$query_paytotal_single;
     




    $data2=["query_tourtotal_adult" => $total_adult,
    "query_tourtotal_exadult" =>$total_exadult,
    "query_tourtotal_childbed" => $total_childbed,
    "query_tourtotal_childwbed" =>$total_childwbed,
    "query_tourtotal_infant" => $total_infant,
    "query_tourtotal_single" =>  $total_single,
    "pricemarkup" =>array_key_exists('pricemarkup',$price) ? $price['pricemarkup'] : 0 , 
    "markup_percentage" =>array_key_exists('markup_percentage',$price) ? $price['markup_percentage'] : 0 ,
    "query_markup_adult" =>$query_markup_adult,
    "query_markup_exadult" => $query_markup_exadult,
    "query_markup_childbed" => $query_markup_childbed,
    "query_markup_childwbed" =>$query_markup_childwbed,
    "query_markup_infant" => $query_markup_infant,
    "query_markup_single" =>$query_markup_single,
    "pricediscountpositive" =>array_key_exists('pricediscountpositive',$price) ? $price['pricediscountpositive'] : 0 , 
    "discountpositive_percentage" =>array_key_exists('discountpositive_percentage',$price) ? $price['discountpositive_percentage'] : 0 , 
    "query_discount_adult" => $query_discount_adult,
    "query_discount_exadult" =>$query_discount_exadult,
    "query_discount_childbed" => $query_discount_childbed,
    "query_discount_childwbed" => $query_discount_childwbed,
    "query_discount_infant" => $query_discount_infant,
    "query_discount_single" => $query_discount_single,
    "query_total_adult" => $query_total_adult,
    "query_total_exadult" => $query_total_exadult,
    "query_total_childbed" => $query_total_childbed,
    "query_total_childwbed" => $query_total_childwbed,
    "query_total_infant" => $query_total_infant,
    "query_total_single" => $query_total_single,
    "query_total_group" => $query_total_group,
    "pricediscountnegative" =>array_key_exists('pricediscountnegative',$price) ? $price['pricediscountnegative'] : 0 , 
    "discountnegative_percentage" =>array_key_exists('discountnegative_percentage',$price) ? $price['discountnegative_percentage'] : 0 , 
    "discount_coupon" =>array_key_exists('discount_coupon',$price) ? $price['discount_coupon'] : 0 , 
    "coupon_id" =>array_key_exists('coupon_id',$price) ? $price['coupon_id'] : 0 , 
    "query_discount_minus_adult" => $query_discount_minus_adult,
    "query_discount_minus_exadult" => $query_discount_minus_exadult,
    "query_discount_minus_childbed" =>$query_discount_minus_childbed,
    "query_discount_minus_childwbed" => $query_discount_minus_childwbed,
    "query_discount_minus_infant" => $query_discount_minus_infant,
    "query_discount_minus_single" => $query_discount_minus_single,
    "query_total_discount_group" => $query_total_discount_group,
    "query_gst_curr" =>array_key_exists('query_gst_curr',$price) ? $price['query_gst_curr'] : 0 ,  
    "gst_percentage" =>array_key_exists('gst_percentage',$price) ? $price['gst_percentage'] : 0 ,  
    "query_gst_adult" => $query_gst_adult,
    "query_gst_exadult" => $query_gst_exadult,
    "query_gst_childbed" => $query_gst_childbed,
    "query_gst_childwbed" => $query_gst_childwbed,
    "query_gst_infant" => $query_gst_infant,
    "query_gst_single" => $query_gst_single,
    "query_total_gst_group" => $query_total_gst_group,
    "query_gsttotal_adult" => $query_gsttotal_adult,
    "query_gsttotal_exadult" =>$query_gsttotal_exadult,
    "query_gsttotal_childbed" => $query_gsttotal_childbed,
    "query_gsttotal_childwbed" => $query_gsttotal_childwbed,
    "query_gsttotal_infant" => $query_gsttotal_infant,
    "query_gsttotal_single" => $query_gsttotal_single,
    "query_tcs_curr" =>array_key_exists('query_tcs_curr',$price) ? $price['query_tcs_curr'] : 0 , 
    "tcs_percentage" =>array_key_exists('tcs_percentage',$price) ? $price['tcs_percentage'] : 0 , 
    "query_tcs_adult" => $query_tcs_adult,
    "query_tcs_exadult" =>  $query_tcs_exadult,
    "query_tcs_childbed" =>  $query_tcs_childbed,
    "query_tcs_childwbed" => $query_tcs_childwbed,
    "query_tcs_infant" =>  $query_tcs_infant,
    "query_tcs_single" =>  $query_tcs_single,
    "query_total_tcs_group" => $query_total_tcs_group,
    "query_tcstotal_adult" => $query_tcstotal_adult,
    "query_tcstotal_exadult" =>$query_tcstotal_exadult,
    "query_tcstotal_childbed" => $query_tcstotal_childbed,
    "query_tcstotal_childwbed" => $query_tcstotal_childwbed,
    "query_tcstotal_infant" => $query_tcstotal_infant,
    "query_tcstotal_single" => $query_tcstotal_single,
    "pg_charges" =>array_key_exists('pg_charges',$price) ? $price['pg_charges'] : 0 ,  
    "pgcharges_percentage" => array_key_exists('pgcharges_percentage',$price) ? $price['pgcharges_percentage'] : 0 ,  
    "query_pgcharges_adult" =>$query_pgcharges_adult,
    "query_pgcharges_exadult" => $query_pgcharges_exadult,
    "query_pgcharges_childbed" => $query_pgcharges_childbed,
    "query_pgcharges_childwbed" => $query_pgcharges_childwbed,
    "query_pgcharges_infant" => $query_pgcharges_infant,
    "query_pgcharges_single" => $query_pgcharges_single,
    "query_total_pg_group" => $query_total_pg_group,
    "query_grand_adult" =>  $query_grand_adult,
    "query_grand_exadult" =>  $query_grand_exadult,
    "query_grand_childbed" =>  $query_grand_childbed,
    "query_grand_childwbed" =>  $query_grand_childwbed,
    "query_grand_infant" =>  $query_grand_infant,
    "query_grand_single" => $query_grand_single,
    "query_paytotal_adult" => $query_paytotal_adult,
    "query_paytotal_exadult" =>$query_paytotal_exadult,
    "query_paytotal_childbed" => $query_paytotal_childbed,
    "query_paytotal_childwbed" => $query_paytotal_childwbed,
    "query_paytotal_infant" =>$query_paytotal_infant,
    "query_paytotal_single" => $query_paytotal_single,
    "query_pricetopay_adult" => $query_pricetopay_adult,
        ];

    $data=array_merge($data1,$data2);
   
    return $data;
  }

  /************************************/
  
  /*public static function part_payments($part_paymeny_data,$total_price) {
    $part_paymeny_data=unserialize($part_paymeny_data);
    $adv_percentage=array_key_exists('adv_percentage',$part_paymeny_data) ? $part_paymeny_data['adv_percentage'] : 100;   
    $first_part_percentage=$part_paymeny_data['first_part_percentage'];
    if($first_part_percentage=='')
    {
      $first_part_percentage=0;   
    }
    $second_part_percentage=$part_paymeny_data['second_part_percentage'];
    if($second_part_percentage=='')
    {
      $second_part_percentage=0;   
    }
    if(((float)$adv_percentage+(float)$first_part_percentage+(float)$second_part_percentage)>100)
    {
      $adv_percentage=100; 
      $first_part_percentage=0;  
      $second_part_percentage=0;         
    }
    $adv_amount=round((float)$total_price*(float)$adv_percentage/100);
    $first_part_amount=round((float)$total_price*(float)$first_part_percentage/100);
    $second_part_amount=round((float)$total_price*(float)$second_part_percentage/100);
    $data1=[
      "adv_type" => array_key_exists('adv_type',$part_paymeny_data) ? $part_paymeny_data['adv_type'] : 2 ,
      "adv_percentage" => $adv_percentage ,
      "adv_amount" => $adv_amount,
      "adv_days" => array_key_exists('adv_days',$part_paymeny_data) ? $part_paymeny_data['adv_days'] : 0 ,
      "adv_date" => array_key_exists('adv_date',$part_paymeny_data) ? $part_paymeny_data['adv_date'] : ' ',
      "first_part_type" => array_key_exists('first_part_type',$part_paymeny_data) ? $part_paymeny_data['first_part_type'] : 2 ,
      "first_part_percentage" => $first_part_percentage ,
      "first_part_amount" => $first_part_amount ,
      "first_part_days" => array_key_exists('first_part_days',$part_paymeny_data) ? $part_paymeny_data['first_part_days'] : 0 ,
      "first_part_date" => array_key_exists('first_part_date',$part_paymeny_data) ? $part_paymeny_data['first_part_date'] : ' ',
      "second_part_type" => array_key_exists('second_part_type',$part_paymeny_data) ? $part_paymeny_data['second_part_type'] : 2 ,
      "second_part_percentage" => $second_part_percentage ,
      "second_part_amount" => $second_part_amount,
      "second_part_days" => array_key_exists('second_part_days',$part_paymeny_data) ? $part_paymeny_data['second_part_days'] : 0 ,
      "second_part_date" => array_key_exists('second_part_date',$part_paymeny_data) ? $part_paymeny_data['second_part_date'] : ' ',
      "total_installment" => $total_price ,
    ];
    return $data1;
  }*/

  public static function part_payments($part_paymeny_data, $total_price) {
    // Unserialize the payment data
    $part_paymeny_data = unserialize($part_paymeny_data);

    // Use array_key_exists to safely access adv_percentage, default to 100
    $adv_percentage = array_key_exists('adv_percentage', $part_paymeny_data) ? $part_paymeny_data['adv_percentage'] : 100;   

    // Check for first_part_percentage and set to 0 if empty
    $first_part_percentage = array_key_exists('first_part_percentage', $part_paymeny_data) ? $part_paymeny_data['first_part_percentage'] : 0;
    if($first_part_percentage == '') {
        $first_part_percentage = 0;   
    }

    // Check for second_part_percentage and set to 0 if missing
    $second_part_percentage = array_key_exists('second_part_percentage', $part_paymeny_data) ? $part_paymeny_data['second_part_percentage'] : 0;
    if($second_part_percentage == '') {
        $second_part_percentage = 0;   
    }

    // Ensure total percentages do not exceed 100
    if(((float)$adv_percentage + (float)$first_part_percentage + (float)$second_part_percentage) > 100) {
        $adv_percentage = 100; 
        $first_part_percentage = 0;  
        $second_part_percentage = 0;         
    }

    // Calculate amounts
    $adv_amount = round((float)$total_price * (float)$adv_percentage / 100);
    $first_part_amount = round((float)$total_price * (float)$first_part_percentage / 100);
    $second_part_amount = round((float)$total_price * (float)$second_part_percentage / 100);

    // Prepare and return the result data
    $data1 = [
        "adv_type" => array_key_exists('adv_type', $part_paymeny_data) ? $part_paymeny_data['adv_type'] : 2,
        "adv_percentage" => $adv_percentage,
        "adv_amount" => $adv_amount,
        "adv_days" => array_key_exists('adv_days', $part_paymeny_data) ? $part_paymeny_data['adv_days'] : 0,
        "adv_date" => array_key_exists('adv_date', $part_paymeny_data) ? $part_paymeny_data['adv_date'] : ' ',
        "first_part_type" => array_key_exists('first_part_type', $part_paymeny_data) ? $part_paymeny_data['first_part_type'] : 2,
        "first_part_percentage" => $first_part_percentage,
        "first_part_amount" => $first_part_amount,
        "first_part_days" => array_key_exists('first_part_days', $part_paymeny_data) ? $part_paymeny_data['first_part_days'] : 0,
        "first_part_date" => array_key_exists('first_part_date', $part_paymeny_data) ? $part_paymeny_data['first_part_date'] : ' ',
        "second_part_type" => array_key_exists('second_part_type', $part_paymeny_data) ? $part_paymeny_data['second_part_type'] : 2,
        "second_part_percentage" => $second_part_percentage,
        "second_part_amount" => $second_part_amount,
        "second_part_days" => array_key_exists('second_part_days', $part_paymeny_data) ? $part_paymeny_data['second_part_days'] : 0,
        "second_part_date" => array_key_exists('second_part_date', $part_paymeny_data) ? $part_paymeny_data['second_part_date'] : ' ',
        "total_installment" => $total_price,
    ];

    return $data1;
  }
  
  public static function refund_payments($refund_paymeny_data, $total_price) {
    // Unserialize the payment data
    $part_payment_data = unserialize($refund_paymeny_data);
    
    // Use array_key_exists to safely access adv_percentage, default to 100
    $adv_percentage = is_array($part_payment_data) && array_key_exists('adv_percentage', $part_payment_data) ? $part_payment_data['adv_percentage'] : 100;  

    // Check for first_part_percentage and set to 0 if empty
    $first_part_percentage = is_array($part_payment_data) && array_key_exists('first_part_percentage', $part_payment_data) ? $part_payment_data['first_part_percentage'] : 0;
    if($first_part_percentage == '') {
        $first_part_percentage = 0;   
    }

    // Check for second_part_percentage and set to 0 if missing
    $second_part_percentage = is_array($part_payment_data) &&  array_key_exists('second_part_percentage', $part_payment_data) ? $part_payment_data['second_part_percentage'] : 0;
    if($second_part_percentage == '') {
        $second_part_percentage = 0;   
    }

    // Ensure total percentages do not exceed 100
    if(((float)$adv_percentage + (float)$first_part_percentage + (float)$second_part_percentage) > 100) {
        $adv_percentage = 100; 
        $first_part_percentage = 0;  
        $second_part_percentage = 0;         
    }

    // Calculate amounts
    $adv_amount = round((float)$total_price * (float)$adv_percentage / 100);
    $first_part_amount = round((float)$total_price * (float)$first_part_percentage / 100);
    $second_part_amount = round((float)$total_price * (float)$second_part_percentage / 100);

    // Prepare and return the result data
    $data1 = [
        "adv_type" =>is_array($part_payment_data) && array_key_exists('adv_type', $part_payment_data) ? $part_payment_data['adv_type'] : 2,
        "adv_percentage" => $adv_percentage,
        "adv_amount" => $adv_amount,
        "adv_days" => is_array($part_payment_data) && array_key_exists('adv_days', $part_payment_data) ? $part_payment_data['adv_days'] : 0,
        "adv_date" => is_array($part_payment_data) && array_key_exists('adv_date', $part_payment_data) ? $part_payment_data['adv_date'] : ' ',
        "first_part_type" => is_array($part_payment_data) && array_key_exists('first_part_type', $part_payment_data) ? $part_payment_data['first_part_type'] : 2,
        "first_part_percentage" => $first_part_percentage,
        "first_part_amount" => $first_part_amount,
        "first_part_days" => is_array($part_payment_data) && array_key_exists('first_part_days', $part_payment_data) ? $part_payment_data['first_part_days'] : 0,
        "first_part_date" => is_array($part_payment_data) && array_key_exists('first_part_date', $part_payment_data) ? $part_payment_data['first_part_date'] : ' ',
        "second_part_type" => is_array($part_payment_data) && array_key_exists('second_part_type', $part_payment_data) ? $part_payment_data['second_part_type'] : 2,
        "second_part_percentage" => $second_part_percentage,
        "second_part_amount" => $second_part_amount,
        "second_part_days" => is_array($part_payment_data) && array_key_exists('second_part_days', $part_payment_data) ? $part_payment_data['second_part_days'] : 0,
        "second_part_date" => is_array($part_payment_data) && array_key_exists('second_part_date', $part_payment_data) ? $part_payment_data['second_part_date'] : ' ',
        "total_installment" => $total_price,
    ];

    return $data1;
  }

  /************************************/
   
  public static function get_packagehotel_title($id) {
    $query = DB::table('package_hotel')
      ->select('hotelname')
      ->where('id', $id)
      ->first();
      return $query->hotelname;
  }
  
  public static function getpackagerecord($id,$table,$field) {
    $query = DB::table($table)
      ->select($field)
      ->where('id', $id)
      ->first();
      if($query)
      {
        return $query->$field;
      } else{
        return 'NA';
      }
  }
  
  public static function check_quote_exist($query_reference)
  {
    $data=Option1Quotation::where('query_reference',$query_reference)->get()->first();
    if($data!="" && $data!="0") {
      return $data->unique_code;
    } else {
      return 0;
    }
  }

  /************************************/
  
  /*public static function get_quotation_option($reference_id) {
    $output="";

    $reference_data=Option1Quotation::where('quo_ref',$reference_id)->get()->first();
    $reference_data2=Option2Quotation::where('quotation_ref_no',$reference_id)->get()->first();
    $reference_data3=Option3Quotation::where('quotation_ref_no',$reference_id)->get()->first();
    $reference_data4=Option4Quotation::where('quotation_ref_no',$reference_id)->get()->first();

    if($reference_data->status=="1"):
      $id1=$reference_data->id;
      $ref=$reference_data->query_reference;
      $output="<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>";
    endif;

    if($reference_data->status=="1" && $reference_data2->status=="1"):
      $id1=$reference_data->id;
      $ref=$reference_data->query_reference;
      $id2=$reference_data2->id;
      $output="<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
              <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>";
    endif;

    if($reference_data->status=="1" && $reference_data2->status=="1" && $reference_data3->status=="1"):
      $id1=$reference_data->id;
      $id2=$reference_data2->id;
      $id3=$reference_data3->id;
      $ref=$reference_data->query_reference;
    $output="<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
            <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>
            <option id='$id3' quotation_no='3' ref_no='$ref'>Quote3</option>";
    endif;

    if($reference_data->status=="1" && $reference_data2->status=="1" && $reference_data3->status=="1" && $reference_data4->status=="1"):
      $id1=$reference_data->id;
      $id2=$reference_data2->id;
      $id3=$reference_data3->id;
      $id4=$reference_data4->id;
      $ref=$reference_data->query_reference;
    $output="<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
            <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>
            <option id='$id3' quotation_no='3' ref_no='$ref'>Quote3</option>
            <option id='$id4' quotation_no='4' ref_no='$ref'>Quote4</option>";
    endif;

    echo "$output";
  }*/

  public static function get_quotation_option($reference_id) {
    $output = "";

    // Fetching the first matching record for each quotation option
    $reference_data = Option1Quotation::where('quo_ref', $reference_id)->get()->first();
    $reference_data2 = Option2Quotation::where('quotation_ref_no', $reference_id)->get()->first();
    $reference_data3 = Option3Quotation::where('quotation_ref_no', $reference_id)->get()->first();
    $reference_data4 = Option4Quotation::where('quotation_ref_no', $reference_id)->get()->first();

    // Check if the first quotation option exists and its status is '1'
    if ($reference_data && $reference_data->status == "1") {
        $id1 = $reference_data->id;
        $ref = $reference_data->query_reference;
        $output = "<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>";
    }

    // Check if both the first and second quotation options exist and their statuses are '1'
    if ($reference_data && $reference_data->status == "1" && $reference_data2 && $reference_data2->status == "1") {
        $id1 = $reference_data->id;
        $ref = $reference_data->query_reference;
        $id2 = $reference_data2->id;
        $output = "<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
                   <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>";
    }

    // Check if the first three quotation options exist and their statuses are '1'
    if ($reference_data && $reference_data->status == "1" &&
        $reference_data2 && $reference_data2->status == "1" &&
        $reference_data3 && $reference_data3->status == "1") {

        $id1 = $reference_data->id;
        $id2 = $reference_data2->id;
        $id3 = $reference_data3->id;
        $ref = $reference_data->query_reference;
        $output = "<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
                   <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>
                   <option id='$id3' quotation_no='3' ref_no='$ref'>Quote3</option>";
    }

    // Check if all four quotation options exist and their statuses are '1'
    if ($reference_data && $reference_data->status == "1" &&
        $reference_data2 && $reference_data2->status == "1" &&
        $reference_data3 && $reference_data3->status == "1" &&
        $reference_data4 && $reference_data4->status == "1") {

        $id1 = $reference_data->id;
        $id2 = $reference_data2->id;
        $id3 = $reference_data3->id;
        $id4 = $reference_data4->id;
        $ref = $reference_data->query_reference;
        $output = "<option id='$id1' quotation_no='1' ref_no='$ref'>Quote1</option>
                   <option id='$id2' quotation_no='2' ref_no='$ref'>Quote2</option>
                   <option id='$id3' quotation_no='3' ref_no='$ref'>Quote3</option>
                   <option id='$id4' quotation_no='4' ref_no='$ref'>Quote4</option>";
    }

    // Output the generated options
    echo $output;
  }

  /************************************/

  //
  public static function get_quotation_hotel($city) {
    $city_name=$city;
    $data=DB::table('package_hotel')
          ->where('location','like','%'.$city_name.'%')->get();
    return $data;
  }
  
  //
  public static function get_supplier_data($id,$field) {
    $query = DB::table("rt_pkg_supplier_info")
    ->select($field)
    ->where('pkg_id', $id)
    ->first();
    if($query) {
      return $query->$field;
    } else {
      return 'NA';
    }
  }
  
  //
  public static function get_rate($id) {
    $query = DB::table("rt_price")
    ->select("rate")
    ->where('id', $id)
    ->first();
    if($query) {
      return $query->rate;
    } else {
      return 'NA';
    }
  }
  
  //
  public static function get_imgpath_id($id)
  {
        $query=DB::table('package_image_gallery')
              ->select('id')
              ->where('image_path',$id)
              ->first();
       if($query)
       {
        return $query->id;
       }
       else
       {
        return '0';
       }
  }
    
  public static function get_first_galleryid($id)
  {
        $query=DB::table('rt_package_uploads')
              ->select('gallery_id')
              ->where('package_id',$id)
              ->orderBy('sort','ASC')
              ->first();
       if($query)
       {
        return $query->gallery_id;
       }
       else
       {
        return '0';
       }
  }
  
  public static function get_supplier_id($id)
  {
        $query=DB::table('rt_pkg_supplier_info')
              ->select('id')
              ->where('pkg_id',$id)
              ->first();
       if($query)
       {
        return $query->id;
       }
       else
       {
        return '0';
       }
  }
    
  public static function get_gallery_country($id)
  {
        $query=DB::table('package_image_gallery')
              ->select('country')
              ->where('id',$id)
              ->first();
       if($query)
       {
        return $query->country;
       }
       else
       {
        return '0';
       }
  }

  public static function get_gallery_state($id)
  {
        $query=DB::table('package_image_gallery')
              ->select('state')
              ->where('id',$id)
              ->first();
       if($query)
       {
        return $query->state;
       }
       else
       {
        return '0';
       }
  }
  
  /************************************/

  // star rating  
  /*public static function get_star_rating($star)
  {
    $value = "";
    $fullStarSrc = url('/public/uploads/icons/star1.png');
    $halfStarSrc = url('/public/uploads/icons/halfstar.png');

    // Determine the number of full stars and half stars
    $fullStars = floor($star);
    $halfStars = ($star - $fullStars) >= 0.5 ? 1 : 0;

    // Add full stars
    for ($i = 0; $i < $fullStars; $i++) {
        $value .= "<img src='$fullStarSrc' title='$star Star'>";
    }

    // Add half star if needed
    if ($halfStars) {
        $value .= "<img src='$halfStarSrc' title='$star Star'>";
    }

    // Display the star rating
    echo $value;
  }*/

  public static function get_star_rating($star)
  {
    // Ensure $star is a numeric value
    $star = floatval($star); // Convert to float

    $value = "";
    $fullStarSrc = url('/public/uploads/icons/star1.png');
    $halfStarSrc = url('/public/uploads/icons/halfstar.png');

    // Determine the number of full stars and half stars
    $fullStars = floor($star);
    $halfStars = ($star - $fullStars) >= 0.5 ? 1 : 0;

    // Add full stars
    for ($i = 0; $i < $fullStars; $i++) {
        $value .= "<img src='$fullStarSrc' title='$star Star'>";
    }

    // Add half star if needed
    if ($halfStars) {
        $value .= "<img src='$halfStarSrc' title='$star Star'>";
    }

    // Display the star rating
    echo $value;
  }


  /************************************/

  //
  public static function get_sel($prices,$min_price,$max_price)
  {
      $prc=array();
      $ids=array();
      foreach($prices as $pris)
      {
        if($pris["price"]!="" && $min_price>"5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
         $ids[]=$pris["id"];
        }
        elseif($pris["price"]!="" && $min_price>"5000" && $max_price=="400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
         $ids[]=$pris["id"];
        }
         elseif($pris["price"]!="" && $min_price=="5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
         $ids[]=$pris["id"];
        }
        elseif($min_price=="5000" && $max_price=="400000")
        {
          $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
         $ids[]=$pris["id"];
        }
      }
    return array_unique($ids);
      //return $prc;
    }

  //
  public static function get_plh($prices,$min_price,$max_price)
  {
      $prc=array();
      $ids=array();
      foreach($prices as $pris)
      {
        if($pris["price"]!="" && $min_price>"5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($pris["price"]!="" && $min_price>"5000" && $max_price=="400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
         elseif($pris["price"]!="" && $min_price=="5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($min_price=="5000" && $max_price=="400000")
        {
          $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
      }
      $price = array();
      foreach ($prc as $key => $row)
      {
        $price[$key] = $row['price'];
      }
    array_multisort($price, SORT_ASC, $prc);
    foreach($prc as $pak_id)
    {
        $ids[]=$pak_id["id"];
    }
    return array_unique($ids);
  }

  //
  public static function get_phl($prices,$min_price,$max_price)
  {
      $prc=array();
      $ids=array();
      foreach($prices as $pris)
      {
        if($pris["price"]!="" && $min_price>"5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($pris["price"]!="" && $min_price>"5000" && $max_price=="400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
         elseif($pris["price"]!="" && $min_price=="5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($min_price=="5000" && $max_price=="400000")
        {
          $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
      }
      $price = array();
      foreach ($prc as $key => $row)
      {
        $price[$key] = $row['price'];
      }
   array_multisort($price, SORT_DESC, $prc);
    foreach($prc as $pak_id)
    {
        $ids[]=$pak_id["id"];
    }
    return array_unique($ids);
  }
  
  //
  public static function get_dlh($prices,$min_price,$max_price)
  {
      $prc=array();
      $ids=array();
      foreach($prices as $pris)
      {
        if($pris["price"]!="" && $min_price>"5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($pris["price"]!="" && $min_price>"5000" && $max_price=="400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
         elseif($pris["price"]!="" && $min_price=="5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($min_price=="5000" && $max_price=="400000")
        {
          $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
      }
      $price = array();
      foreach ($prc as $key => $row)
      {
        $price[$key] = $row['duration'];
      }
   array_multisort($price, SORT_ASC, $prc);
    foreach($prc as $pak_id)
    {
        $ids[]=$pak_id["id"];
    }
    return array_unique($ids);
  }
  
  //
  public static function get_dhl($prices,$min_price,$max_price)
  {
      $prc=array();
      $ids=array();
      foreach($prices as $pris)
      {
       if($pris["price"]!="" && $min_price>"5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($pris["price"]!="" && $min_price>"5000" && $max_price=="400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
         elseif($pris["price"]!="" && $min_price=="5000" && $max_price<"400000" && $pris["price"]>=$min_price && $pris["price"]<=$max_price)
        {
         $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
        elseif($min_price=="5000" && $max_price=="400000")
        {
          $prc[]=['id'=>$pris["id"],'price'=>$pris["price"],'duration'=>$pris["duration"]];
        }
      }
      $price = array();
      foreach ($prc as $key => $row)
      {
        $price[$key] = $row['duration'];
      }
    array_multisort($price, SORT_DESC, $prc);
    foreach($prc as $pak_id)
    {
        $ids[]=$pak_id["id"];
    }
    return array_unique($ids);
  }

  /************************************/

  public static function get_location_data($data, $page)
  {
    // Initialize pagination and data variables
    $link = $data->links();
    $package_list_data = "";

    // Determine pagination range based on current page
    if ($page != "") {
        $url_page1 = $page * 10;
        $url_page2 = $url_page1 - 10;
    } else {
        $url_page2 = 0;
    }

    // Loop through each package in $data
    foreach ($data as $package):
        // Increment the counter for row numbers
        $url_page2++;

        // Start building the row for the package data
        $package_list_data .= "<tr>
                                <td>$url_page2</td>
                               <td>" . ($package->country_list->name ?? $package->country . ' (old)') . "</td>
        <td>" . ($package->state_list->name ?? $package->state . ' (old)') . "</td>
        <td>" . ($package->city_list->name ?? $package->location . ' (old)') . "</td>
                                <td>$package->currency</td>
                                <td>";

        // Display 'Enabled' or 'Disabled' button based on package status
        if ($package->status == 1):
            $package_list_data .= "<button type='button' class='btn btn-sm btn-success location_btn_enable' value='$package->id'>Enabled</button>";
        else:
            $package_list_data .= "<button type='button' class='btn btn-sm btn-danger location_btn_enable' value='$package->id'>Disabled</button>";
        endif;

        $package_list_data .= "</td>
                               <td>";

        // Prepare delete form URL and IDs
        $form_url = url('/location-delete');
        $del_id = "packagedel$package->id";
        $edit_pac_url = url('/package-locations-edit/' . $package->id);

        // Check if user is logged in and has appropriate roles (administrator or super_admin)
        if (Sentinel::check()):
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $package_list_data .= "<form action='$form_url' method='POST' id='$del_id'>";
                $package_list_data .= csrf_field(); // Add CSRF protection
                $package_list_data .= "<input type='hidden' name='id' value='$package->id'/>";
                $package_list_data .= "</form>";
            endif;
        endif;

        // Add edit and delete buttons
        $package_list_data .= "<span>
                                 <a href='$edit_pac_url'>
                                   <button class='btn btn-sm btn-warning'>Edit</button>
                                 </a>";

        // Add delete button if user has proper roles
        if (Sentinel::check()):
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $package_list_data .= "<button id='$del_id' class='btn btn-sm btn-danger deletePackage'>Delete</button>";
            endif;
        endif;

        $package_list_data .= "</span>
                              </td>
                              </tr>";
    endforeach;

    // Add pagination to the table footer
    $package_list_data .= "<tr>
                             <td colspan='7'>
                               <div class='location_list_paginate text-center'>$link</div>
                             </td>
                           </tr>";

    // Return the generated HTML for the package list table
    return $package_list_data;
  }

  /************************************/

  // to check
  /*public static function get_package_list($data,$page)
  {
    $link=$data->links();
    $package_list_data="";
    if($page!="")
    {
      $url_page1=$page*5;
     $url_page2=$url_page1-5;
    }
    else
    {
      $url_page2=0;
    }
    foreach($data as $package):
      $url_page2++;
      $gallery_id=CustomHelpers::get_first_galleryid($package->id);
      $href_id1=CustomHelpers::custom_encrypt($package->id);
      $form_action=url("/Holidays/".str_slug($package->title)).'?package_id='.$href_id1;
      $package_list_data.="<tr><td> $url_page2 </td>
                           <td style='width: 10%;'>";
      if(CustomHelpers::get_image_gallery($gallery_id,'thum_small')!="0"):
        $src=CustomHelpers::get_image_gallery($gallery_id,'thum_small');
        $package_list_data.="<img src='$src' href='#' class=''>";
      elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_small')=="0"):
        $src=url('/').'/public/uploads/default_profile_image.png';
        $package_list_data.="<img src='$src' href='#' class=''>";
      endif;
      $package_list_data.="</td><td>";
      if(is_numeric($package->id)):
        $package_url=url('/packages-detail/'.Crypt::encrypt(['id'=>$package->id]));
        $package_list_data.="
        <a href='$form_action' target='_blank'>$package->title</a></td>";
       endif;
      $package_list_data.="<td>$package->duration Nights</td>
                           <td>";
      if($package->onrequest == 1 && $package->upcoming == 1):
      $package_list_data.="On Request ";
      elseif($package->onrequest != 1 && $package->upcoming == 1):
      if(CustomHelpers::get_price($package->id)=="On Request"):
      $package_list_data.="On Request ";
      else:
      $pr=CustomHelpers::get_price($package->id);
      $package_list_data.="&#x20B9 $pr";
      endif;
      elseif($package->onrequest == 1 && $package->upcoming != 1):
      if(CustomHelpers::get_up_price($package->id)=="On Request"):
      $package_list_data.="On Request ";
      else:
      $pri=CustomHelpers::get_up_price($package->id);
      $package_list_data.="&#x20B9 $pri";
      endif;
      endif;
      $package_list_data.="</td><td>";
      $country_name=substr(implode(',',unserialize($package->country)),0,15);
      $package_list_data.="$country_name";
      if(strlen(implode(',',unserialize($package->country)))>=15):
        $package_list_data.=" ... ";
      endif;
      $package_list_data.="</td>";
       if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')):
      $supply_name=CustomHelpers::get_supplier_data($package->id,"supplier_name");
      $package_list_data.="<td>$supply_name</td>";
      $upload_id=url('/').'/packageUploads/'.$package->id;
      $package_list_data.="<td><a href='$upload_id'>Uploads</a></td>";
      endif;
      endif;
      if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
      $package_list_data.="<td>";
      if($package->status == 1):
      $package_list_data.="<button type='button' class='btn-success btn_enable' value='$package->id'>Disable</button>";
      else:
      $package_list_data.="<button type='button' class='btn-danger btn_enable' value='$package->id'>Enable</button>";
      endif;
      $package_list_data.="</td>";
      $package_list_data.="<td>";
      if($package->front_show == 1):
      $package_list_data.="<button type='button' class='btn-success btn_front_enable' value='$package->id'>Disable</button>";
      else:
      $package_list_data.="<button type='button' class='btn-danger btn_front_enable' value='$package->id'>Enable</button>";
      endif;
      $package_list_data.="</td>";
      endif;
      endif;
      $package_list_data.="<td>";
      $form_url=url('/delete-package');
      $del_id="packagedel$package->id";
      $edit_pac_url=url('/editpackage/'.$package->id);
      $clone_pac_url=url('/clonepackage/'.$package->id);
      $package_list_data.="<form action='$form_url'  method='POST'
      id='$del_id'>";
                $package_list_data.= csrf_field();
      if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
      $package_list_data.="<input type='hidden' name='id' value='$package->id'/></form>";
      endif;
      endif;
      $package_list_data.="<span class='btn-group'>";
      if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
      $package_list_data.="<a class='btn btn-default btn-xcrud btn btn-warning' href='$edit_pac_url'>
       Edit
      </a>
      <a class='btn btn-default btn-xcrud btn btn-info' href='$clone_pac_url'>
       Clone
      </a>";
      endif;
      endif;
      if(Sentinel::check()):
      if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
      $package_list_data.="<button id='$del_id' class='btn btn-danger deletePackage' > Delete </button>";
      endif;
      endif;
      $package_list_data.="</span>
      </td>
      </tr>";
    endforeach;
    $package_list_data.="<tr><td colspan='11'><div class='package_list_paginate' style='text-align: center;'>$link </td></tr></div> ";
    return $package_list_data;
  }*/

  //
  public static function get_package_data($data)
  {
       $value="";
       $icon_data=Icons::all();
       foreach($data as $package):
        $ids=$package->id;
        $value.="<input type='hidden' class='pack_id_list' name='pack_id_list[]'  value='$ids'>";
        $country=unserialize($package->country);
        $city=unserialize($package->city);
        $continent=unserialize($package->continent);
        $state=unserialize($package->state);
       $href_id1=CustomHelpers::custom_encrypt($package->id);
       $form_action=url("/Holidays/".str_slug($package->title)).'?package_id='.$href_id1;
       $gallery_id=CustomHelpers::get_first_galleryid($package->id);
       $ur_l=url('/packages-detail/'.Crypt::encrypt(['id'=>$package->id]));
       $value.="<div class='destop_test_exp'>";
    $value.="<div class=''>
    <div class='col-sm-12 col-md-12 col-xs-12'>
    <article class='box box1 pkgList'>
    <div class='row'>
    <div class='col-sm-3 col-md-3 img-cont' >
    <a href='$form_action' class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' style='margin: 0'>";
    if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0"):
    $src=CustomHelpers::get_image_gallery($gallery_id,'thum_medium');
    $value.="<img style='height: 195px;' src='$src' class='img-responsive nicdark_focus nicdark_zoom_image small_img'>";
    elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0"):
    $src=url('/').'/public/uploads/default_profile_image.png';
    $value.="<img style='height: 195px;' src='$src' class='img-responsive nicdark_focus nicdark_zoom_image small_img'>";
    endif;
    $pkduration=$package->duration+"1";
    $value.="</a>
    </div>
    <div class='col-sm-6 col-md-6'>
    <div class='details'>
    <h4 class='box-title'>
      <a href='$form_action'>$package->title</a></h4>
    <p class='nightDays'>
    <span class='sp1'>
      ($package->duration Nights/$pkduration Days)</span>";
    if($package->onrequest == "1" && $package->upcoming == "1"):
    $value.="<span class='sp2'>On Request</span>";
    elseif($package->onrequest != "1" && $package->upcoming == "1"):
     if(CustomHelpers::get_price($package->id)=="On Request"):
     $value.="<span class='sp2'>On Request</span>";
     else:
     $price=CustomHelpers::get_price($package->id);
     $value.="<span class='sp2'>&#8377; $price</span>";
     endif;
    elseif($package->onrequest == "1" && $package->upcoming != "1"):
     if(CustomHelpers::get_up_price($package->id)=="On Request"):
      $value.="<span class='sp2'>On Request</span>";
      else:
      $price=CustomHelpers::get_up_price($package->id);
      $value.="<span class='sp2'>&#8377; $price</span>";
      endif;
    endif;
    $value.="</p>
    <hr>
    <div class='city_nights'>
    <p>";
    $city1=unserialize($package->city);
    $days=unserialize($package->days);
    $city1_count=count($city1);
    for($i=0;$i<$city1_count;$i++)
        {
          $day=$days[$i]+1;
          $value.="$city1[$i] ($days[$i]N) ";
           if($i<($city1_count-1)):
               $value.="<span>&rarr;&nbsp;</span>";
          endif;
          $a=$i+1;
           if($a%3=="0"):
               $value.="</p><p>";
          endif;
        }
    $value.="</p>
    </div>
    <hr>
    <div class='row' style='margin-bottom: 10px'>
    <div class='col-md-12 hotel_list'>";
      $package_service=unserialize($package->package_service);
    if(empty($package_service)):
          else:
    $count_package_service=count($package_service);
         $ico="";
         foreach ($icon_data as $icon_data1)
         {
           $ico.=$icon_data1->icon_title.",";
         }
    $ico1=array_unique(explode(",",$ico));
    for($i=0;$i<$count_package_service;$i++):
    if(in_array($package_service[$i], $ico1)):
    $icon_src=url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'));
         $icon_t=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
         $icon_n=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
    $value.="<figure>
    <img src='$icon_src'  title='$icon_t'>
    <figcaption >$icon_n</figcaption>
    </figure> ";
    endif;
    endfor;
    endif;
        $value.="</div>
        </div> ";
    $customer_rating=$package->customer_rating;
    $star1=url('/public/uploads/icons/star1.png');
        $starhalf=url('/public/uploads/icons/halfstar.png');
        $star2=url('/public/uploads/icons/star2.png');
    $value.="<div class='row' style='padding-top: 4px'>
    <div class='col-md-3 col-sm-3 col-xs-4'>
    <span>Guest Rating</span>
    </div>
    <div class='col-md-9 col-sm-9 col-xs-6 customer_rating center_dt'>";
    if($customer_rating=="3.5"):
    for($i=1;$i<=$customer_rating;$i++):
    $value.= "<img src='$star1' style='width: 4%' title='$customer_rating  Star'>";
              endfor;
            $value.="<img src='$starhalf' style='width: 4%' title='$customer_rating Star'>
              <img src='$star2' style='width: 4%' title='$customer_rating Star'>";
    elseif($customer_rating=="4.5"):
              for($i=1;$i<=$customer_rating;$i++):
             $value.= "<img src='$star1' style='width: 4%' title='$customer_rating  Star'>";
              endfor;
              $value.="<img src='$starhalf' style='width: 4%' title='$customer_rating Star'>
              ";
    else:
      for($i=1;$i<=$customer_rating;$i++):
             $value.= "<img src='$star1' style='width: 4%' title='$customer_rating  Star'>";
              endfor;
              for($j=5;$j>$customer_rating;$j--):
               $value.="<img src='$star2' style='width: 4%' title='$customer_rating Star'>";
              endfor;
            endif;
            $value.="</div>
        </div></div></div><div class='col-sm-3 col-md-3 price_details'><p class='on_request' style='color:gray !important;font-size: 15px !important'>Customized Holidays</p>";
    if($package->onrequest == "1" && $package->upcoming == "1"):
      $value.="<p class='price' >On Request</p>";
      elseif($package->onrequest != "1" && $package->upcoming == "1"):
      if(CustomHelpers::get_price($package->id)=="On Request"):
      $value.="<p class='price'>On Request</p>";
      else:
      $price=CustomHelpers::get_price($package->id);
      $value.="<p class='price'>&#8377; $price</p>";
      endif;
      elseif($package->onrequest == "1" && $package->upcoming != "1"):
      if(CustomHelpers::get_up_price($package->id)=="On Request"):
      $value.="<p class='price'>On Request</p>";
      else:
      $price=CustomHelpers::get_up_price($package->id);
      $value.="<p class='price'>&#8377; $price</p>";
      endif;
    endif;
    $value.="<p class='price_per'>Starting price per adult</p>
    <a href='$form_action' class='button btn-small full-width details-btn'>View Details</a>
    </div>
    </div>
    </article>
    </div>
    </div>";
         $value.="</div><div class='mobile_test_exp'><div class='col-sm-6 col-md-4'>
                   <article class='box'>
                   <a href='$form_action' class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' style='margin-bottom: 0px'>";
    if(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')!="0"):
      $src=CustomHelpers::get_image_gallery($gallery_id,'thum_medium');
    $value.="<img style='height: 250px;' src='$src'  class='img-responsive nicdark_focus nicdark_zoom_image small_img'>";
    elseif(CustomHelpers::get_image_gallery($gallery_id,'thum_medium')=="0"):
      $src=url('/').'/public/uploads/default_profile_image.png';
    $value.="<img style='height: 250px;' src='$src' class='img-responsive nicdark_focus nicdark_zoom_image small_img'>";
    endif;
     $value.="</a>
             <div class='details' style='border:1px solid lightgray;border-radius: 0px 0px 10px 10px;padding: 5px 10px 10px;'>";
    $pkduration=$package->duration+"1";
    $value.="<h4 class='box-title' style='font-size: 15px;font-weight: bold;'><b>$package->title</b></h4>
    <div class='row'>
    <div class='col-md-6 col-sm-6 col-xs-6'>
    <p class='duration' style='margin-bottom: 5px'>($package->duration Nights/$pkduration Days)</p>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-6'>";
    if($package->onrequest == "1" && $package->upcoming == "1"):
    $value.="<span class='pull-right' style='font-size: 16px;color: #FDB714;;font-size: 1.3337em'>On Request</span>";
    elseif($package->onrequest != "1" && $package->upcoming == "1"):
    if(CustomHelpers::get_price($package->id)=="On Request"):
    $value.="<span class='pull-right' style='font-size: 16px;color: #FDB714;;font-size: 1.3337em'>On Request</span>";
    else:
      $price=CustomHelpers::get_price($package->id);
    $value.="<span class='pull-right' style='color: #FDB714;font-size: 1.3337em'>&#x20B9 $price </span>";
    endif;
    elseif($package->onrequest == "1" && $package->upcoming != "1"):
    if(CustomHelpers::get_up_price($package->id)=="On Request"):
    $value.="<span class='pull-right' style='font-size: 16px;color: #FDB714;;font-size: 1.3337em'>On Request</span>";
    else:
      $price=CustomHelpers::get_up_price($package->id);
    $value.="<span class='pull-right' style='color: #FDB714;font-size: 1.3337em'>&#x20B9 $price </span>";
    endif;
    endif;
    $value.="</div></div>
    <hr style='margin:5px 0px'>
    <div class='city_nights'>
            <p>";
     $city1=unserialize($package->city);
    $days=unserialize($package->days);
    $city1_count=count($city1);
    for($i=0;$i<$city1_count;$i++)
        {
          $day=$days[$i]+1;
          $value.="$city1[$i] ($days[$i]N) ";
           if($i<($city1_count-1)):
               $value.="<span>&rarr;&nbsp;</span>";
          endif;
          $a=$i+1;
           if($a%3=="0"):
          endif;
        }
    $value.="</p>
        </div>
        <hr style='margin:5px 0px 10px 0px'>";
        $package_service=unserialize($package->package_service);
        if(empty($package_service)):
        else:
         $count_package_service=count($package_service);
         $ico="";
         foreach ($icon_data as $icon_data1)
         {
           $ico.=$icon_data1->icon_title.",";
         }
         $ico1=array_unique(explode(",",$ico));
         $value.="<div class='row' style='margin-bottom: 5px'>
          <div class='col-md-12 '>";
           for($i=0;$i<$count_package_service;$i++):
    if(in_array($package_service[$i], $ico1)):
      if($i=="4"):
         $icon_src=url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'));
         $icon_t=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
         $icon_n=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
        $value.="<figure style='margin-right: 0px;'>
           <img src='$icon_src' style='height: 38px' title='$icon_t'>
           <figcaption style='font-size:12px'>$icon_n</figcaption>
          </figure> ";
         else:
         $icon_src=url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'));
         $icon_t=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
         $icon_n=CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title');
          $value.="<figure style=' margin-right: 5%;'>
           <img src='$icon_src' style='height: 38px' title='$icon_t'>
           <figcaption style='font-size:12px'>$icon_n</figcaption>
          </figure> ";
         endif;
    else:
    endif;
        endfor;
        $value.="</div>
        </div> ";
        $customer_rating=$package->customer_rating;
        $star1=url('/public/uploads/icons/star1.png');
        $starhalf=url('/public/uploads/icons/halfstar.png');
        $star2=url('/public/uploads/icons/star2.png');
        $value.="<div class='row' style=''>
          <div class='col-md-5 col-sm-4 col-xs-4'>
           <span>Guest Rating</span>
          </div>
          <div class='col-md-7 col-sm-7 col-xs-7 customer_rating'>";
             if($customer_rating=="3.5"):
              for($i=1;$i<=$customer_rating;$i++):
           $value.= "<img src='$star1' style='width: 9%' title='$customer_rating  Star'>";
              endfor;
            $value.="<img src='$starhalf' style='width: 9%' title='$customer_rating Star'>
              <img src='$star2' style='width: 9%' title='$customer_rating Star'>";
            elseif($customer_rating=="4.5"):
              for($i=1;$i<=$customer_rating;$i++):
             $value.= "<img src='$star1' style='width: 9%' title='$customer_rating  Star'>";
              endfor;
              $value.="<img src='$starhalf' style='width: 9%' title='$customer_rating Star'>
              ";
              else:
              for($i=1;$i<=$customer_rating;$i++):
             $value.= "<img src='$star1' style='width: 9%' title='$customer_rating  Star'>";
              endfor;
              for($j=5;$j>$customer_rating;$j--):
               $value.="<img src='$star2' style='width: 9%' title='$customer_rating Star'>";
              endfor;
            endif;
          $value.="</div>
        </div>";
        //
        $package_city=unserialize($package->city);
        $package_city_count=count($package_city);
        $value.="<div class='row' style='margin-top: 10px'>";
        endif;
        $value.="<div class='col-md-12'>
        <a href='$form_action' class='button btn-small full-width' style='border-radius: 0'>View Details</a>
        </div></div>
        </div>
        </article>
        </div></div>";
      endforeach;
      return $value;
  }

  /************************************/

  // img_gallery data fetch
  /*public static function get_gall_data($data) {
    $value="";
    $link=$data->links();
    foreach($data as $datavalue):
    if($datavalue->thum_medium!=''):
      $img_src_path=url('/public/uploads/packages/thum_medium/'.$datavalue->thum_medium);
    else:
      $img_src_path=url('/public/'.$datavalue->image_path);
    endif;
      $country_data_name=substr($datavalue->country,0,10);
      $city_data_name=substr($datavalue->city,0,10);
      $name_data_name=substr($datavalue->name,0,5);
      $edit_url=url('/edit_image_ingallery/'.$datavalue->id);
      $delete_url=url('/delete_image_ingallery/'.$datavalue->id);
      $data_country=$datavalue->country;
      $data_state=$datavalue->state;
      $data_city=$datavalue->city;
      $data_name=$datavalue->name;
      $data_id=$datavalue->id;
      $img_path=$datavalue->image_path;
      $type=$datavalue->type;
      $value.=
      "<div class='col-md-3' style='margin-bottom: 20px'>";
        if($datavalue->type=='video'):
          $value.= '<div style="max-width:100%" class="video_icon">
          <input type="hidden" name="" class="video_src"  value="'.URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main.'">
          <i class="fa fa-play play_video" style="position: absolute;z-index: 1;color: white;left: 50%;top: 25%;border: 1px solid white;padding: 10px;border-radius: 20px;cursor: pointer;"></i></div>';
        endif;
          $value.= "
          <div class='dImgVdoCard'>
            <div class='dImgVdoCardImgBox'>
              <img src='$img_src_path'>
            </div>
            <div>
              <h3>$data_name</h3>
          <div class=''>
          <div class='col-md-6' style='padding:0'>
            <h4 class='dImgVdoCardCntry'>$data_country</h4>
          </div>
          <div class='col-md-6' style='padding:0'>
            <h5 class='dImgVdoCardCity'>$data_city</h5>
          </div>
          <div class='col-md-6' style='padding:0'>
            <p style='margin:0'>
              <input type='hidden' name='' class='cou_name' value='$data_country'>
              <input type='hidden' name='' class='pac_id' value='$data_id'>
              <input type='hidden' name='' class='sta_name'  value='$data_state'>
              <input type='hidden' name='' class='cit_name'  value='$data_city'>
              <input type='hidden' name='' class='name_name'  value='$data_name'>";
              if($datavalue->type=='video'):
                $value.= '<input type="hidden" name="" class="video_path"  value="'.URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main.'">
                <input type="hidden" name="" class="video_thumb"  value="'.URL::to('/').'/public/uploads/packages/thum_small/'.$datavalue->thum_small .'">';
              else:
                $value.= "<input type='hidden' name='' class='img_name'  value='$img_src_path'>
                <input type='hidden' name='' class='img_value' value='$img_path'>";
              endif;
              if($datavalue->thum_small!=""):
                $value.="<button type='button' class='dImgVdoCardEditBtn img_gall' data-toggle='modal' data-target='#img_gallery_edit'>EDIT</button>";
              else:
                $value.="<button type='button' class='dImgVdoCardEditBtn img_gall' data-toggle='modal' data-target='#img_gallery_edit'>EDIT</button>";
              endif;
                $value.="
            </p>
          </div>
          <div class='col-md-6' style='padding:0'>";
            if(Sentinel::check()):
              if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $value.="<p style='margin:0'>
              <button type='button' class='dImgVdoCardDltBtn delete_gall' data-id='$data_id'>DELETE</button>
              </p>";
              endif;
            endif;
            $value.="</div>
          </div>
          </div>
          </div>
      </div>";
      endforeach;
      $value.="<div class='col-md-12 img_gal_pag' style='text-align: center;'>$link </div>";
      return $value;
  }*/
  
  /*public static function get_gall_data($data) {
    // Initialize an empty string to store the output
    $value = "";
    // Get pagination links
    $link = $data->links();

    // Loop through each data value
    foreach($data as $datavalue):
        // Determine image source path based on availability of thum_medium
        if ($datavalue->thum_medium != ''):
            $img_src_path = url('/public/uploads/packages/thum_medium/' . $datavalue->thum_medium);
        else:
            $img_src_path = url('/public/' . $datavalue->image_path);
        endif;

        // Truncate country, city, and name data for display
        $country_data_name = substr($datavalue->country, 0, 10);
        $city_data_name = substr($datavalue->city, 0, 10);
        $name_data_name = substr($datavalue->name, 0, 5);

        // Set URLs for editing and deleting the gallery image
        $edit_url = url('/edit_image_ingallery/' . $datavalue->id);
        $delete_url = url('/delete_image_ingallery/' . $datavalue->id);

        // Extract various data fields from the datavalue object
        $data_country = $datavalue->country;
        $data_state = $datavalue->state;
        $data_city = $datavalue->city;
        $data_name = $datavalue->name;
        $data_id = $datavalue->id;
        $img_path = $datavalue->image_path;
        $type = $datavalue->type;

        // Start building the gallery HTML structure
        $value .= "<div class='col-md-3' style='margin-bottom: 20px'>";

        // Check if the type is video, and add a video play icon if true
        if ($datavalue->type == 'video'):
            $value .= '<div style="max-width:100%" class="video_icon">
                <input type="hidden" name="" class="video_src" value="'.URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main.'">
                <i class="fa fa-play play_video" style="position: absolute; z-index: 1; color: white; left: 50%; top: 25%; border: 1px solid white; padding: 10px; border-radius: 20px; cursor: pointer;"></i></div>';
        endif;

        // Add image and related details
        $value .= "
        <div class='dImgVdoCard'>
            <div class='dImgVdoCardImgBox'>
                <img src='$img_src_path'>
            </div>
            <div>
                <h3>$data_name</h3>
            <div class=''>
                <div class='col-md-6' style='padding:0'>
                    <h4 class='dImgVdoCardCntry'>$data_country</h4>
                </div>
                <div class='col-md-6' style='padding:0'>
                    <h5 class='dImgVdoCardCity'>$data_city</h5>
                </div>
                <div class='col-md-6' style='padding:0'>
                    <p style='margin:0'>
                        <input type='hidden' name='' class='cou_name' value='$data_country'>
                        <input type='hidden' name='' class='pac_id' value='$data_id'>
                        <input type='hidden' name='' class='sta_name' value='$data_state'>
                        <input type='hidden' name='' class='cit_name' value='$data_city'>
                        <input type='hidden' name='' class='name_name' value='$data_name'>";

        // If the item is a video, add hidden fields for video path and thumbnail
        if ($datavalue->type == 'video'):
            $value .= '<input type="hidden" name="" class="video_path" value="'.URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main.'">
            <input type="hidden" name="" class="video_thumb" value="'.URL::to('/').'/public/uploads/packages/thum_small/'.$datavalue->thum_small.'">';
        else:
            // Otherwise, add hidden fields for image path
            $value .= "<input type='hidden' name='' class='img_name' value='$img_src_path'>
            <input type='hidden' name='' class='img_value' value='$img_path'>";
        endif;

        // Add edit button for image gallery
        if ($datavalue->thum_small != ""):
            $value .= "<button type='button' class='dImgVdoCardEditBtn img_gall' data-toggle='modal' data-target='#img_gallery_edit'>EDIT</button>";
        else:
            $value .= "<button type='button' class='dImgVdoCardEditBtn img_gall' data-toggle='modal' data-target='#img_gallery_edit'>EDIT</button>";
        endif;

        $value .= "
                    </p>
                </div>
                <div class='col-md-6' style='padding:0'>";

        // Check if the current user has permission to delete the image
        if (Sentinel::check()):
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $value .= "<p style='margin:0'>
                    <button type='button' class='dImgVdoCardDltBtn delete_gall' data-id='$data_id'>DELETE</button>
                </p>";
            endif;
        endif;

        $value .= "</div>
                </div>
            </div>
        </div>
        </div>";
    endforeach;

    // Add pagination at the bottom of the gallery
    $value .= "<div class='col-md-12 img_gal_pag' style='text-align: center;'>$link</div>";

    // Return the constructed gallery HTML
    return $value;
  }*/

  public static function get_gall_data($data) {
    // Initialize an empty string to store the output
    $value = "";

    // Get pagination links
    $link = $data->links();

    // Loop through each data value
    foreach($data as $datavalue):
        // Define default image path
        $defaultImage = asset('public/uploads/default-img.webp');

        // Construct image paths
        $thumbImagePath = public_path('uploads/packages/thum_medium/' . $datavalue->thum_medium);
        $mainImagePath = public_path($datavalue->image_path);

        // Check which image exists and set the image source accordingly
        if (!empty($datavalue->thum_medium) && file_exists($thumbImagePath)) {
            $img_src_path = asset('public/uploads/packages/thum_medium/' . $datavalue->thum_medium);
        } elseif (!empty($datavalue->image_path) && file_exists($mainImagePath)) {
            $img_src_path = asset('public/' . $datavalue->image_path);
        } else {
            $img_src_path = $defaultImage;
        }

        $edit_url = url('/edit_image_ingallery/' . $datavalue->id);
        $delete_url = url('/delete_image_ingallery/' . $datavalue->id);
        
        // Begin div structure
        $value .= "
        <div class='col-md-3'>
            <div class='form-group'>
                <div class='dImgVdoCard'>";
                
        // Check if it's a video and add appropriate markup
        if ($datavalue->type == 'video'):
            $value .= "
            <div class='dImgVdoCardImgBox video_icon'>
                <input type='hidden' class='video_src' value='" . URL::to('/') . "/public/uploads/packages/video/" . $datavalue->image_main . "'>
                <i class='vdoInfo fa fa-play play_video'></i>
            </div>";
        endif;

        // Add image source
        $value .= "
          <div class='dImgVdoCardImgBox'>
            <img src='$img_src_path' title='image' loading='lazy'>
          </div>";

        // Add data name
        $value .= "
            <div class='itemName'>{$datavalue->name}</div>";
$cou=CustomHelpers::get_master_table_data('countries', 'id', (int)$datavalue->country, 'name');
$sta=CustomHelpers::get_master_table_data('city', 'id', (int)$datavalue->city, 'name');
        // Add country and city with flex structure
        $value .= "
            <div class='makeflex flex-wrap'>
                <div class='dImgVdoCardCntry flexOne'>{$cou}</div>
                <div class='dImgVdoCardCity flexOne'>{$sta}</div>
            </div>";

        // Add hidden input fields for various data attributes
        $value .= "
            <div class='makeflex flex-wrap'>
                <div class='flexOne'>
                    <input type='hidden' class='cou_name' value='{$datavalue->country}'>
                    <input type='hidden' class='sta_name' value='{$datavalue->state}'>
                    <input type='hidden' class='cit_name' value='{$datavalue->city}'>
                    <input type='hidden' class='name_name' value='{$datavalue->name}'>
                    <input type='hidden' class='pac_id' value='{$datavalue->id}'>";

        // If type is video, add video-related hidden fields
        if ($datavalue->type == 'video'):
            $value .= "
                    <input type='hidden' class='video_path' value='" . URL::to('/') . "/public/uploads/packages/video/" . $datavalue->image_main . "'>
                    <input type='hidden' class='video_thumb' value='" . URL::to('/') . "/public/uploads/packages/thum_small/" . $datavalue->thum_small . "'>";
        else:
            // Add image-related hidden fields
            $value .= "
                    <input type='hidden' class='img_name' value='$img_src_path'>
                    <input type='hidden' class='img_value' value='{$datavalue->image_path}'>";
        endif;

        $value .= "
                    <input type='hidden' class='type' value='{$datavalue->type}'>
                    <div class='dImgVdoCardEditBtn img_gall' data-toggle='modal' data-target='#img_gallery_edit'>EDIT</div>
                </div>";

        // Check if the user is an administrator or super_admin for delete button
        if (Sentinel::check()):
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $value .= "
                <div class='flexOne'>
                    <div class='dImgVdoCardDltBtn delete_gall' data-id='{$datavalue->id}'>DELETE</div>
                </div>";
            endif;
        endif;

        // Close divs
        $value .= "
            </div> <!-- End makeflex div -->
        </div> <!-- End dImgVdoCard div -->
        </div> <!-- End form-group div -->
        </div> <!-- End col-md-3 div -->";
    endforeach;

    // Add pagination links
    $value .= "<div class='col-md-12 img_gal_pag' style='text-align: center;'>$link</div>";
    return $value;
  }

  /************************************/

  public static function get_galler_city($id)
  {
        $query=DB::table('package_image_gallery')
              ->select('city')
              ->where('id',$id)
              ->first();
       if($query)
       {
        return $query->city;
       }
       else
       {
        return '0';
       }
    }

  public static function get_packageuploads_id($id)
  {
        $query=DB::table('rt_package_uploads')
              ->select('id')
              ->where('gallery_id',$id)
              ->first();
       if($query)
       {
        return $query->id;
       }
       else
       {
        return '0';
       }
  }

  /************************************/

  /*public static function get_imgpath_gallery($id,$field)
  {
        $query=DB::table('package_image_gallery')
              ->select($field)
              ->where('id',$id)
              ->first();
       if($query)
       {
        return $query->$field;
       }
       else
       {
        return '0';
       }
  }*/

  public static function get_imgpath_gallery($id, $field)
  {
    $query = DB::table('package_image_gallery')
              ->select($field)
              ->where('id', $id)
              ->first();

    // Return the field value if found, otherwise return '0'
    return $query->$field ?? '0';
  }

  /************************************/

  // tour item card images (home page and product list page)
  /*public static function get_image_gallery($id,$field)
  {
    $query=PackageImageGallery::find($id);

    if(!empty($query)) {
      if($query->$field!=""):
        if($field=='image_path'):
          return env('IMAGESRC').'/public'.$query->image_path;
        elseif($field=='image_main'):
          return CustomHelpers::get_base64_image(env('IMAGESRC').'/public/uploads/packages/'.$query->$field);
        else:
          return CustomHelpers::get_base64_image(env('IMAGESRC').'/public/uploads/packages/'.$field.'/'.$query->$field);
        endif;
      else:
        return env('IMAGESRC').'/public'.$query->image_path;
      endif;
    } else {
      return '0';
    }
  }*/

  // tour item card images (home page and product list page)
  public static function get_image_gallery($id, $field)
  {
      // Retrieve the record
      $query = PackageImageGallery::find($id);

      // Default image path if no image is found
      $defaultImage = url('public/uploads/default-img.webp');

      // Check if record exists
      if (empty($query)) {
          return $defaultImage;
      }

      // Validate the field and initialize base path
      $basePath = env('IMAGESRC') . '/public';
      $validFields = ['image_path', 'image_main']; // Add allowed fields here

      if (!in_array($field, $validFields) && !is_dir(public_path("uploads/packages/$field"))) {
          return 'Invalid field';
      }

      // Handle image field logic
      if (!empty($query->$field)) {
          if ($field == 'image_path') {
              return $basePath . $query->image_path;
          } elseif ($field == 'image_main') {
              return CustomHelpers::get_base64_image($basePath . '/uploads/packages/' . $query->$field);
          } else {
              // General case for other valid fields
              return CustomHelpers::get_base64_image($basePath . '/uploads/packages/' . $field . '/' . $query->$field);
          }
      }

      // Default return if $field is empty
      return $basePath . $query->image_path;
  }


  /************************************/

  public static function get_data_condition($id)
  {
        $query=DB::table('rt_package_uploads')
              ->select('id')
              ->where('gallery_id',$id)
              ->first();
       if($query)
       {
        return '1';
       }
       else
       {
        return '0';
       }
  }

  public static function get_hotel_data_condition1($id1,$id2)
  {
        $query=DB::table('rt_hotel_uploads')
              ->select('id')
              ->where([['gallery_id','=',$id1],['hotel_id','=',$id2]])
              ->first();
       if($query)
       {
        return '1';
       }
       else
       {
        return '0';
       }
  }

  public static function get_package_hotel_data_condition1($id1,$id2)
  {
        $query=DB::table('rt_package_hotels_uploads')
              ->select('id')
              ->where([['gallery_id','=',$id1],['package_hotel_id','=',$id2]])
              ->first();
       if($query)
       {
        return '1';
       }
       else
       {
        return '0';
       }
  }

  public static function get_data_condition1($id1,$id2)
  {
        $query=DB::table('rt_package_uploads')
              ->select('id')
              ->where([['gallery_id','=',$id1],['package_id','=',$id2]])
              ->first();
       if($query)
       {
        return '1';
       }
       else
       {
        return '0';
       }
  }

  public static function get_data_conditions($id)
  {
        $query=DB::table('rt_package_uploads')
              ->select('gallery_id')
              ->where('gallery_id',$id)
              ->first();
       if($query)
       {
        return $query->gallery_id;
       }
       else
       {
        return '0';
       }
  }

  public static function get_data_conditions_hotel($id)
  {
        $query=DB::table('rt_hotel_uploads')
              ->select('gallery_id')
              ->where('gallery_id',$id)
              ->first();
       if($query)
       {
        return $query->gallery_id;
       }
       else
       {
        return '0';
       }
  }

  public static function get_data_conditions_packagehotel($id)
  {
        $query=DB::table('rt_package_hotels_uploads')
              ->select('gallery_id')
              ->where('gallery_id',$id)
              ->first();
       if($query)
       {
        return $query->gallery_id;
       }
       else
       {
        return '0';
       }
  }

  public static function get_country_code($id)
  {
    $query=DB::table('countries')
              ->select('id')
              ->where('name',$id)
              ->first();
       if($query)
       {
        return $query->id;
       }
       else
       {
        return '0';
       }
  }

  public static function get_state_code($id)
  {
    $query=DB::table('states')
              ->select('id')
              ->where('name',$id)
              ->first();
       if($query)
       {
        return $query->id;
       }
       else
       {
        return '0';
       }
  }

  //
  public static function get_theme_footerstatus($id)
  {
        $query=DB::table('rt_pkg_types')
              ->select('showsfooter')
              ->where('name',$id)
              ->first();
       if($query)
       {
        return $query->showsfooter;
       }
       else
       {
        return '0';
       }
  }

  // Get record Name By Table Name And Record ID
  public static function getContById($id,$table,$field) {
        $query = DB::table($table)
        ->select($field)
        ->where('continent', $id)
        ->first();
        return $query->$field;
  }

  // Get record Name By Table Name And Record ID
  public static function getimagename($id,$table,$field) {
        $query = DB::table($table)
        ->select($field)
        ->where('icon_title', $id)
        ->first();
        if($query)
        {
           return $query->$field;
        }
        else
        {
            return "NA";
        }
  }

  //Get Module media image
  public static function get_first_image($id,$table,$selectField,$whareField){
        $image = DB::table($table)
        ->select($selectField)
        ->where($whareField,$id)
        ->first();
        if($image){
            return $image->$selectField;
        }else{
            return '/uploads/default_profile_image.png';
        }
  }

  //destination data
  public static function get_destination_data($condition,$field){
        $data = DB::table('rt_locations')
        ->select($field)
        ->where('location',$condition)
        ->first();
        if($data){
            return $data->$field;
        }else{
            return 'NA';
        }
  }

  //
  public static function get_quotation_total($id,$id1)
  {
     $price=unserialize($id);
     if(array_key_exists("query_air_curr", $price)):
       $air_currency=CustomHelpers::get_rate($price["query_air_curr"]);
     else:
      $air_currency='NA';
      endif;
      if(array_key_exists("query_hotel_curr", $price)):
        $hotel_currency=CustomHelpers::get_rate($price["query_hotel_curr"]);
        else:
      $hotel_currency='NA';
      endif;
      if(array_key_exists("query_tours_curr", $price)):
        $tour_currency=CustomHelpers::get_rate($price["query_tours_curr"]);
        else:
      $tour_currency='NA';
      endif;
       if(array_key_exists("query_transfer_curr", $price)):
        $transfer_currency=CustomHelpers::get_rate($price["query_transfer_curr"]);
        else:
      $transfer_currency='NA';
      endif;
      if(array_key_exists("query_visa_curr", $price)):
        $visa_currency=CustomHelpers::get_rate($price["query_visa_curr"]);
        else:
      $visa_currency='NA';
      endif;
       if(array_key_exists("query_inc_curr", $price)):
        $inc_currency=CustomHelpers::get_rate($price["query_inc_curr"]);
        else:
      $inc_currency='NA';
      endif;
      if(array_key_exists("query_gst_curr", $price)):
        $gst_currency=CustomHelpers::get_rate($price["query_gst_curr"]);
        else:
      $gst_currency='NA';
      endif;

      
      $air_fare=$price["query_air_".$id1];
      
      $hotel_fare=$price["query_hotel_".$id1];
     
      $tour_fare=$price["query_tours_".$id1];
      
      $transfer_fare=$price["query_transfer_".$id1];
      
      $visa_fare=$price["query_visa_".$id1];
      
      $insurance_fare=$price["query_inc_".$id1];
      
      $gst_fare=$price["query_gst_".$id1];
     $cruise_currency="";
     $cruise_fare="";
     $meals_currency="";
     $meals_fare="";
     $markup_currency="";
     $markup_fare="";
      if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_curr", $price)):
       $cruise_currency=CustomHelpers::get_rate($price["query_cruise_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_".$id1, $price)):
       $cruise_fare=$price["query_cruise_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_curr", $price)):
        $meals_currency=CustomHelpers::get_rate($price["query_meals_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_".$id1, $price)):
         $meals_fare=$price["query_meals_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_curr", $price)):
        $markup_currency=CustomHelpers::get_rate($price["query_markup_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_".$id1, $price)):
        $markup_fare=$price["query_markup_".$id1];
      endif;
      endif;
      $total="0";
      if($air_fare!="" && $air_fare!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare;
      }
      if($hotel_fare!="" && $hotel_fare!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare;
      }
      if($tour_fare!="" && $tour_fare!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare;
      }
      if($transfer_fare!="" && $transfer_fare!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_fare*$transfer_currency;
      }
      if($visa_fare!="" && $visa_fare!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare;
      }
      if($insurance_fare!="" && $insurance_fare!="0" && $inc_currency!="NA")
      {
           $total+=$insurance_fare*$inc_currency;
      }
       if($gst_fare!="" && $gst_fare!="0" && $gst_currency!="NA")
      {
           $total+=$gst_fare*$gst_currency;
      }
      if($cruise_fare!="" && $cruise_fare!="0" && $cruise_currency!="NA")
      {
           $total+=$cruise_fare*$cruise_currency;
      }
      if($meals_fare!="" && $meals_fare!="0" && $meals_currency!="NA")
      {
           $total+=$meals_fare*$meals_currency;
      }
      if($markup_fare!="" && $markup_fare!="0" && $markup_currency!="NA")
      {
           $total+=$markup_fare*$markup_currency;
      }
      return $total;
  }

  //
  public static function get_quotation_pricel($id,$id1)
  {
     $price=unserialize($id);
     
     if(array_key_exists("query_air_curr", $price)):
       $air_currency=CustomHelpers::get_rate($price["query_air_curr"]);
     else:
      $air_currency='NA';
      endif;
      if(array_key_exists("query_hotel_curr", $price)):
        $hotel_currency=CustomHelpers::get_rate($price["query_hotel_curr"]);
        else:
      $hotel_currency='NA';
      endif;
      if(array_key_exists("query_tours_curr", $price)):
        $tour_currency=CustomHelpers::get_rate($price["query_tours_curr"]);
        else:
      $tour_currency='NA';
      endif;
       if(array_key_exists("query_transfer_curr", $price)):
        $transfer_currency=CustomHelpers::get_rate($price["query_transfer_curr"]);
        else:
      $transfer_currency='NA';
      endif;
      if(array_key_exists("query_visa_curr", $price)):
        $visa_currency=CustomHelpers::get_rate($price["query_visa_curr"]);
        else:
      $visa_currency='NA';
      endif;
       if(array_key_exists("query_inc_curr", $price)):
        $inc_currency=CustomHelpers::get_rate($price["query_inc_curr"]);
        else:
      $inc_currency='NA';
      endif;
      if(array_key_exists("query_gst_curr", $price)):
        $gst_currency=CustomHelpers::get_rate($price["query_gst_curr"]);
        else:
      $gst_currency='NA';
      endif;

      $air_fare=$price["query_air_".$id1];
      
      $hotel_fare=$price["query_hotel_".$id1];
      
      $tour_fare=$price["query_tours_".$id1];
      
      $transfer_fare=$price["query_transfer_".$id1];
     
      $visa_fare=$price["query_visa_".$id1];
      
      $insurance_fare=$price["query_inc_".$id1];
      
      $gst_fare=$price["query_gst_".$id1];
       $cruise_currency="";
     $cruise_fare="";
     $meals_currency="";
     $meals_fare="";
     $markup_currency="";
     $markup_fare="";
      if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_curr", $price)):
       $cruise_currency=CustomHelpers::get_rate($price["query_cruise_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_".$id1, $price)):
       $cruise_fare=$price["query_cruise_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_curr", $price)):
        $meals_currency=CustomHelpers::get_rate($price["query_meals_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_".$id1, $price)):
         $meals_fare=$price["query_meals_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_curr", $price)):
        $markup_currency=CustomHelpers::get_rate($price["query_markup_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_".$id1, $price)):
        $markup_fare=$price["query_markup_".$id1];
      endif;
      endif;
      $total="0";
      if($air_fare!="" && $air_fare!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare;
      }
      if($hotel_fare!="" && $hotel_fare!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare;
      }
      if($tour_fare!="" && $tour_fare!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare;
      }
      if($transfer_fare!="" && $transfer_fare!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_fare*$transfer_currency;
      }
      if($visa_fare!="" && $visa_fare!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare;
      }
      if($insurance_fare!="" && $insurance_fare!="0" && $inc_currency!="NA")
      {
           $total+=$insurance_fare*$inc_currency;
      }
       if($gst_fare!="" && $gst_fare!="0" && $gst_currency!="NA")
      {
           $total+=$gst_fare*$gst_currency;
      }
       if($cruise_fare!="" && $cruise_fare!="0" && $cruise_currency!="NA")
      {
           $total+=$cruise_fare*$cruise_currency;
      }
      if($meals_fare!="" && $meals_fare!="0" && $meals_currency!="NA")
      {
           $total+=$meals_fare*$meals_currency;
      }
      if($markup_fare!="" && $markup_fare!="0" && $markup_currency!="NA")
      {
           $total+=$markup_fare*$markup_currency;
      }
      return $total;
  }

  //
  public static function get_quotation_group($id,$id1)
  {
     $price=unserialize($id);
     if(array_key_exists("query_air_curr", $price)):
       $air_currency=CustomHelpers::get_rate($price["query_air_curr"]);
     else:
      $air_currency='NA';
      endif;
      if(array_key_exists("query_hotel_curr", $price)):
        $hotel_currency=CustomHelpers::get_rate($price["query_hotel_curr"]);
        else:
      $hotel_currency='NA';
      endif;
      if(array_key_exists("query_tours_curr", $price)):
        $tour_currency=CustomHelpers::get_rate($price["query_tours_curr"]);
        else:
      $tour_currency='NA';
      endif;
       if(array_key_exists("query_transfer_curr", $price)):
        $transfer_currency=CustomHelpers::get_rate($price["query_transfer_curr"]);
        else:
      $transfer_currency='NA';
      endif;
      if(array_key_exists("query_visa_curr", $price)):
        $visa_currency=CustomHelpers::get_rate($price["query_visa_curr"]);
        else:
      $visa_currency='NA';
      endif;
       if(array_key_exists("query_inc_curr", $price)):
        $inc_currency=CustomHelpers::get_rate($price["query_inc_curr"]);
        else:
      $inc_currency='NA';
      endif;
      if(array_key_exists("query_gst_curr", $price)):
        $gst_currency=CustomHelpers::get_rate($price["query_gst_curr"]);
        else:
      $gst_currency='NA';
      endif;

      
      $air_fare=$price["query_air_".$id1];
      
      $hotel_fare=$price["query_hotel_".$id1];
      
      $tour_fare=$price["query_tours_".$id1];
      
      $transfer_fare=$price["query_transfer_".$id1];
      
      $visa_fare=$price["query_visa_".$id1];
      
      $insurance_fare=$price["query_inc_".$id1];
      
      $gst_fare=$price["query_gst_".$id1];
      $total="0";
      if($air_fare!="" && $air_fare!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare;
      }
      if($hotel_fare!="" && $hotel_fare!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare;
      }
      if($tour_fare!="" && $tour_fare!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare;
      }
      if($transfer_fare!="" && $transfer_fare!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_fare*$transfer_currency;
      }
      if($visa_fare!="" && $visa_fare!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare;
      }
      if($insurance_fare!="" && $insurance_fare!="0" && $inc_currency!="NA")
      {
           $total+=$insurance_fare*$inc_currency;
      }
       if($gst_fare!="" && $gst_fare!="0" && $gst_currency!="NA")
      {
           $total+=$gst_fare*$gst_currency;
      }
      echo $total;
  }

  //
  public static function get_quotation_discount($id,$id1)
  {
      $price=unserialize($id);
      $discount=$price["query_discount_".$id1];
       if($discount=="" || $discount=="0")
       {
        $discount="0";
       }
      return $discount;
  }
  
  public static function get_quotation_price($data1)
  {

      if($data1->option1_price_type=="Per Person"):
       $option1_total=CustomHelpers::get_quotation_grandtotal($data1->option1_price,'adult');
      $option1_total_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'adult');
      $output=$option1_total-$option1_total_discount;
     elseif($data1->option1_price_type=="Group Price"):
      $option1_adult=CustomHelpers::get_quotation_pricel($data1->option1_price,'adult');
          $option1_extradult=CustomHelpers::get_quotation_pricel($data1->option1_price,'exadult');
          $option1_child=CustomHelpers::get_quotation_pricel($data1->option1_price,'childbed');
          $option1_childwithoutbed=CustomHelpers::get_quotation_pricel($data1->option1_price,'childwbed');
          $option1_infant=CustomHelpers::get_quotation_pricel($data1->option1_price,'infant');
          $option1_single=CustomHelpers::get_quotation_pricel($data1->option1_price,'single');
          $option1_total=($option1_adult*2) + $option1_extradult + $option1_child + $option1_childwithoutbed + $option1_infant + $option1_single;
        $option1_adult_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'adult');
          $option1_extradult_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'exadult');
          $option1_child_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'childbed');
          $option1_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'childwbed');
          $option1_infant_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'infant');
          $option1_single_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'single');
          $option1_total_discount=($option1_adult_discount*2) + $option1_extradult_discount + $option1_child_discount + $option1_childwithoutbed_discount + $option1_infant_discount + $option1_single_discount;
          $output=$option1_total-$option1_total_discount;
        endif;
        return $output;
  }
  
  public static function get_remaining_due($quote_ref_no,$total_quote_amount)
  {
      $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('amount');
  
      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');

      $gst_on_mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('gst_on_mdr_amount');
    $due_amount=(int)$total_quote_amount-((int)$previous_amount-((int)$mdr_amount+(int)$gst_on_mdr_amount));
    return $due_amount;
  }

  public static function get_pg_charge($quote_ref_no)
  {
      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');

      $gst_on_mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('gst_on_mdr_amount');
       $charge=(int)$mdr_amount+(int)$gst_on_mdr_amount;
       return $charge;
  }

  public static function get_refunded_amount($quote_ref_no)
  {
      $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',1]])
       ->sum('amount');
       $due_amount=(int)$previous_amount;
       return $due_amount;
  }

  public static function get_received_amount($unique_code)
  {
      $quote_no=Session::get($unique_code.'quoteno');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;

        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
        
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
    
     $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('amount');

      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');
      $gst_on_mdr_amount = DB::table('rt_payments')
         ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
         ->sum('gst_on_mdr_amount'); 
    
       $output=(int)$previous_amount-((int)$mdr_amount+(int)$gst_on_mdr_amount);
    
      return $output;
  }

  public static function get_remaining_amount($total_quote_amount,$unique_code)
  {
      $quote_no=Session::get($unique_code.'quoteno');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if((int)$quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;

        }
        elseif((int)$quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
        elseif((int)$quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
        
        }
        elseif((int)$quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }

     $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('amount');
      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');

      $gst_on_mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('gst_on_mdr_amount');
      
      $due_amount=(int)$total_quote_amount-((int)$previous_amount-(int)$mdr_amount+(int)$gst_on_mdr_amount);
      return $due_amount;
  }
    
  public static function get_check_payment_status($quote_ref_no)
  {
      $payment_data=DB::table('rt_payments')->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])->first();
        
        if($payment_data=='')
        {
            return 0;
        }
        else
        {
            return 1; 
        }
  }

  public static function get_paid_amount($unique_code)
  {
      $quote_no=Session::get($unique_code.'quoteno');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;

        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
        
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
    
     $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('amount');

      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');

      $gst_on_mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('gst_on_mdr_amount');

      $paid_amount=(int)$previous_amount-((int)$mdr_amount+(int)$gst_on_mdr_amount);
      return $paid_amount;
  }

  public static function get_charge_amount($unique_code)
  {
      $quote_no=Session::get($unique_code.'quoteno');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;

        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
        
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
       
        }
    
     

      $mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('mdr_amount');

      $gst_on_mdr_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->sum('gst_on_mdr_amount');

      $paid_amount=(int)$mdr_amount+(int)$gst_on_mdr_amount;
      return $paid_amount;
  }

  public static function get_installment_number($total_quote_amount,$unique_code)
  {
      $quote_no=Session::get($unique_code.'quoteno');
      $quote1_id=Session::get($unique_code.'quote1_id');
      $quote2_id=Session::get($unique_code.'quote2_id');
      $quote3_id=Session::get($unique_code.'quote3_id');
      $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;
        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;       
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no; 
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;       
        }
    
       
         $previous_amount = DB::table('rt_payments')
       ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1],['transaction_type','=',0]])
       ->latest()->first();
    
      // $due_amount=(int)$total_quote_amount-(int)$previous_amount;
       if($previous_amount=='')
       {
      $last_installment=0;
       }
       else
       {
      $last_installment=$previous_amount->part_payment;  
       }
       return $last_installment;
  }

  public static function get_remaining_amount_second($quote_no, $unique_code)
  {
      // Only use quote1_id from session as per your modified quotation_details_first
      $quote1_id = Session::get($unique_code . 'quote1_id');
  
      // Since we're only using the Quote model, ignore other quote IDs
      if ($quote_no != 1) {
          // Return early or throw an exception if quote_no is not 1, as only Quote model is used
          return 0; // Or throw new Exception("Invalid quote number: Only quote_no 1 is supported.");
      }
  
      // Fetch data from Quote model
      $data = Quote::find((int)$quote1_id);
  
      // Check if data exists
      if (!$data) {
          // Handle the case where no quote is found
          return 0; // Or throw new Exception("Quote not found for ID: $quote1_id");
      }
  
      // Assuming Quote model has these fields; adjust as per your Quote model schema
      $quote_ref_no = $data->quo_ref; // Ensure 'quo_ref' exists in your Quote model
      $price = $data->price; // Adjust to the actual price field in your Quote model
  
      // Calculate price breakdown (adjust parameters based on your Quote model fields)
      $price_data = CustomHelpers::get_price_part_seperate(
          $data->price,
          $data->number_of_adult ?? 0, // Adjust field names as per your Quote model
          $data->extra_adult ?? 0,
          $data->child_with_bed ?? 0,
          $data->child_without_bed ?? 0,
          $data->infant ?? 0,
          $data->solo_traveller ?? 0
      );
  
      // Use the calculated price for the adult portion
      $total_quote_amount = $price_data['query_pricetopay_adult'];
  
      // Calculate previous payments, MDR, and GST
      $previous_amount = DB::table('rt_payments')
          ->where([
              ['quote_ref_no', '=', $quote_ref_no],
              ['status', '=', 1],
              ['transaction_type', '=', 0]
          ])
          ->sum('amount');
  
      $mdr_amount = DB::table('rt_payments')
          ->where([
              ['quote_ref_no', '=', $quote_ref_no],
              ['status', '=', 1],
              ['transaction_type', '=', 0]
          ])
          ->sum('mdr_amount');
  
      $gst_on_mdr_amount = DB::table('rt_payments')
          ->where([
              ['quote_ref_no', '=', $quote_ref_no],
              ['status', '=', 1],
              ['transaction_type', '=', 0]
          ])
          ->sum('gst_on_mdr_amount');
  
      // Calculate due amount
      $due_amount = (int)$total_quote_amount - ((int)$previous_amount - ((int)$mdr_amount + (int)$gst_on_mdr_amount));
  
      return $due_amount;
  }
    
  //
  public static function get_run_time_passenger_details($quote_ref_no,$return)
  {
      $data=DB::table('rt_passengerinfo')->where('quotation_ref_no',$quote_ref_no)->first();

      if($data!='')
      {
        
        return $data->$return;
      }
  }
  
  //
  public static function get_quotation_grandtotal($id,$id1)
  {
      $price=unserialize($id);
      
      if(array_key_exists("query_air_curr", $price)):
       $air_currency=CustomHelpers::get_rate($price["query_air_curr"]);
      else:
      $air_currency='NA';
      endif;
      if(array_key_exists("query_hotel_curr", $price)):
        $hotel_currency=CustomHelpers::get_rate($price["query_hotel_curr"]);
        else:
      $hotel_currency='NA';
      endif;
      if(array_key_exists("query_tours_curr", $price)):
        $tour_currency=CustomHelpers::get_rate($price["query_tours_curr"]);
        else:
      $tour_currency='NA';
      endif;
       if(array_key_exists("query_transfer_curr", $price)):
        $transfer_currency=CustomHelpers::get_rate($price["query_transfer_curr"]);
        else:
      $transfer_currency='NA';
      endif;
      if(array_key_exists("query_visa_curr", $price)):
        $visa_currency=CustomHelpers::get_rate($price["query_visa_curr"]);
        else:
      $visa_currency='NA';
      endif;
       if(array_key_exists("query_inc_curr", $price)):
        $inc_currency=CustomHelpers::get_rate($price["query_inc_curr"]);
        else:
      $inc_currency='NA';
      endif;
      if(array_key_exists("query_gst_curr", $price)):
        $gst_currency=CustomHelpers::get_rate($price["query_gst_curr"]);
        else:
      $gst_currency='NA';
      endif;

      
      $air_fare=$price["query_air_".$id1];
      
      $hotel_fare=$price["query_hotel_".$id1];
     
      $tour_fare=$price["query_tours_".$id1];
      
      $transfer_fare=$price["query_transfer_".$id1];
      
      $visa_fare=$price["query_visa_".$id1];
      
      $insurance_fare=$price["query_inc_".$id1];
     
      $gst_fare=$price["query_gst_".$id1];
      $cruise_currency="";
      $cruise_fare="";
      $meals_currency="";
      $meals_fare="";
      $markup_currency="";
      $markup_fare="";
      if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_curr", $price)):
       $cruise_currency=CustomHelpers::get_rate($price["query_cruise_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_cruise_".$id1, $price)):
       $cruise_fare=$price["query_cruise_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_curr", $price)):
        $meals_currency=CustomHelpers::get_rate($price["query_meals_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_meals_".$id1, $price)):
         $meals_fare=$price["query_meals_".$id1];
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_curr", $price)):
        $markup_currency=CustomHelpers::get_rate($price["query_markup_curr"]);
      endif;
      endif;
       if(is_bool($price)):
      else:
      if(array_key_exists("query_markup_".$id1, $price)):
        $markup_fare=$price["query_markup_".$id1];
      endif;
      endif;
      $discount=$price["query_discount_".$id1];
      $total="0";
      if($air_fare!="" && $air_fare!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare;
      }
      if($hotel_fare!="" && $hotel_fare!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare;
      }
      if($tour_fare!="" && $tour_fare!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare;
      }
      if($transfer_fare!="" && $transfer_fare!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_fare*$transfer_currency;
      }
      if($visa_fare!="" && $visa_fare!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare;
      }
      if($insurance_fare!="" && $insurance_fare!="0" && $inc_currency!="NA")
      {
           $total+=$insurance_fare*$inc_currency;
      }
       if($gst_fare!="" && $gst_fare!="0" && $gst_currency!="NA")
      {
           $total+=$gst_fare*$gst_currency;
      }
       if($cruise_fare!="" && $cruise_currency!="" && $cruise_fare!="0" && $cruise_currency!="NA")
      {
           $total+=$cruise_fare*$cruise_currency;
      }
      if($meals_fare!="" && $meals_fare!="0" && $meals_currency!="NA")
      {
           $total+=$meals_fare*$meals_currency;
      }
      if($markup_fare!="" && $markup_fare!="0" && $markup_currency!="NA")
      {
           $total+=$markup_fare*$markup_currency;
      }
      if($discount!="" && $discount!="0")
      {
       $total=($total-$discount);
      }
      return $total;
  }

  // ***********************
  
  //
  /*public static function get_total_price($id)
  {
       $data=Packages::find($id);
       if($data->onrequest != 1 && $data->upcoming == 1):
       $price=unserialize($data->pricing);
       elseif($data->onrequest == 1 && $data->upcoming != 1):
       $price=unserialize($data->upcoming_pricing);
      elseif($data->onrequest == 1 && $data->upcoming == 1):
       $price=unserialize($data->pricing);
       endif;
       $price_count=count($price);
       $return_value=array();
         for($i=0;$i<$price_count;$i++)
           {
           //$price_adult=$price[$i]["adult_fare_total"];
      $air_currency=CustomHelpers::get_rate($price[$i]["aircurrency"]);
      $air_fare_adult=$price[$i]["airfare_adult"];
      $hotel_currency=CustomHelpers::get_rate($price[$i]["hotelcurrency"]);
      $hotel_fare_adult=$price[$i]["hotelfare_adult"];
      $tour_currency=CustomHelpers::get_rate($price[$i]["tourcurrency"]);
      $tour_fare_adult=$price[$i]["tourfare_adult"];
      $transfer_currency=CustomHelpers::get_rate($price[$i]["transfercurrency"]);
      $transfer_fare_adult=$price[$i]["transferfare_adult"];
      $visa_currency=CustomHelpers::get_rate($price[$i]["visacurrency"]);
      $visa_fare_adult=$price[$i]["visafare_adult"];
      $total="0";
      if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare_adult;
      }
      if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare_adult;
      }
      if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare_adult;
      }
      if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_currency*$transfer_fare_adult;
      }
      if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare_adult;
      }
      $return_value[]=['id'=>$id,'price'=>$total,'duration'=>$data->duration];
            }
      return $return_value;
  }*/

  public static function get_total_price($id)
  {
      $data = Packages::find($id);

      if (!$data) {
          \Log::error("Package ID: $id not found in database.");
          return [['id' => $id, 'price' => 0, 'duration' => 0]];
      }

      if ($data->onrequest != 1 && $data->upcoming == 1) {
          $price = unserialize($data->pricing);
      } elseif ($data->onrequest == 1 && $data->upcoming != 1) {
          $price = unserialize($data->upcoming_pricing);
      } elseif ($data->onrequest == 1 && $data->upcoming == 1) {
          $price = unserialize($data->pricing);
      } else {
          \Log::warning("Package ID: $id has no valid pricing.");
          return [['id' => $id, 'price' => 0, 'duration' => 0]];
      }

      // Debug each price entry
      if (!$price || !is_array($price)) {
          \Log::error("Package ID: $id pricing data is invalid.");
          return [['id' => $id, 'price' => 0, 'duration' => 0]];
      }

      $return_value = [];
      foreach ($price as $p) {
          $air_currency = CustomHelpers::get_rate($p["aircurrency"]);
          $air_fare_adult = $p["airfare_adult"];
          $hotel_currency = CustomHelpers::get_rate($p["hotelcurrency"]);
          $hotel_fare_adult = $p["hotelfare_adult"];
          $tour_currency = CustomHelpers::get_rate($p["tourcurrency"]);
          $tour_fare_adult = $p["tourfare_adult"];
          $transfer_currency = CustomHelpers::get_rate($p["transfercurrency"]);
          $transfer_fare_adult = $p["transferfare_adult"];
          $visa_currency = CustomHelpers::get_rate($p["visacurrency"]);
          $visa_fare_adult = $p["visafare_adult"];

          $total = 0;
          if (!empty($air_fare_adult) && $air_fare_adult != "0" && $air_currency != "NA") {
              $total += $air_currency * $air_fare_adult;
          }
          if (!empty($hotel_fare_adult) && $hotel_fare_adult != "0" && $hotel_currency != "NA") {
              $total += $hotel_currency * $hotel_fare_adult;
          }
          if (!empty($tour_fare_adult) && $tour_fare_adult != "0" && $tour_currency != "NA") {
              $total += $tour_currency * $tour_fare_adult;
          }
          if (!empty($transfer_fare_adult) && $transfer_fare_adult != "0" && $transfer_currency != "NA") {
              $total += $transfer_currency * $transfer_fare_adult;
          }
          if (!empty($visa_fare_adult) && $visa_fare_adult != "0" && $visa_currency != "NA") {
              $total += $visa_currency * $visa_fare_adult;
          }

          $return_value[] = ['id' => $id, 'price' => $total, 'duration' => $data->duration];
      }

      return $return_value;
  }

  // ***********************
  
  //Third_page_upper_price_change_start  
  public static function package_rating($id) {
      $data=Packages::find($id);
         if($data->onrequest==1)
         {
         $price=unserialize($data->upcoming_pricing);
         }
         else
         {
           $price=unserialize($data->pricing);
         }
         $type=[];
         $pri=[];
         foreach($price as $prices):
            $pri[]=$prices;
         endforeach;
       $price_count=count($price);
       for($i=0;$i<$price_count;$i++)
           {
            $date_from=strtotime($price[$i]["datefrom"]);
           $date_to=strtotime($price[$i]["dateto"]);
           $current_date=strtotime(Date('m/d/Y'));
           if(($date_from<=$current_date )&&( $date_to>=$current_date ))
           {
           $package_type=$price[$i]["package_rating"];
           if($package_type=='other'):
            $type[]=$price[$i]["package_rating_other"];
           else:
            $package_type= PkgRatingType::find($package_type);
            $type[]=$package_type->name;
           endif;
           }
           }
         return $type;
  }
    
  //Third_page_upper_price_change_end
  public static function get_price_by_date($id,$date)
  {
      $date=$date;
      $pkg_type="";
      $date=date("m/d/Y", strtotime($date));
      $package_id=$id;
      $check_pkg_type='';
      $amount=[];
      $associative=[];
      //
      $data=Packages::find($id);
         if($data->onrequest==1)
         {
         $price=unserialize($data->upcoming_pricing);
         }
         else
         {
           $price=unserialize($data->pricing);
         }
         $type=[];
         $pri=[];
         foreach($price as $prices):
            $pri[]=$prices;
         endforeach;
         $price_count=count($price);
         $price=$pri;
         $price_data="";
         $final_price_array="";
         for($i=0;$i<$price_count;$i++)
           {
           //$price_adult=$price[$i]["adult_fare_total"];
      $air_currency=CustomHelpers::get_rate($price[$i]["aircurrency"]);
      $air_fare_adult=$price[$i]["airfare_adult"];
      $hotel_currency=CustomHelpers::get_rate($price[$i]["hotelcurrency"]);
      $hotel_fare_adult=$price[$i]["hotelfare_adult"];
      $tour_currency=CustomHelpers::get_rate($price[$i]["tourcurrency"]);
      $tour_fare_adult=$price[$i]["tourfare_adult"];
      $transfer_currency=CustomHelpers::get_rate($price[$i]["transfercurrency"]);
      $transfer_fare_adult=$price[$i]["transferfare_adult"];
      $visa_currency=CustomHelpers::get_rate($price[$i]["visacurrency"]);
      $visa_fare_adult=$price[$i]["visafare_adult"];
      $total="0";
      if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare_adult;
      }
      if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare_adult;
      }
      if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare_adult;
      }
      if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_currency*$transfer_fare_adult;
      }
      if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare_adult;
      }
           if($total!="" && $total!="0"):
           $total=$total;
           $date_from=strtotime($price[$i]["datefrom"]);
           $date_to=strtotime($price[$i]["dateto"]);
           $current_date=strtotime($date);
           if(($date_from<=$current_date )&&( $date_to>=$current_date ))
           {
           $price_data.=$total.',';
           $package_type=$price[$i]["package_rating"];
           if($package_type=='other'):
            $type[]=$price[$i]["package_rating_other"];
            $check_pkg_type=$price[$i]["package_rating_other"];
           else:
            $package_type= PkgRatingType::find($package_type);
            $type[]=$package_type->name;
            $check_pkg_type=$package_type->name;
           endif;
          //  if($check_pkg_type==$pkg_type)
          //  {
          //  $amount[]=$total;
          //  }
          //  else
          //  {
          // $amount[]=$total;
          //  }
           $associative[$check_pkg_type]=$total;
           }
            endif;
            }
      //
      if(!empty($associative))
      {
      if (array_key_exists($pkg_type,$associative))
      {
        $price=$associative[$pkg_type];
        $ad_price=CustomHelpers::moneyFormatIndia($price);
        $return_price=$ad_price;
        $a='';
        foreach($type as $row=>$col)
        {
        if($pkg_type==$col)
        {
         $condition='selected';
        }
        else
        {
        $condition='';
        }
        $a.='<option value="'.$col.'" '.$condition.'>'.$col.'</option>';
        }
      $type=$a;
      }
      else
      {
      foreach($associative as $rows=>$col):
      $price=$col;
      $ad_price=CustomHelpers::moneyFormatIndia($price);
      $return_price=$ad_price;
      $new_cond=$rows;
      endforeach;
      $a='';
        foreach($type as $row=>$col)
        {
        if($new_cond==$col)
        {
         $condition='selected';
        }
        else
        {
      $condition='';
        }
        $a.='<option value="'.$col.'" '.$condition.'>'.$col.'</option>';
        }
      $type=$a;
      }
      $Price_type=$data->Price_type;
        }
        else
        {
       $return_price= "On Request";
       $type="On Request";
       $Price_type="";
        }
      //
       return $return_price;
  }
  
  //
  public static function get_price($id)
  {
      $data=Packages::find($id);
      $price=unserialize($data->pricing);
      $pri=[];
      foreach($price as $prices):
      $pri[]=$prices;
      endforeach;
      $price_count=count($price);
      $price=$pri;
      $price_data="";
      $final_price_array="";
      for($i=0;$i<$price_count;$i++)
      {
      //$price_adult=$price[$i]["adult_fare_total"];
      $air_currency=CustomHelpers::get_rate($price[$i]["aircurrency"]);
      $air_fare_adult=$price[$i]["airfare_adult"];
      $hotel_currency=CustomHelpers::get_rate($price[$i]["hotelcurrency"]);
      $hotel_fare_adult=$price[$i]["hotelfare_adult"];
      $tour_currency=CustomHelpers::get_rate($price[$i]["tourcurrency"]);
      $tour_fare_adult=$price[$i]["tourfare_adult"];
      $transfer_currency=CustomHelpers::get_rate($price[$i]["transfercurrency"]);
      $transfer_fare_adult=$price[$i]["transferfare_adult"];
      $visa_currency=CustomHelpers::get_rate($price[$i]["visacurrency"]);
      $visa_fare_adult=$price[$i]["visafare_adult"];
      $total="0";
      if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare_adult;
      }
      if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare_adult;
      }
      if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare_adult;
      }
      if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_currency*$transfer_fare_adult;
      }
      if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare_adult;
      }
           if($total!="" && $total!="0"):
           $total=$total;
           $date_from=strtotime($price[$i]["datefrom"]);
           $date_to=strtotime($price[$i]["dateto"]);
           $current_date=strtotime(Date('m/d/Y'));
           if(($date_from<=$current_date )&&( $date_to>=$current_date ))
           {
           $price_data.=$total.',';
           }
           endif;
            }
      $price_array=explode(",",$price_data);
      if(count($price_array)>1)
      {
      sort($price_array);
      $price=$price_array["1"];
      $ad_price=CustomHelpers::moneyFormatIndia($price);
      return $ad_price;
      }
      else
      {
      return "On Request";
      }
  }

  // ***********************

  /*public static function get_up_price($id)
  {
      $data=Packages::find($id);
      $price=unserialize($data->upcoming_pricing);
      $price_count=count($price);
         $price_data="";
         $final_price_array="";
         for($i=0;$i<$price_count;$i++)
           {
           //$price_adult=$price[$i]["adult_fare_total"];
      $air_currency=CustomHelpers::get_rate($price[$i]["aircurrency"]);
      $air_fare_adult=$price[$i]["airfare_adult"];
      $hotel_currency=CustomHelpers::get_rate($price[$i]["hotelcurrency"]);
      $hotel_fare_adult=$price[$i]["hotelfare_adult"];
      $tour_currency=CustomHelpers::get_rate($price[$i]["tourcurrency"]);
      $tour_fare_adult=$price[$i]["tourfare_adult"];
      $transfer_currency=CustomHelpers::get_rate($price[$i]["transfercurrency"]);
      $transfer_fare_adult=$price[$i]["transferfare_adult"];
      $visa_currency=CustomHelpers::get_rate($price[$i]["visacurrency"]);
      $visa_fare_adult=$price[$i]["visafare_adult"];
      $total="0";
      if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
      {
           $total+=$air_currency*$air_fare_adult;
      }
      if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
      {
           $total+=$hotel_currency*$hotel_fare_adult;
      }
      if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
      {
           $total+=$tour_currency*$tour_fare_adult;
      }
      if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
      {
           $total+=$transfer_currency*$transfer_fare_adult;
      }
      if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
      {
           $total+=$visa_currency*$visa_fare_adult;
      }
           if($total!="" && $total!="0"):
           $total=$total;
           $date_from=strtotime($price[$i]["datefrom"]);
           $date_to=strtotime($price[$i]["dateto"]);
           $current_date=strtotime(Date('m/d/Y'));
           if($current_date<$date_from):
           $price_data.=$total.',';
           elseif(($date_from<=$current_date )&&( $date_to>=$current_date )):
           $price_data.=$total.',';
           break;
           endif;
           endif;
            }
      $price_array=explode(",",$price_data);
      if(count($price_array)>1)
      {
      sort($price_array);
      $price=$price_array["1"];
      $ad_price=CustomHelpers::moneyFormatIndia($price);
      return $ad_price;
      }
     else
     {
      return "On Request";
     }
  }*/

  public static function get_up_price($id)
  {
    $data = Packages::find($id);

    // Ensure $data and $data->upcoming_pricing are valid
    if (!$data || !$data->upcoming_pricing) {
        return "On Request";
    }

    // Unserialize and check if $price is an array
    $price = unserialize($data->upcoming_pricing);
    if (!is_array($price) || count($price) === 0) {
        return "On Request";
    }

    $price_data = "";
    foreach ($price as $pricing) {
      $air_currency = CustomHelpers::get_rate($pricing["aircurrency"] ?? "NA");
      $air_fare_adult = $pricing["airfare_adult"] ?? 0;

      $hotel_currency = CustomHelpers::get_rate($pricing["hotelcurrency"] ?? "NA");
      $hotel_fare_adult = $pricing["hotelfare_adult"] ?? 0;

      $tour_currency = CustomHelpers::get_rate($pricing["tourcurrency"] ?? "NA");
      $tour_fare_adult = $pricing["tourfare_adult"] ?? 0;

      $transfer_currency = CustomHelpers::get_rate($pricing["transfercurrency"] ?? "NA");
      $transfer_fare_adult = $pricing["transferfare_adult"] ?? 0;

      $visa_currency = CustomHelpers::get_rate($pricing["visacurrency"] ?? "NA");
      $visa_fare_adult = $pricing["visafare_adult"] ?? 0;

      // Calculate total price
      $total = 0;
      if (!empty($air_fare_adult) && $air_currency !== "NA") {
        $total += $air_currency * $air_fare_adult;
      }
      if (!empty($hotel_fare_adult) && $hotel_currency !== "NA") {
        $total += $hotel_currency * $hotel_fare_adult;
      }
      if (!empty($tour_fare_adult) && $tour_currency !== "NA") {
        $total += $tour_currency * $tour_fare_adult;
      }
      if (!empty($transfer_fare_adult) && $transfer_currency !== "NA") {
        $total += $transfer_currency * $transfer_fare_adult;
      }
      if (!empty($visa_fare_adult) && $visa_currency !== "NA") {
        $total += $visa_currency * $visa_fare_adult;
      }

      // Only add totals if they're valid
      if ($total > 0) {
        $date_from = strtotime($pricing["datefrom"] ?? "1970-01-01");
        $date_to = strtotime($pricing["dateto"] ?? "1970-01-01");
        $current_date = strtotime(Date('m/d/Y'));

        // Check if current date is within the pricing date range
        if ($current_date < $date_from || ($date_from <= $current_date && $current_date <= $date_to)) {
          $price_data .= $total . ",";
        }
      }
    }

    // Process price data
    $price_array = array_filter(explode(",", $price_data));
    if (count($price_array) > 1) {
      sort($price_array);
      $price = $price_array[1] ?? $price_array[0];
      $ad_price = CustomHelpers::moneyFormatIndia($price);
      return $ad_price;
    } else {
      return "On Request";
    }
  }

  /************************************/

  //
  public static function get_package_name($id) {
        $name = DB::table('rt_packages')
        ->select('title')
        ->where('id',$id)
        ->first();
        if($name){
            return $name->title;
        }else{
            return '';
        }
  }
  
  //
  public static function get_pkg_type_record($pkg_type,$id)
  {
      $pkg_type=$pkg_type;
      $id=$id;
      $data=Packages::find($id);
      $pricing=unserialize($data->upcoming_pricing);
      foreach($pricing as $price):
        if($price["package_rating"]==$pkg_type):
          $date=$price["datefrom"];
         break;
        endif;
      endforeach;
      $date=explode("/", $date);
      $date_year=$date["2"];
      $date_month=$date["0"];
      $date_date=$date["1"];
      $final_date=$date_year."-".$date_month."-".$date_date;
      $from_date=strtotime($final_date);
      $current_date=date('Y-m-d');
      $current=strtotime(date('Y-m-d'));
      if($current<$from_date):
        return $final_date;
      else:
         return $current_date;
      endif;
  }

  //
  public static function theme_data($id,$title)
  {
        $data = DB::table('theme_data')
        ->select($title)
        ->where('theme_name',$id)
        ->first();
        if($data){
            return $data->$title;
        }else{
            return 'NA';
        }
  }

  public static function moneyFormatIndia($num) {
      $explrestunits = "" ;
      if(strlen($num)>3) {
          $lastthree = substr($num, strlen($num)-3, strlen($num));
          $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
          $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
          $expunit = str_split($restunits, 2);
          for($i=0; $i<sizeof($expunit); $i++) {
              // creates each of the 2's group and adds a comma to the end
              if($i==0) {
                  $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              } else {
                  $explrestunits .= $expunit[$i].",";
              }
          }
          $thecash = $explrestunits.$lastthree;
      } else {
          $thecash = $num;
      }
      return $thecash; // writes the final format where $currency is the currency symbol.
  }

  //
  public static function data_search($a,$b)
  {
      $first=strtolower($a);
      $second=strtolower($b);
      $first_break=str_split($first);
      $first1=ord($first_break["0"]);
      $first2=ord($first_break["1"]);
      $first3=ord($first_break["2"]);
      $first_complete=($first1+$first2+$first3);
      $second_break=str_split($second);
      $second1=ord($second_break["0"]);
      $second2=ord($second_break["1"]);
      $second3=ord($second_break["2"]);
      $second_complete=($second1+$second2+$second3);
      if($first1==$second1 && $first2==$second2 && $first3==$second3)
      {
        return "<li>".$a."</li>";
      }
  }
    
  //
  public static function get_user_name($id) {
        $name = DB::table('users')
        ->select('first_name','last_name')
        ->where('id',$id)
        ->first();
        if($name){
            return $name->first_name.' '.$name->last_name;
        }else{
            return 'NA';
        }
  }

  //
  public static function query_data($id,$field) {
        $name = DB::table('rt_package_query')
        ->select($field)
        ->where('id',$id)
        ->first();
        if($name){
            return $name->$field;
        }else{
            return 'NA';
        }
  }
  
  //
  public static function get_user_role($id) {
        $user = DB::table('role_users')
        ->select('role_id')
        ->where('user_id',$id)
        ->first();
        if($user){
            $role = DB::table('roles')
            ->select('slug')
            ->where('id', $user->role_id)
            ->first();
            return $role->slug;
        }else{
            return 'NA';
        }
  }

  public static function getcountry_names($country) {
        $coun = DB::table('regions')
            ->select('country')
            ->whereIn('id',$country)
            ->get();
        $country_array = array();
        foreach($coun as $c){
            $country_array[] = $c->country;
        }
            return implode(',',$country_array);
  }

  public static function getlocation_names($location) {
        $loca = DB::table('rt_locations')
            ->select('location')
            ->whereIn('id',$location)
            ->get();
        $location_array = array();
        foreach($loca as $l){
            $location_array[] = $l->location;
        }
            return implode(',',$location_array);
  }

  public static function getlocation_data($location) {
        $loca = DB::table('rt_locations')
            ->select('*')
            ->whereIn('id',$location)
            ->get();
        $location_array = array();
        foreach($loca as $l){
            $location_array[] = $l;
        }
            return $location_array;
  }

  /************************************/

  /*public static function get_visa_policy($id) {
        $poli = DB::table('rt_pkg_visa_policy')
        ->select('pkgPolicyDesc')
        ->where('id',$id)
        ->get()->first();
        return $poli->pkgPolicyDesc;
  }*/

  public static function get_visa_policy($id) {
    $poli = DB::table('rt_pkg_visa_policy')
        ->select('pkgPolicyDesc')
        ->where('id', $id)
        ->first();  // Use first() to retrieve the first matching result

    // Check if a valid result was returned and return the description, or an empty string if not found
    return $poli ? $poli->pkgPolicyDesc : '';
  }

  /************************************/

  public static function get_query_field($id,$field)
  {
       $poli = DB::table('rt_package_query')
        ->select($field)
        ->where('id',$id)
        ->get()->first();
     
        if($poli):
          return $poli->$field;
        else:
          return "N";
        endif;
  }

  public static function get_quotation_header($id)
  {
        $poli = DB::table('quotation_header')
        ->select('header_desc')
        ->where('id',$id)
        ->get()->first();
        return $poli->header_desc;
  }

  public static function get_quotation_footer($id)
  {
        $poli = DB::table('quotation_footer')
        ->select('footer_desc')
        ->where('id',$id)
        ->get()->first();
        return $poli->footer_desc;
  }

  /************************************/

  /*public static function get_payment_policy($id) {
        $poli = DB::table('rt_pkg_payment_policy')
        ->select('pkgPolicyDesc')
        ->where('id',$id)
        ->get()->first();
        return $poli->pkgPolicyDesc;
  }*/

  public static function get_payment_policy($id) {
    $poli = DB::table('rt_pkg_payment_policy')
        ->select('pkgPolicyDesc')
        ->where('id', $id)
        ->first();  // Use first() to get a single result

    // Check if the result exists and return the description, or an empty string if not found
    return $poli ? $poli->pkgPolicyDesc : '';
  }

  /************************************/

  /*public static function get_cancel_policy($id) {
    $poli = DB::table('rt_pkg_cancelation_policy')
        ->select('can_policy_desc')
        ->where('id',$id)
        ->get()->first();
        return $poli->can_policy_desc;
  }*/

  public static function get_cancel_policy($id) {
    $poli = DB::table('rt_pkg_cancelation_policy')
        ->select('can_policy_desc')
        ->where('id', $id)
        ->first();  // Use first() to get a single result

    // Check if the result exists and return the description, or an empty string if not found
    return $poli ? $poli->can_policy_desc : '';
  }

  /************************************/
  
  /*public static function get_impnotes($id) {
    $poli = DB::table('rt_pkgimportantnotes')
        ->select('policy_desc')
        ->where('id',$id)
        ->get()->first();
        return $poli->policy_desc;
  }*/


  public static function get_impnotes($id) {
    $poli = DB::table('rt_pkgimportantnotes')
        ->select('policy_desc')
        ->where('id', $id)
        ->first(); // Fetch only the first result

    return $poli ? $poli->policy_desc : null; // Return null if no policy found
  }

  /************************************/

  public static function get_tour_data($id) {
        $tour = DB::table('rt_pkg_tour_locations')
        ->select('*')
        ->where('id',$id)
        ->get()->first();
        return $tour;
  }

  public static function get_tour_name($id) {
        $tour = DB::table('rt_pkg_tour_locations')
        ->select('activity')
        ->where('id',$id)
        ->get()->first();
        return $tour->activity;
  }

  public static function encrypt_url_param($param) {
      return $parameter= Crypt::encrypt($param);
  }

  public static function countRows($id,$table,$selectField,$whareField) {
        $image = DB::table($table)
        ->select($selectField)
        ->where($whareField,$id)
        ->get();
        return count($image);
  }

  public static function comma_separated_to_array($string, $separator = ',')
  {
      $vals = explode($separator, $string);
      foreach($vals as $key => $val) {
        $vals[$key] = trim($val);
      }
      return array_diff($vals, array(""));
  }

  public static function getRoomPrice($id,$table) {
        // Get Current Day
        $date = date('d-M-Y');
        $nameOfDay = strtolower(date('D', strtotime($date)));
        // Getting Special price from db
        $queryDataByDateRange = DB::table($table)
                    ->select($nameOfDay,'stay_Start_Date','stay_End_Date')
                    ->where(['room_id'=> $id,'price_Type' => "special", 'occupacyType' => 'single'])
                    ->first();
        $queryforRegular = DB::table($table)
                    ->select($nameOfDay)
                    ->where(['room_id'=> $id,'price_Type' => "regular", 'occupacyType' => 'single'])
                    ->first();
        // Checking Special price available Or Not
        if(!empty($queryDataByDateRange)){
            $strtdate = date('m-d-Y',strtotime($queryDataByDateRange->stay_Start_Date));
            $enddate =  date('m-d-Y',strtotime($queryDataByDateRange->stay_End_Date));
            $paymentDate=date('m-d-Y');
            if (($paymentDate >= $strtdate) && ($paymentDate <= $enddate)){
                if($queryDataByDateRange){
                    //echo "Special Price<br>";
                    return ($queryDataByDateRange->$nameOfDay);
                }else{
                    return('On Request');
                }
            }else{
                if($queryforRegular){
                    //echo "Regular Price<br>";
                    return ($queryforRegular->$nameOfDay);
                }else{
                    return('On Request');
                }
            }
        }else{
            if($queryforRegular){
                //echo "Regular Price<br>";
                return ($queryforRegular->$nameOfDay);
            }else{
                return('On Request');
            }
        }
  }

  public static function getRoomPriceByHotel($id) {
        // Get Current Day
        $date = date('d-M-Y');
        $nameOfDay = strtolower(date('D', strtotime($date)));
        $query = DB::table('rt_rooms')
        ->select('id')
        ->where(['assignedHotelname'=> $id])
        ->get();
        //return $query;
        $totalPrice = array();
        foreach ($query as $key => $value) {
            $query1 = DB::table('rt_room_rates_plans')
            ->select($nameOfDay)
            ->where(['room_id'=> $value->id,'price_Type' => "regular", 'occupacyType' => 'single'])
            ->first();
            if($query1){
                $totalPrice[]=$query1->$nameOfDay;
            }else{
                $totalPrice[]="NA";
            }
        }
        if(!in_array("NA", $totalPrice)){
            $minPrice = min($totalPrice);
            return $minPrice;
        }else{
            return('NA');
        }
  }

  public static function getCustomerInRoomInventory($date,$roomId) {
        $query = DB::table('rt_bookings')
        ->select('id','roomId','customerId','cca_order_id','cca_billingName')
        ->where(['checkInDate'=> $date,'bookingStatus' =>'upcoming','roomId'=>$roomId])
        ->get();
        return $query;
  }

  // Get Booking Array from Order Id
  public static function getBookingArrayById($id) {
        $query = DB::table('rt_bookings')
        ->where('cca_order_id', $id)
        ->first();
        return $query;
  }

  public static function getRowArrayById($id,$table) {
        $query = DB::table($table)->first();
        return $query;
  }

  public static function get_indian_currency($num) {
     echo number_format($num,0);
  }

  /************************************/

  /*public static function otp_send($mobile,$otp) {
      $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";

      $number=$mobile;
      $number = preg_replace('/\s/', '', $number);
      $mobile_code="91";
     
      $numbers = array($mobile_code.$number);
      
      $sender = urlencode('RAPTRA');
      if($otp!=0)
      {
       $ref=$otp; 
      }
      else
      {
       $ref=mt_rand(10000,99999); 
      }
      // $ref=mt_rand(10000,99999);
      
    
      $message = rawurlencode("we have sent OTP on your Mobile No: $ref -Regards Rapidex Travels");
      $numbers = implode(',', $numbers);
     
      $response=CustomHelpers::sendSms($apiKey,$numbers, $message, $sender);
      $response=json_decode($response);
      
      if($response->status=="success")
      {
          setcookie('otp',$ref);
         return "success";
      }
      elseif ($response->status=="failure") 
      {
        return "Fail";
      }

       //status
  }*/

  public static function otp_send($mobile, $otp)
  {
    // API Key for sending SMS
    $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";

    // Clean the mobile number by removing spaces
    $number = preg_replace('/\s/', '', $mobile);
    $mobile_code = "91"; // Country code for India

    // Prepare the mobile number
    $numbers = array($mobile_code . $number);
    $sender = urlencode('RAPTRA');

    // Generate or use the provided OTP
    $ref = ($otp != 0) ? $otp : mt_rand(10000, 99999);

    // Determine the sender name based on the environment variable
    $websiteName = env('WEBSITENAME');
    //$senderName = ($websiteName == 1) ? "The World Gateway" : "Rapidex Travels";
    $senderName = ($websiteName == 1) ? "Rapidex Travels" : "Rapidex Travels";

    // Prepare the message
    //$message = rawurlencode("We have sent OTP on your mobile number: $ref - Regards $senderName");
    $message = rawurlencode("we have sent OTP on your Mobile No: $ref -Regards $senderName"); // this message is with DOT panel

    // Convert the numbers array to a comma-separated string
    $numbers = implode(',', $numbers);

    // Send the SMS using a custom method
    $response = CustomHelpers::sendSms($apiKey, $numbers, $message, $sender);
    $response = json_decode($response);

    // Handle the response from the SMS API
    if ($response->status === "success") {
        setcookie('otp', $ref, time() + (5 * 60), "/"); // Set cookie with a 5-minute expiration
        return "success";
    } elseif ($response->status === "failure") {
        return "fail"; // Return a standardized fail message
    }

    // Optional: return an error message if the status is unexpected
    return "error"; // Return error for unexpected status
  }

  /************************************/

  /*public static function sendSms($apiKey,$numbers,$message, $sender)
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
  }*/

  public static function sendSms($apiKey, $numbers, $message, $sender)
  {
    // Prepare data for POST request
    $data = [
        'apikey' => $apiKey,
        'numbers' => $numbers,
        'sender' => $sender,
        'message' => $message
    ];

    // Initialize cURL session
    $ch = curl_init('https://api.textlocal.in/send/');
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Execute cURL request and get the response
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($ch); // Capture error message
        curl_close($ch); // Close cURL session
        return json_encode(['status' => 'failure', 'message' => $error]); // Return error as JSON
    }
    
    // Close cURL session
    curl_close($ch);
    
    // Return the response from the API
    return $response;
  }

}