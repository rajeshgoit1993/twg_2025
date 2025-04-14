<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rates;
use App\Transport;
Use App\PkgTours;
Use App\Icons;
use App\countries;
use App\State;
use App\City;
use App\Mid_Image;
use App\Testimonial;
use App\Theme;
use App\Pkgtype;
use App\Newsletter;
use Session;
use Illuminate\Support\Facades\DB;
use Image;
use Sentinel;
use Validator;
use App\ActivateService;
use App\TestimonialImage;
use Datatables;
use App\QuoteCharges;
use App\LeadDynamicField;
use App\EnquiryLeadFollowup;
use App\EnquiryLeadCancel;
use App\EnquiryTracker;
use App\Query;
use App\Helpers\CustomHelpers;
use App\Supplier;
use App\ServiceStatus;
use App\Payment;
use App\EnquiryTourCancel;
use App\RefundUnderProcess;
use App\EnqueryOTPSetting;
use App\RaiseConcern;
use App\TourVoucherRemarks;
use App\EnquiryTourUnderCancellation;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;

class LeadDynamicFieldController extends Controller
{
  // enquiry otp settings
  public function enquery_otp_setting() {
    $data=EnqueryOTPSetting::all();
    return view('backend_files.enquery_otp_setting.index',compact('data'));
  }

  /*-----------*/

  // enquiry otp settings status
  public function store_setting_status(Request $request) {
    $id = $request->id; // Get the ID from the request
    $data = EnqueryOTPSetting::find($id); // Find the EnqueryOTPSetting record by ID

    // Update the status field with the value from the request
    $data->status = $request->status;
    $data->save(); // Save the updated record

    echo 'success'; // Output 'success' after successful update
  }
  
  /*-----------*/

  // payment history
  public function get_payment_history(Request $request) {
    $id = $request->id;
    $datas = Payment::where('quote_ref_no', $id)->latest()->get();

    $outputs = '<div class="dashboard-outer-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="100">Date</th>
                      <th width="150">Description</th>
                      <th>Quote<br>Reference No</th>
                      <th>Transaction<br>Reference No</th>
                      <th>Payment<br>Status</th>
                      <th>Amount Paid<br>(Cr)</th>
                      <th>Amount Received<br>(Dr)</th>
                      <th>Payment<br>Mode</th>
                      <th>Payment<br>Receipt</th>
                    </tr>
                  </thead>';

    foreach ($datas as $data) {
        // Determine payment type
        $payment_type = ($data->payment_type == 0) ? '<br>(ONLINE)' : '<br>(OFFLINE)';

        // Determine part or refund type
        if ($data->transaction_type == 0) {
            $part_type = '';
            if ($data->part_payment == 'full') {
                $part_type = 'Full ' . $payment_type;
            } elseif ($data->part_payment == 'full_s') {
                $part_type = 'Full sub-Partial) ' . $payment_type;
            } elseif ($data->part_payment == '1') {
                $part_type = 'First partial payment) ' . $payment_type;
            } elseif ($data->part_payment == '1_s') {
                $part_type = 'First sub-partial) ' . $payment_type;
            } elseif ($data->part_payment == '2') {
                $part_type = 'Second partial) ' . $payment_type;
            } elseif ($data->part_payment == '2_s') {
                $part_type = 'Second sub-partial) ' . $payment_type;
            } elseif ($data->part_payment == '3') {
                $part_type = 'Third partial) ' . $payment_type;
            } elseif ($data->part_payment == 'full_s') {
                $part_type = 'Third sub-partial) ' . $payment_type;
            }
            $output = $data->description . ' <br>(' . $part_type . '';

            $credit_amount = ($data->transaction_type == 1) ? $data->amount : '';

            $debit_amount = ($data->transaction_type == 0) ? $data->amount : '';

        } else {

            $output = $data->description . ' <br>(Refund) ' . $payment_type . '';

            $credit_amount = '';

            $debit_amount = '';
        }

        // Determine status
        $status = ($data->status == 1) ? "<div class='font14' style='color:green'>Successfull</div>" : "<div class='font14' style='color:red'>Pending</div>";

        // Determine payment mode
        if ($data->gateway_id != '' && $data->payment_type == 0) {
            $gateway_data = DB::table('gateway_settings')->where('id', $data->gateway_id)->first();
            $gateway = $data->payment_mode . ' (' . $gateway_data->gateway_name . ')';
        } elseif ($data->gateway_id == '' && $data->payment_type == 1) {
            $gateway = "Cash<br>(Offline)";
        } else {
            $gateway = $data->gateway_id;
        }

        // Generate receipt link
        $path = url('payment-receipt/' . $data->id);
        $return_path = "<a href='" . $path . "' target='_blank'>View<br>Receipt</a>";

        // Build table row
        $outputs .= '<tr>
                      <td>' . date("d M Y H:i", strtotime($data->updated_at)) . '</td>
                      <td>' . $output . '</td>
                      <td>' . $data->quote_ref_no . '</td>
                      <td>' . $data->transaction_id . '</td>
                      <td>' . $status . '</td>
                      <td>' . $credit_amount . '</td>
                      <td>' . $debit_amount . '</td>
                      <td>' . $gateway . '</td>
                      <td>' . $return_path . '</td>
                    </tr>';
    }

    $outputs .= '</table></div>';
    echo $outputs;
  }

  /*-----------*/

  /*public function update_raise_concern(Request $request)
  {
      // Get query reference ID, status, and raise IDs from the request
      $id = $request->query_reference;
      $status = $request->status;
      $raise_ids = $request->raise_id;

      // Check if raise_ids are set in the request
      if (isset($request->raise_id)) {
          $raise_ids = $request->raise_id;

          // Update each RaiseConcern record with the new status and admin remarks
          foreach ($raise_ids as $raise_id) {
              $new_data = RaiseConcern::find($raise_id);
              $new_data->status = $status;
              $new_data->admin_remarks = $request->raise_remarks;
              $new_data->save();
          }

          // Save enquiry tracker with serialized raise IDs
          CustomHelpers::save_enquiry_tracker(
              (int) $id,
              $request->raise_remarks,
              Sentinel::getUser()->id,
              'answer_to_raise_concern',
              serialize($raise_ids)
          );
      }

      // Commented out code for different status handling (0, 1, 2)

      // Determine the number of pending and open statuses
      $pending = DB::table('quote_raise_concern')
                   ->where([
                       ['query_reference', (int) $id],
                       ['status', 0]
                   ])->get();

      $open = DB::table('quote_raise_concern')
                ->where([
                    ['query_reference', (int) $id],
                    ['status', 1]
                ])->get();

      // Determine button class based on pending and open statuses
      if (count($pending) > 0) {
          $btn_class = 'btn-danger';
      } elseif (count($pending) == 0 && count($open) > 0) {
          $btn_class = 'btn-warning';
      } else {
          $btn_class = 'btn-success';
      }

      // Prepare output data
      $output_data = [
          'output' => 'success',
          'btn_class' => $btn_class,
          'id' => (int) $id
      ];

      return $output_data;
  }*/

  public function update_raise_concern(Request $request) {
      // Get query reference ID, status, and raise IDs from the request
      $id = (int) $request->query_reference;
      $status = $request->status;
      $raise_ids = $request->raise_id;

      // Update each RaiseConcern record with the new status and admin remarks
      if ($raise_ids) {
          foreach ($raise_ids as $raise_id) {
              $new_data = RaiseConcern::find($raise_id);
              $new_data->status = $status;
              $new_data->admin_remarks = $request->raise_remarks;
              $new_data->save();
          }

          // Save enquiry tracker with serialized raise IDs
          CustomHelpers::save_enquiry_tracker(
              $id,
              $request->raise_remarks,
              Sentinel::getUser()->id,
              'answer_to_raise_concern',
              serialize($raise_ids)
          );
      }

      // Determine the number of pending and open statuses
      $pending = DB::table('quote_raise_concern')
                   ->where([
                       ['query_reference', $id],
                       ['status', 0]
                   ])->count();

      $open = DB::table('quote_raise_concern')
                ->where([
                    ['query_reference', $id],
                    ['status', 1]
                ])->count();

      // Determine button class based on pending and open statuses
      $btn_class = ($pending > 0) ? 'btn-danger' : (($pending == 0 && $open > 0) ? 'btn-warning' : 'btn-success');

      // Prepare output data
      $output_data = [
          'output' => 'success',
          'btn_class' => $btn_class,
          'id' => $id
      ];

      return $output_data;
  }

  /*-----------*/

  /*public function get_enquiry_raise(Request $request)
  {
    $id = (int) $request->id;

    // Fetch all RaiseConcern records for the given query_reference
    $datas = RaiseConcern::where('query_reference', $id)
                        ->latest()
                        ->get();

    // Fetch enquiry_ref_no and quo_ref from respective master tables using CustomHelpers
    $enq_ref_no = CustomHelpers::get_master_table_data('rt_package_query', 'id', $id, 'enquiry_ref_no');
    $quote_ref_no = CustomHelpers::get_master_table_data('option1_quotation', 'query_reference', $id, 'quo_ref');

    // Prepare the view with data and render it
    $output = view("query.get_enquiry_raise", compact('datas', 'id'))->render();

    // Prepare output data to return
    $output_data = [
        'output' => $output,
        'enq_ref_no' => $enq_ref_no,
        'quote_ref_no' => $quote_ref_no,
    ];

    return $output_data;
  }*/

  public function get_enquiry_raise(Request $request) {
    $id = $request->id;

    // Retrieve raise concerns for the given enquiry reference
    $datas = RaiseConcern::where('query_reference', (int)$id)->latest()->get();

    // Get additional details from helper methods or other sources
    $enq_ref_no = CustomHelpers::get_master_table_data('rt_package_query', 'id', $id, 'enquiry_ref_no');
    $quote_ref_no = CustomHelpers::get_master_table_data('option1_quotation', 'query_reference', $id, 'quo_ref');
    $query_reference = (int)$id;

    // Render a view with the retrieved data
    $output = view("query.get_enquiry_raise", compact('datas', 'query_reference'))->render();

    // Prepare the data to return
    $output_data = [
        'output' => $output,
        'enq_ref_no' => $enq_ref_no,
        'quote_ref_no' => $quote_ref_no
    ];

    return $output_data;
  }

  /*-----------*/

  /*public function get_enquiry_history(Request $request)
  {
      // Get enquiry ID from the request
      $id = $request->id;

      // Fetch all enquiry tracker records related to the enquiry ID, ordered by latest
      $datas = EnquiryTracker::where('enquiry_id', (int) $id)->latest()->get();
      $output = '';

      // Fetch enquiry reference number and quote reference number
      $enq_ref_no = CustomHelpers::get_master_table_data('rt_package_query', 'id', $id, 'enquiry_ref_no');
      $quote_ref_no = CustomHelpers::get_master_table_data('option1_quotation', 'query_reference', $id, 'quo_ref');

      // Iterate through each enquiry tracker record
      foreach ($datas as $data) {
          $output .= '<div class="timeline-block timeline-block-right">
                          <div class="marker active"><i class="fa fa-check active" aria-hidden="true"></i></div>
                          <div class="timeline-content">';

          if ($data->activity_type == 'update_enquiry') {
              $output .= '<p>Update Enquiry Details</p><span>' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</span>';
              $output .= $data->description;
          } else {
              $output .= '<h3>' . $data->description . '</h3><span>' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</span>';
          }

          if ($data->activity_type == 'add_lead_follow_up' || $data->activity_type == 'lead_follow_up') {
              $follow_data = DB::table('enquiry_lead_follow_up')->where('id', $data->activity_id)->first();
              $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
              $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

              $output .= '<p>Follow up date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
              $output .= '<p>Follow Time: ' . $follow_data->follow_up_time . '</p>';
              if ($reason) {
                  $output .= '<p>Reason: ' . $reason->field_name . '</p>';
              }
              $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
              if ($user) {
                  $output .= '<p>Assign User: ' . $user->first_name . '</p>';
              }
          }

          if ($data->activity_type == 'lead_cancelled') {
              $follow_data = DB::table('enquiry_lead_cancel')->where('id', $data->activity_id)->first();
              $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
              $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

              if ($reason) {
                  $output .= '<p>Reason: ' . $reason->field_name . '</p>';
              }
              $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
              if ($user) {
                  $output .= '<p>Assign User: ' . $user->first_name . '</p>';
              }
          }

          if ($data->activity_type == 'payment_follow_up') {
              $follow_data = DB::table('payment_follow_up')->where('id', $data->activity_id)->first();
              if ($follow_data) {
                  $output .= '<p>Follow up date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
                  $output .= '<p>Follow Time: ' . $follow_data->follow_up_time . '</p>';
                  $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
              }
          }

          if ($data->activity_type == 'Assigned User') {
              if ($data->activity_id) {
                  $user_id = $data->activity_id;
                  $create_data = DB::table('users')->where('id', $user_id)->first();
                  if ($create_data) {
                      $output .= '<p>Enquiry Assign To : ' . $create_data->first_name . '</p>';
                  } else {
                      $output .= '<p>Enquiry Unassigned </p>';
                  }
              } else {
                  $output .= '<p>Enquiry Unassigned </p>';
              }
          }

          if ($data->activity_type == 'refund_processed') {
              $create_data = DB::table('refund_create')->where('id', $data->activity_id)->first();
              if ($create_data) {
                  $output .= '<p>Remarks: ' . $create_data->remarks . '</p>';
              }
          }

          if ($data->activity_type == 'refund_under_process') {
              $refund_data = DB::table('refund_under_process')->where('id', $data->activity_id)->first();
              if ($refund_data) {
                  $output .= '<p>Remarks: ' . $refund_data->remarks . '</p>';
              }
          }

          if ($data->activity_type == 'tour_cancelled') {
              $follow_data = DB::table('enquiry_tour_cancel')->where('id', $data->activity_id)->first();
              if ($follow_data) {
                  $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                  $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                  if ($reason) {
                      $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                  }
                  $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                  if ($user) {
                      $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                  }
              }
          }

          if ($data->activity_type == 'under_cancellation') {
              $follow_data = DB::table('enquiry_lead_under_cancellation')->where('id', $data->activity_id)->first();
              if ($follow_data) {
                  $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                  $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                  if ($reason) {
                      $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                  }
                  $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                  if ($user) {
                      $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                  }
              }
          }

          if ($data->activity_type == 'voucher_sent') {
              $output .= '<p>Voucher sent</p>';
          }

          if ($data->activity_type == 'voucher_resent') {
              $output .= '<p>Voucher Re-sent</p>';
          }

          if ($data->activity_type == 'answer_to_raise_concern') {
              $activity_id = $data->activity_id;
              if ($activity_id && is_array(unserialize($data->activity_id))) {
                  $raise_data = DB::table('quote_raise_concern')->whereIn('id', unserialize($data->activity_id))->get();
                  foreach ($raise_data as $r_data) {
                      $output .= '<p>Raise : ' . $r_data->raise_concern . ' (Answer To) ' . $data->description . '</p>';
                  }
              }
          }

          $output .= '</div></div>';
      }

      // Prepare output data
      $output_data = [
          'output' => $output,
          'enq_ref_no' => $enq_ref_no,
          'quote_ref_no' => $quote_ref_no
      ];

      return $output_data;
  }*/

  /*public function get_enquiry_history(Request $request) {
    $id = $request->id;
    $datas = EnquiryTracker::where('enquiry_id', (int)$id)->latest()->get();
    $output = '';
    $enq_ref_no = CustomHelpers::get_master_table_data('rt_package_query', 'id', $id, 'enquiry_ref_no');
    $quote_ref_no = CustomHelpers::get_master_table_data('option1_quotation', 'query_reference', $id, 'quo_ref');

    foreach ($datas as $data) {
        $output .= '<div class="timeline-block timeline-block-right">
                      <div class="marker active"><i class="fa fa-check active" aria-hidden="true"></i></div>
                      <div class="timeline-content">';
        if ($data->activity_type == 'update_enquiry') {
            $output .= '<p>Lead Enquiry Updated</p><span>' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</span>';
            $output .= '<h3>' . $data->description . '</h3>';
        } else {
            $output .= '<h3>' . $data->description . '</h3><span>' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</span>';
        }

        if ($data->activity_type == 'add_lead_follow_up' || $data->activity_type == 'lead_follow_up') {
            $follow_data = DB::table('enquiry_lead_follow_up')->where('id', $data->activity_id)->first();
            $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
            $user = DB::table('users')->where('id', $follow_data->assign_user)->first();
            $output .= '<p>Follow-up Date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
            $output .= '<p>Follow-up Time: ' . $follow_data->follow_up_time . '</p>';
            if ($reason != '') {
                $output .= '<p>Reason: ' . $reason->field_name . '</p>';
            }
            $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
            if ($user != '') {
                $output .= '<p>Assign User: ' . $user->first_name . '</p>';
            }
        }

        if ($data->activity_type == 'lead_cancelled') {
            $follow_data = DB::table('enquiry_lead_cancel')->where('id', $data->activity_id)->first();
            $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
            $user = DB::table('users')->where('id', $follow_data->assign_user)->first();
            if ($reason != '') {
                $output .= '<p>Reason: ' . $reason->field_name . '</p>';
            }
            $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
            if ($user != '') {
                $output .= '<p>Assign User: ' . $user->first_name . '</p>';
            }
        }

        if ($data->activity_type == 'payment_follow_up') {
            $follow_data = DB::table('payment_follow_up')->where('id', $data->activity_id)->first();
            if ($follow_data != '') {
                $output .= '<p>Follow-up Date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
                $output .= '<p>Follow-up Time: ' . $follow_data->follow_up_time . '</p>';
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
            }
        }

        if ($data->activity_type == 'Assigned User') {
            if ($data->activity_id != '') {
                $user_id = $data->activity_id;
                $create_data = DB::table('users')->where('id', $user_id)->first();
                if ($create_data != '') {
                    $output .= '<p>Enquiry Assign To: ' . $create_data->first_name . '</p>';
                } else {
                    $output .= '<p>Enquiry Unassigned </p>';
                }
            } else {
                $output .= '<p>Enquiry Unassigned </p>';
            }
        }

        if ($data->activity_type == 'refund_processed') {
            $create_data = DB::table('refund_create')->where('id', $data->activity_id)->first();
            if ($create_data != '') {
                $output .= '<p>Remarks: ' . $create_data->remarks . '</p>';
            }
        }

        if ($data->activity_type == 'refund_under_process') {
            $refund_data = DB::table('refund_under_process')->where('id', $data->activity_id)->first();
            if ($refund_data != '') {
                $output .= '<p>Remarks: ' . $refund_data->remarks . '</p>';
            }
        }

        if ($data->activity_type == 'tour_cancelled') {
            $follow_data = DB::table('enquiry_tour_cancel')->where('id', $data->activity_id)->first();
            if ($follow_data != '') {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();
                if ($reason != '') {
                    $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                }
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                if ($user != '') {
                    $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                }
            }
        }

        if ($data->activity_type == 'under_cancellation') {
            $follow_data = DB::table('enquiry_lead_under_cancellation')->where('id', $data->activity_id)->first();
            if ($follow_data != '') {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();
                if ($reason != '') {
                    $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                }
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                if ($user != '') {
                    $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                }
            }
        }

        if ($data->activity_type == 'voucher_sent') {
            $output .= '<p>Voucher sent</p>';
        }

        if ($data->activity_type == 'voucher_resent') {
            $output .= '<p>Voucher Re-sent</p>';
        }

        if ($data->activity_type == 'refund_under_process') {
            $follow_data = DB::table('refund_under_process')->where('id', $data->activity_id)->first();
            if ($follow_data != '') {
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                if ($user != '') {
                    $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                }
            }
        }

        if ($data->activity_type == 'tour_cancelled') {
            $follow_data = DB::table('enquiry_tour_cancel')->where('id', $data->activity_id)->first();
            if ($follow_data) {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                if ($reason) {
                    $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                }
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                if ($user) {
                    $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                }
            }
        }

        if ($data->activity_type == 'under_cancellation') {
            $follow_data = DB::table('enquiry_lead_under_cancellation')->where('id', $data->activity_id)->first();
            if ($follow_data) {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                if ($reason) {
                    $output .= '<p>Reason: ' . $reason->field_name . '</p>';
                }
                $output .= '<p>Remarks: ' . $follow_data->remarks . '</p>';
                if ($user) {
                    $output .= '<p>Assign User: ' . $user->first_name . '</p>';
                }
            }
        }

        if ($data->activity_type == 'voucher_sent') {
            $output .= '<p>Voucher sent</p>';
        }

        if ($data->activity_type == 'voucher_resent') {
            $output .= '<p>Voucher Re-sent</p>';
        }

        if ($data->activity_type == 'answer_to_raise_concern') {
            $activity_id = $data->activity_id;
            error_log('Activity ID: ' . $activity_id);
            if ($this->is_serialized($activity_id)) {
                try {
                    $unserialized_data = unserialize($activity_id);
                    error_log('Unserialized Data: ' . print_r($unserialized_data, true));
                    if (is_array($unserialized_data)) {
                        $raise_data = DB::table('quote_raise_concern')->whereIn('id', $unserialized_data)->get();
                        foreach ($raise_data as $r_data) {
                            $output .= '<p>Raise: ' . $r_data->raise_concern . ' (Answer To) ' . $data->description . '</p>';
                        }
                    } else {
                        error_log('Unserialized data is not an array: ' . print_r($unserialized_data, true));
                    }
                } catch (Exception $e) {
                    error_log('Exception during unserialize: ' . $e->getMessage());
                }
            } else {
                // Handle the case where activity_id is not serialized
                error_log('Activity ID is not serialized: ' . $activity_id);
                $raise_data = DB::table('quote_raise_concern')->where('id', $activity_id)->get();
                foreach ($raise_data as $r_data) {
                    $output .= '<p>Raise: ' . $r_data->raise_concern . ' (Answer To) ' . $data->description . '</p>';
                }
            }
        }        

        $output .= '</div></div>';
    }

    $output_data = [
      'output' => $output, 
      'enq_ref_no' => $enq_ref_no, 
      'quote_ref_no' => $quote_ref_no
    ];
    
    return $output_data;
  }*/

  public function get_enquiry_history(Request $request) {
    // Retrieve the enquiry ID from the request
    $id = $request->id;

    // Fetch all related data from EnquiryTracker, ordered by latest first
    $datas = EnquiryTracker::where('enquiry_id', (int)$id)->latest()->get();

    // Initialize the output string
    $output = '';

    // Fetch enquiry reference number and quotation reference number
    $enq_ref_no = CustomHelpers::get_master_table_data('rt_package_query', 'id', $id, 'enquiry_ref_no');
    $quote_ref_no = CustomHelpers::get_master_table_data('option1_quotation', 'query_reference', $id, 'quo_ref');

    // Iterate through each data item and build the output string
    foreach ($datas as $data) {
        $output .= '<div class="timeline-block timeline-block-right">';
        $output .= '<div class="marker active"><i class="fa fa-check active" aria-hidden="true"></i></div>';
        $output .= '<div class="timeline-content">';

        // Handle different activity types
        if ($data->activity_type == 'update_enquiry') {
            $output .= '<p class="historyTitle">Lead Enquiry Updated</p>';
            $output .= '<p class="historyTime">' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</p>';
            $output .= '<p class="historyDescription">' . $data->description . '</p>';
        } else {
            $output .= '<p class="historyTitle">' . $data->description . '</p>';
            $output .= '<p class="historyTime">' . date('d-m-Y H:i:s', strtotime($data->created_at)) . '</p>';
        }

        // Handle follow-up activities
        if (in_array($data->activity_type, ['add_lead_follow_up', 'lead_follow_up'])) {
            $follow_data = DB::table('enquiry_lead_follow_up')->where('id', $data->activity_id)->first();
            $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
            $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

            $output .= '<p class="historyDescription">Follow-up Date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
            $output .= '<p class="historyDescription">Follow-up Time: ' . $follow_data->follow_up_time . '</p>';

            if ($reason) {
                $output .= '<p class="historyDescription">Reason: ' . $reason->field_name . '</p>';
            }

            $output .= '<p class="historyDescription">Remarks: ' . $follow_data->remarks . '</p>';

            if ($user) {
                $output .= '<p class="historyDescription">Assigned Consultant: ' . $user->first_name . '</p>';
            }
        }

        // Handle lead cancellation activities
        if ($data->activity_type == 'lead_cancelled') {
            $follow_data = DB::table('enquiry_lead_cancel')->where('id', $data->activity_id)->first();
            $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
            $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

            if ($reason) {
                $output .= '<p class="historyDescription">Reason: ' . $reason->field_name . '</p>';
            }

            $output .= '<p class="historyDescription">Remarks: ' . $follow_data->remarks . '</p>';

            if ($user) {
                $output .= '<p class="historyDescription">Assigned Consultant: ' . $user->first_name . '</p>';
            }
        }

        // Handle payment follow-up activities
        if ($data->activity_type == 'payment_follow_up') {
            $follow_data = DB::table('payment_follow_up')->where('id', $data->activity_id)->first();

            if ($follow_data) {
                $output .= '<p class="historyDescription">Follow-up Date: ' . date('d-m-Y', strtotime($follow_data->follow_up_date)) . '</p>';
                $output .= '<p class="historyDescription">Follow-up Time: ' . $follow_data->follow_up_time . '</p>';
                $output .= '<p class="historyDescription">Remarks: ' . $follow_data->remarks . '</p>';
            }
        }

        // Handle assigned user activities
        if ($data->activity_type == 'Assigned Consultant') {
            if ($data->activity_id) {
                $user_id = $data->activity_id;
                $create_data = DB::table('users')->where('id', $user_id)->first();

                if ($create_data) {
                    $output .= '<p class="historyDescription">Lead Assign To: ' . $create_data->first_name . '</p>';
                } else {
                    $output .= '<p class="historyDescription">Lead Unassigned</p>';
                }
            } else {
                $output .= '<p class="historyDescription">Lead Unassigned</p>';
            }
        }

        // Handle refund processed activities
        if ($data->activity_type == 'refund_processed') {
            $create_data = DB::table('refund_create')->where('id', $data->activity_id)->first();

            if ($create_data) {
                $output .= '<p class="historyDescription">Remarks: ' . $create_data->remarks . '</p>';
            }
        }

        // Handle refund under process activities
        if ($data->activity_type == 'refund_under_process') {
            $refund_data = DB::table('refund_under_process')->where('id', $data->activity_id)->first();

            if ($refund_data) {
                $output .= '<p class="historyDescription">Remarks: ' . $refund_data->remarks . '</p>';
            }
        }

        // Handle tour cancellation activities
        if ($data->activity_type == 'tour_cancelled') {
            $follow_data = DB::table('enquiry_tour_cancel')->where('id', $data->activity_id)->first();

            if ($follow_data) {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                if ($reason) {
                    $output .= '<p class="historyDescription">Reason: ' . $reason->field_name . '</p>';
                }

                $output .= '<p class="historyDescription">Remarks: ' . $follow_data->remarks . '</p>';

                if ($user) {
                    $output .= '<p class="historyDescription">Assigned Consultant: ' . $user->first_name . '</p>';
                }
            }
        }

        // Handle under cancellation activities
        if ($data->activity_type == 'under_cancellation') {
            $follow_data = DB::table('enquiry_lead_under_cancellation')->where('id', $data->activity_id)->first();

            if ($follow_data) {
                $reason = DB::table('lead_dynamic_field')->where('id', $follow_data->reason)->first();
                $user = DB::table('users')->where('id', $follow_data->assign_user)->first();

                if ($reason) {
                    $output .= '<p class="historyDescription">Reason: ' . $reason->field_name . '</p>';
                }

                $output .= '<p class="historyDescription">Remarks: ' . $follow_data->remarks . '</p>';

                if ($user) {
                    $output .= '<p class="historyDescription">Assigned Consultant: ' . $user->first_name . '</p>';
                }
            }
        }

        // Handle voucher sent and resent activities
        if ($data->activity_type == 'voucher_sent') {
            $output .= '<p class="historyDescription">Voucher/Invoice sent</p>';
        }

        if ($data->activity_type == 'voucher_resent') {
            $output .= '<p class="historyDescription">Voucher/Invoice Re-sent</p>';
        }

        // Handle raised concern activities
        if ($data->activity_type == 'answer_to_raise_concern') {
            $activity_id = $data->activity_id;
            error_log('Activity ID: ' . $activity_id);

            if ($this->is_serialized($activity_id)) {
                try {
                    $unserialized_data = unserialize($activity_id);
                    error_log('Unserialized Data: ' . print_r($unserialized_data, true));

                    if (is_array($unserialized_data)) {
                        $raise_data = DB::table('quote_raise_concern')->whereIn('id', $unserialized_data)->get();

                        foreach ($raise_data as $r_data) {
                            $output .= '<p>Request: ' . $r_data->raise_concern . ' <br>(Reply)<br> ' . $data->description . '</p>';
                        }
                    } else {
                        error_log('Unserialized data is not an array: ' . print_r($unserialized_data, true));
                    }
                } catch (Exception $e) {
                    error_log('Exception during unserialize: ' . $e->getMessage());
                }
            } else {
                // Handle the case where activity_id is not serialized
                error_log('Activity ID is not serialized: ' . $activity_id);
                $raise_data = DB::table('quote_raise_concern')->where('id', $activity_id)->get();

                foreach ($raise_data as $r_data) {
                    $output .= '<p class="historyDescription">Request: ' . $r_data->raise_concern . ' <br>(Reply) ' . $data->description . '</p>';
                }
            }
        }

        // Close the timeline block
        $output .= '</div></div>';
    }

    // Prepare the final output data
    $output_data = [
        'output' => $output,
        'enq_ref_no' => $enq_ref_no,
        'quote_ref_no' => $quote_ref_no
    ];

    // Return the output data as a JSON response
    return response()->json($output_data);
  }

  private function is_serialized($data) {
    if (!is_string($data)) {
      return false;
    }
    $data = trim($data);
    if ($data === 'N;') {
      return true;
    }
    if (strlen($data) < 4) {
      return false;
    }
    if ($data[1] !== ':') {
      return false;
    }
    $lastc = substr($data, -1);
    if ($lastc !== ';' && $lastc !== '}') {
      return false;
    }
    $token = $data[0];
    switch ($token) {
      case 's':
      if (preg_match("/^s:[0-9]+:\".*\";$/s", $data)) {
        return true;
      }
      return false;
      case 'a':
      case 'O':
      case 'b':
      case 'i':
      case 'd':
      return (bool)@unserialize($data);
    }
    return false;
  }

  /*-----------*/

  public function add_payment_follow_up() {
    // Fetching users based on role ID 15 (assuming this role is predefined)
    $role = Sentinel::findRoleById(15);
    $employee = $role->users()->with('roles')->get();

    // Initialize empty options for select element
    $emp = '';

    // Checking user roles to determine the options to include
    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
        // Adding option for Admin user
        $emp .= '<option value="'. Sentinel::getUser()->id .'">Admin</option>';

        // Adding options for other employees fetched
        foreach ($employee as $employees) {
            $name = $employees->first_name . '&nbsp;' . $employees->last_name;
            $emp .= '<option value="' . $employees->id . '">' . $name . '</option>';
        }
    } else {
        // Adding option for regular user (non-admin)
        $emp .= '<option value="'. Sentinel::getUser()->id .'">' . Sentinel::getUser()->first_name . '&nbsp;' . Sentinel::getUser()->last_name . '</option>';
    }

    // Fetching dynamic fields where field_type is 2 and status is 1
    $val = 2;
    $datas = LeadDynamicField::where([['field_type', $val], ['status', 1]])->get();

    // Initializing options for reason select element
    $output = '<option value="" disabled selected>Select reason</option>';

    // Generating options for each dynamic field fetched
    foreach ($datas as $data) {
        $output .= '<option value="' . $data->id . '">' . $data->field_name . '</option>';
    }

    // Constructing return array with options for reason and employees
    $retun = ['output' => $output, 'emp' => $emp];

    return $retun;
  }

  /*-----------*/

  public function add_lead_follow_up_data() {
    $role = Sentinel::findRoleById(15);
    $employee = $role->users()->with('roles')->get();
    $emp = '';

    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">Admin</option>';
        foreach ($employee as $employees) {
            $name = $employees->first_name . '&nbsp;' . $employees->last_name;
            $emp .= '<option value="' . $employees->id . '">' . $name . '</option>';
        }
    } else {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">' . Sentinel::getUser()->first_name . '&nbsp;' . Sentinel::getUser()->last_name . '</option>';
    }

    $val = 2;
    $datas = LeadDynamicField::where([
        ['field_type', $val],
        ['status', 1]
    ])->get();
    
    $output = '<option value="" disabled selected>Select reason</option>';
    foreach ($datas as $data) {
        $output .= '<option value="' . $data->id . '">' . $data->field_name . '</option>';
    }

    $time = date('H:i');
    $return_data = ['output' => $output, 'emp' => $emp, 'time' => $time];
    return $return_data;
  }
  
  /*-----------*/

  public function update_follow_up(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'add_lead_follow_up';
    $data->save();

    $date_time = $request->follow_up_date;
    list($date, $time) = explode('T', $date_time);

    $query = new EnquiryLeadFollowup;
    $query->assign_user = $request->assign_person;
    $query->reason = $request->follow_up_reason;
    $query->remarks = $request->remarks;
    $query->follow_up_date = $date;
    $query->follow_up_time = $time;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Add Lead Follow-up', Sentinel::getUser()->id, 'add_lead_follow_up', $query->id, $request->assign_person);

    echo 'success';
  }

  public function update_follow_ups(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'lead_follow_up';
    $data->save();

    $date_time = $request->follow_up_date;
    list($date, $time) = explode('T', $date_time);

    $query = new EnquiryLeadFollowup;
    $query->assign_user = $request->assign_person;
    $query->reason = $request->follow_up_reason;
    $query->remarks = $request->remarks;
    $query->follow_up_date = $date;
    $query->follow_up_time = $time;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Lead Follow-up', Sentinel::getUser()->id, 'lead_follow_up', $query->id);

    echo 'success';
  }

  public function refund_under_process_form(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'refund_under_process';
    $data->save();

    $query = new RefundUnderProcess;
    $query->assign_user = $request->assign_person;
    $query->remarks = $request->remarks;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Refund Under Process', Sentinel::getUser()->id, 'refund_under_process', $query->id);

    return response()->json(['status' => 'success']);
  }

  public function update_tour_cancel(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'tour_cancelled';
    $data->save();

    $query = new EnquiryTourCancel;
    $query->assign_user = $request->assign_person;
    $query->reason = $request->tour_cancel_reason;
    $query->remarks = $request->remarks;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Tour Cancelled', Sentinel::getUser()->id, 'tour_cancelled', $query->id);

    return response()->json(['status' => 'success']);
  }

  public function update_issue_voucher(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'voucher_issued';
    $data->save();

    $query = new TourVoucherRemarks;
    $query->assign_user = $request->assign_person;
    $query->remarks = $request->remarks;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Tour Voucher Issued', Sentinel::getUser()->id, 'voucher_issued', $query->id);

    return response()->json(['status' => 'success']);
  }
  
  public function update_lead_cancel(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'lead_cancelled';
    $data->save();

    $query = new EnquiryLeadCancel;
    $query->assign_user = $request->assign_person;
    $query->reason = $request->lead_cancel_reason;
    $query->remarks = $request->remarks;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Lead Cancelled', Sentinel::getUser()->id, 'lead_cancelled', $query->id);

    return response()->json(['status' => 'success']);
  }

  public function update_lead_under_cancellation(Request $request)
  {
    $query_id = $request->query_id;
    $data = Query::find($query_id);
    $data->status = 'under_cancellation';
    $data->save();

    $query = new EnquiryTourUnderCancellation;
    $query->assign_user = $request->assign_person;
    $query->reason = $request->lead_cancel_reason;
    $query->remarks = $request->remarks;
    $query->enquiry_id = $data->id;
    $query->save();

    CustomHelpers::save_enquiry_tracker($query_id, 'Under Cancellation', Sentinel::getUser()->id, 'under_cancellation', $query->id);

    echo 'success';
  }

  public function query_status(Request $request)
  {
    $id = $request->id;
    $status = $request->status_value;

    $data = Query::find($id);
    $accept_quote_id = $data->accept_quote_id;
    $quotation = Option1Quotation::find($accept_quote_id);
    $tour_date = $quotation->tour_date;
    $lead_verified = $data->lead_verified;
    $output = 'na';

    if ($status == 'interested' && $lead_verified == 1) {
        $data->quo_send = 0;
        $data->status = 'pending_quote';
        $output = 'to_pending';
    } elseif ($status == 'interested' && $data->status == 'lead_cancelled' && ($lead_verified == 0 || $lead_verified == '')) {
        $data->status = $status;
        $output = 'to_web_lead';
    } elseif ($status == 'issue_voucher') {
        $data->status = $status;
        $output = 'issue_voucher';
    } elseif ($status == 'voucher_issued') {
        $data->status = $status;
        $output = 'voucher_issued';
    } elseif ($status == 'tour_cancelled') {
        $data->status = $status;
        $output = 'tour_cancelled';
    } elseif ($status == 'under_cancellation') {
        $data->status = $status;
        $output = 'under_cancellation';
    } elseif ($status == 'tour_completed') {
        if ($tour_date <= date('Y-m-d')) {
            $data->status = $status;
            $output = 'tour_completed';
        } else {
            $output = 'tour_not_completed';
        }
    } else {
        $data->status = $status;
    }

    $data->save();

    $heading = '';
    switch ($status) {
        case 'lead_verify_pending':
            $heading = 'Lead Verify Pending';
            break;
        case 'interested':
            $heading = 'Interested';
            break;
        case 'quote_sent':
            $heading = 'Quote Sent';
            break;
        case 'lead_follow_up':
            $heading = 'Lead Follow-up';
            break;
        case 'follow_up_pending':
            $heading = 'Follow-up Pending';
            break;
        case 'process_booking':
            $heading = 'Process Booking';
            break;
        case 'booking_confirmed':
            $heading = 'Booking Confirmed';
            break;
        case 'payment_follow_up':
            $heading = 'Payment Follow-up';
            break;
        case 'under_cancellation':
            $heading = 'Under Cancellation';
            break;
        case 'issue_voucher':
            $heading = 'Issue Voucher';
            break;
        case 'voucher_issued':
            $heading = 'Voucher Issued';
            break;
        case 'tour_completed':
            $heading = 'Tour Completed';
            break;
        case 'send_review_form':
            $heading = 'Send Review Form';
            break;
        case 'review_posted':
            $heading = 'Review Posted';
            break;
        case 'tour_cancelled':
            $heading = 'Tour Cancelled';
            break;
        case 'process_refund':
            $heading = 'Process Refund';
            break;
        case 'refund_processed':
            $heading = 'Refund Processed';
            break;
        case 'lead_cancelled':
            $heading = 'Lead Cancelled';
            break;
        case 'na':
            $heading = 'Not Applicable';
            break;
        default:
            break;
    }

    CustomHelpers::save_enquiry_tracker($id, $heading, Sentinel::getUser()->id, $status);

    echo $output;
  }
  
  public function cancel_lead_follow_up_data()
  {
    $role = Sentinel::findRoleById(15);
    $employee = $role->users()->with('roles')->get();
    $emp = '';

    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">Admin</option>';
        foreach ($employee as $employees) {
            $name = $employees->first_name . '&nbsp;' . $employees->last_name;
            $emp .= '<option value="' . $employees->id . '">' . $name . '</option>';
        }
    } else {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">' . Sentinel::getUser()->first_name . '&nbsp;' . Sentinel::getUser()->last_name . '</option>';
    }

    $val = 1;
    $datas = LeadDynamicField::where([
        ['field_type', $val],
        ['status', 1]
    ])->get();

    $output = '<option value="" disabled selected>Select reason</option>';
    foreach ($datas as $data) {
        $output .= '<option value="' . $data->id . '">' . $data->field_name . '</option>';
    }

    $time = date('H:i');

    $return_data = ['output' => $output, 'emp' => $emp, 'time' => $time];
    return $return_data;
  }

  public function voucher_issued_remarks()
  {
    $role = Sentinel::findRoleById(15);
    $employee = $role->users()->with('roles')->get();
    $emp = '';

    if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">Admin</option>';
        foreach ($employee as $employees) {
            $name = $employees->first_name . '&nbsp;' . $employees->last_name;
            $emp .= '<option value="' . $employees->id . '">' . $name . '</option>';
        }
    } else {
        $emp .= '<option value="' . Sentinel::getUser()->id . '">' . Sentinel::getUser()->first_name . '&nbsp;' . Sentinel::getUser()->last_name . '</option>';
    }

    $time = date('H:i');

    $return_data = ['emp' => $emp, 'time' => $time];
    return $return_data;
  }

  public function lead_concelled_reasons()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 1;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function add_lead_follow_up()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 2;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function booking_status()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 3;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function lead_payment_status()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 4;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function payment_method()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 5;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function service_type()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 6;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function get_query_service_type_data(Request $request)
  {
    $query_id = $request->query_id;
    $val = 6;
    $datas = LeadDynamicField::where([['field_type', $val], ['status', 1]])->get();
    $supplier = Supplier::all();
    $query = Query::find($query_id);
    $service_s = ServiceStatus::where('query_id', $query_id)->first();
    $data_s = LeadDynamicField::where([['field_type', 7], ['status', 1]])->get();
    $options = view("query.query_modal.modal-popup.get_query_service_type_data", compact('datas', 'supplier', 'query', 'service_s', 'data_s'))->render();
    echo $options;
  }

  public function get_service_type_data(Request $request)
  {
    $id = $request->id;
    $val = 7;
    $service_type_data = LeadDynamicField::find($id);
    $datas = LeadDynamicField::where([['field_type', $val], ['status', 1]])->get();
    $supplier = Supplier::all();
    $options = view("query.query_modal.modal-popup.get_service_type_data", compact('datas', 'service_type_data', 'supplier'))->render();
    echo $options;
  }

  function update_service_status(Request $request)
  {
    $query_id = $request->query_id;
    $data = ServiceStatus::where('query_id', $query_id)->first();

    if ($data == '') {
        $services = $request->service_type;
        $output = '';
        $a = 1;
        foreach ($services as $service) {
            $service_data = LeadDynamicField::find($service);
            if ($a != 1) {
                $output .= ',';
            }
            $output .= $service_data->field_name;
            $a++;
        }
        $output .= ' added these service type';
        $data = new ServiceStatus;
        CustomHelpers::save_enquiry_tracker($query_id, $output, Sentinel::getUser()->id, 'Service Type', $query_id);
    } else {
        $new_services = $request->service_type;
        $old_service_type = unserialize($data->services);
        sort($new_services);
        sort($old_service_type);

        $output = '';

        if ($new_services == $old_service_type) {
            $output .= 'No any changes in service type';
        } else {
            $output .= 'Previous Service Type : ';
            $a = 1;
            foreach ($old_service_type as $service) {
                $service_data = LeadDynamicField::find($service);
                if ($a != 1) {
                    $output .= ',';
                }
                $output .= $service_data->field_name;
                $a++;
            }

            $output .= ' & New Service Type : ';
            $b = 1;
            foreach ($new_services as $service) {
                $service_data = LeadDynamicField::find($service);
                if ($b != 1) {
                    $output .= ',';
                }
                $output .= $service_data->field_name;
                $b++;
            }
        }

        CustomHelpers::save_enquiry_tracker($query_id, $output, Sentinel::getUser()->id, 'Service Type', $query_id);
    }

    $data->query_id = $request->query_id;
    $data->services = serialize($request->service_type);
    $data->services_status = serialize($request->services_status);
    $data->save();

    echo 'success';
  }

  public function service_status()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 7;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function booking_label()
  {
    $check_data_settings = ActivateService::where('services', '=', 'settings')->first();

    if ($check_data_settings->activation == 1) {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')) {
                $val = 8;
                $datas = LeadDynamicField::where('field_type', $val)->get();
                return view("leaddynamicfield.index", compact('datas', 'val'));
            } else {
                return redirect("/");
            }
        }
    } else {
        return response()->view('error.404', [], 404);
    }
  }

  public function lead_field_save(Request $request)
  {
    $field_type = $request->field_type;
    $data_validation = LeadDynamicField::where([['field_name', '=', $request->field_name], ['field_type', '=', $field_type]])->first();

    if (!$data_validation) {
        $data = new LeadDynamicField;
        $data->field_name = $request->field_name;
        $data->field_type = $request->field_type;
        $data->status = $request->status;
        $data->save();
        return 'success';
    } else {
        return 'Data already taken';
    }
  }

  public function edit_leatdynamictable(Request $request)
  {
    $id = $request->id;
    $data = LeadDynamicField::find($id);
    $options = view("leaddynamicfield.edit", compact('data'))->render();
    return $options;
  }

  public function lead_field_update(Request $request)
  {
    $id = $request->id;
    $field_type = $request->field_type;
    $data_validation = LeadDynamicField::where([['field_name', '=', $request->field_name], ['field_type', '=', $field_type], ['id', '!=', $id]])->first();

    if (!$data_validation) {
        $data = LeadDynamicField::find($id);
        $data->field_name = $request->field_name;
        $data->field_type = $request->field_type;
        $data->status = $request->status;
        $data->save();
        return 'success';
    } else {
        return 'Data already taken';
    }
  }
}