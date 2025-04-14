$(document).on("change",".propertysource",function() {
    var propertysource = $(this).val();
    var propertyname = $(this).parent().siblings(".propertyname");
    var selectproperty = $(this).parent().siblings(".selectproperty");
    if(propertysource=='manual') {
        $(this).parent().siblings(".selectpropertystar").css('display','none')
        $(this).parent().siblings(".selectproperty").css('display','none')
        $(this).parent().siblings(".propertyname").css('display','block')
        $(this).parent().siblings(".selectpropertynamestar").css('display','block')
    } else if(propertysource=='packagehoteldatabase') {
        var city_name =$(this).parent().siblings(".quote_city_class").children(".quote_city").val()
        var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
        var hotel_class = $(this).parent().siblings().children(".quote_hotel")
        if(propertysource=='packagehoteldatabase') {
            fetch_hotel_name(city_name,propertytype,hotel_class)
        }
        
        $(this).parent().siblings(".selectpropertystar").css('display','block')
        $(this).parent().siblings(".selectproperty").css('display','block')
        $(this).parent().siblings(".propertyname").css('display','none')
        $(this).parent().siblings(".selectpropertynamestar").css('display','none')
    } else {
        
        $(this).parent().siblings(".selectpropertystar").css('display','none')
        $(this).parent().siblings(".selectproperty").css('display','none')
        $(this).parent().siblings(".propertyname").css('display','none')
        $(this).parent().siblings(".selectpropertynamestar").css('display','none')
    }
});

//
$(document).on("change",".propertytype",function() {
    var city_name =$(this).parent().parent().siblings(".quote_city_class").children(".quote_city").val()
    var propertytype= $(this).val()
    var hotel_class = $(this).parent().parent().siblings().children(".quote_hotel")
    var propertysource= $(this).parent().parent().siblings(".propertysource_class").children(".propertysource").val()
    if(propertysource=='packagehoteldatabase') {
        fetch_hotel_name(city_name,propertytype,hotel_class)
    }
});

//
$(document).ready(function() {
    $('.quote_city').select2({
        placeholder: "To",
        allowClear: true,
        ajax:{
        url: $("#APP_URL").val()+'/search_quote_destination',
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term // search term
            };
        },
        processResults: function (response) {
            return {
                results: response
            };
        },
        cache: true
        }
    });
    $(document).on('change', '.quote_city', function () {
        var city_name = $(this).val()
        var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
        var hotel_class = $(this).parent().siblings().children(".quote_hotel")
        var propertysource= $(this).parent().siblings(".propertysource_class").children(".propertysource").val()
        if(propertysource=='packagehoteldatabase') {
            fetch_hotel_name(city_name,propertytype,hotel_class)
        }
    });
});

//
function fetch_hotel_name(city_name,propertytype,hotel_class) {
    $.ajax({
        type: 'POST',
        data: { city_name: city_name,propertytype:propertytype},
        url: APP_URL + "/quote_hotel_name",
        success: function (data) {
            hotel_class.html("").html("<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>" + data)
        },
        error: function (data) {
        }
    });
}

//
$(document).on("change",".quote_hotel",function() {
    var hotel_id=$(this).val()
    var button=$(this)
    $.ajax({
        type: 'POST',
        data: { hotel_id: hotel_id},
        url: APP_URL + "/quote_hotel_data",
        success: function (data) {
            button.parent().siblings(".hotel_link_class").children(".hotel_link").val("").val(data.link)
            button.parent().siblings(".hotel_contact_class").children(".hotel_contact").val("").val(data.propertymobile)
            button.parent().siblings(".selectpropertystar").children(".selectpropertystar_value").html("").html("<option  selected='true'>"+data.star_rating+" Star</option>")
            console.log(data)
        },
        error: function (data) {
        }
    });
});

//
$(document).on("keyup",".package_name",function() {
    var package_name=$(this).val()
    $.ajax({
        type: 'get',
        data: { package_name: package_name},
        url: APP_URL + "/check_package_availibility",
        success: function (data) {
        $(".package_availibility").html('').html(data)
        console.log(data)
        },
        error: function (data) {
        }
    });
});