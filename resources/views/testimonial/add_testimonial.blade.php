@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="add">
        <a href="{{URL::to('/testimonials')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
        </div>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Testimonial</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="{{URL::to('/store_testimonial')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="type" value="Private Tour"/>
              {{csrf_field()}}
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Name:</label>
                  <div class="col-sm-5">
                  <input type="text" name="c_name" class="form-control" placeholder="Enter Client Name">
                  <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_name")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="image">Choose Client Image:</label>
                  <div class="col-sm-5">
                  <input type="file" name="c_image[]" class="form-control" multiple>
                  <div class="col-sm-5">
                  </div>
                  </div>
                  <span class="error">{{ $errors->first("c_image")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Email Id:</label>
                  <div class="col-sm-5">
                  <input type="email" name="c_email" class="form-control" placeholder="Enter Client Email Id">
                  <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_email")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Mobile No:</label>
                  <div class="col-sm-5">
                  <input type="number" name="c_mobile" class="form-control" placeholder="Enter Client Mobile No">
                  <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_mobile")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Country:</label>
                  <div class="col-sm-5">
                    <input type="text" name="c_country" class="form-control" placeholder="Enter Client Country">
                    <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_country")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter About Package:</label>
                  <div class="col-sm-5">
                    <textarea name="c_exp" class="form-control" rows="3" placeholder="Enter About Package"></textarea>
                    <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_exp")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
              <div class="form-group">
                <label class="control-label col-sm-2" for="state">Choose Rating:</label>
                <div class="col-sm-5">
                  <select name="c_rating" class="form-control">
                    <option value="1">1 Star </option>
                    <option value="2">2 Star </option>
                    <option value="3">3 Star </option>
                    <option value="3.5">3.5 Star </option>
                    <option value="4">4 Star  </option>
                    <option value="4.5">4.5 Star  </option>
                    <option value="5" selected>5 Star </option>
                  </select>
                  <div class="col-sm-5"></div>
                </div>
                <span class="error">{{ $errors->first("c_rating")}}</span>
              </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                  <button type="submit" name="add" id="remove" class="btn btn-danger btn-sm">Save
                  <i class="fa fa-arrow-right"></i>
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