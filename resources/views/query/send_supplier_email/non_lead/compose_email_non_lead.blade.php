@extends('layouts.master')

@section("custom_css_code")

<!-- select2 css -->
<link rel="stylesheet" type="text/css" as="style" href="{{ asset('/resources/assets/backend/css/select2-customized.css') }}" />

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
				<div>
					<a href="{{ route('supplierEmailComposedList') }}" class="btn btn-success apndRt10">
						<i class="glyphicon glyphicon-arrow-left"></i> Back
					</a>
					<h3 class="box-title">Compose Email</h3>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			<form action="{{ URL::to('/supplier_email_submit_non_lead') }}" method="post" enctype="multipart/form-data">
			    {{ csrf_field() }}

			    <div class="row">
			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="from_email_name">From<span class="requiredcolor"> *</span></label>
			                <select class="form-control" name="from_email_name">
			                    <option value="The World Gateway">The World Gateway</option>
			                    <option value="Rapidex Travels">Rapidex Travels</option>
			                </select>
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="email_footer">Signature<span class="requiredcolor"> *</span></label>
			                <select class="select2 form-control" name="email_footer">
			                    @foreach($quotation_footer as $pol)
			                        <option value="{{ $pol->id }}">{{ $pol->footer }}</option>
			                    @endforeach
			                </select>
			            </div>
			        </div>

			        <div class="col-md-12"></div>

			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="to">To<span class="requiredcolor"> *</span></label>
			                <input type="text" class="form-control" id="to" name="to" value="" placeholder="To" required>
			                <div id="to_email_list"></div>
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="cc">Cc</label>
			                <input type="text" class="form-control" id="cc" name="cc" value="" placeholder="Cc">
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="bcc">Bcc</label>
			                <input type="text" class="form-control" id="bcc" name="bcc" value="" placeholder="Bcc">
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="subject">Subject<span class="requiredcolor"> *</span></label>
			                <input type="text" class="form-control" id="subject" name="subject" value="" placeholder="Subject" required>
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="attachment">Attach file</label>
			                <input type="file" class="form-control" id="attachment" name="attachment">
			            </div>
			        </div>

			        <div class="col-md-12"></div>

			        <div class="col-md-12">
			            <div class="form-group">
			                <label for="description">Message<span class="requiredcolor"> *</span></label>
			                <textarea class="form-control ckeditor" id="description" name="description"></textarea>
			            </div>
			        </div>

			        <div class="col-md-12">
			            <div class="form-group text-center">
			                <button type="submit" name="submit" class="btn btn-success btn-lg">Send</button>
			            </div>
			        </div>

			    </div>
			</form>
			</div>
			<!-- /.box-body -->
			</div>
		</div>
	</div>
</section>
</div>

<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="test">
</div>

<!-- page script -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

@endsection