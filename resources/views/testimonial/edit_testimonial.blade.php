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
            <h3 class="box-title">Edit Testimonial</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="{{URL::to('/update_testimonial/'.$data->id)}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="type" value="Private Tour"/>
              {{csrf_field()}}
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Name:</label>
                  <div class="col-sm-5">
                    <input type="text" name="c_name" class="form-control" placeholder="Enter Client Name"
                    value="{{$data->c_name}}">
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
                    <span><img src="{{URL::to('/').'/public/uploads/testimonial/'.$data->c_image }}" width="100" height="50"></span>
                    <input type="file" class="form-control" id="c_image"  name="c_image[]" value="{{$data->c_image}}" multiple>
                    <input type="hidden" name="c_image_value" value="{{$data->c_image}}">
                    <div class="col-sm-5"></div>
                  </div>
                  <span class="error">{{ $errors->first("c_image")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Email Id:</label>
                  <div class="col-sm-5">
                    <input type="email" name="c_email" class="form-control" placeholder="Enter Client Email Id" value="{{$data->c_email}}">
                    <div class="col-sm-5" ></div>
                  </div>
                  <span class="error">{{ $errors->first("c_email")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Enter Client Mobile No:</label>
                  <div class="col-sm-5">
                  <input type="number" name="c_mobile" class="form-control" placeholder="Enter Client Mobile No" value="{{$data->c_mobile}}">
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
                  <input type="text" name="c_country" class="form-control" placeholder="Enter Client Country" value="{{$data->c_country}}">
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
                  <textarea name="c_exp" class="form-control" rows="3" placeholder="Enter About Package">{{$data->c_exp}}</textarea>
                  <div class="col-sm-5">
                  </div>
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
                  <option value="1" @if($data->c_rating=="1") selected @endif>1 Star </option>
                  <option value="2" @if($data->c_rating=="2") selected @endif>2 Star </option>
                  <option value="3" @if($data->c_rating=="3") selected @endif>3 Star </option>
                  <option value="3.5" @if($data->c_rating=="3.5") selected @endif>3.5 Star </option>
                  <option value="4" @if($data->c_rating=="4") selected @endif>4 Star  </option>
                  <option value="4.5" @if($data->c_rating=="4.5") selected @endif>4.5 Star  </option>
                  <option value="5" @if($data->c_rating=="5") selected @endif>5 Star </option>
                  </select>
                  <div class="col-sm-5"></div>
                </div>
                <span class="error">{{ $errors->first("c_rating")}}</span>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="state">Status:</label>
                  <div class="col-sm-5">
                  <select name="status" class="form-control">
                  <option value="0" @if($data->status=="0") selected @endif>Disable</option>
                  <option value="1" @if($data->status=="1") selected @endif>Enable </option>
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
                  <button type="submit" name="add" id="remove" class="btn btn-danger btn-sm">Update
                  <i class="fa  fa-arrow-right"></i>
                  </button>
                </div>
                <div class="col-sm-3"></div>
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