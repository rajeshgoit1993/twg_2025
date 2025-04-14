  @extends('layouts.master')

  @section("custom_css_code")

  <style type="text/css">
    .destination-img-wrapper {
      width: 100%;
      height: 200px;
      border-radius: 5px;
      overflow: hidden;
      /*background-image: var(--default-image);*/
      background-image: url('{{ asset("public/uploads/default-img.webp") }}');
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      border: 1px solid #ccc;
    }
    .destination-img {
      width: 100%;
      height: 200px;
    }
    .custom_border {
      border:1px solid lightgray;
      padding: 10px
    }
    .custom_border .grid-width {
      min-width: 105px;
    }
    .custom_border .dropzone {
      height: 34px;
      min-height: 34px;
      padding: 8px;
      border: 1px solid #d2d6de;
    }
    .custom_border .dz-message {
      display:none;
    }
    .custom_border p {
      pointer-events: none;
    }
    table td {
      vertical-align: middle !important;
    }
  </style>

  @endsection

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    @foreach($img_data as $img)
      <div class="row">
        <!-- <div class="col-md-12 form-group"></div> -->

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title1" @if($img->row1_title1!="") value="{{$img->row1_title1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc1"  @if($img->row1_desc1!="") value="{{$img->row1_desc1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest1" @if($img->row1_dest1!="") value="{{$img->row1_dest1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
              <form action="{{url('/mid_image_save/row1_image1')}}" class="dropzone" enctype="multipart/form-data">
                {{csrf_field()}}
                <p>Select Image</p>
              </form>
            </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row1_image1))
              <img class="destination-img" alt="img" src="{{ asset('public/'.$img->row1_image1) }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td class="grid-width">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title2" @if($img->row1_title2!="") value="{{$img->row1_title2}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc2" @if($img->row1_desc2!="") value="{{$img->row1_desc2}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest2" @if($img->row1_dest2!="") value="{{$img->row1_dest2}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Select Image<br>(300px * 300px)</td>
                    <td>
                    <form action="{{url('/mid_image_save/row1_image2')}}" class="dropzone" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <p>Select Image</p>
                    </form>
                  </td>
                  </tr>
                </tbody>
                </table>
                <div class="destination-img-wrapper">
                  @if(!empty($img->row1_image2))
                    <img class="destination-img" alt="img" src="{{ asset('public/'.$img->row1_image2) }}">
                  @endif
                </div>
        </div>

        <div class="col-md-3 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td class="grid-width">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title3" @if($img->row1_title3!="") value="{{$img->row1_title3}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc3" @if($img->row1_desc3!="") value="{{$img->row1_desc3}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest3" @if($img->row1_dest3!="") value="{{$img->row1_dest3}}" @endif></td>
                  </tr>
                  <tr>
                    <td class="grid-width">Select Image<br>(300px * 300px)</td>
                    <td>
                    <form action="{{url('/mid_image_save/row1_image3')}}" class="dropzone" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <p>Select Image</p>
                    </form>
                  </td>
                  </tr>
                </tbody>
                </table>
                <div class="destination-img-wrapper">
                  @if(!empty($img->row1_image3))
                    <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row1_image3 }}">
                  @endif
                </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title1" @if($img->row2_title1!="") value="{{$img->row2_title1}}" @endif ></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc1" @if($img->row2_desc1!="") value="{{$img->row2_desc1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest1" @if($img->row2_dest1!="") value="{{$img->row2_dest1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image1')}}" class="dropzone" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <p>Select Image</p>
                </form>
              </td>
            </tr>
          </tbody>
          </table>
                <div class="destination-img-wrapper">
          @if(!empty($img->row2_image1))
            <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row2_image1 }}">
          @endif
          </div>
        </div>

        <div class="col-md-12 form-group"></div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title2" @if($img->row2_title2!="") value="{{$img->row2_title2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc2" @if($img->row2_desc2!="") value="{{$img->row2_desc2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest2" @if($img->row2_dest2!="") value="{{$img->row2_dest2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image2')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                 </form>

                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row2_image2))
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row2_image2 }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title3" @if($img->row2_title3!="") value="{{$img->row2_title3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc3" @if($img->row2_desc3!="") value="{{$img->row2_desc3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest3" @if($img->row2_dest3!="") value="{{$img->row2_dest3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%" >Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image3')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row2_image3))
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row2_image3 }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td class="grid-width">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title1" @if($img->row3_title1!="") value="{{$img->row3_title1}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc1" @if($img->row3_desc1!="") value="{{$img->row3_desc1}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest1" @if($img->row3_dest1!="") value="{{$img->row3_dest1}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Select Image<br>(300px * 300px)</td>
                  <td>
                    <form action="{{url('/mid_image_save/row3_image1')}}" class="dropzone" enctype="multipart/form-data">
                      {{csrf_field()}}
                        <p>Select Image</p>
                     </form>

                  </td>
                </tr>
              </tbody>
              </table>
              <div class="destination-img-wrapper">
                @if(!empty($img->row3_image1))
                  <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row3_image1 }}">
                @endif
            </div>
        </div>

        <div class="col-md-3 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td class="grid-width">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title2" @if($img->row3_title2!="") value="{{$img->row3_title2}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc2" @if($img->row3_desc2!="") value="{{$img->row3_desc2}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest2" @if($img->row3_dest2!="") value="{{$img->row3_dest2}}" @endif></td>
                </tr>
                <tr>
                  <td class="grid-width">Select Image<br>(300px * 300px)</td>
                  <td>
                    <form action="{{url('/mid_image_save/row3_image2')}}" class="dropzone" enctype="multipart/form-data">
                      {{csrf_field()}}
                        <p>Select Image</p>
                     </form>

                    </td>
                </tr>
              </tbody>
              </table>
              <div class="destination-img-wrapper">
                @if(!empty($img->row3_image2))
                  <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row3_image2 }}">
                @endif
            </div>
        </div>

        <div class="col-md-12 form-group"></div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title3" @if($img->row3_title3!="") value="{{$img->row3_title3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc3" @if($img->row3_desc3!="") value="{{$img->row3_desc3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest3" @if($img->row3_dest3!="") value="{{$img->row3_dest3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image (300px x 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row3_image3')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if($img->row3_image3=="")
              <img class='destination-img' alt="img" src="{{ asset('public/uploads/default_profile_image.png') }}">
            @else
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row3_image3 }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title1" @if($img->row4_title1!="") value="{{$img->row4_title1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc1" @if($img->row4_desc1!="") value="{{$img->row4_desc1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest1" @if($img->row4_dest1!="") value="{{$img->row4_dest1}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image1')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                 </form>
                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row4_image1))
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row4_image1 }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title2" @if($img->row4_title2!="") value="{{$img->row4_title2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc2" @if($img->row4_desc2!="") value="{{$img->row4_desc2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest2" @if($img->row4_dest2!="") value="{{$img->row4_dest2}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image2')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                 </form>
                </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row4_image2))
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row4_image2 }}">
            @endif
          </div>
        </div>

        <div class="col-md-3 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td class="grid-width">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title3" @if($img->row4_title3!="") value="{{$img->row4_title3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc3" @if($img->row4_desc3!="") value="{{$img->row4_desc3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest3" @if($img->row4_dest3!="") value="{{$img->row4_dest3}}" @endif></td>
            </tr>
            <tr>
              <td class="grid-width">Select Image<br>(300px * 300px)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image3')}}" class="dropzone" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p>Select Image</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          <div class="destination-img-wrapper">
            @if(!empty($img->row4_image3))
              <img class='destination-img' alt="img" src="{{ asset('/public/').$img->row4_image3 }}">
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection