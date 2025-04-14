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

class NotificationHelpers {

  /*public static function get_leads_notification($notification_type) {
    // Initialize the data array
    $data = [];

    // Check the type of notification requested
    if ($notification_type == 'web_leads') {

        // Query to fetch web leads with a status of 'interested' or null status
        $data = Query::where([
                ["webnotation", "=", env("WEBSITENAME")],
                ['delete_status', '=', 1]
            ])
            ->where(function ($queries) {
                $queries->whereIn('status', ['interested'])
                        ->orWhereNull('status');
            })
            ->orderBy('created_at', 'desc')
            ->get();

    } elseif ($notification_type == 'verification_pending_add_lead_follow_up') {

        // Check if the leads service is activated
        $check_data = ActivateService::where('services', '=', 'leads')->first();

        // Proceed only if the check_data is not null and the service is activated
        if ($check_data && $check_data->activation == 1) {

            // Query to fetch leads with 'add_lead_follow_up' or 'lead_verify_pending' status
            $data = Query::where([
                    ["webnotation", "=", env("WEBSITENAME")],
                    ['delete_status', '=', 1]
                ])
                ->whereIn('status', ['add_lead_follow_up', 'lead_verify_pending'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

    } elseif ($notification_type == 'search_leads') {

        // Check if the lead manager service is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Proceed only if the check_data_lm is not null and the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {

            // Get the current user's employee ID
            $employee_id = Sentinel::getUser()->id;

            // Check if the user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                // Query to fetch search leads for non-employees
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', [
                        'quote_sent', 'lead_follow_up', 'follow_up_pending',
                        'process_booking', 'payment_follow_up', 'under_cancellation',
                        'issue_voucher'
                    ])
                    ->select(
                        'option1_quotation.*',
                        'rt_package_query.destinations',
                        'rt_package_query.booking_label',
                        'rt_package_query.span_value_child_without_bed'
                    )
                    ->orderBy('created_at', 'desc')
                    ->get();

            } else {

                // Query to fetch search leads for employees
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', [
                        'quote_sent', 'lead_follow_up', 'follow_up_pending',
                        'process_booking', 'payment_follow_up', 'under_cancellation',
                        'issue_voucher'
                    ])
                    ->select(
                        'option1_quotation.*',
                        'rt_package_query.destinations',
                        'rt_package_query.booking_label',
                        'rt_package_query.span_value_child_without_bed'
                    )
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

    } elseif ($notification_type == 'raise_data') {

        // Check if the leads service is activated
        $check_data = ActivateService::where('services', '=', 'leads')->first();

        // Proceed only if the check_data is not null and the service is activated
        if ($check_data && $check_data->activation == 1) {

            // Get the current user's employee ID
            $employee_id = Sentinel::getUser()->id;

            // Check if the user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                // Query to fetch raise data for non-employees
                $data = DB::table('quote_raise_concern')
                    ->join('option1_quotation', 'option1_quotation.query_reference', '=', 'quote_raise_concern.query_reference')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('quote_raise_concern.status', [0, 1])
                    ->select(
                        'option1_quotation.*',
                        'rt_package_query.destinations',
                        'rt_package_query.booking_label',
                        'rt_package_query.span_value_child_without_bed'
                    )
                    ->get();

            } else {

                // Query to fetch raise data for employees
                $data = DB::table('quote_raise_concern')
                    ->join('option1_quotation', 'option1_quotation.query_reference', '=', 'quote_raise_concern.query_reference')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('quote_raise_concern.status', [0, 1])
                    ->select(
                        'option1_quotation.*',
                        'rt_package_query.destinations',
                        'rt_package_query.booking_label',
                        'rt_package_query.span_value_child_without_bed'
                    )
                    ->get();
            }
        }

    } elseif ($notification_type == 'query') {

        // Check if the lead manager service is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Proceed only if the check_data_lm is not null and the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {

            // Get the current user's employee ID
            $employee_id = Sentinel::getUser()->id;

            // Check if the user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                // Query to fetch query data for non-employees
                $data = Query::where([
                        ['lead_verified', '=', '1'],
                        ['quo_send', '=', '0'],
                        ["webnotation", "=", env("WEBSITENAME")],
                        ['delete_status', '=', 1]
                    ])
                    ->where(function ($queries) {
                        $queries->whereIn('status', ['pending_quote'])
                                ->orWhereNull('status');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

            } else {

                // Query to fetch query data for employees
                $data = Query::where([
                        ['lead_verified', '=', '1'],
                        ['quo_send', '=', '0'],
                        ['assign_id', '=', $employee_id],
                        ["webnotation", "=", env("WEBSITENAME")],
                        ['delete_status', '=', 1]
                    ])
                    ->where(function ($queries) {
                        $queries->whereIn('status', ['pending_quote'])
                                ->orWhereNull('status');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
    } elseif ($notification_type == 'saved_quote') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = Option1Quotation::where([
                    ["webnotation", "=", env("WEBSITENAME")],
                    ['del_status', '=', 1],
                    ['send_option', '=', 0]
                ])
                ->orderBy('created_at', 'desc')
                ->get();
            } else {
                $data = Option1Quotation::where([
                    ["webnotation", "=", env("WEBSITENAME")],
                    ['assign_id', '=', $employee_id],
                    ['del_status', '=', 1],
                    ['send_option', '=', 0]
                ])
                ->orderBy('created_at', 'desc')
                ->get();
            }
        }
    } elseif ($notification_type == 'quotation') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['quote_sent'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['quote_sent'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
    } elseif ($notification_type == 'leads_follow_up') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'booking_hold') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_booking'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_booking'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'payment') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['payment_follow_up'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['payment_follow_up'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'under_cancellation') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['under_cancellation'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['under_cancellation'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'confirmation') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['issue_voucher'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['issue_voucher'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'tour_cancelled') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['tour_cancelled'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['tour_cancelled'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'refund_issued') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'vouchers') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['voucher_issued'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            } else {
                $data = DB::table('option1_quotation')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                    ->where([
                        ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['option1_quotation.del_status', '=', 1],
                        ['option1_quotation.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['voucher_issued'])
                    ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                    ->get();
            }
        }
    } elseif ($notification_type == 'cancelled_leads') {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $data = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['assign_id', '=', $employee_id],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
    }
    return count($data);

    // Return the data retrieved based on the notification type
    return $data;
  }*/

  public static function get_leads_notification($notification_type)
  {
      // Initialize the data array
      $data = [];

      // Check the type of notification requested
      if ($notification_type == 'web_leads') {

          // Query to fetch web leads with a status of 'interested' or null status
          $data = Query::where([
                  ["webnotation", "=", env("WEBSITENAME")],
                  ['delete_status', '=', 1]
              ])
              ->where(function ($queries) {
                  $queries->whereIn('status', ['interested'])
                          ->orWhereNull('status');
              })
              ->orderBy('created_at', 'desc')
              ->get();

      } elseif ($notification_type == 'search_lead') {

          // Check if the lead manager service is activated
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

          // Proceed only if the check_data_lm is not null and the service is activated
          if ($check_data_lm && $check_data_lm->activation == 1) {

              // Get the current user's employee ID
              $employee_id = Sentinel::getUser()->id;

              // Check if the user is not an employee
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                  // Query to fetch search leads for non-employees
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', [
                          'quote_sent', 'lead_follow_up', 'follow_up_pending',
                          'process_booking', 'payment_follow_up', 'under_cancellation',
                          'issue_voucher'
                      ])
                      ->select(
                          'option1_quotation.*',
                          'rt_package_query.destinations',
                          'rt_package_query.booking_label',
                          'rt_package_query.span_value_child_without_bed'
                      )
                      ->orderBy('created_at', 'desc')
                      ->get();

              } else {

                  // Query to fetch search leads for employees
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', [
                          'quote_sent', 'lead_follow_up', 'follow_up_pending',
                          'process_booking', 'payment_follow_up', 'under_cancellation',
                          'issue_voucher'
                      ])
                      ->select(
                          'option1_quotation.*',
                          'rt_package_query.destinations',
                          'rt_package_query.booking_label',
                          'rt_package_query.span_value_child_without_bed'
                      )
                      ->orderBy('created_at', 'desc')
                      ->get();
              }
          }

      } elseif ($notification_type == 'my_requests') {

          // Check if the leads service is activated
          $check_data = ActivateService::where('services', '=', 'leads')->first();

          // Proceed only if the check_data is not null and the service is activated
          if ($check_data && $check_data->activation == 1) {

              // Get the current user's employee ID
              $employee_id = Sentinel::getUser()->id;

              // Check if the user is not an employee
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                  // Query to fetch raise data for non-employees
                  $data = DB::table('quote_raise_concern')
                      ->join('option1_quotation', 'option1_quotation.query_reference', '=', 'quote_raise_concern.query_reference')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('quote_raise_concern.status', [0, 1])
                      ->select(
                          'option1_quotation.*',
                          'rt_package_query.destinations',
                          'rt_package_query.booking_label',
                          'rt_package_query.span_value_child_without_bed'
                      )
                      ->get();

              } else {

                  // Query to fetch raise data for employees
                  $data = DB::table('quote_raise_concern')
                      ->join('option1_quotation', 'option1_quotation.query_reference', '=', 'quote_raise_concern.query_reference')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('quote_raise_concern.status', [0, 1])
                      ->select(
                          'option1_quotation.*',
                          'rt_package_query.destinations',
                          'rt_package_query.booking_label',
                          'rt_package_query.span_value_child_without_bed'
                      )
                      ->get();
              }
          }

      } elseif ($notification_type == 'lead_verification') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = Query::where([
                      ['lead_verified', '=', '1'],
                      ['quo_send', '=', '0'],
                      ["webnotation", "=", env("WEBSITENAME")],
                      ['delete_status', '=', 1]
                  ])
                  ->where(function ($queries) {
                      $queries->whereIn('status', ['pending_quote'])
                              ->orWhereNull('status');
                  })
                  ->orderBy('created_at', 'desc')
                  ->get();
              } else {
                  $data = Query::where([
                      ['lead_verified', '=', '1'],
                      ['quo_send', '=', '0'],
                      ['assign_id', '=', $employee_id],
                      ["webnotation", "=", env("WEBSITENAME")],
                      ['delete_status', '=', 1]
                  ])
                  ->where(function ($queries) {
                      $queries->whereIn('status', ['pending_quote'])
                              ->orWhereNull('status');
                  })
                  ->orderBy('created_at', 'desc')
                  ->get();
              }
          }
      
      } elseif ($notification_type == 'quote_pending') {

          // Check if the lead manager service is activated
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

          // Proceed only if the check_data_lm is not null and the service is activated
          if ($check_data_lm && $check_data_lm->activation == 1) {

              // Get the current user's employee ID
              $employee_id = Sentinel::getUser()->id;

              // Check if the user is not an employee
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                  // Query to fetch query data for non-employees
                  $data = Query::where([
                          ['lead_verified', '=', '1'],
                          ['quo_send', '=', '0'],
                          ["webnotation", "=", env("WEBSITENAME")],
                          ['delete_status', '=', 1]
                      ])
                      ->where(function ($queries) {
                          $queries->whereIn('status', ['pending_quote'])
                                  ->orWhereNull('status');
                      })
                      ->orderBy('created_at', 'desc')
                      ->get();

              } else {

                  // Query to fetch query data for employees
                  $data = Query::where([
                          ['lead_verified', '=', '1'],
                          ['quo_send', '=', '0'],
                          ['assign_id', '=', $employee_id],
                          ["webnotation", "=", env("WEBSITENAME")],
                          ['delete_status', '=', 1]
                      ])
                      ->where(function ($queries) {
                          $queries->whereIn('status', ['pending_quote'])
                                  ->orWhereNull('status');
                      })
                      ->orderBy('created_at', 'desc')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'quote_saved') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = Option1Quotation::where([
                      ["webnotation", "=", env("WEBSITENAME")],
                      ['del_status', '=', 1],
                      ['send_option', '=', 0]
                  ])
                  ->orderBy('created_at', 'desc')
                  ->get();
              } else {
                  $data = Option1Quotation::where([
                      ["webnotation", "=", env("WEBSITENAME")],
                      ['assign_id', '=', $employee_id],
                      ['del_status', '=', 1],
                      ['send_option', '=', 0]
                  ])
                  ->orderBy('created_at', 'desc')
                  ->get();
              }
          }
      
      } elseif ($notification_type == 'quote_sent') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['quote_sent'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->orderBy('created_at', 'desc')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['quote_sent'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->orderBy('created_at', 'desc')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'lead_follow_up') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'process_booking') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['process_booking'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['process_booking'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'payment_follow_up') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['payment_follow_up'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['payment_follow_up'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'trip_under_cancellation') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['under_cancellation'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['under_cancellation'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'issue_voucher') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['issue_voucher'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['issue_voucher'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'trip_vouchers') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['voucher_issued'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['voucher_issued'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'trip_cancelled') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['tour_cancelled'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['tour_cancelled'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'trip_refund') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              } else {
                  $data = DB::table('option1_quotation')
                      ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                      ->where([
                          ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                          ['option1_quotation.assign_id', '=', $employee_id],
                          ['option1_quotation.del_status', '=', 1],
                          ['option1_quotation.send_option', '=', 1]
                      ])
                      ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                      ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label')
                      ->get();
              }
          }
      
      } elseif ($notification_type == 'lead_cancelled') {
          $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
          if ($check_data_lm->activation == 1) {
              $employee_id = Sentinel::getUser()->id;
              if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                  $data = Query::where([
                          ['webnotation', '=', env("WEBSITENAME")],
                          ['delete_status', '=', 1]
                      ])
                      ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                      ->orderBy('created_at', 'desc')
                      ->get();
              } else {
                  $data = Query::where([
                          ['webnotation', '=', env("WEBSITENAME")],
                          ['assign_id', '=', $employee_id],
                          ['delete_status', '=', 1]
                      ])
                      ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                      ->orderBy('created_at', 'desc')
                      ->get();
              }
          }
      
      }

      // Return the data retrieved based on the notification type
      return count($data);
  }

/*old*/
/*public static function get_leads_notificationss($notification_type)
  {
      $data=[];
       if($notification_type=='web_leads')
       {
       	$data = Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',1]])
              
                 ->where(function ($queries) {
                 $queries->whereIn('status', ['interested'])
                 ->orWhereNull('status');
                 
                 }
                 )
                 
                 ->orderBy('created_at', 'desc')
                 ->get();
       }
       elseif($notification_type=='verification_pending')
       {
           $check_data=ActivateService::where('services','=','leads')->first();
       if($check_data->activation==1):
      
         $data = Query::where([["webnotation","=",env("WEBSITENAME")],['delete_status','=',1]])
              
                 ->whereIn('status', ['add_lead_follow_up','lead_verify_pending'])
                 ->orderBy('created_at', 'desc')
                 ->get();
      
       endif; 
       }
       elseif($notification_type=='search_leads')
       {
        $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
        if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
        

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id', '=','option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status',['quote_sent','lead_follow_up','follow_up_pending','process_booking','payment_follow_up','under_cancellation','issue_voucher'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
                    ->orderBy('created_at', 'desc')

                    ->get();

        else:
        

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['quote_sent','lead_follow_up','follow_up_pending','process_booking','payment_follow_up','under_cancellation','issue_voucher'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
                    ->orderBy('created_at', 'desc')

                    ->get();
    
         endif;

        
          endif;

       }
       elseif($notification_type=='raise_data')
       {
           $check_data=ActivateService::where('services','=','leads')->first();
       if($check_data->activation==1):
      
         $employee_id=Sentinel::getUser()->id;
        
        if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
         // $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['del_status','=',1],['send_option','=',1]])
         //            ->orderBy('created_at', 'desc')
         //            ->get();

          $data=DB::table('quote_raise_concern')
          ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
          ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('quote_raise_concern.status', [0,1])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')

                    ->get();

       
        else:
         // $data=Option1Quotation::where([["webnotation","=",env("WEBSITENAME")],['assign_id','=',$employee_id],['del_status','=',1],['send_option','=',1]])
         //            ->orderBy('created_at', 'desc')
         //            ->get();
        
         $data=DB::table('quote_raise_concern')
          ->join('option1_quotation','option1_quotation.query_reference','=','quote_raise_concern.query_reference')
          ->join('rt_package_query','rt_package_query.id' , '=', 'quote_raise_concern.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('quote_raise_concern.status', [0,1])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')

                    ->get();

         
    
         endif;
         
      
       endif; 
       }
        elseif($notification_type=='query')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

      
      $employee_id=Sentinel::getUser()->id;
      if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
      $data = Query::where([
      ['lead_verified','=','1'],
      ['quo_send','=','0'],
      ["webnotation","=",env("WEBSITENAME")],
      ['delete_status','=',1]])
      ->where(function ($queries) {
        $queries->whereIn('status', ['pending_quote'])
        ->orWhereNull('status');
        }
      )
      ->orderBy('created_at', 'desc')
      ->get();
      else:
          $data = Query::where([
      ['lead_verified','=','1'],
      ['quo_send','=','0'],
      ['assign_id','=',$employee_id],
      ["webnotation","=",env("WEBSITENAME")],
      ['delete_status','=',1]])
      ->where(function ($queries) {
        $queries->whereIn('status', ['pending_quote'])
        ->orWhereNull('status');
        }
      )
      ->orderBy('created_at', 'desc')
      ->get();
      endif;
     endif;
       }
       elseif($notification_type=='saved_quote')
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
     endif;
       }
       elseif($notification_type=='quotation')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id', '=','option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status',['quote_sent'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')
                    ->orderBy('created_at', 'desc')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['quote_sent'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')
                    ->orderBy('created_at', 'desc')

                    ->get();
    
         endif;
     endif;
       }

       elseif($notification_type=='leads_follow_up')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['lead_follow_up','follow_up_pending'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['lead_follow_up','follow_up_pending'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }


       elseif($notification_type=='booking_hold')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['process_booking'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['process_booking'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }
      
       
       elseif($notification_type=='payment')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['payment_follow_up'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['payment_follow_up'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }


       
       elseif($notification_type=='under_cancellation')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

           $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['under_cancellation'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['under_cancellation'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }


       
       elseif($notification_type=='confirmation')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['issue_voucher'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['issue_voucher'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }
      

    elseif($notification_type=='tour_cancelled')
    {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

            $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['tour_cancelled'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['tour_cancelled'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }
       elseif($notification_type=='refund_issued')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

            $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['process_refund','refund_processed','refund_under_process'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['process_refund','refund_processed','refund_under_process'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }
       elseif($notification_type=='vouchers')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

            $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['voucher_issued'])
         ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();

        else:
      

          $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.assign_id','=',$employee_id],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
          ->whereIn('rt_package_query.status', ['voucher_issued'])
          ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')

                    ->get();
    
         endif;
     endif;
       }



       
       elseif($notification_type=='cancelled_leads')
       {
          $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
        if($check_data_lm->activation==1):

        $employee_id=Sentinel::getUser()->id;
        
         if(Sentinel::getUser()->roles()->first()->slug != 'employee'):
       

           $data = Query::where([
                    ['webnotation','=',env("WEBSITENAME")],
                    ['delete_status','=',1]])
                 ->whereIn('status', ['booked_with_other','quote_rejected','no_response','lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        else:
      

          $data = Query::where([
                    ['webnotation','=',env("WEBSITENAME")],
                    ['assign_id','=',$employee_id],
                    ['delete_status','=',1]])
                    ->whereIn('status', ['booked_with_other','quote_rejected','no_response','lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();
    
         endif;
     endif;
       }
       return count($data);
  }*/

}