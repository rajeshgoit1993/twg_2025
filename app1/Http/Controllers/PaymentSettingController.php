<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use App\GatewaySetting;
use App\TwgPaymentMode;
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
use App\Helpers\PackagePriceHelpers;
use App\Payment;
use App\Query;
use App\Passengerinfo;
use App\QueryLeadTravellerInfo;
use App\QueryLeadTraveller;
use App\QueryTraveller;
use Redirect;
use App\Coupon;
use Datatables;


class PaymentSettingController extends Controller
{

    public function payment_receipt($id)
    {
        $data_payment=Payment::find($id);
        if($data_payment->status==1)
        {
            return view("payment.success",compact('data_payment'));
        }
        else
        {
            return view("payment.fail",compact('data_payment'));
        }
    }

    public function quotetransactions()
    {
        return view('backend_files.quotetransactions.index');
    } 

    /*--------------------------*/

    /*public function get_quote_list(Request $request)
    {
        $quote_type=$request->quote_type;
        if($quote_type==1)
        {
            $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
            ->whereIn('rt_package_query.status', ['process_booking','payment_follow_up','under_cancellation','issue_voucher','voucher_issued','refund_processed'])
            ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
            ->get();
        }
        elseif($quote_type==2)
        {
            $data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1]])
            ->whereIn('rt_package_query.status', ['process_booking','payment_follow_up','under_cancellation','issue_voucher','voucher_issued'])
            ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label','rt_package_query.span_value_child_without_bed')
            ->get();
        }
        elseif($quote_type==3)
        {
            $data=[];
        }
        $output='';
        foreach($data as $d)
        {
            $output.='<option value="'.$d->quo_ref.'">'.$d->quo_ref.'('.$d->name.')</option>';
        }
        echo $output;
    }*/

    public function get_quote_list(Request $request)
    {
        // Retrieve the quote type from the request
        $quote_type = $request->quote_type;

        // Initialize data array
        $data = [];

        // Determine which table data to retrieve based on quote type
        if ($quote_type == 1) {
            // Fetch data for quote type 1, joining the necessary tables and filtering by status
            $data = DB::table('option1_quotation')
                ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                ->where([
                    ['option1_quotation.webnotation', '=', env("WEBSITENAME")],
                    ['option1_quotation.del_status', '=', 1],
                    ['option1_quotation.send_option', '=', 1]
                ])
                ->whereIn('rt_package_query.status', [
                    'process_booking', 
                    'payment_follow_up', 
                    'under_cancellation', 
                    'issue_voucher', 
                    'voucher_issued', 
                    'refund_processed'
                ])
                ->select(
                    'option1_quotation.*', 
                    'rt_package_query.destinations', 
                    'rt_package_query.booking_label', 
                    'rt_package_query.span_value_child_without_bed'
                )
                ->get();
        } elseif ($quote_type == 2) {
            // Fetch data for quote type 2, similar to type 1 but with a different set of statuses
            $data = DB::table('option1_quotation')
                ->join('rt_package_query', 'rt_package_query.id', '=', 'option1_quotation.query_reference')
                ->where([
                    ['option1_quotation.webnotation', '=', env("WEBSITENAME")],
                    ['option1_quotation.del_status', '=', 1],
                    ['option1_quotation.send_option', '=', 1]
                ])
                ->whereIn('rt_package_query.status', [
                    'process_booking', 
                    'payment_follow_up', 
                    'under_cancellation', 
                    'issue_voucher', 
                    'voucher_issued'
                ])
                ->select(
                    'option1_quotation.*', 
                    'rt_package_query.destinations', 
                    'rt_package_query.booking_label', 
                    'rt_package_query.span_value_child_without_bed'
                )
                ->get();
        } elseif ($quote_type == 3) {
            // No data required for quote type 3
            $data = [];
        }

        // Initialize output variable for HTML options
        $output = '';

        // Loop through the data to build the options for the HTML select
        foreach ($data as $d) {
            $output .= '<option value="' . $d->quo_ref . '">' . $d->quo_ref . ' (' . $d->name . ')</option>';
        }

        // Return the output HTML as the response
        echo $output;
    }

    /*--------------------------*/

    /*public function quote_transactions_lists(Request $request)
    {
        $select_quote=$request->select_quote;
        $status=$request->status;
        if($status==2):
        $out=[0,1];
        elseif($status==1):
        $out=[1];
        elseif($status==0):
        $out=[0];
        endif;
        $data =  DB::table('rt_payments')->whereIn('status',$out)->where('quote_ref_no',$select_quote)->orderBy('updated_at', 'desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('description', function($row){
        $first=$row->description;
        $payment_type=$row->payment_type;
        if($payment_type==0)
        {
        $p_type='online';
        }
        else
        {
        $p_type='offline';
        }
        if($row->transaction_type==0)
        {
        $part_type='';
        if($row->part_payment=='full')
        {
        $part_type='Full '.$p_type;
        }
        elseif($row->part_payment=='full_s')
        {
        $part_type='Full sub-Partial '.$p_type;
        }
        elseif($row->part_payment=='1')
        {
        $part_type='First partial payment '.$p_type;
        }
        elseif($row->part_payment=='1_s')
        {
        $part_type='First sub-partial '.$p_type;
        }
        elseif($row->part_payment=='2')
        {
        $part_type='Second partial '.$p_type;
        }
        elseif($row->part_payment=='2_s')
        {
        $part_type='Second sub-partial '.$p_type;
        }
        elseif($row->part_payment=='3')
        {
        $part_type='Third partial '.$p_type;
        }
        elseif($row->part_payment=='full_s')
        {
        $part_type='Third sub-partial '.$p_type;
        }
        $output=$first.' ('.$part_type.')';
        }
        else
        {
        $output=$first.' (Refund '.$p_type.')';
        }
        return "<span class='payment_details' id='".$row->id."'>".$output."</span>";
        })
        ->addColumn('updated_at', function($row){
        return "<span class='payment_details' id='".$row->id."'>".date("d M Y H:i", strtotime($row->updated_at))."</span>";
        })
        ->addColumn('amount_cr', function($row){
        if($row->transaction_type==1)
        {
        return "<span class='payment_details' style='color:red' id='".$row->id."'>".$row->amount."</span>";
        }
        else
        {
        return '';
        }
        })
        ->addColumn('amount_dr', function($row){
        if($row->transaction_type==0)
        {
        return "<span class='payment_details' style='color:green' id='".$row->id."'>".$row->amount."</span>";
        }
        else
        {
        return ' ';
        }
        })
        ->addColumn('transaction_id', function($row){
        return "<span class='payment_details' id='".$row->id."'>".$row->transaction_id."</span>";
        })
        ->addColumn('status', function($row){
        if($row->status == 1):
        $status="<p style='color:green'>Completed</p>";
        else:
        $status="<p style='color:red'>Pending</p>";
        endif;
        return "<span class='payment_details' id='".$row->id."'>".$status."</span>";
        })
        ->addColumn('amount', function($row){
        return "<span class='payment_details' id='".$row->id."'><i class='fa fa-rupee'></i> ".$row->amount."</span>";
        })
        ->addColumn('payment_mode', function($row){
        if($row->gateway_id!='' && $row->payment_type==0)
        {
        $gateway_data=DB::table('gateway_settings')->where('id',$row->gateway_id)->first();
        if($row->payment_type==1)
        {
        return "<span class='payment_details' id='".$row->id."'>Cash (".$gateway_data->gateway_name.")</span>";
        }
        else
        {
        return "<span class='payment_details' id='".$row->id."'>".$row->payment_mode.' ('.$gateway_data->gateway_name.")</span>";
        }
        }
        elseif($row->gateway_id=='' && $row->payment_type==1)
        {
        return "<span class='payment_details' id='".$row->id."'>Cash (offline)</span>";
        }
        else
        {
        return $row->gateway_id;
        }
        })
        ->addColumn('link', function($row){
        $path=url('payment-receipt/'.$row->id);
        return "<a href='".$path."' target='_blank'>View</a>";
        })
        ->make(true);
    }*/

    public function quote_transactions_lists(Request $request)
    {
        // Get the quote reference number and status from the request
        $select_quote = $request->select_quote;
        $status = $request->status;

        // Determine the output status based on the incoming status
        if ($status == 2) {
            $out = [0, 1]; // Both completed and pending
        } elseif ($status == 1) {
            $out = [1]; // Only completed
        } elseif ($status == 0) {
            $out = [0]; // Only pending
        }

        // Retrieve payment data from the database based on the conditions
        $data = DB::table('rt_payments')
            ->whereIn('status', $out)
            ->where('quote_ref_no', $select_quote)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Use Yajra DataTables to format the data for response
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('description', function ($row) {
                $first = $row->description;
                $payment_type = $row->payment_type;

                // Determine payment type
                $p_type = $payment_type == 0 ? 'online' : 'offline';

                // Determine transaction details based on transaction type and part payment
                if ($row->transaction_type == 0) {
                    $part_type = '';
                    switch ($row->part_payment) {
                        case 'full':
                            $part_type = 'Full ' . $p_type;
                            break;
                        case 'full_s':
                            $part_type = 'Full sub-Partial ' . $p_type;
                            break;
                        case '1':
                            $part_type = 'First partial payment ' . $p_type;
                            break;
                        case '1_s':
                            $part_type = 'First sub-partial ' . $p_type;
                            break;
                        case '2':
                            $part_type = 'Second partial ' . $p_type;
                            break;
                        case '2_s':
                            $part_type = 'Second sub-partial ' . $p_type;
                            break;
                        case '3':
                            $part_type = 'Third partial ' . $p_type;
                            break;
                        case 'full_s':
                            $part_type = 'Third sub-partial ' . $p_type;
                            break;
                    }
                    $output = $first . ' (' . $part_type . ')';
                } else {
                    $output = $first . ' (Refund ' . $p_type . ')';
                }

                return "<span class='payment_details' id='" . $row->id . "'>" . $output . "</span>";
            })
            ->addColumn('updated_at', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'>" . date("d M Y H:i", strtotime($row->updated_at)) . "</span>";
            })
            ->addColumn('amount_cr', function ($row) {
                return $row->transaction_type == 1
                    ? "<span class='payment_details' style='color:red' id='" . $row->id . "'>" . $row->amount . "</span>"
                    : '';
            })
            ->addColumn('amount_dr', function ($row) {
                return $row->transaction_type == 0
                    ? "<span class='payment_details' style='color:green' id='" . $row->id . "'>" . $row->amount . "</span>"
                    : ' ';
            })
            ->addColumn('transaction_id', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'>" . $row->transaction_id . "</span>";
            })
            ->addColumn('status', function ($row) {
                $statusLabel = $row->status == 1
                    ? "<p style='color:green'>Completed</p>"
                    : "<p style='color:red'>Pending</p>";

                return "<span class='payment_details' id='" . $row->id . "'>" . $statusLabel . "</span>";
            })
            ->addColumn('amount', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'><i class='fa fa-rupee'></i> " . $row->amount . "</span>";
            })
            ->addColumn('payment_mode', function ($row) {
                $payment_info = '';

                if ($row->gateway_id && $row->payment_type == 0) {
                    $gateway_data = DB::table('gateway_settings')->where('id', $row->gateway_id)->first();
                    $payment_info = $row->payment_type == 1
                        ? "Cash (" . $gateway_data->gateway_name . ")"
                        : $row->payment_mode . ' (' . $gateway_data->gateway_name . ")";
                } elseif (!$row->gateway_id && $row->payment_type == 1) {
                    $payment_info = "Cash (offline)";
                } else {
                    $payment_info = $row->gateway_id;
                }

                return "<span class='payment_details' id='" . $row->id . "'>" . $payment_info . "</span>";
            })
            ->addColumn('link', function ($row) {
                $path = url('payment-receipt/' . $row->id);
                return "<a href='" . $path . "' target='_blank'>View</a>";
            })
            ->make(true);
    }

    /*--------------------------*/


    /*public function gat_payment_data(Request $request)
    {
        $id=$request->id;
        $data=Payment::find($id);
        $output=view('backend_files.transactions.gat_payment_data',compact('data'))->render();
        echo $output;
    }*/
    public function gat_payment_data(Request $request)
    {
        // Retrieve the payment ID from the request
        $id = $request->id;

        // Find the payment record by its ID
        $data = Payment::find($id);

        // Check if the payment record exists
        if (!$data) {
            return response()->json(['error' => 'Payment not found.'], 404);
        }

        // Render the view with the retrieved data
        $output = view('backend_files.transactions.gat_payment_data', compact('data'))->render();

        // Return the rendered output
        return response()->json(['html' => $output]);
    }

    /*--------------------------*/

    /*public function transactions_lists(Request $request)
    {
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $status=$request->status;
        if($status==2):
        $out=[0,1];
        elseif($status==1):
        $out=[1];
        elseif($status==0):
        $out=[0];
        endif;
        $data =  DB::table('rt_payments')->whereBetween('created_at', [$start_date." 00:00:00", $end_date." 23:59:59"])->whereIn('status',$out)->orderBy('updated_at', 'desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('description', function($row){
        $first=$row->description;
        $payment_type=$row->payment_type;
        if($payment_type==0)
        {
        $p_type='online';
        }
        else
        {
        $p_type='offline';
        }
        if($row->transaction_type==0)
        {
        $part_type='';
        if($row->part_payment=='full')
        {
        $part_type='Full '.$p_type;
        }
        elseif($row->part_payment=='full_s')
        {
        $part_type='Full sub-Partial '.$p_type;
        }
        elseif($row->part_payment=='1')
        {
        $part_type='First partial payment '.$p_type;
        }
        elseif($row->part_payment=='1_s')
        {
        $part_type='First sub-partial '.$p_type;
        }
        elseif($row->part_payment=='2')
        {
        $part_type='Second partial '.$p_type;
        }
        elseif($row->part_payment=='2_s')
        {
        $part_type='Second sub-partial '.$p_type;
        }
        elseif($row->part_payment=='3')
        {
        $part_type='Third partial '.$p_type;
        }
        elseif($row->part_payment=='full_s')
        {
        $part_type='Third sub-partial '.$p_type;
        }
        $output=$first.' ('.$part_type.')';
        }
        else
        {
        $output=$first.' (Refund '.$p_type.')';
        }
        return "<span class='payment_details' id='".$row->id."'>".$output."</span>";
        })
        ->addColumn('updated_at', function($row){
        return "<span class='payment_details' id='".$row->id."'>".date("d M Y H:i", strtotime($row->updated_at))."</span>";
        })
        ->addColumn('amount_cr', function($row){
        if($row->transaction_type==1)
        {
        return "<span class='payment_details' style='color:red' id='".$row->id."'>".$row->amount."</span>";
        }
        else
        {
        return ' ';
        }
        })
        ->addColumn('amount_dr', function($row){
        if($row->transaction_type==0)
        {
        return "<span class='payment_details' style='color:green' id='".$row->id."'>".$row->amount."</span>";
        }
        else
        {
        return ' ';
        }
        })
        ->addColumn('transaction_id', function($row){
        return "<span class='payment_details' id='".$row->id."'>".$row->transaction_id."</span>";
        })
        ->addColumn('status', function($row){
        if($row->status == 1):
        $status="<p style='color:green'>Completed</p>";
        else:
        $status="<p style='color:red'>Pending</p>";
        endif;
        return "<span class='payment_details' id='".$row->id."'>".$status."</span>";
        })
        ->addColumn('amount', function($row){
        return "<span class='payment_details' id='".$row->id."'><i class='fa fa-rupee'></i> ".$row->amount."</span>";
        })
        ->addColumn('payment_mode', function($row){
        if($row->gateway_id!='' && $row->payment_type==0)
        {
        $gateway_data=DB::table('gateway_settings')->where('id',$row->gateway_id)->first();
        if($row->payment_type==1)
        {
        return "<span class='payment_details' id='".$row->id."'>Cash (".$gateway_data->gateway_name.")</span>";
        }
        else
        {
        return "<span class='payment_details' id='".$row->id."'>".$row->payment_mode.' ('.$gateway_data->gateway_name.")</span>";
        }
        }
        elseif($row->gateway_id=='' && $row->payment_type==1)
        {
        return "<span class='payment_details' id='".$row->id."'>Cash (offline)</span>";
        }
        else
        {
        return $row->gateway_id;
        }
        })
        ->addColumn('link', function($row){
        $path=url('payment-receipt/'.$row->id);
        return "<a href='".$path."' target='_blank'>View</a>";
        })
        ->make(true);
    }*/
    public function transactions_lists(Request $request)
    {
        // Retrieve the input parameters
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status = $request->status;

        // Determine the status filter based on the provided status
        if ($status == 2) {
            $out = [0, 1];
        } elseif ($status == 1) {
            $out = [1];
        } elseif ($status == 0) {
            $out = [0];
        } else {
            $out = []; // Default case, can be adjusted as needed
        }

        // Query the database for payment records
        $data = DB::table('rt_payments')
            ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . " 23:59:59"])
            ->whereIn('status', $out)
            ->orderBy('updated_at', 'desc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('description', function ($row) {
                return $this->formatPaymentDescription($row);
            })
            ->addColumn('updated_at', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'>" . date("d M Y H:i", strtotime($row->updated_at)) . "</span>";
            })
            ->addColumn('amount_cr', function ($row) {
                return $this->formatAmount($row, 'credit');
            })
            ->addColumn('amount_dr', function ($row) {
                return $this->formatAmount($row, 'debit');
            })
            ->addColumn('transaction_id', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'>" . $row->transaction_id . "</span>";
            })
            ->addColumn('status', function ($row) {
                return $this->formatPaymentStatus($row);
            })
            ->addColumn('amount', function ($row) {
                return "<span class='payment_details' id='" . $row->id . "'><i class='fa fa-rupee'></i> " . $row->amount . "</span>";
            })
            ->addColumn('payment_mode', function ($row) {
                return $this->formatPaymentMode($row);
            })
            ->addColumn('link', function ($row) {
                $path = url('payment-receipt/' . $row->id);
                return "<a href='" . $path . "' target='_blank'>View</a>";
            })
            ->make(true);
    }

    // Helper function to format payment descriptions
    private function formatPaymentDescription($row)
    {
        $first = $row->description;
        $p_type = $row->payment_type == 0 ? 'online' : 'offline';

        if ($row->transaction_type == 0) {
            $part_type = $this->getPartPaymentType($row, $p_type);
            return "<span class='payment_details' id='" . $row->id . "'>" . $first . " (" . $part_type . ")</span>";
        } else {
            return "<span class='payment_details' id='" . $row->id . "'>" . $first . " (Refund " . $p_type . ")</span>";
        }
    }

    // Helper function to get part payment type
    private function getPartPaymentType($row, $p_type)
    {
        if ($row->part_payment == 'full') {
            return 'Full ' . $p_type;
        } elseif ($row->part_payment == 'full_s') {
            return 'Full sub-Partial ' . $p_type;
        } elseif ($row->part_payment == '1') {
            return 'First partial payment ' . $p_type;
        } elseif ($row->part_payment == '1_s') {
            return 'First sub-partial ' . $p_type;
        } elseif ($row->part_payment == '2') {
            return 'Second partial ' . $p_type;
        } elseif ($row->part_payment == '2_s') {
            return 'Second sub-partial ' . $p_type;
        } elseif ($row->part_payment == '3') {
            return 'Third partial ' . $p_type;
        } elseif ($row->part_payment == '3_s') {
            return 'Third sub-partial ' . $p_type;
        }
        return '';
    }

    // Helper function to format amounts based on transaction type
    private function formatAmount($row, $type)
    {
        if (($type === 'credit' && $row->transaction_type == 1) || ($type === 'debit' && $row->transaction_type == 0)) {
            $color = $type === 'credit' ? 'red' : 'green';
            return "<span class='payment_details' style='color:{$color}' id='" . $row->id . "'>" . $row->amount . "</span>";
        }
        return '';
    }

    // Helper function to format payment status
    private function formatPaymentStatus($row)
    {
        $status = $row->status == 1 ? "<p style='color:green'>Completed</p>" : "<p style='color:red'>Pending</p>";
        return "<span class='payment_details' id='" . $row->id . "'>" . $status . "</span>";
    }

    // Helper function to format payment mode
    private function formatPaymentMode($row)
    {
        if ($row->gateway_id != '' && $row->payment_type == 0) {
            $gateway_data = DB::table('gateway_settings')->where('id', $row->gateway_id)->first();
            return "<span class='payment_details' id='" . $row->id . "'>" . $row->payment_mode . " (" . $gateway_data->gateway_name . ")</span>";
        } elseif ($row->gateway_id == '' && $row->payment_type == 1) {
            return "<span class='payment_details' id='" . $row->id . "'>Cash (offline)</span>";
        } else {
            return $row->gateway_id;
        }
    }

    /*--------------------------*/

    public function transactions()
    {
        return view('backend_files.transactions.index');
    }

    public function payment_mode()
    {
        $data = TwgPaymentMode::all();
        return view('backend_files.paymentmode.index',compact('data'));
    }

    public function add_payment_mode()
    {
        $data = GatewaySetting::all();
        return view('backend_files.paymentmode.create',compact('data'));
    }

    public function store_payment_mode(Request $request)
    {
        $data = new TwgPaymentMode;
        $data->mode=$request->mode;
        $data->gateway_id=$request->gateway_id;
        $data->mdr=$request->mdr;
        $data->gst_on_mdr=$request->gst_on_mdr;
        $data->status=$request->status;
        $data->save();
        return redirect('/Payment-Modes')->with('success','Successfully Added');
    }

    public function editpaymentmode($id)
    {
        $payment_mode_data=TwgPaymentMode::find($id);
        $data = GatewaySetting::all();
        return view('backend_files.paymentmode.edit',compact('data','payment_mode_data'));
    }

    public function update_payment_mode(Request $request)
    {
        $id=$request->id;
        $data =TwgPaymentMode::find($id);
        $data->mode=$request->mode;
        $data->gateway_id=$request->gateway_id;
        $data->mdr=$request->mdr;
        $data->gst_on_mdr=$request->gst_on_mdr;
        $data->status=$request->status;
        $data->save();
        return redirect('/Payment-Modes')->with('success','Successfully Updated');
    }

    public function gateway_settings() {
        $data = GatewaySetting::all();
        return view('backend_files.gateway_setting.index',compact('data'));
    }

    public function editgatewaysetting($id)
    {
        $data = GatewaySetting::find($id);
        return view('backend_files.gateway_setting.edit',compact('data'));
    }

    public function updategatewaysetting(Request $request)
    {
        $id=$request->id;
        $data = GatewaySetting::find($id);
        $data->status=$request->status;
        $data->environment=$request->environment;
        $data->test_merchant_key=$request->test_merchant_key;
        $data->test_merchant_mid=$request->test_merchant_mid;
        $data->prd_merchant_key=$request->prd_merchant_key;
        $data->prd_merchant_mid=$request->prd_merchant_mid;
        $data->save();
        return redirect('/Gateway-Settings')->with('success','Successfully updated');
    }

    /*public function gateway_data(Request $request) 
    {
        $id=$request->id;
        $data=GatewaySetting::find($id);
        $value="
            <div class='row'>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Gateway Name</label>
                        <input class='form-control'  type='text'  value='".$data->gateway_name."'  style='border-radius: 0px;height: 33px;background:white' readonly />
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Status</label>";
        if($data->status==1):
        $value.="<input class='form-control'  type='text'  value='Enable'  style='border-radius: 0px;height: 33px;background:white' readonly />";
        else:
        $value.="<input class='form-control'  type='text'  value='Disable'  style='border-radius: 0px;height: 33px;background:white' readonly />";
        endif;
        $value.= "
        </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label>Environment Mode</label>";
        if($data->environment==1):
        $value.="<input class='form-control'  type='text'  value='Live'  style='border-radius: 0px;height: 33px;background:white' readonly />";
        else:
        $value.="<input class='form-control'  type='text'  value='Test'  style='border-radius: 0px;height: 33px;background:white' readonly />";
        endif;
        $value.="
        </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label>Test Merchant Key</label>
        <input class='form-control'  type='text'  value='".$data->test_merchant_key."'  style='border-radius: 0px;height: 33px;background:white' readonly />
        </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label>Test Merchant ID</label>
        <input class='form-control'  type='text'  value='".$data->test_merchant_mid."'  style='border-radius: 0px;height: 33px;background:white' readonly />
        </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label>Live Merchant Key</label>
        <input class='form-control'  type='text'  value='".$data->prd_merchant_key."'  style='border-radius: 0px;height: 33px;background:white' readonly />
        </div>
        </div>
        <div class='col-md-6'>
        <div class='form-group'>
        <label>Live Merchant ID </label>
        <input class='form-control'  type='text'  value='".$data->prd_merchant_mid."'  style='border-radius: 0px;height: 33px;background:white' readonly />
        </div>
        </div>
        </div>";
        echo $value;
    }*/
    public function gateway_data(Request $request) 
    {
        // Retrieve ID from request
        $id = $request->id;

        // Fetch GatewaySetting record by ID
        $data = GatewaySetting::find($id);

        // Initialize the HTML content
        $value = "
            <div class='row'>
                <!-- Gateway Name Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Gateway Name</label>
                        <input class='form-control' type='text' 
                               value='" . $data->gateway_name . "' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />
                    </div>
                </div>

                <!-- Status Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Status</label>";
                        
        // Display 'Enable' or 'Disable' based on status
        if ($data->status == 1) {
            $value .= "<input class='form-control' type='text' value='Enable' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />";
        } else {
            $value .= "<input class='form-control' type='text' value='Disable' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />";
        }

        $value .= "
                    </div>
                </div>

                <!-- Environment Mode Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Environment Mode</label>";
                        
        // Display 'Live' or 'Test' based on environment mode
        if ($data->environment == 1) {
            $value .= "<input class='form-control' type='text' value='Live' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />";
        } else {
            $value .= "<input class='form-control' type='text' value='Test' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />";
        }

        $value .= "
                    </div>
                </div>

                <!-- Test Merchant Key Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Test Merchant Key</label>
                        <input class='form-control' type='text' 
                               value='" . $data->test_merchant_key . "' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />
                    </div>
                </div>

                <!-- Test Merchant ID Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Test Merchant ID</label>
                        <input class='form-control' type='text' 
                               value='" . $data->test_merchant_mid . "' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />
                    </div>
                </div>

                <!-- Live Merchant Key Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Live Merchant Key</label>
                        <input class='form-control' type='text' 
                               value='" . $data->prd_merchant_key . "' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />
                    </div>
                </div>

                <!-- Live Merchant ID Field -->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Live Merchant ID</label>
                        <input class='form-control' type='text' 
                               value='" . $data->prd_merchant_mid . "' 
                               style='border-radius: 0px; height: 33px; background: white' 
                               readonly />
                    </div>
                </div>
            </div>
        ";

        // Output the generated HTML content
        echo $value;
    }

}
