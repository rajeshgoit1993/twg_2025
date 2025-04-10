<?php $__env->startSection("custom_css_code"); ?>

<style>
.supplier-item-container {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  border: 1px solid #e9e9e9;
  border-radius: 10px;
  padding: 30px;
  margin-bottom: 20px;
  display: block;
  margin-top: 10px;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box">
               <div class="box-header">
                  <h3 class="box-title">Add New Supplier</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <a href="<?php echo e(URL::to('/Supplier')); ?>" class="btn btn-success">
                     <i class="glyphicon glyphicon-arrow-left"> </i> Back
                  </a>

                  <div class="supplier-item-container">
                     <form action="<?php echo e(URL::to('/savesupplierprofile')); ?>" method="Post" id="supplierform" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="alert alert-success fontWeight600" id="success-contaier" style="display: none">
                           <p>Thank You! Your request has been submitted successfully. Our team will check and activate the account.</p>
                        </div>

                        <div class="row">
                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="suppliercompanyname">Company Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliercompanyname" name="suppliercompanyname" placeholder="Enter company name" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercompanytype">Company Type <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="suppliercompanytype" name="suppliercompanytype" required>
                           <option value="" selected disabled>Select</option>
                           <option value="Sole Proprietorship">Sole Proprietorship</option>
                           <option value="Partnership">Partnership</option>
                           <option value="LLP">LLP</option>
                           <option value="Private Limited">Private Limited</option>
                           <option value="Public Limited">Public Limited</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="supplieraddress">Registered Address <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplieraddress" name="supplieraddress" placeholder="Enter registered address" required>
                           <!--<textarea class="form-control" name="supplieraddress" placeholder="Registered Address"></textarea>-->
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercountry">Country <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="suppliercountry" onchange="get_states(this)" name="suppliercountry" required>
                           <option value="" selected disabled>Select</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                              <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>" ><?php echo e($cont->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>   
                           </select>
                           </div>
                           </div>
                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierstate">State <span class="requiredcolor">*</span></label>
                           <select class="form-control st_values" id="supplierstate" name="supplierstate" onchange="getcitys(this)" required>
                           <option value="" selected disabled>Select</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercity">City <span class="requiredcolor">*</span></label>
                           <select class="form-control ct_values" id="suppliercity" name="suppliercity" required>
                           <option value="" selected disabled>Select</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpincode">Pin Code <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="supplierpincode" name="supplierpincode" placeholder="Enter pin code" required>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierservicetype">Services Provided <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="supplierservicetype" name="supplierservicetype" required>
                           <option selected disabled>Select Services</option>
                           <option value="flight">Flight</option>
                           <option value="accommodation">Hotel</option>
                           <option value="home">Homes</option>
                           <option value="visa">Visa</option>
                           <option value="bus">Bus</option>
                           <option value="train">Train</option>
                           <option value="forex">Forex</option>
                           <option value="cruise">Cruise</option>
                           <option value="carrental">Car Rental</option>
                           <option value="tours">Sightseeing</option>
                           <option value="travelinsurance">Travel Insurance</option>
                           <option value="miscellaneous">Miscellaneous</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-3">
                           <div class="form-group">
                           <label for="suppliercurrency">Default Currency</label>
                           <select class="form-control" id="suppliercurrency" name="suppliercurrency" required>
                           <option selected disabled>Select Currency</option>
                           <option value=""></option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-3">
                           <div class="form-group">
                           <label for="supplieremployees">No of Employees</label>
                           <select class="form-control" id="supplieremployees" name="supplieremployees">
                           <option selected disabled>Select Employees</option>
                           <?php for($i=1;$i<=20;$i++): ?>
                           <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                           <?php endfor; ?>
                           <option value="20+">20+</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercontactperson">Contact Person <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliercontactperson" name="suppliercontactperson" placeholder="Enter contact person name" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierprimaryemail">Primary Email ID <span class="requiredcolor">*</span></label>
                           <input type="email" class="form-control textLowercase" id="supplierprimaryemail" name="supplierprimaryemail" placeholder="Enter primary email id" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliersecondaryemail">Secondary Email ID</label>
                           <input type="email" class="form-control textLowercase" id="suppliersecondaryemail" name="suppliersecondaryemail" placeholder="Enter secondary email id">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliermobile">Mobile No <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="suppliermobile" name="suppliermobile" placeholder="Enter mobile number" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieralternatemobile">Alternate Mobile No</label>
                           <input type="text" class="form-control" id="supplieralternatemobile" name="supplieralternatemobile" placeholder="Enter alternate mobile number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierofficenumber">Office Landline No</label>
                           <input type="text" class="form-control" id="supplierofficenumber" name="supplierofficenumber" placeholder="Enter office landline number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierwebsite">Website Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textLowercase" id="supplierwebsite" name="supplierwebsite" placeholder="Enter website name">
                           </div>
                           </div>
                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraccountscontactnumber">Accounts Contact Number</label>
                           <input type="text" class="form-control" id="supplieraccountscontactnumber" name="supplieraccountscontactnumber" placeholder="Enter accounts contact number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraccountsemail">Accounts Email ID</label>
                           <input type="email" class="form-control textLowercase" id="supplieraccountsemail" name="supplieraccountsemail" placeholder="Enter accounts email id">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>GST Details</h4>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstnumber">GST Number<span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUppercase" id="suppliergstnumber" name="suppliergstnumber" placeholder="Enter GST number" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstname">GST Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliergstname" name="suppliergstname" placeholder="Enter GST name" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstemail">GST Email <span class="requiredcolor">*</span></label>
                           <input type="email" class="form-control textLowercase" id="suppliergstemail" name="suppliergstemail" placeholder="Enter GST email id" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppleiergstcontact">GST Contact Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="suppleiergstcontact" name="suppleiergstcontact" placeholder="Enter GST contact number" required>
                           </div>
                           </div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="suppliergstaddress">GST Address <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliergstaddress" name="suppliergstaddress" placeholder="Enter GST address" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpannumber">PAN Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUppercase" id="supplierpannumber" name="supplierpannumber" placeholder="Enter pan number" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpanname">PAN Card Name<span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierpanname" name="supplierpanname" placeholder="Enter name on the PAN Card" required>
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>Bank Account Details</h4>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankname">Bank Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankname" name="supplierbankname" placeholder="Enter bank name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaddress">Bank Address</label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankaddress" name="supplierbankaddress" placeholder="Enter bank address">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaccountname">Account Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankaccountname" name="supplierbankaccountname" placeholder="Enter bank account name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaccountnumber">Account Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="supplierbankaccountnumber" name="supplierbankaccountnumber" placeholder="Enter bank account number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankifsccode">IFSC Code <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUppercase" id="supplierbankifsccode" name="supplierbankifsccode" placeholder="Enter ifsc code">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierupiid">UPI ID</label>
                           <input type="text" class="form-control textLowercase" id="supplierupiid" name="supplierupiid" placeholder="Enter upi id">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankcountry">Country <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankcountry" name="supplierbankcountry" placeholder="Enter country name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierswiftcode">SWIFT Code</label>
                           <input type="text" class="form-control" id="supplierswiftcode" name="supplierswiftcode" placeholder="Enter swift Code">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliersorttcode">SORT Code</label>
                           <input type="text" class="form-control" id="suppliersorttcode" name="suppliersorttcode" placeholder="Sort code for U.K.">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbsbcode">BSB Code</label>
                           <input type="text" class="form-control" id="supplierbsbcode" name="supplierbsbcode" placeholder="BSB code for Australia">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieribancode">IBAN Code</label>
                           <input type="text" class="form-control" id="supplieribancode" name="supplieribancode" placeholder="IBAN code for UK,Europe,UAE,Saudi Arabia,Bahrain">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankroutingnumber">Routing Number</label>
                           <input type="text" class="form-control" id="supplierbankroutingnumber" name="supplierbankroutingnumber" placeholder="Enter routing number">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <label for="supplierotherinfo">Additional Information</label>
                           <input type="text" class="form-control textCapitalize" id="supplierotherinfo" name="supplierotherinfo" placeholder="Any other additional information">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>Upload Documents</h4>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpancard">Upload PAN Card <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierpancard" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstcertificate">Upload GST Certificate <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliergstcertificate" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieridproof">Upload ID Proof <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplieridproof" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>
                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraddressproof">Upload Address Proof <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplieraddressproof" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierregistrationproof">Upload Registration Proof &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierregistrationproof" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercompanylogo">Upload Company Logo (Jpeg, Png) &ensp;<span class="color9B">(size < 3 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliercompanylogo" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierfirstadditionalname">Additional Document-I</label>
                           <input type="text" class="form-control textCapitalize" id="supplierfirstadditionalname" name="supplierfirstadditionalname" placeholder="Enter name of the document">
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierfirstadditionaldocument">Upload Document-I &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierfirstadditionaldocument" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="suppliersecondadditionalname">Additional Document-II</label>
                           <input type="text" class="form-control textCapitalize" id="suppliersecondadditionalname" name="suppliersecondadditionalname" placeholder="Enter name of the document">
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="suppliersecondadditionaldocument">Upload Document-II &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliersecondadditionaldocument" onchange="Filevalidation()" />
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierstatus">Status <span class="requiredcolor">*</span></label>
                           <select class="form-control" name="supplierstatus" id="supplierstatus" required>
                           <option value="" selected disabled>Select</option>
                           <option value="enabled">Enabled</option>
                           <option value="disabled">Disabled</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-12">
                              <div class="form-group text-center">
                                 <button type="submit" name="submit" id="form_submit" class="btn btn-primary location_add">Save</button>
                              </div>
                           </div>

                        </div>
                     </form>
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code_second"); ?>

<!-- <script type="text/javascript">
Filevalidation = () => {
   const fi = document.getElementById('file');
   // Check if any file is selected.
   if (fi.files.length > 0) {
      for (const i = 0; i <= fi.files.length - 1; i++) {
         const fsize = fi.files.item(i).size;
         const file = Math.round((fsize / 1024));
         // The size of the file.
         if (file >= 2048) {
         alert(
         "File too Big, please select a file less than 2mb");
         } else if (file < 100) {
         alert(
         "File too small, please select a file greater than 100kb");
         } else {
         document.getElementById('size').innerHTML = '<b>'
         + file + '</b> KB';
         }
      }
   }
}
</script> -->

<script>
$(document).ready(function () {
   // File validation function to check file size
   function Filevalidation() {
      const fi = document.getElementById('file');

      // Check if any file is selected
      if (fi && fi.files.length > 0) {
         for (let i = 0; i < fi.files.length; i++) {
            const fsize = fi.files[i].size;  // File size in bytes
            const fileSizeInKB = Math.round(fsize / 1024);  // Convert size to KB

            // Validate file size range
            if (fileSizeInKB >= 2048) {
               alert("File too big, please select a file less than 2MB.");
               return false;  // Prevent form submission
            } else if (fileSizeInKB < 100) {
               alert("File too small, please select a file greater than 100KB.");
               return false;  // Prevent form submission
            } else {
               $('#size').html('<b>' + fileSizeInKB + '</b> KB');
            }
         }
      }
      return true;  // Allow form submission if file size is valid
   }

   // Attach Filevalidation function to the form's submit event
   $('form#supplierform').on('submit', function (e) {
      if (!Filevalidation()) {
         e.preventDefault();  // Stop form submission if validation fails
      }
   });
});
</script>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>