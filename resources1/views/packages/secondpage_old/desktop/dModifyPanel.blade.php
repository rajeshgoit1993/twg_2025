
	<div class="mdfySrchCont" id="modify">
		<div class="container">
			<form action="{{URL::to('/packages_list')}}" method="post" autocomplete="off" id="search3" name="search3">
				<input type="hidden" name="_token"  value="{{ Session::token() }}"/>
				<div class="row d-flex-end">
					<div class="col-md-4 col-sm-3 mdfyBox">
						<label>Destination</label>
						<select class="select3 package_service" id="destination_search" required>
							<option value="{{$destination_search}}" selected>{{$destination_search}}</option>
						</select>
					</div>
					<div class="col-md-3 col-sm-3 mdfyBox">
						<!-- <label>Travel Month</label>
						<select class="select2">
							<option >All</option>
							<option>January</option>
							<option>February</option>
							<option>March</option>
							<option>April</option>
							<option>May</option>
							<option>June</option>
							<option>July</option>
							<option>August</option>
							<option>September</option>
							<option>October</option>
							<option>November</option>
							<option>December</option>
						</select> -->

						<label class="modifysearchBoxLabel">STARTING DATE</label>
					<input type="text" id="datepicker" name="datepicker" class="modifysearchContainer_inputBox" value="{{$date}}" style="padding:10px">


					</div>
					<div class="col-md-3 col-sm-3 mdfyBox">
						<label>Theme</label>
						<select id="select_theme" name="select_theme" class="select2">
							<?php  
  $search_theme=$destination_search;
    $getdata="";
    $data=DB::table('rt_packages')->where([['city', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->orwhere([['country', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->orwhere([['state', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->get();
    foreach($data as $data_theme):
        $data_value_theme=unserialize($data_theme->package_category);
        foreach($data_value_theme as $data_values ):
            $getdata.=$data_values.",";
        endforeach;
    endforeach;
    $theme_show="<option value=''>All</option>";
    $theme_front_data=explode(",",$getdata);
    $theme_front_data=array_unique($theme_front_data);
    foreach($theme_front_data as $theme_front ):
        if($theme_front):
        	if($theme_front==$theme_name)
        	{
$theme_show.="<option value='$theme_front' selected>".$theme_front."</option>";
        	}
        	else
        	{
        		$theme_show.="<option value='$theme_front'>".$theme_front."</option>";
        	}
            
        endif;
    endforeach;
    echo $theme_show;
    if($theme_show=="<option value=''>--Choose Theme--</option>"):
        $data=DB::table('rt_packages')->where([['continent', 'like','%' . $search_theme . '%'],['status', '=', '1'],])->get();
        $getdata="";
        foreach($data as $data_theme):
            $data_value_theme=unserialize($data_theme->package_category);
            $count=count($data_value_theme);
            for($i=0;$i<$count;$i++) {
                $getdata.=$data_value_theme[$i].",";
                }
        endforeach;
        $theme_show1="";
        $theme_front_data=explode(",",$getdata);
        $theme_front_data=array_unique($theme_front_data);
        foreach($theme_front_data as $theme_front ):
            if($theme_front):
               if($theme_front==$theme_name)
        	{
$theme_show.="<option value='$theme_front' selected>".$theme_front."</option>";
        	}
        	else
        	{
        		$theme_show.="<option value='$theme_front'>".$theme_front."</option>";
        	}
            endif;
        endforeach;
        echo $theme_show1;
    endif;


							?>
							
						</select>
					</div>
					<div class="col-md-2 col-sm-3">
						<button class="btnModfyWeb">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>