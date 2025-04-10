@extends('layouts.master') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
	.table-striped td {text-align: left; width: 12.5%;}
	    .panel-heading { padding: 0px 0px; }
	    .nav-tabs > li > a {color: #fff;}
	    .input-group {
	        position: relative;
	        display: table;
	        border-collapse: separate;
	        width: 100%;
	    }
	    .nav-tabs {
	        border-bottom: 0px;
	    }
        ..datepicker {z-index:9999 !important;}
</style>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Create Room Rates Plan</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
							@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						{{--  <div class="row">
							<div class="col-md-4">
								<label>Select Hotel</label>
								<select name="hotelId" class="form-control" id="hotelId">
                                    <option value="0">-- Select Hotel --</option>
                                    @foreach($hotels as $key=>$hotel) 
									<option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                    @endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label>Select Room</label>
								<select name="roomId" class="form-control" id="list">
									<option value="">-- Select Room --</option>
								</select>
							</div>
                            <div class="col-md-4">
								<label>Select Currency</label>
								<select name="currency" class="form-control" id="currency">
									<option value="rupees" currName="&#8377;">&#8377;</option>
                                    <option value="dollar" currName="$">$</option>
								</select>
							</div>
						</div>  --}}
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel with-nav-tabs panel-primary">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1primary" data-toggle="tab">Add Regular Price </a>
							</li>
							{{--  <li class=""><a href="#tab2primary" data-toggle="tab">Add Special Prices</a>
							</li>
                            <li class=""><a href="#tab3primary" data-toggle="tab">List Special Prices</a>
							</li>  --}}
						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tab1primary">
							<form action="{{url('/saveRegularRoomRates')}}" method="post">
								{{csrf_field()}}
								<input type="hidden" name="SeleTedHotelID" class="SeleTedHotelID" value="">
								<input type="hidden" name="SeleTedRoomID" class="SeleTedRoomID" value="">
								<input type="hidden" name="SeleTedCurrency" class="SeleTedCurrency" value="rupees">
								<input type="hidden" name="priceType" class="priceType" value="regular">
		
								<div class="row">
									<div class="col-md-4">
										<label>Select Hotel</label>
										<select name="hotelId" class="form-control" id="hotelId">
											<option value="0">-- Select Hotel --</option>
											@foreach($hotels as $key=>$hotel) 
											<option value="{{$hotel->id}}">{{$hotel->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-4">
										<label>Select Room</label>
										<select name="roomId" class="form-control" id="list">
											<option value="">-- Select Room --</option>
										</select>
									</div>
									<div class="col-md-4">
										<label>Select Currency</label>
										<select name="currency" class="form-control" id="currency">
											<option value="rupees" currName="&#8377;">&#8377;</option>
											<option value="dollar" currName="$">$</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<label>Title</label>
										<input type="text" name="plan_name" class="form-control" value="Regular" readonly>
									</div>
									<div class="col-md-6">
										<label>Commission Offered</label>
										<input type="text" name="commissionOffered" class="form-control" placeholder="%">
									</div>
								</div>
								<hr>
								<table class="table table-striped table-condensed">
									<thead>
										<tr>
											<th>CAPACITY</th>
											<th>Sun</th>
											<th>Mon</th>
											<th>Tue</th>
											<th>Wed</th>
											<th>Thu</th>
											<th>Fri</th>
											<th>Sat</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td><b>Single</b>
												</td>
												<td>
													<input class="form-control" type="text" name="single[Sun]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Mon]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Tue]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Wed]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Thu]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Fri]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="single[Sat]" placeholder="">
												</td>
											</tr>
											<tr>
												<td><b>Double</b>
												</td>
												<td>
													<input class="form-control" type="text" name="double[Sun]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Mon]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Tue]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Wed]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Thu]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Fri]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="double[Sat]" placeholder="">
												</td>
											</tr>
											<tr>
												<td><b>Triple</b>
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Sun]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Mon]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Tue]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Wed]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Thu]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Fri]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="triple[Sat]" placeholder="">
												</td>
											</tr>
											<tr>
												<td><b>Extra Child</b>
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Sun]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Mon]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Tue]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Wed]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Thu]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Fri]" placeholder="">
												</td>
												<td>
													<input class="form-control" type="text" name="extraChild[Sat]" placeholder="">
												</td>
											</tr>
										</tbody>
								</table>
								<button class="btn btn-primary" id="">Save Regular Price</button>
							</form>
							</div>
							<div class="tab-pane fade" id="tab2primary">
                                <form action="{{url('/saveSpecialRoomRates')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="SeleTedHotelID" class="SeleTedHotelID" value="">
								<input type="hidden" name="SeleTedRoomID" class="SeleTedRoomID" value="">
								<input type="hidden" name="SeleTedCurrency" class="SeleTedCurrency" value="rupees">
								<input type="hidden" name="priceType" class="priceType" value="special">


								<div class="row">
									<div class="col-md-3">
										<label>Title</label>
										<input type="text" name="plan_name" class="form-control">
									</div>
									<div class="col-md-3">
										<label>Date From</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date">
													<input name="dateFrom" class="form-control datepicker" type="text" value="12-02-2017">
												</div>
											</div>
									</div>
									<div class="col-md-3">
										<label>Date To</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date">
													<input name="dateTo" class="form-control datepicker" type="text" value="12-02-2017">
												</div>
											</div>
									</div>
									<div class="col-md-3">
										<label>Commission Offered</label>
										<input type="text" name="commissionOffered" class="form-control" placeholder="%">
									</div>
								</div>
								<hr>
								<table class="table table-striped table-condensed">
									<thead>
										<tr>
											<th>CAPACITY</th>
											<th>Sun</th>
											<th>Mon</th>
											<th>Tue</th>
											<th>Wed</th>
											<th>Thu</th>
											<th>Fri</th>
											<th>Sat</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>Single</b>
											</td>
											<td>
												<input class="form-control" type="text" name="single[Sun]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Mon]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Tue]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Wed]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Thu]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Fri]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="single[Sat]" placeholder="">
											</td>
										</tr>
										<tr>
											<td><b>Double</b>
											</td>
											<td>
												<input class="form-control" type="text" name="double[Sun]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Mon]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Tue]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Wed]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Thu]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Fri]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="double[Sat]" placeholder="">
											</td>
										</tr>
										<tr>
											<td><b>Triple</b>
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Sun]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Mon]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Tue]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Wed]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Thu]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Fri]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="triple[Sat]" placeholder="">
											</td>
										</tr>
										<tr>
											<td><b>Extra Child</b>
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Sun]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Mon]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Tue]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Wed]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Thu]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Fri]" placeholder="">
											</td>
											<td>
												<input class="form-control" type="text" name="extraChild[Sat]" placeholder="">
											</td>
										</tr>
									</tbody>
								</table>
                                <button class="btn btn-primary" id="">Save Special Price</button>
                            </form>
							</div>
                            <div class="tab-pane fade" id="tab3primary">
								

								<table id="" class="table table-bordered table-striped example1">
									<thead>
										<tr>
											<th>#</th>
											<th>Date From</th>
											<th>Date To</th>
											<th>Title</th>
											<th>Mon</th>
											<th>Tue</th>
											<th>Wed</th>
											<th>Thu</th>
											<th>Fri</th>
											<th>Sat</th>
											<th>Sun</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>26/12/2017</td>
											<td>28/12/2017</td>
											<td>Weekend Plan</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td>1500.00</td>
											<td> <a class="btn btn-primary" href="#"><i class="fa fa-edit"></i></a>
												<a class="btn btn-danger" href="#"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection