  @extends('layouts.master')
  @section('content')
  <style type="text/css">
    img {
      width: 100%;
      margin: 10px;
      height: 50%;
    }
    .custom_border{
      border:1px solid lightgray;
      padding: 10px
    }
    .custom_border .dropzone {
      min-height: 31px;
    }
    .custom_border .dz-message {
      display:none;
    }
   
  </style>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    @foreach($img_data as $img)
      <div class="row">
        <div class="col-md-8 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title1" @if($img->row1_title1!="") value="{{$img->row1_title1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc1"  @if($img->row1_desc1!="") value="{{$img->row1_desc1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest1" @if($img->row1_dest1!="") value="{{$img->row1_dest1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(800*400)</td>
              <td>
              <form action="{{url('/mid_image_save/row1_image1')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                {{csrf_field()}}
                <p style="text-align: center;">--Choose Image--</p>
              </form>
            </td>
            </tr>
          </tbody>
          </table>
          @if($img->row1_image1=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png" style="height: 600px;">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row1_image1 }}" style="height: 600px;">
          @endif
        </div>
      
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td width="22%">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title2" @if($img->row1_title2!="") value="{{$img->row1_title2}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc2" @if($img->row1_desc2!="") value="{{$img->row1_desc2}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest2" @if($img->row1_dest2!="") value="{{$img->row1_dest2}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Choose Image(400*200)</td>
                    <td>
                    <form action="{{url('/mid_image_save/row1_image2')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                      {{csrf_field()}}
                      <p style="text-align: center;">--Choose Image--</p>
                    </form>
                  </td>           
                  </tr>
                </tbody>
                </table>
                @if($img->row1_image2=="")
                  <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
                @else
                  <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row1_image2 }}">
                @endif
              </div>
            
              <div class="col-md-12 custom_border">
                <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td width="22%">Enter Title</td>
                    <td><input type="text" class="form-control" placeholder="Enter Title" name="row1_title3" @if($img->row1_title3!="") value="{{$img->row1_title3}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Enter Image Description</td>
                    <td><input type="text" class="form-control" placeholder="Image Description" name="row1_desc3" @if($img->row1_desc3!="") value="{{$img->row1_desc3}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Enter Destination</td>
                    <td><input type="text" class="form-control" placeholder="Enter Destination" name="row1_dest3" @if($img->row1_dest3!="") value="{{$img->row1_dest3}}" @endif></td>
                  </tr>
                  <tr>
                    <td width="22%">Choose Image(400*200)</td>
                    <td>
                    <form action="{{url('/mid_image_save/row1_image3')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                      {{csrf_field()}}
                      <p style="text-align: center;">--Choose Image--</p>
                    </form>
                  </td>
                  </tr>
                </tbody>
                </table>
                @if($img->row1_image3=="")
                  <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
                @else
                  <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row1_image3 }}">
                @endif
              </div>
            </div>
          </div>
      </div>
    
      <!--row 2-->
      <div class="row">
        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title1" @if($img->row2_title1!="") value="{{$img->row2_title1}}" @endif ></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc1" @if($img->row2_desc1!="") value="{{$img->row2_desc1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest1" @if($img->row2_dest1!="") value="{{$img->row2_dest1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image1')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                </form>
              </td>
            </tr>
          </tbody>
          </table>
          @if($img->row2_image1=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row2_image1 }}">
          @endif     
        </div>

        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title2" @if($img->row2_title2!="") value="{{$img->row2_title2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc2" @if($img->row2_desc2!="") value="{{$img->row2_desc2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest2" @if($img->row2_dest2!="") value="{{$img->row2_dest2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image2')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form>

                </td>
            </tr>
          </tbody>
          </table>
          @if($img->row2_image2=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row2_image2 }}">
          @endif    
        </div>

        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row2_title3" @if($img->row2_title3!="") value="{{$img->row2_title3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row2_desc3" @if($img->row2_desc3!="") value="{{$img->row2_desc3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row2_dest3" @if($img->row2_dest3!="") value="{{$img->row2_dest3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%" >Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row2_image3')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          @if($img->row2_image3=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row2_image3 }}">
          @endif      
        </div>
      </div>

      <!--Row 3--> 
      <div class="row">    
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td width="22%">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title1" @if($img->row3_title1!="") value="{{$img->row3_title1}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc1" @if($img->row3_desc1!="") value="{{$img->row3_desc1}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest1" @if($img->row3_dest1!="") value="{{$img->row3_dest1}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Choose Image(400*200)</td>
                  <td>
                    <form action="{{url('/mid_image_save/row3_image1')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                      {{csrf_field()}}
                        <p style="text-align: center;">--Choose Image--</p>
                     </form>

                  </td>
                </tr>
              </tbody>
              </table>
              @if($img->row3_image1=="")
                <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
              @else
                <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row3_image1 }}">
              @endif      
            </div>

            <div class="col-md-12 custom_border">
              <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td width="22%">Enter Title</td>
                  <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title2" @if($img->row3_title2!="") value="{{$img->row3_title2}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Enter Image Description</td>
                  <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc2" @if($img->row3_desc2!="") value="{{$img->row3_desc2}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Enter Destination</td>
                  <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest2" @if($img->row3_dest2!="") value="{{$img->row3_dest2}}" @endif></td>
                </tr>
                <tr>
                  <td width="22%">Choose Image(400*200)</td>
                  <td>
                    <form action="{{url('/mid_image_save/row3_image2')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                      {{csrf_field()}}
                        <p style="text-align: center;">--Choose Image--</p>
                     </form>

                    </td>
                </tr>
              </tbody>
              </table>
              @if($img->row3_image2=="")
                <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
              @else
                <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row3_image2 }}">
              @endif   
            </div>
          </div>
        </div>

        <div class="col-md-8 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row3_title3"  @if($img->row3_title3!="") value="{{$img->row3_title3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row3_desc3" @if($img->row3_desc3!="") value="{{$img->row3_desc3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row3_dest3" @if($img->row3_dest3!="") value="{{$img->row3_dest3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image (800*400)</td>
              <td>
                          <form action="{{url('/mid_image_save/row3_image3')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          @if($img->row3_image3=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row3_image3 }}">
          @endif      
        </div>
      </div>

      <!--row4-->
      <div class="row">
        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title1" @if($img->row4_title1!="") value="{{$img->row4_title1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc1" @if($img->row4_desc1!="") value="{{$img->row4_desc1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest1" @if($img->row4_dest1!="") value="{{$img->row4_dest1}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image1')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form>
                </td>
            </tr>
          </tbody>
          </table>
          @if($img->row4_image1=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row4_image1 }}">
          @endif    
        </div>

        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title2" @if($img->row4_title2!="") value="{{$img->row4_title2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc2" @if($img->row4_desc2!="") value="{{$img->row4_desc2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest2" @if($img->row4_dest2!="") value="{{$img->row4_dest2}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image2')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form> 
                </td>
            </tr>
          </tbody>
          </table>
          @if($img->row4_image2=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row4_image2 }}">
          @endif    
        </div>

        <div class="col-md-4 custom_border">
          <table class="table table-bordered table-striped">
          <tbody>
            <tr>
              <td width="22%">Enter Title</td>
              <td><input type="text" class="form-control" placeholder="Enter Title" name="row4_title3" @if($img->row4_title3!="") value="{{$img->row4_title3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Image Description</td>
              <td><input type="text" class="form-control" placeholder="Image Description" name="row4_desc3" @if($img->row4_desc3!="") value="{{$img->row4_desc3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Enter Destination</td>
              <td><input type="text" class="form-control" placeholder="Enter Destination" name="row4_dest3" @if($img->row4_dest3!="") value="{{$img->row4_dest3}}" @endif></td>
            </tr>
            <tr>
              <td width="22%">Choose Image(400*200)</td>
              <td>
                <form action="{{url('/mid_image_save/row4_image3')}}" class="dropzone chutom_height"  enctype="multipart/form-data">
                  {{csrf_field()}}
                    <p style="text-align: center;">--Choose Image--</p>
                 </form>
              </td>
            </tr>
          </tbody>
          </table>
          @if($img->row4_image3=="")
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/uploads/") }}/default_profile_image.png">
          @else
            <img class='img-responsive nicdark_focus nicdark_zoom_image' alt="img" src="{{ asset("/public/").$img->row4_image3 }}">
          @endif     
        </div>
      </div>
    @endforeach
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection