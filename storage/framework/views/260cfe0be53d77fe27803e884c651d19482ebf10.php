<?php $__env->startSection('content'); ?>
<style>
  .dayItinerary {
    border-bottom: 1px solid darkgray;
    margin-bottom: 14px;
    border-radius: 23px;
  }

  span.select2.select2-container {
    width: 100% !important;
  }
  .select2-results__option[aria-selected=true] {
      display: none;
  }
</style>
<div class="content-wrapper">

  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="modal-body_main">
              <a href="<?php echo e(URL::to('/tours')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>

              <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add in Bulk</button>-->
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
            </div>
            <br><br>
            <div id="content">
              <!-- <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active">
                  <a href="#red" data-toggle="tab">Customized Holidays</a>
                </li>
                <li>
                  <a href="#group-holiday" data-toggle="tab">Group Holiday
                  </a>
                </li>
                <li>
                  <a href="#fixed-departure" data-toggle="tab">Fixed Departure
                  </a>
                </li>
                <li>
                  <a href="#hotel-package" data-toggle="tab">Hotel Package
                  </a>
                </li>
                <li>
                  <a href="#cruise-holiday" data-toggle="tab">Cruise Holiday
                  </a>
                </li>

                 <li>
<a href="#orange" data-toggle="tab">Hotel Package
</a>
</li>
<li>
<a href="#yellow" data-toggle="tab">Group Tour / Shared Tour
</a>
</li> 
              </ul>-->
              <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="red">
                  <?php if($packagesData->type_of_package != 'Hotel Package'): ?>
                  <input type="hidden" id="package_country" value="<?php echo e(implode(',',$packagesData->country)); ?>">

                  <?php endif; ?>
                  <?php if($errors->any()): ?>
                  <div class="alert alert-warning">
                    <ul>
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </ul>
                  </div>
                  <?php endif; ?>
                  <!--New Edit Template-->
                  <div class="col-md-12">
                    <form action="<?php echo e(URL::to('/store_packages')); ?>" method="post" id="package-form">
                      <input type="hidden" name="type" value="<?php echo e($packagesData->type_of_package); ?>" />

                      <?php echo e(csrf_field()); ?>

                      <br>
                      <!---->
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#Info"><span class="glyphicon glyphicon-file">
                            </span> Package Info</a></li>
                        <li><a data-toggle="tab" href="#Description"><span class="glyphicon glyphicon-th-list">
                            </span> Description</a></li>
                        <li><a data-toggle="tab" href="#Overview"><span class="glyphicon glyphicon-th-list">
                            </span> Inclusions</a></li>
                        <li><a data-toggle="tab" href="#flights"><span class="glyphicon glyphicon-th-list">
                            </span> Flights</a></li>
                        <li><a data-toggle="tab" href="#accommodation"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Accommodation</a></li>
                        <li><a data-toggle="tab" href="#transfers"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Transfers</a></li>
                        <li><a data-toggle="tab" href="#Itinerary"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Tour Itinerary</a></li>
                        <li><a data-toggle="tab" href="#Pricing"><i class="fa fa-inr" aria-hidden="true"></i> Pricing</a></li>
                        <li><a data-toggle="tab" href="#Supplier"><i class="fa fa-suitcase" aria-hidden="true"></i> Supplier </a></li>
                        <?php if(Sentinel::check()): ?>
                        <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                        <li><a data-toggle="tab" href="#META"><i class="fa fa-database" aria-hidden="true"></i> SEO </a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <li><a data-toggle="tab" href="#Additional"><span class="glyphicon glyphicon-th-list">
                            </span> Additional </a></li>
                        <li><a data-toggle="tab" href="#destination"><span class="glyphicon glyphicon-th-list"></span> Destination Info </a></li>
                        <li><a data-toggle="tab" href="#tour-packages"><span class="glyphicon glyphicon-th-list"></span> Similar Tour Packages </a></li>
                        <li><a data-toggle="tab" href="#live-mode"><span class="glyphicon glyphicon-th-list"></span> Live Mode </a></li>
                      </ul>

                      <div class="tab-content">
                        <div id="Info" class="tab-pane fade in active">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-6 form-group">
                                <label for="duration">Package Duration</label>
                                <select name="duration" id="package_durations" class="form-control val">
                                  <?php for($i=1;$i<=30;$i++): ?> <?php if($i==$packagesData->duration): ?>
                                    <option value="<?php echo e($packagesData->duration); ?>" selected="selected">
                                      <?php echo e($packagesData->duration); ?> Night/<?php echo e(($packagesData->duration)+1); ?> Days
                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Night / <?php echo e($i+1); ?> Days</option>
                                    <?php endif; ?>;



                                    <?php endfor; ?>;



                                </select>
                              </div>

                              <div class="col-md-6 form-group">
                                <label for="package_name">Package Title</label>
                                <input type="text" placeholder="Package Title" value="<?php echo e($packagesData->title); ?>" name="package_name" class="form-control">
                              </div>
                              <div class="col-md-6 form-group">
                                <label for="package_location">Services Included</label>
                                <div class="input-group" style="margin-bottom:5px;">
                                  <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                  </span>

                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($icons)>0): ?>

                                    <?php if($packagesData->package_service!=""): ?>
                                    <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($icon->icon_title); ?>" <?php if(in_array($icon->icon_title,$packagesData->package_service) ): ?> selected="selected" <?php endif; ?>><?php echo e($icon->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($icon->icon_title); ?>"><?php echo e($icon->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                    <?php endif; ?>
                                    <?php else: ?>
                                    <option value="No Result Found">No Result Found</option>

                                    <?php endif; ?>

                                  </select>

                                </div>

                              </div>

                              <div class="col-md-6 form-group">
                                <label for="package_location">Suitable For</label>
                                <div class="input-group" style="margin-bottom:5px;">
                                  <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                  </span>

                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($suitables)>0): ?>

                                    <?php if($packagesData->package_service!=""): ?>
                                    <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suitable): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($icon->icon_title); ?>" <?php if(in_array($suitable->icon_title,$packagesData->package_service) ): ?> selected="selected" <?php endif; ?>><?php echo e($suitable->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suitable): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($suitable->icon_title); ?>"><?php echo e($suitable->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                    <?php endif; ?>
                                    <?php else: ?>
                                    <option value="No Result Found">No Result Found</option>

                                    <?php endif; ?>

                                  </select>

                                </div>

                              </div>

                              <div class="col-md-6 form-group">
                                <label for="package_location">General Tags</label>
                                <div class="input-group" style="margin-bottom:5px;">
                                  <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                  </span>

                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($generals)>0): ?>

                                    <?php if($packagesData->package_service!=""): ?>
                                    <?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($general->icon_title); ?>" <?php if(in_array($general->icon_title,$packagesData->package_service) ): ?> selected="selected" <?php endif; ?>><?php echo e($general->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($general->icon_title); ?>"><?php echo e($general->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                    <?php endif; ?>
                                    <?php else: ?>
                                    <option value="No Result Found">No Result Found</option>

                                    <?php endif; ?>

                                  </select>

                                </div>

                              </div>
                                <div class="clearfix"></div>
                              <div class="col-md-6 form-group">
                                <label for="package_category">Theme</label>
                                <select name="package_category[]" placeholder="Theme" id="package_category" class="select2 form-control" multiple>
                                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <?php if(empty($packagesData->package_category)): ?>
                                  <option value="<?php echo e($typ->name); ?>"><?php echo e($typ->name); ?>

                                  </option>
                                  <?php else: ?>
                                  <option value="<?php echo e($typ->name); ?>" <?php if(in_array($typ->name,$packagesData->package_category) ): ?> selected="selected" <?php endif; ?> ><?php echo e($typ->name); ?>

                                  </option>
                                  <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-6 form-group">
                                <label for="package_location">Holiday Type</label>
                                <div class="input-group" style="margin-bottom:5px;">
                                  <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                  </span>

                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($holidays)>0): ?>

                                    <?php if($packagesData->package_service!=""): ?>
                                    <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($holiday->icon_title); ?>" <?php if(in_array($holiday->icon_title,$packagesData->package_service) ): ?> selected="selected" <?php endif; ?>><?php echo e($holiday->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($holiday->icon_title); ?>"><?php echo e($holiday->icon_title); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                    <?php endif; ?>
                                    <?php else: ?>
                                    <option value="No Result Found">No Result Found</option>

                                    <?php endif; ?>

                                  </select>

                                </div>

                              </div>



                              <?php
                              $count = count($packagesData->country);
                              //dd($packagesData->continent[0]);
                              use App\State;
                              use App\City;


                              ?>

                              <div class="" id="dynamic_field_package">
                                <?php for($i=1;$i<=$count;$i++): ?> <?php
                                                            $a = ($i - 1);

                                                            $continent = $packagesData->continent[$a];
                                                            $country = $packagesData->country[$a];
                                                            $state = $packagesData->state[$a];
                                                            $city = $packagesData->city[$a];
                                                            $days = $packagesData->days[$a];
                                                            $days_duration = $packagesData->duration;
                                                            $states = State::where('name', $state)->get();
                                                            $country_id = "";
                                                            foreach ($states as $stat) {
                                                              $country_id = $stat->country_id;
                                                            }
                                                            $states1 = State::where('country_id', $country_id)->get();

                                                            $city1 = City::where('name', $city)->get();


                                                            $state_id = "";
                                                            foreach ($city1 as $cit) {
                                                              $state_id = $cit->state_id;
                                                            }
                                                            $city2 = City::where('state_id', $state_id)->get();

                                                            ?> 
                                                            <div class="row remove dfp dfp-1">
                                  <div class="col-md-12">

                                    <div class="col-md-2 form-group">
                                      <label for="continent">Continent</label>
                                      <select name="continent[<?php echo e($a); ?>]" id="continent" class="form-control">
                                        <option value="Asia" <?php if($continent=='Asia' ): ?> selected="selected" <?php endif; ?>>Asia</option>
                                        <option value="Africa" <?php if($continent=='Africa' ): ?> selected="selected" <?php endif; ?>>Africa</option>
                                        <option value="Antarctica" <?php if($continent=='Antarctica' ): ?> selected="selected" <?php endif; ?>>Antarctica</option>
                                        <option value="Australia" <?php if($continent=='Australia' ): ?> selected="selected" <?php endif; ?>>Australia</option>
                                        <option value="Europe" <?php if($continent=='Europe' ): ?> selected="selected" <?php endif; ?>>Europe</option>
                                        <option value="North America" <?php if($continent=='North America' ): ?> selected="selected" <?php endif; ?>>North America</option>
                                        <option value="South America" <?php if($continent=='South America' ): ?> selected="selected" <?php endif; ?>>South America</option>

                                      </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                      <label for="country">Country</label>
                                      <select name="country[<?php echo e($a); ?>]" id="package_dest_countries<?php echo e($a); ?>" class="form-control package_dest_country" onchange="myFunction(this)">
                                        <option value=''>Select Country</option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if($cont->name==$country): ?>
                                        <option value="<?php echo e($cont->name); ?>" selected="selected" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?> </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?> </option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                      <label for="state">State</label>
                                      <select name="state[<?php echo e($a); ?>]" id="package_dest_state<?php echo e($a); ?>" class="form-control package_dest_countries<?php echo e($a); ?>" onchange="sateFunction(this)">
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
                                    <div class="col-md-2 form-group">
                                      <label for="city">City</label>
                                      <select name="city[<?php echo e($a); ?>]" id="package_dest_city" class="form-control package_dest_state<?php echo e($a); ?> city_package_dest_countries<?php echo e($a); ?> package_dest_cities min-select" onchange="cityFunction(this)">
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
                                    <div class="col-md-2 form-group">
                                      <label for="city">No. Of Days/Nights</label>
                                      <select name="days[<?php echo e($a); ?>]" id="package_dest_days" class="form-control package_dest_days ">
                                        <?php for($day_value=1;$day_value<=$days_duration;$day_value++): ?> <?php if($day_value==$days): ?> <option value="<?php echo e($day_value); ?>" selected="selected">
                                          <?php echo e($day_value); ?> Night/<?php echo e(($day_value)+1); ?> Days
                                          </option>
                                          <?php else: ?>
                                          <option value="<?php echo e($day_value); ?>"> <?php echo e($day_value); ?> Night/<?php echo e(($day_value)+1); ?> Days </option>
                                          <?php endif; ?>;

                                          <?php endfor; ?>
                                      </select>
                                    </div>
                                    <?php if($i!=1): ?>
                                    <div class='col-md-2 form-group'><button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin:18px 10px 0px 0px'>Remove</button></div>

                                    <?php endif; ?>





                                  </div>
                              </div>

                              <?php endfor; ?>

                            </div>
                            <button type="button" name="add-continent" id="add-continent-row" class="btn btn-success" style="margin-left:15px">Add More </button>

                          </div>
                        </div>
                      </div>
                      <!---->
                      <div id="Description" class="tab-pane fade">
                        <div class="row">

                          <div class="col-md-12 collapsable-form">
                            <div class="form-group">
                              <label for="" class="collapse-toggle">Package Description</label>
                              <textarea class="form-control ckeditor" placeholder="Package Description..." name="description" id="" cols="30" rows="5"><?php echo e($packagesData->description); ?></textarea>
                            </div>
                            <div class="form-group">
                              <label for="" class="collapse-toggle">Tour Highlights</label>
                              <textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5"><?php echo e($packagesData->highlights); ?></textarea>
                            </div>


                            <br>
                          </div>




                        </div>
                      </div>
                      <div id="Overview" class="tab-pane fade">
                        <div class="row">

                          <div class="col-md-12">


                            <!--<div class="form-group">
                              <label for="">Transport</label>
                              <select name="transport" id="transport" class="form-control">
                                <option value="0">--Choose Transport--</option>
                                <?php $__currentLoopData = $transport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php if($trans->name==$packagesData->transport): ?>
                                <option value="<?php echo e($trans->name); ?>" selected="selected"><?php echo e($trans->name); ?></option>
                                <?php else: ?>
                                <option value="<?php echo e($trans->name); ?>"><?php echo e($trans->name); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                              </select>

                            </div>

                            <?php if($packagesData->transport=="Flight"): ?>

                            <div class="oflight" style="display: none;">
                              <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5"><?php echo e(old('transport_description')); ?></textarea>

                              <br>

                            </div>


                            <div class="flight">
                              <div class="col-md-12">
                                <h4>UP</h4>
                              </div>
                              <div class="col-md-4">
                                <label>Flight Name</label>
                                <input type="text" name="flight[name]" class="form-control" <?php if($packagesData->flight['name']!=""): ?> value="<?php echo e($packagesData->flight['name']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-4">
                                <label>Flight No.</label>
                                <input type="text" name="flight[no]" class="form-control" <?php if($packagesData->flight['no']!=""): ?> value="<?php echo e($packagesData->flight['no']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-4">
                                <label>No. Of Stop</label>
                                <input type="text" name="flight[numberstop]" class="form-control" <?php if($packagesData->flight['numberstop']!=""): ?> value="<?php echo e($packagesData->flight['numberstop']); ?>" <?php endif; ?>>
                                <br>
                              </div>

                              <div class="col-md-3">
                                <label>Flight Origin</label>
                                <input type="text" name="flight[Origin]" class="form-control" <?php if($packagesData->flight['Origin']!=""): ?> value="<?php echo e($packagesData->flight['Origin']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Departure Time</label>
                                <input type="text" name="flight[dtime]" class="form-control" <?php if($packagesData->flight['dtime']!=""): ?> value="<?php echo e($packagesData->flight['dtime']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Destination</label>
                                <input type="text" name="flight[dest]" class="form-control" <?php if($packagesData->flight['dest']!=""): ?> value="<?php echo e($packagesData->flight['dest']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Arrival Time</label>
                                <input type="text" name="flight[atime]" class="form-control" <?php if($packagesData->flight['atime']!=""): ?> value="<?php echo e($packagesData->flight['atime']); ?>" <?php endif; ?>>
                                <br>
                              </div>

                              <div class="col-md-12">
                                <h4>Down</h4>
                              </div>
                              <div class="col-md-4">
                                <label>Flight Name</label>
                                <input type="text" name="flight[dname]" class="form-control" <?php if(array_key_exists("dname",$packagesData->flight) && $packagesData->flight['dname']!=""): ?> value="<?php echo e($packagesData->flight['dname']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-4">
                                <label>Flight No.</label>
                                <input type="text" name="flight[dno]" class="form-control" <?php if(array_key_exists("dno",$packagesData->flight) && $packagesData->flight['dno']!=""): ?> value="<?php echo e($packagesData->flight['dno']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-4">
                                <label>No. Of Stop</label>
                                <input type="text" name="flight[dnumberstop]" class="form-control" <?php if(array_key_exists("dnumberstop",$packagesData->flight) && $packagesData->flight['dnumberstop']!=""): ?> value="<?php echo e($packagesData->flight['dnumberstop']); ?>" <?php endif; ?>>
                                <br>
                              </div>

                              <div class="col-md-3">
                                <label>Flight Origin</label>
                                <input type="text" name="flight[dOrigin]" class="form-control" <?php if(array_key_exists("dOrigin",$packagesData->flight) && $packagesData->flight['dOrigin']!=""): ?> value="<?php echo e($packagesData->flight['dOrigin']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Departure Time</label>
                                <input type="text" name="flight[ddtime]" class="form-control" <?php if(array_key_exists("ddtime",$packagesData->flight) && $packagesData->flight['ddtime']!=""): ?> value="<?php echo e($packagesData->flight['ddtime']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Destination</label>
                                <input type="text" name="flight[ddest]" class="form-control" <?php if(array_key_exists("ddest",$packagesData->flight) && $packagesData->flight['ddest']!=""): ?> value="<?php echo e($packagesData->flight['ddest']); ?>" <?php endif; ?>>
                              </div>
                              <div class="col-md-3">
                                <label>Arrival Time</label>
                                <input type="text" name="flight[datime]" class="form-control" <?php if(array_key_exists("datime",$packagesData->flight) && $packagesData->flight['datime']!=""): ?> value="<?php echo e($packagesData->flight['datime']); ?>" <?php endif; ?>>
                                <br>
                              </div>

                            </div>



                            <?php else: ?>
                            <div class="oflight">
                              <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5"><?php echo e($packagesData->transport_description); ?></textarea>
                              <br>

                            </div>

                            <div class="flight" style="display: none;">
                              <div class="col-md-12">
                                <h4>UP</h4>
                              </div>
                              <div class="col-md-4">
                                <label>Flight Name</label>
                                <input type="text" name="flight[name]" class="form-control">
                              </div>
                              <div class="col-md-4">
                                <label>Flight No.</label>
                                <input type="text" name="flight[no]" class="form-control">
                              </div>
                              <div class="col-md-4">
                                <label>No. Of Stop</label>
                                <input type="text" name="flight[numberstop]" class="form-control">
                                <br>
                              </div>

                              <div class="col-md-3">
                                <label>Flight Origin</label>
                                <input type="text" name="flight[Origin]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Departure Time</label>
                                <input type="text" name="flight[dtime]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Destination</label>
                                <input type="text" name="flight[dest]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Arrival Time</label>
                                <input type="text" name="flight[atime]" class="form-control">
                                <br>
                              </div>
                              <div class="col-md-12">
                                <h4>Down</h4>
                              </div>
                              <div class="col-md-4">
                                <label>Flight Name</label>
                                <input type="text" name="flight[dname]" class="form-control">
                              </div>
                              <div class="col-md-4">
                                <label>Flight No.</label>
                                <input type="text" name="flight[dno]" class="form-control">
                              </div>
                              <div class="col-md-4">
                                <label>No. Of Stop</label>
                                <input type="text" name="flight[dnumberstop]" class="form-control">
                                <br>
                              </div>

                              <div class="col-md-3">
                                <label>Flight Origin</label>
                                <input type="text" name="flight[dOrigin]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Departure Time</label>
                                <input type="text" name="flight[ddtime]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Destination</label>
                                <input type="text" name="flight[ddest]" class="form-control">
                              </div>
                              <div class="col-md-3">
                                <label>Arrival Time</label>
                                <input type="text" name="flight[datime]" class="form-control">
                                <br>
                              </div>

                            </div>

                            <?php endif; ?>
-->

                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="">Customer Rating</label>
                              <select class=' form-control' name="customer_rating">
                                <option value="1" <?php if($packagesData->customer_rating=='1'): ?> selected="selected" <?php endif; ?>>1 Star </option>

                                <option value="2" <?php if($packagesData->customer_rating=='2'): ?> selected="selected" <?php endif; ?>>2 Star </option>

                                <option value="3" <?php if($packagesData->customer_rating=='3'): ?> selected="selected" <?php endif; ?>>3 Star </option>

                                <option value="3.5" <?php if($packagesData->customer_rating=='3.5'): ?> selected="selected" <?php endif; ?>>3.5 Star </option>

                                <option value="4" <?php if($packagesData->customer_rating=='4'): ?> selected="selected" <?php endif; ?>>4 Star </option>

                                <option value="4.5" <?php if($packagesData->customer_rating=='4.5'): ?> selected="selected" <?php endif; ?>>4.5 Star </option>

                                <option value="5" <?php if($packagesData->customer_rating=='5'): ?> selected="selected" <?php endif; ?>>5 Star </option>

                              </select>

                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group select-container">
                              <label>Sightseeing</label>
                              <select class='select2 form-control' name="tours[]" multiple id="tour_add">
                                <?php $__currentLoopData = $PkgTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php /* @if(empty($packagesData->tours))
                                <option value='{{$tour->id}}'>{{$tour->activity}} </option>
                                @else
                                <option value='{{$tour->id}}' @if(in_array($tour->id, $packagesData->tours)) selected="selected" @endif>{{$tour->activity}} </option>
                                @endif */ ?>
                                <?php if(!empty($packagesData->tours) && in_array($tour->activity, $packagesData->tours)): ?>
                                  <option value='<?php echo e($tour->id); ?>' selected="selected"><?php echo e($tour->activity); ?> </option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                              </select>
                            </div>
                          </div>
                          <div class="custom_tour_parent">
                            <div class="col-md-2">

                              <button data-toggle="modal" data-target="#packagetour_custom " type="button" class="btn-success btn-sm custom_tour" style="margin-top: 18px;margin-left: 40px">Add Sightseeing</button>
                            </div>

                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group select-container">
                              <label>Inclusions</label>
                              <textarea class="form-control ckeditor" name="inclusions" id="" cols="30" rows="5"><?php echo e($packagesData->inclusions); ?></textarea>

                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class=" form-group ">
                              <label>Exclusions</label>
                              <textarea class="form-control ckeditor" name="exclusions" id="" cols="30" rows="5"><?php echo e($packagesData->exclusions); ?></textarea>

                            </div>
                          </div>

                        </div>

                      </div>
                      
                      <div id="flights" class="tab-pane fade">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Is Flight Required?</label>
                              <input type="checkbox" name="flight[show_flight_options]" value="flight[show_flight_options]" id="show_flight_options" <?php if(isset($packagesData->flight['show_flight_options'])!=""): ?> checked <?php endif; ?>>
                            </div>
                            <!--<div class="form-group">
                              <label for="">Transport</label>
                              <select name="transport" id="transport" class="form-control">
                                <option value="0">--Choose Transport--</option>
                                <?php $__currentLoopData = $transport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($trans->name); ?>"><?php echo e($trans->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                              </select>
                            </div>-->
                            <!--<div class="oflight">
                              <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">
                              <?php echo e(old('transport_description')); ?></textarea>
                              <br>
                            </div>-->
                          </div>
                          
                        <div class="flight" style="display: none;">
                          <div class="col-md-12">
                            <h4>Onward Flight</h4>
                          </div>
                          <div class="col-md-4">
                            <label>Airline Name</label>
                            <select name="flight[name]" class="form-control">
                                <option value="0">--Select Airline--</option>
                                <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($airline->airline_name); ?>" <?php if(!empty($packagesData->flight['name']) && $packagesData->flight['name']==$airline->airline_name): ?> selected="selected" <?php endif; ?>><?php echo e($airline->airline_name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label>Flight No.</label>
                            <input type="text" name="flight[no]" class="form-control" <?php if($packagesData->flight['no']!=""): ?> value="<?php echo e($packagesData->flight['no']); ?>" <?php endif; ?>>
                          </div>
                          <div class="col-md-4">
                            <label>No. Of Stop</label>
                            <select name="flight[numberstop]" class="form-control">
                                <option value="0">--Select No.--</option>
                                <option value="Non-Stop" <?php if($packagesData->flight['numberstop']=='Non-Stop'): ?> selected="selected" <?php endif; ?>>Non-Stop</option>
                                <?php for($i=1;$i<=4;$i++): ?>
                                  <?php if($i==1): ?>
                                    <option value="<?php echo e($i); ?> Stop" <?php if($packagesData->flight['numberstop']== $i . ' Stop'): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?> Stop</option>
                                  <?php else: ?>
                                    <option value="<?php echo e($i); ?> Stops" <?php if($packagesData->flight['numberstop']==$i . ' Stops'): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?> Stops</option>
                                    <?php endif; ?>;
                                  <?php endfor; ?>;
                            </select>
                            <br>
                          </div>

                          <div class="col-md-3">
                            <label>Flight Origin</label>
                            <select name="flight[Origin]" class="form-control">
                              <option value="0">Choose Origin</option>
                              <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>)" <?php if($packagesData->flight['Origin']==$iata->iata_name . ' (' . $iata->iata_code . ')'): ?> selected="selected" <?php endif; ?>><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Departure Time</label>
                            <?php /*<input type="text" name="flight[dtime]" class="form-control" @if($packagesData->flight['dtime']!="") value="{{$packagesData->flight['dtime']}}" @endif>*/ ?>
                              <div class="clearfix"></div>
                              <select name="flight[dhours]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Hours</option>
                                <?php for($i=1;$i<=24;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['dhours']) && $packagesData->flight['dhours']!="" && $packagesData->flight['dhours']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                              <select name="flight[dmins]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Minutes</option>
                                <?php for($i=1;$i<=60;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['dmins']) && $packagesData->flight['dmins']!="" && $packagesData->flight['dmins']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                          </div>
                          <div class="col-md-3">
                            <label>Destination</label>
                            <select name="flight[dest]" class="form-control">
                              <option value="0">Choose Destination</option>
                              <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>)" <?php if($packagesData->flight['dest']==$iata->iata_name . ' (' . $iata->iata_code . ')'): ?> selected="selected" <?php endif; ?>><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Arrival Time</label>
                            <?php /*<input type="text" name="flight[atime]" class="form-control" @if($packagesData->flight['atime']!="") value="{{$packagesData->flight['atime']}}" @endif>*/ ?>
                            <div class="clearfix"></div>
                              <select name="flight[ahours]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Hours</option>
                                <?php for($i=1;$i<=24;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['ahours']) && $packagesData->flight['ahours']!="" && $packagesData->flight['ahours']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                              <select name="flight[amins]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Minutes</option>
                                <?php for($i=1;$i<=60;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['amins']) && $packagesData->flight['amins']!="" && $packagesData->flight['amins']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                            <br>
                          </div>
                          <div class="col-md-3">
                            <label>Cabin Class</label>
                            <select name="flight[cabin]" class="form-control">
                              <option value="Economy" <?php if($packagesData->flight['cabin']=='Economy'): ?> selected="selected" <?php endif; ?>>Economy</option>
                              <option value="Business" <?php if($packagesData->flight['cabin']=='Business'): ?> selected="selected" <?php endif; ?>>Business</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Flight Duration</label>
                            <input type="text" name="flight[duration]" class="form-control" placeholder="i.e. 3h 30m" <?php if($packagesData->flight['duration']!=""): ?> value="<?php echo e($packagesData->flight['duration']); ?>" <?php endif; ?>>
                          </div>
                          <div class="col-md-3">
                            <label>Cabin Baggage (in kgs)</label>
                            <!--<input type="text" name="flight[baggage]" class="form-control" <?php if($packagesData->flight['baggage']!=""): ?> value="<?php echo e($packagesData->flight['baggage']); ?>" <?php endif; ?>>-->
                            <select name="flight[baggage]" class="form-control">
                              <option value="0 Kgs" <?php if(!empty($packagesData->flight['baggage']) && $packagesData->flight['baggage']=='0 Kgs'): ?> selected="selected" <?php endif; ?>>0 Kgs</option>
                              <option value="5 Kgs" <?php if(!empty($packagesData->flight['baggage']) && $packagesData->flight['baggage']=='5 Kgs'): ?> selected="selected" <?php endif; ?>>5 Kgs</option>
                              <option value="7 Kgs" <?php if(!empty($packagesData->flight['baggage']) && $packagesData->flight['baggage']=='7 Kgs'): ?> selected="selected" <?php endif; ?>>7 Kgs</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Check-In Baggage (in kgs)</label>
                            <select name="flight[cbaggage]" class="form-control">
                              <option value="0 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="0 Kgs"): ?> selected="selected" <?php endif; ?>>0 Kgs</option>
                              <option value="10 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="10 Kgs"): ?> selected="selected" <?php endif; ?>>10 Kgs</option>
                              <option value="15 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="15 Kgs"): ?> selected="selected" <?php endif; ?>>15 Kgs</option>
                              <option value="20 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="20 Kgs"): ?> selected="selected" <?php endif; ?>>20 Kgs</option>
                              <option value="23 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="23 Kgs"): ?> selected="selected" <?php endif; ?>>23 Kgs</option>
                              <option value="25 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="25 Kgs"): ?> selected="selected" <?php endif; ?>>25 Kgs</option>
                              <option value="30 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="30 Kgs"): ?> selected="selected" <?php endif; ?>>30 Kgs</option>
                              <option value="35 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="35 Kgs"): ?> selected="selected" <?php endif; ?>>35 Kgs</option>
                              <option value="40 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="40 Kgs"): ?> selected="selected" <?php endif; ?>>40 Kgs</option>
                              <option value="45 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="45 Kgs"): ?> selected="selected" <?php endif; ?>>45 Kgs</option>
                              <option value="50 Kgs" <?php if(!empty($packagesData->flight['cbaggage']) && $packagesData->flight['cbaggage']=="50 Kgs"): ?> selected="selected" <?php endif; ?>>50 Kgs</option>
                            </select>
                            <br>
                          </div>
                          <!---->
                          <div class="col-md-12">
                            <h4>Return Flight</h4>
                          </div>
                          <div class="col-md-4">
                            <label>Airline Name</label>
                            <select name="flight[name]" class="form-control">
                                <option value="0">--Select Airline--</option>
                                <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($airline->airline_name); ?>" <?php if(!empty($packagesData->flight['dname']) && $packagesData->flight['dname']==$airline->airline_name): ?> selected="selected" <?php endif; ?>><?php echo e($airline->airline_name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label>Flight No.</label>
                            <input type="text" name="flight[dno]" class="form-control" <?php if($packagesData->flight['dno']!=""): ?> value="<?php echo e($packagesData->flight['dno']); ?>" <?php endif; ?>>
                          </div>
                          <div class="col-md-4">
                            <label>No. Of Stop</label>
                            <select name="flight[dnumberstop]" class="form-control">
                                <option value="0">--Select No.--</option>
                                <option value="Non-Stop" <?php if($packagesData->flight['dnumberstop']=='Non-Stop'): ?> selected="selected" <?php endif; ?>>Non-Stop</option>
                                <?php for($i=1;$i<=4;$i++): ?>
                                  <?php if($i==1): ?>
                                    <option value="<?php echo e($i); ?> Stop" <?php if($packagesData->flight['dnumberstop']==$i . ' Stop'): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?> Stop</option>
                                  <?php else: ?>
                                    <option value="<?php echo e($i); ?> Stops" <?php if($packagesData->flight['dnumberstop']==$i . ' Stops'): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?> Stops</option>
                                    <?php endif; ?>;
                                  <?php endfor; ?>;
                            </select>
                            <br>
                          </div>

                          <div class="col-md-3">
                            <label>Flight Origin</label>
                            <select name="flight[dOrigin]" class="form-control">
                              <option value="0">Choose Origin</option>
                              <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>)" <?php if($packagesData->flight['dOrigin']==$iata->iata_name . ' (' . $iata->iata_code . ')'): ?> selected="selected" <?php endif; ?>><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Departure Time</label>
                            <?php /*<input type="text" name="flight[ddtime]" class="form-control" @if($packagesData->flight['ddtime']!="") value="{{$packagesData->flight['ddtime']}}" @endif>*/ ?>
                              <div class="clearfix"></div>
                              <select name="flight[ddhours]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Hours</option>
                                <?php for($i=1;$i<=24;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['ddhours']) && $packagesData->flight['ddhours']!="" && $packagesData->flight['ddhours']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                              <select name="flight[ddmins]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Minutes</option>
                                <?php for($i=1;$i<=60;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['ddmins']) && $packagesData->flight['ddmins']!="" && $packagesData->flight['ddmins']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                          </div>
                          <div class="col-md-3">
                            <label>Destination</label>
                            <select name="flight[ddest]" class="form-control">
                              <option value="0">Choose Destination</option>
                              <?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>)" <?php if($packagesData->flight['ddest']==$iata->iata_name . ' (' . $iata->iata_code . ')'): ?> selected="selected" <?php endif; ?>><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Arrival Time</label>
                            <?php /*<input type="text" name="flight[datime]" class="form-control" @if($packagesData->flight['datime']!="") value="{{$packagesData->flight['datime']}}" @endif>*/ ?>
                              <div class="clearfix"></div>
                              <select name="flight[dahours]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Hours</option>
                                <?php for($i=1;$i<=24;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['dahours']) && $packagesData->flight['dahours']!="" && $packagesData->flight['dahours']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                              <select name="flight[damins]" class="form-control" style="max-width: 45%;display: inline-block;">
                                <option value="0">Minutes</option>
                                <?php for($i=1;$i<=60;$i++): ?>
                                  <option value="<?php echo e($i); ?>" <?php if(!empty($packagesData->flight['damins']) && $packagesData->flight['damins']!="" && $packagesData->flight['damins']==$i): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                <?php endfor; ?>;
                              </select>
                            <br>
                          </div>
                          <div class="col-md-3">
                            <label>Cabin Class</label>
                            <select name="flight[dcabin]" class="form-control">
                              <option value="Economy" <?php if($packagesData->flight['dcabin']=='Economy'): ?> selected="selected" <?php endif; ?>>Economy</option>
                              <option value="Business" <?php if($packagesData->flight['dcabin']=='Business'): ?> selected="selected" <?php endif; ?>>Business</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Flight Duration</label>
                            <input type="text" name="flight[dduration]" class="form-control" placeholder="i.e. 3h 30m" <?php if($packagesData->flight['dduration']!=""): ?> value="<?php echo e($packagesData->flight['dduration']); ?>" <?php endif; ?>>
                          </div>
                          <div class="col-md-3">
                            <label>Cabin Baggage (in kgs)</label>
                            <!--<input type="text" name="flight[dbaggage]" class="form-control" <?php if($packagesData->flight['dbaggage']!=""): ?> value="<?php echo e($packagesData->flight['dbaggage']); ?>" <?php endif; ?>>-->
                            <select name="flight[dbaggage]" class="form-control">
                              <option value="0 Kgs" <?php if(!empty($packagesData->flight['dbaggage']) && $packagesData->flight['dbaggage']=='0 Kgs'): ?> selected="selected" <?php endif; ?>>0 Kgs</option>
                              <option value="5 Kgs" <?php if(!empty($packagesData->flight['dbaggage']) && $packagesData->flight['dbaggage']=='5 Kgs'): ?> selected="selected" <?php endif; ?>>5 Kgs</option>
                              <option value="7 Kgs" <?php if(!empty($packagesData->flight['dbaggage']) && $packagesData->flight['dbaggage']=='7 Kgs'): ?> selected="selected" <?php endif; ?>>7 Kgs</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label>Check-In Baggage (in kgs)</label>
                            <select name="flight[dcbaggage]" class="form-control">
                              <option value="0 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="0 Kgs"): ?> selected="selected" <?php endif; ?>>0 Kgs</option>
                              <option value="10 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="10 Kgs"): ?> selected="selected" <?php endif; ?>>10 Kgs</option>
                              <option value="15 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="15 Kgs"): ?> selected="selected" <?php endif; ?>>15 Kgs</option>
                              <option value="20 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="20 Kgs"): ?> selected="selected" <?php endif; ?>>20 Kgs</option>
                              <option value="23 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="23 Kgs"): ?> selected="selected" <?php endif; ?>>23 Kgs</option>
                              <option value="25 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="25 Kgs"): ?> selected="selected" <?php endif; ?>>25 Kgs</option>
                              <option value="30 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="30 Kgs"): ?> selected="selected" <?php endif; ?>>30 Kgs</option>
                              <option value="35 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="35 Kgs"): ?> selected="selected" <?php endif; ?>>35 Kgs</option>
                              <option value="40 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="40 Kgs"): ?> selected="selected" <?php endif; ?>>40 Kgs</option>
                              <option value="45 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="45 Kgs"): ?> selected="selected" <?php endif; ?>>45 Kgs</option>
                              <option value="50 Kgs" <?php if(!empty($packagesData->flight['dcbaggage']) && $packagesData->flight['dcbaggage']=="50 Kgs"): ?> selected="selected" <?php endif; ?>>50 Kgs</option>
                            </select>
                            <br>
                          </div>
                        </div>
                        </div>
                      <!---->
                      <div id="accommodation" class="tab-pane fade">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12">
                              <label class="radio-inline"><input type="radio" name="acc_type" class="extra_acc" <?php if($Packages->acc_type=="normal_acc"): ?> checked <?php endif; ?> value="normal_acc">Listed Accommodation</label>
                              <label class="radio-inline"><input type="radio" name="acc_type" class="extra_acc" value="extra_acc" <?php if($Packages->acc_type=="extra_acc"): ?> checked <?php endif; ?>>Unlisted Accommodation</label>
                              <label class="radio-inline"><input type="radio" name="acc_type" class="extra_acc" value="hide_acc" <?php if($Packages->acc_type=="hide_acc"): ?> checked <?php endif; ?>>Hide</label>
                            </div>
                            <?php
                            $option2_accommodation = unserialize($Packages->accommodation);
                            if (is_bool($option2_accommodation)) :
                              $option2_accommodation_count = "1";
                            else :
                              $option2_accommodation_count = count($option2_accommodation);

                            endif;
                            ?>
                            <div class="col-md-12">
                              <br>
                              <div class="accommodation_main" <?php if($Packages->acc_type=="normal_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >

                                <?php
                                $days = $Packages->duration + 1;
                                $days = (int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);


                                ?>

                                <div class="dynamic_acc">
                                  <input type="hidden" name="" value="<?php echo e($days); ?>">
                                  <?php for($j=0;$j<$option2_accommodation_count;$j++): ?> <?php if($j>0): ?>
                                    <hr>
                                    <?php endif; ?>
                                    <div class="field<?php echo e($j); ?>" id="<?php echo e($j); ?>">
                                      <div class="row">
                                        <div class="col-md-4">

                                          <label>Select Days</label>

                                          <select class="form-control select_day select2" multiple name="accommodation[<?php echo e($j); ?>][day][]">
                                            <?php for($i=1;$i<=$days;$i++): ?> <option value="Day <?php echo e($i); ?>" <?php if($option2_accommodation!="" && array_key_exists("day",$option2_accommodation[$j]) && in_array("Day $i",$option2_accommodation[$j]["day"])): ?> selected <?php endif; ?>> Day <?php echo e($i); ?></option>
                                              <?php endfor; ?>

                                          </select>


                                        </div>
                                        <div class="col-md-4">

                                          <label>city</label>

                                          <input type="text" name="accommodation[<?php echo e($j); ?>][city]" class="form-control query_city" placeholder="City" value="<?php echo e($option2_accommodation[$j]["city"]); ?>">

                                        </div>
                                        <div class="col-md-4">

                                          <label>Choose Hotel Manually or from TripAdvisor</label>

                                          <select class="form-control" name="accommodation[<?php echo e($j); ?>][trip]">
                                            <option value='0' disabled='disabled'>--Select--</option>
                                            <option value="Manually" <?php if($option2_accommodation[$j]["trip"]=="Manually" ): ?> selected <?php endif; ?>>Manually</option>
                                            <option value="TripAdvisor" <?php if($option2_accommodation[$j]["trip"]=="TripAdvisor" ): ?> selected <?php endif; ?>>TripAdvisor</option>
                                          </select>


                                        </div>
                                        <div class="col-md-4">

                                          <label>Choose Hotel</label>

                                          <?php
                                          $query_data_option2 = CustomHelpers::get_quotation_hotel($option2_accommodation[$j]["city"]);
                                          ?>
                                          <select class="form-control quo_hotel" name="accommodation[<?php echo e($j); ?>][hotel]">
                                            <option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>
                                            <?php $__currentLoopData = $query_data_option2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value='<?php echo e($single->id); ?>' <?php if($option2_accommodation!="" && array_key_exists("hotel",$option2_accommodation[$j]) && $single->id==$option2_accommodation[$j]["hotel"]): ?> selected <?php endif; ?>><?php echo e($single->hotelname); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="other" <?php if($option2_accommodation!="" && array_key_exists("hotel",$option2_accommodation[$j]) && $option2_accommodation[$j]["hotel"]=="other" ): ?> selected <?php endif; ?>>Other</option>
                                          </select>


                                        </div>

                                        <?php if($option2_accommodation!="" && array_key_exists("hotel",$option2_accommodation[$j]) && $option2_accommodation[$j]["hotel"]=="other"): ?>
                                        <div class="col-md-4 other_hotel" style="display: block;">
                                          <label>Enter Hotel</label>


                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Hotel Name" value="<?php echo e($option2_accommodation[$j]["other_hotel"]); ?>">
                                        </div>

                                        <?php else: ?>
                                        <div class="col-md-4 other_hotel" style="display: none;">
                                          <label>Enter Hotel</label>


                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Hotel Name">
                                        </div>

                                        <?php endif; ?>
                                        <div class="col-md-4 add_star">

                                          <label>Choose Star Rating</label>

                                          <select class="form-control quo_star" name="accommodation[<?php echo e($j); ?>][star]">
                                            <option selected='true' disabled='disabled'>--Select--</option>
                                            <?php if($option2_accommodation!="" && array_key_exists("star",$option2_accommodation[$j]) && $option2_accommodation[$j]["star"]!="" && $option2_accommodation[$j]["star"]!="other"): ?>
                                            <option value="<?php echo e($option2_accommodation[$j]["star"]); ?>" selected><?php echo e($option2_accommodation[$j]["star"]); ?></option>
                                            <?php elseif($option2_accommodation!="" && array_key_exists("star",$option2_accommodation[$j]) && $option2_accommodation[$j]["star"]!="" && $option2_accommodation[$j]["star"]=="other"): ?>
                                            <option value="other" selected>Other</option>
                                            <?php endif; ?>
                                          </select>
                                        </div>
                                        <?php if($option2_accommodation!="" && array_key_exists("star",$option2_accommodation[$j]) && $option2_accommodation[$j]["star"]=="other"): ?>
                                        <div class="col-md-4 other_star" style="display: block;">
                                          <label>Enter Star Rating</label>
                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]" placeholder="Hotel Star Rating" value="<?php echo e($option2_accommodation[$j]["star_other"]); ?>">
                                        </div>
                                        <?php else: ?>
                                        <div class="col-md-4 other_star" style="display: none;">
                                          <label>Enter Star Rating</label>
                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]" value="<?php echo e($option2_accommodation[$j]["star_other"]); ?>" placeholder="Hotel Star Rating">
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-4">
                                          <label>Room Category</label>
                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][category]" placeholder="Room Category" value="<?php echo e($option2_accommodation[$j]["category"]); ?>">
                                        </div>
                                        <div class="col-md-4">
                                          <label>Hotel Website Link</label>
                                          <input type="text" class="form-control" name="accommodation[<?php echo e($j); ?>][hotel_link]" placeholder="Hotel Website Link" <?php if($option2_accommodation!="" && array_key_exists("hotel_link",$option2_accommodation[$j])): ?> value="<?php echo e($option2_accommodation[$j]["hotel_link"]); ?>" <?php endif; ?>>
                                        </div>
                                        <?php if($j>0): ?>
                                        <div class="col-md-2"><button type="button" name="add" id="<?php echo e($j); ?>" class="remove_acco btn btn-danger" style="margin-top:23px">x Remove</button> </div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-12">
                                    <button type="button" name="add" id="add_acco_tours" days="<?php echo e($days); ?>" class="btn btn-success">Add More
                                    </button>
                                  </div>
                                </div>
                              </div>
                              <div class="accommodation_extra" <?php if($Packages->acc_type=="extra_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
                                <label for="">Extra Accommodation</label>
                                <textarea class="form-control ckeditor" rows="3" name="accommodation_extra"><?php echo $Packages->accommodation_extra; ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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
                              <div class="row transfers_input" id="transfers_input-<?php echo e($j); ?>" data-id="<?php echo e($j); ?>">
                                <div class="form-group col-sm-3">
                                  <label for="">Title</label>
                                  <input type="text" name="transfers[<?php echo e($j); ?>][mode_title]" value="<?php echo e($transfer['mode_title']); ?>" class="form-control mode_title" placeholder="Title">
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
                                <div class="form-group col-sm-3">
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
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                              <?php else: ?>
                                <div class="row transfers_input" id="transfers_input-0" data-id="0">
                                  <input type="hidden" name="" value="">
                                  <div class="field-0" id="0">
                                    <div class="form-group col-sm-3">
                                      <label for="">Title</label>
                                      <input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
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
                                    <div class="form-group col-sm-3">
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
                              <?php endif; ?>
                            </div>
                            <div class="col-md-12">
                              <button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">Add More</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!---->
                      <div id="Itinerary" class="tab-pane fade">
                        <div class="panel-body c_body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive">

                                <?php
                                $day_count = count($packagesData->day_itinerary);
                                //$ss=$packagesData->day_itinerary['day1'];
                                //dd($ss)
                                ?>
                                <?php for($i=1 ; $i<= $day_count ; $i++): ?> <div class="col-md-12 dayItinerary day1">
                                  <div class="row">
                                    <label class="col-md-12">Day <?php echo e($i); ?> :
                                      <input type="text" name="dayItinerary[day<?php echo e($i); ?>][title]" value="<?php echo e($packagesData->day_itinerary["day$i"]["title"]); ?>" style="height: 35px;width: 93%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;">
                                    </label>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6"></div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Activity</label>
                                      <select class='select2 form-control dayItineraryactivity custom_days' name="dayItinerary[day<?php echo e($i); ?>][activities][]" multiple>
                                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($activity->activity); ?>" <?php if(!empty($packagesData->day_itinerary["day$i"]["activities"]) && in_array($activity->activity ,
                                        $packagesData->day_itinerary["day$i"]["activities"])): ?> selected='selected' <?php endif; ?>><?php echo e($activity->activity); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Meal Plan</label>
                                      <select name="dayItinerary[day<?php echo e($i); ?>][meal_plan]" class="form-control">
                                        <option value="N" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="N"): ?> selected='selected' <?php endif; ?>>NO Select</option>
                                        <option value="EP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="EP"): ?> selected='selected' <?php endif; ?>>Room Only</option>

                                        <option value="CP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="CP"): ?> selected='selected' <?php endif; ?> > Breakfast </option>

                                        <option value="CP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="lu"): ?> selected='selected' <?php endif; ?> > Lunch </option>

                                        <option value="CP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="di"): ?> selected='selected' <?php endif; ?> > Dinner </option>

                                        <option value="bd" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bd"): ?> selected='selected' <?php endif; ?> > Breakfast & Dinner </option>

                                        <option value="bl" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bl"): ?> selected='selected' <?php endif; ?> > Breakfast & Lunch </option>

                                        <option value="ld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="ld"): ?> selected='selected' <?php endif; ?> > Lunch & Dinner </option>

                                        <option value="bld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bld"): ?> selected='selected' <?php endif; ?> > Breakfast & Lunch/Dinner </option>

                                        <option value="bldall" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bldall"): ?> selected='selected' <?php endif; ?> > Breakfast, Lunch & Dinner </option>

                                        <option value="MAP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="MAP"): ?> selected='selected' <?php endif; ?>> All Inclusive </option>

                                      </select>

                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class=" form-group ">
                                      <label>Included Tours</label>
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
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Description</label>
                                      <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day<?php echo e($i); ?>][desc]">
                                      <?php echo e($packagesData->day_itinerary["day$i"]["desc"]); ?>

                                      </textarea>
                                    </div>
                                  </div>


                              </div>
                              <?php endfor; ?>


                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                  <div id="Pricing" class="tab-pane fade">
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

                                      <select name="Price[<?php echo e($j); ?>][package_rating]" id="rating" class="form-control rating-field" style="width: 40%;display:inline-block">

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
                                    <th>Package Rating</th>
                                    <th>Price from</th>
                                    <th>Price to</th>
                                    <th>Cut Off Point</th>
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

                  <div id="Supplier" class="tab-pane fade">
                    <div class="panel-body">

                      <div class="row">
                        <div class="col-md-12">

                          <div class="form-group">
                            <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->supplier_name); ?>" <?php endif; ?> name="supplier_name" placeholder="Name" />
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->contact_no); ?>" <?php endif; ?> name="supplier_contact_no" placeholder="Contact No" />
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->email_id); ?>" <?php endif; ?> name="supplier_emailId" placeholder="Email Id" />
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" <?php if($packageSupplier!="" ): ?> value="<?php echo e($packageSupplier->supplier_price); ?>" <?php endif; ?> name="supplier_price" placeholder="Price" />
                          </div>

                          <div class="form-group">
                            <textarea class="form-control" name="supplier_address" placeholder="Address" required>  <?php if($packageSupplier!=""): ?><?php echo e($packageSupplier->address); ?> <?php endif; ?></textarea>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <?php if(Sentinel::check()): ?>
                  <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <div id="META" class="tab-pane fade">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-12">
                          <h4>The Worldgateway SEO</h4>
                          <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo e($packagesData->meta_title); ?>" name="meta_title" placeholder="Title" />
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo e($packagesData->meta_desc); ?>" name="meta_desc" placeholder="Description" />
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" name="meta_keyword" placeholder="Keywords"><?php echo e($packagesData->meta_keyword); ?></textarea>
                          </div>
                        </div>
                      </div>
                      <!---->
                      <div class="row">
                        <div class="col-md-12">
                          <h4>Rapidex Travels SEO</h4>

                          <div class="form-group">
                            <input type="text" class="form-control" name="rapidex_meta_title" placeholder="Title" value="<?php echo e($packagesData->rapidex_meta_title); ?>" />
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" name="rapidex_meta_desc" placeholder="Description" value="<?php echo e($packagesData->rapidex_meta_desc); ?>" />
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" name="rapidex_meta_keyword" placeholder="Keywords">
                            <?php echo e($packagesData->rapidex_meta_keyword); ?></textarea>
                          </div>
                        </div>
                      </div>
                      <!---->
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php endif; ?>
                  <div id="Additional" class="tab-pane fade">
                    <div id="Additional">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12">
                            <h4>Terms & Conditions
                            </h4>

                            <div class="form-group">
                              <label for="">Is Visa Required?</label>
                              <input type="checkbox" <?php if($packagesData->visa == 1): ?> checked <?php endif; ?> name="visa" value="1" id="customize_onrequestvisa" />
                            </div>
                            <div class="costomize_tour_visa" <?php if($packagesData->visa == 1): ?> style="display:block" <?php else: ?> style="display:none" <?php endif; ?>>
                              <h5>Visa Terms & Policies</h5>

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
                            <h5>Payment Terms & Methods
                            </h5>
                            <table class="table table-bordered" id="dynamic_field">
                              <tbody>
                                <tr>
                                  <td style="width: 60%;">
                                    <div>
                                      <select name="package_payment[]" class="select2 form-control" multiple>
                                        <?php $__currentLoopData = $paymentPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(empty($packagesData->payment_p)): ?>
                                        <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->payment_p) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <select>





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
                            <h5>Cancellation & Refund Policy
                            </h5>
                            <table class="table table-bordered" id="dynamic_field">
                              <tbody>
                                <tr>
                                  <td style="width: 60%;">
                                    <div>
                                      <select name="package_can[]" class="select2 form-control" multiple>
                                        <?php $__currentLoopData = $cancelPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(empty($packagesData->can_p)): ?>
                                        <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->can_p) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <select>





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
                            <!---->
                            <h5>Important Notes
                            </h5>
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td style="width: 60%;">
                                    <div>
                                      <select name="package_impnotes[]" class="select2 form-control" multiple>
                                        <?php $__currentLoopData = $imp_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(empty($packagesData->importantnotes)): ?>
                                        <option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php else: ?>
                                        <option value="<?php echo e($pol->id); ?>" <?php if(in_array($pol->id,$packagesData->importantnotes) ): ?> selected="selected" <?php endif; ?> ><?php echo e($pol->policy); ?>

                                        </option>
                                        <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <select>





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
                  <div id="destination" class="tab-pane fade">
                    <div class="panel-body">
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="destinations">Choose Destination(s)</label>
                            <div class="input-group" style="margin-bottom:5px;">
                              <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                              </span>
                              <select name="destinations[]" id="destinations" class="form-control select2" multiple>
                                <?php if(count($locations)>0): ?>
                                  <?php if($packagesData->destinations!=""): ?>
                                  <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($loc->location); ?>" <?php if(in_array($loc->location,$packagesData->destinations) ): ?> selected="selected" <?php endif; ?>><?php echo e($loc->location); ?> </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                  <?php else: ?>
                                  <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$loc): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($loc->location); ?>"><?php echo e($loc->location); ?></option>
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
                  <div id="tour-packages" class="tab-pane fade">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="destinations">Choose City</label>
                          <div class="input-group" style="margin-bottom:5px;">
                            <span class="input-group-addon">
                              <i class="fa fa-map-marker"></i>
                            </span>
                            <select name="sp_city[]" id="sp_city" class="form-control select2" multiple>
                              <?php $__currentLoopData = $spcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cty): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                              <option value="<?php echo e($cty->location); ?>" <?php if(!empty($packagesData->sp_city) && in_array($cty->location, $packagesData->sp_city)): ?> selected="selected" <?php endif; ?>><?php echo e($cty->location); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 form-group spkgs-box" style="display: none;">
                          <label for="destinations">Choose Similar Package(s)</label>
                          <div class="input-group" style="margin-bottom:5px;">
                            <span class="input-group-addon">
                              <i class="fa fa-map-marker"></i>
                            </span>
                            <select name="similar_packages[]" id="similar_packages" class="form-control select2" multiple>
                              <?php if(!empty($packagesData->similar_packages)): ?>
                                <?php $__currentLoopData = $packagesData->similar_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkgs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($pkgs); ?>" selected="selected"><?php echo e($pkgs); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="live-mode" class="tab-pane fade">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-12">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!---->
                <!-- end-->
                <div class="update-btns col-sm-12">
                  <button type="submit" name="draft" id="next" class="btn btn-success btn-lg">Draft
                    <i class="fa  fa-save"></i>
                  </button>
                  <button type="submit" name="add" id="next" class="btn btn-success btn-lg">Next
                    <i class="fa  fa-arrow-right"></i>
                  </button>
                </div>
                <div style="text-align: center;">
                  <button type="submit" name="add" id="remove" class="btn btn-danger btn-lg location_add">Save
                    <i class="fa  fa-arrow-right"></i>
                  </button>
                </div>
                </form>
                <!-- TAB-1 INNAR HTML END -->

              </div>
              <!-- END New Edit Template-->
            </div>


            <!--<div class="tab-pane" id="group-holiday"></div>
            <div class="tab-pane" id="fixed-departure"></div>
            <div class="tab-pane" id="hotel-package"></div>
            <div class="tab-pane" id="cruise-holiday"></div>-->
          </div>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>


<!---->
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
<!---->
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

<!---->
<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code"); ?>
<script>
  //customize_onrequestvisa
  $(document).on("click", "#customize_onrequestvisa", function() {
    if ($(this).is(":checked")) {
      $(this).parent().siblings(".costomize_tour_visa").show()
    } else {
      $(this).parent().siblings(".costomize_tour_visa").hide()
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>