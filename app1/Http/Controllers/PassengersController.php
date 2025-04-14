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

class PassengersController extends Controller
{
  public function add_edit_passenger(Request $request)
  {
    $quote_no = 1;
    $unique_code = CustomHelpers::custom_decrypt($request->unique_code);

    // Manage session for quote number
    if (Session::has($unique_code . 'quoteno')) {
        Session::forget($unique_code . 'quoteno');
    }
    Session::set($unique_code . 'quoteno', $quote_no);

    // Retrieve quotations based on unique code
    $data1 = Option1Quotation::where('unique_code', '=', $unique_code)->first();
    $data2 = Option2Quotation::where('unique_code', '=', $unique_code)->first();
    $data3 = Option3Quotation::where('unique_code', '=', $unique_code)->first();
    $data4 = Option4Quotation::where('unique_code', '=', $unique_code)->first();

    // Manage session for quote IDs
    if (Session::has($unique_code . 'quote1_id')) {
        Session::forget($unique_code . 'quote1_id');
    }
    if (Session::has($unique_code . 'quote2_id')) {
        Session::forget($unique_code . 'quote2_id');
    }
    if (Session::has($unique_code . 'quote3_id')) {
        Session::forget($unique_code . 'quote3_id');
    }
    if (Session::has($unique_code . 'quote4_id')) {
        Session::forget($unique_code . 'quote4_id');
    }

    Session::set($unique_code . 'quote1_id', $data1->id);
    Session::set($unique_code . 'quote2_id', $data2->id);
    Session::set($unique_code . 'quote3_id', $data3->id);
    Session::set($unique_code . 'quote4_id', $data4->id);

    // Retrieve quote IDs from the session
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    // Initialize variables for quote data
    $data = null;
    $quote_ref_no = '';
    $price = 0;
    $price_data = [];

    // Determine the appropriate quotation based on quote number
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

    // Retrieve lead passenger information
    $lead_passenger = QueryLeadTraveller::where('email', $data->email)->first();
    if (empty($lead_passenger)) {
        $lead_passenger = new QueryLeadTraveller;
        $lead_passenger->email = $data->email;
        $lead_passenger->save();
    }

    // Retrieve or create lead passenger information
    $lead_passenger_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_passenger->id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    if (empty($lead_passenger_info)) {
        $lead_passenger_info = new QueryLeadTravellerInfo;
        $lead_passenger_info->guest_name = $data->name;
        $lead_passenger_info->country_code = '91';
        $lead_passenger_info->mobile_no = $data->mobile;
        $lead_passenger_info->lead_traveller_id = $lead_passenger->id;
        $lead_passenger_info->quote_id = $data->id;
        $lead_passenger_info->qquote_no = $quote_no;
        $lead_passenger_info->query_id = $data->query_reference;
        $lead_passenger_info->save();
    }

    // Set up query reference and retrieve query
    $quote_ref_no = $data->quo_ref;
    $query_reference = $data->query_reference;
    $query = Query::find($query_reference);

    // Retrieve passengers and room assignments
    $passengers = QueryTraveller::where('lead_traveller_id', $lead_passenger->id)->get();
    $room_passenger = [];
    $passengers_infos = Passengerinfo::where([
        ['lead_traveller_id', '=', $lead_passenger->id],
        ['quotation_ref_no', '=', $quote_ref_no]
    ])->first();

    if (!empty($passengers_infos)) {
        $room_passenger = unserialize($passengers_infos->room_passenger);
    }

    // Return the add/edit passenger view with relevant data
    return view("payment.add_edit_passenger", compact(
        'query', 'data', 'lead_passenger', 'lead_passenger_info', 'passengers', 'room_passenger', 'passengers_infos', 'quote_ref_no', 'unique_code'
    ));
  }

  public function paymentview(Request $request)
  {
    $unique_code = CustomHelpers::custom_decrypt($request->unique_code);

    // Set cookie for user ID based on authentication status
    if (Sentinel::check()) {    
        setcookie('user_ids', Sentinel::getUser()->id);
    } else {
        setcookie('user_ids', 0);
    }

    // Decrypt the quote number and manage session for it
    $quote_no = CustomHelpers::custom_decrypt($request->quote_no);

    if (Session::has($unique_code . 'quoteno')) {
        Session::forget($unique_code . 'quoteno');
    }
    Session::set($unique_code . 'quoteno', $quote_no);

    // Retrieve quotations based on unique code
    $data1 = Option1Quotation::where('unique_code', '=', $unique_code)->first();
    $data2 = Option2Quotation::where('unique_code', '=', $unique_code)->first();
    $data3 = Option3Quotation::where('unique_code', '=', $unique_code)->first();
    $data4 = Option4Quotation::where('unique_code', '=', $unique_code)->first();

    // Manage session for quote IDs
    if (Session::has($unique_code . 'quote1_id')) {
        Session::forget($unique_code . 'quote1_id');
    }
    if (Session::has($unique_code . 'quote2_id')) {
        Session::forget($unique_code . 'quote2_id');
    }
    if (Session::has($unique_code . 'quote3_id')) {
        Session::forget($unique_code . 'quote3_id');
    }
    if (Session::has($unique_code . 'quote4_id')) {
        Session::forget($unique_code . 'quote4_id');
    }

    Session::set($unique_code . 'quote1_id', $data1->id);
    Session::set($unique_code . 'quote2_id', $data2->id);
    Session::set($unique_code . 'quote3_id', $data3->id);
    Session::set($unique_code . 'quote4_id', $data4->id);

    // Retrieve quote IDs from the session
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    // Initialize variables for quote data
    $data = null;
    $quote_ref_no = '';
    $price = 0;
    $price_data = [];

    // Determine the appropriate quotation based on quote number
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

    $order_id = time();
    $amount = $price_data['query_pricetopay_adult'];
    $query_reference = $data->query_reference;
    $query = Query::find($query_reference);

    // Retrieve lead passenger information
    $lead_passenger = QueryLeadTraveller::where('email', $data->email)->first();
    if (empty($lead_passenger)) {
        $lead_passenger = new QueryLeadTraveller;
        $lead_passenger->email = $data->email;
        $lead_passenger->save();
    }

    // Retrieve or create lead passenger information
    $lead_passenger_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_passenger->id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    if (empty($lead_passenger_info)) {
        $lead_passenger_info = new QueryLeadTravellerInfo;
        $lead_passenger_info->guest_name = $data->name;
        $lead_passenger_info->country_code = '91';
        $lead_passenger_info->mobile_no = $data->mobile;
        $lead_passenger_info->lead_traveller_id = $lead_passenger->id;
        $lead_passenger_info->quote_id = $data->id;
        $lead_passenger_info->qquote_no = $quote_no;
        $lead_passenger_info->query_id = $data->query_reference;
        $lead_passenger_info->save();
    }

    $now = date('Y-m-d');
    $coupons = Coupon::where([['end_date', '>=', $now], ['start_date', '<=', $now]])
        ->whereIn('applicable_for', [1, 2, 4])
        ->get();
    $passengers = QueryTraveller::where('lead_traveller_id', $lead_passenger->id)->get();
    $remaining_amount = CustomHelpers::get_remaining_amount($price_data['query_pricetopay_adult'], $unique_code);
    $get_installment_number = CustomHelpers::get_installment_number($price_data['query_pricetopay_adult'], $unique_code);
    $custom_last = 0;
    $part_payments = unserialize($data->part_payments);
    $part_payments_sec = CustomHelpers::part_payments($data->part_payments, $price_data['query_pricetopay_adult']);

    // Calculate the amount to show based on received payments
    $adv_amount = $part_payments_sec['adv_amount'];
    $first_part_amount = $part_payments_sec['first_part_amount'];
    $second_part_amount = $part_payments_sec['second_part_amount'];
    $total_received_amount = CustomHelpers::get_received_amount($unique_code);

    if ($total_received_amount < $adv_amount) {
        $show_amount = (float)$adv_amount - (float)$total_received_amount;
    } elseif ($total_received_amount == $adv_amount) {
        $show_amount = (float)$first_part_amount;
    } elseif ($total_received_amount > $adv_amount && $total_received_amount < ((float)$adv_amount + (float)$first_part_amount)) {
        $show_amount = (float)$first_part_amount - ((float)$total_received_amount - (float)$adv_amount);
    } elseif ($total_received_amount > $adv_amount && $total_received_amount == ((float)$adv_amount + (float)$first_part_amount)) {
        $show_amount = (float)$second_part_amount;
    } else {
        $show_amount = (float)$second_part_amount - ((float)$total_received_amount - (float)$adv_amount - (float)$first_part_amount);
    }

    // Manage session for remaining and show amounts
    if (Session::has($unique_code . 'custom_remaining')) {
        Session::forget($unique_code . 'custom_remaining');
    }
    if (Session::has($unique_code . 'custom_last')) {
        Session::forget($unique_code . 'custom_last');
    }

    Session::set($unique_code . 'custom_remaining', $remaining_amount);
    Session::set($unique_code . 'custom_last', $show_amount);

    // Retrieve room passenger information
    $room_passenger = [];
    $passengers_infos = Passengerinfo::where([
        ['lead_traveller_id', '=', $lead_passenger->id],
        ['quotation_ref_no', '=', $quote_ref_no]
    ])->first();

    if (!empty($passengers_infos)) {
        $room_passenger = unserialize($passengers_infos->room_passenger);
    }

    // Return the booking review view with relevant data
    return view("payment.bookingreview", compact(
        'query', 'amount', 'price', 'data', 'quote_ref_no', 'remaining_amount', 'lead_passenger', 'lead_passenger_info', 'passengers', 'coupons', 'get_installment_number', 'room_passenger', 'passengers_infos', 'unique_code'
    ));
  }

  public function passenger_info(Request $request)
  {
    // Decrypt the unique code from the request
    $unique_code = CustomHelpers::custom_decrypt($request->unique_code);

    // Set cookie for user ID if user is authenticated
    if (Sentinel::check()) {
        setcookie('user_ids', Sentinel::getUser()->id);
    } else {
        setcookie('user_ids', 0);
    }

    // Decrypt the quote number from the request
    $quote_no = CustomHelpers::custom_decrypt($request->quote_no);

    // Manage session for quote number
    if (Session::has($unique_code . 'quoteno')) {
        Session::forget($unique_code . 'quoteno');
    }
    Session::set($unique_code . 'quoteno', $quote_no);

    // Retrieve quote IDs from the session
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    // Initialize variables for quote data
    $data = null;
    $quote_ref_no = '';
    $price = 0;
    $price_data = [];

    // Determine the appropriate quotation based on quote number
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

    // Set up variables for payment and query reference
    $order_id = time();
    $amount = $price_data['query_pricetopay_adult'] ?? $price;
    $query_reference = $data->query_reference;
    $query = Query::find($query_reference);

    // Retrieve lead passenger information
    $lead_passenger = QueryLeadTraveller::where('email', $data->email)->first();
    if (empty($lead_passenger)) {
        $lead_passenger = new QueryLeadTraveller;
        $lead_passenger->email = $data->email;
        $lead_passenger->save();
    }

    // Retrieve or create lead passenger information
    $lead_passenger_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_passenger->id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    if (empty($lead_passenger_info)) {
        $lead_passenger_info = new QueryLeadTravellerInfo;
        $lead_passenger_info->guest_name = $data->name;
        $lead_passenger_info->country_code = '91';
        $lead_passenger_info->mobile_no = $data->mobile;
        $lead_passenger_info->lead_traveller_id = $lead_passenger->id;
        $lead_passenger_info->quote_id = $data->id;
        $lead_passenger_info->qquote_no = $quote_no;
        $lead_passenger_info->query_id = $data->query_reference;
        $lead_passenger_info->save();
    }

    // Get applicable coupons
    $now = date('Y-m-d');
    $coupons = Coupon::where([['end_date', '>=', $now], ['start_date', '<=', $now]])
        ->whereIn('applicable_for', [1, 2, 4])
        ->get();

    // Retrieve passengers and calculate remaining and installment amounts
    $passengers = QueryTraveller::where('lead_traveller_id', $lead_passenger->id)->get();
    $remaining_amount = CustomHelpers::get_remaining_amount($price_data['query_pricetopay_adult'], $unique_code);
    $get_installment_number = CustomHelpers::get_installment_number($price_data['query_pricetopay_adult'], $unique_code);
    $custom_last = 0;

    // Calculate part payments
    $part_payments = unserialize($data->part_payments);
    $part_payments_sec = CustomHelpers::part_payments($data->part_payments, $price_data['query_pricetopay_adult']);

    // Calculate the amount to show based on received amounts
    $adv_amount = $part_payments_sec['adv_amount'];
    $first_part_amount = $part_payments_sec['first_part_amount'];
    $second_part_amount = $part_payments_sec['second_part_amount'];
    $total_received_amount = CustomHelpers::get_received_amount($unique_code);

    if ($total_received_amount < $adv_amount) {
        $show_amount = (float)$adv_amount - (float)$total_received_amount;
    } elseif ($total_received_amount == $adv_amount) {
        $show_amount = (float)$first_part_amount;
    } elseif ($total_received_amount > $adv_amount && $total_received_amount < ((float)$adv_amount + (float)$first_part_amount)) {
        $show_amount = (float)$first_part_amount - ((float)$total_received_amount - (float)$adv_amount);
    } elseif ($total_received_amount > $adv_amount && $total_received_amount == ((float)$adv_amount + (float)$first_part_amount)) {
        $show_amount = (float)$second_part_amount;
    } else {
        $show_amount = (float)$second_part_amount - ((float)$total_received_amount - (float)$adv_amount - (float)$first_part_amount);
    }

    // Manage session for custom remaining amounts and total quote amount
    if (Session::has($unique_code . 'custom_remaining')) {
        Session::forget($unique_code . 'custom_remaining');
    }
    if (Session::has($unique_code . 'custom_last')) {
        Session::forget($unique_code . 'custom_last');
    }
    if (Session::has($unique_code . 'total_quote_amount')) {
        Session::forget($unique_code . 'total_quote_amount');
    }

    Session::set($unique_code . 'total_quote_amount', $price_data['query_pricetopay_adult']);
    Session::set($unique_code . 'custom_remaining', $remaining_amount);
    Session::set($unique_code . 'custom_last', $show_amount);

    // Retrieve passenger info for room assignment
    $room_passenger = [];
    $passengers_infos = Passengerinfo::where([
        ['lead_traveller_id', '=', $lead_passenger->id],
        ['quotation_ref_no', '=', $quote_ref_no]
    ])->first();

    if (!empty($passengers_infos)) {
        $room_passenger = unserialize($passengers_infos->room_passenger);
    }

    // Return the booking review view with relevant data
    return view("payment.bookingreview", compact(
        'query', 'amount', 'price', 'data', 'quote_ref_no', 'remaining_amount',
        'lead_passenger', 'lead_passenger_info', 'passengers', 'coupons',
        'get_installment_number', 'room_passenger', 'passengers_infos', 'unique_code'
    ));
  }

  /*public function save_traveller(Request $request)
  {
    $trav_id = $request->trav_id;
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);

    $email_id = $query_data->email;
    $query_lead_traveller = QueryLeadTraveller::where('email', $email_id)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    // Check if we are updating an existing traveller or creating a new one
    if ($trav_id != '') {
        $id = CustomHelpers::custom_decrypt($trav_id);
        $data = QueryTraveller::find($id);
    } else {
        $data = new QueryTraveller();
    }

    // Set the traveller data
    $data->lead_traveller_id = $lead_traveller_id;
    $data->firstname = $request->firstname;
    $data->lastname = $request->lastname;

    // Validate and set the date of birth
    $dob = $request->year . '-' . str_pad($request->month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->day, 2, '0', STR_PAD_LEFT);
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dob)) {
        $data->dob = $dob;
    }

    $data->gender = $request->gender;
    $data->nationality = $request->nationality;
    $data->pancard = $request->pancard;
    $data->passportnumber = $request->passportnumber;
    $data->passportcountry = $request->passportcountry;

    // Validate and set the passport issue date
    $issue_date = $request->iyear . '-' . str_pad($request->imonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->iday, 2, '0', STR_PAD_LEFT);
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $issue_date)) {
        $data->passport_issue_date = $issue_date;
    }

    // Validate and set the passport expire date
    $expire_date = $request->eyear . '-' . str_pad($request->emonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->eday, 2, '0', STR_PAD_LEFT);
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $expire_date)) {
        $data->passport_expire_date = $expire_date;
    }

    // Save the traveller data
    $data->save();

    // Fetch and display the list of passengers
    $passengers = QueryTraveller::where('lead_traveller_id', $lead_traveller_id)->get();
    $output = '';

    foreach ($passengers as $passenger) {
        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
        if ($data->id == $passenger->id) {
            $output .= '<option value="' . $passenger_id . '" selected>' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        } else {
            $output .= '<option value="' . $passenger_id . '">' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        }
    }

    $output .= '<option value="">Add Passenger</option>';
    echo $output;
  }*/

  public function save_traveller(Request $request)
  {
    $trav_id = $request->trav_id;
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);

    $email_id = $query_data->email;

    $query_lead_traveller = QueryLeadTraveller::where('email', $email_id)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    if ($trav_id != '') {
        $id = CustomHelpers::custom_decrypt($trav_id);
        $data = QueryTraveller::find($id);
    } else {
        $data = new QueryTraveller();
    }

    $data->lead_traveller_id = $lead_traveller_id;
    $data->firstname = $request->firstname;
    $data->lastname = $request->lastname;

    // Validate and set date of birth
    $dob = $this->validateAndFormatDate($request->year, $request->month, $request->day);
    if ($dob) {
        $data->dob = $dob;
    }

    $data->gender = $request->gender;
    $data->nationality = $request->nationality;
    $data->pancard = $request->pancard;
    $data->passportnumber = $request->passportnumber;
    $data->passportcountry = $request->passportcountry;

    // Validate and set passport issue date
    $issue_date = $this->validateAndFormatDate($request->iyear, $request->imonth, $request->iday);
    if ($issue_date) {
        $data->passport_issue_date = $issue_date;
    }

    // Validate and set passport expiry date
    $expire_date = $this->validateAndFormatDate($request->eyear, $request->emonth, $request->eday);
    if ($expire_date) {
        $data->passport_expire_date = $expire_date;
    }

    $data->save();

    $passengers = QueryTraveller::where('lead_traveller_id', $lead_traveller_id)->get();
    $output = '';

    foreach ($passengers as $passenger) {
        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
        if ($data->id == $passenger->id) {
            $output .= '<option value="' . $passenger_id . '" selected>' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        } else {
            $output .= '<option value="' . $passenger_id . '">' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        }
    }

    $output .= '<option value="">Add Passenger</option>';

    return $output;
  }

  /**
   * Validate and format date components into YYYY-MM-DD format.
   * Returns formatted date if valid, otherwise null.
   */
  private function validateAndFormatDate($year, $month, $day)
  {
    $date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
    
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        return $date;
    } else {
        return null; // Invalid date format
    }
  }

  public function delete_traveller(Request $request)
  {
    $trav_id = $request->trav_id;
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);

    $email_id = $query_data->email;

    $query_lead_traveller = QueryLeadTraveller::where('email', $email_id)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    $id = CustomHelpers::custom_decrypt($trav_id);
    QueryTraveller::destroy($id);

    $passengers = QueryTraveller::where('lead_traveller_id', $lead_traveller_id)->get();
    $output = '<option value="">Select Passenger</option>';

    foreach ($passengers as $passenger) {
        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
        $output .= '<option value="' . $passenger_id . '">' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
    }

    $output .= '<option value="">Add Passenger</option>';

    return $output;
  }

  public function get_passenger_select(Request $request)
  {
    $select_item = $request->select_item;
    $select_item_decrypted = CustomHelpers::custom_decrypt($select_item);

    $values = $request->values;
    $unique_code = $request->unique_code;

    // Remove duplicates and empty values from the array
    $values_unique = array_filter(array_unique($values));

    // Remove the current selected item from the array
    foreach (array_keys($values_unique, $select_item) as $key) {
        unset($values_unique[$key]);
    }

    // Decrypt the remaining values
    $final_array = [];
    foreach ($values_unique as $key) {
        $final_array[] = CustomHelpers::custom_decrypt($key);
    }

    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);
    $lead_passenger = QueryLeadTraveller::where('email', $query_data->email)->first();

    // Retrieve passengers excluding those in $final_array
    if (count($final_array) > 0) {
        $passengers = QueryTraveller::where('lead_traveller_id', $lead_passenger->id)
                                    ->whereNotIn('id', $final_array)
                                    ->get();
    } else {
        $passengers = QueryTraveller::where('lead_traveller_id', $lead_passenger->id)
                                    ->get();
    }

    $output = '';

    // Generate <option> elements for the dropdown
    foreach ($passengers as $passenger) {
        $passenger_id = CustomHelpers::custom_encrypt($passenger->id);
        if ($select_item_decrypted == $passenger->id) {
            $output .= '<option value="' . $passenger_id . '" selected>' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        } else {
            $output .= '<option value="' . $passenger_id . '">' . $passenger->firstname . '&nbsp;' . $passenger->lastname . '</option>';
        }
    }

    // Add the "Add Passenger" option based on whether $select_item is empty
    if ($select_item == '') {
        $output .= '<option value="" selected>Add Passenger</option>';
    } else {
        $output .= '<option value="">Add Passenger</option>';
    }

    // Return the generated HTML
    return $output;
  }

  /*public function get_passenger_detail(Request $request)
  {
    $traveller_type = $request->type;
    $selected_item = CustomHelpers::custom_decrypt($request->selected_item);
    $passenger = QueryTraveller::find($selected_item);

    $lead_traveller_id = $passenger->lead_traveller_id;
    $lead_traveller = QueryLeadTraveller::find($lead_traveller_id);
    $lead_traveller_email = $lead_traveller->email;

    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);
    $quote_ref_no = $query_data->quo_ref;

    $payments = DB::table('rt_payments')
        ->where([
            ['quote_ref_no', '=', $quote_ref_no],
            ['status', '=', 1],
            ['transaction_type', '=', 0]
        ])->get();

    $user = Sentinel::getUser();
    $user_email = $user ? $user->email : null;
    $user_role_slug = $user ? $user->roles()->first()->slug : null;

    if (Sentinel::check() && in_array($user_role_slug, ['super_admin', 'administrator', 'supervisor', 'agent'])) {
        $error = 'success';
    } elseif (Sentinel::check() && $user_email == $lead_traveller_email) {
        $error = 'success';
    } elseif (Sentinel::check() && $user_email != $lead_traveller_email) {
        $error = 'Lead passenger details not match';
    } elseif (!Sentinel::check() && $payments->isNotEmpty()) {
        $error = 'Please login with lead passenger id for edit';
    } else {
        $error = 'success';
    }

    // For birthday
    $dob = $passenger->dob;
    if ($dob) {
        $byear = date('Y', strtotime($dob));
        $bmonth = (int)date('m', strtotime($dob));
        $bday = (int)date('d', strtotime($dob));

        $months = CustomHelpers::get_month_output('bmonth', $byear, $traveller_type);
        $days = CustomHelpers::get_day_output($bmonth, $byear, 'bmonth', $traveller_type);
    } else {
        $byear = $bmonth = $bday = '';
        $months = '<option selected="" disabled="">MM</option>';
        $days = '<option selected="" disabled="">DD</option>';
    }

    // For passport issue
    $passport_issue_date = $passenger->passport_issue_date;
    if ($passport_issue_date) {
        $piyear = date('Y', strtotime($passport_issue_date));
        $pimonth = (int)date('m', strtotime($passport_issue_date));
        $piday = (int)date('d', strtotime($passport_issue_date));

        $passport_issuemonths = CustomHelpers::get_month_output('imonth', $piyear, $traveller_type);
        $passport_issue_days = CustomHelpers::get_day_output($pimonth, $piyear, 'imonth', $traveller_type);
    } else {
        $piyear = $pimonth = $piday = '';
        $passport_issuemonths = '<option selected="" disabled="">MM</option>';
        $passport_issue_days = '<option selected="" disabled="">DD</option>';
    }

    // For passport expire
    $passport_expire_date = $passenger->passport_expire_date;
    if ($passport_expire_date) {
        $peyear = date('Y', strtotime($passport_expire_date));
        $pemonth = (int)date('m', strtotime($passport_expire_date));
        $peday = (int)date('d', strtotime($passport_expire_date));

        $passport_expire_months = CustomHelpers::get_month_output('emonth', $peyear, $traveller_type);
        $passport_expire_days = CustomHelpers::get_day_output($pemonth, $peyear, 'emonth', $traveller_type);
    } else {
        $peyear = $pemonth = $peday = '';
        $passport_expire_months = '<option selected="" disabled="">MM</option>';
        $passport_expire_days = '<option selected="" disabled="">DD</option>';
    }

    $output = [
        'firstname' => $passenger->firstname,
        'lastname' => $passenger->lastname,
        'gender' => $passenger->gender,
        'nationality' => $passenger->nationality,
        'pancard' => $passenger->pancard,
        'passportnumber' => $passenger->passportnumber,
        'passportcountry' => $passenger->passportcountry,
        'byear' => $byear,
        'bmonth' => $bmonth,
        'bday' => $bday,
        'months' => $months,
        'days' => $days,
        'piyear' => $piyear,
        'pimonth' => $pimonth,
        'piday' => $piday,
        'passport_issuemonths' => $passport_issuemonths,
        'passport_issue_days' => $passport_issue_days,
        'peyear' => $peyear,
        'pemonth' => $pemonth,
        'peday' => $peday,
        'passport_expire_months' => $passport_expire_months,
        'passport_expire_days' => $passport_expire_days,
        'error' => $error
    ];

    return $output;
  }*/

  public function get_passenger_detail(Request $request)
  {
    $traveller_type = $request->type;
    $selected_item = $request->selected_item;

    $passenger = QueryTraveller::find(CustomHelpers::custom_decrypt($selected_item));
    $lead_traveller_id = $passenger->lead_traveller_id;

    $lead_traveller_data = QueryLeadTraveller::find($lead_traveller_id);
    $lead_traveler_email_id = $lead_traveller_data->email;

    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $query_data = CustomHelpers::get_session_query_details($quote_no, $unique_code);
    $quote_ref_no = $query_data->quo_ref;

    $payments = DB::table('rt_payments')
        ->where([
            ['quote_ref_no', '=', $quote_ref_no],
            ['status', '=', 1],
            ['transaction_type', '=', 0]
        ])->get();

    if (
        Sentinel::check()
        && (Sentinel::getUser()->hasAnyRole(['super_admin', 'administrator', 'supervisor', 'agent'])
            || Sentinel::getUser()->email == $lead_traveler_email_id)
    ) {
        $error = 'success';
    } elseif (!Sentinel::check()) {
        $error = 'Please login with lead passenger id for edit';
    } else {
        $error = 'Lead passenger details do not match';
    }

    // Initialize variables for dates
    $dob = $passport_issue_date = $passport_expire_date = '';

    // Prepare month and day options
    $months = '<option selected="" disabled="">MM</option>';
    $days = '<option selected="" disabled="">DD</option>';
    $passport_issuemonths = '<option selected="" disabled="">MM</option>';
    $passport_issue_days = '<option selected="" disabled="">DD</option>';
    $passport_expire_months = '<option selected="" disabled="">MM</option>';
    $passport_expire_days = '<option selected="" disabled="">DD</option>';

    // Populate date values if they exist
    if (!empty($passenger->dob)) {
        $dob = date('Y-m-d', strtotime($passenger->dob));
        $byear = date('Y', strtotime($passenger->dob));
        $bmonth = (int) date('m', strtotime($passenger->dob));
        $bday = (int) date('d', strtotime($passenger->dob));

        $months = CustomHelpers::get_month_output('bmonth', $byear, $traveller_type);
        $days = CustomHelpers::get_day_output($bmonth, $byear, 'bmonth', $traveller_type);
    }

    if (!empty($passenger->passport_issue_date)) {
        $passport_issue_date = date('Y-m-d', strtotime($passenger->passport_issue_date));
        $piyear = date('Y', strtotime($passenger->passport_issue_date));
        $pimonth = (int) date('m', strtotime($passenger->passport_issue_date));
        $piday = (int) date('d', strtotime($passenger->passport_issue_date));

        $passport_issuemonths = CustomHelpers::get_month_output('imonth', $piyear, $traveller_type);
        $passport_issue_days = CustomHelpers::get_day_output($pimonth, $piyear, 'imonth', $traveller_type);
    }

    if (!empty($passenger->passport_expire_date)) {
        $passport_expire_date = date('Y-m-d', strtotime($passenger->passport_expire_date));
        $peyear = date('Y', strtotime($passenger->passport_expire_date));
        $pemonth = (int) date('m', strtotime($passenger->passport_expire_date));
        $peday = (int) date('d', strtotime($passenger->passport_expire_date));

        $passport_expire_months = CustomHelpers::get_month_output('emonth', $peyear, $traveller_type);
        $passport_expire_days = CustomHelpers::get_day_output($pemonth, $peyear, 'emonth', $traveller_type);
    }

    $output = [
        'firstname' => $passenger->firstname,
        'lastname' => $passenger->lastname,
        'gender' => $passenger->gender,
        'nationality' => $passenger->nationality,
        'pancard' => $passenger->pancard,
        'passportnumber' => $passenger->passportnumber,
        'passportcountry' => $passenger->passportcountry,
        'byear' => $byear ?? '',
        'bmonth' => $bmonth ?? '',
        'bday' => $bday ?? '',
        'months' => $months,
        'days' => $days,
        'piyear' => $piyear ?? '',
        'pimonth' => $pimonth ?? '',
        'piday' => $piday ?? '',
        'passport_issuemonths' => $passport_issuemonths,
        'passport_issue_days' => $passport_issue_days,
        'peyear' => $peyear ?? '',
        'pemonth' => $pemonth ?? '',
        'peday' => $peday ?? '',
        'passport_expire_months' => $passport_expire_months,
        'passport_expire_days' => $passport_expire_days,
        'error' => $error,
    ];

    return $output;
  }

  public function get_month(Request $request)
  {
    $type = $request->type;
    $year_val = $request->year_val;
    $traveller_type = $request->traveller_type;

    $output = CustomHelpers::get_month_output($type, $year_val, $traveller_type);

    return response()->json(['output' => $output]);
  }

  public function save_booking_details(Request $request)
  {
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code.'quoteno');
    $quote1_id = Session::get($unique_code.'quote1_id');
    $quote2_id = Session::get($unique_code.'quote2_id');
    $quote3_id = Session::get($unique_code.'quote3_id');
    $quote4_id = Session::get($unique_code.'quote4_id');

    $coupon_id = Session::has('coupon_id') ? Session::get('coupon_id') : '';

    /*if($quote_no==1) {
      $data=Option1Quotation::find((int)$quote1_id);
      $quote_ref_no=$data->quo_ref;
    }
    elseif($quote_no==2) {
      $data=Option2Quotation::find((int)$quote2_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option2_price;
    }
    elseif($quote_no==3) {
      $data=Option3Quotation::find((int)$quote3_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option3_price;
    }
    elseif($quote_no==4) {
      $data=Option4Quotation::find((int)$quote4_id);
      $quote_ref_no=$data->quotation_ref_no;
      $price=$data->option4_price;
    }*/

    switch ($quote_no) {
        case 1:
            $data = Option1Quotation::find((int) $quote1_id);
            $quote_ref_no = $data->quo_ref;
            break;
        case 2:
            $data = Option2Quotation::find((int) $quote2_id);
            $quote_ref_no = $data->quotation_ref_no;
            break;
        case 3:
            $data = Option3Quotation::find((int) $quote3_id);
            $quote_ref_no = $data->quotation_ref_no;
            break;
        case 4:
            $data = Option4Quotation::find((int) $quote4_id);
            $quote_ref_no = $data->quotation_ref_no;
            break;
        default:
            // Handle default case if needed
            break;
    }

    $passengerInfo = Passengerinfo::where('quotation_ref_no', $quote_ref_no)->first();
    if (!$passengerInfo) {
        $passengerInfo = new Passengerinfo;
    }

    $query_lead_traveller = QueryLeadTraveller::where('email', $data->email)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    $query_lead_traveller_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_traveller_id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    $query_lead_traveller_info->city = $request->guestcontact_city;
    $query_lead_traveller_info->state = $request->guestcontact_state;
    $query_lead_traveller_info->country_code = $request->country_code;
    $query_lead_traveller_info->mobile_no = $request->guestcontact_mobile;
    $query_lead_traveller_info->address = $request->guestcontact_address;
    $query_lead_traveller_info->save();

    $passengerInfo->quotation_ref_no = $quote_ref_no;
    $passengerInfo->query_reference = $data->query_reference;
    $passengerInfo->lead_traveller_id = $lead_traveller_id;

    // Activity Tracker
    $passengerList = $request->passenger;
    if (!$passengerInfo->exists) {
        $output = CustomHelpers::get_passengers_list($passengerList) . ' added these passengers';
        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    } else {
        $newPassengers = explode(',', CustomHelpers::get_passengers_list($passengerList));
        $oldPassengers = explode(',', CustomHelpers::get_passengers_list(unserialize($passengerInfo->room_passenger)));
        sort($newPassengers);
        sort($oldPassengers);

        if ($newPassengers == $oldPassengers) {
            $output = 'No changes in passengers';
        } else {
            $output = 'Previous passengers: ' . CustomHelpers::get_passengers_list($oldPassengers);
            $output .= ' & New passengers: ' . CustomHelpers::get_passengers_list($newPassengers);
        }

        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    }

    $passengerInfo->room_passenger = serialize($passengerList);
    if (Session::has($unique_code.'coupon_id') && CustomHelpers::get_check_payment_status($quote_ref_no) == 0) {
        $passengerInfo->coupon = Session::get($unique_code.'coupon_id');
    }

    $passengerInfo->special_request = serialize($request->special_request);
    $passengerInfo->guest_additionaletails = $request->guest_additionaletails;
    $passengerInfo->guestGST_no = $request->guestGST_no;
    $passengerInfo->guestGST_name = $request->guestGST_name;
    $passengerInfo->guestGST_email = $request->guestGST_email;
    $passengerInfo->guestGST_mobile = $request->guestGST_mobile;
    $passengerInfo->guestGST_state = $request->guestGST_state;
    $passengerInfo->guestGST_address = $request->guestGST_address;
    $passengerInfo->ack = $request->acknowledgement;
    $passengerInfo->save();

    return response()->json(['unique_code' => $unique_code]);
  }

  /*public function save_traveller_details(Request $request)
  {
    $unique_code = $request->unique_code;

    $quote_no = Session::get($unique_code . 'quoteno');
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');
    $coupon_id = '';

    if ($quote_no == 1) {
        $data = Option1Quotation::find((int)$quote1_id);
        $quote_ref_no = $data->quo_ref;
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

    $d = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();
    if (!$d) {
        $d = new Passengerinfo;
    }

    $query_lead_traveller = QueryLeadTraveller::where('email', $data->email)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    $query_lead_traveller_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_traveller_id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    if (!$query_lead_traveller_info) {
        $query_lead_traveller_info = new QueryLeadTravellerInfo;
        $query_lead_traveller_info->lead_traveller_id = $lead_traveller_id;
        $query_lead_traveller_info->quote_id = $data->id;
        $query_lead_traveller_info->qquote_no = $quote_no;
        $query_lead_traveller_info->query_id = $data->query_reference;
    }

    $query_lead_traveller_info->city = $request->guestcontact_city;
    $query_lead_traveller_info->state = $request->guestcontact_state;
    $query_lead_traveller_info->address = $request->guestcontact_address;
    $query_lead_traveller_info->save();

    $d->quotation_ref_no = $quote_ref_no;
    $d->query_reference = $data->query_reference;
    $d->lead_traveller_id = $lead_traveller_id;

    // Activity Tracker
    $check = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();

    if (!$check) {
        $passengers = $request->passenger;
        $output = CustomHelpers::get_passengers_list($passengers);
        $output .= ' added these passengers';
        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    } else {
        $newpassengers = $request->passenger;
        $newpassengers_output = CustomHelpers::get_passengers_list($newpassengers);
        $newpassengers_output = explode(',', $newpassengers_output);

        $old_passengers = unserialize($check->room_passenger);
        $old_passengers_output = CustomHelpers::get_passengers_list($old_passengers);
        $old_passengers_output = explode(',', $old_passengers_output);

        sort($newpassengers_output);
        sort($old_passengers_output);

        $output = '';

        if ($newpassengers_output == $old_passengers_output) {
            $output .= 'No changes in passengers';
        } else {
            $output .= 'Previous passengers: ' . CustomHelpers::get_passengers_list($old_passengers);
            $output .= ' & New passengers: ' . CustomHelpers::get_passengers_list($newpassengers);
        }

        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    }

    $d->room_passenger = serialize($request->passenger);
    $d->special_request = serialize($request->special_request);
    $d->guest_additionaletails = $request->guest_additionaletails;
    $d->guestGST_no = $request->guestGST_no;
    $d->guestGST_name = $request->guestGST_name;
    $d->guestGST_email = $request->guestGST_email;
    $d->guestGST_mobile = $request->guestGST_mobile;
    $d->guestGST_state = $request->guestGST_state;
    $d->guestGST_address = $request->guestGST_address;

    $d->save();

    return response()->json(['message' => 'success']);
  }*/

  public function save_traveller_details(Request $request)
  {
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');
    $coupon_id = '';

    // Determine which quote data to retrieve based on quote_no
    /*if ($quote_no == 1) {
        $data = Option1Quotation::find((int)$quote1_id);
        $quote_ref_no = $data->quo_ref;
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
    }*/
    
    switch ($quote_no) {
        case 1:
            $data = Option1Quotation::find((int)$quote1_id);
            $quote_ref_no = $data->quo_ref;
            break;
        case 2:
            $data = Option2Quotation::find((int)$quote2_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
            break;
        case 3:
            $data = Option3Quotation::find((int)$quote3_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
            break;
        case 4:
            $data = Option4Quotation::find((int)$quote4_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
            break;
        default:
            // Handle default case if necessary
            break;
    }

    // Retrieve or create Passengerinfo record
    $passengerInfo = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();
    if (!$passengerInfo) {
        $passengerInfo = new Passengerinfo();
    }

    // Update lead traveller information
    $query_lead_traveller = QueryLeadTraveller::where('email', $data->email)->first();
    $lead_traveller_id = $query_lead_traveller->id;

    $query_lead_traveller_info = QueryLeadTravellerInfo::where([
        ['lead_traveller_id', $lead_traveller_id],
        ['quote_id', $data->id],
        ['qquote_no', $quote_no],
        ['query_id', $data->query_reference]
    ])->first();

    $query_lead_traveller_info->city = $request->guestcontact_city;
    $query_lead_traveller_info->state = $request->guestcontact_state;
    $query_lead_traveller_info->address = $request->guestcontact_address;
    $query_lead_traveller_info->save();

    // Perform activity tracking based on passenger changes
    $check = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();

    if (!$check) {
        $passengers = $request->passenger;
        $output = CustomHelpers::get_passengers_list($passengers);
        $output .= ' added these passengers';

        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    } else {
        $newpassengers = $request->passenger;
        $newpassengers_output = CustomHelpers::get_passengers_list($newpassengers);
        $newpassengers_output = explode(',', $newpassengers_output);
        $old_passengers = unserialize($check->room_passenger);
        $old_passengers_output = CustomHelpers::get_passengers_list($old_passengers);
        $old_passengers_output = explode(',', $old_passengers_output);
        sort($newpassengers_output);
        sort($old_passengers_output);
        $output = '';

        if ($newpassengers_output == $old_passengers_output) {
            $output .= 'No any changes in passengers';
        } else {
            $output .= 'Previous passengers are : ';
            $old_passengers_d = unserialize($check->room_passenger);
            $old_passengers_output_d = CustomHelpers::get_passengers_list($old_passengers_d);
            $output .= $old_passengers_output_d;

            $output .= ' & New passengers are : ';
            $newpassengers_d = $request->passenger;
            $newpassengers_output_d = CustomHelpers::get_passengers_list($newpassengers_d);
            $output .= $newpassengers_output_d;
        }

        CustomHelpers::save_enquiry_tracker($data->query_reference, $output, Sentinel::getUser()->id, 'add_passenger', $data->query_reference);
    }

    // Update Passengerinfo details
    $passengerInfo->quotation_ref_no = $quote_ref_no;
    $passengerInfo->query_reference = $data->query_reference;
    $passengerInfo->lead_traveller_id = $lead_traveller_id;
    $passengerInfo->room_passenger = serialize($request->passenger);
    $passengerInfo->special_request = serialize($request->special_request);
    $passengerInfo->guest_additionaletails = $request->guest_additionaletails;
    $passengerInfo->guestGST_no = $request->guestGST_no;
    $passengerInfo->guestGST_name = $request->guestGST_name;
    $passengerInfo->guestGST_email = $request->guestGST_email;
    $passengerInfo->guestGST_mobile = $request->guestGST_mobile;
    $passengerInfo->guestGST_state = $request->guestGST_state;
    $passengerInfo->guestGST_address = $request->guestGST_address;
    $passengerInfo->save();

    return response()->json(['status' => 'success']);
    }


  /*public function save_pan_details(Request $request)
  {
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    if ($quote_no == 1) {
        $data = Option1Quotation::find((int)$quote1_id);
        $quote_ref_no = $data->quo_ref;
        $price = $data->option1_price;
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

    $d = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();
    if (!$d) {
        $d = new Passengerinfo;
    }

    if ($request->has('pancardnumber')) {
        $d->pancardnumber = $request->pancardnumber;
    }
    if ($request->has('pancardname')) {
        $d->pancardname = $request->pancardname;
    }
    if ($request->has('panacceptance')) {
        $d->confirm_pan = $request->panacceptance;
    }

    $d->save();

    $output = [
        'mode' => $request->gateway,
        'mdr' => $request->mdr,
        'mdr_gst' => $request->mdr_gst,
        'mode_id' => $request->mode_id
    ];

    return $output;
  }*/

  public function save_pan_details(Request $request)
  {
    $unique_code = $request->unique_code;
    $quote_no = Session::get($unique_code . 'quoteno');
    $quote1_id = Session::get($unique_code . 'quote1_id');
    $quote2_id = Session::get($unique_code . 'quote2_id');
    $quote3_id = Session::get($unique_code . 'quote3_id');
    $quote4_id = Session::get($unique_code . 'quote4_id');

    // Determine which quote data to retrieve based on quote_no
    /*if ($quote_no == 1) {
        $data = Option1Quotation::find((int)$quote1_id);
        $quote_ref_no = $data->quo_ref;
        $price = $data->option1_price;
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
    }*/
    switch ($quote_no) {
        case 1:
            $data = Option1Quotation::find((int)$quote1_id);
            $quote_ref_no = $data->quo_ref;
            $price = $data->option1_price;
            break;
        case 2:
            $data = Option2Quotation::find((int)$quote2_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option2_price;
            break;
        case 3:
            $data = Option3Quotation::find((int)$quote3_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option3_price;
            break;
        case 4:
            $data = Option4Quotation::find((int)$quote4_id);
            $quote_ref_no = $data->quotation_ref_no;
            $price = $data->option4_price;
            break;
        default:
            // Handle default case if necessary
            break;
    }

    // Retrieve or create Passengerinfo record
    $passengerInfo = Passengerinfo::where('quotation_ref_no', '=', $quote_ref_no)->first();
    if (!$passengerInfo) {
        $passengerInfo = new Passengerinfo();
    }

    // Update PAN details if provided in the request
    if ($request->has('pancardnumber')) {
        $passengerInfo->pancardnumber = $request->pancardnumber;
    }
    if ($request->has('pancardname')) {
        $passengerInfo->pancardname = $request->pancardname;
    }
    if ($request->has('panacceptance')) {
        $passengerInfo->confirm_pan = $request->panacceptance;
    }

    // Save Passengerinfo details
    $passengerInfo->save();

    // Prepare output response
    $output = [
        'mode' => $request->gateway,
        'mdr' => $request->mdr,
        'mdr_gst' => $request->mdr_gst,
        'mode_id' => $request->mode_id
    ];

    return $output;
  }
}