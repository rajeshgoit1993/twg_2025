<style type="text/css">
.item-container {
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;
	border-radius: 10px;
	padding: 30px;
	margin-bottom: 20px;
	display: -webkit-box;
	display: inline-block;
	width: 100%;
}
#cke_inclusions, #cke_exclusions{
	display: none;
}
</style>
		<div class="quoteDtlsCont">

			<!-- left section -->
			<div class="left-section">
			<form action="<?php echo e(URL::to('/save_quote')); ?>" method="post" id="quo1" name="quo1">
				<input type="hidden" name="type" value=""/>
				<input type="hidden" name="query_id" value="<?php echo e($data->id); ?>"/>
				<input type="hidden" name="action_type" value="<?php echo e($action_type); ?>"/> 
				<?php if($action_type == 'quote_edit'): ?>
				<input type="hidden" name="quote_id" value="<?php echo e($packagesData->id); ?>"/>
				<?php endif; ?>
				<?php echo e(csrf_field()); ?>


			

				<!--Trip Details-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trip Details <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<?php echo $__env->make('manage_packages.packages-blocks.package-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<!--Trip Guest Room-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-user-o" aria-hidden="true"></i> Guest Room <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
					    <div class="panelContent">
					    	<?php if($action_type=='quote'): ?>
					  <?php echo $__env->make('query.quotation.guest_room_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>      
					       <?php else: ?>
					  <?php echo $__env->make('query.quotation.guest_room_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    

					       <?php endif; ?>
					    </div> <!-- panelContent end -->
					</div> <!-- panelBox end -->
				</div>

				<!--Trip Pricing-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-money" aria-hidden="true"></i> Trip Pricing <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox mobScroll scrollX">
						<div class="panelContent">
                      <?php if($action_type=='quote'): ?>
					  <?php echo $__env->make('query.quotation.price_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>      
					       <?php else: ?>
					  <?php echo $__env->make('query.quotation.price_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    

					       <?php endif; ?>
							<!-- Price type selection section -->
					        

							
							
						</div>
					</div>
				</div>
				
				<!--Trip Accommodation-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-bed" aria-hidden="true"></i> Trip Accommodation <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">

							<?php echo $__env->make('manage_packages.packages-blocks.accommodation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

							
						</div>
					</div>
				</div>

				<!--Trip Flight-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-plane" aria-hidden="true"></i> Flight <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">

							<?php echo $__env->make('manage_packages.packages-blocks.flights', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

							
						</div>
					</div>
				</div>

				<!--Trip Transfers-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-bus" aria-hidden="true"></i> Transfers (Car, Bus, Train) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">

							<?php echo $__env->make('manage_packages.packages-blocks.transfers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

							
						</div>
					</div>
				</div>

				<!--Trip Overview-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-sticky-note-o" aria-hidden="true"></i> Trip Overview (Add-on Service & Highlights) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">

							<?php echo $__env->make('manage_packages.packages-blocks.description', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
							
						</div>
					</div>
				</div>

				<!--Trip Inclusions & Exclusions-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-plus-circle" aria-hidden="true"></i> Inclusions & Exclusions <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">

							 <?php echo $__env->make('manage_packages.packages-blocks.inclusions', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


							
						</div>
					</div>
				</div>

				<!--Trip Itinerary-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Trip Itinerary <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							 <?php echo $__env->make('manage_packages.packages-blocks.itinerary', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

							
						</div>
					</div>
				</div>

				<!--Trip Policy-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-info-circle" aria-hidden="true"></i> Trip Policies (Visa, Payment, Cancellation & Important Notes) <span class="requiredcolor">*</span></h4>
					</div>

					<div class="panelBox">
						<div class="panelContent">

							<?php echo $__env->make('manage_packages.packages-blocks.policies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

							
						</div>
					</div>
				</div>

				<!--Trip Quote Validity-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Quote Validity <span class="requiredcolor">*</span></h4>
					</div>
 <?php if($action_type=='quote'): ?>
					  <?php echo $__env->make('query.quotation.quote_validity_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>      
					       <?php else: ?>
					  <?php echo $__env->make('query.quotation.quote_validity_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    

					       <?php endif; ?>

					


				</div>

				<!--Greetings & Signature-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
					<i class="fa fa-user" aria-hidden="true"></i> Greetings & Signature <span class="requiredcolor">*</span>
					</div>

					 <?php if($action_type=='quote'): ?>
					  <?php echo $__env->make('query.quotation.quote_signatire_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>      
					       <?php else: ?>
					  <?php echo $__env->make('query.quotation.quote_signatire_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    

					       <?php endif; ?>


				</div>
				
				<!-- save or send quote -->
				<div class="col-md-12">
					<div class="saveOptions">
						<!-- select save quote -->
						<div class="savePreview">
							<label class="radio-inline">
							<input type="radio" value="1" name="send_option" checked>Save & Preview</label>
						</div>

						<!-- select send quote -->
						<div class="saveSend" style="display: none;">
							<label class="radio-inline">
							<input type="radio" value="0" name="send_option">Save & Send</label>
						</div>
					</div>
				</div>

				<!-- continue -->
				<div class="col-md-12">
					<div class="saveQuote">
						<button type="submit" name="add" id="remove" class="btnblue btnQuoteSave">Continue</button>
					</div>
				</div>
			</form>
			</div>

			<!-- right section -->
			<div class="right-section sidebar">
				<!--Enquiry Details-->
				<div class="panel-item-cont">
					<div class="panelHeading">
						<i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details <span class="requiredcolor">*</span>
					</div>
					<div class="panelBox" style="display: block; max-height: inherit;">
						<div class="panelContent">
							<!-- lead details -->
							<?php echo $__env->make('query.enquiryDetails.leadDetails', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>							
						</div>
					</div>
				</div>
			</div>
		</div>