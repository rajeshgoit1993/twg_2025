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
			<h3 class="box-title">Add Tour Discounts</h3>
		</div>
		<div class="box-body">
			<form action="{{URL::to('/store-tourdiscounts')}}" method="post" >
			<input type="hidden" name="type" value="Private Tour"/>
			{{csrf_field()}}
				<br>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="charge_type">Charge Type</label>
								<select class="form-control" id="charge_type" required name="charges_type">
									<option selected disabled>Select</option>
									
									<option value="Markup Profit">Markup Profit</option>
									<option value="Discount (+)">Discount (+)</option>
									<option value="Discount (-)">Discount (-)</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="name">Name</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
							</div>
						</div>
						<div class="col-sm-12"></div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="value">Value</label>
								<input required type="number" min="1" class="form-control" id="value" placeholder="Enter value" name="value" value="{{ old('value') }}">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="status">Status</label>
								<select class="form-control" id="status" required name="status">
									<option value="1">Enable</option>
									<option value="0">Disable</option>
								</select>
							</div>
						</div>
						<div class="col-sm-5"></div>
					</div>
					<span class="error">{{ $errors->first("transport")}}</span>
				</div>
				<br>
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