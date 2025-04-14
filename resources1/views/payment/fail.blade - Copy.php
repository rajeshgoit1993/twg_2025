@extends('layouts.front.masternoindex')
@section("title", 'Payment Failed')
@section('content')
<style>
@media (max-width: 992px) {
.mBar, .mFooter {
	display:none;
	}
.pmtFailCont {
	padding: 0;
	display: flex;
    justify-content: center;
    align-items: center;
	}
.pmtFailContBox {
	padding: 30px 40px;
	border-radius: 5px;
	background: #fff;
	/*box-shadow: 0 2px 3px #C8D0D8;*/
	width: 100%;
	display: flex;
	flex-direction: column;
    align-items: center;
    justify-content: center;
	}
.pmtFailIcon {
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
	}
.pmtFailContBox h2, h3 {
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 30px;
	line-height: 32px;
	color: #f01b1b;
	font-weight: 600;
	text-align: center;
	margin-bottom: 0;
	}
.pmtFailContBox p {
	margin-top: 50px;
	border-top: 1px solid #e7e7e7;
	padding-top: 20px;
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	}
.pmtFailDtls {
	margin: 40px 0 70px;
	border-top: 1px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	padding: 10px 0;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtFailContBox button {
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
	cursor: default;
	}
.pmtFailContBox button:hover {
	text-decoration:none;
	}
}
@media (min-width: 992px) {
.dFooter {
	display: none;
	}
.pmtFailCont {
	padding: 50px 0 100px;
	display: flex;
    justify-content: center;
    align-items: center;
	}
.pmtFailContBox {
	padding: 20px 40px;
	border-radius: 5px;
	background: #fff;
	box-shadow: 0 2px 3px #C8D0D8;
	width: 500px;
	height: 500px;
	display: flex;
	flex-direction: column;
    align-items: center;
    justify-content: center;
	}
.pmtFailIcon {
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
	}
.pmtFailContBox h2, h3 {
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 30px;
	line-height: 32px;
	color: #f01b1b;
	font-weight: 600;
	text-align: center;
	margin-bottom: 0;
	}
.pmtFailContBox p {
	margin-top: 20px;
	border-top: 1px solid #e7e7e7;
	padding-top: 20px;
	font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	}
.pmtFailDtls {
	margin: 20px 0 40px;
	border-top: 1px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
	padding: 10px 0;
	background: #fff;
	width: 100%;
	font-size: 14px;
	line-height: 24px;
	}
.pmtFailContBox button {
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
.pmtFailContBox button:hover {
	text-decoration:none;
	}
}
</style>
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
<section>
<div class="mBG">
<div class="pmtFailCont">
	<div class="pmtFailContBox">
		<div class="pmtFailIcon">&#x2715;</div>
		<h3>Payment Failed !</h3>
		<p>If amount is debited from your account, it will be refunded automatically in 5-7 working days</p>
		<div class="pmtFailDtls">
			<div class="flexBetween">
				<div class="fontBold">Payment ID</div>
				<div>MOZ58968458752</div>
			</div>
			<div class="flexBetween">
				<div class="fontBold">Time</div>
				<div>Sep 22, 2022 at 7:50 pm</div>
			</div>
		</div>
		<button onclick="#">Retry</button>
	</div>
</div>
</div>
</section>
@endsection