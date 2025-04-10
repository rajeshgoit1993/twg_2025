@extends('layouts.master')

@section("custom_css_code")

<style>
/* Styles for the fixed top bar */
#dGalleryTopBarCont {
     position: fixed;
     z-index: 1;
     top: 75px;
     margin-bottom: 20px;
     background: #f2f2f2;
     width: 88%;
     display: block;
     transition: top 0.3s;
     padding: 15px;
     border-radius: 5px;
}

/* Styles for the heading in the top bar */
#dGalleryTopBarCont h3 {
     font-size: 24px;
     line-height: 26px;
     color: #000001;
     font-weight: 500;
     text-align: left;
     margin: 0 0 0 10px;
}

.dImgSelectionCont {
     position: relative;
     top: 75px;
     margin-bottom: 50px;
}

/* Styles for the image card */
.dImgCardCont {
     border: 1px solid #e7e7e7;
     /*margin-top: 60px;*/
     position: relative;
     width: 100%;
     height: 250px;
     overflow: hidden;
     border-radius: 5px;
     margin-bottom: 20px;
}

.dImgCardBox {
     width: 100%;
     height: 100%;
     background-color: #f2f2f2;
}

/* Styles for images within the card */
.dImgCardBox img {
     width: 100%;
     height: 100%;
     object-fit: cover;
}

/* Styles for the label that overlays the image */
.labelGallery {
     position: absolute;
     bottom: 0;
     margin: 0;
     padding: 10px 0;
     background-color: #00000160;
     width: 100%;
     font-size: 14px;
     line-height: 16px;
     color: #fff;
     font-weight: 500;
     display: flex;
     justify-content: center;
     align-items: center;
     height: 100%;
}

.labelGalleryText {
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
}

/* Styles for the checkbox */
.dImgCardCont input[type=checkbox] {
     margin: 0 5px;
     height: 21px;
     width: 16px;
}

/* Styles for the fixed bottom bar */
.dGalleryBtmBarCont {
     position: fixed;
     bottom: 0;
     background: #fff;
     padding: 15px 0;
     width: 97%;
     display: flex;
     justify-content: center;
}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Content Header (Page header) -->

     <!-- Main content -->
     <section class="content">
          <div class="row">
               <div class="col-md-12">
                    <div class="box" style="padding-bottom: 20px;">
                         <div class="box-body">

                              <!-- Top Bar -->
                              <div id="dGalleryTopBarCont">
                                   <div class="makeflex align-center">
                                        <div>
                                             <a href="{{ URL::to('/package_image_location/' . Request::segment(2)) }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                                        </div>
                                        <!-- manage_package -> package_image_gallery -->
                                        <div>
                                             <h3>Add Images from gallery <span class="font14">
                                                  (Images from
                                                  @if($country && $country != "0" && $state == "0" && ($city == "Select City" || $city == "0"))
                                                       {{ CustomHelpers::get_master_table_data('countries', 'id', (int)$country, 'name') }} &rarr;
                                                  @elseif($country && $country != "0" && $state != "0" && ($city == "Select City" || $city == "0"))
                                                     {{ CustomHelpers::get_master_table_data('countries', 'id', (int)$country, 'name') }} &rarr; {{CustomHelpers::get_master_table_data('states', 'id', (int)$state, 'name')  }} &rarr;
                                                  @elseif($country && $country != "0" && $state != "0" && $city != "Select City" && $city != "0")
                                                     {{ CustomHelpers::get_master_table_data('countries', 'id', (int)$country, 'name') }} &rarr; {{CustomHelpers::get_master_table_data('states', 'id', (int)$state, 'name')  }}&rarr;
{{CustomHelpers::get_master_table_data('city', 'id', (int)$city, 'name')  }}
                                                     &rarr;
                                                  @endif
                                                  {{ CustomHelpers::get_package_title(Request::segment(2)) }}
                                                  )
                                             </span>
                                             </h3>
                                        </div>
                                   </div>
                              </div>

                              <div class="dImgSelectionCont">
                                   <!-- Image Selection Form -->
                                   <form action="{{ URL::to('/package_image_save/' . Request::segment(2)) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            
                                             @foreach($data as $datavalue)
                                             <div class="col-md-3">
                                                  <div class="dImgCardCont">
                                                       <div class="dImgCardBox">
                                                            @if($datavalue->thum_medium != "")
                                                                 <img src="{{ URL::to('/') . '/public/uploads/packages/thum_medium/' . $datavalue->thum_medium }}">
                                                            @else
                                                                 <img src="{{ URL::to('/') . '/public/' . $datavalue->image_path }}">
                                                            @endif
                                                       </div>
                                                       <label class="labelGallery">
                                                            <input type="checkbox" name="image_from_gallery[]" value="{{ $datavalue->id }}"
                                                            @if(CustomHelpers::get_data_condition1($datavalue->id, Request::segment(2)) == "1") checked @endif>

                                                            @if(!empty($datavalue->name))
                                                               <span class="pull-right labelGalleryText">{{ $datavalue->name }}</span>
                                                            @else
                                                               <span class="labelGalleryText">Select</span>
                                                            @endif
                                                       </label>
                                                  </div>
                                             </div>
                                             @endforeach

                                             <!-- Submit Button -->
                                             <!-- <div class="dGalleryBtmBarCont"> -->

                                                  
                                                  @if(count($data)>0)
                                        <div class="col-md-12">
                                                  <div class="form-group textCenter">
                                                       <button type="submit" class="btn btn-success fontBold">Proceed to update</button>
                                                  </div>
                                             </div>
                                                  @endif
                                            
                                        </div>
                                   </form>

                                   <!-- alert message, if no image is loaded (working) -->
                                   @if($message)
                                        <div class="alert alert-info">{{ $message }}</div>
                                   @endif                              
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

@section("custom_js_code")

<script>
    // When the user scrolls down 20px from the top of the document, slide down the navbar
    window.onscroll = function() { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("dGalleryTopBarCont").style.top = "0";
        } else {
            document.getElementById("dGalleryTopBarCont").style.top = "75px";
        }
    }
</script>

@endsection