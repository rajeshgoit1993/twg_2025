<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Sentinel;
use Validator;
use App\Packages;
use App\PackageUploads;
use App\countries;
use App\Icons;
use App\Testimonial;
use App\Locations;
use App\PakagesSeo;
use App\Helpers\CustomHelpers;
use App\Helpers\PackagePriceHelpers;
use App\PackageHotel;
use App\Mid_Image;
use Illuminate\Support\Facades\DB;
use Session;
use App\Gtags;
use App\Suitable;
use URL;
use App\PkgRatingType;
use App\QuoteCharges;
use App\Coupon;
use App\EnqueryOTPSetting;
use Illuminate\Support\Facades\Cache; // Laravel Cache (Cache::remember), application-level caching
use App\City;
use App\State;


class FrontController extends Controller 
{
    // window width
    /*public function check_window_width(Request $request)
    {
        if(Session::has('window_width')) {
            Session::forget('window_width');
        }
        $window_width=$request->window_width;
        Session::set('window_width',$window_width);
        echo Session::get('window_width');
    }*/

    public function check_window_width(Request $request)
    {
        // Validate the window_width
        $request->validate([
            'window_width' => 'required|integer|min:0',
        ]);

        // Check if window_width is already in the session, and forget it if so
        if (Session::has('window_width')) {
            Session::forget('window_width');
        }

        // Set the new window_width in the session
        $window_width = $request->window_width;
        Session::put('window_width', $window_width);

        // Return the window_width as a JSON response
        return response()->json(['window_width' => Session::get('window_width')]);
    }

    // ****************************************
    
    // tour new price
    function calendar_data_new($id1,$id2,Request $request)
    {
        $package_id=$id1;
        $package_type=$id2;
        $Packages = Packages::findOrFail($package_id);
        $pricediscounts = unserialize($Packages->newprices_discounts);
        $new_price=PackagePriceHelpers::get_package_new_price($Packages->newprices,$Packages->adult,$Packages->extra_adult,$Packages->child_with_bed,$Packages->child_without_bed,$Packages->infant,$Packages->solo_traveller);

        $type_of_package = $Packages->Price_type;
        $new_price['package_pricetopay_adult']=PackagePriceHelpers::get_price_by_packageType($type_of_package,$new_price['package_pricetopay_adult'],$Packages->adult,$Packages->extra_adult,$Packages->child_with_bed,$Packages->child_without_bed,$Packages->infant,$Packages->solo_traveller); 

        $start_date=[];
        if(count($pricediscounts)>0)
        {
        $datef="";
        $datet="";
        $total_f="";
        $total_price="";
        $cutt_off="";
        foreach($pricediscounts as $row=>$col):
        if(count($col)>=30)
        {
        if($col['package_rating']==$package_type)
        {
        $date_array=$col['datefrom'];
        foreach($date_array as $row_from=>$col_from)
        {
        $datefrom=$col['datefrom'][$row_from];
        $datefrom=explode("/", $datefrom);
        $datefrom_year=$datefrom["2"];
        $datefrom_day=$datefrom["0"];
        $datefrom_month=$datefrom["1"];
        $datefrom=($datefrom_year."-".$datefrom_month."-".$datefrom_day);
        $datefrom=date('Y-m-d', strtotime("-0 day", strtotime($datefrom)));
        $dateto=$col['dateto'][$row_from];
        $dateto=explode("/", $dateto);
        $dateto_year=$dateto["2"];
        $dateto_day=$dateto["0"];
        $dateto_month=$dateto["1"];
        $dateto=$dateto_year."-".$dateto_month."-".$dateto_day;
        $applicable_for=$col['applicable_for'][$row_from];
        if($applicable_for=='all')
        {
        $over_all_discount_type=$col['over_all_discount_type'][$row_from];
        if($over_all_discount_type==0)
        {
        $output_price=$new_price["package_pricetopay_adult"];
        }
        elseif($over_all_discount_type==2)
        {
        $precentage_discount_id=$col['normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $output_price=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($over_all_discount_type==3)
        {
        $coupon_discount_id=$col['coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $output_price=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $output_price=$new_price["package_pricetopay_adult"];
        }
        }
        elseif($applicable_for=='day_wise')
        {
        //for sunday
        $sunday_discount_type=$col['sunday_discount_type'][$row_from];
        if($sunday_discount_type==0)
        {
        $out_day['Sun']=0;
        }
        elseif($sunday_discount_type==2)
        {
        $precentage_discount_id=$col['sunday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Sun']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($sunday_discount_type==3)
        {
        $coupon_discount_id=$col['sunday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Sun']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Sun']=0;
        }
        //for monday
        $monday_discount_type=$col['monday_discount_type'][$row_from];
        if($monday_discount_type==0)
        {
        $out_day['Mon']=0;
        }
        elseif($monday_discount_type==2)
        {
        $precentage_discount_id=$col['monday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Mon']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($monday_discount_type==3)
        {
        $coupon_discount_id=$col['monday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Mon']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Mon']=0;
        }
        //for tuesday
        $tuesday_discount_type=$col['tuesday_discount_type'][$row_from];
        if($tuesday_discount_type==0)
        {
        $out_day['Tue']=0;
        }
        elseif($tuesday_discount_type==2)
        {
        $precentage_discount_id=$col['tuesday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Tue']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($tuesday_discount_type==3)
        {
        $coupon_discount_id=$col['tuesday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Tue']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Tue']=0;
        }
        //for wednesday
        $wednesday_discount_type=$col['wednesday_discount_type'][$row_from];
        if($wednesday_discount_type==0)
        {
        $out_day['Wed']=0;
        }
        elseif($wednesday_discount_type==2)
        {
        $precentage_discount_id=$col['wednesday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Wed']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($wednesday_discount_type==3)
        {
        $coupon_discount_id=$col['wednesday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Wed']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Wed']=0;
        }
        //for thursday
        $thursday_discount_type=$col['thursday_discount_type'][$row_from];
        if($thursday_discount_type==0)
        {
        $out_day['Thu']=0;
        }
        elseif($thursday_discount_type==2)
        {
        $precentage_discount_id=$col['thursday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Thu']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($thursday_discount_type==3)
        {
        $coupon_discount_id=$col['thursday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Thu']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Thu']=0;
        }
        //for friday
        $friday_discount_type=$col['friday_discount_type'][$row_from];
        if($friday_discount_type==0)
        {
        $out_day['Fri']=0;
        }
        elseif($friday_discount_type==2)
        {
        $precentage_discount_id=$col['friday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Fri']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($friday_discount_type==3)
        {
        $coupon_discount_id=$col['friday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Fri']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Fri']=0;
        }
        //for saturday
        $saturday_discount_type=$col['saturday_discount_type'][$row_from];
        if($saturday_discount_type==0)
        {
        $out_day['Sat']=0;
        }
        elseif($saturday_discount_type==2)
        {
        $precentage_discount_id=$col['saturday_normal_discount'][$row_from];
        $discunt_negative=QuoteCharges::find($precentage_discount_id);
        $discount_percentage=$discunt_negative->value;
        $out_day['Sat']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$discount_percentage/100));
        }
        elseif($saturday_discount_type==3)
        {
        $coupon_discount_id=$col['saturday_coupon_discount'][$row_from];
        $coupon=Coupon::find($coupon_discount_id);
        $coupon_percentage=$coupon->value;
        $out_day['Sat']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
        }
        else
        {
        $out_day['Sat']=0;
        }
        }
        else
        {
        $output_price=$new_price["package_pricetopay_adult"];
        }
        $total_f.=$new_price["package_pricetopay_adult"].",";
        $total_price.=$new_price["package_pricetopay_adult"].",";
        $datef.=$datefrom.",";
        $datet.=$dateto.",";
        $cutt_off=$col['cuttoffpoint'][$row_from];
        $today=date('Y-m-d');
        $limit_days=date("Y-m-d" , strtotime($today. "+$cutt_off days "));
        while (strtotime($datefrom) <= strtotime($dateto))
        {
        if(strtotime($datefrom)>=strtotime($limit_days))
        {
        $start_date[]=$datefrom;
        }
        if($applicable_for=='all')
        {
        $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$output_price);
        }
        elseif($applicable_for=='day_wise')
        {
        $day = date('D', strtotime($datefrom));
        $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$out_day[$day]);
        }
        else
        {
        $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$output_price);
        }
        $datefrom = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom)));
        }
        }
        }
        }
        endforeach;
        $total_price=explode(",", $total_price);
        $datef=explode(",", $datef);
        $total_f=explode(",", $total_f);
        $datet=explode(",", $datet);
        $date_f_count=(count($datef)-1);
        // for($i=0;$i<$date_f_count;$i++)
        //    {
        //        while (strtotime($datef[$i]) <= strtotime($datet[$i]))
        //           {
        //    //echo date('Y-m-d', strtotime("-1 day", strtotime($datef[$i])))."<br><br>";
        //     $daterange[]=array( 'date'=>strtotime($datef[$i]),'price'=>"$total_f[$i]");
        //     $datef[$i] = date ("Y-m-d", strtotime("+1 day", strtotime($datef[$i])));
        //           }
        //    }
        sort($start_date);
        if(count($start_date)>0)
        {
        $start_d=$start_date[0];
        }
        else
        {
        $start_d=date("Y-m-d");
        }
        // if($cutt_off!=""):
        //   $start=date("Y-m-d" , strtotime($start_d. "+$cutt_off days "));
        //  else:
        //   $start=$start_d;
        //  endif;
        $start=$start_d;
        $end=date('Y-m-d', strtotime($start_d. '+1 year'));
        while (strtotime($start) <= strtotime($end))
        {
        $key = array_search(strtotime($start), array_column($daterange, 'date'));
        if ($key !== false)
        {
        $key = array_search(strtotime($start), array_column($daterange, 'date'));
        // echo $key;
        //  echo '<br>';
        if($daterange[$key]['price']!='' && $daterange[$key]['price']!=0)
        {
        $calendar_price[]=array(
        'className'=>['price_data'],
        'title'=>$daterange[$key]['price'],
        'start'=>$start);
        }
        else
        {
        $calendar_price[]=array(
        'className'=>['query_data'],
        'title'=>'',
        'start'=>$start);
        }
        }
        else
        {
        $calendar_price[]=array(
        'className'=>['query_data'],
        'title'=>'Send Query',
        'start'=>$start);
        }
        //   if(array_search(strtotime('2023-09-01'), array_column($daterange, 'date')))
        //   {
        //   //$key = array_search(strtotime($start), array_column($daterange, 'date'));
        // $key = array_search(strtotime($start), array_column($daterange, 'date'));
        // // echo $key;
        // //  echo '<br>';
        // if($daterange[$key]['price']!='' && $daterange[$key]['price']!=0)
        // {
        //  $calendar_price[]=array(
        //   'className'=>['price_data'],
        //   'title'=>$daterange[$key]['price'],
        //   'start'=>$start);
        // }
        // else
        // {
        // $calendar_price[]=array(
        //   'className'=>['query_data'],
        //   'title'=>'',
        //   'start'=>$start);
        // }
        //    }
        //   else
        //   {
        //   $calendar_price[]=array(
        //   'className'=>['query_data'],
        //   'title'=>'Send Query',
        //   'start'=>$start);
        //   }
        $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
        }
        //print_r($calendar_price);
        $a=json_encode($calendar_price);
        return $a;
        // dd($date_f_count);
        }
        }
    
    function calendar_data($id1,$id2,$id3,$id4,Request $request)
    {
        //function calendar_data(Request $request)
        //{
        //$package_id=$request->package_id;
        //$array_count=$request->array_count;
        //$package_type=$request->package_type;
        $package_id=$id1;
        $array_count=$id2;
        $package_type=$id3;
        $pkg_type=$id4;
        if($pkg_type=="normal"):
        $datef="";
        $datet="";
        $total_f="";
        $cutt_off="";
        $Packages = Packages::findOrFail($package_id);
        $price = unserialize($Packages->pricing);
        for($i=0;$i<$array_count;$i++)
        {
        if($price[$i]["package_rating"]==$package_type)
        {
        $datefrom=$price[$i]["datefrom"];
        $datefrom=explode("/", $datefrom);
        $datefrom_year=$datefrom["2"];
        $datefrom_day=$datefrom["1"];
        $datefrom_month=$datefrom["0"];
        $datefrom=($datefrom_year."-".$datefrom_month."-".$datefrom_day);
        $datefrom=date('Y-m-d', strtotime("-1 day", strtotime($datefrom)));
        $dateto=$price[$i]["dateto"];
        $dateto=explode("/", $dateto);
        $dateto_year=$dateto["2"];
        $dateto_day=$dateto["1"];
        $dateto_month=$dateto["0"];
        $dateto=$dateto_year."-".$dateto_month."-".$dateto_day;
        //$total_fare=$price[$i]["adult_fare_total"];
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
        $total_fare="0";
        if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
        {
        $total_fare+=$air_currency*$air_fare_adult;
        }
        if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
        {
        $total_fare+=$hotel_currency*$hotel_fare_adult;
        }
        if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
        {
        $total_fare+=$tour_currency*$tour_fare_adult;
        }
        if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
        {
        $total_fare+=$transfer_currency*$transfer_fare_adult;
        }
        if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
        {
        $total_fare+=$visa_currency*$visa_fare_adult;
        }
        $total_f.=$total_fare.",";
        $datef.=$datefrom.",";
        $datet.=$dateto.",";
        $cutt_off=$price[$i]["cuttoffpoint"];
        }
        }
        /*echo $datefrom."<br>";
        echo $dateto."<br>";
        echo $total_fare."<br>";*/
        $datef=explode(",", $datef);
        $total_f=explode(",", $total_f);
        $datet=explode(",", $datet);
        $date_f_count=(count($datef)-1);
        //print_r($datef )."<br>";
        //print_r($total_f)."<br>";
        //print_r($datet)."<br>";
        for($i=0;$i<$date_f_count;$i++)
        {
        while (strtotime($datef[$i]) <= strtotime($datet[$i]))
        {
        //echo date('Y-m-d', strtotime("-1 day", strtotime($datef[$i])))."<br><br>";
        $daterange[]=array( 'date'=>strtotime($datef[$i]),'price'=>"$total_f[$i]");
        $datef[$i] = date ("Y-m-d", strtotime("+1 day", strtotime($datef[$i])));
        }
        }
        //print_r($daterange);
        //$key = array_search(strtotime("2018-06-20"), array_column($daterange, 'date'));
        //echo $daterange[$key]['price']."<br>";
        if($cutt_off!=""):
        $start=date("Y-m-d" , strtotime("+$cutt_off days "));
        else:
        $start=date("Y-m-d");
        endif;
        $end=date('Y-m-d', strtotime('+1 year'));
        while (strtotime($start) <= strtotime($end))
        {
        if(array_search(strtotime($start), array_column($daterange, 'date')))
        {
        //$key = array_search(strtotime($start), array_column($daterange, 'date'));
        $key = array_search(strtotime($start), array_column($daterange, 'date'));
        $calendar_price[]=array(
        'className'=>['price_data'],
        'title'=>$daterange[$key]['price'],
        'start'=>$start);
        }
        else
        {
        $calendar_price[]=array(
        'className'=>['query_data'],
        'title'=>'Send Query',
        'start'=>$start);
        }
        $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
        }
        //print_r($calendar_price);
        $a=json_encode($calendar_price);
        return $a;
        elseif($pkg_type=="upcoming"):
        $datef="";
        $datet="";
        $total_f="";
        $cutt_off="";
        $Packages = Packages::findOrFail($package_id);
        $price = unserialize($Packages->upcoming_pricing);
        for($i=0;$i<$array_count;$i++)
        {
        if($price[$i]["package_rating"]==$package_type)
        {
        $datefrom=$price[$i]["datefrom"];
        $datefrom=explode("/", $datefrom);
        $datefrom_year=$datefrom["2"];
        $datefrom_day=$datefrom["1"];
        $datefrom_month=$datefrom["0"];
        $datefrom=($datefrom_year."-".$datefrom_month."-".$datefrom_day);
        $datefrom=date('Y-m-d', strtotime("-1 day", strtotime($datefrom)));
        $dateto=$price[$i]["dateto"];
        $dateto=explode("/", $dateto);
        $dateto_year=$dateto["2"];
        $dateto_day=$dateto["1"];
        $dateto_month=$dateto["0"];
        $dateto=$dateto_year."-".$dateto_month."-".$dateto_day;
        //$total_fare=$price[$i]["adult_fare_total"];
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
        $total_fare="0";
        if($air_fare_adult!="" && $air_fare_adult!="0" && $air_currency!="NA")
        {
        $total_fare+=$air_currency*$air_fare_adult;
        }
        if($hotel_fare_adult!="" && $hotel_fare_adult!="0" && $hotel_currency!="NA")
        {
        $total_fare+=$hotel_currency*$hotel_fare_adult;
        }
        if($tour_fare_adult!="" && $tour_fare_adult!="0" && $tour_currency!="NA")
        {
        $total_fare+=$tour_currency*$tour_fare_adult;
        }
        if($transfer_fare_adult!="" && $transfer_fare_adult!="0" && $transfer_currency!="NA")
        {
        $total_fare+=$transfer_currency*$transfer_fare_adult;
        }
        if($visa_fare_adult!="" && $visa_fare_adult!="0" && $visa_currency!="NA")
        {
        $total_fare+=$visa_currency*$visa_fare_adult;
        }
        $total_f.=$total_fare.",";
        $datef.=$datefrom.",";
        $datet.=$dateto.",";
        $cutt_off=$price[$i]["cuttoffpoint"];
        }
        }
        /*echo $datefrom."<br>";
        echo $dateto."<br>";
        echo $total_fare."<br>";*/
        $datef=explode(",", $datef);
        $total_f=explode(",", $total_f);
        $datet=explode(",", $datet);
        $date_f_count=(count($datef)-1);
        $date_from= $datef;
        //print_r($datef )."<br>";
        //print_r($total_f)."<br>";
        //print_r($date_f_count)."<br>";
        for($i=0;$i<$date_f_count;$i++) {
        while (strtotime($datef[$i]) <= strtotime($datet[$i])) {
        //echo date('Y-m-d', strtotime("-1 day", strtotime($datef[$i])))."<br><br>";
        $daterange[]=array( 'date'=>strtotime($datef[$i]),'price'=>"$total_f[$i]");
        $datef[$i] = date ("Y-m-d", strtotime("+1 day", strtotime($datef[$i])));
        }
        }
        //print_r($daterange);
        //$key = array_search(strtotime("2018-06-20"), array_column($daterange, 'date'));
        //echo $daterange[$key]['price']."<br>";
        for($i=0;$i<$date_f_count;$i++) {
        $dates_from[]= date ("Y-m-d", strtotime("+1 day", strtotime($date_from[$i])));
        }
        //sort($dates_from);
        //print_r($dates_from);
        // echo strtotime($dates_from["0"])."<br>";
        //echo strtotime(date("Y-m-d" , strtotime("+0 days")));
        $from_date=strtotime($dates_from["0"]);
        $current=strtotime(date('Y-m-d'));
        if($current<$from_date):
        if($cutt_off!="" && $cutt_off!="0"):
        $starts_from[]= date ("Y-m-d", strtotime("+$cutt_off days", strtotime($dates_from["0"])) );
        else:
        $starts_from[]= date ("Y-m-d", strtotime("+0 day", strtotime($dates_from["0"])));
        endif;
        else:
        if($cutt_off!="" && $cutt_off!="0"):
        $starts_from[]= date ("Y-m-d", strtotime("+$cutt_off days"));
        else:
        $starts_from[]= date ("Y-m-d", strtotime("+0 day"));
        endif;
        endif;
        //print_r($starts_from);
        $start=$starts_from["0"];
        //echo $start;
        $end=date('Y-m-d', strtotime('+1 year'));
        while (strtotime($start) <= strtotime($end))
        {
        if(array_search(strtotime($start), array_column($daterange, 'date')))
        {
        //$key = array_search(strtotime($start), array_column($daterange, 'date'));
        $key = array_search(strtotime($start), array_column($daterange, 'date'));
        $calendar_price[]=array(
        'className'=>['price_data'],
        'title'=>$daterange[$key]['price'],
        'start'=>$start);
        }
        else
        {
        $calendar_price[]=array(
        'className'=>['query_data'],
        'title'=>'Send Query',
        'start'=>$start);
        }
        $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
        }
        //print_r($calendar_price);
        $a=json_encode($calendar_price);
        return $a;
        endif;
        }

    // ****************************************

    // third_page_upper_price_change_controller_start
    public function appy_price_type(Request $request)
    {

      $date=$request->date;
        $pkg_type=$request->pkg_type;
        $date=date("Y-m-d", strtotime($date));
        $package_id=$request->package_id;
        $type_value=$request->type_value;
        $details=Packages::find($package_id);
        $new_price=PackagePriceHelpers::get_new_pricing_data($package_id,$date);
        date('Y-m-d', 1693333800);
        $type='';
        $return_price='';

        if($new_price!='na'):

        $overall_package_rating=$new_price['overall_package_rating'];
        $package_rating=$new_price['package_rating'];
        if(count($overall_package_rating)>0):
        $type.='<select class="searchPanelUpdate_selectBox pkg_type_two type_value">';
        foreach($overall_package_rating as $row=>$col):

        $rate=DB::table('rt_pkg_rating_type')->where('id',$row)->first();
        if($type_value!='On Request'):
        if($row==$type_value):
        $type.='<option  selected  value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        else:
        if($row==$package_rating):
        $type.='<option  selected value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        endif;

        endforeach;
        $type.='</select>';
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        //

     
        
        //

        $data=['type'=>$type];

        return $data;  
    }
    public function date_wise_price(Request $request)
    {
        $date=$request->date;
        $pkg_type=$request->pkg_type;

        $date=date("Y-m-d", strtotime($date));
        $package_id=$request->package_id;
        $type_value=$request->type_value;
        $details=Packages::find($package_id);
        $new_price=PackagePriceHelpers::get_new_pricing_data_with_price_type($package_id,$date,$pkg_type);
        $package_duration = $details->duration;
        $first_day = $date;
        $last_day = date('Y-m-d', strtotime("+$package_duration days", strtotime($date)));
        $date_range = date('d M' , strtotime($first_day)).' - '.date('d M' , strtotime($last_day));

       
        date('Y-m-d', 1693333800);
        $type='';
        $return_price='';

        if($new_price!='na'):

        $overall_package_rating=$new_price['overall_package_rating'];
        $package_rating=$new_price['package_rating'];
        if(count($overall_package_rating)>0):
        $type.='<select class="searchPanelUpdate_selectBox pkg_type_two type_value">';
        foreach($overall_package_rating as $row=>$col):

        $rate=DB::table('rt_pkg_rating_type')->where('id',$row)->first();
        if($type_value!='On Request'):
        if($row==$type_value):
        $type.='<option  selected  value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        else:
        if($row==$package_rating):
        $type.='<option  selected value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        endif;

        endforeach;
        $type.='</select>';
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        //
       $type_p=PackagePriceHelpers::get_price_type($details->Price_type);

        if($new_price!='na'):

        if(array_key_exists($type_value,$new_price['overall_package_rating'])):
        $package_rating=$new_price['package_rating'];
        

        if($new_price['actual_price']==$new_price['overall_package_rating'][$type_value]):
        $return_price.='<div class="dSideItemBoxTop flexCenter">
        <p class="dSlashedPrice defaultCurrency">'.$new_price['actual_price'].'</p>
        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">'.$new_price['discount_price'].'</span>'.$type_p.'</p>
        </div>';
        else:
        $return_price.='<div class="dSideItemBoxTop">
        <p class="dSlashedPrice defaultCurrency">'.$new_price['actual_price'].'</p>
        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">'.$new_price['discount_price'].'</span> '.$type_p.'</p>
        <p class="dPriceSubTag">*Excluding applicable taxes</p>
        <span class="dPkgOfferTag">';
            $tourdiscount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
            $percentage = $tourdiscount / $new_price['actual_price'] * 100;
            
            $return_price .= round($percentage) . '% Off';
            
            $return_price .= '</span>
        </div>';
        endif;
        else:
        $package_rating=$new_price['package_rating'];

        if($new_price['actual_price']==$new_price['discount_price']):

        $return_price.='
        <div class="dSideItemBoxTop">
        <p class="dSlashedPrice defaultCurrency">'.$new_price['actual_price'].'</p>
        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">'.$type_p.'</p>
        </div>';
        else:

        $return_price.='
        <div class="dSideItemBoxTop">
        <p class="dSlashedPrice defaultCurrency">
        <strike>'.$new_price['actual_price'].'</strike>
        &nbsp;&nbsp;<span class="tourDefaultCurency"></span>'.$new_price['discount_price'].'
        </p>
        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">'.$type_p.'</p>
        </div>';
        endif;
        endif;
        

        else:
        $return_price.='<div class="dSideItemBoxTop flexCenter">
        <p class="dPriceTag_OnRequest"><span class="defaultCurrency"></span> On Request</p>
        </div>';
        endif;
        //


        $data=['return_price'=>$return_price,'type'=>$type,'first_day'=>$first_day,'last_day'=>$last_day,'date_range'=>$date_range];

        return $data;
        //
    }


public function date_wise_price_mobile(Request $request)
    {
        $date=$request->date;
        $pkg_type=$request->pkg_type;

        $date=date("Y-m-d", strtotime($date));
        $package_id=$request->package_id;
        $type_value=$request->type_value;
        $details=Packages::find($package_id);
        $new_price=PackagePriceHelpers::get_new_pricing_data_with_price_type($package_id,$date,$pkg_type);
        $package_duration = $details->duration;
        $first_day = $date;
        $last_day = date('Y-m-d', strtotime("+$package_duration days", strtotime($date)));
        $date_range = date('d M' , strtotime($first_day)).' - '.date('d M' , strtotime($last_day));

       
        date('Y-m-d', 1693333800);
        $type='';
        $return_price='';

        if($new_price!='na'):

        $overall_package_rating=$new_price['overall_package_rating'];
        $package_rating=$new_price['package_rating'];
        if(count($overall_package_rating)>0):
        $type.='<select class="searchPanelUpdate_selectBox pkg_type_two type_value">';
        foreach($overall_package_rating as $row=>$col):

        $rate=DB::table('rt_pkg_rating_type')->where('id',$row)->first();
        if($type_value!='On Request'):
        if($row==$type_value):
        $type.='<option  selected  value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        else:
        if($row==$package_rating):
        $type.='<option  selected value="'.$row.'">'.$rate->name.'</option>';
        else:
        $type.='<option value="'.$row.'">'.$rate->name.'</option>';
        endif;
        endif;

        endforeach;
        $type.='</select>';
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        else:
        $type.='<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        endif;
        //
       $type_p=PackagePriceHelpers::get_price_type($details->Price_type);

       

if ($new_price != 'na') {
    if (array_key_exists($type_value, $new_price['overall_package_rating'])) {
        if ($new_price['actual_price'] == $new_price['overall_package_rating'][$type_value]) {
            $return_price .= '
                <div class="mSideItemBoxTop">
                    <p class="mSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                    <p class="mPriceTag">
                        <span class="mActualPrice defaultCurrency">' . $new_price['discount_price'] . '</span> ' . $type_p . '
                    </p>
                </div>';
        } else {
            $tourdiscount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
            $percentage = $tourdiscount / $new_price['actual_price'] * 100;

            $return_price .= '
                <div class="mSideItemBoxTop">
                    <p class="mSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                    <p class="mPriceTag">
                        <span class="mActualPrice defaultCurrency">' . $new_price['discount_price'] . '</span> ' . $type_p . '
                    </p>
                    <span class="mPkgOfferTag">' . round($percentage) . '% Off</span>
                </div>';
        }
    } else {
        if ($new_price['actual_price'] == $new_price['discount_price']) {
            $return_price .= '
                <div class="mSideItemBoxTop">
                    <p class="mSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                    <p class="mPriceTag">
                        <span class="mActualPrice defaultCurrency"></span> ' . $type_p . '
                    </p>
                </div>';
        } else {
            $return_price .= '
                <div class="mSideItemBoxTop">
                    <p class="mSlashedPrice defaultCurrency">
                        <strike>' . $new_price['actual_price'] . '</strike>
                        &nbsp;&nbsp;<span class="tourDefaultCurrency"></span>' . $new_price['discount_price'] . '
                    </p>
                    <p class="mPriceTag">
                        <span class="mActualPrice defaultCurrency"></span> ' . $type_p . '
                    </p>
                </div>';
        }
    }
} else {
    $return_price .= '
        <div class="mSideItemBoxTop">
            <p class="mPriceTag_OnRequest">
                <span class="defaultCurrency"></span> On Request
            </p>
        </div>';
}

        //


        $data=['return_price'=>$return_price,'type'=>$type,'first_day'=>$first_day,'last_day'=>$last_day,'date_range'=>$date_range];

        return $data;
        //
    }

    // third_page_upper_price_change_controller_start (new - unchecked)
    /*public function date_wise_price(Request $request)
    {
        // Extract data from the request
        $date = $request->date;
        $pkg_type = $request->pkg_type;
        $package_id = $request->package_id;
        $type_value = $request->type_value;

        // Format the date to 'Y-m-d' format
        $date = date("Y-m-d", strtotime($date));

        // Get package details by ID
        $details = Packages::find($package_id);

        // Fetch new pricing data based on the package ID and the selected date
        $new_price = PackagePriceHelpers::get_new_pricing_data($package_id, $date);

        // Initialize default type and return price variables
        $type = '';
        $return_price = '';

        // Check if new price data is available
        if ($new_price != 'na') {

            // Extract overall package ratings and package rating
            $overall_package_rating = $new_price['overall_package_rating'];
            $package_rating = $new_price['package_rating'];

            // If package ratings are available, generate the select box for ratings
            if (count($overall_package_rating) > 0) {
                $type .= '<select class="searchPanelUpdate_selectBox pkg_type_two type_value">';
                foreach ($overall_package_rating as $row => $col) {
                    // Get rating type from the database
                    $rate = DB::table('rt_pkg_rating_type')->where('id', $row)->first();

                    // Check for 'On Request' condition and add options accordingly
                    if ($type_value != 'On Request') {
                        if ($row == $type_value) {
                            $type .= '<option selected value="' . $row . '">' . $rate->name . '</option>';
                        } else {
                            $type .= '<option value="' . $row . '">' . $rate->name . '</option>';
                        }
                    } else {
                        // If the type is 'On Request', select the package rating by default
                        if ($row == $package_rating) {
                            $type .= '<option selected value="' . $row . '">' . $rate->name . '</option>';
                        } else {
                            $type .= '<option value="' . $row . '">' . $rate->name . '</option>';
                        }
                    }
                }
                $type .= '</select>';
            } else {
                // If no ratings are available, display 'On Request' input box
                $type .= '<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
            }
        } else {
            // If no price data is available, display 'On Request' input box
            $type .= '<input type="text" value="On Request" class="searchPanelUpdate_inputBox" readonly>';
        }

        // Check if new price data is available and calculate the return price
        if ($new_price != 'na') {
            // Ensure type_value exists in the overall package ratings
            if (array_key_exists($type_value, $new_price['overall_package_rating'])) {

                // Get the actual price and discount price
                $package_rating = $new_price['package_rating'];

                if ($new_price['actual_price'] == $new_price['overall_package_rating'][$type_value]) {
                    // If the actual price is equal to the rating price, display the price without discount
                    $return_price .= '<div class="dSideItemBoxTop flexCenter">
                        <p class="dSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">' . $new_price['discount_price'] . '</span>' . $details->Price_type . '</p>
                    </div>';
                } else {
                    // Display the actual price with discount information
                    $return_price .= '<div class="dSideItemBoxTop">
                        <p class="dSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">' . $new_price['discount_price'] . '</span> ' . $details->Price_type . '</p>
                        <p class="dPriceSubTag">*Excluding applicable taxes</p>
                        <span class="dPkgOfferTag">';

                    // Calculate the percentage discount
                    $tourdiscount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
                    $percentage = $tourdiscount / $new_price['actual_price'] * 100;

                    // Append the discount percentage to the return price
                    $return_price .= round($percentage) . '% Off';
                    $return_price .= '</span>
                    </div>';
                }
            } else {
                // If type_value is not in the overall package ratings
                $package_rating = $new_price['package_rating'];

                if ($new_price['actual_price'] == $new_price['discount_price']) {
                    // Display the actual price without a discount if both prices are equal
                    $return_price .= '
                    <div class="dSideItemBoxTop">
                        <p class="dSlashedPrice defaultCurrency">' . $new_price['actual_price'] . '</p>
                        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">' . $details->Price_type . '</span></p>
                    </div>';
                } else {
                    // Display the actual price and discount price
                    $return_price .= '
                    <div class="dSideItemBoxTop">
                        <p class="dSlashedPrice defaultCurrency">
                            <strike>' . $new_price['actual_price'] . '</strike>
                            &nbsp;&nbsp;<span class="tourDefaultCurency"></span>' . $new_price['discount_price'] . '
                        </p>
                        <p class="dPriceTag"><span class="dActualPrice defaultCurrency">' . $details->Price_type . '</span></p>
                    </div>';
                }
            }
        } else {
            // If no new price data is available, display 'On Request'
            $return_price .= '<div class="dSideItemBoxTop flexCenter">
                <p class="dPriceTag_OnRequest"><span class="defaultCurrency"></span> On Request</p>
            </div>';
        }

        // Return the data as an array containing the formatted return price and package type
        $data = ['return_price' => $return_price, 'type' => $type];
        return $data;
    }*/

    // ****************************************

    // third_page_upper_price_change_controller_end
    /*public function packages(Request $request)
    {
        $this->validate($request,['destination_search'=>'required',]);
        $destination_search=$request->destination_search;
        $select_theme=$request->select_theme;
        if($select_theme==""):
        $data=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->get();
        else:
        $data=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->get();
        endif;
        $icon_data=Icons::all();
        return view("packages.pagetwo",[
            'data'=>$data,
            'destination_search'=>$destination_search,
            'icon_data'=>$icon_data,
        ]);
    }*/

    // third_page_upper_price_change_controller_end
    public function packages(Request $request)
    {
        // Validate the destination search input
        $this->validate($request, [
            'destination_search' => 'required'
            
        ]);

        $destination_search = $request->destination_search;
        // $select_theme = $request->select_theme;
        $select_theme = strtolower(trim($request->select_theme)); // Normalize input

        // Build the base query
        $query = DB::table('rt_packages')
            ->where('status', '=', '1')
            ->where(function ($q) use ($destination_search) {
                $q->orWhere('continent', 'like', '%' . $destination_search . '%')
                  ->orWhere('country', 'like', '%' . $destination_search . '%')
                  ->orWhere('state', 'like', '%' . $destination_search . '%')
                  ->orWhere('city', 'like', '%' . $destination_search . '%');
            });

        // Apply the theme filter only if a specific theme is selected
        // if (!empty($select_theme) && strtolower($select_theme) !== 'all') {
        //     $query->where('package_category', 'like', '%' . $select_theme . '%');
        // }

        // Apply the theme filter only if a specific theme is selected
        if (!empty($select_theme) && $select_theme !== 'all') {
            $query->where('package_category', 'like', '%' . $select_theme . '%');
        }

        // Fetch the data
        $data = $query->get();

        // Get icon data
        $icon_data = Icons::all();

        // Return the view with data
        return view("packages.pagetwo", [
            'data' => $data,
            'destination_search' => $destination_search,
            'icon_data' => $icon_data,
        ]);
    }
        
    // ****************************************

    // search packages using destination and theme (old working)
    /*public function packages1($id,Request $request)
    {
        $date=$request->datepicker;
        $theme_name='';
        $destination_search_first=explode("-", $id);
        $remove_array=['tour','packages'];
        $destination_search=array_diff($destination_search_first,$remove_array);
        $destination_search=implode(" ", $destination_search);
        // $destination_search=ucwords($destination_search);
        $destination_search = str_replace(' And ', ' and ', ucwords($destination_search));
        
        $array=explode("-", $id);
        $first_value=end($array);
        $second_value=prev($array);
        
        if($first_value!="packages" && $second_value!="tour"):
        $data_id = CustomHelpers::custom_decrypt($request->package_id);
        
        $Packages = Packages::findOrFail($data_id);
        
        $id=$Packages->id;

        if($Packages->onrequest == 1) {
            $price = false;
        } else {
            $price = unserialize($Packages->pricing);
        }

        $images = PackageUploads::all()->where('package_id',$data_id);
        $daywise = unserialize($Packages->day_itinerary);
        $city  = unserialize($Packages->city);
        $country  = unserialize($Packages->country);
        $continent  = unserialize($Packages->continent);
        $state  = unserialize($Packages->state);
        $icon_data=Icons::all();
        $hoteldata=PackageHotel::all();
        $status=$Packages->status;
        
        // if($status==1  || $Packages->search_status==1)
        if($status==1) {
            return view('packages.pagethree',[
                'details'=>$Packages,
                'price'=>$price,
                'images'=>$images,
                'daywise'=>$daywise,
                'city'=>$city,
                'country'=>$country,
                'continent'=>$continent,
                'state'=>$state,
                'id'=>$data_id,
                'hoteldata'=>$hoteldata,
                'icon_data'=>$icon_data,
                'id'=>$id
            ]);
        } else {
            if (Sentinel::check()) {
                if(Sentinel::getUser()->roles()->first()->slug == 'super_admin' || Sentinel::getUser()->roles()->first()->slug == 'administrator' || Sentinel::getUser()->roles()->first()->slug == 'supervisor' || Sentinel::getUser()->roles()->first()->slug == 'employee') {
                    return view('packages.pagethree',[
                        'details'=>$Packages,
                        'price'=>$price,
                        'images'=>$images,
                        'daywise'=>$daywise,
                        'city'=>$city,
                        'country'=>$country,
                        'continent'=>$continent,
                        'state'=>$state,
                        'id'=>$data_id,
                        'hoteldata'=>$hoteldata,
                        'icon_data'=>$icon_data,
                        'id'=>$id
                    ]);
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        }
        endif;

        $data=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orderBy('sort','ASC')->get();

        $data_ids=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orderBy('sort','ASC')->pluck('id')->toArray();

        $packages=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orderBy('sort','ASC')->limit(3)->get();

        $data1=DB::table('rt_packages_seo')->where([['destination', 'like', '%' . $destination_search . '%']])->get();
        $icon_data=Icons::all();
        return view("packages.pagetwo",[
            'data'=>$data,
            'data_ids'=>$data_ids,
            'destination_search'=>$destination_search,
            'icon_data'=>$icon_data,
            'data1'=>$data1,
            'packages'=>$packages,
            'date'=>$date,
            'theme_name'=>$theme_name,
        ]);
    }*/

    // search packages using destination and theme (working)
    /*public function packages1($id, Request $request)
    {
        $date = $request->datepicker;
        $theme_name = '';
        $destination_search_first = explode("-", $id);
        $remove_array = ['tour', 'packages'];
        $destination_search = array_diff($destination_search_first, $remove_array);
        $destination_search = implode(" ", $destination_search);
        $destination_search = str_replace(' And ', ' and ', ucwords($destination_search));
        
        $array = explode("-", $id);
        $first_value = end($array);
        $second_value = prev($array);

        if ($first_value != "packages" && $second_value != "tour") {
            // Decrypt the package ID
            try {
                $data_id = CustomHelpers::custom_decrypt($request->package_id ?? '');
            } catch (\Exception $e) {
                return redirect('/')->withErrors('Invalid package ID.');
            }

            // Fetch package details
            $Packages = Packages::find($data_id);
            if (!$Packages) {
                return redirect('/')->withErrors('Package not found.');
            }

            $id = $Packages->id;

            // Determine pricing information
            if ($Packages->onrequest == 1) {
                $price = false;
            } else {
                $price = unserialize($Packages->pricing);
            }

            // Retrieve related data
            $images = PackageUploads::where('package_id', $data_id)->orderBy('sort','ASC')->get();
            $daywise = unserialize($Packages->day_itinerary);
            $city = unserialize($Packages->city);
            $country = unserialize($Packages->country);
            $continent = unserialize($Packages->continent);
            $state = unserialize($Packages->state);
            $icon_data = Icons::all();
            $hoteldata = PackageHotel::all();
            $status = $Packages->status;

            // Check package status and permissions
            if ($status == 1) {
                return view('packages.pagethree', [
                    'details' => $Packages,
                    'price' => $price,
                    'images' => $images,
                    'daywise' => $daywise,
                    'city' => $city,
                    'country' => $country,
                    'continent' => $continent,
                    'state' => $state,
                    'id' => $data_id,
                    'hoteldata' => $hoteldata,
                    'icon_data' => $icon_data,
                ]);
            } else {
                if (Sentinel::check()) {
                    $userRole = Sentinel::getUser()->roles()->first()->slug;
                    $allowedRoles = ['super_admin', 'administrator', 'supervisor', 'employee'];
                    if (in_array($userRole, $allowedRoles)) {
                        return view('packages.pagethree', [
                            'details' => $Packages,
                            'price' => $price,
                            'images' => $images,
                            'daywise' => $daywise,
                            'city' => $city,
                            'country' => $country,
                            'continent' => $continent,
                            'state' => $state,
                            'id' => $data_id,
                            'hoteldata' => $hoteldata,
                            'icon_data' => $icon_data,
                        ]);
                    } else {
                        return redirect('/');
                    }
                } else {
                    return redirect('/');
                }
            }
        }

        // Handle cases when package is searched by destination
        $data = DB::table('rt_packages')
            ->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orderBy('sort', 'ASC')
            ->get();

        $data_ids = DB::table('rt_packages')
            ->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orderBy('sort', 'ASC')
            ->pluck('id')
            ->toArray();

        $packages = DB::table('rt_packages')
            ->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
            ->orderBy('sort', 'ASC')
            ->limit(3)
            ->get();

        $data1 = DB::table('rt_packages_seo')
            ->where([
                ['destination', 'like', '%' . $destination_search . '%']
            ])
            ->get();

        $icon_data = Icons::all();

        return view("packages.pagetwo", [
            'data' => $data,
            'data_ids' => $data_ids,
            'destination_search' => $destination_search,
            'icon_data' => $icon_data,
            'data1' => $data1,
            'packages' => $packages,
            'date' => $date,
            'theme_name' => $theme_name,
        ]);
    }*/

    // tried to map with id to name (not working)
    /*public function packages1($id, Request $request)
    {
        $date = $request->datepicker;
        $theme_name = '';
        $destination_search_first = explode("-", $id);
        $remove_array = ['tour', 'packages'];
        $destination_search = array_diff($destination_search_first, $remove_array);
        $destination_search = implode(" ", $destination_search);
        $destination_search = str_replace(' And ', ' and ', ucwords($destination_search));

        $array = explode("-", $id);
        $first_value = end($array);
        $second_value = prev($array);

        // Handle direct package ID (733-tour-packages)
        if ($first_value != "packages" && $second_value != "tour") {
            try {
                $data_id = CustomHelpers::custom_decrypt($request->package_id ?? '');
            } catch (\Exception $e) {
                return redirect('/')->withErrors('Invalid package ID.');
            }

            $Packages = Packages::find($data_id);
            if (!$Packages) {
                return redirect('/')->withErrors('Package not found.');
            }

            $id = $Packages->id;
            $price = ($Packages->onrequest == 1) ? false : unserialize($Packages->pricing);
            $images = PackageUploads::where('package_id', $data_id)->orderBy('sort','ASC')->get();
            $daywise = unserialize($Packages->day_itinerary);
            $city = unserialize($Packages->city);
            $country = unserialize($Packages->country);
            $continent = unserialize($Packages->continent);
            $state = unserialize($Packages->state);
            $icon_data = Icons::all();
            $hoteldata = PackageHotel::all();
            $status = $Packages->status;

            if ($status == 1) {
                return view('packages.pagethree', compact(
                    'Packages', 'price', 'images', 'daywise', 'city',
                    'country', 'continent', 'state', 'data_id', 'hoteldata', 'icon_data'
                ));
            } else {
                if (Sentinel::check()) {
                    $userRole = Sentinel::getUser()->roles()->first()->slug;
                    $allowedRoles = ['super_admin', 'administrator', 'supervisor', 'employee'];
                    if (in_array($userRole, $allowedRoles)) {
                        return view('packages.pagethree', compact(
                            'Packages', 'price', 'images', 'daywise', 'city',
                            'country', 'continent', 'state', 'data_id', 'hoteldata', 'icon_data'
                        ));
                    } else {
                        return redirect('/');
                    }
                } else {
                    return redirect('/');
                }
            }
        }

        // Map destination name to IDs
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', $destination_search . '%')->pluck('id')->toArray();
        $countryIds = DB::table('countries')->where('name', 'LIKE', $destination_search . '%')->pluck('id')->toArray();
        $stateIds = DB::table('states')->where('name', 'LIKE', $destination_search . '%')->pluck('id')->toArray();
        $cityIds = DB::table('city')->where('name', 'LIKE', $destination_search . '%')->pluck('id')->toArray();

        Log::info('Destination Search: ' . $destination_search);
        Log::info('Matched Continent IDs: ', $continentIds);
        Log::info('Matched Country IDs: ', $countryIds);
        Log::info('Matched State IDs: ', $stateIds);
        Log::info('Matched City IDs: ', $cityIds);

        // Get all packages
        $allPackages = DB::table('rt_packages')->where('status', 1)->get();

        $filteredPackages = $allPackages->filter(function ($pkg) use ($continentIds, $countryIds, $stateIds, $cityIds) {
            $pkgContinents = @unserialize($pkg->continent) ?: [];
            $pkgCountries = @unserialize($pkg->country) ?: [];
            $pkgStates = @unserialize($pkg->state) ?: [];
            $pkgCities = @unserialize($pkg->city) ?: [];

            return
                array_intersect($continentIds, $pkgContinents) ||
                array_intersect($countryIds, $pkgCountries) ||
                array_intersect($stateIds, $pkgStates) ||
                array_intersect($cityIds, $pkgCities);
        });

        $data = $filteredPackages;
        $data_ids = $filteredPackages->pluck('id')->toArray();
        $packages = $filteredPackages->take(3);

        $data1 = DB::table('rt_packages_seo')
            ->where('destination', 'LIKE', '%' . $destination_search . '%')
            ->get();

        $icon_data = Icons::all();

        return view("packages.pagetwo", [
            'data' => $data,
            'data_ids' => $data_ids,
            'destination_search' => $destination_search,
            'icon_data' => $icon_data,
            'data1' => $data1,
            'packages' => $packages,
            'date' => $date,
            'theme_name' => $theme_name,
        ]);
    }*/


    // ***********************

    // url showing using id (working)
    public function packages1($id, Request $request)
    {
        $date = $request->datepicker;

        $theme_name = '';
       

        // Detect if it's a direct package detail view or a destination-based search
        if (!$this->isDestinationSlug($id)) {
            return $this->showPackageDetails($request);
        }
       if (empty($date)) {
      $date = date("D, d M Y", strtotime('+60 days'));
         }
        
        if (Session::has('filtered_tour_date')) {
        Session::forget('filtered_tour_date');
          }
    Session::set('filtered_tour_date', $date);
        // Parse and clean destination slug
        $destination_search = $this->parseDestinationSlug($id);
        
        // Search for packages by destination
        [$data, $data_ids, $packages] = $this->searchPackagesByDestination($destination_search);
   
        // Get SEO meta data
        $data1 = DB::table('rt_packages_seo')
            ->where('destination', $destination_search)
            ->get();

        $icon_data = Icons::all();

   $total_themes = $this->extractThemes($data);

        return view("packages.pagetwo", [
            'data'                  => $data,
            'data_ids'              => $data_ids,
            'destination_search'    => $destination_search,
            'icon_data'             => $icon_data,
            'data1'                 => $data1,
            'packages'              => $packages,
            'date'                  => $date,
            'theme_name'            => $theme_name,
            'total_themes'            => $total_themes,
        ]);
    }

    

    private function isDestinationSlug(string $id): bool
    {
        return Str::endsWith($id, '-tour-packages');
    }

    private function parseDestinationSlug(string $slug): string
    {
        $cleaned = preg_replace('/-?tour-?packages$/i', '', $slug); // remove suffix
        $cleaned = str_replace('-', ' ', $cleaned);
        return strtolower($cleaned);
    }

private function searchPackagesByDestination1(string $destination_search): array
    {
        $query = DB::table('rt_packages')
            ->where('status', '=', '1')
            ->where(function ($q) use ($destination_search) {
                $q->where('continent', 'like', '%' . $destination_search . '%')
                  ->orWhere('country', 'like', '%' . $destination_search . '%')
                  ->orWhere('state', 'like', '%' . $destination_search . '%')
                  ->orWhere('city', 'like', '%' . $destination_search . '%');
            })
            ->orderBy('sort', 'ASC');

        $results = $query->get();

        return [
            $results,
            $results->pluck('id')->toArray(),
            $results->take(3),
        ];
    }

  public function searchPackagesByTheme($destination_search, $select_theme)
  {
$countryIds = countries::where('name', $destination_search)->pluck('id');

if (count($countryIds) > 0) {
    $stateIds = collect(); // initialize as empty collection
    $cityIds = collect();
} else {
    $stateIds = State::where('name', $destination_search)->pluck('id');
    
    if (count($stateIds) > 0) {
        $cityIds = collect();
    } else {
        $cityIds = City::where('name', $destination_search)->pluck('id');
    }
} 

if ($countryIds->isEmpty() && $stateIds->isEmpty() && $cityIds->isEmpty()) {
    return [collect(), [], collect()];
}

$packages = DB::table('rt_packages')
    ->where('status', '=', '1')
    ->when($select_theme, function ($query) use ($select_theme) {
        return $query->where('package_category', 'like', "%{$select_theme}%");
    })
    ->orderBy('sort', 'ASC')
    ->get();



// Filter packages based on matching city, state, and country
$filteredData = $packages->filter(function ($package) use ($countryIds, $stateIds, $cityIds) {
    // Unserialize location data from the package
    $packageCountries = @unserialize($package->country);
    $packageStates = @unserialize($package->state);
    $packageCities = @unserialize($package->city);

    // Default to empty array if not an array
    $packageCountries = is_array($packageCountries) ? $packageCountries : [];
    $packageStates = is_array($packageStates) ? $packageStates : [];
 

    // Match each location level if we have search input for it
    $matchCountry = count($countryIds) > 0 ? !empty(array_intersect($packageCountries, $countryIds->toArray())) : true;
    $matchState   = count($stateIds) > 0 ? !empty(array_intersect($packageStates, $stateIds->toArray())) : true;
    $matchCity    = count($cityIds) > 0 ? !empty(array_intersect($packageCities, $cityIds->toArray())) : true;
    // Return true only if all match
    return $matchCountry && $matchState && $matchCity;
});

// Reset keys and prepare result
$results = $filteredData->values();

// Return desired result format
return [
    $results,                         // Full filtered collection
    $results->pluck('id')->toArray(), // Just the IDs
    $results->take(3),                // First 3 items
];



  }
    private function searchPackagesByDestination(string $destination_search): array
    {

$countryIds = countries::where('name', $destination_search)->pluck('id');

if (count($countryIds) > 0) {
    $stateIds = collect(); // initialize as empty collection
    $cityIds = collect();
} else {
    $stateIds = State::where('name', $destination_search)->pluck('id');
    
    if (count($stateIds) > 0) {
        $cityIds = collect();
    } else {
        $cityIds = City::where('name', $destination_search)->pluck('id');
    }
}
if ($countryIds->isEmpty() && $stateIds->isEmpty() && $cityIds->isEmpty()) {
    return [collect(), [], collect()];
}

$packages = DB::table('rt_packages')
    ->where('status', '=', '1')
    ->orderBy('sort', 'ASC')
    ->get();

// Filter packages based on matching city, state, and country
$filteredData = $packages->filter(function ($package) use ($countryIds, $stateIds, $cityIds) {
    // Unserialize location data from the package
    $packageCountries = @unserialize($package->country);
    $packageStates = @unserialize($package->state);
    $packageCities = @unserialize($package->city);

    // Default to empty array if not an array
    $packageCountries = is_array($packageCountries) ? $packageCountries : [];
    $packageStates = is_array($packageStates) ? $packageStates : [];
 

    // Match each location level if we have search input for it
    $matchCountry = count($countryIds) > 0 ? !empty(array_intersect($packageCountries, $countryIds->toArray())) : true;
    $matchState   = count($stateIds) > 0 ? !empty(array_intersect($packageStates, $stateIds->toArray())) : true;
    $matchCity    = count($cityIds) > 0 ? !empty(array_intersect($packageCities, $cityIds->toArray())) : true;
    // Return true only if all match
    return $matchCountry && $matchState && $matchCity;
});

// Reset keys and prepare result
$results = $filteredData->values();

// Return desired result format
return [
    $results,                         // Full filtered collection
    $results->pluck('id')->toArray(), // Just the IDs
    $results->take(3),                // First 3 items
];

    }

    // map id with name (not working)
    /*private function searchPackagesByDestination(string $destination_search): array
    {
        \Log::info("Looking for destination: $destination_search");
        // 1. Get matching IDs from name
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search%")->pluck('id')->toArray();
        $countryIds   = DB::table('countries')->where('name', 'LIKE', "$destination_search%")->pluck('id')->toArray();
        $stateIds     = DB::table('states')->where('name', 'LIKE', "$destination_search%")->pluck('id')->toArray();
        $cityIds      = DB::table('city')->where('name', 'LIKE', "$destination_search%")->pluck('id')->toArray();

        \Log::info("Matched Continent IDs: " . implode(',', $continentIds));
        \Log::info("Matched Country IDs: " . implode(',', $countryIds));
        \Log::info("Matched State IDs: " . implode(',', $stateIds));
        \Log::info("Matched City IDs: " . implode(',', $cityIds));

        // 2. Query packages using matched IDs
        $query = DB::table('rt_packages')
            ->where('status', '=', '1')
            ->where(function ($q) use ($continentIds, $countryIds, $stateIds, $cityIds) {
                if (!empty($continentIds)) {
                    $q->orWhereIn('continent', $continentIds);
                }
                if (!empty($countryIds)) {
                    $q->orWhereIn('country', $countryIds);
                }
                if (!empty($stateIds)) {
                    $q->orWhereIn('state', $stateIds);
                }
                if (!empty($cityIds)) {
                    $q->orWhereIn('city', $cityIds);
                }
            })
            ->orderBy('sort', 'ASC');

        $results = $query->get();

        return [
            $results,
            $results->pluck('id')->toArray(),
            $results->take(3),
        ];
    }*/


    private function showPackageDetails(Request $request)
    {

      
$packageId = str_replace(" ", "+", $request->package_id); 


        try {
            $data_id = CustomHelpers::custom_decrypt($packageId ?? '');
         
        } catch (\Exception $e) {
            return redirect('/')->withErrors('Invalid package ID.');
        }

        $package = Packages::find($data_id);
        if (!$package) {
            return redirect('/')->withErrors('Package not found.');
        }

        //$price = $package->onrequest == 1 ? false : @unserialize($package->pricing) ?: [];
        $pricingData = @unserialize($package->pricing);
        $price = ($package->onrequest == 1 ? false : $pricingData) ?: [];
        
        // Get a destination name to show (adjust based on your preference)
        //$destination_name = $package->city ?? $package->state ?? $package->country ?? $package->continent ?? $package->title ?? 'Holiday';

        $data = [
            'details'   => $package,
            'price'     => $price,
            'images'    => PackageUploads::where('package_id', $data_id)->orderBy('sort', 'ASC')->get(),
            'daywise'   => @unserialize($package->day_itinerary) ?: [],
            'city'      => @unserialize($package->city) ?: [],
            'country'   => @unserialize($package->country) ?: [],
            'continent' => @unserialize($package->continent) ?: [],
            'state'     => @unserialize($package->state) ?: [],
            'id'        => $data_id,
            'hoteldata' => PackageHotel::all(),
            'icon_data' => Icons::all(),
            //'destination_name'  => is_array($destination_name) ? implode(', ', $destination_name) : $destination_name,
        ];

        if ($package->status == 1 || $this->canViewInactivePackage()) {
            return view('packages.pagethree', $data);
        }

        return redirect('/');
    }

    /*private function showPackageDetails(Request $request)
    {
        try {
            $data_id = CustomHelpers::custom_decrypt($request->package_id ?? '');
        } catch (\Exception $e) {
            return redirect('/')->withErrors('Invalid package ID.');
        }

        $package = Packages::find($data_id);
        if (!$package) {
            return redirect('/')->withErrors('Package not found.');
        }

        $pricingData = @unserialize($package->pricing);
        $price       = ($package->onrequest == 1 ? false : $pricingData) ?: [];

        // Prepare fallback destination name
        $destination_name = '';
        if (!empty($package->city)) {
            $destination_name = is_array(@unserialize($package->city)) 
                                ? implode(', ', @unserialize($package->city)) 
                                : $package->city;
        } elseif (!empty($package->state)) {
            $destination_name = is_array(@unserialize($package->state)) 
                                ? implode(', ', @unserialize($package->state)) 
                                : $package->state;
        } elseif (!empty($package->country)) {
            $destination_name = is_array(@unserialize($package->country)) 
                                ? implode(', ', @unserialize($package->country)) 
                                : $package->country;
        } elseif (!empty($package->continent)) {
            $destination_name = is_array(@unserialize($package->continent)) 
                                ? implode(', ', @unserialize($package->continent)) 
                                : $package->continent;
        } else {
            $destination_name = $package->title ?? 'Holiday';
        }

        $data = [
            'details'           => $package,
            'price'             => $price,
            'images'            => PackageUploads::where('package_id', $data_id)->orderBy('sort', 'ASC')->get(),
            'daywise'           => @unserialize($package->day_itinerary) ?: [],
            'city'              => @unserialize($package->city) ?: [],
            'country'           => @unserialize($package->country) ?: [],
            'continent'         => @unserialize($package->continent) ?: [],
            'state'             => @unserialize($package->state) ?: [],
            'id'                => $data_id,
            'hoteldata'         => PackageHotel::all(),
            'icon_data'         => Icons::all(),

            // Add this
            'destination_search' => $destination_name,
        ];

        if ($package->status == 1 || $this->canViewInactivePackage()) {
            return view('packages.pagethree', $data);
        }

        return redirect('/');
    }*/


    private function canViewInactivePackage(): bool
    {
        if (!Sentinel::check()) return false;

        $role = Sentinel::getUser()->roles()->first()->slug;
        return in_array($role, ['super_admin', 'administrator', 'supervisor', 'employee']);
    }


    // ***********************


    // search packages using destination and theme
    /*public function packages1($id, Request $request)
    {
        $date = $request->datepicker;
        $theme_name = '';

        // Normalize the $id to lowercase
        $id = strtolower($id);

        $destination_search_first = explode("-", $id);
        $remove_array = ['tour', 'packages'];
        $destination_search = array_diff($destination_search_first, $remove_array);
        $destination_search = implode(" ", $destination_search);

        // Convert the destination search to lowercase
        $destination_search = strtolower($destination_search);

        $array = explode("-", $id);
        $first_value = end($array);
        $second_value = prev($array);

        if ($first_value != "packages" && $second_value != "tour") {
            try {
                $data_id = CustomHelpers::custom_decrypt($request->package_id ?? '');
            } catch (\Exception $e) {
                return redirect('/')->withErrors('Invalid package ID.');
            }

            $Packages = Packages::find($data_id);
            if (!$Packages) {
                return redirect('/')->withErrors('Package not found.');
            }

            $id = $Packages->id;
            $price = $Packages->onrequest == 1 ? false : unserialize($Packages->pricing);
            $images = PackageUploads::all()->where('package_id', $data_id);
            $daywise = unserialize($Packages->day_itinerary);
            $city = unserialize($Packages->city);
            $country = unserialize($Packages->country);
            $continent = unserialize($Packages->continent);
            $state = unserialize($Packages->state);
            $icon_data = Icons::all();
            $hoteldata = PackageHotel::all();
            $status = $Packages->status;

            if ($status == 1) {
                return view('packages.pagethree', compact('Packages', 'price', 'images', 'daywise', 'city', 'country', 'continent', 'state', 'data_id', 'hoteldata', 'icon_data'));
            } else {
                if (Sentinel::check()) {
                    $userRole = Sentinel::getUser()->roles()->first()->slug;
                    $allowedRoles = ['super_admin', 'administrator', 'supervisor', 'employee'];
                    if (in_array($userRole, $allowedRoles)) {
                        return view('packages.pagethree', compact('Packages', 'price', 'images', 'daywise', 'city', 'country', 'continent', 'state', 'data_id', 'hoteldata', 'icon_data'));
                    }
                    return redirect('/');
                }
                return redirect('/');
            }
        }

        // Perform case-insensitive matching in SQL queries
        $data = DB::table('rt_packages')
            ->whereRaw('LOWER(continent) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(country) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(state) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(city) LIKE ?', ["%{$destination_search}%"])
            ->where('status', '=', '1')
            ->orderBy('sort', 'ASC')
            ->get();

        $data_ids = DB::table('rt_packages')
            ->whereRaw('LOWER(continent) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(country) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(state) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(city) LIKE ?', ["%{$destination_search}%"])
            ->where('status', '=', '1')
            ->orderBy('sort', 'ASC')
            ->pluck('id')
            ->toArray();

        $packages = DB::table('rt_packages')
            ->whereRaw('LOWER(continent) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(country) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(state) LIKE ?', ["%{$destination_search}%"])
            ->orWhereRaw('LOWER(city) LIKE ?', ["%{$destination_search}%"])
            ->where('status', '=', '1')
            ->orderBy('sort', 'ASC')
            ->limit(3)
            ->get();

        $data1 = DB::table('rt_packages_seo')
            ->whereRaw('LOWER(destination) LIKE ?', ["%{$destination_search}%"])
            ->get();

        $icon_data = Icons::all();

        return view("packages.pagetwo", compact('data', 'data_ids', 'destination_search', 'icon_data', 'data1', 'packages', 'date', 'theme_name'));
    }*/


    // ****************************************

    // search destination using theme from search panel
    /*public function packages2($id,$id1,Request $request) 
    {
        $date=$request->datepicker;
        $destination_search_first=explode("-", $id);
        $remove_array=['tour','packages'];
        $destination_search=array_diff($destination_search_first,$remove_array);
        $destination_search=implode(" ", $destination_search);
        $destination_search = str_replace(' And ', ' and ', ucwords($destination_search));

        $select_theme=explode("-", $id1);
        $select_theme=implode(" ", $select_theme);
        $select_theme = str_replace(' And ', ' and ', ucwords($select_theme));

        $data=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orderBy('sort','ASC')->get();

        $packages=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $select_theme . '%']])->orderBy('sort','ASC')->limit(3)->get();

        $icon_data=Icons::all();
        $data1=DB::table('rt_packages_seo')->where([['destination', 'like', '%' . $destination_search . '%']])->get();
        $theme_name=$select_theme;
        $data_ids=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orwhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])->orderBy('sort','ASC')->pluck('id')->toArray();
        
        return view("packages.pagetwo",[
            'data'=>$data,
            'destination_search'=>$destination_search,
            'icon_data'=>$icon_data,
            'data1'=>$data1,
            'packages'=>$packages,
            'date'=>$date,
            'theme_name'=>$theme_name,
            'data_ids'=>$data_ids,
        ]);
    }*/

    // search destination using theme from search panel
    public function packages2($id, $id1, Request $request)
    {
        // Extract and format the destination search term
        $date = $request->datepicker;
        if (empty($date)) {
      $date = date("D, d M Y", strtotime('+60 days'));
         }

          if (Session::has('filtered_tour_date')) {
        Session::forget('filtered_tour_date');
          }
    Session::set('filtered_tour_date', $date);

        $destination_search_first = explode("-", $id);
        $remove_array = ['tour', 'packages'];
        $destination_search = array_diff($destination_search_first, $remove_array);
        $destination_search = implode(" ", $destination_search);
        $destination_search = str_replace(' And ', ' and ', ucwords($destination_search));

        // Extract and format the selected theme
        // $select_theme = explode("-", $id1);
        // $select_theme = implode(" ", $select_theme);
        // $select_theme = str_replace(' And ', ' and ', ucwords($select_theme));
        $select_theme = $id1;
        $select_theme = str_replace(' And ', ' and ', ucwords($select_theme));

[$data, $data_ids, $packages] = $this->searchPackagesByTheme($destination_search,$select_theme);
[$data_total_destination, $data_ids_total_destination, $packages_total_destination] = $this->searchPackagesByDestination($destination_search);    


        // Additional data
        $icon_data = Icons::all();
        $data1 = DB::table('rt_packages_seo')
            ->where('destination', 'like', '%' . $destination_search . '%')
            ->get();


 $total_themes = $this->extractThemes($data_total_destination);
        // Render the view
        return view("packages.pagetwo", [
            'data' => $data,
            'destination_search' => $destination_search,
            'icon_data' => $icon_data,
            'data1' => $data1,
            'packages' => $packages,
            'date' => $date,
            'theme_name' => $select_theme,
            'data_ids' => $data_ids,
            'total_themes'            => $total_themes,
        ]);
    }

    // ****************************************

    // home mid-image (world popular destination)
    /*public function mid_image(Request $request)
    {
        $output="";
        $img_data=Mid_Image::all();
        foreach($img_data as $img):
        if($img->row1_dest1!=''):
        $url1= url('/Holidays/').'/'.str_slug($img->row1_dest1).'-tour-packages';
        else:
        $url1="#";
        endif;
        if($img->row1_dest2!=''):
        $url2= url('/Holidays/').'/'.str_slug($img->row1_dest2).'-tour-packages';
        else:
        $url2="#";
        endif;
        if($img->row1_dest3!=''):
        $url3= url('/Holidays/').'/'.str_slug($img->row1_dest3).'-tour-packages';
        else:
        $url3="#";
        endif;
        if($img->row2_dest1!=''):
        $url4= url('/Holidays/').'/'.str_slug($img->row2_dest1).'-tour-packages';
        else:
        $url4="#";
        endif;
        //
        if($img->row2_dest2!=''):
        $url5= url('/Holidays/').'/'.str_slug($img->row2_dest2).'-tour-packages';
        else:
        $url5="#";
        endif;
        //
        if($img->row2_dest3!=''):
        $url6= url('/Holidays/').'/'.str_slug($img->row2_dest3).'-tour-packages';
        else:
        $url6="#";
        endif;
        //
        if($img->row3_dest1!=''):
        $url7= url('/Holidays/').'/'.str_slug($img->row3_dest1).'-tour-packages';
        else:
        $url7="#";
        endif;
        //
        if($img->row3_dest2!=''):
        $url8= url('/Holidays/').'/'.str_slug($img->row3_dest2).'-tour-packages';
        else:
        $url8="#";
        endif;
        //
        if($img->row3_dest3!=''):
        $url9= url('/Holidays/').'/'.str_slug($img->row3_dest3).'-tour-packages';
        else:
        $url9="#";
        endif;
        //
        if($img->row4_dest1!=''):
        $url10= url('/Holidays/').'/'.str_slug($img->row4_dest1).'-tour-packages';
        else:
        $url10="#";
        endif;
        //
        if($img->row4_dest2!=''):
        $url11= url('/Holidays/').'/'.str_slug($img->row4_dest2).'-tour-packages';
        else:
        $url11="#";
        endif;
        //
        if($img->row4_dest3!=''):
        $url12= url('/Holidays/').'/'.str_slug($img->row4_dest3).'-tour-packages';
        else:
        $url12="#";
        endif;
        //
        if($img->row1_image1==""):
        $src1=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src1=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row1_image1);
        $src1=env('IMAGESRC').'/public'.$img->row1_image1;
        endif;
        if($img->row1_image2==""):
        $src2=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src2=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row1_image2);
        $src2=env('IMAGESRC').'/public'.$img->row1_image2;
        endif;
        if($img->row1_image3==""):
        $src3=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src3=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row1_image3);
        $src3=env('IMAGESRC').'/public'.$img->row1_image3;
        endif;
        //
        if($img->row2_image1==""):
        $src4=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src4=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row2_image1);
        $src4=env('IMAGESRC').'/public'.$img->row2_image1;
        endif;
        //
        if($img->row2_image2==""):
        $src5=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src5=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row2_image2);
        $src5=env('IMAGESRC').'/public'.$img->row2_image2;
        endif;
        //
        if($img->row2_image3==""):
        $src6=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src6=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row2_image3);
        $src6=env('IMAGESRC').'/public'.$img->row2_image3;
        endif;
        //
        if($img->row3_image1==""):
        $src7=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src7=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row3_image1);
        $src7=env('IMAGESRC').'/public'.$img->row3_image1;
        endif;
        //
        if($img->row3_image2==""):
        $src8=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src8=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row3_image2);
        $src8=env('IMAGESRC').'/public'.$img->row3_image2;
        endif;
        //
        if($img->row3_image3==""):
        $src9=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src9=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row3_image3);
        $src9=env('IMAGESRC').'/public'.$img->row3_image3;
        endif;
        //
        if($img->row4_image1==""):
        $src10=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src10=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row4_image1);
        $src10=env('IMAGESRC').'/public'.$img->row4_image1;
        endif;
        //
        if($img->row4_image2==""):
        $src11=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src11=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row4_image2);
        $src11=env('IMAGESRC').'/public'.$img->row4_image2;
        endif;
        //
        if($img->row4_image3==""):
        $src12=env('IMAGESRC').'/public/uploads/d.png';
        else:
        // $src12=CustomHelpers::get_base64_image(env('IMAGESRC').'/public'.$img->row4_image3);
        $src12=env('IMAGESRC').'/public'.$img->row4_image3;
        endif;
        //
        $output.="<section class='section-3'>
        <div class='container'>
        <div class='hadding1'>
        <h2>TOP DESTINATIONS</h2>
        <h4>BEST TRAVEL PACKAGES AVAILABLE</h4>
        <div class='hadd-line'></div>
        </div>
        <div class='col-md-8 col-sm-8'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url1'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image big_img' alt='img' src='$src1'>
        <div class='quotes'>";
        if($img->row1_title1!=""):
        $output.="<h1>$img->row1_title1</h1>";
        endif;
        if($img->row1_desc1!=""):
        $output.="<p>$img->row1_desc1 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-4 col-sm-4'>
        <div class='row'>
        <div class='col-md-12 col-sm-12'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url2'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src2'>
        <div class='quotes'>";
        if($img->row1_title2!=""):
        $output.="<h1>$img->row1_title2</h1>";
        endif;
        if($img->row1_desc2!=""):
        $output.="<p>$img->row1_desc2 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-12 col-sm-12'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url3'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src3'>
        <div class='quotes'>";
        if($img->row1_title3!=""):
        $output.="<h1>$img->row1_title3</h1>";
        endif;
        if($img->row1_desc3!=""):
        $output.="<p>$img->row1_desc3 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        </div>
        </div>
        <div class='col-md-12 col-sm-12'>
        <div class='row'>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url4'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src4'>
        <div class='quotes'>";
        if($img->row2_title1!=""):
        $output.="<h1>$img->row2_title1</h1>";
        endif;
        if($img->row2_desc1!=""):
        $output.="<p>$img->row2_desc1 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url5'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src5'>
        <div class='quotes'>";
        if($img->row2_title2!=""):
        $output.="<h1>$img->row2_title2</h1>";
        endif;
        if($img->row2_desc2!=""):
        $output.="<p>$img->row2_desc2 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url6'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src6'>
        <div class='quotes'>";
        if($img->row2_title3!=""):
        $output.="<h1>$img->row2_title3</h1>";
        endif;
        if($img->row2_desc3!=""):
        $output.="<p>$img->row2_desc3 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        </div>
        </div>
        <div class='col-md-4 col-sm-4'>
        <div class='row'>
        <div class='col-md-12 col-sm-12'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url7'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src7'>
        <div class='quotes'>";
        if($img->row3_title1!=""):
        $output.="<h1>$img->row3_title1</h1>";
        endif;
        if($img->row3_desc1!=""):
        $output.="<p>$img->row3_desc1 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-12 col-sm-12'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url8'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src8'>
        <div class='quotes'>";
        if($img->row3_title2!=""):
        $output.="<h1>$img->row3_title2</h1>";
        endif;
        if($img->row3_desc2!=""):
        $output.="<p>$img->row3_desc2 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        </div>
        </div>
        <div class='col-md-8 col-sm-8'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url9'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image big_img'  alt='' src='$src9'>
        <div class='quotes'>";
        if($img->row3_title3!=""):
        $output.="<h1>$img->row3_title3</h1>";
        endif;
        if($img->row3_desc3!=""):
        $output.="<p>$img->row3_desc3 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-12 col-sm-12'>
        <div class='row'>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url10'>
        <img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src10'>
        <div class='quotes'>";
        if($img->row4_title1!=""):
        $output.="<h1>$img->row4_title1</h1>";
        endif;
        if($img->row4_desc1!=""):
        $output.="<p>$img->row4_desc1 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url11'><img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src11'>
        <div class='quotes'>";
        if($img->row4_title2!=""):
        $output.="<h1>$img->row4_title2</h1>";
        endif;
        if($img->row4_desc2!=""):
        $output.="<p>$img->row4_desc2 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        <div class='col-md-4 col-sm-4'>
        <a class='list-quotes nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow pkg_search' href='$url12'><img class='img-responsive nicdark_focus nicdark_zoom_image small_img' alt='img' src='$src12'>
        <div class='quotes'>";
        if($img->row4_title3!=""):
        $output.="<h1>$img->row4_title3</h1>";
        endif;
        if($img->row4_desc3!=""):
        $output.="<p>$img->row4_desc3 <span>...Read More</span></p>";
        endif;
        $output.="</div>
        </a>
        </div>
        </div>
        </div>
        </div>
        </section>";
        endforeach;
        echo $output;
    }*/
    
    // popular destination in search panel (mobile)
    /*function mobile_destination_search(Request $request)
    {
        $response="";
        $response1="";
        $response2="";
        $response3="";
        $destination_search_value=$request->mobile_destination_search;
        if(strlen($destination_search_value)>1):
        $data=DB::table('rt_packages')
        ->where([['continent', 'like', '%' . $destination_search_value . '%'],['status', '=', '1'],])
        ->orWhere([['country', 'like', '%' . $destination_search_value . '%'],['status', '=', '1'],])
        ->orWhere([['state', 'like', '%' . $destination_search_value . '%'],['status', '=', '1'],])
        ->orWhere([['city', 'like', '%' . $destination_search_value . '%'],['status', '=', '1'],])
        ->get();
        if($data):
        $dest=[];
        $dest_val=[];
        foreach($data as $data_value):
        $continents=unserialize($data_value->continent);
        foreach($continents as $continent ):
        $dest[]=$continent;
        // $dest_val[$continent]=$continent;
        endforeach;
        //
        $countries=unserialize($data_value->country);
        foreach($countries as $country ):
        $dest[]=$country;
        // $dest_val[$country]=$country;
        endforeach;
        //
        $states=unserialize($data_value->state);
        foreach($states as $row=>$col):
        if($countries[$row]=='India'):
        $dest[]=$states[$row];
        $dest_val[$states[$row]]=$states[$row].' ('.$countries[$row].')';
        else:
        $dest[]=$states[$row];
        endif;
        endforeach;
        //
        $cities=unserialize($data_value->city);
        foreach($cities as $row=>$col ):
        if($countries[$row]=='India'):
        $dest[]=$cities[$row];
        $dest_val[$cities[$row]]=$cities[$row].' ('.$states[$row].', '.$countries[$row].')';
        else:
        $dest[]=$cities[$row];
        $dest_val[$cities[$row]]=$cities[$row].' ('.$countries[$row].')';
        endif;
        endforeach;
        endforeach;
        endif;
        $dest=array_unique($dest);
        $dest_val=array_unique($dest_val);
        $dest=$this->filter_array($dest, strtoupper(substr($destination_search_value, 0, 1)));
        $show=[];
        foreach($dest as $d) {
        $total_data=DB::table('rt_packages')
        ->where([['continent', 'like', '%' . $d . '%'],['status', '=', '1'],])
        ->orWhere([['country', 'like', '%' . $d . '%'],['status', '=', '1'],])
        ->orWhere([['state', 'like', '%' . $d . '%'],['status', '=', '1'],])
        ->orWhere([['city', 'like', '%' . $d . '%'],['status', '=', '1'],])
        ->get();
        $output='';
        if(array_key_exists($d, $dest_val))
        {
        $output.='<div class="item-name" des_value="'.$d.'">'.$dest_val[$d].' ('.count($total_data).')</div>';
        }
        else
        {
        $output.='<div class="item-name" des_value="'.$d.'">'.$d.' ('.count($total_data).')</div>';
        }
        }
        echo $output;
        else:
        $dest=['Goa','Kerala','Sikkim','Manali','Rajasthan','Singapore','Thailand','Dubai','Australia','Bali'];
        $dest=array_unique($dest);
        $show=[];
        $output='';
        foreach($dest as $d) {
        $output.='<div class="item-name" des_value="'.$d.'">'.$d.' </div>';
        }
        echo $output;
        endif;
    }*/
    
    // search tour package by theme (mobile)
    /*public function search_theme_mobile(Request $request) 
    {
        $search_theme=$request->search_theme;
        $getdata="";
        $data=DB::table('rt_packages')->where([['city', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->orwhere([['country', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->orwhere([['state', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->get();
        foreach($data as $data_theme):
        $data_value_theme=unserialize($data_theme->package_category);
        foreach($data_value_theme as $data_values ):
        $getdata.=$data_values.",";
        endforeach;
        endforeach;
        $theme_show='<div class="item-name" theme_value="All">All</div>';
        $theme_front_data=explode(",",$getdata);
        $theme_front_data=array_unique($theme_front_data);
        foreach($theme_front_data as $theme_front ):
        if($theme_front):
        $theme_show.='<div class="item-name" theme_value="'.$theme_front.'">'.$theme_front.'</div>';
        endif;
        endforeach;
        echo $theme_show;
        if($theme_show=="<option value=''>--Choose Theme--</option>"):
        $data=DB::table('rt_packages')->where([['continent', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->get();
        $getdata="";
        foreach($data as $data_theme):
        $data_value_theme=unserialize($data_theme->package_category);
        $count=count($data_value_theme);
        for($i=0;$i<$count;$i++) {
        $getdata.=$data_value_theme[$i].",";
        }
        endforeach;
        $theme_show1="";
        $theme_front_data=explode(",",$getdata);
        $theme_front_data=array_unique($theme_front_data);
        foreach($theme_front_data as $theme_front ):
        if($theme_front):
        $theme_show1.='<div class="item-name" theme_value="'.$theme_front.'">'.$theme_front.'</div>';
        endif;
        endforeach;
        echo $theme_show1;
        endif;
    }*/

    // ****************************************

    // Search for popular destinations in the search panel (desktop) - (OLD working)
    /*public function search_destination(Request $request)
    {
        // Initialize response variables
        $response = "";
        $response1 = "";
        $response2 = "";
        $response3 = "";
        
        // Get the search term from the request
        $destination_search_value = $request->searchTerm;

        // Proceed only if the search term length is greater than 1
        if (strlen($destination_search_value) > 1) {
            
            // Query the database to search for the term in various fields (continent, country, state, city)
            $data = DB::table('rt_packages')
                ->where([['continent', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['country', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['state', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['city', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->get();

            // If data is returned from the database
            if ($data) {
                // Initialize arrays to store destination results
                $dest = [];
                $dest_val = [];

                // Loop through the fetched data and process each package
                foreach ($data as $data_value) {
                    // Deserialize the continent data
                    $continents = unserialize($data_value->continent);
                    foreach ($continents as $continent) {
                        $dest[] = $continent;
                        // Uncomment to store continent values if needed
                        // $dest_val[$continent] = $continent;
                    }

                    // Deserialize the country data
                    $countries = unserialize($data_value->country);
                    foreach ($countries as $country) {
                        $dest[] = $country;
                        // Uncomment to store country values if needed
                        // $dest_val[$country] = $country;
                    }

                    // Deserialize the state data
                    $states = unserialize($data_value->state);
                    foreach ($states as $row => $col) {
                        if ($countries[$row] == 'India') {
                            $dest[] = $states[$row];
                            $dest_val[$states[$row]] = $states[$row] . ' (' . $countries[$row] . ')';
                        } else {
                            $dest[] = $states[$row];
                        }
                    }

                    // Deserialize the city data
                    $cities = unserialize($data_value->city);
                    foreach ($cities as $row => $col) {
                        if ($countries[$row] == 'India') {
                            $dest[] = $cities[$row];
                            $dest_val[$cities[$row]] = $cities[$row] . ' (' . $states[$row] . ', ' . $countries[$row] . ')';
                        } else {
                            $dest[] = $cities[$row];
                            $dest_val[$cities[$row]] = $cities[$row] . ' (' . $countries[$row] . ')';
                        }
                    }
                }
            }

            // Remove duplicate destinations
            $dest = array_unique($dest);
            $dest_val = array_unique($dest_val);

            // Filter the destination array based on the first letter of the search term (uppercase)
            $dest = $this->filter_array($dest, strtoupper(substr($destination_search_value, 0, 1)));

            // Prepare data for response
            $show = [];
            foreach ($dest as $d) {
                // Query the database to count the number of packages for each destination
                $total_data = DB::table('rt_packages')
                    ->where([['continent', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['country', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['state', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['city', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->get();

                // If the destination exists in the destination values array, format the text accordingly
                if (array_key_exists($d, $dest_val)) {
                    $show[] = ['id' => $d, 'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)'];
                } else {
                    $show[] = ['id' => $d, 'text' => $d . ' (' . count($total_data) . ' Packages)'];
                }
            }

            // Final data to be sent as response
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the final data as JSON
            echo json_encode($final_data);
        } else {
            // Default destinations if no search term or a short search term is provided
            $dest = ['Goa', 'Kerala', 'Sikkim', 'Manali', 'Rajasthan', 'Singapore', 'Thailand', 'Dubai', 'Australia', 'Bali'];
            $dest = array_unique($dest);

            // Prepare default destinations for display
            $show = [];
            foreach ($dest as $d) {
                $show[] = ['id' => $d, 'text' => $d];
            }

            // Return default destinations as JSON
            $final_data[] = ["text" => "Popular City", 'children' => $show];
            echo json_encode($final_data);
        }
        // echo $show3; // Optional debugging line
    }*/

    /*--------*/

    // Search for popular destinations in the search panel (desktop) - only package count in default destination list
    /*public function search_destination(Request $request)
    {
        // Initialize response variables
        $response = "";
        $response1 = "";
        $response2 = "";
        $response3 = "";
        
        // Get the search term from the request
        $destination_search_value = $request->searchTerm;

        // Default destinations when search term is empty or too short
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $dest = ['Goa', 'Kerala', 'Sikkim', 'Manali', 'Rajasthan', 'Singapore', 'Thailand', 'Dubai', 'Australia', 'Bali'];
            $dest = array_unique($dest);

            // Prepare default destinations for display
            $show = [];
            $dest_val = [
                'Goa' => 'Goa',
                'Kerala' => 'Kerala',
                'Sikkim' => 'Sikkim',
                'Manali' => 'Manali',
                'Rajasthan' => 'Rajasthan',
                'Singapore' => 'Singapore',
                'Thailand' => 'Thailand',
                'Dubai' => 'Dubai',
                'Australia' => 'Australia',
                'Bali' => 'Bali'
            ];

            foreach ($dest as $d) {
                // Query the database to count the number of packages for each destination
                $total_data = DB::table('rt_packages')
                    ->where([['continent', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['country', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['state', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['city', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->get();

                $show[] = [
                    'id' => $d,
                    'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)', // full display text
                    'value' => $d // the destination name for the input field
                ];
            }

            // Return default destinations as JSON
            $final_data[] = ["text" => "Popular City", 'children' => $show];
            return response()->json($final_data); // Return the default response
        }


        // Proceed only if the search term length is greater than 1
        if (strlen($destination_search_value) > 1) {
            
            // Query the database to search for the term in various fields (continent, country, state, city)
            $data = DB::table('rt_packages')
                ->where([['continent', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['country', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['state', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['city', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->get();

            // If data is returned from the database
            if ($data) {
                // Initialize arrays to store destination results
                $dest = [];
                $dest_val = [];

                // Loop through the fetched data and process each package
                foreach ($data as $data_value) {
                    // Deserialize the continent data
                    $continents = unserialize($data_value->continent);
                    foreach ($continents as $continent) {
                        $dest[] = $continent;
                        // Uncomment to store continent values if needed
                        // $dest_val[$continent] = $continent;
                    }

                    // Deserialize the country data
                    $countries = unserialize($data_value->country);
                    foreach ($countries as $country) {
                        $dest[] = $country;
                        // Uncomment to store country values if needed
                        // $dest_val[$country] = $country;
                    }

                    // Deserialize the state data
                    $states = unserialize($data_value->state);
                    foreach ($states as $row => $col) {
                        if ($countries[$row] == 'India') {
                            $dest[] = $states[$row];
                            $dest_val[$states[$row]] = $states[$row] . ' (' . $countries[$row] . ')';
                        } else {
                            $dest[] = $states[$row];
                        }
                    }

                    // Deserialize the city data
                    $cities = unserialize($data_value->city);
                    foreach ($cities as $row => $col) {
                        if ($countries[$row] == 'India') {
                            $dest[] = $cities[$row];
                            $dest_val[$cities[$row]] = $cities[$row] . ' (' . $states[$row] . ', ' . $countries[$row] . ')';
                        } else {
                            $dest[] = $cities[$row];
                            $dest_val[$cities[$row]] = $cities[$row] . ' (' . $countries[$row] . ')';
                        }
                    }
                }
            }

            // Remove duplicate destinations
            $dest = array_unique($dest);
            $dest_val = array_unique($dest_val);

            // Filter the destination array based on the first letter of the search term (uppercase)
            $dest = $this->filter_array($dest, strtoupper(substr($destination_search_value, 0, 1)));

            // Prepare data for response
            $show = [];
            foreach ($dest as $d) {
                // Query the database to count the number of packages for each destination
                $total_data = DB::table('rt_packages')
                    ->where([['continent', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['country', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['state', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['city', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->get();

                // If the destination exists in the destination values array, format the text accordingly
                // if (array_key_exists($d, $dest_val)) {
                //     $show[] = [
                //         'id' => $d, 
                //         'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)'
                //     ];
                // } else {
                //     $show[] = [
                //         'id' => $d, 
                //         'text' => $d . ' (' . count($total_data) . ' Packages)'
                //     ];
                // }

                // If the destination exists in the destination values array, format the text accordingly
                if (array_key_exists($d, $dest_val)) {
                    // Add the formatted name as the 'text' and simple destination name as the 'value'
                    $show[] = [
                        'id' => $d, 
                        'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)', // full display text
                        'value' => $d // the destination name for the input field
                    ];
                } else {
                    // If not in the destination values array, use the simple destination name as 'text' and 'value'
                    $show[] = [
                        'id' => $d, 
                        'text' => $d . ' (' . count($total_data) . ' Packages)', // full display text
                        'value' => $d // the destination name for the input field
                    ];
                }
            }

            // Final data to be sent as response
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the final data as JSON
            return response()->json($final_data);
        }
    }*/

    /*--------*/

    // Search for popular destinations in the search panel (desktop) - state and city with package count in default destination list (working on name) (old)
    /*public function search_destination(Request $request)
    {
        // Initialize response variables
        $response = "";
        $response1 = "";
        $response2 = "";
        $response3 = "";
        
        // Get the search term from the request
        $destination_search_value = $request->searchTerm;

        // Default destinations when search term is empty or too short
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $dest = ['Goa', 'Kerala', 'Sikkim', 'Shimla', 'Rajasthan', 'Singapore', 'Thailand', 'Dubai', 'Australia', 'Bali'];
            $dest = array_unique($dest);

            // Initialize arrays to store destination names and values
            $show = [];
            $dest_val = [];

            foreach ($dest as $d) {
                // Query the database to count the number of packages for each destination
                $total_data = DB::table('rt_packages')
                    ->where([['continent', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['country', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['state', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['city', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->get();

                // Fetch dynamic state and country names from the database
                $dest_val[$d] = $this->getDestinationStateCountry($d);

                // Add the formatted destination to the list
                $show[] = [
                    'id' => $d,
                    'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)', // full display text
                    'value' => $d // the destination name for the input field
                ];
            }

            // Return the default destinations with dynamic state and country information
            $final_data[] = ["text" => "Popular City", 'children' => $show];
            return response()->json($final_data); // Return the default response
        }

        // Proceed only if the search term length is greater than 1
        if (strlen($destination_search_value) > 1) {
            
            // Query the database to search for the term in various fields (continent, country, state, city)
            $data = DB::table('rt_packages')
                ->where([['continent', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['country', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['state', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->orWhere([['city', 'like', '%' . $destination_search_value . '%'], ['status', '=', '1']])
                ->get();

            // Initialize arrays to store destination results
            $dest = [];
            $dest_val = [];

            // Loop through the fetched data and process each package
            foreach ($data as $data_value) {
                // Deserialize the continent data
                $continents = unserialize($data_value->continent);
                foreach ($continents as $continent) {
                    $dest[] = $continent;
                }

                // Deserialize the country data
                $countries = unserialize($data_value->country);
                foreach ($countries as $country) {
                    $dest[] = $country;
                }

                // Deserialize the state data
                $states = unserialize($data_value->state);
                foreach ($states as $row => $col) {
                    if ($countries[$row] == 'India') {
                        $dest[] = $states[$row];
                        $dest_val[$states[$row]] = $states[$row] . ' (' . $countries[$row] . ')';
                    } else {
                        $dest[] = $states[$row];
                    }
                }

                // Deserialize the city data
                $cities = unserialize($data_value->city);
                foreach ($cities as $row => $col) {
                    if ($countries[$row] == 'India') {
                        $dest[] = $cities[$row];
                        $dest_val[$cities[$row]] = $cities[$row] . ' (' . $states[$row] . ', ' . $countries[$row] . ')';
                    } else {
                        $dest[] = $cities[$row];
                        $dest_val[$cities[$row]] = $cities[$row] . ' (' . $countries[$row] . ')';
                    }
                }
            }

            // Remove duplicate destinations
            $dest = array_unique($dest);
            $dest_val = array_unique($dest_val);

            // Filter the destination array based on the first letter of the search term (uppercase)
            $dest = $this->filter_array($dest, strtoupper(substr($destination_search_value, 0, 1)));

            // Prepare data for response
            $show = [];
            foreach ($dest as $d) {
                // Query the database to count the number of packages for each destination
                $total_data = DB::table('rt_packages')
                    ->where([['continent', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['country', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['state', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->orWhere([['city', 'like', '%' . $d . '%'], ['status', '=', '1']])
                    ->get();

                // Format the text with state and country details dynamically
                if (array_key_exists($d, $dest_val)) {
                    $show[] = [
                        'id' => $d, 
                        'text' => $dest_val[$d] . ' (' . count($total_data) . ' Packages)', // full display text
                        'value' => $d // the destination name for the input field
                    ];
                } else {
                    $show[] = [
                        'id' => $d, 
                        'text' => $d . ' (' . count($total_data) . ' Packages)', // full display text
                        'value' => $d // the destination name for the input field
                    ];
                }
            }

            // Final data to be sent as response
            $final_data[] = ["text" => "Suggestion", 'children' => $show];

            // Return the final data as JSON
            return response()->json($final_data);
        }
    }

    // Method to dynamically fetch the destination state and country information
    private function getDestinationStateCountry($destination)
    {
        // Query the database to get state and country details for a given destination
        $data = DB::table('rt_packages')
            ->where([['city', 'like', '%' . $destination . '%'], ['status', '=', '1']])
            ->orWhere([['state', 'like', '%' . $destination . '%'], ['status', '=', '1']])
            ->orWhere([['country', 'like', '%' . $destination . '%'], ['status', '=', '1']])
            ->first();

        if ($data) {
            // If found, return the state and country information dynamically
            $countries = unserialize($data->country);
            $states = unserialize($data->state);
            $cities = unserialize($data->city);
            
            // If the destination matches a state or city, return the appropriate information
            foreach ($cities as $index => $city) {
                if (strpos($city, $destination) !== false) {
                    return $city . ' (' . $states[$index] . ', ' . $countries[$index] . ')';
                }
            }

            foreach ($states as $index => $state) {
                if (strpos($state, $destination) !== false) {
                    return $state . ' (' . $countries[$index] . ')';
                }
            }

            return $destination . ' (' . $countries[0] . ')'; // Return city/country if no match for state
        }
        return $destination; // If no match found, return the destination as is
    }*/

    /*--------*/

    // Search for popular destinations in the search panel (desktop) - state and city with package count in default destination list (by Raj)
    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        // If search term is empty or too short, return default popular destinations
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $defaultDestinations = ['Goa', 'Kerala', 'Sikkim', 'Shimla', 'Rajasthan', 'Singapore', 'Thailand', 'Dubai', 'Australia', 'Bali'];
            $defaultDestinations = array_unique($defaultDestinations);

            $show = [];
            foreach ($defaultDestinations as $d) {
                // Count packages available for each destination
                $packageCount = DB::table('rt_packages')
                    ->where(function ($query) use ($d) {
                        $query->where('continent', 'like', "%$d%")
                            ->orWhere('country', 'like', "%$d%")
                            ->orWhere('state', 'like', "%$d%")
                            ->orWhere('city', 'like', "%$d%");
                    })
                    ->where('status', 1)
                    ->count();

                // Fetch properly formatted destination name
                $destinationText = $this->getDestinationStateCountry($d);
                $show[] = [
                    'id' => $d,
                    'text' => "$destinationText ($packageCount Packages)",
                    'value' => $d
                ];
            }
            return response()->json([["text" => "Popular City", 'children' => $show]]);
        }



        // Fetch matching destinations from the database
        $matchingContinentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $matchingCountryIds = DB::table('countries')->where('name', 'LIKE', "$destination_search_value%")->pluck('id','continent_id')->toArray();
        $matchingStateIds   = DB::table('states','country_id')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $matchingCityIds    = DB::table('city','state_id')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $matchingIds = array_merge($matchingContinentIds, $matchingCountryIds, $matchingStateIds, $matchingCityIds);


         $destinations = DB::table('rt_packages')
        ->where('status', 1)
        ->get(['continent', 'country', 'state', 'city'])
        ->filter(function ($package) use ($matchingIds) {
            $continentIds = @unserialize($package->continent) ?: [];
            $countryIds = @unserialize($package->country) ?: [];
            $stateIds = @unserialize($package->state) ?: [];
            $cityIds = @unserialize($package->city) ?: [];

            return array_intersect($matchingIds, $continentIds) ||
                   array_intersect($matchingIds, $countryIds) ||
                   array_intersect($matchingIds, $stateIds) ||
                   array_intersect($matchingIds, $cityIds);
        });

        $dest = [];
        $dest_val = [];

        $continentNames = DB::table('continent')->whereIn('id', $matchingIds)->pluck('continent_name', 'id')->toArray();
        $countryNames = DB::table('countries')->whereIn('id', $matchingIds)->pluck('name', 'id')->toArray();
        $stateNames = DB::table('states')->whereIn('id', $matchingIds)->pluck('name', 'id')->toArray();
        $cityNames = DB::table('city')->whereIn('id', $matchingIds)->pluck('name', 'id')->toArray();



        foreach ($destinations as $data) {
            $continents = unserialize($data->continent) ?: [];
            $countries = unserialize($data->country) ?: [];
            $states = unserialize($data->state) ?: [];
            $cities = unserialize($data->city) ?: [];

            foreach ($continents as $continent) {
                if (isset($continentNames[$continent])) {
                    $dest[$continent] = $continentNames[$continent];
                }
            }

            foreach ($countries as $country) {
                if (isset($countryNames[$country])) {
                    $dest[$country] = $countryNames[$country];
                }
            }

            foreach ($states as $index => $state) {
                if (isset($stateNames[$state])) {
                    $stateName = $stateNames[$state];
                    $countryName = isset($countries[$index]) && isset($countryNames[$countries[$index]]) ? $countryNames[$countries[$index]] : '';
                    $dest[$state] = $countryName ? "$stateName ($countryName)" : $stateName;
                }
            }

            foreach ($cities as $index => $city) {
                if (isset($cityNames[$city])) {
                    $cityName = $cityNames[$city];
                    $stateName = isset($states[$index]) && isset($stateNames[$states[$index]]) ? $stateNames[$states[$index]] : '';
                    $countryName = isset($countries[$index]) && isset($countryNames[$countries[$index]]) ? $countryNames[$countries[$index]] : '';

                    if ($stateName && $countryName) {
                        $dest[$city] = "$cityName ($stateName, $countryName)";
                    } elseif ($countryName) {
                        $dest[$city] = "$cityName ($countryName)";
                    } else {
                        $dest[$city] = $cityName;
                    }
                }
            }
        }

        $dest = array_unique($dest);
        // $dest = $this->filter_array($dest, strtoupper($destination_search_value[0]));
              
        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

         $packageCounts = [];
         foreach ($allPackages as $package) {
            $continents = @unserialize($package->continent) ?: [];
            $countries = @unserialize($package->country) ?: [];
            $states = @unserialize($package->state) ?: [];
            $cities = @unserialize($package->city) ?: [];

            $allDestinations = array_merge($continents, $countries, $states, $cities);

            foreach ($allDestinations as $destinationId) {
                if (!isset($packageCounts[$destinationId])) {
                    $packageCounts[$destinationId] = 0;
                }
                $packageCounts[$destinationId]++;
            }
        }

        $show = [];   
        foreach ($dest as $destinationId => $destinationName) {
            $count = isset($packageCounts[$destinationId]) ? $packageCounts[$destinationId] : 0;

            $show[] = [
                'id' => $destinationId,
                'text' => "$destinationName ($count Packages)",
                'value' => $destinationId
            ];
        }




        return response()->json([["text" => "Suggestion", 'children' => $show]]);
    }

    //Fetches the state and country for a given destination
    private function getDestinationStateCountry($destination)
    {
        $data = DB::table('rt_packages')
            ->where(function ($query) use ($destination) {
                $query->where('city', 'like', "%$destination%")
                    ->orWhere('state', 'like', "%$destination%")
                    ->orWhere('country', 'like', "%$destination%");
            })
            ->where('status', 1)
            ->first(['country', 'state', 'city']);

        if (!$data) {
            return $destination;
        }

        $countries = unserialize($data->country) ?: [];
        $states = unserialize($data->state) ?: [];
        $cities = unserialize($data->city) ?: [];

        foreach ($cities as $index => $city) {
            if (stripos($city, $destination) !== false) {
                return "$city ({$states[$index]}, {$countries[$index]})";
            }
        }

        foreach ($states as $index => $state) {
            if (stripos($state, $destination) !== false) {
                return "$state ({$countries[$index]})";
            }
        }

        return isset($countries[0]) ? "$destination ({$countries[0]})" : $destination;
    }*/

    /*--------*/

    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            // Default destinations logic (optional fallback or modified to use default IDs if needed)
            return response()->json([]);
        }

        // Step 1: Match names from individual tables to get IDs
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $countryIds   = DB::table('countries')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $stateIds     = DB::table('states')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $cityIds      = DB::table('city')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();

        $allMatchingIds = array_merge($continentIds, $countryIds, $stateIds, $cityIds);

        // Step 2: Get matching packages
        $packages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

        $destMap = []; // To hold deduplicated label text
        foreach ($packages as $pkg) {
            $pkgContinents = unserialize($pkg->continent) ?: [];
            $pkgCountries  = unserialize($pkg->country) ?: [];
            $pkgStates     = unserialize($pkg->state) ?: [];
            $pkgCities     = unserialize($pkg->city) ?: [];

            foreach ($pkgCities as $i => $cityId) {
                if (in_array($cityId, $allMatchingIds)) {
                    $cityName  = CustomHelpers::get_master_table_data('city', 'id', $cityId, 'name');
                    $stateName = isset($pkgStates[$i]) ? CustomHelpers::get_master_table_data('states', 'id', $pkgStates[$i], 'name') : '';
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label = trim("$cityName ($stateName, $countryName)", ' (,)');
                    $destMap[$cityId] = $label;
                }
            }

            foreach ($pkgStates as $i => $stateId) {
                if (in_array($stateId, $allMatchingIds)) {
                    $stateName = CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name');
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label = trim("$stateName ($countryName)", ' (,)');
                    $destMap[$stateId] = $label;
                }
            }

            foreach ($pkgCountries as $countryId) {
                if (in_array($countryId, $allMatchingIds)) {
                    $countryName = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name');
                    $destMap[$countryId] = $countryName;
                }
            }

            foreach ($pkgContinents as $continentId) {
                if (in_array($continentId, $allMatchingIds)) {
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $destMap[$continentId] = $continentName;
                }
            }
        }

        // Step 3: Count packages for each label
        $response = [];
        foreach ($destMap as $id => $label) {
            $packageCount = DB::table('rt_packages')
                ->where('status', 1)
                ->where(function ($query) use ($id) {
                    $query->orWhere('continent', 'like', "%$id%")
                        ->orWhere('country', 'like', "%$id%")
                        ->orWhere('state', 'like', "%$id%")
                        ->orWhere('city', 'like', "%$id%");
                })
                ->count();

            $response[] = [
                'id' => $id,
                'text' => "$label ($packageCount Packages)",
                'value' => $label,
            ];
        }

        return response()->json([["text" => "Suggestions", "children" => $response]]);
    }*/

    /*--------*/

    // Home search panel (desktop) - state and city with package count in default (manual)destination list (working) (new)
    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        //$defaultDestinations = ['Goa', 'Kerala', 'Sikkim', 'Shimla', 'Rajasthan', 'Singapore', 'Thailand', 'Dubai', 'Australia', 'Bali'];

        // ✅ Show default destinations when search is empty or too short (search id->name)
        // if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
        //     $defaultDestinations = [
        //         ["id" => 5304, "value" => "Srinagar", "text" => "Srinagar"],
        //         ["id" => 733, "value" => "Goa", "text" => "Goa"],
        //         ["id" => 19, "value" => "Kerala", "text" => "Kerala"],
        //         ["id" => 34, "value" => "Sikkim", "text" => "Sikkim"],
        //         ["id" => 1262, "value" => "Shimla", "text" => "Shimla"],
        //         ["id" => 217, "value" => "Thailand", "text" => "Thailand"],
        //         ["id" => 41391, "value" => "Dubai", "text" => "Dubai"],
        //         ["id" => 48331, "value" => "Bali", "text" => "Bali"],            
        //         ["id" => 132, "value" => "Malaysia", "text" => "Malaysia"],
        //     ];

        //     return response()->json([
        //         ["text" => "Popular Destinations", "children" => $defaultDestinations]
        //     ]);
        // }

        // ✅ Show default destinations when search is empty or too short (search name->id)
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"]; // always check on frontend
            $defaultDestinations = [];

            foreach ($defaultNames as $name) {
                // Try to find in City
                $record = DB::table('city')->where('name', $name)->first();
                if (!$record) {
                    // Try to find in State
                    $record = DB::table('states')->where('name', $name)->first();
                }
                if (!$record) {
                    // Try to find in Country
                    $record = DB::table('countries')->where('name', $name)->first();
                }
                if (!$record) {
                    // Try to find in Continent
                    $record = DB::table('continent')->where('continent_name', $name)->first();
                }

                if ($record) {
                    $defaultDestinations[] = [
                        'id' => $record->id,
                        'value' => $name,
                        'text' => $name,
                    ];
                }
            }

            return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        }


        // Step 1: Match names from individual tables to get IDs
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $countryIds   = DB::table('countries')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $stateIds     = DB::table('states')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $cityIds      = DB::table('city')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();

        $allMatchingIds = array_merge($continentIds, $countryIds, $stateIds, $cityIds);

        // Step 2: Get matching packages
        $packages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

        $destMap = []; // To hold deduplicated label text
        foreach ($packages as $pkg) {
            $pkgContinents = unserialize($pkg->continent) ?: [];
            $pkgCountries  = unserialize($pkg->country) ?: [];
            $pkgStates     = unserialize($pkg->state) ?: [];
            $pkgCities     = unserialize($pkg->city) ?: [];

            foreach ($pkgCities as $i => $cityId) {
                if (in_array($cityId, $allMatchingIds)) {
                    $cityName    = CustomHelpers::get_master_table_data('city', 'id', $cityId, 'name');
                    $stateName   = isset($pkgStates[$i]) ? CustomHelpers::get_master_table_data('states', 'id', $pkgStates[$i], 'name') : '';
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label = trim("$cityName ($stateName, $countryName)", ' (,)');
                    $destMap[$cityId] = $label;
                }
            }

            foreach ($pkgStates as $i => $stateId) {
                if (in_array($stateId, $allMatchingIds)) {
                    $stateName   = CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name');
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label = trim("$stateName ($countryName)", ' (,)');
                    $destMap[$stateId] = $label;
                }
            }

            foreach ($pkgCountries as $countryId) {
                if (in_array($countryId, $allMatchingIds)) {
                    $countryName = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name');
                    $destMap[$countryId] = $countryName;
                }
            }

            foreach ($pkgContinents as $continentId) {
                if (in_array($continentId, $allMatchingIds)) {
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $destMap[$continentId] = $continentName;
                }
            }
        }

        // Step 3: Count packages for each label
        $response = [];
        foreach ($destMap as $id => $label) {
            $packageCount = DB::table('rt_packages')
                ->where('status', 1)
                ->where(function ($query) use ($id) {
                    $query->orWhere('continent', 'like', "%$id%")
                        ->orWhere('country', 'like', "%$id%")
                        ->orWhere('state', 'like', "%$id%")
                        ->orWhere('city', 'like', "%$id%");
                })
                ->count();

            $response[] = [
                'id' => $id,
                'text' => "$label ($packageCount Packages)",
                'value' => $label,
            ];
        }

        return response()->json([
            ["text" => "Suggestions", "children" => $response]
        ]);
    }*/

    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        // ✅ Show default destinations when search is empty or too short
        // if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
        //     $defaultDestinations = [
        //         ["id" => 5304, "value" => "Srinagar", "text" => "Srinagar"],
        //         ["id" => 733, "value" => "Goa", "text" => "Goa"],
        //         ["id" => 19, "value" => "Kerala", "text" => "Kerala"],
        //         ["id" => 34, "value" => "Sikkim", "text" => "Sikkim"],
        //         ["id" => 1262, "value" => "Shimla", "text" => "Shimla"],
        //         ["id" => 217, "value" => "Thailand", "text" => "Thailand"],
        //         ["id" => 41391, "value" => "Dubai", "text" => "Dubai"],
        //         ["id" => 48331, "value" => "Bali", "text" => "Bali"],
        //         ["id" => 132, "value" => "Malaysia", "text" => "Malaysia"],
        //     ];
        //     return response()->json([["text" => "Top Destinations", "children" => $defaultDestinations]]);
        // }

        // ✅ Show default destinations when search is empty or too short (search name->id) (only City)
        // if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
        //     $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"]; // always check on frontend
        //     $defaultDestinations = [];

        //     foreach ($defaultNames as $name) {
        //         // Try to find in City
        //         $record = DB::table('city')->where('name', $name)->first();
        //         if (!$record) {
        //             // Try to find in State
        //             $record = DB::table('states')->where('name', $name)->first();
        //         }
        //         if (!$record) {
        //             // Try to find in Country
        //             $record = DB::table('countries')->where('name', $name)->first();
        //         }
        //         if (!$record) {
        //             // Try to find in Continent
        //             $record = DB::table('continent')->where('continent_name', $name)->first();
        //         }

        //         if ($record) {
        //             $defaultDestinations[] = [
        //                 'id' => $record->id,
        //                 'value' => $name,
        //                 'text' => $name,
        //             ];
        //         }
        //     }

        //     return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        // }

        // ✅ Show default destinations when search is empty or too short (search name->id) (City with Country)
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"];
            $defaultDestinations = [];

            foreach ($defaultNames as $name) {
                $record = null;
                $label = '';

                // 1. Check in City
                $record = DB::table('city')->where('name', $name)->first();
                if ($record) {
                    $state = DB::table('states')->where('id', $record->state_id)->first();
                    $country = DB::table('countries')->where('id', $state->country_id ?? null)->first();
                    $label = $record->name . ', ' . ($country->name ?? '');
                }

                // 2. Check in State
                if (!$record) {
                    $record = DB::table('states')->where('name', $name)->first();
                    if ($record) {
                        $country = DB::table('countries')->where('id', $record->country_id)->first();
                        $label = $record->name . ', ' . ($country->name ?? '');
                    }
                }

                // 3. Check in Country
                if (!$record) {
                    $record = DB::table('countries')->where('name', $name)->first();
                    if ($record) {
                        $continent = DB::table('continent')->where('id', $record->continent_id)->first();
                        $label = $record->name . ', ' . ($continent->continent_name ?? '');
                    }
                }

                // 4. Check in Continent
                if (!$record) {
                    $record = DB::table('continent')->where('continent_name', $name)->first();
                    if ($record) {
                        $label = $record->continent_name;
                    }
                }

                // Push to list if record found
                if ($record) {
                    $defaultDestinations[] = [
                        'id' => $record->id,
                        'value' => $name,
                        'text' => $label,
                    ];
                }
            }

            return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        }



        // ✅ Match against continent, country, state, city
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $countryIds   = DB::table('countries')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $stateIds     = DB::table('states')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $cityIds      = DB::table('city')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();

        $allMatchingIds = array_merge($continentIds, $countryIds, $stateIds, $cityIds);

        // ✅ Get all active packages
        $packages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

        // ✅ Helper function to clean labels (city -> state -> country)
        // $buildLabel = function ($city = '', $state = '', $country = '') {
        //     $parts = array_filter([$city, $state, $country]);
        //     return implode(', ', $parts);
        // };

        // ✅ Helper function to clean labels (city -> country)
        $buildLabel = function ($city = '', $state = '', $country = '') {
            $parts = array_filter([$city, $state, $country]);
            $uniqueParts = array_unique($parts);

            // Example logic: show at least City + Country if different
            if (count($uniqueParts) === 1) {
                return $uniqueParts[0]; // Just "Singapore"
            }

            return implode(', ', $uniqueParts); // "Singapore, Malaysia" etc.
        };


        $destMap = [];

        foreach ($packages as $pkg) {
            $pkgContinents = unserialize($pkg->continent) ?: [];
            $pkgCountries  = unserialize($pkg->country) ?: [];
            $pkgStates     = unserialize($pkg->state) ?: [];
            $pkgCities     = unserialize($pkg->city) ?: [];

            foreach ($pkgCities as $i => $cityId) {
                if (in_array($cityId, $allMatchingIds)) {
                    $cityName    = CustomHelpers::get_master_table_data('city', 'id', $cityId, 'name');
                    $stateName   = isset($pkgStates[$i]) ? CustomHelpers::get_master_table_data('states', 'id', $pkgStates[$i], 'name') : '';
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label       = $buildLabel($cityName, $stateName, $countryName);
                    $destMap[$cityId . '-city'] = $label;
                }
            }

            foreach ($pkgStates as $i => $stateId) {
                if (in_array($stateId, $allMatchingIds)) {
                    $stateName   = CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name');
                    $countryName = isset($pkgCountries[$i]) ? CustomHelpers::get_master_table_data('countries', 'id', $pkgCountries[$i], 'name') : '';
                    $label       = $buildLabel($stateName, $countryName);
                    $destMap[$stateId . '-state'] = $label;
                }
            }

            foreach ($pkgCountries as $countryId) {
                if (in_array($countryId, $allMatchingIds)) {
                    $countryName = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name');
                    $label       = $buildLabel($countryName);
                    $destMap[$countryId . '-country'] = $label;
                }
            }

            foreach ($pkgContinents as $continentId) {
                if (in_array($continentId, $allMatchingIds)) {
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $label         = $buildLabel($continentName);
                    $destMap[$continentId . '-continent'] = $label;
                }
            }
        }

        // ✅ Deduplicate by label and keep one ID
        $labelToIdMap = [];
        foreach ($destMap as $id => $label) {
            if (!in_array($label, array_keys($labelToIdMap))) {
                $labelToIdMap[$label] = $id;
            }
        }

        // ✅ Final formatted response
        $response = [];
        foreach ($labelToIdMap as $label => $id) {
            $numericId = explode('-', $id)[0]; // strip "-city"/"-state"/etc. suffix
            $packageCount = DB::table('rt_packages')
                ->where('status', 1)
                ->where(function ($query) use ($numericId) {
                    $query->orWhere('continent', 'like', "%$numericId%")
                        ->orWhere('country', 'like', "%$numericId%")
                        ->orWhere('state', 'like', "%$numericId%")
                        ->orWhere('city', 'like', "%$numericId%");
                })
                ->count();

            $response[] = [
                'id'    => $numericId,
                'text'  => "$label ($packageCount Packages)",
                'value' => $label,
            ];
        }

        return response()->json([["text" => "Suggestions", "children" => $response]]);
    }*/

    // Home search panel (desktop) - state and city with package count in default (automatic)destination list (working) (new)
    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        // ✅ Show default destinations when search is empty or too short
        // if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
        //     $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"];
        //     $defaultDestinations = [];

        //     foreach ($defaultNames as $name) {
        //         $record = null;
        //         $label = '';

        //         // 1. Check in City
        //         $record = DB::table('city')->where('name', $name)->first();
        //         if ($record) {
        //             $state = DB::table('states')->where('id', $record->state_id)->first();
        //             $country = DB::table('countries')->where('id', $state->country_id ?? null)->first();
        //             $label = $record->name . ', ' . ($country->name ?? '');
        //         }

        //         // 2. Check in State
        //         if (!$record) {
        //             $record = DB::table('states')->where('name', $name)->first();
        //             if ($record) {
        //                 $country = DB::table('countries')->where('id', $record->country_id)->first();
        //                 $label = $record->name . ', ' . ($country->name ?? '');
        //             }
        //         }

        //         // 3. Check in Country
        //         if (!$record) {
        //             $record = DB::table('countries')->where('name', $name)->first();
        //             if ($record) {
        //                 $continent = DB::table('continent')->where('id', $record->continent_id)->first();
        //                 $label = $record->name . ', ' . ($continent->continent_name ?? '');
        //             }
        //         }

        //         // 4. Check in Continent
        //         if (!$record) {
        //             $record = DB::table('continent')->where('continent_name', $name)->first();
        //             if ($record) {
        //                 $label = $record->continent_name;
        //             }
        //         }

        //         // Push to list if record found
        //         if ($record) {
        //             $defaultDestinations[] = [
        //                 'id' => $record->id,
        //                 'value' => $name,
        //                 'text' => $label,
        //             ];
        //         }
        //     }

        //     return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        // }

        // city and country matching
        // if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
        //     $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"];
        //     $defaultDestinations = [];

        //     foreach ($defaultNames as $name) {
        //         $record = null;
        //         $label = '';
        //         $matchedCity = null;

        //         // 1. Check in City (with specific country match)
        //         $cities = DB::table('city')->where('name', $name)->get();
        //         foreach ($cities as $city) {
        //             $state = DB::table('states')->where('id', $city->state_id)->first();
        //             $country = DB::table('countries')->where('id', $state->country_id ?? null)->first();

        //             // Check if a package exists for the city-country pair
        //             $packageExists = DB::table('rt_packages')
        //                 ->where('city', 'LIKE', "%{$city->id}%")
        //                 ->where('country', 'LIKE', "%{$country->id}%")
        //                 ->exists();

        //             if ($packageExists) {
        //                 // Set the city-country pair with the label "City, Country"
        //                 $label = $city->name . ', ' . ($country->name ?? '');
        //                 $matchedCity = $city;
        //                 break; // stop if we find a match
        //             }
        //         }

        //         // 2. Check in State (only if no city-country match was found)
        //         if (!$matchedCity) {
        //             $record = DB::table('states')->where('name', $name)->first();
        //             if ($record) {
        //                 $country = DB::table('countries')->where('id', $record->country_id)->first();
        //                 $label = $record->name . ', ' . ($country->name ?? '');
        //             }
        //         }

        //         // 3. Check in Country
        //         if (!$matchedCity && !$record) {
        //             $record = DB::table('countries')->where('name', $name)->first();
        //             if ($record) {
        //                 $continent = DB::table('continent')->where('id', $record->continent_id)->first();
        //                 $label = $record->name . ($continent ? ', ' . $continent->continent_name : '');
        //             }
        //         }

        //         // 4. Check in Continent
        //         if (!$matchedCity && !$record) {
        //             $record = DB::table('continent')->where('continent_name', $name)->first();
        //             if ($record) {
        //                 $label = $record->continent_name;
        //             }
        //         }

        //         // Push to list if record found
        //         if ($matchedCity) {
        //             $defaultDestinations[] = [
        //                 'id' => $matchedCity->id,
        //                 'value' => $name,
        //                 'text' => $label,
        //             ];
        //         }
        //     }

        //     return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        // }

        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {
            $defaultNames = ["gangtok", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"];
            $defaultDestinations = [];

            foreach ($defaultNames as $name) {
                $record = null;
                $label = '';
                $matchedDestination = null;

                // 1. City and Country Matching
                $cities = DB::table('city')->where('name', $name)->get();
                foreach ($cities as $city) {
                    $state = DB::table('states')->where('id', $city->state_id)->first();
                    $country = DB::table('countries')->where('id', $state->country_id ?? null)->first();

                    // Check if a package exists for the city-country pair
                    $packageExists = DB::table('rt_packages')
                        ->where('city', 'LIKE', "%{$city->id}%")
                        ->where('country', 'LIKE', "%{$country->id}%")
                        ->exists();

                    if ($packageExists) {
                        $label = $city->name . ', ' . ($country->name ?? '');
                        $matchedDestination = $city;
                        break; // stop if we find a match
                    }
                }

                // 2. State and Country Matching (if no city-country match)
                if (!$matchedDestination) {
                    $states = DB::table('states')->where('name', $name)->get();
                    foreach ($states as $state) {
                        $country = DB::table('countries')->where('id', $state->country_id)->first();

                        // Check if a package exists for the state-country pair
                        $packageExists = DB::table('rt_packages')
                            ->where('state', 'LIKE', "%{$state->id}%")
                            ->where('country', 'LIKE', "%{$country->id}%")
                            ->exists();

                        if ($packageExists) {
                            $label = $state->name . ', ' . ($country->name ?? '');
                            $matchedDestination = $state;
                            break;
                        }
                    }
                }

                // 3. Country and Continent Matching (if no state-country match)
                if (!$matchedDestination) {
                    $countries = DB::table('countries')->where('name', $name)->get();
                    foreach ($countries as $country) {
                        $continent = DB::table('continent')->where('id', $country->continent_id)->first();

                        // Check if a package exists for the country-continent pair
                        $packageExists = DB::table('rt_packages')
                            ->where('country', 'LIKE', "%{$country->id}%")
                            ->where('continent', 'LIKE', "%{$continent->id}%")
                            ->exists();

                        if ($packageExists) {
                            $label = $country->name . ', ' . ($continent->continent_name ?? '');
                            $matchedDestination = $country;
                            break;
                        }
                    }
                }

                // 4. Continent Matching (if no country-continent match)
                if (!$matchedDestination) {
                    $continents = DB::table('continent')->where('continent_name', $name)->get();
                    foreach ($continents as $continent) {
                        // Check if a package exists for the continent
                        $packageExists = DB::table('rt_packages')
                            ->where('continent', 'LIKE', "%{$continent->id}%")
                            ->exists();

                        if ($packageExists) {
                            $label = $continent->continent_name;
                            $matchedDestination = $continent;
                            break;
                        }
                    }
                }

                // Push to list if record found
                if ($matchedDestination) {
                    $defaultDestinations[] = [
                        'id' => $matchedDestination->id,
                        'value' => $name,
                        'text' => $label,
                    ];
                }
            }

            return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        }

        // search destination
        // ✅ Match against continent, country, state, city
        $continentIds = DB::table('continent')->where('continent_name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $countryIds   = DB::table('countries')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $stateIds     = DB::table('states')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();
        $cityIds      = DB::table('city')->where('name', 'LIKE', "$destination_search_value%")->pluck('id')->toArray();

        $allMatchingIds = array_merge($continentIds, $countryIds, $stateIds, $cityIds);

        // ✅ Get all active packages
        $packages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

        // ✅ Label builder (based on type)
        $buildLabel = function ($type, $first = '', $second = '', $third = '') {
            if ($type === 'city') {
                return trim("{$first}, {$third}");
            } elseif ($type === 'state') {
                return trim("{$first}, {$third}");
            } elseif ($type === 'country') {
                return trim("{$first}, {$second}");
            } elseif ($type === 'continent') {
                return $first;
            }
            return $first;
        };

        $destMap = [];

        foreach ($packages as $pkg) {
            $pkgContinents = unserialize($pkg->continent) ?: [];
            $pkgCountries  = unserialize($pkg->country) ?: [];
            $pkgStates     = unserialize($pkg->state) ?: [];
            $pkgCities     = unserialize($pkg->city) ?: [];

            foreach ($pkgCities as $i => $cityId) {
                if (in_array($cityId, $allMatchingIds)) {
                    $cityName    = CustomHelpers::get_master_table_data('city', 'id', $cityId, 'name');
                    $stateId     = $pkgStates[$i] ?? null;
                    $stateName   = $stateId ? CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name') : '';
                    $countryId   = $pkgCountries[$i] ?? null;
                    $countryName = $countryId ? CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name') : '';
                    $label       = $buildLabel('city', $cityName, $stateName, $countryName);
                    $destMap[$cityId . '-city'] = $label;
                }
            }

            foreach ($pkgStates as $i => $stateId) {
                if (in_array($stateId, $allMatchingIds)) {
                    $stateName   = CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name');
                    $countryId   = $pkgCountries[$i] ?? null;
                    $countryName = $countryId ? CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name') : '';
                    $label       = $buildLabel('state', $stateName, '', $countryName);
                    $destMap[$stateId . '-state'] = $label;
                }
            }

            foreach ($pkgCountries as $countryId) {
                if (in_array($countryId, $allMatchingIds)) {
                    $countryName   = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name');
                    $continentId   = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'continent_id');
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $label         = $buildLabel('country', $countryName, $continentName);
                    $destMap[$countryId . '-country'] = $label;
                }
            }

            foreach ($pkgContinents as $continentId) {
                if (in_array($continentId, $allMatchingIds)) {
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $label         = $buildLabel('continent', $continentName);
                    $destMap[$continentId . '-continent'] = $label;
                }
            }
        }

        // ✅ Deduplicate by label and keep one ID
        $labelToIdMap = [];
        foreach ($destMap as $id => $label) {
            if (!in_array($label, array_keys($labelToIdMap))) {
                $labelToIdMap[$label] = $id;
            }
        }

        // ✅ Final formatted response
        $response = [];
        foreach ($labelToIdMap as $label => $id) {
            $numericId = explode('-', $id)[0]; // strip "-city"/"-state"/etc. suffix
            $packageCount = DB::table('rt_packages')
                ->where('status', 1)
                ->where(function ($query) use ($numericId) {
                    $query->orWhere('continent', 'like', "%$numericId%")
                        ->orWhere('country', 'like', "%$numericId%")
                        ->orWhere('state', 'like', "%$numericId%")
                        ->orWhere('city', 'like', "%$numericId%");
                })
                ->count();

            $response[] = [
                'id'    => $numericId,
                'text'  => "$label ($packageCount Packages)",
                'value' => $label,
            ];
        }

        return response()->json([["text" => "Suggestions", "children" => $response]]);
    }*/
   public function search_package_title(Request $request)
   {
     $destination_search_value = trim($request->searchTerm);
    $destination = trim($request->destination);

    // Assuming this returns Eloquent Collection or array of objects
    [$data, $data_ids, $packages] = $this->searchPackagesByDestination($destination);

    // If it's not a collection, make it one
    if (!($data instanceof \Illuminate\Support\Collection)) {
        $data = collect($data);
    }

    // Sort by title similarity to search term
    $sortedData = $data->sortByDesc(function ($item) use ($destination_search_value) {
        similar_text(strtolower($destination_search_value), strtolower($item->title), $percent);
        return $percent; // Higher percent = more similar
    })->values(); // Reset keys after sort

    // Optional: Just dump sorted titles
    $titles = $sortedData->pluck('title');

     $data = collect($titles)->map(function ($title, $index) {
        return (object) [
            'id' => $index,
            'title' => $title
        ];
    });

      $sortedData = $data->sortByDesc(function ($item) use ($destination_search_value) {
        $title = strtolower($item->title);
        $term = strtolower($destination_search_value);

        // Priority if the term exists in title
        if (stripos($title, $term) !== false) {
            return 1000; // Push exact/partial matches to top
        }

        // Otherwise use similarity
        similar_text($term, $title, $percent);
        return $percent;
    })->values(); // Reset array keys

       $results = $sortedData->map(function ($item) {
        return [
            'id' => $item->title,
            'text' => $item->title
        ];
    });

    return response()->json($results);
 

   }
    public function search_destination(Request $request)
    {
        

        //*****************

        $destination_search_value = trim($request->searchTerm);

        // ✅ Show default destinations when search is empty or too short
        if (empty($destination_search_value) || strlen($destination_search_value) <= 1) {

            // ⚡ Cache this block for 60 minutes
            $defaultDestinations = Cache::remember('popular_destinations_v1', 60, function () {
                $defaultNames = ["Goa", "Kerala", "Sikkim", "Shimla", "Thailand", "Dubai", "Bali", "Malaysia"];
                $destinations = [];

                foreach ($defaultNames as $name) {
                    $record = null;
                    $label = '';
                    $matchedDestination = null;

                    // 1. City and Country Matching
                    $cities = DB::table('city')->where('name', $name)->get();
                    foreach ($cities as $city) {
                        $state = DB::table('states')->where('id', $city->state_id)->first();
                        $country = DB::table('countries')->where('id', $state->country_id ?? null)->first();

                        $packageExists = DB::table('rt_packages')
                            ->where('city', 'LIKE', "%{$city->id}%")
                            ->where('country', 'LIKE', "%{$country->id}%")
                            ->exists();

                        if ($packageExists) {
                            $label = $city->name . ', ' . ($country->name ?? '');
                            $matchedDestination = $city;
                            break;
                        }
                    }

                    // 2. State and Country Matching
                    if (!$matchedDestination) {
                        $states = DB::table('states')->where('name', $name)->get();
                        foreach ($states as $state) {
                            $country = DB::table('countries')->where('id', $state->country_id)->first();

                            $packageExists = DB::table('rt_packages')
                                ->where('state', 'LIKE', "%{$state->id}%")
                                ->where('country', 'LIKE', "%{$country->id}%")
                                ->exists();

                            if ($packageExists) {
                                $label = $state->name . ', ' . ($country->name ?? '');
                                $matchedDestination = $state;
                                break;
                            }
                        }
                    }

                    // 3. Country and Continent Matching
                    if (!$matchedDestination) {
                        $countries = DB::table('countries')->where('name', $name)->get();
                        foreach ($countries as $country) {
                            $continent = DB::table('continent')->where('id', $country->continent_id)->first();

                            $packageExists = DB::table('rt_packages')
                                ->where('country', 'LIKE', "%{$country->id}%")
                                ->where('continent', 'LIKE', "%{$continent->id}%")
                                ->exists();

                            if ($packageExists) {
                                $label = $country->name . ', ' . ($continent->continent_name ?? '');
                                $matchedDestination = $country;
                                break;
                            }
                        }
                    }

                    // 4. Continent Matching
                    if (!$matchedDestination) {
                        $continents = DB::table('continent')->where('continent_name', $name)->get();
                        foreach ($continents as $continent) {
                            $packageExists = DB::table('rt_packages')
                                ->where('continent', 'LIKE', "%{$continent->id}%")
                                ->exists();

                            if ($packageExists) {
                                $label = $continent->continent_name;
                                $matchedDestination = $continent;
                                break;
                            }
                        }
                    }

                    if ($matchedDestination) {
                        $destinations[] = [
                            'id' => $name,
                            'value' => $name,
                            'text' => $label,
                        ];
                    }
                }

                return $destinations;
            });

            return response()->json([["text" => "Popular Destinations", "children" => $defaultDestinations]]);
        }

        //*****************

       

        // ✅ Match against continent, country, state, city
        $continentIds = DB::table('continent')
            ->where('continent_name', 'LIKE', "$destination_search_value%")
            ->pluck('id')->toArray();

        $countryIds = DB::table('countries')
            ->where('name', 'LIKE', "$destination_search_value%")
            ->pluck('id')->toArray();

        $stateIds = DB::table('states')
            ->where('name', 'LIKE', "$destination_search_value%")
            ->pluck('id')->toArray();

        $cityIds = DB::table('city')
            ->where('name', 'LIKE', "$destination_search_value%")
            ->pluck('id')->toArray();

        $allMatchingIds = array_merge($continentIds, $countryIds, $stateIds, $cityIds);

        // ✅ Get all active packages
        $packages = DB::table('rt_packages')
            ->where('status', 1)
            ->get(['id', 'continent', 'country', 'state', 'city']);

        // ✅ Label builder
        $buildLabel = function ($type, $first = '', $second = '', $third = '') {
            if ($type === 'city') {
                return trim("{$first}, {$third}");
            } elseif ($type === 'state') {
                return trim("{$first}, {$third}");
            } elseif ($type === 'country') {
                return trim("{$first}, {$second}");
            } elseif ($type === 'continent') {
                return $first;
            }
            return $first;
        };

        $destMap = [];

        foreach ($packages as $pkg) {
            $pkgContinents = unserialize($pkg->continent) ?: [];
            $pkgCountries  = unserialize($pkg->country) ?: [];
            $pkgStates     = unserialize($pkg->state) ?: [];
            $pkgCities     = unserialize($pkg->city) ?: [];

            foreach ($pkgCities as $i => $cityId) {
                if (in_array($cityId, $allMatchingIds)) {
                    $cityName    = CustomHelpers::get_master_table_data('city', 'id', $cityId, 'name');
                    $stateId     = $pkgStates[$i] ?? null;
                    $stateName   = $stateId ? CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name') : '';
                    $countryId   = $pkgCountries[$i] ?? null;
                    $countryName = $countryId ? CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name') : '';
                    $label       = $buildLabel('city', $cityName, $stateName, $countryName);

                    $destMap[$cityId . '-city'] = $label;
                }
            }

            foreach ($pkgStates as $i => $stateId) {
                if (in_array($stateId, $allMatchingIds)) {
                    $stateName   = CustomHelpers::get_master_table_data('states', 'id', $stateId, 'name');
                    $countryId   = $pkgCountries[$i] ?? null;
                    $countryName = $countryId ? CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name') : '';
                    $label       = $buildLabel('state', $stateName, '', $countryName);

                    $destMap[$stateId . '-state'] = $label;
                }
            }

            foreach ($pkgCountries as $countryId) {
                if (in_array($countryId, $allMatchingIds)) {
                    $countryName   = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'name');
                    $continentId   = CustomHelpers::get_master_table_data('countries', 'id', $countryId, 'continent_id');
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $label         = $buildLabel('country', $countryName, $continentName);

                    $destMap[$countryId . '-country'] = $label;
                }
            }

            foreach ($pkgContinents as $continentId) {
                if (in_array($continentId, $allMatchingIds)) {
                    $continentName = CustomHelpers::get_master_table_data('continent', 'id', $continentId, 'continent_name');
                    $label = $buildLabel('continent', $continentName);

                    $destMap[$continentId . '-continent'] = $label;
                }
            }
        }

        // ✅ Deduplicate by label
        $labelToIdMap = [];

        foreach ($destMap as $id => $label) {
            if (!array_key_exists($label, $labelToIdMap)) {
                $labelToIdMap[$label] = $id;
            }
        }

        // ✅ Final formatted response
        $response = [];

        foreach ($labelToIdMap as $label => $id) {
            $numericId = explode('-', $id)[0];
           
            $packageCount = DB::table('rt_packages')
                ->where('status', 1)
                ->where(function ($query) use ($numericId) {
                    $query->orWhere('continent', 'like', "%$numericId%")
                          ->orWhere('country', 'like', "%$numericId%")
                          ->orWhere('state', 'like', "%$numericId%")
                          ->orWhere('city', 'like', "%$numericId%");
                })
                ->count();

            // $response[] = [
            //     'id'    => $numericId,
            //     'text'  => "$label ($packageCount Packages)",
            //     'value' => $label,  
            // ];
                $searched_location= explode(',', $label)[0];

                 $response[] = [
                'id'    => $searched_location,
                'text'  => "$label ($packageCount Packages)",
                'value' => $label,  
            ];

        }

        return response()->json([
            ["text" => "Suggestions", "children" => $response]
        ]);

    }


    /*--------*/

    //these are to check only (helps to find the destination details)

    // to find city -> state -> country using name - e.g. find Bali located in world in which country and others
    /*public function search_destination(Request $request)
    {
        $destination_search_value = trim($request->searchTerm);

        // ✅ Check if the search term matches multiple locations in the database
        $cities = DB::table('city')->where('name', 'LIKE', "%$destination_search_value%")->get();
        $states = DB::table('states')->where('name', 'LIKE', "%$destination_search_value%")->get();
        $countries = DB::table('countries')->where('name', 'LIKE', "%$destination_search_value%")->get();
        $continents = DB::table('continent')->where('continent_name', 'LIKE', "%$destination_search_value%")->get();

        $results = [];

        // ✅ Handle Cities
        if ($cities->count() > 0) {
            foreach ($cities as $city) {
                $state = DB::table('states')->where('id', $city->state_id)->first();
                $country = DB::table('countries')->where('id', $state->country_id)->first();
                $results[] = [
                    'id' => $city->id,
                    'text' => "{$city->name}, {$state->name}, {$country->name}",
                ];
            }
        }

        // ✅ Handle States
        if ($states->count() > 0) {
            foreach ($states as $state) {
                $country = DB::table('countries')->where('id', $state->country_id)->first();
                $results[] = [
                    'id' => $state->id,
                    'text' => "{$state->name}, {$country->name}",
                ];
            }
        }

        // ✅ Handle Countries
        if ($countries->count() > 0) {
            foreach ($countries as $country) {
                $continent = DB::table('continent')->where('id', $country->continent_id)->first();
                $results[] = [
                    'id' => $country->id,
                    'text' => "{$country->name}, {$continent->continent_name}",
                ];
            }
        }

        // ✅ Handle Continents
        if ($continents->count() > 0) {
            foreach ($continents as $continent) {
                $results[] = [
                    'id' => $continent->id,
                    'text' => $continent->continent_name,
                ];
            }
        }

        // ✅ If no results found, display a fallback message
        if (empty($results)) {
            return response()->json([["text" => "No results found", "children" => []]]);
        }

        // ✅ Return results
        return response()->json([["text" => "Suggestions", "children" => $results]]);
    }*/

    // to find city -> state -> country using name - e.g. find Bali located in world in which country and others
    /*public function search_destination(Request $request)
    {
        $search = trim($request->searchTerm);
        $results = [];

        // Search cities
        $cities = DB::table('city')->where('name', 'LIKE', "%$search%")->get();
        foreach ($cities as $city) {
            $state = DB::table('states')->where('id', $city->state_id)->first();
            $country = $state ? DB::table('countries')->where('id', $state->country_id)->first() : null;
            $continent = $country ? DB::table('continent')->where('id', $country->continent_id)->first() : null;

            $textParts = [$city->name];
            if ($state) $textParts[] = $state->name;
            if ($country) $textParts[] = $country->name;
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'city_' . $city->id,
                'text' => implode(', ', $textParts),
            ];
        }

        // Search states
        $states = DB::table('states')->where('name', 'LIKE', "%$search%")->get();
        foreach ($states as $state) {
            $country = DB::table('countries')->where('id', $state->country_id)->first();
            $continent = $country ? DB::table('continent')->where('id', $country->continent_id)->first() : null;

            $textParts = [$state->name];
            if ($country) $textParts[] = $country->name;
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'state_' . $state->id,
                'text' => implode(', ', $textParts),
            ];
        }

        // Search countries
        $countries = DB::table('countries')->where('name', 'LIKE', "%$search%")->get();
        foreach ($countries as $country) {
            $continent = DB::table('continent')->where('id', $country->continent_id)->first();

            $textParts = [$country->name];
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'country_' . $country->id,
                'text' => implode(', ', $textParts),
            ];
        }

        // Search continents
        $continents = DB::table('continent')->where('continent_name', 'LIKE', "%$search%")->get();
        foreach ($continents as $continent) {
            $results[] = [
                'id' => 'continent_' . $continent->id,
                'text' => $continent->continent_name,
            ];
        }

        // Remove duplicates by 'text'
        $results = collect($results)
            ->unique('text')                 // remove duplicates
            ->sortBy(function($item) {
                $parts = explode(',', $item['text']);
                return count($parts);        // prioritize more complete (4-part) labels
            })
            ->values()
            ->all();

        // if (empty($results)) {
        //     return response()->json([["text" => "No results found", "children" => []]]);
        // }

        return response()->json([["text" => "Suggestions", "children" => $results]]);
    }*/

    // to find city -> state -> country -> continent using name (Avoid duplicates like Singapore, Asia if Singapore, Singapore, Singapore, Asia already exists)
    /*public function search_destination(Request $request)
    {
        $search = trim($request->searchTerm);
        $results = [];
        $usedNames = [];

        // Search cities first (most complete)
        $cities = DB::table('city')->where('name', 'LIKE', "%$search%")->get();
        foreach ($cities as $city) {
            $state = DB::table('states')->where('id', $city->state_id)->first();
            $country = $state ? DB::table('countries')->where('id', $state->country_id)->first() : null;
            $continent = $country ? DB::table('continent')->where('id', $country->continent_id)->first() : null;

            $nameKey = strtolower($city->name);
            if (in_array($nameKey, $usedNames)) continue;

            $textParts = [$city->name];
            if ($state) $textParts[] = $state->name;
            if ($country) $textParts[] = $country->name;
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'city_' . $city->id,
                'text' => implode(', ', $textParts),
            ];
            $usedNames[] = $nameKey;
        }

        // Search states only if not already matched in cities
        $states = DB::table('states')->where('name', 'LIKE', "%$search%")->get();
        foreach ($states as $state) {
            $nameKey = strtolower($state->name);
            if (in_array($nameKey, $usedNames)) continue;

            $country = DB::table('countries')->where('id', $state->country_id)->first();
            $continent = $country ? DB::table('continent')->where('id', $country->continent_id)->first() : null;

            $textParts = [$state->name];
            if ($country) $textParts[] = $country->name;
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'state_' . $state->id,
                'text' => implode(', ', $textParts),
            ];
            $usedNames[] = $nameKey;
        }

        // Search countries only if not already matched
        $countries = DB::table('countries')->where('name', 'LIKE', "%$search%")->get();
        foreach ($countries as $country) {
            $nameKey = strtolower($country->name);
            if (in_array($nameKey, $usedNames)) continue;

            $continent = DB::table('continent')->where('id', $country->continent_id)->first();

            $textParts = [$country->name];
            if ($continent) $textParts[] = $continent->continent_name;

            $results[] = [
                'id' => 'country_' . $country->id,
                'text' => implode(', ', $textParts),
            ];
            $usedNames[] = $nameKey;
        }

        // Search continents only if not already matched
        $continents = DB::table('continent')->where('continent_name', 'LIKE', "%$search%")->get();
        foreach ($continents as $continent) {
            $nameKey = strtolower($continent->continent_name);
            if (in_array($nameKey, $usedNames)) continue;

            $results[] = [
                'id' => 'continent_' . $continent->id,
                'text' => $continent->continent_name,
            ];
            $usedNames[] = $nameKey;
        }

        if (empty($results)) {
            return response()->json([["text" => "No results found", "children" => []]]);
        }

        return response()->json([["text" => "Suggestions", "children" => $results]]);
    }*/



    // ****************************************


    public function filter_array($array, $letter) 
    {
        $filtered_array=array();
        foreach($array as $key=>$val) {
            if($val[0]==$letter) {
                    $filtered_array[]=$val;
                }
            }
        return $filtered_array;
    }

    /*public function filter_array(array $array, string $letter): array
    {
        // Initialize an empty array to store filtered results
        $filtered_array = [];

        // Iterate through the input array
        foreach ($array as $key => $val) {
            // Check if the first character of the element matches the specified letter
            if ($val[0] == $letter) {
                // Add the matching element to the filtered array
                $filtered_array[] = $val;
            }
        }

        // Return the filtered array
        return $filtered_array;
    }*/

    // ****************************************

    // search tour package by theme (desktop) - (OLD Working)
    /*public function search_theme(Request $request) 
    {
        // Get the search theme from the request
        $search_theme = $request->search_theme;
        $getdata = "";

        // Query the database for matching records in city, country, or state fields
        $data = DB::table('rt_packages')
            ->where([['city', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
            ->orWhere([['country', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
            ->orWhere([['state', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
            ->get();

        // Iterate through the data and extract package categories
        foreach ($data as $data_theme) :
            $data_value_theme = unserialize($data_theme->package_category);
            
            // Append each value to the getdata string
            foreach ($data_value_theme as $data_values) :
                $getdata .= $data_values . ",";
            endforeach;
        endforeach;

        // Initialize the theme options with a default value
        $theme_show = "<option value=''>All</option>";
        
        // Split and remove duplicate values
        $theme_front_data = explode(",", $getdata);
        $theme_front_data = array_unique($theme_front_data);

        // Generate option tags for each unique theme
        foreach ($theme_front_data as $theme_front) :
            if ($theme_front) :
                $theme_show .= "<option value='$theme_front'>" . $theme_front . "</option>";
            endif;
        endforeach;

        // Output the generated options
        echo $theme_show;

        // Check if no themes were found and handle continent search
        if ($theme_show == "<option value=''>--Choose Theme--</option>") :
            $data = DB::table('rt_packages')
                ->where([['continent', 'like', '%' . $search_theme . '%'], ['status', '=', '1']])
                ->get();
            
            $getdata = "";
            
            // Extract package categories from the data
            foreach ($data as $data_theme) :
                $data_value_theme = unserialize($data_theme->package_category);
                $count = count($data_value_theme);
                
                // Append each value to the getdata string
                for ($i = 0; $i < $count; $i++) {
                    $getdata .= $data_value_theme[$i] . ",";
                }
            endforeach;

            $theme_show1 = "";
            
            // Split and remove duplicate values
            $theme_front_data = explode(",", $getdata);
            $theme_front_data = array_unique($theme_front_data);
            
            // Generate option tags for each unique theme
            foreach ($theme_front_data as $theme_front) :
                if ($theme_front) :
                    $theme_show1 .= "<option value='$theme_front'>" . $theme_front . "</option>";
                endif;
            endforeach;

            // Output the additional generated options
            echo $theme_show1;
        endif;
    }*/

    /*--------*/

    // search tour package by theme (desktop)
    public function search_theme(Request $request)
    {
        $search_theme = strtolower($request->search_theme);
        
        // Search for packages by destination
        [$data, $data_ids, $packages] = $this->searchPackagesByDestination($search_theme);
      
       
        // Check if data is empty
        if ($data->isEmpty()) {
            return response('no_data'); // Send "no_data" if no results are found
        }

        // Extract themes
        $themes = $this->extractThemes($data);

        // Generate and return HTML options
        return response($this->generateOptions($themes));
    }

    /*public function search_theme(Request $request)
    {
        $search_theme = $request->search_theme;

        if (empty($search_theme)) {
            $data = DB::table('rt_packages')
                ->where('status', '=', '1')
                ->get();

            \Log::info('All packages:', ['data' => $data->toArray()]);
        } else {
            $fields = ['city', 'country', 'state', 'continent'];
            $data = DB::table('rt_packages')
                ->where('status', '=', '1')
                ->where(function ($query) use ($fields, $search_theme) {
                    foreach ($fields as $field) {
                        $query->orWhere($field, 'like', '%' . $search_theme . '%');
                    }
                })
                ->get();
        }

        // Log the data size
        \Log::info('Fetched data size:', ['count' => $data->count()]);

        // Check if the data is empty
        if ($data->isEmpty()) {
            \Log::info('No data found, returning no_data');
            return response('no_data'); // Send "no_data" to indicate no more records
        }

        // Extract themes and log them
        $themes = $this->extractThemes($data);
        \Log::info('Extracted themes:', ['themes' => $themes]);

        // Generate and return HTML options
        $options = $this->generateOptions($themes);
        \Log::info('Generated options HTML:', ['options' => $options]);

        return response($options);
    }*/


    private function extractThemes($data)
    {
        $getdata = "";
        foreach ($data as $data_theme) {
            $data_value_theme = @unserialize($data_theme->package_category);
            if ($data_value_theme && is_array($data_value_theme)) {
                $getdata .= implode(",", $data_value_theme) . ",";
            }
        }
        $theme_front_data = explode(",", rtrim($getdata, ","));
        return array_unique(array_filter($theme_front_data));
    }

    private function generateOptions($themes)
    {
        $options = "<option value=''>All</option>";
        foreach ($themes as $theme) {
            $options .= "<option value='$theme'>" . e($theme) . "</option>";
        }
        return $options;
    }

    // ****************************************

    // show more packages (home page) (old)
    /*public function add_package(Request $request)
    {
        $custom_length=$request->custom_length;
        $p_id=$request->id;
        $content_type=$request->content_type;

        if($content_type=='domestic' || $content_type=='domestic_mobile') {
            $country = array('India','Nepal','Bhutan');
            $packages = DB::Table('rt_packages')
            ->Where(function ($query) use($country) {
                for ($i = 0; $i < count($country); $i++){
                    $query->orwhere([
                        ['status','=' ,'1'],
                        ['front_show','=' ,'1'],
                        ['country', 'like',  '%' . $country[$i] .'%']
                    ]);
                }
            })
            //->whereNotIn('id',$p_id)
            ->whereNotIn('id', (array)$p_id) // Ensure $p_id is an array
            ->inRandomOrder()
            ->limit(4)
            ->get();
        } else {
            $exclude_emails = [
                ['status','=' ,'1'],
                ['front_show','=' ,'1'],
                ['rt_packages.country' ,'not like','%'.'India'.'%'],
                ['rt_packages.country' ,'not like','%'.'Nepal'.'%'],
                ['rt_packages.country' ,'not like','%'.'Bhutan'.'%'],
            ];
            $packages=\DB::table("rt_packages")
            ->where($exclude_emails)
            //->whereNotIn('id',$p_id)
            ->whereNotIn('id', (array)$p_id) // Ensure $p_id is an array
            ->inRandomOrder()
            ->limit(4)
            ->get();
        }
        $output=view('home.add_more_data.index',compact('content_type','packages'))->render();
        echo $output;
        //return response()->json(['html' => $output]); // Ensure JSON response for AJAX
    }*/

    // show more packages (home page)
    /*public function add_package(Request $request)
    {
        // Get request parameters
        $custom_length = $request->custom_length;
        $p_id = !empty($request->id) ? (array) $request->id : []; // Ensure ID is always an array
        $content_type = $request->content_type;
        $limit = $request->limit ?? 4; // Default limit to 4, but allow dynamic value from AJAX (using javascript limit in add_packages in pageone.js)

        // Handle Domestic Packages (India, Nepal, Bhutan)
        if ($content_type == 'domestic' || $content_type == 'domestic_mobile') {
            $country = ['India', 'Nepal', 'Bhutan']; // Allowed domestic countries

            $packages = DB::table('rt_packages')
                ->where('status', '1') // Ensure the package is active
                ->where('front_show', '1') // Ensure the package is visible on frontend
                ->where(function ($query) use ($country) {
                    // Check if the package country matches any domestic country
                    foreach ($country as $c) {
                        $query->orWhere('country', 'like', '%' . $c . '%');
                    }
                })
                ->whereNotIn('id', $p_id) // Exclude already loaded packages
                ->inRandomOrder() // Shuffle results for variety
                ->limit($limit) // Fetch only the required number of packages
                ->get();
        } 
        // Handle International Packages (Exclude India, Nepal, Bhutan)
        else {
            $packages = DB::table("rt_packages")
                ->where('status', '1') // Ensure the package is active
                ->where('front_show', '1') // Ensure the package is visible on frontend
                ->whereNotIn('id', $p_id) // Exclude already loaded packages
                ->where(function ($query) {
                    // Exclude India, Nepal, Bhutan
                    $query->where('country', 'not like', '%India%')
                          ->where('country', 'not like', '%Nepal%')
                          ->where('country', 'not like', '%Bhutan%');
                })
                ->inRandomOrder() // Shuffle results for variety
                ->limit($limit) // Fetch only the required number of packages
                ->get();
        }

        // Render the response using the view
        $output = view('home.add_more_data.index', compact('content_type', 'packages'))->render();

        // Return JSON response to AJAX call
        return response()->json(['html' => $output]);
    }*/

    /*public function add_package(Request $request)
    {
        // Get request parameters
        $custom_length = $request->custom_length;
        $p_id = !empty($request->id) ? (array) $request->id : [];
        $content_type = $request->content_type;
        $limit = $request->limit ?? 4;

        // ✅ Get country IDs for India, Nepal, Bhutan
        $domesticCountryIds = DB::table('countries')
            ->whereIn('name', ['India', 'Nepal', 'Bhutan'])
            ->pluck('id')
            ->toArray();

        // ✅ International packages (Exclude India, Nepal, Bhutan)
        if ($content_type !== 'domestic' && $content_type !== 'domestic_mobile') {
            $packages = DB::table("rt_packages")
                ->where('status', '1')
                ->where('front_show', '1')
                ->whereNotIn('id', $p_id)
                ->whereNotIn('country', $domesticCountryIds)
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }
        // ✅ Domestic packages (Only India, Nepal, Bhutan)
        else {
            $packages = DB::table('rt_packages')
                ->where('status', '1')
                ->where('front_show', '1')
                ->whereNotIn('id', $p_id)
                ->whereIn('country', $domesticCountryIds)
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        $output = view('home.add_more_data.index', compact('content_type', 'packages'))->render();

        return response()->json(['html' => $output]);
    }*/

    // show more packages (home page) (working)
    /*public function add_package(Request $request)
    {
        $content_type = $request->input('content_type');

        // ✅ Define country names to exclude/include
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

        // ✅ Fetch corresponding country IDs from `countries` table
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        // Determine package list based on content type
        if ($content_type == 'international') {
            // 🌐 International packages: exclude countries with these IDs
            $packages = DB::table('rt_packages')
                ->where('status', '1')
                ->where('front_show', '1')
                ->where(function ($query) use ($excludedCountryIds) {
                    foreach ($excludedCountryIds as $id) {
                        $query->where('country', 'not like', "%$id%");
                    }
                })
                ->inRandomOrder()
                ->limit(4)
                ->get();
        } else {
            // 🇮🇳 Domestic packages: include countries with these IDs
            $packages = DB::table('rt_packages')
                ->where('status', '1')
                ->where('front_show', '1')
                ->where(function ($query) use ($excludedCountryIds) {
                    foreach ($excludedCountryIds as $id) {
                        $query->orWhere('country', 'like', "%$id%");
                    }
                })
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }

        // ✅ Render and return as JSON
        $output = view('home.add_more_data.index', compact('content_type', 'packages'))->render();

        return response()->json(['html' => $output]);
    }*/

    // Show more packages (Home Page) – Working with serialized `country` support
    /*public function add_package(Request $request)
    {
        $content_type = $request->input('content_type');

        // ✅ Define country names to exclude/include
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

        // ✅ Fetch corresponding country IDs from `countries` table
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        // ✅ Fetch all valid packages
        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->where('front_show', 1)
            ->get();

        $packages = [];

        foreach ($allPackages as $pkg) {
            $countryIds = @unserialize($pkg->country);
            if (!is_array($countryIds)) continue;

            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if ($content_type === 'international' && empty($intersect)) {
                $packages[] = $pkg;
            }

            if ($content_type !== 'international' && !empty($intersect)) {
                $packages[] = $pkg;
            }
        }

        // ✅ Shuffle and limit 4
        $packages = collect($packages)->shuffle()->take(4);

        // ✅ Render and return as JSON
        $output = view('home.add_more_data.index', compact('content_type', 'packages'))->render();

        return response()->json(['html' => $output]);
    }*/

    // not repeating the same package
    /*public function add_package(Request $request)
    {
        $content_type = $request->input('content_type');
        $alreadyLoadedIds = $request->input('already_loaded_ids', []); // Expecting an array of package IDs

        // ✅ Country names to exclude/include
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

        // ✅ Get country IDs
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        // ✅ Get all packages not already shown
        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->where('front_show', 1)
            ->whereNotIn('id', $alreadyLoadedIds)
            ->get();

        $packages = [];

        foreach ($allPackages as $pkg) {
            $countryIds = @unserialize($pkg->country);
            if (!is_array($countryIds)) continue;

            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if ($content_type === 'international' && empty($intersect)) {
                $packages[] = $pkg;
            }

            if ($content_type !== 'international' && !empty($intersect)) {
                $packages[] = $pkg;
            }
        }

        // ✅ Shuffle and limit 4
        $packages = collect($packages)->shuffle()->take(4);

        $output = view('home.add_more_data.index', compact('content_type', 'packages'))->render();

        return response()->json(['html' => $output]);
    }*/

    // show more packages (home page) (enhanced) // transferred to HomeController
    /*public function add_package(Request $request)
    {
        $content_type = $request->input('content_type');
        $alreadyLoadedIds = $request->input('already_loaded_ids', []); // loaded pkgs will not repeat linked to pageone.js
        $limit = $request->input('limit', 4); // default to 4

        // Define excluded countries for "domestic"
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

        // Get their IDs
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        // Fetch all eligible packages
        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->where('front_show', 1)
            ->whereNotIn('id', $alreadyLoadedIds) // exclude already shown
            ->get();

        $packages = [];

        foreach ($allPackages as $pkg) {
            $countryIds = @unserialize($pkg->country);
            if (!is_array($countryIds)) continue;

            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if ($content_type === 'international' || $content_type === 'international_mobile') {
                // International: Should NOT match any excluded
                if (empty($intersect)) {
                    $packages[] = $pkg;
                }
            } else {
                // Domestic: Should include any excluded
                if (!empty($intersect)) {
                    $packages[] = $pkg;
                }
            }
        }

        // Shuffle and take up to 4
        $packages = collect($packages)->shuffle()->take($limit);

        // Render view
        $output = view('home.add_more_data.index', [
            'content_type' => $content_type,
            'packages' => $packages
        ])->render();

        return response()->json(['html' => $output]);
    }*/




    // ****************************************

    //add theme
    /*public function add_theme(Request $request)
    {
        $custom_length=$request->custom_length;
        $theme_name=$request->theme_name;
        $ids=$request->id;
        //$packages=Packages::all()->where('status','1')->take(3);
        $packages=DB::table('rt_packages')
        ->where([['package_category', 'like','%' . $theme_name . '%'],
        ['status', '=', '1'],])
        ->whereNotIn('id', $ids)
        ->inRandomOrder()->limit(3)->get();

        if(count($packages)>="3"):
        foreach($packages as $package):
        $location =unserialize($package->city);
        $packaes_ids=$package->id;
        echo "<div class='col-md-4 col-sm-6 custom_length'>
        <div class='nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow'>
        <input type='hidden' class='pack_id_list' name='pack_id_list[]'  value='$packaes_ids'>
        <div class='prise'>";
        if($package->onrequest == "1" && $package->upcoming == "1"):
        echo "<a href=''>On Request </a>";
        elseif($package->onrequest != "1" && $package->upcoming == "1"):
        $price=CustomHelpers::get_price($package->id);
        if($price=="On Request"):
        echo "<a href='#'> $price</a>";
        else:
        echo "<a href='#'>&#x20B9 $price</a>";
        endif;
        elseif($package->onrequest == "1" && $package->upcoming != "1"):
        $price=CustomHelpers::get_up_price($package->id);
        if($price=="On Request"):
        echo "<a href='#'> $price</a>";
        else:
        echo "<a href='#'>&#x20B9 $price</a>";
        endif;
        endif;
        $href_id=Crypt::encrypt(['id'=>$package->id]);
        $href_id1=CustomHelpers::custom_encrypt($package->id);
        $href_url=url("/packages-detail/$href_id");
        $form_action=url("/Holidays/".str_slug($package->title)).'?package_id='.$href_id1;
        $csrf=csrf_field();
        //$img_src_path=url('/public'.CustomHelpers::get_first_image($package->id,'rt_package_uploads','image_path','package_id'));
        $gallery_id=CustomHelpers::get_first_galleryid($package->id);
        $pat=CustomHelpers::get_image_gallery($gallery_id,'thum_medium');
        if($pat!="0"):
        $img_src_path=$pat;
        elseif($pat=="0"):
        $img_src_path=url('/public/Uploads/default_profile_image.png');
        endif;
        echo "</div>
        <div class='DETAILS'>
        <a href='$form_action' >DETAILS</a>
        </div>
        <a href='$form_action' >
        <img style='height: 250px;'  class='nicdark_focus nicdark_zoom_image img-responsive' src='$img_src_path'>
        </a>
        </div>
        <div class=''>
        <div class='cube_main'>
        <h4 class='cube'>$package->title</h4>
        </div>
        <div>
        <div class='name-1'>
        <p class='white'><i class='fa fa-location-arrow' aria-hidden='true'></i> $location[0] </p>
        </div>
        <div class='name-1'>
        <p class='white1'><i class='fa fa-info' aria-hidden='true'></i>
        ";
        $themedata=unserialize($package->package_category);
        if(empty($themedata)):
        else:
        echo $themedata[0];
        endif;
        echo "</p>
        </div>
        </div>
        <div class='pro_text'>
        <div class='row'>
        <div class='col-md-6 col-xs-6'>
        <a href='$form_action' class='details'>DETAILS</a>
        </div>";
        $pkg_duration=$package->duration;
        $pkg_duration_day=$package->duration+1;
        echo "<div class='col-md-6 col-xs-6'>
        <a>$pkg_duration N / $pkg_duration_day D
        </a>
        </div>
        </div></div></div></div>";
        endforeach;
        endif;
    }*/
    
    // testimonial
    public function testimonial_detail($id)
    {
        // Decrypt the provided ID to get the original ID value
        $id1 = CustomHelpers::custom_decrypt($id);

        // Find the testimonial by its ID or fail if not found
        $data1 = Testimonial::findOrFail($id1);

        // Get all testimonials except the one with the specified ID
        $data2 = Testimonial::where('id', '!=', $id1)->get();

        // Return the view with the testimonial data
        return view('packages.packagetestimonials', compact('data1', 'data2'));
    }

    // ****************************************

    // load more packages (page two)
    public function mid_package_data(Request $request)
    {
        $window_width=$request->window_width;
        $limit=$request->limit;
        $event_type=$request->event_type;
        $packages_id=$request->packages_id;
        $pac_id=array();
        $prices=array();
        $new_price=array();
        $destination=$request->destination;

        if($request->has('places')) {
            $places=$request->places;
            $places_count=count($places);
        } else {
            $places_count=0;
        }
        if($request->has('duration')) {
            $duration=$request->duration;
            $duration_count=count($duration);
        } else {
            $duration_count=0;
        }
        if($request->has('travel_type')) {
            $travel_type=$request->travel_type;
            $travel_type_count=count($travel_type);
        } else {
            $travel_type_count=0;
        }
        if($request->has('theme_type')) {
            $theme_type=$request->theme_type;
            $theme_type_count=count($theme_type);
        } else {
            $theme_type_count=0;
        }
        if($request->has('guest_rating')) {
            $guest_rating=$request->guest_rating;
            $guest_rating_count=count($guest_rating);
        } else {
            $guest_rating_count=0;
        }

        $min_price=$request->min_price;
        $min_price=(int)filter_var($min_price, FILTER_SANITIZE_NUMBER_INT);
        $max_price=$request->max_price;
        $max_price=(int)filter_var($max_price, FILTER_SANITIZE_NUMBER_INT);
        $sort_filter=$request->sort_filter;
    
        //
        if($request->has('services_includes')) {
            $services_includes=$request->services_includes;
            $services_includes_count=count($services_includes);
        } else {
            $services_includes_count=0;
        }
        if($request->has('sut_for')) {
            $sut_for=$request->sut_for;
            $sut_for_count=count($sut_for);
        } else {
            $sut_for_count=0;
        }
        if($request->has('gen_tags')) {
            $gen_tags=$request->gen_tags;
            $gen_tags_count=count($gen_tags);
        } else {
            $gen_tags_count=0;
        }
        $search_date=$request->search_date;

        $icons = Icons::all();
        $generals = Gtags::all();
        $suitables = Suitable::all();
      [$data, $data_ids, $package_s] = $this->searchPackagesByDestination($destination);
        //
        if($event_type=="0"):

            $packages=$data;
        elseif($event_type=="1"):
        
            $packages = collect($data)->reject(function ($d) use ($packages_id) {
    return in_array($d->id, $packages_id);
})->values();


        endif;

        //1
        if($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package) {
                $city_array=unserialize($package->city);
                $intersect=array_intersect($city_array, $places);
                $pricing=unserialize($package->pricing);
                if(count($intersect)!="0"):
                    $new_price[]=CustomHelpers::get_total_price($package->id);
                endif;
                }

            //2
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
                foreach($packages as $package) {
                    $city_array=unserialize($package->city);
                    $package_duration=$package->duration;
                    $intersect=array_intersect($city_array, $places);
                    $pricing=unserialize($package->pricing);
                    for($i="0";$i<$duration_count;$i++) {
                        if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        }
                    }
                }
            //3
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
                foreach($packages as $package) {
                    $city_array=unserialize($package->city);
                    $package_duration=$package->duration;
                    $intersect=array_intersect($city_array, $places);
                    $transport=$package->transport;
                    $pricing=unserialize($package->pricing);
                    for($i="0";$i<$duration_count;$i++) {
                        if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type)) {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type)) {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type)) {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        }
                    }
                }
            //4
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
                foreach($packages as $package) {
                    $city_array=unserialize($package->city);
                    $package_duration=$package->duration;
                    $intersect=array_intersect($city_array, $places);
                    $transport=$package->transport;
                    $theme_array=unserialize($package->package_category);
                    $theme_intersect=array_intersect($theme_type, $theme_array);
                    //echo count($theme_intersect);
                    $pricing=unserialize($package->pricing);
                    for($i="0";$i<$duration_count;$i++) {
                        if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0") {
                            $new_price[]=CustomHelpers::get_total_price($package->id);
                        }
                    }
            }
            //5
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
                foreach($packages as $package) {
                    $city_array=unserialize($package->city);
                    $package_duration=$package->duration;
                    $intersect=array_intersect($city_array, $places);
                    $transport=$package->transport;
                    $theme_array=unserialize($package->package_category);
                    $theme_intersect=array_intersect($theme_type, $theme_array);
                    $gues_rat=$package->customer_rating;
                    $pricing=unserialize($package->pricing);
                    for($i="0";$i<$duration_count;$i++) {
                        if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating)) {
                        $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating)) {
                        $new_price[]=CustomHelpers::get_total_price($package->id);
                        } elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating)) {
                        $new_price[]=CustomHelpers::get_total_price($package->id);
                        }
                    }
            }
            //6
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package) {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            }
            }
            //7
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package) {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($sutible_for_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            }
            }
            //8
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package) {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($sutible_for_intersect)!="0" && count($service_included_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            }
            }
            //9
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package) {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($theme_intersect)!="0" )
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($theme_intersect)!="0" )
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($theme_intersect)!="0" )
            {
            $new_price[]=CustomHelpers::get_total_price($package->id);
            }
            }
            }
            //10
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package) {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //11
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //12
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //13
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //14
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //15
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //16
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //17
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //18
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //19
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //20
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //21
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //22
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //23
            elseif($places_count>"0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($intersect)!="0"  && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($intersect)!="0"  && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($intersect)!="0"  && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //24
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if( count($intersect)!="0"  && in_array($transport, $travel_type))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //25
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if( count($intersect)!="0"  && in_array($transport, $travel_type) && count($theme_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //26
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if( count($intersect)!="0"  && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //27
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //28
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //29
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //30
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if( count($intersect)!="0" && count($theme_intersect)!="0"  )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //31
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if( count($intersect)!="0" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //32
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //33
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //34
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //34
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            if( count($intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //35
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //36
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //37
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //38
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //39
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //40
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //41
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //42
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //43
            elseif($places_count>"0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            $city_array=unserialize($package->city);
            $package_duration=$package->duration;
            $intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            // $gues_rat=$package->customer_rating;
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($intersect)!="0"  && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //43
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //44
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //45
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type) && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type) && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type) && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //46
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //47
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //48
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //49
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //50
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($theme_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //51
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //52
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //53
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //53
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //54
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //55
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //56
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //57
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //58
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //59
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //60
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //61
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count=="0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //62
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //63
            elseif($places_count=="0" && $duration_count>"0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count>"0" ):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            $package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            for($i="0";$i<$duration_count;$i++)
            {
            if($duration[$i]=="7" && $package_duration<="7"  && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="8" && $package_duration<="12" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            elseif($duration[$i]=="8" && $package_duration>="13"   && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            }
            //64
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(in_array($transport, $travel_type))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //65
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(in_array($transport, $travel_type) && count($theme_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //66
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(in_array($transport, $travel_type) && count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //67
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //68
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //69
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //70
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(in_array($transport, $travel_type)  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //72
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($service_included_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //73
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //74
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count>"0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            $transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($transport, $travel_type) && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0"  && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //75
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            //$gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(count($theme_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //76
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(count($theme_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //77
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //78
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" && in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0" && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0"  && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0"  && count($sutible_for_intersect)!="0" && count($gen_tags_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //79
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count>"0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            $theme_array=unserialize($package->package_category);
            $theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($theme_intersect)!="0"  && count($gen_tags_intersect)!="0" )
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //80
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            if(in_array($gues_rat, $guest_rating))
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //81
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($gues_rat, $guest_rating) && count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //82
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($gues_rat, $guest_rating) && count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //83
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count>"0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(in_array($gues_rat, $guest_rating) && count($service_included_intersect)!="0" && count($gen_tags_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //84
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count=="0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($service_included_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //85
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($service_included_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //86
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count>"0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($service_included_intersect)!="0" && count($gen_tags_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //87
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count=="0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            // $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //88
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count>"0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if( count($gen_tags_intersect)!="0" && count($sutible_for_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //89
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0" && $services_includes_count=="0" && $sut_for_count=="0" && $gen_tags_count>"0"):
            foreach($packages as $package)
            {
            //$city_array=unserialize($package->city);
            //$package_duration=$package->duration;
            //$intersect=array_intersect($city_array, $places);
            //$transport=$package->transport;
            //$theme_array=unserialize($package->package_category);
            //$theme_intersect=array_intersect($theme_type, $theme_array);
            $gues_rat=$package->customer_rating;
            $pricing=unserialize($package->pricing);
            $service=unserialize($package->package_service);
            // $service_included_intersect=array_intersect($services_includes, $service);
            // $sutible_for_intersect=array_intersect($sut_for, $service);
            $gen_tags_intersect=array_intersect($gen_tags, $service);
            if(count($gen_tags_intersect)!="0")
            {
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            }
            //90
            elseif($places_count=="0" && $duration_count=="0" && $travel_type_count=="0" && $theme_type_count=="0" && $guest_rating_count=="0"):
            foreach($packages as $package)
            {
            $pricing=unserialize($package->pricing);
            /*foreach($pricing as $pri):
            $prices[]=['id'=>$package->id,'price'=>$pri["adult_fare_total"],'duration'=>$package->duration];
            endforeach;*/
            $new_price[]=CustomHelpers::get_total_price($package->id);
            //$pac_id[]=$package->id;
            }
            //
            endif;
      
            foreach($new_price as $pr):
            foreach($pr as $to):
            $prices[]=['id'=>$to["id"],'price'=>$to["price"],'duration'=>$to["duration"],'title'=>$to["title"]];
            endforeach;
            endforeach;
           
           $search = $request->search_package;
if($search!='')
{
  usort($prices, function ($a, $b) use ($search) {
    similar_text(strtolower($search), strtolower($b['title']), $percentB);
    similar_text(strtolower($search), strtolower($a['title']), $percentA);
    return $percentB <=> $percentA; // sort descending (best match on top)
});  
}


            if($sort_filter=="SEL"):
            $p_id=CustomHelpers::get_sel($prices,$min_price,$max_price);

            elseif($sort_filter=="PLH"):
            $p_id=CustomHelpers::get_plh($prices,$min_price,$max_price);
            elseif($sort_filter=="PHL"):
            $p_id=CustomHelpers::get_phl($prices,$min_price,$max_price);
            elseif($sort_filter=="DLH"):
            $p_id=CustomHelpers::get_dlh($prices,$min_price,$max_price);
            elseif($sort_filter=="DHL"):
            $p_id=CustomHelpers::get_dhl($prices,$min_price,$max_price);
            endif;

            //print_r($p_id);
            $pac_data="";
            $p_id=implode(",", $p_id);
            $p_id=explode(",", $p_id);
            $icon_data=Icons::all();
            $p_id= array_slice($p_id, 0, 3);
            foreach($p_id as $ids):
            $data=DB::table('rt_packages')->where('id','=',$ids)->get();

            $pac_data.= view('packages.secondpage.rendersorting_data',compact('data','icon_data','window_width','search_date'))->render();
            endforeach;

            echo $pac_data."<br>";
      
    }

    // load more packages (page two) (optimized but not working, check with error log)
    /*public function mid_package_data(Request $request)
    {
        // Fetch filters from request
        $window_width = $request->input('window_width');
        $limit = (int) $request->input('limit', 4); // Default limit to 4
        $event_type = $request->input('event_type', '1');
        $packages_id = $request->input('packages_id', []);
        
        // Ensure $packages_id is always an array
        $packages_id = is_array($packages_id) ? $packages_id : [$packages_id];

        // Destination and filter inputs
        $destination = $request->input('destination', '');
        $places = $request->input('places', []);
        $duration = $request->input('duration', []);
        $travel_type = $request->input('travel_type', []);
        $theme_type = $request->input('theme_type', []);
        $guest_rating = $request->input('guest_rating', []);
        $services_includes = $request->input('services_includes', []);
        $sut_for = $request->input('sut_for', []);
        $gen_tags = $request->input('gen_tags', []);
        $search_date = $request->input('search_date', '');
        $sort_filter = $request->input('sort_filter', 'SEL');

        // Sanitize price values
        $min_price = (int) filter_var($request->input('min_price', 0), FILTER_SANITIZE_NUMBER_INT);
        $max_price = (int) filter_var($request->input('max_price', 0), FILTER_SANITIZE_NUMBER_INT);

        // Fetch required models
        $icons = Icons::all();
        $generals = Gtags::all();
        $suitables = Suitable::all();

        // Initialize query WITHOUT price filtering
        $query = DB::table('rt_packages')
            ->where('status', '1')
            ->where(function ($query) use ($destination) {
                $query->where('continent', 'like', "%{$destination}%")
                    ->orWhere('country', 'like', "%{$destination}%")
                    ->orWhere('city', 'like', "%{$destination}%")
                    ->orWhere('state', 'like', "%{$destination}%");
            });

        // Apply filters dynamically
        if (!empty($places)) {
            $query->whereIn('city', $places);
        }
        if (!empty($duration)) {
            $query->whereIn('days', $duration);
        }
        if (!empty($travel_type)) {
            $query->whereIn('travel_type', $travel_type);
        }
        if (!empty($theme_type)) {
            $query->whereIn('theme', $theme_type);
        }
        if (!empty($guest_rating)) {
            $query->whereIn('guest_rating', $guest_rating);
        }
        if (!empty($services_includes)) {
            $query->whereIn('services_includes', $services_includes);
        }
        if (!empty($sut_for)) {
            $query->whereIn('suitability', $sut_for);
        }
        if (!empty($gen_tags)) {
            $query->whereIn('tags', $gen_tags);
        }

        // Exclude already loaded packages
        if (!empty($packages_id)) {
            $query->whereNotIn('id', $packages_id);
        }

        // Sorting (excluding price sorting since price is calculated dynamically)
        $query->orderBy('id', 'DESC');

        // Apply limit
        $query->limit($limit);

        // Execute query
        $packages = $query->get();

        // Debugging: Log the total number of packages retrieved before filtering
        \Log::info('Total Packages Before Price Filter: ' . count($packages));
        \Log::info('Packages Data Before Filtering:', $packages->toArray());

        // Now filter by price in PHP
        $filteredPackages = $packages->filter(function ($package) use ($min_price, $max_price) {
            $priceData = CustomHelpers::get_total_price($package->id);
            $packagePrice = !empty($priceData) ? $priceData[0]['price'] : 0; // Extract price from helper function

            // Debugging: Log each package price before filtering
            \Log::info("Package ID: {$package->id}, Calculated Price: {$packagePrice}, Min Price: {$min_price}, Max Price: {$max_price}");

            return ($packagePrice >= $min_price && $packagePrice <= $max_price);
        });

        // Debugging: Log filtered package count
        \Log::info('Total Packages After Price Filter: ' . count($filteredPackages));

        // Prepare response
        $pac_data = '';
        foreach ($filteredPackages as $package) {
            $pac_data .= view('packages.secondpage.rendersorting_data', compact('package', 'icons', 'window_width', 'search_date'))->render();
        }

        // Debugging: Log final package count sent to frontend
        \Log::info('Total Packages Sent to Frontend: ' . count($filteredPackages));

        // Return as JSON response for AJAX
        return response()->json([
            'html' => $pac_data,
            'no_more_data' => count($filteredPackages) === 0, // If no packages, return true
        ]);
    }*/
}