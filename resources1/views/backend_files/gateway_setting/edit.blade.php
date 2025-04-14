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

    <!-- Main content section -->
    <section class="content">

        <!-- Row container -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <!-- Header section with back button and title -->
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Edit Payment Gateway</h3>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <!-- Form content -->
                    <div class="box-body">
                    	<a href="{{ route('gateway_settings') }}" class="btn btn-success">
                    		<i class="glyphicon glyphicon-arrow-left"> </i> Back
                    	</a>

                    	<div class="payment-mode-container">
	                        <form action="{{URL::to('/updategatewaysetting')}}" method="POST" enctype="multipart/form-data" onsubmit="return Filevalidation()">
	                            <input type="hidden" name="id" value="{{$data->id}}">
	                            {{ csrf_field() }}

	                            <!-- Success message container -->
	                            <div class="alert alert-success font-weight600" id="success-contaier" style="display: none">
	                                <p>Thank You! Payment Mode has been updated successfully.</p>
	                            </div>

	                            <!-- Form fields row -->
	                            <div class="row">

	                                <!-- Gateway Name - Read-only field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="gateway_name">Gateway Name <span class="requiredcolor">*</span></label>
	                                        <input type="text" class="form-control textCapitalize" id="gateway_name" name="gateway_name" value="{{$data->gateway_name}}" placeholder="Gateway Name" readonly>
	                                    </div>
	                                </div>

	                                <!-- Environment Mode - Dropdown field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="environment">Environment Mode <span class="requiredcolor">*</span></label>
	                                        <select class="form-control" id="environment" name="environment">
	                                            <option value="" selected disabled>Select</option>
	                                            <option value="1" @if($data->environment==1) selected @endif>Production</option>
	                                            <option value="0" @if($data->environment==0) selected @endif>Development</option>
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="col-md-12"></div>

	                                <!-- Test Merchant Key - Text field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="test_merchant_key">Development Merchant Key <span class="requiredcolor">*</span></label>
	                                        <input type="text" class="form-control" id="test_merchant_key" name="test_merchant_key" placeholder="Test Merchant Key" required value="{{$data->test_merchant_key}}">
	                                    </div>
	                                </div>

	                                <!-- Test Merchant ID - Text field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="test_merchant_mid">Development Merchant ID <span class="requiredcolor">*</span></label>
	                                        <input type="text" class="form-control" id="test_merchant_mid" name="test_merchant_mid" placeholder="Test Merchant ID" required value="{{$data->test_merchant_mid}}">
	                                    </div>
	                                </div>

	                                <div class="col-md-12"></div>

	                                <!-- Live Merchant Key - Text field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="prd_merchant_key">Production Merchant Key <span class="requiredcolor">*</span></label>
	                                        <input type="text" class="form-control" id="prd_merchant_key" name="prd_merchant_key" placeholder="Live Merchant Key" required value="{{$data->prd_merchant_key}}">
	                                    </div>
	                                </div>

	                                <!-- Live Merchant ID - Text field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="prd_merchant_mid">Production Merchant ID <span class="requiredcolor">*</span></label>
	                                        <input type="text" class="form-control" id="prd_merchant_mid" name="prd_merchant_mid" placeholder="Live Merchant ID" required value="{{$data->prd_merchant_mid}}">
	                                    </div>
	                                </div>

	                                <div class="col-md-12"></div>

	                                <!-- Status - Dropdown field -->
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label for="status">Status <span class="requiredcolor">*</span></label>
	                                        <select class="form-control" id="status" name="status">
	                                            <option value="" selected disabled>Select</option>
	                                            <option value="1" @if($data->status==1) selected @endif>Enable</option>
	                                            <option value="0" @if($data->status==0) selected @endif>Disable</option>
	                                        </select>
	                                    </div>
	                                </div>

	                            </div>

	                            <!-- submit -->
	                            @if(Sentinel::check())
	                            @if(Sentinel::getUser()->inRole('super_admin') ||
	                            	Sentinel::getUser()->inRole('administrator'))
	                            <div>
	                            	<button type="submit" name="submit" id="form_submit" class="btn btn-danger location_add">Update</button>
	                            </div>
	                            @endif
	                            @endif
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

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<!-- /.content-wrapper -->
@endsection