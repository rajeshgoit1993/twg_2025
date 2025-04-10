<!--<div class="row">
<div class="col-md-12">
	<div style="text-align: right;">
		<br>
	<button class="btn btn-success user_quote_accept" content_id="{{CustomHelpers::custom_encrypt($data1->id)}}" content_action="{{url('quote_accept')}}">Accept Quote</button>
	<button class="btn btn-danger user_quote_accept" content_id="{{CustomHelpers::custom_encrypt($data1->id)}}" content_action="{{url('quote_reject')}}">Reject Quote</button>
	</div>
</div>
</div>-->
<!-- <div class="rejectionReasonCont">
	<ul>
		<li>
			<label for="pricehigh" class="rejectionLabel"><input type="radio" id="pricehigh" class="rejectionInput" name="pricehigh" value="pricehigh">Price is high</label>
		</li>
		<li>
			<label for="callback" class="rejectionLabel"><input type="radio" id="callback" class="rejectionInput" name="callback1" value="callback">Want call back</label>
		</li>
		<li>
			<label for="bookedwithother" class="rejectionLabel"><input type="radio" id="bookedwithother" class="rejectionInput" name="bookedwithother" value="bookedwithother">Booked with other</label>
		</li>
		<li>
			<label for="datechange" class="rejectionLabel"><input type="radio" id="datechange" class="rejectionInput" name="datechange" value="datechange">Date Changed</label>
		</li>
		<li>
			<label for="cancelled" class="rejectionLabel"><input type="radio" id="cancelled" class="rejectionInput" name="cancelled" value="cancelled">Tour Cancelled</label>
		</li>
		<li>
			<label for="postponned" class="rejectionLabel"><input type="radio" id="postponned" class="rejectionInput" name="postponned" value="postponned">Tour Postponned</label>
		</li>
		<li>
			<label for="destinationchange" class="rejectionLabel"><input type="radio" id="destinationchange" class="rejectionInput" name="destinationchange" value="destinationchange">Destination Changed</label>
		</li>
	</ul>
</div> -->

<div class="flexCenter">
    <!-- Button to raise concern (commented out) -->
    <!-- <button class="btnMain btnRaiseConcern" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_reject') }}">RAISE CONCERN</button> -->

    <!-- raised requests-desktop -->
    @if(Sentinel::getUser()->inRole('super_admin')
        || Sentinel::getUser()->inRole('administrator')
        || Sentinel::getUser()->inRole('supervisor')
        || Sentinel::getUser()->inRole('agent')
        || Sentinel::getUser()->inRole('employee'))
        <?php
            // Fetch previous raises for the quotation reference number
            $previous_raises = DB::table('quote_raise_concern')->where('quotation_ref_no', $data1->quo_ref)->get();
        ?>
        <span class="btnRaiseConcern_button">
            @if(count($previous_raises) > 0)
                <button type="button" class="btnRaiseConcern previous_raise" id="{{ $data1->quo_ref }}">Request Raised</button>
            @endif
        </span>
    @endif

    <!-- Button to raise concern with modal trigger -->
    <button type="button" class="btnRaiseConcern" data-toggle="modal" data-target="#myModal" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}">Request Callback</button>

    <!-- ****************************** -->

    <!-- Vouchers, TCS & Invoice -->
    <?php
        // Fetch documents related to the lead voucher
        $docs = DB::table('lead_voucher')->where('lead_id', '=', $data1->query_reference)->get();
    ?>
    @if(count($docs) > 0)
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#voucher_list">Vouchers, TCS & Invoice</button>
    @endif
    
    <!-- ****************************** -->

    <!-- Hidden inputs -->
    <input type="hidden" name="quote_no" class="quote_no" value="{{ CustomHelpers::custom_encrypt(1) }}">
    <input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($data1->unique_code) }}">


    <!-- old -->
    <!-- @if(CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) == 0 || CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) < 0)
        !-- Display a button indicating paid status --
        <button class="btn btn-success">Paid</button>
    @else
        <?php  
          // Get today's date in UNIX timestamp
          $today = strtotime(date('Y-m-d'));
          $time = $data1->validity_time;

          // Set default time if not provided
          if ($time == '') {
              $time = '23:59:59';
          }

          // Calculate validity timestamp based on option1_validaty field
          $validity = strtotime(date("Y-m-d", strtotime(str_replace('/','-',$data1->option1_validaty))) . ' ' . $time);
        ?>

        @if ($today <= $validity || CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) > 0)
            @if ($data1->send_option == 1)
                <?php 
                    // Check if there are payments for the quote
                    $check = DB::table('rt_payments')
                            ->where([
                                ['quote_ref_no', '=', $data1->quo_ref],
                                ['status', '=', 1],
                                ['transaction_type', '=', 0]
                            ])->get();
                ?>

                @if (count($check) > 0)
                    <button class="btnPayBook pay_now" content_action="{{ route('bookingreview') }}">Pay Balance &#8377; {{ CustomHelpers::get_remaining_amount_second(1, $data1->unique_code) }}</button>
                @else
                    <button class="btnPayBook pay_now" content_action="{{ route('bookingreview') }}">Pay & Book</button>
                @endif
            @else
                <button class="btnPayBook" style="cursor: not-allowed !important;">Pay & Book</button>
            @endif
        @else
            <button class="" content_action="">Expired</button>
        @endif
    @endif -->

    <!-- new -->
    <?php $remainingAmount = CustomHelpers::get_remaining_amount_second(1, $data1->unique_code); ?>
    @if ($remainingAmount == 0 || $remainingAmount < 0)
        <button class="btn btn-success">Paid</button>
    @else
        <?php  
            $today = strtotime(date('Y-m-d'));
            $time = $data1->validity_time ?: '23:59:59';
            $validity = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $data1->option1_validaty))) . ' ' . $time);
        ?>
        @if ($today <= $validity || $remainingAmount > 0)
            @if ($data1->send_option == 1)
                <?php 
                    $check = DB::table('rt_payments')
                                ->where([
                                    ['quote_ref_no', '=', $data1->quo_ref],
                                    ['status', '=', 1],
                                    ['transaction_type', '=', 0]
                                ])->count();
                ?>
                @if ($check > 0)
                    <button class="btnPayBook pay_now" content_action="{{ route('bookingreview') }}">Pay Balance &#8377; {{ $remainingAmount }}</button>
                @else
                    <button class="btnPayBook pay_now" content_action="{{ route('bookingreview') }}">Pay & Book</button>
                @endif
            @else
                <button class="btnPayBook" style="cursor: not-allowed !important;">Pay & Book</button>
            @endif
        @else
            <button class="btn-quote-expired" content_action="">Expired</button>
        @endif
    @endif

</div>

<!---->
<!-- <button class="btnMain btnPayBook user_quote_accept" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_accept') }}">PAY & BOOK</button> -->

<!-- ****************************** -->

<!-- modal voucher list in quotation_webpage -> accept -->
<div id="voucher_list" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Voucher List</h4>
            </div>
            <div class="modal-body">
                <?php  
                    // Fetch vouchers related to the lead voucher
                    $docs = DB::table('lead_voucher')->where('lead_id', '=', $data1->query_reference)->get();
                    if (count($docs) != "" && count($docs) != "0"):
                        $output = "";
                        $output .= "<table class='table table-striped'><tr>
                            <th>S.No.</th>
                            <th>File Type</th>
                            <th>File</th>
                            <th>Date</th>
                            </tr>";
                        $i = 0;
                        foreach ($docs as $datas):
                            $voucher = unserialize($datas->voucher);
                            $date = date("d M Y H:i", strtotime($datas->created_at));
                            $file_type = $datas->file_type;
                            if ($file_type == 0) {
                                $subject = 'Voucher';
                            } elseif ($file_type == 1) {
                                $subject = 'TCS';
                            } elseif ($file_type == 2) {
                                $subject = 'Invoice';  
                            }

                            foreach ($voucher as $vouchers):
                                $i++;
                                $path = url('/public/uploads/voucher/' . $vouchers);
                                $output .= "<tr>
                                    <td>$i</td>
                                    <td>$subject</td>
                                    <td><a href='$path' download>Download</a></td>
                                    <td>$date</td>
                                    </tr>";
                            endforeach;
                        endforeach;
                        $output .= "</table>";
                        echo "$output";
                    endif;
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ****************************** -->