var APP_URL = $('#baseurl').val();

$("#hotelId").change(function(){
    $('#list').html('<option value="0">-- Select Room --</option>');
    var selectedHotelVal =  $("#hotelId option:selected").val();
    $(".SeleTedHotelID").val(selectedHotelVal);
    var selectedHotel = {selectedHotel : selectedHotelVal};
    // console.log(selectedHotel);
    $.ajax({
        type:'post',
        url: APP_URL+'/getRooms',
        data: selectedHotel,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success:function (data) {
            // console.log(data); 
            if(data !=''){
                $.each(data, function(key, value) {
                    $('#list').append('<option value="' + value.id + '">' + value.roomTypeName + '</option>');
                });
            }else{
                $('#list').html('<option value="">No Rooms Available</option>');
            }     
            
        }, 
        error: function (data) {

            // console.log('Error : '+data);
            
        }
    });
});
var defaultcurrency = $("#currency option:selected").attr('currName');
$("tbody input.form-control").attr("placeholder", defaultcurrency);

$("#currency").change(function(){
    var currency = $("#currency option:selected").attr('currName');
    $("tbody input.form-control").attr("placeholder", currency);
    var currencyVal = $("#currency option:selected").val();
    $(".SeleTedCurrency").val(currencyVal);
});

$("#list").change(function(){
    var selectedRoomVal =  $("#list option:selected").val();
    $(".SeleTedRoomID").val(selectedRoomVal);
});

/******************* Change Room Contract Type *********************/
$(".ctEdit").on("click", function(){   
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#'+typeParentId+' .typename').text();
    var typeDesc = $('#'+typeParentId+' .typedesc').text();
    var status = $('#'+typeParentId+' .status span').attr('status');
    $('#addContractType #ctValue').attr('value',typeId);
    $('#addContractType #cTName').attr('value',typeName);
    $('#addContractType #cTDesc').val(typeDesc);
    $('#addContractType select').val(status);
});
$(".rvEdit").on("click", function(){   
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeName = $('#'+typeParentId+' .typename').text();
    var status = $('#'+typeParentId+' .status span').attr('status');
    $('#addRoomView #rvValue').attr('value',typeId);
    $('#addRoomView #rvName').attr('value',typeName);
    $('#addRoomView select').val(status);
});
$(".raEdit").on("click", function(){   
    var typeId = $(this).attr('data-id');
    var typeParentId = $(this).closest("tr").attr('id');
    var typeIcon = $('#'+typeParentId+' .amenitiesIcon #Aicon i').attr('lang');
    var typeName = $('#'+typeParentId+' .amenitiesName').text();
    var typeDesc = $('#'+typeParentId+' .amenitiesDesc').text();
    var status = $('#'+typeParentId+' .amenitiesStatus span').attr('status');


    $('#addRoomAminities #raValue').attr('value',typeId);
    $('#addRoomAminities #aminiIcon').attr('value',typeIcon);
    $('#addRoomAminities #aminiName').attr('value',typeName);
    $('#addRoomAminities #aminiDesc').val(typeDesc);
    $('#addRoomAminities select').val(status);
});
 