<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;
use Session;
use App\User;
use App\Voucher;
use DB;
use Sentinel;
use Validator;
use Mail;
use App\Helpers\CustomHelpers;
use App\Payment;
use App\Query;
use App\Passengerinfo;
use App\QueryLeadTravellerInfo;
use App\QueryLeadTraveller;
use App\QueryTraveller;
use Redirect;
use App\Coupon;
use App\GatewaySetting;
use App\TwgPaymentMode;

class PaymentOptionController extends Controller
{
    public function check_mode(Request $request)
    {
        $mode=CustomHelpers::custom_decrypt($request->mode);
        $check_mode=TwgPaymentMode::where([['status',1],['id',$mode]])->first();
        if($check_mode=='')
        {
            echo 'error';
        }
        else
        {
          $gateway_id=$check_mode->gateway_id;
          $mdr=$check_mode->mdr;
          $mdr_gst=$check_mode->gst_on_mdr;
          if($gateway_id==1)
          {
           $output=['mode'=>'paytm-payment','mdr'=>$mdr,'mdr_gst'=>$mdr_gst,'mode_id'=>$mode]; 
          }
          elseif($gateway_id==2)
          {
            $output=['mode'=>'phonepe-payment','mdr'=>$mdr,'mdr_gst'=>$mdr_gst,'mode_id'=>$mode]; 
           
          }
          return $output;
          
        }
        


    }
    public function payment_option(Request $request)
  {
   
    
   //  $remaining_amount=CustomHelpers::get_remaining_amount();
   //  if($amount=='' || $amount>$remaining_amount || $amount<10)
   //  {
   // $amount=CustomHelpers::get_remaining_amount();
   //  }
    $unique_code=$request->unique_code;
  
        $quote_no=Session::get($unique_code.'quoteno');
        $quote1_id=Session::get($unique_code.'quote1_id');
        $quote2_id=Session::get($unique_code.'quote2_id');
        $quote3_id=Session::get($unique_code.'quote3_id');
        $quote4_id=Session::get($unique_code.'quote4_id');
        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;
        $price=unserialize($data->option1_price);
         $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);

        }
        elseif($quote_no==2)
        {
        $data=Option2Quotation::find((int)$quote2_id);
        $quote_ref_no=$data->quotation_ref_no;
        $price=$data->option2_price;
        }
        elseif($quote_no==3)
        {
         $data=Option3Quotation::find((int)$quote3_id);
         $quote_ref_no=$data->quotation_ref_no;
         $price=$data->option3_price;
        }
        elseif($quote_no==4)
        {
        $data=Option4Quotation::find((int)$quote4_id);
        $quote_ref_no=$data->quotation_ref_no;
        $price=$data->option4_price;
        }
    $amount_type=$request->amount_type;
    $get_installment_number=CustomHelpers::get_installment_number($price_data['query_pricetopay_adult'],$unique_code);
 $part_payments_sec=CustomHelpers::part_payments($data->part_payments,$price_data['query_pricetopay_adult']);
 
    if($amount_type=='part')
    {
    $amount=Session::get($unique_code.'custom_last');
    $adv_amount=$part_payments_sec['adv_amount'];
$first_part_amount=$part_payments_sec['first_part_amount'];
$second_part_amount=$part_payments_sec['second_part_amount'];
$total_received_amount=CustomHelpers::get_received_amount($unique_code);
if($total_received_amount<$adv_amount)
{
$get_installment_number=1;

}
elseif($total_received_amount==$adv_amount)
{
$get_installment_number=2;

}
elseif($total_received_amount>$adv_amount && $total_received_amount<((float)$adv_amount+(float)$first_part_amount))
{
$get_installment_number=3; 
}
elseif($total_received_amount>$adv_amount && $total_received_amount==((float)$adv_amount+(float)$first_part_amount))
{
$get_installment_number=3; 
}
else
{
$get_installment_number=3; 
}

     if(Session::has($unique_code.'get_installment_number'))
         {
       Session::forget($unique_code.'get_installment_number');
         }
    
      Session::set($unique_code.'get_installment_number',$get_installment_number);
      
    }
    else
    {
        if(Session::has($unique_code.'get_installment_number'))
         {
       Session::forget($unique_code.'get_installment_number');
         }
        
      Session::set($unique_code.'get_installment_number','full');
    $amount=Session::get($unique_code.'custom_remaining');
    }

    $custom_last=Session::get($unique_code.'custom_last');
    $custom_remaining=Session::get($unique_code.'custom_remaining');

        $order_id=time();
        
        $query_reference=$data->query_reference;
        $query=Query::find($query_reference);
        $totalamount=1212;
        $total_quote_amount=232;
    
         if(Session::has($unique_code.'amount'))
         {
       Session::forget($unique_code.'amount');
         }
        Session::set($unique_code.'amount',$amount);

    $passenger=Passengerinfo::where('quotation_ref_no','=',$quote_ref_no)->first();
    $passenger->installment_number=Session::get($unique_code.'get_installment_number');
    $passenger->save();
    $query_lead_traveller=QueryLeadTraveller::where('email',$data->email)->first();
    $lead_traveller_id=$query_lead_traveller->id;

    $query_lead_traveller_info=QueryLeadTravellerInfo::where('lead_traveller_id',$lead_traveller_id)->first();
   


if(Session::has($unique_code.'coupon_id') && CustomHelpers::get_check_payment_status($quote_ref_no)==0)
                        {
    $coupon_id=Session::get($unique_code.'coupon_id'); 
    $coupon_data=Coupon::find($coupon_id);
   
    if($coupon_data!='')
    {
       $price['pricediscountnegative']=3;
       $price['discount_coupon']=$coupon_data->value;   
    }
  }
    
   $price_data_first=CustomHelpers::get_price_part_seperate(serialize($price),$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
               $adult=$data->quote1_number_of_adult;
               $extra_adult=$data->extra_adult;
               $child_with_bed=$data->child_with_bed;
               $child_without_bed=$data->child_without_bed;
               $infant=$data->infant;
               $solo_traveller=$data->solo_traveller;                     

   $payment_modes=TwgPaymentMode::where('status',1)->get();
  
    return view("payment.paymentreview",compact('amount','query','data','totalamount','total_quote_amount','quote_ref_no','passenger','query_lead_traveller_info','query_lead_traveller','custom_last','custom_remaining','price_data_first','unique_code','payment_modes'));
  } 



  
}
