@extends('layouts.front.master')
@section('content')
  <div class="page-title-container">
         <div class="container">
            <div class="page-title pull-left">
               <h2 class="entry-title">Hotel Search Results</h2>
            </div>
            <ul class="breadcrumbs pull-right">
               <li><a href="#">HOME</a></li>
               <li class="active">Hotel Search Results</li>
            </ul>
         </div>
      </div>
      <section id="content">
         <div class="container">
            <div id="main">
               <div class="row">
                  <div class="col-sm-4 col-md-3">
                   
                     <h4 class="search-results-title"><i class="soap-icon-search"></i><b></b> Hotels found.</h4>
                     <div class="toggle-container filters-container">
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                           </h4>
                           <div id="price-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <div id="price-range"></div>
                                 <br />
                                 <span class="min-price-label pull-left"></span>
                                 <span class="max-price-label pull-right"></span>
                                 <div class="clearer"></div>
                              </div>
                              <!-- end content -->
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#rating-filter" class="collapsed">User Rating</a>
                           </h4>
                           <div id="rating-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <div id="rating" class="five-stars-container editable-rating"></div>
                                 <br />
                                 <small>2458 REVIEWS</small>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Accomodation Type</a>
                           </h4>
                           <div id="accomodation-type-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">All<small>(722)</small></a></li>
                                    <li><a href="#">Hotel<small>(982)</small></a></li>
                                    <li><a href="#">Resort<small>(127)</small></a></li>
                                    <li class="active"><a href="#">Bed &amp; Breakfast<small>(222)</small></a></li>
                                    <li><a href="#">Condo<small>(158)</small></a></li>
                                    <li><a href="#">Residence<small>(439)</small></a></li>
                                    <li><a href="#">Guest House<small>(52)</small></a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                           </h4>
                           <div id="amenities-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">Bathroom<small>(722)</small></a></li>
                                    <li><a href="#">Cable tv<small>(982)</small></a></li>
                                    <li class="active"><a href="#">air conditioning<small>(127)</small></a></li>
                                    <li class="active"><a href="#">mini bar<small>(222)</small></a></li>
                                    <li><a href="#">wi - fi<small>(158)</small></a></li>
                                    <li><a href="#">pets allowed<small>(439)</small></a></li>
                                    <li><a href="#">room service<small>(52)</small></a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#language-filter" class="collapsed">Host Language</a>
                           </h4>
                           <div id="language-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">English<small>(722)</small></a></li>
                                    <li><a href="#">Español<small>(982)</small></a></li>
                                    <li class="active"><a href="#">Português<small>(127)</small></a></li>
                                    <li class="active"><a href="#">Français<small>(222)</small></a></li>
                                    <li><a href="#">Suomi<small>(158)</small></a></li>
                                    <li><a href="#">Italiano<small>(439)</small></a></li>
                                    <li><a href="#">Sign Language<small>(52)</small></a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                           </h4>
                           <div id="modify-search-panel" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <form method="post">
                                    <div class="form-group">
                                       <label>destination</label>
                                       <input type="text" class="input-text full-width" placeholder="" value="Paris" />
                                    </div>
                                    <div class="form-group">
                                       <label>check in</label>
                                       <div class="datepicker-wrap">
                                          <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label>check out</label>
                                       <div class="datepicker-wrap">
                                          <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                       </div>
                                    </div>
                                    <br />
                                    <button class="btn-medium icon-check uppercase full-width">search again</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-8 col-md-9">
                    <div class="sort-by-section clearfix">
                        <h4 class="sort-by-title block-sm">Sort results by:</h4>
                        <ul class="sort-bar clearfix block-sm">
                           <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                           <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                           <li class="clearer visible-sms"></li>
                           <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                          <!--  <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li> -->
                        </ul>
                    </div>
                    
                    <div class="hotel-list listing-style3 hotel">
                       @if($ForezonHotels==True)
                            @foreach($ForezonHotels->Hotel as $key=>$hotel)
                           
                            <article class="box">
                                <figure class="col-sm-5 col-md-4">
                                    <a  title="" href="">
                                        <img style="width: 275px;height: 167px;" alt="" src=" {{$hotel->HOTEL_THUMB_IMAGE_FIELD}}">   
                                    </a>
                                    </figure>
                                <div class="details col-sm-7 col-md-8">
                                    <div>
                                        <div>
                                            <h4 class="box-title">
                                                    <a  title="" href="">
                                                        {{$hotel->HOTEL_NAME_FIELD}}
                                                    </a>
                                                <small>
                                                    <i class="soap-icon-departure yellow-color"></i> 
                                                   {{$hotel->HOTEL_CITY_NAME_FIELD}}, {{$hotel->HOTEL_COUNTRY_NAME_FIELD}}
                                                </small>
                                            </h4>
                                            @php
                                           
                                            @endphp
                                          
                                        </div>
                                        <div>
                                            <div class="five-stars-container">
                                            @if($hotel->HOTEL_STAR_RATING_FIELD == 5)
                                                <span class="five-stars" style="width: 100%;"></span>
                                            @elseif($hotel->HOTEL_STAR_RATING_FIELD == 4)   
                                                 <span class="five-stars" style="width: 80%;"></span>
                                             @elseif($hotel->HOTEL_STAR_RATING_FIELD == 3)   
                                                 <span class="five-stars" style="width: 60%;"></span>
                                             @elseif($hotel->HOTEL_STAR_RATING_FIELD == 2)   
                                                 <span class="five-stars" style="width: 40%;"></span>
                                             @elseif($hotel->HOTEL_STAR_RATING_FIELD == 1)   
                                                 <span class="five-stars" style="width: 20%;"></span>
                                            @endif
                                            </div>
                                            <span class="review">270 reviews</span>
                                        </div> 
                                    </div>
                                    <div>
                                        <p>{{$hotel->HOTEL_ADDRESS_FIELD}}</p>
                                        <div>
                                            <span class="price"><small>AVG/NIGHT</small>&#8377;{{$hotel->HOTEL_PRIMARY_PRICE_FIELD}} </span>
                                           <form method="POST" action="{{URL::to('/hotel-details')}}">
                                           {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$hotel->HOTEL_ID_FIELD}}" />
                                            <input type="hidden" name="room" value="{{serialize($hotel->ROOM_TABLE)}}" />
                                            <input type="hidden" name="hotelrequest" value="{{$hotelrequest}}" />
                                            <button type="submit" class="button btn-small full-width text-center">SELECT</button>
                                           </form>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </article>
                            @endforeach 
                            @endif

                            {{dump($xmlHubHotels)}}
                            @if(!isset($xmlHubHotels['Hotels']['Error']))
                            @foreach($xmlHubHotels['Hotels']['Hotel'] as $xmlhubData)
                                 <article class="box">
                                <figure class="col-sm-5 col-md-4">
                                    <a  title="" href="">
                                        <img style="width: 275px;height: 167px;" alt="" src=" {{$xmlhubData['ThumbImages']}}">   
                                    </a>
                                    </figure>
                                <div class="details col-sm-7 col-md-8">
                                    <div>
                                        <div>
                                            <h4 class="box-title">
                                                    <a  title="" href="">
                                                        {{$xmlhubData['Name']}}
                                                    </a>
                                                <small>
                                                    <i class="soap-icon-departure yellow-color"></i> 
                                                  
                                                </small>
                                            </h4>
                                            @php
                                           
                                            @endphp
                                          
                                        </div>
                                        <div>
                                            <div class="five-stars-container">
                                            @if($xmlhubData['Rating'] == 5)
                                                <span class="five-stars" style="width: 100%;"></span>
                                            @elseif($xmlhubData['Rating'] == 4)   
                                                 <span class="five-stars" style="width: 80%;"></span>
                                             @elseif($xmlhubData['Rating'] == 3)   
                                                 <span class="five-stars" style="width: 60%;"></span>
                                             @elseif($xmlhubData['Rating'] == 2)   
                                                 <span class="five-stars" style="width: 40%;"></span>
                                             @elseif($xmlhubData['Rating'] == 1)   
                                                 <span class="five-stars" style="width: 20%;"></span>
                                            @endif
                                            </div>
                                            <span class="review">270 reviews</span>
                                        </div> 
                                    </div>
                                    <div>
                                        <p>Not Available</p>
                                        <div>
                                            <span class="price"><small>AVG/NIGHT</small>&#8377;{{$xmlhubData['Price']}} </span>
                                           <form method="POST" action="{{URL::to('/hotel-details-xml')}}">
                                           {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$xmlhubData['Id']}}" />
                                            <input type="hidden" name="room" value="{{serialize($xmlhubData['RoomDetails'])}}" />
                                            <input type="hidden" name="hotelrequest" value="{{$hotelrequest}}" />
                                            <button type="submit" class="button btn-small full-width text-center">SELECT</button>
                                           </form>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </article>
                            @endforeach
                            @else
                              No Record Found  
                            @endif

                    </div>
                     <a href="#" class="uppercase full-width button btn-large">load more listing</a>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection