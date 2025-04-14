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
			<h3 class="box-title">Add Valid From</h3>
		</div>
		<div class="box-body">
			<form action="{{URL::to('/store-valid-from')}}" method="post" >
			<input type="hidden" name="type" value="Private Tour"/>
			<input type="hidden" name="id" value="{{$id}}">
			{{csrf_field()}}
				<br>
				<div class="row">
					<div class="form-group">

						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="name">Valid From Date</label>
								<input required type="text" class="form-control datepicker_s" id="name" placeholder="Select Date" name="valid_from_date" value="{{ old('valid_from_date') }}">
							</div>
						</div>

					
					
					
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="value">Value</label>
								<input required type="number" min="1" class="form-control" id="value" placeholder="Enter value" name="value" value="{{ old('value') }}">
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
			<!---->
<hr>
<div class="box-header">
			<h3 class="box-title">History</h3>
		</div>

		  <table id="example1" class="table table-bordered table-striped">
              
                <thead>
                  <tr>
                   
                    <th>Valid From</th>
                    <th>Value </th>
                    
                    
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($data_history as $single1)
                  <tr>
                  
                    
                    <td>{{ $single1->valid_from_date }}</td>
                    <td>{{ $single1->value }}</td>
                    <td>
                    	@if(strtotime($single1->valid_from_date)>strtotime(date('Y-m-d')))
                      <form action="{{URL::to('/delete-valid-from/'.$single1->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                        <span class="btn-group">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="" />
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/editvalidfrom/'.$single1->id) }}">
                            <i class="fa fa-edit"> Edit</i>
                          </a>
                          <button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
                        </span>
                      </form>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <th colspan="4" class="text-center text-danger">  No Data Found</th>
                  </tr>
                  @endforelse
                </tbody>
              </table>

			<!---->
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


