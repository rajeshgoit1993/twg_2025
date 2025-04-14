<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
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

class PhonepeController extends Controller
{
   
   public function phonepe(Request $request)
   {
   
     $unique_code=$request->unique_code;
     $mode_id=$request->mode_id;
     $order_id=time();
     $amount=CustomHelpers::get_quote_amount($unique_code,$mode_id,$order_id);

    $merchantId=CustomHelpers::get_gateway_settings(2)['mid'];
    $merchantkey=CustomHelpers::get_gateway_settings(2)['mkey'];
     $data = [
            "merchantId" => "$merchantId", 
            "merchantTransactionId" =>"$order_id", 
            "merchantUserId" => "MUID123", 
            "amount" => $amount*100, 
            "redirectUrl" => url('/phonepe-callback'), 
            "redirectMode" => "POST", 
            "callbackUrl" => url('/phonepe-callback'), 
            "mobileNumber" => "9999999999", 
            "paymentInstrument" => [
            "type" => "PAY_PAGE" 
                      ] 
        ]; 
     
     $encode = base64_encode(json_encode($data));

        $saltKey = $merchantkey;
        $saltIndex = 1;

        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'.$saltIndex;

        $response = Curl::to('https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay')
                ->withHeader('Content-Type:application/json')
                ->withHeader('X-VERIFY:'.$finalXHeader)
                ->withData(json_encode(['request' => $encode]))
                ->post();

        $rData = json_decode($response);

      


     return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
   }
   public function response(Request $request)
   {
      $input = $request->all();
       // dd($input);
      $merchantkey=CustomHelpers::get_gateway_settings(2)['mkey'];
        $saltKey = $merchantkey;
        $saltIndex = 1;

        $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;

        $response = Curl::to('https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
                ->withHeader('Content-Type:application/json')
                ->withHeader('accept:application/json')
                ->withHeader('X-VERIFY:'.$finalXHeader)
                ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
                ->get();
    $response_data=json_decode($response);
    if($response_data->code=='PAYMENT_SUCCESS')
    {
    $order_id=$response_data->data->merchantTransactionId;
    $transaction_id=$response_data->data->transactionId;
    $PAYMENTMODE=$response_data->data->paymentInstrument->type;
    $TXNDATE=date('Y-m-d');
    $BANKTXNID=$response_data->data->paymentInstrument->bankTransactionId;
    $bank_name=$response_data->data->paymentInstrument->bankId;  

    $data_payment=CustomHelpers::after_success_payment($order_id,$transaction_id,$PAYMENTMODE,$TXNDATE,$BANKTXNID,$bank_name);
             //
            
    return view("payment.success",compact('data_payment'));


    }
    else
    {
        $order_id=$response_data->data->merchantTransactionId;
     $data_payment = Payment::where( 'order_id', $order_id )->first();
         $user_ids=$data_payment->payment_user_id;
             if($user_ids!=0)
             {
           $user = Sentinel::findById($user_ids);
             Sentinel::login($user);
             }
        return view("payment.fail",compact('data_payment'));
    }
    // dd(json_decode($response));
   }
}
