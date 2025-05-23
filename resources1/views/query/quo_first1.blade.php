@extends('layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="makeflex aligncenter padding10">
					<a href="{{ URL::to('/quote-pending') }}" class="btn btn-success apndRt20"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<div class="box-header">
						<!-- quo_first page -->
						<h3 class="box-title">Create Quotation</h3>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body" style="padding-top: 0px">
					<div class="panel-body">

						<!--Quote Lead Details Starts-->
						@include('query.enquiryDetails.quoteLeadDetails')
						<!--Quote Lead Details Ends-->

						<br>
						<div class="row">
							<div class="col-md-6">
								<!-- create quote -->
								<a href="{{ URL::to('quo_new/'.$data->id) }}">
									<button type="button" name="add" class="btn btn-success">Create Quotation</button>
								</a>

								<!-- import quote -->
								<a href="{{ URL::to('quo_copy/'.$data->id) }}">
									<button type="button" name="add" class="btn btn-success">Import Quotation</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			<!-- /.box-body -->
			</div>
		</div>
	</div>
<!---->
</section>
<!-- /.content -->
</div>
<div class="testing">
<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection