@extends('layouts.master')
@section('content')

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
			

          	<form action="{{url('/storeRatePlans')}}" method="post">
          		

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Create Rate Plan</h3>
              </div>
                <div class="col-md-12 form-group">
              	@if(count($errors))
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.
						<br/>
						<ul>
							@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
              	</div>
              <div class="col-md-12 form-group">
                <label class="col-md-3 control-label text-left">Rate Plan Name</label>
                <div class="col-md-8">
                  <select class="form-control" name="ratePlanName">
                    <option value="0">-- Select Rate Plan--</option>
                    <option value="EP" @if(old('ratePlanName') == 'EP') {{ 'selected' }} @endif>EP</option>
                    <option value="CP" @if(old('ratePlanName') == 'CP') {{ 'selected' }} @endif>CP</option>
                    <option value="MAP" @if(old('ratePlanName') == 'MAP') {{ 'selected' }} @endif>MAP</option>
                    <option value="AP" @if(old('ratePlanName') == 'AP') {{ 'selected' }} @endif>AP</option>
                    <option value="APAI" @if(old('ratePlanName') == 'APAI') {{ 'selected' }} @endif>APAI</option>
                    <option value="Half-Board" @if(old('ratePlanName') == 'Half-Board') {{ 'selected' }} @endif>Half Board</option>
                    <option value="Full-Board" @if(old('ratePlanName') == 'Full-Board') {{ 'selected' }} @endif>Full Board</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-3 control-label text-left">Meal Plan</label>
                <div class="col-md-8">
                  <select class="form-control" name="mealPlan">
                    <option value="0">--Select Meal Plan--</option>


                    <option value="Accommodation-Only" @if(old('mealPlan') == 'Accommodation-Only') {{ 'selected' }} @endif>Accommodation-Only</option>
                    <option value="Free-Breakfast" @if(old('mealPlan') == 'Free-Breakfast') {{ 'selected' }} @endif>Free-Breakfast</option>
                    <option value="Free-Breakfast-and-Dinner" @if(old('mealPlan') == 'Free-Breakfast-and-Dinner') {{ 'selected' }} @endif>Free-Breakfast-and-Dinner</option>
                    <option value="Free-Cooked-Breakfast" @if(old('mealPlan') == 'Free-Cooked-Breakfast') {{ 'selected' }} @endif>Free-Cooked-Breakfast</option>

                  </select>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-3 control-label text-left">Payment Mode</label>
                <div class="col-md-8">
                  <select class="form-control" name="paymentMode">
                    <option value="0">--Select Payment Mode--</option>

                    <option value="Pay-Full-Amount" @if(old('paymentMode') == 'Pay-Full-Amount') {{ 'selected' }} @endif>Pay Full Amount</option>
                    <option value="Pay@Hotel" @if(old('paymentMode') == 'Pay@Hotel') {{ 'selected' }} @endif>Pay@Hotel</option>
                    <option value="Pay-Partial-Amount+Pay@Hotel" @if(old('paymentMode') == 'Pay-Partial-Amount+Pay@Hotel') {{ 'selected' }} @endif>
	                    Pay Partial Amount + Pay@Hotel
	                </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-3 control-label text-left">Tax Included</label>
                <div class="col-md-8">
                  <select class="form-control" name="taxInclude">
                    <option value="0">--Select One--</option>

                    <option value="Yes" @if(old('taxInclude') == 'Yes') {{ 'selected' }} @endif>Yes</option>
                    <option value="No" @if(old('taxInclude') == 'No') {{ 'selected' }} @endif>No</option>

                  </select>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <label class="col-md-3 control-label text-left">Payment Type</label>
                <div class="col-md-8">
                  <select class="form-control" name="paymentType">
                    <option value="0">--Select Payment Type--</option>

                    <option value="Refudnable" @if(old('paymentType') == 'Refudnable') {{ 'selected' }} @endif>Refudnable</option>
                    <option value="Non-Refundable" @if(old('paymentType') == 'Non-Refundable') {{ 'selected' }} @endif>Non-Refundable</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="panel-footer">
                 	<input type="submit" class="btn btn-primary submitfrm" id="add">
              </div>
            </div>
        </form>
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection