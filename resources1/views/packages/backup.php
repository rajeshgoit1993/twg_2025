 @extends('layouts.front.master')
@section('content')
<div class="page-title-container">
<div class="container">
<div class="page-title pull-left">
                   
<h2 class="entry-title">{{$details->title}}</h2>
</div>
<ul class="breadcrumbs pull-right">
<li><a href="#">HOME</a></li>
<li class="active">Packages</li>
</ul>
</div>
</div>

<section id="content">
<div class="container tour-detail-page">
<div class="row">
@if(session()->has('message'))
<div class="alert alert-success">
{{ session()->get('message') }}
</div>
@endif
<div id="main" class="col-md-9">
<div class="tab-container style1" id="hotel-main-content">
<div class="tab-content">
<div id="photos-tab" class="tab-pane fade in active">
<div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                        
<div class="flex-viewport" style="overflow: hidden; position: relative;">
<ul class="slides" style="width: 3000%; transition-duration: 0.6s; transform: translate3d(-2610px, 0px, 0px);">
                                            
                 @foreach($images as $img)
<li style="width: 870px; float: left; display: block;" class=""><img src="{{URL::to('/').'/public/'.$img->image_path}}" alt="" draggable="false"></li>
                @endforeach
                                            
</ul>



</div>
@php
$theme=unserialize($details->package_category);
$theme_count=count($theme);

@endphp
<span class="theme_possition"> 
    
        @for($i=0;$i<$theme_count;$i++)
        <span class="theme_element">
         {{$theme[$i]}}
          </span>
        @endfor
   

</span>

<ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>
<div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                                        
<div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 2600%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
               @foreach($images as $img)
<li class="" style="width: 70px; float: left; display: block; height: 70px; position: relative;"><img src="{{URL::to('/').'/public/'.$img->image_path}}" alt="" draggable="false" style="position: absolute; top: 50%; margin-top: -35px; left: 50%; margin-left: -35px;"></li>
                                            
                @endforeach
                                            
                                            

</ul></div><ol class="flex-control-nav flex-control-paging"><li><a class="flex-active">1</a></li><li><a>2</a></li></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>
</div>
</div>
</div>
                        
<div id="hotel-features" class="tab-container">
<ul class="tabs">
<li class="active"><a href="#hotel-description" data-toggle="tab">Package Description</a></li>
<li><a href="#hotel_overview" data-toggle="tab">Overview</a></li>
<li><a href="#hotel-calender" data-toggle="tab">Pricing calendar</a></li>
<li><a href="#hotel-availability" data-toggle="tab">Itinerary</a></li>

<li><a href="#hotel-things-todo" data-toggle="tab">Tours</a></li>
<li><a href="#hotel-terms-policy" data-toggle="tab">Terms & Condition</a></li>
<li><a href="" data-toggle="tab">Destinations</a></li>
</ul>
<div class="tab-content list_custom_style">
<div class="tab-pane fade in active" id="hotel-description">

<!--<ul class="tabs">
<li><a href="#description" data-toggle="tab">Description</a></li>
<li><a href="" data-toggle="tab">Transportation</a></li>
<li><a href="" data-toggle="tab">Inclusions</a></li>
<li><a href="" data-toggle="tab">Exclusions</a></li>
<li><a href="" data-toggle="tab">Tour Highlights</a></li>
</ul>-->
 
<div class="tab-pane fade in active ">

<div class="long-description">
<h2 class="heading_color">About : {{$details->title}} </h2>


<p>

                                           
    {!!$details->description!!}
</p>

                                       

                                          
</div>
</div>
<div class="custom_padding"></div>
<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Tour Highlights</h2>


<p>

                                           
    {!! $details->description !!}
</p>

                                       

                                          
</div>
</div>



</div>
<!---->
 <div class="tab-pane fade " id="hotel_overview">


 
<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Transportation </h2>
<table class="table">
<tr>
<th style="width: 21%;">Transport : </th>
<td>
{{$details->transport}}
</td>
</tr>
<tr>
<th style="width: 21%;">About Transport : </th>
<td>
{{$details->transport_description}}
</td>
</tr>


</table> 


                                       

                                          
</div>
</div>
<div class="custom_padding"></div>
<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Accommodation</h2>


<div class="room-list listing-style3 hotel">
            @php

            $hoteldata="";
            @endphp
            
            @foreach($daywise as $day)
            @php
             $hoteldata.=$day['hotelname'].",";
             
            @endphp

            @endforeach 
            
             <?php
           
             $hoteldata=array_unique(explode(",",$hoteldata));
             $hoteldata_count=count($hoteldata);
              
             ?>
             @for($i=1;$i<$hoteldata_count;$i++)
             <?php
             $j=($i-1);
             
             ?>
<article class="box">
<figure class="col-sm-4 col-md-3">
<a class="hover-effect popup-gallery" href="#" title=""><img width="230" height="160" src="{{ url('/public'.CustomHelpers::get_first_image($hoteldata[$j],'rt_hotel_uploads','image_path','hotel_id')) }}" alt=""></a>
</figure>
<div class="details col-xs-12 col-sm-8 col-md-9">
<div>
<div>
<div class="box-title">
<h4 class="title"> </h4>
<dl class="description">
<dt>Location:
 @foreach($daywise as $day)
  
 @if($day['hotelname']==$hoteldata[$j])
{{$day['city']}}
 @break;
 @endif
 @endforeach
</dt>
</dl>
<dl class="description">

</dl>
</div>

</div>

                                                   
</div>
<div>

                                                   
</div>

                                                
</div>
</article>

@endfor


</div>
                                       

                                          
</div>
</div>
<div class="custom_padding"></div>
<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Inclusions</h2>


<p>

                                           
    {!!$details->inclusions!!}

</p>

                                 

                                          
</div>
</div>
<div class="custom_padding"></div>
<div class="tab-pane fade in active" id="description">

<div class="long-description">
<h2 class="heading_color">Exclusions</h2>


<p>

                                           
   {!!$details->exclusions!!}

</p>

                                       

                                          
</div>
</div>


</div>   


<!---->
<div class="tab-pane fade " id="hotel-location">
<div class="long-description">
<h2>Location Overview </h2> 


                                           
<table class="table">
<tr>
<th style="width: 21%;">Location : </th>
<td>
@php $city_count=count($city) @endphp
@if($city_count>0)
@for($i=0;$i<$city_count;$i++)
{{$city[$i]}} 
@if($i<($city_count-1))
,
@endif

@endfor
@endif
</td>
</tr>
<tr> 
<th>Country : </th>

<td>
@php $country_count=count($country) @endphp
@if($country_count>0)
@for($i=0;$i<$country_count;$i++)
{{$country[$i]}}

@if($i<($country_count-1))
,
@endif

@endfor
@endif  

</td>
</tr>
<tr> 
<th>Continent : </th>
<td> 
 @php $continent_count=count($continent) @endphp
@if($continent_count>0)
@for($i=0;$i<$continent_count;$i++)
{{$continent[$i]}}

@if($i<($continent_count-1))
,
@endif

@endfor
@endif     
</td>
</tr> 
<tr> 
<th>Best Time To Visit : </th>
<td><p></p></td>
</tr>
</table> 



                                          
</div>
</div>
<!--calender start-->
<div class="tab-pane fade " id="hotel-calender">
<div class="long-description">

<div class="cal_header">
<div class="col-md-6 col-sm-12">
<h2>Pricing Calender</h2> 
        
</div>
<div class="col-md-6 col-sm-12">
<div class="right">

    

<?php

$price_count=count($price);
$package_type="";

for($i=0;$i<$price_count;$i++)
{
  $package_type.=$price[$i]["package_rating"].",";
}

$package_array=array_unique(explode(",",$package_type));
$package_array=implode(" ",$package_array);
$package_array=explode(" ",$package_array);
$package_array_count=(count($package_array)-1);
?>
<input type="hidden" value="{{$price_count}}" id="hidden_value">

<input type="hidden" value="{{ $id["id"] }}" id="package_value">

<h2> Select Category:</h2>
<select id="package_type">
@for($j=0;$j<$package_array_count;$j++)

 <option value="{{ $package_array[$j] }}">
{{ 
CustomHelpers::getTableRecordById($package_array[$j],'rt_pkg_rating_type','name') 
}}
</option>   


@endfor
</select>
</div>  
</div>      
</div>
<div class="col-md-12">
 <div id="calendar_parrent">
  <div id='calendar'></div>  

 </div>   
                      



 </div>                                          
</div>
</div>


<!--calender end-->
<div class="tab-pane fade" id="hotel-availability">
                                    
<h2>Day wise Itinerary</h2>
                                   
<div class="room-list listing-style3 hotel">
            @foreach($daywise as $day)
                @if(count($day)>4)
                                       
                                                

<article class="box">
<figure class="col-sm-4 col-md-3">
<a class="hover-effect popup-gallery" href="#" title=""><img width="230" height="160" src="{{ url('/public'.CustomHelpers::get_first_image($day['hotelname'],'rt_hotel_uploads','image_path','hotel_id')) }}" alt=""></a>
</figure>
<div class="details col-xs-12 col-sm-8 col-md-9">
<div>
<div>
<div class="box-title">
<h4 class="title">{{CustomHelpers::getTableRecordById($day['hotelname'],'rt_hotels','name')}} </h4>
<dl class="description">
<dt>Location:</dt>
<dd>{{$day['city']}}&nbsp;<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div></dd>
</dl>
<dl class="description">
<dt>Meal Plan:</dt>
<dd>
    @if($day['meal_plan']=="EP")
     No meal
    @elseif($day['meal_plan']=="CP")
    Room + Breakfast
    @elseif($day['meal_plan']=="MAP")
    Room + Breakfast + Lunch/Dinner
    @endif

</dd>
</dl>
</div>
<div class="amenities" style="float: right !important;">
<h4 style="font-size:24px;" class="label label-primary pull-right">{{$day['title']}}</h4>
</div>
</div>

                                                   
</div>
<div>
  <span class="spn">
{!!$day['desc']!!}
   </span>                                                
</div>
<h4>Tours</h4>
@foreach($day['tours'] as $tour)
<div class="col-md-3">
<div class="Tours"><p>{{CustomHelpers::get_tour_name($tour)}}</p></div>
</div>
@endforeach
                                                
</div>
</article>

@endif
@endforeach    
</div>
                                    
</div>
<!--
<div class="tab-pane fade" id="hotel-amenities">
<h2>Inclusions & Exclusions</h2>
                                    


<h4>Inclusions</h4>
<ul class="amenities clearfix style1">


<li class="col-md-12">
<div class="">
    
{{$details->inclusions}}
</div>
</li>

  
                                        
                                       
</ul>
                                   
<h4>Exclusions</h4>
<ul class="amenities clearfix style1">

<li class="col-md-12">
<div class="">
{{$details->exclusions}}
</div>
</li>


                                        
                                       
</ul>
                                    
</div>
-->
<div class="tab-pane fade" id="hotel-things-todo">
<h2>Things to Do</h2>
<div class="activities image-box style2 innerstyle">
@foreach (unserialize($details->tours) as $t)
@php $tour = CustomHelpers::get_tour_data($t) @endphp
<article class="box">
<figure>
<a title="" href="#alt="" src="http://placehold.it/250x160"></a>
</figure>
<div class="details">
<div class="details-header">
                                                    
<h4 class="box-title">{{$tour->activity}}</h4>
</div>
<p>{{$tour->desc}}</p>
                                               
</div>
</article>
@endforeach    
                                        
                                       
</div>
</div>
                                
<div class="tab-pane fade" id="hotel-terms-policy">
<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Visa Policies</h2>


<p>

                                           
@php $v_policy =  array_filter(explode(',',$details->visa_policies)) @endphp
                                   

@foreach($v_policy as $v)
{{CustomHelpers::get_payment_policy($v)}}</br>
@endforeach
</p>

                                       

                                          
</div>
</div>
<div class="custom_padding"></div>

<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Payment Policies</h2>


<p>

                                           
@php $p_policy =  array_filter(explode(',',$details->payment_policy)) @endphp
                                   

@foreach($p_policy as $p)
{{CustomHelpers::get_payment_policy($p)}}</br>
@endforeach
</p>

                                       

                                          
</div>
</div>
<div class="custom_padding"></div>


<div class="tab-pane fade in active">

<div class="long-description">
<h2 class="heading_color">Cancel Policies</h2>


<p>

                                           
@php $c_policy =  array_filter(explode(',',$details->cancel_policy)) @endphp
                                   

@foreach($c_policy as $p)
{{CustomHelpers::get_cancel_policy($p)}}</br>
@endforeach
</p>

                                       

                                          
</div>
</div>













                                   
                                    
                                  
</div>
</div>
                        
</div>
</div>
<div class="sidebar col-md-3">
<div class="travelo-box">
<h4 class="box-title">Overview</h4>
<article class="detailed-logo">
<figure>
                            
<img src=" {{URL::to('/').'/public/'.$images->first()->image_path}}" alt="">
</figure>
<div class="details">
                           
<h2 class="box-title">{{$details->title}}</h2>



   <?php
   
   $price_count=count($price);
   $price_data="";
   $final_price_array="";
   for($i=0;$i<$price_count;$i++)
   {
    $price_airfare=$price[$i]["airfare"];
    $price_hotel=$price[$i]["hotel"];
    $price_tour_transfer=$price[$i]["tour_transfer"];
    $price_currency=$price[$i]["currency"];
    $total=(($price_airfare+$price_hotel+$price_tour_transfer)*$price_currency);
    //$price_data.=$total.',';
    
    $date_from=strtotime($price[$i]["datefrom"]);
    $date_to=strtotime($price[$i]["dateto"]);
    $current_date=strtotime(Date('m/d/Y'));
    if(($date_from<$current_date )&&( $date_to>$current_date ))
    {
     
    $price_data.=$total.',';

    }

    
    
   }
   


   $price_array=explode(",",$price_data);
   sort($price_array);

   
   ?>                     
                                    
<span class="price clearfix">
<small class="pull-left">Price</small>
@if($details->onrequest == 1)
                                           
<span class="pull-right">On Request</span>
@else
                                            
<span class="pull-right">&#x20B9; {{ $price_array["1"]  }}</span>
@endif
                                    
</span>
                                 
<div class="feedback clearfix">
<small class="pull-left">Rating</small>&nbsp;&nbsp;&nbsp;
@if($details->package_rating == 1)
<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 20%;"></span></div>
@elseif($details->package_rating == 2)
<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 40%;"></span></div>
@elseif($details->package_rating == 3)
<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 60%;"></span></div>
@elseif($details->package_rating == 4)

<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div>
@elseif($details->package_rating == 5)

<div title="" class="five-stars-container pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 100%;"></span></div>
@endif

                                    
</div>
<button class="button yellow full-width uppercase btn-small" data-toggle="modal" data-target="#queryHandler">Book Package</button>
</div>
</article>
                        
<div class="travelo-box book-with-us-box">
<h4>Why Book with us?</h4>
<ul>
<li>
<i class="soap-icon-hotel-1 circle"></i>
<h5 class="title"><a href="#">135,00+</h5>
<p>Nunc cursus libero pur congue arut nimspnty.</p>
</li>
<li>
<i class="soap-icon-savings circle"></i>
<h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
<p>Nunc cursus libero pur congue arut nimspnty.</p>
</li>
<li>
<i class="soap-icon-support circle"></i>
<h5 class="title"><a href="#">Excellent Support</a></h5>
<p>Nunc cursus libero pur congue arut nimspnty.</p>
</li>
</ul>
</div>
                        
</div>
                       
                        
</div>
</div>
</div>
</section>
   <div class="testing">
      <input type="text" value="{{url('/')}}" name="" id="test">
   </div>         
<!-- Modal -->
<div id="queryHandler" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Enquiry Now!</h4>
</div>
<div class="modal-body">
       

<form action="{{URL::to('/saveQuery')}}" method="Post">
    {{csrf_field()}}
<input type="hidden" name="packageId" value="{{$details->id}}">
<div class="form-group">
<label for="name">Name</label>
<input class="form-control" required type="text" value="" name="name"/>
</div>
<div class="form-group">
<label for="mobile">Mobile No</label>
<input class="form-control" required type="text" value="" name="mobile"/>
</div>
<div class="form-group">
<label for="email">Email Id</label>
<input class="form-control" type="text" required value="" name="email"/>
</div>
<div class="form-group">
<label for="massage">Message</label>
<textarea class="form-control" type="text" name="message"></textarea>
</div>
        
       
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-success" name="submit" value="Submit"/>
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</form>
</div>
</div>

</div>
</div>

 <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/moment.min.js") }}'></script>
     <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/jquery.min.js") }}'></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/fullcalendar.js") }}'></script>
    <script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/gcal.js") }}'></script>
    
    
<script>
     $(document).ready(function() 
      { 

         
       var APP_URL=$("#test").val();
        
      
       var package_type=$("#package_type").val();
       var hidden_value=$("#hidden_value").val();
       var package_id=$("#package_value").val();
      
  
       var url=APP_URL+'/calendar-data/'+package_id+"/"+hidden_value+"/"+package_type;
      

         //var url="{{URL::to('/calendar-data')}}";
           
            
          //var data={_token:"{{ csrf_token() }}"};
          //$.get(url,function(rdata)
          //{
          
          //document.write(rdata)
             
       
   
                // });  
        
    
       
      

      $('#calendar').fullCalendar({

      header: 
      {
        left: 'prev, today',
        center: 'title',
        right: 'next'
      },
      eventRender: function( event, element, view ) {
        element.find('.fc-title').prepend('<span class="price_s">&#8377</span> ');
      $(element).css("margin-left", "10px");
       },
    
      displayEventTime: false,   
      events:url,
     
      eventClick: function(event) {
        // opens events in a popup window
        window.open(event.url, 'gcalevent', 'width=700,height=600');
        return false;
      },

    

    });
var i=1;
$("#package_type").change(function()
{
$("#calendar_parrent").empty();
var package_type=$(this).val();
var url=APP_URL+'/calendar-data/'+package_id+"/"+hidden_value+"/"+package_type;

$("#calendar_parrent").append('<div id="calendar'+i+'"></div>');

$('#calendar' + i + '').fullCalendar({

      header: 
      {
        left: 'prev, today',
        center: 'title',
        right: 'next'
      },
      eventRender: function( event, element, view ) {
       element.find('.fc-title').prepend('<span class="price_s">&#8377</span> ');
      $(element).css("margin-left", "10px");
       },
    
      displayEventTime: false,   
      events:url,
     
      eventClick: function(event) {
        // opens events in a popup window
        window.open(event.url, 'gcalevent', 'width=700,height=600');
        return false;
      },

    

    });



i++
})

  
    
      });

  

</script>

@endsection