<?php $__env->startSection("custom_css_code"); ?>

<!-- edit quote -->
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

              <?php if($packagesData->type_of_package != 'Hotel Package'): ?>
                <input type="hidden" id="package_country" value="<?php echo e(implode(',',$packagesData->country)); ?>">
              <?php endif; ?>              

              <!-- edit tour -->
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
                  <li><a data-toggle="tab" href="#similar-tour" id="showSelPkgs"><span class="glyphicon glyphicon-th-list"></span> Similar Tour</a></li>

                  <!-- book online -->
                  <li><a data-toggle="tab" href="#book-online"><span class="glyphicon glyphicon-th-list"></span> Live Mode</a></li>
                </ul>

                <form action="<?php echo e(URL::to('/store-package')); ?>" method="post" id="package-form">
                  <input type="hidden" name="type" value="<?php echo e($packagesData->type_of_package); ?>" />
                  <input type="hidden" name="id" value="<?php echo e($packagesData->id); ?>" />
                  <?php echo e(csrf_field()); ?>

                  <br>                  

                  <!-- tab content -->
                  <div class="tab-content">
                    <!-- tour info -->
                    <div id="Info" class="tab-pane fade in active">
                      <div class="panel-body">
                        <div class="item-container">
                          <div class="row">

                            <!-- tour duration -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="duration">Tour Duration <span class="requiredcolor">&#42;</span></label>
                                <select name="duration" id="package_durations" class="form-control val">
                                  <?php for($i = 1; $i <= 30; $i++): ?>
                                    <option value="<?php echo e($i); ?>" 
                                    <?php echo e(isset($packagesData->duration) && $i == $packagesData->duration ? 'selected' : ''); ?>>
                                    <?php echo e($i); ?> Night / <?php echo e($i + 1); ?> Days
                                  </option>
                                  <?php endfor; ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour title -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_name" class="field-required">Tour Title</label>
                                <input type="text" placeholder="Enter tour name" value="<?php echo e($packagesData->title); ?>" name="package_name" class="form-control package_name">
                                <span class="package_availibility"> </span>
                              </div>
                            </div>

                            <!-- departure city -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Departure City</label>
                                <select class="quote_city form-control" name="sourcecity">
                                <option value="<?php echo e($packagesData->sourcecity); ?>" selected><?php echo e($packagesData->sourcecity); ?></option>
                                </select>
                              </div>
                            </div>

                            <!-- tour type -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Type</label>
                                <select class="form-control" name="tour_type">
                                  <option value="">Select tour type</option>
                                  <?php $__currentLoopData = $tourtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($tourtype->id); ?>" 
                                      <?php echo e(isset($packagesData->tour_type) && $packagesData->tour_type == $tourtype->id ? 'selected' : ''); ?>>
                                      <?php echo e($tourtype->tour_type); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                              </div>
                            </div>

                            <!-- tour category -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Category</label>
                                <select class="form-control" name="tour_category">
                                  <option value="">Select Tour Category</option>
                                  <?php $__currentLoopData = $tourcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourcategory): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($tourcategory->id); ?>" 
                                      <?php echo e((isset($packagesData->tour_category) && $packagesData->tour_category == $tourcategory->id) || old('tour_category') == $tourcategory->id ? 'selected' : ''); ?>>
                                      <?php echo e($tourcategory->tour_category); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour star rating -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Star Rating <i>(use to display hotel rating on frontend)</i></label>
                                <select class="form-control" name="select_star_rating">
                                  <option value="">Select Star</option>
                                  <?php $__currentLoopData = [5, 4, 3, 2, 1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($star); ?> Star" 
                                    <?php echo e(old('select_star_rating', $packagesData->select_star_rating ?? '') == "$star Star" ? 'selected' : ''); ?>>
                                    <?php echo e($star); ?> Star
                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>

                            </div>

                            <!-- services included -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_location" class="field-required">Tour Services Included</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($icons) > 0): ?>
                                      <?php 
                                        // Ensure package_service is an array
                                        $selectedServices = is_array($packagesData->package_service) 
                                        ? $packagesData->package_service 
                                        : explode(',', $packagesData->package_service);
                                       ?>
                                      <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($icon->icon_title); ?>" 
                                          <?php echo e(in_array($icon->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : ''); ?>>
                                          <?php echo e($icon->icon_title); ?>

                                        </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- suitable for -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_location">Suitable For</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($suitables) > 0): ?>
                                      <?php 
                                        // Convert package_service to an array if it is a string
                                        $selectedServices = is_array($packagesData->package_service) 
                                        ? $packagesData->package_service 
                                        : explode(',', $packagesData->package_service);
                                       ?>
                                      <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suitable): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($suitable->icon_title); ?>" 
                                          <?php echo e(in_array($suitable->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : ''); ?>>
                                          <?php echo e($suitable->icon_title); ?>

                                        </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                    <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>

                            </div>

                            <!-- general tag -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_location">General Tags</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($generals) > 0): ?>
                                      <?php 
                                        // Convert package_service to an array if it is a string
                                        $selectedServices = is_array($packagesData->package_service)
                                        ? $packagesData->package_service
                                        : explode(',', $packagesData->package_service);
                                       ?>

                                      <?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($general->icon_title); ?>"
                                        <?php echo e(in_array($general->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : ''); ?>>
                                        <?php echo e($general->icon_title); ?>

                                        </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php else: ?>
                                      <option value="">No Result Found</option>
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
                                <select name="package_category[]" id="package_category" class="select2 form-control" multiple>
                                  <?php 
                                    // Convert package_category to an array if it is a string
                                    $selectedCategories = is_array($packagesData->package_category) 
                                      ? $packagesData->package_category 
                                      : explode(',', $packagesData->package_category);
                                   ?>
                                  
                                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($typ->name); ?>" 
                                      <?php echo e(in_array($typ->name, old('package_category', $selectedCategories) ?? []) ? 'selected' : ''); ?>>
                                      <?php echo e($typ->name); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- holiday type -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="package_location">Holiday Type</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <!-- <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php 
                                      // Convert package_service to an array if it's a string
                                      $selectedServices = is_array($packagesData->package_service) 
                                          ? $packagesData->package_service 
                                          : explode(',', $packagesData->package_service);
                                     ?>

                                    <?php if(count($holidays) > 0): ?>
                                      <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($holiday->icon_title); ?>" 
                                              <?php echo e(in_array($holiday->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : ''); ?>>
                                              <?php echo e($holiday->icon_title); ?>

                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select> -->

                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php 
                                      // Ensure package_service is an array
                                      if (isset($packagesData->package_service)) {
                                        $selectedServices = is_array($packagesData->package_service)
                                          ? $packagesData->package_service  // Already an array
                                          : explode(',', $packagesData->package_service); // Convert CSV string to array
                                        } else {
                                          $selectedServices = []; // Default to empty array
                                        }

                                        // Retrieve old input if available, otherwise use $selectedServices
                                        $oldServices = old('package_service', $selectedServices);
                                     ?>

                                    <?php if(count($holidays) > 0): ?>
                                      <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($holiday->icon_title); ?>" 
                                          <?php echo e(in_array($holiday->icon_title, (array) $oldServices) ? 'selected' : ''); ?>>
                                            <?php echo e($holiday->icon_title); ?>

                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- city wise duration -->
                          <?php
                            $count = count($packagesData->country);
                            //dd($packagesData->continent[0]);
                            use App\State;
                            use App\City;
                            $i=1;
                          ?>                          
                          <label for="">Duration By City</label>
                          <div class="col-md-12">
                            <div class="row" id="dynamic_field_package">
                              <?php 
                                // Pre-fetch data outside loop to avoid multiple queries
                                $stateNames = collect($packagesData->state ?? []);
                                $cityNames = collect($packagesData->city ?? []);

                                // Fetch all states and cities at once
                                $stateData = State::whereIn('name', $stateNames)->get()->keyBy('name');
                                $cityData = City::whereIn('name', $cityNames)->get()->keyBy('name');

                                // Fetch all states grouped by country_id
                                $allStates = State::whereIn('country_id', $stateData->pluck('country_id')->unique())->get()->groupBy('country_id');

                                // Fetch all cities grouped by state_id
                                $allCities = City::whereIn('state_id', $cityData->pluck('state_id')->unique())->get()->groupBy('state_id');
                               ?>

                              <?php $__currentLoopData = $packagesData->country ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php 
                                  $a = 0; // Initialize the missing variable
                                    $continent = $packagesData->continent[$row] ?? '';
                                    $country = $packagesData->country[$row] ?? '';
                                    $state = $packagesData->state[$row] ?? '';
                                    $city = $packagesData->city[$row] ?? '';
                                    $days = $packagesData->days[$row] ?? '';
                                    $days_duration = $packagesData->duration ?? '';

                                    // Get country_id from pre-fetched state data
                                    $country_id = $stateData[$state]->country_id ?? '';

                                    // Get related states from pre-fetched data
                                    $states1 = $allStates[$country_id] ?? collect();

                                    // Get state_id from pre-fetched city data
                                    $state_id = $cityData[$city]->state_id ?? '';

                                    // Get related cities from pre-fetched data
                                    $city2 = $allCities[$state_id] ?? collect();
                                 ?>

                              <div class="item-container remove dfp dfp-1">
                                <!-- continent -->
                                <?php 
                                  $continents = ['Asia', 'Africa', 'Antarctica', 'Australia', 'Europe', 'North America', 'South America'];
                                 ?>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="continent">Continent</label>
                                    <select name="continent[<?php echo e($a); ?>]" id="continent" class="form-control">
                                      <?php $__currentLoopData = $continents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($cont); ?>" <?php echo e($continent == $cont ? 'selected' : ''); ?>><?php echo e($cont); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>
                                </div>

                                <!-- country -->
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="country" class="field-required">Country</label>
                                    <select name="country[<?php echo e($a); ?>]" id="package_dest_countries<?php echo e($a); ?>" class="form-control package_dest_country" onchange="selectCountry(this)">
                                      <option value=''>Select Country</option>
                                      <?php if(isset($countries) && count($countries) > 0): ?>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>" 
                                                <?php echo e(($cont->name == $country) ? 'selected' : ''); ?>>
                                                <?php echo e($cont->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php endif; ?>
                                    </select>
                                  </div>
                                </div>

                                <!-- state -->
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="state" class="field-required">State</label>
                                    <select name="state[<?php echo e($a); ?>]" id="package_dest_state<?php echo e($a); ?>" class="form-control package_dest_countries<?php echo e($a); ?>" onchange="selectState(this)">
                                      <option value=''>Select State</option>
                                      <?php $__currentLoopData = $states1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state_name): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <?php if($state_name->name==$state): ?>
                                        <option value="<?php echo e($state_name->name); ?>" selected="selected" s_id="<?php echo e($state_name->id); ?>"><?php echo e($state_name->name); ?> </option>
                                      <?php else: ?>
                                        <option value="<?php echo e($state_name->name); ?>" s_id="<?php echo e($state_name->id); ?>"><?php echo e($state_name->name); ?> </option>
                                      <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>
                                </div>

                                <!-- city -->
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="city" class="field-required">City</label>
                                    <select name="city[<?php echo e($a); ?>]" id="package_dest_city" class="form-control package_dest_state<?php echo e($a); ?> city_package_dest_countries<?php echo e($a); ?> package_dest_cities min-select" onchange="selectCity(this)">
                                      <option value=''>Select City</option>
                                      <?php $__currentLoopData = $city2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_name): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <?php if($city_name->name==$city): ?>
                                        <option value="<?php echo e($city_name->name); ?>" selected="selected"><?php echo e($city_name->name); ?> </option>
                                      <?php else: ?>
                                        <option value="<?php echo e($city_name->name); ?>"><?php echo e($city_name->name); ?> </option>
                                      <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>
                                </div>

                                <!-- duration city wise -->
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="city" class="field-required">Duration</label>
                                    <select name="days[<?php echo e($a); ?>]" id="package_dest_days" class="form-control package_dest_days ">
                                      <?php for($day_value=1;$day_value<=$days_duration;$day_value++): ?> <?php if($day_value==$days): ?>
                                        <option value="<?php echo e($day_value); ?>" selected="selected">
                                        <?php echo e($day_value); ?> Night/<?php echo e(($day_value)+1); ?> Days
                                        </option>
                                      <?php else: ?>
                                        <option value="<?php echo e($day_value); ?>"> <?php echo e($day_value); ?> Night/<?php echo e(($day_value)+1); ?> Days </option>
                                      <?php endif; ?>
                                      <?php endfor; ?>
                                    </select>
                                  </div>
                                </div>

                                <?php if($i!=1): ?>
                                <div class="col-md-2">
                                  <div class='form-group'>
                                    <button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin:18px 10px 0px 0px'>Remove</button>
                                  </div>
                                </div>
                                <?php endif; ?>

                              </div>
                              <?php $i++;?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                          </div>

                          <!-- add more city & duration -->
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <button type="button" name="add-continent" id="add-continent-row" class="btn btn-success">(+) Add more city
                                  <!-- more content from package.js -->
                                </button>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <!-- tour description -->
                    <div id="Description" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="row">

                          <!-- tour description -->
                          <div class="col-md-12">
                            <div class="form-group item-container custom_inc_exc">
                              <label class="collapse-toggle">Tour Description</label>
                              <br><br>
                              <span class="show_hide morePlus">More+</span>
                              <textarea class="form-control ckeditor" placeholder="Package Description..." name="description" id="" cols="30" rows="5"><?php echo e($packagesData->description); ?></textarea>
                            </div>
                          </div>
                            
                          <!-- tour highlights -->
                          <div class="col-md-12">
                            <div class="form-group item-container custom_inc_exc">
                              <label class="collapse-toggle">Tour Highlights</label>
                              <br><br>
                              <span class="show_hide morePlus">More+</span>
                              <textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5"><?php echo e($packagesData->highlights); ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- tour inclusions and exclusions -->
                    <div id="Overview" class="tab-pane fade">
                      <div class="panel-body">

                        <div class="col-md-12 item-container">
                          <div class="row">

                            <!-- hotel star rating -->
                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="field-required">
                                    Star Rating 
                                    <span class="color74">(The highest star rating hotel featured in this tour)</span>
                                </label>
                                <select class="form-control" name="customer_rating">
                                  <?php $__currentLoopData = [1, 2, 3, 4, 5, 7]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($rating); ?>" <?php echo e(isset($packagesData->customer_rating) && $packagesData->customer_rating == $rating ? 'selected' : ''); ?>>
                                      <?php echo e($rating); ?> Star
                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour sightseeing -->
                            <div class="col-md-7">                              
                              <div class="form-group select-container">
                                <label>Tour Sightseeing</label>
                                <select class="select2 form-control" name="tours[]" multiple id="tour_add">
                                    <?php $__currentLoopData = $PkgTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($tour->id); ?>" 
                                        <?php if(!empty($packagesData->tours) && in_array($tour->activity, $packagesData->tours)): ?> selected <?php endif; ?>>
                                        <?php echo e($tour->activity); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>

                            </div>

                            <!-- add new sightseeing -->
                            <div class="col-md-2">
                              <div class="form-group">
                                <div class="custom_tour_parent">
                                  <button data-toggle="modal" data-target="#packagetour_custom " type="button" class="btn-success btn-sm custom_tour appendTop20">Add new sightseeing</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                          <div class="row">

                            <!-- tour inclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Inclusions</label>
                                
                                <?php  
                                    $tour_inc = !empty($packagesData->tour_inc) ? unserialize($packagesData->tour_inc) : []; 
                                 ?>

                                <select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
                                    <?php $__currentLoopData = $inclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>" <?php echo e(in_array($pol->id, $tour_inc) ? 'selected' : ''); ?>>
                                        <?php echo e($pol->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="inclusions" cols="30" rows="5">
                                    <?php echo e(old('inclusions', $packagesData->inclusions ?? '')); ?>

                                </textarea>
                              </div>
                            </div>

                            <!-- tour exclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Exclusions</label>
                                
                                <?php  
                                    $tour_exc = !empty($packagesData->tour_exc) ? unserialize($packagesData->tour_exc) : []; 
                                 ?>

                                <select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
                                    <?php $__currentLoopData = $exclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>" <?php echo e(in_array($pol->id, $tour_exc) ? 'selected' : ''); ?>>
                                        <?php echo e($pol->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="exclusions" cols="30" rows="5">
                                  <?php echo e(old('exclusions', $packagesData->exclusions ?? '')); ?>

                                </textarea>
                              </div>
                            </div>
                          </div>                          
                      </div>
                    </div>

                    <!-- tour flights -->
                    <?php $flight_data=$packagesData->flight; ?>
                    <div id="flights" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="flightOption">
                              <label for="flightOption">Flight Required?</label>
                              <!-- <input type="checkbox" name="flight[flightOption]" id="show_flight_options" value="1"
                              <?php if(array_key_exists('flightOption', $flight_data) && $flight_data['flightOption'] == 1): ?> checked <?php endif; ?>> -->
                              <input type="checkbox" name="flight[flightOption]" id="show_flight_options" value="1" <?php echo e(!empty($flight_data['flightOption']) && $flight_data['flightOption'] == 1 ? 'checked' : ''); ?>>
                            </div>
                          </div>

                          <!-- flight -->
                          <!-- <div class="col-md-12 flight" <?php if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>> -->
                          <div class="col-md-12 flight" style="display: <?php echo e(!empty($flight_data['flightOption']) && $flight_data['flightOption'] == 1 ? 'block' : 'none'); ?>;">

                            <!--Onward Flight-->
                            <div class="item-container">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="flightOption">
                                    <label for="onward_required">Onward Flight Required?</label>
                                    <!-- <input type="checkbox" name="flight[onward_required]" id="onward_required" value="1"
                                      <?php if(array_key_exists('onward_required', $flight_data) && $flight_data['onward_required'] == 1): ?> checked <?php endif; ?>> -->
                                    <input type="checkbox" name="flight[onward_required]" id="onward_required" value="1" <?php echo e(!empty($flight_data['onward_required']) && $flight_data['onward_required'] == 1 ? 'checked' : ''); ?>>

                                  </div>
                                </div>
                                <div class="onwardflight"
                                  <?php if(array_key_exists('onward_required', $flight_data) && $flight_data['onward_required'] == 1): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                                  <div class="col-md-12 appendBottom10">
                                    <p class="flightBoxHeading">ONWARD FLIGHT</p>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Airline Name</label>
                                    <!--<input type="text" name="flight[name]" class="form-control flight_name">-->
                                    <select name="flight[name]" class="form-control flight_name">
                                      <option value="0">Select Airline</option>
                                      <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($airline->airline_name); ?>" <?php if($flight_data['name']==$airline->airline_name): ?> selected <?php endif; ?>><?php echo e($airline->airline_name); ?> </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Flight No.</label>
                                    <input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333" value="<?php echo e($flight_data['no']); ?>">
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>No. Of Stop</label>
                                    <select name="flight[numberstop]" class="form-control">
                                      <option value="0" <?php echo e(($flight_data['numberstop'] ?? '') == 0 ? 'selected' : ''); ?>>Select Stops</option>
                                      <option value="Non-Stop" <?php echo e(($flight_data['numberstop'] ?? '') == "Non-Stop" ? 'selected' : ''); ?>>Non-Stop</option>
                                      <?php for($i = 1; $i <= 4; $i++): ?>
                                          <option value="<?php echo e($i); ?> <?php echo e($i == 1 ? 'Stop' : 'Stops'); ?>" 
                                              <?php echo e(($flight_data['numberstop'] ?? '') == "$i " . ($i == 1 ? 'Stop' : 'Stops') ? 'selected' : ''); ?>>
                                              <?php echo e($i); ?> <?php echo e($i == 1 ? 'Stop' : 'Stops'); ?>

                                          </option>
                                      <?php endfor; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Origin</label>
                                    <select name="flight[origin]" class="form-control origin">
                                      <option value="0" <?php echo e(($flight_data['origin'] ?? '') == 0 ? 'selected' : ''); ?>>Select Origin</option>
                                      <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <?php  $val = "{$iata->iata_name} ({$iata->iata_code})";  ?>
                                          <option value="<?php echo e($val); ?>" <?php echo e(($flight_data['origin'] ?? '') == $val ? 'selected' : ''); ?>>
                                              <?php echo e($val); ?>

                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Departure Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[dhours]" class="form-control dhours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0" >Hours</option>
                                      <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dhours',$flight_data) && $flight_data['dhours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Hours</option>
                                      <?php for($i=1; $i<=24; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dhours', $flight_data) && $flight_data['dhours'] == $i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[dmins]" class="form-control dmins" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=60;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dmins',$flight_data) && $flight_data['dmins'] == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dmins',$flight_data) && $flight_data['dmins']==$i): ?> selected <?php endif; ?>><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>                                    
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Destination</label>
                                    <select name="flight[dest]" class="form-control dest">
                                      <option value="0">Select Destination</option>
                                      <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="<?php echo e($val); ?>" <?php if($flight_data['dest']==$val): ?> selected <?php endif; ?>><?php echo e($val); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Arrival Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[ahours]" class="form-control ahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      <?php for($i=1;$i<=72;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ahours',$flight_data) && $flight_data['ahours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Hours</option>
                                      <?php for($i=1; $i<=72; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ahours',$flight_data) && $flight_data['ahours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[amins]" class="form-control amins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=60;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('amins',$flight_data) && $flight_data['amins']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('amins',$flight_data) && $flight_data['amins'] == $i): ?> selected <?php endif; ?>><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[adayplus]" class="form-control adayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                      <option value="0" <?php if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==0): ?> selected <?php endif; ?>>+0 Day</option>
                                      <option value="1" <?php if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==1): ?> selected <?php endif; ?>>+1 Day</option>
                                      <option value="2" <?php if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==2): ?> selected <?php endif; ?>>+2 Day</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Cabin Class</label>
                                    <select name="flight[cabin]" class="form-control">
                                      <option value="economyclass" <?php if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='economyclass'): ?> selected <?php endif; ?>>Economy</option>
                                      <option value="premiumeconomyclass" <?php if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='premiumeconomyclass'): ?> selected <?php endif; ?>>Premium Economy</option>
                                      <option value="businessclass" <?php if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='businessclass'): ?> selected <?php endif; ?>>Business</option>
                                      <option value="firstclass" <?php if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='firstclass'): ?> selected <?php endif; ?>>First</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Fare Type</label>
                                    <select name="flight[faretype]" class="form-control">
                                      <option value="">Select</option>
                                      <option value="refundable" <?php if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                      <option value="partialrefundable" <?php if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='partialrefundable'): ?> selected <?php endif; ?>>Partial-refundable</option>
                                      <option value="non-refundable" <?php if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Duration</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[duration_hours]" class="form-control duration_hours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('duration_hours',$flight_data) && $flight_data['duration_hours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> hrs </option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Hours</option>
                                      <?php for($i = 1; $i <= 40; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('duration_hours', $flight_data) && $flight_data['duration_hours'] == $i): ?> selected <?php endif; ?>>
                                          <?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?>

                                        </option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[duration_dmins]" class="form-control duration_min" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=59;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('duration_dmins',$flight_data) && $flight_data['duration_dmins']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> mins</option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('duration_dmins', $flight_data) && $flight_data['duration_dmins'] == $i): ?> selected <?php endif; ?>>
                                      <?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
                                      <?php endfor; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 apndBtm20">
                                    <div class="makeflex">
                                      <!-- cabin baggage -->
                                      <div class="flexOne">
                                        <label>Cabin Baggage</label>
                                        <select name="flight[baggage]" class="form-control">
                                          <option value="" selected disabled>Cabin Bag</option>
                                          <option value="0 Kg" <?php if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='0 Kg'): ?> selected <?php endif; ?>>0 Kg</option>
                                          <option value="5 Kgs" <?php if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='5 Kgs'): ?> selected <?php endif; ?>>5 Kgs</option>
                                          <option value="7 Kgs" <?php if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='7 Kgs'): ?> selected <?php endif; ?>>7 Kgs</option>
                                          <option value="8 Kgs" <?php if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='8 Kgs'): ?> selected <?php endif; ?>>8 Kgs</option>
                                        </select>
                                      </div>

                                      <!-- check-in baggage -->
                                      <div class="flexOne">
                                        <label>Check-In Baggage</label>
                                        <select name="flight[cbaggage]" class="form-control">
                                          <option selected disabled>Check-In Bag</option>
                                          <option value="0 Kg" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='0 Kg'): ?> selected <?php endif; ?>>0 Kg</option>
                                          <option value="10 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='10 Kgs'): ?> selected <?php endif; ?>>10 Kgs</option>
                                          <option value="15 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='15 Kgs'): ?> selected <?php endif; ?>>15 Kgs</option>
                                          <option value="20 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='20 Kgs'): ?> selected <?php endif; ?>>20 Kgs</option>
                                          <option value="23 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='23 Kgs'): ?> selected <?php endif; ?>>23 Kgs</option>
                                          <option value="25 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='25 Kgs'): ?> selected <?php endif; ?>>25 Kgs</option>
                                          <option value="30 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='30 Kgs'): ?> selected <?php endif; ?>>30 Kgs</option>
                                          <option value="35 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='35 Kgs'): ?> selected <?php endif; ?>>35 Kgs</option>
                                          <option value="40 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='40 Kgs'): ?> selected <?php endif; ?>>40 Kgs</option>
                                          <option value="45 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='45 Kgs'): ?> selected <?php endif; ?>>45 Kgs</option>
                                          <option value="50 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='50 Kgs'): ?> selected <?php endif; ?>>50 Kgs</option>
                                          <option value="55 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='55 Kgs'): ?> selected <?php endif; ?>>55 Kgs</option>
                                          <option value="60 Kgs" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='60 Kgs'): ?> selected <?php endif; ?>>60 Kgs</option>
                                          <option value="1 Piece" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='1 Piece'): ?> selected <?php endif; ?>>1 Piece</option>
                                          <option value="2 Pieces" <?php if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='2 Pieces'): ?> selected <?php endif; ?>>2 Pieces</option>
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
                                    <input type="checkbox"  name="flight[return_required]"  id="return_required" value="1"  <?php if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1): ?> checked <?php endif; ?>>
                                  </div>
                                </div>

                                <div class="returnflight" <?php if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                                  <div class="col-md-12 appendBottom10">
                                    <p class="flightBoxHeading">RETURN FLIGHT</p>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Airline Name</label>
                                    <select name="flight[dname]" class="form-control down_filght">
                                      <option value="0">Select Airline</option>
                                      <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($airline->airline_name); ?>" <?php if($flight_data['dname']==$airline->airline_name): ?> selected <?php endif; ?>><?php echo e($airline->airline_name); ?> </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>Flight No.</label>
                                    <input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334" value="<?php echo e($flight_data['dno']); ?>">
                                  </div>

                                  <div class="col-md-4 appendBottom20">
                                    <label>No. Of Stop</label>
                                    <select name="flight[dnumberstop]" class="form-control">
                                      <option value="0" <?php if($flight_data['dnumberstop']==0): ?> selected <?php endif; ?>>Select Stopover</option>
                                      <option value="Non-Stop" <?php if($flight_data['dnumberstop']=="Non-Stop"): ?> selected <?php endif; ?>>Non-Stop</option>
                                      <?php for($i = 1; $i <= 4; $i++): ?>
                                      <?php if($i == 1): ?>
                                        <option value="<?php echo e($i); ?> Stop" <?php if($flight_data['dnumberstop']=="$i Stop"): ?> selected <?php endif; ?>><?php echo e($i); ?> Stop</option>
                                      <?php else: ?>
                                        <option value="<?php echo e($i); ?> Stops" <?php if($flight_data['dnumberstop']=="$i Stops"): ?> selected <?php endif; ?>><?php echo e($i); ?> Stops</option>
                                      <?php endif; ?>
                                      <?php endfor; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Flight Origin</label>
                                    <select name="flight[dOrigin]" class="form-control down_origin">
                                      <option value="0" <?php if($flight_data['dOrigin']==0): ?> selected <?php endif; ?>>Select Origin</option>
                                      <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="<?php echo e($val); ?>" <?php if($flight_data['dOrigin']==$val): ?> selected <?php endif; ?>><?php echo e($val); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Departure Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[ddhours]" class="form-control ddhours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ddhours',$flight_data) && $flight_data['ddhours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Hours</option>
                                      <?php for($i=1; $i<=24; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ddhours',$flight_data) && $flight_data['ddhours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[ddmins]" class="form-control ddmins" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=60;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ddmins',$flight_data) && $flight_data['ddmins']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('ddmins',$flight_data) && $flight_data['ddmins']==$i): ?> selected <?php endif; ?>><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Destination</label>
                                    <select name="flight[ddest]" class="form-control down_dest">
                                      <option value="0">Select Destination</option>
                                      <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
                                        <option value="<?php echo e($val); ?>" <?php if(array_key_exists('ddest',$flight_data) &&  $flight_data['ddest']==$val): ?> selected <?php endif; ?>><?php echo e($val); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Arrival Time</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[dahours]" class="form-control dahours" style="padding: 5px;max-width: 32%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dahours',$flight_data) && $flight_data['dahours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                        <option value="" disabled>Hours</option>
                                        <?php for($i=1; $i<=24; $i++): ?>
                                          <option value="<?php echo e($i); ?>" <?php if(array_key_exists('dahours',$flight_data) && $flight_data['dahours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
                                        <?php endfor; ?>
                                    </select>

                                    <select name="flight[damins]" class="form-control damins" style="padding: 5px;max-width: 37%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=60;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('damins',$flight_data) && $flight_data['damins']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('damins',$flight_data) && $flight_data['damins']==$i): ?> selected <?php endif; ?>><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[dadayplus]" class="form-control dadayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
                                      <option value="0" <?php if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==0): ?> selected <?php endif; ?>>+0 Day</option>
                                      <option value="1" <?php if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==1): ?> selected <?php endif; ?>>+1 Day</option>
                                      <option value="2" <?php if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==2): ?> selected <?php endif; ?>>+2 Day</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3">
                                    <label>Cabin Class</label>
                                    <select name="flight[dcabin]" class="form-control">
                                      <option value="economyclass" <?php if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='economyclass'): ?> selected <?php endif; ?>>Economy</option>
                                      <option value="premiumeconomyclass" <?php if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='premiumeconomyclass'): ?> selected <?php endif; ?>>Premium Economy</option>
                                      <option value="businessclass" <?php if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='businessclass'): ?> selected <?php endif; ?>>Business</option>
                                      <option value="firstclass" <?php if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='firstclass'): ?> selected <?php endif; ?>>First</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3 appendBottom20">
                                    <label>Fare Type</label>
                                    <select name="flight[dfaretype]" class="form-control">
                                      <option value="">Select</option>
                                      <option value="refundable" <?php if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                      <option value="partialrefundable" <?php if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='partialrefundable'): ?> selected <?php endif; ?>>Partial-refundable</option>
                                      <option value="non-refundable" <?php if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                    </select>
                                  </div>

                                  <div class="col-md-3">
                                    <label>Flight Duration</label>
                                    <div class="clearfix"></div>
                                    <select name="flight[return_duration_hours]" class="form-control return_duration_hours" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Hours</option>
                                      <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('return_duration_hours',$flight_data) && $flight_data['return_duration_hours']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> hrs </option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Hours</option>
                                      <?php for($i = 1; $i <= 40; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('return_duration_hours',$flight_data) && $flight_data['return_duration_hours']==$i): ?> selected <?php endif; ?>>
                                            <?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?>

                                        </option>
                                      <?php endfor; ?>
                                    </select>

                                    <select name="flight[return_duration_mins]" class="form-control return_duration_min" style="max-width: 49%;display: inline-block;">
                                      <!-- <option value="0">Minutes</option>
                                      <option value="0">00</option>
                                      <?php for($i=1;$i<=59;$i++): ?>
                                      <option value="<?php echo e($i); ?>" <?php if(array_key_exists('return_duration_mins',$flight_data) && $flight_data['return_duration_mins']==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> mins</option>
                                      <?php endfor; ?> -->
                                      <option value="" disabled>Minutes</option>
                                      <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(array_key_exists('return_duration_mins',$flight_data) && $flight_data['return_duration_mins']==$i): ?> selected <?php endif; ?>>
                                            <?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
                                        </option>
                                      <?php endfor; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-3 apndBtm20">
                                    <div class="makeflex">
                                      <!-- cabin baggage -->
                                      <div class="flexOne">
                                        <label>Cabin Baggage</label>
                                        <select name="flight[dbaggage]" class="form-control">
                                          <option selected disabled>Cabin Bag</option>
                                          <option value="0 Kg" <?php if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='0 Kg'): ?> selected <?php endif; ?>>0 Kg</option>
                                          <option value="5 Kgs" <?php if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='5 Kgs'): ?> selected <?php endif; ?>>5 Kgs</option>
                                          <option value="7 Kgs" <?php if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='7 Kgs'): ?> selected <?php endif; ?>>7 Kgs</option>
                                          <option value="8 Kgs" <?php if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='8 Kgs'): ?> selected <?php endif; ?>>8 Kgs</option>
                                        </select>
                                      </div>

                                      <!-- check-in baggage -->
                                      <div class="flexOne">
                                        <label>Check-In Baggage</label>
                                        <select name="flight[dcbaggage]" class="form-control">
                                          <option selected disabled>Check-In Bag</option>
                                          <option value="0 Kg" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='0 Kg'): ?> selected <?php endif; ?>>0 Kg</option>
                                          <option value="10 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='10 Kgs'): ?> selected <?php endif; ?>>10 Kgs</option>
                                          <option value="15 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='15 Kgs'): ?> selected <?php endif; ?>>15 Kgs</option>
                                          <option value="20 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='20 Kgs'): ?> selected <?php endif; ?>>20 Kgs</option>
                                          <option value="23 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='23 Kgs'): ?> selected <?php endif; ?>>23 Kgs</option>
                                          <option value="25 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='25 Kgs'): ?> selected <?php endif; ?>>25 Kgs</option>
                                          <option value="30 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='30 Kgs'): ?> selected <?php endif; ?>>30 Kgs</option>
                                          <option value="35 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='35 Kgs'): ?> selected <?php endif; ?>>35 Kgs</option>
                                          <option value="40 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='40 Kgs'): ?> selected <?php endif; ?>>40 Kgs</option>
                                          <option value="45 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='45 Kgs'): ?> selected <?php endif; ?>>45 Kgs</option>
                                          <option value="50 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='50 Kgs'): ?> selected <?php endif; ?>>50 Kgs</option>
                                          <option value="55 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='55 Kgs'): ?> selected <?php endif; ?>>55 Kgs</option>
                                          <option value="60 Kgs" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='60 Kgs'): ?> selected <?php endif; ?>>60 Kgs</option>
                                          <option value="1 Piece" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='1 Piece'): ?> selected <?php endif; ?>>1 Piece</option>
                                          <option value="2 Pieces" <?php if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='2 Pieces'): ?> selected <?php endif; ?>>2 Pieces</option>
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

                    <!-- tour accommodation -->
                    <div id="accommodation" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 form-group">

                              <!-- listed hotel -->
                              <label for="listed_hotel" class="select-hotel-type">
                                <input type="radio" id="listed_hotel" name="acc_type" checked class="extra_acc" <?php if($Packages->acc_type=="normal_acc"): ?> checked <?php endif; ?> value="normal_acc">Add Listed Hotel
                              </label>

                              <!-- unlisted hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="extra_acc" <?php if($Packages->acc_type=="extra_acc"): ?> checked <?php endif; ?>>Add Unlisted Hotel
                              </label>

                              <!-- hide hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="hide_acc" <?php if($Packages->acc_type=="hide_acc"): ?> checked <?php endif; ?>>Hide Hotel&nbsp;<i>(Not visible on the frontend)</i>
                              </label>
                            </div>

                            <!-- content -->
                            <?php
                              $option2_accommodation = unserialize($Packages->accommodation);
                              if (is_bool($option2_accommodation)) :
                                $option2_accommodation_count = "1";
                              else :
                                $option2_accommodation_count = count($option2_accommodation);
                              endif;
                            ?>
                            <div class="col-md-12">

                              <!-- listed accommodation content -->
                              <div class="accommodation_main" <?php if($Packages->acc_type=="normal_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
                                <?php
                                  $days = $Packages->duration;
                                  $days = (int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
                                  $j=0;
                                ?>
                                <div class="dynamic_acc">
                                  <input type="hidden" name="" value="<?php echo e($days); ?>">
                                  <?php if($Packages->accommodation!=''): ?>
                                  <?php $__currentLoopData = unserialize($Packages->accommodation); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($j>0): ?>
                                    <hr>
                                    <?php endif; ?>
                                  <div class="item-container field<?php echo e($j); ?>" id="<?php echo e($j); ?>">
                                    <div class="row">

                                      <!-- select nights -->
                                      <!-- <div class="col-md-6 appendBottom10">
                                        <label class="field-required">Select Duration</label>
                                        !-- Add the "Select all" checkbox and check if it should be checked --
                                        <label class="label-duration">
                                            Select all
                                            <input type="checkbox" class="all_days" 
                                                <?php if(array_key_exists('night', $col) && count($col['night']) === $days): ?> checked <?php endif; ?>>
                                        </label>
                                        <select class="form-control select_day select2" name="accommodation[<?php echo e($j); ?>][night][]" multiple>
                                          <?php for($i=1; $i<=$days; $i++): ?>
                                            <option value="Night <?php echo e($i); ?>" <?php if(array_key_exists('night',$col) && in_array("Night $i",$col["night"])): ?> selected <?php endif; ?>>Night <?php echo e($i); ?></option>
                                          <?php endfor; ?>
                                        </select>
                                      </div> -->

                                      <div class="col-md-6 appendBottom10">
                                        <label class="field-required">Select Duration</label>

                                        <!-- "Select all" checkbox -->
                                        <label class="label-duration">
                                            Select all
                                            <input type="checkbox" class="select_complete_duration"
                                                <?php if(!empty($col['night']) && count($col['night']) === $days): ?> checked <?php endif; ?>>
                                        </label>

                                        <!-- Multi-select dropdown -->
                                        <select class="form-control select_day select2" name="accommodation[<?php echo e($j); ?>][night][]" multiple>
                                            <?php for($i = 1; $i <= $days; $i++): ?>
                                                <?php 
                                                    $nightLabel = "Night $i";
                                                 ?>
                                                <option value="<?php echo e($nightLabel); ?>" 
                                                    <?php if(!empty($col['night']) && in_array($nightLabel, $col['night'])): ?> selected <?php endif; ?>>
                                                    <?php echo e($nightLabel); ?>

                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                      <!-- city -->
                                      <div class="col-md-3 appendBottom10 quote_city_class">
                                        <label class="field-required">City</label>
                                        <select class="quote_city form-control" name="accommodation[<?php echo e($j); ?>][city]" >
                                          <option <?php if(array_key_exists("city",$col)): ?> value="<?php echo e($col['city']); ?>" <?php endif; ?>><?php if(array_key_exists("city",$col)): ?> <?php echo e($col['city']); ?> <?php endif; ?></option>
                                        </select>
                                      </div>

                                      <!-- hotel type -->
                                      <div class="col-md-3 propertytype_class">
                                        <div class="form-group">
                                          <label class="field-required">Hotel Type</label>
                                          <!-- <select class="form-control propertytype" name="accommodation[<?php echo e($j); ?>][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <option value="hotel" <?php if(array_key_exists('propertytype',$col) && $col['propertytype']=='hotel'): ?> selected <?php endif; ?>>Hotel</option>
                                            <option value="resort" <?php if(array_key_exists('propertytype',$col) && $col['propertytype']=='resort'): ?> selected <?php endif; ?>>Resort</option>
                                            <option value="villa" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='villa'): ?> selected <?php endif; ?>>Villa</option>
                                            <option value="home" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='home'): ?> selected <?php endif; ?>>Home</option>
                                            <option value="camp" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='camp'): ?> selected <?php endif; ?>>Camp</option>
                                            <option value="cruise" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='cruise'): ?> selected <?php endif; ?>>Cruise</option>
                                          </select> -->
                                          <select class="form-control propertytype" name="accommodation[<?php echo e($j); ?>][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <?php 
                                                $propertyTypes = ['hotel', 'resort', 'villa', 'home', 'camp', 'cruise'];
                                                $selectedType = $col['propertytype'] ?? '';
                                             ?>
                                            <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($type); ?>" <?php echo e($selectedType === $type ? 'selected' : ''); ?>>
                                                <?php echo e(ucfirst($type)); ?>

                                              </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- hotel source -->
                                      <div class="col-md-4 appendBottom10 propertysource_class">
                                        <label class="field-required">Hotel Source</label>
                                        <!-- <select class="form-control propertysource" name="accommodation[<?php echo e($j); ?>][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <option value="packagehoteldatabase" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> selected <?php endif; ?>>Package Hotel Database</option>
                                          <option value="hoteldatabase" <?php if(array_key_exists('trip',$col) && $col['trip']=='hoteldatabase'): ?> selected <?php endif; ?>>Hotel Database</option>
                                          <option value="tripadvisor" <?php if(array_key_exists('trip',$col) && $col['trip']=='tripadvisor'): ?> selected <?php endif; ?>>TripAdvisor</option>
                                          <option value="manual" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> selected <?php endif; ?>>Manual</option>
                                        </select> -->
                                        <select class="form-control propertysource" name="accommodation[<?php echo e($j); ?>][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <?php 
                                            $tripSources = [
                                              'packagehoteldatabase' => 'Package Hotel Database',
                                              'hoteldatabase' => 'Hotel Database',
                                              'tripadvisor' => 'TripAdvisor',
                                              'manual' => 'Manual'
                                            ];
                                            $selectedTrip = $col['trip'] ?? '';
                                           ?>
                                          <?php $__currentLoopData = $tripSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($value); ?>" <?php echo e($selectedTrip === $value ? 'selected' : ''); ?>>
                                              <?php echo e($label); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <!-- select hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Name</label>
                                        <?php if(array_key_exists('city',$col) && array_key_exists('propertytype',$col)): ?>
                                        <?php $quote_hotel_data=CustomHelpers::get_quotation_hotel_new($col['city'],$col['propertytype']); ?>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[<?php echo e($j); ?>][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          <?php $__currentLoopData = $quote_hotel_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($single->id); ?>" <?php if(array_key_exists('hotel',$col) && $col['hotel']==$single->id): ?> selected <?php endif; ?>><?php echo e($single->hotelname); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                          <?php else: ?>
                                          <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                        </select>
                                        <?php endif; ?>
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" 
                                       style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Name</label>
                                        
                                        <?php 
                                          $quote_hotel_data = [];
                                          if(array_key_exists('city', $col) && array_key_exists('propertytype', $col)) {
                                            $quote_hotel_data = CustomHelpers::get_quotation_hotel_new($col['city'], $col['propertytype']);
                                          }
                                          $selectedHotel = $col['hotel'] ?? '';
                                         ?>

                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[<?php echo e($j); ?>][hotel]">
                                          <option value="0" selected disabled>Select</option>
                                            <?php $__currentLoopData = $quote_hotel_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($single->id); ?>" <?php echo e($selectedHotel == $single->id ? 'selected' : ''); ?>>
                                                <?php echo e($single->hotelname); ?>

                                              </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>


                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[<?php echo e($j); ?>][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1" <?php if(array_key_exists('star',$col) && $col['star']==1): ?> selected <?php endif; ?>>1 star</option>
                                          <option value="2" <?php if(array_key_exists('star',$col) && $col['star']==2): ?> selected <?php endif; ?>>2 star</option>
                                          <option value="3" <?php if(array_key_exists('star',$col) &&  $col['star']==3): ?> selected <?php endif; ?>>3 star</option>
                                          <option value="4" <?php if(array_key_exists('star',$col) &&  $col['star']==4): ?> selected <?php endif; ?>>4 star</option>
                                          <option value="5" <?php if(array_key_exists('star',$col) &&  $col['star']==5): ?> selected <?php endif; ?>>5 star</option>
                                        </select>
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[<?php echo e($j); ?>][star]">
                                          <option selected disabled>Select</option>
                                          <?php for($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e((array_key_exists('star', $col) && $col['star'] == $i) ? 'selected' : ''); ?>>
                                              <?php echo e($i); ?> star
                                            </option>
                                          <?php endfor; ?>
                                        </select>
                                      </div>


                                      <!-- enter hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 propertyname" id="propertyname" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Enter property name" value="<?php echo e($col['other_hotel']); ?>">
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Enter property name" value="<?php echo e($col['other_hotel'] ?? ''); ?>">
                                      </div>


                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='1' <?php if(array_key_exists('star_other',$col) && $col['star_other']==1): ?> selected <?php endif; ?>>1 star</option>
                                          <option value='2' <?php if(array_key_exists('star_other',$col) && $col['star_other']==2): ?> selected <?php endif; ?>>2 star</option>
                                          <option value='3' <?php if(array_key_exists('star_other',$col) && $col['star_other']==3): ?> selected <?php endif; ?>>3 star</option>
                                          <option value='4' <?php if(array_key_exists('star_other',$col) && $col['star_other']==4): ?> selected <?php endif; ?>>4 star</option>
                                          <option value='5' <?php if(array_key_exists('star_other',$col) && $col['star_other']==5): ?> selected <?php endif; ?>>5 star</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]">
                                            <option selected disabled>Select</option>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                              <option value="<?php echo e($i); ?>" <?php echo e((array_key_exists('star_other', $col) && $col['star_other'] == $i) ? 'selected' : ''); ?>>
                                                <?php echo e($i); ?> star
                                              </option>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                      <div class="col-md-12"></div>

                                      <!-- room type -->
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][category]" placeholder="Enter room type" value="<?php echo e($col['category']); ?>">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[<?php echo e($j); ?>][hotel_link]" placeholder="Enter hotel website" value="<?php echo e($col['hotel_link']); ?>">
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" name="accommodation[<?php echo e($j); ?>][contact]" placeholder="Enter hotel contact no" value="<?php echo e($col['hotel_link']); ?>">
                                      </div>

                                      <!-- meals -->
                                      <!-- <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[<?php echo e($j); ?>][meals]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Room Only' <?php if(array_key_exists('meals',$col) && $col['meals']=='Room Only'): ?> selected <?php endif; ?>>Room Only</option>
                                          <option value='Breakfast' <?php if(array_key_exists('meals',$col) && $col['meals']=='Breakfast'): ?> selected <?php endif; ?>>Breakfast</option>
                                          <option value='Half Board' <?php if(array_key_exists('meals',$col) && $col['meals']=='Half Board'): ?> selected <?php endif; ?>>Half Board</option>
                                          <option value='Full Board' <?php if(array_key_exists('meals',$col) && $col['meals']=='Full Board'): ?> selected <?php endif; ?>>Full Board</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[<?php echo e($j); ?>][meals]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Room Only', 'Breakfast', 'Half Board', 'Full Board']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($meal); ?>" <?php echo e((array_key_exists('meals', $col) && $col['meals'] == $meal) ? 'selected' : ''); ?>>
                                              <?php echo e($meal); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>


                                      <!-- hotel price type -->
                                      <?php if($j>0): ?>
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                        <!-- <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                          <option value='Non-refundable' <?php if(array_key_exists('faretype',$col) &&  $col['faretype']=='Non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Refundable', 'Non-refundable']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fareType): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($fareType); ?>" <?php echo e((array_key_exists('faretype', $col) && $col['faretype'] == $fareType) ? 'selected' : ''); ?>>
                                                <?php echo e($fareType); ?>

                                              </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <div class="col-md-4 appendTop20">
                                        <button type="button" name="add" id="<?php echo e($j); ?>" class="remove_acco btn btn-danger">Remove</button>
                                      </div>

                                      <?php else: ?>
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                       <!--  <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                          <option value='Non-refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Refundable', 'Non-refundable']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fareType): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($fareType); ?>" <?php echo e((!empty($col['faretype']) && $col['faretype'] == $fareType) ? 'selected' : ''); ?>>
                                              <?php echo e($fareType); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <div class="col-md-4"></div>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                  <?php $j++; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                  <?php else: ?>
                                  <div class="item-container field0" id="0">
                                    <div class="row">

                                      <!-- select nights -->
                                      <div class="col-md-6 form-group daysel">
                                        <label class="field-required">Select Duration</label>
                                        <label class="label-duration">Select all<input type="checkbox" class="all_days"></label>
                                        <select class="form-control select_day select2" multiple name="accommodation[0][night][]">
                                          <?php for($i=1; $i<=$days; $i++): ?>
                                            <option value="Night <?php echo e($i); ?>">Night <?php echo e($i); ?></option>
                                          <?php endfor; ?>
                                        </select>
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
                                      <div class="col-md-4 appendBottom10 propertysource_class">
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
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" style="display: none">
                                        <label class="field-required">Hotel Name</label>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          <!--<option value="other">Unlisted Property</option>-->
                                        </select>
                                      </div>

                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: none">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[0][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1">1 star</option>
                                          <option value="2">2 star</option>
                                          <option value="3">3 star</option>
                                          <option value="4">4 star</option>
                                          <option value="5">5 star</option>
                                        </select>
                                      </div>

                                      <!-- enter hotel name -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: none">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
                                      </div>

                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
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
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][category]" placeholder="Enter room type">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" placeholder="Enter hotel contact no" name="accommodation[0][contact]">
                                      </div>

                                      <!-- meals -->
                                      <div class="col-md-4 appendBottom10">
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
                                      <div class="col-md-4 appendBottom10">
                                        <div class="form-group">
                                          <label>Hotel Price Type</label>
                                          <select class="form-control accommodationFareType" name="accommodation[0][faretype]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Refundable'>Refundable</option>
                                            <option value='Non-refundable'>Non-refundable</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-4"></div>

                                    </div>
                                  </div>
                                  <?php endif; ?>
                                </div>

                                <!-- add more hotel -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <!-- <button type="button" name="add" id="add_acco_tours" days="<?php echo e($days); ?>" class="btn btn-success">Add More</button> -->
                                    <button type="button" name="add" id="add_acco" days="<?php echo e($days); ?>" class="btn btn-success">(+) Add more hotel</button>
                                  </div>
                                </div>

                              </div>

                              <!-- unlisted accommodation content -->
                              <div class="accommodation_extra item-container" <?php if($Packages->acc_type=="extra_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
                                <label class="field-required">Unlisted Hotel details</label>
                                <textarea class="form-control ckeditor" rows="3" name="accommodation_extra"><?php echo $Packages->accommodation_extra; ?></textarea>
                              </div>

                            </div>
                        </div>
                      </div>
                    </div>

                    <!-- tour transfers -->
                    <div id="transfers" class="tab-pane fade">
                      <?php
                        $option_transfer = unserialize($Packages->transfers);
                        if (is_bool($option_transfer)) :
                          $option_transfer_count = "1";
                        else :
                          $option_transfer_count = count($option_transfer);
                        endif;
                      ?>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12 transfers_input_wrapper">
                            <?php $j = 0 ?>
                            <?php if(is_array($option_transfer) || is_object($option_transfer)): ?>
                              <?php $__currentLoopData = $option_transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php $j++ ?>
                                <div class="transfers_input" id="transfers_input-<?php echo e($j); ?>" data-id="<?php echo e($j); ?>">

                                  <div class="item-container">
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="">Transfer Title</label>
                                        <input type="text" name="transfers[<?php echo e($j); ?>][mode_title]" value="<?php echo e($transfer['mode_title']); ?>" class="form-control mode_title" placeholder="Title">
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="">Select Transfer Mode</label>
                                        <select name="transfers[<?php echo e($j); ?>][transport_type]" id="transfers[<?php echo e($j); ?>][transport_type]" class="form-control transfer_mode">
                                        <option value="">--Choose Transport--</option>
                                        <option value="Car" <?php if($transfer!="" && $transfer['transport_type']=='Car' ): ?> selected <?php endif; ?>>Car</option>
                                        <option value="Bus" <?php if($transfer!="" && $transfer['transport_type']=='Bus' ): ?> selected <?php endif; ?>>Bus</option>
                                        <option value="Train" <?php if($transfer!="" && $transfer['transport_type']=='Train' ): ?> selected <?php endif; ?>>Train</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="">Select Transfers</label>
                                        <select name="transfers[<?php echo e($j); ?>][transfers_type]" id="transfers_type0" class="form-control transfers_type">
                                          <option value="0">--Select Transfers--</option>
                                          <?php /*@foreach($transfers->unique('transfer_type') as $transfer1)
                                          <option value="{{$transfer1->title}}" @if($transfer!="" && $transfer['transfers_type']==$transfer1->title) selected @endif>{{$transfer1->title}} </option>
                                          @endforeach*/ ?>
                                          <option <?php if($transfer!="" && !empty($transfer['transfers_type'])): ?> selected value="<?php echo e($transfer['transfers_type']); ?>" <?php endif; ?>><?php echo e($transfer['transfers_type']); ?> </option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php else: ?>
                              <div class="transfers_input" id="transfers_input-0" data-id="0">
                                <input type="hidden" name="" value="">
                                <div class="item-container field-0" id="0">

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="">Title</label>
                                      <input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Select Transfer Mode</label>
                                      <select name="transfers[0][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
                                        <option value="">--Choose Transport--</option>
                                        <option value="Car">Car</option>
                                        <option value="Bus">Bus</option>
                                        <option value="Train">Train</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="">Select Transfers</label>
                                      <select name="transfers[0][transfers_type]" id="transfers_type0" class="form-control transfers_type">
                                        <?php /*<option value="0">--Select Transfers--</option>
                                        @foreach($transfers->unique('transfer_type') as $transfer)
                                        <option value="{{$transfer->title}}">{{$transfer->title}} </option>
                                        @endforeach*/ ?>
                                        <option value="0">--Select Transfers--</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="col-md-12">
                            <button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">Add More</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- tour itinerary -->
                    <div id="Itinerary" class="tab-pane fade">
                      <div class="panel-body c_body">
                        <div class="row">
                          <div class="table-responsive">
                            <?php $day_count = count($packagesData->day_itinerary); ?>
                            <?php for($i=1 ; $i<= $day_count ; $i++): ?>
                            <div class="col-md-12 dayItinerary day1">
                              <div class="item-container">
                                <div class="row">

                                  <!-- day title -->
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="field-required">DAY <?php echo e($i); ?></label>
                                      <input type="text" class="form-control" name="dayItinerary[day<?php echo e($i); ?>][title]" value="<?php echo e($packagesData->day_itinerary["day$i"]["title"]); ?>">
                                    </div>
                                  </div>
                                
                                  <!-- tour activity -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Tour Activity</label>
                                      <select class='select2 form-control dayItineraryactivity custom_days' name="dayItinerary[day<?php echo e($i); ?>][activities][]" multiple>
                                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($activity->activity); ?>" <?php if(!empty($packagesData->day_itinerary["day$i"]["activities"]) && in_array($activity->activity ,
                                        $packagesData->day_itinerary["day$i"]["activities"])): ?> selected='selected' <?php endif; ?>><?php echo e($activity->activity); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- meal plan -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Meal Plan (in hotel)</label>
                                      <select name="dayItinerary[day<?php echo e($i); ?>][meal_plan]" class="form-control">
                                        <option value="N" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="N"): ?> selected='selected' <?php endif; ?>>No Meal</option>
                                        <option value="EP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="EP"): ?> selected='selected' <?php endif; ?>>Room Only</option>
                                        <option value="CP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="CP"): ?> selected='selected' <?php endif; ?>> Breakfast </option>
                                        <option value="lu" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="lu"): ?> selected='selected' <?php endif; ?>>Lunch </option>
                                        <option value="di" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="di"): ?> selected='selected' <?php endif; ?>>Dinner </option>
                                        <option value="bd" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bd"): ?> selected='selected' <?php endif; ?>> Breakfast & Dinner </option>
                                        <option value="bl" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bl"): ?> selected='selected' <?php endif; ?>> Breakfast & Lunch </option>
                                        <option value="ld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="ld"): ?> selected='selected' <?php endif; ?>>Lunch & Dinner </option>
                                        <option value="bld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bld"): ?> selected='selected' <?php endif; ?>> Breakfast & Lunch/Dinner </option>
                                        <option value="bldall" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bldall"): ?> selected='selected' <?php endif; ?>>Breakfast, Lunch & Dinner </option>
                                        <option value="apai" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="apai"): ?> selected='selected' <?php endif; ?>>All Inclusive </option>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour sightseeing -->
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                    <label>Tour Sightseeing</label>
                                    <select class='select2 form-control dayItinerarytour custom_days' name="dayItinerary[day<?php echo e($i); ?>][tours][]" multiple>
                                      <?php $__currentLoopData = $PkgTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <?php if(array_key_exists("tours",$packagesData->day_itinerary["day$i"])): ?>
                                      <option value="<?php echo e($tour->id); ?>" <?php if(in_array($tour->id ,
                                      $packagesData->day_itinerary["day$i"]["tours"])): ?> selected='selected' <?php endif; ?>><?php echo e($tour->activity); ?></option>
                                      <?php else: ?>
                                      <option value="<?php echo e($tour->id); ?>"><?php echo e($tour->activity); ?></option>
                                      <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                    </div>
                                  </div>

                                  <!-- tour day plan -->
                                  <div class="col-md-12 custom_inc_exc">
                                    <div class="form-group">
                                      <label>Day Plan</label>
                                      <br>
                                      <span class="show_hide morePlus">More+</span>
                                      <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day<?php echo e($i); ?>][desc]"><?php echo e($packagesData->day_itinerary["day$i"]["desc"]); ?></textarea>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                            <?php endfor; ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- -------------------------------------------- -->

                    <!-- tour pricing (not in use) -->
                    <div id="Pricing" class="tab-pane fade" style="display: none;">
                      <?php
                      $ss = $packagesData->pricing["0"];
                      //dd($ss)
                      ?>
                      <div id="Pricing">
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                        <label for="">Is On Request?</label>
                        <input type="checkbox" <?php if($packagesData->onrequest == 1): ?> checked <?php endif; ?> value="1" name="onrequest" id="onrequest" />
                        <label for="" style="margin-left: 25px">Upcoming Package?</label>
                        <input type="checkbox" <?php if($packagesData->upcoming == 1): ?> checked <?php endif; ?> value="1" name="upcoming" id="upcoming" />
                        </div>
                        <div class="form-group pricelistpackage" <?php if($packagesData->onrequest == 1): ?> style="display:none;" <?php endif; ?>>
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                        <tr>
                        <th>Price title</th>
                        <th>Price type</th>
                        <th>Confirmation Type</th>
                        <th>
                        </th>
                        <th></th>
                        </tr>
                        <tr>
                        <td><input name="Price_title" placeholder="Title.." class="form-control" type="text" value="<?php echo e($packagesData->Price_title); ?>"></td>
                        <td>
                        <select name="Price_type" class="form-control">
                        <option value="0">Select Type </option>
                        <option value="Per Person" <?php if($packagesData->Price_type=="Per Person"): ?> selected="selected" <?php endif; ?> >Per Person </option>
                        <option value="Per Group" <?php if($packagesData->Price_type=="Per Group"): ?> selected="selected" <?php endif; ?>>Per Group</option>
                        </select>
                        </td>
                        <td>
                        <select name="confirmation_type" class="form-control">
                        <option value="0">Select Type </option>
                        <option value="Instant Confirmation" <?php if(!empty($packagesData->confirmation_type) && $packagesData->confirmation_type=="Instant Confirmation"): ?> selected="selected" <?php endif; ?>>Instant Confirmation</option>
                        <option value="Confirmation in 24-48 hrs" <?php if(!empty($packagesData->confirmation_type) && $packagesData->confirmation_type=="Confirmation in 24-48 hrs"): ?> selected="selected" <?php endif; ?>>Confirmation in 24-48 hrs</option>
                        <option value="On-Request" <?php if(!empty($packagesData->confirmation_type) && $packagesData->confirmation_type=="On-Request"): ?> selected="selected" <?php endif; ?>>On-Request</option>
                        </select>
                        </td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <th>Package Rating</th>
                        <th>Price from</th>
                        <th>Price to</th>
                        <th>Cut Off Point</th>
                        </tr>
                        <?php
                        $price_count = count($packagesData->pricing);
                        $priceing = $packagesData->pricing;
                        $pri = [];
                        foreach ($priceing as $prices) :
                        $pri[] = $prices;
                        endforeach;
                        $packagesData->pricing = $pri;
                        ?>
                        <?php for($i=1;$i<=$price_count;$i++): ?> <?php
                        $j = ($i - 1);
                        ?> <tr id="row<?php echo e($i); ?>">
                        <td>
                        <select name="Price[<?php echo e($j); ?>][package_rating]" id="rating " class="form-control rating-field" style="width: 40%;display:inline-block">
                        <?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <?php
                        if (array_key_exists("package_rating", $packagesData->pricing["$j"])) :
                        $rating_array = explode(" ", $packagesData->pricing["$j"]["package_rating"]);
                        endif;
                        ?>
                        <option value='<?php echo e($rtyp->id); ?>' <?php if(in_array($rtyp->id , $rating_array )): ?> selected="selected" <?php endif; ?> ><?php echo e($rtyp->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <option value='other' <?php if(in_array('other' , $rating_array )): ?> selected="selected" <?php endif; ?> >Other</option>
                        </select>
                        <input name="Price[<?php echo e($j); ?>][package_rating_other]" id="otherrating<?php echo e($j); ?>" class="form-control other-rating" style="width: 50%;display:none" <?php if(!empty($packagesData->pricing["$j"]["package_rating_other"])): ?> value="<?php echo e($packagesData->pricing["$j"]["package_rating_other"]); ?>" <?php endif; ?>>
                        </td>
                        <td>
                        <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input name="Price[<?php echo e($j); ?>][datefrom]" class="form-control pull-right datepicker" type="text" value="<?php echo e($packagesData->pricing["$j"]["datefrom"]); ?>">
                        </div>
                        </td>
                        <td>
                        <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input name="Price[<?php echo e($j); ?>][dateto]" class="form-control pull-right datepicker" type="text" value="<?php echo e($packagesData->pricing["$j"]["dateto"]); ?>">
                        </div>
                        </td>
                        <td>
                        <input type="number" name="Price[<?php echo e($j); ?>][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days" <?php if(array_key_exists("cuttoffpoint",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["cuttoffpoint"]); ?>" <?php endif; ?>>
                        </td>
                        <td>
                        <div class="c_price<?php echo e($j); ?>" id="c_price<?php echo e($j); ?>">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_adult]" <?php if(array_key_exists("airfare_adult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_adult"]); ?>" <?php endif; ?> class="air_fare_adult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_exadult]" <?php if(array_key_exists("airfare_exadult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_exadult"]); ?>" <?php endif; ?> class="air_fare_exadult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_childbed]" <?php if(array_key_exists("airfare_childbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_childbed"]); ?>" <?php endif; ?> class="air_fare_childbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_childwbed]" <?php if(array_key_exists("airfare_childwbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_childwbed"]); ?>" <?php endif; ?> class="air_fare_childwbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_infant]" <?php if(array_key_exists("airfare_infant",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_infant"]); ?>" <?php endif; ?> class="air_fare_infant">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][airfare_single]" <?php if(array_key_exists("airfare_single",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["airfare_single"]); ?>" <?php endif; ?> class="air_fare_single">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][aircurrency]" <?php if(array_key_exists("aircurrency",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["aircurrency"]); ?>" <?php endif; ?> class="air_currency">
                        <!---->
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_adult]" <?php if(array_key_exists("hotelfare_adult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_adult"]); ?>" <?php endif; ?> class="hotel_fare_adult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_exadult]" <?php if(array_key_exists("hotelfare_exadult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_exadult"]); ?>" <?php endif; ?> class="hotel_fare_exadult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_childbed]" <?php if(array_key_exists("hotelfare_childbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_childbed"]); ?>" <?php endif; ?> class="hotel_fare_childbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_childwbed]" <?php if(array_key_exists("hotelfare_childwbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_childwbed"]); ?>" <?php endif; ?> class="hotel_fare_childwbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_infant]" <?php if(array_key_exists("hotelfare_infant",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_infant"]); ?>" <?php endif; ?> class="hotel_fare_infant">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelfare_single]" <?php if(array_key_exists("hotelfare_single",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelfare_single"]); ?>" <?php endif; ?> class="hotel_fare_single">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][hotelcurrency]" <?php if(array_key_exists("hotelcurrency",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["hotelcurrency"]); ?>" <?php endif; ?> class="hotel_currency">
                        <!---->
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_adult]" <?php if(array_key_exists("tourfare_adult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_adult"]); ?>" <?php endif; ?> class="tour_fare_adult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_exadult]" <?php if(array_key_exists("tourfare_exadult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_exadult"]); ?>" <?php endif; ?> class="tour_fare_exadult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_childbed]" <?php if(array_key_exists("tourfare_childbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_childbed"]); ?>" <?php endif; ?> class="tour_fare_childbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_childwbed]" <?php if(array_key_exists("tourfare_childwbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_childwbed"]); ?>" <?php endif; ?> class="tour_fare_childwbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_infant]" <?php if(array_key_exists("tourfare_infant",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_infant"]); ?>" <?php endif; ?> class="tour_fare_infant">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourfare_single]" <?php if(array_key_exists("tourfare_single",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourfare_single"]); ?>" <?php endif; ?> class="tour_fare_single">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][tourcurrency]" <?php if(array_key_exists("tourcurrency",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["tourcurrency"]); ?>" <?php endif; ?> class="tour_currency">
                        <!---->
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_adult]" <?php if(array_key_exists("transferfare_adult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_adult"]); ?>" <?php endif; ?> class="transfer_fare_adult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_exadult]" <?php if(array_key_exists("transferfare_exadult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_exadult"]); ?>" <?php endif; ?> class="transfer_fare_exadult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_childbed]" <?php if(array_key_exists("transferfare_childbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_childbed"]); ?>" <?php endif; ?> class="transfer_fare_childbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_childwbed]" <?php if(array_key_exists("transferfare_childwbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_childwbed"]); ?>" <?php endif; ?> class="transfer_fare_childwbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_infant]" <?php if(array_key_exists("transferfare_infant",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_infant"]); ?>" <?php endif; ?> class="transfer_fare_infant">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transferfare_single]" <?php if(array_key_exists("transferfare_single",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transferfare_single"]); ?>" <?php endif; ?> class="transfer_fare_single">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][transfercurrency]" <?php if(array_key_exists("transfercurrency",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["transfercurrency"]); ?>" <?php endif; ?> class="transfer_currency">
                        <!---->
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_adult]" <?php if(array_key_exists("visafare_adult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_adult"]); ?>" <?php endif; ?> class="visa_fare_adult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_exadult]" <?php if(array_key_exists("visafare_exadult",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_exadult"]); ?>" <?php endif; ?> class="visa_fare_exadult">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_childbed]" <?php if(array_key_exists("visafare_childbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_childbed"]); ?>" <?php endif; ?> class="visa_fare_childbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_childwbed]" <?php if(array_key_exists("visafare_childwbed",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_childwbed"]); ?>" <?php endif; ?> class="visa_fare_childwbed">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_infant]" <?php if(array_key_exists("visafare_infant",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_infant"]); ?>" <?php endif; ?> class="visa_fare_infant">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visafare_single]" <?php if(array_key_exists("visafare_single",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visafare_single"]); ?>" <?php endif; ?> class="visa_fare_single">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][visacurrency]" <?php if(array_key_exists("visacurrency",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["visacurrency"]); ?>" <?php endif; ?> class="visa_currency">
                        <!---->
                        <input type="hidden" name="Price[<?php echo e($j); ?>][adult_fare_total]" <?php if(array_key_exists("adult_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["adult_fare_total"]); ?>" <?php endif; ?> class="adult_fare_total">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][exadult_fare_total]" <?php if(array_key_exists("exadult_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["exadult_fare_total"]); ?>" <?php endif; ?> class="exadult_fare_total">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][childwithbed_fare_total]" <?php if(array_key_exists("childwithbed_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["childwithbed_fare_total"]); ?>" <?php endif; ?> class="childwithbed_fare_total">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][childwithoutbed_fare_total]" <?php if(array_key_exists("childwithoutbed_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["childwithoutbed_fare_total"]); ?>" <?php endif; ?> class="childwithoutbed_fare_total">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][infant_fare_total]" <?php if(array_key_exists("infant_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["infant_fare_total"]); ?>" <?php endif; ?> class="infant_fare_total">
                        <input type="hidden" name="Price[<?php echo e($j); ?>][single_fare_total]" <?php if(array_key_exists("single_fare_total",$packagesData->pricing["$j"])): ?> value="<?php echo e($packagesData->pricing["$j"]["single_fare_total"]); ?>" <?php endif; ?> class="single_fare_total">
                        </div>
                        <button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="c_price<?php echo e($j); ?>">Add Price</button>
                        </td>
                        <td>
                        <?php if($i>"1"): ?>
                        <button type="button" name="remove" id="<?php echo e($i); ?>" class="btn btn-danger btn_remove">X</button>
                        <?php endif; ?>
                        </td>
                        </tr>
                        <?php endfor; ?>
                        </table>
                        <button type="button" name="add" id="add-price-row" class="btn btn-success" style="margin-left: 10px">Add More
                        </button>
                        </div>
                        </div>
                        <!--upcoming start-->
                        <div class="form-group pricelistpackage_upcoming" <?php if($packagesData->upcoming == 1): ?> style="display:none;" <?php endif; ?>>
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
                        <td><input name="Price_title_upcoming" placeholder="Title.." class="form-control" type="text" value="<?php echo e($packagesData->upcoming_title); ?>"></td>
                        <td>
                        <select name="Price_type_upcoming" class="form-control">
                        <option value="0">Select Type </option>
                        <option value="Per Person" <?php if($packagesData->upcoming_type=="Per Person"): ?> selected="selected" <?php endif; ?> >Per Person </option>
                        <option value="Per Group" <?php if($packagesData->upcoming_type=="Per Group"): ?> selected="selected" <?php endif; ?>>Per Group</option>
                        </select>
                        </td>
                        <td>
                        <select name="confirmation_type_upcoming" class="form-control">
                        <option value="0">Select Type </option>
                        <option value="Instant Confirmation" <?php if(!empty($packagesData->confirmation_type_upcoming) && $packagesData->confirmation_type_upcoming=="Instant Confirmation"): ?> selected="selected" <?php endif; ?>>Instant Confirmation</option>
                        <option value="Confirmation in 24-48 hrs" <?php if(!empty($packagesData->confirmation_type_upcoming) && $packagesData->confirmation_type_upcoming=="Confirmation in 24-48 hrs"): ?> selected="selected" <?php endif; ?>>Confirmation in 24-48 hrs</option>
                        <option value="On-Request" <?php if(!empty($packagesData->confirmation_type_upcoming) && $packagesData->confirmation_type_upcoming=="On-Request"): ?> selected="selected" <?php endif; ?>>On-Request</option>
                        </select>
                        </td>
                        <td></td>
                        <td></td>
                        </tr>
                        <tr>
                        <th>Package Rating</th>
                        <th>Price from</th>
                        <th>Price to</th>
                        <th>Cut Off Point</th>
                        </tr>
                        <?php if($packagesData->upcoming_pricing!=''): ?>
                        <?php
                        $price_up_count = count($packagesData->upcoming_pricing);
                        $priceingup = $packagesData->upcoming_pricing;
                        $priup = [];
                        foreach ($priceingup as $prices) :
                        $priup[] = $prices;
                        endforeach;
                        $packagesData->priceingup = $priup;
                        ?>
                        <?php for($i=1;$i<=$price_up_count;$i++): ?> <?php
                        $j = ($i - 1);
                        ?> <tr id="up_row<?php echo e($i); ?>">
                        <td>
                        <select name="Price_upcoming[<?php echo e($j); ?>][package_rating]" id="rating_upcoming" class="form-control rating-field" style="width: 40%;display:inline-block">
                        <?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <?php
                        $rating_up_array = explode(" ", $packagesData->upcoming_pricing["$j"]["package_rating"]);
                        ?>
                        <option value='<?php echo e($rtyp->id); ?>' <?php if(in_array($rtyp->id , $rating_up_array )): ?> selected="selected" <?php endif; ?> ><?php echo e($rtyp->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <option value='other' <?php if(in_array('other' , $rating_up_array )): ?> selected="selected" <?php endif; ?> >Other</option>
                        </select>
                        <input name="Price_upcoming[<?php echo e($j); ?>][package_rating_other]" id="otherrating<?php echo e($j); ?>" class="form-control other-rating" style="width: 50%;display:none" <?php if(!empty($packagesData->upcoming_pricing["$j"]["package_rating_other"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["package_rating_other"]); ?>" <?php endif; ?>>
                        </td>
                        <td>
                        <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input name="Price_upcoming[<?php echo e($j); ?>][datefrom]" class="form-control pull-right datepicker" type="text" value="<?php echo e($packagesData->upcoming_pricing["$j"]["datefrom"]); ?>">
                        </div>
                        </td>
                        <td>
                        <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input name="Price_upcoming[<?php echo e($j); ?>][dateto]" class="form-control pull-right datepicker" type="text" value="<?php echo e($packagesData->upcoming_pricing["$j"]["dateto"]); ?>">
                        </div>
                        </td>
                        <td>
                        <input type="number" name="Price_upcoming[<?php echo e($j); ?>][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("cuttoffpoint",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["cuttoffpoint"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        >
                        </td>
                        <td>
                        <div class="cup_price<?php echo e($j); ?>" id="cup_price<?php echo e($j); ?>">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_adult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_adult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_adult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_adult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_exadult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_exadult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_exadult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_exadult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_childbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_childbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_childbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_childbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_childwbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_childwbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_childwbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_childwbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_infant]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_infant",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_infant"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_infant">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][airfare_single]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("airfare_single",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["airfare_single"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_fare_single">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][aircurrency]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("aircurrency",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["aircurrency"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="air_currency">
                        <!---->
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_adult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_adult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_adult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_adult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_exadult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_exadult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_exadult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_exadult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_childbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_childbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_childbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_childbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_childwbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_childwbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_childwbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_childwbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_infant]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_infant",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_infant"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_infant">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelfare_single]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelfare_single",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelfare_single"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_fare_single">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][hotelcurrency]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("hotelcurrency",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["hotelcurrency"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="hotel_currency">
                        <!---->
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_adult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_adult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_adult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_adult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_exadult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_exadult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_exadult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_exadult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_childbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_childbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_childbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_childbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_childwbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_childwbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_childwbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_childwbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_infant]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_infant",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_infant"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_infant">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourfare_single]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourfare_single",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourfare_single"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_fare_single">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][tourcurrency]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("tourcurrency",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["tourcurrency"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="tour_currency">
                        <!---->
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_adult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_adult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_adult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_adult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_exadult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_exadult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_exadult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_exadult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_childbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_childbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_childbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_childbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_childwbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_childwbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_childwbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_childwbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_infant]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_infant",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_infant"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_infant">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transferfare_single]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transferfare_single",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transferfare_single"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_fare_single">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][transfercurrency]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("transfercurrency",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["transfercurrency"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="transfer_currency">
                        <!---->
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_adult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_adult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_adult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_adult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_exadult]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_exadult",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_exadult"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_exadult">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_childbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_childbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_childbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_childbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_childwbed]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_childwbed",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_childwbed"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_childwbed">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_infant]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_infant",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_infant"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_infant">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visafare_single]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visafare_single",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visafare_single"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_fare_single">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][visacurrency]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("visacurrency",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["visacurrency"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="visa_currency">
                        <!---->
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][adult_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("adult_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["adult_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="adult_fare_total">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][exadult_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("exadult_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["exadult_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="exadult_fare_total">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][childwithbed_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("childwithbed_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["childwithbed_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="childwithbed_fare_total">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][childwithoutbed_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("childwithoutbed_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["childwithoutbed_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="childwithoutbed_fare_total">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][infant_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("infant_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["infant_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="infant_fare_total">
                        <input type="hidden" name="Price_upcoming[<?php echo e($j); ?>][single_fare_total]" <?php if($packagesData->upcoming_pricing!=""): ?>
                        <?php if(array_key_exists("single_fare_total",$packagesData->upcoming_pricing["$j"])): ?> value="<?php echo e($packagesData->upcoming_pricing["$j"]["single_fare_total"]); ?>" <?php endif; ?>
                        <?php endif; ?>
                        class="single_fare_total">
                        </div>
                        <button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="cup_price<?php echo e($j); ?>">Add Price</button>
                        </td>
                        <td>
                        <?php if($i>"1"): ?>
                        <button type="button" name="remove" id="<?php echo e($i); ?>" class="btn btn-danger btn_remove_up">X</button>
                        <?php endif; ?>
                        </td>
                        </tr>
                        <?php endfor; ?>
                        <?php endif; ?>
                        </table>
                        <button type="button" name="add" id="add_upcoming_price_row" class="btn btn-success" style="margin-left: 10px">Add More
                        </button>
                        </div>
                        </div>
                        <!--upcoming end-->
                        </div>
                        </div>
                        </div>
                        </div>
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
                    <?php $new_price=CustomHelpers::get_package_new_price($packagesData->newprices); ?>
                    <div id="NewPricing" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group pricelistpackage" >
                              <div class="table-responsive no-border">
                                <?php echo $__env->make('manage_packages.price_fields_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                          
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
                      </div> <!-- close modal -->

                    </div>

                    <!-- tour supplier -->
                    <div id="Supplier" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="item-container">
                          <div class="row">

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Supplier Name</label>
                                <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->supplier_name); ?>" <?php endif; ?> name="supplier_name" placeholder="Name" />
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Supplier Contact No</label>
                                <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->contact_no); ?>" <?php endif; ?> name="supplier_contact_no" placeholder="Contact No" />
                              </div>
                            </div>

                            <div class="col-md-12"></div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Supplier Email id</label>
                                <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->email_id); ?>" <?php endif; ?> name="supplier_emailId" placeholder="Email Id" />
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Supplier Price</label>
                                <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->supplier_price); ?>" <?php endif; ?> name="supplier_price" placeholder="Price" />
                              </div>
                            </div>

                            <div class="col-md-12"></div>

                            <div class="col-md-8">
                              <div class="form-group">
                                <label>Supplier Address</label>
                                <textarea class="form-control" name="supplier_address" placeholder="Address" required>  <?php if($packageSupplier!=""): ?><?php echo e($packageSupplier->address); ?> <?php endif; ?></textarea>
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
                                <input type="text" class="form-control" value="<?php echo e($packagesData->meta_title); ?>" name="meta_title" placeholder="Title" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Description</label>
                                <input type="text" class="form-control" value="<?php echo e($packagesData->meta_desc); ?>" name="meta_desc" placeholder="Description" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keyword" placeholder="Keywords"><?php echo e($packagesData->meta_keyword); ?></textarea>
                              </div>
                            </div>
                          </div>

                          <!-- seo 2 -->
                          <div class="col-md-12">
                            <div class="item-container">
                              <h4>RTA SEO</h4>
                              <div class="form-group">
                                <label class="field-required">Meta Title</label>
                                <input type="text" class="form-control" name="rapidex_meta_title" placeholder="Title" value="<?php echo e($packagesData->rapidex_meta_title); ?>" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Description</label>
                                <input type="text" class="form-control" name="rapidex_meta_desc" placeholder="Description" value="<?php echo e($packagesData->rapidex_meta_desc); ?>" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Keywords</label>
                                <textarea class="form-control" name="rapidex_meta_keyword" placeholder="Keywords"><?php echo e($packagesData->rapidex_meta_keyword); ?></textarea>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- tour policy -->
                    <div id="policies" class="tab-pane fade">
                      <div id="Additional">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12">

                          <!-- visa policy -->
                          <div class="item-container">
                            <div class="row">
                              <div class="form-group visaOption">
                                <label for="">Add Visa Policy</label>
                                <input type="checkbox" <?php if($packagesData->visa == 1): ?> checked <?php endif; ?> name="visa" value="1" id="customize_onrequestvisa" />
                              </div>
                              <div class="col-md-12 costomize_tour_visa" <?php if($packagesData->visa == 1): ?> style="display:block" <?php else: ?> style="display:none" <?php endif; ?>>
                                <h5>Visa Policy</h5>
                                <table class="table table-bordered" id="dynamic_field">
                                  <tbody>
                                    <tr>
                                      <td style="width: 60%;">
                                        <div>
                                        <select name="package_visa[]" class="select2 form-control" multiple>
                                        <?php $__currentLoopData = $visaPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(empty($packagesData->visa_p)): ?>
                                        <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->visa_p) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control"><?php echo e($packagesData->visa_policy); ?>

                                        </textarea>
                                        <!--<input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
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
                                            <?php if(empty($packagesData->payment_p)): ?>
                                              <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?></option>
                                            <?php else: ?>
                                              <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->payment_p) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                          </div>
                                        </td>
                                      </tr>
                                    <tr>
                                      <td>
                                        <textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control"><?php echo e($packagesData->payment_policy); ?>

                                        </textarea>
                                        <!--<input type="hidden" name="payment_policies" id="payment_policies_input" value=""/>-->
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
                                            <?php if(empty($packagesData->can_p)): ?>
                                              <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?></option>
                                            <?php else: ?>
                                              <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->can_p) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control"><?php echo e($packagesData->cancel_policy); ?>

                                        </textarea>
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
                                            <?php if(empty($packagesData->importantnotes)): ?>
                                              <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?></option>
                                            <?php else: ?>
                                              <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->importantnotes) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control"><?php echo e($packagesData->extranotes); ?>

                                        </textarea>
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
                    </div>

                    <!-- tour destination info -->
                    <div id="destination" class="tab-pane fade">
                      <div class="panel-body">
                        <div class="item-container">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="destinations">Select Tour Destination(s)</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="destinations[]" id="destinations" class="form-control select2" multiple>
                                    <?php if(count($locations)>0): ?>
                                      <?php if($packagesData->destinations!=""): ?>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($loc->location); ?>" <?php if(in_array($loc->location,$packagesData->destinations) ): ?> selected="selected" <?php endif; ?>><?php echo e($loc->location); ?>

                                          <?php if($loc->country=='India'): ?>
                                            (<?php echo e($loc->state); ?>, <?php echo e($loc->country); ?>)
                                          <?php else: ?>
                                            (<?php echo e($loc->country); ?>)
                                          <?php endif; ?>
                                          </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php else: ?>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($loc->location); ?>"><?php echo e($loc->location); ?>

                                          <?php if($loc->country=='India'): ?>
                                            (<?php echo e($loc->state); ?>, <?php echo e($loc->country); ?>)
                                          <?php else: ?>
                                            (<?php echo e($loc->country); ?>)
                                          <?php endif; ?>
                                          </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php endif; ?>
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
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="sp_city[]" id="sp_city" class="form-control select2" multiple>
                                    <?php $__currentLoopData = $spcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cty): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php $val=trim(explode("(",$cty)[0]); ?>
                                      <option value="<?php echo e(trim(explode("(",$cty)[0])); ?>" <?php if(!empty($packagesData->sp_city) && in_array($val, $packagesData->sp_city)): ?> selected="selected" <?php endif; ?>><?php echo e($cty); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- select similar tour -->
                            <div class="spkgs-box">
                              <div class="col-md-12">
                                <div class="form-group ">
                                  <label for="destinations">Choose Similar Package(s)</label>
                                  <div class="input-group pdngBtm5">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <select name="similar_packages[]" id="similar_packages" class="form-control select2" multiple>
                                      <?php if(!empty($packagesData->similar_packages)): ?>
                                        <?php $__currentLoopData = $packagesData->similar_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkgs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(in_array($pkgs,$packagesData->similar_packages) ): ?>
                                          <?php
                                            $id=$pkgs;
                                            $data_check=DB::table('rt_packages')->where('id',$id)->first();
                                            $city_list=unserialize($data_check->city);
                                            $given_city_list=$packagesData->sp_city;
                                            if(!is_array($given_city_list)) {
                                              $given_city_list=[];
                                            }
                                            $result=array_intersect($given_city_list,$city_list);
                                            $output='';
                                            if(count($result)>0) {
                                              $output=$result[0];
                                            } else {
                                              $output='';
                                            }
                                          ?>
                                            <option value="<?php echo e($pkgs); ?>" city="<?php echo e($output); ?>" selected="selected"><?php echo e($data_check->title); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php endif; ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- book online -->
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

                  </div><!-- close tab-content -->

                  <!-- </div></select></select></div> -->
                  <!-- end-->
                  <!-- <div class="update-btns col-sm-12">
                    <button type="submit" name="draft" id="next" class="btn btn-success">Draft<i class="fa fa-save"></i></button>
                    <button type="submit" name="add" id="next" class="btn btn-success">Next<i class="fa fa-arrow-right"></i></button>
                  </div> -->

                  <!-- update & save tour -->
                  <div class="textCenter">
                    <div class="form-group textCenter">
                      <button type="submit" name="add" id="remove" class="btn btn-danger location_add">Continue To Update <i class="fa fa-arrow-right"></i></button>
                    </div>
                  </div>

                </form>
              </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

<!-- ************************** -->

<!-- modal -->

<!-- add package tour -->
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
            <p>Tour Added Successfully.</p>
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
            <label class="col-md-12 control-label text-left"> Sightseeing Description</label>
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

<!-- add package hotel-->
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

<!-- supplier details -->
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



  <!-- tour package (added in header -> packages.js) -->
  <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/tour-package.js")); ?>'></script> -->
  
  <!-- package property selection -->
  <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/package-property-selection.js")); ?>'></script>

  <!-- new pricing -->
  <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/package_new_price.js")); ?>'></script>

<script>
/*$(document).ready(function () {
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
});*/

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

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>