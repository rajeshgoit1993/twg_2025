@extends('layouts.master')

@section("custom_css_code")

<style>
.payment-mode-container {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  border: 1px solid #e9e9e9;
  border-radius: 10px;
  padding: 30px;
  margin-bottom: 20px;
  display: block;
  margin-top: 10px;
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
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Add Payment Mode</h3>
                        </div>
                    </div>
                    <!-- /.box-header -->
                   
                    <div class="box-body">
                    	<a href="{{ route('payment_mode') }}" class="btn btn-success">
                    		<i class="glyphicon glyphicon-arrow-left"> </i> Back
                    	</a>
                    	<div class="payment-mode-container">
                    		<form action="{{URL::to('/store_payment_mode')}}" method="POST" enctype="multipart/form-data">
                    			{{ csrf_field() }}
                    			<div class="row">
                    				<div class="col-md-3">
                    					<div class="form-group">
                    						<label for="mode" class="field-required">Payment Mode Name</label>
                    						<input type="text" class="form-control textCapitalize" id="mode" name="mode" value="" placeholder="Payment Mode Name" required>
                    					</div>
                    				</div>

                    				<div class="col-md-3">
                    					<div class="form-group">
                    						<label for="gateway_id" class="field-required">Gateway Name</label>
                    						<select class="form-control text-capitalize" id="gateway_id" name="gateway_id" required>
                    							<option value="" selected disabled>Select Gateway</option>
                    							@foreach($data as $datas)
                    								<option value="{{$datas->id}}">{{$datas->gateway_name}}</option>
                    							@endforeach
		                                    </select>
		                                </div>
		                            </div>

		                            <div class="col-md-12"></div>

		                            <div class="col-md-3">
		                            	<div class="form-group">
		                            		<label for="mdr" class="field-required">Merchant Discount Rate (MDR)</label>
		                            		<!-- <input type="number" min="0" class="form-control" id="mdr" name="mdr" placeholder="MDR" required value=""> -->
		                            		<select class="form-control" id="mdr" name="mdr" required>
		                            			<option value="" selected disabled>Select MDR</option>
		                            			@for ($i = 1; $i <= 10; $i++)
		                            				<option value="{{ $i }}">{{ $i }} %</option>
		                            			@endfor
		                            		</select>
		                            	</div>
		                            </div>

		                            <div class="col-md-3">
		                            	<div class="form-group">
		                            		<label for="gst_on_mdr" class="field-required">GST on Merchant Discount Rate (MDR)</label>
		                            		<!-- <input type="number" min="0" class="form-control" id="gst_on_mdr" name="gst_on_mdr" placeholder="GST on MDR" required value=""> -->
		                            		<select class="form-control" id="gst_on_mdr" name="gst_on_mdr" required disabled>
		                            			<option value="" selected disabled>Select</option>
		                            			@for ($i = 18; $i <= 18; $i++)
		                            				<option value="{{ $i }}">{{ $i }} %</option>
		                            			@endfor
		                            		</select>
		                            	</div>
		                            </div>

		                            <div class="col-md-12"></div>

		                            <div class="col-md-3">
		                            	<div class="form-group">
		                            		<label for="status" class="field-required">Status</label>
		                            		<select class="form-control" id="status" name="status" required>
		                            			<option value="1">Enable</option>
		                            			<option value="0">Disable</option>
		                            		</select>
		                            	</div>
		                            </div>

		                            <div class="col-md-12"></div>

		                        </div>

		                        <div class="">
		                        	<button type="submit" name="submit" id="form_submit" class="btn btn-danger location_add">Update</button>
		                        </div>
		                    </form>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
	const mdrSelect = document.getElementById("mdr");
	const gstOnMdrSelect = document.getElementById("gst_on_mdr");

	// Enable GST on MDR if MDR already has a value on load
	gstOnMdrSelect.disabled = !mdrSelect.value;

	mdrSelect.addEventListener("change", function() {
		gstOnMdrSelect.disabled = !mdrSelect.value;
		if (!mdrSelect.value) {
			gstOnMdrSelect.value = ""; // Reset GST on MDR selection if MDR is cleared
		}
	});
});
</script>
@endsection