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
          <!-- <div class="box-header"></div> -->
          <!-- /.box-header -->
          <div class="box-body">

            <!-- Back Button -->
            <a href="{{URL::to('/packagehotelUploads/'.Request::segment(3))}}" class="btn btn-success">
              <i class="glyphicon glyphicon-arrow-left"> </i> Back
            </a>

            <div class="box-header"></div>

            <div class="well">
              <!-- manage_package -> editimagemiddle -->
              <div class="box-header" style="padding: 10px 0;">
                <h3 class="box-title">Select location to edit images from gallery</h3>
                <h3 class="box-title">({{ CustomHelpers::get_packagehotel_title(Request::segment(3)) }})</h3>
              </div>
              <div class="modal-body">
                <!-- Form for selecting country, state, and city -->
                <form action="{{ URL::to('/packagehotel_image_gallery_edit/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4)) }}"  >
                  {{ csrf_field() }}
                  <!-- Row for form fields -->
                  <div class="row">
                    
                    <!-- Country Selection -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control country" name="country_name" >
                          <option value="">Select Country</option>
                          @foreach($countries as $country)
        <option value="{{ $country->id }}" @if($gallery_data->country==$country->id) selected="selected" @endif >
            {{ $country->name }}
        </option>
    @endforeach    

                        
                        </select>
                      </div>
                    </div>

                    <!-- State Selection -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="country">State</label>
                        <select class="form-control states" name="state_name">

                          @foreach($state as $state)
        <option value="{{ $state->id }}" @if($gallery_data->state==$state->id) selected="selected" @endif >
            {{ $state->name }}
        </option>
    @endforeach

                     
                        </select>
                      </div>
                    </div>

                    <!-- City Selection -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="country">City</label>
                        <select class="form-control city" name="city_name">

                           @foreach($city as $cont)
        <option value="{{ $cont->id }}" @if($gallery_data->city==$cont->id) selected="selected" @endif>
            {{ $cont->name }}
        </option>
    @endforeach

                       
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12"></div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger">Proceed to select</button>
                      </div>
                    </div>
                    </div>
                    <!-- /.row -->
                </form>
              </div>
            </div>

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