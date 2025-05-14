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
                  <?php if($action_type=='edit'): ?>
<input type="hidden" name="id" value="<?php echo e($packagesData->id); ?>" />
                 
                  <?php endif; ?>
                   <?php echo e(csrf_field()); ?>

                  <br>                  

                  <!-- tab content -->
                  <div class="tab-content">
                    <!-- tour info -->
                    <div id="Info" class="tab-pane fade in active">
                      <div class="panel-body">
                        <?php echo $__env->make('manage_packages.packages-blocks.package-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                      </div>
                    </div>


                    <!-- tour description -->
                    <div id="Description" class="tab-pane fade">
                      <div class="panel-body">

                         <?php echo $__env->make('manage_packages.packages-blocks.description', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        
                      </div>
                    </div>

                    <!-- tour inclusions and exclusions -->
                    <div id="Overview" class="tab-pane fade">
                      <div class="panel-body">
 <?php echo $__env->make('manage_packages.packages-blocks.inclusions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                 
                      </div>
                    </div>

                    <!-- tour flights -->
                   
                    <div id="flights" class="tab-pane fade">
                      <div class="panel-body">
       <?php echo $__env->make('manage_packages.packages-blocks.flights', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                     

                          
                            </div>

                          </div>
                       

                    <!-- tour accommodation -->
                    <div id="accommodation" class="tab-pane fade">
                      <div class="panel-body">
                        
                            
<?php echo $__env->make('manage_packages.packages-blocks.accommodation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                      
                      </div>
                    </div>

                    <!-- tour transfers -->
                    <div id="transfers" class="tab-pane fade">
                     
                      <div class="panel-body">
                <?php echo $__env->make('manage_packages.packages-blocks.transfers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>         
                      </div>
                    </div>

                    <!-- tour itinerary -->
                    <div id="Itinerary" class="tab-pane fade">
 <?php echo $__env->make('manage_packages.packages-blocks.itinerary', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
                    </div>

                    <!-- -------------------------------------------- -->

                    <!-- tour pricing (not in use) -->
                    

                    <!-- -------------------------------------------- -->

                    <!-- tour new pricing -->
                  <!--   <?php $new_price=CustomHelpers::get_package_new_price($packagesData->newprices); 

                    ?> -->
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
                       <?php echo $__env->make('manage_packages.packages-blocks.supplier', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
                      </div>
                    </div>

                    <!-- tour seo -->
                    <?php if(Sentinel::check()): ?>
                    <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                    <div id="meta" class="tab-pane fade">
                      <div class="panel-body">
                 <?php echo $__env->make('manage_packages.packages-blocks.seo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>        
                      </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- tour policy -->
                    <div id="policies" class="tab-pane fade">
                      <div class="panel-body">
                     <?php echo $__env->make('manage_packages.packages-blocks.policies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
                      </div>
                    </div>

                    <!-- tour destination info -->
                    <div id="destination" class="tab-pane fade">
                      <div class="panel-body">
                      <?php echo $__env->make('manage_packages.packages-blocks.destination', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
                      </div>
                    </div>

                    <!-- similar tour packages -->
                    <div id="similar-tour" class="tab-pane fade">
                      <div class="panel-body">
           <?php echo $__env->make('manage_packages.packages-blocks.similar_tour', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>             
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
                                      <input type="checkbox" id="book-online-toggle" value="1" name="livemode" <?php if($packagesData->livemode==1): ?> checked <?php endif; ?>>
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
                      <button type="submit" name="add" id="remove" class="btn btn-danger location_add">
                        Continue To 
                        <?php 

                        ?>
 <?php if($action_type=='edit'): ?>
    Update                    
<?php else: ?>
Clone
<?php endif; ?>
                        <i class="fa fa-arrow-right"></i></button>
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