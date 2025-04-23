@extends('layouts.master')

@section('custom_css_code')

<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/contact-us-enquiry.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/ui-datepicker-new-contact-us.css') }}" />
<style type="text/css">
	.checkmarkCont 
	{
		background: white !important;
	}
</style>
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box autoScroll">
					<div class="box-header">
						<!-- query-enquiry page -->
						
							<h3 class="box-title">Add Customer Detail</h3>
						
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						@if (\Session::has('message'))
						<div class="alert alert-success">
							<ul>
								<li>{!! \Session::get('message') !!}</li>
							</ul>
						</div>
						@endif



						<div class="dashboard-outer-table">
						 <form action="#" method="Post" id="enquiry_form" name="enquiry_form">
    {{csrf_field()}}
<div class="alert alert-success" id="success-contaier" style="display:none">
   <p>Thanks You! Your query has been submitted.</p>
</div>

@include('cms.form-contact')


</form>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>




@endsection

@section('custom_js_code')


<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> -->
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

<!-- contact-us-enquiry js -->
<script type="text/javascript" src='{{ asset("/resources/assets/frontend/js/contact-us-enquiry.js") }}'></script>
<script type="text/javascript">
	
	$('#TravelDate').datepicker({
    format: 'dd M yyyy', 
    autoclose: true,
    todayHighlight: true,
    startDate: '0d',
});
</script>
@endsection