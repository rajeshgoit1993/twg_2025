<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Version : 1.0
            </div>
            <!-- Default to the left -->
             @if(env("WEBSITENAME")==1)
             <strong>Copyright © 2019 The World Gateway</strong> 
             @elseif(env("WEBSITENAME")==0)
             <strong>Copyright © 2019 Rapidex Travels</strong> 
             @endif
            All rights reserved.
        </footer>
    </div><!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.3 -->
    <script src='{{ asset ("/resources/assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js") }}'></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src='{{ asset ("/resources/assets/admin-lte/bootstrap/js/bootstrap.min.js") }}' type="text/javascript"></script>
    <script src='{{ asset ("/resources/assets/admin-lte/dist/js/select2.js") }}' type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src='{{ asset ("/resources/assets/admin-lte/dist/js/app.min.js") }}' type="text/javascript"></script>
    <script src='{{ asset ("/resources/assets/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}' type="text/javascript"></script>
    <script src='{{ asset ("/resources/assets/admin-lte/plugins/datatables/dataTables.bootstrap.min.js") }}' type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src='{{ asset ("/resources/assets/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}' type="text/javascript"></script>
    <!-- FastClick -->
    <script src='{{ asset ("/resources/assets/admin-lte/plugins/fastclick/fastclick.js") }}' type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src='{{ asset ("/resources/assets/admin-lte/dist/js/demo.js") }}' type="text/javascript"></script>
   
    <script src='https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js' type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js' type="text/javascript"></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js' type="text/javascript"></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js' type="text/javascript"></script>
    <script src='https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js' type="text/javascript"></script>
    <script src='https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js' type="text/javascript"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnT6ewhJpccffkJRlbAPyCQeQKJxJfLQ8&libraries=places"></script>
	<script src='{{ asset ("/resources/assets/frontend/js/bootstrap-formhelpers.min.js") }}'></script>
	<script src='https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js' type="text/javascript"></script>
 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
	<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	<script src='{{ asset ("/resources/assets/js/hotel/hotel.js") }}' type="text/javascript"></script>
	<script src='{{ asset ("/resources/assets/js/room/room.js") }}' type="text/javascript"></script>
	<script type="text/javascript" src='{{ asset ("/resources/assets/admin-lte/ckeditor/ckeditor.js") }}'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.js"></script>
	<script src='{{ asset ("/resources/assets/js/packages/packages.js") }}' type="text/javascript"></script>
	<script src='{{ asset ("/resources/assets/js/packages/query.js") }}' type="text/javascript"></script>
	<!--<script src='{{ asset ("/resources/assets/admin-lte/dist/js/select2.js") }}' type="text/javascript"></script> -->
    <!-- Optionally, you can add Slimscroll and FastClick plugins.Both of these plugins are recommended to enhance the user experience -->

  


@yield("custom_js_code")
<script type="text/javascript">
jQuery(document).ready(function() {
//notification
get_notification()

function get_notification()
{
	 var APP_URL=$("#APP_URL").val();
    $.ajax({
        url:APP_URL+'/get_notification',
        data:{id:'na'},
        type:'get',
        // contentType: false,
        // processData: false,
        
        success:function(data)
        {
          $(".total_notification").html('').html(data.notification_count)  
          $(".notification_data").html('').html(data.notification_link)  
          // console.log('dd')

        },
        error:function(data)
        {

        }
    })
}

var refreshId = setInterval(get_notification, 5000);

	//
	var table  =  jQuery('.example1').DataTable( {
		dom: 'Bfrtip',
		buttons: ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5','print'],
		"bPaginate": true
		} );
	jQuery('.select2').select2();

	   $('.select3').select2({
            ajax:{
     
                 url: $("#APP_URL").val()+'/get_cities',
                    type: "post",
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
            $('.select4').select2({

                ajax:{
     
                 url: $("#APP_URL").val()+'/get_country',
                    type: "post",
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
            
	//Date picker
	jQuery('.datepicker').datepicker({autoclose: true,dateFormat:'dd-mm-yy'})
	} );
</script>
@yield("custom_js_code_second")
<script> function startTime() { var today=new Date(); var h=today.getHours(); var m=today.getMinutes(); var s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('txt').innerHTML=h+":"+m+":"+s; t=setTimeout(function(){startTime()},500); } function checkTime(i) { if (i<10) { i="0" + i; } return i; } </script>
<strong>
<script type="text/javascript">
$.ajaxSetup({
	headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
		});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		jQuery('a[href="' + activeTab + '"]').tab('show');
		}
	});
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.default_commission').bind('keypress keyup', function() {
		jQuery(".sellCommissionSingle").val(jQuery(this).val());
		jQuery(".sellCommissionDouble").val(jQuery(this).val());
		jQuery(".sellCommissionTriple").val(jQuery(this).val());
		jQuery(".extraCommissionAdult").val(jQuery(this).val());
		jQuery(".extraCommissionChild").val(jQuery(this).val());
		jQuery(".extraCommissionInfrant").val(jQuery(this).val());
		});
	jQuery('.Calculate').click(function(){
		var default_commission = jQuery(".default_commission").val();
		var sellCommissionSingle = jQuery(".sellCommissionSingle").val();
		var sellCommissionDouble = jQuery(".sellCommissionDouble").val();
		var sellCommissionTriple = jQuery(".sellCommissionTriple").val();
		var extraCommissionAdult = jQuery(".extraCommissionAdult").val();
		var extraCommissionChild = jQuery(".extraCommissionChild").val();
		var extraCommissionInfrant = jQuery(".extraCommissionInfrant").val();
		
		var Singleprice    = jQuery(".Single").val();
		var Doubleprice    = jQuery(".Double").val();
		var Tripleprice    = jQuery(".Triple").val();
		var Extra_Adult    = jQuery(".Extra_Adult").val();
		var Extra_Child    = jQuery(".Extra_Child").val();
		var Extra_Infant    = jQuery(".Extra_Infant").val();
		
		var calcSinglePrice  = (Singleprice - ( Singleprice * sellCommissionSingle / 100 )).toFixed(2);
		var calcDoublePrice  = (Doubleprice - ( Doubleprice * sellCommissionDouble / 100 )).toFixed(2);
		var calcTriplePrice  = (Tripleprice - ( Tripleprice * sellCommissionTriple / 100 )).toFixed(2);
		var calcExtra_Adult  = (Extra_Adult - ( Extra_Adult * extraCommissionAdult / 100 )).toFixed(2);
		var calcExtra_Child  = (Extra_Child - ( Extra_Child * extraCommissionChild / 100 )).toFixed(2);
		var calcExtra_Infant  = (Extra_Infant - ( Extra_Infant * extraCommissionInfrant / 100 )).toFixed(2);
		
		jQuery(".discountSingle").val(calcSinglePrice);
		jQuery(".discountDouble").val(calcDoublePrice);
		jQuery(".discountTriple").val(calcTriplePrice);
		jQuery(".Nett_Extra_Adult").val(calcExtra_Adult);
		jQuery(".Nett_Extra_Child").val(calcExtra_Child);
		jQuery(".Nett_Extra_Infant").val(calcExtra_Infant);
		});
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	moment.locale('tr');
	//var ahmet = moment("25/04/2012","DD/MM/YYYY").year();
	var date = new Date();
	bugun = moment(date).format("DD/MM/YYYY");
	
	var date_input=$('input[name="date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		//startDate: '+1d',
        //endDate: '+0d',
        container: container,
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        //defaultDate: moment().subtract(15, 'days')
        //setStartDate : "<DATETIME STRING HERE>"
		};
		date_input.val(bugun);
		date_input.datepicker(options).on('focus', function(date_input){
			$("").html("focus event");
			}); ;
	});
 </script>
</body>
</html>