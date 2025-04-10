<?php $__env->startSection("custom_css_code"); ?>

<!-- create quote -->
<!-- tour-package -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/tour-package.css')); ?>" />

<!-- tour-price css -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/tour-price.css')); ?>" />

<!-- select2 css -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/select2-customized.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">

            <div class="modal-body_main">
              <!-- go back -->
              <a href="<?php echo e(URL::to('/tours')); ?>">
                <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</button>
              </a>
              <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add in Bulk</button>-->

              <!-- *************************************************** -->

              <!-- check the use of this modal -->
              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4>Choose a file to upload</h4>
                      <h3>Instructions</h3>
                      <div class="control-group" style="width: 24%;margin: 0 auto;">
                        <div class="controls">
                          <input id="filebutton" name="filebutton" class="input-file" type="file">
                        </div>
                      </div>
                      <br>
                      <div class="control-group">
                        <div class="controls">
                          <button id="singlebutton" name="singlebutton" class="btn btn-info">Upload</button>
                        </div>
                      </div>
                      <br>
                      <ol>
                        <li>To see format & possible values while uploading your deals, please <b><a href="#"> download format sheet</a></b> </li>
                        <li>Fill the details of your deals in excel sheet & save the excel sheet.</li>
                        <li>Click on <b>Browse</b> button & select the excel file.</li>
                        <li>Click on <b>Submit</b> to post your deals.</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- *************************************************** -->

            </div>
            <br>
            <br>
            <!-- ---------- -->
            <!-- <div id="content"> -->
            <div>
                  <?php if($errors->any()): ?>
                  <div class="alert alert-warning">
                    <ul>
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </ul>
                  </div>
                  <?php endif; ?>

                  <!-- create tour -->
                  <div class="col-md-12">
                    <!-- nav tabs -->
                    <ul class="nav nav-tabs makeflex mobscroll scrollX">
                        <!-- tour info -->
                        <li class="active"><a data-toggle="tab" href="#Info"><span class="glyphicon glyphicon-file"></span> Package Info</a></li>

                        <!-- tour description -->
                        <li><a data-toggle="tab" href="#Description"><span class="glyphicon glyphicon-th-list"></span> Description</a></li>
                        
                        <!-- inclusions and exclusions -->
                        <li><a data-toggle="tab" href="#Overview"><span class="glyphicon glyphicon-th-list"></span> Inclusions</a></li>
                        
                        <!-- flights -->
                        <li><a data-toggle="tab" href="#flights"><span class="glyphicon glyphicon-th-list"></span> Flights</a></li>
                        
                        <!-- accommodation -->
                        <li><a data-toggle="tab" href="#accommodation"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Accommodation</a></li>
                        
                        <!-- transfers -->
                        <li><a data-toggle="tab" href="#transfers"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Transfers</a></li>
                        
                        <!-- tour itinerary -->
                        <li><a data-toggle="tab" href="#Itinerary"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Tour Itinerary</a></li>
                        
                        <!-- tour pricing -->
                        <!-- <li><a data-toggle="tab" href="#Pricing"><i class="fa fa-inr" aria-hidden="true"></i> Pricing</a></li> -->
                        
                        <!-- tour new pricing -->
                         <li><a data-toggle="tab" href="#NewPricing"><i class="fa fa-inr" aria-hidden="true"></i> New Pricing</a></li>
                        
                        <!-- tour supplier -->
                        <li><a data-toggle="tab" href="#Supplier"><i class="fa fa-suitcase" aria-hidden="true"></i> Supplier</a></li>
                        
                        <!-- tour seo -->
                        <?php if(Sentinel::check()): ?>
                        <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                        <li><a data-toggle="tab" href="#meta"><i class="fa fa-database" aria-hidden="true"></i> SEO</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <!-- tour policies -->
                        <li><a data-toggle="tab" href="#policies"><span class="glyphicon glyphicon-th-list"></span> Policies</a></li>
                        
                        <!-- tour destination info -->
                        <li><a data-toggle="tab" href="#destination"><span class="glyphicon glyphicon-th-list"></span> Destination Info</a></li>
                        
                        <!-- similar tour packages -->
                        <li><a data-toggle="tab" href="#similar-tour"><span class="glyphicon glyphicon-th-list"></span> Similar Tour</a></li>
                        
                        <!-- book online -->
                        <li><a data-toggle="tab" href="#book-online"><span class="glyphicon glyphicon-th-list"></span> Live Mode</a></li>
                    </ul>

                    <form action="<?php echo e(URL::to('/store-package')); ?>" method="post" id="package-form">
                      <input type="hidden" name="type" value="Private Tour" />
                      <?php echo e(csrf_field()); ?>

                      <br>

                      <!-- tab content -->
                      <div class="tab-content">
                        <!-- tour info -->
                        <div id="Info" class="tab-pane fade in active">
                          <div class="panel-body">
                            <div class="item-container">
                              <div class="">
                                <div class="row">

                                  <!-- tour duration -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="duration">Tour Duration <span class="requiredcolor">&#42;</span></label>
                                      <select name="duration" id="package_durations" class="form-control val" required>
                                        <!-- Placeholder option -->
                                        <option value="" disabled selected>Select Duration</option>
                                        <?php for($i = 1; $i <= 30; $i++): ?>
                                          <option value="<?php echo e($i); ?>">                                              
                                              <?php echo e($i); ?> <?php echo e($i == 1 ? 'Night' : 'Nights'); ?> / <?php echo e($i + 1); ?> <?php echo e(($i + 1) == 1 ? 'Day' : 'Days'); ?>

                                          </option>
                                      <?php endfor; ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour title -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_name" class="field-required">Tour Title</label>
                                      <input type="text" placeholder="Enter tour name" value="<?php echo e(old('package_name')); ?>" name="package_name" class="form-control package_name" required>
                                      <span class="package_availibility"> </span>
                                    </div>
                                  </div>

                                  <!-- departure city -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="sourcecity" class="field-required">Tour Departure City</label>
                                      <select class="quote_city form-control" name="sourcecity" required></select>
                                    </div>
                                  </div>

                                  <!-- tour type -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="sourcecity" class="field-required">Tour Type</label>
                                      <select class="form-control" name="tour_type">
                                        <option selected disabled>Select tour type</option>
                                        <?php $__currentLoopData = $tourtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($tourtype->id); ?>"> <?php echo e($tourtype->tour_type); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour category -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="sourcecity" class="field-required">Tour Category</label>
                                      <select class="form-control" name="tour_category">
                                        <option selected disabled>Select category</option>
                                        <?php $__currentLoopData = $tourcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourcategory): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($tourcategory->id); ?>"> <?php echo e($tourcategory->tour_category); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour star rating -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Star Rating <i>(use to display hotel rating on frontend)</i></label>
                                      <select class="form-control" name="select_star_rating">
                                        <option>Select star rating</option>
                                        <option value="5 Star">5 Star</option>
                                        <option value="4 Star">4 Star</option>
                                        <option value="3 Star">3 Star</option>
                                        <option value="2 Star">2 Star</option>
                                        <option value="1 Star">1 Star</option>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- services included -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_service" class="field-required">Tour Services Included</label>
                                      <div class="input-group pdngBtm5">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                          <?php if(count($icons)>0): ?>
                                          <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($icon->icon_title); ?>"><?php echo e($icon->icon_title); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          <?php else: ?>
                                            <option value="No Result Found">No Result Found</option>
                                          <?php endif; ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- suitable for -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_service">Suitable for</label>
                                      <div class="input-group pdngBtm5">
                                        <span class="input-group-addon">
                                          <i class="fa fa-map-marker"></i>
                                        </span>
                                        <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                          <?php if(count($suitables)>0): ?>
                                          <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suit): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($suit->icon_title); ?>"><?php echo e($suit->icon_title); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          <?php else: ?>
                                            <option value="No Result Found">No Result Found</option>
                                          <?php endif; ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- general tag -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_service">General Tags</label>
                                      <div class="input-group pdngBtm5">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                          <?php if(count($generals)>0): ?>
                                          <?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($general->icon_title); ?>"><?php echo e($general->icon_title); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          <?php else: ?>
                                            <option value="No Result Found">No Result Found</option>
                                          <?php endif; ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- <div class="clearfix"></div> -->
                                  <!-- theme -->
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_category">Theme</label>
                                      <select name="package_category[]" id="package_category" class="select2 form-control" placeholder="Theme" multiple>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($typ->name); ?>"><?php echo e($typ->name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- holiday type -->
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="package_service">Holiday Type</label>
                                      <div class="input-group pdngBtm5">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                          <?php if(count($holidays)>0): ?>
                                          <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($holiday->icon_title); ?>"><?php echo e($holiday->icon_title); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          <?php else: ?>
                                          <option value="No Result Found">No Result Found</option>
                                          <?php endif; ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- city wise duration -->
                                <label for="">Duration By City</label>
                                <div class="col-md-12">
                                  <div class="row" id="dynamic_field_package">                                  
                                    <div class="item-container remove dfp dfp-1">

                                      <!-- continent -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="continent">Continent</label>
                                          <select name="continent[0]" id="continent" class="form-control">
                                            <?php 
                                              $continents = ['Asia', 'Africa', 'Antarctica', 'Australia', 'Europe', 'North America', 'South America'];
                                             ?>

                                            <?php $__currentLoopData = $continents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($cont); ?>"><?php echo e($cont); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- country -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="country" class="field-required">Country</label>
                                          <select name="country[0]" id="package_dest_countries" class="form-control package_dest_country" onchange="selectCountry(this)">
                                            <option value='0'>Select Country</option>
                                            <?php if(isset($countries) && count($countries) > 0): ?>
                                              <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                  <?php if(isset($cont->name)): ?>
                                                    <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?></option>
                                                  <?php endif; ?>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <?php endif; ?>

                                          </select>
                                        </div>
                                      </div>

                                      <!-- state -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="state" class="field-required">State</label>
                                          <select name="state[0]" id="package_dest_state" class="form-control package_dest_countries" onchange="selectState(this)"></select>
                                        </div>
                                      </div>

                                      <!-- city -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">City</label>
                                          <select name="city[0]" id="package_dest_city" class="package_dest_cities form-control package_dest_state city_package_dest_countries min-select" onchange="selectCity(this)"></select>
                                        </div>
                                      </div>

                                      <!-- duration city wise -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">Duration</label>
                                          <select name="days[0]" id="package_dest_days" class="form-control package_dest_days ">
                                          </select>
                                        </div>
                                      </div>
                                      <!-- <div class="col-md-2 form-group"></div> -->
                                    </div>
                                  </div>
                                </div>

                                <!-- add more city & duration -->
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <button type="button" name="add-continent" id="add-continent-row" class="btn btn-success">(+) Add more city
                                        <!-- more content added from add-continent-row function package.js -->
                                      </button>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour description -->
                        <div id="Description" class="tab-pane fade">
                          <!-- <div class="tab-title">Tour Description</div> -->
                          <div class="panel-body">
                            <div class="row">

                              <!-- tour description -->
                              <div class="col-md-12 collapsable-form">
                                <div class="form-group item-container custom_inc_exc">
                                  <label class="collapse-toggle">Tour Description</label>
                                  <br><br>
                                  <span class="show_hide morePlus">More+</span>
                                  <textarea class="form-control ckeditor collapse-item" name="description" cols="30" rows="5"><?php echo e(old('description')); ?></textarea>
                                </div>
                              </div>

                              <!-- tour highlights -->
                              <div class="col-md-12">
                                <div class="form-group item-container custom_inc_exc">
                                  <label class="collapse-toggle">Tour Highlights</label>
                                  <br><br>
                                  <span class="show_hide morePlus">More+</span>
                                  <textarea class="form-control ckeditor collapse-item" name="highlights" id="" cols="30" rows="5"><?php echo e(old('highlights')); ?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour inclusions and exclusions -->
                        <div id="Overview" class="tab-pane fade ">
                          <div class="panel-body">

                            <div class="col-md-12 item-container">
                              <div class="row">

                                <!-- hotel star rating -->
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label class="field-required">Star Rating <span class="color74">(The highest star rating hotel featured in this tour)</span></label>
                                    <select class="form-control" name="customer_rating">
                                      <option value="1">1 Star</option>
                                      <option value="2">2 Star</option>
                                      <option value="3">3 Star</option>
                                      <option value="4" selected>4 Star</option>
                                      <option value="5">5 Star</option>
                                      <option value="7">7 Star</option>
                                    </select>
                                  </div>
                                </div>

                                <!-- tour sightseeing -->
                                <div class="col-md-7">
                                  <div class="form-group select-container">
                                    <label>Tour Sightseeing</label>
                                    <select class='select2 form-control' name="tours[]" multiple id="tour_add">
                                    </select>
                                  </div>
                                </div>

                                <!-- add new sightseeing -->
                                <!-- <div class="custom_tour_parent"> -->
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <div class="custom_tour_parent">
                                      <button data-toggle="modal" data-target="#packagetour_custom" type="button" class="btn-success btn-sm custom_tour appendTop20">Add new sightseeing</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- separator -->
                                <!-- <div class="col-md-12">
                                  <hr>
                                </div> -->
                              </div>
                            </div>

                            <div class="row">
                              <!-- tour inclusions -->
                              <div class="col-md-12 custom_inc_exc">
                                  <div class="form-group item-container">
                                    <label>Tour Inclusions</label>
                                     <select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
                                      <?php $__currentLoopData = $inclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                    <br>
                                    <span class="show_hide morePlus">More+</span>
                                    <textarea class="form-control ckeditor" name="inclusions" id="" cols="30" rows="5"><?php echo e(old('inclusions')); ?></textarea>
                                  </div>
                              </div>

                              <!-- tour exclusions -->
                              <div class="col-md-12 custom_inc_exc">
                                  <div class="form-group item-container">
                                    <label>Tour Exclusions</label>
                                    <select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
                                      <?php $__currentLoopData = $exclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                    <br>
                                    <span class="show_hide morePlus">More+</span>
                                    <textarea class="form-control ckeditor" name="exclusions" id="" cols="30" rows="5"><?php echo e(old('exclusions')); ?></textarea>
                                  </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>

                        <!-- tour flights -->
                        <div id="flights" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="flightOption">
                                    <label for="flightOption">Add Flight</label>
                                    <input type="checkbox"  name="flight[flightOption]" id="show_flight_options" value="1">
                                  </div>
                                </div>

                                <!-- onwards flight -->
                                <div class="col-md-12 flight">
                                  <div class="item-container">
                                    <div class="row">

                                      <!--Onward Flight-->
                                      <div class="col-md-12">
                                        <div class="flightOption">
                                          <label for="onward_required">Onward Flight Required?</label>
                                          <input type="checkbox" name="flight[onward_required]" id="onward_required" value="1" checked>
                                        </div>
                                      </div>

                                      <!--Onward Flight Details-->
                                      <div class="onwardflight">
                                        <div class="col-md-12 appendBottom10">
                                          <p class="flightBoxHeading">ONWARD FLIGHT</p>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Onward Date</label>
                                          <input type="text" name="flight[onwarddate]" class="form-control departure_date" placeholder="Select departure date">
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Airline Name</label>
                                          <select name="flight[name]" class="form-control flight_name">
                                            <option value="0">Select Airline</option>
                                            <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($airline->airline_name); ?>"><?php echo e($airline->airline_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Flight No.</label>
                                          <input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333">
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>No. Of Stop</label>
                                          <select name="flight[numberstop]" class="form-control">
                                            <option value="0">Select Stops</option>
                                            <option value="Non-Stop" selected>Non-Stop</option>
                                            <?php for($i = 1; $i <= 4; $i++): ?>
                                            <?php if($i==1): ?>
                                              <option value="<?php echo e($i); ?> Stop"><?php echo e($i); ?> Stop</option>
                                            <?php else: ?>
                                              <option value="<?php echo e($i); ?> Stops"><?php echo e($i); ?> Stops</option>
                                            <?php endif; ?>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Flight Origin</label>
                                          <select name="flight[origin]" class="form-control origin">
                                            <option value="0">Select Origin</option>
                                            <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php
                                              $val=$iata->iata_name.' '.'('.$iata->iata_code.')';
                                            ?>
                                            <option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Departure Time</label>
                                          <div class="clearfix"></div>
                                            <select name="flight[dhours]" class="form-control dhours" style="max-width: 49%;display: inline-block;">
                                              <option value="0">Hours</option>
                                              <?php for($i = 1; $i <= 24; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                              <?php endfor; ?>
                                            </select>

                                            <select name="flight[dmins]" class="form-control dmins" style="max-width: 49%;display: inline-block;">
                                              <option value="0">Minutes</option>
                                              <!-- <option value="0">00</option>
                                              <?php for($i=1; $i<=59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                              <?php endfor; ?> -->
                                              <?php for($i = 0; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                              <?php endfor; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Destination</label>
                                          <select name="flight[dest]" class="form-control dest">
                                            <option value="0">Select Destination</option>
                                            <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                            <option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Arrival Time</label>
                                          <div class="clearfix"></div>
                                          <select name="flight[ahours]" class="form-control ahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                            <option value="0">Hours</option>
                                            <?php for($i = 1; $i <= 24; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                            <?php endfor; ?>;
                                          </select>

                                          <select name="flight[amins]" class="form-control amins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                            <option value="0">Minutes</option>
                                            <!-- <option value="0">00</option>
                                            <?php for($i = 1; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?> -->
                                            <?php for($i = 0; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                            <?php endfor; ?>
                                          </select>

                                          <select name="flight[adayplus]" class="form-control adayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                            <option value="0">+0 Day</option>
                                            <option value="1">+1 Day</option>
                                            <option value="2">+2 Day</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Cabin Class</label>
                                          <select name="flight[cabin]" class="form-control">
                                            <option value="economyclass">Economy</option>
                                            <option value="premiumeconomyclass">Premium Economy</option>
                                            <option value="businessclass">Business</option>
                                            <option value="firstclass">First</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Fare Type</label>
                                          <select name="flight[faretype]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="refundable" selected>Refundable</option>
                                            <option value="partialrefundable">Partial-refundable</option>
                                            <option value="non-refundable">Non-refundable</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Flight Duration</label>
                                          <div class="clearfix"></div>
                                            <select name="flight[duration_hours]" class="form-control duration_hours" style="max-width: 49%;display: inline-block;">
                                              <!-- <option value="0">Hours</option>
                                              <?php for($i = 1; $i <= 72; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> hrs </option>
                                              <?php endfor; ?> -->
                                              <option value="" selected disabled>Hours</option>
                                              <?php for($i = 1; $i <= 40; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?></option>
                                              <?php endfor; ?>
                                            </select>
                                            <select name="flight[duration_dmins]" class="form-control duration_min" style="max-width: 49%;display: inline-block;">
                                              <!-- <option value="0">Minutes</option>
                                              <option value="0">00</option>
                                              <?php for($i = 1; $i <= 59; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> mins</option>
                                              <?php endfor; ?> -->
                                              <option value="" selected disabled>Minutes</option>
                                              <?php for($i = 0; $i <= 59; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
                                              <?php endfor; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 apndBtm20">
                                          <div class="makeflex">
                                            <!-- cabin baggage -->
                                            <div class="flexOne">
                                              <label>Cabin Baggage</label>
                                              <select class="form-control" name="flight[baggage]">
                                                <option selected disabled>Cabin Bag</option>
                                                <option value="0 Kg">0 Kg</option>
                                                <option value="5 Kgs">5 Kgs</option>
                                                <option value="7 Kgs">7 Kgs</option>
                                                <option value="8 Kgs">8 Kgs</option>
                                              </select>
                                            </div>

                                            <!-- check-in baggage -->
                                            <div class="flexOne">
                                              <label>Check-In Baggage</label>
                                              <select class="form-control" name="flight[cbaggage]">
                                                <option selected disabled>Check-In Bag</option>
                                                <option value="0 Kg">0 Kg</option>
                                                <option value="10 Kgs">10 Kgs</option>
                                                <option value="15 Kgs">15 Kgs</option>
                                                <option value="20 Kgs">20 Kgs</option>
                                                <option value="23 Kgs">23 Kgs</option>
                                                <option value="25 Kgs">25 Kgs</option>
                                                <option value="30 Kgs">30 Kgs</option>
                                                <option value="35 Kgs">35 Kgs</option>
                                                <option value="40 Kgs">40 Kgs</option>
                                                <option value="45 Kgs">45 Kgs</option>
                                                <option value="50 Kgs">50 Kgs</option>
                                                <option value="55 Kgs">55 Kgs</option>
                                                <option value="60 Kgs">60 Kgs</option>
                                                <option value="1 Piece">1 Piece</option>
                                                <option value="2 Pieces">2 Pieces</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>

                                  <!--Return Flight-->
                                  <div class="item-container">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="flightOption">
                                          <label for="return_required">Return Flight Required?</label>
                                          <input type="checkbox"  name="flight[return_required]"  id="return_required" value="1" checked>
                                        </div>
                                      </div>

                                      <!--Return Flight Details-->
                                      <div class="returnflight">
                                        <div class="col-md-12 appendBottom10">
                                          <p class="flightBoxHeading">RETURN FLIGHT</p>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Return Date</label>
                                          <input type="text" name="flight[downwarddate]" class="form-control return_date" placeholder="Select return date">
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Airline Name</label>
                                          <select name="flight[dname]" class="form-control down_filght">
                                            <option value="0">Select Airline</option>
                                            <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($airline->airline_name); ?>"><?php echo e($airline->airline_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Flight No.</label>
                                          <input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334">
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>No. Of Stop</label>
                                          <select name="flight[dnumberstop]" class="form-control">
                                            <option value="0">Select Stopover</option>
                                            <option value="Non-Stop" selected>Non-Stop</option>
                                            <?php for($i = 1; $i <= 4; $i++): ?>
                                            <?php if($i==1): ?>
                                              <option value="<?php echo e($i); ?> Stop"><?php echo e($i); ?> Stop</option>
                                            <?php else: ?>
                                              <option value="<?php echo e($i); ?> Stops"><?php echo e($i); ?> Stops</option>
                                            <?php endif; ?>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Flight Origin</label>
                                          <select name="flight[dOrigin]" class="form-control down_origin">
                                            <option value="0">Select Origin</option>
                                            <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                            <option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Departure Time</label>
                                          <div class="clearfix"></div>
                                          <select name="flight[ddhours]" class="form-control ddhours" style="max-width: 49%;display: inline-block;">
                                            <!-- <option value="0">Hours</option>
                                            <?php for($i=1;$i<=24;$i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Hours</option>
                                            <?php for($i=1; $i<=24; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                            <?php endfor; ?>
                                          </select>
                                          <select name="flight[ddmins]" class="form-control ddmins" style="max-width: 49%;display: inline-block;">
                                            <!-- <option value="0">Minutes</option>
                                            <option value="0">00</option>
                                            <?php for($i=1; $i<=59; $i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Minutes</option>
                                            <?php for($i = 0; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Destination</label>
                                          <select name="flight[ddest]" class="form-control down_dest">
                                            <option value="0">Select Destination</option>
                                            <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                              <option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Arrival Time</label>
                                          <div class="clearfix"></div>
                                          <select name="flight[dahours]" class="form-control dahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                            <!-- <option value="0">Hours</option>
                                            <?php for($i=1;$i<=24;$i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Hours</option>
                                            <?php for($i=1; $i<=24; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                            <?php endfor; ?>
                                          </select>

                                          <select name="flight[damins]" class="form-control damins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                            <!-- <option value="0">Minutes</option>
                                            <option value="0">00</option>
                                            <?php for($i=1; $i<=59; $i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Minutes</option>
                                            <?php for($i = 0; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                            <?php endfor; ?>
                                          </select>

                                          <select name="flight[dadayplus]" class="form-control dadayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                            <option value="0">+ 0Day</option>
                                            <option value="1">+1</option>
                                            <option value="2">+2</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3">
                                          <label>Cabin Class</label>
                                          <select name="flight[dcabin]" class="form-control">
                                            <option value="economyclass">Economy</option>
                                            <option value="premiumeconomyclass">Premium Economy</option>
                                            <option value="businessclass">Business</option>
                                            <option value="firstclass">First</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3 appendBottom20">
                                          <label>Fare Type</label>
                                          <select name="flight[dfaretype]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="refundable" selected>Refundable</option>
                                            <option value="partialrefundable">Partial-refundable</option>
                                            <option value="non-refundable">Non-refundable</option>
                                          </select>
                                        </div>

                                        <div class="col-md-3">
                                          <label>Flight Duration</label>
                                          <div class="clearfix"></div>
                                          <select name="flight[return_duration_hours]" class="form-control return_duration_hours" style="max-width: 49%;display: inline-block;">
                                            <!-- <option value="0">Hours</option>
                                            <?php for($i=1;$i<=72;$i++): ?>
                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?> hrs</option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Hours</option>
                                            <?php for($i = 1; $i <= 40; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?></option>
                                            <?php endfor; ?>
                                          </select>

                                          <select name="flight[return_duration_mins]" class="form-control return_duration_min" style="max-width: 49%;display: inline-block;">
                                            <!-- <option value="0">Minutes</option>
                                            <option value="0">00</option>
                                            <?php for($i=1; $i<=59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?> mins</option>
                                            <?php endfor; ?> -->
                                            <option value="" selected disabled>Minutes</option>
                                            <?php for($i = 0; $i <= 59; $i++): ?>
                                              <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3 apndBtm20">
                                          <div class="makeflex">
                                            <!-- cabin baggage -->
                                            <div class="flexOne">
                                              <label>Cabin Baggage</label>
                                              <select class="form-control" name="flight[dbaggage]">
                                                <option selected disabled>Cabin Bag</option>
                                                <option value="0 Kg">0 Kg</option>
                                                <option value="5 Kgs">5 Kgs</option>
                                                <option value="7 Kgs">7 Kgs</option>
                                                <option value="8 Kgs">8 Kgs</option>
                                              </select>
                                            </div>

                                            <!-- check-in baggage -->
                                            <div class="flexOne">
                                              <label>Check-In Baggage</label>
                                              <select class="form-control" name="flight[dcbaggage]">
                                                <option selected disabled>Check-In Bag</option>
                                                <option value="0 Kg">0 Kg</option>
                                                <option value="10 Kgs">10 Kgs</option>
                                                <option value="15 Kgs">15 Kgs</option>
                                                <option value="20 Kgs">20 Kgs</option>
                                                <option value="23 Kgs">23 Kgs</option>
                                                <option value="25 Kgs">25 Kgs</option>
                                                <option value="30 Kgs">30 Kgs</option>
                                                <option value="35 Kgs">35 Kgs</option>
                                                <option value="40 Kgs">40 Kgs</option>
                                                <option value="45 Kgs">45 Kgs</option>
                                                <option value="50 Kgs">50 Kgs</option>
                                                <option value="55 Kgs">55 Kgs</option>
                                                <option value="60 Kgs">60 Kgs</option>
                                                <option value="1 Piece">1 Piece</option>
                                                <option value="2 Pieces">2 Pieces</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour accommodation -->
                        <div id="accommodation" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="row">

                              <!-- accommodation type -->
                              <div class="col-md-12 form-group">
                                <!-- listed hotel -->
                                <label for="listed_hotel" class="select-hotel-type">
                                  <input type="radio" id="listed_hotel" name="acc_type" class="extra_acc" value="normal_acc">Add Listed Hotel
                                </label>

                                <!-- unlisted hotel -->
                                <label class="select-hotel-type">
                                  <input type="radio" name="acc_type" class="extra_acc" value="extra_acc">Add Unlisted Hotel
                                </label>

                                <!-- hide hotel -->
                                <label class="select-hotel-type">
                                  <input type="radio" name="acc_type" class="extra_acc" value="hide_acc" checked>Hide Hotel&nbsp;<i>(Not visible on the frontend)</i>
                                </label>
                              </div>

                              <!-- content -->
                              <div class="col-md-12">
                                <!-- listed accommodation content -->
                                <div class="accommodation_main">
                                  <div class="dynamic_acc" id="ddd">
                                    <input type="hidden" name="" value="">
                                    <div class="item-container field0" id="0">
                                      <div class="row">

                                        <!-- select nights -->
                                        <!-- <div class="col-md-6 relativeCont">
                                          <div class="form-group daysel">
                                            <label class="field-required">Select Duration</label>
                                            <label class="label-duration">Select all<input type="checkbox" class="all_days_selection"></label>
                                            <select class="form-control select_day select2" name="accommodation[0][night][]" multiple>
                                              !-- populating from package.js toggleSelectDurationButton --
                                            </select>
                                          </div>
                                        </div> -->

                                        <div class="col-md-6 relativeCont appendBottom10">
                                          <div class="form-group daysel">
                                            <label class="field-required">Select Duration</label>

                                            <!-- "Select All" Checkbox -->
                                            <label class="label-duration">
                                              Select all
                                              <input type="checkbox" class="select_complete_duration">
                                            </label>

                                            <!-- Multi-Select Dropdown -->
                                            <select class="form-control select_day select2" name="accommodation_add[<?php echo e($j ?? 0); ?>][night][]" multiple>
                                              <!-- Options will be populated dynamically -->
                                            </select>
                                          </div>
                                        </div>

                                        <!-- city -->
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label class="field-required">City</label>
                                            <select class="quote_city form-control" name="accommodation[0][city]"></select>
                                            <!-- <input type="text" name="accommodation[0][city]" class="form-control query_city" placeholder="City"> -->
                                          </div>
                                        </div>

                                        <!-- hotel type -->
                                        <div class="col-md-3 propertytype_class">
                                          <div class="form-group">
                                            <label class="field-required">Hotel Type</label>
                                            <select class="form-control propertytype" name="accommodation[0][propertytype]" id="propertytype">
                                                <option selected disabled>Select</option>
                                                <option value="hotel">Hotel</option>
                                                <option value="resort">Resort</option>
                                                <option value="villa">Villa</option>
                                                <option value="home">Home</option>
                                                <option value="camp">Camp</option>
                                                <option value="cruise">Cruise</option>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-md-12"></div>

                                        <!-- hotel source -->
                                        <div class="col-md-4 form-group propertysource_class">
                                          <label class="field-required">Hotel Source</label>
                                          <select class="form-control propertysource" name="accommodation[0][trip]" id="propertysource">
                                            <option selected disabled>Select</option>
                                            <option value="packagehoteldatabase">Package Hotel Database</option>
                                            <option value="hoteldatabase">Hotel Database</option>
                                            <option value="tripadvisor">TripAdvisor</option>
                                            <option value="manual">Manual</option>
                                          </select>
                                        </div>

                                        <!-- select hotel name -->
                                        <div class="col-md-4 form-group selectproperty" id="selectproperty" style="display: none">
                                          <label class="field-required">Hotel Name</label>
                                          <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                            <option value='0' selected='true' disabled='disabled'>Select</option>
                                            <!--<option value="other">Unlisted Property</option>-->
                                          </select>
                                        </div>

                                        <!-- select hotel star rating -->
                                        <div class="col-md-4 form-group selectpropertystar" id="selectpropertystar" style="display: none">
                                          <label class="field-required">Hotel Star Rating</label>
                                          <select class="form-control selectpropertystar_value" name="accommodation[0][star]">
                                            <option selected disabled>Select</option>
                                            <option value="1">1 star</option>
                                            <option value="2">2 star</option>
                                            <option value="3">3 star</option>
                                            <option value="4">4 star</option>
                                            <option value="5">5 star</option>
                                            <!--<option value="other">Other</option>-->
                                          </select>
                                        </div>

                                        <!-- enter hotel name -->
                                        <div class="col-md-4 form-group propertyname" id="propertyname" style="display: none">
                                          <label class="field-required">Enter Hotel Name</label>
                                          <input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
                                        </div>

                                        <!-- select hotel star rating -->
                                        <div class="col-md-4 form-group selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
                                          <label class="field-required">Hotel Star Rating</label>
                                          <!--<input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Enter hotel star rating">-->
                                          <select class="form-control" name="accommodation[0][star_other]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='1'>1 star</option>
                                            <option value='2'>2 star</option>
                                            <option value='3'>3 star</option>
                                            <option value='4'>4 star</option>
                                            <option value='5'>5 star</option>
                                          </select>
                                        </div>

                                        <div class="col-md-12"></div>

                                        <!-- room type -->
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label class="field-required">Room Type</label>
                                            <input type="text" class="form-control" name="accommodation[0][category]" placeholder="Enter room type">
                                          </div>
                                        </div>

                                        <!-- hotel website -->
                                        <div class="col-md-4 form-group hotel_link_class">
                                          <label>Hotel Website</label>
                                          <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
                                        </div>

                                        <!-- hotel contact no -->
                                        <div class="col-md-4 form-group hotel_contact_class">
                                          <label>Hotel Contact No</label>
                                          <input type="text" class="form-control hotel_contact" placeholder="Enter hotel contact no" name="accommodation[0][contact]">
                                        </div>

                                        <!-- meals -->
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label>Meals</label>
                                            <select class="form-control accommodationMeals" name="accommodation[0][meals]" id="">
                                              <option selected disabled>Select</option>
                                              <option value='Room Only'>Room Only</option>
                                              <option value='Breakfast'>Breakfast</option>
                                              <option value='Half Board'>Half Board</option>
                                              <option value='Full Board'>Full Board</option>
                                            </select>
                                          </div>
                                        </div>

                                        <!-- hotel price type -->
                                        <div class="col-md-4" >
                                          <label>Hotel Price Type</label>
                                          <select class="form-control accommodationFareType" name="accommodation[0][faretype]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Refundable'>Refundable</option>
                                            <option value='Non-refundable'>Non-refundable</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4"></div>

                                      </div>
                                    </div>
                                  </div>

                                  <!-- add more hotel -->
                                  <div class="row">
                                    <div class="col-md-12">
                                      <!-- <button type="button" name="add" id="add_acco_tours" days="" class="btn btn-success">(+) Add more hotel</button> -->
                                      <button type="button" name="add" id="add_acco" days="" class="btn btn-success">(+) Add more hotel</button>
                                    </div>
                                  </div>

                                </div>

                                <!-- unlisted accommodation content -->
                                <div class="accommodation_extra item-container" style="display: none;">
                                  <!-- <div class="row">
                                    <div class="col-md-12">
                                      <h4>Unlisted Hotels</h4>
                                    </div>
                                  </div> -->
                                  <label class="field-required">Unlisted Hotel details</label>
                                  <textarea class="form-control ckeditor" rows="3" name="accommodation_extra"></textarea>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour transfers -->
                        <div id="transfers" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="row">
                              <div class="">
                              <div class="col-md-12 transfers_input_wrapper">
                                <div class="transfers_input" id="transfers_input-0" data-id="0">
                                  <input type="hidden" name="" value="">

                                  <div class="item-container field-0" id="0">
                                    <div class="row">

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label class="field-required">Transfer Title</label>
                                        <input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label class="field-required">Transfer Type</label>
                                        <select name="transfers[0][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
                                          <option value="">Select</option>
                                          <option value="Car">Car</option>
                                          <option value="Bus">Bus</option>
                                          <option value="Train">Train</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label class="field-required">Select Transfers</label>
                                        <select name="transfers[0][transfers_type]" id="transfers_type0" class="form-control transfers_type">
                                          <?php /*<option value="0">--Select Transfers--</option>
                                          @foreach($transfers->unique('transfer_type') as $transfer)
                                          <option value="{{$transfer->title}}">{{$transfer->title}} </option>
                                          @endforeach*/ ?>
                                          <option value="0">Select</option>
                                        </select>
                                      </div>
                                    </div>
                                    
                                    </div>
                                  </div>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">(+) Add more transfers</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour itinerary -->
                        <div id="Itinerary" class="tab-pane fade">
                          <div class="panel-body c_body">
                            <div class="item-container">
                              <div class="row">
                                <div class="table-responsive">
                                  <div class="col-md-12 dayItinerary day1">
                                    <div class="row">

                                      <!-- day title -->
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="field-required">DAY 1</label>
                                          <input type="text" class="form-control" name="dayItinerary[day1][title]" placeholder="Enter day title">
                                        </div>
                                      </div>

                                      <!-- tour activity -->
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Tour Activity</label>
                                          <select class='select2 form-control dayItineraryactivity' name="dayItinerary[day1][activities][]" multiple>
                                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($activity->activity); ?>"><?php echo e($activity->activity); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- meal plan -->
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Meal Plan (in hotel)</label>
                                          <select name="dayItinerary[day1][meal_plan]" class="form-control">
                                            <option value="N">No Meal</option>
                                            <option value="EP">Room Only</option>
                                            <option value="CP" selected>Breakfast</option>
                                            <option value="lu">Lunch</option>
                                            <option value="di">Dinner</option>
                                            <option value="bd">Breakfast & Dinner</option>
                                            <option value="bl">Breakfast & Lunch</option>
                                            <option value="ld">Lunch & Dinner</option>
                                            <option value="bld">Breakfast & Lunch/Dinner</option>
                                            <option value="bldall">Breakfast, Lunch & Dinner</option>
                                            <option value="apai">All Inclusive</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- tour sightseeing -->
                                      <div class="col-md-4">
                                        <div class=" form-group ">
                                          <label>Tour Sightseeing</label>
                                          <select class='select2 form-control dayItinerarytour custom_days' name="dayItinerary[day1][tours][]" multiple>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- tour day plan -->
                                      <div class="col-md-12 custom_inc_exc">
                                        <div class="form-group">
                                          <label>Day Plan</label>
                                          <br>
                                          <span class="show_hide morePlus">More+</span>
                                          <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day1][desc]"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- -------------------------------------------- -->

                        <!-- tour pricing (not in use) -->
                        <div id="Pricing" class="tab-pane fade" style="display: none;">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Is On Request?</label>
                                  <input type="checkbox" value="1" name="onrequest" id="onrequest" checked />
                                  <label for="" style="margin-left: 25px">Upcoming Package?</label>
                                  <input type="checkbox" value="1" name="upcoming" id="upcoming" checked />
                                </div>
                                <!---->
                                <div class="form-group pricelistpackage" style="display:none;">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">
                                      <tr>
                                        <th>Price title</th>
                                        <th>Price type</th>
                                        <th>Confirmation Type</th>
                                        <th>
                                          <!--<select name="Price_type" class="form-control">
                                            <option value="0">Select Type </option>
                                            <option value="Per Person">Per Person </option>
                                            <option value="Per Group">Per Group</option>
                                          </select>-->
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <td><input name="Price_title" placeholder="Title.." class="form-control" type="text" value="<?php echo e(old('Price_title')); ?>"></td>
                                        <td>
                                          <select name="Price_type" class="form-control">
                                            <option value="0">Select Type </option>
                                            <option value="Per Person">Per Person </option>
                                            <option value="Per Group">Per Group</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="confirmation_type" class="form-control">
                                            <option value="0">Select Type </option>
                                            <option value="Instant Confirmation">Instant Confirmation</option>
                                            <option value="Confirmation in 24-48 hrs">Confirmation in 24-48 hrs</option>
                                            <option value="On-Request">On-Request</option>
                                          </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <th>Category</th>
                                        <th>Price from</th>
                                        <th>Price to</th>
                                        <th>Cut Off Point</th>
                                      </tr>
                                      <tr id="row1">
                                        <td>
                                          <select name="Price[0][package_rating]" id="rating" class="form-control rating-field" style="width: 40%;display:inline-block">
                                            <?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value='<?php echo e($rtyp->id); ?>'><?php echo e($rtyp->name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="other">Other</option>
                                          </select>
                                          <input name="Price[0][package_rating_other]" id="otherrating" class="form-control other-rating" style="width: 50%;display:none">
                                        </td>
                                        <td>
                                          <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="Price[0][datefrom]" class="form-control pull-right datepicker" type="text">
                                          </div>
                                        </td>
                                        <td>
                                          <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="Price[0][dateto]" class="form-control pull-right datepicker" type="text">
                                          </div>
                                        </td>
                                        <td>
                                          <input type="number" value="0" name="Price[0][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days">
                                        </td>
                                        <td>
                                          <div class="c_price0" id="c_price0">
                                            <input type="hidden" name="Price[0][airfare_adult]" value="" class="air_fare_adult">
                                            <input type="hidden" name="Price[0][airfare_exadult]" value="" class="air_fare_exadult">
                                            <input type="hidden" name="Price[0][airfare_childbed]" value="" class="air_fare_childbed">
                                            <input type="hidden" name="Price[0][airfare_childwbed]" value="" class="air_fare_childwbed">
                                            <input type="hidden" name="Price[0][airfare_infant]" value="" class="air_fare_infant">
                                            <input type="hidden" name="Price[0][airfare_single]" value="" class="air_fare_single">
                                            <input type="hidden" name="Price[0][aircurrency]" value="" class="air_currency">
                                            <!---->
                                            <input type="hidden" name="Price[0][hotelfare_adult]" value="" class="hotel_fare_adult">
                                            <input type="hidden" name="Price[0][hotelfare_exadult]" value="" class="hotel_fare_exadult">
                                            <input type="hidden" name="Price[0][hotelfare_childbed]" value="" class="hotel_fare_childbed">
                                            <input type="hidden" name="Price[0][hotelfare_childwbed]" value="" class="hotel_fare_childwbed">
                                            <input type="hidden" name="Price[0][hotelfare_infant]" value="" class="hotel_fare_infant">
                                            <input type="hidden" name="Price[0][hotelfare_single]" value="" class="hotel_fare_single">
                                            <input type="hidden" name="Price[0][hotelcurrency]" value="" class="hotel_currency">
                                            <!---->
                                            <input type="hidden" name="Price[0][tourfare_adult]" value="" class="tour_fare_adult">
                                            <input type="hidden" name="Price[0][tourfare_exadult]" value="" class="tour_fare_exadult">
                                            <input type="hidden" name="Price[0][tourfare_childbed]" value="" class="tour_fare_childbed">
                                            <input type="hidden" name="Price[0][tourfare_childwbed]" value="" class="tour_fare_childwbed">
                                            <input type="hidden" name="Price[0][tourfare_infant]" value="" class="tour_fare_infant">
                                            <input type="hidden" name="Price[0][tourfare_single]" value="" class="tour_fare_single">
                                            <input type="hidden" name="Price[0][tourcurrency]" value="" class="tour_currency">
                                            <!---->
                                            <input type="hidden" name="Price[0][transferfare_adult]" value="" class="transfer_fare_adult">
                                            <input type="hidden" name="Price[0][transferfare_exadult]" value="" class="transfer_fare_exadult">
                                            <input type="hidden" name="Price[0][transferfare_childbed]" value="" class="transfer_fare_childbed">
                                            <input type="hidden" name="Price[0][transferfare_childwbed]" value="" class="transfer_fare_childwbed">
                                            <input type="hidden" name="Price[0][transferfare_infant]" value="" class="transfer_fare_infant">
                                            <input type="hidden" name="Price[0][transferfare_single]" value="" class="transfer_fare_single">
                                            <input type="hidden" name="Price[0][transfercurrency]" value="" class="transfer_currency">
                                            <!---->
                                            <input type="hidden" name="Price[0][visafare_adult]" value="" class="visa_fare_adult">
                                            <input type="hidden" name="Price[0][visafare_exadult]" value="" class="visa_fare_exadult">
                                            <input type="hidden" name="Price[0][visafare_childbed]" value="" class="visa_fare_childbed">
                                            <input type="hidden" name="Price[0][visafare_childwbed]" value="" class="visa_fare_childwbed">
                                            <input type="hidden" name="Price[0][visafare_infant]" value="" class="visa_fare_infant">
                                            <input type="hidden" name="Price[0][visafare_single]" value="" class="visa_fare_single">
                                            <input type="hidden" name="Price[0][visacurrency]" value="" class="visa_currency">
                                            <!---->
                                            <input type="hidden" name="Price[0][adult_fare_total]" value="" class="adult_fare_total">
                                            <input type="hidden" name="Price[0][exadult_fare_total]" value="" class="exadult_fare_total">
                                            <input type="hidden" name="Price[0][childwithbed_fare_total]" value="" class="childwithbed_fare_total">
                                            <input type="hidden" name="Price[0][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total">
                                            <input type="hidden" name="Price[0][infant_fare_total]" value="" class="infant_fare_total">
                                            <input type="hidden" name="Price[0][single_fare_total]" value="" class="single_fare_total">
                                          </div>
                                          <button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="c_price0">Add Price</button>
                                        </td>
                                      </tr>
                                    </table>
                                    <button type="button" name="add" id="add-price-row" class="btn btn-success" style="margin-left: 10px">Add more
                                    </button>
                                  </div>
                                </div>

                                <!--upcoming start-->
                                <div class="form-group pricelistpackage_upcoming" style="display:none;">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field_upcoming">
                                      <tr>
                                        <th>Price title</th>
                                        <th>Price type</th>
                                        <th>Confirmation Type</th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <td><input name="Price_title_upcoming" placeholder="Title.." class="form-control" type="text" value="<?php echo e(old('Price_title')); ?>"></td>
                                        <td>
                                          <select name="Price_type_upcoming" class="form-control">
                                            <option value="0">Select Type </option>
                                            <option value="Per Person">Per Person </option>
                                            <option value="Per Group">Per Group</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="confirmation_type_upcoming" class="form-control">
                                            <option value="0">Select Type </option>
                                            <option value="Instant Confirmation">Instant Confirmation</option>
                                            <option value="Confirmation in 24-48 hrs">Confirmation in 24-48 hrs</option>
                                            <option value="On-Request">On-Request</option>
                                          </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <th>Category</th>
                                        <th>Price from</th>
                                        <th>Price to</th>
                                        <th>Cut Off Point</th>
                                      </tr>
                                      <tr id="up_row1">
                                        <td>
                                          <select name="Price_upcoming[0][package_rating]" id="rating_upcoming" class="form-control rating-field" style="width: 40%;display:inline-block">
                                            <?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value='<?php echo e($rtyp->id); ?>'><?php echo e($rtyp->name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="other">Other</option>
                                          </select>
                                          <input name="Price_upcoming[0][package_rating_other]" id="otherrating" class="form-control other-rating" style="width: 50%;display:none">
                                        </td>
                                        <td>
                                          <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="Price_upcoming[0][datefrom]" class="form-control pull-right datepicker" type="text">
                                          </div>
                                        </td>
                                        <td>
                                          <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="Price_upcoming[0][dateto]" class="form-control pull-right datepicker" type="text">
                                          </div>
                                        </td>
                                        <td>
                                          <input type="number" value="0" name="Price_upcoming[0][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days">
                                        </td>
                                        <td>
                                          <div class="cup_price0" id="cup_price0">
                                            <input type="hidden" name="Price_upcoming[0][airfare_adult]" value="" class="air_fare_adult">
                                            <input type="hidden" name="Price_upcoming[0][airfare_exadult]" value="" class="air_fare_exadult">
                                            <input type="hidden" name="Price_upcoming[0][airfare_childbed]" value="" class="air_fare_childbed">
                                            <input type="hidden" name="Price_upcoming[0][airfare_childwbed]" value="" class="air_fare_childwbed">
                                            <input type="hidden" name="Price_upcoming[0][airfare_infant]" value="" class="air_fare_infant">
                                            <input type="hidden" name="Price_upcoming[0][airfare_single]" value="" class="air_fare_single">
                                            <input type="hidden" name="Price_upcoming[0][aircurrency]" value="" class="air_currency">
                                            <!---->
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_adult]" value="" class="hotel_fare_adult">
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_exadult]" value="" class="hotel_fare_exadult">
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_childbed]" value="" class="hotel_fare_childbed">
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_childwbed]" value="" class="hotel_fare_childwbed">
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_infant]" value="" class="hotel_fare_infant">
                                            <input type="hidden" name="Price_upcoming[0][hotelfare_single]" value="" class="hotel_fare_single">
                                            <input type="hidden" name="Price_upcoming[0][hotelcurrency]" value="" class="hotel_currency">
                                            <!---->
                                            <input type="hidden" name="Price_upcoming[0][tourfare_adult]" value="" class="tour_fare_adult">
                                            <input type="hidden" name="Price_upcoming[0][tourfare_exadult]" value="" class="tour_fare_exadult">
                                            <input type="hidden" name="Price_upcoming[0][tourfare_childbed]" value="" class="tour_fare_childbed">
                                            <input type="hidden" name="Price_upcoming[0][tourfare_childwbed]" value="" class="tour_fare_childwbed">
                                            <input type="hidden" name="Price_upcoming[0][tourfare_infant]" value="" class="tour_fare_infant">
                                            <input type="hidden" name="Price_upcoming[0][tourfare_single]" value="" class="tour_fare_single">
                                            <input type="hidden" name="Price_upcoming[0][tourcurrency]" value="" class="tour_currency">
                                            <!---->
                                            <input type="hidden" name="Price_upcoming[0][transferfare_adult]" value="" class="transfer_fare_adult">
                                            <input type="hidden" name="Price_upcoming[0][transferfare_exadult]" value="" class="transfer_fare_exadult">
                                            <input type="hidden" name="Price_upcoming[0][transferfare_childbed]" value="" class="transfer_fare_childbed">
                                            <input type="hidden" name="Price_upcoming[0][transferfare_childwbed]" value="" class="transfer_fare_childwbed">
                                            <input type="hidden" name="Price_upcoming[0][transferfare_infant]" value="" class="transfer_fare_infant">
                                            <input type="hidden" name="Price_upcoming[0][transferfare_single]" value="" class="transfer_fare_single">
                                            <input type="hidden" name="Price_upcoming[0][transfercurrency]" value="" class="transfer_currency">
                                            <!---->
                                            <input type="hidden" name="Price_upcoming[0][visafare_adult]" value="" class="visa_fare_adult">
                                            <input type="hidden" name="Price_upcoming[0][visafare_exadult]" value="" class="visa_fare_exadult">
                                            <input type="hidden" name="Price_upcoming[0][visafare_childbed]" value="" class="visa_fare_childbed">
                                            <input type="hidden" name="Price_upcoming[0][visafare_childwbed]" value="" class="visa_fare_childwbed">
                                            <input type="hidden" name="Price_upcoming[0][visafare_infant]" value="" class="visa_fare_infant">
                                            <input type="hidden" name="Price_upcoming[0][visafare_single]" value="" class="visa_fare_single">
                                            <input type="hidden" name="Price_upcoming[0][visacurrency]" value="" class="visa_currency">
                                            <!---->
                                            <input type="hidden" name="Price_upcoming[0][adult_fare_total]" value="" class="adult_fare_total">
                                            <input type="hidden" name="Price_upcoming[0][exadult_fare_total]" value="" class="exadult_fare_total">
                                            <input type="hidden" name="Price_upcoming[0][childwithbed_fare_total]" value="" class="childwithbed_fare_total">
                                            <input type="hidden" name="Price_upcoming[0][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total">
                                            <input type="hidden" name="Price_upcoming[0][infant_fare_total]" value="" class="infant_fare_total">
                                            <input type="hidden" name="Price_upcoming[0][single_fare_total]" value="" class="single_fare_total">
                                          </div>
                                          <button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="cup_price0">Add Price</button>
                                        </td>
                                      </tr>
                                    </table>
                                    <button type="button" name="add" id="add_upcoming_price_row" class="btn btn-success" style="margin-left: 10px">Add more
                                    </button>
                                  </div>
                                </div>
                                <!--upcoming end-->

                              </div>
                            </div>
                          </div>
                          <!---->
                          <div id="price_add" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Add Price</h4>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="" value="" class="price_class">
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <th></th>
                                        <th>Currency</th>
                                        <th>Adult <br> (Twin Sharing)</th>
                                        <th>Extra Adult</th>
                                        <th>Child <br> (With Bed)</th>
                                        <th>Child <br> (Without Bed)</th>
                                        <th>Infant </th>
                                        <th>Single <br> Supplement</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Air Fare</strong></td>
                                          <td>
                                            <select class="form-control a_curr">
                                            </select>
                                          </td>
                                          <td>
                                            <input class="form-control airfare_adult" placeholder="Airfare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control airfare_exadult" placeholder="Airfare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control airfare_childbed" placeholder="Airfare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control airfare_childwbed" placeholder="Airfare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control airfare_infant" placeholder="Airfare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control airfare_single" placeholder="Airfare" value="">
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Hotel</strong></td>
                                          <td>
                                            <select class="form-control h_curr">
                                            </select>
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_adult" placeholder="Hotel Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_exadult" placeholder="Hotel Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_childbed" placeholder="Hotel Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_childwbed" placeholder="Hotel Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_infant" placeholder="Hotel Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control hotelfare_single" placeholder="Hotel Fare" value="">
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Tours</strong></td>
                                          <td>
                                            <select class="form-control t_curr">
                                            </select>
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_adult" placeholder="Tour Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_exadult" placeholder="Tour Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_childbed" placeholder="Tour Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_childwbed" placeholder="Tour Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_infant" placeholder="Tour Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control tourfare_single" placeholder="Tour Fare" value="">
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Transfers</strong></td>
                                          <td>
                                            <select class="form-control to_curr">
                                            </select>
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_adult" placeholder="Transfer Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_exadult" placeholder="Transfer Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_childbed" placeholder="Transfer Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_childwbed" placeholder="Transfer Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_infant" placeholder="Transfer Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control transferfare_single" placeholder="Transfer Fare" value="">
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Visa</strong></td>
                                          <td>
                                            <select class="form-control v_curr">
                                            </select>
                                          </td>
                                          <td>
                                            <input class="form-control visafare_adult" placeholder="Visa Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control visafare_exadult" placeholder="Visa Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control visafare_childbed" placeholder="Visa Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control visafare_childwbed" placeholder="Visa Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control visafare_infant" placeholder="Visa Fare" value="">
                                          </td>
                                          <td>
                                            <input class="form-control visafare_single" placeholder="Visa Fare" value="">
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td style="padding-top: 16px;"><strong>Total</strong></td>
                                          <td><select class="form-control">
                                              <option selected="disabled">INR</option>
                                            </select></td>
                                          <td>
                                            <input class="form-control adult_total" value="" readonly>
                                          </td>
                                          <td>
                                            <input class="form-control extraadult_total" value="" readonly>
                                          </td>
                                          <td>
                                            <input class="form-control childwithbed_total" value="" readonly>
                                          </td>
                                          <td>
                                            <input class="form-control childwithoutbed_total " value="" readonly>
                                          </td>
                                          <td>
                                            <input class="form-control infant_total" value="" readonly>
                                          </td>
                                          <td>
                                            <input class="form-control single_total" value="" readonly>
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success" id="submit_price" data-dismiss="modal">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- -------------------------------------------- -->

                        <!-- tour new pricing -->
                        <div id="NewPricing" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="table-responsive no-border">
                                    <?php echo $__env->make('manage_packages.price_fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>

                          <!-- add price (day wise) modal -->
                          <div id="price_add_daywise" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Add DayWise Price</h4>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="" value="" class="price_class">
                                  <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <th>Day</th>
                                        <th>Price Discount</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>Sunday</td>
                                          <td class="sunday_data">
                                            <!-- <input class="form-control sunday_price" placeholder="Sunday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td>Monday</td>
                                          <td class="monday_data">
                                            <!-- <input class="form-control monday_price" placeholder="Monday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td>Tuesday</td>
                                          <td class="tuesday_data">
                                            <!-- <input class="form-control tuesday_price" placeholder="Tuesday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td>Wednesday</td>
                                          <td class="wednesday_data">
                                            <!-- <input class="form-control wednesday_price" placeholder="Wednesday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td>Thursday</td>
                                          <td class="thursday_data">
                                            <!-- <input class="form-control thursday_price" placeholder="Thursday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                         <tr>
                                          <td>Friday</td>
                                          <td class="friday_data">
                                            <!-- <input class="form-control friday_price" placeholder="Friday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                        <tr>
                                          <td>Saturday</td>
                                          <td class="saturday_data">
                                            <!-- <input class="form-control saturday_price" placeholder="Saturday Discount" value=""> -->
                                          </td>
                                        </tr>
                                        <!--seperate-->
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success" id="submit_day_wise_price" data-dismiss="modal">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour supplier -->
                        <div id="Supplier" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="item-container">
                              <div class="row">

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input type="text" class="form-control" name="supplier_name" placeholder="Name" value="" />
                                  </div>
                                </div>
                               
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Supplier Contact No</label>
                                    <input type="text" class="form-control" name="supplier_contact_no" placeholder="Contact No" value="" />
                                  </div>
                                </div>

                                <div class="col-md-12"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Supplier Email id</label>
                                    <input type="text" class="form-control" name="supplier_emailId" placeholder="Email Id" value="" />
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Supplier Price</label>
                                    <input type="text" class="form-control" name="supplier_price" placeholder="Price" value="0" />
                                  </div>
                                </div>

                                <div class="col-md-12"></div>

                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Supplier Address</label>
                                    <textarea class="form-control" name="supplier_address" placeholder="Address"><?php echo e(old('supplier_address')); ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour seo -->
                        <?php if(Sentinel::check()): ?>
                        <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                        <div id="meta" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="row">

                              <!-- seo 1 -->
                              <div class="col-md-12">
                                <div class="item-container">
                                  <h4>Gateway SEO</h4>
                                  <div class="form-group">
                                    <label class="field-required">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" placeholder="Title" value="<?php echo e(old('meta_title')); ?>" />
                                  </div>
                                  <div class="form-group">
                                    <label class="field-required">Meta Description</label>
                                    <input type="text" class="form-control" name="meta_desc" placeholder="Description" value="<?php echo e(old('meta_desc')); ?>" />
                                  </div>
                                  <div class="form-group">
                                    <label class="field-required">Meta Keywords</label>
                                    <textarea class="form-control" name="meta_keyword" placeholder="Keywords">
                                    <?php echo e(old('meta_keyword')); ?></textarea>
                                  </div>
                                </div>
                              </div>

                              <!-- seo 2 -->
                              <div class="col-md-12">
                                <div class="item-container">
                                  <h4>RTA SEO</h4>
                                  <div class="form-group">
                                    <label class="field-required">Meta Title</label>
                                    <input type="text" class="form-control" name="rapidex_meta_title" placeholder="Title" value="<?php echo e(old('rapidex_meta_title')); ?>" />
                                  </div>
                                  <div class="form-group">
                                    <label class="field-required">Meta Description</label>
                                    <input type="text" class="form-control" name="rapidex_meta_desc" placeholder="Description" value="<?php echo e(old('rapidex_meta_desc')); ?>" />
                                  </div>
                                  <div class="form-group">
                                    <label class="field-required">Meta Keywords</label>
                                    <textarea class="form-control" name="rapidex_meta_keyword" placeholder="Keywords"><?php echo e(old('rapidex_meta_keyword')); ?></textarea>
                                  </div>
                                </div>
                              </div>
                              <!---->
                            </div>
                          </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <!-- tour policy -->
                        <div id="policies" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">

                                <!-- visa policy -->
                                <div class="item-container">
                                  <div class="row">
                                    <div class="form-group visaOption">
                                      <label for="">Add Visa Policy</label>
                                      <input type="checkbox" name="visa" value="1" id="customize_onrequestvisa"/>
                                    </div>
                                    <div class="col-md-12 costomize_tour_visa">
                                      <h5>Visa Policy</h5>
                                      <table class="table table-bordered" id="dynamic_field">
                                        <tbody>
                                          <tr>
                                            <td style="width: 60%;">
                                              <div>
                                                <select name="package_visa[]" class="select2 form-control" multiple>
                                                  <?php $__currentLoopData = $visaPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                  <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                </select>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <textarea name="visa_policies" placeholder="Please enter your additional visa policies (if any)..." rows="6" class="form-control"></textarea>
                                              <!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>

                                <!-- payment policy -->
                                <div class="item-container">
                                  <div class="row">
                                    <div class="form-group visaOption">
                                      <label>Add Payment Policy</label>
                                    </div>
                                    <div class="col-md-12">
                                      <h5>Payment Policy</h5>
                                      <table class="table table-bordered" id="dynamic_field">
                                        <tbody>
                                          <tr>
                                            <td style="width: 60%;">
                                              <div>
                                                <select name="package_payment[]" class="select2 form-control" multiple>
                                                  <?php $__currentLoopData = $paymentPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                  <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                </select>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <textarea name="payment_policies" placeholder="Please enter your additional payment policies (if any)..." rows="6" class="form-control"></textarea>
                                              <!-- <input type="hidden" name="payment_policies" id="payment_policies_input" value=""/>-->
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>

                                <!-- cancellation policy -->
                                <div class="item-container">
                                  <div class="row">
                                    <div class="form-group visaOption">
                                      <label>Add Cancellation Policy</label>
                                    </div>
                                    <div class="col-md-12">
                                      <h5>Cancellation Policy</h5>
                                      <table class="table table-bordered" id="dynamic_field">
                                        <tbody>
                                          <tr>
                                            <td style="width: 60%;">
                                              <div>
                                                <select name="package_can[]" class="select2 form-control" multiple>
                                                  <?php $__currentLoopData = $cancelPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                  <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                </select>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <textarea name="cancellation" placeholder="Please enter your additional cancellation policies (if any)..." rows="6" class="form-control"></textarea>
                                              <!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>

                                <!-- important notes -->
                                <div class="item-container">
                                  <div class="row">
                                    <div class="form-group visaOption">
                                      <label>Add Important Notes</label>
                                    </div>
                                    <div class="col-md-12">
                                      <h5>Important Notes</h5>
                                      <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <td style="width: 60%;">
                                              <div>
                                                <select name="package_impnotes[]" class="select2 form-control" multiple>
                                                  <?php $__currentLoopData = $imp_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                  <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                </select>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <textarea name="extra_imp" placeholder="Please enter your additional terms & conditions (if any)..." rows="6" class="form-control"></textarea>
                                              <!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tour destination info -->
                        <div id="destination" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="item-container">
                              <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="destinations">Tour Destination(s)</label>
                                  <div class="input-group pdngBtm5">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <select name="destinations[]" id="destinations" class="form-control select2" multiple>
                                      <?php if(count($locations)>0): ?>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if($loc->location!='' || $loc->location!=0): ?>
                                          <option value="<?php echo e($loc->location); ?>"><?php echo e($loc->location); ?> 
                                          <?php if($loc->country=='India'): ?>
                                            (<?php echo e($loc->state); ?>, <?php echo e($loc->country); ?>)
                                          <?php else: ?>
                                            (<?php echo e($loc->country); ?>)
                                          <?php endif; ?>
                                          </option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php else: ?>
                                        <option value="No Result Found">No Result Found</option>
                                      <?php endif; ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>

                        <!-- similar tour packages -->
                        <div id="similar-tour" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="item-container">
                              <div class="row">

                                <!-- select destination -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="destinations">Choose City</label>
                                    <div class="input-group pdngBtm5">
                                      <span class="input-group-addon"> <i class="fa fa-map-marker"></i></span>
                                      <select name="sp_city[]" id="sp_city" class="form-control select2" multiple>
                                        <?php $__currentLoopData = $spcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cty): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($cty); ?>"><?php echo e($cty); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <!-- select similar tour -->
                                <div class="spkgs-box" style="display: none;">
                                  <div class="col-md-12">
                                    <div class="form-group ">
                                      <label for="destinations">Choose Similar Package(s)</label>
                                      <div class="input-group pdngBtm5">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="similar_packages[]" id="similar_packages" class="form-control select2" multiple>
                                          <!-- missing code -->
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- enable book online -->
                        <div id="book-online" class="tab-pane fade">
                          <div class="panel-body">
                            <div class="item-container">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="makeflex align-center ">
                                      <label class="font13 appendRight20">Book Online</label>
                                      <div class="toggle-switch">
                                        <input type="checkbox" id="book-online-toggle">
                                        <label for="book-online-toggle" class="toggle"></label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div> <!-- close tab-content -->

                      <!-- end-->
                      <!-- <div class="update-btns col-sm-12">
                        <button type="submit" name="draft" id="next" class="btn btn-success">Draft<i class="fa fa-save"></i></button>
                        <button type="submit" name="add" id="next" class="btn btn-success">Next<i class="fa fa-arrow-right"></i></button>
                      </div> -->

                      <!-- save tour -->
                      <div class="col-md-12">
                        <div class="form-group textCenter">
                          <button type="submit" name="add" id="remove" class="btn btn-danger location_add">Continue To Save <i class="fa fa-arrow-right"></i></button>
                        </div>
                      </div>

                    </form>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

<!-- ************************** -->

<!-- modal -->

<!--add package tour modal (in inclusions)-->
<div class="modal fade" id="packagetour_custom" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="lineModalLabel">Add Package Tour</h3>
      </div>
      <div class="modal-body">
        <!-- content goes here -->
        <form>
          <input type="hidden" name="type" value="Private Tour" />
          <br>
          <div class="alert alert-success" id="success-add" style="display:none">
            <p>Tour Added Successfully</p>
          </div>
          <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
            <ul id="error-contaier">
            </ul>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Name</label>
            <div class="col-md-8">
              <input name="name" class="form-control name" placeholder="Name" value="" type="text" id="tour_name">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Image(250*160)</label>
            <div class="col-md-8">
              <input name="tour_image" class="form-control tour_image " id="tour_image" type="file">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-12 control-label text-left">Sightseeing Description</label>
            <div class="col-md-11">
              <textarea class="form-control description ckeditor" name="description" id="tour_description" cols="50" rows="2" id="tour_description"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Locations</label>
            <div class="col-md-8">
              <input name="location" class="form-control location query_city" placeholder="location" value="" type="text" id="tour_location">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Duration</label>
            <div class="col-md-8">
              <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text" id="tour_duration">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Inclusions</label>
            <div class="col-md-8">
              <input name="inclusions" class="form-control inclusions" placeholder="Inclusions" value="" type="text" id="tour_inclusion">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Sightseeing Exclusions</label>
            <div class="col-md-8">
              <input name="exclusions" class="form-control exclusions" placeholder="Exclusions" value="" id="tour_exclusion" type="text">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Status</label>
            <div class="col-md-8">
              <select name="status" class="form-control status" id="tour_status">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group tn-group-justified" role="group" aria-label="group button">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
          </div>
          <div class="btn-group" role="group">
            <input type="submit" class="btn btn-primary" value="Add" id="add-tour">
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- package hotel modal (to be checked for here) -->
<div class="modal fade" id="pk_aadhotel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="lineModalLabel">Add Package Hotel</h3>
      </div>
      <div class="modal-body">
        <!-- content goes here -->
        <form>
          <input type="hidden" name="type" value="Private Tour" />
          <br>
          <div class="alert alert-success" id="success-add_pkhotel" style="display:none">
            <p>Package Hotel Added Successfully.</p>
          </div>
          <div class="alert alert-danger" id="error-add_pkhotel" style="display:none">
            <ul id="error-contaier">
              <p>Enter Valid Input</p>
            </ul>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Hotel Name</label>
            <div class="col-md-8">
              <input name="hotelname" class="form-control" placeholder="Hotel Name" type="text" id="hotelname">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Locations</label>
            <div class="col-md-8">
              <input name="location" class="form-control" placeholder="Location" value="" type="text" id="location">
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-3 control-label text-left">Star Rating</label>
            <div class="col-md-8">
              <select name="star_rating" class="form-control" id="star_rating">
                <option value="5">5 Star</option>
                <option value="4.5">4.5 Star</option>
                <option value="4">4 Star</option>
                <option value="3.5">3.5 Star</option>
                <option value="3">3 Star</option>
                <option value="2">2 Star</option>
                <option value="1">1 Star</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group tn-group-justified" role="group" aria-label="group button">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
          </div>
          <div class="btn-group" role="group">
            <input type="submit" class="btn btn-primary" value="Add" id="add_package_hotel">
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- supplier modal (to be checked for here) -->
<div class="modal fade" id="supplier" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content borderRadius5">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="" value="" id="bookId">
        <h4 class="modal-title">Supplier Remarks</h4>
      </div>
      <form action="#" method="post" id="enq_data" name="enq_data">
        <div class="modal-body custom_border" id="supplier_body"></div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-success supplier_remarks" supplier_remarks_id="" supplier_attr="">Apply</button>
        <button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ************************** -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code_second"); ?>
  
  <!-- tour package -->
  <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/tour-package.js")); ?>'></script> -->
  
  <!-- package property selection -->
  <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/package-property-selection.js")); ?>'></script>

  <!-- new pricing -->
  <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/package_new_price.js")); ?>'></script>

<script>
$(document).ready(function () {
    $('#package_service').select2({
        placeholder: "Select Tour Services",
        allowClear: true,
        // Use templateResult to filter out selected items from the dropdown
        templateResult: function (data) {
            if ($(data.element).is(':selected')) {
                return null; // Don't show already selected items in the dropdown
            }
            return data.text; // Show unselected items in the dropdown
        }
    });
});

//
$(document).on("change",".adayplus", function() {
  alert('Kindly check duration')
});

//
$(document).on("change",".dhours , .dmins, .ahours, .amins", function() {
  var dhours=$(".dhours").val()
  var dmins=$(".dmins").val()
  var ahours=$(".ahours").val()
  var amins=$(".amins").val()
  var adayplus=$(".adayplus").val()
  var departure_in_min=parseInt(dhours)*60+parseInt(dmins)
  var arrival_in_min=parseInt(ahours)*60+parseInt(amins)
  if(arrival_in_min<=departure_in_min) {
    var arrival_in_min=parseInt(arrival_in_min)+parseInt(24)*60
    $('.adayplus').val('').val(1);
  } else {
    $('.adayplus').val('').val(0);
  }
  var duration_in_min=parseInt(arrival_in_min)-parseInt(departure_in_min)
  var hours = Math.floor(duration_in_min / 60);          
  var minutes = duration_in_min % 60;
  // if(adayplus==1)
  // {
    
  // var hours=parseInt(hours)+parseInt(24)
  // }
  // else if(adayplus==2)
  // {
  // var hours=parseInt(hours)+parseInt(48)
  // }
  var duration_min=parseInt(amins)-parseInt(dmins)
  $('.duration_hours').val('').val(hours);
  $('.duration_min').val('').val(minutes);
});

//return flight
$(document).on("change",".dadayplus", function() {
alert('Kindly check duration')
});

//
$(document).on("change",".ddhours , .ddmins, .dahours, .damins", function() {
  var dhours=$(".ddhours").val()
  var dmins=$(".ddmins").val()
  var ahours=$(".dahours").val()
  var amins=$(".damins").val()
  var adayplus=$(".dadayplus").val()
  var departure_in_min=parseInt(dhours)*60+parseInt(dmins)
  var arrival_in_min=parseInt(ahours)*60+parseInt(amins)
  if(arrival_in_min<=departure_in_min) {
    var arrival_in_min=parseInt(arrival_in_min)+parseInt(24)*60
    $('.dadayplus').val('').val(1);
  } else {
    $('.dadayplus').val('').val(0);
  }
  var duration_in_min=parseInt(arrival_in_min)-parseInt(departure_in_min)
  var hours = Math.floor(duration_in_min / 60);          
  var minutes = duration_in_min % 60;
  // if(adayplus==1)
  // {
    
  // var hours=parseInt(hours)+parseInt(24)
  // }
  // else if(adayplus==2)
  // {
  // var hours=parseInt(hours)+parseInt(48)
  // }
  var duration_min=parseInt(amins)-parseInt(dmins)
  $('.return_duration_hours').val('').val(hours);
  $('.return_duration_min').val('').val(minutes);
});

//
$(document).on("change",".flight_name",function() {
  var flight_name=$(this).val()
  $(".down_filght").val('').val(flight_name)
});

$(document).on("change",".origin",function() {
  var origin=$(this).val()
  $(".down_dest").val('').val(origin)
});

$(document).on("change",".dest",function() {
  var dest=$(this).val()
  $(".down_origin").val('').val(dest)
});
</script>

<script type="text/javascript">
/*form validation*/
/*document.getElementById('package-form').addEventListener('submit', function(e) {
    const durationSelect = document.getElementById('package_durations');
    
    if (durationSelect.value === "") {
        alert('Please select a valid duration.');
        durationSelect.focus();  // Set focus to the dropdown
        e.preventDefault();  // Prevent form submission
    }
});*/
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>