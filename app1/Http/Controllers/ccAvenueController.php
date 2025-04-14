<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use DateTime;
use DatePeriod;
use DateInterval;
use App\RoomBooking;
use App\Http\Controllers\MailController;
use Carbon\Carbon;

class ccAvenueController extends Controller
{
    public  function pkcs5_pad ($plainText, $blockSize){
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}
	//********** Hexadecimal to Binary function for php 4.0 version ********
	public function hextobin($hexString){
		$length = strlen($hexString);
		$binString="";
		$count=0;
			while($count<$length){
				$subString =substr($hexString,$count,2);
				$packedString = pack("H*",$subString);
				if ($count==0){
					$binString=$packedString;
				}else{
					$binString.=$packedString;
				}
			$count+=2;
		}
		return $binString;
    }
    /* Crypto.php Data Starts */
    public function encrypt($plainText,$key){
		$secretKey =  $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1)
		{
		    $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	mcrypt_generic_deinit($openMode);
		}
		return bin2hex($encryptedText);
	}
	public function decrypt($encryptedText,$key){
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
	}
	//*********** Padding Function *********************
    /* Crypto.php Data Ends */
    public function ccRequest(Request $request){
      // echo 'test';die;
        //return response()->json($request->merchant_id);
        $merchant_data='';
        $working_key='5213B8F4E6135396B994FA747E216FEF';//Shared by CCAVENUES
        $access_code='AVXO76FC73AS72OXSA';//Shared by CCAVENUES
        foreach ($_POST as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
       // echo $merchant_data;
        echo $this->encrypt($merchant_data,$working_key);
    }
    public function ccResponse(Request $request){
        $workingKey='5213B8F4E6135396B994FA747E216FEF';		//Working Key should be provided here.
        $encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
        $rcvdString=$this->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        // echo "<pre>";
        // print_r( $decryptValues);
        $dataSize=sizeof($decryptValues); // Size of array
        for($i = 0; $i < $dataSize; $i++){
            $information=explode('=',$decryptValues[$i]);
            if($i==0)	$order_id = $information[1];
            if($i==1)	$tracking_id = $information[1];
            if($i==3)	$order_status = $information[1];
            if($i==5)	$payment_mode = $information[1];
            if($i==9)	$currency = $information[1];
            if($i==10)	$paidAmount = $information[1];
            if($i==11)	$billingName = $information[1];
            if($i==12)	$billingAddress = $information[1];
            if($i==13)	$billingCity = $information[1];
            if($i==14)	$billingState = $information[1];
            if($i==15)	$billingZip = $information[1];
            if($i==16)	$billingCountry = $information[1];
            if($i==17)	$billingTel = $information[1];
            if($i==18)	$billingEmail = $information[1];
            if($i==27)	$customerId = $information[1];
            if($i==28)	$roomDetails = $information[1];
            if($i==29)	$dates = $information[1];
            if($i==30)	$amount = $information[1];
            if($i==40)	$transactionDate = $information[1];
        }
        // Get param data
        //$ids = explode(',',$ids);
        $roomDetails = explode(',',$roomDetails);
        $dates = explode(',',$dates);
        $amount = explode(',',$amount);
        // param data to Array
        $hotelBookingParamDetail = array(
            'customerId' =>$customerId,
            'noOfBookedRooms' =>$roomDetails[0],
            'noOfAdults' =>$roomDetails[1],
            'noOfChilds' =>$roomDetails[2],
            'hotelId' =>$roomDetails[3],
            'roomId' =>$roomDetails[4],
            'checkInDate' =>$dates[0],
            'checkOutDate' =>$dates[1],
            'noOfNights' =>$dates[2],
            'totalAmount' =>$amount[0],
            'pendingAmount' =>$amount[1],
            'paidAmount' =>$amount[2],
            'taxAmount' =>$amount[3],
            'cca_order_id' => $order_id,
            'cca_tracking_id' => $tracking_id,
            'cca_order_status' => $order_status,
            'cca_payment_mode' => $payment_mode,
            'cca_currency' => $currency,
            'cca_paidAmount' => $paidAmount,
            'cca_billingName' => $billingName,
            'cca_billingAddress' => $billingAddress,
            'cca_billingCity' => $billingCity,
            'cca_billingState' => $billingState,
            'cca_billingZip' => $billingZip,
            'cca_billingCountry' => $billingCountry,
            'cca_billingTel' => $billingTel,
            'cca_billingEmail' => $billingEmail,
            'cca_transactionDate' => $transactionDate
        );
        $period = new DatePeriod(
            new DateTime(date("Y-m-d H:i:s",strtotime($hotelBookingParamDetail['checkInDate']))),
            new DateInterval('P1D'),
            new DateTime(date("Y-m-d H:i:s",strtotime($hotelBookingParamDetail['checkOutDate'])))
        );
        foreach ($period as $key => $value) {
            $checkInDateInt = $value->format('Y-m-d H:i:s');
        // Save Booking to Database
            $booking = new RoomBooking;
            $booking->hotelId = $hotelBookingParamDetail['hotelId'];
            $booking->roomId = $hotelBookingParamDetail['roomId'];
            $booking->customerId = $hotelBookingParamDetail['customerId'];
            $booking->noOfBookedRooms = $hotelBookingParamDetail['noOfBookedRooms'];
            $booking->noOfAdults = $hotelBookingParamDetail['noOfAdults'];
            $booking->noOfChilds = $hotelBookingParamDetail['noOfChilds'];
            $booking->checkInDate = $checkInDateInt;
            $booking->checkOutDate = date("Y-m-d H:i:s",strtotime($hotelBookingParamDetail['checkOutDate']));
            $booking->totalAmount = $hotelBookingParamDetail['totalAmount'];
            $booking->pendingAmount = $hotelBookingParamDetail['pendingAmount'];
            $booking->paidAmount = $hotelBookingParamDetail['paidAmount'];
            $booking->taxAmount = $hotelBookingParamDetail['taxAmount'];
            $booking->bookingStatus = 'upcoming';
            $booking->cca_order_id =  $order_id;
            $booking->cca_tracking_id =  $tracking_id;
            $booking->cca_order_status =  $order_status;
            $booking->cca_payment_mode =  $payment_mode;
            $booking->cca_currency =  $currency;
            $booking->cca_paidAmount =  $paidAmount;
            $booking->cca_billingName =  $billingName;
            $booking->cca_billingAddress = $billingAddress;
            $booking->cca_billingCity = $billingCity;
            $booking->cca_billingState = $billingState;
            $booking->cca_billingZip = $billingZip;
            $booking->cca_billingCountry = $billingCountry;
            $booking->cca_billingTel = $billingTel;
            $booking->cca_billingEmail = $billingEmail;
            $booking->cca_transactionDate = $transactionDate;
            //dd($booking);
            $booking->save();
        }
        // Message according as Status
        // if($order_status==="Success"){
        //     $booking->save();
        //     $paymentStatus = "Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
        // }elseif($order_status==="Aborted"){
        //     $paymentStatus = "We will keep you posted regarding the status of your order through e-mail";
        // }elseif($order_status==="Failure"){
        //     $paymentStatus = "The transaction has been declined.";
        // }else{
            //$booking->save();
            $mail = new MailController;
            $mail->html_email($hotelBookingParamDetail,$billingName, $billingEmail);
            //$paymentStatus = "Security Error. Illegal access detected";
        // }
        //die;
       return view('hotels.confirmedBooking',[
            'hotelBookingDetail'=>$hotelBookingParamDetail
        ]);
    }
}