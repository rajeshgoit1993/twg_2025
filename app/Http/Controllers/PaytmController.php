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

class PaytmController extends Controller
{
    /*-------- Coupon --------*/

    /*// coupon code
    public function check_coupon_code(Request $request)
    {
      $code=$request->code;
      $now = date('Y-m-d');
      $coupon_data=Coupon::where([['end_date', '>=', $now],['start_date', '<=', $now]])
                      ->whereIn('coupon_code',[$code])
                       ->first();
      if($coupon_data=='')
      {
      echo 'error';
      }
      else
      {
     echo CustomHelpers::custom_encrypt($coupon_data->id);
      }
    }*/

    // coupon code
    public function check_coupon_code(Request $request)
    {
        // Retrieve the coupon code from the request
        $code = $request->code;

        // Get the current date
        $now = date('Y-m-d');

        // Query to find a coupon that matches the provided code and is valid within the current date range
        $coupon_data = Coupon::where([
            ['end_date', '>=', $now],   // Coupon end date should be on or after today
            ['start_date', '<=', $now]  // Coupon start date should be on or before today
        ])->whereIn('coupon_code', [$code])->first();

        // Check if no coupon data was found
        if ($coupon_data == '') {
            echo 'error'; // Output 'error' if no valid coupon was found
        } else {
            // If a valid coupon was found, encrypt its ID using a custom encryption method
            echo CustomHelpers::custom_encrypt($coupon_data->id);
        }
    }

    /*// coupon apply
    public function coupon_apply(Request $request)
    {
        $unique_code=$request->unique_code;

        $id=CustomHelpers::custom_decrypt($request->id); 
        $type=$request->type;  
        $amount_type=$request->amount_type;  
        // $coupons=Coupon::all();
        $now = date('Y-m-d');
        $coupons=Coupon::where([['end_date', '>=', $now],['start_date', '<=', $now]])
                          ->whereIn('applicable_for',[1,2,4])
                           ->get();
        $coupn_output='';
        $quote_no=Session::get($unique_code.'quoteno');
        $quote1_id=Session::get($unique_code.'quote1_id');
        $quote2_id=Session::get($unique_code.'quote2_id');
        $quote3_id=Session::get($unique_code.'quote3_id');
        $quote4_id=Session::get($unique_code.'quote4_id');

        if($quote_no==1)
        {
        $data=Option1Quotation::find((int)$quote1_id);
        $quote_ref_no=$data->quo_ref;
        $price=$data->option1_price;
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
        $remaining_amount=CustomHelpers::get_remaining_amount($price_data['query_pricetopay_adult'],$unique_code);
        $get_installment_number=CustomHelpers::get_installment_number($price_data['query_pricetopay_adult'],$unique_code);

        $price_data_first=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
               $adult=$data->quote1_number_of_adult;
               $extra_adult=$data->extra_adult;
               $child_with_bed=$data->child_with_bed;
               $child_without_bed=$data->child_without_bed;
               $infant=$data->infant;
               $solo_traveller=$data->solo_traveller;

        $gst_amount=$price_data_first['query_total_gst_group'];
        $tcs_amount=$price_data_first['query_total_tcs_group'];
        $booking_amount=$price_data_first['query_total_pg_group'];
        $grand_total=$price_data_first['query_pricetopay_adult'];
        if($type=='coupon_remove' && $price_data_first['pricediscountnegative']==3 && CustomHelpers::get_check_payment_status($quote_ref_no)==0)
        {
        $remove_price=unserialize($data->option1_price);   
        $remove_price['pricediscountnegative']=3;
        $remove_price['discount_coupon']=0;  

            $price_data_first=CustomHelpers::get_price_part_seperate(serialize($remove_price),$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
                   $adult=$data->quote1_number_of_adult;
                   $extra_adult=$data->extra_adult;
                   $child_with_bed=$data->child_with_bed;
                   $child_without_bed=$data->child_without_bed;
                   $infant=$data->infant;
                   $solo_traveller=$data->solo_traveller;

        $gst_amount=$price_data_first['query_total_gst_group'];
        $tcs_amount=$price_data_first['query_total_tcs_group'];
        $booking_amount=$price_data_first['query_total_pg_group'];
        $grand_total=$price_data_first['query_pricetopay_adult'];
        $custom_discount_coupn=$price_data_first['query_total_discount_group'];
        $remaining_amount=$price_data_first['query_pricetopay_adult'];


        }
        else
        {
        $custom_discount_coupn=$price_data_first['query_total_discount_group'];

        }

        $custom_offer_show='';  

        $custom_last=0;
        $custom_first_installment=0;  
        $custom_second_installment=0;
        $custom_third_installment=0;
        Session::set($unique_code.'get_installment_number','full');
        if($data->partPayment==1):
        $part_payments=unserialize($data->part_payments);
        if($get_installment_number==0):
               $custom_last=(float)$part_payments['adv_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;
        if(Session::has($unique_code.'get_installment_number'))
         {
        Session::forget($unique_code.'get_installment_number');
         }
        Session::set($unique_code.'get_installment_number',1);

        elseif($get_installment_number==1):
               $custom_last=(float)$part_payments['first_part_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;
                if(Session::has($unique_code.'get_installment_number'))
         {
        Session::forget($unique_code.'get_installment_number');
         }
        Session::set($unique_code.'get_installment_number',2);
        elseif($get_installment_number==2):
              $custom_last=(float)$part_payments['second_part_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;
        if(Session::has($unique_code.'get_installment_number'))
         {
        Session::forget($unique_code.'get_installment_number');
         }
        Session::set($unique_code.'get_installment_number',3);
        elseif($get_installment_number==3):

        endif;
        $custom_first_installment=(float)$part_payments['adv_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;
        $custom_second_installment=(float)$part_payments['first_part_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;
        $custom_third_installment=(float)$part_payments['second_part_percentage']*(float)$price_data_first['query_pricetopay_adult']/100;

        endif;

        $pay_now=$remaining_amount;
        $due_amount=0;
        if($amount_type=='part')
        {
        $pay_now=$custom_last;
        // $due_amount=$custom_remaining-$custom_last;   
        $due_amount=$remaining_amount-$custom_last;   
        }
        $custom_remaining=$remaining_amount;

        // if($type=='coupon' && $price_data_first['pricediscountnegative']!=3):
        if($type=='coupon' && CustomHelpers::get_check_payment_status($quote_ref_no)==0):
        $price=$data->option1_price;
        $new_price=unserialize($data->option1_price);
        $d=Passengerinfo::where('quotation_ref_no','=',$data->quo_ref)->first();
        $coupon_data=Coupon::find($id);
        $new_price['pricediscountnegative']=3;
        $new_price['discount_coupon']=$coupon_data->value; 
        $new_price['coupon_id']=$id;   
        // $new_price['query_discount_minus_adult']=0;  
        // $new_price['query_discount_minus_exadult']=0;  
        // $new_price['query_discount_minus_childbed']=0;  
        // $new_price['query_discount_minus_childwbed']=0;   
        // $new_price['query_discount_minus_infant']=0;  
        // $new_price['query_discount_minus_single']=0; 
        // $new_price['query_total_discount_group']=0; 
        $price_data_first=CustomHelpers::get_price_part_seperate(serialize($new_price),$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
               $adult=$data->quote1_number_of_adult;
               $extra_adult=$data->extra_adult;
               $child_with_bed=$data->child_with_bed;
               $child_without_bed=$data->child_without_bed;
               $infant=$data->infant;
               $solo_traveller=$data->solo_traveller;

        $gst_amount=$price_data_first['query_total_gst_group'];
        $tcs_amount=$price_data_first['query_total_tcs_group'];
        $booking_amount=$price_data_first['query_total_pg_group'];
        $grand_total=$price_data_first['query_pricetopay_adult'];
        $custom_discount_coupn=$price_data_first['query_total_discount_group'];
        $remaining_amount=$price_data_first['query_pricetopay_adult'];

        $divide_val=$coupon_data->value+100;
        $booking_amount=$price_data_first['query_total_pg_group'];
        $grand_total=$price_data_first['query_total_group'];
        $custom_discount_coupn=$price_data_first['query_total_group']*$coupon_data->value/$divide_val;
        $custom_remaining=$price_data_first['query_pricetopay_adult'];

        $custom_last=0;
        $custom_first_installment=0;
        $custom_second_installment=0;
        $custom_third_installment=0;
        if($data->partPayment==1):
        $part_payments=CustomHelpers::part_payments($data->part_payments,$custom_remaining);

        if($get_installment_number==0):
               $custom_last=$part_payments['adv_amount'];
        elseif($get_installment_number==1):
               $custom_last=$part_payments['first_part_amount'];
        elseif($get_installment_number==2):
              $custom_last=$part_payments['second_part_amount'];
        elseif($get_installment_number==3):

        endif;
        $custom_first_installment=$part_payments['adv_amount'];
        $custom_second_installment=$part_payments['first_part_amount'];
        $custom_third_installment=$part_payments['second_part_amount'];

        endif;

        $pay_now=$custom_remaining;
        $due_amount=0;
        if($amount_type=='part')
        {
        $pay_now=$custom_last;
        $due_amount=$custom_remaining-$custom_last;   
        }

        if($coupon_data->type=='Percentage'):
            $percentage=$coupon_data->value;
            $total_amount=$price_data_first['query_total_group'];
            $after_dis_amount=$total_amount*$percentage/((int)$percentage+(int)100);
        else:
            $after_dis_amount=$coupon->value;
        endif;
        $custom_offer_show='<div class="flexOne">
                                <p class="CouponColor capText flexCenter">'.$coupon_data->coupon_name.'
                                    <a href="#" class="pointer">
                                        <span class="deleteIcon apndLeft5 coupon_remove" style="margin-top: -8px;" id="'.CustomHelpers::custom_encrypt($coupon_data->id).'">x</span>
                                    </a>
                                </p>
                                <p class="offerTag colorA1">'.$coupon_data->coupon_desc.'</p>
                            </div>
                            <div class="font12 noShrink CouponColor"><span class="defaultCurencyPay"></span>&nbsp;'.number_format($after_dis_amount,0).'</div>';
        endif;

        $total_fee_taxes=$gst_amount+$tcs_amount+$booking_amount;
        if(Session::has($unique_code.'coupon_id'))
         {
        Session::forget($unique_code.'coupon_id');
         }
        Session::set($unique_code.'coupon_id',0);
        foreach($coupons as $coupon):
        if($coupon->id==$id && $type=='coupon'):
              $coupn_output.='<label class="couponsOuter active undefined">';

            else:
                  $coupn_output.='<label class="couponsOuter undefined">';
                 endif;
                     if($coupon->id==$id && $type=='coupon'):
              $coupn_output.='<span class="reviewSprite greenTick"></span>';
               if(Session::has($unique_code.'coupon_id'))
                        {
                      Session::forget($unique_code.'coupon_id');
                        }
                     Session::set($unique_code.'coupon_id',$coupon->id);
                   endif; 
                        $coupn_output.='<div class="couponOfferBox flexOne">
                         
                            <div class="makeflex spaceBetween flexOne">
                                <div class="flexOne">
                                    <p class="couponName">'.$coupon->coupon_name.'</p>';
                                    if($coupon->id==$id && $type=='coupon'):
                                        $coupn_output.=' <p class="couponDesc description">Coupon applied successfully</p>';
                                        $coupn_output.='</div>
                                <span class="latoBlack font11 linkText capText unique coupon_remove" id="'.CustomHelpers::custom_encrypt($coupon->id).'">Remove</span>
                            </div>
                            <p class="couponPrice"><span>-';
                                    else:
                                        $coupn_output.=' <p class="couponDesc description">'.$coupon->coupon_desc.'</p>';
                                        $coupn_output.='</div>
                                <span class="latoBlack font11 linkText capText unique coupon_apply" id="'.CustomHelpers::custom_encrypt($coupon->id).'">Apply</span>
                            </div>
                            <p class="couponPrice"><span>-';
                                    endif;
                                   
                                

                                if($coupon->type=='Percentage'):
                                 
                $percentage=$coupon->value;
                $total_amount=$price_data_first['query_total_group'];
                $after_dis_amount=$total_amount*$percentage/100;
                                 
                                else:

              
                $after_dis_amount=$coupon->value;
                              
                                endif;
                 $coupn_output.='₹'.number_format($after_dis_amount,0).'  
                           </span></p>
                        </div>
                        </label>';
                        endforeach;
        if(Session::has($unique_code.'custom_remaining'))
         {
        Session::forget($unique_code.'custom_remaining');
         }
          if(Session::has($unique_code.'custom_last'))
         {
        Session::forget($unique_code.'custom_last');
         }
         if(Session::has($unique_code.'total_quote_amount'))
         {
        Session::forget($unique_code.'total_quote_amount');
         }
         Session::set($unique_code.'total_quote_amount',$grand_total);
        Session::set($unique_code.'custom_remaining',$custom_remaining);
        Session::set($unique_code.'custom_last',$custom_last);
        $output=['coupn_output'=>$coupn_output,'gst_amount'=>number_format($gst_amount,0),'tcs_amount'=>number_format($tcs_amount,0),'booking_amount'=>number_format($booking_amount,0),'grand_total'=>number_format($grand_total,0),'total_fee_taxes'=>number_format($total_fee_taxes,0),'custom_discount_coupn'=>number_format($custom_discount_coupn,0),'custom_offer_show'=>$custom_offer_show,'custom_remaining'=>number_format($custom_remaining,0),'custom_last'=>number_format($custom_last,0),'pay_now'=>number_format($pay_now,0),'due_amount'=>number_format($due_amount,0),'custom_first_installment'=>number_format($custom_first_installment,0),'custom_second_installment'=>number_format($custom_second_installment,0),'custom_third_installment'=>number_format($custom_third_installment,0)];
        return $output;
    }*/

    // coupon apply
    public function coupon_apply(Request $request)
    {
        // Extract request parameters
        $unique_code = $request->unique_code;
        $id = CustomHelpers::custom_decrypt($request->id);
        $type = $request->type;
        $amount_type = $request->amount_type;

        // Fetch valid coupons
        $now = date('Y-m-d');
        $coupons = Coupon::where([
            ['end_date', '>=', $now],
            ['start_date', '<=', $now]
        ])->whereIn('applicable_for', [1, 2, 4])->get();

        $coupn_output = '';

        // Fetch quote IDs from session
        $quote_no = Session::get($unique_code . 'quoteno');
        $quote1_id = Session::get($unique_code . 'quote1_id');
        $quote2_id = Session::get($unique_code . 'quote2_id');
        $quote3_id = Session::get($unique_code . 'quote3_id');
        $quote4_id = Session::get($unique_code . 'quote4_id');

        // Determine quote data based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote1_id);
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
        } elseif ($quote_no == 2) {
            $data = Option2Quotation::find((int)$quote2_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote3_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote4_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }

        // Calculate remaining amount and installment number
        $price_data_first = CustomHelpers::get_price_part_seperate(
            $data->option1_price,
            $data->quote1_number_of_adult,
            $data->extra_adult,
            $data->child_with_bed,
            $data->child_without_bed,
            $data->infant,
            $data->solo_traveller
        );
        $remaining_amount = CustomHelpers::get_remaining_amount(
            $price_data['query_pricetopay_adult'],
            $unique_code
        );
        $get_installment_number = CustomHelpers::get_installment_number(
            $price_data['query_pricetopay_adult'],
            $unique_code
        );

            $price_data_first=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
                   $adult=$data->quote1_number_of_adult;
                   $extra_adult=$data->extra_adult;
                   $child_with_bed=$data->child_with_bed;
                   $child_without_bed=$data->child_without_bed;
                   $infant=$data->infant;
                   $solo_traveller=$data->solo_traveller;

        // Initialize variables
        $gst_amount = $price_data_first['query_total_gst_group'];
        $tcs_amount = $price_data_first['query_total_tcs_group'];
        $booking_amount = $price_data_first['query_total_pg_group'];
        $grand_total = $price_data_first['query_pricetopay_adult'];
        $custom_discount_coupn = $price_data_first['query_total_discount_group'];

        // Process based on coupon type
        if ($type == 'coupon_remove' && $price_data_first['pricediscountnegative'] == 3 && CustomHelpers::get_check_payment_status($quote_ref_no) == 0) {
            $remove_price = unserialize($data->option1_price);
            $remove_price['pricediscountnegative'] = 3;
            $remove_price['discount_coupon'] = 0;

            $price_data_first = CustomHelpers::get_price_part_seperate(
                serialize($remove_price),
                $data->quote1_number_of_adult,
                $data->extra_adult,
                $data->child_with_bed,
                $data->child_without_bed,
                $data->infant,
                $data->solo_traveller
            );

            // Update variables
            $gst_amount = $price_data_first['query_total_gst_group'];
            $tcs_amount = $price_data_first['query_total_tcs_group'];
            $booking_amount = $price_data_first['query_total_pg_group'];
            $grand_total = $price_data_first['query_pricetopay_adult'];
            $custom_discount_coupn = $price_data_first['query_total_discount_group'];
            $remaining_amount = $price_data_first['query_pricetopay_adult'];
        } else {
            $custom_discount_coupn = $price_data_first['query_total_discount_group'];
        }

        // Additional offer details
        $custom_offer_show = '';
        $custom_last = 0;
        $custom_first_installment = 0;
        $custom_second_installment = 0;
        $custom_third_installment = 0;

        // Handle part payment if enabled
        Session::set($unique_code . 'get_installment_number', 'full');
        if ($data->partPayment == 1) {
            $part_payments = unserialize($data->part_payments);

            // Determine installment details based on installment number
            if ($get_installment_number == 0) {
                $custom_last = (float)$part_payments['adv_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
                if (Session::has($unique_code . 'get_installment_number')) {
                    Session::forget($unique_code . 'get_installment_number');
                }
                Session::set($unique_code . 'get_installment_number', 1);
            } elseif ($get_installment_number == 1) {
                $custom_last = (float)$part_payments['first_part_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
                if (Session::has($unique_code . 'get_installment_number')) {
                    Session::forget($unique_code . 'get_installment_number');
                }
                Session::set($unique_code . 'get_installment_number', 2);
            } elseif ($get_installment_number == 2) {
                $custom_last = (float)$part_payments['second_part_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
                if (Session::has($unique_code . 'get_installment_number')) {
                    Session::forget($unique_code . 'get_installment_number');
                }
                Session::set($unique_code . 'get_installment_number', 3);
            }
            $custom_first_installment = (float)$part_payments['adv_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
            $custom_second_installment = (float)$part_payments['first_part_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
            $custom_third_installment = (float)$part_payments['second_part_percentage'] * (float)$price_data_first['query_pricetopay_adult'] / 100;
        }

        // Calculate pay now and due amount based on payment type
        $pay_now = $remaining_amount;
        $due_amount = 0;
        if ($amount_type == 'part') {
            $pay_now = $custom_last;
            $due_amount = $remaining_amount - $custom_last;
        }
        $custom_remaining=$remaining_amount;

        // Apply coupon if valid and update price details
        if ($type == 'coupon' && CustomHelpers::get_check_payment_status($quote_ref_no) == 0) {
            $price = $data->option1_price;
            $new_price = unserialize($data->option1_price);
            $coupon_data = Coupon::find($id);
            $new_price['pricediscountnegative'] = 3;
            $new_price['discount_coupon'] = $coupon_data->value;
            $new_price['coupon_id'] = $id;

            // Update price details
            $price_data_first = CustomHelpers::get_price_part_seperate(
                serialize($new_price),
                $data->quote1_number_of_adult,
                $data->extra_adult,
                $data->child_with_bed,
                $data->child_without_bed,
                $data->infant,
                $data->solo_traveller
            );

            // Update variables
            $gst_amount = $price_data_first['query_total_gst_group'];
            $tcs_amount = $price_data_first['query_total_tcs_group'];
            $booking_amount = $price_data_first['query_total_pg_group'];
            $grand_total = $price_data_first['query_pricetopay_adult'];
            $custom_discount_coupn = $price_data_first['query_total_discount_group'];
            $remaining_amount = $price_data_first['query_pricetopay_adult'];

            // Calculate and update price based on coupon value
            $divide_val = $coupon_data->value + 100;
            $booking_amount = $price_data_first['query_total_pg_group'];
            $grand_total = $price_data_first['query_total_group'];
            $custom_discount_coupn =         $price_data_first['query_total_group'] * $coupon_data->value / $divide_val;
            $custom_remaining = $price_data_first['query_pricetopay_adult'];

            // Reset installment details
            $custom_last = 0;
            $custom_first_installment = 0;
            $custom_second_installment = 0;
            $custom_third_installment = 0;

            // Handle part payment if enabled
            if ($data->partPayment == 1) {
                $part_payments = CustomHelpers::part_payments($data->part_payments, $custom_remaining);

                // Determine installment details based on installment number
                if ($get_installment_number == 0) {
                    $custom_last = $part_payments['adv_amount'];
                } elseif ($get_installment_number == 1) {
                    $custom_last = $part_payments['first_part_amount'];
                } elseif ($get_installment_number == 2) {
                    $custom_last = $part_payments['second_part_amount'];
                }
                $custom_first_installment = $part_payments['adv_amount'];
                $custom_second_installment = $part_payments['first_part_amount'];
                $custom_third_installment = $part_payments['second_part_amount'];
            }

            // Calculate pay now and due amount based on payment type
            $pay_now = $custom_remaining;
            $due_amount = 0;
            if ($amount_type == 'part') {
                $pay_now = $custom_last;
                $due_amount = $custom_remaining - $custom_last;
            }

            // Calculate discount based on coupon type
            if ($coupon_data->type == 'Percentage') {
                $percentage = $coupon_data->value;
                $total_amount = $price_data_first['query_total_group'];
                $after_dis_amount = $total_amount * $percentage / ((int)$percentage + (int)100);
            } else {
                $after_dis_amount = $coupon->value;
            }

            // Format custom offer display
            $custom_offer_show = '<div class="flexOne">
                <p class="CouponColor flexCenter">' . $coupon_data->coupon_name . '
                    <a href="#" class="pointer">
                        <span class="deleteIcon apndLeft5 coupon_remove" id="' . CustomHelpers::custom_encrypt($coupon_data->id) . '">x</span>
                    </a>
                </p>
                <p class="offerTag colorA1">' . $coupon_data->coupon_desc . '</p>
            </div>
            <div class="font12 noShrink CouponColor">
                <span class="defaultCurencyPay"></span>&nbsp;' . number_format($after_dis_amount, 0) . '
            </div>';
        }

        // Calculate total fees and taxes
        $total_fee_taxes = $gst_amount + $tcs_amount + $booking_amount;

        // Set session variables
        if (Session::has($unique_code . 'coupon_id')) {
            Session::forget($unique_code . 'coupon_id');
        }
        Session::set($unique_code . 'coupon_id', 0);

        // Build coupon output
        foreach ($coupons as $coupon) {
            if ($coupon->id == $id && $type == 'coupon') {
                $coupn_output .= '<label class="couponsOuter active undefined">';
            } else {
                $coupn_output .= '<label class="couponsOuter undefined">';
            }

            // Add review sprite if coupon applied
            if ($coupon->id == $id && $type == 'coupon') {
                $coupn_output .= '<span class=""></span>';
                if (Session::has($unique_code . 'coupon_id')) {
                    Session::forget($unique_code . 'coupon_id');
                }
                Session::set($unique_code . 'coupon_id', $coupon->id);
            }

            // Build coupon details HTML
            $coupn_output .= '<div class="couponOfferBox flexOne">
                    <div class="makeflex spaceBetween flexOne">
                        <div class="flexOne">
                            <p class="couponName">' . $coupon->coupon_name . '</p>';

            // Add description based on coupon application
            if ($coupon->id == $id && $type == 'coupon') {
                $coupn_output .= ' <p class="couponDesc">Coupon applied successfully</p>
                                    <p class="couponDesc">' . $coupon->coupon_desc . '</p>';
                $coupn_output .= '</div>
                        <span class="couponBtn textUppercase unique coupon_remove" id="' . CustomHelpers::custom_encrypt($coupon->id) . '">Remove</span>
                    </div>
                    <p class="couponPrice"><span>-';
            } else {
                $coupn_output .= ' <p class="couponDesc">' . $coupon->coupon_desc . '</p>';
                $coupn_output .= '</div>
                        <span class="couponBtn textUppercase unique coupon_apply" id="' . CustomHelpers::custom_encrypt($coupon->id) . '">Apply</span>
                    </div>
                    <p class="couponPrice"><span>-';
            }

            // Calculate and append discount amount
            if ($coupon->type == 'Percentage') {
                $percentage = $coupon->value;
                $total_amount = $price_data_first['query_total_group'];
                $after_dis_amount = $total_amount * $percentage / ((int)$percentage + (int)100);
            } else {
                $after_dis_amount = $coupon->value;
            }

            $coupn_output .= '₹' . number_format($after_dis_amount, 0) . '
                        </span></p>
                    </div>
                </label>';
        }

        // Set session variables for further calculations
        if (Session::has($unique_code . 'custom_remaining')) {
            Session::forget($unique_code . 'custom_remaining');
        }
        if (Session::has($unique_code . 'custom_last')) {
            Session::forget($unique_code . 'custom_last');
        }
        if (Session::has($unique_code . 'total_quote_amount')) {
            Session::forget($unique_code . 'total_quote_amount');
        }
        Session::set($unique_code . 'total_quote_amount', $grand_total);
        Session::set($unique_code . 'custom_remaining', $custom_remaining);
        Session::set($unique_code . 'custom_last', $custom_last);

        // Prepare output array
        $output = [
            'coupn_output' => $coupn_output,
            'gst_amount' => number_format($gst_amount, 0),
            'tcs_amount' => number_format($tcs_amount, 0),
            'booking_amount' => number_format($booking_amount, 0),
            'grand_total' => number_format($grand_total, 0),
            'total_fee_taxes' => number_format($total_fee_taxes, 0),
            'custom_discount_coupn' => number_format($custom_discount_coupn, 0),
            'custom_offer_show' => $custom_offer_show,
            'custom_remaining' => number_format($custom_remaining, 0),
            'custom_last' => number_format($custom_last, 0),
            'pay_now' => number_format($pay_now, 0),
            'due_amount' => number_format($due_amount, 0),
            'custom_first_installment' => number_format($custom_first_installment, 0),
            'custom_second_installment' => number_format($custom_second_installment, 0),
            'custom_third_installment' => number_format($custom_third_installment, 0)
        ];

        // Return output array
        return $output;
    }

    /*-------- Payment --------*/

    /*// part payment type
    public function part_payment_type(Request $request)
    {
        $unique_code=$request->unique_code;
        $amount_type=$request->amount_type;  
        $custom_remaining=Session::get($unique_code.'custom_remaining'); 
        $custom_last=Session::get($unique_code.'custom_last'); 

        $pay_now=$custom_remaining;
        $due_amount=0;

        if($amount_type=='part')
        {
        $pay_now=$custom_last;
        $due_amount=$custom_remaining-$custom_last;   
        }

        $output=['pay_now'=>number_format($pay_now,0),'due_amount'=>number_format($due_amount,0)];
        return $output;
    }*/

    // part payment type
    public function part_payment_type(Request $request)
    {
        $unique_code = $request->unique_code;
        $amount_type = $request->amount_type;
        
        // Retrieve session variables
        $custom_remaining = Session::get($unique_code . 'custom_remaining');
        $custom_last = Session::get($unique_code . 'custom_last');

        // Initialize variables
        $pay_now = $custom_remaining;
        $due_amount = 0;

        // Calculate payment amounts based on amount type ('part' or 'full')
        if ($amount_type == 'part') {
            $pay_now = $custom_last;
            $due_amount = $custom_remaining - $custom_last;
        }

        // Prepare output array
        $output = [
            'pay_now' => number_format($pay_now, 0),
            'due_amount' => number_format($due_amount, 0)
        ];

        return $output;
    }

    // customised payment calculation
    public function get_custom_pay_calculation(Request $request)
    {
        $unique_code = $request->unique_code;
        $total_quote_amount = Session::get($unique_code . 'total_quote_amount');  
        $total_quote_amount = CustomHelpers::get_remaining_amount($total_quote_amount, $unique_code);
        $amount = $request->amount;
        $due_amount = (int)$total_quote_amount - (int)$amount;

        echo $due_amount;
    }

    // full payment calculation
    public function get_full_pay_calculation(Request $request)
    {
        $unique_code = $request->unique_code;
        $total_quote_amount = Session::get($unique_code . 'total_quote_amount'); 

        $total_quote_amount = CustomHelpers::get_remaining_amount($total_quote_amount, $unique_code);

        echo $total_quote_amount;
    }

    // save payment
    public function payment_store(Request $request)
    {
        $unique_code = $request->unique_code;
        $mode_id = $request->mode_id;
        $order_id = time();
        $amount = CustomHelpers::get_quote_amount($unique_code, $mode_id, $order_id);

        $data_for_request = $this->handlePaytmRequest($order_id, $amount);
        $paytm_txn_url = env('TXN_URL');
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        
        return view("payment.merchantform", compact('paytm_txn_url', 'paramList', 'checkSum'));
    }

    /*-------- Paytm Payment Gateway --------*/

    // paytm call back
    public function paytmcallback(Request $request)
    {
        $order_id = $request['ORDERID'];
        if ('TXN_SUCCESS' === $request['STATUS']) {
            $data_payment = CustomHelpers::after_success_payment($order_id, $request['TXNID'], $request['PAYMENTMODE'], $request['TXNDATE'], $request['BANKTXNID'], $request['BANKNAME']);

            return view("payment.success", compact('data_payment'));
        } elseif ('TXN_FAILURE' === $request['STATUS']) {
            $data_payment = Payment::where('order_id', $order_id)->first();
            $user_ids = $data_payment->payment_user_id;
            
            if ($user_ids != 0) {
                $user = Sentinel::findById($user_ids);
                Sentinel::login($user);
            }

            return view("payment.fail", compact('data_payment'));
        }
    }

    // handle Paytm request
    public function handlePaytmRequest($order_id, $amount) 
    {
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();
        $checkSum = "";
        $paramList = array();

        // Create an array having all required parameters for creating checksum
        $paramList["MID"] = CustomHelpers::get_gateway_settings(1)['mid'];
        $paramList["ORDER_ID"] = $order_id;

        // Set customer ID based on user login status
        if (Sentinel::check()) {
            $paramList["CUST_ID"] = Sentinel::getUser()->id; 
        } else {
            $paramList["CUST_ID"] = '';   
        }

        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = 'WEBSTAGING';
        $paramList["CALLBACK_URL"] = url('/paytm-callback');

        $paytm_merchant_key = CustomHelpers::get_gateway_settings(1)['mkey'];

        // Generate checksum using getChecksumFromArray function
        $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);

        return [
            'checkSum' => $checkSum,
            'paramList' => $paramList
        ];
    }

    function getAllEncdecFunc()
    {
        function encrypt_e($input, $ky) 
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function decrypt_e($crypt, $ky) 
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function generateSalt_e($length) 
        {
            $random = "";
            srand((double) microtime() * 1000000);
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";
            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }
            return $random;
        }

        function checkString_e($value) 
        {
            if ($value == 'null') {
                $value = '';
            }
            return $value;
        }

        function getChecksumFromArray($arrayList, $key, $sort = 1) 
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function getChecksumFromString($str, $key) 
        {
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function verifychecksum_e($arrayList, $key, $checksumvalue) 
        {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function verifychecksum_eFromStr($str, $key, $checksumvalue) 
        {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function getArray2Str($arrayList) 
        {
            $findme = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function getArray2StrForVerify($arrayList) 
        {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function redirect2PG($paramList, $key) 
        {
            $hashString = getchecksumFromArray($paramList);
            $checksum = encrypt_e($hashString, $key);
        }

        function removeCheckSumParam($arrayList) 
        {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }

        function getTxnStatus($requestParamList) 
        {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }

        function getTxnStatusNew($requestParamList) 
        {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }

        function initiateTxnRefund($requestParamList) 
        {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }

        function callAPI($apiURL, $requestParamList) 
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData)
            ));
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }

        function callNewAPI($apiURL, $requestParamList) 
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData)
            ));
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }

        function getRefundChecksumFromArray($arrayList, $key, $sort = 1) 
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function getRefundArray2Str($arrayList) 
        {
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function callRefundAPI($refundApiURL, $requestParamList) 
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }

    // Paytm settings
    function getConfigPaytmSettings() 
    {
        /*
        - Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
        - Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
        - Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
        - Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
        - Above details will be different for testing and production environment.
        */

        define('PAYTM_ENVIRONMENT', CustomHelpers::get_gateway_settings(1)['environment']); // PROD or TEST
        define('PAYTM_MERCHANT_KEY', CustomHelpers::get_gateway_settings(1)['mkey']); // Merchant key received from Paytm
        define('PAYTM_MERCHANT_MID', CustomHelpers::get_gateway_settings(1)['mid']); // Merchant ID (MID) received from Paytm
        define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); // Website name received from Paytm for testing

        $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL = 'https://securegw-stage.paytm.in/theia/processTransaction';

        // production environment
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL = 'https://securegw.paytm.in/theia/processTransaction';
        }

        define('PAYTM_REFUND_URL', ''); // Set appropriate refund URL if needed
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL); // Set status query URL
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL); // Set new status query URL
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL); // Set transaction URL
    }
}