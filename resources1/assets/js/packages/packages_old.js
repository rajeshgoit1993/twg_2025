var APP_URL = $('#baseurl').val();
//alert(APP_URL);
//Timepicker
$('.timepicker').timepicker({
  showInputs: false
});
$('.datepicker').datepicker({
    autoclose: true,

  });

$('.datepickers').datepicker({
    autoclose: true,
    todayHighlight: true,
    startDate: '0d'
})
$(document).on("click",".visa",function(){
    if($(this).is(":checked"))
    {
    $(this).parent().siblings(".visa_pol").show()
    }
    else
    {
   $(this).parent().siblings(".visa_pol").hide()
    }
})
/******** Select all check boxes  *****************/
$(".selectall").click(function(){
    $(".individual").prop("checked",$(this).prop("checked"));
});
//
$(document).on("click",".show_hide",function(){
var inner_data=$(this).html()

if(inner_data=="More+")
{
 $(this).html("").html("Less-")
 $(this).siblings(".cke_chrome").show()
}
else
{
 $(this).html("").html("More+")
 $(this).siblings(".cke_chrome").hide()
}
})
//
$(document).on("click",".show_hides",function(){
var inner_data=$(this).html()

if(inner_data=="More+")
{
 $(this).html("").html("Less-")
 $(this).siblings(".hide_text").show()
}
else
{
 $(this).html("").html("More+")
 $(this).siblings(".hide_text").hide()
}
})
//
$(document).on("click",".link",function(){
var link=$(this).attr("link");
var copyText = document.getElementById(link);
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(copyText.value).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Copied the text: " + copyText.value);
})
//



 // For Add Package Types
        $('#savePackageTypes').click(function(){
            
           
            var packageTypeformData = {
                pkgTypeName : $('#addPackageType .pkgTypeName').val(),
                pkgTypeStatus : $('#addPackageType .pkgTypeStatus').val(),
                showsfooter :  $('#addPackageType .showsfooter').val(),
            }
            //console.log(packageTypeformData);
            $.ajax({
                type:'post',
                url: APP_URL+'/add-package-type',
                data: packageTypeformData,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#error-contaier-parent').hide();
                        $('#success-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#addPackageType #error-contaier').html(' ').html(html);
                    $('#addPackageType #error-contaier-parent').show();

                }
            });
        }); 


    //FOr append data
     //  Append data for Edit Type Modal
        $(".edit_pkgType").on("click", function(){  
            var typeId = $(this).attr('data-id');
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();
            var showsfooter=$('#'+typeParentId+' .showsfooter input').val();

            
            $('.editPkgType .edittypeid').attr('value',typeId);
            $('.editPkgType .pkgTypeName').attr('value',typeName);
            $('.editPkgType select').val(status);
            $('.editPkgType .showsfooter select').val(showsfooter);
        }); 

    // //  Edit PkgType Modal
        $("#updatePkgTypes").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var pkgTypeformData = {
                id : $('#editPkgTypeModal .edittypeid').val(),
                pkgTypeName : $('#editPkgTypeModal .pkgTypeName').val(),
                pkgTypeStatus : $('#editPkgTypeModal .pkgTypeStatus').val(),
                showsfooter : $('#editPkgTypeModal .showsfooters').val(),
            }
            //console.log(pkgTypeformData);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/edit-package-type',
                dataType: 'json',
                data: pkgTypeformData,
                success:function(data){
                    //console.log('Sucess : '+data);
                    $('#error-contaier-parent1').hide();
                    $('#success-contaier-parent1').show();
                    setTimeout(function () {
                      location.reload();
                    }, 400)
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#editPkgTypeModal #error-contaier1').html(' ').html(html);
                    $('#editPkgTypeModal #error-contaier-parent1').show();
                }
            });
        });
        //delete Pkg Type
        $('.deletePkgType').on('click',function(){
            var TypeId = $(this).attr('data-id');
            if(confirm('Are you sure to delete Package Type?')){
                $('#deletePkgType'+TypeId).submit();
            }
        });       
        // For Add Package Types
        $('#addInclusions').click(function(){
            

            var packageInclusions = {
                Name : $('#packageInclusion .name').val(),
                Status : $('#packageInclusion .status').val(),
            }
            //console.log(packageInclusions);
            $.ajax({
                type:'post',
                url: APP_URL+'/add-inclusion',
                data: packageInclusions,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#packageInclusion #error-contaier-parent').hide();
                        $('#packageInclusion #success-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#packageInclusion #error-contaier').html(' ').html(html);
                    $('#packageInclusion #error-contaier-parent').show();

                }
            });
        }); 


        

        //FOr append data
     //  Append data for Edit Type Modal
        $(".editInclusionType").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
           // alert(typeParentId);
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();
            //alert(typeName+'/'+status);
            $('#editInclusionsModel .edittypeid').attr('value',typeId);
            $('#editInclusionsModel .incName').attr('value',typeName);
            $('#editInclusionsModel select').val(status);
        }); 

    // //  Edit Inclusions Modal
        $("#updateInclusionbtn").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var pkgInclusions = {
                id : $('#editInclusionsModel .edittypeid').val(),
                Name : $('#editInclusionsModel .incName').val(),
                Status : $('#editInclusionsModel .incStatus').val(),
            }
            //console.log(pkgInclusions);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/edit-inclusion',
                dataType: 'json',
                data: pkgInclusions,
                success:function(data){
                    //console.log('Sucess : '+data);
                    $('#editInclusionsModel #error-contaier-parent1').hide();
                    $('#editInclusionsModel #success-contaier-parent1').show();
                    setTimeout(function () {
                      location.reload();
                    }, 400)
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#editInclusionsModel #error-contaier1').html(' ').html(html);
                    $('#editInclusionsModel #error-contaier-parent1').show();
                }
            });
        });
        //delete Hotel Type
        $('.deleteIncType').on('click',function(){
            var TypeId = $(this).attr('data-id');
            
            if(confirm('Are you sure to delete Inclusion?')){
                $('#deleteIncType'+TypeId).submit();
            }
        });       


        //For Package Exclusions
        $("#add_packages_seo").click(function(){

            var destination=$("#package_seo .destination").val()
            var title=$("#package_seo .title").val()
            var keywords=$("#package_seo .keywords").val()
            var description=$("#package_seo .description").val()
           
           var packages_seo=
           {
            destination:$("#package_seo .destination").val(),
            title:$("#package_seo .title").val(),
            keywords:$("#package_seo .keywords").val(),
            description:$("#package_seo .description").val(),
           }

           $.ajax({
                type:'post',
                url: APP_URL+'/add_packages_seo',
                data: packages_seo,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#package_seo #error-pacseo-contaier-parent').hide();
                        $('#package_seo #success-pacseo-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#package_seo #error-pacseo-contaier').html(' ').html(html);
                    $('#package_seo #error-pacseo-contaier-parent').show();

                }
            });

        })
        //
        $(".edit_packages_seo").click(function(){
           
           var seo_id=$(this).siblings(".seo_id").val()
           var destination=$(this).siblings(".seo_destination").val()
           var title=$(this).siblings(".seo_title").val()
           var keywords=$(this).siblings(".seo_keywords").val()
           var description=$(this).siblings(".seo_desc").val()
        

        $(".edit_pack_seo .seo_id").val(seo_id);
        $(".edit_pack_seo .destination").val(destination);
        $(".edit_pack_seo .title").val(title);
        $(".edit_pack_seo .keywords").val(keywords);
        $(".edit_pack_seo .description").val(description);
        })
         //

         $("#update_packageseo").click(function(){

            var packages_seo=
           {
            seo_id:$("#edit_packages_seo .seo_id").val(),
            destination:$("#edit_packages_seo .destination").val(),
            title:$("#edit_packages_seo .title").val(),
            keywords:$("#edit_packages_seo .keywords").val(),
            description:$("#edit_packages_seo .description").val(),
           }
          
            $.ajax({
                type:'post',
                url: APP_URL+'/edit_packages_seo',
                data: packages_seo,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#edit_packages_seo #error-pacseo-contaier-parent').hide();
                        $('#edit_packages_seo #success-pacseo-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#edit_packages_seo #error-pacseo-contaier').html(' ').html(html);
                    $('#edit_packages_seo #error-pacseo-contaier-parent').show();

                }
            });

         })
         //
$(document).on("change","#change_package",function(){
   var value=$(this).val();
   if(value=="manual")
   {
    $("#change_packages").html("").html("<input type='text' class='form-control' name='packageId' placeholder='Enter Manual Package'>")
   }
   else
   {
    $.ajax({
    type:'post',
    url:APP_URL+'/change_package',
    data:{value:value},
    success:function(data)
    {

    $("#change_packages").html("").html("<select class='form-control' name='packageId'>"+data+"</select>")
    
    },
    error:function(data){

    }
   })

   }
   
})


        //
        $('#addExclusions').click(function(){
            

            var packageExclusions = {
                Name : $('#packageExclusion .name').val(),
                Status : $('#packageExclusion .status').val(),
            }
            //console.log(packageExclusions);

            $.ajax({
                type:'post',
                url: APP_URL+'/add-exclusion',
                data: packageExclusions,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#packageExclusion #error-contaier-parent').hide();
                        $('#packageExclusion #success-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#packageExclusion #error-contaier').html(' ').html(html);
                    $('#packageExclusion #error-contaier-parent').show();

                }
            });
        }); 


        

        //FOr append data
     //  Append data for Edit Type Modal
        $(".editExclusionType").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
           // alert(typeParentId);
            var typeName = $('#'+typeParentId+' .typename').text();
            var status = $('#'+typeParentId+' .typestatus input').val();
            //alert(typeName+'/'+status);
            $('#editExclusionsModel .edittypeid').attr('value',typeId);
            $('#editExclusionsModel .incName').attr('value',typeName);
            $('#editExclusionsModel select').val(status);
        }); 

    // //  Edit Exclusions Modal
        $("#updateExclusionbtn").on("click", function(){
           
          //  alert($('#editHotelTypeModal .edittypeid').val());
             var pkgExclusions = {
                id : $('#editExclusionsModel .edittypeid').val(),
                Name : $('#editExclusionsModel .incName').val(),
                Status : $('#editExclusionsModel .incStatus').val(),
            }
            //console.log(pkgExclusions);
            $.ajax({
                type:'POST',
                 url: APP_URL+'/edit-exclusion',
                dataType: 'json',
                data: pkgExclusions,
                success:function(data){
                    //console.log('Sucess : '+data);
                    $('#editExclusionsModel #error-contaier-parent1').hide();
                    $('#editExclusionsModel #success-contaier-parent1').show();
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
                    //console.log(html);
                    $('#editExclusionsModel #error-contaier1').html(' ').html(html);
                    $('#editExclusionsModel #error-contaier-parent1').show();
                }
            });
        });
        //delete Hotel Type
        $('.deleteExcType').on('click',function(){
            var TypeId = $(this).attr('data-id');
            
            if(confirm('Are you sure to delete Exclusion?')){
                $('#deleteExcType'+TypeId).submit();
            }
        }); 


        //Add package Tours
   $(".custom_tour").click(function(e){
   e.preventDefault()
   })
        //For Package Exclusions

        /*$('#addTours').click(function(){
           
          
            var packageTours = {
                Name : $('#packageTours .name').val(),
                description : $('#packageTours .description').val(),
                location : $('#packageTours .location').val(),
                Status : $('#packageTours .status').val(),
            }
            //console.log(packageTours);
            $.ajax({
                type:'post',
                url: APP_URL+'/add-tour',
                data: packageTours,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success:function(data){

                    //console.log('Success : '+data);
                    if (data =='added') {
                        $('#packageTours #error-contaier-parent').hide();
                        $('#packageTourspackageTours #success-contaier-parent').show();
                        
                        setTimeout(function () {
                          location.reload();
                        }, 300)
                    }
                }, 
                error: function (data) {

                    //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    $('#packageTours #error-contaier').html(' ').html(html);
                    $('#packageTours #error-contaier-parent').show();

                }
            });
        }); */

        //  $('#addTours').click(function(event){
           
        //     event.preventDefault();
           
        //     var form_data = new FormData($("#tour_add")[0]);
           

        //     $.ajax({
        //     url: APP_URL+'/add-tour',
        //     data: form_data,
        //     type: 'post',
        //     contentType: false,
        //     processData: false,
        //     success: function (data) {
                
        //        if (data =='added') {
        //                 $('#packageTours #error-contaier-parent').hide();
        //                 $('#packageTourspackageTours #success-contaier-parent').show();
                        
        //                 setTimeout(function () {
        //                   location.reload();
        //                 }, 300)
        //             }
              
               
        //     },
        //     error: function (xhr, status, error) {
        //         //alert(xhr.responseText);

        //         //console.log('Error : '+data);
        //              var html = '';
        //             $.each(JSON.parse(xhr.responseText), function(index, value){
        //                 html +='<li>'+value+'</li>';
        //             });
        //             //console.log(html);
        //             $('#packageTours #error-contaier').html(' ').html(html);
        //             $('#packageTours #error-contaier-parent').show();
                
        //     }
        // });
          
        // }); 
         //  Append data for Edit Tours
        $(".editTourType").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
           // alert(typeParentId);
            var typeName = $('#'+typeParentId+' .typename').text();
            var typedesc = $('#'+typeParentId+' .typedesc input').val();
            var typelocation = $('#'+typeParentId+' .typelocation').text();
            var status = $('#'+typeParentId+' .typestatus input').val();
            var img_src = $('#'+typeParentId+' .typeimage img').attr("src");
            var edit_img_value = $('#'+typeParentId+' .edit_img_value').val();
           
            //alert(typeName+'/'+status);
            CKEDITOR.instances['edit_description'].setData(typedesc);
            $('#editToursModel .edittypeid').attr('value',typeId);
            $('#editToursModel .name').attr('value',typeName);
            //$('.edit_description').insertText('<p>This is a new paragraph.</p>');
            $('#editToursModel .location').attr('value',typelocation);
            $('#editToursModel select').val(status);
            $('#editToursModel img').attr('src',img_src);
            $('#editToursModel .tour_image').attr('value',edit_img_value);

        }); 
       // edit package tours
       // $("#updateTourbtn").on("click", function(event){
         

       //      event.preventDefault();
           
       //      var form_data = new FormData($("#tour_add1")[0]);
            

       //      console.log(form_data)

       //      $.ajax({
       //      url: APP_URL+'/edit-tour',
       //      data: form_data,
       //      type: 'post',
       //      contentType: false,
       //      processData: false,
       //      success: function (data) {
                
       //        //console.log('Sucess : '+data);
       //        $('#editToursModel #error-contaier-parent1').hide();
       //        $('#editToursModel #success-contaier-parent1').show();
       //        setTimeout(function () {
       //          location.reload();
       //        }, 400)
                   
              
       //      },
       //      error: function (xhr, status, error) {
               
       //               var html = '';
       //              $.each(JSON.parse(data.responseText), function(index, value){
       //                  html +='<li>'+value+'</li>';
       //              });
       //              //console.log(html);
       //              $('#editToursModel #error-contaier1').html(' ').html(html);
       //              $('#editToursModel #error-contaier-parent1').show();
                
                
       //      }
       //  });


       //  });
       //delete Package Tours
        $('.deleteTour').on('click',function(){
            var TypeId = $(this).attr('data-id');
            
            if(confirm('Are you sure to delete Tour?')){
                $('#deleteTour'+TypeId).submit();
            }
        }); 
//

$(document).on("click",".img_gall", function(){


var cou_name=$(this).siblings(".cou_name").val()
var cou_id=$(this).siblings(".cou_name").attr("c_id")
var sta_name=$(this).siblings(".sta_name").val()
var cit_name=$(this).siblings(".cit_name").val()
var name_name=$(this).siblings(".name_name").val()


var pac_id=$(this).siblings(".pac_id").val()

var type=$(this).siblings(".type").val()
var gallery_country=$(".gallery_country").val();
var gallery_state=$(".gallery_state").val();

var gallery_city=$(".gallery_city").val();
var search_by_name=$(".search_by_name").val();

if(type=='video')
{
var video_path=$(this).siblings(".video_path").val()
var video_thumb=$(this).siblings(".video_thumb").val()
$(".dynamic_file").html('<div class="col-md-1">Choose Thumb: </div><div class="col-md-11 video_thumb"><img src="'+video_thumb+'"  width="100" style="margin-bottom: 5px"><input type="file" name="image_thumb"  class="form-control" ></div><div class="col-md-1">Choose Video: </div><div class="col-md-6"><video width="220" height="200" controls><source src="'+video_path+'" type="video/mp4"><source src="'+video_path+'" type="video/ogg">Your browser does not support the video tag.</video><input type="file" name="uploadvideo"  class="form-control" ></div>')

}
else
{
    var img_name=$(this).siblings(".img_name").val()
    var img_val=$(this).siblings(".img_value").val()
$(".dynamic_file").html('').html('<div class="col-md-1">Choose Image: </div><div class="col-md-6 img_up"><img src=""  width="100" style="margin-bottom: 5px"><input type="file" name="uploadimage" class="form-control"><input type="hidden" name="uploadimage_value" class="im_value" value=""></div>')
 $('.img_gallery_edit_value .img_up img').attr("src",img_name);

 $('.img_gallery_edit_value .im_value').val(img_val);

}
 $('.img_gallery_edit_value .country_val select').val(cou_name);
 $('.img_gallery_edit_value .img_name ').val(name_name);
 $('.img_gallery_edit_value .img_pac_id').val(pac_id);

 $('.img_gallery_edit_value .c_val').val(gallery_country);
 $('.img_gallery_edit_value .s_val').val(gallery_state);
 $('.img_gallery_edit_value .ct_val').val(gallery_city);
 $('.img_gallery_edit_value .search_val').val(search_by_name);
 //$('.img_gallery_edit_value .st_val select').val(cou_name);
 //$('.img_gallery_edit_value .ct_val select').val(cou_name);
//
 $.ajax({
                type:'POST',
                 url: APP_URL+'/get_gall_state',
               // dataType: 'json',
                data: {country:cou_name,sta_name:sta_name},
                success:function(data){
                    //console.log('Sucess : '+data);

                    $('.img_gallery_edit_value .state_val').html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });

  $.ajax({
                type:'POST',
                 url: APP_URL+'/get_gall_city',
               // dataType: 'json',
                data: {sta_name:sta_name,cit_name:cit_name},
                success:function(data){
                    //console.log('Sucess : '+data);

                    $('.img_gallery_edit_value .city_val').html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });



})
//play_video
$(document).on("click",".play_video", function(){
    var video_src=$(this).siblings(".video_src").val()

  $(".video_open").html('').html(' <video width="100%" controls=""><source src="'+video_src+'" type="video/mp4" ><source src="'+video_src+'" type="video/ogg">Your browser does not support HTML video.</video>')
   

$("#video_play_modal").modal("toggle")

})
//
$(document).on("click","#update_gallery", function(event){

     event.preventDefault();

     var form_data = new FormData($("#gallery_form")[0]);
     var page=$(".img_gal_pag").children().children(".active").children().html()
     

            $.ajax({
            url: APP_URL+'/edit_gallery_form?page='+page,
            data: form_data,
            type: 'post',
            contentType: false,
            processData: false,
            success: function (data) {
                
              console.log('Sucess : '+data);
                   
             $("#gallery_sorting").html('').html(data);
              
            },
            error: function (xhr, status, error) {
                //alert(xhr.responseText);

                //console.log('Error : '+data);
                //console.log('Error : '+data);
                     var html = '';
                    $.each(JSON.parse(data.responseText), function(index, value){
                        html +='<li>'+value+'</li>';
                    });
                    //console.log(html);
                    //$('#editToursModel #error-contaier1').html(' ').html(html);
                    //$('#editToursModel #error-contaier-parent1').show();
                
                
            }
        });

})

$(document).on("click",".delete_gall", function(event){
 var gallery_country=$(".gallery_country").val();
 var gallery_state=$(".gallery_state").val();
var page=$(".img_gal_pag").children().children(".active").children().html()
     
 var gallery_city=$(".gallery_city").val();
 var search_by_name=$(".search_by_name").val();
 var pac_id=$(this).data("id");
 var r=confirm("Are you sure Delete This Image?")
   if (r==true)
   {
      
     $.ajax({
                type:'POST',
                 url: APP_URL+'/delete_image_ingall?page='+page,
               // dataType: 'json',
                data: {id:pac_id,country:gallery_country,state:gallery_state,city:gallery_city,search_by_city:search_by_name},
                success:function(data){
                    //console.log('Sucess : '+data);

                     $("#gallery_sorting").html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });


   }
   else
   {
       //nothing to do here
   }

})
//
$(document).on('click','.img_gal_pag .pagination a', function(e){
    e.preventDefault();

    var page=$(this).attr('href').split('page=')[1];
    fetch_data(page);
    //alert(page)
})

function fetch_data(page)
{
    var gallery_country=$(".gallery_country").val();
    var gallery_state=$(".gallery_state").val();

    var gallery_city=$(".gallery_city").val();
    var search_by_name=$(".search_by_name").val()


     $.ajax({

        url:APP_URL+'/img_gallery/fetch_data?page='+page,
        data:{search_by_name:search_by_name,gallery_country:gallery_country,gallery_state:gallery_state,gallery_city:gallery_city},
        success:function(data)
        {
           console.log(data)
           $("#gallery_sorting").html('').html(data);
        }
     })

}
//
$(document).on("keyup",".search_by_name", function(event){
var gallery_country=$(".gallery_country").val();
 var gallery_state=$(".gallery_state").val();

 var gallery_city=$(".gallery_city").val();
var search_by_name=$(this).val()

 $.ajax({
                type:'POST',
                 url: APP_URL+'/search_name_gallery',
               // dataType: 'json',
                data: {country:gallery_country,state:gallery_state,city:gallery_city,search_by_city:search_by_name},
                success:function(data){
                     console.log('Sucess : '+data);

                     $("#gallery_sorting").html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });

})
        //Payment Method
        $('.paymentMethods').click(function(){
            var condition = '';
            var id='';
            $(".paymentMethods").each(function(){
             if($(this).is(':checked')){
                condition += $(this).val();
                condition += '\n';
                id +=$(this).attr('lang');
                id +=',';

            }
            });
           $('#payment_policies').val(condition);
           $('#payment_policies_input').val(id);
          
        });
        //Visa Policies
        $('.visaMethods').click(function(){
            var condition = '';
            var id='';
            $(".visaMethods").each(function(){
             if($(this).is(':checked')){
                condition += $(this).val();
                condition += '\n';
                id +=$(this).attr('lang');
                id +=',';

            }
            });
           $('#visa_policies').val(condition);
           $('#visa_policies_input').val(id);
          
        });

        //Cancelation Policy
        $('.cancellation').click(function(){
            var conditionC = '';
            var idC = '';
            $(".cancellation").each(function(){
             if($(this).is(':checked')){
                conditionC += $(this).val();
                conditionC += '\n';
                idC +=$(this).attr('lang');
                idC +=',';
            }
            });
           $('#cancle_policy').val(conditionC);
           $('#cancellation_input_field').val(idC);
          
        });
        $('#package_dest_country').on('change',function(){
            
            $.ajax({
                type:'POST',
                 url: APP_URL+'/get-cities',
               // dataType: 'json',
                data: {state:$(this).val(),cotegory:$('#category').val()},
                success:function(data){
                    //console.log('Sucess : '+data);

                    $('#package_dest_city').html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });

            $.ajax({
                type:'POST',
                 url: APP_URL+'/get-locations',
               // dataType: 'json',
                data: {state:$(this).val(),cotegory:$('#category').val()},
                success:function(data){
                    //console.log('Sucess : '+data);

                    $('#package_location_city').html('').html(data);
                  
                }, 
                error: function (data) {
                      //console.log('Error : '+data);
                   
                }
            });


        });

        $('#category').on('change',function(){

            

            if($(this).val()=='international'){

                $.ajax({
                    type:'POST',
                     url: APP_URL+'/get-country',
                   // dataType: 'json',
                    data: {state:$(this).val(),type:'international'},
                    success:function(data){
                        //console.log('Sucess : '+data);
    
                        $('#package_dest_country').html('').html(data);
                      
                    }, 
                    error: function (data) {
                          //console.log('Error : '+data);
                       
                    }
                });

            }else{

                $.ajax({
                    type:'POST',
                     url: APP_URL+'/get-country',
                   // dataType: 'json',
                    data: {state:$(this).val(),type:'domestic'},
                    success:function(data){
                        //console.log('Sucess : '+data);
    
                        $('#package_dest_country').html('').html(data);
                      
                    }, 
                    error: function (data) {
                          //console.log('Error : '+data);
                       
                    }
                });

            }

        });

        $('#onrequest').click(function(){

            if($(this).is(':checked')) {
                $('.pricelistpackage').hide();
                
                
            }else{
                $('.pricelistpackage').show();
                $('#upcoming').prop('checked', $(this).is(':checked') ? false : true);
                 $('.pricelistpackage_upcoming').hide();
            }
        });
        //
         $('#upcoming').click(function(){

            if($(this).is(':checked')) {
                $('.pricelistpackage_upcoming').hide();
               
            }else{
                $('.pricelistpackage_upcoming').show();
                $('#onrequest').prop('checked', $(this).is(':checked') ? false : true);
                $('.pricelistpackage').hide();
            }
        });
        //append payment policy in model
       
        $(".edit_pkgPayPolicy").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .packagePayPolicy').text();
            var typedesc = $('#'+typeParentId+' .packagePayDesc input').val();
            var status = $('#'+typeParentId+' .poltypestatus input').val();
            
            CKEDITOR.instances['pkgPayDesc'].setData(typedesc);
            $('.editPkgPayPolicy .edittypeid').val(typeId);
            $('.editPkgPayPolicy #pkgPolicyName').val(typeName);
            $('.editPkgPayPolicy select').val(status);
        }); 
        //append payment policy in model
       
        $(".edit_pkgCanPolicy").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .canPolicy').text();
            var typedesc = $('#'+typeParentId+' .canPolicydesc input').val();
            var status = $('#'+typeParentId+' .canPolicystatus input').val();
           
           CKEDITOR.instances['canPolicyDesc'].setData(typedesc);
            $('.editPkgCanPolicy .edittypeid').val(typeId);
            $('.editPkgCanPolicy #pkgPolicyName').val(typeName);
            $('.editPkgCanPolicy select').val(status);
        }); 

        //

        $(".edit_impnotes").on("click", function(){  
            var typeId = $(this).attr('data-id');
           //alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .imp_notes').text();
            var typedesc = $('#'+typeParentId+' .imp_desc input').val();
            var status = $('#'+typeParentId+' .imp_status input').val();
           

            CKEDITOR.instances['notes_desc'].setData(typedesc);
            $('.editimpnotes .edittypeid').val(typeId);
            $('.editimpnotes #notes_name').val(typeName);
            $('.editimpnotes select').val(status);
        }); 
        //
        $(".editquotationheader").on("click", function(){  
            var typeId = $(this).attr('data-id');
           
            
            var typeParentId = $(this).closest("tr").attr('id');

            var typeName = $('#'+typeParentId+' .quo_header').text();
            var typedesc = $('#'+typeParentId+' .quo_desc input').val();
            var status = $('#'+typeParentId+' .quo_status input').val();
            
            
            CKEDITOR.instances['header_desc'].setData(typedesc);
            $('.edit_quotationheader .edittypeid').val(typeId);
            $('.edit_quotationheader #quotationheader').val(typeName);
            $('.edit_quotationheader select').val(status);
        }); 
        //
        $(".editquotationfooter").on("click", function(){  
            var typeId = $(this).attr('data-id');
           
            
            var typeParentId = $(this).closest("tr").attr('id');

            var typeName = $('#'+typeParentId+' .quo_footer').text();
            var typedesc = $('#'+typeParentId+' .quo_desc input').val();
            var status = $('#'+typeParentId+' .quo_status input').val();
            
            
            CKEDITOR.instances['footer_desc'].setData(typedesc);
            $('.edit_quotationfooter .edittypeid').val(typeId);
            $('.edit_quotationfooter #quotationfooter').val(typeName);
            $('.edit_quotationfooter select').val(status);
        }); 
        //

        $(".edit_pkgvisaPolicy").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .visaPolicy').text();
            var typeDesc = $('#'+typeParentId+' .visaPolicyDesc input').val();
            var status = $('#'+typeParentId+' .visaPolicystatus input').val();

          
          CKEDITOR.instances['pkgPolicyDesc'].setData(typeDesc);
            $('.editPkgVisaPolicy .edittypeid').val(typeId);
            $('.editPkgVisaPolicy #pkgPolicyName').val(typeName);
            
            $('.editPkgVisaPolicy select').val(status);
        }); 

        //append traveller type in model
        $(".edit_pkgTravellerType").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .travellername').text();
            var status = $('#'+typeParentId+' .travellerstatus input').val();
           
            $('.editPkgTravellerType .edittypeid').val(typeId);
            $('.editPkgTravellerType .travellerTypeName').val(typeName);
            $('.editPkgTravellerType select').val(status);
        }); 

        //append rating type in model
        $(".edit_pkgRatingType").on("click", function(){  
            var typeId = $(this).attr('data-id');
           // alert(typeId);
            var typeParentId = $(this).closest("tr").attr('id');
            var typeName = $('#'+typeParentId+' .ratingname').text();
            var status = $('#'+typeParentId+' .ratingstatus input').val();
           
            $('.editPkgRatingType .edittypeid').val(typeId);
            $('.editPkgRatingType .ratingTypeName').val(typeName);
            $('.editPkgRatingType select').val(status);
        }); 
  //

jQuery(document).ready(function()
{

$('.wrap_small').find('a[href=""]').on('click', function (e) {
    e.preventDefault();

var class_name=$(this).siblings().attr("class")
if(class_name=="small_class")
    {
    $(this).closest('.wrap_small').find('.small_class').toggleClass('small_class big_class');
    $(this).html("Hide")
    }
    else
    {
    $(this).closest('.wrap_small').find('.big_class').toggleClass('big_class small_class');
    $(this).html("Show More")
    }

});
})
jQuery(document).ready(function () {

    $('.wrap_small').find('a[href=""]').on('click', function (e) {
        e.preventDefault();

        var class_name = $(this).siblings().attr("class")
        if (class_name == "small_class") {
            $(this).closest('.wrap_small').find('.small_class').toggleClass('small_class big_class');
            $(this).html("Hide")
        }
        else {
            $(this).closest('.wrap_small').find('.big_class').toggleClass('big_class small_class');
            $(this).html("Show More")
        }

    });
})

jQuery("#show_flight_options").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.flight').css('display', 'block');
        jQuery('#onward_required').prop('checked',true);
        jQuery('.onwardflight').css('display', 'block');
        jQuery('#return_required').prop('checked',true);
        jQuery('.returnflight').css('display', 'block');
        // jQuery('#onward_required').attr('checked', true);
        // jQuery('#return_required').attr('checked', true);

    } else {
        jQuery('.flight').css('display', 'none');
    }
});
jQuery(document).ready(function () {
    var ischecked = $("#show_flight_options").is(':checked');
    if (ischecked) {
        jQuery('.flight').css('display', 'block');
      

    } else {
        jQuery('.flight').css('display', 'none');
    }
});
//
jQuery("#onward_required").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.onwardflight').css('display', 'block');
    } else {

        jQuery('.onwardflight').css('display', 'none');
    }
  //
var onward_check = $('input[name="flight[onward_required]"]:checked').length;
var down_check = $('input[name="flight[return_required]"]:checked').length;

if (!onward_check && !down_check) {
  jQuery('#show_flight_options').attr('checked', false);
}
else
{
    jQuery('#show_flight_options').prop('checked',true); 
}


});
jQuery("#return_required").change(function () {
    var ischecked = $(this).is(':checked');
    if (ischecked) {
        jQuery('.returnflight').css('display', 'block');
    } else {
        jQuery('.returnflight').css('display', 'none');
    }
    //
    var onward_check = $('input[name="flight[onward_required]"]:checked').length;
var down_check = $('input[name="flight[return_required]"]:checked').length;
if (!onward_check && !down_check) {
  $('#show_flight_options').attr('checked', false);
}
else
{
    jQuery('#show_flight_options').prop('checked',true); 
}
});
  // 
  jQuery(document).ready(function(){

    $("#packages_search").keyup(function(){
        var value=$(this).val()
       
        $.ajax({
            type:'POST',
            url:APP_URL+'/list_data',
            data:{value:value},
            success:function(data)
            {
                $("#list_dynamic_data").html("").html(data)
               console.log(data);
            },
            error:function(data)
            {

            }

        })
    })
  })    
  //      
 jQuery(document).ready(function(){


        jQuery('#package_durations').change(function(){
            
            jQuery('.daylog').hide();
            var daycount = jQuery($(this)).val();
            for (i = 1; i <= daycount; i++) {
               jQuery('.day'+i).show();
            }
        });  
        jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
        jQuery('a[href="' + activeTab + '"]').tab('show');
        }
        });


 $('#package_arrival_country').change(function(){

    alert($(this).val());
    $.ajax({
            type:'POST',
             url: APP_URL+'/get-states',
            dataType: 'json',
            data: pkgExclusions,
            success:function(data){
                //console.log('Sucess : '+data);
                $('#editExclusionsModel #error-contaier-parent1').hide();
                $('#editExclusionsModel #success-contaier-parent1').show();
                setTimeout(function () {
                  location.reload();
                }, 400)
            }, 
            error: function (data) {
                  //console.log('Error : '+data);
                 var html = '';
                $.each(JSON.parse(data.responseText), function(index, value){
                    html +='<li>'+value+'</li>';
                });
                //console.log(html);
                $('#editExclusionsModel #error-contaier1').html(' ').html(html);
                $('#editExclusionsModel #error-contaier-parent1').show();
            }
        });



 });

//

$("#transport").change(function(){
    var t_value=$(this).val();

    if(t_value=="Flight")
    {
       $(".oflight").css("display","none")
        $(".flight").css("display","block")
    }
    else
    {
        $(".oflight").css("display","block")
        $(".flight").css("display","none")
    }
})
$("#transport1").change(function(){
    var t_value=$(this).val();
    
    if(t_value=="Flight")
    {
       $(".oflight1").css("display","none")
        $(".flight1").css("display","block")
    }
    else
    {
        $(".oflight1").css("display","block")
        $(".flight1").css("display","none")
    }
})
$("#transport2").change(function(){
    var t_value=$(this).val();
    
    if(t_value=="Flight")
    {
       $(".oflight2").css("display","none")
        $(".flight2").css("display","block")
    }
    else
    {
        $(".oflight2").css("display","block")
        $(".flight2").css("display","none")
    }
})
$("#transport3").change(function(){
    var t_value=$(this).val();
    
    if(t_value=="Flight")
    {
       $(".oflight3").css("display","none")
        $(".flight3").css("display","block")
    }
    else
    {
        $(".oflight3").css("display","block")
        $(".flight3").css("display","none")
    }
})
//
$(document).on('change','.transport',function(){
  var t_value=$(this).val();
   if(t_value=="Flight")
    {
       $(this).parents().siblings(".oflight").css("display","none")
       $(this).parents().parents().siblings(".flight").css("display","block")
    }
    else
    {
        $(this).parents().siblings(".oflight").css("display","block")
        $(this).parents().parents().siblings(".flight").css("display","none")
    }
})

//

//
$(document).on("click",".btn_enable",function(){


     var variable = $(this).html(); 
     var pak_id=$(this).val();

     if(variable=="Disable")
     {
      
     $(this).removeClass("btn-success");
     $(this).addClass("btn-danger");
     $(this).html("Enable")

       $.ajax({
                            type:'POST',
                             url: APP_URL+'/enable',
                           // dataType: 'json',
                            data: {status:'0',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
                                                                                                                 
     }
     else if(variable=="Enable")
     {

     $(this).removeClass("btn-danger");
     $(this).addClass("btn-success");
     $(this).html("Disable")

     $.ajax({
                            type:'POST',
                             url: APP_URL+'/disable',
                           // dataType: 'json',
                            data: {status:'1',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });

     }

    
     
})
//

$(document).on("click",".location_btn_enable",function(){

     var variable = $(this).html(); 
     var pak_id=$(this).val();

     if(variable=="Disable")
     {
      
     $(this).removeClass("btn-success");
     $(this).addClass("btn-danger");
     $(this).html("Enable")

       $.ajax({
                            type:'POST',
                             url: APP_URL+'/location_enable',
                           // dataType: 'json',
                            data: {status:'0',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
                                                                                                                 
     }
     else if(variable=="Enable")
     {

     $(this).removeClass("btn-danger");
     $(this).addClass("btn-success");
     $(this).html("Disable")

     $.ajax({
                            type:'POST',
                             url: APP_URL+'/location_disable',
                           // dataType: 'json',
                            data: {status:'1',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });

     }

    
     
})
//
$(document).on("click",".btn_front_enable",function(){


     var variable = $(this).html(); 
     var pak_id=$(this).val();

    

     if(variable=="Disable")
     {
      
     $(this).removeClass("btn-success");
     $(this).addClass("btn-danger");
     $(this).html("Enable")

       $.ajax({
                            type:'POST',
                             url: APP_URL+'/front_enable',
                           // dataType: 'json',
                            data: {status:'0',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
                                                                                                                 
     }
     else if(variable=="Enable")
     {

     $(this).removeClass("btn-danger");
     $(this).addClass("btn-success");
     $(this).html("Disable")

     $.ajax({
                            type:'POST',
                             url: APP_URL+'/front_disable',
                           // dataType: 'json',
                            data: {status:'1',pak_id:pak_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                              },    

                             error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });

     }

    
     
})

//
$(document).on('click','.price_add',function(){

    

    var id = $(this).data('id');

    var air_fare_adult=$('.'+id).children(".air_fare_adult").val()
    var air_fare_exadult=$('.'+id).children(".air_fare_exadult").val()
    var air_fare_childbed=$('.'+id).children(".air_fare_childbed").val()
    var air_fare_childwbed=$('.'+id).children(".air_fare_childwbed").val()
    var air_fare_infant=$('.'+id).children(".air_fare_infant").val()
    var air_fare_single=$('.'+id).children(".air_fare_single").val()

    var air_currency=$('.'+id).children(".air_currency").val()
    


    //
    
    var hotel_fare_adult=$('.'+id).children(".hotel_fare_adult").val()
    var hotel_fare_exadult=$('.'+id).children(".hotel_fare_exadult").val()
    var hotel_fare_childbed=$('.'+id).children(".hotel_fare_childbed").val()
    var hotel_fare_childwbed=$('.'+id).children(".hotel_fare_childwbed").val()
    var hotel_fare_infant=$('.'+id).children(".hotel_fare_infant").val()
    var hotel_fare_single=$('.'+id).children(".hotel_fare_single").val()
    var hotel_currency=$('.'+id).children(".hotel_currency").val()


    //
    var tour_fare_adult=$('.'+id).children(".tour_fare_adult").val()
    var tour_fare_exadult=$('.'+id).children(".tour_fare_exadult").val()
    var tour_fare_childbed=$('.'+id).children(".tour_fare_childbed").val()
    var tour_fare_childwbed=$('.'+id).children(".tour_fare_childwbed").val()
    var tour_fare_infant=$('.'+id).children(".tour_fare_infant").val()
    var tour_fare_single=$('.'+id).children(".tour_fare_single").val()
    var tour_currency=$('.'+id).children(".tour_currency").val()
    //
    var transfer_fare_adult=$('.'+id).children(".transfer_fare_adult").val()
    var transfer_fare_exadult=$('.'+id).children(".transfer_fare_exadult").val()
    var transfer_fare_childbed=$('.'+id).children(".transfer_fare_childbed").val()
    var transfer_fare_childwbed=$('.'+id).children(".transfer_fare_childwbed").val()
    var transfer_fare_infant=$('.'+id).children(".transfer_fare_infant").val()
    var transfer_fare_single=$('.'+id).children(".transfer_fare_single").val()
    var transfer_currency=$('.'+id).children(".transfer_currency").val()
    //
    var visa_fare_adult=$('.'+id).children(".visa_fare_adult").val()
    var visa_fare_exadult=$('.'+id).children(".visa_fare_exadult").val()
    var visa_fare_childbed=$('.'+id).children(".visa_fare_childbed").val()
    var visa_fare_childwbed=$('.'+id).children(".visa_fare_childwbed").val()
    var visa_fare_infant=$('.'+id).children(".visa_fare_infant").val()
    var visa_fare_single=$('.'+id).children(".visa_fare_single").val()
    var visa_currency=$('.'+id).children(".visa_currency").val()
    //
    var adult_fare=$('.'+id).children(".adult_fare").val()
    var adult_currency=$('.'+id).children(".adult_currency").val()
    var chiildbed_fare=$('.'+id).children(".chiildbed_fare").val()
    var chiildbed_currency=$('.'+id).children(".air_fare").val()
    var chiildwbed_fare=$('.'+id).children(".chiildwbed_fare").val()
    var chiildwbed_currency=$('.'+id).children(".chiildwbed_currency").val()
    var infant_fare=$('.'+id).children(".infant_fare").val()
    var infant_currency=$('.'+id).children(".infant_currency").val()
    var single_fare=$('.'+id).children(".single_fare").val()
    var single_currency=$('.'+id).children(".single_currency").val()
    //
    var adult_fare_total=$('.'+id).children(".adult_fare_total").val()
    var exadult_fare_total=$('.'+id).children(".exadult_fare_total").val()
    var childwithbed_fare_total=$('.'+id).children(".childwithbed_fare_total").val()
    var childwithoutbed_fare_total=$('.'+id).children(".childwithoutbed_fare_total").val()
    var infant_fare_total=$('.'+id).children(".infant_fare_total").val()
    var single_fare_total=$('.'+id).children(".single_fare_total").val()
   
    $('#price_add').modal('show');
    $('#price_add .price_class').val("").val(id);
    $('#price_add .modal-body').attr('id',id);
    



    if(air_currency>0)
    {
   
       $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/air_curr",
                        data:{air_currency:air_currency},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .a_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    


    
    }
    if(air_currency=="")
    {
     $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/all_curr",
                         //data:{duration_value:duration_value},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .a_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    

    
    
    }
    
    if(hotel_currency=="")
    {
       $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/all_curr",
                         //data:{duration_value:duration_value},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .h_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    
       
    }

    if(hotel_currency>0)
    {

          $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/hot_curr",
                        data:{air_currency:hotel_currency},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .h_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    

      
    }
    
    if(tour_currency>0)
    {
         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/tour_curr",
                        data:{air_currency:tour_currency},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .t_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });  

        

    }
    if(tour_currency=="")
    {

         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/all_curr",
                         //data:{duration_value:duration_value},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .t_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    


        

    }
    
    if(transfer_currency>0)
    {
         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/transfer_curr",
                        data:{air_currency:transfer_currency},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .to_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });  

       

    }
    if(transfer_currency=="")
    {
         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/all_curr",
                         //data:{duration_value:duration_value},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .to_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    

       

    }
    
    if(visa_currency>0)
    {

         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/visa_curr",
                        data:{air_currency:visa_currency},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .v_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });  
       
    }
    
    //total_fare_adult
     
    $.ajax({

        type:'POST',
        url:APP_URL+'/total_adult',
        data:{air_currency:air_currency,air_fare_adult:air_fare_adult,hotel_fare_adult:hotel_fare_adult,hotel_currency:hotel_currency,tour_currency:tour_currency,tour_fare_adult:tour_fare_adult,transfer_currency:transfer_currency,transfer_fare_adult:transfer_fare_adult,visa_currency:visa_currency,visa_fare_adult:visa_fare_adult},
        success:function(data)
        {
            if(data!="NA")
            {
             $('#price_add .adult_total').val("").val(data);
            }
        },
        error:function(data)
        {

        }
    })
   //total_fare_extra_adult
   
   $.ajax({
         type:'POST',
         url:APP_URL+'/total_extra_adult',
         data:{air_currency:air_currency,air_fare_exadult:air_fare_exadult,hotel_currency:hotel_currency,hotel_fare_exadult:hotel_fare_exadult,tour_currency:tour_currency,tour_fare_exadult:tour_fare_exadult,transfer_currency:transfer_currency,transfer_fare_exadult:transfer_fare_exadult,visa_currency:visa_currency,visa_fare_exadult:visa_fare_exadult},
         success:function(data)
         {
            $('#price_add .extraadult_total').val("").val(data)                     
         },
         error:function(data)
         {

         }
   })
   //total_child_with_bed
   $.ajax({
      type:'POST',
      url:APP_URL+'/total_child_with_bed',
      data:{air_currency:air_currency,air_fare_childbed:air_fare_childbed,hotel_currency:hotel_currency,hotel_fare_childbed:hotel_fare_childbed,tour_currency:tour_currency,tour_fare_childbed:tour_fare_childbed,transfer_currency:transfer_currency,transfer_fare_childbed:transfer_fare_childbed},
      success:function(data)
      {
       $('#price_add .childwithbed_total').val("").val(data);
      },
      error:function(data)
      {}
   })
   //total_child_without_bed
   $.ajax({
        type:'POST',
        url:APP_URL+'/total_child_without_bed',
        data:{air_currency:air_currency,air_fare_childwbed:air_fare_childwbed,hotel_currency:hotel_currency,hotel_fare_childwbed:hotel_fare_childwbed,tour_currency:tour_currency,tour_fare_childwbed:tour_fare_childwbed,transfer_currency:transfer_currency,transfer_fare_childwbed:transfer_fare_childwbed,visa_currency:visa_currency,visa_fare_childwbed:visa_fare_childwbed},
        success:function(data)
        {
           $('#price_add .childwithoutbed_total').val("").val(data);
        },
        error:function(data)
        {}
   })
   //total_infant
   $.ajax({
         type:'POST',
         url:APP_URL+'/total_infant',
         data:{air_currency:air_currency,air_fare_infant:air_fare_infant,hotel_currency:hotel_currency,hotel_fare_infant:hotel_fare_infant,tour_currency:tour_currency,tour_fare_infant:tour_fare_infant,transfer_currency:transfer_currency,transfer_fare_infant:transfer_fare_infant,visa_currency:visa_currency,visa_fare_infant:visa_fare_infant},
         success:function(data)
         {
           $('#price_add .infant_total').val("").val(data); 
         },
         error:function(data)
         {}
   })
   //total_single
   $.ajax({
         type:'POST',
         url:APP_URL+'/total_single',
         data:{air_currency:air_currency,air_fare_single:air_fare_single,hotel_currency:hotel_currency,hotel_fare_single:hotel_fare_single,tour_currency:tour_currency,tour_fare_single:tour_fare_single,transfer_currency:transfer_currency,transfer_fare_single:transfer_fare_single,visa_currency:visa_currency,visa_fare_single:visa_fare_single},
         success:function(data)
         {
           $('#price_add .single_total').val("").val(data);
         },
         error:function(data)
         {}
   })
    //
    if(visa_currency=="")
    {
         $.ajax({
                             
                        type:'POST',
                        url: APP_URL+"/all_curr",
                         //data:{duration_value:duration_value},   
                        success:function(data){
                         //console.log('success : '+data);   
                       $('#price_add .v_curr').html("").html(data);
                        },    
                        error: function (data) {         
                        //console.log('Error : '+data);
                          }       
                           
                        });    
       
    }
    if(air_fare_adult=="")
    {

        $('#price_add .airfare_adult').val("");

    }
    if(air_fare_adult>0)
    {

        $('#price_add .airfare_adult').val("").val(air_fare_adult);

    }
     if(air_fare_exadult=="")
    {

        $('#price_add .airfare_exadult').val("");

    }
    if(air_fare_exadult>0)
    {

        $('#price_add .airfare_exadult').val("").val(air_fare_exadult);

    }
     if(air_fare_childbed=="")
    {

        $('#price_add .airfare_childbed').val("");

    }
    if(air_fare_childbed>0)
    {

        $('#price_add .airfare_childbed').val("").val(air_fare_childbed);

    }
     if(air_fare_childwbed=="")
    {

        $('#price_add .airfare_childwbed').val("");

    }
    if(air_fare_childwbed>0)
    {

        $('#price_add .airfare_childwbed').val("").val(air_fare_childwbed);

    }
     if(air_fare_infant=="")
    {

        $('#price_add .airfare_infant').val("");

    }
    if(air_fare_infant>0)
    {

        $('#price_add .airfare_infant').val("").val(air_fare_infant);

    }
     if(air_fare_single=="")
    {

        $('#price_add .airfare_single').val("");

    }
    if(air_fare_single>0)
    {

        $('#price_add .airfare_single').val("").val(air_fare_single);

    }
    //
    if(hotel_fare_adult>0)
    {

        $('#price_add .hotelfare_adult').val("").val(hotel_fare_adult);

    }
    if(hotel_fare_adult=="")
    {

        $('#price_add .hotelfare_adult').val("");

    }
    if(hotel_fare_exadult>0)
    {

        $('#price_add .hotelfare_exadult').val("").val(hotel_fare_exadult);

    }
    if(hotel_fare_exadult=="")
    {

        $('#price_add .hotelfare_exadult').val("");

    }
    if(hotel_fare_childbed>0)
    {

        $('#price_add .hotelfare_childbed').val("").val(hotel_fare_childbed);

    }
    if(hotel_fare_childbed=="")
    {

        $('#price_add .hotelfare_childbed').val("");

    }
    if(hotel_fare_childwbed>0)
    {

        $('#price_add .hotelfare_childwbed').val("").val(hotel_fare_childwbed);

    }
    if(hotel_fare_childwbed=="")
    {

        $('#price_add .hotelfare_childwbed').val("");

    }
    if(hotel_fare_infant>0)
    {

        $('#price_add .hotelfare_infant').val("").val(hotel_fare_infant);

    }
    if(hotel_fare_infant=="")
    {

        $('#price_add .hotelfare_infant').val("");

    }
    if(hotel_fare_single>0)
    {

        $('#price_add .hotelfare_single').val("").val(hotel_fare_single);

    }
    if(hotel_fare_single=="")
    {

        $('#price_add .hotelfare_single').val("");

    }

    //
    if(tour_fare_adult>0)
    {

          $('#price_add .tourfare_adult').val("").val(tour_fare_adult);

    }
    if(tour_fare_adult=="")
    {

          $('#price_add .tourfare_adult').val("");

    }
    if(tour_fare_exadult>0)
    {

          $('#price_add .tourfare_exadult').val("").val(tour_fare_exadult);

    }
    if(tour_fare_exadult=="")
    {

          $('#price_add .tourfare_exadult').val("");

    }
    if(tour_fare_childbed>0)
    {

          $('#price_add .tourfare_childbed').val("").val(tour_fare_childbed);

    }
    if(tour_fare_childbed=="")
    {

          $('#price_add .tourfare_childbed').val("");

    }
    if(tour_fare_childwbed>0)
    {

          $('#price_add .tourfare_childwbed').val("").val(tour_fare_childwbed);

    }
    if(tour_fare_childwbed=="")
    {

          $('#price_add .tourfare_childwbed').val("");

    }
    if(tour_fare_infant>0)
    {

          $('#price_add .tourfare_infant').val("").val(tour_fare_infant);

    }
    if(tour_fare_infant=="")
    {

          $('#price_add .tourfare_infant').val("");

    }
    if(tour_fare_single>0)
    {

          $('#price_add .tourfare_single').val("").val(tour_fare_single);

    }
    if(tour_fare_single=="")
    {

          $('#price_add .tourfare_single').val("");

    }
    //
    if(transfer_fare_adult>0)
    {
        $('#price_add .transferfare_adult').val("").val(transfer_fare_adult);
    }
    if(transfer_fare_adult=="")
    {
        $('#price_add .transferfare_adult').val("");
    }
    if(transfer_fare_exadult>0)
    {
        $('#price_add .transferfare_exadult').val("").val(transfer_fare_exadult);
    }
    if(transfer_fare_exadult=="")
    {
        $('#price_add .transferfare_exadult').val("");
    }
    if(transfer_fare_childbed>0)
    {
        $('#price_add .transferfare_childbed').val("").val(transfer_fare_childbed);
    }
    if(transfer_fare_childbed=="")
    {
        $('#price_add .transferfare_childbed').val("");
    }
    if(transfer_fare_childwbed>0)
    {
        $('#price_add .transferfare_childwbed').val("").val(transfer_fare_childwbed);
    }
    if(transfer_fare_childwbed=="")
    {
        $('#price_add .transferfare_childwbed').val("");
    }
    if(transfer_fare_infant>0)
    {
        $('#price_add .transferfare_infant').val("").val(transfer_fare_infant);
    }
    if(transfer_fare_infant=="")
    {
        $('#price_add .transferfare_infant').val("");
    }
    if(transfer_fare_single>0)
    {
        $('#price_add .transferfare_single').val("").val(transfer_fare_single);
    }
    if(transfer_fare_single=="")
    {
        $('#price_add .transferfare_single').val("");
    }
    //
    if(visa_fare_adult>0)
    {

        $('#price_add .visafare_adult').val("").val(visa_fare_adult);

    }
    if(visa_fare_adult=="")
    {

        $('#price_add .visafare_adult').val("");

    }
    if(visa_fare_exadult>0)
    {

        $('#price_add .visafare_exadult').val("").val(visa_fare_exadult);

    }
    if(visa_fare_exadult=="")
    {

        $('#price_add .visafare_exadult').val("");

    }
    if(visa_fare_childbed>0)
    {

        $('#price_add .visafare_childbed').val("").val(visa_fare_childbed);

    }
    if(visa_fare_childbed=="")
    {

        $('#price_add .visafare_childbed').val("");

    }
    if(visa_fare_childwbed>0)
    {

        $('#price_add .visafare_childwbed').val("").val(visa_fare_childwbed);

    }
    if(visa_fare_childwbed=="")
    {

        $('#price_add .visafare_childwbed').val("");

    }
    if(visa_fare_infant>0)
    {

        $('#price_add .visafare_infant').val("").val(visa_fare_infant);

    }
    if(visa_fare_infant=="")
    {

        $('#price_add .visafare_infant').val("");

    }
    if(visa_fare_single>0)
    {

        $('#price_add .visafare_single').val("").val(visa_fare_single);

    }
    if(visa_fare_single=="")
    {

        $('#price_add .visafare_single').val("");

    }

   
})
//
$(document).on('keyup','.airfare_adult',function()
{
var airfare_adult  =$(this).val();

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()



var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected'); 
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")


var total=parseInt(airfare_adult*air_currency)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)

 
})

$(document).on('keyup','.hotelfare_adult',function()
{
var  hotelfare_adult=$(this).val();

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')
 
var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")


var total=parseInt(airfare_adult*air_currency)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)

 
})

$(document).on('keyup','.tourfare_adult',function()
{
var tourfare_adult =$(this).val();

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")



var total=parseInt(airfare_adult*air_currency)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)

 
})

$(document).on('keyup','.transferfare_adult',function()
{
var  transferfare_adult=$(this).val();

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")



var total=parseInt(airfare_adult*air_currency)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)

 
})

$(document).on('keyup','.visafare_adult',function()
{
var  visafare_adult =$(this).val();

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")



var total=parseInt(airfare_adult*air_currency)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total)

 
})

//adult end
$(document).on('keyup','.airfare_exadult',function()
{
var airfare_exadult  =$(this).val();

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})

$(document).on('keyup','.hotelfare_exadult',function()
{
var  hotelfare_exadult =$(this).val();

var airfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})

$(document).on('keyup','.tourfare_exadult',function()
{
var tourfare_exadult  =$(this).val();

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var airfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")



var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})

$(document).on('keyup','.transferfare_exadult',function()
{
var transferfare_exadult  =$(this).val();

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var airfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})

$(document).on('keyup','.visafare_exadult',function()
{
var visafare_exadult  =$(this).val();

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var airfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})

/*$(document).on('keyup','.airfare_exadult',function()
{
var airfare_exadult  =$(this).val();

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").val()
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").val()
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").val()
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").val()
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").val()

var total=parseInt(airfare_exadult*air_currency)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total)

 
})*/
//extra adult end
$(document).on('keyup','.airfare_childbed',function()
{
var airfare_childbed  =$(this).val();

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childbed*air_currency)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)

 
})


$(document).on('keyup','.hotelfare_childbed',function()
{
var hotelfare_childbed  =$(this).val();

var airfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childbed*air_currency)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)

 
})

$(document).on('keyup','.tourfare_childbed',function()
{
var tourfare_childbed  =$(this).val();

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var airfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childbed*air_currency)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)

 
})


$(document).on('keyup','.transferfare_childbed',function()
{
var transferfare_childbed  =$(this).val();

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var airfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childbed*air_currency)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)

 
})

$(document).on('keyup','.visafare_childbed',function()
{
var visafare_childbed  =$(this).val();

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var airfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childbed*air_currency)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total)

 
})
// child with bed end
$(document).on('keyup','.airfare_childwbed',function()
{
var airfare_childwbed  =$(this).val();

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childwbed*air_currency)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)

 
})

$(document).on('keyup','.hotelfare_childwbed',function()
{
var hotelfare_childwbed  =$(this).val();

var airfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childwbed*air_currency)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)

 
})
$(document).on('keyup','.tourfare_childwbed',function()
{
var tourfare_childwbed  =$(this).val();

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var airfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childwbed*air_currency)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)

 
})
$(document).on('keyup','.transferfare_childwbed',function()
{
var transferfare_childwbed  =$(this).val();

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var airfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childwbed*air_currency)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)

 
})
$(document).on('keyup','.visafare_childwbed',function()
{
var visafare_childwbed  =$(this).val();

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var airfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_childwbed*air_currency)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total)

 
})
//child without bed end
$(document).on('keyup','.airfare_infant',function()
{
var airfare_infant  =$(this).val();

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_infant*air_currency)+parseInt(hotelfare_infant*h_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)

 
})

$(document).on('keyup','.hotelfare_infant',function()
{
var hotelfare_infant  =$(this).val();

var airfare_infant=$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_infant*air_currency)+parseInt(hotelfare_infant*h_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)

 
})
$(document).on('keyup','.tourfare_infant',function()
{
var tourfare_infant  =$(this).val();

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var airfare_infant=$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_infant*air_currency)+parseInt(hotelfare_infant*h_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)

 
})
$(document).on('keyup','.transferfare_infant',function()
{
var transferfare_infant  =$(this).val();

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var airfare_infant=$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_infant*air_currency)+parseInt(hotelfare_infant*h_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)

 
})
$(document).on('keyup','.visafare_infant',function()
{
var visafare_infant  =$(this).val();

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var airfare_infant=$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_infant*air_currency)+parseInt(hotelfare_infant*h_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total)

 
})
//infant end
$(document).on('keyup','.airfare_single',function()
{
var airfare_single  =$(this).val();

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_single*air_currency)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)

 
})

$(document).on('keyup','.hotelfare_single',function()
{
var hotelfare_single  =$(this).val();

var airfare_single=$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_single*air_currency)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)

 
})
$(document).on('keyup','.tourfare_single',function()
{
var tourfare_single  =$(this).val();

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var airfare_single=$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_single*air_currency)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)

 
})
$(document).on('keyup','.transferfare_single',function()
{
var transferfare_single  =$(this).val();

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var airfare_single=$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_single*air_currency)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)

 
})
$(document).on('keyup','.visafare_single',function()
{
var visafare_single  =$(this).val();

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var airfare_single=$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()


var air_currency=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var air_currency=air_currency.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var total=parseInt(airfare_single*air_currency)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total)

 
})
//
$(document).on('change','.a_curr',function()
{
var a_curr=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var a_curr=a_curr.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()

var total1=parseInt(airfare_adult*a_curr)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr);


$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)


var airfare_exadult =$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()



var total2=parseInt(airfare_exadult*a_curr)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)


var airfare_childbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()



var total3=parseInt(airfare_childbed*a_curr)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)


var airfare_childwbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()



var total4=parseInt(airfare_childwbed*a_curr)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)

var airfare_infant  =$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()



var total5=parseInt(airfare_infant*a_curr)+parseInt(hotelfare_infant*a_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)

var airfare_single  =$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()



var total6=parseInt(airfare_single*a_curr)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)


})
//air currency end
$(document).on('change','.h_curr',function()
{
var a_curr=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var a_curr=a_curr.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()

var total1=parseInt(airfare_adult*a_curr)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr);


$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)


var airfare_exadult =$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()



var total2=parseInt(airfare_exadult*a_curr)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)


var airfare_childbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()



var total3=parseInt(airfare_childbed*a_curr)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)


var airfare_childwbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()



var total4=parseInt(airfare_childwbed*a_curr)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)

var airfare_infant  =$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()



var total5=parseInt(airfare_infant*a_curr)+parseInt(hotelfare_infant*a_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)

var airfare_single  =$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()



var total6=parseInt(airfare_single*a_curr)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)


})
//hotel currency end
$(document).on('change','.t_curr',function()
{
var a_curr=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var a_curr=a_curr.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()

var total1=parseInt(airfare_adult*a_curr)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr);


$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)


var airfare_exadult =$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()



var total2=parseInt(airfare_exadult*a_curr)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)


var airfare_childbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()



var total3=parseInt(airfare_childbed*a_curr)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)


var airfare_childwbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()



var total4=parseInt(airfare_childwbed*a_curr)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)

var airfare_infant  =$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()



var total5=parseInt(airfare_infant*a_curr)+parseInt(hotelfare_infant*a_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)

var airfare_single  =$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()



var total6=parseInt(airfare_single*a_curr)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)


})
//tour currency end
$(document).on('change','.to_curr',function()
{
var a_curr=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").find('option:selected')
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var a_curr=a_curr.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()

var total1=parseInt(airfare_adult*a_curr)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr);


$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)


var airfare_exadult =$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()



var total2=parseInt(airfare_exadult*a_curr)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)


var airfare_childbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()



var total3=parseInt(airfare_childbed*a_curr)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)


var airfare_childwbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()



var total4=parseInt(airfare_childwbed*a_curr)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)

var airfare_infant  =$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()



var total5=parseInt(airfare_infant*a_curr)+parseInt(hotelfare_infant*a_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)

var airfare_single  =$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()



var total6=parseInt(airfare_single*a_curr)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)


})
//transfer currency end
$(document).on('change','.v_curr',function()
{
var a_curr=$(this).parent().parent().parent().children("tr").children().children(".a_curr").find('option:selected')
var h_curr=$(this).parent().parent().parent().children("tr").children().children(".h_curr").find('option:selected')
var t_curr=$(this).parent().parent().parent().children("tr").children().children(".t_curr").val()
var to_curr=$(this).parent().parent().parent().children("tr").children().children(".to_curr").find('option:selected')
var v_curr=$(this).parent().parent().parent().children("tr").children().children(".v_curr").find('option:selected')

var a_curr=a_curr.attr("c_val")
var h_curr=h_curr.attr("c_val")
var t_curr=t_curr.attr("c_val")
var to_curr=to_curr.attr("c_val")
var v_curr=v_curr.attr("c_val")

var airfare_adult=$(this).parent().parent().parent().children("tr").children().children(".airfare_adult").val()

var hotelfare_adult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_adult").val()
var tourfare_adult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_adult").val()
var transferfare_adult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_adult").val()
var visafare_adult=$(this).parent().parent().parent().children("tr").children().children(".visafare_adult").val()

var total1=parseInt(airfare_adult*a_curr)+parseInt(hotelfare_adult*h_curr)+parseInt(tourfare_adult*t_curr)+parseInt(transferfare_adult*to_curr)+parseInt(visafare_adult*v_curr);


$(this).parent().parent().parent().children("tr").children().children(".adult_total").val("").val(total1)


var airfare_exadult =$(this).parent().parent().parent().children("tr").children().children(".airfare_exadult").val()

var hotelfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_exadult").val()
var tourfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".tourfare_exadult").val()
var transferfare_exadult=$(this).parent().parent().parent().children("tr").children().children(".transferfare_exadult").val()
var visafare_exadult=$(this).parent().parent().parent().children("tr").children().children(".visafare_exadult").val()



var total2=parseInt(airfare_exadult*a_curr)+parseInt(hotelfare_exadult*h_curr)+parseInt(tourfare_exadult*t_curr)+parseInt(transferfare_exadult*to_curr)+parseInt(visafare_exadult*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".extraadult_total").val("").val(total2)


var airfare_childbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childbed").val()

var hotelfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childbed").val()
var tourfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childbed").val()
var transferfare_childbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childbed").val()
var visafare_childbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childbed").val()



var total3=parseInt(airfare_childbed*a_curr)+parseInt(hotelfare_childbed*h_curr)+parseInt(tourfare_childbed*t_curr)+parseInt(transferfare_childbed*to_curr)+parseInt(visafare_childbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithbed_total").val("").val(total3)


var airfare_childwbed  =$(this).parent().parent().parent().children("tr").children().children(".airfare_childwbed").val()

var hotelfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_childwbed").val()
var tourfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".tourfare_childwbed").val()
var transferfare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".transferfare_childwbed").val()
var visafare_childwbed=$(this).parent().parent().parent().children("tr").children().children(".visafare_childwbed").val()



var total4=parseInt(airfare_childwbed*a_curr)+parseInt(hotelfare_childwbed*h_curr)+parseInt(tourfare_childwbed*t_curr)+parseInt(transferfare_childwbed*to_curr)+parseInt(visafare_childwbed*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".childwithoutbed_total").val("").val(total4)

var airfare_infant  =$(this).parent().parent().parent().children("tr").children().children(".airfare_infant").val()

var hotelfare_infant=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_infant").val()
var tourfare_infant=$(this).parent().parent().parent().children("tr").children().children(".tourfare_infant").val()
var transferfare_infant=$(this).parent().parent().parent().children("tr").children().children(".transferfare_infant").val()
var visafare_infant=$(this).parent().parent().parent().children("tr").children().children(".visafare_infant").val()



var total5=parseInt(airfare_infant*a_curr)+parseInt(hotelfare_infant*a_curr)+parseInt(tourfare_infant*t_curr)+parseInt(transferfare_infant*to_curr)+parseInt(visafare_infant*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".infant_total").val("").val(total5)

var airfare_single  =$(this).parent().parent().parent().children("tr").children().children(".airfare_single").val()

var hotelfare_single=$(this).parent().parent().parent().children("tr").children().children(".hotelfare_single").val()
var tourfare_single=$(this).parent().parent().parent().children("tr").children().children(".tourfare_single").val()
var transferfare_single=$(this).parent().parent().parent().children("tr").children().children(".transferfare_single").val()
var visafare_single=$(this).parent().parent().parent().children("tr").children().children(".visafare_single").val()



var total6=parseInt(airfare_single*a_curr)+parseInt(hotelfare_single*h_curr)+parseInt(tourfare_single*t_curr)+parseInt(transferfare_single*to_curr)+parseInt(visafare_single*v_curr)
$(this).parent().parent().parent().children("tr").children().children(".single_total").val("").val(total6)


})
//

$("#submit_price").click(function(){

    var class_value=$(this).parent().siblings(".modal-body").children(".price_class").val()
    
    var airfare_adult=$('#'+class_value+'  .airfare_adult').val();
    var airfare_exadult=$('#'+class_value+'  .airfare_exadult').val();
    var airfare_childbed=$('#'+class_value+'  .airfare_childbed').val();
    var airfare_childwbed=$('#'+class_value+'  .airfare_childwbed').val();
    var airfare_infant=$('#'+class_value+'  .airfare_infant').val();
    var airfare_single=$('#'+class_value+'  .airfare_single').val();
    var aircurrency=$('#'+class_value+'  .a_curr').val();

    var aircurrency_value=$('#'+class_value+'  .a_curr').find('option:selected');
    var aircurrency_value=aircurrency_value.attr('c_val');
    

    //
    var hotelcurrency=$('#'+class_value+'  .h_curr').val();
    var hotelfare_adult=$('#'+class_value+'  .hotelfare_adult').val();
    var hotelfare_exadult=$('#'+class_value+'  .hotelfare_exadult').val();
    var hotelfare_childbed=$('#'+class_value+'  .hotelfare_childbed').val();
    var hotelfare_childwbed=$('#'+class_value+'  .hotelfare_childwbed').val();
    var hotelfare_infant=$('#'+class_value+'  .hotelfare_infant').val();
    var hotelfare_single=$('#'+class_value+'  .hotelfare_single').val();

    var hotel_value=$('#'+class_value+'  .h_curr').find('option:selected');
    var hotel_value=hotel_value.attr('c_val');


    //
    var tourcurrency=$('#'+class_value+'  .t_curr').val();
    var tourfare_adult=$('#'+class_value+'  .tourfare_adult').val();
    var tourfare_exadult=$('#'+class_value+'  .tourfare_exadult').val();
    var tourfare_childbed=$('#'+class_value+'  .tourfare_childbed').val();
    var tourfare_childwbed=$('#'+class_value+'  .tourfare_childwbed').val();
    var tourfare_infant=$('#'+class_value+'  .tourfare_infant').val();
    var tourfare_single=$('#'+class_value+'  .tourfare_single').val();

    var tourcurrency_value=$('#'+class_value+'  .t_curr').find('option:selected');
    var tourcurrency_value=tourcurrency_value.attr('c_val');
    //
    var transfercurrency=$('#'+class_value+'  .to_curr').val();
    var transferfare_adult=$('#'+class_value+'  .transferfare_adult').val();
    var transferfare_exadult=$('#'+class_value+'  .transferfare_exadult').val();
    var transferfare_childbed=$('#'+class_value+'  .transferfare_childbed').val();
    var transferfare_childwbed=$('#'+class_value+'  .transferfare_childwbed').val();
    var transferfare_infant=$('#'+class_value+'  .transferfare_infant').val();
    var transferfare_single=$('#'+class_value+'  .transferfare_single').val();

    var transfercurrency_value=$('#'+class_value+'  .to_curr').find('option:selected');
    var transfercurrency_value=transfercurrency_value.attr('c_val');
    //
    var visacurrency=$('#'+class_value+'  .v_curr').val();
    var visafare_adult=$('#'+class_value+'  .visafare_adult').val();
    var visafare_exadult=$('#'+class_value+'  .visafare_exadult').val();
    var visafare_childbed=$('#'+class_value+'  .visafare_childbed').val();
    var visafare_childwbed=$('#'+class_value+'  .visafare_childwbed').val();
    var visafare_infant=$('#'+class_value+'  .visafare_infant').val();
    var visafare_single=$('#'+class_value+'  .visafare_single').val();

    var visacurrency_value=$('#'+class_value+'  .v_curr').find('option:selected');
    var visacurrency_value=visacurrency_value.attr('c_val');
    //
    var adult_total=$('#'+class_value+'  .adult_total').val();
    var extraadult_total=$('#'+class_value+'  .extraadult_total').val();
    var childwithbed_total=$('#'+class_value+'  .childwithbed_total').val();
    var childwithoutbed_total=$('#'+class_value+'  .childwithoutbed_total').val();
    var infant_total=$('#'+class_value+'  .infant_total').val();
    var single_total=$('#'+class_value+'  .single_total').val();
    
    
    
    $('#'+class_value).children(".air_fare_adult").val("").val(airfare_adult)
    $('#'+class_value).children(".air_fare_exadult").val("").val(airfare_exadult)
    $('#'+class_value).children(".air_fare_childbed").val("").val(airfare_childbed)
    $('#'+class_value).children(".air_fare_childwbed").val("").val(airfare_childwbed)
    $('#'+class_value).children(".air_fare_infant").val("").val(airfare_infant)
    $('#'+class_value).children(".air_fare_single").val("").val(airfare_single)
    $('#'+class_value).children(".air_currency").val("").val(aircurrency)
    //
    $('#'+class_value).children(".hotel_currency").val("").val(hotelcurrency)
    $('#'+class_value).children(".hotel_fare_adult").val("").val(hotelfare_adult)
    $('#'+class_value).children(".hotel_fare_exadult").val("").val(hotelfare_exadult)
    $('#'+class_value).children(".hotel_fare_childbed").val("").val(hotelfare_childbed)
    $('#'+class_value).children(".hotel_fare_childwbed").val("").val(hotelfare_childwbed)
    $('#'+class_value).children(".hotel_fare_infant").val("").val(hotelfare_infant)
    $('#'+class_value).children(".hotel_fare_single").val("").val(hotelfare_single)
    //
    $('#'+class_value).children(".tour_currency").val("").val(tourcurrency)
    $('#'+class_value).children(".tour_fare_adult").val("").val(tourfare_adult)
    $('#'+class_value).children(".tour_fare_exadult").val("").val(tourfare_exadult)
    $('#'+class_value).children(".tour_fare_childbed").val("").val(tourfare_childbed)
    $('#'+class_value).children(".tour_fare_childwbed").val("").val(tourfare_childwbed)
    $('#'+class_value).children(".tour_fare_infant").val("").val(tourfare_infant)
    $('#'+class_value).children(".tour_fare_single").val("").val(tourfare_single)
    //
    $('#'+class_value).children(".transfer_currency").val("").val(transfercurrency)
    $('#'+class_value).children(".transfer_fare_adult").val("").val(transferfare_adult)
    $('#'+class_value).children(".transfer_fare_exadult").val("").val(transferfare_exadult)
    $('#'+class_value).children(".transfer_fare_childbed").val("").val(transferfare_childbed)
    $('#'+class_value).children(".transfer_fare_childwbed").val("").val(transferfare_childwbed)
    $('#'+class_value).children(".transfer_fare_infant").val("").val(transferfare_infant)
    $('#'+class_value).children(".transfer_fare_single").val("").val(transferfare_single)
    //
    $('#'+class_value).children(".visa_currency").val("").val(visacurrency)
    $('#'+class_value).children(".visa_fare_adult").val("").val(visafare_adult)
    $('#'+class_value).children(".visa_fare_exadult").val("").val(visafare_exadult)
    $('#'+class_value).children(".visa_fare_childbed").val("").val(visafare_childbed)
    $('#'+class_value).children(".visa_fare_childwbed").val("").val(visafare_childwbed)
    $('#'+class_value).children(".visa_fare_infant").val("").val(visafare_infant)
    $('#'+class_value).children(".visa_fare_single").val("").val(visafare_single)
    //
    $('#'+class_value).children(".adult_fare_total").val("").val(adult_total)
    $('#'+class_value).children(".exadult_fare_total").val("").val(extraadult_total)
    $('#'+class_value).children(".childwithbed_fare_total").val("").val(childwithbed_total)
    $('#'+class_value).children(".childwithoutbed_fare_total").val("").val(childwithoutbed_total)
    $('#'+class_value).children(".infant_fare_total").val("").val(infant_total)
    $('#'+class_value).children(".single_fare_total").val("").val(single_total)
  
  

    
   



})
 /*$('[data-dismiss=modal]').on('click', function (e) {
    var $t = $(this),
        target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

  $(target)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})*/
//
  $(document).ready(function() {
    
       
      var i = 1;

      var rowCount = $('.packagePricing tr').length;
      if(rowCount > 2){
          i = rowCount - 1;
      }else{
          i = 1;
      }
    
      $('#add-price-row').click(function() {
      //var name_count=$("#dynamic_field .form-control:last").attr("name").slice(6,7)
      var name_count1=$("#dynamic_field tr:last").attr("id").slice(3)
      var name_count=parseInt(name_count1)-"1";
      name_count1++
      name_count++
      //alert(name_count)
       // $('#dynamic_field').append('<tr id="row' + i + '"><td><select name="Price['+ name_count +'][package_rating]" id="rating' + name_count + '" class="form-control" style="width: 90px"> </select></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price['+ name_count +'][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price['+ name_count +'][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td> <div class="input-group" style="margin-bottom:5px;"> <span class="input-group-addon"> <select name="Price['+ name_count +'][currency]" id="currency' + name_count + '">  </select> </span> <input name="Price['+ name_count +'][airfare]" class="form-control" placeholder="Enter Airfare"> </div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][hotel]" class="form-control" placeholder="Enter Hotel Fare"></div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][tour_transfer]" class="form-control" placeholder="Enter Tour & Transfer Fare"></div></td><td><div class="input-group" style="margin-bottom:5px;"><input name="Price['+ name_count +'][total]" class="form-control" placeholder="Total Fare"></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    $('#dynamic_field').append('<tr id="row' + name_count1 + '"><td><select name="Price['+ name_count +'][package_rating]" id="rating' + name_count + '" class="form-control" style="width: 90px"> </select></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price['+ name_count +'][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price['+ name_count +'][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td><input type="number" value="0" name="Price['+ name_count +'][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days"></td><td><div class="c_price' + name_count + '" id="c_price' + name_count + '"><input type="hidden" name="Price[' + name_count + '][airfare_adult]" value="" class="air_fare_adult"><input type="hidden" name="Price[' + name_count + '][airfare_exadult]" value="" class="air_fare_exadult"><input type="hidden" name="Price[' + name_count + '][airfare_childbed]" value="" class="air_fare_childbed"><input type="hidden" name="Price[' + name_count + '][airfare_childwbed]" value="" class="air_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][airfare_infant]" value="" class="air_fare_infant"><input type="hidden" name="Price[' + name_count + '][airfare_single]" value="" class="air_fare_single"><input type="hidden" name="Price[' + name_count + '][aircurrency]" value="" class="air_currency"><input type="hidden" name="Price[' + name_count + '][hotelfare_adult]" value="" class="hotel_fare_adult"><input type="hidden" name="Price[' + name_count + '][hotelfare_exadult]" value="" class="hotel_fare_exadult"><input type="hidden" name="Price[' + name_count + '][hotelfare_childbed]" value="" class="hotel_fare_childbed"><input type="hidden" name="Price[' + name_count + '][hotelfare_childwbed]" value="" class="hotel_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][hotelfare_infant]" value="" class="hotel_fare_infant"><input type="hidden" name="Price[' + name_count + '][hotelfare_single]" value="" class="hotel_fare_single"><input type="hidden" name="Price[' + name_count + '][hotelcurrency]" value="" class="hotel_currency"><input type="hidden" name="Price[' + name_count + '][tourfare_adult]" value="" class="tour_fare_adult"><input type="hidden" name="Price[' + name_count + '][tourfare_exadult]" value="" class="tour_fare_exadult"><input type="hidden" name="Price[' + name_count + '][tourfare_childbed]" value="" class="tour_fare_childbed"><input type="hidden" name="Price[' + name_count + '][tourfare_childwbed]" value="" class="tour_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][tourfare_infant]" value="" class="tour_fare_infant"><input type="hidden" name="Price[' + name_count + '][tourfare_single]" value="" class="tour_fare_single"><input type="hidden" name="Price[' + name_count + '][tourcurrency]" value="" class="tour_currency"><input type="hidden" name="Price[' + name_count + '][transferfare_adult]" value="" class="transfer_fare_adult"><input type="hidden" name="Price[' + name_count + '][transferfare_exadult]" value="" class="transfer_fare_exadult"><input type="hidden" name="Price[' + name_count + '][transferfare_childbed]" value="" class="transfer_fare_childbed"><input type="hidden" name="Price[' + name_count + '][transferfare_childwbed]" value="" class="transfer_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][transferfare_infant]" value="" class="transfer_fare_infant"><input type="hidden" name="Price[' + name_count + '][transferfare_single]" value="" class="transfer_fare_single"><input type="hidden" name="Price[' + name_count + '][transfercurrency]" value="" class="transfer_currency"><input type="hidden" name="Price[' + name_count + '][visafare_adult]" value="" class="visa_fare_adult"><input type="hidden" name="Price[' + name_count + '][visafare_exadult]" value="" class="visa_fare_exadult"><input type="hidden" name="Price[' + name_count + '][visafare_childbed]" value="" class="visa_fare_childbed"><input type="hidden" name="Price[' + name_count + '][visafare_childwbed]" value="" class="visa_fare_childwbed"><input type="hidden" name="Price[' + name_count + '][visafare_infant]" value="" class="visa_fare_infant"><input type="hidden" name="Price[' + name_count + '][visafare_single]" value="" class="visa_fare_single"><input type="hidden" name="Price[' + name_count + '][visacurrency]" value="" class="visa_currency"><input type="hidden" name="Price[' + name_count + '][adult_fare_total]" value="" class="adult_fare_total"><input type="hidden" name="Price[' + name_count + '][exadult_fare_total]" value="" class="exadult_fare_total"><input type="hidden" name="Price[' + name_count + '][childwithbed_fare_total]" value="" class="childwithbed_fare_total"><input type="hidden" name="Price[' + name_count + '][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total"><input type="hidden" name="Price[' + name_count + '][infant_fare_total]" value="" class="infant_fare_total"><input type="hidden" name="Price[' + name_count + '][single_fare_total]" value="" class="single_fare_total"></div><button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="c_price' + name_count + '">Add Price</button></td><td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove">X</button></td></tr>');
         
      
           
           $(".datepicker").datepicker();
           

           var id=name_count;
             $.ajax({
                            type:'POST',
                             url: APP_URL+'/packagerating_url',
                           // dataType: 'json',
                            //data: {type:'domestic',selected:country},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                $('#rating' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
              $.ajax({
                            type:'POST',
                             url: APP_URL+'/currency_url',
                           // dataType: 'json',
                            //data: {type:'domestic',selected:country},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                $('#currency' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });







        i++;
        }
      );
//
$("#add_upcoming_price_row").click(function(){
  var name_count1=$("#dynamic_field_upcoming tr:last").attr("id").slice(6)
  var name_count=parseInt(name_count1)-"1";
  name_count1++
  name_count++
   $('#dynamic_field_upcoming').append('<tr id="up_row' + name_count1 + '"><td><select name="Price_upcoming['+ name_count +'][package_rating]" id="rating_upcoming' + name_count + '" class="form-control" style="width: 90px"> </select></td><td> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input name="Price_upcoming['+ name_count +'][datefrom]" class="form-control pull-right datepicker" type="text"> </div></td><td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i> </div><input name="Price_upcoming['+ name_count +'][dateto]" class="form-control pull-right datepicker" type="text"></div></td><td><input type="number" value="0" name="Price_upcoming['+ name_count +'][cuttoffpoint]" class="form-control" placeholder="Cutt Off Days"></td><td><div class="cup_price' + name_count + '" id="cup_price' + name_count + '"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_adult]" value="" class="air_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_exadult]" value="" class="air_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_childbed]" value="" class="air_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_childwbed]" value="" class="air_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_infant]" value="" class="air_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][airfare_single]" value="" class="air_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][aircurrency]" value="" class="air_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_adult]" value="" class="hotel_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_exadult]" value="" class="hotel_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_childbed]" value="" class="hotel_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_childwbed]" value="" class="hotel_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_infant]" value="" class="hotel_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelfare_single]" value="" class="hotel_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][hotelcurrency]" value="" class="hotel_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_adult]" value="" class="tour_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_exadult]" value="" class="tour_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_childbed]" value="" class="tour_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_childwbed]" value="" class="tour_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_infant]" value="" class="tour_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][tourfare_single]" value="" class="tour_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][tourcurrency]" value="" class="tour_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_adult]" value="" class="transfer_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_exadult]" value="" class="transfer_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_childbed]" value="" class="transfer_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_childwbed]" value="" class="transfer_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_infant]" value="" class="transfer_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][transferfare_single]" value="" class="transfer_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][transfercurrency]" value="" class="transfer_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_adult]" value="" class="visa_fare_adult"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_exadult]" value="" class="visa_fare_exadult"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_childbed]" value="" class="visa_fare_childbed"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_childwbed]" value="" class="visa_fare_childwbed"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_infant]" value="" class="visa_fare_infant"><input type="hidden" name="Price_upcoming[' + name_count + '][visafare_single]" value="" class="visa_fare_single"><input type="hidden" name="Price_upcoming[' + name_count + '][visacurrency]" value="" class="visa_currency"><input type="hidden" name="Price_upcoming[' + name_count + '][adult_fare_total]" value="" class="adult_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][exadult_fare_total]" value="" class="exadult_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][childwithbed_fare_total]" value="" class="childwithbed_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][childwithoutbed_fare_total]" value="" class="childwithoutbed_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][infant_fare_total]" value="" class="infant_fare_total"><input type="hidden" name="Price_upcoming[' + name_count + '][single_fare_total]" value="" class="single_fare_total"></div><button type="button" class="btn btn-info btn-lg price_add" data-toggle="modal" data-id="cup_price' + name_count + '">Add Price</button></td><td><button type="button" name="remove" id="' + name_count1 + '" class="btn btn-danger btn_remove_up">X</button></td></tr>');
     
     $(".datepicker").datepicker(); 

     var id=name_count;
             $.ajax({
                            type:'POST',
                             url: APP_URL+'/packagerating_url',
                           // dataType: 'json',
                            //data: {type:'domestic',selected:country},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                $('#rating_upcoming' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
})
//
$(document).on('click', '.btn_remove_up', function() {
      var button_id = $(this).attr("id");
      $('#up_row' + button_id + '').remove();
      }
      );
//
      $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
      }
      );
      //
 $(document).on('change','.quo_hotel',function(){
  
  var hotel_val=$(this).val();
  if(hotel_val=="other")
  {
   $(this).parents().siblings(".other_hotel").css("display","block")
   $(this).parents().siblings(".other_hotel").children("input").focus()
   var sel_option=$(this).parents().siblings(".add_star").children("select")
    sel_option.html('').html('<option selected='+"true"+'>select</option><option value='+"other"+'>Other</option>');
  }
  else
  {
   $(this).parents().siblings(".other_hotel").css("display","none") 
   $(this).parents().siblings(".other_star").css("display","none") 
    var sel_option=$(this).parents().siblings(".add_star").children("select")
    $.ajax({
    type:'POST',
    url: APP_URL+'/add_hotel_star',
                           // dataType: 'json',
    data: {id:hotel_val},
                 success:function(data){
                 //console.log('Sucess : '+data);
                                
                   
  sel_option.html('').html('<option value='+"other"+'>Other</option><option selected>'+data+'</option>')
                  
                              
                }, 
                error: function (data) {
                //console.log('Error : '+data);
                 
                }
                }); 
  }

 })    
 //
 $(document).on('change','.quo_star',function(){
  
  var star_val=$(this).val();
  if(star_val=="other")
  {
   $(this).parents().siblings(".other_star").css("display","block")
   $(this).parents().siblings(".other_star").children("input").focus()
  }
  else
  {
   $(this).parents().siblings(".other_star").css("display","none") 
  }

 }) 
 //
 $(".extra_acc").click(function(){
    var value=$(this).val();
   if(value=="normal_acc")
   {
  $(".accommodation_main").css("display","block")
  $(".accommodation_extra").css("display","none")
   }
   else if(value=="extra_acc")
   {
   $(".accommodation_main").css("display","none")
  $(".accommodation_extra").css("display","block")
   }
 })
 //
 $("#add_acco_tours").click(function(){
    var days=$("#package_durations").val();
    var days=parseInt(days)+parseInt(1);
   
    var id=$(".dynamic_acc").children(":last").attr("id");
    var id1=$(".dynamic_acc").children(":last").attr("id");
    id++

   $(".dynamic_acc").append("<div class='field"+id+"' id="+id+"><hr><div class='row'><div class='col-md-4'><label>Select Days</label><select class='select_day select2 form-control days_select"+id+"' multiple name='accommodation["+id+"][day][]'></select></div><div class='col-md-4'><label>city</label><input type='text' name='accommodation["+id+"][city]' class='query_city form-control' placeholder='City'></div><div class='col-md-4'><label>Choose Hotel Manually or from TripAdvisor</label><select class='form-control' name='accommodation["+id+"][trip]'><option>--Select--</option><option>Manually</option> <option>TripAdvisor</option> </select></div><div class='col-md-4'><label>Choose Hotel</label><select class='form-control quo_hotel add_hotel_query"+id+"' name='accommodation["+id+"][hotel]'></select></div><div class='col-md-4 other_hotel' style='display: none;'><label>Enter Hotel</label><input type='text' class='form-control' name='accommodation["+id+"][other_hotel]' placeholder='Hotel Name'></div><div class='col-md-4 add_star'><label>Choose Star Rating</label><select class='form-control quo_star' name='accommodation["+id+"][star]'></select></div><div class='col-md-4 other_star' style='display: none;'><label>Enter Star Rating</label><input type='text' class='form-control' name='accommodation["+id+"][star_other]' placeholder='Hotel Star Rating'></div><div class='col-md-2'><label>Room Category</label><input type='text' placeholder='Room Category'  class='form-control' name='accommodation["+id+"][category]'></div><div class='col-md-2'><button type='button' name='add'  id='"+id+"' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button> </div></div></div>  ")

 $('.select2').select2(); 

 var select_day=[];
   $('.select_day').each(function() {
    select_day.push($(this).val());
  
});




$.ajax({
    type:'POST',
    url:APP_URL+'/querys_days',
    data:{days:days,select_day:select_day},
    success:function(data)
    {
       
   $('.dynamic_acc .days_select'+id+'').html("").html(data)
    },
    error:function(data)
    {

    }
})

})
 //
$("#add_acco").click(function(){
    var days=$(this).attr("days")
   
    var id=$(".dynamic_acc").children(":last").attr("id");
    var id1=$(".dynamic_acc").children(":last").attr("id");
    id++

   $(".dynamic_acc").append("<div class='field"+id+"' id="+id+"><hr><div class='row'><div class='col-md-4'><label>Select Days</label><select class='select_day select2 form-control days_select"+id+"' multiple name='accommodation["+id+"][day][]'></select></div><div class='col-md-4'><label>city</label><input type='text' name='accommodation["+id+"][city]' class='query_city form-control' placeholder='City'></div><div class='col-md-4'><label>Choose Hotel Manually or from TripAdvisor</label><select class='form-control' name='accommodation["+id+"][trip]'><option>--Select--</option><option>Manually</option> <option>TripAdvisor</option> </select></div><div class='col-md-4'><label>Choose Hotel</label><select class='form-control quo_hotel add_hotel_query"+id+"' name='accommodation["+id+"][hotel]'></select></div><div class='col-md-4 other_hotel' style='display: none;'><label>Enter Hotel</label><input type='text' class='form-control' name='accommodation["+id+"][other_hotel]' placeholder='Hotel Name'></div><div class='col-md-4 add_star'><label>Choose Star Rating</label><select class='form-control quo_star' name='accommodation["+id+"][star]'></select></div><div class='col-md-4 other_star' style='display: none;'><label>Enter Star Rating</label><input type='text' class='form-control' name='accommodation["+id+"][star_other]' placeholder='Hotel Star Rating'></div><div class='col-md-4'><label>Room Category</label><input type='text' placeholder='Room Category'  class='form-control' name='accommodation["+id+"][category]'></div><div class='col-md-4'><label>Hotel Website Link</label><input type='text' placeholder='Hotel Website Link'  class='form-control' name='accommodation["+id+"][hotel_link]'></div><div class='col-md-2'><button type='button' name='add'  id='"+id+"' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button> </div></div></div>  ")

$('.select2').select2(); 

 var select_day=[];
   $('.select_day').each(function() {
    select_day.push($(this).val());
  
});




$.ajax({
    type:'POST',
    url:APP_URL+'/querys_days',
    data:{days:days,select_day:select_day},
    success:function(data)
    {
       
   $('.dynamic_acc .days_select'+id+'').html("").html(data)
    },
    error:function(data)
    {

    }
})

})
//
$("#option2_add_acco").click(function(){
    var days=$(this).attr("days")

    var id=$(".option2_dynamic_acc").children(":last").attr("id");
    var id1=$(".option2_dynamic_acc").children(":last").attr("id");
    id++
$(".option2_dynamic_acc").append("<div class='field"+id+"' id="+id+"><hr><div class='row'><div class='col-md-4'><label>Select Days</label><select class='select_day select2 form-control days_select"+id+"' multiple name='accommodation["+id+"][day][]'></select></div><div class='col-md-4'><label>city</label><input type='text' name='accommodation["+id+"][city]' class='query_city form-control' placeholder='City'></div><div class='col-md-4'><label>Choose Hotel Manually or from TripAdvisor</label><select class='form-control' name='accommodation["+id+"][trip]'><option>--Select--</option><option>Manually</option> <option>TripAdvisor</option> </select></div><div class='col-md-4'><label>Choose Hotel</label><select class='form-control quo_hotel add_hotel_query"+id+"' name='accommodation["+id+"][hotel]'></select></div><div class='col-md-4 other_hotel' style='display: none;'><label>Enter Hotel</label><input type='text' class='form-control' name='accommodation["+id+"][other_hotel]' placeholder='Hotel Name'></div><div class='col-md-4 add_star'><label>Choose Star Rating</label><select class='form-control quo_star' name='accommodation["+id+"][star]'></select></div><div class='col-md-4 other_star' style='display: none;'><label>Enter Star Rating</label><input type='text' class='form-control' name='accommodation["+id+"][star_other]' placeholder='Hotel Star Rating'></div><div class='col-md-4'><label>Room Category</label><input type='text' placeholder='Room Category'  class='form-control' name='accommodation["+id+"][category]'></div><div class='col-md-4'><label>Hotel Website Link</label><input type='text' placeholder='Hotel Website Link'  class='form-control' name='accommodation["+id+"][hotel_link]'></div><div class='col-md-2'><button type='button' name='add'  id='"+id+"' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button> </div></div></div>  ")

 
$('.select2').select2(); 

 var select_day=[];
   $('.select_day').each(function() {
    select_day.push($(this).val());
  
});




$.ajax({
    type:'POST',
    url:APP_URL+'/querys_days',
    data:{days:days,select_day:select_day},
    success:function(data)
    {
       
   $('.option2_dynamic_acc .days_select'+id+'').html("").html(data)
    },
    error:function(data)
    {

    }
})
})
//
$("#option3_add_acco").click(function(){
    var days=$(this).attr("days")

    var id=$(".option3_dynamic_acc").children(":last").attr("id");
    var id1=$(".option3_dynamic_acc").children(":last").attr("id");
    id++
$(".option3_dynamic_acc").append("<div class='field"+id+"' id="+id+"><hr><div class='row'><div class='col-md-4'><label>Select Days</label><select class='select_day select2 form-control days_select"+id+"' multiple name='accommodation["+id+"][day][]'></select></div><div class='col-md-4'><label>city</label><input type='text' name='accommodation["+id+"][city]' class='query_city form-control' placeholder='City'></div><div class='col-md-4'><label>Choose Hotel Manually or from TripAdvisor</label><select class='form-control' name='accommodation["+id+"][trip]'><option>--Select--</option><option>Manually</option> <option>TripAdvisor</option> </select></div><div class='col-md-4'><label>Choose Hotel</label><select class='form-control quo_hotel add_hotel_query"+id+"' name='accommodation["+id+"][hotel]'></select></div><div class='col-md-4 other_hotel' style='display: none;'><label>Enter Hotel</label><input type='text' class='form-control' name='accommodation["+id+"][other_hotel]' placeholder='Hotel Name'></div><div class='col-md-4 add_star'><label>Choose Star Rating</label><select class='form-control quo_star' name='accommodation["+id+"][star]'></select></div><div class='col-md-4 other_star' style='display: none;'><label>Enter Star Rating</label><input type='text' class='form-control' name='accommodation["+id+"][star_other]' placeholder='Hotel Star Rating'></div><div class='col-md-4'><label>Room Category</label><input type='text' placeholder='Room Category'  class='form-control' name='accommodation["+id+"][category]'></div><div class='col-md-4'><label>Hotel Website Link</label><input type='text' placeholder='Hotel Website Link'  class='form-control' name='accommodation["+id+"][hotel_link]'></div><div class='col-md-2'><button type='button' name='add'  id='"+id+"' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button> </div></div></div>  ")

 
$('.select2').select2(); 

 var select_day=[];
   $('.select_day').each(function() {
    select_day.push($(this).val());
  
});




$.ajax({
    type:'POST',
    url:APP_URL+'/querys_days',
    data:{days:days,select_day:select_day},
    success:function(data)
    {
       
   $('.option3_dynamic_acc .days_select'+id+'').html("").html(data)
    },
    error:function(data)
    {

    }
})
})
//
$("#option4_add_acco").click(function(){
    var days=$(this).attr("days")

    var id=$(".option4_dynamic_acc").children(":last").attr("id");
    var id1=$(".option4_dynamic_acc").children(":last").attr("id");
    id++
$(".option4_dynamic_acc").append("<div class='field"+id+"' id="+id+"><hr><div class='row'><div class='col-md-4'><label>Select Days</label><select class='select_day select2 form-control days_select"+id+"' multiple name='accommodation["+id+"][day][]'></select></div><div class='col-md-4'><label>city</label><input type='text' name='accommodation["+id+"][city]' class='query_city form-control' placeholder='City'></div><div class='col-md-4'><label>Choose Hotel Manually or from TripAdvisor</label><select class='form-control' name='accommodation["+id+"][trip]'><option>--Select--</option><option>Manually</option> <option>TripAdvisor</option> </select></div><div class='col-md-4'><label>Choose Hotel</label><select class='form-control quo_hotel add_hotel_query"+id+"' name='accommodation["+id+"][hotel]'></select></div><div class='col-md-4 other_hotel' style='display: none;'><label>Enter Hotel</label><input type='text' class='form-control' name='accommodation["+id+"][other_hotel]' placeholder='Hotel Name'></div><div class='col-md-4 add_star'><label>Choose Star Rating</label><select class='form-control quo_star' name='accommodation["+id+"][star]'></select></div><div class='col-md-4 other_star' style='display: none;'><label>Enter Star Rating</label><input type='text' class='form-control' name='accommodation["+id+"][star_other]' placeholder='Hotel Star Rating'></div><div class='col-md-4'><label>Room Category</label><input type='text' placeholder='Room Category'  class='form-control' name='accommodation["+id+"][category]'></div><div class='col-md-4'><label>Hotel Website Link</label><input type='text' placeholder='Hotel Website Link'  class='form-control' name='accommodation["+id+"][hotel_link]'></div><div class='col-md-2'><button type='button' name='add'  id='"+id+"' class='remove_acco btn btn-danger' style='margin-top:23px'>x Remove</button> </div></div></div>  ")

$('.select2').select2(); 

 var select_day=[];
   $('.select_day').each(function() {
    select_day.push($(this).val());
  
});




$.ajax({
    type:'POST',
    url:APP_URL+'/querys_days',
    data:{days:days,select_day:select_day},
    success:function(data)
    {
       
   $('.option4_dynamic_acc .days_select'+id+'').html("").html(data)
    },
    error:function(data)
    {

    }
})

})
//add_hotel_query
 /*$.ajax({
                             
    type:'POST',
    url: APP_URL+"/dayItineraryhotel",
                           
    success:function(data)
    {
    $('.add_hotel_query'+id+'').html("").html(data+"<option value='other'>Other</option>")
    }, 
    error: function (data) 
    {
                                  
                               
    }
}); */
//




$(document).on('keyup','.query_city',function(){

var city_name=$(this).val()
var hotel_class=$(this).parent().siblings().children(".quo_hotel")
var city_value= $(".query_city").map(function() {
   return $(this).val();
}).get();

$(this).typeahead({
    source: function (city_name, process) {
        return $.get(APP_URL+"/autocomplete", { city_name: city_name }, function (data) {
            return process(data);
        });
    }
});
//
// $.ajax({
                             
//     type:'get',
//     data:{city_name:city_name},
//     url: APP_URL+"/autocomplete",
                           
//     success:function(data)
//     {
//      console.log(data)  
//     //$(".custom_days").html("").html(data)
    
//     }, 
//     error: function (data) 
//     {
                                  
                               
//     }
// });
//

$.ajax({
                             
    type:'POST',
    data:{city_value:city_value},
    url: APP_URL+"/sort_tour_bycity",
                           
    success:function(data)
    {
       
    $(".custom_days").html("").html(data)
    
    }, 
    error: function (data) 
    {
                                  
                               
    }
}); 
//
$.ajax({
                             
    type:'POST',
    data:{city_name:city_name},
    url: APP_URL+"/query_hotel_name",
                           
    success:function(data)
    {
  
    hotel_class.html("").html("<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>"+data+"<option value='other'>Other</option>")
    }, 
    error: function (data) 
    {
                                  
                               
    }
}); 

})

/*
$.ajax({
    type:'POST',
    url: APP_URL+'/add_hotel_star',
                          
    data: {id:hotel_id},
    success:function(data){
    console.log('Sucess : '+data);
                                
                   
                 
                  
                              
    }, 
    error: function (data) {
    //console.log('Error : '+data);
                 
    }
    });  

*/
//
 $(document).on('click', '.remove_acco', function() {
      var button_id = $(this).attr("id");
      $('.field' + button_id + '').remove();
      }
      );

 // 

      //
      /*
      $(".hotel").parent().parent().siblings().children(".input-group.total_value").children("input.form-control.total:text").val("846132")
      */
     // var lastSel = $("#package_durations option:selected");
       
$("#package_durations").change(function(){
 var count_ite=($('.dayItinerary').length+1);
 var row_count=$('.remove').length;        
 var dd_value=$(this).val();
 $(".select_day").html("")
 var m;
 var select_day_data="";
   for(m = 1 ; m<=parseInt(dd_value)+parseInt("1");m++)              
        {                      
    $(".select_day").append(`<option value="Day ${m}">Day 
                                       ${m} 
                                  </option>`); 
        }   
        
 if(dd_value<row_count)         
  {
   alert("not allowed")        
  }        
 var d_value=$(this).val();         
 var i;           
  if(d_value>=count_ite)      
   {     
    var d_value1=parseInt(dd_value)+parseInt("1");    
    for(i = count_ite ; i<=d_value1;i++)       
    {     
    $('#Itinerary').append('<div class="panel-body c_body"> <div class="row"><div class="col-md-12"><div class="table-responsive"><div class="col-md-12 dayItinerary day1" ><div class="row"><label class="col-md-12">Day '+i+' :<input type="text" name="dayItinerary[day'+i+'][title]" placeholder="Day Title" style="height: 35px;width: 93%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;"></label></div><div class="col-md-6"><div class="form-group"> <label >Meal Plan</label><select name="dayItinerary[day'+i+'][meal_plan]" class="form-control"><option value="N">NO Select</option><option value="EP">Room Only</option><option value="CP">Breakfast</option><option value="lu">Lunch</option><option value="di">Dinner</option><option value="bd">Breakfast & Dinner </option><option value="bl">Breakfast & Lunch </option><option value="ld">Lunch & Dinner</option><option value="bld">Breakfast & Lunch/Dinner </option><option value="bldall">Breakfast, Lunch & Dinner</option><option value="MAP"> All Inclusive </option></select></div></div><div class="col-md-6"><div class=" form-group "><label >Included Tours</label><select class="select2 form-control custom_days dayItinerarytour'+i+'" name="dayItinerary[day'+i+'][tours][]" multiple> </option> </select></div></div><div class="col-md-12"><div class="form-group"><label for="">Description</label><textarea class="form-control ckeditor" rows="3" name="dayItinerary[day'+i+'][desc]" ></textarea></div></div></div></div></div></div>  </div>');
           CKEDITOR.replace( 'dayItinerary[day'+i+'][desc]'); 
    }       
   /* $.ajax({
        type:'POST',
        url: APP_URL+"/dayItineraryhotel",     
        // dataType: 'json', 
        //data:{duration_value:duration_value},           
        success:function(data){
        //console.log('Sucess : '+data,);
        for(i = count_ite ; i<=d_value1;i++)                  
        {                      
        $('.dayItineraryhotel'+ i + '').html('').html(data);
        }                                       
        },
        error: function (data) {                         
        //console.log('Error : '+data);                    
        }                     
        }); */                   
  /*  $.ajax({                              
        type:'POST',                       
        url: APP_URL+"/dayItinerarytour",                    
        // dataType: 'json',                 
        //data:{duration_value:duration_value},
        success:function(data){                  
        //console.log('Sucess : '+data,);                     
        for(i = count_ite ; i<=d_value1;i++)                     
        { 
        $('.dayItinerarytour'+ i + '').html('').html(data);
        }                     
        }, 
        error: function (data)                    
        {                    
        //console.log('Error : '+data);                     
        }                          
        }); */  

        var city_value= $(".query_city").map(function() {
   return $(this).val();
}).get();

//
$.ajax({
                             
    type:'POST',
    data:{city_value:city_value},
    url: APP_URL+"/sort_tour_bycity",
                           
    success:function(data)
    {
       
    $(".custom_days").html("").html(data)
    
    }, 
    error: function (data) 
    {
                                  
                               
    }
}); 
//                     
        }
        else
        {                    
    $(".c_body").remove();                    
    var d_value1=parseInt(d_value)+parseInt("1");
    for(i = 1 ; i<=d_value1;i++)          
    {
   $('#Itinerary').append('<div class="panel-body c_body"> <div class="row"><div class="col-md-12"><div class="table-responsive"><div class="col-md-12 dayItinerary day1" ><div class="row"><label class="col-md-12">Day '+i+' :<input type="text" name="dayItinerary[day'+i+'][title]" placeholder="Day Title" style="height: 35px;width: 93%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;"></label></div><div class="col-md-6"><div class="form-group"> <label >Meal Plan</label><select name="dayItinerary[day'+i+'][meal_plan]" class="form-control"><option value="N">NO Select</option><option value="EP">Room Only</option><option value="CP">Breakfast</option><option value="lu">Lunch</option><option value="di">Dinner</option><option value="bd">Breakfast & Dinner </option><option value="bl">Breakfast & Lunch </option><option value="ld">Lunch & Dinner</option><option value="bld">Breakfast & Lunch/Dinner </option><option value="bldall">Breakfast, Lunch & Dinner</option><option value="MAP"> All Inclusive </option></select></div></div><div class="col-md-6"><div class=" form-group "><label >Included Tours</label><select class="select2 form-control custom_days dayItinerarytour'+i+'" name="dayItinerary[day'+i+'][tours][]" multiple> </option> </select></div></div><div class="col-md-12"><div class="form-group"><label for="">Description</label><textarea class="form-control ckeditor" rows="3" name="dayItinerary[day'+i+'][desc]" ></textarea></div></div></div></div></div></div>  </div>');
       CKEDITOR.replace( 'dayItinerary[day'+i+'][desc]');        
    }     
    var city_value= $(".query_city").map(function() {
   return $(this).val();
}).get();

//
$.ajax({
                             
    type:'POST',
    data:{city_value:city_value},
    url: APP_URL+"/sort_tour_bycity",
                           
    success:function(data)
    {
       
    $(".custom_days").html("").html(data)
    
    }, 
    error: function (data) 
    {
                                  
                               
    }
});        
    /*$.ajax({    
        type:'POST', 
        url: APP_URL+"/dayItineraryCity", 
        // dataType: 'json', 
        //data:{duration_value:duration_value},   
        success:function(data){                     
        //console.log('Sucess : '+data,);
        for(i = 1 ; i<=d_value1;i++)                     
        {                      
        $('.dayItineraryCity'+ i + '').html('').html(data);
                                             
        }
        },                  
        error: function (data) {                         
        //console.log('Error : '+data);                    
        }                     
        });                     
    $.ajax({                              
        type:'POST',                       
        url: APP_URL+"/dayItineraryhotel",                    
        // dataType: 'json',                 
        //data:{duration_value:duration_value},
        success:function(data){                  
        //console.log('Sucess : '+data,);                     
        for(i = 1 ; i<=d_value1;i++)                     
        {                     
        $('.dayItineraryhotel'+ i + '').html('').html(data);
        }                                     
        },                    
        error: function (data) {
        //console.log('Error : '+data);                    
        }                        
        }); 
    $.ajax({
        type:'POST',                  
        url: APP_URL+"/dayItinerarytour",                     
        // dataType: 'json',                     
        //data:{duration_value:duration_value},                     
        success:function(data){                   
        //console.log('Sucess : '+data,);                    
        for(i = 1 ; i<=d_value1;i++)
        {                    
        $('.dayItinerarytour'+ i + '').html('').html(data);                        
        }
        },                        
        error: function (data) {                    
        //console.log('Error : '+data);                   
        }                 
        });*/                    
        }                         
        $('.select2').select2();                     
                      
                                            
   })                                         
                                            
                                                                
                                              
 $(document).on("click",".customn_package_hotel",function(e){

e.preventDefault()
$("#pk_aadhotel #success-add_pkhotel").css("display","none");
$("#pk_aadhotel #error-add_pkhotel").css("display","none");
$("#pk_aadhotel #hotelname").val("");
$("#pk_aadhotel #location").val("");


 })                                                               
                                              
 $(document).on("click","#add_package_hotel",function(e){

e.preventDefault()

var hotelname=$("#hotelname").val();
var location=$("#location").val();
var star_rating=$("#star_rating").val();

       
$.ajax({
    type:'POST',
    url: APP_URL+'/add_package_hotel',
                           // dataType: 'json',
    data: {hotelname:hotelname,location:location,star_rating:star_rating},
                 success:function(data){
                 console.log('Sucess : '+data);
                                
                   
                  $("#success-add_pkhotel").css("display","block"); 
                  $('.package_hot_add').append(data);
                  
                              
                }, 
                error: function (data) {
                //console.log('Error : '+data);
                 $("#error-add_pkhotel").css("display","block");           
                }
                });
       
       
 })                                               
                      
        
$(document).on("change",".package_hot_add",function(){

    var hotel_id=$(this).val();
   var add_star=$(this).parent().parent().siblings(".h_star").children().children(".add_star");
    
    $.ajax({
    type:'POST',
    url: APP_URL+'/add_hotel_star',
                           // dataType: 'json',
    data: {id:hotel_id},
                 success:function(data){
                 console.log('Sucess : '+data);
                                
                   
                 $(add_star).val(data)
                  
                              
                }, 
                error: function (data) {
                //console.log('Error : '+data);
                 
                }
                });  


})
        



      
     


    //continent-add
       var j=1;
     $("#add-continent-row").click(function() {
     var continent_name=$("#dynamic_field_package .remove:last .form-control").attr("name").slice(10,11);
     continent_name++
     var row_count=$('.remove').length;
     var limit=$('#package_durations').val();

     if(row_count<limit)
    
    {   

        $("#dynamic_field_package").append

        ("<div class='row remove'><div class='col-md-12'><div class='col-md-2 form-group'><label for='continent'>Continent</label><select name='continent["+continent_name+"]' id='continent' class='form-control continent' ><option value='Asia'>Asia</option><option value='Africa'>Africa</option><option value='Antarctica'>Antarctica</option><option value='Australia'>Australia</option><option value='Europe'>Europe</option><option value='North America'>North America</option><option value='South America'>South America</option></select></div><div class='col-md-2 form-group'><label for='country'>Country</label><select name='country["+continent_name+"]' id='package_dest_countries"+continent_name+"' class='form-control  package_dest_country' onchange='myFunction(this)'><option value='0'></option></select></div><div class='col-md-2 form-group'><label for='state'>State</label><select name='state["+continent_name+"]' id='package_dest_state"+continent_name+"' class='form-control package_dest_countries"+continent_name+"' onchange='sateFunction(this)'></select></div><div class='col-md-2 form-group'><label for='city'>City</label><select name='city["+continent_name+"]' id='package_dest_city' class='form-control package_dest_state"+continent_name+" city_package_dest_countries"+continent_name+"  min-select' onchange='cityFunction(this)'></select></div><div class='col-md-2 form-group'><label for='No. Of Night'>No. Of Days/Nights</label><select name='days["+continent_name+"]' id='package_dest_days' class='form-control select2 package_dest_days'></select></div><div class='col-md-2 form-group'><button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin: 18px 10px 0px 0px'>Remove</button></div></div></div></div>  ");
         

          

         var days_option=$(".val").val();
        // var class_length=$(".remove").length;
         //var val_count=(days_option/class_length);
           var options = '';
          for( var i=1 ; i<=days_option; i++){
            options +='<option value="'+i+'">'+i+' Nights /'+(i+1)+' Days </option>';
        }
     
     
        $('.package_dest_days').html(' ').html(options);
        // var class_country=".package_dest_country"+j;
        //alert(class_country)
        var id=continent_name;
        //alert(id)

        $.ajax({
                            type:'POST',
                             url: APP_URL+'/country_url',
                           // dataType: 'json',
                            //data: {type:'domestic',selected:country},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $('#package_dest_countries' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });




      j++;
  }
  else
  {
   alert("Number of Rows cannot be Greater than Night")
  }


     });


   $(document).on('click', '.remove-continent-row', function() {
       
        var x = $(this).parent().parent().parent();

        $(x).remove();  
      }
      );


    //

    $(".location_add").click(function(){

            $.ajax({
                            type:'post',
                             url: APP_URL+'/location_data',
                           // dataType: 'json',
                           // data: {location_name:"country_id"},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                       
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        });

   
    })
    
   //

  $(".addcountry").change(function(){


    
    var country_id=$(this).val();


    
     $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_url1',
                           // dataType: 'json',
                            data: {country_id:country_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $('#addstate').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        });




  })
      
    //


    //country status handling

    $('.countryStatus').click(function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('lang');
       // alert($(this).attr('data-id'));
        $.ajax({
            type:'POST',
             url: APP_URL+'/set-country-status',
           // dataType: 'json',
            data: {status:status,id:id},
            success:function(data){

                if(data == 'TRUE'){

                    location.reload();
                }
                //console.log('Sucess : '+data);
                
               
              
            }, 
            error: function (data) {
                  //console.log('Error : '+data);
               
            }
        });


    });  

    //Multi City Location Day Schedule
    $('#package_location_city').on('change',function(){

        var count=0;
        
        var options = '';
        $("#package_location_city option:selected").each(function () {
            var $this = $(this);
            count++;
            if ($this.length) {
                var selText = $this.text();
                var selVal = $this.val();
                options +='<option value="'+selVal+'">'+selText+'</option>';  
            }
            
            });
          
          // alert(count);
           
           var scheduleOptions = '<div class="col-md-6 form-group"><label for="duration">Location</label><select name="locationSed[]" id="" class="form-control package_multi_sechdule_city"></select></div><div class="col-md-6 form-group"><label for="duration">Duration</label><select name="durationSed[]" id="" class="form-control package_multi_sechdule_days"></select></div>';
           var scheduleOptionsList = '';

           for(var j=0 ; j<count ;j++){

            scheduleOptionsList +=scheduleOptions;

           }

           $('#dayscheduleDiv').html(' ').html(scheduleOptionsList);
           $('.package_multi_sechdule_city').html(' ').html(options);

           $('.dayItineraryCity').html(' ').html(options);




    });

    $('#package_durations').on('change',function(){
        var options = '';
        for( var i=1 ; i<=$(this).val() ; i++){
            options +='<option value="'+i+'">'+i+' Nights</option>';
        }

     //alert(options);
        $('.package_multi_sechdule_days').html(' ').html(options);
        
    });   

   $('#package_durations').on('change',function(){
        var options = '';
        for( var i=1 ; i<=$(this).val() ; i++){
            options +='<option value="'+i+'">'+i+' Nights /'+(i+1)+' Days </option>';
        }

     //alert(options);
        $('.package_dest_days').html(' ').html(options);
        
    });  



    $("#add-tour").click(function(e){

     e.preventDefault();
     
     var tour_name=$("#tour_name").val();
     var tour_description=$("#tour_description").val();
     var tour_location=$("#tour_location").val();
     var tour_status=$("#tour_status").val();
       
        $.ajax({
                type:'POST',
                url: APP_URL+'/add-tour-custom',
                           // dataType: 'json',
                data: {name:tour_name,description:tour_description,location:tour_location,status:tour_status},
                success:function(data){
                //console.log('Sucess : '+data);
                                
                   
                  $("#success-add").css("display","block"); 
                  $('#tour_add').html('').html(data);

                              
                }, 
                error: function (data) {
                //console.log('Error : '+data);
                               
                }
                });
       
       

    
      
    })    


});
//ckeditor start
 $(document).ready(function(){
    $('.custom_border input[type="text"]').keyup(function(){
        var name =$(this).attr("name");
        var value =$(this).val();
        //var file_name =e.target.files[0].name;
         $.ajax({
                            type:'POST',
                             url: APP_URL+'/dest_add',
                           // dataType: 'json',
                            data: {value:value,name:name},
                            success:function(data){
                                console.log('Sucess : '+data);
                                
                             
                              
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
       
       
   
       

 })
})


//ckeditor start

init_paymentpolicy();
init_cancelpolicy();
init_visapolicy();
init_package_category();
init_package_dist_city()
function init_paymentpolicy(){

     var condition = '';
            var id='';
            $(".paymentMethods").each(function(){
             if($(this).is(':checked')){
                condition += $(this).val();
                condition += '\n';
                id +=$(this).attr('lang');
                id +=',';

            }
            });
           $('#payment_policies').val(condition);
           $('#payment_policies_input').val(id);
}

function init_visapolicy(){
    
         var condition = '';
                var id='';
                $(".visaMethods").each(function(){
                 if($(this).is(':checked')){
                    condition += $(this).val();
                    condition += '\n';
                    id +=$(this).attr('lang');
                    id +=',';
    
                }
                });
               $('#visa_policies').val(condition);
               $('#visa_policies_input').val(id);
    }

function init_cancelpolicy(){

    var conditionC = '';
            var idC = '';
            $(".cancellation").each(function(){
             if($(this).is(':checked')){
                conditionC += $(this).val();
                conditionC += '\n';
                idC +=$(this).attr('lang');
                idC +=',';
            }
            });
           $('#cancle_policy').val(conditionC);
           $('#cancellation_input_field').val(idC);
}



function init_package_category(){

    var category = $('#category').val();
    var country = $('#package_country').val().split(',');
    if(category=='international'){
       
                        $.ajax({
                            type:'POST',
                             url: APP_URL+'/get-country',
                           // dataType: 'json',
                            data: {type:'international',selected:country},
                            success:function(data){
                                //console.log('Sucess : '+data);
                                
                                $('#package_dest_country').html('').html(data);
                              
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
        
                    }else{
        
                        $.ajax({
                            type:'POST',
                             url: APP_URL+'/get-country',
                           // dataType: 'json',
                            data: {type:'domestic',selected:country},
                            success:function(data){
                                //console.log('Sucess : '+data,);
            
                                $('#package_dest_country').html('').html(data);
                              
                            }, 
                            error: function (data) {
                                  //console.log('Error : '+data);
                               
                            }
                        });
        
                    }
        
}


function init_package_dist_city(){
   
    var country = $('#package_country').val().split(',');
    var city = $('#package_country_city').val().split(',');

    $.ajax({
        type:'POST',
         url: APP_URL+'/get-locations',
       // dataType: 'json',
        data: {state:country,selected:city,cotegory:$('#category').val()},
        success:function(data){
            //console.log('Sucess : '+data);

            $('#package_location_city').html('').html(data);
          
        }, 
        error: function (data) {
              //console.log('Error : '+data);
           
        }
    });


    

}
//



//



function myFunction(selectObject)
{
    var c_id=$('option:selected', selectObject).attr('c_id');
    var country_id  = c_id;  
    var id  = selectObject.id;  
    var city_blank="city_"+id;
     
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_url',
                           // dataType: 'json',
                            data: {country_id:country_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $('.' + city_blank + '').html('<option>Select City</option>');
                        $('.' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })
}

function sateFunction(selectValue)
{
    var s_id=$('option:selected', selectValue).val()
    var state_id  = s_id;

    var id  = selectValue.id;  
  
  
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/city_url',
                           // dataType: 'json',
                            data: {state_id:state_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $('.' + id + '').html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })


}
//gallery part
function getstate(selectObject)
{
   var country_value=$(".gallery_country").val();
   //var state_value=$(".gallery_state").val();
   //var city_value=$(".gallery_city").val();
  var search_by_name=$(".search_by_name").val();


  $.ajax({
                            type:'POST',
                             url: APP_URL+'/country_sorting',
                           // dataType: 'json',
                            data: {country:country_value,search_by_name:search_by_name},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $("#gallery_sorting").html('').html(data);
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })


   //
    var c_id=$('option:selected', selectObject).attr('c_id');
    var country_id  = c_id;  
    var id  = selectObject.id;  
    var city_blank="city_"+id;
     
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_url',
                           // dataType: 'json',
                            data: {country_id:country_id},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $('.gallery_city').html('<option>Select City</option>');
                        $(".gallery_state").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })
}


function getcity(selectValue)
{

var country_value=$(".gallery_country").val();
var state_value=$(".gallery_state").val();
   //var city_value=$(".gallery_city").val();
var search_by_name=$(".search_by_name").val();
  
  $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_sorting',
                           // dataType: 'json',
                            data: {country:country_value,state:state_value,search_by_name:search_by_name},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $("#gallery_sorting").html('').html(data);
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })








    //
    var s_id=$('option:selected', selectValue).val()
    var state_id  = s_id;

    var id  = selectValue.id;  
  
  
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/city_url',
                           // dataType: 'json',
                            data: {state_id:state_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $(".gallery_city").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })


}

//
function getcity_value(selectValue)
{

var country_value=$(".gallery_country").val();
var state_value=$(".gallery_state").val();
var city_value=$(".gallery_city").val();
var search_by_name=$(".search_by_name").val();  
  $.ajax({
                            type:'POST',
                             url: APP_URL+'/city_sorting',
                           // dataType: 'json',
                            data: {country:country_value,state:state_value,city:city_value,search_by_name:search_by_name},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $("#gallery_sorting").html('').html(data);
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })








    


}
//


function get_states(selectObject)
{
   
    var c_id=$('option:selected', selectObject).attr('c_id');
    var country_id  = c_id;  
   
     
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_url',
                           // dataType: 'json',
                            data: {country_id:country_id},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $('.ct_values').html('<option>Select City</option>');
                        $(".st_values").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })
}

function getcitys(selectValue)
{






    //
    var s_id=$('option:selected', selectValue).val()
    var state_id  = s_id;

    var id  = selectValue.id;  
  
  
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/city_url',
                           // dataType: 'json',
                            data: {state_id:state_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $(".ct_values").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })


}


//
function get_state(selectObject)
{
   
    var c_id=$('option:selected', selectObject).attr('c_id');
    var country_id  = c_id;  
    var id  = selectObject.id;  
    var city_blank="city_"+id;
     
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/state_url',
                           // dataType: 'json',
                            data: {country_id:country_id},

                            success:function(data){
                                //console.log('Sucess : '+data,);

                                 //alert(class_country);

                        $('.city_val').html('<option>Select City</option>');
                        $(".state_val").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })
}
function get_city(selectValue)
{

    var s_id=$('option:selected', selectValue).val()
    var state_id  = s_id;
   
    var id  = selectValue.id;  
  
    
   $.ajax({
                            type:'POST',
                             url: APP_URL+'/city_url',
                           // dataType: 'json',
                            data: {state_id:state_id},

                            success:function(data){
                                console.log('Sucess : '+data,);

                                 //alert(class_country);

            
                        $(".city_val").html('').html(data);
                             
                                 
                            
                            }, 
                            error: function (data) {
                                  console.log('Error : '+data);
                               
                            }
                        })


}

//
function cityFunction(){

    

 var values = [];
$("select.min-select").each(function(i, sel){
    var selectedVal = $(sel).val();
    values.push(selectedVal);
    
});

var length=values.length;
var i;
var data=""
for(i=0;i<length;i++)
{
data+="<option value="+values[i]+">"+values[i]+"</option>"

}


$(".dayItineraryCity").html(data);



}
