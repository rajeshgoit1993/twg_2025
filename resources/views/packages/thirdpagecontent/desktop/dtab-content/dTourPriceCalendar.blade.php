<!--calender start-->

<div class="tab-pane fade tourPkgDesc" id="dTourPriceCalendar">
	<div class="tab-pane fade in active tourHgLhts">
		<div class="tourDesc">
			<h2>Pricing Calender</h2>
		</div>
		<div class="row">
		<div class="col-md-12 mWhiteBG pdngUD10 appendBtm10">
			<div class="col-md-8 col-sm-7 col-xs-6"></div>
			<div class="col-md-4 col-sm-5 col-xs-6 dCaldrPref">
				<label>Preference</label>

@if($new_price!='na')
<?php  
$overall_package_rating_without_date=$new_price['overall_package_rating_without_date'];
$package_rating=$new_price['package_rating'];

?>
<input type="hidden" value="" id="hidden_value">
<input type="hidden" value="{{ $id }}" id="package_value">
<input type="hidden" value="upcoming" name="" class="pkg_type">


<select id="package_type">
@foreach($overall_package_rating_without_date as $row=>$col)
@if(array_key_exists($col,$new_price['overall_package_rating_with_date']))
<?php 
$rate=DB::table('rt_pkg_rating_type')->where('id',$col)->first();
 $start_d=date("Y-m-d",$new_price['overall_package_rating_with_date'][$col]);
?>
<option value="{{ $col }}" pkg_date="{{$start_d}}" @if($col==$package_rating) selected @endif>
							{{$rate->name}}
							</option>
@endif


@endforeach
</select>



@endif






				
			</div>
		</div>
		<div class="col-md-12">
			<div id="calendar_parrent">
				<div id="calendar"></div>
			</div>
		</div>
		</div>
	</div>
</div>
<!--calender end-->