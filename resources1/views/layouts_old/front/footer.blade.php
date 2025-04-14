<form id="packages_dest" action="{{ URL::to('/packages_list') }}" method="post">
  <input type="hidden" name="_token" id="csrfField" value="{{ Session::token() }}"/>
  <input type="hidden"  id="destination_search2" value="" name="destination_search" />
</form>
<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="testvalue_footer">
</div>

<?php
	use App\Packages;
	use Illuminate\Support\Facades\DB;
	$packages_footer = Packages::all()->where('status','1');
	$getdata="";
	$india_city="";
	$out_india_city="";
	foreach($packages_footer as $packages_footer_data):
	$data_value_theme=unserialize($packages_footer_data->package_category);
	$count=count($data_value_theme);
		for($i=0;$i<$count;$i++) {
			$getdata.=$data_value_theme[$i].",";
			}
		endforeach;
	$theme_front_data=explode(",",$getdata);
	$theme_front_data=array_unique($theme_front_data);
	$data_india=DB::table('rt_packages')->where([['country', 'like','%India%'],['status', '=', '1'],])->get();
	foreach($data_india as $data_india_city):
		$data_india_city_pkg=unserialize($data_india_city->state);
		$count=count($data_india_city_pkg);
		for($i=0;$i<$count;$i++) {
			$india_city.=$data_india_city_pkg[$i].",";
			}
	endforeach;
	$india_city_font_data=explode(",",$india_city);
	$india_city_font=array_unique($india_city_font_data);
	$data_out_india=DB::table('rt_packages')->where([['country', 'NOT LIKE','%India%'],['status', '=', '1'],])->get();
	foreach($data_out_india as $data_out_india_city):
		$data_out_india_city_pkg=unserialize($data_out_india_city->country);
		$count=count($data_out_india_city_pkg);
		for($i=0;$i<$count;$i++) {
			$out_india_city.=$data_out_india_city_pkg[$i].",";
			}
			endforeach;
			$out_india_city_font_data=explode(",",$out_india_city);
			$out_india_city_font=array_unique($out_india_city_font_data);
?>
<footer>
<div class="destop_test_exp">
@include('layouts.front.footer.desktopFooter')
</div>

<div class="mobile_test_exp">
@include('layouts.front.footer.mobileFooter')
</div>
</footer>