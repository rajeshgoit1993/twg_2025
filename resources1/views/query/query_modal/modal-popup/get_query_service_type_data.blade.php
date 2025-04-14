			<!--Assigned User-->
			<div class="form-group">
				<label for="assigned_user" class="detailsInput">Assigned User Name </label>
				<input type="text" class="lead-input-text fullWidth" id="assigned_user" name="assigned_user" placeholder="Assigned User" value="{{CustomHelpers::get_user_name($query->assign_id)}}" disabled/>
				<input type="hidden" name="query_id" value="{{$query->id}}">
			</div>

			<!--Services-->
			<div class="form-group">
				<label for="service_type" class="detailsInput">Services Included</label>
				<select class="lead-input-text fullWidth select2 service_type" multiple id="service_type_select2" name="service_type[]">
				   @foreach($datas as $services)
					<option value="{{$services->id}}" @if($service_s!='' && in_array($services->id,unserialize($service_s->services))) selected @endif>{{$services->field_name}}</option>
					@endforeach 
				</select>
			</div>

			<!--Service Details-->
			<div class="apndBtm5 service_type_data">
				@if($service_s!='') 
					<?php
						$services_status=unserialize($service_s->services_status);
					?>
					@foreach($services_status as $row=>$col)
						<?php 
							$service_type_data=DB::table('lead_dynamic_field')->where('id',$row)->first();
						?>
						<div class="service_category detailsInput collapsible" id="services_type_{{$service_type_data->id}}">{{$service_type_data->field_name}}</div>
						<div class="contents" id="services_type_content_{{$service_type_data->id}}">
							<div class="service_category_dtls">
								<!--Current Status-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="lead_current_status" class="detailsInput">Current Status</label>
									<div>
										<select class="lead-input-text fullWidth" id="lead_current_status" name="services_status[{{$service_type_data->id}}][status]">
											@foreach($data_s as $services)
												<option value="{{$services->id}}" @if($services->id==$col['status']) selected @endif>{{$services->field_name}}</option>
											@endforeach 
										</select>
									</div>
								</div>
								<!--Supplier Name-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="supplier_name" class="detailsInput">Supplier Name</label>
									<div>
										<select class="lead-input-text fullWidth select2" id="supplier_name" name="services_status[{{$service_type_data->id}}][supplier_name]">
											<option selected disabled>Select</option>
											@foreach($supplier as $suppliers)
												<option value="{{$suppliers->id}}" @if(array_key_exists('supplier_name',$col) && $suppliers->id==$col['supplier_name']) selected @endif select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<!--Supplier Reference No-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="supplier_reference_no" class="detailsInput">Reference No</label>
									<div>
										<input type="text" @if(array_key_exists('supplier_reference_no',$col)) value="{{$col['supplier_reference_no']}}" @endif  class="lead-input-text fullWidth" id="supplier_reference_no" name="services_status[{{$service_type_data->id}}][supplier_reference_no]" placeholder="Enter Supplier Reference No" />
									</div>
								</div>
								<!--Cancellation Deadline-->
								<div class="service_category_dtls_part form-group fullWidth">
									<label for="service_cancellation_deadline" class="detailsInput">Cancellation Deadline</label>
									<div class="makeflex">
										<input type="date" @if(array_key_exists('supplier_reference_no',$col)) value="{{$col['date']}}" @endif  name="services_status[{{$service_type_data->id}}][date]" class="lead-input-text fullWidth" id="service_cancellation_deadline"  style="border-radius: 4px 0px 0px 4px; border-right: none;" />
										<input type="time" @if(array_key_exists('supplier_reference_no',$col)) value="{{$col['time']}}" @endif   name="services_status[{{$service_type_data->id}}][time]" class="lead-input-text fullWidth" id="service_cancellation_deadline"  style="border-radius: 0px 4px 4px 0px;flex-basis: 70%;" />
									</div>
								</div>
							</div>
							<!--User Remarks-->
							<div class="form-group">
								<button type="button" id="btn_remarks" class="btn_add_remarks btn_remarks_service">
									@if(array_key_exists('user_remarks',$col) && $col['user_remarks']!='') 
										Hide Remarks(-)
										@else
										Add Remarks(+)
									@endif
								</button>
								<span class="add_remarks"></span>
								<span class="add_content" 
									@if(array_key_exists('user_remarks',$col) && $col['user_remarks']!='') style="display: block;"
										@else
											style="display: none;"
									@endif
									>
									<textarea class="lead-input-text-area fullWidth" type="text" name="services_status[{{$service_type_data->id}}][user_remarks]" style="" placeholder="Remarks">@if(array_key_exists('user_remarks',$col) && $col['user_remarks']!=''){{$col['user_remarks']}} @endif</textarea>
								</span>
							</div>
						</div>
	           		@endforeach
           		@endif
			</div>
			
			<!--Current Date & Time-->
			<div class="form-group">
				<label for="datetimestamp" class="detailsInput">Current Date & Time </label>
				<div class="makeflex">
					<!-- <input type="date" value="{{date('Y-m-d')}}" class="lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled/> -->
					<input type="text" class="lead-input-text disabled fullWidth date_display" style="border-radius: 4px 0px 0px 4px; border-right: none;" disabled />
					<!-- <input type="time" value="{{date('H:i')}}" class="current_time lead-input-text disabled fullWidth" id="datetimestamp" name="datetimestamp" style="border-radius: 0px 4px 4px 0px" disabled/> -->
					<input type="text" class="lead-input-text disabled fullWidth time_display" style="border-radius: 0px 4px 4px 0px" disabled />
					<input type="hidden" id="datetimestamp" name="datetimestamp" />
				</div>
			</div>

<script type="text/javascript">
// Get all elements with the class name "accordion (collapsible)"
//document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class name "accordion (collapsible)"
    var coll = document.getElementsByClassName("collapsible");

    // Iterate over each accordion element
    for (var i = 0; i < coll.length; i++) {
        // Add a click event listener to each accordion element
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class on the clicked accordion
            this.classList.toggle("active");

            // Get the next sibling element (the panel) of the clicked accordion
            var contents = this.nextElementSibling;

            // Check if the panel is currently open
            if (contents.style.maxHeight) {
                // If open, close it by setting maxHeight to null
                contents.style.maxHeight = null;
            } else {
                // If closed, open it by setting maxHeight to its scroll height
                contents.style.maxHeight = 'inherit';
            }
        });
    }
//});
</script>