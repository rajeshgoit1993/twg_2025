<form id="packages_dest" action="{{ route('productList') }}" method="post">
	<input type="hidden" name="_token" id="csrfField" value="{{ Session::token() }}"/>
	<input type="hidden"  id="destination_search2" value="" name="destination_search" />
</form>

<div class="testing">
	<input type="hidden" value="{{ url('/') }}" name="" id="testvalue_footer">
</div>

<?php
    // Import necessary classes
    use App\Packages;
    use Illuminate\Support\Facades\DB;

    // Initialize variables
    $packages_footer = Packages::all()->where('status', '1');
    $getdata = "";
    $india_city = "";
    $out_india_city = "";

    // Iterate over packages_footer to get package categories
    foreach ($packages_footer as $packages_footer_data):
        // Ensure it's unserialized correctly
        $data_value_theme = @unserialize($packages_footer_data->package_category);

        // If unserialization fails or it's not an array, default to an empty array
        if ($data_value_theme === false || !is_array($data_value_theme)) {
            $data_value_theme = [];
        }

        // Count items safely
        $count = count($data_value_theme);

        // Loop through each category and append to $getdata
        for ($i = 0; $i < $count; $i++) {
            $getdata .= $data_value_theme[$i] . ",";
        }
    endforeach;

    // Split the getdata string and remove duplicate entries
    $theme_front_data = explode(",", $getdata);
    $theme_front_data = array_unique($theme_front_data);

    // Fetch data related to India packages
    $data_india = DB::table('rt_packages')
                    ->where([['country', 'like', '%101%'], ['status', '=', '1']])
                    ->get();

    // Iterate over India package data to extract city information
    foreach ($data_india as $data_india_city):
        // Unserialize state data
        $data_india_city_pkg = unserialize($data_india_city->state);
        $count = count($data_india_city_pkg);

        // Loop through each city and append to $india_city
        foreach ($data_india_city_pkg as $row => $col) {
            $india_city .= CustomHelpers::get_master_table_data('states', 'id', (int)$data_india_city_pkg[$row], 'name'). ",";
        }
    endforeach;

    // Split the india_city string and remove duplicate entries
    $india_city_font_data = explode(",", $india_city);
    $india_city_font = array_unique($india_city_font_data);

    // Fetch data related to non-India packages
    $data_out_india = DB::table('rt_packages')
                        ->where([['country', 'NOT LIKE', '%101%'], ['status', '=', '1']])
                        ->get();

    // Iterate over non-India package data to extract city information
    foreach ($data_out_india as $data_out_india_city):
        // Unserialize country data
        $data_out_india_city_pkg = unserialize($data_out_india_city->country);
        $count = count($data_out_india_city_pkg);

        // Loop through each city and append to $out_india_city
        for ($i = 0; $i < $count; $i++) {
            $out_india_city .= CustomHelpers::get_master_table_data('countries', 'id', (int)$data_out_india_city_pkg[$row], 'name'). ",";
        }
    endforeach;

    // Split the out_india_city string and remove duplicate entries
    $out_india_city_font_data = explode(",", $out_india_city);
    $out_india_city_font = array_unique($out_india_city_font_data);
?>


<footer>
	@include('layouts.front.footer.desktopFooter')
</footer>