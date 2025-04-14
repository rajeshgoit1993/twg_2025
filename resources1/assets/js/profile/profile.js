var APP_URL = jQuery('#base_url').val();

//alert(APP_URL);

 jQuery('#edit-profile-form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    first_name: {
                        validators: {
                                stringLength: {
                                min: 4,
                            },
                                notEmpty: {
                                message: 'Please enter your first name'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                                stringLength: {
                                min: 2,
                            },
                                notEmpty: {
                                message: 'Please enter your last name'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your email address'
                            },
                            emailAddress: {
                                message: 'Please enter a valid email address'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            stringLength: {
                                min:7,
                                message:'Please enter Valid Number'
                            },
                            notEmpty: {
                                message: 'Please enter a phone No.'
                            },
                            numeric:{
                          	 message:'Please only enter numeric characters!'
                       		 }
                        }
                    },
                    zipcode: {
                        validators: {
                            stringLength: {
                                min:4,
                                message:'Please enter Valid Zip'
                            },
                            notEmpty: {
                                message: 'Please enter a Zipcode.'
                            },
                            numeric:{
                             message:'Please only enter numeric characters!'
                             }
                        }
                    }
                },
                submitHandler: function(validator, form, submitButton) {
                   
                    var dob = jQuery( ".bfh-datepicker input" ).val();
                    var country = jQuery( "#countries_states2 span.bfh-selectbox-option" ).text();
                   	var state = jQuery( ".bfh-states span.bfh-selectbox-option" ).text();
                   
                	var formdata = jQuery("#edit-profile-form").serializeArray();

                	//console.log(formdata);
                	var fdata = {};
					jQuery(formdata ).each(function(index, obj){
					    fdata[obj.name] = obj.value;
					});

                    fdata['dob'] = dob;
                    fdata['country'] = country;
					fdata['state'] = state;
                  
                   console.log(fdata);
                   
                     jQuery.ajax({
                        url: APP_URL+'/saveProfile',
                        type:'POST',
                        data: fdata,
                        success:function(data) {
                            // This outputs the result of the ajax request
                            console.log(data);
                          
                           //jQuery("body").scrollTop();
                           var body = jQuery("html, body");
                            body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                                jQuery('#success_message').fadeIn();
                                location.reload();
                            });
                           
                        },
                        error: function(errorThrown){
                            console.log(errorThrown);
                        }
                    });
                },
            });
        jQuery('#save-profile-image').click(function(){

          location.reload();
        });



/****************** For Map Start  **************************/



var editlat = jQuery('#lat').val();
var editlng = jQuery('#lng').val();
var address = jQuery('#map_address').val();
var geocoder;
var map;
//var address ="San Diego, CA";
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(editlat, editlng);
  var myOptions = {
    zoom: 16,
    center: latlng,
  mapTypeControl: true,
  mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
  navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map"), myOptions);
  if (geocoder) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
        map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow(
              { content: '<b>'+address+'</b>',
                size: new google.maps.Size(150,50)
              });

          var marker = new google.maps.Marker({
              position: results[0].geometry.location,
              map: map, 
              title:address
          }); 
          google.maps.event.addListener(marker, 'click', function() {
              infowindow.open(map,marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}
google.maps.event.addDomListener(window, 'load', initialize);

/****************** For Map  End **************************/