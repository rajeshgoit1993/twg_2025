@extends('layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Roles </h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol> --}}
    </section>
    <!-- Main content -->
    <section class="content" id="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box-header">
          <!--   <a href="{{URL::to('/role-create')}}" class="btn btn-success pull-right" style="cursor: not-allowed;">Add New Role</a>  --> 
          <a href="#" class="btn btn-success pull-right" style="cursor: not-allowed;"><i class="glyphicon glyphicon-plus-sign"></i> Add New Role</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              
				<table id="example1" class="table table-bordered table-striped example1">
                <thead>
                  <tr>
                    <th>Role Name</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>


                @foreach($roles as $row)          

                  <tr id="role_{{$row->id}}">
                    <td class="role_name">
                      <span>{{$row->name}}</span>
                    </td>

                    <td class="role_slug">
                      <span>{{$row->slug}}</span>
                    </td>

                    <td class="role_created_date">
                      <span>{{$row->created_at}}</span>
                    </td>
                    
                   <td>
                    <form action="{{URL::to('/deleterole')}}" method="post" id="deleterole{{$row->id}}">
                      {{csrf_field()}} 
                      <input type="hidden" name="id" value="{{$row->id}}"/>
                       <a href="{{URL::to('/role-edit/'.$row->id)}}"  class="edit_role" data-target="#myEditRoleModal">Edit</a> |
                      <a href="#" data-id="{{$row->id}}" class="deleterole">Delete</a>
                    </form>
                    </td>

                  </tr>

                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Role Name</th>
                    <th>Role Slug</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Create Role Modal -->
<div id="myRoleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title">Add New Role</h4>
      	</div>
      	<div class="modal-body">
        @if(Session::has('success'))
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('success')}}
        </div>
        @endif
            <form action="{{URL::to('/role-store')}}" method="post">
            {{csrf_field()}}
        	<div class="panel panel-info" id="success-contaier-parent-new">
        		<div class="panel-body">  
	              	<div class="alert alert-danger" id="error-contaier-parent" style="display:none">
	                  <ul id="error-contaier"> 
	                  </ul>
	              	</div>
	              	<div class="form-group">
	                  <label for="" class="control-label col-md-3  requiredField"> Role Name :</label>
	                  <div class="controls col-md-9 ">
	                      <input class="input-md form-control" id="role_name" name="role_name" placeholder="Role Name" style="margin-bottom: 10px" type="text"  />
	                  </div>     
	              	</div>
	               	<div class="form-group">
	                  <label for="" class="control-label col-md-3  requiredField"> Role Slug :</label>
	                  <div class="controls col-md-9 ">
	                      <input class="input-md form-control" id="role_slug" name="role_slug" placeholder="Role Slug" style="margin-bottom: 10px" type="text"  />
	                  </div>     
	              	</div>
	              	<div class="form-group"> 
	                  <div class="controls col-md-3 "></div>
	                  <div class="controls col-md-9 ">
	                      <input type="submit" name="Signup" value="Add Role" class="btn btn-primary btn btn-info" id="save_role" />
	                  </div>
	              	</div> 
        		</div>
            </form>
        	</div>         
      	</div>
    </div>

  </div>
</div>
<!-- create role Modal Ends Here-->
<!-- Edit Role Modal -->
<div id="myEditRoleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title">Edit Role</h4>
      	</div>
      	<div class="modal-body">
        	<div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                <p>Role Updated Successfully.</p>
            </div>
        	<div class="panel panel-info" id="success-contaier-parent-new1">
        		<div class="panel-body">  
	              	<div class="alert alert-danger" id="error-contaier-parent" style="display:none">
	                  <ul id="error-contaier"> 
	                  </ul>
	              	</div>
	              	<input type="hidden" name="id" id="role-id" value="">        
	              	<div class="form-group">
	                  <label for="" class="control-label col-md-3  requiredField"> Role Name :</label>
	                  <div class="controls col-md-9 ">
	                      <input class="input-md form-control" id="role_name1" name="role_name1" placeholder="Role Name" style="margin-bottom: 10px" type="text"  />
	                  </div>     
	              	</div>
	               	<div class="form-group">
	                  <label for="" class="control-label col-md-3  requiredField"> Role Slug :</label>
	                  <div class="controls col-md-9 ">
	                      <input class="input-md form-control" id="role_slug1" name="role_slug1" placeholder="Role Slug" style="margin-bottom: 10px" type="text"  />
	                  </div>     
	              	</div>
	              	<div class="form-group"> 
	                  <div class="controls col-md-3 "></div>
	                  <div class="controls col-md-9 ">
	                      <input type="submit" name="Signup" value="Edit Role" class="btn btn-primary btn btn-info" id="edit_role" />
	                  </div>
	              	</div> 
        		</div>
        	</div>         
      	</div>
    </div>

  </div>
</div>
<!-- edit role Modal Ends Here-->
@endsection