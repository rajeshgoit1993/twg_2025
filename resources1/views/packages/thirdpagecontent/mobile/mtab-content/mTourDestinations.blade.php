<div class="tab-pane fade mTourPkgDesc" id="mTourDestinations">
	<div class="tab-pane fade in active mTourHgLhts">
		<h2>Tour Destination</h2>
		<div>
		<?php
			$destinations=$details->destinations;
		if($destinations!='' && $destinations!='N;')
		{
        $city1=unserialize($details->destinations);
		$city_data=array_unique($city1);
		}
		else
		{
		$city1=unserialize($details->city);
		$city_data=array_unique($city1);	
		}
			
		?>
		<div class="fancy-collapse-panel">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			@foreach($city_data as $data)
			@if(CustomHelpers::get_destination_data($data,'status')=="1")
			<?php
				$best_time=CustomHelpers::get_destination_data($data,'best_time_desc');
				$overview=CustomHelpers::get_destination_data($data,'overview');
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingThree_mob">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#mob{{str_slug($data, '-')}}" aria-expanded="false" aria-controls="collapseThree"><span class="glyphicon glyphicon-map-marker" style="color: #da2128"></span> {{$data}} , {{CustomHelpers::get_destination_data($data,'country')}}
					</a>
					</h4>
				</div>
				<div id="mob{{str_slug($data, '-')}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_mob">
					<div class="panel-body">
						@if($overview!="")
						<h3>About City</h3>
						<p>{!! $overview !!}</p>
						@endif
						@if($best_time!="")
						<h3>Best Time To Visit</h3>
						<p>{!! $best_time !!}</p>
						@endif
					</div>
				</div>
			</div>
			@endif
			@endforeach
			</div>
		</div>
		</div>
	</div>
</div>