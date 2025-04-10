		<!--Lead Button-->
		@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin') || Sentinel::getUser()->inRole('employee') )
		<div class="add">
			<a href="{{URL::to('/add_customer')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Lead</a>
		</div>
		@endif