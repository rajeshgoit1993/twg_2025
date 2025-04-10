@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Rate Plan</h3>
              </div>

              
                        <!-- /.box-header -->
                        <div class="box-body">
                          <a href="{{{URL::to('/room-plan-create')}}}" class="btn btn-warning" style="margin-bottom: 15px; " type="button">Add Rate Plan</a>

                          <table class="table table-bordered table-striped" id="example1">
                            <thead>
                              <tr>
                                <th><input class="checkboxcls" type="checkbox" value="3"></th>
                                <th>#</th>
                                <th>Rate Plan Name</th>
                                <th>Meal Plan</th>
                                <th>Payment Mode</th>
                                <th>Tax Included</th>
                                <th>Payment Type</th>
                                <th>&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                              @foreach($RoomPlan as $key=>$Roomplan) 
                              <tr>
                                <td><input class="checkboxcls" type="checkbox" value="3"></td>
                                <td>{{++$key}}</td>
                                <td>{{$Roomplan->RatePlanName}}</td>
                                <td>{{$Roomplan->MealPlan}}</td>
                                <td>{{$Roomplan->PaymentMode}}</td>
                                <td>{{$Roomplan->TaxIncluded}}</td>
                                <td>{{$Roomplan->PaymentType}}</td>
                                <td>
                                  
                                  
                                  <form action="{{url('/deleteRatePlans')}}" method="post" onsubmit="return confirm('Do you really want to delete this.?');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{$Roomplan->id}}">
                                    <a class="btn btn-warning btn-sm" href="{{ URL::to('/rp-edit/'.$Roomplan->id) }}"><i class="fa fa-edit"></i></a> 
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                  </form>
                                  
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                
              <div class="panel-footer">
                <input id="slug" type="hidden" value=""> <input name="submittype" type="hidden" value="add"> <input name="hotelid" type="hidden" value=""> <button class="btn btn-primary submitfrm" id="add">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection