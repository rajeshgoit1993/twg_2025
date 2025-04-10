<?php $__env->startSection('content'); ?>
<style type="text/css">
.small_class {
  height: 30px;
  overflow:hidden;
}
.big_class {
  height: auto;
}
.nav-tabs > li {
  float: left;
  margin-bottom: -1px;
  width: 12% !important;
  text-align: center;
}
</style>

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
              <!-- <li class="active"><a href="#tab1" data-toggle="tab">General</a></li> -->
              <li class="active"><a href="#tab1" data-toggle="tab">Payment Policies</a></li>
              <li ><a href="#tab2" data-toggle="tab">Cancellation Policies</a></li>
              <li ><a href="#tab3" data-toggle="tab">Visa Policies</a></li>
              <li ><a href="#tab4" data-toggle="tab">Important Notes</a></li>
              <li ><a href="#tab5" data-toggle="tab">Traveller Type</a></li>
              <li ><a href="#tab6" data-toggle="tab">Package Category</a></li>
            </ul>
          </h3>
        </div>

        <div class="panel-body">
          <div class="tabbable">
            <div class="tab-content">
              <?php if(Session::has('success')): ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <?php echo e(Session::get('success')); ?>

              </div>
              <?php endif; ?>

              <!-- payment policies -->
              <div class="tab-pane active" id="tab1">
                <div class="box">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                  <table class="table table-bordered table-striped example1">
                    <div class="add">
                    <?php if(Sentinel::check()): ?>
                    <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                      <button data-toggle="modal" data-target="#addPaymentPolicy" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Payment Policy </button>
                    <?php endif; ?>
                    <?php endif; ?>

                    <div class="modal fade" id="addPaymentPolicy" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add Policy</h3>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form action="<?php echo e(URL::to('/save-payPolicy')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div class="row form-group">
                          <label class="col-md-3 control-label text-left"> Policy Name</label>
                          <div class="col-md-8">
                            <textarea class="form-control"  name="policy" id="pkgPolicyName" cols="70" rows="1" required></textarea>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-md-12 control-label text-left"> Policy Description</label>
                          <div class="col-md-11">
                            <textarea class="form-control ckeditor" name="policy_desc" id="pkgPolicyDesc" cols="50" rows="2" required></textarea>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-md-3 control-label text-left">Status</label>
                          <div class="col-md-8">
                            <select name="status" class="form-control pkgTypeStatus" id="">
                              <option value="1">Enable</option>
                              <option value="0">Disable</option>
                            </select>
                          </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="submit" id="savePackageTypes" class="btn btn-success" data-action="save" role="button">Add</button>
                          </div>
                          </div>
                        </div>
                      </form>

                    </div>

                    </div>
                    </div>
                    <div class="modal fade editPkgPayPolicy" id="editPkgPayPolicyModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit Package Policy</h3>
                      </div>
                      <div class="modal-body">

                        <!-- content goes here -->
                        <form action="<?php echo e(URL::to('/save-payPolicy')); ?>" method="POST">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" value="" name="id" class="edittypeid"/>
                          <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Type Name</label>
                            <div class="col-md-8">
                            <textarea class="form-control pkgPolicyName" name="policy" id="pkgPolicyName" cols="70" rows="1" required></textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <label class="col-md-12 control-label text-left"> Policy Description</label>
                            <div class="col-md-11">
                            <textarea class="form-control ckeditor" name="policy_desc" id="pkgPayDesc" cols="50" rows="2" required></textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Status</label>
                            <div class="col-md-8">
                            <select name="status" class="form-control pkgPayPolicyStatus" id="">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                            </select>
                            </div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                            <div class="btn-group" role="group">
                              <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                            </div>
                            <div class="btn-group" role="group">
                              <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                            </div>
                            </div>
                          </div>
                        </form>

                      </div>
                    </div>
                    </div>
                    </div>

                    <thead>
                      <tr>
                        <th><input class="checkboxcls" value="3" type="checkbox"></th>
                        <th>#</th>
                        <th>Policy Name</th>
                        <th style="width: 406px;">Policy Description</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $PkgPaymentPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <tr id="edittype_<?php echo e($pol->id); ?>">
                        <td><input class="checkboxcls" value="3" type="checkbox"></td>
                        <td class="center"><?php echo e(++$key); ?></td>
                        <td class="packagePayPolicy"><?php echo e($pol->policy); ?></td>
                        <td class="packagePayDesc">
                          <input type="hidden" name="" value="<?php echo e($pol-> pkgPolicyDesc); ?>">
                          <div class="wrap_small">
                            <div class="small_class">
                              <?php echo $pol-> pkgPolicyDesc; ?>

                            </div>
                            <a href="" id="show_more">Show More</a>
                          </div>
                        </td>
                        <td class="poltypestatus center">
                          <?php if($pol->status == 1): ?>
                          <button class="btn btn-sm btn-success">Enabled</button>
                          <?php else: ?>
                          <button class="btn btn-sm btn-danger">Disabled</button>
                          <?php endif; ?>
                          <input  type="hidden" name="status" value="<?php echo e($pol->status); ?>">
                        </td>
                        <td>
                          <form action="<?php echo e(URL::to('/deletePayPolicy')); ?>" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($pol->id); ?>"/>
                            <a class="edit_pkgPayPolicy" data-id="<?php echo e($pol->id); ?>" data-toggle="modal"  data-target="#editPkgPayPolicyModal" href="#" style=""><span class="btn btn-sm btn-warning">Edit</span></a>
                            <!--<a href="#" data-id="<?php echo e($pol->id); ?>" class="btn btn-danger deletePkgType"><i class="fa fa-times"></i></a>-->
                            <?php if(Sentinel::check()): ?>
                            <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                              <button class="btn btn-sm btn-danger">Delete</button>
                            <?php endif; ?>
                            <?php endif; ?>
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

              <!-- visa policies -->
              <div class="tab-pane" id="tab3">
                <div class="box">
                  <div class="box-header"></div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table  class="table table-bordered table-striped example1">
                      <div class="add">
                      <?php if(Sentinel::check()): ?>
                      <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                      <button data-toggle="modal" data-target="#addVisaPolicy" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Visa Policy </button>
                      <?php endif; ?>
                      <?php endif; ?>
                      <div class="modal fade" id="addVisaPolicy" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Add Visa Policy</h3>
                          </div>
                          <div class="modal-body">
                          <!-- content goes here -->
                          <form action="<?php echo e(URL::to('/save-visaPolicy')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row form-group">
                              <label class="col-md-3 control-label text-left"> Policy Name</label>
                              <div class="col-md-8">
                              <textarea class="form-control" name="policy" id="pkgPolicyName" cols="50" rows="1" required></textarea>
                              </div>
                            </div>
                            <div class="row form-group">
                              <label class="col-md-12 control-label text-left"> Policy Description</label>
                              <div class="col-md-11">
                              <textarea class="form-control ckeditor" name="policy_desc" id="pkgPolicyDesc" cols="50" rows="2" required></textarea>
                              </div>
                            </div>
                            <div class="row form-group">
                              <label class="col-md-3 control-label text-left">Status</label>
                              <div class="col-md-8">
                                <select name="status" class="form-control pkgTypeStatus" id="">
                                  <option value="1">Enable</option>
                                  <option value="0">Disable</option>
                                </select>
                              </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                </div>
                                <div class="btn-group" role="group">
                                  <button type="submit" id="savePackageTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
                                </div>
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade editPkgVisaPolicy" id="editVisaPolicyModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h3 class="modal-title" id="lineModalLabel">Edit Package Type</h3>
                        </div>
                      <div class="modal-body">
                        <!-- content goes here -->
                        <form action="<?php echo e(URL::to('/save-visaPolicy')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="" name="id" class="edittypeid"/>
                        <div class="row form-group">
                          <label class="col-md-3 control-label text-left">Type Name</label>
                          <div class="col-md-8">
                          <textarea class="pkgPolicyName" name="policy" id="pkgPolicyName" cols="50" rows="1" required></textarea>
                        </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-md-12 control-label text-left"> Policy Description</label>
                          <div class="col-md-11">
                            <textarea class="form-control ckeditor" name="policy_desc" id="pkgPolicyDesc" cols="50" rows="2" required ></textarea>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-md-3 control-label text-left">Status</label>
                          <div class="col-md-8">
                          <select name="status" class="form-control pkgPayPolicyStatus" id="">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                          </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                          </div>
                        </div>
                      </div>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>

                      <thead>
                        <tr>
                          <th><input class="checkboxcls" value="3" type="checkbox"></th>
                          <th>#</th>
                          <th>Policy</th>
                          <th style="width: 466px;">Policy Description</th>
                          <th>Status</th>
                          <th width="100">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $PkgVisaPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr id="edittype_<?php echo e($pol->id); ?>">
                          <td><input class="checkboxcls" value="3" type="checkbox"></td>
                          <td class="center"><?php echo e(++$key); ?></td>
                          <td class="visaPolicy"><?php echo e($pol->policy); ?></td>
                          <td class="visaPolicyDesc">
                            <input type="hidden" name="visapolicydesc" value="<?php echo e($pol->  pkgPolicyDesc); ?>">
                            <div class="wrap_small">
                              <div class="small_class">
                                <?php echo $pol->  pkgPolicyDesc; ?>

                              </div>
                              <a href="" id="show_more">Show More</a>
                            </div>
                          </td>
                          <td class="visaPolicystatus center">
                          <?php if($pol->status == 1): ?>
                          <button class="btn btn-sm btn-success">Enabled</button>
                          <?php else: ?>
                          <button class="btn btn-sm btn-danger">Disabled</button>
                          <?php endif; ?>
                          <input  type="hidden" name="status" value="<?php echo e($pol->status); ?>">
                          </td>
                          <td>
                            <form action="<?php echo e(URL::to('/deletePkgType')); ?>" method="post" id="deletePkgType<?php echo e($pol->id); ?>">
                              <?php echo e(csrf_field()); ?>

                              <input type="hidden" name="id" value="<?php echo e($pol->id); ?>"/>
                              <a class="edit_pkgvisaPolicy" data-id="<?php echo e($pol->id); ?>" data-toggle="modal"  data-target="#editVisaPolicyModal" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                              <?php if(Sentinel::check()): ?>
                              <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                                <a href="#" data-id="<?php echo e($pol->id); ?>" class="deletePkgType"><span class="btn btn-sm btn-danger">Delete</span></a>
                              <?php endif; ?>
                              <?php endif; ?>
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

              <!-- important notes -->
              <div class="tab-pane" id="tab4">
                <div class="box">
                  <div class="box-header"></div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table  class="table table-bordered table-striped example1">
                      <div class="add">
                      <?php if(Sentinel::check()): ?>
                      <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                        <button data-toggle="modal" data-target="#addimpnotes" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Important Notes</button>
                      <?php endif; ?>
                      <?php endif; ?>
                      <div class="modal fade" id="addimpnotes" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Add Important Notes</h3>
                          </div>
                          <div class="modal-body">
                          <!-- content goes here -->
                          <form action="<?php echo e(URL::to('/save-impnotes')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row form-group">
                            <label class="col-md-3 control-label text-left"> Notes Name</label>
                            <div class="col-md-8">
                            <textarea class="form-control"  name="notes_name" id="notes_name" cols="70" rows="1" required></textarea>
                            </div>
                            </div>
                            <div class="row form-group">
                            <label class="col-md-12 control-label text-left"> Notes Description</label>
                            <div class="col-md-11">
                            <textarea class="form-control ckeditor" name="notes_desc" id="notes_desc" cols="50" rows="2" required></textarea>
                            </div>
                            </div>
                            <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Status</label>
                            <div class="col-md-8">
                            <select name="notes_status" class="form-control notes_status" id="">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                            </select>
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                            <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                            </div>
                            <div class="btn-group" role="group">
                            <button type="submit" id="savePackageTypes" class="btn btn-success" data-action="save" role="button">Add</button>
                            </div>
                            </div>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade editimpnotes" id="editimpnotes" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit Important Notes</h3>
                      </div>
                      <div class="modal-body">
                        <!-- content goes here -->
                        <form action="<?php echo e(URL::to('/save-impnotes')); ?>" method="POST">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" value="" name="id" class="edittypeid"/>
                          <div class="row form-group">
                          <label class="col-md-3 control-label text-left">Notes Name</label>
                          <div class="col-md-8">
                          <textarea class="form-control notes_name" name="notes_name" id="notes_name" cols="70" rows="1" required></textarea>
                          </div>
                          </div>
                          <div class="row form-group">
                          <label class="col-md-12 control-label text-left"> Notes Description</label>
                          <div class="col-md-11">
                          <textarea class="form-control ckeditor" name="notes_desc" id="notes_desc" cols="50" rows="2" required></textarea>
                          </div>
                          </div>
                          <div class="row form-group">
                          <label class="col-md-3 control-label text-left">Status</label>
                          <div class="col-md-8">
                          <select name="notes_status" class="form-control pkgPayPolicyStatus" id="">
                          <option value="1">Enable</option>
                          <option value="0">Disable</option>
                          </select>
                          </div>
                          </div>
                          </div>
                          <div class="modal-footer">
                          <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                          <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                          </div>
                          <div class="btn-group" role="group">
                          <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                          </div>
                          </div>
                          </div>
                        </form>
                      </div>
                      </div>
                      </div>
                      </div>
                      <thead>
                        <tr>
                          <th><input class="checkboxcls" value="3" type="checkbox"></th>
                          <th>#</th>
                          <th>Policy Name</th>
                          <th style="width: 406px;">Policy Description</th>
                          <th>Status</th>
                          <th width="100">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- important notes -->
                        <?php $__currentLoopData = $imp_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr id="editimp_<?php echo e($pol->id); ?>">
                          <td><input class="checkboxcls" value="3" type="checkbox"></td>
                          <td class="center"><?php echo e(++$key); ?></td>
                          <td class="imp_notes"><?php echo e($pol->policy); ?></td>
                          <td class="imp_desc">
                            <input type="hidden" name="" value="<?php echo e($pol-> policy_desc); ?>">
                            <div class="wrap_small">
                            <div class="small_class">
                            <?php echo $pol-> policy_desc; ?>

                            </div>
                            <a href="" id="show_more">Show More</a>
                            </div>
                          </td>
                          <td class="imp_status center">
                            <?php if($pol->status == 1): ?>
                            <button class="btn btn-sm btn-success">Enabled</button>
                            <?php else: ?>
                            <button class="btn btn-sm btn-danger">Disabled</button>
                            <?php endif; ?>
                            <input  type="hidden" name="status" value="<?php echo e($pol->status); ?>">
                          </td>
                          <td>
                            <form action="<?php echo e(URL::to('/deleteimpnotes')); ?>" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                              <?php echo e(csrf_field()); ?>

                              <input type="hidden" name="id" value="<?php echo e($pol->id); ?>"/>
                              <a class="edit_impnotes" data-id="<?php echo e($pol->id); ?>" data-toggle="modal"  data-target="#editimpnotes" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                              <!--<a href="#" data-id="<?php echo e($pol->id); ?>" class="btn btn-danger deletePkgType"><i class="fa fa-times"></i></a>-->
                              <?php if(Sentinel::check()): ?>
                              <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                                  <button class="btn btn-sm btn-danger">Delete</button>
                              <?php endif; ?>
                              <?php endif; ?>
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

                  <!-- cancellation policies -->
                  <div class="tab-pane" id="tab2">
                  <div class="box">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table  class="table table-bordered table-striped example1">
                      <div class="add">
                      <?php if(Sentinel::check()): ?>
                      <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                        <button data-toggle="modal" data-target="#addCancelPolicy" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New CancellationPolicy</button>
                      <?php endif; ?>
                      <?php endif; ?>
                      <div class="modal fade" id="addCancelPolicy" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h3 class="modal-title" id="lineModalLabel">Add Policy</h3>
                        </div>
                        <div class="modal-body">
                          <!-- content goes here -->
                          <form action="<?php echo e(URL::to('/save-canPolicy')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row form-group">
                              <label class="col-md-3 control-label text-left"> Policy Name</label>
                              <div class="col-md-8">
                                <textarea class="form-control" name="policy" id="pkgPolicyName" cols="70" rows="1" required></textarea>
                              </div>
                            </div>
                            <div class="row form-group">
                              <label class="col-md-12 control-label text-left"> Policy Description</label>
                              <div class="col-md-11">
                                <textarea class="form-control ckeditor" name="policy_desc" id="pkgPolicyDesc" cols="50" rows="2" required></textarea>
                              </div>
                            </div>
                            <div class="row form-group">
                              <label class="col-md-3 control-label text-left">Status</label>
                              <div class="col-md-8">
                                <select name="status" class="form-control pkgTypeStatus" id="">
                                  <option value="1">Enable</option>
                                  <option value="0">Disable</option>
                                </select>
                              </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                </div>
                                <div class="btn-group" role="group">
                                  <button type="submit" id="savePackageTypes" class="btn btn-success" data-action="save" role="button">Add</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      </div>
                      <div class="modal fade editPkgCanPolicy" id="editCanPolicyModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title" id="lineModalLabel">Edit Package Type</h3>
                      </div>
                      <div class="modal-body">
                      <!-- content goes here -->
                      <form action="<?php echo e(URL::to('/save-canPolicy')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="" name="id" class="edittypeid"/>
                        <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Type Name</label>
                        <div class="col-md-8">
                        <textarea class="form-control pkgPolicyName" name="policy" id="pkgPolicyName" cols="70" rows="1" required></textarea>
                        </div>
                        </div>
                        <div class="row form-group">
                        <label class="col-md-12 control-label text-left"> Policy Description</label>
                        <div class="col-md-11">
                        <textarea class="form-control ckeditor" name="policy_desc" id="canPolicyDesc" cols="50" rows="2" required></textarea>
                        </div>
                        </div>
                        <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Status</label>
                        <div class="col-md-8">
                        <select name="status" class="form-control pkgPayPolicyStatus" id="">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>
                        <div class="btn-group" role="group">
                        <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                        </div>
                        </div>
                        </div>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>
                      <thead>
                        <tr>
                          <th><input class="checkboxcls" value="3" type="checkbox"></th>
                          <th>#</th>
                          <th>Policy</th>
                          <th style="width: 406px;">Policy Description</th>
                          <th>Status</th>
                          <th width="100">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $PkgCancelPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <tr id="edittype_<?php echo e($pol->id); ?>">
                        <td><input class="checkboxcls" value="3" type="checkbox"></td>
                        <td class="center"><?php echo e(++$key); ?></td>
                        <td class="canPolicy"><?php echo e($pol->policy); ?></td>
                        <td class="canPolicydesc">
                          <input type="hidden" name="" value="<?php echo e($pol->can_policy_desc); ?>">
                          <div class="wrap_small">
                          <div class="small_class">
                          <?php echo $pol->can_policy_desc; ?>

                          </div>
                          <a href="" id="show_more">Show More</a>
                          </div>
                        </td>
                        <td class="canPolicystatus center">
                          <?php if($pol->status == 1): ?>
                          <button class="btn btn-sm btn-success">Enabled</button>
                          <?php else: ?>
                          <button class="btn btn-sm btn-danger">Disabled</button>
                          <?php endif; ?>
                          <input  type="hidden" name="status" value="<?php echo e($pol->status); ?>">
                        </td>
                        <td>
                          <form action="<?php echo e(URL::to('/deletePkgcan')); ?>" onsubmit="return confirm('Do you really want to delete this.?');" id="deletePkgType<?php echo e($pol->id); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($pol->id); ?>"/>
                            <a class="edit_pkgCanPolicy" data-id="<?php echo e($pol->id); ?>" data-toggle="modal"  data-target="#editCanPolicyModal" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                            <!--<a href="#" data-id="<?php echo e($pol->id); ?>" class="btn btn-danger deletePkgType"><i class="fa fa-times"></i></a>-->
                            <?php if(Sentinel::check()): ?>
                            <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                            <button class="btn btn-sm btn-danger">Delete</button>
                            <?php endif; ?>
                            <?php endif; ?>
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

              <!-- traveller type -->
              <div class="tab-pane" id="tab5">
                <div class="box">
                  <div class="box-header"></div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table  class="table table-bordered table-striped example1">
                      <div class="add">
                      <?php if(Sentinel::check()): ?>
                      <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                        <button data-toggle="modal" data-target="#addTravellerType" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Traveller</button>
                      <?php endif; ?>
                      <?php endif; ?>
                      <div class="modal fade" id="addTravellerType" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Add Policy</h3>
                          </div>
                          <div class="modal-body">
                            <!-- content goes here -->
                            <form action="<?php echo e(URL::to('/save-traveller')); ?>" method="Post">
                              <?php echo e(csrf_field()); ?>

                              <div class="row form-group">
                                <label class="col-md-3 control-label text-left"> Policy Name</label>
                                <div class="col-md-8">
                                <input name="name" class="form-control pkgTypeName" placeholder="Name" value="" type="text">
                                </div>
                              </div>
                              <div class="row form-group">
                                <label class="col-md-3 control-label text-left">Status</label>
                                <div class="col-md-8">
                                <select name="status" class="form-control pkgTypeStatus" id="">
                                  <option value="1">Enable</option>
                                  <option value="0">Disable</option>
                                </select>
                                </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <button type="submit" id="savePackageTypes" class="btn btn-success" data-action="save" role="button">Add</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade editPkgTravellerType" id="editPkgTravellerTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                              <h3 class="modal-title" id="lineModalLabel">Edit Package Type</h3>
                            </div>
                            <div class="modal-body">
                              <!-- content goes here -->
                              <form action="<?php echo e(URL::to('/save-traveller')); ?>" method="Post">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="id" value="" class="edittypeid"/>
                                <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Type Name</label>
                                  <div class="col-md-8">
                                    <input name="name" class="form-control travellerTypeName" placeholder="Name" value="" type="text">
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <label class="col-md-3 control-label text-left">Status</label>
                                  <div class="col-md-8">
                                  <select name="status" class="form-control pkgTypeStatus" id="">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                  </select>
                                  </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                                  </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <thead>
                        <tr>
                          <th><input class="checkboxcls" value="3" type="checkbox"></th>
                          <th>#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th width="100">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $TravellerType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr id="edittype_<?php echo e($typ->id); ?>">
                          <td><input class="checkboxcls" value="3" type="checkbox"></td>
                          <td class="center"><?php echo e(++$key); ?></td>
                          <td class="travellername"><?php echo e($typ->name); ?></td>
                          <td class="travellerstatus center">
                            <?php if($typ->status == 1): ?>
                            <button class="btn btn-sm btn-success">Enabled</button>
                            <?php else: ?>
                            <button class="btn btn-sm btn-danger">Disabled</button>
                            <?php endif; ?>
                            <input  type="hidden" name="status" value="<?php echo e($typ->status); ?>">
                          </td>
                          <td>
                          <form action="<?php echo e(URL::to('/deletePkgType')); ?>" method="post" id="deletePkgType<?php echo e($typ->id); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($typ->id); ?>"/>
                            <a class="edit_pkgTravellerType" data-id="<?php echo e($typ->id); ?>" data-toggle="modal"  data-target="#editPkgTravellerTypeModal" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                            <?php if(Sentinel::check()): ?>
                            <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                              <a href="#" data-id="<?php echo e($typ->id); ?>" class="deletePkgType"><span class="btn btn-sm btn-danger">Delete</span></a>
                            <?php endif; ?>
                            <?php endif; ?>
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

              <!-- package category -->
              <div class="tab-pane" id="tab6">
                <div class="box">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                  <table  class="table table-bordered table-striped example1">
                    <div class="add">
                    <?php if(Sentinel::check()): ?>
                    <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                      <button data-toggle="modal" data-target="#addRatingType" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Package Category</button>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="modal fade" id="addRatingType" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h3 class="modal-title" id="lineModalLabel">Add Rating Type</h3>
                        </div>
                        <div class="modal-body">
                          <!-- content goes here -->
                          <form action="<?php echo e(URL::to('/save-rating')); ?>" method="Post">
                            <?php echo e(csrf_field()); ?>

                            <div class="row form-group">
                            <label class="col-md-3 control-label text-left"> Name</label>
                            <div class="col-md-8">
                              <input name="name" class="form-control pkgTypeName" placeholder="Name" value="" type="text">
                            </div>
                            </div>
                            <div class="row form-group">
                              <label class="col-md-3 control-label text-left">Status</label>
                              <div class="col-md-8">
                              <select name="status" class="form-control pkgTypeStatus" id="">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                              </select>
                              </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                              <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                              </div>
                              <div class="btn-group" role="group">
                                <button type="submit" id="savePackageTypes" class="btn btn-primary" data-action="save" role="button">Add</button>
                              </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade editPkgRatingType" id="editPkgRatingTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Edit Package Type</h3>
                          </div>
                          <div class="modal-body">
                            <!-- content goes here -->
                            <form action="<?php echo e(URL::to('/save-rating')); ?>" method="Post">
                              <?php echo e(csrf_field()); ?>

                              <input type="hidden" name="id" value="" class="edittypeid"/>
                              <div class="row form-group">
                                <label class="col-md-3 control-label text-left">Type Name</label>
                                <div class="col-md-8">
                                  <input name="name" class="form-control ratingTypeName" placeholder="Name" value="" type="text">
                                </div>
                              </div>
                              <div class="row form-group">
                                <label class="col-md-3 control-label text-left">Status</label>
                                <div class="col-md-8">
                                <select name="status" class="form-control pkgTypeStatus" id="">
                                  <option value="1">Enable</option>
                                  <option value="0">Disable</option>
                                </select>
                                </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                </div>
                                <div class="btn-group" role="group">
                                  <button type="submit" id="updatePkgTypes" class="btn btn-primary" data-action="save" role="button">Update</button>
                                </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <thead>
                      <tr>
                        <th><input class="checkboxcls" value="3" type="checkbox"></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $PkgRatingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <tr id="edittype_<?php echo e($typ->id); ?>">
                        <td><input class="checkboxcls" value="3" type="checkbox"></td>
                        <td class="center"><?php echo e(++$key); ?></td>
                        <td class="ratingname"><?php echo e($typ->name); ?></td>
                        <td class="ratingstatus center">
                          <?php if($typ->status == 1): ?>
                          <button class="btn btn-sm btn-success">Enabled</button>
                          <?php else: ?>
                          <button class="btn btn-sm btn-danger">Disabled</button>
                          <?php endif; ?>
                          <input  type="hidden" name="status" value="<?php echo e($typ->status); ?>">
                        </td>
                        <td>
                          <form action="<?php echo e(URL::to('/deletePkgType')); ?>" method="post" id="deletePkgType<?php echo e($typ->id); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($typ->id); ?>"/>
                            <a class="edit_pkgRatingType" data-id="<?php echo e($typ->id); ?>" data-toggle="modal"  data-target="#editPkgRatingTypeModal" href="#"><span class="btn btn-sm btn-warning">Edit</span></a>
                            <?php if(Sentinel::check()): ?>
                            <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')): ?>
                              <a href="#" data-id="<?php echo e($typ->id); ?>" class="deletePkgType"><span class="btn btn-sm btn-danger">Delete</span></a>
                            <?php endif; ?>
                            <?php endif; ?>
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
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>