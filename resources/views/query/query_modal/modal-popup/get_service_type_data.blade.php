				<div class="service_category detailsInput collapsible" id="services_type_{{$service_type_data->id}}">{{$service_type_data->field_name}}</div>
				<div class="contents" id="services_type_content_{{$service_type_data->id}}">
					<div class="service_category_dtls">
					<!--Current Status-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="lead_current_status" class="detailsInput">Current Status</label>
						<div>
							<select class="lead-input-text fullWidth" id="lead_current_status" name="services_status[{{$service_type_data->id}}][status]">
								@foreach($datas as $services)
									<option value="{{$services->id}}">{{$services->field_name}}</option>
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
									<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<!--Supplier Reference No-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="supplier_reference_no" class="detailsInput">Reference No</label>
						<div>
							<input type="text" class="lead-input-text fullWidth" id="supplier_reference_no" name="services_status[{{$service_type_data->id}}][supplier_reference_no]" placeholder="Enter Supplier Reference No" />
						</div>
					</div>

					<!--Cancellation Deadline-->
					<div class="service_category_dtls_part form-group fullWidth">
						<label for="service_cancellation_deadline" class="detailsInput">Cancellation Deadline</label>
						<div class="makeflex">
							<input type="date" name="services_status[{{$service_type_data->id}}][date]" class="lead-input-text fullWidth" id="service_cancellation_deadline" style="border-radius: 4px 0px 0px 4px; border-right: none;" />
							<input type="time" name="services_status[{{$service_type_data->id}}][time]" class="lead-input-text fullWidth" id="service_cancellation_deadline" style="border-radius: 0px 4px 4px 0px;flex-basis: 70%;" />
						</div>
					</div>
				</div>
				
				<!--User Remarks-->
				<div class="form-group">
					<button type="button" id="btn_remarks" class="btn_add_remarks btn_remarks_service">Add Remarks(+)</button>
					<span class="add_remarks"></span>
					<span class="add_content" style="display: none;">
						<textarea class="lead-input-text-area fullWidth" type="text" name="services_status[{{$service_type_data->id}}][user_remarks]" style="" placeholder="Remarks"></textarea>
					</span>
				</div>
				</div>