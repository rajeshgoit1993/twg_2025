@extends('layouts.master')
@section('content')
<div class="content-wrapper">
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Currency Conversion</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Currency Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
				@if(Sentinel::check())
				@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
				<div class="add">
					<a href="{{URL::to('/add-currency')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Currency</a>
				</div>
				@endif
				@endif
				<thead>
					<tr>
						<th>#</th>
						<th>Currency Type</th>
						<th>Rates</th>
						<th>Updated At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				@forelse($data as $single)
				<tr>
					<td>{{ $single->id }}</td>
					<td>{{ $single->currency }}</td>
					<td>{{ $single->rate }}</td>
					<td>{{ $single->updated_at }}</td>
					<td>
						<form action="{{URL::to('/delete-currency/'.$single->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
							<span class="btn-group">
							{{csrf_field()}}
							<input type="hidden" name="id" value=""/>
							@if(Sentinel::check())
							@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
							<a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/editcurrency/'.$single->id) }}"><i class="fa fa-edit"> Edit</i></a>
							@endif
							@endif
							@if(Sentinel::check())
							@if(Sentinel::getUser()->inRole('administrator')  || Sentinel::getUser()->inRole('super_admin'))
							<button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
							@endif
							@endif
							</span>
						</form>
					</td>
				</tr>
				@empty
				<tr>
					<th colspan="6" class="text-center text-danger">Currency Conversion list not found</th>
				</tr>
				@endforelse
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--Transport Managed-->
@if(Sentinel::check())
@if(Sentinel::getUser()->inRole('super_admin'))
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
			<h3 class="box-title">Transport List</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Transport Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
					<div class="add">
						<a href="{{URL::to('/add-transport')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Transport</a>
					</div>
					<thead>
						<tr>
							<th>ID</th>
							<th>Transport</th>
							<th>Updated At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse($data_transport as $single1)
						<tr>
							<td>{{ $single1->id }}</td>
							<td>{{ $single1->name }}</td>
							<td>{{ $single1->updated_at }}</td>
							<td>
								<form action="{{URL::to('/delete-transport/'.$single1->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
								<span class="btn-group">
								{{csrf_field()}}
								<input type="hidden" name="id" value=""/>
								<a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/edittransport/'.$single1->id) }}">
								<i class="fa fa-edit"> Edit</i>
								</a>
								<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i> Delete</button>
								</span>
								</form>
							</td>
						</tr>
						@empty
						<tr>
							<th colspan="6" class="text-center text-danger">Transport list not found</th>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endif
@endif
<!--transport management end-->
<!--icon management start-->
@if(Sentinel::check())
@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Icon List</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
					<p>Icon Deleted Successfully</p>
				</div>
				<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
					<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
				</div>
				<table id="example1" class="table table-bordered table-striped">
					<div class="add">
						<a href="{{URL::to('/add-icon')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Icon</a>
					</div>
					<thead>
						<tr>
							<th>ID</th>
							<th>Icon</th>
							<th>Icon Title</th>
							<th>Updated At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse($data_icons as $single1)
						<tr>
							<td>{{ $single1->id }}</td>
							<td>
								@if($single1->icon=="")
								@php  $image="noimage.jpg";  @endphp
								@else
								@php  $image=$single1->icon;  @endphp
								@endif
								<img width="35" height="35" src="{{URL::to('/').'/public/uploads/icons/'.$single1->icon}}">
							</td>
							<td>{{ $single1->icon_title }}</td>
							<td>{{ $single1->updated_at }}</td>
							<td>
								<form action="{{URL::to('/delete-icon/'.$single1->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
									<span class="btn-group">
										{{csrf_field()}}
										<input type="hidden" name="id" value=""/>
										<a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/editicon/'.$single1->id) }}"><i class="fa fa-edit"> Edit</i></a>
										<button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i> Delete</button>
									</span>
								</form>
							</td>
						</tr>
						@empty
						<tr>
							<th colspan="6" class="text-center text-danger">Icons List no found</th>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endif
@endif
<!--icon management end-->
<!--Tour Taxes start-->
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tour Taxes (GST & TCS & PG)</h3>
            </div>
            <div class="box-body">
              <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                <p>Tour Taxes Deleted Successfully</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="{{URL::to('/addtourtaxes')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Tax</a>
                </div>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Charge Type</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Valid From Latest</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($data_quote_taxes as $single1)
                  <?php 
$data_history=DB::table('quote_charges_dynamic_data')->where('quote_charges_id',$single1->id)->orderBy('valid_from_date_tmestamp','DESC')->first();

?>
                  <tr>
                    <td>{{ $single1->id }}</td>
                    <td>{{ $single1->charges_type }}</td>
                    <td>{{ $single1->name }}</td>
                    <td>
                @if($data_history!='')
{{$data_history->value}}
@else
{{ $single1->value }}
@endif</td>
                    <td>

@if($data_history!='')
{{date('d-m-Y', strtotime($data_history->valid_from_date))}}
@else
Valid From Blank
@endif

                    </td>
                     <td>@if($single1->status=='1')
						 <button class="btn btn-sm btn-info enable">Enable</button>
					 @else
						 <button class="btn btn-sm btn-danger disable">Disable</button>
					 @endif
                     </td>
                    <td>
                      <form action="{{URL::to('/delete-tourtaxes/'.$single1->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                        <span class="btn-group">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="" />
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/edittourtaxes/'.$single1->id) }}">
                            <i class="fa fa-edit"> Edit</i>
                          </a>
                            <a class="btn btn-default btn-xcrud btn btn-primary" href="{{ URL::to('/addvalidfrom/'.$single1->id) }}">
                            <i class="fa fa-edit"> Add/Edit Valid From</i>
                          </a>

                          <button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
                        </span>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <th colspan="6" class="text-center text-danger"> Transport No Found</th>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--Tour Taxes end-->

      <!--Tour Taxes start-->
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tour Discounts</h3>
            </div>
            <div class="box-body">
              <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                <p>Tour Discounts Deleted Successfully</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="{{URL::to('/addtourdiscounts')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Discounts</a>
                </div>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Discount Type</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($data_quote_discounts as $single1)
                  <tr>
                    <td>{{ $single1->id }}</td>
                    <td>{{ $single1->charges_type }}</td>
                    <td>{{ $single1->name }}</td>
                    <td>{{ $single1->value }}</td>
                     <td>@if($single1->status=='1')
						 <button class="btn btn-sm btn-info enable">Enable</button>
					 @else
						 <button class="btn btn-sm btn-danger disable">Disable</button>
					 @endif
                     </td>
                    <td>
                      <form action="{{URL::to('/delete-tourdiscounts/'.$single1->id)}}" onsubmit="return confirm('Are you sure, you want to delete this?');" method="POST">
                        <span class="btn-group">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="" />
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/edittourdiscounts/'.$single1->id) }}">
                            <i class="fa fa-edit"> Edit</i>
                          </a>
                          <button type="submit" class="btn btn-danger deletePackage"><i class="fa fa-times"></i> Delete</button>
                        </span>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <th colspan="6" class="text-center text-danger"> Transport No Found</th>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--Tour Taxes end-->

</section>
</div>
@endsection