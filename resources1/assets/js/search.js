var APP_URL = jQuery('#base_url').val();
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});
//alert(APP_URL);
jQuery('#searchHotel').click(function(e){

   var hotelcity = jQuery('#autocomplete').val();
   
    var checkin = jQuery( "#checkin input" ).val();
    var checkout = jQuery( "#checkout input" ).val();
    var guest_count = jQuery( "#guest_count" ).val();
    var _token = jQuery( "#csrfField" ).val();
     //alert(guest_count);

    jQuery.ajax({
	        type: "POST",
	        url: APP_URL+"/search-hotel",
	        data: {
	            hotelcity: hotelcity,
	            checkin: checkin,
	            checkout: checkout,
	            guest_count: guest_count,
	            _token: _token
	           
	        },
	        success: function(response) {
	            console.log(response);
	        },
	        error: function(response) {
	            console.log(response);
	        }
	}); 
     //alert(checkout);
    e.preventDefault();
});

// jQuery('.sbmtFeedbck').on('click',function(){
//           alert('ss');
//       var result = jQuery(".date_from[required], .date_to[required]").filter(function () {
//         return jQuery.trim(jQuery(this).val()).length == 0
//       }).length == 0;
//       //alert(result);
//       if(result === true){
//         jQuery('.feedbckerror').hide();
//       }else{
//         jQuery('.feedbckerror').show();  
//       }
// });



window.onload = GetAllProperties;

function GetAllProperties() {
    var formData = jQuery("#roomFilter").serializeArray();
    //alert(formData);
    jQuery.ajax({
        type:'post',
        url: APP_URL+'/search-rooms',
        data: formData,
        dataType: 'html',
        success:function(response){
            jQuery('#ajaxRooms').html(response);
        }, 
        error: function (response) {
            console.log('Error : '+response);
        }
    });
}

// For room Filter
jQuery('#filterRooms').click(function(event){
	event.preventDefault();
    var formData = jQuery("#roomFilter").serializeArray();
    console.log(formData);
    jQuery.ajax({
        type:'post',
        url: APP_URL+'/search-rooms',
        data: formData,
        dataType: 'html',
        success:function(response){
            jQuery('#ajaxRooms').html(response);
        }, 
        error: function (response) {
            console.log('Error : '+response);
        }
    });
});

//


//
jQuery("#CheckOut").on("click",function(event){
    event.preventDefault();
   //alert(jQuery('#customerData').serialize());
    var d = new Date().getTime();
    document.getElementById("tid").value = d;
    var result = jQuery(".billing_name[required],.billing_address[required],.billing_city[required],.billing_state[required],.billing_zip[required],.billing_country[required],.billing_tel[required],.billing_email[required]",).filter(function () {
        return jQuery.trim(jQuery(this).val()).length == 0
    }).length == 0;
    if(result === true){
        jQuery('.feedbckerror').hide();  
        // ajax For Check User availblity
        jQuery.ajax({
            url: APP_URL+'/CheckUserAvailblity',
            type: 'post',
            data: {
                name: jQuery('.billing_name').val(),
                address: jQuery('.billing_address').val(),
                city: jQuery('.billing_city').val(),
                state: jQuery('.billing_state').val(),
                zip: jQuery('.billing_zip').val(),
                country: jQuery('.billing_country').val(),
                phone: jQuery('.billing_tel').val(),
                email: jQuery('.billing_email').val()
            },
                success: function (data) { 
                    console.log(data);
                    jQuery('#customerId').val(data);
                    jQuery('#preloader').show();
                    setTimeout(function(){ 
                        jQuery.ajax({
                            url: APP_URL+'/make-payment',
                            type: 'post',
                            data: jQuery('#customerData').serialize(),
                                success: function (data) { 
                                    //alert(data);
                                    jQuery('#encRequest').attr('value',data);
                                   document.redirect.submit(); 
                                },
                                error: function(xhr, desc, err) {
                                console.log("Details: " + desc + "\nError:" + err);
                            }
                        });
                    }, 3000);
                    
                },
                error: function(xhr, desc, err) {
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
        // jQuery.ajax({
        //     url: APP_URL+'/make-payment',
        //     type: 'post',
        //     data: jQuery('#customerData').serialize(),
        //         success: function (data) { 
        //             //alert(data);
        //             jQuery('#encRequest').attr('value',data);
        //            document.redirect.submit(); 
        //         },
        //         error: function(xhr, desc, err) {
        //         console.log("Details: " + desc + "\nError:" + err);
        //     }
        // });
    }else{
        jQuery('.feedbckerror').show();  
    }



    
});




// jQuery('.cancel').on("click", function (event) {
//     event.preventDefault();
//     var choice = confirm('Are You Sure To cancel this Booking...?? ');
//     if (choice) {
//         var orderId = jQuery(this).attr('data-orderId')
//         alert(orderId);
//     }
// });


//packages work


