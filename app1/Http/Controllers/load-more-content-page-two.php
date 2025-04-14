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

class FrontController extends Controller 
{
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

        //
        if($event_type=="0"):
            $packages=DB::table('rt_packages')->where([['continent', 'like', '%' . $destination . '%'],['status', '=', '1'],])->orWhere([['country', 'like', '%' . $destination . '%'],['status', '=', '1'],])->orWhere([['city', 'like', '%' . $destination . '%'],['status', '=', '1'],])->orWhere([['state', 'like', '%' . $destination . '%'],['status', '=', '1'],])
            ->get();
        elseif($event_type=="1"):
            $packages=DB::table('rt_packages')
            ->where(function ($query) use ($destination){
            $query->where([['continent', 'like', '%' . $destination . '%'],['status', '=', '1'],])
            ->orWhere([['country', 'like', '%' . $destination . '%'],['status', '=', '1'],])
            ->orWhere([['city', 'like', '%' . $destination . '%'],['status', '=', '1'],])
            ->orWhere([['state', 'like', '%' . $destination . '%'],['status', '=', '1'],]);
            })
            ->whereNotIn('id', $packages_id)
            ->get();
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
            $prices[]=['id'=>$to["id"],'price'=>$to["price"],'duration'=>$to["duration"]];
            endforeach;
            endforeach;
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
            //print_r($prices);
    }
}