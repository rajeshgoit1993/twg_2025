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
						<h3 class="box-title">Edit Room Rates Plan</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
                    {{--  {{dump($RoomRatesRegularPlan)}}  --}}
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
							<li class="active"><a href="#tab2primary" data-toggle="tab">Edit Special Price</a>
							</li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">

							<div class="tab-pane fade active in" id="tab2primary">
                                <form action="{{url('/updateRatePlan')}}" method="post">
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
										<input type="text" name="plan_name" class="form-control" value="{{$RoomRatesRegularPlan[0]->rate_Name}}">
									</div>
									<div class="col-md-3">
										<label>Date From</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date" id="">
													<input name="dateFrom" class="form-control datepicker" type="text" value="{{date('m/d/Y',strtotime($RoomRatesRegularPlan[0]->stay_Start_Date))}}">
												</div>
											</div>
									</div>
									<div class="col-md-3">
										<label>Date To</label>
											<div class="form-group">
												<!-- Date input -->
												<div class="input-group date" id="">
													<input name="dateTo" class="form-control datepicker" type="text" value="{{date('m/d/Y',strtotime($RoomRatesRegularPlan[0]->stay_End_Date))}}">
												</div>
											</div>
									</div>
									<div class="col-md-3">
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
                                <button class="btn btn-primary" id="">Save Special Price</button>
                            </form>
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