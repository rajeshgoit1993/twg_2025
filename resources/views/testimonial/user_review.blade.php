@extends('layouts.front.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Add Review</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{URL::to('/store_reviews')}}" id="store_reviews" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$testimonial_id}}">
            {{csrf_field()}}
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="image">Add Photo & Videos:</label>
                  <input type="file" name="c_image[]" class="form-control" multiple>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Choose Rating</label>
                  <select name="c_rating" class="form-control">
                    <option value="1" @if($testimonial_data->c_rating==1) selected @endif>1 Star </option>
                    <option value="2" @if($testimonial_data->c_rating==2) selected @endif>2 Star </option>
                    <option value="3" @if($testimonial_data->c_rating==3) selected @endif>3 Star </option>
                    <option value="3.5" @if($testimonial_data->c_rating==3.5) selected @endif>3.5 Star </option>
                    <option value="4" @if($testimonial_data->c_rating==4) selected @endif>4 Star  </option>
                    <option value="4.5" @if($testimonial_data->c_rating==4.5) selected @endif>4.5 Star  </option>
                    <option value="5" @if($testimonial_data->c_rating==5) selected @endif>5 Star </option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group" style="margin-top: 10px;">
                  <label  for="state">Enter About Package</label>
                  <textarea name="c_exp" class="form-control" rows="3" placeholder="Enter About Package">{{$testimonial_data->c_exp}}</textarea>
                </div>
              </div>
              <div class="col-md-12 textCenter">
                <button type="submit" name="add" id="remove" class="btn btn-danger btn-sm">Save <i class="fa  fa-arrow-right"></i></button>
              </div>
            </div>
        </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
</div>
</div>
<!--</div>-->

@endsection

@section('custom_js_code')

<!-- <script type="text/javascript">
$("#store_reviews").submit(function(e) {
  e.preventDefault()
  var APP_URL=$("#APP_URL").val();
  var form_data = new FormData($('#store_reviews')[0]);
  $.ajax( {
    url:APP_URL+'/store_reviews',
    data:form_data,
    type:'post',
    contentType: false,
    processData: false,
    success:function(data) {
      if(data=='success') {
        swal({
          title: 'Done !',
          text: 'Thank you! Reviews submitted successfully',
          icon: 'success',
          timer: 1000,
          buttons: false,
        })
        .then(() => {
          window.location.href = APP_URL;
          })
        }
      else {
        swal("Error", data, "error");
        }
      },
      error:function(data) {

      }
    })
  })
</script> -->

<script type="text/javascript">
$(document).ready(function() {
  $("#store_reviews").submit(function(e) {
    e.preventDefault();
    
    var APP_URL = $("#APP_URL").val();
    var form_data = new FormData(this);

    $.ajax({
      url: APP_URL + '/store_reviews',
      data: form_data,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
      },
      contentType: false,
      processData: false,
      success: function(response) {
        if (response == 'success') {
          swal({
            title: 'Done!',
            text: 'Thank you! Reviews submitted successfully',
            icon: 'success',
            timer: 1000,
            buttons: false,
          }).then(() => {
            window.location.href = APP_URL;
          });
        } else {
          swal("Error", response, "error");
        }
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
        swal("Error", "Something went wrong. Please try again.", "error");
      }
    });
  });
});
</script>
@endsection