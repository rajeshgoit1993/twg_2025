<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Sentinel;
use Session;
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
use App\airlineList;
use App\iataList;
use App\ActivateService;
use App\Supplier;
use App\QuoteCharges;
use App\PkgInclusions;
use App\PkgExclusions;
use App\Coupon;
use App\RaiseConcern;
use App\EnquiryLeadFollowup;
use App\LeadDynamicField;
use App\EnquiryTracker;
use App\Payment;
use App\PaymentFollowup;
use App\UserDetails;
use App\RefundPayments;
use App\SupplierEmail;
use App\SupplierEmailNonLead;
use App\EnqueryOTPSetting;
use App\RefundCreate;
use URL;

class NotificationController extends Controller
{
    /*public function get_notification()
    {
       
        $queries = Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',1]])
        ->where(function ($queries) {
           $queries->whereIn('status', ['interested'])
           ->orWhereNull('status');
        })
        ->orderBy('created_at', 'desc')
        ->get();
        $notification_link='';
        $notification_count=0;
        if(count($queries)>0) {
            $link=URL::to('/web-leads');
            $notification_link.='<li><a href="'.$link.'"><i class="fa fa-users text-aqua">'.count($queries) .'  New Enquiry</i></a></li>';
            $notification_count=$notification_count+(int)count($queries);
        }

        //Raise open
        $employee_id=Sentinel::getUser()->id;

        if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
            $open_raise=DB::table('quote_raise_concern')
        ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
        ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
        ->whereIn('quote_raise_concern.status', [0])
        ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
        ->get();
        else:
            $open_raise=DB::table('quote_raise_concern')
            ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
            ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
            ->whereIn('quote_raise_concern.status', [0])
            ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
            ->get();
        endif;

        if(count($open_raise)>0) {
            $link=URL::to('/myRequests');
            $notification_link.='<li><a href="'.$link.'"><i class="fa fa-users text-aqua">'.count($open_raise) .'  New Raise Concern </i></a></li>';
            $notification_count=$notification_count+(int)count($open_raise);
        }

        //Raise Pending
        $employee_id=Sentinel::getUser()->id;
        if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
            $pending_raise=DB::table('quote_raise_concern')
            ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
            ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
            ->whereIn('quote_raise_concern.status', [1])
            ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
            ->get();
        else:
            $pending_raise=DB::table('quote_raise_concern')
            ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
            ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
            ->whereIn('quote_raise_concern.status', [1])
            ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
            ->get();
        endif;
        if(count($pending_raise)>0) {
            $link=URL::to('/myRequests');
            $notification_link.='<li><a href="'.$link.'"><i class="fa fa-users text-aqua">'.count($pending_raise) .'  Pending Raise Concern </i></a></li>';
            $notification_count=$notification_count+(int)count($pending_raise);
        }

        //
        $output=['notification_link'=>$notification_link,'notification_count'=>$notification_count];
        return $output;
    }*/

    public function get_notification()
    {
        $employee_id = Sentinel::getUser()->id;
        $user_role = Sentinel::getUser()->roles()->first()->slug;
        
        $queries = Query::where([["webnotation", "=", env("WEBSITENAME")], ['delete_status', '=', 1]])
            ->where(function ($query) {
                $query->whereIn('status', ['interested'])
                    ->orWhereNull('status');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $notification_link = '';
        $notification_count = $queries->count();

        if ($queries->isNotEmpty()) {
            // $notification_link .= '<li><a href="' . URL::to('/web-leads') . '"><i class="fa fa-users text-aqua">' . $notification_count . ' New Enquiry</i></a></li>';
            $notification_link = '
            <li class="notification-item">
                <a href="' . URL::to('/web-leads') . '">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="content-item">
                        <span class="message">' . $notification_count . ' New Enquiry</span>
                        <span class="timestamp">Just now</span>
                    </div>
                </a>
            </li>';
        }

        // Function to fetch raise concerns based on status
        $getRaiseConcerns = function ($status) use ($employee_id, $user_role) {
            $query = DB::table('quote_raise_concern')
                ->join('option1_quotation', 'option1_quotation.query_reference', '=', 'quote_raise_concern.query_reference')
                ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                ->where([["option1_quotation.webnotation", "=", env("WEBSITENAME")], ['option1_quotation.del_status', '=', 1], ['option1_quotation.send_option', '=', 1]])
                ->whereIn('quote_raise_concern.status', [$status])
                ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed');

            if ($user_role === 'employee') {
                $query->where('option1_quotation.assign_id', $employee_id);
            }

            return $query->get();
        };

        // Handle Open Raise Concerns
        $open_raise = $getRaiseConcerns(0);
        if ($open_raise->isNotEmpty()) {
            // $notification_link .= '<li><a href="' . URL::to('/myRequests') . '"><i class="fa fa-users text-aqua">' . $open_raise->count() . ' New Raise Concern</i></a></li>';
            $notification_link .= '
            <li class="notification-item">
                <a href="' . URL::to('/myRequests') . '">
                    <div class="icon"><i class="fa fa-exclamation-circle"></i></div>
                    <div class="content-item">
                        <p class="message">' . $open_raise->count() . ' New Requests</p>
                        <span class="timestamp">2 min ago</span>
                    </div>
                </a>
            </li>';

            $notification_count += $open_raise->count();
        }

        // Handle Pending Raise Concerns
        $pending_raise = $getRaiseConcerns(1);
        if ($pending_raise->isNotEmpty()) {
            // $notification_link .= '<li><a href="' . URL::to('/myRequests') . '"><i class="fa fa-users text-aqua">' . $pending_raise->count() . ' Pending Raise Concern</i></a></li>';
            $notification_link .= '
            <li class="notification-item">
                <a href="' . URL::to('/myRequests') . '">
                    <div class="icon"><i class="fa fa-hourglass-half"></i></div>
                    <div class="content">
                        <p class="message">' . $pending_raise->count() . ' Pending Requests</p>
                        <span class="timestamp">5 min ago</span>
                    </div>
                </a>
            </li>';

            $notification_count += $pending_raise->count();
        }

        return ['notification_link' => $notification_link, 'notification_count' => $notification_count];
    }
}