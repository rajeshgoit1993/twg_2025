@extends('layouts.master')
@section('content')
<style>
.error{color: red}
.textCapital {
	text-transform: capitalize;
	}
.enqryTtlCont {
	display: flex;
	flex-direction: column;
	align-items: center;
	margin-bottom: 30px;
	}
.enqryTtlCont h2 {
	font-size: 24px;
	line-height: 26px;
	color: #000001;
	font-weight: 600;
	text-align: center;
	margin-bottom: 10px;
	text-transform: capitalize;
	}
.enqryTtlCont h3 {
	font-size: 16px;
	line-height: 18px;
	color: #4a4a4a;
	font-weight: 500;
	text-align: center;
	margin-bottom: 0;
	text-transform: none;
	}
.guestInputCont {
	margin-bottom: 20px;
	}
.guestInputCont label {
    display: block;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    color: #000001 !important;
    margin-right: 0px !important;
    margin-bottom: 5px;
	}
.guestInputCont input[type=text] {
    padding: 6px 12px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    cursor: text;
    height: 36px;
    background: #fff;
    text-transform: none;
    width: 100%;
    outline: 0;
	}
.guestInputCont select, .guestInputCont input[type=date] {
    padding: 6px 10px;
    font-size: 14px;
    line-height: 16px;
    color: #4a4a4a;
    font-weight: 500;
    border: 1px solid #c8c8c8;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    webkit-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    -ms-transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    cursor: default;
    height: 36px;
    background: #fff;
    text-transform: capitalize;
    width: 100%;
    outline: 0;
	}
.guestInputCont input[type=text]:focus, .formTextarea:focus, .guestInputCont select:focus, .guestInputCont input[type=date]:focus {
	border-color: #4a4a4a;
	box-shadow: none;
	}
.noPadding {
	padding: 0 !important;
	}
	
/*Flex Row*/
.flex-row {
   display: flex;
   flex-direction: row;
   }
.flex-col {
	padding: 15px;
	margin: 0 15px;
	background: #ddd;
	}
.flex-row-multicolum {
	display: flex;
	flex-flow: row wrap;
	}
.flex-col-md-12, .flex-col-md-11, .flex-col-md-10, .flex-col-md-9, .flex-col-md-8, .flex-col-md-7, .flex-col-md-6, .flex-col-md-5, .flex-col-md-4, .flex-col-md-3, .flex-col-md-2, .flex-col-md-1 {
	margin: 0 auto;
	/*margin: 0 15px 15px;*/
	width: 100%;
	}
@media (min-width: 992px) {
.flex-col-md-12, .flex-col-md-11, .flex-col-md-10, .flex-col-md-9, .flex-col-md-8, .flex-col-md-7, .flex-col-md-6, .flex-col-md-5, .flex-col-md-4, .flex-col-md-3, .flex-col-md-2, .flex-col-md-1 {
	/*margin: 0 15px 15px;*/
	padding-left: 15px;
	padding-right: 15px;
	}
}
@media (min-width: 992px) {
.flex-col-md-12 {
	width: 100%;
	}
  .flex-col-md-11 {
    width: 91.66666667%;
  }
  .flex-col-md-10 {
    width: 83.33333333%;
  }
  .flex-col-md-9 {
    width: 75%;
  }
  .flex-col-md-8 {
    width: 66.66666667%;
  }
  .flex-col-md-7 {
    width: 58.33333333%;
  }
  .flex-col-md-6 {
    width: 50%;
  }
  .flex-col-md-5 {
    width: 41.66666667%;
  }
  .flex-col-md-4 {
    width: 33.33333333%;
  }
  .flex-col-md-3 {
    width: 25%;
  }
  .flex-col-md-2 {
    width: 16.66666667%;
  }
  .flex-col-md-1 {
    width: 8.33333333%;
  }
}
</style>
<style>
@media (max-width: 992px) {
	.breadCrumpsCont {
		display: none;
		}
	.quickEnqCon {
		margin-top: 20px;
		margin-bottom: 0;
	}
}
@media (min-width: 992px) {
.breadCrumpsCont {
	background: #f2f2f2;
	}
.pageContainer {
	width: 1200px;
	margin: 0 auto;
	}
.breadCrumpsCont ul li {
	display: inline-block;
    padding: 15px 0px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 500;
	}
.breadCrumpsCont ul li a:hover {
	color: #008cff;
	}
.breadCrumpsCont ul .active {
	color: #008cff;
	font-size: 16px;
	line-height: 16px;
	text-transform: none;
	}
.centerBlock {
	display: block;
    margin-right: auto;
    margin-left: auto;
	}
.noPadding {
	padding: 0 !important;
	}
.noFloat {
    float: none !important;
	}
.dEnqFormCont {
	border: 1px solid #ccc;
	border-radius: 10px;
	padding: 20px 20px;
	}
.quickEnqCon {
	margin-top: 20px;
	margin-bottom: 25px;
	}
}
</style>

<div class="content-wrapper">
<!--Short URL-->
<section class="content mWhiteBG">
	<div class="pageContainer">
		<div class="quickEnqCon">
			<div class="flex-col-md-9 noFloat dEnqFormCont">
				<a href="{{URL::route('short_urls')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
			<div class="enqryTtlCont">
				<h2>Add Short URL</h2>
				<h3>Enter URL to create short URL</h3>
			</div>
			<form action="{{ URL::to('/store_short_urls') }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="type" value="Private Tour"/>
				{{csrf_field()}}
				<div class="flex-row-multicolum appendTop10">
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="service_type">Domain</label>
							<select name="url_domain" required>
								<option value="" selected disabled>Select Domain</option>
								<option value="theworldgateway">The World Gateway</option>
								<option value="rapidextravels">Rapidex Travels</option>
							</select>
						</div>
					</div>

					<!--Title-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="url_title">Title</label>
							<input type="text" name="url_title" placeholder="Enter Title" />
							<span class="inputError" id="name_error"></span>
						</div>
					</div>

					<!--App-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="name">App Name</label>
							<select name="url_app" required>
								<option value="" selected disabled >Select App</option>
								<option value="all">All</option>
								<option value="google">Google</option>
								<option value="facebook">Facebook</option>
								<option value="twitter">Twitter</option>
								<option value="instagram">Instagram</option>
								<option value="whatsapp">WhatsApp</option>
								<option value="telegram">Telegram</option>
							</select>
						</div>
					</div>

					<!--Device-->
					<div class="flex-col-md-6">
						<div class="guestInputCont">
							<label for="email">Device</label>
							<select name="url_device">
								<option value="all" selected>All</option>
								<option value="tab">Tab</option>
								<option value="mobile">Mobile</option>
								<option value="desktop">Desktop</option>
							</select>
						</div>
					</div>

					<!--Long URL-->
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="name">Long URL</label>
							<input type="text" name="long_url" placeholder="Enter long URL" required />
							<span class="error">{{ $errors->first("long_url")}}</span>
						</div>
					</div>

					<!--Tags-->
					<div class="flex-col-md-12">
						<div class="guestInputCont">
							<label for="name">Tags</label>
							<input type="text" name="url_tags" placeholder="Enter Tags" />
						</div>
					</div>

					<!-- submit -->
					<div class="flex-col-md-12">
						<div class="btnCont">
							<button type="submit" name="submit" id="" class="btn btn-sm btn-danger">Create</button>
						</div>
					</div>
				</div>
			</form>
			</div>
			<div class="flex-col-md-3"></div>
		</div>
	</div>
</section>

<!--<section class="content">
	<div class="row">
		<div class="col-md-12">
			<a href="{{URL::route('short_urls')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Add Short URLs</h3>
				</div>
				<div class="box-body">
					<form action="{{URL::to('/store_short_urls')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="type" value="Private Tour"/>
					{{csrf_field()}}
					<br>
						<div class="">
							<div class="guestInputCont">
								<label for="long_url" class="control-label col-sm-2">Enter Long URL:</label>
								<div class="col-sm-6 noPadding">
									<input type="text" name="long_url" class="form-control" placeholder="Enter Long URL">
								</div>
								<span class="error">{{ $errors->first("long_url")}}</span>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-6">
								<button type="submit" name="add" id="remove" class="btn btn-danger btn-lg">Save<i class="fa  fa-arrow-right"></i></button>
							</div>
							<div class="col-sm-5"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>-->
</div>
@endsection