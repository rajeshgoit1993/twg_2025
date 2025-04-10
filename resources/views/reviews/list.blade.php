@extends('layouts.master')
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
              <h3 class="box-title">Package Reviews & Ratings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                 <p>Package Deleted Successfully.</p>
              </div>
              @if(Session::has('success'))
              <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
              </div>
              @endif
              <table id="example1" class="table table-bordered table-striped example1">
                <div class="add">
                  <a href="{{URL::to('/testimonials-create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                </div>
                <thead>
                <tr>
                  <th><input class="checkboxcls" value="3" type="checkbox"></th>
                  <!-- <th>#</th> -->
                  <th>Package Name</th>
                  <th>User Name</th>
                  <th>User Rating</th>
                  <th>User Exp.</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($reviews as $key=>$rev) 
                <tr>
                  <td><input class="checkboxcls" value="3" type="checkbox"></td>
                  <td>{{CustomHelpers::get_package_name($rev->package_id)}}</td>
                  <td>{{CustomHelpers::get_user_name($rev->user_id)}}</td>
                  <td>{{$rev->user_rating}}</td>
                  <td>{{$rev->user_exp}}</td>
                 
                  <td>
                    @if ($rev->status == 1)
                        <label class="label label-success">Enable</label>
                    @else  
                        <label class="label label-danger">Disable</label>
                    @endif
                  </td>
                  <td>
                  <form action="{{URL::to('/testimonials-delete')}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                    <span class="btn-group">
                    {{csrf_field()}}
                      <input type="hidden" name="id" value="{{$rev->id}}"/>
                        <a class="btn btn-default btn-xcrud btn btn-warning" href="{{ URL::to('/testimonials-edit/'.$rev->id) }}">
                        <i class="fa fa-edit"></i>
                      </a>
                      <button type="submit" class="btn btn-danger deletePackage" ><i class="fa fa-times"></i></button>
                    </span>
                    </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection