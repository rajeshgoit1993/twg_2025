var APP_URL = $('#baseurl').val();

//Timepicker
$('.timepicker').timepicker({
  showInputs: false
});
/******** Select all check boxes  *****************/
$(".selectall").click(function(){
    $(".individual").prop("checked",$(this).prop("checked"));
});
/****************** For Map Start  **************************/

/* script */

function initialize() {
    var editlat = jQuery('#lat').val();
    var editlng = jQuery('#lng').val();
    ///alert(editlat);
   /// alert(editlng);
    var latlng = new google.maps.LatLng(editlat,editlng);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });

    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();   


    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
     
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
        showTooltip(infowindow,marker,place.formatted_address);
       
    });
    google.maps.event.addListener(marker, 'dragend', function() {

geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
    console.log(results[0]);
  if (results[0]) {        
   
      bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());

      infowindow.setContent(results[0].formatted_address);
      infowindow.open(map, marker);
      showTooltip(infowindow,marker,results[0].formatted_address);
      document.getElementById('searchInput');

  }
}
});
});


}

function bindDataToForm(address,lat,lng){

   document.getElementById('location').value = address;
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;

}
function showTooltip(infowindow,marker,address){
   google.maps.event.addListener(marker, 'click', function() { 
          infowindow.setContent(address);
          infowindow.open(map, marker);
         });
}
google.maps.event.addDomListener(window, 'load', initialize);

/****************** For Map  End **************************/

 // For Add Hotel Types
        $('#saveHotelTypes').click(function(){
            

            var hotelTypeformData = {
                hotelTypeName : $('.hotelType .hotelTypeName').val(),
                hotelTypeStatus : $('.hotelType .hotelTypeStatus').val(),
            }
            //console.log(hotelTypeformData);
            $.ajax({
                type:'post',
                url: APP_URL+'/addHotelType',
                data: hotelTypeformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent').hide();
                        $('#success-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('.hotelType #error-contaier').html(' ').html(html);
                    $('.hotelType #error-contaier-parent').show();

                }
            });
        }); 


    //FOr append data
     //  Append data for Edit Type Modal
        $(".edit_hotelType").on("click", function(){  
            var typeId = $(this).attr('data-id');
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();

            $('.editHotelType .edittypeid').attr('value',typeId);
            $('.editHotelType .hotelTypeName').attr('value',typeName);
            $('.editHotelType select').val(status);
        }); 

    // //  Edit HotelType Modal
        $("#updateHotelTypes").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var hotelTypeformData = {
                id : $('#editHotelTypeModal .edittypeid').val(),
                hotelTypeName : $('#editHotelTypeModal .hotelTypeName').val(),
                hotelTypeStatus : $('#editHotelTypeModal .hotelTypeStatus').val(),
            }
            console.log(hotelTypeformData);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/editHotelType',
                dataType: 'json',
                data: hotelTypeformData,
                success:function(data){
                    //console.log('Sucess : '+data);
                    $('#error-contaier-parent1').hide();
                    $('#success-contaier-parent1').show();
                    setTimeout(function () {
                      location.reload();
                    }, 400)
                }, 
                error: function (data) {
                      console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    console.log(html);
                    $('#editHotelTypeModal #error-contaier1').html(' ').html(html);
                    $('#editHotelTypeModal #error-contaier-parent1').show();
                }
            });
        });
        //delete Hotel Type
        $('.deleteHotelType').on('click',function(){
            var TypeId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Hotel Type?')){
                $('#deleteHotelType'+TypeId).submit();
            }
        });       



 // For Add Hotel Types
        $('#savePaymentMethod').click(function(){
            

            var PaymentMethodformData = {
                PaymentMethodName : $('.PaymentMethod .PaymentMethodName').val(),
                PaymentMethodStatus : $('.PaymentMethod .PaymentMethodStatus').val(),
            }
            console.log(PaymentMethodformData);
            $.ajax({
                type:'post',
                url: APP_URL+'/addPaymentMethod',
                data: PaymentMethodformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){
                    //alert(data);
                    console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent-Payment').hide();
                        $('#success-contaier-parent-Payment').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {
                     //alert(data);
                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('.PaymentMethod #error-contaier-Payment').html(' ').html(html);
                    $('.PaymentMethod #error-contaier-parent-Payment').show();

                }
            });
        }); 


    //FOr append data
     //  Append data for Edit Type Modal
        $(".edit_PaymentMethod").on("click", function(){  
            var typeId = $(this).attr('data-id');
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();

            $('.editPaymentMethod .edittypeid').attr('value',typeId);
            $('.editPaymentMethod .PaymentMethodName').attr('value',typeName);
            $('.editPaymentMethod select').val(status);
        }); 

    // //  Edit HotelType Modal
        $("#updatePaymentMethod").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var PaymentMethodformData = {
                id : $('#editPaymentMethod .edittypeid').val(),
                PaymentMethodName : $('#editPaymentMethod .PaymentMethodName').val(),
                PaymentMethodStatus : $('#editPaymentMethod .PaymentMethodStatus').val(),
            }
            console.log(PaymentMethodformData);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/editPaymentMethod',
                dataType: 'json',
                data: PaymentMethodformData,
                success:function(data){
                    //console.log('Sucess : '+data);
                    $('#error-contaier-parent-edit-Payment').hide();
                    $('#success-contaier-parent-edit-Payment').show();
                    setTimeout(function () {
                      location.reload();
                    }, 400)
                }, 
                error: function (data) {
                      console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    console.log(html);
                    $('#editHotelTypeModal #error-contaier-edit-Payment').html(' ').html(html);
                    $('#editHotelTypeModal #error-contaier-parent-edit-Payment').show();
                }
            });
        });
        //delete Hotel Type
        $('.deletePaymentMethod').on('click',function(){
            var TypeId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Payment Method?')){
                $('#deletePaymentMethod'+TypeId).submit();
            }
        });       



        //Hotel Aminities

        

         $('#saveHotelAmi').click(function(){
            
           
            var hotelAminiformData = {
                aminiName : $('#addAminities #aminiName').val(),
                aminiIcon : $('#addAminities #aminiIcon').val(),
                aminiDesc : $('#addAminities #aminiDesc').val(),
                aminiStatus : $('#addAminities #aminiStatus').val(),
            }
          //  console.log(hotelAminiformData);
           
           
            $.ajax({
                type:'post',
                url: APP_URL+'/addHotelAminities',
                data: hotelAminiformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){


                    console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent-ame').hide();
                        $('#success-contaier-parent-ame').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#addAminities #error-contaier-ame').html(' ').html(html);
                    $('#addAminities #error-contaier-parent-ame').show();

                }
            });
        }); 

          //  Append data for Edit Hotel Amenities
        $(".edit_hotelAmenities").on("click", function(){  
            var ameId = $(this).attr('data-id');

            var ameParentId = $(this).closest("tr").attr('id');
           
            var ameName = $('#'+ameParentId+' .amenitiesName').text();
            var ameIcon = $('#'+ameParentId+' .amenitiesIcon #Aicon').attr('lang');
            var ameDesc = $('#'+ameParentId+'  #desc').val();
            var status = $('#'+ameParentId+'  #status').val();
            
            $('#editAminities .editAmenutiesid').attr('value',ameId);
            $('#editAminities #aminiName').val(ameName);
            $('#editAminities #aminiIcon').val(ameIcon);
            $('#editAminities #aminiDesc').val(ameDesc);
            $('#editAminities #aminiStatus').val(status);
        }); 

        //Update Hotel
         $('#UpdateHotelAmi').click(function(){
            
           
            var hotelAminiformData = {
                 id : $('#editAminities .editAmenutiesid').val(),
                aminiName : $('#editAminities #aminiName').val(),
                aminiIcon : $('#editAminities #aminiIcon').val(),
                aminiDesc : $('#editAminities #aminiDesc').val(),
                aminiStatus : $('#editAminities #aminiStatus').val(),
            }
           console.log(hotelAminiformData);
           
           
            $.ajax({
                type:'post',
                url: APP_URL+'/editHotelAminities',
                data: hotelAminiformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){


                    console.log('Success : '+data);
                    if (data =='update') {
                        $('#error-contaier-parent-ame1').hide();
                        $('#success-contaier-parent-ame1').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#editAminities #error-contaier-ame1').html(' ').html(html);
                    $('#editAminities #error-contaier-parent-ame1').show();

                }
            });
        }); 

          //delete Users
        $('.deleteHotelAmenities').on('click',function(){
            var ameId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Hotel Amenities?')){
                $('#deleteHotelAmenities'+ameId).submit();
            }
        });    

         //Hotel Aminities

        

         $('#saveRoomAmi').click(function(){
            
           
            var hotelAminiformData = {
                aminiName : $('#addRoomAminities #aminiName').val(),
                aminiIcon : $('#addRoomAminities #aminiIcon').val(),
                aminiDesc : $('#addRoomAminities #aminiDesc').val(),
                aminiStatus : $('#addRoomAminities #aminiStatus').val(),
            }
          //  console.log(hotelAminiformData);
           
           
            $.ajax({
                type:'post',
                url: APP_URL+'/addRoomAminities',
                data: hotelAminiformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){


                    console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent-room').hide();
                        $('#success-contaier-parent-room').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#addRoomAminities #error-contaier-room').html(' ').html(html);
                    $('#addRoomAminities #error-contaier-parent-room').show();

                }
            });
        }); 

           //  Append data for Edit Rooms Amenities
        $(".edit_RoomAmenities").on("click", function(){  
            var ameId = $(this).attr('data-id');
           
            var ameParentId = $(this).closest("tr").attr('id');
         
            var ameName = $('#'+ameParentId+' .amenitiesName').text();
            var ameIcon = $('#'+ameParentId+' .amenitiesIcon #Aicon').attr('lang');
            var ameDesc = $('#'+ameParentId+'  #desc').val();
            var status = $('#'+ameParentId+'  #status').val();
          
            $('#editRoomAminities .editAmenutiesid').attr('value',ameId);
            $('#editRoomAminities #aminiName').val(ameName);
            $('#editRoomAminities #aminiIcon').val(ameIcon);
            $('#editRoomAminities #aminiDesc').val(ameDesc);
            $('#editRoomAminities #aminiStatus').val(status);
        });  

        //Update Room Amenities
         $('#UpdateRoomAmi').click(function(){
            
           
            var RoomAminiformData = {
                 id : $('#editRoomAminities .editAmenutiesid').val(),
                aminiName : $('#editRoomAminities #aminiName').val(),
                aminiIcon : $('#editRoomAminities #aminiIcon').val(),
                aminiDesc : $('#editRoomAminities #aminiDesc').val(),
                aminiStatus : $('#editRoomAminities #aminiStatus').val(),
            }
           console.log(RoomAminiformData);
           
           
            $.ajax({
                type:'post',
                url: APP_URL+'/editRoomAminities',
                data: RoomAminiformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){


                    console.log('Success : '+data);
                    if (data =='update') {
                        $('#error-contaier-parent-room1').hide();
                        $('#success-contaier-parent-room1').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#editRoomAminities #error-contaier-room1').html(' ').html(html);
                    $('#editRoomAminities #error-contaier-parent-room1').show();

                }
            });
        }); 

         
           //delete Users
        $('.deleteRoomAmenities').on('click',function(){
            var ameId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Room Amenities?')){
                $('#deleteRoomAmenities'+ameId).submit();
            }
        });   





         // For Add Room Types
        $('#saveRoomTypes').click(function(){
            

            var roomTypeformData = {
                roomTypeName : $('.roomType .roomTypeName').val(),
                roomTypeStatus : $('.roomType .roomTypeStatus').val(),
            }
          
           //console.log(roomTypeformData);
           
            $.ajax({
                type:'post',
                url: APP_URL+'/addRoomType',
                data: roomTypeformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent-room').hide();
                        $('#success-contaier-parent-room').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('.roomType #error-contaier-room').html(' ').html(html);
                    $('.roomType #error-contaier-parent-room').show();

                }
            });
        }); 
        //FOr append data
        //  Append data for Edit Type Modal
        $(".edit_roomType").on("click", function(){  
            var typeId = $(this).attr('data-id');
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();

            $('.editRoomType .edittypeid').attr('value',typeId);
            $('.editRoomType .roomTypeName').attr('value',typeName);
            $('.editRoomType select').val(status);
        }); 

        //  Edit Room Type Modal
        $("#updateRoomTypes").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var roomTypeformData = {
                id : $('#editRoomTypeModal .edittypeid').val(),
                roomTypeName : $('#editRoomTypeModal .roomTypeName').val(),
                roomTypeStatus : $('#editRoomTypeModal .roomTypeStatus').val(),
            }
            console.log(roomTypeformData);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/editRoomType',
                dataType: 'json',
                data: roomTypeformData,
                success:function(data){
                    console.log('Sucess : '+data);
                    $('#error-contaier-parent-edit-room').hide();
                    $('#success-contaier-parent-edit-room').show();
                    setTimeout(function () {
                      location.reload();
                    }, 400)
                }, 
                error: function (data) {
                      console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    console.log(html);
                    $('#editRoomTypeModal #error-contaier-edit-room').html(' ').html(html);
                    $('#editRoomTypeModal #error-contaier-parent-edit-room').show();
                }
            });
        });
        //delete Hotel Room Type
        $('.deleteRoomType').on('click',function(){
            var TypeId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Room Type?')){
                $('#deleteRoomType'+TypeId).submit();
            }
        });       
        // For Sav general Settings 
        $('#saveGeneralSetting').click(function(){
            var GeneralSettingformData = {
                id : '1',
                headertitle : $('.generalSetting .headertitle').val(),
                noFeatured : $('.generalSetting .noFeatured').val(),
                checkin : $('.generalSetting .checkin').val(),
                checkout : $('.generalSetting .checkout').val()
            }
            console.log(GeneralSettingformData);
            $.ajax({
                type:'post',
                url: APP_URL+'/addGeneralSetting',
                data: GeneralSettingformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){
                    //alert('Success : '+data);
                    if (data =='update') {
                        $('#error-contaier-parent-general').hide();
                        $('#success-contaier-parent-general').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 400)
                    }
                }, 
                error: function (data) {
                    //alert('Error : '+data);
                    var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('.generalSetting #error-contaier-general').html(' ').html(html);
                    $('.generalSetting #error-contaier-parent-general').show();

                }
            });
        }); 
/********************* For Hotel Add Backend ************************************************/

 $('#addHotelSubmit').click(function(event){
    event.preventDefault();
    data = $("#contactForm").serialize();
    console.log(data);
    $.ajax({
        type:'post',
        url: APP_URL+'/addHotel',
        data: data,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success:function(data){
            //alert(data);
            console.log('Success : '+data);
            if (data =='added') {
                $('.error-contaier-parent-hotel').hide();
                //$('.success-contaier-parent-hotel').show();
                
                var body = jQuery("html, body");
                body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    jQuery('.success-contaier-parent-hotel').fadeIn();
                    location.reload();
                });
            }
        }, 
        error: function (data) {

            console.log('Error : '+data);
             var html = '';
            $.each(JSON.parse(data.responseText), function(index, value){
                html +='<li>'+value+'</li>';
            });
            //console.log(html);
            $('.error-contaier-hotel').html(' ').html(html);
            $('.error-contaier-parent-hotel').show();

        }
    });
 });

 /********************* For Hotel Edit Backend ************************************************/

$('#editHotelSubmit').click(function(event){
    event.preventDefault();
    data = $("#contactForm").serializeArray();
    console.log(data);
    $.ajax({
        type:'post',
        url: APP_URL+'/editHotel',
        data: data,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success:function(data){
            //alert(data);
            console.log('Success : '+data);
            if (data =='update') {
                $('.error-contaier-parent-hotel').hide();
                //$('.success-contaier-parent-hotel').show();
                
                var body = jQuery("html, body");
                body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    jQuery('.success-contaier-parent-hotel').fadeIn();
                    location.reload();
                });
                
                // setTimeout(function () {
                //   location.reload();
                // }, 300)
            }
        }, 
        error: function (data) {

            console.log('Error : '+data);
             var html = '';
            $.each(JSON.parse(data.responseText), function(index, value){
                html +='<li>'+value+'</li>';
            });
            //console.log(html);
            $('.error-contaier-hotel').html(' ').html(html);
            $('.error-contaier-parent-hotel').show();

        }
    });
});

 /********************* For Hotel Delete Backend  ************************************************/

$('.deleteHotel').on('click',function(){
    var hotelName = $(this).attr('hotel-name');
    var hotelformData = {hotelId : $(this).attr('hotel-id')}
    if(confirm('Are you sure to delete "'+hotelName+'" ..?')){
        $.ajax({
            type:'post',
            url: APP_URL+'/deleteHotel',
            data: hotelformData,
            //contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success:function(data){
                //alert(data);
                console.log('Success : '+data);
                if (data =='delete') {
                    $('.error-contaier-parent-hotel').hide();                    
                    var body = jQuery("html, body");
                    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                        jQuery('.success-contaier-parent-hotel').fadeIn();
                        location.reload();
                    });
                }
            }, 
            error: function (data) {
                console.log('Error : '+data);
                 var html = '';
                $.each(JSON.parse(data.responseText), function(index, value){
                    html +='<li>'+value+'</li>';
                });
                $('.error-contaier-hotel').html(' ').html(html);
                $('.error-contaier-parent-hotel').show();
            }
        });
    }
});  

window.onload = function () {

    Dropzone.options.reportfile = {
        paramName: "file", 
        maxFilesize: 2,
        error: function (file, response) {
            alert('hiii')
        },
        init: function () {
            this.on("addedfile", function (file) {
                alert("Added file.");
            });
        },
        accept: function (file, done) {
            alert('hi')
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }

        }

    };
};
/************* Country State City Dropdown***************/
$(document).ready(function(){
    $("#Continent").click(function(){
        $("#State").html('');
        var SelectedContData = {
            SelectedCont : $("#Continent").val(),
        }
        console.log(SelectedContData);
        $.ajax({
            type:'POST',
            url: APP_URL+'/getHotelCountry',
            data: SelectedContData,
            success:function(data){
                //alert('Success : '+data);
                $("#Country").html(data);
            }, 
            error: function (data) {
                console.log('Error : '+data);                 
            }
        });
    });
    $("#Country").click(function(){
        var SelectedStateData = {
            SelectedState : $("#Country").val(),
        }
        console.log(SelectedStateData);
        $.ajax({
            type:'POST',
            url: APP_URL+'/getHotelState',
            data: SelectedStateData,
            success:function(data){
                //alert('Success : '+data);
                $("#State").html(data);
            }, 
            error: function (data) {
                console.log('Error : '+data);                 
            }
        });
    });
});