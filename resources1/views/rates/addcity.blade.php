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
              <h3 class="box-title">Add City</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="{{URL::to('/store-city')}}" method="post" >
                          <input type="hidden" name="type" value="Private Tour"/>
                          {{csrf_field()}}
                        <br>
            <div class="row">
            <div class="form-group">
           <label class="control-label col-sm-2" for="country">Choose Country:</label>
           <div class="col-sm-5">
            <select id="addcountry" class="form-control addcountry" name="choosecountry">
              <option value=''>Choose Country</option>
              @foreach($country_data as $countries)
              <option value="{{ $countries->id }}">{{ $countries->name }}</option>
              @endforeach
            </select>
           <div class="col-sm-5"></div>
             </div>
             <span class="error">{{ $errors->first("choosecountry")}}</span>
             </div>
              </div>
             <br>
       <div class="row">
         <div class="form-group">
           <label class="control-label col-sm-2" for="state">Choose State:</label>
           <div class="col-sm-5">
             <select id="addstate" class="form-control" name="choosestate">
                <option value=''>Choose State</option>
             </select>
           <div class="col-sm-5"></div>
             </div>
              <span class="error">{{ $errors->first("choosestate")}}</span>
             </div>
           </div>
             <br>
             <div class="row">
         <div class="form-group">
           <label class="control-label col-sm-2" for="state">Enter City:</label>
           <div class="col-sm-5">
             <input type="text" name="add_city" class="form-control">
           <div class="col-sm-5"></div>
             </div>
              <span class="error">{{ $errors->first("add_city")}}</span>
             </div>
           </div>
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