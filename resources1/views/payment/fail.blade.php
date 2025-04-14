@extends('layouts.front.masternoindex')
@section("title", 'Payment Failed')
@section('content')
<style>
<!--<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet"><style>-->

@media (max-width: 992px) {
.mBar, .mFooter {
	display:none;
	}
.pmtContainer {
	padding: 0;
	display: flex;
    justify-content: center;
    align-items: space-between;
	}
.pmtContainerBox {
	padding: 20px 40px;
	border-radius: 5px;
	background: #fff;
	/*box-shadow: 0 2px 3px #C8D0D8;*/
	width: 100%;
	display: flex;
	flex-direction: column;
    align-items: center;
    justify-content: center;
	}
.pmtIcon {
    height: 100px;
    width: 100px;
	box-shadow: 0 2px 3px #C8D0D8;
    border-radius: 50%;
	background: #F8FAF5;
    font-size: 50px;
	color: #f01b1b;
	font-weight: 600;
	margin-top: 20px;
	margin-bottom: 40px;
	display: flex;
    align-items: center;
    justify-content: center;
	flex-shrink: 0;
	}
.pmtContainerBox h2, h3 {
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 30px;
	line-height: 32px;
	color: #f01b1b;
	font-weight: 600;
	text-align: center;
	margin-bottom: 0;
	}
.pmtMsg {
	margin: 40px 0 0;
	border-top: 1px solid #e7e7e7;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtMsg p {
	padding: 20px 0;
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	}
.pmtDtls {
	margin: 0 0 40px;
	border-top: 1px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	padding: 10px 0;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtContainerBox button {
	width:150px;
	height:35px;
	font-size: 16px;
	line-height: 20px;
	color:#fff;
	font-weight: 900;
	text-transform: uppercase;
	border-radius:30px;
	padding:5px 10px;
	background:#f01b1b;
	transition:all ease-in-out 0.3s;
	cursor: default;
	}
.pmtContainerBox button:hover {
	text-decoration:none;
	}
}
@media (min-width: 992px) {
.dFooter {
	display: none;
	}
.pmtContainer {
	padding: 30px 0 40px;
	display: flex;
    justify-content: center;
    align-items: space-between;
	}
.pmtContainerBox {
	padding: 40px;
	border-radius: 5px;
	background: #fff;
	box-shadow: 0 2px 3px #C8D0D8;
	width: 500px;
	height: 600px;
	display: flex;
	flex-direction: column;
    align-items: center;
    justify-content: center;
	}
.pmtIcon {
    height: 100px;
    width: 100px;
	box-shadow: 0 2px 3px #C8D0D8;
    border-radius: 50%;
	background: #F8FAF5;
    font-size: 50px;
	color: #f01b1b;
	font-weight: 600;
	margin-top: 0;
	margin-bottom: 40px;
	display: flex;
    align-items: center;
    justify-content: center;
	flex-shrink: 0;
	}
.pmtContainerBox h2, h3 {
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 30px;
	line-height: 32px;
	color: #f01b1b;
	font-weight: 600;
	text-align: center;
	margin-bottom: 0;
	}
.pmtMsg {
	margin: 40px 0 0;
	border-top: 1px solid #e7e7e7;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtMsg p {
	padding: 20px 0;
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	}
.pmtDtls {
	margin: 20px 0 70px;
	border-top: 1px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	padding: 10px 0;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtContainerBox button {
	width:200px;
	height:35px;
	font-size: 16px;
	line-height: 20px;
	color:#fff;
	font-weight: 900;
	text-transform: uppercase;
	border-radius:30px;
	padding:5px 10px;
	background:#f01b1b;
	transition:all ease-in-out 0.3s;
	}
.pmtContainerBox button:hover {
	text-decoration:none;
	}
}
</style>
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
<section>
<div class="mBG">
<div class="pmtContainer">
	<div class="pmtContainerBox">
		<div class="pmtIcon">&#x2715;</div>
		<h3>Payment Failed !</h3>
		<div class="pmtMsg">
			<p>If amount is debited from your account, it will be refunded automatically in 5-7 working days</p>
		</div>
			<div class="pmtDtls">
			<?php 
			$quoteno=$data_payment->quote_no;
			if($quoteno==1)
			{
$data=DB::table('option1_quotation')->where('id',$data_payment->quote_id)->first();
			}
			elseif($quoteno==2)
			{
$data=DB::table('option2_quotation')->where('id',$data_payment->quote_id)->first();
			}
			elseif($quoteno==3)
			{
$data=DB::table('option3_quotation')->where('id',$data_payment->quote_id)->first();
			}
			elseif($quoteno==4)
			{
$data=DB::table('option4_quotation')->where('id',$data_payment->quote_id)->first();
			}
			?>
			<div class="flexBetween">
				<div class="fontBold">Booking Reference ID</div>
				<div>{{$data_payment->quote_ref_no}}</div>
			</div>
			<div class="flexBetween">
				<div class="fontBold">Name</div>
				<div>{{$data->name}}</div>
			</div>
			<div class="flexBetween">
				<div class="fontBold">Mobile No.</div>
				<div>{{$data->mobile}}</div>
			</div>
			<div class="flexBetween">
				<div class="fontBold">Email</div>
				<div>{{$data->email}}</div>
			</div>
			<div class="flexBetween">
				<div class="fontBold">Amount Fail</div>
				<div class="defaultCurencyPay">&nbsp;{{$data_payment->amount}}</div>
			</div>
			
		
			<div class="flexBetween">
				<div class="fontBold">Time</div>
				<div>{{date('d-m-Y h:s A',strtotime($data_payment->created_at))}}</div>
			</div>
		</div>
		<div class="fullWidth flexBetween">

			<button >  <a href="{{url('/quotes/'.$data->unique_code)}}">Retry</a> </button>
			<button > <a href="{{url('/')}}">Close</a> </button>
		</div>
	</div>
</div>
</div>
</section>
@endsection