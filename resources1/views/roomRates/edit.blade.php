@extends('layouts.master') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
	.table-striped td {text-align: left; width: 12.5%;}
	.panel-heading { padding: 0px 0px; }
	.nav-tabs > li > a {color: #fff;}
	.input-group {position: relative;display: table;border-collapse: separate;width: 100%;}
	.nav-tabs {border-bottom: 0px;}
	.datepicker {z-index:9999 !important;}
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
						<div class="row">
							<div class="col-md-4">
								<label>Hotel Name </label>
								<select name="roomId" class="form-control" id="hotelId" disabled>
                                    <option value="">{{CustomHelpers::getTableRecordById($RoomRatesRegularPlan[0]->hotel_Id,'rt_hotels','name')}}</option>
                                </select>
							</div>
							<div class="col-md-4">
								<label>Room</label>
								<select name="roomId" class="form-control" id="list" disabled>
									<option value="">{{CustomHelpers::getTableRecordById($RoomRatesRegularPlan[0]->room_Id,'rt_rooms','roomTypeName')}}</option>
								</select>
							</div>
                            <div class="col-md-4">
								<label>Currency</label>
								<select name="currency" class="form-control" id="currency" disabled>
                                    <option value="rupees" currName="&#8377;">{{$RoomRatesRegularPlan[0]->currency}}</option>
								</select>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel with-nav-tabs panel-primary">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1primary" data-toggle="tab">Edit Regular Price </a>
							</li>
							<li class=""><a href="#tab2primary" data-toggle="tab">Add Special Price Range</a>
							</li>
                            <li class=""><a href="#tab3primary" data-toggle="tab">All Special Prices</a>
							</li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tab1primary">
							<form action="{{url('/saveRegularRoomRates')}}" method="post">
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-6">
										<label>Title</label>
										<input type="text" name="plan_name" class="form-control" value="Regular" readonly>
										
										
										<input type="hidden" name="SeleTedHotelID" class="SeleTedHotelID" value="{{$RoomRatesRegularPlan[0]->hotel_Id}}">
										<input type="hidden" name="SeleTedRoomID" class="SeleTedRoomID" value="{{$RoomRatesRegularPlan[0]->room_Id}}">
										<input type="hidden" name="SeleTedCurrency" class="SeleTedCurrency" value="rupees">
										<input type="hidden" name="priceType" class="priceType" value="regular">

										<input type="hidden" name="capSingleId" class="" value="{{$RoomRatesRegularPlan[0]->id}}">
										<input type="hidden" name="capDoubleId" class="" value="{{$RoomRatesRegularPlan[1]->id}}">
										<input type="hidden" name="capTripleId" class="" value="{{$RoomRatesRegularPlan[2]->id}}">
										<input type="hidden" name="capExtraChildId" class="" value="{{$RoomRatesRegularPlan[3]->id}}">
									</div>
									<div class="col-md-6">
										<label>Commission Offered</label>
										<input type="text" name="commissionOffered" class="form-control" placeholder="%" value="{{$RoomRatesRegularPlan[0]->commission_Offered}}">
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
                                                    <input class="form-control" type="text" name="single[Sun]" placeholder="" value="{{$RoomRatesRegularPlan[0]->sun}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Mon]" placeholder="" value="{{$RoomRatesRegularPlan[0]->mon}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Tue]" placeholder="" value="{{$RoomRatesRegularPlan[0]->tue}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Wed]" placeholder="" value="{{$RoomRatesRegularPlan[0]->wed}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Thu]" placeholder="" value="{{$RoomRatesRegularPlan[0]->thu}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Fri]" placeholder="" value="{{$RoomRatesRegularPlan[0]->fri}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="single[Sat]" placeholder="" value="{{$RoomRatesRegularPlan[0]->sat}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Double</b>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Sun]" placeholder="" value="{{$RoomRatesRegularPlan[1]->sun}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Mon]" placeholder="" value="{{$RoomRatesRegularPlan[1]->mon}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Tue]" placeholder="" value="{{$RoomRatesRegularPlan[1]->tue}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Wed]" placeholder="" value="{{$RoomRatesRegularPlan[1]->wed}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Thu]" placeholder="" value="{{$RoomRatesRegularPlan[1]->thu}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Fri]" placeholder="" value="{{$RoomRatesRegularPlan[1]->fri}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="double[Sat]" placeholder="" value="{{$RoomRatesRegularPlan[1]->sat}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Triple</b>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Sun]" placeholder="" value="{{$RoomRatesRegularPlan[2]->sun}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Mon]" placeholder="" value="{{$RoomRatesRegularPlan[2]->mon}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Tue]" placeholder="" value="{{$RoomRatesRegularPlan[2]->tue}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Wed]" placeholder="" value="{{$RoomRatesRegularPlan[2]->wed}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Thu]" placeholder="" value="{{$RoomRatesRegularPlan[2]->thu}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Fri]" placeholder="" value="{{$RoomRatesRegularPlan[2]->fri}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="triple[Sat]" placeholder="" value="{{$RoomRatesRegularPlan[2]->sat}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Extra Child</b>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Sun]" placeholder="" value="{{$RoomRatesRegularPlan[3]->sun}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Mon]" placeholder="" value="{{$RoomRatesRegularPlan[3]->mon}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Tue]" placeholder="" value="{{$RoomRatesRegularPlan[3]->tue}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Wed]" placeholder="" value="{{$RoomRatesRegularPlan[3]->wed}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Thu]" placeholder="" value="{{$RoomRatesRegularPlan[3]->thu}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Fri]" placeholder="" value="{{$RoomRatesRegularPlan[3]->fri}}">
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="extraChild[Sat]" placeholder="" value="{{$RoomRatesRegularPlan[3]->sat}}">
                                                </td>
                                            </tr>
                                        </tbody>
								</table>
								<button class="btn btn-primary" id="">Update Regular Price</button>
							</form>
							</div>
							<div class="tab-pane fade" id="tab2primary">
                                <form action="{{url('/saveSpecialRoomRates')}}" method="post">
                                {{csrf_field()}}


								<input type="hidden" name="SeleTedHotelID" class="SeleTedHotelID" value="{{$RoomRatesRegularPlan[0]->hotel_Id}}">
								<input type="hidden" name="SeleTedRoomID" class="SeleTedRoomID" value="{{$RoomRatesRegularPlan[0]->room_Id}}">
								<input type="hidden" name="SeleTedCurrency" class="SeleTedCurrency" value="rupees">
								<input type="hidden" name="priceType" class="priceType" value="special">

								<input type="hidden" name="capSingleId" class="" value="{{$RoomRatesRegularPlan[0]->id}}">
								<input type="hidden" name="capDoubleId" class="" value="{{$RoomRatesRegularPlan[1]->id}}">
								<input type="hidden" name="capTripleId" class="" value="{{$RoomRatesRegularPlan[2]->id}}">
								<input type="hidden" name="capExtraChildId" class="" value="{{$RoomRatesRegularPlan[3]->id}}">


								<div class="row">
									<div class="col-md-3">
										<label>Title</label>
										<input type="text" name="plan_name" class="form-control">
									</div>
									<div class="col-md-3">
										<label>Date From</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date" id="dp1" data-date="" data-date-format="mm-dd-yyyy">
													<input name="dateFrom" class="form-control datepicker" type="text" value="">
												</div>
											</div>
									</div>
									<div class="col-md-3">
										<label>Date To</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date" id="dp2" data-date="" data-date-format="mm-dd-yyyy">
													<input name="dateTo" class="form-control datepicker" type="text" value="">
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
                                <button class="btn btn-primary" id="">Add Special Price</button>
                            </form>
							</div>
                            <div class="tab-pane fade" id="tab3primary">
								

								<table id="" class="table table-bordered table-striped example1">
									<thead>
										<tr>
                                            <th>#</th>
											<th>Plan Title</th>	
											<th>Date From</th>
											<th>Date To</th>										
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($planData as $key=>$plan) 
										<tr>
											<td>{{++$key}}</td>
											<td><b>{{$plan->rate_Name}}</b></td>
											<td>{{date('d-M-Y',strtotime($plan->stay_Start_Date))}}</td>
											<td>{{date('d-M-Y',strtotime($plan->stay_End_Date))}}</td>
											<td>
												<form action="{{url('/deleteRoomRatePlanName')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="rateName" value="{{$plan->rate_Name}}">
													<input type="hidden" name="staystartDate" value="{{$plan->stay_Start_Date}}">
													<input type="hidden" name="stayEndDate" value="{{$plan->stay_End_Date}}">
													<a class="btn btn-warning" href="{{ URL::to('/room-rates-ratename-edit/'.$plan->rate_Name.'/'.$plan->stay_Start_Date.'/'.$plan->stay_End_Date) }}"><i class="fa fa-edit"></i>Edit</a>
													<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
											  	</form>
											</td>
                                        </tr>
                                    @endforeach   
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