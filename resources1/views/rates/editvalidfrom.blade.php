@extends('layouts.master')
@section('content')
<style>
.error{color: red}
</style>
<div class="content-wrapper">
<section class="content">
<div class="row">
	<div class="col-md-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Edit Valid From (  {{$main_data->charges_type}}, {{$main_data->name}})</h3>
		</div>
		<div class="box-body">
			<form action="{{URL::to('/update-valid-from')}}" method="post" >
			<input type="hidden" name="type" value="Private Tour"/>
			<input type="hidden" name="id" value="{{$id}}">
			{{csrf_field()}}
				<br>
				<div class="row">
					<div class="form-group">

						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="name">Valid From Date </label>
								<input required type="text" class="form-control datepicker_s" id="name" placeholder="Select Date" name="valid_from_date"  value="{{date('d/m/Y',strtotime($data_history->valid_from_date))}}">
							</div>
						</div>

					
					
					
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="value">Value</label>
								<input required type="number" min="1" class="form-control" id="value" placeholder="Enter value" name="value" value="{{$data_history->value}}">
							</div>
						</div>
					
						<div class="col-sm-5"></div>
					</div>
					<span class="error">{{ $errors->first("transport")}}</span>
				</div>
				<br>
			
				<div class="row">
					<div class="col-sm-12">
						<button type="submit" name="add" id="remove" class="btn btn-danger btn-lg">Save <i class="fa fa-arrow-right"></i></button>
					</div>
					<div class="col-sm-5"></div>
				</div>
			</form>
		
		</div>
	</div>
	</div>
</div>
</section>
</div>




@endsection

@section('custom_js_code')
<script type="text/javascript">
	$(document).ready(function(){
	$('.datepicker_s').datepicker({
     format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
   
});
})
</script>
@endsection


