<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon; // ✅ Add this here
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
use App\TourType;
use App\TourCategory;
use App\Gtags;
use App\Suitable;
use App\Holiday;
use App\Pkgtype;
use App\PkgTours;
use App\Activity;
use App\Quote;
use App\PayAtHotelPaymentType;
use DateTime;

class QueryController extends Controller 
{
    /*//public $mail_from_ids="tourquotes@theworldgateway.com";
    public $mail_from_ids="rapidextravels@hotmail.com";
    //public $mail_to_cc="helpdesk@theworldgateway.com";
    public $mail_to_cc="helpdesk@theworldgateway.com";
    //public $mail_from_id="reservations@theworldgaeway.com";
    public $mail_from_id="rapidextravels@hotmail.com";*/

    public $mail_from_sender;
    public $mail_from_reservations;
    public $mail_to_cc;
    public $webnotation;

    public function __construct()
    {
        // Determine webnotation (1 = The World Gateway, 0 = Rapidex Travels)
        $this->webnotation = env("WEBSITENAME") == 1 ? 1 : 0;

        // Get website-specific email details dynamically
        $this->mail_from_sender = getWebsiteData('sender_email');
        $this->mail_from_reservations = getWebsiteData('reservation_email');
        $this->mail_to_cc = getWebsiteData('cc_email'); // Fetch support email dynamically
    }


    /**********************/



    public function index() {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        
        if ($check_data_lm->activation == 1) {
            $employee_id = Sentinel::getUser()->id;
            
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $queries = Query::where([
                    ['lead_verified', '=', '1'],
                    ['quo_send', '=', '0'],
                    ["webnotation", "=", env("WEBSITENAME")],
                    ['delete_status', '=', 1]
                ])->where(function ($queries) {
                    $queries->whereIn('status', ['pending_quote'])
                            ->orWhereNull('status');
                })
                ->orderBy('created_at', 'desc')
                ->get();
            } else {
                $queries = Query::where([
                    ['lead_verified', '=', '1'],
                    ['quo_send', '=', '0'],
                    ['assign_id', '=', $employee_id],
                    ["webnotation", "=", env("WEBSITENAME")],
                    ['delete_status', '=', 1]
                ])->where(function ($queries) {
                    $queries->whereIn('status', ['pending_quote'])
                            ->orWhereNull('status');
                })
                ->orderBy('created_at', 'desc')
                ->get();
            }
            
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'pending_quote';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();
            
            return view('query.list', [
                'queries' => $queries,
                'employee' => $employee,
                'val' => $val,
                'booking_lavel' => $booking_lavel
            ]);
        } else {
            return response()->view('error.404', [], 404);
        }
    }

    public function quote_accept(Request $request) {
        // Decrypt the quote ID from the request
        $id = CustomHelpers::custom_decrypt($request->quote_id);
        
        // Find the quote by its decrypted ID
        $data = Option1Quotation::find($id); 
        
        // If the quote data is found, update its accept_status and save
        if ($data) {
            $data->accept_status = 1;
            $data->save();
            
            // Redirect back with success message
            return redirect()->back()->with("success", "Quote Accepted");
        } else {
            // Redirect back with error message if quote data not found
            return redirect()->back()->with("error", "Not Accepted");
        }
    }

    public function quote_reject(Request $request) {
        // Decrypt the quote ID from the request
        $id = CustomHelpers::custom_decrypt($request->quote_id);
        
        // Find the quote by its decrypted ID
        $data = Option1Quotation::find($id); 
        
        // If the quote data is found, update its accept_status to reject (2) and save
        if ($data) {
            $data->accept_status = 2;
            $data->save();
            
            // Redirect back with error message indicating quote rejection
            return redirect()->back()->with("error", "Quote Rejected");
        } else {
            // Redirect back with error message if quote data not found
            return redirect()->back()->with("error", "Not Accepted");
        }
    }

    public function enquiry() {
        // Check if the 'leads' service is activated
        $check_data = ActivateService::where('services', '=', 'leads')->first();
        
        if ($check_data && $check_data->activation == 1) {
            $val = 1; // Set a value (if needed)
            $employee_id = Sentinel::getUser()->id;
            
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                $queries = Query::where([
                ["webnotation", "=", env("WEBSITENAME")],
                ['delete_status', '=', 1]
            ])->where(function ($queries) {
                // Filter queries based on status being 'interested' or null
                $queries->whereIn('status', ['interested'])
                        ->orWhereNull('status');
            })->orderBy('created_at', 'desc')
            ->get();
            }
            else
            {
             $queries = Query::where([
                ["webnotation", "=", env("WEBSITENAME")],
                ['delete_status', '=', 1],
                ['assign_id', '=', $employee_id]
            ])->where(function ($queries) {
                // Filter queries based on status being 'interested' or null
                $queries->whereIn('status', ['interested'])
                        ->orWhereNull('status');
            })->orderBy('created_at', 'desc')
            ->get();
            }
            
            
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            // Return the view with queries and additional data
            return view('query.enquiry', ['queries' => $queries, 'val' => $val, 'employee' => $employee,]);
        } else {
            // If the 'leads' service is not activated, return a 404 error view
            return response()->view('error.404', [], 404);
        }
    }

    public function pending_verification() {
        // Check if the 'leads' service is activated
        $check_data = ActivateService::where('services', '=', 'leads')->first();
        
        if ($check_data && $check_data->activation == 1) {
            $val = 2; // Set a value (if needed)
            
            // Retrieve queries where webnotation matches the environment variable WEBSITENAME and delete_status is 1
             $employee_id = Sentinel::getUser()->id;
             if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                $queries = Query::where([
                ["webnotation", "=", env("WEBSITENAME")],
                ['delete_status', '=', 1]
            ])->whereIn('status', ['add_lead_follow_up', 'lead_verify_pending'])
            ->orderBy('created_at', 'desc')
            ->get();

             }
               else {

                $queries = Query::where([
                ["webnotation", "=", env("WEBSITENAME")],
                ['delete_status', '=', 1],
                ['assign_id', '=', $employee_id]
            ])->whereIn('status', ['add_lead_follow_up', 'lead_verify_pending'])
            ->orderBy('created_at', 'desc')
            ->get();

              }
             $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            
            // Retrieve lead booking levels if needed
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();
            
            // Return the view with queries, value, and lead booking levels
            return view('query.enquiry', [
                'queries' => $queries,
                'val' => $val,
                'employee' => $employee,
                'booking_lavel' => $booking_lavel
            ]);
        } else {
            // If the 'leads' service is not activated, return a 404 error view
            return response()->view('error.404', [], 404);
        }
    }

    public function change_payment_status(Request $request) {
        // Retrieve the query ID from the request
        $query_id = $request->id;
        
        // Find the query by its ID
        $data = Query::find($query_id);
        
        // Update the payment status with the value from the request
        $data->payment_status = $request->status_value;
        $data->save();
        
        // Save an enquiry tracker for the query
        CustomHelpers::save_enquiry_tracker(
            $query_id,
            $request->status_value,
            Sentinel::getUser()->id,
            'add_lead_follow_up', // Assuming 'add_lead_follow_up' is the action type
            $data->id // Assuming $data refers to the Query model instance
        );
        
        // Echo 'success' to indicate successful operation
        echo 'success';
    }

    public function add_lead_payment(Request $request) {
        // Retrieve the query ID from the request
        $query_id = $request->id;
        
        // Find the query by its ID
        $data = Query::find($query_id);
        
        // Retrieve guest details from the query
        $booking_guest_name = $data->name;
        $booking_guest_mobile_no = $data->mobile;
        $booking_guest_email_id = $data->email;
        
        // Retrieve quote details from the request
        $quote_no = $request->quote_no;
        $quote_id = $request->quote_id;
        
        // Initialize variables for quote-specific data
        $quote_ref_no = '';
        $price = 0;
        $amount = 0;
        $price_data = [];
        
        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote_id);
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
            $data = Option2Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }
        
        // Calculate amount and due amount for payment
        $amount = $price_data['query_pricetopay_adult'];
        $due_amount = CustomHelpers::get_remaining_due($quote_ref_no, $amount);
        $main_paid = (int)$amount - (int)$due_amount;
        
        // Initialize payment type output
        $payment_type_output = '';
        $payment_type_output .= '<option value="full">Full</option>';
        
        // Add part payment options if applicable
        if ($data->partPayment == 1) {
            $part_payments_sec = CustomHelpers::part_payments($data->part_payments, $price_data['query_pricetopay_adult']);
            
            if ($part_payments_sec['adv_amount'] > 0) {
                $payment_type_output .= '<option value="advance">Advance Payment</option>';
            }
            
            if ($part_payments_sec['first_part_amount'] > 0) {
                $payment_type_output .= '<option value="first">1st Part Payment</option>';
            }
            
            if ($part_payments_sec['second_part_amount'] > 0) {
                $payment_type_output .= '<option value="second">2nd Part Payment</option>';
            }
        }
        
        // Check if passengers exist for the quote
        $passengers_check = DB::table('rt_passengerinfo')->where('quotation_ref_no', $quote_ref_no)->first();
        
        // Handle different scenarios based on passenger check and payment status
        if (!$passengers_check) {
            return 'error';
        } elseif ($main_paid >= $amount) {
            return 'already_paid';
        } else {
            $time = date('H:i');
            $return = [
                'assign' => CustomHelpers::get_user_name($data->assign_id),
                'booking_guest_name' => $booking_guest_name,
                'booking_guest_mobile_no' => $booking_guest_mobile_no,
                'booking_guest_email_id' => $booking_guest_email_id,
                'amount' => $amount,
                'due_amount' => $due_amount,
                'payment_type_output' => $payment_type_output,
                'quote_ref_no' => $quote_ref_no,
                'time' => $time
            ];
            
            // Return the payment details as an array
            return $return;
        }
    }

    public function create_refund_amound(Request $request) {
        // Retrieve the query ID from the request
        $query_id = $request->id;
        
        // Find the query by its ID
        $data = Query::find($query_id);
        
        // Retrieve cancellation charge and guest details from the query
        $cancellation_charge = $data->cancellation_charge;
        $booking_guest_name = $data->name;
        $booking_guest_mobile_no = $data->mobile;
        $booking_guest_email_id = $data->email;
        
        // Retrieve quote details from the request
        $quote_no = $request->quote_no;
        $quote_id = $request->quote_id;
        
        // Initialize variables for quote-specific data
        $quote_ref_no = '';
        $price = 0;
        $amount = 0;
        $price_data = [];
        
        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote_id);
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
            $data = Option2Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }
        
        // Calculate amount and total refundable amount for refund
        $amount = $price_data['query_pricetopay_adult'];
        
        $total_refundable_amount = DB::table('refund_create')
            ->where('quote_ref_no', '=', $quote_ref_no)
            ->sum('refund_amount');
        
        $total_refundable = (int)$amount - (int)$total_refundable_amount;
        
        // Initialize payment type output (if needed)
        $payment_type_output = '';
        
        // Check if passengers exist for the quote
        $passengers_check = DB::table('rt_passengerinfo')->where('quotation_ref_no', $quote_ref_no)->first();
        
        // Handle different scenarios based on passenger check
        if (!$passengers_check) {
            return 'error';
        } else {
            $return = [
                'assign' => CustomHelpers::get_user_name($data->assign_id),
                'booking_guest_name' => $booking_guest_name,
                'booking_guest_mobile_no' => $booking_guest_mobile_no,
                'booking_guest_email_id' => $booking_guest_email_id,
                'amount' => $amount,
                'total_refundable' => $total_refundable,
                'quote_ref_no' => $quote_ref_no
            ];
            
            // Return the refund details as an array
            return $return;
        }
    }

    public function update_refund_create(Request $request) {
        // Retrieve and cast request parameters
        $query_id = (int)$request->query_id;
        $quote_no = (int)$request->quote_no_refund_create;
        $quote_id = (int)$request->quote_id_refund_create;
      
        // Initialize variables for quote-specific data
        $quote_ref_no = '';
        $price = 0;
        $price_data = [];
        
        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find($quote_id);
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
            $data = Option2Quotation::find($quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find($quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find($quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }
       
        // Calculate receiving amount and total refundable amount
        $receiving_amount = (int)$request->refund_amount + (int)$request->cancellation_charge;
        $amount = $price_data['query_pricetopay_adult'];

        $total_refundable_amount = DB::table('refund_create')
            ->where('quote_ref_no', '=', $quote_ref_no)
            ->sum('refund_amount');

        $total_refundable = (int)$amount - (int)$total_refundable_amount;

        // Check if receiving amount exceeds total refundable amount
        if ($receiving_amount > $total_refundable) {
            echo 'You Cannot Enter More Than Refundable Amount';
            die();
        } else {
            // Update query and payment details
            $query = Query::find($query_id);
            $query->status = 'refund_processed';
            $query->cancellation_charge = (int)$request->cancellation_charge;
            $query->save();

            // Create new refund entry
            $payment = new RefundCreate;
            $payment->quote_id = $data->id;
            $payment->quote_no = $quote_no;
            $payment->quote_ref_no = $quote_ref_no;
            $payment->cancellation_charge = (int)$request->cancellation_charge;
            $payment->refund_amount = (int)$request->refund_amount;
            $payment->remarks = $request->user_remarks;
            $payment->save();

            // Save enquiry tracker
            CustomHelpers::save_enquiry_tracker(
                $query_id,
                'Refund created for Rs. ' . (int)$request->refund_amount,
                Sentinel::getUser()->id,
                'refund_processed',
                $payment->id
            );

            echo 'success';
        }
    }

    public function add_refund_payment(Request $request) {
        // Retrieve and cast request parameters
        $query_id = $request->id;
        $data = Query::find($query_id);
        
        // Initialize variables for booking guest details and quote information
        $booking_guest_name = $data->name;
        $booking_guest_mobile_no = $data->mobile;
        $booking_guest_email_id = $data->email;
        $quote_no = $request->quote_no;
        $quote_id = $request->quote_id;
        
        // Initialize variables for quote-specific data
        $quote_ref_no = '';
        $price = 0;
        $price_data = [];

        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote_id);
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
            $data = Option2Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }

        // Calculate amount and refundable details
        $amount = $price_data['query_pricetopay_adult'];

        $total_refundable_amount = DB::table('refund_create')
            ->where('quote_ref_no', '=', $quote_ref_no)
            ->sum('refund_amount');

        $cancellation_charge = DB::table('refund_create')
            ->where('quote_ref_no', '=', $quote_ref_no)
            ->sum('cancellation_charge');

        $refunded_amounts = CustomHelpers::get_refunded_amount($quote_ref_no);
        $due_refund_amount = (int)$total_refundable_amount - (int)$refunded_amounts;

        // Prepare payment type options
        $payment_type_output = '';

        // Check if passengers check is empty
        $passengers_check = DB::table('rt_passengerinfo')->where('quotation_ref_no', $quote_ref_no)->first();
        if (!$passengers_check) {
            return 'error';
        }

        // Prepare return data
        $return = [
            'assign' => CustomHelpers::get_user_name($data->assign_id),
            'booking_guest_name' => $booking_guest_name,
            'booking_guest_mobile_no' => $booking_guest_mobile_no,
            'booking_guest_email_id' => $booking_guest_email_id,
            'amount' => $amount,
            'total_refundable_amount' => $total_refundable_amount,
            'refunded_amounts' => $refunded_amounts,
            'due_refund_amount' => $due_refund_amount,
            'cancellation_charge' => $cancellation_charge,
            'quote_ref_no' => $quote_ref_no,
        ];

        return $return;
    }

    public function update_refund_payments(Request $request) {
        $query_id = $request->query_id;
        $quote_no = $request->quote_no_refund_payment;
        $quote_id = $request->quote_id_refund_payment;

        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote_id);
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
            $data = Option2Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }

        $select_payment_type = $request->select_payment_type;
        $receiving_amount = $request->receiving_amount;
        $amount = $price_data['query_pricetopay_adult'];

        $total_refundable_amount = DB::table('refund_create')
            ->where('quote_ref_no', '=', $quote_ref_no)
            ->sum('refund_amount');

        $refunded_amounts = CustomHelpers::get_refunded_amount($quote_ref_no);
        $due_refund_amount = (int)$total_refundable_amount - (int)$refunded_amounts;

        // Check for negative amount
        if ((int)$request->receiving_amount < 0) {
            return 'You Can Not Enter Negative Amount';
        }

        // Check if receiving amount is greater than due refund amount
        if ($receiving_amount > $due_refund_amount) {
            return 'You Can Not Enter More Than Refundable Amount';
        }

        // Process payment and update database records
        $query_id = (int)$data->query_reference;
        $package_query = Query::find($query_id);
        $refund_no = CustomHelpers::get_receipt_no('refund', 1);

        $payment = new Payment;
        $payment->description = $package_query->service_type;
        $payment->quote_id = $data->id;
        $payment->pmt_no = $refund_no;
        $payment->quote_no = $quote_no;
        $payment->quote_ref_no = $quote_ref_no;
        $payment->amount = $receiving_amount;
        $payment->status = 1;
        $payment->transaction_type = 1;
        $payment->payment_type = 1;
        $payment->refund_remarks = $request->user_remarks;
        $payment->transaction_id = $request->payment_transaction_id;
        $payment->payment_mode = $request->payment_method;
        $payment->transaction_date = $request->receiving_amount_datetime;
        $payment->save();

        // Update query status and save
        $query_data = Query::find($query_id);
        $query_data->status = 'refund_processed';
        $query_data->cancellation_charge = $request->cancellation_charge;
        CustomHelpers::save_enquiry_tracker($query_id, 'Refund processed for Rs. ' . $receiving_amount, Sentinel::getUser()->id, 'refund_processed', $payment->id);
        $query_data->save();

        return 'success';
    }

    public function update_offline_payments(Request $request) {
        $query_id = (int)$request->query_id;
        $quote_no = (int)$request->quote_no_add_payment;
        $quote_id = (int)$request->quote_id_add_payment;

        // Determine quote details based on quote number
        if ($quote_no == 1) {
            $data = Option1Quotation::find((int)$quote_id);
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
            $data = Option2Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
        } elseif ($quote_no == 3) {
            $data = Option3Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
        } elseif ($quote_no == 4) {
            $data = Option4Quotation::find((int)$quote_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
        }

        $select_payment_type = $request->select_payment_type;
        $receiving_amount = $request->receiving_amount;
        $amount = $price_data['query_pricetopay_adult'];
        $part_type = '';

        // Check for negative amount
        if ((int)$receiving_amount < 0) {
            return 'You Can Not Enter Negative Amount';
        }

        // Handle full payment or part payment scenarios
        if ($select_payment_type == 'full') {
            $due_amount = CustomHelpers::get_remaining_due($quote_ref_no, $amount);
            if ((int)$receiving_amount > $due_amount) {
                return 'You Can Not Enter More Than Due Amount';
            } elseif ((int)$receiving_amount == (int)$due_amount) {
                $part_type = 'full';
            } else {
                $part_type = 'full_s';
            }
        } elseif ($select_payment_type != 'full' && $data->partPayment == 1) {
            $part_payments = unserialize($data->part_payments);
            $part_payments_sec = CustomHelpers::part_payments($data->part_payments, $price_data['query_pricetopay_adult']);

            // Handle advance, first, and second part payments
            if ($select_payment_type == 'advance' && $receiving_amount == $part_payments_sec['adv_amount']) {
                $part_type = '1';
            } elseif ($select_payment_type == 'advance' && $receiving_amount < $part_payments_sec['adv_amount']) {
                $part_type = '1_s';
            } elseif ($select_payment_type == 'advance' && $receiving_amount > $part_payments_sec['adv_amount']) {
                return 'You Can Not Enter More Than Advance Amount';
            } elseif ($select_payment_type == 'first' && $receiving_amount == $part_payments_sec['first_part_amount']) {
                $part_type = '2';
            } elseif ($select_payment_type == 'first' && $receiving_amount < $part_payments_sec['first_part_amount']) {
                $part_type = '2_s';
            } elseif ($select_payment_type == 'first' && $receiving_amount > $part_payments_sec['first_part_amount']) {
                return 'You Can Not Enter More Than 1st Part Payment';
            } elseif ($select_payment_type == 'second' && $receiving_amount == $part_payments_sec['second_part_amount']) {
                $part_type = '3';
            } elseif ($select_payment_type == 'second' && $receiving_amount < $part_payments_sec['second_part_amount']) {
                $part_type = '3_s';
            } elseif ($select_payment_type == 'second' && $receiving_amount > $part_payments_sec['second_part_amount']) {
                return 'You Can Not Enter More Than 2nd Part Payment';
            }
        } else {
            return 'Please Select Correct Payment Part';
        }

        // Process payment and update database records
        $query_id = $data->query_reference;
        $package_query = Query::find($query_id);
        $receipt_no = CustomHelpers::get_receipt_no('payment', 1);

        $payment = new Payment;

        $payment->receipt_id = $receipt_no;
        $payment->payment_mode = 'CASH';
        $payment->part_payment = $part_type;
        $payment->quote_id = $data->id;
        $payment->description = $package_query->service_type;
        $payment->quote_no = $quote_no;
        $payment->quote_ref_no = $quote_ref_no;
        $payment->amount = $receiving_amount;
        $payment->status = 1;
        $payment->payment_mode = $request->payment_method;
        $payment->transaction_date = $request->receiving_amount_datetime;
        $payment->transaction_id = $request->payment_transaction_id;

        $payment->payment_user_id = Sentinel::getUser()->id;
        $payment->payment_type = 1;
        $payment->due_follow_up_remarks = $request->user_remarks;

        if ($request->payment_follow_up_date_time != '') {
            $payment->payment_follow_up_date_time = $request->payment_follow_up_date_time;
        }

        $payment->save();

        // Update query status and save
        $query_data = Query::find($query_id);
        $due_amount = CustomHelpers::get_remaining_due($quote_ref_no, $amount);
        $check_first_payment = DB::table('rt_payments')
            ->where([['quote_ref_no', '=', $quote_ref_no], ['status', '=', 1], ['transaction_type', '=', 0]])
            ->get();

        if (count($check_first_payment) <= 1) {
            $query_data->status = 'process_booking';
        }

        $query_data->accept_quote_no = $quote_no;
        $query_data->accept_quote_id = $data->id;

        if ($due_amount <= 0) {
            $query_data->payment_status = 'Full Paid';
            CustomHelpers::save_enquiry_tracker($query_id, 'Full Paid', Sentinel::getUser()->id, 'Full Paid', $payment->id);
        } else {
            $query_data->payment_status = 'Partial Paid';
            CustomHelpers::save_enquiry_tracker($query_id, 'Partial Paid', Sentinel::getUser()->id, 'Partial Paid', $payment->id);
        }

        $query_data->save();

        $due_amount = CustomHelpers::get_remaining_due($quote_ref_no, $amount);

        if ($due_amount <= 0) {
            return 'full_pay';
        } else {
            return 'success';
        }
    }

    /*Handles updating payment follow-up based on request parameters*/
    public function update_payment_follow_up(Request $request) {
        $query_id = $request->query_id;
        $data = Query::find($query_id);
        $data->status = 'payment_follow_up';
        $data->save();

        $query = new PaymentFollowup;
        $query->remarks = $request->remarks;
        $query->follow_up_date = $request->follow_up_date;
        $query->follow_up_time = $request->follow_up_time;
        $query->enquiry_id = $data->id;
        $query->quote_id = $data->accept_quote_id;
        $query->quote_no = $data->accept_quote_no;
        $query->save();

        CustomHelpers::save_enquiry_tracker($query_id, 'Payment follow-up details', Sentinel::getUser()->id, 'payment_follow_up', $query->id);

        return 'success';
    }

    public function send_saved_quote(Request $request) {
        // Update main query status
        $quote_id= $request->id;
        $data= Quote::find($quote_id);
        $data->send_option = 1;
        $data->quote_view = 0;
        $data->save();
      

        $main_query = Query::find($data->query_reference);
        $main_query->quo_send = 1;
        $main_query->status = 'quote_sent';
        $main_query->save();


        // Send email to customer
        $reference = $data->quo_ref;
        $to = $main_query->email;
        $email = $main_query->email;

        Mail::send('query.mail.mail1', compact("data"), function ($message) use ($to, $reference) {
            $message->from($this->mail_from_sender);
            $message->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
        });

        // Send SMS notification
        $status = $this->quote_sms($data->mobile, $email, url('/quotes/' . $data->unique_code));

        // Save enquiry tracker
        CustomHelpers::save_enquiry_tracker($main_query->id, 'Quote Sent', Sentinel::getUser()->id, 'quote_sent');

        // Return success message based on SMS status
        if ($status == "success") {
            return 'success';
        } else {
            return 'success';
        }
    }

    /*public function saved_quote() {
      $check_data_lm=ActivateService::where('services','=','laed_manager')->first();
      if($check_data_lm->activation==1):

      $employee_id=Sentinel::getUser()->id;
      
      if(Sentinel::getUser()->roles()->first()->slug != 'employee'):

        $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id', '=','option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',0]])
       
        ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed','rt_package_query.enquiry_ref_no')
                  ->orderBy('created_at', 'desc')
                  ->get();
      else:
        $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id', '=','option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',0],['option1_quotation.assign_id','=',$employee_id]])
       
        ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed','rt_package_query.enquiry_ref_no')
                  ->orderBy('created_at', 'desc')

                  ->get();
  
      endif;
      $booking_lavel=LeadDynamicField::where([['field_type',8],['status',1]])->get();
     
        return view('query.savedquote.quotation',compact("data",'booking_lavel'));
        else:
       return response()->view('error.404', [], 404);
        endif;
    }*/

    public function saved_quote() {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            $employee_id = Sentinel::getUser()->id;

            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {

                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 0]
                    ])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.assign_id', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed', 'rt_package_query.enquiry_ref_no', 'rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name')
                    ->orderBy('created_at', 'desc')
                    ->get(); 

            } else {

                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 0],
                        ['quote.assign_id', '=', $employee_id]
                    ])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed', 'rt_package_query.enquiry_ref_no', 'rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.assign_id')
                    ->orderBy('created_at', 'desc')
                    ->get();

            }
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();
           $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            return view('query.savedquote.quotation', compact("data", 'booking_lavel','employee'));
        } else {
            return response()->view('error.404', [], 404);
        }
    }

    public function quotation() {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            $employee_id = Sentinel::getUser()->id;

            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['quote_sent'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->orderBy('created_at', 'desc')
                    ->get();

            } else {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['quote_sent'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
          $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'quote_sent';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            return view('query.quotation', compact("data", 'booking_lavel', 'val','employee'));
        } else {
            return response()->view('error.404', [], 404);
        }
    }


    /**
     * Handle the leads follow-up.
     */
    public function leads_follow_up() {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            $employee_id = Sentinel::getUser()->id;

            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['lead_follow_up', 'follow_up_pending'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }
 $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'lead_follow_ups';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            return response()->view('error.404', [], 404);
        }
    }


    /**
     * Handle the search leads functionality.
     */
    public function search_leads() {
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            $employee_id = Sentinel::getUser()->id;

            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', [
                        'quote_sent',
                        'lead_follow_up',
                        'follow_up_pending',
                        'process_booking',
                        'payment_follow_up',
                        'under_cancellation',
                        'issue_voucher'
                    ])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['option1_quotation.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', [
                        'quote_sent',
                        'lead_follow_up',
                        'follow_up_pending',
                        'process_booking',
                        'payment_follow_up',
                        'under_cancellation',
                        'issue_voucher'
                    ])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
          $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'quote_sent';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            return view('query.search_leads', compact("data", 'booking_lavel', 'val','employee'));
        } else {
            return response()->view('error.404', [], 404);
        }
    }


    /**
    * Handle the raise concern functionality.
    */
    public function raise_concern() {
        // Check if the lead manager service is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            // Get the ID of the currently logged-in employee
            $employee_id = Sentinel::getUser()->id;

            // Check if the user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch data for non-employees
                $data = DB::table('quote_raise_concern')
                    ->join('quote', 'quote.query_reference', '=', 'quote_raise_concern.query_reference')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('quote_raise_concern.status', [0, 1])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no')
                    ->get();

                    
            } else {
                // Query to fetch data for employees
                $data = DB::table('quote_raise_concern')
                    ->join('quote', 'quote.query_reference', '=', 'quote_raise_concern.query_reference')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote_raise_concern.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('quote_raise_concern.status', [0, 1])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.date_arrival', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no')
                    ->get();
            }

            // Fetch booking level information
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with the data and booking level information
            return view('query.raise_concern_page', compact("data", "booking_lavel"));
        } else {
            // If the lead manager service is not activated, return a 404 error view
            return response()->view('error.404', [], 404);
        }
    }


    /*Handle the booking hold (blocked booking) functionality*/
    public function booking_hold() {
        // Check if the lead manager service is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();
        if ($check_data_lm->activation == 1) {

            // Get the ID of the currently logged-in employee
            $employee_id = Sentinel::getUser()->id;

            // Check if the user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch data for non-employees
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->join('rt_payments', 'rt_payments.quote_ref_no', '=', 'quote.quo_ref')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_booking'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->orderBy('rt_payments.created_at', 'desc')
                    ->distinct()
                    ->get();
            } else {
                // Query to fetch data for employees
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_booking'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Set the booking status value
            $val = 'process_booking';
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            // Fetch booking level information
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with the data, booking level information, and status value
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // If the lead manager service is not activated, return a 404 error view
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Prepare and display the form to send an email to the supplier for a non-sent query.
     */
    public function send_supplier_email_non_send($query_id) {
        // Find the query data by query ID
        $data = Query::find($query_id);
        
        // Retrieve the package name using a custom helper function
        $package_name = CustomHelpers::get_package_name($data->packageId);
        
        // Get all quotation footers
        $quotation_footer = QuotationFooter::all();
        
        // Set the query ID and quotation reference
        $query_id = $query_id;
        $quo_ref = '';

        // Return the view with the necessary data
        return view('query.send_supplier_email.index', compact('data', 'package_name', 'quotation_footer', 'query_id', 'quo_ref'));
    }

    /**
     * Sends supplier email based on the quotation reference.
     */
    public function send_supplier_email($quo_ref) {
        // Retrieve the quotation based on the quotation reference
        $quotation = Option1Quotation::where('quo_ref', $quo_ref)->first();
        
        // Retrieve the query data based on the query reference from the quotation
        $data = Query::find($quotation->query_reference);
        
        // Get the package name using a custom helper function
        $package_name = CustomHelpers::get_package_name($data->packageId);
        
        // Get the query ID from the quotation's query reference
        $query_id = $quotation->query_reference;
        
        // Retrieve all quotation footers
        $quotation_footer = QuotationFooter::all();
        
        // Return the view with the retrieved data
        return view('query.send_supplier_email.index', compact('data', 'package_name', 'quotation_footer', 'quo_ref', 'query_id'));
    }

    /**
     * Submits the supplier email by saving the email details and sending the email.
     */
    public function submit_supplier_email(Request $request) {
        // Process and format the 'to' email addresses
        $to = str_replace(' ', '', $request->to);
        $to = explode(",", $to);

        // Process and format the 'cc' email addresses if provided
        $cc = '';
        if ($request->cc != '') {
            $cc = str_replace(' ', '', $request->cc);
            $cc = explode(",", $cc);
        }

        // Process and format the 'bcc' email addresses if provided
        $bcc = '';
        if ($request->bcc != '') {
            $bcc = str_replace(' ', '', $request->bcc);
            $bcc = explode(",", $bcc);
        }

        // Retrieve or create a new SupplierEmail record
        $data = SupplierEmail::where('quo_ref', $request->quo_ref)->first();
        if ($data == '') {
            $data = new SupplierEmail;
        }

        // Populate the SupplierEmail record with request data
        $data->query_id = $request->query_id;
        $data->quo_ref = $request->quo_ref;
        if ($to != '') {
            $data->to = serialize($to);
        }
        if ($cc != '') {
            $data->cc = serialize($cc);
        }
        if ($bcc != '') {
            $data->bcc = serialize($bcc);
        }
        $data->subject = $request->subject;
        $data->description = $request->description;
        $data->email_footer = $request->email_footer;

        // Save the SupplierEmail record
        $data->save();

        // Send the email using the Mail facade
        $subject = $request->subject;
        Mail::send('query.send_supplier_email.mail', compact("data"), function($message1) use ($to, $cc, $bcc, $subject) {
            $message1->from($this->mail_from_sender);
            $message1->to($to)->subject($subject);

            // Add 'cc' and 'bcc' recipients if provided
            if ($cc != '') {
                $message1->cc($cc);
            }
            if ($bcc != '') {
                $message1->bcc($bcc);
            }
        });

        // Retrieve all supplier data and redirect with a success message
        $supplierdata = Supplier::all();
        return redirect(route('supplierEmailList'))->with('success', 'Email sent successfully');
    }

    /**
     * Searches for suppliers by their primary email address and returns matching results.
     */
    public function supplier_to_email_search(Request $request) {
        // Search for suppliers whose primary email addresses start with the search query
        $data = Supplier::where('supplierprimaryemail', 'LIKE', $request->to . '%')->get();
        
        $output = '';

        // If there are matching suppliers, generate a list of email addresses
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display:block; position:relative; z-index:1;">';
            
            foreach ($data as $d) {
                $output .= '<li class="list-group-item">' . $d->supplierprimaryemail . '</li>';
            }
            
            $output .= "</ul>";
        } else {
            // If no matching suppliers found, display a message
            $output .= '<li class="list-group-item">No Data Found</li>';
        }

        // Return the generated HTML content
        return $output;
    }


    /**
     * Resends a supplier email based on the stored details in the database.
     */
    public function resend_supplier_email(Request $request) {
        // Retrieve the email ID from the request
        $id = $request->id;

        // Find the SupplierEmail record by ID
        $data = SupplierEmail::find($id);

        // Initialize variables for recipients and unserialize them if they exist
        $to = ($data->to != '') ? unserialize($data->to) : '';
        $cc = ($data->cc != '') ? unserialize($data->cc) : '';
        $bcc = ($data->bcc != '') ? unserialize($data->bcc) : '';

        // Extract subject from the SupplierEmail record
        $subject = $data->subject;

        // Send the email using Mail::send
        Mail::send('query.send_supplier_email.mail', compact("data"), function($message) use ($to, $cc, $bcc, $subject) {
            $message->from($this->mail_from_sender);

            // Set recipients and subject based on presence of CC and BCC
            if ($cc == '' && $bcc == '') {
                $message->to($to)->subject($subject);
            } elseif ($cc != '' && $bcc == '') {
                $message->to($to)->subject($subject)->cc($cc);
            } elseif ($cc == '' && $bcc != '') {
                $message->to($to)->subject($subject)->bcc($bcc);
            } elseif ($cc != '' && $bcc != '') {
                $message->to($to)->subject($subject)->cc($cc)->bcc($bcc);
            }
        });

        // Output success message
        echo 'success';
    }

    /**
     * Resends a supplier email (non-lead) based on the stored details in the database.
     */
    public function resend_supplier_email_non_lead(Request $request) {
        // Retrieve the email ID from the request
        $id = $request->id;

        // Find the SupplierEmailNonLead record by ID
        $data = SupplierEmailNonLead::find($id);

        // Initialize variables for recipients, CC, BCC, and attachment paths, unserializing them if they exist
        $to = ($data->to != '') ? unserialize($data->to) : '';
        $cc = ($data->cc != '') ? unserialize($data->cc) : '';
        $bcc = ($data->bcc != '') ? unserialize($data->bcc) : '';
        $path = ($data->attachment != '') ? url('/').'/public/uploads/email/attachments/'.$data->attachment : '';

        // Extract subject and from_email_name from the SupplierEmailNonLead record
        $subject = $data->subject;
        $from_email_name = $data->from_email_name;

        // Send the email using Mail::send
        if ($path == '') {
            Mail::send('query.send_supplier_email.mail', compact("data"), function($message) use ($to, $cc, $bcc, $subject, $from_email_name) {
                $message->from($this->mail_from_sender, $from_email_name);

                // Set recipients and subject based on presence of CC and BCC
                if ($cc == '' && $bcc == '') {
                    $message->to($to)->subject($subject);
                } elseif ($cc != '' && $bcc == '') {
                    $message->to($to)->subject($subject)->cc($cc);
                } elseif ($cc == '' && $bcc != '') {
                    $message->to($to)->subject($subject)->bcc($bcc);
                } elseif ($cc != '' && $bcc != '') {
                    $message->to($to)->subject($subject)->cc($cc)->bcc($bcc);
                }
            });
        } else {
            $files = [$path];
            Mail::send('query.send_supplier_email.mail', compact("data"), function($message) use ($to, $cc, $bcc, $subject, $from_email_name, $files) {
                $message->from($this->mail_from_sender, $from_email_name);

                // Set recipients and subject based on presence of CC and BCC
                if ($cc == '' && $bcc == '') {
                    $message->to($to)->subject($subject);
                } elseif ($cc != '' && $bcc == '') {
                    $message->to($to)->subject($subject)->cc($cc);
                } elseif ($cc == '' && $bcc != '') {
                    $message->to($to)->subject($subject)->bcc($bcc);
                } elseif ($cc != '' && $bcc != '') {
                    $message->to($to)->subject($subject)->cc($cc)->bcc($bcc);
                }

                // Attach files to the email
                foreach ($files as $file) {
                    $message->attach($file);
                }
            });
        }

        // Output success message
        echo 'success';
    }

    /*Handles submission of supplier email (non-lead) form data and sends the email.*/
    public function supplier_email_submit_non_lead(Request $request) {
        // Clean and explode recipient emails from input
        $to = str_replace(' ', '', $request->to);
        $to = explode(",", $to);

        // Clean and explode CC emails from input
        $cc = '';
        if ($request->cc != '') {
            $cc = str_replace(' ', '', $request->cc);
            $cc = explode(",", $cc);
        }

        // Clean and explode BCC emails from input
        $bcc = '';
        if ($request->bcc != '') {
            $bcc = str_replace(' ', '', $request->bcc);
            $bcc = explode(",", $bcc);
        }

        // Create a new SupplierEmailNonLead instance
        $data = new SupplierEmailNonLead;

        // Generate a random quotation reference number and assign it to quo_ref
        $quo_ref = rand(1000, 1000000);
        $data->quo_ref = $quo_ref;

        // Serialize and store recipient, CC, and BCC if provided
        if ($to != '') {
            $data->to = serialize($to);
        }
        if ($cc != '') {
            $data->cc = serialize($cc);
        }
        if ($bcc != '') {
            $data->bcc = serialize($bcc);
        }

        // Handle file attachment if uploaded
        $path = '';
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $quo_ref . $file->getClientOriginalName();
            $path = url('/').'/public/uploads/email/attachments/'.$filename;
            $file->move(public_path().'/uploads/email/attachments/', $filename);
            $data->attachment = $filename;
        }

        // Assign other fields from the request
        $data->from_email_name = $request->from_email_name;
        $data->subject = $request->subject;
        $data->description = $request->description;
        $data->email_footer = $request->email_footer;

        // Save the SupplierEmailNonLead instance to the database
        $data->save();

        // Prepare email details
        $subject = $request->subject;

        if ($path == '') {
            Mail::send('query.send_supplier_email.mail', compact("data"), function($message) use ($to, $cc, $bcc, $subject, $data) {
                $message->from($this->mail_from_sender, $data->from_email_name);
                if ($cc != '') {
                    $message->cc($cc);
                }
                if ($bcc != '') {
                    $message->bcc($bcc);
                }
                $message->to($to)->subject($subject);
            });
        } else {
            $files = [$path];
            Mail::send('query.send_supplier_email.mail', compact("data"), function($message) use ($to, $cc, $bcc, $subject, $files, $data) {
                $message->from($this->mail_from_sender, $data->from_email_name);
                if ($cc != '') {
                    $message->cc($cc);
                }
                if ($bcc != '') {
                    $message->bcc($bcc);
                }
                $message->to($to)->subject($subject);
                foreach ($files as $file) {
                    $message->attach($file);
                }
            });
        }


        // Redirect back with success message
        return redirect(route('supplierEmailComposedList'))->with('success', 'Email sent successfully');
    }

    /*Retrieves quotations that require payment follow-up and displays them.*/
    public function payment() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['payment_follow_up'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['payment_follow_up'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'payment_follow_up';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Retrieves quotations under cancellation status and displays them.
     */
    public function under_cancellation() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['under_cancellation'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['under_cancellation'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'under_cancellation';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /* Displays the booking calendar view*/
    public function booking_calendar() {
        return view('query.booking_calendar');
    }

    /**
     * Retrieves data for booking calendar.
     * 
     * @return string JSON-encoded calendar data
     */
    public function get_booking_cal_data() {
        // Check if the service 'lead_manager' is activated (currently unused)
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Get the current user's ID
        $employee_id = Sentinel::getUser()->id;

        // Initialize an empty data collection
        $data = [];

        // Check the user's role to determine which query to run
        if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
            // Non-employee query: Fetch relevant quotations
            $data = DB::table('option1_quotation')
                ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                ->where([
                    ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                    ['option1_quotation.del_status', '=', 1],
                    ['option1_quotation.send_option', '=', 1]
                ])
                ->whereIn('rt_package_query.status', ['process_booking', 'payment_follow_up', 'issue_voucher', 'voucher_issued'])
                ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed')
                ->get();
        } else {
            // Employee query: Fetch quotations assigned to the current employee
            $data = DB::table('option1_quotation')
                ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                ->where([
                    ["option1_quotation.webnotation", "=", env("WEBSITENAME")],
                    ['option1_quotation.assign_id', '=', $employee_id],
                    ['option1_quotation.del_status', '=', 1],
                    ['option1_quotation.send_option', '=', 1]
                ])
                ->whereIn('rt_package_query.status', ['process_booking', 'payment_follow_up', 'issue_voucher', 'voucher_issued'])
                ->select('option1_quotation.*', 'rt_package_query.destinations', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed')
                ->get();
        }

        // Prepare calendar data
        $calendar_data = [];
        foreach ($data as $d) {
            $calendar_data[] = [
                'title' => $d->quo_ref,                   // Quotation reference as the event title
                'unique_code' => $d->unique_code,         // Unique code for the event
                'start' => date('Y-m-d', strtotime($d->date_arrival))  // Start date of the event
            ];
        }

        // Log calendar data for debugging (optional)
        Log::info('Calendar Data:', $calendar_data);

        // Return JSON-encoded calendar data
        return json_encode($calendar_data);
    }

    /**
     * Displays quotations under 'issue_voucher' status.
     */
    public function confirmation() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['issue_voucher'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['issue_voucher'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $val = 'confirmation';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Displays quotations under 'voucher_issued' status.
     * 
     * @return \Illuminate\Http\Response
     */
    public function vouchers() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['voucher_issued'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['voucher_issued'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view

            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();

            $val = 'voucher_issued';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Displays quotations under 'tour_cancelled' status.
     * 
     * @return \Illuminate\Http\Response
     */
    public function tour_cancelled() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['tour_cancelled'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['tour_cancelled'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view
            $val = 'tour_cancelled';
             $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();

            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Displays quotations under 'process_refund', 'refund_processed', 'refund_under_process' statuses.
     */
    public function refund_issued() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;
            
            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch quotations for non-employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            } else {
                // Query to fetch quotations for employee users
                $data = DB::table('quote')
                    ->join('rt_package_query', 'rt_package_query.id', '=', 'quote.query_reference')
                    ->where([
                        ["quote.webnotation", "=", env("WEBSITENAME")],
                        ['quote.assign_id', '=', $employee_id],
                        ['quote.del_status', '=', 1],
                        ['quote.send_option', '=', 1]
                    ])
                    ->whereIn('rt_package_query.status', ['process_refund', 'refund_processed', 'refund_under_process'])
                    ->select('quote.*', 'rt_package_query.destinations', 'rt_package_query.date_arrival', 'rt_package_query.booking_label', 'rt_package_query.span_value_child_without_bed','rt_package_query.mobile as mobile', 'rt_package_query.email as email', 'rt_package_query.name as name', 'rt_package_query.country_of_residence', 'rt_package_query.packageId', 'rt_package_query.enquiry_ref_no', 'rt_package_query.assign_id')
                    ->get();
            }

            // Prepare data for the view
            $val = 'refund_issued';
            $booking_lavel = LeadDynamicField::where([['field_type', 8], ['status', 1]])->get();
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();
            // Return the view with data
            return view('query.quotation', compact("data", "booking_lavel", "val",'employee'));
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Displays cancelled leads based on user role and service activation status.
     */
    public function cancelled_leads() {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;

            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch queries for non-employee users
                $queries = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                // Query to fetch queries for employee users
                $queries = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['assign_id', '=', $employee_id],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['booked_with_other', 'quote_rejected', 'no_response', 'lead_cancelled'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // Fetch all users with role ID 15 (assuming 15 is the role ID for employee role)
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();

            // Return the view with data
            return view('query.cancelleads.index', ['queries' => $queries, 'employee' => $employee]);
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**
     * Handles the post tour completion requests based on user role and service activation status.
     */
    public function post_tour(Request $request) {
        // Check if the service 'laed_manager' is activated
        $check_data_lm = ActivateService::where('services', '=', 'laed_manager')->first();

        // Check if the service is activated
        if ($check_data_lm && $check_data_lm->activation == 1) {
            // Get the current user's ID
            $employee_id = Sentinel::getUser()->id;

            // Determine if the current user is not an employee
            if (Sentinel::getUser()->roles()->first()->slug != 'employee') {
                // Query to fetch queries for non-employee users
                $queries = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['tour_completed'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                // Query to fetch queries for employee users
                $queries = Query::where([
                        ['webnotation', '=', env("WEBSITENAME")],
                        ['assign_id', '=', $employee_id],
                        ['delete_status', '=', 1]
                    ])
                    ->whereIn('status', ['tour_completed'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // Fetch all users with role ID 15 (assuming 15 is the role ID for employee role)
            $role = Sentinel::findRoleById(15);
            $employee = $role->users()->with('roles')->get();

            // Return the view with data
            return view('query.tourcomplete.index', ['queries' => $queries, 'employee' => $employee]);
        } else {
            // Return a 404 error response if the service is not activated
            return response()->view('error.404', [], 404);
        }
    }

    /**********************/

    /*public function send_voucher_file(Request $request) { 
     $this->validate($request,[
            "voucher"=>"required"]);
      $vouchers=$request->file('voucher');
      $filenames=[];
      foreach($vouchers as $voucher):
       $filename= uniqid(). $voucher->getClientOriginalName();
       $path = '/uploads/voucher/'.$filename;
        //move the file to correct location
       $voucher->move(public_path().'/uploads/voucher/', $filename);
       $filenames[]=$filename;
      endforeach;
      $data=Query::find($request->lead_id);
      $voucher_data=new Voucher;
      $voucher_data->lead_id=$request->lead_id;
      $voucher_data->file_type=$request->file_type;
      $voucher_data->voucher=serialize($filenames);
     $file_type=$request->file_type;
     if($file_type==0)
     {
     $subject='Reservation Voucher';
     }
     elseif($file_type==1)
     {
     $subject='Reservation TCS';
     }
     elseif($file_type==2)
     {
      $subject='Reservation Invoice';  
     }
    
     if($voucher_data->save()):
     Mail::send('query.voucher.mail',compact("data",'file_type'),function($message) use ($data,$filenames,$subject)
       {
      $message->from($this->mail_from_reservations);
      $message->to($data->email)->subject($subject);
      foreach($filenames as $filen):
        $file_path=public_path().'/'.('uploads/voucher/'.$filen);
        $message->attach($file_path);
       endforeach;
      });
     CustomHelpers::save_enquiry_tracker($request->lead_id,$subject,Sentinel::getUser()->id,'voucher_sent');

     return redirect()->back()->with("success","File have been sent successfully");
      endif;
    }*/

    /*public function send_voucher_file(Request $request) {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'voucher' => 'required|array',
            'lead_id' => 'required|exists:queries,id',
            'file_type' => 'required|integer'
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve voucher files
        $vouchers = $request->file('voucher');
        $filenames = [];

        // Upload each voucher file
        foreach ($vouchers as $voucher) {
            $filename = uniqid() . $voucher->getClientOriginalName();
            $voucher->move(public_path('/uploads/voucher/'), $filename);
            $filenames[] = $filename;
        }

        // Fetch query data
        $data = Query::find($request->lead_id);

        // Create new Voucher record
        $voucher_data = new Voucher;
        $voucher_data->lead_id = $request->lead_id;
        $voucher_data->file_type = $request->file_type;
        $voucher_data->subject = $request->subject;
        $voucher_data->voucher = serialize($filenames);

        // Determine subject based on file type
        switch ($request->file_type) {
            case 0:
                $subject = 'Reservation Voucher';
                break;
            case 1:
                $subject = 'Reservation TCS';
                break;
            case 2:
                $subject = 'Reservation Invoice';
                break;
            default:
                $subject = 'Reservation Document';
                break;
        }

        // Save voucher data and send email with attachments
        if ($voucher_data->save()) {
            Mail::send('query.voucher.mail', compact("data", 'file_type'), function ($message) use ($data, $filenames, $subject) {
                $message->from($this->mail_from_reservations);
                $message->to($data->email)->subject($subject);
                foreach ($filenames as $filen) {
                    $file_path = public_path('/uploads/voucher/' . $filen);
                    $message->attach($file_path);
                }
            });

            // Save entry in enquiry tracker
            CustomHelpers::save_enquiry_tracker($request->lead_id, $subject, Sentinel::getUser()->id, 'voucher_sent');

            return redirect()->back()->with("success", "Files have been sent successfully");
        }

        // Redirect back with error if saving fails
        return redirect()->back()->with("error", "Failed to send files");
    }*/

    public function send_voucher_file(Request $request) {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'voucher' => 'required|array',
            'lead_id' => 'required|exists:queries,id',
            'file_type' => 'required|integer',
            'subject' => 'required|string|max:255', // Ensure subject is required and is a string
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve voucher files
        $vouchers = $request->file('voucher');
        $filenames = [];

        // Upload each voucher file
        foreach ($vouchers as $voucher) {
            $filename = uniqid() . '_' . $voucher->getClientOriginalName(); // Prefix filenames with unique ID
            $voucher->move(public_path('/uploads/voucher/'), $filename);
            $filenames[] = $filename;
        }

        // Fetch query data
        $data = Query::find($request->lead_id);

        // Create new Voucher record
        $voucher_data = new Voucher;
        $voucher_data->lead_id = $request->lead_id;
        $voucher_data->file_type = $request->file_type;
        $voucher_data->subject = $request->subject;
        $voucher_data->voucher = serialize($filenames);

        // Determine subject based on file type
        switch ($request->file_type) {
            case 0:
                $subject = 'Reservation Voucher';
                break;
            case 1:
                $subject = 'Reservation TCS';
                break;
            case 2:
                $subject = 'Reservation Invoice';
                break;
            default:
                $subject = 'Reservation Document';
                break;
        }

        // Save voucher data and send email with attachments
        if ($voucher_data->save()) {
            Mail::send('query.voucher.mail', compact('data', 'file_type'), function ($message) use ($data, $filenames, $subject) {
                $message->from($this->mail_from_reservations); // Ensure $this->mail_from_reservations is defined
                $message->to($data->email)->subject($subject);
                foreach ($filenames as $filename) {
                    $file_path = public_path('/uploads/voucher/' . $filename);
                    $message->attach($file_path);
                }
            });

            // Save entry in enquiry tracker
            CustomHelpers::save_enquiry_tracker($request->lead_id, $subject, Sentinel::getUser()->id, 'voucher_sent');

            return redirect()->back()->with("success", "Files have been sent successfully");
        }

        // Redirect back with error if saving fails
        return redirect()->back()->with("error", "Failed to send files");
    }

    /**********************/

    // voucher list
    /*public function voucherlist(Request $request) {
      $data=Voucher::where('lead_id','=',$request->id)->get();
      if(count($data)!="" && count($data)!="0"):
        $output="";
        $output.="<table class='table table-striped'><tr>
        <th>S.No.</th>
        <th>File Type</th>
        <th>File</th>
        <th>Date</th>
        </tr>";
        $i=0;
        foreach($data as $datas):
          $voucher=unserialize($datas->voucher);
          $date = date("d M Y H:i", strtotime($datas->created_at));
          $file_type=$datas->file_type;
          if($file_type==0)
     {
     $subject='Voucher';
     }
     elseif($file_type==1)
     {
     $subject='TCS';
     }
     elseif($file_type==2)
     {
      $subject='Invoice';  
     }
     foreach($voucher as $vouchers):

             $i++;
             $path=url('/public/uploads/voucher/'.$vouchers);
             $output.="<tr>
             <td>$i</td>
             <td>$subject</td>
             <td><a href='$path' download>Download</a></td>
              <td>$date</td>";
           
             $output.="</tr>";
          endforeach;
         
        endforeach;
         $output.="</table>";
        echo "$output";
      else:
        echo "Data Not Found";
      endif;
    }*/

    /*public function voucherlist(Request $request) {
        // Retrieve vouchers associated with the lead_id
        $data = Voucher::where('lead_id', $request->id)->get();

        // Check if vouchers are found
        if (count($data) > 0) {
            $output = "<table class='table table-striped'><tr>
                <th>S.No.</th>
                <th>File Type</th>
                <th>Subject</th>
                <th>File</th>
                <th>Date</th>
                </tr>";
            $i = 0;

            // Iterate through each voucher data
            foreach ($data as $datas) {
                $voucher = unserialize($datas->voucher);
                $date = date("d M Y H:i", strtotime($datas->created_at));
                $file_type = $datas->file_type;

                // Determine subject based on file_type
                switch ($file_type) {
                    case 0:
                        $subject = 'Voucher';
                        break;
                    case 1:
                        $subject = 'TCS';
                        break;
                    case 2:
                        $subject = 'Invoice';
                        break;
                    default:
                        $subject = 'Unknown';
                        break;
                }

                // Iterate through each voucher file
                foreach ($voucher as $vouchers) {
                    $i++;
                    $path = url('/uploads/voucher/' . $vouchers);
                    $output .= "<tr>
                        <td>$i</td>
                        <td>$subject</td>
                        <td>$datas->subject</td>
                        <td><a href='$path' download>Download</a></td>
                        <td>$date</td>
                        </tr>";
                }
            }

            $output .= "</table>";
            return $output;
        } else {
            return "Data Not Found";
        }
    }*/

    /*public function voucherlist(Request $request) {
        // Retrieve vouchers associated with the lead_id
        $data = Voucher::where('lead_id', $request->id)->get();

        // Check if vouchers are found
        if (count($data) > 0) {
            $output = "<table class='table table-striped'><tr>
                <th>S.No.</th>
                <th>File Type</th>
                <th>Subject</th>
                <th>File</th>
                <th>Date</th>
                </tr>";
            $i = 0;

            // Iterate through each voucher data
            foreach ($data as $datas) {
                $voucher = unserialize($datas->voucher);
                $date = date("d M Y H:i", strtotime($datas->created_at));
                $file_type = $datas->file_type;
                $subject = $datas->subject; // Add this line if `subject` is a property of `Voucher` model

                // Determine subject based on file_type
                switch ($file_type) {
                    case 0:
                        $file_type_text = 'Voucher';
                        break;
                    case 1:
                        $file_type_text = 'TCS';
                        break;
                    case 2:
                        $file_type_text = 'Invoice';
                        break;
                    default:
                        $file_type_text = 'Unknown';
                        break;
                }

                // Iterate through each voucher file
                foreach ($voucher as $vouchers) {
                    $i++;
                    $path = url('/uploads/voucher/' . $vouchers);
                    $output .= "<tr>
                        <td>$i</td>
                        <td>$file_type_text</td>
                        <td>$subject</td> <!-- This is where the subject is added -->
                        <td><a href='$path' download>Download</a></td>
                        <td>$date</td>
                    </tr>";
                }
            }

            $output .= "</table>";
            return $output;
        } else {
            return "Data Not Found";
        }
    }*/

    public function voucherlist(Request $request) {
        // Retrieve vouchers associated with the lead_id
        $data = Voucher::where('lead_id', $request->id)->get();

        // Check if vouchers are found
        if ($data->isNotEmpty()) {
            $output = "
            <table class='table table-striped'>
                <tr>
                    <th>S.No.</th>
                    <th>File Type</th>
                    <th>Subject</th>
                    <th>File</th>
                    <th>Date</th>
                </tr>";
            $i = 0;

            // Iterate through each voucher data
            foreach ($data as $datas) {
                $voucher = @unserialize($datas->voucher); // Use @ to suppress errors and handle invalid serialization
                if ($voucher === false && $datas->voucher !== 'b:0;') {
                    // Handle serialization error
                    continue;
                }
                $date = date("d M Y H:i", strtotime($datas->created_at));
                $file_type = $datas->file_type;
                $subject = $datas->subject; // Assuming `subject` is a property of `Voucher` model

                // Determine subject based on file_type
                switch ($file_type) {
                    case 0:
                        $file_type_text = 'Voucher';
                        break;
                    case 1:
                        $file_type_text = 'TCS';
                        break;
                    case 2:
                        $file_type_text = 'Invoice';
                        break;
                    default:
                        $file_type_text = 'Unknown';
                        break;
                }

                // Iterate through each voucher file
                foreach ($voucher as $vouchers) {
                    $i++;
                    $path = url('/uploads/voucher/' . htmlspecialchars($vouchers, ENT_QUOTES, 'UTF-8')); // Sanitize file path
                    $output .= "
                    <tr>
                        <td>{$i}</td>
                        <td>{$file_type_text}</td>
                        <td>{$subject}</td>
                        <td><a href='{$path}' download>Download</a></td>
                        <td>{$date}</td>
                    </tr>";
                }
            }

            $output .= "</table>";
            return $output;
        } else {
            return "Data Not Found";
        }
    }

    /**********************/

    // resend vouchers
    /*public function resend_voucher_file(Request $request)
    {
        $file_type=$request->file_type;
     if($file_type==0)
     {
     $subject='Reservation Voucher';
     }
     elseif($file_type==1)
     {
     $subject='Reservation TCS';
     }
     elseif($file_type==2)
     {
      $subject='Reservation Invoice';  
     }
    
      $data=Voucher::where([['lead_id','=',$request->lead_id],['file_type',$file_type]])->get();
      $to=CustomHelpers::get_query_field($request->lead_id,'email');

      if(count($data)!="" && count($data)!="0"):
       $vouchers_data=[];
        foreach($data as $datas):
          $voucher=unserialize($datas->voucher);
          
          foreach($voucher as $vouchers):
           $vouchers_data[]=$vouchers; 
          endforeach;
         
        endforeach;

          Mail::send('query.voucher.mail',compact("data",'file_type'),function($message) use ($to,$vouchers_data,$subject)
       {
      $message->from($this->mail_from_reservations);
      $message->to($to)->subject($subject);
      foreach($vouchers_data as $filen):
        $file_path=public_path().'/'.('uploads/voucher/'.$filen);
        $message->attach($file_path);
       endforeach;
      });
           CustomHelpers::save_enquiry_tracker($request->lead_id,$subject,Sentinel::getUser()->id,'voucher_resent');

       return redirect()->back()->with("success","File have been sent successfully");
      
      endif;
    }*/

    // resend voucher
    public function resend(Request $request) {
        // Retrieve vouchers based on file_type for the given lead_id
        $data_voucher = Voucher::where([['lead_id', '=', $request->id], ['file_type', 0]])->get();
        $data_tcs = Voucher::where([['lead_id', '=', $request->id], ['file_type', 1]])->get();
        $data_invoice = Voucher::where([['lead_id', '=', $request->id], ['file_type', 2]])->get();

        // Initialize output HTML
        $output = '<label>File Type</label>
            <select class="form-control" name="file_type" required>
                <option value="">--Select--</option>';

        // Add options based on the presence of vouchers
        if (count($data_voucher) > 0) {
            $output .= '<option value="0">Voucher</option>';
        }
        if (count($data_tcs) > 0) {
            $output .= '<option value="1">TCS</option>';
        }
        if (count($data_invoice) > 0) {
            $output .= '<option value="2">Invoice</option>';
        }

        // Close the select element
        $output .= '</select>';

        // Output the HTML
        echo $output;
    }
    
    /**********************/

    public function resend_voucher_file(Request $request) {
        $file_type = $request->file_type;

        // Determine subject based on file_type
        switch ($file_type) {
            case 0:
                $subject = 'Reservation Voucher';
                break;
            case 1:
                $subject = 'Reservation TCS';
                break;
            case 2:
                $subject = 'Reservation Invoice';
                break;
            default:
                return redirect()->back()->with("error", "Invalid file type selected.");
        }

        // Retrieve vouchers based on lead_id and file_type
        $data = Voucher::where([
            ['lead_id', '=', $request->lead_id],
            ['file_type', '=', $file_type]
        ])->get();

        // Get recipient email address
        $to = CustomHelpers::get_query_field($request->lead_id, 'email');

        // Process if vouchers exist
        if (count($data) > 0) {
            $vouchers_data = [];

            // Extract voucher filenames
            foreach ($data as $datas) {
                $voucher = unserialize($datas->voucher);
                foreach ($voucher as $vouchers) {
                    $vouchers_data[] = $vouchers;
                }
            }

            // Send email with attachments
            Mail::send('query.voucher.mail', compact("data", 'file_type'), function ($message) use ($to, $vouchers_data, $subject) {
                $message->from($this->mail_from_reservations);
                $message->to($to)->subject($subject);
                foreach ($vouchers_data as $filen) {
                    $file_path = public_path() . '/uploads/voucher/' . $filen;
                    $message->attach($file_path);
                }
            });

            // Save activity in enquiry tracker
            CustomHelpers::save_enquiry_tracker($request->lead_id, $subject, Sentinel::getUser()->id, 'voucher_resent');

            return redirect()->back()->with("success", "File has been sent successfully");
        } else {
            return redirect()->back()->with("error", "No vouchers found for the selected file type.");
        }
    }

    public function deleted_leads() {
        $check_data = ActivateService::where('services', '=', 'leads')->first();
        if ($check_data && $check_data->activation == 1) {
            $queries = Query::where([
                ['webnotation', '=', env("WEBSITENAME")],
                ['delete_status', '=', 0]
            ])->orderBy('created_at', 'desc')->get();

            return view('query.deleteleads.index', ['queries' => $queries]);
        } else {
            return response()->view('error.404', [], 404);
        }
    }

    // recover lead
    /*public function recover_lead(Request $request)
    {
     $query_id=$request->id;

     $assign_data1=Option1Quotation::where('query_reference','=',$query_id)->first();
      if($assign_data1!=""):
      $assign_data1->del_status=1;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($query_id);
      if($assign_data2!=""):
      $assign_data2->delete_status=1;
      $assign_data2->save();
      endif;
    }*/

    public function recover_lead(Request $request) {
        $query_id = $request->id;

        // Retrieve Option1Quotation record and update del_status to recover if found
        $assign_data1 = Option1Quotation::where('query_reference', '=', $query_id)->first();
        if ($assign_data1) {
            // Assuming del_status 1 means deleted, so recovering by setting to 0
            $assign_data1->del_status = 0; // Setting del_status to 0 indicates recovery
            $assign_data1->save(); // Save the updated record
        }

        // Retrieve Query record and update delete_status to recover if found
        $assign_data2 = Query::find($query_id);
        if ($assign_data2) {
            // Assuming delete_status 1 means deleted, so recovering by setting to 0
            $assign_data2->delete_status = 0; // Setting delete_status to 0 indicates recovery
            $assign_data2->save(); // Save the updated record
        }
    }

    public function add_quotation() {
        return view('query.create');
    }

    public function quo_first($id) {
        // Find the query by its ID
        $data = Query::find($id);
    
        // Retrieve list of airlines with status 1
        $airlines = airlineList::where('status', '1')->get();
    
        // Check if user is logged in and has appropriate role
        if (Sentinel::check()) {
            if (Sentinel::getUser()->roles()->first()->slug == 'employee') {
                $user_id = Sentinel::getUser()->id;
                if ($user_id != $data->assign_id) {
                    return redirect()->back()->with("error", "User not assigned");
                }
            }
        }
    
        // Logic to allow Create Quotation only if from_package and quotation_created is false
        $allowCreateQuotation = false;
        if ($data->packageId !='') {
            $allowCreateQuotation = true;
        }

        // Return view with flags
        return view('query.quo_first', compact("data", "airlines", "allowCreateQuotation"));
    }
    

    public function querys_days(Request $request) {
        // Retrieve selected day from request
        $select_day = $request->select_day;

        // Retrieve total days from request
        $days = $request->days;

        // Uncommented code for future use:
        // for($i=1;$i<=$days;$i++)
        // {
        //      if(in_array("Day $i",$select_day))
        //      {

        //      }
        //      else
        //      {
        //       echo "<option value='Day ".$i."'>  Day $i</option>  ";  
        //      }
           
        // }

        // Print options for night selections
        for ($i = 1; $i <= $days; $i++) {
            echo "<option value='Night ".$i."'>  Night $i</option>  ";  
        }
    }

    /**********************/
    public function get_quote_validity_date(Request $request)
    {
    $quote_id = $request->quote_id;
    $data = DB::table('quote')
                ->leftJoin('rt_package_query','rt_package_query.id','=','quote.query_reference')
                ->where('quote.quo_ref',$quote_id)
                ->select('quote.*','rt_package_query.enquiry_ref_no')
                ->first();

    $main_data = view("query.query_modal.modal-popup.action-modal.extend_lead_body_content", compact('data',))->render();
              
$date1 = new DateTime(); // today
$date2 = new DateTime($data->tour_date); // your target date
$diffDays = 0;
$start_date = 0;

if ($date2 >= $date1) {
    $interval = $date1->diff($date2);
    $diffDays = (int)$interval->format('%a');
    $start_date = max(0, $diffDays - 2);
}


    $output_data = 
    [
'main_data'=>$main_data,
'diffDays'=>$diffDays,
'enquiry_ref_no' => $data->enquiry_ref_no,
        'quote_ref_no' => $quote_id,
    ];

  return $output_data;
    }
    public function update_quote_validity(Request $request)
{
    $quote_ref_no = $request->quote_ref_no;
    $validity_date = $request->validity;

   
    $validity_timestamp = strtotime(str_replace('/', '-', $validity_date)); 

    $data = Quote::where('quo_ref', $quote_ref_no)->first();

    if (!$data) {
        return response()->json(['error' => 'Quote not found'], 404);
    }

    $previous_date = $data->quote_validity;
    $message = '';

  
    if ($previous_date != date('Y-m-d', $validity_timestamp)) {
        $message .= '<p>Validity Date Changed from ' . date('d-m-Y', strtotime($previous_date)) . ' to ' . date('d-m-Y', $validity_timestamp) . '</p>';
    }

 
    if ($data->validity_time != $request->validity_time) {
        $message .= '<p>Time Changed from ' . $data->validity_time . ' to ' . $request->validity_time . '</p>';
    }


    if ($data->validity_show_on_frontend != $request->validity_show_on_frontend) {
        $message .= '<p>Show on Frontend Changed from ' . $data->validity_show_on_frontend . ' to ' . $request->validity_show_on_frontend . '</p>';
    }


    if (!empty($message)) {
        CustomHelpers::save_enquiry_tracker(
            $data->query_reference,
            $message,
            Sentinel::getUser()->id,
            'validity_update'
        );
    }


    $data->quote_validity = date('Y-m-d', $validity_timestamp);
    $data->validity_time = $request->validity_time;
    $data->validity_show_on_frontend = $request->validity_show_on_frontend;
    $data->save();
    echo 'success';
}

   public function save_quote(Request $request)
   {


    $send_option = $request->send_option;
    $action_type = $request->action_type;
    $main_query = Query::find($request->query_id);
    $main_query->quo_send = "1";
    $main_query->assign_id = Sentinel::getUser()->id;
    // If the send option is "0", update the status to 'quote_sent'
        if ($send_option == "0") {
            $main_query->status = 'quote_sent';
        }

        // Save the updated main query
        $main_query->save();

      if($action_type == 'quote' || $action_type == 'quote_copy')
      {
     $data = new Quote;
     // Generate a unique code
     $unique_code = bin2hex(openssl_random_pseudo_bytes(10));
      } 
      else
      {
    $quote_id = $request->quote_id;
    $data = Quote::find($quote_id);
    $unique_code = $data->unique_code;
      } 

      // Set the send option and related fields based on send_option
        if ($send_option == "0") {
            $data->send_option = 1;
        } elseif ($send_option == "1") {
            $data->send_option = 0;
            $data->accept_status = 0;
            $data->quote_view = 0;
        }
       $query_data = Query::find($request->query_id); 
       $data->query_reference = $request->query_id;
       $data->quote_view = 0;
       $data->title = $request->package_name;
       $data->duration = $request->duration;
      
       $data->transfers =  serialize($request->transfers);
       $data->package_service =  serialize($request->package_service);
     
        $data->continent = serialize($request->continent);
        $data->country = serialize($request->country);
        $data->state = serialize($request->state);
        $data->city = serialize($request->city);
        $data->days = serialize($request->days);
        $data->description = $request->description;
        $data->highlights = $request->highlights;
       
        $data->customer_rating = $request->customer_rating;
        $data->tours = serialize($request->tours);
        $data->tour_inc = serialize($request->quote_inc);
        $data->tour_exc = serialize($request->quote_exc);
        $data->inclusions = $request->inclusions;
        $data->exclusions = $request->exclusions;
        $data->day_itinerary = serialize($request->dayItinerary);
       
        $data->tour_type = $request->tour_type;
        $data->tour_category = $request->tour_category;
        $data->sourcecity = $request->sourcecity;
        $data->select_star_rating = $request->select_star_rating;
        $data->acc_type = $request->acc_type;
            
            if($request->acc_type=="normal_acc")
            {
            $data->accommodation = serialize($request->accommodation);
            }
            else if($request->acc_type=="extra_acc")
            {
              $data->accommodation_extra = $request->accommodation_extra;
            }
        $data->price_type = $request->price_type;
        $data->anything = $request->priceremarks;
        $data->remarks = $request->remarks;
        $data->admin_remarks = $request->admin_remarks;
        $data->price = serialize($request->price);
        $data->flight = serialize($request->flight);
        $data->visa_p = serialize($request->package_visa);
        $data->payment_p = serialize($request->package_payment);
        $data->can_p = serialize($request->package_can);
        $data->imp_notes = serialize($request->package_impnotes);
        $data->extra_notes =$request->extra_imp;

        $data->adult =$request->quote1_number_of_adult;
        $data->extra_adult =$request->extra_adult;
        $data->child_with_bed =$request->child_with_bed;
        $data->child_without_bed =$request->child_without_bed;
        $data->solo_traveller =$request->infant;
        $data->infant =$request->solo_traveller;
        if($request->package_hotel){
                $data->hotel_id = $request->package_hotel;
            }
        $data->payment_policy = $request->payment_policies;
        $data->cancel_policy = $request->cancellation;
        $data->visa_policies = $request->visa_policies;
        $data->visa = $request->visa;
        $validity_date = $request->validity;
        $validity_timestamp = strtotime(str_replace('/', '-', $validity_date));
        $data->quote_validity = date('Y-m-d', $validity_timestamp);
       
        $data->validity_time = $request->validity_time;
        $data->validity_show_on_frontend = $request->validity_show_on_frontend;
        $data->tour_date = $request->tour_date;
        $data->currency = $request->currency;
        $data->roe = $request->roe;
        $data->indian_rate = $request->indian_rate;
        $data->total_value = $request->total_value;
        $data->partPayment = $request->partPayment;
        $data->part_payments = serialize($request->part_payments);
        $data->refundPaymentCheckbox = $request->refundPaymentCheckbox;
        $data->refund_payments = serialize($request->refund_payments);
        
        $data->directPayment = $request->directPayment;
        $data->directPayments = serialize($request->directPayments);
        $data->second_directPayments = serialize($request->second_directPayments);
        $data->third_directPayments = serialize($request->third_directPayments);
        $data->no_of_room = $request->no_of_room;
        $data->room = serialize($request->room);

        $loged_user = Sentinel::getUser();
        if ($loged_user->lock_header_email == 1) {
            $data->quote_header_extra = $loged_user->signature_header;
        } else {
            $data->quote_header_extra = $request->quotation_header_extra;
        }
        if ($loged_user->lock_header == 1) {
            $data->quote_header = $loged_user->quotation_header;
        } else {
            $data->quote_header = $request->quotation_header;
        }
        if ($loged_user->lock_footer_email == 1) {
            $data->quote_footer_extra = $loged_user->signature;
        } else {
            $data->quote_footer_extra = $request->quotation_footer_extra;
        }
        if ($loged_user->lock_footer == 1) {
            $data->quote_footer = $loged_user->quotation_footer;
        } else {
            $data->quote_footer = $request->quotation_footer;
        }
         if (env("WEBSITENAME") == 1) {
            $data->webnotation = 1;
        } elseif (env("WEBSITENAME") == 0) {
            $data->webnotation = 0;
        }
        $data->unique_code = $unique_code;
        $data->assign_id = Sentinel::getUser()->id;
        $data->status = "1";

        if ($data->save())
        {
            $reference = "91" . date("Y") . date("d") . date("m") . $data->id;

            // Update the quo_ref with the reference
            $data->quo_ref = $reference;
            $data->save();
            // Get the recipient's email address
            $to = $request->guest_email;

            $data=Quote::find($data->id);
            $send_option=$request->send_option;

             // Handle email sending based on send_option
            if ($send_option == "0") {
                // Return the view for the email (if needed, uncomment the line below)
                // return view('query.mail.mailoption1', compact("data"));
                
                // Send the email to the client
                Mail::send(
                    'query.mail.mail1',
                    compact("data"),
                    function($message1) use ($to, $reference) {
                        $message1->from($this->mail_from_sender);
                        $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
                    }
                );
            }
            // Send email to guest if send_option is "0"
            if ($send_option == "0") {
                // Save the enquiry tracker
                CustomHelpers::save_enquiry_tracker($main_query->id, 'Quote Sent on email', Sentinel::getUser()->id, 'quote_sent');
                
                // Get the hidden email and send SMS
                $data = Quote::find($data->id);      
                $email = $this->get_hide_mail($data->email);
                $status = $this->quote_sms($data->mobile, $email, url('/quotes/' . $data->unique_code));
                
                // Redirect with a success message based on SMS status
                if ($status == "success") {
                    return redirect(route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail & Mobile.');
                } else {
                    return redirect(route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail.');
                }
            } elseif ($send_option == "1") {
                // Save the enquiry tracker for saved quotes
                CustomHelpers::save_enquiry_tracker($main_query->id, 'Quotation Saved', Sentinel::getUser()->id, 'quote_saved');
                
                // Redirect with a success message for saved quotes
                return redirect(route('quoteSaved'))->with('message', 'Thank you! Quotation has been saved for preview.');
            }

        }
 
   }
    

    public function option1(Request $request) {
        // Get the send option from the request
        $send_option = $request->send_option;

        // Find the main query by ID
        $main_query = Query::find($request->query_id);
        
        // Update main query details
        $main_query->quo_send = "1";
        $main_query->assign_id = Sentinel::getUser()->id;

        // If the send option is "0", update the status to 'quote_sent'
        if ($send_option == "0") {
            $main_query->status = 'quote_sent';
        }

        // Save the updated main query
        $main_query->save();
        
        // Retrieve or create a new Option1Quotation
        $data = Option1Quotation::where("query_reference", "=", $request->query_id)->first();
        if ($data == "") {
            $data = new Option1Quotation;
        }

        // Set the send option and related fields based on send_option
        if ($send_option == "0") {
            $data->send_option = 1;
        } elseif ($send_option == "1") {
            $data->send_option = 0;
            $data->accept_status = 0;
            $data->quote_view = 0;
        }

        // Fetch the main query data again for further processing
        $query_data = Query::find($request->query_id);
        
        // Generate a unique code
        $unique_code = bin2hex(openssl_random_pseudo_bytes(10));
        
        // Populate the Option1Quotation fields with data from the request
        $data->query_reference = $request->query_id;
        $data->name = $query_data->name;
        $data->quote_view = 0;
        $data->mobile = $query_data->mobile;
        $data->email = $query_data->email;
        $data->package_name = $request->package_name;
        $data->destination = $request->destination;
        $data->adult = $request->adult;
        $data->child = $request->child;
        $data->infant = $request->infant;
        $data->nationality = $request->nationality;
        $data->best_time_call = $request->best_time_call;
        $data->duration = $request->duration;
        $data->custom_package_name = $request->custom_package_name;
        $data->option1_price_type = $request->price_type;
        $data->anything = $request->priceremarks;
        $data->remarks = $request->remarks;
        $data->admin_remarks = $request->admin_remarks;
        $data->option1_price = serialize($request->price);
        $data->option1_accommodation = serialize($request->accommodation);
        $data->option1_transport = $request->transport;
        $data->option1_transport_description = $request->transport_description;
        $data->option1_flight = serialize($request->flight);
        $data->option1_description = $request->description;
        $data->option1_highlights = $request->highlights;
        $data->option1_inclusions = $request->inclusions;
        $data->option1_exclusions = $request->exclusions;
        $data->option1_dayItinerary = serialize($request->dayItinerary);
        $data->option1_visa = $request->visa;
        $data->option1_package_visa = serialize($request->package_visa);
        $data->option1_visa_policies = $request->visa_policies;
        $data->option1_package_payment = serialize($request->package_payment);
        $data->option1_payment_policies = $request->payment_policies;
        $data->option1_package_can = serialize($request->package_can);
        $data->option1_cancellation = $request->cancellation;
        $data->option1_package_impnotes = serialize($request->package_impnotes);
        $data->option1_extra_imp = $request->extra_imp;
        $data->option1_validity = $request->validity;
        $data->validity_time = $request->validity_time;
        $data->validity_show_on_frontend = $request->validity_show_on_frontend;
        $data->tour_date = $request->tour_date;
        $data->date_arrival = date('Y-m-d', strtotime($request->date_arrival));
        $data->message = $request->message;
        $data->sourcecity = $request->sourcecity;
        $data->package_service = serialize($request->package_service);
        $data->currency = $request->currency;
        $data->roe = $request->roe;
        $data->indian_rate = $request->indian_rate;
        $data->total_value = $request->total_value;
        $data->quote1_number_of_adult = $request->quote1_number_of_adult;
        $data->extra_adult = $request->extra_adult;
        $data->child_with_bed = $request->child_with_bed;
        $data->child_without_bed = $request->child_without_bed;
        $data->solo_traveller = $request->solo_traveller;
        $data->partPayment = $request->partPayment;
        $data->part_payments = serialize($request->part_payments);
        $data->directPayment = $request->directPayment;
        $data->directPayments = serialize($request->directPayments);
        $data->second_directPayments = serialize($request->second_directPayments);
        $data->third_directPayments = serialize($request->third_directPayments);
        $data->transfers = serialize($request->transfers);
        $data->no_of_room = $request->no_of_room;
        $data->room = serialize($request->room);
        $data->quote_inc = serialize($request->quote_inc);
        $data->quote_exc = serialize($request->quote_exc);

        // Handle quotation header/footer details based on user lock settings
        $loged_user = Sentinel::getUser();
        if ($loged_user->lock_header_email == 1) {
            $data->option1_quotation_header_extra = $loged_user->signature_header;
        } else {
            $data->option1_quotation_header_extra = $request->quotation_header_extra;
        }

        if ($loged_user->lock_header == 1) {
            $data->option1_quotation_header = $loged_user->quotation_header;
        } else {
            $data->option1_quotation_header = $request->quotation_header;
        }

        if ($loged_user->lock_footer_email == 1) {
            $data->option1_quotation_footer_extra = $loged_user->signature;
        } else {
            $data->option1_quotation_footer_extra = $request->quotation_footer_extra;
        }

        if ($loged_user->lock_footer == 1) {
            $data->option1_quotation_footer = $loged_user->quotation_footer;
        } else {
            $data->option1_quotation_footer = $request->quotation_footer;
        }
        
        // Set web notation based on environment setting
        if (env("WEBSITENAME") == 1) {
            $data->webnotation = 1;
        } elseif (env("WEBSITENAME") == 0) {
            $data->webnotation = 0;
        }
        
        // Set additional quotation details
        $data->source = $request->source;
        $data->unique_code = $unique_code;
        $data->assign_id = Sentinel::getUser()->id;
        $data->status = "1";

        // Save the quotation data and handle additional logic if saved
        if ($data->save()) {
            // Format the reference string
            $reference = "91" . date("Y") . date("d") . date("m") . $data->id;

            // Update the quo_ref with the reference
            $data->quo_ref = $reference;
            $data->save();

            // Get the recipient's email address
            $to = $request->guest_email;

            $data=Option1Quotation::find($data->id);
            $send_option=$request->send_option;

            // Handle email sending based on send_option
            if ($send_option == "0") {
                // Return the view for the email (if needed, uncomment the line below)
                // return view('query.mail.mailoption1', compact("data"));
                
                // Send the email to the client
                Mail::send(
                    'query.mail.mail1',
                    compact("data"),
                    function($message1) use ($to, $reference) {
                        $message1->from($this->mail_from_sender);
                        $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
                    }
                );
            }

            // Send email to guest if send_option is "0"
            if ($send_option == "0") {
                // Save the enquiry tracker
                CustomHelpers::save_enquiry_tracker($main_query->id, 'Quote Sent on email', Sentinel::getUser()->id, 'quote_sent');
                
                // Get the hidden email and send SMS
                $data = Option1Quotation::find($data->id);      
                $email = $this->get_hide_mail($data->email);
                $status = $this->quote_sms($data->mobile, $email, url('/quotes/' . $data->unique_code));
                
                // Redirect with a success message based on SMS status
                if ($status == "success") {
                    return redirect(route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail & Mobile.');
                } else {
                    return redirect(route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail.');
                }
            } elseif ($send_option == "1") {
                // Save the enquiry tracker for saved quotes
                CustomHelpers::save_enquiry_tracker($main_query->id, 'Quotation Saved', Sentinel::getUser()->id, 'quote_saved');
                
                // Redirect with a success message for saved quotes
                return redirect(route('quoteSaved'))->with('message', 'Thank you! Quotation has been saved for preview.');
            }
        }

        // If the save failed, continue with saving options 2-5
        $data_option2 = new Option2Quotation;
        $data_option2->quotation_ref_no = $reference;
        $data_option2->query_reference = $request->query_id;
        $data_option2->custom_package_name = $request->custom_package_name;
        $data_option2->duration = $request->duration;
        $data_option2->unique_code = $unique_code;
        $data_option2->save();

        $data_option3 = new Option3Quotation;
        $data_option3->quotation_ref_no = $reference;
        $data_option3->query_reference = $request->query_id;
        $data_option3->custom_package_name = $request->custom_package_name;
        $data_option3->duration = $request->duration;
        $data_option3->unique_code = $unique_code;
        $data_option3->save();

        $data_option4 = new Option4Quotation;
        $data_option4->quotation_ref_no = $reference;
        $data_option4->query_reference = $request->query_id;
        $data_option4->custom_package_name = $request->custom_package_name;
        $data_option4->duration = $request->duration;
        $data_option4->unique_code = $unique_code;
        $data_option4->save();

        // Redirect back with a success message if none of the saves failed
        return redirect()->back()->with('success', 'Option 1 details successfully saved.');
    }

    /**********************/
    
    public function send_custom_quote(Request $request)
    {
        $quote_id=$request->quote_id;
        $quote_no=$request->quote_no;
        $ref_no=$request->ref_no;
         

        $main_query=Query::find($ref_no);
        if($main_query->quo_send==0) {
            $main_query->quo_send="1";
            $main_query->status='quote_sent';
            $main_query->save();
        }
        $assign_data1=Option1Quotation::where('query_reference','=',$ref_no)->first();
        if($assign_data1):
            $assign_data1->assign_id=Sentinel::getUser()->id;
            $assign_data1->save();
        endif;
        $assign_data2=Query::find($ref_no);
        if($assign_data2):
            $assign_data2->assign_id=Sentinel::getUser()->id;
            $assign_data2->save();
        endif;

        if($quote_no=="1"):
            $data=Option1Quotation::find($quote_id);
            // return view('query.mail.mail1',compact("data"));
            if($data):
                //mail
                $data->send_option=1;
                $data->accept_status=0;
                $data->quote_view=0;
                $data->save();
                $to=$data->email;
                $reference=$data->quo_ref;
                Mail::send('query.mail.mail1',compact("data"), function($message1) use ($to,$reference){
                    $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
                });

                //message
                $email=$this->get_hide_mail($data->email);
                $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));

                CustomHelpers::save_enquiry_tracker($ref_no,'Quotation sent again',Sentinel::getUser()->id,'quote_sent');

                if($status=="success") {
                    return redirect()->back()->with('message', 'Thank you! Quotation has been sent successfully on E-Mail & Mobile.');
                } else {
                    return redirect()->back()->with('message', 'Thank you! Quotation has been sent successfully on E-Mail.');
                }
                //
            else:
                return redirect()->back()->with('message', "Data Not Found");
            endif;
        elseif($quote_no=="2"):
            $data=Option2Quotation::find($quote_id);
            if($data):
                $data->send_option=1;
                $data->save();
                //
                $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
                $email_data->accept_status=0;
                $email_data->quote_view=0;
                $email_data->save();
                $to=$email_data->email;
                
                $ref_no=$data->quotation_ref_no;
                //return view('query.mail.mailoption1',compact("data"));
                
                //mail sending to client
                Mail::send('query.mail.mail2',compact("data"), function($message1) use ($to,$ref_no) {
                    $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
                });
                //
                
                $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();

                $email=$this->get_hide_mail($data->email);

                $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));

                if($status=="success") {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
                } else {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
                }
            else:
                return redirect (route('quoteSent'))->with('message', "Data Not Found");
            endif;
        elseif($quote_no=="3"):
            $data=Option3Quotation::find($quote_id);
            if($data):
                //
                $data->send_option=1;
                $data->save();
                $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
                $email_data->accept_status=0;
                $email_data->quote_view=0;
                $email_data->save();
                $to=$email_data->email;
                $ref_no=$data->quotation_ref_no;
                //return view('query.mail.mailoption1',compact("data"));
                
                //mail sending to client
                Mail::send('query.mail.mail3',compact("data"), function($message1) use ($to,$ref_no) {
                    $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
                });

                //
                $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();

                $email=$this->get_hide_mail($data->email);
                $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
                if($status=="success") {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
                } else {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
                }

                //
            else:
                return redirect (route('quoteSent'))->with('message', "Data Not Found");
            endif;
        elseif($quote_no=="4"): 
            $data=Option4Quotation::find($quote_id);
            if($data):
                //
                $data->send_option=1;
                $data->save();
                $email_data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();
                $email_data->accept_status=0;
                $email_data->quote_view=0;
                $email_data->save();
                $to=$email_data->email;
                $ref_no=$data->quotation_ref_no;
                //return view('query.mail.mailoption1',compact("data"));
                
                //mail sending to client
                Mail::send('query.mail.mail4',compact("data"), function($message1) use ($to,$ref_no) {
                    $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
                });
                
                //
                $data=Option1Quotation::where('quo_ref',$data->quotation_ref_no)->get()->first();

                $email=$this->get_hide_mail($data->email);

                $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));

                if($status=="success") {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
                } else {
                    return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
                }
                //
            else:
                return redirect (route('quoteSent'))->with('message', "Data Not Found");
            endif;
        endif;
        // return redirect (route('quoteSent'))->with('message', "Thank you ! Quotation has been sent successfully On E-Mail.");
    }
    
    public function option1_store(Request $request)
    {
       $send_option=$request->send_option;
      $main_query=Query::find($request->query_id);
      $main_query->quo_send="1";
      $main_query->assign_id=Sentinel::getUser()->id;
        if($send_option=="0"):
       $main_query->status='quote_sent';
  
      endif;
      $main_query->save();

      $id=$request->custom_id;
     
      $data=Option1Quotation::where('quo_ref',$id)->get()->first();
      
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
       $data->accept_status=0;
       $data->quote_view=0;
      endif;
      $query_data=Query::find($request->query_id);

      $data->query_reference=$request->query_id;
      $data->name=$query_data->name;
      $data->mobile=$query_data->mobile;
      $data->email=$query_data->email;
      $data->package_name=$request->package_name;
      $data->destination=$request->destination;
      $data->adult=$request->adult;
      $data->child=$request->child;
      $data->infant=$request->infant;
      $data->nationality=$request->nationality;
      $data->best_time_call=$request->best_time_call;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option1_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option1_price=serialize($request->price);
      $data->option1_accommodation=serialize($request->accommodation);
      $data->option1_transport=$request->transport;
      $data->option1_transport_description=$request->transport_description;
      $data->option1_flight=serialize($request->flight);
      $data->option1_description=$request->description;
      $data->option1_highlights=$request->highlights;
      $data->option1_inclusions=$request->inclusions;
      $data->option1_exclusions=$request->exclusions;
      
      $data->option1_dayItinerary=serialize($request->dayItinerary);
      $data->option1_visa=$request->visa;
      $data->option1_package_visa=serialize($request->package_visa);
      $data->option1_visa_policies=$request->visa_policies;
      $data->option1_package_payment=serialize($request->package_payment);
      $data->option1_payment_policies=$request->payment_policies;
      $data->option1_package_can=serialize($request->package_can);
      $data->option1_cancellation=$request->cancellation;
      $data->option1_package_impnotes=serialize($request->package_impnotes);
      $data->option1_extra_imp=$request->extra_imp;
      $data->option1_validity=$request->validity;
      $data->option1_quotation_header=serialize($request->quotation_header);
      $data->option1_quotation_header_extra=$request->quotation_header_extra;
      $data->option1_quotation_footer=serialize($request->quotation_footer);
      $data->option1_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;

      $data->assign_id=Sentinel::getUser()->id;
       $data->status="1";
        if(env("WEBSITENAME")==1):
        $data->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
        $data->webnotation = 0;
         endif;
       if($data->save())
       {

         $send_option=$request->send_option;
         if($send_option=="0"):
         CustomHelpers::save_enquiry_tracker($main_query->id,'Quotation Sent',Sentinel::getUser()->id,'quote_sent');
         $data=Option1Quotation::find($data->id);
         $to=$data->email;
         $ref_no=$data->quo_ref;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });

        
         // 
        $data=Option1Quotation::find($data->id);

       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect (route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail & Mobile.');
       
       }
        else
       {
       return redirect (route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail .');
        }
        elseif($send_option=="1"):
          CustomHelpers::save_enquiry_tracker($main_query->id,'Quotation Saved',Sentinel::getUser()->id,'quote_saved');
          /*return redirect ('/Saved-Quote')->with('message', 'Thank you! Quotation has been saved successfully.');*/
          return redirect (route('quoteSaved'))->with('message', 'Thank you! Quotation has been saved successfully.');
         endif;
            //
      
        }
    }
    
    public function option2(Request $request)
    {
        $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();

        if($assign_data1):
        $assign_data1->assign_id=Sentinel::getUser()->id;
        $assign_data1->save();
        endif;
        $assign_data2=Query::find($request->query_id);
        if($assign_data2):
        $assign_data2->assign_id=Sentinel::getUser()->id;
        $assign_data2->save();
        endif;
        $data=Option2Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
        $send_option=$request->send_option;
        if($send_option=="0"):
        $data->send_option=1;
        elseif($send_option=="1"):
        $data->send_option=0;

        endif;
        $data->query_reference=$request->query_id;
        $data->quotation_ref_no=$request->quotation_ref_no;
     
        $data->custom_package_name=$request->custom_package_name;
        $data->option2_price_type=$request->price_type;
        $data->anything=$request->anything;
        $data->remarks=$request->remarks;
        $data->admin_remarks=$request->admin_remarks;
        $data->option2_price=serialize($request->price);
        $data->option2_accommodation=serialize($request->accommodation);
        $data->option2_transport=$request->transport;
        $data->option2_transport_description=$request->transport_description;
        $data->option2_flight=serialize($request->flight);
        $data->option2_description=$request->description;
        $data->option2_highlights=$request->highlights;
        $data->option2_inclusions=$request->inclusions;
        $data->option2_exclusions=$request->exclusions;
        $data->duration=$request->duration;
        $data->option2_dayItinerary=serialize($request->dayItinerary);
        $data->option2_visa=$request->visa;
        $data->option2_package_visa=serialize($request->package_visa);
        $data->option2_visa_policies=$request->visa_policies;
        $data->option2_package_payment=serialize($request->package_payment);
        $data->option2_payment_policies=$request->payment_policies;
        $data->option2_package_can=serialize($request->package_can);
        $data->option2_cancellation=$request->cancellation;
        $data->option2_package_impnotes=serialize($request->package_impnotes);
        $data->option2_extra_imp=$request->extra_imp;
        $data->option2_validity=$request->validity;
        $data->option2_quotation_header=serialize($request->quotation_header);
        $data->option2_quotation_header_extra=$request->quotation_header_extra;
        $data->option2_quotation_footer=serialize($request->quotation_footer);
        $data->option2_quotation_footer_extra=$request->quotation_footer_extra;
        $data->source=$request->source;
        $data->status="1";
        if($data->save()) {
        $send_option=$request->send_option;
        if($send_option=="0"):
        $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
        $email_data->accept_status=0;
        $email_data->quote_view=0;
        $email_data->save();
        $to=$email_data->email;
        $data=Option2Quotation::find($data->id);
        $ref_no=$data->quotation_ref_no;
        //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
        Mail::send('query.mail.mail2',compact("data"), function($message1) use ($to,$ref_no) {
            $message1->from($this->mail_from_sender);
            $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
        });
          //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
        $email=$this->get_hide_mail($data->email);
       
        $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
        if($status=="success")
        {
            return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
        } else
        {
            return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
            return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been Save successfully.');
        endif;
        //
        }
    }

    public function option3(Request $request) 
    {
        $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();
      
        if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($request->query_id);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;
      $data=Option3Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->quotation_ref_no=$request->quotation_ref_no;

      $data->custom_package_name=$request->custom_package_name;
      $data->option3_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option3_price=serialize($request->price);
      $data->option3_accommodation=serialize($request->accommodation);
      $data->option3_transport=$request->transport;
      $data->option3_transport_description=$request->transport_description;
      $data->option3_flight=serialize($request->flight);
      $data->option3_description=$request->description;
      $data->option3_highlights=$request->highlights;
      $data->option3_inclusions=$request->inclusions;
      $data->option3_exclusions=$request->exclusions;
      $data->duration=$request->duration;
      $data->option3_dayItinerary=serialize($request->dayItinerary);
      $data->option3_visa=$request->visa;
      $data->option3_package_visa=serialize($request->package_visa);
      $data->option3_visa_policies=$request->visa_policies;
      $data->option3_package_payment=serialize($request->package_payment);
      $data->option3_payment_policies=$request->payment_policies;
      $data->option3_package_can=serialize($request->package_can);
      $data->option3_cancellation=$request->cancellation;
      $data->option3_package_impnotes=serialize($request->package_impnotes);
      $data->option3_extra_imp=$request->extra_imp;
      $data->option3_validity=$request->validity;
      $data->option3_quotation_header=serialize($request->quotation_header);
      $data->option3_quotation_header_extra=$request->quotation_header_extra;
      $data->option3_quotation_footer=serialize($request->quotation_footer);
      $data->option3_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
        $data->status="1";
       if($data->save()){

        //
        $send_option=$request->send_option;
         if($send_option=="0"):
         $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         $data=Option3Quotation::find($data->id);
       $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail3',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
        //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //
        }
    }

    public function option4(Request $request)
    { 
       $assign_data1=Option1Quotation::where('query_reference','=',$request->query_id)->first();

      if($assign_data1):
      $assign_data1->assign_id=Sentinel::getUser()->id;
      $assign_data1->save();
      endif;
      $assign_data2=Query::find($request->query_id);
      if($assign_data2):
      $assign_data2->assign_id=Sentinel::getUser()->id;
      $assign_data2->save();
      endif;
      $data=Option4Quotation::where('quotation_ref_no',$request->quotation_ref_no)->get()->first();
       $send_option=$request->send_option;
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif;
      $data->query_reference=$request->query_id;
      $data->quotation_ref_no=$request->quotation_ref_no;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option4_price_type=$request->price_type;
      $data->anything=$request->anything;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option4_price=serialize($request->price);
      $data->option4_accommodation=serialize($request->accommodation);
      $data->option4_transport=$request->transport;
      $data->option4_transport_description=$request->transport_description;
      $data->option4_flight=serialize($request->flight);
      $data->option4_description=$request->description;
      $data->option4_highlights=$request->highlights;
      $data->option4_inclusions=$request->inclusions;
      $data->option4_exclusions=$request->exclusions;
      
      $data->option4_dayItinerary=serialize($request->dayItinerary);
      $data->option4_visa=$request->visa;
      $data->option4_package_visa=serialize($request->package_visa);
      $data->option4_visa_policies=$request->visa_policies;
      $data->option4_package_payment=serialize($request->package_payment);
      $data->option4_payment_policies=$request->payment_policies;
      $data->option4_package_can=serialize($request->package_can);
      $data->option4_cancellation=$request->cancellation;
      $data->option4_package_impnotes=serialize($request->package_impnotes);
      $data->option4_extra_imp=$request->extra_imp;
      $data->option4_validity=$request->validity;
      $data->option4_quotation_header=serialize($request->quotation_header);
      $data->option4_quotation_header_extra=$request->quotation_header_extra;
      $data->option4_quotation_footer=serialize($request->quotation_footer);
      $data->option4_quotation_footer_extra=$request->quotation_footer_extra;
      $data->source=$request->source;
        $data->status="1";
       if($data->save()){
         //
        $send_option=$request->send_option;
         if($send_option=="0"):
         $email_data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
         $email_data->accept_status=0;
         $email_data->quote_view=0;
         $email_data->save();
         $to=$email_data->email;
         $data=Option4Quotation::find($data->id);
             $ref_no=$data->quotation_ref_no;
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail4',compact("data")
            
           , function($message1) use ($to,$ref_no)
               {
                   $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $ref_no")->bcc($this->mail_to_cc);
               });
         //
        $data=Option1Quotation::where('quo_ref',$request->quotation_ref_no)->get()->first();
      
       $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      
       if($status=="success")
      {
       return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail & Mobile.');
       
       }
        else
       {
       return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been sent successfully On E-Mail.');
        }
        elseif($send_option=="1"):
          return redirect (route('quoteSent'))->with('message', 'Thank you ! Quotation has been Save successfully.');
         endif;
            //
        }
    }
    
    public function copy_option1(Request $request)
    { 

      $send_option=$request->send_option;
      $main_query=Query::find($request->query_id);
      $main_query->quo_send="1";
        if($send_option=="0"):
       $main_query->status='quote_sent';
  
      endif;
      $main_query->save();

      $unique_code=bin2hex(openssl_random_pseudo_bytes(10));
      $data=Option1Quotation::where("query_reference","=",$request->query_id)->first();
      if($data=='')
      {
       $data=new Option1Quotation;
      }
      if($send_option=="0"):
       $data->send_option=1;
      elseif($send_option=="1"):
       $data->send_option=0;
      endif; 
       $query_data=Query::find($request->query_id);
       $data->quote_view=0;
      $data->query_reference=$request->query_id;
      $data->name=$query_data->name;
      $data->mobile=$query_data->mobile;
      $data->email=$query_data->email;
      $data->package_name=$request->package_name;
      $data->destination=$request->destination;
      $data->adult=$request->adult;
      $data->child=$request->child;
      $data->infant=$request->infant;
      $data->nationality=$request->nationality;
      $data->best_time_call=$request->best_time_call;
      $data->duration=$request->duration;
      $data->custom_package_name=$request->custom_package_name;
      $data->option1_price_type=$request->price_type;
      $data->anything=$request->priceremarks;
      $data->remarks=$request->remarks;
      $data->admin_remarks=$request->admin_remarks;
      $data->option1_price=serialize($request->price);
      $data->option1_accommodation=serialize($request->accommodation);
      $data->option1_transport=$request->transport;
      $data->option1_transport_description=$request->transport_description;
      $data->option1_flight=serialize($request->flight);
      $data->option1_description=$request->description;
      $data->option1_highlights=$request->highlights;
      $data->option1_inclusions=$request->inclusions;
      $data->option1_exclusions=$request->exclusions;
      
      $data->option1_dayItinerary=serialize($request->dayItinerary);
      $data->option1_visa=$request->visa;
      $data->option1_package_visa=serialize($request->package_visa);
      $data->option1_visa_policies=$request->visa_policies;
      $data->option1_package_payment=serialize($request->package_payment);
      $data->option1_payment_policies=$request->payment_policies;
      $data->option1_package_can=serialize($request->package_can);
      $data->option1_cancellation=$request->cancellation;
      $data->option1_package_impnotes=serialize($request->package_impnotes);
      $data->option1_extra_imp=$request->extra_imp;
      $data->option1_validity=$request->validity;
      
      $data->date_arrival=date('Y-m-d', strtotime($request->date_arrival));
     $data->message=$request->message;
     $data->sourcecity=$request->sourcecity;
     $data->package_service=serialize($request->package_service);
     $data->currency=$request->currency;
     $data->roe=$request->roe;
     $data->indian_rate=$request->indian_rate;
     $data->total_value=$request->total_value;
     $data->quote1_number_of_adult=$request->quote1_number_of_adult;
     $data->extra_adult=$request->extra_adult;
     $data->child_with_bed=$request->child_with_bed;
     $data->child_without_bed=$request->child_without_bed;
     $data->solo_traveller=$request->solo_traveller;
     $data->partPayment=$request->partPayment;
     $data->part_payments=serialize($request->part_payments);
     $data->directPayment=$request->directPayment;
     $data->directPayments=serialize($request->directPayments);
     $data->second_directPayments=serialize($request->second_directPayments);
     $data->third_directPayments=serialize($request->third_directPayments);
     $data->transfers=serialize($request->transfers);
     $data->no_of_room=$request->no_of_room;
     $data->room=serialize($request->room);
     $data->quote_inc=serialize($request->quote_inc);
     $data->quote_exc=serialize($request->quote_exc);
     $loged_user=Sentinel::getUser();
     $data->tour_date=$request->tour_date; 
     $data->validity_time=$request->validity_time;
     $data->validity_show_on_frontend=$request->validity_show_on_frontend;

      if($loged_user->lock_header_email==1)
      {
      $data->option1_quotation_header_extra=$loged_user->signature_header;
      }
      else
      {

      $data->option1_quotation_header_extra=$request->quotation_header_extra;

      } 

       if($loged_user->lock_header==1)
      {
      $data->option1_quotation_header=$loged_user->quotation_header;
      }
      else
      {
       $data->option1_quotation_header=$request->quotation_header;  
      }
       if($loged_user->lock_footer_email==1)
      {
      $data->option1_quotation_footer_extra=$loged_user->signature;
      }
      else
      {
       $data->option1_quotation_footer_extra=$request->quotation_footer_extra;
      }
       if($loged_user->lock_footer==1)
      {
      $data->option1_quotation_footer=$loged_user->quotation_footer;
      }
      else
      {
        $data->option1_quotation_footer=$request->quotation_footer;
      }

    
      $data->source=$request->source;

      if($data->unique_code=='')
      {

       $data->unique_code=$unique_code; 
      }
      
        if(env("WEBSITENAME")==1):
        $data->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
        $data->webnotation = 0;
         endif;
      $data->status="1";
       $year=date("Y");
       $month=date("m");
       $date=date("d");
       if($data->save())
         {
      //
          if($data->quo_ref=='')
          {
            $reference="91".date("Y").$date.$month.$data->id;
          }
         else
         {
          $reference=$data->quo_ref;
         }
        
         $to=$request->guest_email;
         $data=Option1Quotation::find($data->id);
         $data->quo_ref=$reference;
         $data->save();
        $send_option=$request->send_option;
         if($send_option=="0"):
          
      //return view('query.mail.mailoption1',compact("data"));
        //mail sending to client
         Mail::send('query.mail.mail1',compact("data")
            
           , function($message1) use ($to,$reference)
               {
                   $message1->from($this->mail_from_sender);
                    $message1->to($to)->subject("Tour Quote # $reference")->bcc($this->mail_to_cc);
               });
      
      endif;    

          //
      $data_option2=new Option2Quotation; 
      $data_option2->quotation_ref_no=$reference; 
      $data_option2->query_reference=$request->query_id;
      $data_option2->custom_package_name=$request->custom_package_name;
      $data_option2->duration=$request->duration;
      
      $quotation2_data=Option2Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first();
     
      if($quotation2_data!="" && count($quotation2_data)!="0")
      {
      $data_option2->option2_price_type=$quotation2_data->option2_price_type;
      $data_option2->anything=$quotation2_data->anything;
      $data_option2->remarks=$quotation2_data->remarks;
      $data_option2->admin_remarks=$quotation2_data->admin_remarks;
      $data_option2->option2_price=$quotation2_data->option2_price;
      $data_option2->option2_accommodation=$quotation2_data->option2_accommodation;
      $data_option2->option2_transport=$quotation2_data->option2_transport;
      $data_option2->option2_transport_description=$quotation2_data->option2_transport_description;
      $data_option2->option2_flight=$quotation2_data->option2_flight;
      $data_option2->option2_description=$quotation2_data->option2_description;
      $data_option2->option2_highlights=$quotation2_data->option2_highlights;
      $data_option2->option2_inclusions=$quotation2_data->option2_inclusions;
      $data_option2->option2_exclusions=$quotation2_data->option2_exclusions;
      
      $data_option2->option2_dayItinerary=$quotation2_data->option2_dayItinerary;
      $data_option2->option2_visa=$quotation2_data->option2_visa;
      $data_option2->option2_package_visa=$quotation2_data->option2_package_visa;
      $data_option2->option2_visa_policies=$quotation2_data->option2_visa_policies;
      $data_option2->option2_package_payment=$quotation2_data->option2_package_payment;
      $data_option2->option2_payment_policies=$quotation2_data->option2_payment_policies;
      $data_option2->option2_package_can=$quotation2_data->option2_package_can;
      $data_option2->option2_cancellation=$quotation2_data->option2_cancellation;
      $data_option2->option2_package_impnotes=$quotation2_data->option2_package_impnotes;
      $data_option2->option2_extra_imp=$quotation2_data->option2_extra_imp;
      $data_option2->option2_validity=$quotation2_data->option2_validity;
      $data_option2->option2_quotation_header=$quotation2_data->option2_quotation_header;
      $data_option2->option2_quotation_header_extra=$quotation2_data->option2_quotation_header_extra;
      $data_option2->option2_quotation_footer=$quotation2_data->option2_quotation_footer;
      $data_option2->option2_quotation_footer_extra=$quotation2_data->option2_quotation_footer_extra;
      }
      $data_option2->unique_code=$unique_code;
      $data_option2->save(); 
      $data_option3=new Option3Quotation; 
      $data_option3->quotation_ref_no=$reference; 
      $data_option3->query_reference=$request->query_id;
      $data_option3->custom_package_name=$request->custom_package_name;
      $data_option3->duration=$request->duration;
      $quotation3_data=Option3Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first(); 
       if($quotation3_data!="" && count($quotation3_data)!="0")
      {
      $data_option3->option3_price_type=$quotation3_data->option3_price_type;
      $data_option3->anything=$quotation3_data->anything;
      $data_option3->remarks=$quotation3_data->remarks;
      $data_option3->admin_remarks=$quotation3_data->admin_remarks;
      $data_option3->option3_price=$quotation3_data->option3_price;
      $data_option3->option3_accommodation=$quotation3_data->option3_accommodation;
      $data_option3->option3_transport=$quotation3_data->option3_transport;
      $data_option3->option3_transport_description=$quotation3_data->option3_transport_description;
      $data_option3->option3_flight=$quotation3_data->option3_flight;
      $data_option3->option3_description=$quotation3_data->option3_description;
      $data_option3->option3_highlights=$quotation3_data->option3_highlights;
      $data_option3->option3_inclusions=$quotation3_data->option3_inclusions;
      $data_option3->option3_exclusions=$quotation3_data->option3_exclusions;
      
      $data_option3->option3_dayItinerary=$quotation3_data->option3_dayItinerary;
      $data_option3->option3_visa=$quotation3_data->option3_visa;
      $data_option3->option3_package_visa=$quotation3_data->option3_package_visa;
      $data_option3->option3_visa_policies=$quotation3_data->option3_visa_policies;
      $data_option3->option3_package_payment=$quotation3_data->option3_package_payment;
      $data_option3->option3_payment_policies=$quotation3_data->option3_payment_policies;
      $data_option3->option3_package_can=$quotation3_data->option3_package_can;
      $data_option3->option3_cancellation=$quotation3_data->option3_cancellation;
      $data_option3->option3_package_impnotes=$quotation3_data->option3_package_impnotes;
      $data_option3->option3_extra_imp=$quotation3_data->option3_extra_imp;
      $data_option3->option3_validity=$quotation3_data->option3_validity;
      $data_option3->option3_quotation_header=$quotation2_data->option3_quotation_header;
      $data_option3->option3_quotation_header_extra=$quotation3_data->option3_quotation_header_extra;
      $data_option3->option3_quotation_footer=$quotation3_data->option3_quotation_footer;
      $data_option3->option3_quotation_footer_extra=$quotation3_data->option3_quotation_footer_extra;
      $data_option3->source=$quotation3_data->source;
      }
      $data_option3->unique_code=$unique_code;
      $data_option3->save(); 
      $data_option4=new Option4Quotation;
      $data_option4->quotation_ref_no=$reference; 
      $data_option4->query_reference=$request->query_id;
      $data_option4->custom_package_name=$request->custom_package_name;
      $data_option4->duration=$request->duration;
      $quotation4_data=Option4Quotation::where('quotation_ref_no',$request->copy_reference)->get()->first(); 
       if($quotation4_data!="" && count($quotation4_data)!="0")
      {
        $data_option4->option4_price_type=$quotation4_data->option4_price_type;
        $data_option4->anything=$quotation4_data->anything;
        $data_option4->remarks=$quotation4_data->remarks;
        $data_option4->admin_remarks=$quotation4_data->admin_remarks;
      $data_option4->option4_price=$quotation4_data->option4_price;
      $data_option4->option4_accommodation=$quotation4_data->option4_accommodation;
      $data_option4->option4_transport=$quotation4_data->option4_transport;
      $data_option4->option4_transport_description=$quotation4_data->option4_transport_description;
      $data_option4->option4_flight=$quotation4_data->option4_flight;
      $data_option4->option4_description=$quotation4_data->option4_description;
      $data_option4->option4_highlights=$quotation4_data->option4_highlights;
      $data_option4->option4_inclusions=$quotation4_data->option4_inclusions;
      $data_option4->option4_exclusions=$quotation4_data->option4_exclusions;
      
      $data_option4->option4_dayItinerary=$quotation4_data->option4_dayItinerary;
      $data_option4->option4_visa=$quotation4_data->option4_visa;
      $data_option4->option4_package_visa=$quotation4_data->option4_package_visa;
      $data_option4->option4_visa_policies=$quotation4_data->option4_visa_policies;
      $data_option4->option4_package_payment=$quotation4_data->option4_package_payment;
      $data_option4->option4_payment_policies=$quotation4_data->option4_payment_policies;
      $data_option4->option4_package_can=$quotation4_data->option4_package_can;
      $data_option4->option4_cancellation=$quotation4_data->option4_cancellation;
      $data_option4->option4_package_impnotes=$quotation4_data->option4_package_impnotes;
      $data_option4->option4_extra_imp=$quotation4_data->option4_extra_imp;
      $data_option4->option4_validity=$quotation4_data->option4_validity;
      $data_option4->option4_quotation_header=$quotation4_data->option4_quotation_header;
      $data_option4->option4_quotation_header_extra=$quotation4_data->option4_quotation_header_extra;
      $data_option4->option4_quotation_footer=$quotation4_data->option4_quotation_footer;
      $data_option4->option4_quotation_footer_extra=$quotation4_data->option4_quotation_footer_extra;
      $data_option4->source=$quotation4_data->source;
      }  
      $data_option4->unique_code=$unique_code;
      $data_option4->save();  
      
      //
      $send_option=$request->send_option;
      if($send_option=="0"):
      $data=Option1Quotation::find($data->id);      
      $email=$this->get_hide_mail($data->email);
       
      $status=$this->quote_sms($data->mobile,$email,url('/quotes/'.$data->unique_code));
      CustomHelpers::save_enquiry_tracker($main_query->id,'Quotation Sended',Sentinel::getUser()->id,'quote_sent');
      if($status=="success")
      {
        return redirect (route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail & Mobile.');
      }
      else
      {
        return redirect (route('quoteSent'))->with('message', 'Thank you! Quotation has been sent successfully on E-Mail.');
      }
      elseif($send_option=="1"):
        CustomHelpers::save_enquiry_tracker($main_query->id,'Quotation Updated & Saved',Sentinel::getUser()->id,'quote_saved');
        return redirect (route('quoteSaved'))->with('message', 'Thank you! Quotation has been saved successfully.');
        endif;
        //
      }
    }

    public function store_raise(Request $request)
    {
        $raise=$request->raise;
        $message='';
        $ref_no='';
        if($raise=='')
        {
            $message='Please select your request';
        }
        else
        {
          $content_id=CustomHelpers::custom_decrypt($request->content_id);
          $quote=Quote::find($content_id); 
     
          $data=new RaiseConcern;
          $data->quotation_ref_no=$quote->quo_ref;  
          $data->query_reference=$quote->query_reference; 
          $data->raise_concern=$raise; 
          $data->save();   
          $message='success';
          $ref_no=$data->quotation_ref_no;
        }
        $output=['message'=>$message,'ref_no'=>$ref_no];
        return $output;
    }

    // raised concern
    public function get_previous_raise(Request $request)
    {
        $quotation_ref_no=$request->quotation_ref_no;
        $previous_raises=DB::table('quote_raise_concern')->where('quotation_ref_no',$quotation_ref_no)->get();
        $output='';
        foreach($previous_raises as $previous_raise):
            $output.='<li>'.$previous_raise->raise_concern.'</li>';
        endforeach;
        echo $output;
    }

    /**********************/

    /*public function quotation_details_first($id)
    {
     $unique_code=$id;
    
     $data1=Option1Quotation::where('unique_code','=',$unique_code)->first();
     $data2=Option2Quotation::where('unique_code','=',$unique_code)->first();
     $data3=Option3Quotation::where('unique_code','=',$unique_code)->first();
     $data4=Option4Quotation::where('unique_code','=',$unique_code)->first();
     //quote1
     if(Session::has($unique_code.'quote1_id'))
         {
       Session::forget($unique_code.'quote1_id');
         }
      if(Session::has($unique_code.'quote2_id'))
         {
       Session::forget($unique_code.'quote2_id');
         }
       if(Session::has($unique_code.'quote3_id'))
         {
       Session::forget($unique_code.'quote3_id');
         }
         if(Session::has($unique_code.'quote4_id'))
         {
       Session::forget($unique_code.'quote4_id');
         }
        Session::set($unique_code.'quote1_id',$data1->id);
        Session::set($unique_code.'quote2_id',$data2->id);
        Session::set($unique_code.'quote3_id',$data3->id);
        Session::set($unique_code.'quote4_id',$data4->id);

        if(Sentinel::check()) {

            if(Sentinel::getUser()->roles()->first()->slug == 'super_admin' || Sentinel::getUser()->roles()->first()->slug == 'administrator' || Sentinel::getUser()->roles()->first()->slug == 'employee') {
          

              if($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="0" && $data3!="" && $data3!="0" && $data3->status=="0" && $data4!="" && $data4!="0" && $data4->status=="0"):
              return view("query.quotation_webpage.first",compact("data1"));
              elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="0" && $data4!="" && $data4!="0" && $data4->status=="0"):
              return view("query.quotation_webpage.second",compact("data2","data1"));
              elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="1" && $data4!="" && $data4!="0" && $data4->status=="0"):
              return view("query.quotation_webpage.three",compact("data3","data2","data1"));
              elseif($data1!="" && $data1!="0" && $data1->status=="1" && $data2!="" && $data2!="0" && $data2->status=="1" && $data3!="" && $data3!="0" && $data3->status=="1" && $data4!="" && $data4!="0" && $data4->status=="1"):
              
              return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
              else:
              return redirect(route('home'));;
              endif;
              }
        }

        if($data1!="" && $data1!="0" && $data1->send_option=="1"  && $data2!="" && $data2!="0" && $data2->send_option=="0" && $data3!="" && $data3!="0" && $data3->send_option=="0" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
        $data1->quote_view=1;
        $data1->save();
        return view("query.quotation_webpage.first",compact("data1"));

        elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="0" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
        $data1->quote_view=1;
        $data1->save();
        return view("query.quotation_webpage.second",compact("data2","data1"));

        elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="1" && $data4!="" && $data4!="0" && $data4->send_option=="0"):
        $data1->quote_view=1;
        $data1->save();
        return view("query.quotation_webpage.three",compact("data3","data2","data1"));

        elseif($data1!="" && $data1!="0" && $data1->send_option=="1" && $data2!="" && $data2!="0" && $data2->send_option=="1" && $data3!="" && $data3!="0" && $data3->send_option=="1" && $data4!="" && $data4!="0" && $data4->send_option=="1"):
       
       $data1->quote_view=1;
       $data1->save();
       return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
     
        else:
        return redirect(route('home'));;
        endif;
    }*/

    public function quotation_details_first($id)
    {
        $unique_code = $id;
        $data1 = Quote::where('unique_code', $unique_code)->first();
    
        if (!$data1) {
            abort(404, 'Quote not found');
        }
    
        Session::put($unique_code . 'quote1_id', $data1->id);
    
       
    
        // Ensure status for first.blade.php
        $data1->status = "1"; // Remove if not desired
    
        return $this->getQuotationViewBasedOnStatus($data1);
    }

    private function clearQuotationSessionData($unique_code) {
        // Clear existing session data if present
        Session::forget($unique_code . 'quote1_id');
        Session::forget($unique_code . 'quote2_id');
        Session::forget($unique_code . 'quote3_id');
        Session::forget($unique_code . 'quote4_id');
    }

    private function getQuotationViewBasedOnStatus($data1)
{
    return view("query.quotation_webpage.first", compact("data1"));
}

    private function getQuotationViewForCustomer($data1, $data2, $data3, $data4) {
        // Return views based on the send_option for customers
        if ($data1 && $data1->send_option == "1" && !$data2 && !$data3 && !$data4) {
            $data1->quote_view = 1;
            $data1->save();
            return view("query.quotation_webpage.first", compact("data1"));
        } elseif ($data1 && $data1->send_option == "1" && $data2 && $data2->send_option == "1" && !$data3 && !$data4) {
            $data1->quote_view = 1;
            $data1->save();
            return view("query.quotation_webpage.second", compact("data2", "data1"));
        } elseif ($data1 && $data1->send_option == "1" && $data2 && $data2->send_option == "1" && $data3 && $data3->send_option == "1" && !$data4) {
            $data1->quote_view = 1;
            $data1->save();
            return view("query.quotation_webpage.three", compact("data3", "data2", "data1"));
        } elseif ($data1 && $data1->send_option == "1" && $data2 && $data2->send_option == "1" && $data3 && $data3->send_option == "1" && $data4 && $data4->send_option == "1") {
            $data1->quote_view = 1;
            $data1->save();
            return view("query.quotation_webpage.four", compact("data4", "data3", "data2", "data1"));
        } else {
            return redirect(route('home'));;
        }
    }

    /**********************/
    
    public function quotation_details_second($id) 
    {
      $unique_code=$id;
      $data2=Option2Quotation::where('unique_code','=',$unique_code)->first();
       if(count($data2)!="" && count($data2)!="0"):
         $data1=Option1Quotation::where('id','=',$data2->quotation_ref_no)->first();
      return view("query.quotation_webpage.second",compact("data2","data1"));
      else:
        return redirect(route('home'));;
      endif; 
    }
  
    public function quotation_details_three($id) 
    {
      $unique_code=$id;
      $data3=Option3Quotation::where('unique_code','=',$unique_code)->first();
      if(count($data3)!="" && count($data3)!="0"):
         $data1=Option1Quotation::where('id','=',$data3->quotation_ref_no)->first();
         $data2=Option2Quotation::where('quotation_ref_no','=',$data3->quotation_ref_no)->first();
      return view("query.quotation_webpage.three",compact("data3","data2","data1"));
      else:
        return redirect(route('home'));;
      endif;
    }

    public function quotation_details_four($id) 
    {
      $unique_code=$id;
      $data4=Option4Quotation::where('unique_code','=',$unique_code)->first();
      if(count($data4)!="" && count($data4)!="0"):
         $data1=Option1Quotation::where('id','=',$data4->quotation_ref_no)->first();
         $data2=Option2Quotation::where('quotation_ref_no','=',$data4->quotation_ref_no)->first();
         $data3=Option3Quotation::where('quotation_ref_no','=',$data4->quotation_ref_no)->first();
      return view("query.quotation_webpage.four",compact("data4","data3","data2","data1"));
      else:
        return redirect(route('home'));;
      endif;
    }


    /**********************/


    /*public function mail_test()
    {
      $to="rapidexholidays@gmail.com";
      //$data=Option1Quotation::find('28');
      $data=Option1Quotation::find('13');;
        //mail sending to client
         Mail::send('query.mail.test',compact('data')
           
           , function($message1) use ($to)
               {
                   $message1->from('tourquotes@theworldgateway.com');
                   $message1->to($to)->subject("Thanks for your enquiry.")->bcc('helpdesk@theworldgateway.com');
                  
               });
    }*/


    /**********************/


    public function mail_test1()
    {
      $data=Option1Quotation::find('13');
      $email=$this->get_hide_mail($data->email);

      $this->quote_sms($data->mobile,$email,$data->quo_ref);
      return view('query.mail.test',compact('data'));
    }


    /**********************/


    /*public function get_hide_mail($email)
    {
        $email = $email;

        $em = explode("@",$email);
        $name = $em[0];
        $len = strlen($name);
        $showLen = floor($len/2);
        $str_arr = str_split($name);
        for($ii=$showLen;$ii<$len;$ii++){
         $str_arr[$ii] = '*';
        }
        $em[0] = implode('',$str_arr); 
        $new_name = implode('@',$em);

        return $new_name;
    }*/

    public function get_hide_mail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid Email'; // Handle invalid email input
        }

        [$name, $domain] = explode("@", $email);
        $showLen = floor(strlen($name) / 2);
        
        // Replace the second half of the name with '*'
        $hiddenName = substr($name, 0, $showLen) . str_repeat('*', strlen($name) - $showLen);

        return "{$hiddenName}@{$domain}";
    }


    /**********************/


    /*public function quote_sms($mobile,$name,$ref)
    {
      $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";

      $number=$mobile;
      $number = preg_replace('/\s/', '', $number);
      $mobile_code="91";
     
      $numbers = array($mobile_code.$number);
      
      $sender = urlencode('UPDATE');
      
    
      $message = rawurlencode(" We have sent the Tour quote on your email-id. Click on the link to check your quote: $ref");
      $numbers = implode(',', $numbers);
      
      $response=$this->sendSms($apiKey,$numbers, $message, $sender);
      $response=json_decode($response);
     
        if($response->status=="success")
        {
           return "success";
        }
        elseif ($response->status=="failure") 
        {
          return "Fail";
        }

         //status
    }*/

    public function quote_sms($mobile, $name, $ref)
    {
        $apiKey = "KRNn8pJ93PQ-A6Jf6TmI8JoaBbz76NG91hB3P99Gwz";
        $mobile_code = "91";

        // Remove spaces from mobile number
        $number = preg_replace('/\s+/', '', $mobile);
        $fullNumber = $mobile_code . $number;

        // Message content
        $message = rawurlencode("We have sent the Tour quote on your email-id. Click on the link to check your quote: $ref");

        // Send SMS
        $response = $this->sendSms($apiKey, $fullNumber, $message, 'UPDATE');
        $responseData = json_decode($response, true); // Decode as associative array

        // Return status
        return $responseData['status'] === "success" ? "success" : "Fail";
    }


    /**********************/


    public function sendSms($apiKey,$numbers,$message, $sender)
    {
      // Prepare data for POST request
      $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }


    /**********************/


    /*public function quo_copy($id)
    {
        $data=Query::find($id);
        return view('query.quo_second',compact("data")); 
    }*/

    public function quo_copy($id)
    {
        return view('query.quo_second', ['data' => Query::findOrFail($id)]);
    }


    public function copy_reference($id, Request $request)
    {
        $data = Query::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Invalid Query ID');
        }
     $select_type=$request->select_type;
        

        if ($select_type == "1") {

        $Packages =DB::table('quote')
              ->where('quo_ref',$request->q_reference_no)
              ->first();
              if(!$Packages)
              {
          return redirect()->back()->with('error', 'Invalid Reference No');      
              }
        return $this->quote_create_edit($data,$Packages, 'quote_copy');
           
           
        } elseif ($select_type == "2") {

       
       $Packages = Packages::where('package_code','=',$request->q_reference_no)->first();
        if(!$Packages)
              {
          return redirect()->back()->with('error', 'Invalid Package Code');      
              }
       return $this->quote_create_edit($data,$Packages, 'quote');

          
        }

        return redirect()->back()->with('error', 'Invalid Selection Type');
    }


    /**********************/


    /*public function quo_new($id)
    {
      $data=Query::find($id);
      $airlines = airlineList::where('status','1')->get();
      $iatalist = iataList::where('status','1')->get();
      $rates =rates::all();
      $inclusions = PkgInclusions::where('status','1')->get();
      $exclusions = PkgExclusions::where('status','1')->get();
      $paymentPolicy = PkgPaymentPolicy::where('status','1')->get();
      $cancelPolicy = PkgCancelPolicy::where('status','1')->get();
      $visaPolicy = PkgVisa::where('status','1')->get();
      $imp_notes = ImportantNotes::all();
      $package_hotel = PackageHotel::all();
      $transport = Transport::all();
      $quotation_header = QuotationHeader::all();
      $quotation_footer = QuotationFooter::all();
      $supplier = Supplier::all();
      $gst = QuoteCharges::where('charges_type','=','GST')->get();
      $tcs = QuoteCharges::where('charges_type','=','TCS')->get();
      $pg = QuoteCharges::where('charges_type','=','PG')->get();
      $markup_profit = QuoteCharges::where('charges_type','=','Markup Profit')->get();
      $discunt_positive = QuoteCharges::where('charges_type','=','Discount (+)')->get();
      $discunt_negative = QuoteCharges::where('charges_type','=','Discount (-)')->get();
      $icons = Icons::all();
      $coupons = Coupon::all();
      return view('query.create',compact("data","rates","paymentPolicy","cancelPolicy","visaPolicy","imp_notes","package_hotel","transport","quotation_header","quotation_footer","airlines","iatalist","supplier",'gst','tcs','pg','inclusions','exclusions','markup_profit','discunt_positive','discunt_negative','icons','coupons'));  
    }*/
    public function quote_create_edit($data,$Packages, $action_type)
    {
    $continents = DB::table('continent')->get();
        $airlines = airlineList::where('status', '1')->get();
        $iatalist = iataList::where('status', '1')->get();
        $rates = rates::all();
        $inclusions = PkgInclusions::where('status', '1')->get();
        $exclusions = PkgExclusions::where('status', '1')->get();
        $paymentPolicy = PkgPaymentPolicy::where('status', '1')->get();
        $cancelPolicy = PkgCancelPolicy::where('status', '1')->get();
        $visaPolicy = PkgVisa::where('status', '1')->get();
        $imp_notes = ImportantNotes::all();
        $package_hotel = PackageHotel::all();
        $transport = Transport::all();
        $quotation_header = QuotationHeader::all();
        $quotation_footer = QuotationFooter::all();
        $supplier = Supplier::all();

        // Fetch quote charges based on charge types
        $quoteCharges = QuoteCharges::whereIn('charges_type', [
            'GST', 'TCS', 'PG', 'Markup Profit', 'Discount (+)', 'Discount (-)'
        ])->get()->groupBy('charges_type');

        // Fetch additional data
        $icons = Icons::all();
        $coupons = Coupon::all();
       $tourtypes = TourType::where('status','1')->get();
       $tourcategories  = TourCategory::where('status', '1')->get();
       $generals    =Gtags::all();
       $suitables   =Suitable::all();
       $holidays    =Holiday::all();
       $payathotelsdatas    =PayAtHotelPaymentType::all();
       $types = Pkgtype::where('status','1')->get();
       
       $activities = Activity::where('status','1')->get();


        $type=$action_type;
        // Return the view with the required data
        return view('query.create-edit', [
            'packagesData'=>CustomHelpers::get_package_details($Packages, 'main_data'),
            
            'tourtypes'=>$tourtypes,
            'tourcategories'=>$tourcategories,
            'suitables'    =>$suitables, 
            'generals'    =>$generals, 
            'holidays'    =>$holidays, 
            'PkgTours'=>CustomHelpers::get_package_details($Packages, 'PkgTours'),
            'types'=>$types,
            'activities'=>$activities,
            'action_type'=>$type,
            'data' => $data,
            'airlines' => $airlines,
            'iatalist' => $iatalist,
            'rates' => $rates,
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'paymentPolicy' => $paymentPolicy,
            'cancelPolicy' => $cancelPolicy,
            'visaPolicy' => $visaPolicy,
            'imp_notes' => $imp_notes,
            'package_hotel' => $package_hotel,
            'transport' => $transport,
            'quotation_header' => $quotation_header,
            'quotation_footer' => $quotation_footer,
            'supplier' => $supplier,
            'gst' => $quoteCharges['GST'] ?? collect(),
            'tcs' => $quoteCharges['TCS'] ?? collect(),
            'pg' => $quoteCharges['PG'] ?? collect(),
            'markup_profit' => $quoteCharges['Markup Profit'] ?? collect(),
            'discunt_positive' => $quoteCharges['Discount (+)'] ?? collect(),
            'discunt_negative' => $quoteCharges['Discount (-)'] ?? collect(),
            'icons' => $icons,
            'coupons' => $coupons,
            'continents'=>$continents,
            'payathotelsdatas'=>$payathotelsdatas,
        ]);
    }
    public function quo_new($id)
    {
        // Fetch required data 
        $data =DB::table('rt_package_query')
              ->where('rt_package_query.id',$id)
              ->first();
       
       $Packages = Packages::findOrFail($data->packageId);
        
       return $this->quote_create_edit($data,$Packages, 'quote');

        
    }

   
   public function edit_quation($id, $id2) {
        // Retrieve data from your models
        $data = Query::find($id2);
        $Packages =DB::table('quote')
              ->where('quo_ref',$id)
              ->first();

        return $this->quote_create_edit($data,$Packages, 'quote_edit');
        
    }

    /**********************/


    /*public function save_enq_type()
    {
        $data=EnqueryOTPSetting::find(1);
        if($data->status==1)
        {
        $return='otp';
        }
        else
        {
        $return='nonotp';    
        }
        echo $return;
    }*/

    public function save_enq_type()
    {
        $status = EnqueryOTPSetting::where('id', 1)->value('status');
        return response()->json($status == 1 ? 'otp' : 'nonotp');
    }


    /**********************/


    /*public function save_otp_Query(Request $request)
    {
        $validator = Validator::make($request->all(),
            [ 
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'time_call' => 'required',
            'city_of_residence' => 'required',
            'country_of_residence' => 'required',
            'destinations' => 'required', 
            'date_arrival' => 'required' 
            ]); 
            if($validator->fails()) {
                $a='';
                $messages = $validator->messages();
                foreach ($messages->all(':message') as $message) {
                    $a= $message;
                }
                echo $a;
            } else {
                $webnotation = 1;
                if(env("WEBSITENAME")==1):
                    $webnotation = 1;
                elseif(env("WEBSITENAME")==0):
                    $webnotation = 0;
                endif;
                $data=[
                    'packageId'=>$request->packageId,
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'channel_type'=>$request->channel_type,
                    'service_type'=>$request->service_type,
                    'mobile'=>$request->mobile,
                    'message'=>$request->message,
                    'city_of_residence' => $request->city_of_residence,
                    'country_of_residence' => $request->country_of_residence,
                    'destinations' => $request->package_name,
                    'date_arrival' =>date("Y-m-d",strtotime($request->date_arrival)) ,
                    'duration' =>$request->duration,
                    'span_value_adult' =>$request->span_value_adult,
                    'span_value_child'=> $request->span_value_child,
                    'span_value_infant'=> $request->span_value_infant,
                    'span_value_child_without_bed'=> $request->span_value_child_without_bed,
                    'hotel_pre' =>$request->hotel_pre,
                    'exp_budget'=> $request->exp_budget,
                    'time_call' =>$request->time_call,
                    'accept_value' => $request->accept_value,
                    'package_name' => $request->package_name,
                    'status'=> 'interested',
                    'webnotation' =>$webnotation,
                ];
                if(Session::has('enq_info')) {
                    Session::forget('enq_info');
                }
                Session::set('enq_info',$data);
                // dd(Session::get('enq_info'));
                $otp=mt_rand(10000,99999);
                $login_email=$request->email;
                $name=$request->name;
                $mobile=$request->mobile;
                setcookie('email_otp',$otp);
                setcookie('enq_email',$login_email);
                setcookie('enq_mobile',$mobile);
                Mail::raw("Hello $name,  your OTP is: $otp" , function ($message) use ($login_email) {
                    $message->to($login_email);
                    $message->from($login_email,"The WorldGateway");
                    $message->subject("Hello ,  Email OTP.");
                });
                $otp_mobile=mt_rand(10000,99999);
                $status=CustomHelpers::otp_send($mobile,$otp_mobile);
                echo 'success';
            }
    }*/

    /*public function save_otp_Query(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits_between:8,15',
            'email' => 'required|email|max:255',
            'time_call' => 'required',
            'city_of_residence' => 'required|string|max:255',
            'country_of_residence' => 'required|string|max:255',
            'destinations' => 'required|string|max:255',
            'date_arrival' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Determine webnotation value
        $webnotation = env("WEBSITENAME") == 1 ? 1 : 0;

        // Prepare data array
        $data = [
            'packageId' => $request->packageId,
            'name' => $request->name,
            'email' => $request->email,
            'channel_type' => $request->channel_type,
            'service_type' => $request->service_type,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'city_of_residence' => $request->city_of_residence,
            'country_of_residence' => $request->country_of_residence,
            'destinations' => $request->package_name,
            'date_arrival' => date("Y-m-d", strtotime($request->date_arrival)),
            'duration' => $request->duration,
            'span_value_adult' => $request->span_value_adult,
            'span_value_child' => $request->span_value_child,
            'span_value_infant' => $request->span_value_infant,
            'span_value_child_without_bed' => $request->span_value_child_without_bed,
            'hotel_pre' => $request->hotel_pre,
            'exp_budget' => $request->exp_budget,
            'time_call' => $request->time_call,
            'accept_value' => $request->accept_value,
            'package_name' => $request->package_name,
            'status' => 'interested',
            'webnotation' => $webnotation,
        ];

        // Store in session
        Session::forget('enq_info');
        Session::put('enq_info', $data);

        // Generate OTPs
        $otp_email = rand(100000, 999999); // Secure 6-digit OTP
        $otp_mobile = rand(100000, 999999);

        // Store OTPs in cookies (expires in 5 minutes)
        setcookie('email_otp', $otp_email, time() + 30, "/");
        setcookie('enq_email', $request->email, time() + 30, "/");
        setcookie('enq_mobile', $request->mobile, time() + 30, "/");

        // Send OTP email
        try {
            Mail::raw("Hello {$request->name}, your OTP is: $otp_email", function ($message) use ($request) {
                $message->to($request->email);
                $message->from(config('mail.from.address'), "The WorldGateway");
                $message->subject("Email OTP Verification");
            });
        } catch (\Exception $e) {
            Log::error("OTP Email failed: " . $e->getMessage());
        }

        // Send OTP SMS
        $status = CustomHelpers::otp_send($request->mobile, $otp_mobile);

        //return response()->json(['success' => 'OTP sent successfully'], 200);
        echo 'success';
    }*/

    public function save_otp_Query(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'time_call' => 'required',
            'city_of_residence' => 'required',
            'country_of_residence' => 'required',
            'destinations' => 'required',
            'date_arrival' => 'required|date'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
    
        $webnotation = env("WEBSITENAME") == 1 ? 1 : 0;
        $websiteName = getWebsiteData('name');
        $senderEmail = getWebsiteData('sender_email');
        $replyToEmail = getWebsiteData('reply_to_email');
        dd($senderEmail, $websiteName, $replyToEmail);
    
        $data = [
            'packageId' => $request->packageId,
            'name' => $request->name,
            'email' => $request->email,
            'channel_type' => $request->channel_type,
            'service_type' => $request->service_type,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'city_of_residence' => $request->city_of_residence,
            'country_of_residence' => $request->country_of_residence,
            'destinations' => $request->destinations,
            'date_arrival' => date("Y-m-d", strtotime($request->date_arrival)),
            'duration' => $request->duration,
            'span_value_adult' => $request->span_value_adult,
            'span_value_child' => $request->span_value_child,
            'span_value_infant' => $request->span_value_infant,
            'span_value_child_without_bed' => $request->span_value_child_without_bed,
            'hotel_pre' => $request->hotel_pre,
            'exp_budget' => $request->exp_budget,
            'time_call' => $request->time_call,
            'accept_value' => $request->accept_value,
            'package_name' => $request->package_name,
            'status' => 'interested',
            'webnotation' => $webnotation,
        ];
    
        Session::put('enq_info', $data);
    
        // Generate OTPs
        $otp_email = mt_rand(10000, 99999);
        $otp_mobile = mt_rand(10000, 99999);
    
        // Set short-lived cookies
        setcookie('email_otp', $otp_email, time() + 30, "/");
        setcookie('enq_email', $request->email, time() + 30, "/");
        setcookie('enq_mobile', $request->mobile, time() + 30, "/");
    
        try {
            Mail::raw("Hi {$request->name}, your OTP is: $otp_email", function ($message) use ($request, $senderEmail, $websiteName, $replyToEmail) {
                $message->to($request->email);
                $message->from($senderEmail, $websiteName);
                $message->subject("Email OTP");
                $message->replyTo($replyToEmail);
            });
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to send email OTP.']);
        }
    
        // Send Mobile OTP
        $status = CustomHelpers::otp_send($request->mobile, $otp_mobile);
    
        if (!$status) {
            return response()->json(['status' => 'error', 'message' => 'Failed to send mobile OTP.']);
        }
    
        return response()->json(['status' => 'success']);
    }
    


    /**********************/

    // resend OTP (old with email id error)
    /*public function resend_otp()
    {
        $request_data=Session::get('enq_info');
        
        $login_email=$request_data['email'];
        $name=$request_data['name'];
        $mobile=$request_data['mobile'];

        $otp=mt_rand(10000,99999);

        setcookie('email_otp',$otp);
        setcookie('enq_email',$login_email);
        setcookie('enq_mobile',$mobile);

        Mail::raw("Hi $name,  Your OTP is: $otp" , function ($message) use ($login_email) {
            $message->to($login_email);
            $message->from($login_email,"The WorldGateway");
            $message->subject("Email OTP.");
        });
        
        $otp_mobile=mt_rand(10000,99999);
        
        $status=CustomHelpers::otp_send($mobile,$otp_mobile);
        
        echo 'success';   
    }*/

    // resend OTP (new)
    public function resend_otp(Request $request)
    {
        $request_data = Session::get('enq_info');

        if (!$request_data || !isset($request_data['email'], $request_data['name'], $request_data['mobile'])) {
            return response()->json(['status' => 'error', 'message' => 'Session expired. Please try again.'], 400);
        }

        $login_email = trim($request_data['email']);
        $name = trim($request_data['name']);
        $mobile = trim($request_data['mobile']);

        // Validate Email Before Sending
        if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'error', 'message' => 'Enter valid email-id'], 400);
        }

        $otp_email = mt_rand(10000, 99999);
        $otp_mobile = mt_rand(10000, 99999);

        $websiteName = getWebsiteData('name');
        $senderEmail = getWebsiteData('sender_email');
        $replyToEmail = getWebsiteData('reply_to_email');

        setcookie('email_otp', $otp_email, time() + 30, "/");
        setcookie('enq_email', $login_email, time() + 30, "/");
        setcookie('enq_mobile', $mobile, time() + 30, "/");

        // Debugging Log
        //\Log::info("Sending OTP to Email: " . $login_email);

        try {
            Mail::raw("Hi $name, your OTP is: $otp_email", function ($message) use ($login_email, $websiteName, $senderEmail) {
                $message->to($login_email);
                $message->from($senderEmail, $websiteName);
                $message->subject("Email OTP");
            });
        } catch (\Exception $e) {
            \Log::error("Email OTP Failed: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send OTP via email.'], 500);
        }

        // $sms_status = CustomHelpers::otp_send($mobile, $otp_mobile);
        $sms_status = CustomHelpers::otp_send($request->mobile, $otp_mobile);

        if (!$sms_status) {
            return response()->json(['status' => 'error', 'message' => 'Failed to send OTP via SMS.'], 500);
        }

        return response()->json(['status' => 'success', 'message' => 'OTP has been resent successfully!']);
    }


    /**********************/


    /*public function savequery_with_otp(Request $request)
    {
        $otp=$request->otp_value;

        $mobile_otp=$_COOKIE['otp'];
        $email_otp=$_COOKIE['email_otp'];
        if($otp==$mobile_otp):
        $email=$_COOKIE['enq_email'];
        $mobile=$_COOKIE['enq_mobile'];
        
        $request_data=Session::get('enq_info');

        $query = new Query;
    
        $query->packageId = $request_data['packageId'];
        $query->name = $request_data['name'];
        $query->email = $request_data['email'];
        $query->channel_type = $request_data['channel_type'];
        $query->service_type = $request_data['service_type'];
        $query->mobile = $request_data['mobile'];
        $query->message = $request_data['message'];
        $query->city_of_residence = $request_data['city_of_residence'];
        $query->country_of_residence = $request_data['country_of_residence'];
        $query->destinations = $request_data['destinations'];
        $query->date_arrival = $request_data['date_arrival'];
        $query->duration = $request_data['duration'];
        $query->span_value_adult = $request_data['span_value_adult'];
        $query->span_value_child = $request_data['span_value_child'];
        $query->span_value_infant = $request_data['span_value_infant'];
        $query->hotel_pre = $request_data['hotel_pre'];
        $query->exp_budget = $request_data['exp_budget'];
        $query->time_call = $request_data['time_call'];
        $query->accept_value = $request_data['accept_value']; 
        $query->package_name = $request_data['package_name'];
        $query->span_value_child_without_bed = $request_data['span_value_child_without_bed'];
        $query->status = $request_data['status'];
        $query->otp_verified = 1;
        $query->webnotation = $request_data['webnotation'];
      
        if($query->save()):
        $reference=date("Y").date("d").date("m").$query->id;
        $data=Query::find($query->id);
             $data->enquiry_ref_no=$reference;
             $data->save();
        
            $this->send_enquiry_email($query,'mobile');
            CustomHelpers::save_enquiry_tracker($query->id,'New Enquiry Initiated');

            echo 'success';
            endif;
            elseif($otp==$email_otp):
            $email=$_COOKIE['enq_email'];
            $mobile=$_COOKIE['enq_mobile'];
            $email=$_COOKIE['enq_email'];
            $mobile=$_COOKIE['enq_mobile'];
            
            $request_data=Session::get('enq_info');
       
            $query = new Query;
        $query->channel_type = $request_data['channel_type'];
        $query->service_type = $request_data['service_type'];

        $query->packageId = $request_data['packageId'];
        $query->name = $request_data['name'];
        $query->email = $request_data['email'];
        $query->mobile = $request_data['mobile'];
        $query->message = $request_data['message'];
        $query->city_of_residence = $request_data['city_of_residence'];
        $query->country_of_residence = $request_data['country_of_residence'];
        $query->destinations = $request_data['destinations'];
        $query->date_arrival = $request_data['date_arrival'];
        $query->duration = $request_data['duration'];
        $query->span_value_adult = $request_data['span_value_adult'];
        $query->span_value_child = $request_data['span_value_child'];
        $query->span_value_infant = $request_data['span_value_infant'];
        $query->hotel_pre = $request_data['hotel_pre'];
        $query->exp_budget = $request_data['exp_budget'];
        $query->time_call = $request_data['time_call'];
        $query->accept_value = $request_data['accept_value']; 
        $query->package_name = $request_data['package_name'];
        $query->span_value_child_without_bed = $request_data['span_value_child_without_bed'];
        $query->status = $request_data['status'];
        $query->webnotation = $request_data['webnotation'];
        $query->otp_verified = 1;
        if($query->save()):
           $reference=date("Y").date("d").date("m").$query->id;
        $data=Query::find($query->id);
             $data->enquiry_ref_no=$reference;
             $data->save();
        $this->send_enquiry_email($query,'email');
        CustomHelpers::save_enquiry_tracker($query->id,'New Enquiry Initiated');

         echo 'success';
        endif;
           else:
            echo 'Enter Correct OTP';
           endif;
    }*/

    public function savequery_with_otp(Request $request)
    {
        $otp = $request->otp_value;

        // Ensure cookies exist before accessing them
        $mobile_otp = $_COOKIE['otp'] ?? null;
        $email_otp = $_COOKIE['email_otp'] ?? null;

        // Check if OTP matches either mobile or email OTP
        if ($otp === $mobile_otp || $otp === $email_otp) {
            // Ensure session data is available
            $request_data = Session::get('enq_info');
            if (!$request_data) {
                echo 'Session expired. Please try again.';
                return;
            }

            // Create and save the query
            $query = new Query;
            $query->packageId = $request_data['packageId'];
            $query->name = $request_data['name'];
            $query->email = $request_data['email'];
            $query->mobile = $request_data['mobile'];
            $query->channel_type = $request_data['channel_type'];
            $query->service_type = $request_data['service_type'];
            $query->message = $request_data['message'];
            $query->city_of_residence = $request_data['city_of_residence'];
            $query->country_of_residence = $request_data['country_of_residence'];
            $query->destinations = $request_data['destinations'];
            $query->date_arrival = $request_data['date_arrival'];
            $query->duration = $request_data['duration'];
            $query->span_value_adult = $request_data['span_value_adult'];
            $query->span_value_child = $request_data['span_value_child'];
            $query->span_value_infant = $request_data['span_value_infant'];
            $query->span_value_child_without_bed = $request_data['span_value_child_without_bed'];
            $query->hotel_pre = $request_data['hotel_pre'];
            $query->exp_budget = $request_data['exp_budget'];
            $query->time_call = $request_data['time_call'];
            $query->accept_value = $request_data['accept_value'];
            $query->package_name = $request_data['package_name'];
            $query->status = $request_data['status'];
            $query->webnotation = $request_data['webnotation'];
            $query->otp_verified = 1;

            if ($query->save()) {
                $reference = date("Y") . date("d") . date("m") . $query->id;
                $query->enquiry_ref_no = $reference;
                $query->save();

                // Determine if the OTP was verified via mobile or email
                $otp_type = ($otp === $mobile_otp) ? 'mobile' : 'email';

                // Send email and track the enquiry
                $this->send_enquiry_email($query, $otp_type);
                CustomHelpers::save_enquiry_tracker($query->id, 'New Enquiry Initiated');

                echo 'success';
            } else {
                echo 'Failed to save enquiry. Please try again.';
            }
        } else {
            echo 'Enter Correct OTP';
        }
    }

    /**********************/


    

    public function saveQuery(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric',
            'email' => 'required|email|max:255',
            'time_call' => 'required|string',
            'city_of_residence' => 'required|string|max:255',
            'country_of_residence' => 'required|string|max:255',
            'destinations' => 'required|string',
            'date_arrival' => 'required|date',
            'channel_type' => 'required|string',  // Assuming these are required
            'service_type' => 'required|string',  // Assuming these are required
        ]);

        $query = new Query;
        $query->channel_type = $request->channel_type;
        $query->service_type = $request->service_type;
        $query->packageId = $request->packageId;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->country_code = $request->country_code;
        $query->mobile = $request->mobile;
        $query->time_call = $request->time_call;
        $query->country_of_residence = $request->country_of_residence;
        $query->destinations = $request->destinations;
        $query->date_arrival = date("Y-m-d", strtotime($request->date_arrival));        
        $query->city_of_residence = $request->city_of_residence;        
        $query->duration = $request->duration;
        $query->exp_budget = $request->exp_budget;
        $query->hotel_pre = $request->hotel_pre;
        $query->cruiseline = $request->cruiseline;
        $query->cruisecabin = $request->cruisecabin;
        $query->visatype = $request->visatype;
        $query->visavalidity = $request->visavalidity;
        $query->visaentry = $request->visaentry;
        $query->visaservice = $request->visaservice;
        $query->span_value_adult = $request->span_value_adult;
        $query->span_value_child = $request->span_value_child;
        $query->span_value_child_without_bed = $request->span_value_child_without_bed;
        $query->span_value_infant = $request->span_value_infant;
        $query->package_name = $request->package_name;        
        $query->accept_value = $request->accept_value;
        $query->message = $request->message;
        $query->status = 'interested';

        // Set webnotation based on environment setting
        $query->webnotation = env("WEBSITENAME") == 1 ? 1 : 0;

        if ($query->save()) {
            $reference = date("Ydm") . $query->id;
            $query->enquiry_ref_no = $reference;
            $query->save();

            $this->send_enquiry_email($query, 'na');
            CustomHelpers::save_enquiry_tracker($query->id, 'New Enquiry Initiated');

            return response()->json(['message' => 'Success'], 200);
        }

        return response()->json(['message' => 'Failed to save query'], 500);
    }

    
    /**********************/


    /*public function send_enquiry_email($query,$verified)
    {
        $email=$query->email;
        $check_data=DB::table('users')->where('email',strtolower($email))->first();
        if($check_data=='')
        {
        if($verified=='email')
        {
        $email_verify=1;
        }
        else
        {
        $email_verify=0;
        }
          $dataEdit = [
                        'first_name' => $query->name,
                        'password' => 123456,
                        'email' => $query->email,
                        'email_activation' => $email_verify,
                        ];  
         $user= Sentinel::registerAndActivate($dataEdit);
         $role = Sentinel::findRoleBySlug('customer');
         $role->users()->attach($user);
         //
         $user_details=UserDetails::where('user_id',$query->email)->first();
            if($user_details=='')
            {
             $user_details=new  UserDetails;
             
             
            }
            $user_details->user_id=$user->id;  
            $user_details->country_code=$query->country_code;  
            $user_details->phone_no=$query->mobile; 
            if($verified=='mobile')
            {
           $user_details->mobile_verify=$user->id;  
           } 
            
          
            $user_details->save();

         //
         $to=$email;
         try{
            Mail::send('query.mail.enquiry_mail.newregistration_with_enq',compact("query"),function($message) use ($to)
           {
          $message->from($this->mail_from_reservations);
          $message->to($to)->subject("New Enq1");
        
          });
         }
          catch(\Exception $e){ // Using a generic exception
       
           }
          }
          else
          {
             if($verified=='email')
            {
            $email_verify=1;
            }
            elseif($check_data->email_activation==1)
            {
             $email_verify=1; 
            }
            else
            {
            $email_verify=0;
            }
              $dataEdit = [
                            'email_activation' => $email_verify,
                            ];  
            $user=DB::table('users')->where('email',$email)->first();
             $user = Sentinel::findById($user->id);
             $save = Sentinel::update($user, $dataEdit);

             //
             $user_details=UserDetails::where('user_id',$query->email)->first();
                if($user_details=='')
                {
                 $user_details=new  UserDetails;
                 
          
                }
                $user_details->user_id=$user->id;  
                $user_details->country_code=$query->country_code;  
                $user_details->phone_no=$query->mobile; 
                if($verified=='mobile')
                {
               $user_details->mobile_verify=1;  
               } 
                
              
                $user_details->save();

             //
            try{
             $to=$email;
             Mail::send('query.mail.enquiry_mail.new_enq',compact("query"),function($message) use ($to)
               {
              $message->from($this->mail_from_reservations);
              $message->to($to)->subject("New Enq2");
              });
              }
              catch(\Exception $e){ // Using a generic exception
               }
          }
    }*/

    /*public function send_enquiry_email($query, $verified)
    {
        $email = strtolower($query->email);
        $check_data = DB::table('users')->where('email', $email)->first();

        if (!$check_data) { // User does not exist
            $email_verify = ($verified === 'email') ? 1 : 0;

            $password = Str::random(8); // Generate a secure random password
            $dataEdit = [
                'first_name' => $query->name,
                'password' => $password,
                'email' => $query->email,
                'email_activation' => $email_verify,
            ];

            try {
                // Register and activate user
                $user = Sentinel::registerAndActivate($dataEdit);
                $role = Sentinel::findRoleBySlug('customer');
                $role->users()->attach($user);

                // Check or create user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send registration email
                Mail::send('query.mail.enquiry_mail.newregistration_with_enq', compact("query", "password"), function ($message) use ($email) {
                    $message->from($this->mail_from_reservations);
                    $message->to($email)->subject("Welcome! Your Registration is Successful");
                });

            } catch (\Exception $e) {
                Log::error("User registration error: " . $e->getMessage());
            }

        } else { // User already exists
            $email_verify = ($verified === 'email' || $check_data->email_activation == 1) ? 1 : 0;

            try {
                // Update user email verification status
                $user = Sentinel::findById($check_data->id);
                Sentinel::update($user, ['email_activation' => $email_verify]);

                // Update user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send enquiry email
                Mail::send('query.mail.enquiry_mail.new_enq', compact("query", "password"), function ($message) use ($email) {
                    $message->from($this->mail_from_reservations);
                    $message->to($email)->subject("Thank You! We've Received Your Enquiry");
                });


            } catch (\Exception $e) {
                Log::error("User update error: " . $e->getMessage());
            }
        }
    }*/

    /*public function send_enquiry_email($query, $verified)
    {
        $email = strtolower($query->email);
        $check_data = DB::table('users')->where('email', $email)->first();

        if (!$check_data) { // User does not exist
            $email_verify = ($verified === 'email') ? 1 : 0;

            $password = Str::random(8); // Generate a secure random password
            $dataEdit = [
                'first_name' => $query->name,
                'password' => $password,
                'email' => $query->email,
                'email_activation' => $email_verify,
            ];

            try {
                // Register and activate user
                $user = Sentinel::registerAndActivate($dataEdit);
                $role = Sentinel::findRoleBySlug('customer');
                $role->users()->attach($user);

                // Check or create user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send registration email
                Mail::send('query.mail.enquiry_mail.newregistration_with_enq', compact("query"), function ($message) use ($email) {
                    $message->from($this->mail_from_reservations);
                    $message->to($email)->subject("Welcome! Your Registration is Successful");
                });

            } catch (\Exception $e) {
                Log::error("User registration error: " . $e->getMessage());
            }

        } else { // If User already exists
            $email_verify = ($verified === 'email' || $check_data->email_activation == 1) ? 1 : 0;

            try {
                // Update user email verification status
                $user = Sentinel::findById($check_data->id);
                Sentinel::update($user, ['email_activation' => $email_verify]);

                // Update user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send enquiry email
                Mail::send('query.mail.enquiry_mail.new_enq', compact("query"), function ($message) use ($email) {
                    $message->from($this->mail_from_reservations);
                    $message->to($email)->subject("Thank You! We've Received Your Enquiry");
                });

            } catch (\Exception $e) {
                Log::error("User update error: " . $e->getMessage());
            }
        }
    }*/

    public function send_enquiry_email($query, $verified)
    {
        $email = strtolower($query->email);
        $check_data = DB::table('users')->where('email', $email)->first();

     
        $webnotation = env("WEBSITENAME") == 1 ? 1 : 0;

        
        $websiteName = getWebsiteData('name');
        $senderEmail = getWebsiteData('sender_email');
        $replyToEmail = getWebsiteData('reply_to_email');

        if (!$check_data) { // User does not exist
            $email_verify = ($verified === 'email') ? 1 : 0;

            $password = Str::random(8); // Generate a secure random password
            $dataEdit = [
                'first_name' => $query->name,
                'password' => $password,
                'email' => $query->email,
                'email_activation' => $email_verify,
            ];

            try {
                // Register and activate user
                $user = Sentinel::registerAndActivate($dataEdit);
                $role = Sentinel::findRoleBySlug('customer');
                $role->users()->attach($user);

                // Check or create user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send registration email
                Mail::send('query.mail.enquiry_mail.newregistration_with_enq', compact("query"), function ($message) use ($email, $senderEmail, $websiteName, $replyToEmail) {
                    $message->from($senderEmail, $websiteName); // Set sender dynamically
                    $message->to($email)->subject("Welcome! Your Registration is Successful");
                    $message->replyTo($replyToEmail); // Set reply-to email
                });

            } catch (\Exception $e) {
                Log::error("User registration error: " . $e->getMessage());
            }

        } else { // If User already exists
            $email_verify = ($verified === 'email' || $check_data->email_activation == 1) ? 1 : 0;

            try {
                // Update user email verification status
                $user = Sentinel::findById($check_data->id);
                Sentinel::update($user, ['email_activation' => $email_verify]);

                // Update user details
                $user_details = UserDetails::firstOrNew(['user_id' => $query->email]);
                $user_details->user_id = $user->id;
                $user_details->country_code = $query->country_code;
                $user_details->phone_no = $query->mobile;
                if ($verified === 'mobile') {
                    $user_details->mobile_verify = 1;
                }
                $user_details->save();

                // Send enquiry email
                Mail::send('query.mail.enquiry_mail.new_enq', compact("query"), function ($message) use ($email, $senderEmail, $websiteName, $replyToEmail) {
                    $message->from($senderEmail, $websiteName); // Set sender dynamically
                    $message->to($email)->subject("Thank You! We've Received Your Enquiry");
                    $message->replyTo($replyToEmail); // Set reply-to email
                });

            } catch (\Exception $e) {
                Log::error("User update error: " . $e->getMessage());
            }
        }
    }


    /**********************/


    /*public function query_status(Request $request) 
    {
        $id=$request->id;
        $status=$request->status_value;

        $data=Query::find($id);
        $data->status=$status;
        $data->save();
    }*/

    public function query_status(Request $request) 
    {
        $request->validate([
            'id' => 'required|integer|exists:queries,id',
            'status_value' => 'required|string|max:255'
        ]);

        try {
            $query = Query::find($request->id);
            if (!$query) {
                return response()->json(['error' => 'Query not found'], 404);
            }

            $query->status = $request->status_value;
            $query->save();

            return response()->json(['success' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error("Query status update failed: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }

    
    /**********************/
    
    /*public function role_assign(Request $request) {
        $id=$request->id;
        $assign_id=$request->assign_id;
        
        $data=Query::find($id);

        $data->assign_id=$assign_id;
        $data->save();

        $data1=Option1Quotation::where("query_reference","=",$id)->first();
        if($data1):
            $data1->assign_id=$assign_id;
            $data1->save();
        endif;

        CustomHelpers::save_enquiry_tracker($id,'Travel consultant assigned successfully',Sentinel::getUser()->id,'Assigned User',$assign_id);
        CustomHelpers::send_assign_user_notification($assign_id,$data,$this->mail_from_reservations);
    }*/

    public function user_assign(Request $request) {
        $id = $request->id;
        $assign_id = $request->assign_id;
        
        // Find the query by ID
        $data = Query::find($id);
        
        // Assign the consultant (assign_id) to the query
        if ($data) {
            $data->assign_id = $assign_id;
            $data->save();

            // Check if there is an associated Option1Quotation and update it
            $data1 = Quote::where("query_reference", "=", $id)->first();
            if ($data1) {
                $data1->assign_id = $assign_id;
                $data1->save();
            }

            // Log the assignment in the enquiry tracker
            CustomHelpers::save_enquiry_tracker($id, 'Travel consultant assigned successfully', Sentinel::getUser()->id, 'Assigned User', $assign_id);

            // Send notification to the enquiry person
            CustomHelpers::send_assign_user_notification($assign_id, $data, $this->mail_from_reservations);
        } else {
            // Handle the case where the query is not found
            /*return response()->json(['error' => 'Query not found.'], 404);*/
            return response()->json(['success' => 'Travel consultant assigned successfully.'], 200);

        }
    }

    /**********************/

    /*public function lead_varified(Request $request)
    {
        $id=$request->id;
        $status=$request->status_value;

        $data=Query::find($id);

        $travel_date=$data->date_arrival;
        $today=date('Y-m-d');

        if($travel_date<$today) {
            echo 'error';
        } else {
            $data->lead_verified=$status;
            $data->status='pending_quote';
            $data->save();
            CustomHelpers::save_enquiry_tracker($id,'Lead Verified & Pending Quote',Sentinel::getUser()->id,'pending_quote');
            echo 'success';
        }
    }*/

    public function lead_varified(Request $request)
    {
        $id = $request->id;
        $status = $request->status_value;
        
        // Find the Query record by ID
        $data = Query::find($id);

        // Check if the Query record exists
        if (!$data) {
            return response()->json(['error' => 'Lead not found'], 404);
        }

        // Compare travel_date with today's date
        $travel_date = Carbon::parse($data->date_arrival);
        $today = Carbon::today();
        
        if ($travel_date->lessThan($today)) {

            return response()->json(['error' => 'Travel date has passed'], 400);
            //echo 'error';
        }

        $data->lead_verified = $status;
        $data->status = 'pending_quote';
         $data->save();

        // Save the enquiry tracker log
        CustomHelpers::save_enquiry_tracker($id, 'Lead Verified (moved into quote pending)', Sentinel::getUser()->id, 'pending_quote');

        return response()->json(['success' => 'Lead verified and moved into "Quote Pending"']);
    }


    /**********************/

    /*public function update_booking_label(Request $request)  {
        $id=$request->id;
        $booking_label=$request->booking_label;
        $data=Query::find($id);
        $assigned_label=$data->booking_label;
        $data->booking_label=$booking_label;
        $data->save();

        $description='Lead label updated from ' .CustomHelpers::get_master_table_data('lead_dynamic_field','id',(int)$assigned_label,'field_name').' to '.CustomHelpers::get_master_table_data('lead_dynamic_field','id',(int)$booking_label,'field_name');
        CustomHelpers::save_enquiry_tracker($data->id,$description,Sentinel::getUser()->id,'booking_label');
    }*/

    public function update_booking_label(Request $request) {
        $id = $request->id;
        $booking_label = $request->booking_label;
        $data = Query::find($id);
        $assigned_label = $data->booking_label;

        // Update the booking label
        $data->booking_label = $booking_label;
        $data->save();

        // Handle the case where assigned_label is empty or null
        $old_label_name = empty($assigned_label) ? '""' : '"' . CustomHelpers::get_master_table_data('lead_dynamic_field', 'id', (int)$assigned_label, 'field_name') . '"';
        $new_label_name = '"' . CustomHelpers::get_master_table_data('lead_dynamic_field', 'id', (int)$booking_label, 'field_name') . '"';

        // Create the description with labels in double quotes
        $description = 'Lead label updated from ' . $old_label_name . ' to ' . $new_label_name;

        // Save the enquiry tracker entry
        CustomHelpers::save_enquiry_tracker($data->id, $description, Sentinel::getUser()->id, 'booking_label');
    }

    /**********************/

    /*public function lead_unvarified(Request $request) {
        // Retrieve the ID from the request
        $id = $request->id;

        // Find the Query model by ID
        $data = Query::find($id);

        // Set lead_verified to 0 (unverified)
        $data->lead_verified = 0;

        // Set quo_send to 0 (quote not sent)
        $data->quo_send = 0;

        // Update the status to 'interested'
        $data->status = 'interested';

        // Save the updated model back to the database
        $data->save();

        // Log the action using a custom helper function
        CustomHelpers::save_enquiry_tracker(
            $id, // Enquiry ID
            'Lead Un-Verified', // Action description
            Sentinel::getUser()->id, // ID of the user performing the action
            'Lead Un-Verified' // Additional action description
        );
    }*/

    public function lead_unvarified(Request $request) {
        // Retrieve the ID from the request
        $id = $request->id;

        // Find the specific query record by ID
        $data = Query::find($id);

        // Mark the lead as unverified, reset the quotation status, and set status to 'interested'
        $data->lead_verified = 0;
        $data->quo_send = 0;
        $data->status = 'interested';
        $data->save();

        // Retrieve the user associated with the lead, if any
        $user = DB::table('users')->where('id', $data->assign_user)->first();

        // Prepare the message to include the user's name
        $actionMessage = 'Lead Un-Verified';
        if ($user) {
            $actionMessage .= ' by ' . $user->first_name;
        }

        // Save the enquiry tracker log with the user name
        CustomHelpers::save_enquiry_tracker($id, $actionMessage, Sentinel::getUser()->id, $actionMessage);

        // Optionally, log the action for debugging purposes
        // \Log::info($actionMessage);
    }

    /**********************/
  
    // View Lead
    public function enq_data(Request $request) 
    {
        try {
            $id = $request->id;
            $data = Query::find($id);

            if (!$data) {
                Log::error('No data found for ID: ' . $id);
                return response()->json(['error' => 'No data found'], 404);
            }

            $package_name = CustomHelpers::get_package_name($data->packageId);

            /*if (is_numeric((int)$data->packageId)) {
                $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$data->packageId, 'city');
                $cities = unserialize($cities);
                $output = '';
                $a = 1;
                if ($cities && is_array($cities)) {
                    foreach ($cities as $c) {
                        if ($a > 1) {
                            $output .= ',';
                        }
                        $output .= $c;
                        $a++;
                    }
                } else {
                    Log::error('No valid cities data found or unable to unserialize data for package ID: ' . $data->packageId);
                    $output = $data->destinations;
                }
            } else {
                $output = $data->destinations;
            }*/

            if (is_numeric((int)$data->packageId)) {
                $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$data->packageId, 'city');

                // Ensure it's an array before attempting to unserialize
                if (!is_array($cities)) {
                    if (is_string($cities) && strpos($cities, 'a:') === 0) {
                        $cities = unserialize($cities);
                    } else {
                        Log::error('Cities data is not an array or a serialized string in enq_data: ' . json_encode($cities));
                        $cities = [];
                    }
                }

                $output = '';
                $a = 1;
                if (!empty($cities) && is_array($cities)) {
                    foreach ($cities as $c) {
                        if ($a > 1) {
                            $output .= ',';
                        }
                        $output .= $c;
                        $a++;
                    }
                } else {
                    Log::error('No valid cities data found for package ID: ' . $data->packageId);
                    $output = $data->destinations;
                }
            } else {
                $output = $data->destinations;
            }

            $response = "<div class='col-md-12'>
                <div class='form-group'>
                <label>Enquiry Ref No: #$data->enquiry_ref_no</label>
                <br>
                 </div>
                 </div> <div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
               

                    <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Name</strong></div>
                    <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->name</div>
                  </div>";
               
            $loged_user = Sentinel::getUser();
            if ($loged_user->lock_before_quote_send == '') {
                $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                    <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Contact Number</strong></div>
                    <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->mobile</div>
                  </div>";

                $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                    <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Email Id</strong></div>
                    <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: lowercase'>$data->email</div>
                  </div>";
            } else {
                $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                    <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Contact Number</strong></div>
                    <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>" . CustomHelpers::mask_mobile_no($data->mobile) . "</div>
                  </div>";

                $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                    <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Email Id</strong></div>
                    <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: lowercase'>" . CustomHelpers::partiallyHideEmail($data->email) . "</div>
                  </div>";
            }

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Residence City</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->city_of_residence</div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Country</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->country_of_residence</div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Destination</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$output</div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Arrival Date</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>" . date('d-m-Y', strtotime($data->date_arrival)) . "</div>
              </div>";
              
            $day_s = (int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
            $nights = $day_s - 1;
            $out = $nights . ' Nights / ' . $day_s . ' Days';
            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Duration</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$out </div>
              </div>";
              
            $adult = $data->span_value_adult > 0 ? $data->span_value_adult . ' Adults,' : '';
            $child = $data->span_value_child > 0 ? $data->span_value_child . ' Child,' : '';
            $child_without_bed = $data->span_value_child_without_bed > 0 ? $data->span_value_child_without_bed . ' Child Without Bed,' : '';
            $infant = $data->span_value_infant > 0 ? $data->span_value_infant . ' Infants' : '';
            $all = $adult . $child . $child_without_bed . $infant;

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Travellers</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$all</div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Hotel Preference</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->hotel_pre Star</div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Expected Budget</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->exp_budget </div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Best Time To Call</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->time_call </div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Message</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$data->message </div>
              </div>";

            $response .= "<div class='' style='padding: 0px 20px;margin-bottom: 10px;display: flex;align-items: center'>
                <div class='col-md-3 col-xs-4' style='padding: 0px;margin-right: 20px'><strong>Package Name</strong></div>
                <div class='col-md-9 col-xs-8' style='padding: 5px 10px;height: 35px;border-radius: 3px;border: 1px solid #ccc;text-transform: capitalize'>$package_name</div>
              </div>";

            return response($response);
        } catch (\Exception $e) {
            Log::error('Error in enq_data: ' . $e->getMessage());
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    /*// View Lead - link html from views
    public function enq_data(Request $request) 
    {
        try {
            $id = $request->id;
            $data = Query::find($id);

            if (!$data) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $package_name = CustomHelpers::get_package_name($data->packageId);

            $cities = [];
            if (is_numeric((int)$data->packageId)) {
                $citiesSerialized = CustomHelpers::get_master_table_data('rt_packages', 'id', (int)$data->packageId, 'city');
                $cities = unserialize($citiesSerialized);
            } else {
                $cities[] = $data->destinations;
            }

            $viewData = [
                'data' => $data,
                'package_name' => $package_name,
                'cities' => $cities,
                'travellers' => $this->getTravellersString($data),
            ];

            // Render the view to a string
            $view = view('query.view-lead-details', $viewData)->render();
            return response()->json(['html' => $view], 200);

        } catch (\Exception $e) {
            \Log::error('Error in enq_data: ' . $e->getMessage());
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    private function getTravellersString($data) {
        $adult = $data->span_value_adult > 0 ? $data->span_value_adult . ' Adults,' : '';
        $child = $data->span_value_child > 0 ? $data->span_value_child . ' Child,' : '';
        $child_without_bed = $data->span_value_child_without_bed > 0 ? $data->span_value_child_without_bed . ' Child Without Bed,' : '';
        $infant = $data->span_value_infant > 0 ? $data->span_value_infant . ' Infants' : '';

        return trim("$adult $child $child_without_bed $infant", ',');
    }*/

    /**********************/

    // Edit Lead
    /*public function enq_datas(Request $request) {
        // Retrieve the ID from the request
        $id = $request->id;
        
        // Find the query data by ID
        $data = Query::find($id);
        
        // Update the view status of the query
        $data->view_status = 1;
        
        // Save the updated data
        $data->save();
        
        // Render the 'edit_enquiry' view and capture the output
        $output = view('query.enquiryDetails.edit_enquiry', compact('data', 'id'))->render();
        
        // Output the rendered view
        echo $output;
    }*/

    /*public function enq_datas(Request $request) {
        // Retrieve the ID from the request
        $id = $request->id;

        // Find the query data by ID
        $data = Query::find($id);

        // Check if data is null
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Update the view status of the query
        $data->view_status = 1;

        // Save the updated data
        $data->save();

        // Render the 'edit_enquiry' view and capture the output
        $output = view('query.enquiryDetails.edit_enquiry', compact('data', 'id'))->render();

        // Output the rendered view
        return response($output);
    }*/

    public function enq_datas(Request $request)
    {
        try {
            // Retrieve the ID from the request
            $id = $request->id;
            
            // Validate the ID
            if (!$id || !is_numeric($id)) {
                return response()->json(['error' => 'Invalid ID'], 400);
            }

            // Find the query data by ID
            $data = Query::find($id);

            // Check if data is null
            if (!$data) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            // Update the view status of the query
            $data->view_status = 1;

            // Save the updated data
            $data->save();

            // Render the 'edit_enquiry' view and capture the output
            $output = view('query.enquiryDetails.edit_enquiry', compact('data', 'id'))->render();

            // Return the rendered view
            return response($output);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }


    /**********************/

    

    public function add_new_lead() 
    {
        // Check if the 'leads' service is activated
        $check_data = ActivateService::where('services', '=', 'leads')->first();
        
        // If the service is activated
        if ($check_data && $check_data->activation == 1) {
            // Fetch all packages
            $package_data = Packages::all();

            // Define allowed roles
            $allowedRoles = ['administrator', 'supervisor', 'super_admin', 'employee'];
            $user = Sentinel::getUser();

            // Check if the user is logged in and has any of the allowed roles
            if ($user && array_reduce($allowedRoles, fn($carry, $role) => $carry || $user->inRole($role), false)) {
                return view('query.addquery', ['package_data' => $package_data]);
            } else {
                return redirect(route('webLeads'));
            }
        } else {
            return response()->view('error.404', [], 404);
        }
    }

    
    /*public function change_package(Request $request) 
    {
      $package_data = Packages::all();
      $data="";
        foreach($package_data as $packages ):
        $data.="<option value='$packages->id'>$packages->title</option>";
        endforeach;
        echo "$data";
    }*/

    public function change_package(Request $request) 
    {
        // Retrieve all packages
        $package_data = Packages::all();

        // Generate options using Laravel's Collection method
        $options = $package_data->map(function($package) {
            return "<option value='{$package->id}'>{$package->title}</option>";
        })->implode('');

        // Return the generated options
        return response($options);
    }


    /**********************/

    // edit enquiry update in history
    /*public function enq_update_data(Request $request)
    {
        $query_id=$request->query_id;
        $remarks='';
        $query =Query::find($query_id);
        $query->packageId = $request->package_id;
        if($query->name!=$request->name):
        $remarks.='<p>Name Changes '.$query->name. ' to '.$request->name.'</p>' ;
        endif;
        $query->name = $request->name;
         if($query->email!=$request->email):
        $remarks.='<p>Email Changes '.$query->email. ' to '.$request->email.'</p>' ;
        endif;

        $query->email = $request->email;
         if($query->mobile!=$request->mobile):
        $remarks.='<p>Mobile No '.$query->mobile. ' to '.$request->mobile.'</p>' ;
        endif;
        $query->mobile = $request->mobile;
        if($query->message!=$request->message):
        $remarks.='<p>Message '.$query->message. ' to '.$request->message.'</p>' ;
        endif;
        $query->message = $request->message;
         if($query->city_of_residence!=$request->city_of_residence):
        $remarks.='<p>Residence City '.$query->city_of_residence. ' to '.$request->city_of_residence.'</p>' ;
        endif;
        $query->city_of_residence = $request->city_of_residence;
         if($query->country_of_residence!=$request->country_of_residence):
        $remarks.='<p>Country '.$query->country_of_residence. 'to'.$request->country_of_residence.'</p>' ;
        endif;
        $query->country_of_residence = $request->country_of_residence;
         if($query->destinations!=$request->destinations):
        $remarks.='<p>Destination '.$query->destinations. ' to '.$request->destinations.'</p>' ;
        endif;
        $query->destinations = $request->destinations;
         if($query->date_arrival!=$request->date_arrival):
        $remarks.='<p>Arrival Date '.$query->date_arrival. ' to '.$request->date_arrival.'</p>' ;
        endif;
        $query->date_arrival = $request->date_arrival;
        if((int)$query->duration!=(int)$request->duration):
        $remarks.='<p>Duration Changes'.((int)$query->duration-1).' Nights /'.$query->duration. 'Days to '.((int)$request->duration-1). 'Nights / '.$request->duration.' Days </p>' ;
        endif;
        $query->duration = $request->duration;
        if($query->span_value_adult!=$request->span_value_adult):
        $remarks.='<p>Travellers(Adult) Changes '.$query->span_value_adult. ' to '.$request->span_value_adult.'</p>' ;
        endif;
        $query->span_value_adult = $request->span_value_adult;
          if($query->span_value_child!=$request->span_value_child):
        $remarks.='<p>Travellers(child) Changes '.$query->span_value_child. ' to '.$request->span_value_child.'</p>' ;
        endif;

        $query->span_value_child = $request->span_value_child;
          if($query->span_value_infant!=$request->span_value_infant):
        $remarks.='<p>Travellers(Infant) Changes '.$query->span_value_infant. ' to '.$request->span_value_infant.'</p>' ;
        endif;
        $query->span_value_infant = $request->span_value_infant;
          if($query->span_value_child_without_bed!=$request->span_value_child_without_bed):
        $remarks.='<p>Travellers(child Without Bed) Changes '.$query->span_value_child_without_bed. ' to '.$request->span_value_child_without_bed.'</p>' ;
        endif;
        $query->span_value_child_without_bed = $request->span_value_child_without_bed;
         if($query->hotel_pre!=$request->hotel_pre):
        $remarks.='<p>Hotel Preference Changes '.$query->hotel_pre. ' to '.$request->hotel_pre.'</p>' ;
        endif;
        $query->hotel_pre = $request->hotel_pre;
         if($query->exp_budget!=$request->exp_budget):
        $remarks.='<p>Expected Budget Changes '.$query->exp_budget. ' to '.$request->exp_budget.'</p>' ;
        endif;
        $query->exp_budget = $request->exp_budget;
        if($query->time_call!=$request->time_call):
        $remarks.='<p>Best Time To Call Changes '.$query->time_call. ' to '.$request->time_call.'</p>' ;
        endif;
        $query->time_call = $request->time_call;
        if($query->package_name!=$request->package_name):
        $remarks.='<p>Package Name Changes '.$query->package_name. ' to '.$request->package_name.'</p>' ;
        endif;
        $query->message = $request->message;
        $query->package_name = $request->package_name;
        $query->save();
        if($remarks=='')
        {
        $remarks='<p>Nothing Changes</p>';    
        }
        CustomHelpers::save_enquiry_tracker($query_id,$remarks,Sentinel::getUser()->id,'update_enquiry',$query_id);


        echo "success";
    }*/

    /*public function enq_update_data(Request $request) {
        // Retrieve the query ID from the request
        $query_id = $request->query_id;
        
        // Initialize remarks as an empty string
        $remarks = '';

        // Find the query record by ID
        $query = Query::find($query_id);

        // Update the package ID
        $query->packageId = $request->package_id;


        // Check and log name change
        if ($query->name != $request->name) {
            $remarks .= '<p>Name changed from ' . $query->name . ' to ' . $request->name . '</p>';
        }
        $query->name = $request->name;

        // Check and log email change
        if ($query->email != $request->email) {
            $remarks .= '<p>Email changed from ' . $query->email . ' to ' . $request->email . '</p>';
        }
        $query->email = $request->email;

        // Check and log mobile number change
        if ($query->mobile != $request->mobile) {
            $remarks .= '<p>Mobile No changed from ' . $query->mobile . ' to ' . $request->mobile . '</p>';
        }
        $query->mobile = $request->mobile;

        // Check and log message change
        if ($query->message != $request->message) {
            $remarks .= '<p>Message changed from ' . $query->message . ' to ' . $request->message . '</p>';
        }
        $query->message = $request->message;

        // Check and log city of residence change
        if ($query->city_of_residence != $request->city_of_residence) {
            $remarks .= '<p>Residence City changed from ' . $query->city_of_residence . ' to ' . $request->city_of_residence . '</p>';
        }
        $query->city_of_residence = $request->city_of_residence;

        // Check and log country of residence change
        if ($query->country_of_residence != $request->country_of_residence) {
            $remarks .= '<p>Country changed from ' . $query->country_of_residence . ' to ' . $request->country_of_residence . '</p>';
        }
        $query->country_of_residence = $request->country_of_residence;

        // Check and log destination change
        if ($query->destinations != $request->destinations) {
            $remarks .= '<p>Destination changed from ' . $query->destinations . ' to ' . $request->destinations . '</p>';
        }
        $query->destinations = $request->destinations;

        // Check and log date of arrival change
        if ($query->date_arrival != $request->date_arrival) {
            $remarks .= '<p>Arrival Date changed from ' . $query->date_arrival . ' to ' . $request->date_arrival . '</p>';
        }
        $query->date_arrival = $request->date_arrival;

        // Check and log duration change
        if ((int)$query->duration != (int)$request->duration) {
            $remarks .= '<p>Duration changed from ' . ((int)$query->duration-1) . ' Nights / ' . $query->duration . ' Days to ' . ((int)$request->duration-1) . ' Nights / ' . $request->duration . ' Days</p>';
        }
        $query->duration = $request->duration;

        // Check and log number of adult travelers change
        if ($query->span_value_adult != $request->span_value_adult) {
            $remarks .= '<p>Travellers (Adult) changed from ' . $query->span_value_adult . ' to ' . $request->span_value_adult . '</p>';
        }
        $query->span_value_adult = $request->span_value_adult;

        // Check and log number of child travelers change
        if ($query->span_value_child != $request->span_value_child) {
            $remarks .= '<p>Travellers (Child) changed from ' . $query->span_value_child . ' to ' . $request->span_value_child . '</p>';
        }
        $query->span_value_child = $request->span_value_child;

        // Check and log number of infant travelers change
        if ($query->span_value_infant != $request->span_value_infant) {
            $remarks .= '<p>Travellers (Infant) changed from ' . $query->span_value_infant . ' to ' . $request->span_value_infant . '</p>';
        }
        $query->span_value_infant = $request->span_value_infant;

        // Check and log number of child travelers without bed change
        if ($query->span_value_child_without_bed != $request->span_value_child_without_bed) {
            $remarks .= '<p>Travellers (Child Without Bed) changed from ' . $query->span_value_child_without_bed . ' to ' . $request->span_value_child_without_bed . '</p>';
        }
        $query->span_value_child_without_bed = $request->span_value_child_without_bed;

        // Check and log hotel preference change
        if ($query->hotel_pre != $request->hotel_pre) {
            $remarks .= '<p>Hotel Preference changed from ' . $query->hotel_pre . ' to ' . $request->hotel_pre . '</p>';
        }
        $query->hotel_pre = $request->hotel_pre;

        // Check and log expected budget change
        if ($query->exp_budget != $request->exp_budget) {
            $remarks .= '<p>Expected Budget changed from ' . $query->exp_budget . ' to ' . $request->exp_budget . '</p>';
        }
        $query->exp_budget = $request->exp_budget;

        // Check and log best time to call change
        if ($query->time_call != $request->time_call) {
            $remarks .= '<p>Best Time To Call changed from ' . $query->time_call . ' to ' . $request->time_call . '</p>';
        }
        $query->time_call = $request->time_call;

        // Check and log package name change
        if ($query->package_name != $request->package_name) {
            $remarks .= '<p>Package Name changed from ' . $query->package_name . ' to ' . $request->package_name . '</p>';
        }
        $query->package_name = $request->package_name;

        // Save the updated query
        $query->save();

        // If no changes were made, add a note to the remarks
        if ($remarks == '') {
            $remarks = '<p>No changes were made.</p>';    
        }

        // Save the remarks to the enquiry tracker
        CustomHelpers::save_enquiry_tracker($query_id, $remarks, Sentinel::getUser()->id, 'update_enquiry', $query_id);

        // Output success message
        echo "success";
    }*/

    public function enq_update_data(Request $request) {
        $query_id = $request->query_id;
        $remarks = ''; // Initialize remarks string
        $query = Query::find($query_id); // Find the query by ID

        // General field checks
        $fields_to_check = [
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile No',
            'message' => 'Message',
            'city_of_residence' => 'Residence City',
            'country_of_residence' => 'Country',
            'destinations' => 'Destination',
            'date_arrival' => 'Arrival Date',
            'hotel_pre' => 'Hotel Preference',
            'exp_budget' => 'Expected Budget',
            'time_call' => 'Best Time To Call',
            'package_name' => 'Package Name'
        ];

        foreach ($fields_to_check as $field => $label) {
            if ($query->$field != $request->$field) {
                $remarks .= '<p class="historyDescription">' . $label . ' changed from ' . $query->$field . ' to ' . $request->$field . '</p>';
                if($field=='date_arrival')
                {
                $query->$field = date('Y-m-d', strtotime($request->$field)); 
                }
                else
                {
                   $query->$field = $request->$field; 
                }
                
            }
        }

        // Handle Duration specifically
        if ((int)$query->duration != (int)$request->duration) {
            /*$remarks .= '<p class="historyDescription">Duration changed from ' . ((int)$query->duration - 1) . ' Nights / ' . $query->duration . ' Days to ' . ((int)$request->duration - 1) . ' Nights / ' . $request->duration . ' Days</p>';*/
            $remarks .= '<p class="historyDescription">Duration changed from ' . ((int)$query->duration - 1) . ' Nights to ' . ((int)$request->duration - 1) . ' Nights</p>';
            $query->duration = $request->duration;
        }

        // Traveler fields check with additional handling
        $traveller_fields = [
            'span_value_adult' => 'Travellers (Adult)',
            'span_value_child' => 'Travellers (Child)',
            'span_value_infant' => 'Travellers (Infant)',
            'span_value_child_without_bed' => 'Travellers (Child Without Bed)'
        ];

        foreach ($traveller_fields as $field => $label) {
            $prev_value = $query->$field;
            $new_value = $request->$field;

            // Handle cases where values are either 0 or empty
            if ($prev_value != $new_value && (!empty($prev_value) || !empty($new_value))) {
                if (empty($prev_value)) $prev_value = '0'; // Default empty previous value to 0
                if (empty($new_value)) $new_value = '0';   // Default empty new value to 0

                $remarks .= '<p class="historyDescription">' . $label . ' changed from ' . $prev_value . ' to ' . $new_value . '</p>';
                $query->$field = $new_value;
            }
        }

        $query->save();

        // If no changes were made, add a note to the remarks
        if (empty($remarks)) {
            $remarks = '<p class="historyDescription">Nothing Changed</p>';
        }

        // Save the enquiry tracker with the recorded changes
        CustomHelpers::save_enquiry_tracker(
            $query_id,
            $remarks,
            Sentinel::getUser()->id,
            'update_enquiry',
            $query_id
        );

        echo "success";
    }

    /**********************/

    public function saveQuery1(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'mobile' => 'required',
        'email' => 'required',
        'time_call' => 'required',
        'city_of_residence' => 'required',
        'country_of_residence' => 'required',
        'destinations' => 'required',
        'date_arrival' => 'required'
        ]); 
        $query = new Query;
        $query->packageId = $request->packageId;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->mobile = $request->mobile;
        $query->message = $request->message;
        $query->city_of_residence = $request->city_of_residence;
        $query->country_of_residence = $request->country_of_residence;
        $query->destinations = $request->destinations;
        $query->date_arrival = $request->date_arrival;
        $query->duration = $request->duration;
        $query->span_value_adult = $request->span_value_adult;
        $query->span_value_child = $request->span_value_child;
        $query->span_value_infant = $request->span_value_infant;
        $query->span_value_child_without_bed = $request->span_value_child_without_bed;
        $query->hotel_pre = $request->hotel_pre;
        $query->exp_budget = $request->exp_budget;
        $query->time_call = $request->time_call;
        $query->accept_value = $request->accept_value;
        $query->status = 'interested';
        if(env("WEBSITENAME")==1):
        $query->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
        $query->webnotation = 0;
        endif;
        if($query->save()) {
         CustomHelpers::save_enquiry_tracker($query->id,'New Enquiry Initiated');
        return redirect(route('webLeads'))->with('message', 'Thank you! Your query has been submitted and our experts will contact you shortly');
        }
    }

    public function saveQuery2(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'city_of_residence' => 'required', //Departure City
        'destinations' => 'required',
        'date_arrival' => 'required',
        'duration' => 'required',
        'span_value_adult' => 'required',
        ]);
        
        $query = new Query;
        
        $query->packageId = $request->packageId;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->mobile = $request->mobile;
        $query->message = $request->message;
        $query->city_of_residence = $request->city_of_residence; //Departure City
        $query->country_of_residence = $request->country_of_residence; //Nationality
        $query->destinations = $request->destinations;
        $query->date_arrival = $request->date_arrival;
        $query->duration = $request->duration;
        $query->span_value_adult = $request->span_value_adult;
        $query->span_value_child = $request->span_value_child;
        $query->span_value_infant = $request->span_value_infant;
        $query->hotel_pre = $request->hotel_pre;
        $query->exp_budget = $request->exp_budget;
        $query->time_call = $request->time_call;
        $query->accept_value = $request->accept_value;
        $query->status = 'interested';
        if(env("WEBSITENAME")==1):
          $query->webnotation = 1;
        elseif(env("WEBSITENAME")==0):
          $query->webnotation = 0;
        endif;
        if($query->save()){
           CustomHelpers::save_enquiry_tracker($query->id,'New Enquiry Initiated');
          return redirect(route('contactUs'))->with('message', 'Thank you! Your query has been submitted and our experts will contact you shortly');
          }
    }
          
    public function disable_quotation($id) 
    {
        $data=Option1Quotation::where("quo_ref","=",$id)->first();

           if($data):
            $query_data=Query::find($data->query_reference);
            if($query_data):
             $query_data->delete_status=0;
             $query_data->save();
            endif;
             $data->del_status=0;
             $data->save();
             return redirect(route('quoteSent'))->with("success",'Quote Deleted');
           else:
           return redirect(route('quoteSent'))->with("success",'Data Not Found');
           endif;
    }
        
    public function detele_quotation($id) 
    {
        $query_data=Query::find($id);
        if(count($query_data)!="" && count($query_data)!="0"):
          Query::destroy($id);
          $data1=Option1Quotation::where("query_reference","=",$id)->first();
          if(count($data1)!="" && count($data1)!="0"):
            $data2=Option2Quotation::where("query_reference","=",$id)->first();
            $data3=Option3Quotation::where("query_reference","=",$id)->first();
            $data4=Option4Quotation::where("query_reference","=",$id)->first();
            Option1Quotation::destroy($data1->id);
            Option2Quotation::destroy($data2->id);
            Option3Quotation::destroy($data3->id);
            Option4Quotation::destroy($data4->id);
          endif;
        endif;
        return redirect()->back()->with("success","Deleted Successfully");
    }
        
    public function detele_query($id) 
    {
        $data=Query::find($id);

            if($data):
              $quotation_data=Option1Quotation::where('query_reference','=',$data->id)->first();
              if($quotation_data!=""):
              $quotation_data->del_status=0;
              $quotation_data->save();
              endif;
             //Query::destroy($id);
              $data->delete_status=0;
              $data->save();
             return redirect()->back();
            endif;
    }
}