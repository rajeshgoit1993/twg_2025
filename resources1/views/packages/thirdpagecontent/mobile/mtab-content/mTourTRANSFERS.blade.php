<div class="tab-pane fade mTourPkgDesc" id="mTourTRANSFERS">

	@if($details->transfers!='')
	<div class="tab-pane fade in active tourHgLhts">
		<div class="tourQuoteTransferCont">
		<div>
			<h3 class="tourQuoteTransferHead">TRANSFERS</h3>
		</div>
		<?php 
		$transfers=unserialize($details->transfers); 
      
		?>
		<?php $a=0; ?>
		@foreach($transfers as $row=>$col)
		@if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col))
		<?php
		 $transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first(); 
       
		?>	
		<div class="tourQuoteTransferBox">
			<div class="tourQuoteTransferTitle">{{$col['mode_title']}}</div>
			<div class="tourQuoteTransferDescBox">
				<div class="makeflex">
					<!--Vehicle Image-->
					<div class="transferImageBox">
						@if($transfers_data!='' && $transfers_data->transfer_image!='')
						<img class="transferImageType" src="{{ url('/public/uploads/transfer_image/'.$transfers_data->transfer_image) }}">	
						@endif				
					</div>
					<div>
						<!--Private, Shared or Coach-->
						<div class="transferDescTopSection">
							<h4 class="transferTitle">{{$col['mode_title']}}</h4>
							<h2 class="transportType">@if($transfers_data!='' && $transfers_data->transfer_type!='') {{$transfers_data->transfer_type}} @endif	</h2>
						</div>
						<!--Vehicle Type,Duration & Inclusion-->
						<div class="flexCenter">
							<div class="transferVehicleCont">
								<h4 class="transferHead">VEHICLE TYPE</h4>
								<h5 class="transferSubHead"> @if($transfers_data!='' && $transfers_data->vehicle_type!='') {{$transfers_data->vehicle_type}} @endif</h5>
							</div>
							<div class="transferDurationCont">
								<h4 class="transferHead">DURATION</h4>
								<h5 class="transferSubHead">@if($transfers_data!='' && $transfers_data->duration!='') {{$transfers_data->duration}} @endif</h5>
							</div>
							<div>
								<h4 class="transferHead">INCLUDES</h4>
								<h5 class="transferSubHead">@if($transfers_data!='' && $transfers_data->includes!='') {{$transfers_data->includes}} @endif</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $a++; ?>
		@endif
		@endforeach
	</div>
	</div>
	@endif
</div>