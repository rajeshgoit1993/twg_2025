@extends('layouts.master')

@section('content')

<style>
.url-item-container {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  border: 1px solid #e9e9e9;
  border-radius: 10px;
  padding: 30px;
  margin-bottom: 20px;
  display: block;
  margin-top: 10px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!--Short URL-->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Add Short URL</h3>
						<h3>Enter URL to create short URL</h3>
					</div>
					<div class="box-body">
						<!-- Back Button -->
						<a href="{{ URL::route('short_urls') }}" class="btn btn-success">
							<i class="glyphicon glyphicon-arrow-left"></i> Back to Short URLs List
						</a>
						<div class="url-item-container">
							<form action="{{ URL::to('/update_short_url/' . $data->id) }}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="type"/>
								{{csrf_field()}}
								<div class="row">

									<!-- domain -->
									<div class="col-md-3">
										<div class="form-group">
											<label for="service_type" class="control-label">Domain</label>
											<select class="form-control" name="url_domain" required>
												<option value="" selected disabled>Select</option>
												<option value="theworldgateway" @if($data->url_domain=='theworldgateway') selected @endif>The World Gateway</option>
												<option value="rapidextravels" @if($data->url_domain=='rapidextravels') selected @endif>Rapidex Travels</option>
											</select>
										</div>
									</div>

									<!--Title-->
									<div class="col-md-3">
										<div class="form-group">
											<label for="url_title" class="control-label">Title</label>
											<input type="text" class="form-control" name="url_title" value="{{ $data->url_title }}" placeholder="Enter Title" />
											<span class="inputError" id="name_error"></span>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--App-->
									<div class="col-md-3">
										<div class="form-group">
											<label for="name" class="control-label">App Name</label>
											<select class="form-control" name="url_app" required>
												<option value="" selected disabled >Select</option>
												<option value="all" @if($data->url_app=='all') selected @endif>All</option>
												<option value="google" @if($data->url_app=='google') selected @endif>Google</option>
												<option value="facebook" @if($data->url_app=='facebook') selected @endif>Facebook</option>
												<option value="twitter" @if($data->url_app=='twitter') selected @endif>Twitter</option>
												<option value="instagram" @if($data->url_app=='instagram') selected @endif>Instagram</option>
												<option value="whatsapp" @if($data->url_app=='whatsapp') selected @endif>WhatsApp</option>
												<option value="telegram" @if($data->url_app=='telegram') selected @endif>Telegram</option>
											</select>
										</div>
									</div>

									<!--Device-->
									<div class="col-md-3">
										<div class="form-group">
											<label for="email" class="control-label">Device</label>
											<select class="form-control" name="url_device">
												<option value="" selected disabled>Select</option>
												<option value="all" @if($data->url_device=='all') selected @endif >All</option>
												<option value="tab" @if($data->url_device=='tab') selected @endif>Tab</option>
												<option value="mobile" @if($data->url_device=='mobile') selected @endif>Mobile</option>
												<option value="desktop" @if($data->url_device=='desktop') selected @endif>Desktop</option>
											</select>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--Long URL-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="name" class="control-label">Long URL</label>
											<input type="text" class="form-control" name="long_url" value="{{ $data->long_url }}" placeholder="Enter long URL" required />
											<span class="error">{{ $errors->first("long_url")}}</span>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!--Tags-->
									<div class="col-md-6">
										<div class="form-group">
											<label for="name" class="control-label">Tags</label>
											<input type="text" class="form-control" name="url_tags" value="{{ $data->url_tags }}" placeholder="Enter Tags" />
										</div>
									</div>

									<div class="col-md-12"></div>

									<!-- submit -->
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" name="submit" id="" class="btn btn-primary">Update <i class="fa fa-arrow-right"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection