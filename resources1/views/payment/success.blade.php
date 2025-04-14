@extends('layouts.front.masternoindex')
@section("title", 'Payment Successful')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">

<!-- payment success -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/payment-success.css') }}" />

<section>
	<div class="mBG">
		<div class="pmtContainer">
			<div class="pmtContainerBox">
				<div class="pmtIcon">&#10003;</div>
				<h3>Payment Successful !</h3>

				<div class="pmtMsg">
					<p>Thank you !</p>
				</div>

				<div class="pmtDtls">
					<?php 
					
						$quoteno=$data_payment->quote_no;

						if($quoteno==1) {
							$data=DB::table('option1_quotation')->where('id',$data_payment->quote_id)->first();
						} elseif($quoteno==2) {
							$data=DB::table('option2_quotation')->where('id',$data_payment->quote_id)->first();
						} elseif($quoteno==3) {
							$data=DB::table('option3_quotation')->where('id',$data_payment->quote_id)->first();
						} elseif($quoteno==4) {
							$data=DB::table('option4_quotation')->where('id',$data_payment->quote_id)->first();
						}
					?>
					<div class="flexBetween">
						<div class="fontBold">Booking Reference ID</div>
						<div>{{ $data_payment->quote_ref_no }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Name</div>
						<div class="textCapitalize">{{ $data->name }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Mobile No.</div>
						<div>{{ $data->mobile }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Email</div>
						<div class="textLowercase">{{ $data->email }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Transaction Amount</div>
						<div class="defaultCurencyPay">&nbsp; {{ ((int)$data_payment->amount)-((int)$data_payment->mdr_amount+(int)$data_payment->gst_on_mdr_amount) }}
						</div>
					</div>

		           <div class="flexBetween">
						<div class="fontBold">Gateway Charge</div>
						<div class="defaultCurencyPay">&nbsp; {{ ((int)$data_payment->mdr_amount+(int)$data_payment->gst_on_mdr_amount) }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Amount Paid</div>
						<div class="defaultCurencyPay">&nbsp;{{ $data_payment->amount }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Payment Mode</div>
						<div>{{ $data_payment->payment_mode }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Transaction ID</div>
						<div>{{ $data_payment->transaction_id }}</div>
					</div>

					<div class="flexBetween">
						<div class="fontBold">Time</div>
						<div>{{ date('d-m-Y h:s A',strtotime($data_payment->created_at)) }}</div>
					</div>
				</div>
				<div class="fullWidth flexBetween">
					<button type="button" onclick="window.print()">Print</button>
					<button type="button">
						<a href="{{ url('/') }}">Close</a>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection