var APP_URL = $('#baseurl').val();

function get_country_list(continent, callback)
{
$.ajax({
    url: APP_URL+'/get_continent_country',
    data: {continent_id:continent},
    type: 'get',
    success:function(response){
       if (callback) callback(response);
    },
    error:function(){
    	console.error("Error fetching countries:", error);
    }
})

}
function get_state_list(country_id, callback)
{

$.ajax({
    url: APP_URL+'/get_country_states',
    data: {country_id:country_id},
    type: 'get',
    success:function(response){
       if (callback) callback(response);
    },
    error:function(){
    	console.error("Error fetching states:", error);
    }
})

}

function get_city_list(state_id, callback)
{

$.ajax({
    url: APP_URL+'/get_cities_states',
    data: {state_id:state_id},
    type: 'get',
    success:function(response){
       if (callback) callback(response);
    },
    error:function(){
    	console.error("Error fetching states:", error);
    }
})

}

function append_country_list(countries, country_class, states_class, city_class)
{
var countrySelect =$("."+country_class)
    countrySelect.empty()
var stateSelect =$("."+states_class)
    stateSelect.empty()
var citySelect =$("."+city_class)
    citySelect.empty()

    if(countries.length>0)
    {
    countrySelect.append('<option value="">Select Country</option>');
    $.each(countries, function(index, country){
   countrySelect.append('<option value="' + country.id + '">' + country.name + '</option>');
    })

    }
    
}

function append_state_list(states, states_class, city_class)
{
var stateSelect =$("."+states_class)
    stateSelect.empty()
var citySelect =$("."+city_class)
    citySelect.empty()
    if(states.length>0)
    {
    stateSelect.append('<option value="">Select State</option>');
    $.each(states, function(index, state){
   stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
    })

    }
    
}

function append_city_list(cities, city_class)
{
var citySelect =$("."+city_class)
    citySelect.empty()
    if(cities.length>0)
    {
    citySelect.append('<option value="">Select City</option>');
    $.each(cities, function(index, city){
   citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
    })

    }
    
}



$(document).on("change",".continent", function(){
 var continent=$(this).val();
get_country_list(continent, function(countries) {
	append_country_list(countries, 'country', 'states', 'city')
});

})

$(document).on("change",".country", function(){
 var country_id=$(this).val();
get_state_list(country_id, function(states) {

	append_state_list(states, 'states', 'city')
});

})

$(document).on("change",".states", function(){
 var state_id=$(this).val();
get_city_list(state_id, function(cities) {

	append_city_list(cities, 'city')
});

})

//
function append_country_list_by_id(countries, country_id, states_id, city_id)
{
    console.log(country_id)
var countrySelect =$("#"+country_id)
    countrySelect.empty()
var stateSelect =$("#"+states_id)
    stateSelect.empty()
var citySelect =$("#"+city_id)
    citySelect.empty()

    if(countries.length>0)
    {
    countrySelect.append('<option value="">Select Country</option>');
    $.each(countries, function(index, country){
   countrySelect.append('<option value="' + country.id + '">' + country.name + '</option>');
    })

    }
    
}

function append_state_list_by_id(states, states_id, city_id)
{
var stateSelect =$("#"+states_id)
    stateSelect.empty()
var citySelect =$("#"+city_id)
    citySelect.empty()
    if(states.length>0)
    {
    stateSelect.append('<option value="">Select State</option>');
    $.each(states, function(index, state){
   stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
    })

    }
    
}
function append_city_list_by_id(cities, city_id)
{
var citySelect =$("#"+city_id)
    citySelect.empty()
    if(cities.length>0)
    {
    citySelect.append('<option value="">Select City</option>');
    $.each(cities, function(index, city){
   citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
    })

    }
    
}
$(document).on("change",".package_continent",function(){
  var continent=$(this).val();
  var row_id = $(this).attr("name").slice(10, 11);
  
get_country_list(continent, function(countries) {

    append_country_list_by_id(countries, 'package_dest_countries'+row_id, 'package_dest_state'+row_id, 'package_dest_city'+row_id)
    
});

})

$(document).on("change",".package_dest_country",function(){
  var country_id=$(this).val();
  var row_id = $(this).attr("name").slice(8, 9);
  
get_state_list(country_id, function(states) {

    append_state_list_by_id(states, 'package_dest_state'+row_id, 'package_dest_city'+row_id)
    
});

})

$(document).on("change",".package_dest_state",function(){
  var state_id=$(this).val();
  var row_id = $(this).attr("name").slice(6, 7);
  
get_city_list(state_id, function(cities) {

    append_city_list_by_id(cities, 'package_dest_city'+row_id)
    
});

})


