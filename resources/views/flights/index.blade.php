@extends('layouts.front.master')
@section('content')
 <div class="page-title-container">
         <div class="container">
            <div class="page-title pull-left">
               <h2 class="entry-title">Flight</h2>
            </div>
            <ul class="breadcrumbs pull-right">
               <li><a href="#">HOME</a></li>
               <li class="active">Flight</li>
            </ul>
         </div>
      </div>
      <section id="content">
         <div class="container">
            <div id="main">
               <div class="row">
                  <div class="col-sm-4 col-md-3">
                     <h4 class="search-results-title"><i class="fa fa-search" aria-hidden="true"></i><b>1,984</b> results found.</h4>
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
                              <a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Flight Times</a>
                           </h4>
                           <div id="flight-times-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <div id="flight-times" class="slider-color-yellow"></div>
                                 <br />
                                 <span class="start-time-label pull-left"></span>
                                 <span class="end-time-label pull-right"></span>
                                 <div class="clearer"></div>
                              </div>
                              <!-- end content -->
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Flight Stops</a>
                           </h4>
                           <div id="flight-stops-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">1 Stop</a></li>
                                    <li><a href="#">2 Stops</a></li>
                                    <li class="active"><a href="#">3 Stops</a></li>
                                    <li><a href="#">MultiStops</a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Airlines</a>
                           </h4>
                           <div id="airlines-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">Major Airline<small>($620)</small></a></li>
                                    <li><a href="#">United Airlines<small>($982)</small></a></li>
                                    <li class="active"><a href="#">delta airlines<small>($1,127)</small></a></li>
                                    <li><a href="#">Alitalia<small>($2,322)</small></a></li>
                                    <li><a href="#">US airways<small>($3,158)</small></a></li>
                                    <li><a href="#">Air France<small>($4,239)</small></a></li>
                                    <li><a href="#">Air tahiti nui<small>($5,872)</small></a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#flight-type-filter" class="collapsed">Flight Type</a>
                           </h4>
                           <div id="flight-type-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">First class</a></li>
                                    <li class="active"><a href="#">Economy</a></li>
                                    <li><a href="#">Premium Economy</a></li>
                                 </ul>
                                 <a class="button btn-mini">MORE</a>
                              </div>
                           </div>
                        </div>
                        <div class="panel style1 arrow-right">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#inflight-experience-filter" class="collapsed">Inflight Experience</a>
                           </h4>
                           <div id="inflight-experience-filter" class="panel-collapse collapse">
                              <div class="panel-content">
                                 <ul class="check-square filters-option">
                                    <li><a href="#">Inflight Dining</a></li>
                                    <li><a href="#">Music</a></li>
                                    <li class="active"><a href="#">Sky Shopping</a></li>
                                    <li><a href="#">Wi-fi</a></li>
                                    <li><a href="#">Seats &amp; Cabin</a></li>
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
                                       <label>Leaving from</label>
                                       <input type="text" class="input-text full-width" placeholder="" value="city, district, or specific airpot" />
                                    </div>
                                    <div class="form-group">
                                       <label>Departure on</label>
                                       <div class="datepicker-wrap">
                                          <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label>Arriving On</label>
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
                     <div class="sort-by-section clearfix box">
                        <h4 class="sort-by-title block-sm">Sort results by:</h4>
                        <ul class="sort-bar clearfix block-sm">
                           <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                           <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                           <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>duration</span></a></li>
                        </ul>
                     </div>
                     <div class="flight-list row image-box listing-style2 flight">
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                        <div class="col-sms-6 col-sm-6 col-md-4">
                           <article class="box">
                              <figure>
                                 <a href="#" data-post_id="192" class="hover-effect popup-gallery"><img src="http://www.soaptheme.net/wordpress/travelo/wp-content/uploads/2014/11/6-500x300.jpg" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="" draggable="false" width="500" height="300"></a>
                              </figure>
                              <div class="details">
                                 <a title="View all" href="flight-detailed.php" class="pull-right button uppercase">select</a>
                                 <h4 class="box-title"><a href="flight-detailed.php">Aqua Palace</a></h4>
                                 <label class="price-wrapper">
                                 <span class="price-per-unit">$300.00</span>avg/night</label>
                              </div>
                           </article>
                        </div>
                     </div>
                     <a class="button uppercase full-width btn-large">load more listings</a>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection