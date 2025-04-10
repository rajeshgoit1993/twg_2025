<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
	.small_class {
  	height: 30px;
  	overflow: hidden;
	}

  .typeImage {
    border: 1px solid #ccc;
    width: 100px;
    height: 75px;
    overflow: hidden;
    border-radius: 5px;
    background-color: #f2f2f2;
  }
  .typeImage img {
    width: 100px;
    height: 75px;
    object-fit: cover;
  }
  
@media (max-width: 768px) {
  .modalDialog {
    width: 80%;
    margin: auto;
    border-radius: 5px;
    overflow: hidden;
  }
}
@media (min-width: 768px) {
  .modalDialog {
    width: 1200px;
    margin: 30px auto;
    border-radius: 10px;
    overflow: hidden;
  }
}
</style>

<!-- select2 css -->
<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/backend/css/select2-customized.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              <ul class="nav nav-tabs">

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                  <li class="active"><a href="#tab1" data-toggle="tab">Theme</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab2" data-toggle="tab">Inclusions</a></li>
                  <li><a href="#tab3" data-toggle="tab">Exclusions</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab4" data-toggle="tab">Sightseeing</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab5" data-toggle="tab">Activities</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab6" data-toggle="tab">Packages SEO</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab7" data-toggle="tab">Transfers</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab8" data-toggle="tab">Airline Info</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab9" data-toggle="tab">IATA List</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab10" data-toggle="tab">General Tags</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab11" data-toggle="tab">Suitable For</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab12" data-toggle="tab">Holiday Type</a></li>
                <?php endif; ?>
                <?php endif; ?>

                 <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab13" data-toggle="tab">Tour Type</a></li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                  <li><a href="#tab14" data-toggle="tab">Tour Category</a></li>
                <?php endif; ?>
                <?php endif; ?>

              </ul>
            </h3>
          </div>
          <div class="panel-body">
            <div class="tabbable">
              <div class="tab-content">

                <!-- theme -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane active" id="tab1">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#addPackageType" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Theme</button>

                          <!-- modal - add theme -->
                          <div class="modal fade" id="addPackageType" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add New Theme</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Type Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Type Name</label>
                                      <div class="col-md-8">
                                        <input name="pkgTypeName" class="form-control pkgTypeName" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="pkgTypeStatus" class="form-control pkgTypeStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Show On Footer</label>
                                      <div class="col-md-8">
                                        <select name="showsfooter" class="form-control showsfooter" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="savePackageTypes" class="btn btn-success" data-action="save" role="button">Add</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit theme -->
                          <div class="modal fade editPkgType" id="editPkgTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Theme</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Package Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>
                                    <input type="hidden" value="" class="edittypeid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Type Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control pkgTypeName" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="pkgTypeStatus" class="form-control pkgTypeStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Show On Footer</label>
                                      <div class="col-md-8 showsfooter">
                                        <select name="showsfooter" class="form-control showsfooters" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="updatePkgTypes" class="btn btn-success" data-action="save" role="button">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th width="50">S.No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Show On Footer</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $hotelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="edittype_<?php echo e($type->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($type->name); ?></td>
                            <td class="typestatus center">
                              <?php if($type->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($type->status); ?>">
                            </td>
                            <td class="showsfooter">
                              <?php if($type->showsfooter == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="showsfooter" value="<?php echo e($type->showsfooter); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deletePkgTypes')); ?>" method="post" id="deletePkgType<?php echo e($type->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($type->id); ?>" />
                                <a class="edit_pkgType" data-id="<?php echo e($type->id); ?>" data-toggle="modal" data-target="#editPkgTypeModal" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($type->id); ?>" class="deletePkgType"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- inclusions -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab2">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packageInclusion" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Inclusion</button>

                          <!-- modal - add inclusion -->
                          <div class="modal fade" id="packageInclusion" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Inclusion</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Inclusions Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Inclusion Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control name" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="addInclusions" class="btn btn-success" data-action="save" role="button">Add</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit inclusion -->
                          <div class="modal fade editInclusionModel" id="editInclusionsModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Inclusion</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Inclusions Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>
                                    <input type="hidden" value="" class="edittypeid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control incName" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control incStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="updateInclusionbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"><span class="pull-right">#</span></th> -->
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $all_inclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$inclusion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editinc_<?php echo e($inclusion->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($inclusion->name); ?></td>
                            <td class="typestatus center">
                              <?php if($inclusion->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($inclusion->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deleteInclusion')); ?>" method="post" id="deleteIncType<?php echo e($inclusion->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($inclusion->id); ?>" />
                                <a class="editInclusionType" data-id="<?php echo e($inclusion->id); ?>" data-toggle="modal" data-target="#editInclusionsModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($inclusion->id); ?>" class="deleteIncType"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- exclusions -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab3">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packageExclusion" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Exclusion</button>

                          <!-- modal - add exclusion -->
                          <div class="modal fade" id="packageExclusion" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Exclusion</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Exclusions Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Exclusion Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control name" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="addExclusions" class="btn btn-success" data-action="save" role="button">Add</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit exclusion -->
                          <div class="modal fade editExclusionModel" id="editExclusionsModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Exclusion</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Exclusions Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>
                                    <input type="hidden" value="" class="edittypeid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control incName" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control incStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="updateExclusionbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $all_exclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$exclusion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editexc_<?php echo e($exclusion->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($exclusion->name); ?></td>
                            <td class="typestatus center">
                              <?php if($exclusion->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($exclusion->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deleteExclusion')); ?>" method="post" id="deleteExcType<?php echo e($exclusion->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($exclusion->id); ?>" />
                                <a class="editExclusionType" data-id="<?php echo e($exclusion->id); ?>" data-toggle="modal" data-target="#editExclusionsModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($exclusion->id); ?>" class="deleteExcType"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>                

                <!-- sightseeing -->
                <div class="tab-pane" id="tab4">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packageTours" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Sightseeing</button>

                          <!-- modal - add sightseeing -->
                          <!-- <div class="modal fade" id="packageTours" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modalDialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Sightseeing</h3>
                                </div>
                                <div class="modal-body">
                                  !-- content goes here --
                                  <form action="<?php echo e(URL::to('/add-tour')); ?>" enctype="multipart/form-data" method="post" id="tour_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Sightseeing Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Sightseeing Name</label>
                                      <div class="col-md-8">
                                        <input name="name" class="form-control name" placeholder="Name" value="" type="text">
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
                                        <textarea class="form-control description ckeditor" name="description" id="" cols="50" rows="2"><?php echo e(old('description')); ?></textarea>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Sightseeing Locations</label>
                                      <div class="col-md-8">
                                         <select class="quote_city form-control location" name="location"></select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Sightseeing Duration</label>
                                      <div class="col-md-8">
                                        <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Sightseeing Inclusions</label>
                                      <div class="col-md-8">
                                        <input name="inclusions" class="form-control inclusions" placeholder="Inclusions" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Sightseeing Exclusions</label>
                                      <div class="col-md-8">
                                        <input name="exclusions" class="form-control exclusions" placeholder="Exclusions" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                  <button type="submit" class="btn btn-success" id="addTours" data-action="save" role="button">Save</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div> -->

                          <div class="modal fade" id="packageTours" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modalDialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalLabel">Add Sightseeing</h5>
                                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button> -->
                                </div>
                                <div class="modal-body">
                                  <!-- Success and error alerts -->
                                  <div class="alert alert-success d-none" id="success-container">
                                      <p>Sightseeing Added Successfully.</p>
                                  </div>
                                  <div class="alert alert-danger d-none" id="error-container">
                                      <ul></ul>
                                  </div>

                                  <!-- Form start -->
                                  <form action="<?php echo e(URL::to('/add-tour')); ?>" method="post" enctype="multipart/form-data" id="tour_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <div class="makeflex flex-column">

                                      <!-- Sightseeing Name -->
                                      <div class="form-group ">
                                        <label for="name" class="col-md-3 col-form-label">Title</label>
                                        <div class="col-md-9">
                                          <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                                        </div>
                                      </div>

                                      <!-- Sightseeing Locations -->
                                      <div class="form-group ">
                                        <label for="location" class="col-md-3 col-form-label">City</label>
                                        <div class="col-md-9">
                                          <select class="form-control quote_city location" name="location" id="location">
                                          <!-- Location options will be populated here -->
                                          </select>
                                        </div>
                                      </div>

                                      <!-- Sightseeing Duration -->
                                      <div class="form-group ">
                                        <label for="duration" class="col-md-3 col-form-label">Duration</label>
                                        <div class="col-md-9">
                                          <input type="text" name="duration" class="form-control" id="duration" placeholder="Duration in hours or days">
                                        </div>
                                      </div>

                                      <!-- Sightseeing Inclusions -->
                                      <div class="form-group ">
                                        <label for="inclusions" class="col-md-3 col-form-label">Inclusions</label>
                                        <div class="col-md-9">
                                          <input type="text" name="inclusions" class="form-control" id="inclusions" placeholder="What’s included">
                                        </div>
                                      </div>

                                      <!-- Sightseeing Exclusions -->
                                      <div class="form-group ">
                                        <label for="exclusions" class="col-md-3 col-form-label">Exclusions</label>
                                        <div class="col-md-9">
                                          <input type="text" name="exclusions" class="form-control" id="exclusions" placeholder="What’s not included">
                                        </div>
                                      </div>

                                      <!-- Sightseeing Image -->
                                      <div class="form-group ">
                                        <label for="tour_image" class="col-md-3 col-form-label">Image (250x160)</label>
                                        <div class="col-md-9">
                                          <input type="file" name="tour_image" class="form-control-file" id="tour_image">
                                        </div>
                                      </div>

                                      <!-- Sightseeing Description -->
                                      <div class="form-group ">
                                        <label for="description" class="col-md-3 col-form-label">Description</label>
                                        <div class="col-md-9">
                                          <textarea name="description" class="form-control ckeditor" id="description" rows="3" placeholder="Enter a brief description"></textarea>
                                        </div>
                                      </div>

                                      <!-- Status -->
                                      <div class="form-group ">
                                        <label for="status" class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                          <select name="status" class="form-control" id="status">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" id="addTours">Save</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit sightseeing -->
                          <div class="modal fade editTourModel" id="editToursModel"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modalDialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Sightseeing</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-tour')); ?>" enctype="multipart/form-data" method="post" id="tour_add1">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                                    <div class="makeflex flex-column">

                                      <div class="form-group">
                                        <input type="hidden" value="" class="edittypeid" name="edittypeid" />
                                        <label class="col-md-3 col-form-label">Title</label>
                                        <div class="col-md-9">
                                          <input name="name" class="form-control name" placeholder="Name" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">City</label>
                                        <div class="col-md-9">
                                            <select class="quote_city form-control location" name="location">
                                              <!-- populate from -->
                                            </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Duration</label>
                                        <div class="col-md-9">
                                          <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Inclusions</label>
                                        <div class="col-md-9">
                                          <input name="inclusions" class="form-control inclusions" placeholder="Inclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Exclusions</label>
                                        <div class="col-md-9">
                                          <input name="exclusions" class="form-control exclusions" placeholder="Exclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Image(250*160)</label>
                                        <div class="col-md-9">
                                          <input type="file" class="form-control " id="tour_image" name="tour_image" value="">
                                          <input type="hidden" class="tour_image" name="tour_image_value" value="">
                                          <!-- <div class="tour_img apndTop5">
                                            <img src="" width="50" height="50">
                                          </div> -->
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Description</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control ckeditor" name="description" id="edit_description1" cols="50" rows="2" required></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                          <select name="status" class="form-control incStatus" id="">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" id="updateTourbtn" data-action="save" role="button">Update</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Name</th>
                            <th width="100">Image</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Inclusions</th>
                            <th>Exclusions</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $all_tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editexc_<?php echo e($tour->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"> -->
                            </td>
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($tour->activity); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name only
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/tour_image/' . $tour->tour_image);

                                  // Check if the image exists in the server; otherwise, use the default image
                                  if (!empty($tour->tour_image) && file_exists($imagePath)) {
                                    $image = 'uploads/tour_image/' . $tour->tour_image;
                                  } else {
                                    $image = $defaultImage;
                                  }
                                 ?>
                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="Tour Image">
                                <input type="hidden" name="edit_img_value" class="edit_img_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typelocation"><?php echo e($tour->location); ?></td>
                            <td class="typedesc">
                              <input type="hidden" name="visapolicydesc" value="<?php echo e($tour->desc); ?>">
                              <div class="wrap_small">
                                <div class="small_class">
                                  <?php echo $tour->desc; ?>

                                </div>
                                <a href="" id="show_more">Show More</a>
                              </div>
                            </td>
                            <td class="typeduration"><?php echo e($tour->duration); ?></td>
                            <td class="typeinclusions"><?php echo e($tour->inclusions); ?></td>
                            <td class="typeexclusions"><?php echo e($tour->exclusions); ?></td>
                            <td class="typestatus center">
                              <?php if($tour->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($tour->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deleteTour')); ?>" method="post" id="deleteTour<?php echo e($tour->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($tour->id); ?>" />
                                <a class="editTourType" data-id="<?php echo e($tour->id); ?>" data-toggle="modal" data-target="#editToursModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($tour->id); ?>" class="deleteTour"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>

                <!-- activities -->
                <div class="tab-pane" id="tab5">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packageActivity" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Activity</button>

                          <!-- modal - add activity -->
                          <div class="modal fade" id="packageActivity"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modalDialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button> -->
                                  <h3 class="modal-title" id="lineModalLabel">Add Activity</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-activity')); ?>" enctype="multipart/form-data" method="post" id="activity_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Activity Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>

                                    <div class="makeflex flex-column">

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Title</label>
                                        <div class="col-md-9">
                                          <input name="name" class="form-control name" placeholder="Name" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity City</label>
                                        <div class="col-md-9">
                                           <select class="quote_city form-control location" name="location"></select>
                                          <!-- <input name="location" class="form-control location query_city" placeholder="location" value="" type="text"> -->
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Duration</label>
                                        <div class="col-md-9">
                                          <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Inclusions</label>
                                        <div class="col-md-9">
                                          <input name="inclusions" class="form-control inclusions" placeholder="Inclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Exclusions</label>
                                        <div class="col-md-9">
                                          <input name="exclusions" class="form-control exclusions" placeholder="Exclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Image(250*160)</label>
                                        <div class="col-md-9">
                                          <input name="activity_image" class="form-control activity_image " id="activity_image" type="file">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label"> Activity Description</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control description ckeditor" name="description" id="" cols="50" rows="2"><?php echo e(old('description')); ?></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                          <select name="status" class="form-control status" id="">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                      <button type="submit" id="addActivity" class="btn btn-primary" data-action="save" role="button">Save</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit activity -->
                          <div class="modal fade editActivityModel" id="editActivityModel"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modalDialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button> -->
                                  <h3 class="modal-title" id="lineModalLabel">Edit Activity</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-activity')); ?>" enctype="multipart/form-data" method="post" id="activity_add1">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Activity Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>

                                    <div class="makeflex flex-column">

                                      <div class="form-group">
                                        <input type="hidden" value="" class="editactivityid" name="editactivityid" />
                                        <label class="col-md-3 col-form-label">Activity Name</label>
                                        <div class="col-md-9">
                                          <input name="name" class="form-control name" placeholder="Name" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Locations</label>
                                        <div class="col-md-9">
                                           <select class="quote_city form-control location" name="location"></select>

                                          <!-- <input name="location" class="form-control location query_city" placeholder="location" value="" type="text"> -->
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Duration</label>
                                        <div class="col-md-9">
                                          <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Inclusions</label>
                                        <div class="col-md-9">
                                          <input name="inclusions" class="form-control inclusions" placeholder="Inclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Exclusions</label>
                                        <div class="col-md-9">
                                          <input name="exclusions" class="form-control exclusions" placeholder="Exclusions" value="" type="text">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Activity Image(250*160)</label>
                                        <div class="col-md-9">
                                          <input type="file" class="form-control activity_image" id="activity_image" name="activity_image" value="">
                                          <input type="hidden" class="activity_image_value" name="activity_image_value" value="">
                                          <div class="activity_img apndTop5">
                                            <img src="" width="100" height="50">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label"> Activity Description</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control ckeditor" name="description" id="edit_description" cols="50" rows="2" required></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                          <select name="status" class="form-control incStatus" id="">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                          </select>
                                        </div>
                                      </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" id="updateActivitybtn" data-action="save" role="button">Update</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Name</th>
                            <th width="100">Image</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Inclusions</th>
                            <th>Exclusions</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editact_<?php echo e($activity->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($activity->activity); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image path
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/activity_image/' . $activity->activity_image);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($activity->activity_image) && file_exists($imagePath)) {
                                      $image = 'uploads/activity_image/' . $activity->activity_image;
                                  } else {
                                      $image = $defaultImage;
                                  }
                                 ?>

                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="Activity Image">
                                <input type="hidden" name="activity_img_value" class="activity_img_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typelocation"><?php echo e($activity->location); ?></td>
                            <td class="typedesc">
                              <input type="hidden" name="visapolicydesc" value="<?php echo e($activity->desc); ?>">
                              <div class="wrap_small">
                                <div class="small_class">
                                  <?php echo $activity->desc; ?>

                                </div>
                                <a href="" id="show_more">Show More</a>
                              </div>
                            </td>
                            <td class="typeduration"><?php echo e($activity->duration); ?></td>
                            <td class="typeinclusions"><?php echo e($activity->inclusions); ?></td>
                            <td class="typeexclusions"><?php echo e($activity->exclusions); ?></td>

                            <td class="typestatus center">
                              <?php if($activity->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($activity->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deleteActivity')); ?>" method="post" id="deleteActivity<?php echo e($activity->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($activity->id); ?>" />
                                <a class="editActivityType" data-id="<?php echo e($activity->id); ?>" data-toggle="modal" data-target="#editActivityModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($activity->id); ?>" class="deleteActivity"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>

                <!-- destination seo -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab6">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#package_seo" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Destinaion SEO</button>

                          <!-- modal - add destination seo -->
                          <div class="modal fade" id="package_seo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title">Add Destination SEO</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-pacseo-contaier-parent" style="display:none">
                                      <p>Package SEO Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-pacseo-contaier-parent" style="display:none">
                                      <ul id="error-pacseo-contaier">
                                      </ul>
                                    </div>

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Destination</label>
                                      <div class="col-md-8">
                                        <input name="destination" class="form-control   destination" required placeholder="Destination" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Title</label>
                                      <div class="col-md-8">
                                        <input name="title" class="form-control   title" required placeholder="Title" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Keywords</label>
                                      <div class="col-md-8">
                                        <input name="keywords" class="form-control   keywords" required placeholder="Keywords" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Description</label>
                                      <div class="col-md-8">
                                        <textarea name="description" class="form-control   description" placeholder="Description"></textarea>
                                      </div>
                                    </div>
                                    <!---->
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="add_packages_seo" class="btn btn-success" data-action="save" role="button">Add</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit destination seo -->
                          <div class="modal fade edit_pack_seo" id="edit_packages_seo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Destination SEO</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form>
                                    <div class="alert alert-success" id="success-pacseo-contaier-parent" style="display:none">
                                      <p>Package SEO Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-pacseo-contaier-parent" style="display:none">
                                      <ul id="error-pacseo-contaier">
                                      </ul>
                                    </div>

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Destination</label>
                                      <div class="col-md-8">
                                        <input type="hidden" name="seo_id" class="seo_id">
                                        <input name="destination" class="form-control   destination" required placeholder="Destination" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Title</label>
                                      <div class="col-md-8">
                                        <input name="title" class="form-control   title" required placeholder="Title" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Keywords</label>
                                      <div class="col-md-8">
                                        <input name="keywords" class="form-control   keywords" required placeholder="Keywords" value="" type="text">
                                      </div>
                                    </div>
                                    <!---->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">SEO Description</label>
                                      <div class="col-md-8">
                                        <textarea name="description" class="form-control   description" placeholder="Description"></textarea>
                                      </div>
                                    </div>
                                    <!---->
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="button" id="update_packageseo" class="btn btn-success" data-action="save" role="button">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Destination Name</th>
                            <th>SEO Title</th>
                            <th>SEO Keywords</th>
                            <th>SEO Description</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $coun = "1"; ?>
                          <?php $__currentLoopData = $pack_seo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packages_seo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editexc_<?php echo e($packages_seo->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e($coun++); ?></td>
                            <td class="pack_dest"><?php echo e($packages_seo->destination); ?></td>
                            <td class="pack_title"><?php echo e($packages_seo->title); ?></td>
                            <td class="pack_keywords"><?php echo e($packages_seo->keywords); ?></td>
                            <td class="pack_description"><?php echo e($packages_seo->description); ?></td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete_packages_seo/'.$packages_seo->id)); ?>" method="post" id="deleteExcType<?php echo e($packages_seo->id); ?>" onsubmit="return confirm('Are you sure, you want to Delete this item?')">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" class="seo_id" value="<?php echo e($packages_seo->id); ?>" />
                                <input type="hidden" class="seo_destination" value="<?php echo e($packages_seo->destination); ?>">
                                <input type="hidden" class="seo_title" value="<?php echo e($packages_seo->title); ?>">
                                <input type="hidden" class="seo_keywords" value="<?php echo e($packages_seo->keywords); ?>">
                                <input type="hidden" class="seo_desc" value="<?php echo e($packages_seo->description); ?>">

                                <a class="edit_packages_seo" data-id="<?php echo e($packages_seo->id); ?>" data-toggle="modal" data-target="#edit_packages_seo" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- transfers -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab7">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#transfersAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Transfers</button>

                          <!-- modal - add transfer -->
                          <div class="modal fade" id="transfersAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Transfer</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-transfers')); ?>" enctype="multipart/form-data" method="post" id="transfer_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Transfer Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Select Transport</label>
                                      <div class="col-md-8">
                                        <select name="transport_type" id="transport_type" class="form-control">
                                          <option value="">--Choose Transport--</option>
                                          <option value="Car">Car</option>
                                          <option value="Bus">Bus</option>
                                          <option value="Train">Train</option>
                                          <option value="Ferry">Ferry</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Select Transfer Type</label>
                                      <div class="col-md-8">
                                        <select name="transfer_type" id="transfer_type" class="form-control">
                                          <option value="">--Choose Transfer Type--</option>
                                          <option value="Private">Private</option>
                                          <option value="Shared">Shared</option>
                                          <option value="Coach">Coach</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="title" class="form-control name" placeholder="Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Transfer Image(250*160)</label>
                                      <div class="col-md-8">
                                        <input name="transfer_image" class="form-control transfer_image" id="transfer_image" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Vehicle Type</label>
                                      <div class="col-md-8">
                                        <input name="vehicle_type" class="form-control vehicle_type" placeholder="Vehicle Type" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Duration</label>
                                      <div class="col-md-8">
                                        <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Includes</label>
                                      <div class="col-md-8">
                                        <input name="includes" class="form-control includes" placeholder="Includes" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">City</label>
                                      <div class="col-md-8">
                                        <input name="city" class="form-control city" placeholder="City" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addTransfers" class="btn btn-success" data-action="save" role="button">Add</button>

                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit transfer -->
                          <div class="modal fade editTransferModel" id="editTransferModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Transfer</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-transfers')); ?>" enctype="multipart/form-data" method="post" id="transfer-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Transfer Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <input type="hidden" value="" class="edittransferid" name="edittransferid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Select Transport</label>
                                      <div class="col-md-8">
                                        <select name="transport_type" id="transport_type" class="form-control">
                                          <option value="">--Choose Transport--</option>
                                          <option value="Car">Car</option>
                                          <option value="Bus">Bus</option>
                                          <option value="Train">Train</option>
                                          <option value="Ferry">Ferry</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Select Transfer Type</label>
                                      <div class="col-md-8">
                                        <select name="transfer_type" id="transfer_type" class="form-control">
                                          <option value="">--Choose Transfer Type--</option>
                                          <option value="Private">Private</option>
                                          <option value="Shared">Shared</option>
                                          <option value="Coach">Coach</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="title" class="form-control name" placeholder="Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Transfer Image(250*160)</label>
                                      <div class="col-md-8">
                                        <span class="transfer_img">
                                          <img width="100" height="50">
                                        </span>
                                        <input name="transfer_image" class="form-control transfer_image" id="transfer_image" type="file">
                                        <input type="hidden" class="transfer_image_value" name="transfer_image_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Vehicle Type</label>
                                      <div class="col-md-8">
                                        <input name="vehicle_type" class="form-control vehicle_type" placeholder="Vehicle Type" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Duration</label>
                                      <div class="col-md-8">
                                        <input name="duration" class="form-control duration" placeholder="Duration" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Includes</label>
                                      <div class="col-md-8">
                                        <input name="includes" class="form-control includes" placeholder="Includes" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">City</label>
                                      <div class="col-md-8">
                                        <input name="city" class="form-control city" placeholder="City" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateTransferbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Transport</th>
                            <th width="100">Image</th>
                            <th>Transport Type</th>
                            <th>Title</th>
                            <th>Vehicle Type</th>
                            <th>Duration</th>
                            <th>Includes</th>
                            <th>City</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $transfer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transfer): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="edittrans_<?php echo e($transfer->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typeTransport"><?php echo e($transfer->transport_type); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name only
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/transfer_image/' . $transfer->transfer_image);

                                  // Check if the image exists in the server; otherwise, use the default image
                                  if (!empty($transfer->transfer_image) && file_exists($imagePath)) {
                                    $image = 'uploads/transfer_image/' . $transfer->transfer_image;
                                  } else {
                                    $image = $defaultImage;
                                  }
                                 ?>
                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="img">
                                <input type="hidden" name="edit_img_value" class="edit_img_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typeTransfer"><?php echo e($transfer->transfer_type); ?></td>
                            <td class="typeTitle"><?php echo e($transfer->title); ?></td>
                            <td class="typeVehicle"><?php echo e($transfer->vehicle_type); ?></td>
                            <td class="typeDuration"><?php echo e($transfer->duration); ?></td>
                            <td class="typeIncludes"><?php echo e($transfer->includes); ?></td>
                            <td class="typeCity"><?php echo e($transfer->city); ?></td>
                            <td class="typestatus center">
                              <?php if($transfer->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($transfer->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-transfers')); ?>" method="post" id="delete-transfers<?php echo e($transfer->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($transfer->id); ?>" />
                                <a class="editTransfer" data-id="<?php echo e($transfer->id); ?>" data-toggle="modal" data-target="#editTransferModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($transfer->id); ?>" class="deleteTransfer"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- airline -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab8">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#airlineAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Airline</button>

                          <!-- modal - add airline -->
                          <div class="modal fade" id="airlineAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Airline</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-airlines')); ?>" enctype="multipart/form-data" method="post" id="airline_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Airline Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Name</label>
                                      <div class="col-md-8">
                                        <input name="airline_name" class="form-control name" placeholder="Airline Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Code</label>
                                      <div class="col-md-8">
                                        <input name="airline_code" class="form-control code" placeholder="Airline Code" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Logo(250*160)</label>
                                      <div class="col-md-8">
                                        <input name="airline_logo" class="form-control airline_logo" id="airline_logo" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addAirline" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - Edit airline -->
                          <div class="modal fade editAirlinesModel" id="editAirlinesModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Airline</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-airlines')); ?>" enctype="multipart/form-data" method="post" id="airline-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Airline Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <input type="hidden" value="" class="editairlineid" name="editairlineid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Name</label>
                                      <div class="col-md-8">
                                        <input name="airline_name" class="form-control name" placeholder="Airline Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Code</label>
                                      <div class="col-md-8">
                                        <input name="airline_code" class="form-control code" placeholder="Airline Code" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Airline Logo(250*160)</label>
                                      <div class="col-md-8">
                                        <span class="airline_img">
                                          <img width="100" height="50">
                                        </span>
                                        <input name="airline_logo" class="form-control airline_logo" id="airline_logo" type="file">
                                        <input type="hidden" class="airline_logo_value" name="airline_logo_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateAirlinebtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th width="100">Image</th>
                            <th>Airline Name</th>
                            <th>Airline Code</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $airline_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editAir_<?php echo e($item->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name only
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/airline_logo/' . $item->airline_logo);

                                  // Check if the image exists in the server; otherwise, use the default image
                                  if (!empty($item->airline_logo) && file_exists($imagePath)) {
                                    $image = 'uploads/airline_logo/' . $item->airline_logo;
                                  } else {
                                    $image = $defaultImage;
                                  }
                                 ?>
                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="img">
                                <input type="hidden" name="edit_air_value" class="edit_air_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            </td>
                            <td class="typeAirline"><?php echo e($item->airline_name); ?></td>
                            <td class="typeCode"><?php echo e($item->airline_code); ?></td>
                            <td class="typestatus center">
                              <?php if($item->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-airlines')); ?>" method="post" id="delete-airlines<?php echo e($item->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>" />
                                <a class="editAirline" data-id="<?php echo e($item->id); ?>" data-toggle="modal" data-target="#editAirlinesModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($item->id); ?>" class="deleteAirline"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- iata code -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab9">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#iataAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add IATA</button>

                          <!-- modal - add IATA code -->
                          <div class="modal fade" id="iataAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add New IATA Code</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-iata')); ?>" enctype="multipart/form-data" method="post" id="iata_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>IATA Added Successfully.</p>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Add IATA Code</label>
                                      <div class="col-md-8">
                                        <input name="iata_name" class="form-control iataname" placeholder="IATA Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">IATA Code</label>
                                      <div class="col-md-8">
                                        <input name="iata_code" class="form-control iatacode" placeholder="IATA Code" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addIATA" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - Edit IATA code -->
                          <div class="modal fade editIataModel" id="editIataModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit IATA Code</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-iata')); ?>" enctype="multipart/form-data" method="post" id="iata-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>IATA Added Successfully.</p>
                                    </div>
                                    <input type="hidden" value="" class="editiataid" name="editiataid" />

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">IATA Name</label>
                                      <div class="col-md-8">
                                        <input name="iata_name" class="form-control iataname" placeholder="IATA Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">IATA Code</label>
                                      <div class="col-md-8">
                                        <input name="iata_code" class="form-control iatacode" placeholder="IATA Code" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateIatabtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>IATA Name</th>
                            <th>IATA Code</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $iata_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editIata_<?php echo e($iata->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typeIATA"><?php echo e($iata->iata_name); ?></td>
                            <td class="typeIATACode"><?php echo e($iata->iata_code); ?></td>
                            <td class="typestatus center">
                              <?php if($iata->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($iata->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-iata')); ?>" method="post" id="delete-iata<?php echo e($iata->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($iata->id); ?>" />
                                <a class="editIata" data-id="<?php echo e($iata->id); ?>" data-toggle="modal" data-target="#editIataModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($iata->id); ?>" class="deleteIATA"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- general tag -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab10">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#tagsAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New General Tags</button>

                          <!-- modal - add general tag -->
                          <div class="modal fade" id="tagsAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add General Tags</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-generals')); ?>" enctype="multipart/form-data" method="post" id="gtags_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Tag Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="General Tags Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addTags" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit general tag -->
                          <div class="modal fade editGtagsModel" id="editGtagsModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit General Tags</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-generals')); ?>" enctype="multipart/form-data" method="post" id="gtags-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>General Tags Added Successfully.</p>
                                    </div>
                                    <!--div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div-->
                                    <input type="hidden" value="" class="editgtagsid" name="editgtagsid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="General Tags Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <span class="gtag_icon">
                                          <img width="100" height="50">
                                        </span>
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                        <input type="hidden" class="icon_value" name="icon_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateGtagsbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th width="100">Image</th>
                            <th>Title</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $gtags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editGtag_<?php echo e($item->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/gtag/' . $item->icon);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($item->icon) && file_exists($imagePath)) {
                                      $image = 'uploads/gtag/' . $item->icon;
                                  } else {
                                      $image = $defaultImage;
                                  }
                                 ?>
                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="icon">
                                <input type="hidden" name="edit_gtag_value" class="edit_gtag_value" value="<?php echo e($image); ?>">
                            </div>
                            </td>
                            <td class="typeGtTitle"><?php echo e($item->icon_title); ?></td>
                            <td class="typeGtUpdate"><?php echo e($item->updated_at); ?></td>
                            <td class="typestatus center">
                              <?php if($item->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-generals')); ?>" method="post" id="delete-generals<?php echo e($item->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>" />
                                <a class="editGtags" data-id="<?php echo e($item->id); ?>" data-toggle="modal" data-target="#editGtagsModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($item->id); ?>" class="deleteGtags"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- suitable for -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab11">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#suitableAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Suitable</button>

                          <!-- modal - add suitalble -->
                          <div class="modal fade" id="suitableAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Suitable</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-suitables')); ?>" enctype="multipart/form-data" method="post" id="suitables_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Suitables Added Successfully.</p>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="Suitable Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addTags" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit suitalble -->
                          <div class="modal fade editStblModel" id="editStblModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Suitable</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-suitables')); ?>" enctype="multipart/form-data" method="post" id="suitables-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Suitables Added Successfully.</p>
                                    </div>
                                    <input type="hidden" value="" class="editstblsid" name="editstblsid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Title</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="Suitables Title" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <span class="stbl_icon">
                                          <img width="100" height="50">
                                        </span>
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                        <input type="hidden" class="icon_value" name="icon_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateStblbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th width="100">Image</th>
                            <th>Title</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="editStbl_<?php echo e($item->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/suitable/' . $item->icon);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($item->icon) && file_exists($imagePath)) {
                                      $image = 'uploads/suitable/' . $item->icon;
                                  } else {
                                      $image = $defaultImage;
                                  }
                                 ?>

                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="icon">
                                <input type="hidden" name="edit_suitable_value" class="edit_suitable_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typeStblTitle"><?php echo e($item->icon_title); ?></td>
                            <td class="typeStblUpdate"><?php echo e($item->updated_at); ?></td>
                            <td class="typestatus center">
                              <?php if($item->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-suitables')); ?>" method="post" id="delete-suitable<?php echo e($item->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>" />
                                <a class="editSuitable" data-id="<?php echo e($item->id); ?>" data-toggle="modal" data-target="#editStblModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($item->id); ?>" class="deleteSuitable"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- holiday type -->
                <?php if(Sentinel::check()): ?>
                <?php if(Sentinel::getUser()->inRole('super_admin')): ?>
                <div class="tab-pane" id="tab12">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#holidayAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Holiday Type</button>

                          <!-- modal - add holiday type -->
                          <div class="modal fade" id="holidayAdd" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Holiday Type</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-holiday')); ?>" enctype="multipart/form-data" method="post" id="suitables_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Holiday Added Successfully.</p>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Name</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="Holiday Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addHoliday" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit holiday type -->
                          <div class="modal fade editHldModel" id="editHldModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Holiday Type</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-holiday')); ?>" enctype="multipart/form-data" method="post" id="holiday-edit">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Holiady Added Successfully.</p>
                                    </div>
                                    <input type="hidden" value="" class="edithldid" name="edithldid" />
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Name</label>
                                      <div class="col-md-8">
                                        <input name="icon_title" class="form-control name" placeholder="Holiday Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Choose Icon</label>
                                      <div class="col-md-8">
                                        <span class="holiday_icon">
                                          <img width="100" height="50">
                                        </span>
                                        <input name="icon" class="form-control icon" id="icon" type="file">
                                        <input type="hidden" class="icon_value" name="icon_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="updateHdbtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th width="100">Image</th>
                            <th>Title</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $holiday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="edithld_<?php echo e($item->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image path
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/holiday/' . $item->icon);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($item->icon) && file_exists($imagePath)) {
                                      $image = 'uploads/holiday/' . $item->icon;
                                  } else {
                                      $image = $defaultImage;
                                  }
                                 ?>

                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="Holiday Image">
                                <input type="hidden" name="edit_holiday_value" class="edit_holiday_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typeHldTitle"><?php echo e($item->icon_title); ?></td>
                            <td class="typeHldUpdate"><?php echo e($item->updated_at); ?></td>
                            <td class="typestatus center">
                              <?php if($item->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($item->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/delete-holiday')); ?>" method="post" id="delete-holiday<?php echo e($item->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>" />
                                <a class="editHoliday" data-id="<?php echo e($item->id); ?>" data-toggle="modal" data-target="#editHldModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($item->id); ?>" class="deleteHoliday"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- tour type -->
                <div class="tab-pane" id="tab13">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packagetourtype" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Tour Type</button>

                          <!-- modal - add tour type -->
                          <div class="modal fade" id="packagetourtype"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Tour Type</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-tour-type')); ?>" enctype="multipart/form-data" method="post" id="activity_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Tour Type Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Type Name</label>
                                      <div class="col-md-8">
                                        <input name="tour_type" class="form-control tour_type" placeholder="Name" value="" type="text">

                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Type Icon</label>
                                      <div class="col-md-8">
                                        <input name="icon" class="form-control icon" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-12 control-label text-left"> Tour Type Description</label>
                                      <div class="col-md-11">
                                        <textarea class="form-control description ckeditor" name="description" id="" cols="50" rows="2"><?php echo e(old('description')); ?></textarea>
                                      </div>
                                    </div>

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addActivity" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit tour type -->
                          <div class="modal fade edittourtypeModel" id="edittourtypeModel"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Tour Type</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-tour-type')); ?>" enctype="multipart/form-data" method="post" id="activity_add1">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Tour Type Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <input type="hidden" value="" class="edittourtypeid" name="edittourtypeid" />
                                      <label class="col-md-3 control-label text-left">Tour Type Name</label>
                                      <div class="col-md-8">
                                        <input name="tour_type" class="form-control tour_type" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Type Icon</label>
                                      <div class="col-md-8">
                                        <span class="tour_type_img">
                                          <img width="100" height="50">
                                        </span>
                                        <input type="file" class="form-control icon" id="icon" name="icon" value="">
                                        <input type="hidden" class="tour_type_image_value" name="tour_type_image_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-12 control-label text-left"> Tour Type Description</label>
                                      <div class="col-md-11">
                                        <textarea class="form-control ckeditor" name="description" id="edit_tour_type_description" cols="50" rows="2" required></textarea>
                                      </div>
                                    </div>
                               



                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control incStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-md-12" style="text-align: center;">
                                        <div class="btn-group" role="group">
                                          <button type="submit" id="updateActivitybtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Tour Type</th>
                            <th>Image</th>                            
                            <th>Description</th>                           
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $tour_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour_type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="edittour_<?php echo e($tour_type->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($tour_type->tour_type); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name
                                  $defaultImage = 'uploads/default-img.webp';
                                  $imagePath = public_path('uploads/tour_type_image/' . $tour_type->icon);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($tour_type->icon) && file_exists($imagePath)) {
                                    $image = 'uploads/tour_type_image/' . $tour_type->icon;
                                  } else {
                                    $image = $defaultImage;
                                  }
                                 ?>
                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="Tour Type Image">
                                <input type="hidden" name="tour_type_img_value" class="tour_type_img_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>                          
                            <td class="typedesc">
                              <input type="hidden" name="visapolicydesc" value="<?php echo e($tour_type->description); ?>">
                              <div class="wrap_small">
                                <div class="small_class">
                                  <?php echo $tour_type->description; ?>

                                </div>
                                <a href="" id="show_more">Show More</a>
                              </div>
                            </td>
                           

                            <td class="typestatus center">
                              <?php if($tour_type->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($tour_type->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deletetourtype')); ?>" method="post" id="deletetourtype<?php echo e($tour_type->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($tour_type->id); ?>" />
                                <a class="editTourType" data-id="<?php echo e($tour_type->id); ?>" data-toggle="modal" data-target="#edittourtypeModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($tour_type->id); ?>" class="deletetourtype"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>

                <!-- tour category -->
                <div class="tab-pane" id="tab14">
                  <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped example1">
                        <div class="add">
                          <button data-toggle="modal" data-target="#packagetourcategory" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Tour Category</button>

                          <!-- modal - add tour category -->
                          <div class="modal fade" id="packagetourcategory"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Add Tour Category</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/add-tour-category')); ?>" enctype="multipart/form-data" method="post" id="activity_add">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent" style="display:none">
                                      <p>Tour Category Added Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent" style="display:none">
                                      <ul id="error-contaier">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Category Name</label>
                                      <div class="col-md-8">
                                        <input name="tour_category" class="form-control tour_category" placeholder="Name" value="" type="text">

                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Category Icon</label>
                                      <div class="col-md-8">
                                        <input name="icon" class="form-control icon" type="file">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-12 control-label text-left"> Tour Category Description</label>
                                      <div class="col-md-11">
                                        <textarea class="form-control description ckeditor" name="description" id="" cols="50" rows="2"><?php echo e(old('description')); ?></textarea>
                                      </div>
                                    </div>

                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control status" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                      <button type="submit" id="addActivity" class="btn btn-success" data-action="save" role="button">Add</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- modal - edit tour category -->
                          <div class="modal fade edittourcategoryModel" id="edittourcategoryModel"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h3 class="modal-title" id="lineModalLabel">Edit Tour Category</h3>
                                </div>
                                <div class="modal-body">
                                  <!-- content goes here -->
                                  <form action="<?php echo e(URL::to('/edit-tour-category')); ?>" enctype="multipart/form-data" method="post" id="activity_add1">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="alert alert-success" id="success-contaier-parent1" style="display:none">
                                      <p>Tour Category Updated Successfully.</p>
                                    </div>
                                    <div class="alert alert-danger" id="error-contaier-parent1" style="display:none">
                                      <ul id="error-contaier1">
                                      </ul>
                                    </div>
                                    <div class="row form-group">
                                      <input type="hidden" value="" class="edittourcategoryid" name="edittourcategoryid" />
                                      <label class="col-md-3 control-label text-left">Tour Category Name</label>
                                      <div class="col-md-8">
                                        <input name="tour_category" class="form-control tour_category" placeholder="Name" value="" type="text">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Tour Category Icon</label>
                                      <div class="col-md-8">
                                        <span class="tour_category_img">
                                          <img width="100" height="50">
                                        </span>
                                        <input type="file" class="form-control icon" id="icon" name="icon" value="">
                                        <input type="hidden" class="tour_category_image_value" name="tour_category_image_value" value="">
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-12 control-label text-left"> Tour Category Description</label>
                                      <div class="col-md-11">
                                        <textarea class="form-control ckeditor" name="description" id="edit_tour_category_description" cols="50" rows="2" required></textarea>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <label class="col-md-3 control-label text-left">Status</label>
                                      <div class="col-md-8">
                                        <select name="status" class="form-control incStatus" id="">
                                          <option value="1">Enable</option>
                                          <option value="0">Disable</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-md-12" style="text-align: center;">
                                        <div class="btn-group" role="group">
                                          <button type="submit" id="updateActivitybtn" class="btn btn-success" data-action="save" role="button">Update</button>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <!-- <th><input class="checkboxcls" value="3" type="checkbox"></th> -->
                            <th>S.No.</th>
                            <th>Tour Category</th>
                            <th>Image</th>                            
                            <th>Description</th>                           
                            <th>Status</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $tour_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour_category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <tr id="edittourcategory_<?php echo e($tour_category->id); ?>">
                            <!-- <td><input class="checkboxcls" value="3" type="checkbox"></td> -->
                            <td class="center"><?php echo e(++$key); ?></td>
                            <td class="typename"><?php echo e($tour_category->tour_category); ?></td>
                            <td>
                              <div class="typeImage">
                                <?php 
                                  // Define the default image file name
                                  $defaultImage = 'uploads/default_profile_image.png';
                                  $imagePath = public_path('uploads/tour_category_image/' . $tour_category->icon);

                                  // Check if the image exists, otherwise use the default image
                                  if (!empty($tour_category->icon) && file_exists($imagePath)) {
                                      $image = 'uploads/tour_category_image/' . $tour_category->icon;
                                  } else {
                                      $image = $defaultImage;
                                  }
                                 ?>

                                <img src="<?php echo e(asset('public/' . $image)); ?>" alt="Tour Category Image">
                                <input type="hidden" name="tour_category_img_value" class="tour_category_img_value" value="<?php echo e($image); ?>">
                              </div>
                            </td>
                            <td class="typedesc">
                              <input type="hidden" name="visapolicydesc" value="<?php echo e($tour_category->description); ?>">
                              <div class="wrap_small">
                                <div class="small_class">
                                  <?php echo $tour_category->description; ?>

                                </div>
                                <a href="" id="show_more">Show More</a>
                              </div>
                            </td>

                            <td class="typestatus center">
                              <?php if($tour_category->status == 1): ?>
                              <button class="btn btn-sm btn-success no-event">Enabled</button>
                              <?php else: ?>
                              <button class="btn btn-sm btn-danger no-event">Disabled</button>
                              <?php endif; ?>
                              <input type="hidden" name="status" value="<?php echo e($tour_category->status); ?>">
                            </td>
                            <td>
                              <form action="<?php echo e(URL::to('/deletetourcategory')); ?>" method="post" id="deletetourcategory<?php echo e($tour_category->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="<?php echo e($tour_category->id); ?>" />
                                <a class="editTourCategory" data-id="<?php echo e($tour_category->id); ?>" data-toggle="modal" data-target="#edittourcategoryModel" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                                <a href="#" data-id="<?php echo e($tour_category->id); ?>" class="deletetourcategory"><span class="btn btn-sm btn-danger">Delete</span></a>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
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
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code_second"); ?>

<script>  
$(document).ready(function() {
  // Initialize the Select2 plugin for the .quote_city dropdown
  $('.quote_city').select2({
    placeholder: "To",   // Placeholder text for the dropdown
    allowClear: true,    // Allow clearing the selected option
    ajax: {
      // URL for the AJAX request (retrieves destination data)
      url: $("#APP_URL").val() + '/search_quote_destination',
      type: "get",        // HTTP method for the request
      dataType: 'json',   // Expect JSON response
      delay: 250,         // Delay in milliseconds before sending the request (debouncing)
      
      // Data sent with the request
      data: function(params) {
        return {
          searchTerm: params.term // The search term entered by the user
        };
      },
      
      // Process the server's response to match Select2 format
      processResults: function(response) {
        return {
          results: response  // The results to display in the dropdown
        };
      },
      
      cache: true  // Cache the results to avoid repeated requests for the same query
    }
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>