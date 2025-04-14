<?php  
$val=$data->field_type;
?>
<input type="hidden" name="id" value="{{$data->id}}">
<input type="hidden" name="field_type" value="{{$val}}">
				<div class="form-group">
					<label for="sortname">@if($val==1)
							Lead Cancelled Reasons
							@elseif($val==2)
							Add Lead Follow-up
							@elseif($val==3)
							Booking Status
							@elseif($val==4)
							Lead Payment Status
							@elseif($val==5)
							Payment Method
							@elseif($val==6)
							Service Type
							@elseif($val==7)
							Service Status
							@elseif($val==8)
							Booking Label
							@endif</label>
					<input type="text"  value="{{$data->field_name}}"  name="field_name"class="form-control" 
             @if($val==1)
							placeholder="Lead Cancelled Reasons"
							@elseif($val==2)
							placeholder="Add Lead Follow-up"
							@elseif($val==3)
							placeholder="Booking Status"
							@elseif($val==4)
							placeholder="Lead Payment Status"
							@elseif($val==5)
							placeholder="Payment Method"
							@elseif($val==6)
							placeholder="Service Type"
							@elseif($val==7)
							placeholder="Service Status"
							@elseif($val==8)
							placeholder="Booking Label"
							@endif

		   required>
				</div>
				<div class="form-group">
					<label for="country">Status</label>
					<select name="status" class="form-control">	
						<option value="1" @if($data->status==1) selected @endif>Enable</option>
						<option value="0" @if($data->status==0) selected @endif>Disable</option>
					</select>
				</div>
			
				<button type="submit" class="btn btn-success">Update</button>