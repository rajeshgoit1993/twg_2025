<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Icons;
use App\Packages;
use App\Quotation;
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
use Session;
use App\ActivateService;
use App\QuoteCharges;
use App\Coupon;
use App\Helpers\CustomHelpers;

class PackagePriceHelpers {
    public static function get_new_pricing_data($package_id,$given_date)
    {
            $Packages = Packages::findOrFail($package_id);
            if($Packages->newprices_discounts!='') {
            $pricediscounts = unserialize($Packages->newprices_discounts);
            $new_price=PackagePriceHelpers::get_package_new_price($Packages->newprices,$Packages->adult,$Packages->extra_adult,$Packages->child_with_bed,$Packages->child_without_bed,$Packages->infant,$Packages->solo_traveller);
            $start_date=[];
            $output='';
            $overall_package_rating=[];
            $overall_package_rating_without_date=[];
            $overall_package_rating_with_date=[];
            if($Packages->show_status==0)
            {
            $output='na';
            }
            else
            {
            if(is_array($pricediscounts) && count($pricediscounts)>0)
            {
            $datef="";
            $datet="";
            $total_f="";
            $total_price="";
            $cutt_off="";
            foreach($pricediscounts as $row=>$col):
            if(array_key_exists('package_rating',$col))
            {
            $overall_package_rating_without_date[]=$col['package_rating'];
            if(count($col)>=30)
            {
            $date_array=$col['datefrom'];
            foreach($date_array as $row_from=>$col_from)
            {
            $datefrom=$col['datefrom'][$row_from];
            $datefrom=explode("/", $datefrom);
            $datefrom_year=array_key_exists(2,$datefrom) ? $datefrom["2"] : 0;
            $datefrom_day=$datefrom["0"];
            $datefrom_month=array_key_exists(1,$datefrom) ? $datefrom["1"] : 0;
            $datefrom=($datefrom_year."-".$datefrom_month."-".$datefrom_day);
            $datefrom=date('Y-m-d', strtotime("-0 day", strtotime($datefrom)));
            $dateto=$col['dateto'][$row_from];
            $dateto=explode("/", $dateto);
            $dateto_year=array_key_exists(2,$dateto) ? $dateto["2"] : 0;
            $dateto_day=$dateto["0"];
            $dateto_month=array_key_exists(1,$dateto) ? $dateto["1"] : 0;
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
            $output_price=$new_price["package_pricetopay_adult"];
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
            $output_price=$out_day['Sun'];
            }
            elseif($sunday_discount_type==3)
            {
            $coupon_discount_id=$col['sunday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Sun']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Sun'];
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
            $output_price=$out_day['Mon'];
            }
            elseif($monday_discount_type==3)
            {
            $coupon_discount_id=$col['monday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Mon']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Mon'];
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
            $output_price=$out_day['Tue'];
            }
            elseif($tuesday_discount_type==3)
            {
            $coupon_discount_id=$col['tuesday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Tue']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Tue'];
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
            $output_price=$out_day['Wed'];
            }
            elseif($wednesday_discount_type==3)
            {
            $coupon_discount_id=$col['wednesday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Wed']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Wed'];
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
            $output_price=$out_day['Thu'];
            }
            elseif($thursday_discount_type==3)
            {
            $coupon_discount_id=$col['thursday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Thu']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Thu'];
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
            $output_price=$out_day['Fri'];
            }
            elseif($friday_discount_type==3)
            {
            $coupon_discount_id=$col['friday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Fri']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Fri'];
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
            $output_price=$out_day['Sat'];
            }
            elseif($saturday_discount_type==3)
            {
            $coupon_discount_id=$col['saturday_coupon_discount'][$row_from];
            $coupon=Coupon::find($coupon_discount_id);
            $coupon_percentage=$coupon->value;
            $out_day['Sat']=round($new_price["package_pricetopay_adult"]-($new_price["package_pricetopay_adult"]*$coupon_percentage/100));
            $output_price=$out_day['Sat'];
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
            // if(strtotime($datefrom)>=strtotime($limit_days))
            // {
            //    $start_date[]=$datefrom;
            // }
            if(strtotime($datefrom)>=strtotime($given_date) && $output_price>0)
            {
            if(!array_key_exists($col['package_rating'],$overall_package_rating_with_date))
            {
            $overall_package_rating_with_date[$col['package_rating']]=strtotime($datefrom);
            }
            if(strtotime($datefrom)==strtotime($given_date))
            {
            $overall_package_rating[$col['package_rating']]=  $output_price;
            }
            if($applicable_for=='all')
            {
            $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$output_price,'package_rating'=>$col['package_rating']);
            }
            elseif($applicable_for=='day_wise')
            {
            $day = date('D', strtotime($datefrom));
            $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$out_day[$day],'package_rating'=>$col['package_rating']);
            }
            else
            {
            $daterange[]=array( 'date'=>strtotime($datefrom),'price'=>$output_price,'package_rating'=>$col['package_rating']);
            }
            }
            $datefrom = date ("Y-m-d", strtotime("+1 day", strtotime($datefrom)));
            }
            }
            }
            }
            endforeach;
            if(isset($daterange) && is_array($daterange) && count($daterange)>0)
            {
            $key_values = array_column($daterange, 'date');
            array_multisort($key_values, SORT_ASC, $daterange);
            $overall_package_rating_unique=array_unique($overall_package_rating);
            $key = array_search(strtotime($given_date), array_column($daterange, 'date'));
            if ($key !== false)
            {
            $key = array_search(strtotime($given_date), array_column($daterange, 'date'));
            $output=['discount_price'=>$daterange[$key]['price'],'actual_price'=>$new_price["package_pricetopay_adult"],'date'=>$daterange[$key]['date'],'end_date'=>$daterange[count($daterange)-1]['date'],'package_rating'=>$daterange[$key]['package_rating'],'overall_package_rating'=>$overall_package_rating_unique,'overall_package_rating_without_date'=>$overall_package_rating_without_date,'overall_package_rating_with_date'=>$overall_package_rating_with_date];
            }
            else
            {
            $output=['discount_price'=>$daterange[0]['price'],'actual_price'=>$new_price["package_pricetopay_adult"],'date'=>$daterange[0]['date'],'end_date'=>$daterange[count($daterange)-1]['date'],'package_rating'=>$daterange[0]['package_rating'],'overall_package_rating'=>$overall_package_rating_unique,'overall_package_rating_without_date'=>$overall_package_rating_without_date,'overall_package_rating_with_date'=>$overall_package_rating_with_date];
            }
            }
            else
            {
            $output='na';
            }
            }
            else
            {
            $output='na';
            }
            }
            }
            else
            {
            $output='na';
            }
        
            return $output;
    }

    public static function get_package_new_price($price,$adult,$extra_adult,$child_with_bed,$child_without_bed,$infant,$solo_traveller)
    {
            if($adult=="")
            {
            $adult=0;
            }
            if($extra_adult=="")
            {
            $extra_adult=0;
            }
            if($child_with_bed=="")
            {
            $child_with_bed=0;
            }
            if($child_without_bed=="")
            {
            $child_without_bed=0;
            }
            if($infant=="")
            {
            $infant=0;
            }
            if($solo_traveller=="")
            {
            $solo_traveller=0;
            }
            $price=unserialize($price);

            $aircurrency =is_array($price) ? array_key_exists('aircurrency',$price) ? CustomHelpers::get_rate($price['aircurrency']) : 0 :0;
            $cruisecurrency =is_array($price) ? array_key_exists('cruisecurrency',$price) ? CustomHelpers::get_rate($price['cruisecurrency']) : 0 :0;
            $portchargecurrency =is_array($price) ? array_key_exists('portchargecurrency',$price) ? CustomHelpers::get_rate($price['portchargecurrency']) : 0 :0;
            $gratuitycurrency =is_array($price) ? array_key_exists('gratuitycurrency',$price) ? CustomHelpers::get_rate($price['gratuitycurrency']) : 0 :0;
            $cruise_gstcurrency =is_array($price) ? array_key_exists('cruise_gstcurrency',$price) ? CustomHelpers::get_rate($price['cruise_gstcurrency']) : 0 :0;
            $accommodationcurrency =is_array($price) ? array_key_exists('accommodationcurrency',$price) ? CustomHelpers::get_rate($price['accommodationcurrency']) : 0 :0;
            $sightseeingcurrency=is_array($price) ? array_key_exists('sightseeingcurrency',$price) ? CustomHelpers::get_rate($price['sightseeingcurrency']) : 0 :0;
            $transferscurrency=is_array($price) ? array_key_exists('transferscurrency',$price) ? CustomHelpers::get_rate($price['transferscurrency']) : 0 :0;
            $visacurrency=is_array($price) ? array_key_exists('visacurrency',$price) ? CustomHelpers::get_rate($price['visacurrency']) : 0 :0;
            $travelcurrency=is_array($price) ? array_key_exists('travelcurrency',$price) ? CustomHelpers::get_rate($price['travelcurrency']) : 0 :0;
            $mealscurrency=is_array($price) ? array_key_exists('mealscurrency',$price) ? CustomHelpers::get_rate($price['mealscurrency']) : 0 :0;
            $addon_servicecurrency=is_array($price) ? array_key_exists('addon_servicecurrency',$price) ? CustomHelpers::get_rate($price['addon_servicecurrency']) : 0 :0;
            $markupcurrency=is_array($price) ? array_key_exists('markupcurrency',$price) ? CustomHelpers::get_rate($price['markupcurrency']) : 0 :0;
            $discount_positive_currency=is_array($price) ? array_key_exists('discount_positive_currency',$price) ? CustomHelpers::get_rate($price['discount_positive_currency']) : 0 :0;
            $discount_negative_currency=is_array($price) ? array_key_exists('discount_negative_currency',$price) ? CustomHelpers::get_rate($price['discount_negative_currency']) : 0 :0;
            $gst_currency=is_array($price) ? array_key_exists('gst_currency',$price) ? CustomHelpers::get_rate($price['gst_currency']) : 0 :0;
            $tcs_currency=is_array($price) ? array_key_exists('tcs_currency',$price) ? CustomHelpers::get_rate($price['tcs_currency']) : 0 :0;
            $pgcharges_currency=is_array($price) ? array_key_exists('pgcharges_currency',$price) ? CustomHelpers::get_rate($price['pgcharges_currency']) : 0 :0;
            $data1=[
            "aircurrency" =>is_array($price) ? array_key_exists('aircurrency',$price) ? CustomHelpers::get_rate($price['aircurrency']) : 0 :0,
            "cruisecurrency" =>is_array($price) ? array_key_exists('cruisecurrency',$price) ? CustomHelpers::get_rate($price['cruisecurrency']) : 0 :0,
            "portchargecurrency" =>is_array($price) ? array_key_exists('portchargecurrency',$price) ? CustomHelpers::get_rate($price['portchargecurrency']) : 0 :0,
            "gratuitycurrency" =>is_array($price) ? array_key_exists('gratuitycurrency',$price) ? CustomHelpers::get_rate($price['gratuitycurrency']) : 0 :0,
            "cruise_gstcurrency" =>is_array($price) ? array_key_exists('cruise_gstcurrency',$price) ? CustomHelpers::get_rate($price['cruise_gstcurrency']) : 0 :0,
            "accommodationcurrency" =>is_array($price) ? array_key_exists('accommodationcurrency',$price) ? CustomHelpers::get_rate($price['accommodationcurrency']) : 0 :0,
            "sightseeingcurrency" =>is_array($price) ? array_key_exists('sightseeingcurrency',$price) ? CustomHelpers::get_rate($price['sightseeingcurrency']) : 0 :0,
            "transferscurrency" =>is_array($price) ? array_key_exists('transferscurrency',$price) ? CustomHelpers::get_rate($price['transferscurrency']) : 0 :0,
            "visacurrency" =>is_array($price) ? array_key_exists('visacurrency',$price) ? CustomHelpers::get_rate($price['visacurrency']) : 0 :0,
            "travelcurrency" =>is_array($price) ? array_key_exists('travelcurrency',$price) ? CustomHelpers::get_rate($price['travelcurrency']) : 0 :0,
            "mealscurrency" =>is_array($price) ? array_key_exists('mealscurrency',$price) ? CustomHelpers::get_rate($price['mealscurrency']) : 0 :0,
            "addon_servicecurrency" =>is_array($price) ? array_key_exists('addon_servicecurrency',$price) ? CustomHelpers::get_rate($price['addon_servicecurrency']) : 0 :0,
            "markupcurrency" =>is_array($price) ? array_key_exists('markupcurrency',$price) ? CustomHelpers::get_rate($price['markupcurrency']) : 0 :0,
            "discount_positive_currency" =>is_array($price) ? array_key_exists('discount_positive_currency',$price) ? CustomHelpers::get_rate($price['discount_positive_currency']) : 0 :0,
            "discount_negative_currency" =>is_array($price) ? array_key_exists('discount_negative_currency',$price) ? CustomHelpers::get_rate($price['discount_negative_currency']) : 0 :0,
            "gst_currency" =>is_array($price) ? array_key_exists('gst_currency',$price) ? CustomHelpers::get_rate($price['gst_currency']) : 0 :0,
            "tcs_currency" =>is_array($price) ? array_key_exists('tcs_currency',$price) ? CustomHelpers::get_rate($price['tcs_currency']) : 0 :0,
            "pgcharges_currency" =>is_array($price) ? array_key_exists('pgcharges_currency',$price) ? CustomHelpers::get_rate($price['pgcharges_currency']) : 0 :0,
            "package_airfare" =>is_array($price) ? array_key_exists('package_airfare',$price) ? $price['package_airfare'] : 0 :0,
            "package_airfare_remarks" =>is_array($price) ? array_key_exists('package_airfare_remarks',$price) ? $price['package_airfare_remarks'] : 0 :0,
            "package_air_adult" =>is_array($price) ? array_key_exists('package_air_adult',$price) ?  $price['package_air_adult'] : 0 :0,
            "package_air_exadult" =>is_array($price) ?  array_key_exists('package_air_exadult',$price) ? $price['package_air_exadult'] : 0 :0,
            "package_air_childbed" =>is_array($price) ?  array_key_exists('package_air_childbed',$price) ?  $price['package_air_childbed'] : 0 :0,
            "package_air_childwbed" =>is_array($price) ? array_key_exists('package_air_childwbed',$price) ?  $price['package_air_childwbed'] : 0 :0,
            "package_air_infant" =>is_array($price) ? array_key_exists('package_air_infant',$price) ?  $price['package_air_infant'] : 0 :0,
            "package_air_single" =>is_array($price) ? array_key_exists('package_air_single',$price) ?  $price['package_air_single'] : 0 :0,
            "package_cruise_fare" =>is_array($price) ? array_key_exists('package_cruise_fare',$price) ? $price['package_cruise_fare'] : 0 :0,
            "package_cruise_fare_remarks" =>is_array($price) ? array_key_exists('package_cruise_fare_remarks',$price) ? $price['package_cruise_fare_remarks'] : 0:0,
            "package_cruise_adult" => is_array($price) ? array_key_exists('package_cruise_adult',$price) ? $price['package_cruise_adult'] : 0 :0,
            "package_cruise_exadult" => is_array($price) ? array_key_exists('package_cruise_exadult',$price) ? $price['package_cruise_exadult'] : 0 :0,
            "package_cruise_childbed" => is_array($price) ? array_key_exists('package_cruise_childbed',$price) ? $price['package_cruise_childbed'] : 0 :0,
            "package_cruise_childwbed" => is_array($price) ? array_key_exists('package_cruise_childwbed',$price) ? $price['package_cruise_childwbed'] : 0 :0,
            "package_cruise_infant" => is_array($price) ? array_key_exists('package_cruise_infant',$price) ? $price['package_cruise_infant'] : 0 :0,
            "package_cruise_single" => is_array($price) ? array_key_exists('package_cruise_single',$price) ? $price['package_cruise_single'] : 0 :0,
            "port_charge_supplier" =>is_array($price) ? array_key_exists('port_charge_supplier',$price) ? $price['port_charge_supplier'] : 0 :0,
            "port_charge_fare_remarks" =>is_array($price) ? array_key_exists('port_charge_fare_remarks',$price) ? $price['port_charge_fare_remarks'] : 0 :0,

            "package_cruiseport_adult" =>is_array($price) ? array_key_exists('package_cruiseport_adult',$price) ? $price['package_cruiseport_adult'] : 0 : 0 ,
            "package_cruiseport_exadult" =>is_array($price) ? array_key_exists('package_cruiseport_exadult',$price) ? $price['package_cruiseport_exadult'] : 0 : 0 ,
            "package_cruiseport_childbed" =>is_array($price) ? array_key_exists('package_cruiseport_childbed',$price) ? $price['package_cruiseport_childbed'] : 0 : 0 ,
            "package_cruiseport_childwbed" =>is_array($price) ? array_key_exists('package_cruiseport_childwbed',$price) ? $price['package_cruiseport_childwbed'] : 0 : 0 ,
            "package_cruiseport_infant" =>is_array($price) ? array_key_exists('package_cruiseport_infant',$price) ? $price['package_cruiseport_infant'] : 0 : 0 ,
            "package_cruiseport_single" =>is_array($price) ? array_key_exists('package_cruiseport_single',$price) ? $price['package_cruiseport_single'] : 0 : 0 ,
            "gratuity_supplier" =>is_array($price) ? array_key_exists('gratuity_supplier',$price) ? $price['gratuity_supplier'] : 0 : 0 ,
            "gratuity_remarks" =>is_array($price) ? array_key_exists('gratuity_remarks',$price) ? $price['gratuity_remarks'] : 0 : 0 ,
            "package_cruisegratuity_adult" =>is_array($price) ? array_key_exists('package_cruisegratuity_adult',$price) ? $price['package_cruisegratuity_adult'] : 0 : 0 ,
            "package_cruisegratuity_exadult" =>is_array($price) ? array_key_exists('package_cruisegratuity_exadult',$price) ? $price['package_cruisegratuity_exadult'] : 0 : 0 ,
            "package_cruisegratuity_childbed" =>is_array($price) ? array_key_exists('package_cruisegratuity_childbed',$price) ? $price['package_cruisegratuity_childbed'] : 0 : 0 ,
            "package_cruisegratuity_childwbed" =>is_array($price) ? array_key_exists('package_cruisegratuity_childwbed',$price) ? $price['package_cruisegratuity_childwbed'] : 0 : 0 ,
            "package_cruisegratuity_infant" =>is_array($price) ? array_key_exists('package_cruisegratuity_infant',$price) ? $price['package_cruisegratuity_infant'] : 0 : 0 ,
            "package_cruisegratuity_single" =>is_array($price) ? array_key_exists('package_cruisegratuity_single',$price) ? $price['package_cruisegratuity_single'] : 0 : 0 ,
            "cruise_gst_fare_supplier" =>is_array($price) ? array_key_exists('cruise_gst_fare_supplier',$price) ? $price['cruise_gst_fare_supplier'] : 0 : 0 ,
            "cruise_gst_fare_remarks" =>is_array($price) ? array_key_exists('cruise_gst_fare_remarks',$price) ? $price['cruise_gst_fare_remarks'] : 0 : 0 ,
            "package_cruisegst_adult" =>is_array($price) ? array_key_exists('package_cruisegst_adult',$price) ? $price['package_cruisegst_adult'] : 0 : 0 ,
            "package_cruisegst_exadult" =>is_array($price) ? array_key_exists('package_cruisegst_exadult',$price) ? $price['package_cruisegst_exadult'] : 0 : 0 ,
            "package_cruisegst_childbed" =>is_array($price) ? array_key_exists('package_cruisegst_childbed',$price) ? $price['package_cruisegst_childbed'] : 0 : 0 ,
            "package_cruisegst_childwbed" => is_array($price) ? array_key_exists('package_cruisegst_childwbed',$price) ? $price['package_cruisegst_childwbed'] : 0 : 0 ,
            "package_cruisegst_infant" => is_array($price) ? array_key_exists('package_cruisegst_infant',$price) ? $price['package_cruisegst_infant'] : 0 : 0 ,
            "package_cruisegst_single" => is_array($price) ? array_key_exists('package_cruisegst_single',$price) ? $price['package_cruisegst_single'] : 0 : 0 ,
            "accommodation_fare_supplier" =>is_array($price) ? array_key_exists('accommodation_fare_supplier',$price) ? $price['accommodation_fare_supplier'] : 0 : 0 ,
            "accommodation_fare_remarks" =>is_array($price) ? array_key_exists('accommodation_fare_remarks',$price) ? $price['accommodation_fare_remarks'] : 0 : 0 ,
            "package_hotel_adult" =>is_array($price) ? array_key_exists('package_hotel_adult',$price) ? $price['package_hotel_adult'] : 0 : 0 ,
            "package_hotel_exadult" => is_array($price) ? array_key_exists('package_hotel_exadult',$price) ? $price['package_hotel_exadult'] : 0 : 0 ,
            "package_hotel_childbed" =>is_array($price) ? array_key_exists('package_hotel_childbed',$price) ? $price['package_hotel_childbed'] : 0  : 0,
            "package_hotel_childwbed" =>is_array($price) ? array_key_exists('package_hotel_childwbed',$price) ? $price['package_hotel_childwbed'] : 0 : 0 ,
            "package_hotel_infant" =>is_array($price) ? array_key_exists('package_hotel_infant',$price) ? $price['package_hotel_infant'] : 0  : 0,
            "package_hotel_single" => is_array($price) ? array_key_exists('package_hotel_single',$price) ? $price['package_hotel_single'] : 0 : 0 ,
            "sightseeing_fare_supplier" =>is_array($price) ? array_key_exists('sightseeing_fare_supplier',$price) ? $price['sightseeing_fare_supplier'] : 0 : 0 ,
            "sightseeing_fare_remarks" =>is_array($price) ? array_key_exists('sightseeing_fare_remarks',$price) ? $price['sightseeing_fare_remarks'] : 0 : 0 ,
            "package_tours_adult" => is_array($price) ? array_key_exists('package_tours_adult',$price) ? $price['package_tours_adult'] : 0 : 0 ,
            "package_tours_exadult" =>is_array($price) ? array_key_exists('package_tours_exadult',$price) ? $price['package_tours_exadult'] : 0 : 0 ,
            "package_tours_childbed" => is_array($price) ? array_key_exists('package_tours_childbed',$price) ? $price['package_tours_childbed'] : 0 : 0 ,
            "package_tours_childwbed" => is_array($price) ? array_key_exists('package_tours_childwbed',$price) ? $price['package_tours_childwbed'] : 0 : 0 ,
            "package_tours_infant" =>is_array($price) ? array_key_exists('package_tours_infant',$price) ? $price['package_tours_infant'] : 0 : 0 ,
            "package_tours_single" =>is_array($price) ? array_key_exists('package_tours_single',$price) ? $price['package_tours_single'] : 0 : 0 ,
            "transfers_fare_supplier" => is_array($price) ? array_key_exists('transfers_fare_supplier',$price) ? $price['transfers_fare_supplier'] : 0 : 0 ,
            "transfers_fare_remarks" =>is_array($price) ? array_key_exists('transfers_fare_remarks',$price) ? $price['transfers_fare_remarks'] : 0 : 0 ,
            "package_transfer_adult" => is_array($price) ? array_key_exists('package_transfer_adult',$price) ? $price['package_transfer_adult'] : 0 : 0 ,
            "package_transfer_exadult" =>is_array($price) ? array_key_exists('package_transfer_exadult',$price) ? $price['package_transfer_exadult'] : 0 : 0 ,
            "package_transfer_childbed" =>is_array($price) ? array_key_exists('package_transfer_childbed',$price) ? $price['package_transfer_childbed'] : 0 : 0 ,
            "package_transfer_childwbed" =>is_array($price) ? array_key_exists('package_transfer_childwbed',$price) ? $price['package_transfer_childwbed'] : 0 : 0 ,
            "package_transfer_infant" =>is_array($price) ? array_key_exists('package_transfer_infant',$price) ? $price['package_transfer_infant'] : 0 : 0 ,
            "package_transfer_single" =>is_array($price) ? array_key_exists('package_transfer_single',$price) ? $price['package_transfer_single'] : 0 : 0 ,
            "visa_charges_fare_supplier" => is_array($price) ? array_key_exists('visa_charges_fare_supplier',$price) ? $price['visa_charges_fare_supplier'] : 0 : 0 ,
            "visa_charges_fare_remarks" =>is_array($price) ? array_key_exists('visa_charges_fare_remarks',$price) ? $price['visa_charges_fare_remarks'] : 0 : 0 ,
            "package_visa_adult" =>is_array($price) ? array_key_exists('package_visa_adult',$price) ? $price['package_visa_adult'] : 0 : 0 ,
            "package_visa_exadult" =>is_array($price) ? array_key_exists('package_visa_exadult',$price) ? $price['package_visa_exadult'] : 0 : 0 ,
            "package_visa_childbed" =>is_array($price) ? array_key_exists('package_visa_childbed',$price) ? $price['package_visa_childbed'] : 0 : 0 ,
            "package_visa_childwbed" =>is_array($price) ? array_key_exists('package_visa_childwbed',$price) ? $price['package_visa_childwbed'] : 0 : 0 ,
            "package_visa_infant" =>is_array($price) ? array_key_exists('package_visa_infant',$price) ? $price['package_visa_infant'] : 0 : 0 ,
            "package_visa_single" =>is_array($price) ? array_key_exists('package_visa_single',$price) ? $price['package_visa_single'] : 0 : 0 ,
            "travel_insurance_fare_supplier" => is_array($price) ? array_key_exists('travel_insurance_fare_supplier',$price) ? $price['travel_insurance_fare_supplier'] : 0 : 0 ,
            "travel_insurance_fare_remarks" => is_array($price) ? array_key_exists('travel_insurance_fare_remarks',$price) ? $price['travel_insurance_fare_remarks'] : 0 : 0 ,
            "package_inc_adult" => is_array($price) ? array_key_exists('package_inc_adult',$price) ? $price['package_inc_adult'] : 0 : 0 ,
            "package_inc_exadult" =>is_array($price) ? array_key_exists('package_inc_exadult',$price) ? $price['package_inc_exadult'] : 0 : 0 ,
            "package_inc_childbed" =>is_array($price) ? array_key_exists('package_inc_childbed',$price) ? $price['package_inc_childbed'] : 0 : 0 ,
            "package_inc_childwbed" =>is_array($price) ? array_key_exists('package_inc_childwbed',$price) ? $price['package_inc_childwbed'] : 0 : 0 ,
            "package_inc_infant" =>is_array($price) ? array_key_exists('package_inc_infant',$price) ? $price['package_inc_infant'] : 0 : 0 ,
            "package_inc_single" =>is_array($price) ? array_key_exists('package_inc_single',$price) ? $price['package_inc_single'] : 0 : 0 ,
            "meals_fare_supplier" =>is_array($price) ? array_key_exists('meals_fare_supplier',$price) ? $price['meals_fare_supplier'] : 0  : 0,
            "meals_fare_remarks" =>is_array($price) ? array_key_exists('meals_fare_remarks',$price) ? $price['meals_fare_remarks'] : 0 : 0 ,
            "package_meals_adult" =>is_array($price) ? array_key_exists('package_meals_adult',$price) ? $price['package_meals_adult'] : 0 : 0 ,
            "package_meals_exadult" =>is_array($price) ? array_key_exists('package_meals_exadult',$price) ? $price['package_meals_exadult'] : 0 : 0 ,
            "package_meals_childbed" =>is_array($price) ? array_key_exists('package_meals_childbed',$price) ? $price['package_meals_childbed'] : 0 : 0 ,
            "package_meals_childwbed" =>is_array($price) ? array_key_exists('package_meals_childwbed',$price) ? $price['package_meals_childwbed'] : 0 : 0 ,
            "package_meals_infant" =>is_array($price) ? array_key_exists('package_meals_infant',$price) ? $price['package_meals_infant'] : 0 : 0 ,
            "package_meals_single" =>is_array($price) ? array_key_exists('package_meals_single',$price) ? $price['package_meals_single'] : 0 : 0 ,
            "addon_service_fare_supplier" =>is_array($price) ? array_key_exists('addon_service_fare_supplier',$price) ? $price['addon_service_fare_supplier'] : 0 : 0 ,
            "addon_service_fare_remarks" =>is_array($price) ? array_key_exists('addon_service_fare_remarks',$price) ? $price['addon_service_fare_remarks'] : 0 : 0 ,
            "package_additionalservice_adult" => is_array($price) ? array_key_exists('package_additionalservice_adult',$price) ? $price['package_additionalservice_adult'] : 0 : 0 ,
            "package_additionalservice_exadult" => is_array($price) ? array_key_exists('package_additionalservice_exadult',$price) ? $price['package_additionalservice_exadult'] : 0 : 0 ,
            "package_additionalservice_childbed" => is_array($price) ? array_key_exists('package_additionalservice_childbed',$price) ? $price['package_additionalservice_childbed'] : 0 : 0 ,
            "package_additionalservice_childwbed" =>is_array($price) ? array_key_exists('package_additionalservice_childwbed',$price) ? $price['package_additionalservice_childwbed'] : 0 : 0 ,
            "package_additionalservice_infant" =>is_array($price) ? array_key_exists('package_additionalservice_infant',$price) ? $price['package_additionalservice_infant'] : 0 : 0 ,
            "package_additionalservice_single" =>is_array($price) ? array_key_exists('package_additionalservice_single',$price) ? $price['package_additionalservice_single'] : 0 : 0 ,
            ];
            $total_adult=0;
            if(is_array($price) && array_key_exists('package_air_adult',$price) && $price['package_air_adult']!='' && $price['package_air_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_air_adult']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_adult',$price) && $price['package_cruise_adult']!='' && $price['package_cruise_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_cruise_adult']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_adult',$price) && $price['package_cruiseport_adult']!='' && $price['package_cruiseport_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_cruiseport_adult']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_adult',$price) && $price['package_cruisegratuity_adult']!='' && $price['package_cruisegratuity_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_cruisegratuity_adult']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_adult',$price) && $price['package_cruisegst_adult']!='' && $price['package_cruisegst_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_cruisegst_adult']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_adult',$price) && $price['package_hotel_adult']!='' && $price['package_hotel_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_hotel_adult']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_adult',$price) && $price['package_tours_adult']!='' && $price['package_tours_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_tours_adult']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_adult',$price) && $price['package_transfer_adult']!='' && $price['package_transfer_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_transfer_adult']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_adult',$price) && $price['package_visa_adult']!='' && $price['package_visa_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_visa_adult']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_adult',$price) && $price['package_inc_adult']!='' && $price['package_inc_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_inc_adult']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_adult',$price) && $price['package_meals_adult']!='' && $price['package_meals_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_meals_adult']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_adult',$price) && $price['package_additionalservice_adult']!='' && $price['package_additionalservice_adult']!=0)
            {
            $total_adult=$total_adult+$price['package_additionalservice_adult']*$addon_servicecurrency;
            }
            //
            $total_exadult=0;
            if(is_array($price) && array_key_exists('package_air_exadult',$price) && $price['package_air_exadult']!='' && $price['package_air_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_air_exadult']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_exadult',$price) && $price['package_cruise_exadult']!='' && $price['package_cruise_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_cruise_exadult']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_exadult',$price) && $price['package_cruiseport_exadult']!='' && $price['package_cruiseport_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_cruiseport_exadult']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_exadult',$price) && $price['package_cruisegratuity_exadult']!='' && $price['package_cruisegratuity_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_cruisegratuity_exadult']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_exadult',$price) && $price['package_cruisegst_exadult']!='' && $price['package_cruisegst_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_cruisegst_exadult']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_exadult',$price) && $price['package_hotel_exadult']!='' && $price['package_hotel_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_hotel_exadult']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_exadult',$price) && $price['package_tours_exadult']!='' && $price['package_tours_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_tours_exadult']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_exadult',$price) && $price['package_transfer_exadult']!='' && $price['package_transfer_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_transfer_exadult']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_exadult',$price) && $price['package_visa_exadult']!='' && $price['package_visa_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_visa_exadult']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_exadult',$price) && $price['package_inc_exadult']!='' && $price['package_inc_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_inc_exadult']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_exadult',$price) && $price['package_meals_exadult']!='' && $price['package_meals_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_meals_exadult']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_exadult',$price) && $price['package_additionalservice_exadult']!='' && $price['package_additionalservice_exadult']!=0)
            {
            $total_exadult=$total_exadult+$price['package_additionalservice_exadult']*$addon_servicecurrency;
            }
            //
            $total_childbed=0;
            if(is_array($price) && array_key_exists('package_air_childbed',$price) && $price['package_air_childbed']!='' && $price['package_air_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_air_childbed']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_childbed',$price) && $price['package_cruise_childbed']!='' && $price['package_cruise_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_cruise_childbed']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_childbed',$price) && $price['package_cruiseport_childbed']!='' && $price['package_cruiseport_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_cruiseport_childbed']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_childbed',$price) && $price['package_cruisegratuity_childbed']!='' && $price['package_cruisegratuity_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_cruisegratuity_childbed']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_childbed',$price) && $price['package_cruisegst_childbed']!='' && $price['package_cruisegst_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_cruisegst_childbed']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_childbed',$price) && $price['package_hotel_childbed']!='' && $price['package_hotel_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_hotel_childbed']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_childbed',$price) && $price['package_tours_childbed']!='' && $price['package_tours_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_tours_childbed']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_childbed',$price) && $price['package_transfer_childbed']!='' && $price['package_transfer_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_transfer_childbed']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_childbed',$price) && $price['package_visa_childbed']!='' && $price['package_visa_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_visa_childbed']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_childbed',$price) && $price['package_inc_childbed']!='' && $price['package_inc_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_inc_childbed']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_childbed',$price) && $price['package_meals_childbed']!='' && $price['package_meals_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_meals_childbed']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_childbed',$price) && $price['package_additionalservice_childbed']!='' && $price['package_additionalservice_childbed']!=0)
            {
            $total_childbed=$total_childbed+$price['package_additionalservice_childbed']*$addon_servicecurrency;
            }
            //
            $total_childwbed=0;
            if(is_array($price) && array_key_exists('package_air_childwbed',$price) && $price['package_air_childwbed']!='' && $price['package_air_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_air_childwbed']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_childwbed',$price) && $price['package_cruise_childwbed']!='' && $price['package_cruise_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_cruise_childwbed']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_childwbed',$price) && $price['package_cruiseport_childwbed']!='' && $price['package_cruiseport_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_cruiseport_childwbed']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_childwbed',$price) && $price['package_cruisegratuity_childwbed']!='' && $price['package_cruisegratuity_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_cruisegratuity_childwbed']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_childwbed',$price) && $price['package_cruisegst_childwbed']!='' && $price['package_cruisegst_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_cruisegst_childwbed']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_childwbed',$price) && $price['package_hotel_childwbed']!='' && $price['package_hotel_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_hotel_childwbed']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_childwbed',$price) && $price['package_tours_childwbed']!='' && $price['package_tours_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_tours_childwbed']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_childwbed',$price) && $price['package_transfer_childwbed']!='' && $price['package_transfer_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_transfer_childwbed']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_childwbed',$price) && $price['package_visa_childwbed']!='' && $price['package_visa_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_visa_childwbed']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_childwbed',$price) && $price['package_inc_childwbed']!='' && $price['package_inc_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_inc_childwbed']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_childwbed',$price) && $price['package_meals_childwbed']!='' && $price['package_meals_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_meals_childwbed']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_childwbed',$price) && $price['package_additionalservice_childwbed']!='' && $price['package_additionalservice_childwbed']!=0)
            {
            $total_childwbed=$total_childwbed+$price['package_additionalservice_childwbed']*$addon_servicecurrency;
            }
            //
            $total_infant=0;
            if(is_array($price) && array_key_exists('package_air_infant',$price) &&  $price['package_air_infant']!='' && $price['package_air_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_air_infant']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_infant',$price) &&  $price['package_cruise_infant']!='' && $price['package_cruise_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_cruise_infant']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_infant',$price) &&  $price['package_cruiseport_infant']!='' && $price['package_cruiseport_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_cruiseport_infant']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_infant',$price) &&  $price['package_cruisegratuity_infant']!='' && $price['package_cruisegratuity_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_cruisegratuity_infant']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_infant',$price) &&  $price['package_cruisegst_infant']!='' && $price['package_cruisegst_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_cruisegst_infant']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_infant',$price) &&  $price['package_hotel_infant']!='' && $price['package_hotel_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_hotel_infant']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_infant',$price) &&  $price['package_tours_infant']!='' && $price['package_tours_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_tours_infant']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_infant',$price) &&  $price['package_transfer_infant']!='' && $price['package_transfer_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_transfer_infant']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_infant',$price) &&  $price['package_visa_infant']!='' && $price['package_visa_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_visa_infant']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_infant',$price) &&  $price['package_inc_infant']!='' && $price['package_inc_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_inc_infant']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_infant',$price) &&  $price['package_meals_infant']!='' && $price['package_meals_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_meals_infant']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_infant',$price) &&  $price['package_additionalservice_infant']!='' && $price['package_additionalservice_infant']!=0)
            {
            $total_infant=$total_infant+$price['package_additionalservice_infant']*$addon_servicecurrency;
            }
            //
            $total_single=0;
            if(is_array($price) && array_key_exists('package_air_single',$price) && $price['package_air_single']!='' && $price['package_air_single']!=0)
            {
            $total_single=$total_single+$price['package_air_single']*$aircurrency;
            }
            if(is_array($price) && array_key_exists('package_cruise_single',$price) && $price['package_cruise_single']!='' && $price['package_cruise_single']!=0)
            {
            $total_single=$total_single+$price['package_cruise_single']*$cruisecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruiseport_single',$price) && $price['package_cruiseport_single']!='' && $price['package_cruiseport_single']!=0)
            {
            $total_single=$total_single+$price['package_cruiseport_single']*$portchargecurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegratuity_single',$price) && $price['package_cruisegratuity_single']!='' && $price['package_cruisegratuity_single']!=0)
            {
            $total_single=$total_single+$price['package_cruisegratuity_single']*$gratuitycurrency;
            }
            if(is_array($price) && array_key_exists('package_cruisegst_single',$price) && $price['package_cruisegst_single']!='' && $price['package_cruisegst_single']!=0)
            {
            $total_single=$total_single+$price['package_cruisegst_single']*$cruise_gstcurrency;
            }
            if(is_array($price) && array_key_exists('package_hotel_single',$price) && $price['package_hotel_single']!='' && $price['package_hotel_single']!=0)
            {
            $total_single=$total_single+$price['package_hotel_single']*$accommodationcurrency;
            }
            if(is_array($price) && array_key_exists('package_tours_single',$price) && $price['package_tours_single']!='' && $price['package_tours_single']!=0)
            {
            $total_single=$total_single+$price['package_tours_single']*$sightseeingcurrency;
            }
            if(is_array($price) && array_key_exists('package_transfer_single',$price) && $price['package_transfer_single']!='' && $price['package_transfer_single']!=0)
            {
            $total_single=$total_single+$price['package_transfer_single']*$transferscurrency;
            }
            if(is_array($price) && array_key_exists('package_visa_single',$price) && $price['package_visa_single']!='' && $price['package_visa_single']!=0)
            {
            $total_single=$total_single+$price['package_visa_single']*$visacurrency;
            }
            if(is_array($price) && array_key_exists('package_inc_single',$price) && $price['package_inc_single']!='' && $price['package_inc_single']!=0)
            {
            $total_single=$total_single+$price['package_inc_single']*$travelcurrency;
            }
            if(is_array($price) && array_key_exists('package_meals_single',$price) && $price['package_meals_single']!='' && $price['package_meals_single']!=0)
            {
            $total_single=$total_single+$price['package_meals_single']*$mealscurrency;
            }
            if(is_array($price) && array_key_exists('package_additionalservice_single',$price) && $price['package_additionalservice_single']!='' && $price['package_additionalservice_single']!=0)
            {
            $total_single=$total_single+$price['package_additionalservice_single']*$addon_servicecurrency;
            }

            $package_markup_adult=0;
            if(is_array($price) && array_key_exists('package_markup_adult',$price) && $price['package_markup_adult']!='')
            {
            $package_markup_adult=$price['package_markup_adult'];
            }
            $package_markup_exadult=0;
            if(is_array($price) && array_key_exists('package_markup_exadult',$price) && $price['package_markup_exadult']!='')
            {
            $package_markup_exadult=$price['package_markup_exadult'];
            }
            $package_markup_childbed=0;
            if(is_array($price) && array_key_exists('package_markup_childbed',$price) && $price['package_markup_childbed']!='')
            {
            $package_markup_childbed=$price['package_markup_childbed'];
            }
            $package_markup_childwbed=0;
            if(is_array($price) && array_key_exists('package_markup_childwbed',$price) && $price['package_markup_childwbed']!='')
            {
            $package_markup_childwbed=$price['package_markup_childwbed'];
            }
            $package_markup_infant=0;
            if(is_array($price) && array_key_exists('package_markup_infant',$price) && $price['package_markup_infant']!='')
            {
            $package_markup_infant=$price['package_markup_infant'];
            }
            $package_markup_single=0;
            if(is_array($price) && array_key_exists('package_markup_single',$price) && $price['package_markup_single']!='')
            {
            $package_markup_single=$price['package_markup_single'];
            }

            if(is_array($price) && array_key_exists('pricemarkup',$price) && $price['pricemarkup']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('pricemarkup',$price) && $price['pricemarkup']==2)
            {
            $percentage_markup=$price['markup_percentage'];
            $package_markup_adult=round($total_adult*$percentage_markup/100);
            $package_markup_exadult=round($total_exadult*$percentage_markup/100);
            $package_markup_childbed=round($total_childbed*$percentage_markup/100);
            $package_markup_childwbed=round($total_childwbed*$percentage_markup/100);
            $package_markup_infant=round($total_infant*$percentage_markup/100);
            $package_markup_single=round($total_single*$percentage_markup/100);
            }
            //
            $package_discount_adult=0;
            if(is_array($price) && array_key_exists('package_discount_adult',$price) && $price['package_discount_adult']!='')
            {
            $package_discount_adult=$price['package_discount_adult'];
            }
            $package_discount_exadult=0;
            if(is_array($price) && array_key_exists('package_discount_exadult',$price) && $price['package_discount_exadult']!='')
            {
            $package_discount_exadult=$price['package_discount_exadult'];
            }
            $package_discount_childbed=0;
            if(is_array($price) && array_key_exists('package_discount_childbed',$price) && $price['package_discount_childbed']!='')
            {
            $package_discount_childbed=$price['package_discount_childbed'];
            }
            $package_discount_childwbed=0;
            if(is_array($price) && array_key_exists('package_discount_childwbed',$price) && $price['package_discount_childwbed']!='')
            {
            $package_discount_childwbed=$price['package_discount_childwbed'];
            }
            $package_discount_infant=0;
            if(is_array($price) && array_key_exists('package_discount_infant',$price) && $price['package_discount_infant']!='')
            {
            $package_discount_infant=$price['package_discount_infant'];
            }
            $package_discount_single=0;
            if(is_array($price) && array_key_exists('package_discount_single',$price) && $price['package_discount_single']!='')
            {
            $package_discount_single=$price['package_discount_single'];
            }
            if(is_array($price) && array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==2)
            {
            $discountpositive_percentage=$price['discountpositive_percentage'];
            $package_discount_adult=round(($total_adult+$package_markup_adult)*$discountpositive_percentage/100);
            $package_discount_exadult=round(($total_exadult+$package_markup_exadult)*$discountpositive_percentage/100);
            $package_discount_childbed=round(($total_childbed+$package_markup_childbed)*$discountpositive_percentage/100);
            $package_discount_childwbed=round(($total_childwbed+$package_markup_childwbed)*$discountpositive_percentage/100);
            $package_discount_infant=round(($total_infant+$package_markup_infant)*$discountpositive_percentage/100);
            $package_discount_single=round(($total_single+$package_markup_single)*$discountpositive_percentage/100);
            }
            $package_total_adult=$total_adult;
            $package_total_exadult=$total_exadult;
            $package_total_childbed=$total_childbed;
            $package_total_childwbed=$total_childwbed;
            $package_total_infant=$total_infant;
            $package_total_single=$total_single;
            if(is_array($price) && array_key_exists('pricemarkup',$price) && $price['pricemarkup']==1)
            {
            $package_total_adult=round($package_total_adult+$package_markup_adult*$markupcurrency);
            $package_total_exadult=round($package_total_exadult+$package_markup_exadult*$markupcurrency);
            $package_total_childbed=round($package_total_childbed+$package_markup_childbed*$markupcurrency);
            $package_total_childwbed=round($package_total_childwbed+$package_markup_childwbed*$markupcurrency);
            $package_total_infant=round($package_total_infant+$package_markup_infant*$markupcurrency);
            $package_total_single=round($package_total_single+$package_markup_single*$markupcurrency);
            }
            else
            {
            $package_total_adult=round($package_total_adult+$package_markup_adult);
            $package_total_exadult=round($package_total_exadult+$package_markup_exadult);
            $package_total_childbed=round($package_total_childbed+$package_markup_childbed);
            $package_total_childwbed=round($package_total_childwbed+$package_markup_childwbed);
            $package_total_infant=round($package_total_infant+$package_markup_infant);
            $package_total_single=round($package_total_single+$package_markup_single);
            }
            if(is_array($price) && array_key_exists('pricediscountpositive',$price) && $price['pricediscountpositive']==1)
            {
            $package_total_adult=round($package_total_adult+$package_discount_adult*$discount_positive_currency);
            $package_total_exadult=round($package_total_exadult+$package_discount_exadult*$discount_positive_currency);
            $package_total_childbed=round($package_total_childbed+$package_discount_childbed*$discount_positive_currency);
            $package_total_childwbed=round($package_total_childwbed+$package_discount_childwbed*$discount_positive_currency);
            $package_total_infant=round($package_total_infant+$package_discount_infant*$discount_positive_currency);
            $package_total_single=round($package_total_single+$package_discount_single*$discount_positive_currency);
            }
            else
            {
            $package_total_adult=round($package_total_adult+$package_discount_adult);
            $package_total_exadult=round($package_total_exadult+$package_discount_exadult);
            $package_total_childbed=round($package_total_childbed+$package_discount_childbed);
            $package_total_childwbed=round($package_total_childwbed+$package_discount_childwbed);
            $package_total_infant=round($package_total_infant+$package_discount_infant);
            $package_total_single=round($package_total_single+$package_discount_single);
            }
            // $package_total_adult=round($total_adult+$package_markup_adult+$package_discount_adult);
            // $package_total_exadult=round($total_exadult+$package_markup_exadult+$package_discount_exadult);
            // $package_total_childbed=round($total_childbed+$package_markup_childbed+$package_discount_childbed);
            // $package_total_childwbed=round($total_childwbed+$package_markup_childwbed+$package_discount_childwbed);
            // $package_total_infant=round($total_infant+$package_markup_infant+$package_discount_infant);
            // $package_total_single=round($total_single+$package_markup_single+$package_discount_single);
            $package_total_group=($package_total_adult*$adult)+($package_total_exadult*$extra_adult)+($package_total_childbed*$child_with_bed)+($package_total_childwbed*$child_without_bed)+($package_total_infant*$infant)+($package_total_single*$solo_traveller);
            //
            $package_discount_minus_adult=0;
            if(is_array($price) && array_key_exists('package_discount_minus_adult',$price) && $price['package_discount_minus_adult']!='')
            {
            $package_discount_minus_adult=$price['package_discount_minus_adult'];
            }
            $package_discount_minus_exadult=0;
            if(is_array($price) && array_key_exists('package_discount_minus_exadult',$price) && $price['package_discount_minus_exadult']!='')
            {
            $package_discount_minus_exadult=$price['package_discount_minus_exadult'];
            }
            $package_discount_minus_childbed=0;
            if(is_array($price) && array_key_exists('package_discount_minus_childbed',$price) && $price['package_discount_minus_childbed']!='')
            {
            $package_discount_minus_childbed=$price['package_discount_minus_childbed'];
            }
            $package_discount_minus_childwbed=0;
            if(is_array($price) && array_key_exists('package_discount_minus_childwbed',$price) && $price['package_discount_minus_childwbed']!='')
            {
            $package_discount_minus_childwbed=$price['package_discount_minus_childwbed'];
            }
            $package_discount_minus_infant=0;
            if(is_array($price) && array_key_exists('package_discount_minus_infant',$price) && $price['package_discount_minus_infant']!='')
            {
            $package_discount_minus_infant=$price['package_discount_minus_infant'];
            }
            $package_discount_minus_single=0;
            if(is_array($price) && array_key_exists('package_discount_minus_single',$price) && $price['package_discount_minus_single']!='')
            {
            $package_discount_minus_single=$price['package_discount_minus_single'];
            }
            if(is_array($price) && array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==2)
            {
            $discountnegative_percentage=$price['discountnegative_percentage'];
            $divide_val=$discountnegative_percentage+100;
            $package_discount_minus_adult=round($package_total_adult*$discountnegative_percentage/$divide_val);
            $package_discount_minus_exadult=round($package_total_exadult*$discountnegative_percentage/$divide_val);
            $package_discount_minus_childbed=round($package_total_childbed*$discountnegative_percentage/$divide_val);
            $package_discount_minus_childwbed=round($package_total_childwbed*$discountnegative_percentage/$divide_val);
            $package_discount_minus_infant=round($package_total_infant*$discountnegative_percentage/$divide_val);
            $package_discount_minus_single=round($package_total_single*$discountnegative_percentage/$divide_val);
            }
            elseif(is_array($price) && array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==3)
            {

            $discountnegative_percentage=array_key_exists('discount_coupon',$price) ? $price['discount_coupon'] : 0;

            $divide_val=$discountnegative_percentage+100;
            $package_discount_minus_adult=round($package_total_adult*$discountnegative_percentage/$divide_val);
            $package_discount_minus_exadult=round($package_total_exadult*$discountnegative_percentage/$divide_val);
            $package_discount_minus_childbed=round($package_total_childbed*$discountnegative_percentage/$divide_val);
            $package_discount_minus_childwbed=round($package_total_childwbed*$discountnegative_percentage/$divide_val);
            $package_discount_minus_infant=round($package_total_infant*$discountnegative_percentage/$divide_val);
            $package_discount_minus_single=round($package_total_single*$discountnegative_percentage/$divide_val);
            }
            if(is_array($price) && array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==1)
            {
            $package_total_discount_group=($package_discount_minus_adult*$adult*$discount_negative_currency)+($package_discount_minus_exadult*$extra_adult*$discount_negative_currency)+($package_discount_minus_childbed*$child_with_bed*$discount_negative_currency)+($package_discount_minus_childwbed*$child_without_bed*$discount_negative_currency)+($package_discount_minus_infant*$infant*$discount_negative_currency)+($package_discount_minus_single*$solo_traveller*$discount_negative_currency);
            }
            else
            {
            $package_total_discount_group=($package_discount_minus_adult*$adult)+($package_discount_minus_exadult*$extra_adult)+($package_discount_minus_childbed*$child_with_bed)+($package_discount_minus_childwbed*$child_without_bed)+($package_discount_minus_infant*$infant)+($package_discount_minus_single*$solo_traveller);
            }
            //
            $package_gst_adult=0;
            if(is_array($price) && array_key_exists('package_gst_adult',$price) && $price['package_gst_adult']!='')
            {
            $package_gst_adult=$price['package_gst_adult'];
            }
            $package_gst_exadult=0;
            if(is_array($price) && array_key_exists('package_gst_exadult',$price) && $price['package_gst_exadult']!='')
            {
            $package_gst_exadult=$price['package_gst_exadult'];
            }
            $package_gst_childbed=0;
            if(is_array($price) && array_key_exists('package_gst_childbed',$price) && $price['package_gst_childbed']!='')
            {
            $package_gst_childbed=$price['package_gst_childbed'];
            }
            $package_gst_childwbed=0;
            if(is_array($price) && array_key_exists('package_gst_childwbed',$price) && $price['package_gst_childwbed']!='')
            {
            $package_gst_childwbed=$price['package_gst_childwbed'];
            }
            $package_gst_infant=0;
            if(is_array($price) && array_key_exists('package_gst_infant',$price) && $price['package_gst_infant']!='')
            {
            $package_gst_infant=$price['package_gst_infant'];
            }
            $package_gst_single=0;
            if(is_array($price) && array_key_exists('package_gst_single',$price) && $price['package_gst_single']!='')
            {
            $package_gst_single=$price['package_gst_single'];
            }
            if(is_array($price) && array_key_exists('package_gst_curr',$price) && $price['package_gst_curr']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('package_gst_curr',$price) && $price['package_gst_curr']==2)
            {
            $gst_percentage=$price['gst_percentage'];

            $package_gst_adult=round(($package_total_adult-$package_discount_minus_adult)*$gst_percentage/100);
            $package_gst_exadult=round(($package_total_exadult-$package_discount_minus_exadult)*$gst_percentage/100);
            $package_gst_childbed=round(($package_total_childbed-$package_discount_minus_childbed)*$gst_percentage/100);
            $package_gst_childwbed=round(($package_total_childwbed-$package_discount_minus_childwbed)*$gst_percentage/100);
            $package_gst_infant=round(($package_total_infant-$package_discount_minus_infant)*$gst_percentage/100);
            $package_gst_single=round(($package_total_single-$package_discount_minus_single)*$gst_percentage/100);

            }
            if(is_array($price) && array_key_exists('package_gst_curr',$price) && $price['package_gst_curr']==1)
            {

            $package_total_gst_group=($package_gst_adult*$adult*$gst_currency)+($package_gst_exadult*$extra_adult*$gst_currency)+($package_gst_childbed*$child_with_bed*$gst_currency)+($package_gst_childwbed*$child_without_bed*$gst_currency)+($package_gst_infant*$infant*$gst_currency)+($package_gst_single*$solo_traveller*$gst_currency);
            $package_gst_adult_cal=$package_gst_adult*$gst_currency;
            $package_gst_exadult_cal=$package_gst_exadult*$gst_currency;
            $package_gst_childbed_cal=$package_gst_childbed*$gst_currency;
            $package_gst_childwbed_cal=$package_gst_childwbed*$gst_currency;
            $package_gst_infant_cal=$package_gst_infant*$gst_currency;
            $package_gst_single_cal=$package_gst_single*$gst_currency;
            }
            else
            {
            $package_gst_adult_cal=$package_gst_adult;
            $package_gst_exadult_cal=$package_gst_exadult;
            $package_gst_childbed_cal=$package_gst_childbed;
            $package_gst_childwbed_cal=$package_gst_childwbed;
            $package_gst_infant_cal=$package_gst_infant;
            $package_gst_single_cal=$package_gst_single;
            $package_total_gst_group=($package_gst_adult*$adult)+($package_gst_exadult*$extra_adult)+($package_gst_childbed*$child_with_bed)+($package_gst_childwbed*$child_without_bed)+($package_gst_infant*$infant)+($package_gst_single*$solo_traveller);
            }

            if(is_array($price) && array_key_exists('pricediscountnegative',$price) && $price['pricediscountnegative']==1)
            {

            $package_gsttotal_adult=round($package_total_adult-$package_discount_minus_adult*$discount_negative_currency+$package_gst_adult_cal);
            $package_gsttotal_exadult=round($package_total_exadult-$package_discount_minus_exadult*$discount_negative_currency+$package_gst_exadult_cal);
            $package_gsttotal_childbed=round($package_total_childbed-$package_discount_minus_childbed*$discount_negative_currency+$package_gst_childbed_cal);
            $package_gsttotal_childwbed=round($package_total_childwbed-$package_discount_minus_childwbed*$discount_negative_currency+$package_gst_childwbed_cal);
            $package_gsttotal_infant=round($package_total_infant*$discount_negative_currency-$package_discount_minus_infant+$package_gst_infant_cal);
            $package_gsttotal_single=round($package_total_single*$discount_negative_currency-$package_discount_minus_single+$package_gst_single_cal);
            }
            else
            {
            $package_gsttotal_adult=round($package_total_adult-$package_discount_minus_adult+$package_gst_adult_cal);
            $package_gsttotal_exadult=round($package_total_exadult-$package_discount_minus_exadult+$package_gst_exadult_cal);
            $package_gsttotal_childbed=round($package_total_childbed-$package_discount_minus_childbed+$package_gst_childbed_cal);
            $package_gsttotal_childwbed=round($package_total_childwbed-$package_discount_minus_childwbed+$package_gst_childwbed_cal);
            $package_gsttotal_infant=round($package_total_infant-$package_discount_minus_infant+$package_gst_infant_cal);
            $package_gsttotal_single=round($package_total_single-$package_discount_minus_single+$package_gst_single_cal);
            }
            //TCS CALCULATION
            $package_tcs_adult=0;
            if(is_array($price) && array_key_exists('package_tcs_adult',$price) && $price['package_tcs_adult']!='')
            {
            $package_tcs_adult=$price['package_tcs_adult'];
            }
            $package_tcs_exadult=0;
            if(is_array($price) && array_key_exists('package_tcs_exadult',$price) && $price['package_tcs_exadult']!='')
            {
            $package_tcs_exadult=$price['package_tcs_exadult'];
            }
            $package_tcs_childbed=0;
            if(is_array($price) && array_key_exists('package_tcs_childbed',$price) && $price['package_tcs_childbed']!='')
            {
            $package_tcs_childbed=$price['package_tcs_childbed'];
            }
            $package_tcs_childwbed=0;
            if(is_array($price) && array_key_exists('package_tcs_childwbed',$price) && $price['package_tcs_childwbed']!='')
            {
            $package_tcs_childwbed=$price['package_tcs_childwbed'];
            }
            $package_tcs_infant=0;
            if(is_array($price) && array_key_exists('package_tcs_infant',$price) && $price['package_tcs_infant']!='')
            {
            $package_tcs_infant=$price['package_tcs_infant'];
            }
            $package_tcs_single=0;
            if(is_array($price) && array_key_exists('package_tcs_single',$price) && $price['package_tcs_single']!='')
            {
            $package_tcs_single=$price['package_tcs_single'];
            }
            if(is_array($price) && array_key_exists('package_tcs_curr',$price) && $price['package_tcs_curr']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('package_tcs_curr',$price) && $price['package_tcs_curr']==2)
            {
            $tcs_percentage=$price['tcs_percentage'];
            $package_tcs_adult=round($package_gsttotal_adult*$tcs_percentage/100);
            $package_tcs_exadult=round($package_gsttotal_exadult*$tcs_percentage/100);
            $package_tcs_childbed=round($package_gsttotal_childbed*$tcs_percentage/100);
            $package_tcs_childwbed=round($package_gsttotal_childwbed*$tcs_percentage/100);
            $package_tcs_infant=round($package_gsttotal_infant*$tcs_percentage/100);
            $package_tcs_single=round($package_gsttotal_single*$tcs_percentage/100);
            }
            if(is_array($price) && array_key_exists('package_tcs_curr',$price) && $price['package_tcs_curr']==1)
            {

            $package_total_tcs_group=($package_tcs_adult*$adult*$tcs_currency)+($package_tcs_exadult*$extra_adult*$tcs_currency)+($package_tcs_childbed*$child_with_bed*$tcs_currency)+($package_tcs_childwbed*$child_without_bed*$tcs_currency)+($package_tcs_infant*$infant*$tcs_currency)+($package_tcs_single*$solo_traveller*$tcs_currency);
            $package_tcstotal_adult=round($package_gsttotal_adult+$package_tcs_adult*$tcs_currency);
            $package_tcstotal_exadult=round($package_gsttotal_exadult+$package_tcs_exadult*$tcs_currency);
            $package_tcstotal_childbed=round($package_gsttotal_childbed+$package_tcs_childbed*$tcs_currency);
            $package_tcstotal_childwbed=round($package_gsttotal_childwbed+$package_tcs_childwbed*$tcs_currency);
            $package_tcstotal_infant=round($package_gsttotal_infant+$package_tcs_infant*$tcs_currency);
            $package_tcstotal_single=round($package_gsttotal_single+$package_tcs_single*$tcs_currency);
            }
            else
            {
            $package_total_tcs_group=($package_tcs_adult*$adult)+($package_tcs_exadult*$extra_adult)+($package_tcs_childbed*$child_with_bed)+($package_tcs_childwbed*$child_without_bed)+($package_tcs_infant*$infant)+($package_tcs_single*$solo_traveller);
            $package_tcstotal_adult=round($package_gsttotal_adult+$package_tcs_adult);
            $package_tcstotal_exadult=round($package_gsttotal_exadult+$package_tcs_exadult);
            $package_tcstotal_childbed=round($package_gsttotal_childbed+$package_tcs_childbed);
            $package_tcstotal_childwbed=round($package_gsttotal_childwbed+$package_tcs_childwbed);
            $package_tcstotal_infant=round($package_gsttotal_infant+$package_tcs_infant);
            $package_tcstotal_single=round($package_gsttotal_single+$package_tcs_single);
            }

            //Pg Charges
            $package_pgcharges_adult=0;
            if(is_array($price) && array_key_exists('package_pgcharges_adult',$price) && $price['package_pgcharges_adult']!='')
            {
            $package_pgcharges_adult=$price['package_pgcharges_adult'];
            }
            $package_pgcharges_exadult=0;
            if(is_array($price) && array_key_exists('package_pgcharges_exadult',$price) && $price['package_pgcharges_exadult']!='')
            {
            $package_pgcharges_exadult=$price['package_pgcharges_exadult'];
            }
            $package_pgcharges_childbed=0;
            if(is_array($price) && array_key_exists('package_pgcharges_childbed',$price) && $price['package_pgcharges_childbed']!='')
            {
            $package_pgcharges_childbed=$price['package_pgcharges_childbed'];
            }
            $package_pgcharges_childwbed=0;
            if(is_array($price) && array_key_exists('package_pgcharges_childwbed',$price) && $price['package_pgcharges_childwbed']!='')
            {
            $package_pgcharges_childwbed=$price['package_pgcharges_childwbed'];
            }
            $package_pgcharges_infant=0;
            if(is_array($price) && array_key_exists('package_pgcharges_infant',$price) && $price['package_pgcharges_infant']!='')
            {
            $package_pgcharges_infant=$price['package_pgcharges_infant'];
            }
            $package_pgcharges_single=0;
            if(is_array($price) && array_key_exists('package_pgcharges_single',$price) && $price['package_pgcharges_single']!='')
            {
            $package_pgcharges_single=$price['package_pgcharges_single'];
            }
            if(is_array($price) && array_key_exists('pg_charges',$price) && $price['pg_charges']==1)
            {

            }
            elseif(is_array($price) && array_key_exists('pg_charges',$price) && $price['pg_charges']==2)
            {
            $pgcharges_percentage=1;
            $package_pgcharges_adult=round($package_tcstotal_adult*$pgcharges_percentage/100);
            $package_pgcharges_exadult=round($package_tcstotal_exadult*$pgcharges_percentage/100);
            $package_pgcharges_childbed=round($package_tcstotal_childbed*$pgcharges_percentage/100);
            $package_pgcharges_childwbed=round($package_tcstotal_childwbed*$pgcharges_percentage/100);
            $package_pgcharges_infant=round($package_tcstotal_infant*$pgcharges_percentage/100);
            $package_pgcharges_single=round($package_tcstotal_single*$pgcharges_percentage/100);
            }
            if(is_array($price) && array_key_exists('pg_charges',$price) && $price['pg_charges']==1)
            {
            $package_total_pg_group=($package_pgcharges_adult*$adult*$pgcharges_currency)+($package_pgcharges_exadult*$extra_adult*$pgcharges_currency)+($package_pgcharges_childbed*$child_with_bed*$pgcharges_currency)+($package_pgcharges_childwbed*$child_without_bed*$pgcharges_currency)+($package_pgcharges_infant*$infant*$pgcharges_currency)+($package_pgcharges_single*$solo_traveller*$pgcharges_currency);
            $package_grand_adult=round($package_tcstotal_adult+$package_pgcharges_adult*$pgcharges_currency);
            $package_grand_exadult=round($package_tcstotal_exadult+$package_pgcharges_exadult*$pgcharges_currency);
            $package_grand_childbed=round($package_tcstotal_childbed+$package_pgcharges_childbed*$pgcharges_currency);
            $package_grand_childwbed=round($package_tcstotal_childwbed+$package_pgcharges_childwbed*$pgcharges_currency);
            $package_grand_infant=round($package_tcstotal_infant+$package_pgcharges_infant*$pgcharges_currency);
            $package_grand_single=round($package_tcstotal_single+$package_pgcharges_single*$pgcharges_currency);
            }
            else
            {
            $package_total_pg_group=($package_pgcharges_adult*$adult)+($package_pgcharges_exadult*$extra_adult)+($package_pgcharges_childbed*$child_with_bed)+($package_pgcharges_childwbed*$child_without_bed)+($package_pgcharges_infant*$infant)+($package_pgcharges_single*$solo_traveller);
            $package_grand_adult=round($package_tcstotal_adult+$package_pgcharges_adult);
            $package_grand_exadult=round($package_tcstotal_exadult+$package_pgcharges_exadult);
            $package_grand_childbed=round($package_tcstotal_childbed+$package_pgcharges_childbed);
            $package_grand_childwbed=round($package_tcstotal_childwbed+$package_pgcharges_childwbed);
            $package_grand_infant=round($package_tcstotal_infant+$package_pgcharges_infant);
            $package_grand_single=round($package_tcstotal_single+$package_pgcharges_single);
            }

            $package_paytotal_adult=round($package_grand_adult*$adult);
            $package_paytotal_exadult=round($package_grand_exadult*$extra_adult);
            $package_paytotal_childbed=round($package_grand_childbed*$child_with_bed);
            $package_paytotal_childwbed=round($package_grand_childwbed*$child_without_bed);
            $package_paytotal_infant=round($package_grand_infant*$infant);
            $package_paytotal_single=round($package_grand_single*$solo_traveller);
            $package_pricetopay_adult=$package_paytotal_adult+$package_paytotal_exadult+$package_paytotal_childbed+$package_paytotal_childwbed+$package_paytotal_infant+$package_paytotal_single;

            $data2=["package_tourtotal_adult" => $total_adult,
            "package_tourtotal_exadult" =>$total_exadult,
            "package_tourtotal_childbed" => $total_childbed,
            "package_tourtotal_childwbed" =>$total_childwbed,
            "package_tourtotal_infant" => $total_infant,
            "package_tourtotal_single" =>  $total_single,
            "pricemarkup" =>is_array($price) ? array_key_exists('pricemarkup',$price) ? $price['pricemarkup'] : 0 : 0,
            "markup_percentage" =>is_array($price) ? array_key_exists('markup_percentage',$price) ? $price['markup_percentage'] : 0 : 0,
            "package_markup_adult" =>$package_markup_adult,
            "package_markup_exadult" => $package_markup_exadult,
            "package_markup_childbed" => $package_markup_childbed,
            "package_markup_childwbed" =>$package_markup_childwbed,
            "package_markup_infant" => $package_markup_infant,
            "package_markup_single" =>$package_markup_single,
            "pricediscountpositive" =>is_array($price) ? array_key_exists('pricediscountpositive',$price) ? $price['pricediscountpositive'] : 0 : 0,
            "discountpositive_percentage" =>is_array($price) ? array_key_exists('discountpositive_percentage',$price) ? $price['discountpositive_percentage'] : 0 : 0,
            "package_discount_adult" => $package_discount_adult,
            "package_discount_exadult" =>$package_discount_exadult,
            "package_discount_childbed" => $package_discount_childbed,
            "package_discount_childwbed" => $package_discount_childwbed,
            "package_discount_infant" => $package_discount_infant,
            "package_discount_single" => $package_discount_single,
            "package_total_adult" => $package_total_adult,
            "package_total_exadult" => $package_total_exadult,
            "package_total_childbed" => $package_total_childbed,
            "package_total_childwbed" => $package_total_childwbed,
            "package_total_infant" => $package_total_infant,
            "package_total_single" => $package_total_single,
            "package_total_group" => $package_total_group,
            "pricediscountnegative" =>is_array($price) ? array_key_exists('pricediscountnegative',$price) ? $price['pricediscountnegative'] : 0 : 0,
            "discountnegative_percentage" =>is_array($price) ? array_key_exists('discountnegative_percentage',$price) ? $price['discountnegative_percentage'] : 0: 0 ,
            "discount_coupon" =>is_array($price) ? array_key_exists('discount_coupon',$price) ? $price['discount_coupon'] : 0 : 0,
            "coupon_id" =>is_array($price) ? array_key_exists('coupon_id',$price) ? $price['coupon_id'] : 0 : 0,
            "package_discount_minus_adult" => $package_discount_minus_adult,
            "package_discount_minus_exadult" => $package_discount_minus_exadult,
            "package_discount_minus_childbed" =>$package_discount_minus_childbed,
            "package_discount_minus_childwbed" => $package_discount_minus_childwbed,
            "package_discount_minus_infant" => $package_discount_minus_infant,
            "package_discount_minus_single" => $package_discount_minus_single,
            "package_total_discount_group" => $package_total_discount_group,
            "package_gst_curr" =>is_array($price) ? array_key_exists('package_gst_curr',$price) ? $price['package_gst_curr'] : 0 : 0,
            "gst_percentage" =>is_array($price) ? array_key_exists('gst_percentage',$price) ? $price['gst_percentage'] : 0 : 0,
            "package_gst_adult" => $package_gst_adult,
            "package_gst_exadult" => $package_gst_exadult,
            "package_gst_childbed" => $package_gst_childbed,
            "package_gst_childwbed" => $package_gst_childwbed,
            "package_gst_infant" => $package_gst_infant,
            "package_gst_single" => $package_gst_single,
            "package_total_gst_group" => $package_total_gst_group,
            "package_gsttotal_adult" => $package_gsttotal_adult,
            "package_gsttotal_exadult" =>$package_gsttotal_exadult,
            "package_gsttotal_childbed" => $package_gsttotal_childbed,
            "package_gsttotal_childwbed" => $package_gsttotal_childwbed,
            "package_gsttotal_infant" => $package_gsttotal_infant,
            "package_gsttotal_single" => $package_gsttotal_single,
            "package_tcs_curr" =>is_array($price) ? array_key_exists('package_tcs_curr',$price) ? $price['package_tcs_curr'] : 0 : 0,
            "tcs_percentage" =>is_array($price) ? array_key_exists('tcs_percentage',$price) ? $price['tcs_percentage'] : 0 : 0,
            "package_tcs_adult" => $package_tcs_adult,
            "package_tcs_exadult" =>  $package_tcs_exadult,
            "package_tcs_childbed" =>  $package_tcs_childbed,
            "package_tcs_childwbed" => $package_tcs_childwbed,
            "package_tcs_infant" =>  $package_tcs_infant,
            "package_tcs_single" =>  $package_tcs_single,
            "package_total_tcs_group" => $package_total_tcs_group,
            "package_tcstotal_adult" => $package_tcstotal_adult,
            "package_tcstotal_exadult" =>$package_tcstotal_exadult,
            "package_tcstotal_childbed" => $package_tcstotal_childbed,
            "package_tcstotal_childwbed" => $package_tcstotal_childwbed,
            "package_tcstotal_infant" => $package_tcstotal_infant,
            "package_tcstotal_single" => $package_tcstotal_single,
            "pg_charges" =>is_array($price) ? array_key_exists('pg_charges',$price) ? $price['pg_charges'] : 0 : 0,
            "pgcharges_percentage" => is_array($price) ? array_key_exists('pgcharges_percentage',$price) ? $price['pgcharges_percentage'] : 0 : 0,
            "package_pgcharges_adult" =>$package_pgcharges_adult,
            "package_pgcharges_exadult" => $package_pgcharges_exadult,
            "package_pgcharges_childbed" => $package_pgcharges_childbed,
            "package_pgcharges_childwbed" => $package_pgcharges_childwbed,
            "package_pgcharges_infant" => $package_pgcharges_infant,
            "package_pgcharges_single" => $package_pgcharges_single,
            "package_total_pg_group" => $package_total_pg_group,
            "package_grand_adult" =>  $package_grand_adult,
            "package_grand_exadult" =>  $package_grand_exadult,
            "package_grand_childbed" =>  $package_grand_childbed,
            "package_grand_childwbed" =>  $package_grand_childwbed,
            "package_grand_infant" =>  $package_grand_infant,
            "package_grand_single" => $package_grand_single,
            "package_paytotal_adult" => $package_paytotal_adult,
            "package_paytotal_exadult" =>$package_paytotal_exadult,
            "package_paytotal_childbed" => $package_paytotal_childbed,
            "package_paytotal_childwbed" => $package_paytotal_childwbed,
            "package_paytotal_infant" =>$package_paytotal_infant,
            "package_paytotal_single" => $package_paytotal_single,
            "package_pricetopay_adult" => $package_pricetopay_adult,
            ];
            $data=array_merge($data1,$data2);
        
            return $data;
    }
}