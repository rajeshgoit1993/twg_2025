var APP_URL = $('#baseurl').val();
//alert(APP_URL);
$(document).ready(function(){

$(document).on('change','.query_status',function(){

	var status_value=$(this).val()
	var id =$(this).parent().attr('id')
	//alert(id)
	$.ajax({
		url:APP_URL+'/query_status',
		type:'POST',
		data:{id:id,status_value:status_value},
		success:function(data)
		{
         alert("Status Successfully Changed")
		},
		error:function(data)
		{

		}
	})
})
//
$(document).on('change','.lead_varified',function(){

	var status_value=$(this).val()
	var id =$(this).parent().attr('id')
    
    if(status_value=="1")
    {
    $(this).parent().parent().css("display","none");	
    }
	


	//alert(id)
	$.ajax({
		url:APP_URL+'/lead_varified',
		type:'POST',
		data:{id:id,status_value:status_value},
		success:function(data)
		{
         
		},
		error:function(data)
		{

		}
	})
})
//
/*$(document).on("change",".price_type",function(){
    var price_type=$(this).val();

    if(price_type=="Group Price")
    {
      $(this).parent().siblings(".anything").css("visibility","visible")
    }
    else
    {
     $(this).parent().siblings(".anything").css("visibility","hidden")
    }
})*/
//
$(document).on('keyup','.query_air_adult',function()
{

	var query_air_adult=$(this).val();
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_adult
    
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_adult',function()
{

	var query_hotel_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
   var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
   
    
})
//
$(document).on('keyup','.query_tours_adult',function()
{

	var query_tours_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
   var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_adult',function()
{

	var query_transfer_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_adult',function()
{

	var query_visa_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_adult',function()
{

	var query_inc_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_adult',function()
{

	var query_discount_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
   var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_adult',function()
{

	var query_gst_adult=$(this).val();
	var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
    var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand)
    
})
//column 2 start
$(document).on('keyup','.query_air_exadult',function()
{

	var query_air_exadult=$(this).val();
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
  
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_exadult',function()
{

	var query_hotel_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_tours_exadult',function()
{

	var query_tours_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_exadult',function()
{

	var query_transfer_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_exadult',function()
{

	var query_visa_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_exadult',function()
{

	var query_inc_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_exadult',function()
{

	var query_discount_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_exadult',function()
{

	var query_gst_exadult=$(this).val();
	var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
    var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand)
    
})
//column 3 childbed
$(document).on('keyup','.query_air_childbed',function()
{

	var query_air_childbed=$(this).val();
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")

   
    var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_childbed',function()
{

	var query_hotel_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_tours_childbed',function()
{

	var query_tours_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_childbed',function()
{

	var query_transfer_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
     var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_childbed',function()
{

	var query_visa_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_childbed',function()
{

	var query_inc_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_childbed',function()
{

	var query_discount_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
     var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_childbed',function()
{

	var query_gst_childbed=$(this).val();
	var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
    var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
     var total=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand)
    
})
//column 4 start
$(document).on('keyup','.query_air_childwbed',function()
{

	var query_air_childwbed=$(this).val();
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_childwbed',function()
{

	var query_hotel_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_tours_childwbed',function()
{

	var query_tours_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
   var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_childwbed',function()
{

	var query_transfer_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_childwbed',function()
{

	var query_visa_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_childwbed',function()
{

	var query_inc_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_childwbed',function()
{

	var query_discount_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_childwbed',function()
{

	var query_gst_childwbed=$(this).val();
	var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
    var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand)
    
})

//column 5 start
$(document).on('keyup','.query_air_infant',function()
{

	var query_air_infant=$(this).val();
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_infant',function()
{

	var query_hotel_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_tours_infant',function()
{

	var query_tours_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_infant',function()
{

	var query_transfer_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_infant',function()
{

	var query_visa_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_infant',function()
{

	var query_inc_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_infant',function()
{

	var query_discount_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_infant',function()
{

	var query_gst_infant=$(this).val();
	var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
    var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand)
    
})

//column 6 start
$(document).on('keyup','.query_air_single',function()
{

	var query_air_single=$(this).val();
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_hotel_single',function()
{

	var query_hotel_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_tours_single',function()
{

	var query_tours_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_transfer_single',function()
{

	var query_transfer_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_visa_single',function()
{

	var query_visa_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_inc_single',function()
{

	var query_inc_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_discount_single',function()
{

	var query_discount_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})
//
$(document).on('keyup','.query_gst_single',function()
{

	var query_gst_single=$(this).val();
	var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
    var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    
    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")
    
    var total=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total=parseFloat(total)-parseFloat(total*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total)
    var total_grand=parseFloat(total)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand)
    
})

//currency change part 1
$(document).on('change','.query_air_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//2
$(document).on('change','.query_hotel_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_gst_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//3
$(document).on('change','.query_tours_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//4
$(document).on('change','.query_transfer_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//6
$(document).on('change','.query_inc_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //ar total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
    var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//7
$(document).on('change','.query_visa_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})
//8
$(document).on('change','.query_gst_curr',function()
{

    var query_air_curr=$(this).parent().parent().parent().children("tr").children().children(".query_air_curr").find('option:selected'); 
    var query_hotel_curr=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_curr").find('option:selected'); 
    var query_tours_curr=$(this).parent().parent().parent().children("tr").children().children(".query_tours_curr").find('option:selected'); 
    var query_transfer_curr=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_curr").find('option:selected'); 
    var query_visa_curr=$(this).parent().parent().parent().children("tr").children().children(".query_visa_curr").find('option:selected'); 
    var query_inc_curr=$(this).parent().parent().parent().children("tr").children().children(".query_inc_curr").find('option:selected'); 
    var query_gst_curr=$(this).parent().parent().parent().children("tr").children().children(".query_gst_curr").find('option:selected'); 
    

    var query_air_curr=query_air_curr.attr("c_val")
    var query_hotel_curr=query_hotel_curr.attr("c_val")
    var query_tours_curr=query_tours_curr.attr("c_val")
    var query_transfer_curr=query_transfer_curr.attr("c_val")
    var query_visa_curr=query_visa_curr.attr("c_val")
    var query_inc_curr=query_inc_curr.attr("c_val")
   
    var query_gst_curr=query_gst_curr.attr("c_val")


    var query_air_adult=$(this).parent().parent().parent().children("tr").children().children(".query_air_adult").val()
	var query_hotel_adult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_adult").val()
    var query_tours_adult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_adult").val()
    var query_transfer_adult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_adult").val()
    var query_visa_adult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_adult").val()
    var query_inc_adult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_adult").val()
    var query_discount_adult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_adult").val()
    var query_gst_adult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_adult").val()
    
   
    
    var total1=parseFloat(query_air_adult*query_air_curr)+parseFloat(query_hotel_adult*query_hotel_curr)+parseFloat(query_tours_adult*query_tours_curr)+parseFloat(query_transfer_adult*query_transfer_curr)+parseFloat(query_visa_adult*query_visa_curr)+parseFloat(query_inc_adult*query_inc_curr)+parseFloat(query_gst_adult*query_gst_curr)
    
    //var total1=parseFloat(total1)-parseFloat(total1*query_discount_adult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_adult").val("").val(total1)
    var total_grand1=parseFloat(total1)-query_discount_adult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_adult").val("").val(total_grand1)
   //line 2 end 

    var query_air_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_air_exadult").val()
	var query_hotel_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_exadult").val()
    var query_tours_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_tours_exadult").val()
    var query_transfer_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_exadult").val()
    var query_visa_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_visa_exadult").val()
    var query_inc_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_inc_exadult").val()
    var query_discount_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_discount_exadult").val()
    var query_gst_exadult=$(this).parent().parent().parent().children("tr").children().children(".query_gst_exadult").val()
    
    
    
    var total2=parseFloat(query_air_exadult*query_air_curr)+parseFloat(query_hotel_exadult*query_hotel_curr)+parseFloat(query_tours_exadult*query_tours_curr)+parseFloat(query_transfer_exadult*query_transfer_curr)+parseFloat(query_visa_exadult*query_visa_curr)+parseFloat(query_inc_exadult*query_inc_curr)+parseFloat(query_gst_exadult*query_gst_curr)
    
    //var total2=parseFloat(total2)-parseFloat(total2*query_discount_exadult/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_exadult").val("").val(total2)
    var total_grand2=parseFloat(total2)-query_discount_exadult
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_exadult").val("").val(total_grand2)
    
    //line 3 start
    var query_air_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childbed").val()
	var query_hotel_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childbed").val()
    var query_tours_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childbed").val()
    var query_transfer_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childbed").val()
    var query_visa_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childbed").val()
    var query_inc_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childbed").val()
    var query_discount_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childbed").val()
    var query_gst_childbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childbed").val()
    
    var total3=parseFloat(query_air_childbed*query_air_curr)+parseFloat(query_hotel_childbed*query_hotel_curr)+parseFloat(query_tours_childbed*query_tours_curr)+parseFloat(query_transfer_childbed*query_transfer_curr)+parseFloat(query_visa_childbed*query_visa_curr)+parseFloat(query_inc_childbed*query_inc_curr)+parseFloat(query_gst_childbed*query_gst_curr)
    
    //var total3=parseFloat(total3)-parseFloat(total3*query_discount_childbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childbed").val("").val(total3)
    var total_grand3=parseFloat(total3)-query_discount_childbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childbed").val("").val(total_grand3)
    //line 4
    var query_air_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_air_childwbed").val()
	var query_hotel_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_childwbed").val()
    var query_tours_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_tours_childwbed").val()
    var query_transfer_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_childwbed").val()
    var query_visa_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_visa_childwbed").val()
    var query_inc_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_inc_childwbed").val()
    var query_discount_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_discount_childwbed").val()
    var query_gst_childwbed=$(this).parent().parent().parent().children("tr").children().children(".query_gst_childwbed").val()
    
    var total4=parseFloat(query_air_childwbed*query_air_curr)+parseFloat(query_hotel_childwbed*query_hotel_curr)+parseFloat(query_tours_childwbed*query_tours_curr)+parseFloat(query_transfer_childwbed*query_transfer_curr)+parseFloat(query_visa_childwbed*query_visa_curr)+parseFloat(query_inc_childwbed*query_inc_curr)+parseFloat(query_gst_childwbed*query_gst_curr)
    
    //var total4=parseFloat(total4)-parseFloat(total4*query_discount_childwbed/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_childwbed").val("").val(total4)
    var total_grand4=parseFloat(total4)-query_discount_childwbed
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_childwbed").val("").val(total_grand4)
    
    //line 5
    var query_air_infant=$(this).parent().parent().parent().children("tr").children().children(".query_air_infant").val()
	var query_hotel_infant=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_infant").val()
    var query_tours_infant=$(this).parent().parent().parent().children("tr").children().children(".query_tours_infant").val()
    var query_transfer_infant=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_infant").val()
    var query_visa_infant=$(this).parent().parent().parent().children("tr").children().children(".query_visa_infant").val()
    var query_inc_infant=$(this).parent().parent().parent().children("tr").children().children(".query_inc_infant").val()
    var query_discount_infant=$(this).parent().parent().parent().children("tr").children().children(".query_discount_infant").val()
    var query_gst_infant=$(this).parent().parent().parent().children("tr").children().children(".query_gst_infant").val()
    
   var total5=parseFloat(query_air_infant*query_air_curr)+parseFloat(query_hotel_infant*query_hotel_curr)+parseFloat(query_tours_infant*query_tours_curr)+parseFloat(query_transfer_infant*query_transfer_curr)+parseFloat(query_visa_infant*query_visa_curr)+parseFloat(query_inc_infant*query_inc_curr)+parseFloat(query_gst_infant*query_gst_curr)
    
    //var total5=parseFloat(total5)-parseFloat(total5*query_discount_infant/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_infant").val("").val(total5)
    var total_grand5=parseFloat(total5)-query_discount_infant
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_infant").val("").val(total_grand5)
    
    //line6
    var query_air_single=$(this).parent().parent().parent().children("tr").children().children(".query_air_single").val()
	var query_hotel_single=$(this).parent().parent().parent().children("tr").children().children(".query_hotel_single").val()
    var query_tours_single=$(this).parent().parent().parent().children("tr").children().children(".query_tours_single").val()
    var query_transfer_single=$(this).parent().parent().parent().children("tr").children().children(".query_transfer_single").val()
    var query_visa_single=$(this).parent().parent().parent().children("tr").children().children(".query_visa_single").val()
    var query_inc_single=$(this).parent().parent().parent().children("tr").children().children(".query_inc_single").val()
    var query_discount_single=$(this).parent().parent().parent().children("tr").children().children(".query_discount_single").val()
    var query_gst_single=$(this).parent().parent().parent().children("tr").children().children(".query_gst_single").val()
    
   var total6=parseFloat(query_air_single*query_air_curr)+parseFloat(query_hotel_single*query_hotel_curr)+parseFloat(query_tours_single*query_tours_curr)+parseFloat(query_transfer_single*query_transfer_curr)+parseFloat(query_visa_single*query_visa_curr)+parseFloat(query_inc_single*query_inc_curr)+parseFloat(query_gst_single*query_gst_curr)
    
    //var total6=parseFloat(total6)-parseFloat(total6*query_discount_single/100)
    $(this).parent().parent().parent().children("tr").children().children(".query_total_single").val("").val(total6)
    var total_grand6=parseFloat(total6)-query_discount_single
    $(this).parent().parent().parent().children("tr").children().children(".query_grand_single").val("").val(total_grand6)
    
})


//
//

})