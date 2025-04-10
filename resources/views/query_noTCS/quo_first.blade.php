@extends('layouts.master')
@section("title", 'Create Quote')
@section('content')
<style type="text/css">
.custom_border .row
{
padding: 5px 0px
}
</style>
<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header">
				<h3 class="box-title">Create Quote</h3>
			</div>
			<div class="box-body">
				<div class="">
					<a href="{{URL::to('/query')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>
				<div class="panel-body">
					<!--Quote Lead Details Starts-->
					@include('query.enquiryDetails.quoteLeadDetails')
					<!--Quote Lead Details Ends-->
					<br>
					<div class="row">
						<div class="col-md-6">
							<a href="{{URL::to('quo_new/'.$data->id)}}">
								<button type="button" name="add" id="" class="btn btn-success">Create Quotation</button>
							</a>
							<a href="{{URL::to('quo_copy/'.$data->id)}}">
								<button type="button" name="add" id="" class="btn btn-success">Import Quotation</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>
</div>
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"></script>
@endsection