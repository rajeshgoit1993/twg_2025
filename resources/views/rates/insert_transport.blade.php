@extends('layouts.master')
@section('content')
<style>
  .error{color: red}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Transport</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="{{URL::to('/store-transport')}}" method="post" >
                          <input type="hidden" name="type" value="Private Tour"/>
                          {{csrf_field()}}
                        <br>
                 <div class="row">
            <div class="form-group">
              
           <label class="control-label col-sm-1" for="transport">Transport:</label>
           <div class="col-sm-6">
             <input type="text" class="form-control" id="transport" placeholder="Enter Transport Name" name="transport" value="{{ old('transport') }}">
             </div>
           <div class="col-sm-5"></div>

             </div>
             <span class="error">{{ $errors->first("transport")}}</span>
             </div> 
             <br>
      
             <br>
              <div class="row">
                
                     <div class="col-sm-1"></div>   
                      <div class="col-sm-6">
                        
                      <button type="submit" name="add" id="remove" class="btn btn-danger btn-lg">Save 
                            <i class="fa  fa-arrow-right">
                            </i>
                          </button>

                      </div> 
                       <div class="col-sm-5"></div>  
                          
                       
              </div>
                 
            </form>

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