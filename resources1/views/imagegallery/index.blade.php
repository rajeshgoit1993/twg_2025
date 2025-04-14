@extends('layouts.master')

@section("custom_css_code")

<style type="text/css">
.search-container {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #f2f2f2;
  margin: 10px;
}
.video_icon .fa {
}
.dSrchImgCont {
  padding: 5px 0 15px;
  background: #f2f2f2;
  margin-bottom: 10px;
}
.dImgVdoCard {
  border-radius: 10px;
  overflow: hidden;
  border: 2px solid #e9e9e9;
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  width: 100%;
  height: auto;
  overflow: hidden;
}
.dImgVdoCard:hover {
  border-width: 2px;
  border-color: red;
}
.dImgVdoCardImgBox {
  width: 100%;
  height: 250px;
  background-color: #f2f2f2;
}
.dImgVdoCardImgBox img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.vdoInfo {
  position: absolute;
  z-index: 1;
  color: #fff;
  left: 50%;
  top: 25%;
  border: 1px solid #fff;
  padding: 10px;
  border-radius: 20px;
  cursor: pointer;'
}
.dImgVdoCard .itemName {
  padding: 10px;
  font-size: 14px;
  line-height: 16px;
  color: #fff;
  background-color: #434a54;
  height: 36px;
  }
.dImgVdoCardCntry {
  font-size: 14px;
  line-height: 16px;
  color: #fff;
  font-weight: 600;
  background-color: #edbe01;
  padding: 15px;
  text-align: center;
  white-space: nowrap;
}
.dImgVdoCardCity {
  font-size: 14px;
  line-height: 16px;
  color: #fff;
  font-weight: 600;
  background-color: #08b2ed;
  padding: 15px;
  text-align: center;
  white-space: nowrap;
}
.dImgVdoCardEditBtn {
  padding: 15px;
  font-size: 14px;
  line-height: 16px;
  color: #8f9192;
  background-color: #fff;
  text-align: center;
  cursor: pointer;
  white-space: nowrap;
}
.dImgVdoCardDltBtn {
  padding: 15px;
  font-size: 14px;
  line-height: 16px;
  color: #8f9192;
  background-color: #f2f2f2;
  text-align: center;
  cursor: pointer;
  white-space: nowrap;
}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">    

    <!--Search Image & Videos Ends-->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tour Image Gallery</h3>
          </div>
          <!-- /.box-header -->

          <!--Search Image & Videos Starts-->
          <div class="search-container">
            <h4>Search Image & Videos</h4>
            <div class="row">

              <div class="col-md-3">
                <label>Country</label>
                <div class="form-group">
                <select class="form-control country gallery_country">
                  <option value=''>Select Country</option>
                  @foreach($countries as $cont)
                                            <option value="{{ $cont->id }}">{{ $cont->name }}</option>
                                          @endforeach
                </select>
                </div>
              </div>

              <div class="col-md-3">
                <label>State</label>
                <div class="form-group">
                <select class="form-control gallery_state states">
                  <option value=''>Select State</option>
                </select>
                </div>
              </div>

              <div class="col-md-3">
                <label>City</label>
                <div class="form-group">
                <select class="form-control gallery_city city" >
                    <option value=''>Select City</option>
                </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                <label>Search by name</label>
                <input type="text" name="search_by_name" placeholder="Search By Name" class="form-control search_by_name" value="">
                </div> 
              </div>

              <!-- Find Button -->
              <div class="col-md-2">
                <div class="form-group">
                  <button class="btn btn-success btn-block find_images">Find Images</button>
                </div>
              </div>

            </div>
          </div>

          <div class="box-body">
            <div class="row">
              @if(Sentinel::check())
                @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="makeflex flex-wrap" style="gap: 10px;">
                      <a href="{{ route('addNewImage') }}">
                        <div class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Image From System</div>
                      </a>
                    <a href="{{ route('addNewVideo') }}">
                      <div class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Video From System</div>
                    </a>
                  </div>
                </div>
                </div>
                @endif
              @endif
            </div>

            <div class="row" id="gallery_sorting">
              @foreach($data as $datavalue) 
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="dImgVdoCard">

                      <!--Video-->
                      @if($datavalue->type=='video')
                        <div class="dImgVdoCardImgBox video_icon">
                          <input type="hidden" name="" class="video_src"  value="{{ URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main }}">
                          <i class="vdoInfo fa fa-play play_video"></i>
                        </div>
                      @endif

                      <!-- image -->
                      <div class="dImgVdoCardImgBox">
                        <img  src="{{ file_exists(public_path('uploads/packages/thum_medium/'.$datavalue->thum_medium)) && !empty($datavalue->thum_medium) ? asset('public/uploads/packages/thum_medium/'.$datavalue->thum_medium) : (file_exists(public_path($datavalue->image_path)) && !empty($datavalue->image_path) ? asset('public/'.$datavalue->image_path) : asset('public/uploads/default-img.webp')) }}" title="image" loading="lazy">
                      </div>

                      <!-- title -->
                      <div class="itemName">{{ $datavalue->name }}</div>

                      <!-- country and city -->
                      <div class="makeflex flex-wrap">
                        <div class="dImgVdoCardCntry flexOne">{{CustomHelpers::get_master_table_data('countries', 'id', (int)$datavalue->country, 'name')  }}</div>
                        <div class="dImgVdoCardCity flexOne">{{ CustomHelpers::get_master_table_data('city', 'id', (int)$datavalue->city, 'name') }}</div>
                      </div>

                      <div class="makeflex flex-wrap">
                        <div class="flexOne">
                            <input type="hidden" name="" class="cou_name" value="{{$datavalue->country}}">
                            <input type="hidden" name="" class="sta_name" value="{{$datavalue->state}}">
                            <input type="hidden" name="" class="cit_name" value="{{$datavalue->city}}">
                            <input type="hidden" name="" class="name_name" value="{{$datavalue->name}}">
                            <input type="hidden" name="" class="pac_id" value="{{$datavalue->id}}">
                            @if($datavalue->type=='video')
                              <input type="hidden" name="" class="video_path" value="{{URL::to('/').'/public/uploads/packages/video/'.$datavalue->image_main }}">
                              <input type="hidden" name="" class="video_thumb" value="{{URL::to('/').'/public/uploads/packages/thum_small/'.$datavalue->thum_small }}">
                            @else
                              <input type="hidden" name="" class="img_name" value="{{URL::to('/').'/public/'.$datavalue->image_path }}">
                              <input type="hidden" name="" class="img_value" value="{{$datavalue->image_path}}">
                            @endif
                            <input type="hidden" name="" class="type" value="{{$datavalue->type}}">

                            <!-- <div type="button" class="dImgVdoCardEditBtn img_gall" data-toggle="modal" data-target="#img_gallery_edit" @if($datavalue->thum_small!="") @else @endif>EDIT</div> -->
                            @if(!empty($datavalue->thum_small))
                              <div class="dImgVdoCardEditBtn img_gall" data-toggle="modal" data-target="#img_gallery_edit">EDIT</div>
                            @endif

                          </div>
                          @if(Sentinel::check())
                            @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
                              <div class="flexOne">
                                <div type="button" class="dImgVdoCardDltBtn delete_gall" data-id="{{$datavalue->id}}">DELETE</div>
                              </div>
                            @endif
                          @endif

                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              <div class="col-md-12">
                <div class="form-group img_gal_pag text-center">
                  {!! $data->links() !!}
                  <!-- packageManageController -> fetch_data -->
                </div>
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

<!-- ******************** -->

<!-- edit modal -->
<!-- Modal Img Gallery Edit -->
<div id="img_gallery_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Image & Video</h4>
      </div>
      <div class="modal-body img_gallery_edit_value" style="padding: 5px 30px">
        <form  enctype="multipart/form-data" method="POST" id="gallery_form">
          {{csrf_field()}}
          <input type="hidden" name="pac_id" class="img_pac_id">
          <br>
          <div class="row">
            <div class="col-md-2">Country</div>
            <div class="col-md-7 country_val">
              <!--<input type="text" name="country" placeholder="Country Name" class="form-control " required value="">-->
              <select class="form-control country" name="country" >
                <option value="">Select Country</option>
                @foreach($countries as $cont)
                  <option value="{{ $cont->id }}" c_id="{{ $cont->id }}" >{{ $cont->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2">State</div>
              <div class="col-md-7 st_val">
                <!--<input type="text" name="city" placeholder="Country city" class="form-control" required value="">-->
                <select class="form-control states state_val" name="state" >
                  <option value="">Select State</option>
                </select>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2">City</div>
              <div class="col-md-7 ct_val">
                <!--<input type="text" name="city" placeholder="Country city" class="form-control" required value="">-->
                <select class="form-control city city_val" name="city">
                  <option value="">Select City</option>
                </select>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2">Name</div>
              <div class="col-md-7">
                <input type="text" name="name" placeholder="Image Name" class="form-control img_name" value="">
              </div>
          </div>
          <br>
          <div class="row">
            <div class="dynamic_file"></div>
            <input type="hidden" name="c_val" class="c_val">
            <input type="hidden" name="s_val" class="s_val">
            <input type="hidden" name="ct_val" class="ct_val">
            <input type="hidden" name="search_val" class="search_val" value="">
          </div>
          <br>
          <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-7 form-group">
                <button class="btn btn-success" id="update_gallery" data-dismiss="modal">Upload & Save</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection