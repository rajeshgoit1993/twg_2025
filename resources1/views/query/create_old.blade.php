@extends('layouts.master')
@section('content')

<style type="text/css">
.panel-default>.panel-heading {
	color: #333;
	background-color: #fff;
	border-color: #e4e5e7;
	padding: 0;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	}
.panel-default>.panel-heading a {
	display: block;
	padding: 10px 15px;
	}
 .panel-default>.panel-heading a.active, .panel-default>.panel-heading a:hover{
	color: #008cff;
	}
.panel-default>.panel-heading a:after {
	content: "";
	position: relative;
	top: 1px;
	display: inline-block;
	font-family: 'Glyphicons Halflings';
	font-style: normal;
	font-weight: 400;
	line-height: 1;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	float: right;
	transition: transform .25s linear;
	-webkit-transition: -webkit-transform .25s linear;
	}
.panel-default>.panel-heading a[aria-expanded="true"] {
	background-color: #eee;
	}
.panel-default>.panel-heading a[aria-expanded="true"]:after {
	content: "\2212";
	-webkit-transform: rotate(180deg);
	transform: rotate(180deg);
	}
.panel-default>.panel-heading a[aria-expanded="false"]:after {
	content: "\002b";
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
	}
.accordion-option {
	width: 100%;
	float: left;
	clear: both;
	margin: 15px 0;
	}
.accordion-option .title {
	font-size: 20px;
	font-weight: bold;
	float: left;
	padding: 0;margin: 0;
	}
.accordion-option .toggle-accordion {
	float: right;
	font-size: 16px;
	color: #6a6c6f;
	}
.dayItinerary {
	border-bottom: 1px solid #ccc;
	margin: 15px; 
	
	}
span.select2.select2-container {
	width: 100% !important;
	}
.flight {
	display: none;
	}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	background: #ffffff;
	border: none;
	border-bottom:2px solid #008cff;
	color: #08b2ed;
	font-size: 16px !important;
	font-weight: 700;
	}
.btnblue {
	display: inline-block;
	background: #008cff;
    padding: 4px 12px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #008cff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
	}
.pfwmt {
	font-weight: 600;
	margin: 0px;
	text-align: left;
	}
.font-size10 {
	font-size: 10px;
	}
.font-size12 {
	font-size: 12px;
	}
.font-size14 {
	font-size: 14px;
	}
.font-size16 {
	font-size: 16px;
	}
.font-size18 {
	font-size: 18px;
	}
.font-size20 {
	font-size: 20px;
	}
.font-size22 {
	font-size: 22px;
	}
.color8cff {
	color: #008cff;
}
.color4a {
	color: #4a4a4a;
}
.colorf2 {
	color: #f2f2f2;
}
.colorf9 {
	color: #f9f9f9;
}
.colorced {
	color: #CED0D4;
}
.requiredcolor {
	color: #E12D2D;
}
.font-weight500 {
	font-weight: 500;
	}
.font-weight600 {
	font-weight: 600;
	}
.text-center {
	text-align: center;
	}
.text-capitalize {
	text-transform: capitalize;
	}
.text-lowercase {
	text-transform: lowercase;
	}
.text-uppercase {
	text-transform: uppercase;
	}
.lineHeight14 {
	line-height: 14px;
	}
.lineHeight15 {
	line-height: 15px;
	}
.padding10 {
	padding: 10px;
	}
.padding-top10 {
	padding-top: 10px;
	}
.padding-bottom10 {
	padding-bottom: 10px;
	}
.appendTop5 {
	margin-top: 5px;
	}
.appendTop10 {
	margin-top: 10px;
	}
.appendTop15 {
	margin-top: 15px;
	}
.appendTop20 {
	margin-top: 20px;
	}
.appendBottom5 {
	margin-bottom: 5px;
	}
.appendBottom10 {
	margin-bottom: 10px;
	}
.appendBottom15 {
	margin-bottom: 15px;
	}
.appendBottom20 {
	margin-bottom: 20px;
	}
.border1 {
	border: 1px solid #ccc;
	}
.border-top1 {
	border-top: 1px solid #ccc;
	}
.border-bottom1 {
	border-bottom: 1px solid #ccc;
	}
.borderradius2 {
	border-radius: 2px;
	}
.borderradius3 {
	border-radius: 3px;
	}
.borderradius4 {
	border-radius: 4px;
	}
.borderradius5 {
	border-radius: 5px;
	}
.borderradius10 {
	border-radius: 10px;
	}
.makeflex {
	display: flex;
	}
.flex110 {
	flex-grow: 1;
    flex-shrink: 1;
    flex-basis: 0%;
	}
.flexcenter {
	display: flex;
	align-items: center;
	}
.aligncenter {
	align-items: center;
	}
.flexcenter > li.active, .flexcenter > li.active >a:focus, .flexcenter > li.active > a:hover {
	color: #008cff !important;
	border-bottom-color:#008cff !important;
	}
.flexcenter > li > a.hover {
	color: #008cff !important;
	padding-bottom: 15px;
	border-bottom:2px solid #008cff !important;
	}
.flex-column {
	display: flex;
	flex-direction: column;
	}
.priceitemlist {
	font-size: 15px;
	font-weight: 600;
	margin: 0px;
	color: #000001;
	}
.minwidth100 {
	min-width: 100px !important;
	}
.minwidth100 {
	min-width: 100px !important;
	}
.minwidth135 {
	min-width: 135px !important;
	}
	#touraccommodation .dropdown-menu
	{
		margin: -1px !important;
	}


.dropdown-menu li a 
{
  
    margin: -3px 0px !important;
}
.part_payment
{
display: none;

}
.direct_part
{
	display: none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="makeflex aligncenter padding10">
					<a href="{{ URL::to('/query') }}" class="btn btn-success" style="margin-right: 20px"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<span class="pfwmt font-size18">Create Quote</span>
				</div>
				<!-- /.box-header -->
				<div class="box-body" style="padding-top: 0px">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#option1">Quote 1</a></li>
						<!--<li><a data-toggle="tab" href="#option2">Option 2</a></li>
						<li><a data-toggle="tab" href="#option3">Option 3</a></li>
						<li><a data-toggle="tab" href="#option4">Option 4</a></li>-->
					</ul>
					<br>
					<div class="tab-content">
						@include('query.quotation.option1')
						<!--option1 end-->
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
			<!-- Modal -->
	<div class="modal fade" id="addBookDialog" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
			<div class="modal-content" style="border-radius: 5px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" name="" value="" id="bookId">
						<h4 class="modal-title">Rooms Details</h4>
				</div>
				<form action="#" method="post" id="enq_data" name="enq_data">
<select class="form-control select_room" name="remarks">
<option value="">Select Room</option>
@for($i=1;$i<=10;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor

</select>
				<div class="modal-body custom_border" id="modal-body" style="font-size: 15px;line-height: 24px;">

                 

				</div>
	             </form>	
				<div class="modal-footer">
						<button type="button" class="btn btn-success" id="enq_update">Update</button>
					<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!---->


		<!---->
		<div class="modal fade" id="supplier" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
			<div class="modal-content" style="border-radius: 5px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" name="" value="" id="bookId">
						<h4 class="modal-title">Supplier Remarks</h4>
				</div>
				<form action="#" method="post" id="enq_data" name="enq_data">
                 
			  <div class="modal-body custom_border" id="supplier_body" style="font-size: 15px;line-height: 24px;">
               
            

				</div>
	             </form>	
				<div class="modal-footer">
						<button type="button" class="btn btn-success supplier_remarks" supplier_remarks_id="" supplier_attr="">Apply</button>
					<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
</div>
<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src='{{ url("resources/assets/js/packages/quote1.js") }}'></script>
<script type="text/javascript">
$(document).on('click','.get_room',function(e){
	e.preventDefault()
	$('#addBookDialog').modal('show');	

})
	
$(document).ready(function(){
$(".quote1_first_part").val('')

$(".quote1_first_part").attr('readonly','')

$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')

})
//
$(document).on("keyup change",".quote1_air_adult , .quote1_cruise_adult , .quote1_cruiseport_adult , .quote1_cruisegratuity_adult , .quote1_cruisegst_adult , .quote1_hotel_adult , .quote1_tours_adult , .quote1_transfer_adult , .quote1_visa_adult , .quote1_inc_adult , .quote1_meals_adult , .quote1_additionalservice_adult ,.pricemarkup , .markup_percentage,.quote1_markup_adult,.quote1_markup_adult, .quote1_markup_exadult, .quote1_markup_childbed, .quote1_markup_childwbed,.quote1_markup_infant,.quote1_markup_single ,.pricegst ,.gst_percentage ,.quote1_gst_adult,.quote1_gst_exadult,.quote1_gst_childbed,.quote1_gst_childwbed,.quote1_gst_infant,.quote1_gst_single ,.pricetcs ,.tcs_percentage ,.quote1_tcs_adult ,.quote1_tcs_exadult,.quote1_tcs_childbed,.quote1_tcs_childwbed,.quote1_tcs_infant,.quote1_tcs_single,.pricepgcharges ,.pgcharges_percentage , .quote1_pgcharges_adult,.quote1_pgcharges_exadult,.quote1_pgcharges_childbed,.quote1_pgcharges_childwbed,.quote1_pgcharges_infant,.quote1_pgcharges_single,.quote1_discount_adult_plus,.quote1_discount_exadult_minus,.quote1_discount_childbed_minus,.quote1_discount_childwbed_minus,.quote1_discount_infant_minus,.quote1_discount_single_minus ,.quote1_discount_adult_minus,.quote1_air_exadult,.quote1_cruise_exadult,.quote1_cruiseport_exadult,.quote1_cruisegratuity_exadult,.quote1_cruisegst_exadult,.quote1_hotel_exadult,.quote1_tours_exadult,.quote1_transfer_exadult,.quote1_visa_exadult,.quote1_inc_exadult,.quote1_meals_exadult,.quote1_additionalservice_exadult,.quote1_discount_exadult_plus,.quote1_air_childbed,.quote1_cruise_childbed,.quote1_cruiseport_childbed,.quote1_cruisegratuity_childbed,.quote1_cruisegst_childbed,.quote1_hotel_childbed,.quote1_tours_childbed,.quote1_transfer_childbed,.quote1_visa_childbed,.quote1_inc_childbed,.quote1_meals_childbed,.quote1_additionalservice_childbed,.quote1_discount_childbed_plus,.quote1_air_childwbed,.quote1_cruise_childwbed,.quote1_cruiseport_childwbed,.quote1_cruisegratuity_childwbed,.quote1_cruisegst_childwbed,.quote1_hotel_childwbed,.quote1_tours_childwbed,.quote1_transfer_childwbed,.quote1_visa_childwbed,.quote1_inc_childwbed,.quote1_meals_childwbed,.quote1_additionalservice_childwbed,.quote1_discount_childwbed_plus,.quote1_air_infant,.quote1_cruise_infant,.quote1_cruiseport_infant,.quote1_cruisegratuity_infant,.quote1_cruisegst_infant,.quote1_hotel_infant,.quote1_tours_infant,.quote1_transfer_infant,.quote1_visa_infant,.quote1_inc_infant,.quote1_meals_infant,.quote1_additionalservice_infant,.quote1_discount_infant_plus,.quote1_air_single,.quote1_cruise_single,.quote1_cruiseport_single,.quote1_cruisegratuity_single,.quote1_cruisegst_single,.quote1_hotel_single,.quote1_tours_single,.quote1_transfer_single,.quote1_visa_single,.quote1_inc_single,.quote1_meals_single,.quote1_additionalservice_single,.quote1_discount_single_plus,.pricediscountpositive,.discountpositive_percentage,.pricediscountnegative,.discountnegative_percentage",function(){
		quote1_price('quote1_air_adult','quote1_cruise_adult','quote1_cruiseport_adult','quote1_cruisegratuity_adult','quote1_cruisegst_adult','quote1_hotel_adult','quote1_tours_adult','quote1_transfer_adult','quote1_visa_adult','quote1_inc_adult','quote1_meals_adult','quote1_additionalservice_adult','quote1_tourtotal_adult','quote1_tourtotal_exadult','quote1_tourtotal_childbed','quote1_tourtotal_childwbed','quote1_tourtotal_infant','quote1_tourtotal_single','pricemarkup','markup_percentage','quote1_markup_adult','quote1_markup_exadult','quote1_markup_childbed','quote1_markup_childwbed','quote1_markup_infant','quote1_markup_single','quote1_total_adult','quote1_discount_adult_plus','quote1_gross_total_adult','quote1_gross_total_exadult','quote1_gross_total_childbed','quote1_gross_total_childwbed','quote1_gross_total_infant','quote1_gross_total_single','quote1_gross_total_group','quote1_discount_adult_minus','quote1_discount_exadult_minus','quote1_discount_childbed_minus','quote1_discount_childwbed_minus','quote1_discount_infant_minus','quote1_discount_single_minus','pricegst','gst_percentage','quote1_gst_adult','quote1_gst_adult','quote1_gst_exadult','quote1_gst_childbed','quote1_gst_childwbed','quote1_gst_infant','quote1_gst_single','quote1_gst_group','quote1_gsttotal_adult','pricetcs','tcs_percentage','quote1_tcs_adult','quote1_tcs_exadult','quote1_tcs_childbed','quote1_tcs_childwbed','quote1_tcs_infant','quote1_tcs_single','quote1_tcs_group','quote1_tcstotal_adult','pricepgcharges','pgcharges_percentage','quote1_pgcharges_adult','quote1_pgcharges_exadult','quote1_pgcharges_childbed','quote1_pgcharges_childwbed','quote1_pgcharges_infant','quote1_pgcharges_single','quote1_pg_group','quote1_grand_adult','quote1_grand_adult_with_person','query_pricetopay','quote1_number_of_adult','quote1_number_of_extra_adult','quote1_number_of_child_with_bed','quote1_number_of_child_without_bed','quote1_number_of_infant','quote1_number_solo_traveller','quote1_grand_exadult_with_person','quote1_grand_childbed_with_person','quote1_grand_childwbed_with_person','quote1_grand_infant_with_person','quote1_grand_single_with_person','quote1_discount_group','quote1_gsttotal_exadult','quote1_gsttotal_childbed','quote1_gsttotal_childwbed','quote1_gsttotal_infant','quote1_gsttotal_single','quote1_tcstotal_exadult','quote1_tcstotal_childbed','quote1_tcstotal_childwbed','quote1_tcstotal_infant','quote1_tcstotal_single','quote1_air_exadult','quote1_cruise_exadult','quote1_cruiseport_exadult','quote1_cruisegratuity_exadult','quote1_cruisegst_exadult','quote1_hotel_exadult','quote1_tours_exadult','quote1_transfer_exadult','quote1_visa_exadult','quote1_inc_exadult','quote1_meals_exadult','quote1_additionalservice_exadult','quote1_discount_exadult_plus','quote1_grand_exadult','quote1_grand_childbed','quote1_grand_childwbed','quote1_grand_infant','quote1_grand_single','quote1_air_childbed','quote1_cruise_childbed','quote1_cruiseport_childbed','quote1_cruisegratuity_childbed','quote1_cruisegst_childbed','quote1_hotel_childbed','quote1_tours_childbed','quote1_transfer_childbed','quote1_visa_childbed','quote1_inc_childbed','quote1_meals_childbed','quote1_additionalservice_childbed','quote1_discount_childbed_plus','quote1_air_childwbed','quote1_cruise_childwbed','quote1_cruiseport_childwbed','quote1_cruisegratuity_childwbed','quote1_cruisegst_childwbed','quote1_hotel_childwbed','quote1_tours_childwbed','quote1_transfer_childwbed','quote1_visa_childwbed','quote1_inc_childwbed','quote1_meals_childwbed','quote1_additionalservice_childwbed','quote1_discount_childwbed_plus','quote1_air_infant','quote1_cruise_infant','quote1_cruiseport_infant','quote1_cruisegratuity_infant','quote1_cruisegst_infant','quote1_hotel_infant','quote1_tours_infant','quote1_transfer_infant','quote1_visa_infant','quote1_inc_infant','quote1_meals_infant','quote1_additionalservice_infant','quote1_discount_infant_plus','quote1_air_single','quote1_cruise_single','quote1_cruiseport_single','quote1_cruisegratuity_single','quote1_cruisegst_single','quote1_hotel_single','quote1_tours_single','quote1_transfer_single','quote1_visa_single','quote1_inc_single','quote1_meals_single','quote1_additionalservice_single','quote1_discount_single_plus','quote1_pricetopay','pricediscountpositive','discountpositive_percentage','pricediscountnegative','discountnegative_percentage','advance_payment','advance_payment_percentage','quote1_advance_payment','first_part_payment','first_part_percentage','quote1_first_part','second_part_payment','second_part_percentage','quote1_second_part','quote1_total_payment')
	})

	function quote1_price(a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19,a20,a21,a22,a23,a24,a25,a26,a27,a28,a29,a30,a31,a32,a33,a34,a35,a36,a37,a38,a39,a40,a41,a42,a43,a44,a45,a46,a47,a48,a49,a50,a51,a52,a53,a54,a55,a56,a57,a58,a59,a60,a61,a62,a63,a64,a65,a66,a67,a68,a69,a70,a71,a72,a73,a74,a75,a76,a77,a78,a79,a80,a81,a82,a83,a84,a85,a86,a87,a88,a89,a90,a91,a92,a93,a94,a95,a96,a97,a98,a99,a100,a101,a102,a103,a104,a105,a106,a107,a108,a109,a110,a111,a112,a113,a114,a115,a116,a117,a118,a119,a120,a121,a122,a123,a124,a125,a126,a127,a128,a129,a130,a131,a132,a133,a134,a135,a136,a137,a138,a139,a140,a141,a142,a143,a144,a145,a146,a147,a148,a149,a150,a151,a152,a153,a154,a155,a156,a157,a158,a159,a160,a161,a162,a163,a164,a165,a166,a167,a168,a169,a170,a171,a172,a173,a174,a175,a176,a177,a178,a179,a180,a181)
	{
		var air=$("."+a1).val();
		if(air=='')
		{
			air=0;
		}
		var cruise =$("."+a2).val();
		if(cruise=='')
		{
			cruise=0;
		}
		var port=$("."+a3).val();
		if(port=='')
		{
			port=0;
		}
		var gratuity=$("."+a4).val();
		if(gratuity=='')
		{
			gratuity=0;
		}
		var cruisegst=$("."+a5).val();
		if(cruisegst=='')
		{
			cruisegst=0;
		}
		var accommodation=$("."+a6).val();
		if(accommodation=='')
		{
			accommodation=0;
		}
		var sightseeing=$("."+a7).val();
		if(sightseeing=='')
		{
			sightseeing=0;
		}
		var transfer=$("."+a8).val();
		if(transfer=='')
		{
			transfer=0;
		}
		var visa=$("."+a9).val();
		if(visa=='')
		{
			visa=0;
		}
		var inc=$("."+a10).val();
		if(inc=='')
		{
			inc=0;
		}
		var meals=$("."+a11).val();
		if(meals=='')
		{
			meals=0;
		}
		var additionalservice=$("."+a12).val();
		if(additionalservice=='')
		{
			additionalservice=0;
		}
		//total 13
		
		$("."+a13).val('').val(parseInt(air)+parseInt(cruise)+parseInt(port)+parseInt(gratuity)+parseInt(cruisegst)+parseInt(additionalservice)+parseInt(accommodation)+parseInt(sightseeing)+parseInt(transfer)+parseInt(visa)+parseInt(inc)+parseInt(meals))
      //
      var air_exadult=$("."+a97).val();
		if(air_exadult=='')
		{
			air_exadult=0;
		}
		var cruise_exadult =$("."+a98).val();
		if(cruise_exadult=='')
		{
			cruise_exadult=0;
		}
		var port_exadult=$("."+a99).val();
		if(port_exadult=='')
		{
			port_exadult=0;
		}
		var gratuity_exadult=$("."+a100).val();
		if(gratuity_exadult=='')
		{
			gratuity_exadult=0;
		}
		var cruisegst_exadult=$("."+a101).val();
		if(cruisegst_exadult=='')
		{
			cruisegst_exadult=0;
		}
		var accommodation_exadult=$("."+a102).val();
		if(accommodation_exadult=='')
		{
			accommodation_exadult=0;
		}
		var sightseeing_exadult=$("."+a103).val();
		if(sightseeing_exadult=='')
		{
			sightseeing_exadult=0;
		}
		var transfer_exadult=$("."+a104).val();
		if(transfer_exadult=='')
		{
			transfer_exadult=0;
		}
		var visa_exadult=$("."+a105).val();
		if(visa_exadult=='')
		{
			visa_exadult=0;
		}
		var inc_exadult=$("."+a106).val();
		if(inc_exadult=='')
		{
			inc_exadult=0;
		}
		var meals_exadult=$("."+a107).val();
		if(meals_exadult=='')
		{
			meals_exadult=0;
		}
		var additionalservice_exadult=$("."+a108).val();
		if(additionalservice_exadult=='')
		{
			additionalservice_exadult=0;
		}
		//total 14
		
		$("."+a14).val('').val(parseInt(air_exadult)+parseInt(cruise_exadult)+parseInt(port_exadult)+parseInt(gratuity_exadult)+parseInt(cruisegst_exadult)+parseInt(additionalservice_exadult)+parseInt(accommodation_exadult)+parseInt(sightseeing_exadult)+parseInt(transfer_exadult)+parseInt(visa_exadult)+parseInt(inc_exadult)+parseInt(meals_exadult))
      //
      var air_childbed=$("."+a115).val();
		if(air_childbed=='')
		{
			air_childbed=0;
		}
		var cruise_childbed =$("."+a116).val();
		if(cruise_childbed=='')
		{
			cruise_childbed=0;
		}
		var port_childbed=$("."+a117).val();
		if(port_childbed=='')
		{
			port_childbed=0;
		}
		var gratuity_childbed=$("."+a118).val();
		if(gratuity_childbed=='')
		{
			gratuity_childbed=0;
		}
		var cruisegst_childbed=$("."+a119).val();
		if(cruisegst_childbed=='')
		{
			cruisegst_childbed=0;
		}
		var accommodation_childbed=$("."+a120).val();
		if(accommodation_childbed=='')
		{
			accommodation_childbed=0;
		}
		var sightseeing_childbed=$("."+a121).val();
		if(sightseeing_childbed=='')
		{
			sightseeing_childbed=0;
		}
		var transfer_childbed=$("."+a122).val();
		if(transfer_childbed=='')
		{
			transfer_childbed=0;
		}
		var visa_childbed=$("."+a123).val();
		if(visa_childbed=='')
		{
			visa_childbed=0;
		}
		var inc_childbed=$("."+a124).val();
		if(inc_childbed=='')
		{
			inc_childbed=0;
		}
		var meals_childbed=$("."+a125).val();
		if(meals_childbed=='')
		{
			meals_childbed=0;
		}
		var additionalservice_childbed=$("."+a126).val();
		if(additionalservice_childbed=='')
		{
			additionalservice_childbed=0;
		}
		//total 15
		
		$("."+a15).val('').val(parseInt(air_childbed)+parseInt(cruise_childbed)+parseInt(port_childbed)+parseInt(gratuity_childbed)+parseInt(cruisegst_childbed)+parseInt(additionalservice_childbed)+parseInt(accommodation_childbed)+parseInt(sightseeing_childbed)+parseInt(transfer_childbed)+parseInt(visa_childbed)+parseInt(inc_childbed)+parseInt(meals_childbed))
		  //
      var air_childwbed=$("."+a128).val();
		if(air_childwbed=='')
		{
			air_childwbed=0;
		}
		var cruise_childwbed =$("."+a129).val();
		if(cruise_childwbed=='')
		{
			cruise_childwbed=0;
		}
		var port_childwbed=$("."+a130).val();
		if(port_childwbed=='')
		{
			port_childwbed=0;
		}
		var gratuity_childwbed=$("."+a131).val();
		if(gratuity_childwbed=='')
		{
			gratuity_childwbed=0;
		}
		var cruisegst_childwbed=$("."+a132).val();
		if(cruisegst_childwbed=='')
		{
			cruisegst_childwbed=0;
		}
		var accommodation_childwbed=$("."+a133).val();
		if(accommodation_childwbed=='')
		{
			accommodation_childwbed=0;
		}
		var sightseeing_childwbed=$("."+a134).val();
		if(sightseeing_childwbed=='')
		{
			sightseeing_childwbed=0;
		}
		var transfer_childwbed=$("."+a135).val();
		if(transfer_childwbed=='')
		{
			transfer_childwbed=0;
		}
		var visa_childwbed=$("."+a136).val();
		if(visa_childwbed=='')
		{
			visa_childwbed=0;
		}
		var inc_childwbed=$("."+a137).val();
		if(inc_childwbed=='')
		{
			inc_childwbed=0;
		}
		var meals_childwbed=$("."+a138).val();
		if(meals_childwbed=='')
		{
			meals_childwbed=0;
		}
		var additionalservice_childwbed=$("."+a139).val();
		if(additionalservice_childwbed=='')
		{
			additionalservice_childwbed=0;
		}
		//total 16
		
		$("."+a16).val('').val(parseInt(air_childwbed)+parseInt(cruise_childwbed)+parseInt(port_childwbed)+parseInt(gratuity_childwbed)+parseInt(cruisegst_childwbed)+parseInt(additionalservice_childwbed)+parseInt(accommodation_childwbed)+parseInt(sightseeing_childwbed)+parseInt(transfer_childwbed)+parseInt(visa_childwbed)+parseInt(inc_childwbed)+parseInt(meals_childwbed))
       //
      var air_infant=$("."+a141).val();
		if(air_infant=='')
		{
			air_infant=0;
		}
		var cruise_infant =$("."+a142).val();
		if(cruise_infant=='')
		{
			cruise_infant=0;
		}
		var port_infant=$("."+a143).val();
		if(port_infant=='')
		{
			port_infant=0;
		}
		var gratuity_infant=$("."+a144).val();
		if(gratuity_infant=='')
		{
			gratuity_infant=0;
		}
		var cruisegst_infant=$("."+a145).val();
		if(cruisegst_infant=='')
		{
			cruisegst_infant=0;
		}
		var accommodation_infant=$("."+a146).val();
		if(accommodation_infant=='')
		{
			accommodation_infant=0;
		}
		var sightseeing_infant=$("."+a147).val();
		if(sightseeing_infant=='')
		{
			sightseeing_infant=0;
		}
		var transfer_infant=$("."+a148).val();
		if(transfer_infant=='')
		{
			transfer_infant=0;
		}
		var visa_infant=$("."+a149).val();
		if(visa_infant=='')
		{
			visa_infant=0;
		}
		var inc_infant=$("."+a150).val();
		if(inc_infant=='')
		{
			inc_infant=0;
		}
		var meals_infant=$("."+a151).val();
		if(meals_infant=='')
		{
			meals_infant=0;
		}
		var additionalservice_infant=$("."+a152).val();
		if(additionalservice_infant=='')
		{
			additionalservice_infant=0;
		}
		//total 17
		
		$("."+a17).val('').val(parseInt(air_infant)+parseInt(cruise_infant)+parseInt(port_infant)+parseInt(gratuity_infant)+parseInt(cruisegst_infant)+parseInt(additionalservice_infant)+parseInt(accommodation_infant)+parseInt(sightseeing_infant)+parseInt(transfer_infant)+parseInt(visa_infant)+parseInt(inc_infant)+parseInt(meals_infant))
		 //
      var air_single=$("."+a154).val();
		if(air_single=='')
		{
			air_single=0;
		}
		var cruise_single =$("."+a155).val();
		if(cruise_single=='')
		{
			cruise_single=0;
		}
		var port_single=$("."+a156).val();
		if(port_single=='')
		{
			port_single=0;
		}
		var gratuity_single=$("."+a157).val();
		if(gratuity_single=='')
		{
			gratuity_single=0;
		}
		var cruisegst_single=$("."+a158).val();
		if(cruisegst_single=='')
		{
			cruisegst_single=0;
		}
		var accommodation_single=$("."+a159).val();
		if(accommodation_single=='')
		{
			accommodation_single=0;
		}
		var sightseeing_single=$("."+a160).val();
		if(sightseeing_single=='')
		{
			sightseeing_single=0;
		}
		var transfer_single=$("."+a161).val();
		if(transfer_single=='')
		{
			transfer_single=0;
		}
		var visa_single=$("."+a162).val();
		if(visa_single=='')
		{
			visa_single=0;
		}
		var inc_single=$("."+a163).val();
		if(inc_single=='')
		{
			inc_single=0;
		}
		var meals_single=$("."+a164).val();
		if(meals_single=='')
		{
			meals_single=0;
		}
		var additionalservice_single=$("."+a165).val();
		if(additionalservice_single=='')
		{
			additionalservice_single=0;
		}
		//total 17
		
		$("."+a18).val('').val(parseInt(air_single)+parseInt(cruise_single)+parseInt(port_single)+parseInt(gratuity_single)+parseInt(cruisegst_single)+parseInt(additionalservice_single)+parseInt(accommodation_single)+parseInt(sightseeing_single)+parseInt(transfer_single)+parseInt(visa_single)+parseInt(inc_single)+parseInt(meals_single))
		var markup=$("."+a19).val();
		if(markup==1)
		{
	
		}
		else if(markup==2)
		{
var percentage_markup=$("."+a20).val();



if(percentage_markup!='')
   {
   var tourtotal_adult=$("."+a13).val();
	var tourtotal_exadult=$("."+a14).val();
	var tourtotal_childbed=$("."+a15).val();
	var tourtotal_childwbed=$("."+a16).val();
	var tourtotal_infant=$("."+a17).val();
	var tourtotal_single=$("."+a18).val();
   if(tourtotal_adult!='')
   {
   	var markup_percentage_into_total_adult=tourtotal_adult*percentage_markup/100;
   		$("."+a21).val('').val(parseInt(markup_percentage_into_total_adult))
   }
   if(tourtotal_exadult!='')
   {
   	var markup_percentage_into_total_exadult=tourtotal_exadult*percentage_markup/100;
   		$("."+a22).val('').val(parseInt(markup_percentage_into_total_exadult))
   }
   if(tourtotal_childbed!='')
   {
   	var markup_percentage_into_total_childbed=tourtotal_childbed*percentage_markup/100;
   		$("."+a23).val('').val(parseInt(markup_percentage_into_total_childbed))
   }
   if(tourtotal_childwbed!='')
   {
   	var markup_percentage_into_total_childwbed=tourtotal_childwbed*percentage_markup/100;
   		$("."+a24).val('').val(parseInt(markup_percentage_into_total_childwbed))
   }
   if(tourtotal_infant!='')
   {
   	var markup_percentage_into_total_infant=tourtotal_infant*percentage_markup/100;
   		$("."+a25).val('').val(parseInt(markup_percentage_into_total_infant))
   }
   if(tourtotal_single!='')
   {
   	var markup_percentage_into_total_single=tourtotal_single*percentage_markup/100;
   		$("."+a26).val('').val(parseInt(markup_percentage_into_total_single))
   }
   	
   }
	}
	//for discount plus
	var pricediscountpositive=$("."+a168).val();

		if(pricediscountpositive==1)
		{
	
		}
		else if(pricediscountpositive==2)
		{
var discountpositive_percentage=$("."+a169).val();



if(discountpositive_percentage!='')
   {
    var tourtotal_adult=$("."+a13).val();
	var tourtotal_exadult=$("."+a14).val();
	var tourtotal_childbed=$("."+a15).val();
	var tourtotal_childwbed=$("."+a16).val();
	var tourtotal_infant=$("."+a17).val();
	var tourtotal_single=$("."+a18).val();
	//
    var markuptotal_adult=$("."+a21).val();
	var markuptotal_exadult=$("."+a22).val();
	var markuptotal_childbed=$("."+a23).val();
	var markuptotal_childwbed=$("."+a24).val();
	var markuptotal_infant=$("."+a25).val();
	var markuptotal_single=$("."+a26).val();
	//
	var total_tour_with_markup_adult=0;
	var total_tour_with_markup_exadult=0;
	var total_tour_with_markup_childbed=0;
	var total_tour_with_markup_childwbed=0;
	var total_tour_with_markup_infant=0;
	var total_tour_with_markup_single=0;
	if(tourtotal_adult!='')
	{
	var total_tour_with_markup_adult=parseInt(total_tour_with_markup_adult)+parseInt(tourtotal_adult)	
	}
	if(markuptotal_adult!='')
	{
	var total_tour_with_markup_adult=parseInt(total_tour_with_markup_adult)+parseInt(markuptotal_adult)	
	}
	if(tourtotal_exadult!='')
	{
	var total_tour_with_markup_exadult=parseInt(total_tour_with_markup_exadult)+parseInt(tourtotal_exadult)	
	}
	if(markuptotal_exadult!='')
	{
	var total_tour_with_markup_exadult=parseInt(total_tour_with_markup_exadult)+parseInt(markuptotal_exadult)	
	}
	if(tourtotal_childbed!='')
	{
	var total_tour_with_markup_childbed=parseInt(total_tour_with_markup_childbed)+parseInt(tourtotal_childbed)	
	}
	if(markuptotal_childbed!='')
	{
	var total_tour_with_markup_childbed=parseInt(total_tour_with_markup_childbed)+parseInt(markuptotal_childbed)	
	}
	if(tourtotal_childwbed!='')
	{
	var total_tour_with_markup_childwbed=parseInt(total_tour_with_markup_childwbed)+parseInt(tourtotal_childwbed)	
	}
	if(markuptotal_childwbed!='')
	{
	var total_tour_with_markup_childwbed=parseInt(total_tour_with_markup_childwbed)+parseInt(markuptotal_childwbed)	
	}
	if(tourtotal_infant!='')
	{
	var total_tour_with_markup_infant=parseInt(total_tour_with_markup_infant)+parseInt(tourtotal_infant)	
	}
	if(markuptotal_infant!='')
	{
	var total_tour_with_markup_infant=parseInt(total_tour_with_markup_infant)+parseInt(markuptotal_infant)	
	}
	if(tourtotal_single!='')
	{
	var total_tour_with_markup_single=parseInt(total_tour_with_markup_single)+parseInt(tourtotal_single)	
	}
	if(markuptotal_single!='')
	{
	var total_tour_with_markup_single=parseInt(total_tour_with_markup_single)+parseInt(markuptotal_single)	
	}

	var discount_plus_total_adult=total_tour_with_markup_adult*discountpositive_percentage/100;
   	$("."+a28).val('').val(parseInt(discount_plus_total_adult))

   	var discount_plus_total_exadult=total_tour_with_markup_exadult*discountpositive_percentage/100;
   	$("."+a109).val('').val(parseInt(discount_plus_total_exadult))

   	var discount_plus_total_childbed=total_tour_with_markup_childbed*discountpositive_percentage/100;
   	$("."+a127).val('').val(parseInt(discount_plus_total_childbed))

   	var discount_plus_total_childwbed=total_tour_with_markup_childwbed*discountpositive_percentage/100;
   	$("."+a140).val('').val(parseInt(discount_plus_total_childwbed))

   	var discount_plus_total_infant=total_tour_with_markup_infant*discountpositive_percentage/100;
   	$("."+a153).val('').val(parseInt(discount_plus_total_infant))

   	var discount_plus_total_single=total_tour_with_markup_single*discountpositive_percentage/100;
   	$("."+a166).val('').val(parseInt(discount_plus_total_single))

	//
  
   	
   }
	}
	else if(pricediscountpositive==3)
		{

   	$("."+a28).val('').val(0)

   
   	$("."+a109).val('').val(0)

   	$("."+a127).val('').val(0)

   
   	$("."+a140).val('').val(0)

   
   	$("."+a153).val('').val(0)

   
   	$("."+a166).val('').val(0)

		}
	//for gross total
	var gross_total=0;
   var tourtotal_adult=$("."+a13).val();
	if(tourtotal_adult!='')
	{
	var gross_total=parseInt(gross_total)+parseInt(tourtotal_adult)	
	}
	var markup_profit_adult=$("."+a21).val();
   if(markup_profit_adult!='')
   {
   	var gross_total=parseInt(gross_total)+parseInt(markup_profit_adult)	
   }
   var discount_adult_plus=$("."+a28).val();
   if(discount_adult_plus!='')
   {
   	var gross_total=parseInt(gross_total)+parseInt(discount_adult_plus)	
   }
  $("."+a29).val('').val(parseInt(gross_total))
  var gross_total_exa=0;
   var tourtotal_exadult=$("."+a14).val();
	if(tourtotal_exadult!='')
	{
	var gross_total_exa=parseInt(gross_total_exa)+parseInt(tourtotal_exadult)	
	}
	var markup_profit_exadult=$("."+a22).val();
   if(markup_profit_exadult!='')
   {
   	var gross_total_exa=parseInt(gross_total_exa)+parseInt(markup_profit_exadult)	
   }
   var discount_exadult_plus=$("."+a109).val();
   if(discount_exadult_plus!='')
   {
   	var gross_total_exa=parseInt(gross_total_exa)+parseInt(discount_exadult_plus)	
   }
  $("."+a30).val('').val(parseInt(gross_total_exa))

   var gross_total_childbed=0;
   var tourtotal_childbed=$("."+a15).val();
	if(tourtotal_childbed!='')
	{
	var gross_total_childbed=parseInt(gross_total_childbed)+parseInt(tourtotal_childbed)	
	}
	var markup_profit_childbed=$("."+a23).val();
   if(markup_profit_childbed!='')
   {
   	var gross_total_childbed=parseInt(gross_total_childbed)+parseInt(markup_profit_childbed)	
   }
   var discount_childbed_plus=$("."+a127).val();
   if(discount_childbed_plus!='')
   {
   	var gross_total_childbed=parseInt(gross_total_childbed)+parseInt(discount_childbed_plus)	
   }
  $("."+a31).val('').val(parseInt(gross_total_childbed))

   var gross_total_childwbed=0;
   var tourtotal_childwbed=$("."+a16).val();
	if(tourtotal_childwbed!='')
	{
	var gross_total_childwbed=parseInt(gross_total_childwbed)+parseInt(tourtotal_childwbed)	
	}
	var markup_profit_childwbed=$("."+a24).val();
   if(markup_profit_childwbed!='')
   {
   	var gross_total_childwbed=parseInt(gross_total_childwbed)+parseInt(markup_profit_childwbed)	
   }
   var discount_childwbed_plus=$("."+a140).val();
   if(discount_childwbed_plus!='')
   {
   	var gross_total_childwbed=parseInt(gross_total_childwbed)+parseInt(discount_childwbed_plus)	
   }
  $("."+a32).val('').val(parseInt(gross_total_childwbed))

   var gross_total_infant=0;
   var tourtotal_infant=$("."+a17).val();
	if(tourtotal_infant!='')
	{
	var gross_total_infant=parseInt(gross_total_infant)+parseInt(tourtotal_infant)	
	}
	var markup_profit_infant=$("."+a25).val();
   if(markup_profit_infant!='')
   {
   	var gross_total_infant=parseInt(gross_total_infant)+parseInt(markup_profit_infant)	
   }
   var discount_infant_plus=$("."+a153).val();
   if(discount_infant_plus!='')
   {
   	var gross_total_infant=parseInt(gross_total_infant)+parseInt(discount_infant_plus)	
   }
  $("."+a33).val('').val(parseInt(gross_total_infant))

  var gross_total_single=0;
   var tourtotal_single=$("."+a18).val();
	if(tourtotal_single!='')
	{
	var gross_total_single=parseInt(gross_total_single)+parseInt(tourtotal_single)	
	}
	var markup_profit_single=$("."+a26).val();
   if(markup_profit_single!='')
   {
   	var gross_total_single=parseInt(gross_total_single)+parseInt(markup_profit_single)	
   }
   var discount_single_plus=$("."+a166).val();
   if(discount_single_plus!='')
   {
   	var gross_total_single=parseInt(gross_total_single)+parseInt(discount_single_plus)	
   }
  $("."+a34).val('').val(parseInt(gross_total_single))
	//for gross group
   var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();
    
   var gross_total_adult=$("."+a29).val();
   var gross_total_exadult=$("."+a30).val();
   var gross_total_childbed=$("."+a31).val();
   var gross_total_childwbed=$("."+a32).val();
   var gross_total_infant=$("."+a33).val();
   var gross_total_single=$("."+a34).val();

   var gross_group=0;
   if(gross_total_adult!='' && number_of_adult!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_adult*number_of_adult)
   }
   if(gross_total_exadult!='' && number_of_extra_adult!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_exadult*number_of_extra_adult)
   }
   if(gross_total_childbed!='' && number_of_child_with_bed!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_childbed*number_of_child_with_bed)
   }
   if(gross_total_childwbed!='' && number_of_child_without_bed!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_childwbed*number_of_child_without_bed)
   }
   if(gross_total_infant!='' && number_of_infant!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_infant*number_of_infant)
   }
   if(gross_total_single!='' && number_solo_traveller!='')
   {
   	 var gross_group=parseInt(gross_group)+parseInt(gross_total_single*number_solo_traveller)
   }
   $("."+a35).val('').val(parseInt(gross_group))
   //for discount minus
   var pricediscountnegative=$("."+a170).val();

		if(pricediscountnegative==1)
		{
	
		}
		else if(pricediscountnegative==2)
		{
var discountnegative_percentage=$("."+a171).val();



if(discountnegative_percentage!='')
   {
    var grosstotal_adult=$("."+a29).val();
	var grosstotal_exadult=$("."+a30).val();
	var grosstotal_childbed=$("."+a31).val();
	var grosstotal_childwbed=$("."+a32).val();
	var grosstotal_infant=$("."+a33).val();
	var grosstotal_single=$("."+a34).val();
	
	//
	var total_discount_with_gross_adult=0;
	var total_discount_with_gross_exadult=0;
	var total_discount_with_gross_childbed=0;
	var total_discount_with_gross_childwbed=0;
	var total_discount_with_gross_infant=0;
	var total_discount_with_gross_single=0;
	if(grosstotal_adult!='')
	{
	var total_discount_with_gross_adult=parseInt(total_discount_with_gross_adult)+parseInt(grosstotal_adult)	
	}
	
	if(grosstotal_exadult!='')
	{
	var total_discount_with_gross_exadult=parseInt(total_discount_with_gross_exadult)+parseInt(grosstotal_exadult)	
	}
	
	if(grosstotal_childbed!='')
	{
	var total_discount_with_gross_childbed=parseInt(total_discount_with_gross_childbed)+parseInt(grosstotal_childbed)	
	}
	
	if(grosstotal_childwbed!='')
	{
	var total_discount_with_gross_childwbed=parseInt(total_discount_with_gross_childwbed)+parseInt(grosstotal_childwbed)	
	}
	
	if(grosstotal_infant!='')
	{
	var total_discount_with_gross_infant=parseInt(total_discount_with_gross_infant)+parseInt(grosstotal_infant)	
	}
	
	if(grosstotal_single!='')
	{
	var total_discount_with_gross_single=parseInt(total_discount_with_gross_single)+parseInt(grosstotal_single)	
	}
	
    var divide_val=parseInt(discountnegative_percentage)+parseInt(100);
	var discount_minus_total_adult=total_discount_with_gross_adult*discountnegative_percentage/divide_val;
   	$("."+a36).val('').val(parseInt(discount_minus_total_adult))

   	var discount_minus_total_exadult=total_discount_with_gross_exadult*discountnegative_percentage/divide_val;
   	$("."+a37).val('').val(parseInt(discount_minus_total_exadult))

   	var discount_minus_total_childbed=total_discount_with_gross_childbed*discountnegative_percentage/divide_val;
   	$("."+a38).val('').val(parseInt(discount_minus_total_childbed))

   	var discount_minus_total_childwbed=total_discount_with_gross_childwbed*discountnegative_percentage/divide_val;
   	$("."+a39).val('').val(parseInt(discount_minus_total_childwbed))

   	var discount_minus_total_infant=total_discount_with_gross_infant*discountnegative_percentage/divide_val;
   	$("."+a40).val('').val(parseInt(discount_minus_total_infant))

   	var discount_minus_total_single=total_discount_with_gross_single*discountnegative_percentage/divide_val;
   	$("."+a41).val('').val(parseInt(discount_minus_total_single))

	//
  
   	
   }
	}
	else if(pricediscountnegative==3)
		{

   	$("."+a36).val('').val(0)

   
   	$("."+a37).val('').val(0)

   	$("."+a38).val('').val(0)

   
   	$("."+a39).val('').val(0)

   
   	$("."+a40).val('').val(0)

   
   	$("."+a41).val('').val(0)

		}
	//	for discount group
	var discount_adult_minus=$("."+a36).val();
   var discount_exadult_minus=$("."+a37).val();
   var discount_childbed_minus=$("."+a38).val();
   var discount_childwbed_minus=$("."+a39).val();
   var discount_infant_minus=$("."+a40).val();
   var discount_single_minus=$("."+a41).val();

   var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();

   var discount_group=0;
   if(discount_adult_minus!='' && number_of_adult!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_adult_minus*number_of_adult)
   }
   if(discount_exadult_minus!='' && number_of_extra_adult!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_exadult_minus*number_of_extra_adult)
   }
   if(discount_childbed_minus!='' && number_of_child_with_bed!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_childbed_minus*number_of_child_with_bed)
   }
   if(discount_childwbed_minus!='' && number_of_child_without_bed!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_childwbed_minus*number_of_child_without_bed)
   }
   if(discount_infant_minus!='' && number_of_infant!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_infant_minus*number_of_infant)
   }
   if(discount_single_minus!='' && number_solo_traveller!='')
   {
   	 var discount_group=parseInt(discount_group)+parseInt(discount_single_minus*number_solo_traveller)
   }
    $("."+a86).val('').val(parseInt(discount_group))
	//for gst claculation
	var gst=$("."+a42).val();
		if(gst==1)
		{
	
		}
		else if(gst==2)
		{
var percentage_gst=$("."+a43).val();



if(percentage_gst!='')
   {
   var gross_total_adult=$("."+a29).val();
   var gross_total_exadult=$("."+a30).val();
   var gross_total_childbed=$("."+a31).val();
   var gross_total_childwbed=$("."+a32).val();
   var gross_total_infant=$("."+a33).val();
   var gross_total_single=$("."+a34).val();
   
  	var discount_adult_minus=$("."+a36).val();
   var discount_exadult_minus=$("."+a37).val();
   var discount_childbed_minus=$("."+a38).val();
   var discount_childwbed_minus=$("."+a39).val();
   var discount_infant_minus=$("."+a40).val();
   var discount_single_minus=$("."+a41).val()


   if(gross_total_adult!='')
   {
   	if(discount_adult_minus!='')
   	{
   		var amount_after_minus_adult=parseInt(gross_total_adult)-parseInt(discount_adult_minus)
   	}
   	else
   	{
    var amount_after_minus_adult=parseInt(gross_total_adult)
   	}
   	
   	var gst_percentage_into_total_adult=amount_after_minus_adult*percentage_gst/100;
   		$("."+a44).val('').val(parseInt(gst_percentage_into_total_adult))
   }
  if(gross_total_exadult!='')
   {

   	if(discount_exadult_minus!='')
   	{
   		var amount_after_minus_exadult=parseInt(gross_total_exadult)-parseInt(discount_exadult_minus)
   	}
   	else
   	{
    var amount_after_minus_exadult=parseInt(gross_total_exadult)
   	}
   	var gst_percentage_into_total_exadult=amount_after_minus_exadult*percentage_gst/100;
   
   	
   		$("."+a46).val('').val(parseInt(gst_percentage_into_total_exadult))
   }
   if(gross_total_childbed!='')
   {
   	if(discount_childbed_minus!='')
   	{
   		var amount_after_minus_childbed=parseInt(gross_total_childbed)-parseInt(discount_childbed_minus)
   	}
   	else
   	{
    var amount_after_minus_childbed=parseInt(gross_total_childbed)
   	}
   	
   	var gst_percentage_into_total_childbed=amount_after_minus_childbed*percentage_gst/100;
   		$("."+a47).val('').val(parseInt(gst_percentage_into_total_childbed))
   }
   if(gross_total_childwbed!='')
   {
   	if(discount_childwbed_minus!='')
   	{
   		var amount_after_minus_childwbed=parseInt(gross_total_childwbed)-parseInt(discount_childwbed_minus)
   	}
   	else
   	{
    var amount_after_minus_childwbed=parseInt(gross_total_childwbed)
   	}
   	
   	var gst_percentage_into_total_childwbed=amount_after_minus_childwbed*percentage_gst/100;
   		$("."+a48).val('').val(parseInt(gst_percentage_into_total_childwbed))
   }
   if(gross_total_infant!='')
   {
   	if(discount_infant_minus!='')
   	{
   		var amount_after_minus_infant=parseInt(gross_total_infant)-parseInt(discount_infant_minus)
   	}
   	else
   	{
    var amount_after_minus_infant=parseInt(gross_total_infant)
   	}
   	
   	var gst_percentage_into_total_infant=amount_after_minus_infant*percentage_gst/100;
   		$("."+a49).val('').val(parseInt(gst_percentage_into_total_infant))
   }
    if(gross_total_single!='')
   {
   	if(discount_single_minus!='')
   	{
   		var amount_after_minus_single=parseInt(gross_total_single)-parseInt(discount_single_minus)
   	}
   	else
   	{
    var amount_after_minus_single=parseInt(gross_total_single)
   	}
   	
   	var gst_percentage_into_total_single=amount_after_minus_single*percentage_gst/100;
   		$("."+a50).val('').val(parseInt(gst_percentage_into_total_single))
   }
   	
   }
   }
   //for gst group
   var gst_adult=$("."+a44).val();
   var gst_exadult=$("."+a46).val();
   var gst_childbed=$("."+a47).val();
   var gst_childwbed=$("."+a48).val();
   var gst_infant=$("."+a49).val();
   var gst_single=$("."+a50).val();

    var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();

   var gst_group=0;
   if(gst_adult!='' && number_of_adult!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_adult*number_of_adult)
   }
   if(gst_exadult!='' && number_of_extra_adult!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_exadult*number_of_extra_adult)
   }
   if(gst_childbed!='' && number_of_child_with_bed!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_childbed*number_of_child_with_bed)
   }
   if(gst_childwbed!='' && number_of_child_without_bed!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_childwbed*number_of_child_without_bed)
   }
   if(gst_infant!='' && number_of_infant!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_infant*number_of_infant)
   }
   if(gst_single!='' && number_solo_traveller!='')
   {
   	 var gst_group=parseInt(gst_group)+parseInt(gst_single*number_solo_traveller)
   }
    $("."+a51).val('').val(parseInt(gst_group))
  //for gst total
	var gst_total_adult=0;
   var gross_adult=$("."+a29).val();
	if(gross_adult!='')
	{
	var gst_total_adult=parseInt(gst_total_adult)+parseInt(gross_adult)	
	}
	var discount_minius_adult=$("."+a36).val();
   if(discount_minius_adult!='')
   {
   	var gst_total_adult=parseInt(gst_total_adult)-parseInt(discount_minius_adult)	
   }
    var gst_adult=$("."+a44).val();
   if(gst_adult!='')
   {
   	var gst_total_adult=parseInt(gst_total_adult)+parseInt(gst_adult)	
   }
  $("."+a52).val('').val(parseInt(gst_total_adult))

  var gst_total_exadult=0;
   var gross_exadult=$("."+a30).val();
	if(gross_exadult!='')
	{
	var gst_total_exadult=parseInt(gst_total_exadult)+parseInt(gross_exadult)	
	}
	var discount_minius_exadult=$("."+a37).val();
   if(discount_minius_exadult!='')
   {
   	var gst_total_exadult=parseInt(gst_total_exadult)-parseInt(discount_minius_exadult)	
   }
    var gst_exadult=$("."+a46).val();
   if(gst_exadult!='')
   {
   	var gst_total_exadult=parseInt(gst_total_exadult)+parseInt(gst_exadult)	
   }
  $("."+a87).val('').val(parseInt(gst_total_exadult))
  //
   var gst_total_childbed=0;
   var gross_childbed=$("."+a31).val();
	if(gross_childbed!='')
	{
	var gst_total_childbed=parseInt(gst_total_childbed)+parseInt(gross_childbed)	
	}
	var discount_minius_childbed=$("."+a38).val();
   if(discount_minius_childbed!='')
   {
   	var gst_total_childbed=parseInt(gst_total_childbed)-parseInt(discount_minius_childbed)	
   }
    var gst_childbed=$("."+a47).val();
   if(gst_childbed!='')
   {
   	var gst_total_childbed=parseInt(gst_total_childbed)+parseInt(gst_childbed)	
   }
  $("."+a88).val('').val(parseInt(gst_total_childbed))

   var gst_total_childwbed=0;
   var gross_childwbed=$("."+a32).val();
	if(gross_childwbed!='')
	{
	var gst_total_childwbed=parseInt(gst_total_childwbed)+parseInt(gross_childwbed)	
	}
	var discount_minius_childwbed=$("."+a39).val();
   if(discount_minius_childwbed!='')
   {
   	var gst_total_childwbed=parseInt(gst_total_childwbed)-parseInt(discount_minius_childwbed)	
   }
    var gst_childwbed=$("."+a48).val();
   if(gst_childwbed!='')
   {
   	var gst_total_childwbed=parseInt(gst_total_childwbed)+parseInt(gst_childwbed)	
   }
  $("."+a89).val('').val(parseInt(gst_total_childwbed))

    var gst_total_infant=0;
   var gross_infant=$("."+a33).val();
	if(gross_infant!='')
	{
	var gst_total_infant=parseInt(gst_total_infant)+parseInt(gross_infant)	
	}
	var discount_minius_infant=$("."+a40).val();
   if(discount_minius_infant!='')
   {
   	var gst_total_infant=parseInt(gst_total_infant)-parseInt(discount_minius_infant)	
   }
    var gst_infant=$("."+a49).val();
   if(gst_infant!='')
   {
   	var gst_total_infant=parseInt(gst_total_infant)+parseInt(gst_infant)	
   }
  $("."+a90).val('').val(parseInt(gst_total_infant))

    var gst_total_single=0;
   var gross_single=$("."+a34).val();
	if(gross_single!='')
	{
	var gst_total_single=parseInt(gst_total_single)+parseInt(gross_single)	
	}
	var discount_minius_single=$("."+a41).val();
   if(discount_minius_single!='')
   {
   	var gst_total_single=parseInt(gst_total_single)-parseInt(discount_minius_single)	
   }
    var gst_single=$("."+a50).val();
   if(gst_single!='')
   {
   	var gst_total_single=parseInt(gst_total_single)+parseInt(gst_single)	
   }
  $("."+a91).val('').val(parseInt(gst_total_single))

  //for tcs claculation
	var tcs=$("."+a53).val();

		if(tcs==1)
		{
	
		}
		else if(tcs==2)
		{
var tcs_percentage=$("."+a54).val();



if(tcs_percentage!='')
   {
   var gst_total_adult=$("."+a52).val();
   var gst_total_exadult=$("."+a87).val();
   var gst_total_childbed=$("."+a88).val();
   var gst_total_childwbed=$("."+a89).val();
   var gst_total_infant=$("."+a90).val();
   var gst_total_single=$("."+a91).val();
  
  


   if(gst_total_adult!='')
   {
   	
   	
   	var tcs_percentage_into_total_adult=gst_total_adult*tcs_percentage/100;
   		$("."+a55).val('').val(parseInt(tcs_percentage_into_total_adult))
   }
  if(gst_total_exadult!='')
   {

   	var tcs_percentage_into_total_exadult=gst_total_exadult*tcs_percentage/100;
   
   	
   		$("."+a56).val('').val(parseInt(tcs_percentage_into_total_exadult))
   }
   if(gst_total_childbed!='')
   {
   	
   	
   	var tcs_percentage_into_total_childbed=gst_total_childbed*tcs_percentage/100;
   		$("."+a57).val('').val(parseInt(tcs_percentage_into_total_childbed))
   }
   if(gst_total_childwbed!='')
   {
   	
   	
   	var tcs_percentage_into_total_childwbed=gst_total_childwbed*tcs_percentage/100;
   		$("."+a58).val('').val(parseInt(tcs_percentage_into_total_childwbed))
   }
   if(gst_total_infant!='')
   {
   	
   	
   	var tcs_percentage_into_total_infant=gst_total_infant*tcs_percentage/100;
   		$("."+a59).val('').val(parseInt(tcs_percentage_into_total_infant))
   }
    if(gst_total_single!='')
   {
   	
   	
   	var tcs_percentage_into_total_single=gst_total_single*tcs_percentage/100;
   		$("."+a60).val('').val(parseInt(tcs_percentage_into_total_single))
   }
   	
   }
   }
   //for tcs group
   var tcs_adult=$("."+a55).val();
   var tcs_exadult=$("."+a56).val();
   var tcs_childbed=$("."+a57).val();
   var tcs_childwbed=$("."+a58).val();
   var tcs_infant=$("."+a59).val();
   var tcs_single=$("."+a60).val();

    var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();

   var tcs_group=0;
   if(tcs_adult!='' && number_of_adult!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_adult*number_of_adult)
   }
   if(tcs_exadult!='' && number_of_extra_adult!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_exadult*number_of_extra_adult)
   }
   if(tcs_childbed!='' && number_of_child_with_bed!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_childbed*number_of_child_with_bed)
   }
   if(tcs_childwbed!='' && number_of_child_without_bed!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_childwbed*number_of_child_without_bed)
   }
   if(tcs_infant!='' && number_of_infant!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_infant*number_of_infant)
   }
   if(tcs_single!='' && number_solo_traveller!='')
   {
   	 var tcs_group=parseInt(tcs_group)+parseInt(tcs_single*number_solo_traveller)
   }
    $("."+a61).val('').val(parseInt(tcs_group))
	//for tcs total
	var tcs_total_adult=0;
   var gst_adult=$("."+a52).val();
	if(gst_adult!='')
	{
	var tcs_total_adult=parseInt(tcs_total_adult)+parseInt(gst_adult)	
	}
	
    var tcs_adult=$("."+a55).val();
   if(tcs_adult!='')
   {
   	var tcs_total_adult=parseInt(tcs_total_adult)+parseInt(tcs_adult)	
   }
  $("."+a62).val('').val(parseInt(tcs_total_adult))

  var tcs_total_exadult=0;
   var gst_exadult=$("."+a87).val();
	if(gst_exadult!='')
	{
	var tcs_total_exadult=parseInt(tcs_total_exadult)+parseInt(gst_exadult)	
	}
	
    var tcs_exadult=$("."+a56).val();
   if(tcs_exadult!='')
   {
   	var tcs_total_exadult=parseInt(tcs_total_exadult)+parseInt(tcs_exadult)	
   }
  $("."+a92).val('').val(parseInt(tcs_total_exadult))

   var tcs_total_childbed=0;
   var gst_childbed=$("."+a88).val();
	if(gst_childbed!='')
	{
	var tcs_total_childbed=parseInt(tcs_total_childbed)+parseInt(gst_childbed)	
	}
	
    var tcs_childbed=$("."+a57).val();
   if(tcs_childbed!='')
   {
   	var tcs_total_childbed=parseInt(tcs_total_childbed)+parseInt(tcs_childbed)	
   }
  $("."+a93).val('').val(parseInt(tcs_total_childbed))

   var tcs_total_childwbed=0;
   var gst_childwbed=$("."+a89).val();
	if(gst_childwbed!='')
	{
	var tcs_total_childwbed=parseInt(tcs_total_childwbed)+parseInt(gst_childwbed)	
	}
	
    var tcs_childwbed=$("."+a58).val();
   if(tcs_childwbed!='')
   {
   	var tcs_total_childwbed=parseInt(tcs_total_childwbed)+parseInt(tcs_childwbed)	
   }
  $("."+a94).val('').val(parseInt(tcs_total_childwbed))

   var tcs_total_infant=0;
   var gst_infant=$("."+a90).val();
	if(gst_infant!='')
	{
	var tcs_total_infant=parseInt(tcs_total_infant)+parseInt(gst_infant)	
	}
	
    var tcs_infant=$("."+a59).val();
   if(tcs_infant!='')
   {
   	var tcs_total_infant=parseInt(tcs_total_infant)+parseInt(tcs_infant)	
   }
  $("."+a95).val('').val(parseInt(tcs_total_infant))

  var tcs_total_single=0;
   var gst_single=$("."+a91).val();
	if(gst_single!='')
	{
	var tcs_total_single=parseInt(tcs_total_single)+parseInt(gst_single)	
	}
	
    var tcs_single=$("."+a60).val();
   if(tcs_single!='')
   {
   	var tcs_total_single=parseInt(tcs_total_single)+parseInt(tcs_single)	
   }
  $("."+a96).val('').val(parseInt(tcs_total_single))


  //for pg charge claculation
	var pricepgcharges=$("."+a63).val();

		if(pricepgcharges==1)
		{
	
		}
		else if(pricepgcharges==2)
		{
var pg_percentage=$("."+a64).val();



if(pg_percentage!='')
   {
   var tcs_total_adult=$("."+a62).val();
   var tcs_total_exadult=$("."+a92).val();
   var tcs_total_childbed=$("."+a93).val();
   var tcs_total_childwbed=$("."+a94).val();
   var tcs_total_infant=$("."+a95).val();
   var tcs_total_single=$("."+a96).val();
  
  


   if(tcs_total_adult!='')
   {
   	
   	
   	var pg_percentage_into_total_adult=tcs_total_adult*pg_percentage/100;
   		$("."+a65).val('').val(parseInt(pg_percentage_into_total_adult))
   }
  if(tcs_total_exadult!='')
   {

   	var pg_percentage_into_total_exadult=tcs_total_exadult*pg_percentage/100;
   
   	
   		$("."+a66).val('').val(parseInt(pg_percentage_into_total_exadult))
   }
   if(tcs_total_childbed!='')
   {
   	
   	
   	var pg_percentage_into_total_childbed=tcs_total_childbed*pg_percentage/100;
   		$("."+a67).val('').val(parseInt(pg_percentage_into_total_childbed))
   }
   if(tcs_total_childwbed!='')
   {
   	
   	
   	var pg_percentage_into_total_childwbed=tcs_total_childwbed*pg_percentage/100;
   		$("."+a68).val('').val(parseInt(pg_percentage_into_total_childwbed))
   }
   if(tcs_total_infant!='')
   {
   	
   	
   	var pg_percentage_into_total_infant=tcs_total_infant*pg_percentage/100;
   		$("."+a69).val('').val(parseInt(pg_percentage_into_total_infant))
   }
    if(tcs_total_single!='')
   {
   	
   	
   	var pg_percentage_into_total_single=tcs_total_single*pg_percentage/100;
   		$("."+a70).val('').val(parseInt(pg_percentage_into_total_single))
   }
   	
   }
   }
   //for pg group
   var pg_adult=$("."+a65).val();
   var pg_exadult=$("."+a66).val();
   var pg_childbed=$("."+a67).val();
   var pg_childwbed=$("."+a68).val();
   var pg_infant=$("."+a69).val();
   var pg_single=$("."+a70).val();

    var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();

   var pg_group=0;
   if(pg_adult!='' && number_of_adult!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_adult*number_of_adult)
   }
   if(pg_exadult!='' && number_of_extra_adult!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_exadult*number_of_extra_adult)
   }
   if(pg_childbed!='' && number_of_child_with_bed!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_childbed*number_of_child_with_bed)
   }
   if(pg_childwbed!='' && number_of_child_without_bed!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_childwbed*number_of_child_without_bed)
   }
   if(pg_infant!='' && number_of_infant!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_infant*number_of_infant)
   }
   if(pg_single!='' && number_solo_traveller!='')
   {
   	 var pg_group=parseInt(pg_group)+parseInt(pg_single*number_solo_traveller)
   }
    $("."+a71).val('').val(parseInt(pg_group))
    //for grand total
	var grand_total_adult=0;
   var total_tcs_adult=$("."+a62).val();
	if(total_tcs_adult!='')
	{
	var grand_total_adult=parseInt(grand_total_adult)+parseInt(total_tcs_adult)	
	}
	
    var pg_total_adult=$("."+a65).val();
   if(pg_total_adult!='')
   {
   	var grand_total_adult=parseInt(grand_total_adult)+parseInt(pg_total_adult)	
   }
  $("."+a72).val('').val(parseInt(grand_total_adult))
  var grand_total_exadult=0;
  var total_tcs_exadult=$("."+a92).val();
  if(total_tcs_exadult!='')
	{
	var grand_total_exadult=parseInt(grand_total_exadult)+parseInt(total_tcs_exadult)	
	}
  var pg_total_exadult=$("."+a66).val();
   if(pg_total_exadult!='')
   {
   	var grand_total_exadult=parseInt(grand_total_exadult)+parseInt(pg_total_exadult)	
   }

$("."+a110).val('').val(parseInt(grand_total_exadult))

 var grand_total_childbed=0;
  var total_tcs_childbed=$("."+a93).val();
  if(total_tcs_childbed!='')
	{
	var grand_total_childbed=parseInt(grand_total_childbed)+parseInt(total_tcs_childbed)	
	}
  var pg_total_childbed=$("."+a67).val();
   if(pg_total_childbed!='')
   {
   	var grand_total_childbed=parseInt(grand_total_childbed)+parseInt(pg_total_childbed)	
   }

$("."+a111).val('').val(parseInt(grand_total_childbed))

 var grand_total_childwbed=0;
  var total_tcs_childwbed=$("."+a94).val();
  if(total_tcs_childwbed!='')
	{
	var grand_total_childwbed=parseInt(grand_total_childwbed)+parseInt(total_tcs_childwbed)	
	}
  var pg_total_childwbed=$("."+a68).val();
   if(pg_total_childwbed!='')
   {
   	var grand_total_childwbed=parseInt(grand_total_childwbed)+parseInt(pg_total_childwbed)	
   }

$("."+a112).val('').val(parseInt(grand_total_childwbed))

 var grand_total_infant=0;
  var total_tcs_infant=$("."+a95).val();
  if(total_tcs_infant!='')
	{
	var grand_total_infant=parseInt(grand_total_infant)+parseInt(total_tcs_infant)	
	}
  var pg_total_infant=$("."+a69).val();
   if(pg_total_infant!='')
   {
   	var grand_total_infant=parseInt(grand_total_infant)+parseInt(pg_total_infant)	
   }

$("."+a113).val('').val(parseInt(grand_total_infant))

var grand_total_single=0;
  var total_tcs_single=$("."+a96).val();
  if(total_tcs_single!='')
	{
	var grand_total_single=parseInt(grand_total_single)+parseInt(total_tcs_single)	
	}
  var pg_total_single=$("."+a70).val();
   if(pg_total_single!='')
   {
   	var grand_total_single=parseInt(grand_total_single)+parseInt(pg_total_single)	
   }

$("."+a114).val('').val(parseInt(grand_total_single))

   //for total per number of guest
	var total_number_of_guest_according_adult=0;
	var total_number_of_guest_according_exadult=0;
	var total_number_of_guest_according_childbed=0;
	var total_number_of_guest_according_childwbed=0;
	var total_number_of_guest_according_infant=0;
	var total_number_of_guest_according_single=0;
   var grand_total_adult=$("."+a72).val();
   var grand_total_exadult=$("."+a110).val();
   var grand_total_childbed=$("."+a111).val();
   var grand_total_childwbed=$("."+a112).val();
   var grand_total_infant=$("."+a113).val();
    var grand_total_single=$("."+a114).val();

   var number_of_adult=$("."+a75).val();
   var number_of_extra_adult=$("."+a76).val();
   var number_of_child_with_bed=$("."+a77).val();
   var number_of_child_without_bed=$("."+a78).val();
   var number_of_infant=$("."+a79).val();
   var number_solo_traveller=$("."+a80).val();


	if(grand_total_adult!='' && number_of_adult!='')
	{
	var total_number_of_guest_according_adult=parseInt(total_number_of_guest_according_adult)+parseInt(grand_total_adult*number_of_adult)	
	}
	
   
  $("."+a73).val('').val(parseInt(total_number_of_guest_according_adult))

  if(grand_total_exadult!='' && number_of_extra_adult!='')
	{
	var total_number_of_guest_according_exadult=parseInt(total_number_of_guest_according_exadult)+parseInt(grand_total_exadult*number_of_extra_adult)	
	}
	$("."+a81).val('').val(parseInt(total_number_of_guest_according_exadult))

if(grand_total_childbed!='' && number_of_child_with_bed!='')
	{
	var total_number_of_guest_according_childbed=parseInt(total_number_of_guest_according_childbed)+parseInt(grand_total_childbed*number_of_child_with_bed)	
	}
	$("."+a82).val('').val(parseInt(total_number_of_guest_according_childbed))
   if(grand_total_childwbed!='' && number_of_child_without_bed!='')
	{
	var total_number_of_guest_according_childwbed=parseInt(total_number_of_guest_according_childwbed)+parseInt(grand_total_childwbed*number_of_child_without_bed)	
	}
	$("."+a83).val('').val(parseInt(total_number_of_guest_according_childwbed))

	if(grand_total_infant!='' && number_of_infant!='')
	{
	var total_number_of_guest_according_infant=parseInt(total_number_of_guest_according_infant)+parseInt(grand_total_infant*number_of_infant)	
	}
	$("."+a84).val('').val(parseInt(total_number_of_guest_according_infant))

	if(grand_total_single!='' && number_solo_traveller!='')
	{
	var total_number_of_guest_according_single=parseInt(total_number_of_guest_according_single)+parseInt(grand_total_single*number_solo_traveller)	
	}
	$("."+a85).val('').val(parseInt(total_number_of_guest_according_single))
	//for price to pay
	var price_to_pay=0;
	if($("."+a73).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a73).val())	
	}
	if($("."+a81).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a81).val())	
	}
	if($("."+a82).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a82).val())	
	}
	if($("."+a83).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a83).val())	
	}
	if($("."+a84).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a84).val())	
	}
	if($("."+a85).val()!='')
	{
var price_to_pay=parseInt(price_to_pay)+parseInt($("."+a85).val())	
	}
$("."+a167).val('').val(parseInt(price_to_pay))
//


	//
		
	}


jQuery("#show_part_payment").change(function () {
    var ischecked = $(this).is(':checked');
    var quote1_pricetopay=$('.quote1_pricetopay').val();
    if(quote1_pricetopay=='')
    {
    	quote1_pricetopay=0;
    }
    if (ischecked) {
        jQuery('.part_payment').each(function(){
       $(this).css('display', 'block');
        $('.advance_payment_percentage').val('')
        $('.quote1_advance_payment').val('').val(quote1_pricetopay)
        $('.first_part_percentage').val('')
        $('.quote1_first_part').val('')
        $('.second_part_percentage').val('')
        $('.quote1_second_part').val('')
         $('.quote1_total_payment').val('').val(quote1_pricetopay)
        })
    } else {

    	 jQuery('.part_payment').each(function(){
       $(this).css('display', 'none');
        })

    }
});


$(document).on("focusout change",".advance_payment,.advance_payment_percentage,.quote1_advance_payment",function(){
var quote1_pricetopay=$('.quote1_pricetopay').val();
var advance_payment=$('.advance_payment').val();

if(advance_payment==1)
{
$('.advance_payment_percentage').val('')
$(".quote1_advance_payment").removeAttr('readonly','')

}
else if(advance_payment==2)
{
	$(".quote1_advance_payment").attr('readonly','')
var advance_payment_percentage=$(".advance_payment_percentage").val();
if(advance_payment_percentage!='')
   {
var advance_into_total=quote1_pricetopay*advance_payment_percentage/100;
  $(".quote1_advance_payment").val('').val(parseInt(advance_into_total))

   	}
}
var quote1_advance_payment=$('.quote1_advance_payment').val();
if(parseInt(quote1_advance_payment)==0 || quote1_advance_payment=='')
{

$("#quote1_advance_payment_error").html('').html('Advance Amount Cannot be Zero')
 $('.quote1_advance_payment').val('').val(quote1_pricetopay)	
$(".quote1_first_part").attr('readonly','')
$(".quote1_first_part").val('')
$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')
}

else if(parseInt(quote1_advance_payment)<parseInt(quote1_pricetopay))
{
var first_payment_bal=parseInt(quote1_pricetopay)-parseInt(quote1_advance_payment);

$(".quote1_first_part").removeAttr('readonly','')
$(".quote1_first_part").val('').val(first_payment_bal)
$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')
$("#quote1_advance_payment_error").html('')
}
else if(parseInt(quote1_advance_payment)>parseInt(quote1_pricetopay))
{
$("#quote1_advance_payment_error").html('').html('Advance Amount Cannot be greater than total amount')	
setTimeout(function() {
  $('#quote1_advance_payment_error').html('');
}, 1000);

	

 $('.quote1_advance_payment').val('').val(quote1_pricetopay)	
$(".quote1_first_part").attr('readonly','')
$(".quote1_first_part").val('')
$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')

}
else
{
$(".quote1_first_part").attr('readonly','')
$(".quote1_first_part").val('')
$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')


}

 $('.quote1_total_payment').val('').val(parseInt(quote1_pricetopay))
})
//
$(document).on("focusout change",".first_part_payment,.first_part_percentage,.quote1_first_part",function(){
var quote1_pricetopay=$('.quote1_pricetopay').val();
var first_part_payment=$('.first_part_payment').val();
var attr = $(this).attr('readonly');
if (typeof attr !== 'undefined' && attr !== false) {
    // ...
}
else
{

if(first_part_payment==1)
{
$('.first_part_percentage').val('')
$(".quote1_first_part").removeAttr('readonly','')

}
else if(first_part_payment==2)
{
	$(".quote1_first_part").attr('readonly','')
var first_part_percentage=$(".first_part_percentage").val();
if(first_part_percentage!='')
   {
var advance_into_total=quote1_pricetopay*first_part_percentage/100;
  $(".quote1_first_part").val('').val(parseInt(advance_into_total))

   	}
}
var quote1_advance_payment=$('.quote1_advance_payment').val();
var quote2_advance_payment=$('.quote1_first_part').val();
if(quote1_advance_payment!='' && quote2_advance_payment!='')
{
var total_two_payment=parseInt(quote1_advance_payment)+parseInt(quote2_advance_payment)
}

if(parseInt(quote2_advance_payment)==0 || quote2_advance_payment=='')
{
	var sec_payment_bal=parseInt(quote1_pricetopay)-parseInt(quote1_advance_payment);

	$("#quote1_first_part_error").html('').html('1st Part Payment Cannot be Zero')
	setTimeout(function() {
  $('#quote1_first_part_error').html('');
}, 1000)

$('.quote1_first_part').val('').val(sec_payment_bal)	

$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')
}

else if(parseInt(total_two_payment)>parseInt(quote1_pricetopay))
{
	var sec_payment_bal=parseInt(quote1_pricetopay)-parseInt(quote1_advance_payment);

$("#quote1_first_part_error").html('').html('1st Part Payment Cannot be greater than sum of Advance & total amount')
setTimeout(function() {
  $('#quote1_first_part_error').html('');
}, 1000);
if(sec_payment_bal==0)
{
	$(".quote1_second_part").val('')
}
else
{
$(".quote1_second_part").val('').val(sec_payment_bal)
}



$(".quote1_second_part").val('')

$(".quote1_second_part").attr('readonly','')

}
else if(parseInt(total_two_payment)<=parseInt(quote1_pricetopay))
{
var sec_payment_bal=parseInt(quote1_pricetopay)-parseInt(total_two_payment);

if(sec_payment_bal==0)
{
	$(".quote1_second_part").val('')
}
else
{
$(".quote1_second_part").val('').val(sec_payment_bal)
}



}

$('.quote1_total_payment').val('').val(parseInt(quote1_pricetopay))

	
}
})
//
//
// $(document).on("focusout change",".second_part_payment,.second_part_percentage,.quote1_second_part",function(){
// var quote1_pricetopay=$('.quote1_pricetopay').val();
// var second_part_payment=$('.second_part_payment').val();

// if(second_part_payment==1)
// {
// $('.second_part_percentage').val('')


// }
// else if(second_part_payment==2)
// {
// var second_part_percentage=$(".second_part_percentage").val();
// if(second_part_percentage!='')
//    {
// var advance_into_total=quote1_pricetopay*second_part_percentage/100;
//   $(".quote1_second_part").val('').val(parseInt(advance_into_total))

//    	}
// }
// var quote1_advance_payment=$('.quote1_advance_payment').val();
// var quote2_advance_payment=$('.quote1_first_part').val();
// var quote3_advance_payment=$('.quote1_second_part').val();

// if(quote1_advance_payment!='' && quote2_advance_payment!='' && quote3_advance_payment!='')
// {
// var total_three_payment=parseInt(quote1_advance_payment)+parseInt(quote2_advance_payment)+parseInt(quote3_advance_payment)
// }

// if(quote1_advance_payment!='' && quote2_advance_payment!='')
// {
// var total_two_payment=parseInt(quote1_advance_payment)+parseInt(quote2_advance_payment)
// }

// if(parseInt(quote3_advance_payment)==0)
// {
// 	var sec_payment_bal=parseInt(quote1_pricetopay)-parseInt(total_two_payment);
// alert('2nd Part Payment Cannot be Zero')
// $('.quote1_second_part').val('').val(sec_payment_bal)	


// }

// else if(parseInt(total_three_payment)>parseInt(quote1_pricetopay))
// {
// 	var sec_payment_bal=parseInt(quote1_pricetopay)-parseInt(total_two_payment);
// alert('2nd Part Payment Cannot be greater than sum of Advance & total amount')
// $('.quote1_second_part').val('').val(sec_payment_bal)	

// }
// $('.quote1_total_payment').val('').val(parseInt(quote1_pricetopay))

// })
//

jQuery("#show_direct_part").change(function () {
    var ischecked = $(this).is(':checked');
 
  
    if (ischecked) {
       $(".direct_part").css('display', 'block');
    } else {

    	$(".direct_part").css('display', 'none');

    }
});




	//
$(document).ready(function(){
	var pricemarkup=$(".pricemarkup").val();
	if(pricemarkup=='2')
	{
		$(".markup_percentage").css("display","block")
	}
	else
	{
		$(".markup_percentage").css("display","none")
	}
	$(".pricemarkup").change(function(){
			var pricemarkup=$(this).val();
			if(pricemarkup=='2')
	{
		$(".markup_percentage").css("display","block")
	}
	else
	{
		$(".markup_percentage").css("display","none")
	}
	})
	//
	var pricediscountpositive=$(".pricediscountpositive").val();
	if(pricediscountpositive=='2')
	{
		$(".discountpositive_percentage").css("display","block")
	}
	else
	{
		$(".discountpositive_percentage").css("display","none")
	}
	$(".pricediscountpositive").change(function(){
			var pricediscountpositive=$(this).val();
			if(pricediscountpositive=='2')
	{
		$(".discountpositive_percentage").css("display","block")
	}
	else
	{
		$(".discountpositive_percentage").css("display","none")
	}
	})
		//
	var pricediscountnegative=$(".pricediscountnegative").val();
	if(pricediscountnegative=='2')
	{
		$(".discountnegative_percentage").css("display","block")
	}
	else
	{
		$(".discountnegative_percentage").css("display","none")
	}
	$(".pricediscountnegative").change(function(){
			var pricediscountnegative=$(this).val();
			if(pricediscountnegative=='2')
	{
		$(".discountnegative_percentage").css("display","block")
	}
	else
	{
		$(".discountnegative_percentage").css("display","none")
	}
	})
	//
	var pricegst=$(".pricegst").val();
	if(pricegst=='2')
	{
		$(".gst_percentage").css("display","block")
	}
	else
	{
		$(".gst_percentage").css("display","none")
	}
	$(".pricegst").change(function(){
			var pricegst=$(this).val();
			if(pricegst=='2')
	{
		$(".gst_percentage").css("display","block")
	}
	else
	{
		$(".gst_percentage").css("display","none")
	}
	})
	//
	var pricetcs=$(".pricetcs").val();
	if(pricetcs=='2')
	{
		$(".tcs_percentage").css("display","block")
	}
	else
	{
		$(".tcs_percentage").css("display","none")
	}
	$(".pricetcs").change(function(){
			var pricetcs=$(this).val();
			if(pricetcs=='2')
	{
		$(".tcs_percentage").css("display","block")
	}
	else
	{
		$(".tcs_percentage").css("display","none")
	}
	})
	//
	var pricepgcharges=$(".pricepgcharges").val();
	if(pricepgcharges=='2')
	{
		$(".pgcharges_percentage").css("display","block")
	}
	else
	{
		$(".pgcharges_percentage").css("display","none")
	}
	$(".pricepgcharges").change(function(){
			var pricepgcharges=$(this).val();
			if(pricepgcharges=='2')
	{
		$(".pgcharges_percentage").css("display","block")
	}
	else
	{
		$(".pgcharges_percentage").css("display","none")
	}
	})
	//
	var advance_payment=$(".advance_payment").val();
	if(advance_payment=='2')
	{
		$(".advance_payment_percentage").css("display","block")
	}
	else
	{
		$(".advance_payment_percentage").css("display","none")
	}
	$(".advance_payment").change(function(){
			var advance_payment=$(this).val();
			if(advance_payment=='2')
	{
		$(".advance_payment_percentage").css("display","block")
	}
	else
	{
		$(".advance_payment_percentage").css("display","none")
	}
	})
	//
	var first_part_payment=$(".first_part_payment").val();
	if(first_part_payment=='2')
	{
		$(".first_part_percentage").css("display","block")
	}
	else
	{
		$(".first_part_percentage").css("display","none")
	}
	$(".first_part_payment").change(function(){
			var first_part_payment=$(this).val();
			if(first_part_payment=='2')
	{
		$(".first_part_percentage").css("display","block")
	}
	else
	{
		$(".first_part_percentage").css("display","none")
	}
	})
	//
	var second_part_payment=$(".second_part_payment").val();
	if(second_part_payment=='2')
	{
		$(".second_part_percentage").css("display","block")
	}
	else
	{
		$(".second_part_percentage").css("display","none")
	}
	$(".second_part_payment").change(function(){
			var second_part_payment=$(this).val();
			if(second_part_payment=='2')
	{
		$(".second_part_percentage").css("display","block")
	}
	else
	{
		$(".second_part_percentage").css("display","none")
	}
	})
	//
	

})

//





















	//
$(document).ready(function(){
	$('.datepicker_s').datepicker({
     format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    startDate: '0d'
});
})

 $(document).on("change",".propertysource",function(){
var propertysource = $(this).val();
var propertyname = $(this).parent().siblings(".propertyname");
var selectproperty = $(this).parent().siblings(".selectproperty");
if(propertysource=='manual')
{
$(this).parent().siblings(".selectpropertystar").css('display','none')	
$(this).parent().siblings(".selectproperty").css('display','none')	
 $(this).parent().siblings(".propertyname").css('display','block')	
 $(this).parent().siblings(".selectpropertynamestar").css('display','block')
}
else if(propertysource=='packagehoteldatabase')
{
var city_name =$(this).parent().siblings(".quote_city_class").children(".quote_city").val()
var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
var hotel_class = $(this).parent().siblings().children(".quote_hotel")
  if(propertysource=='packagehoteldatabase')
    {
    	fetch_hotel_name(city_name,propertytype,hotel_class)
    }
$(this).parent().siblings(".selectpropertystar").css('display','block')	
$(this).parent().siblings(".selectproperty").css('display','block')	
 $(this).parent().siblings(".propertyname").css('display','none')	
 $(this).parent().siblings(".selectpropertynamestar").css('display','none')
}
else
{
$(this).parent().siblings(".selectpropertystar").css('display','none')	
$(this).parent().siblings(".selectproperty").css('display','none')	
 $(this).parent().siblings(".propertyname").css('display','none')	
 $(this).parent().siblings(".selectpropertynamestar").css('display','none')
}	
 })
 //
 $(document).on("change",".propertytype",function(){
 var city_name =$(this).parent().parent().siblings(".quote_city_class").children(".quote_city").val()
var propertytype= $(this).val()
var hotel_class = $(this).parent().parent().siblings().children(".quote_hotel")
var propertysource= $(this).parent().parent().siblings(".propertysource_class").children(".propertysource").val()

  if(propertysource=='packagehoteldatabase')
    {
    	fetch_hotel_name(city_name,propertytype,hotel_class)
    }
 })
        
//
 $(document).on('keyup', '.quote_city', function () {
 	var city_name = $(this).val()
        var propertytype= $(this).parent().siblings(".propertytype_class").children(".form-group").children(".propertytype").val()
        var propertysource= $(this).parent().siblings(".propertysource_class").children(".propertysource").val()
        

        var hotel_class = $(this).parent().siblings().children(".quote_hotel")
        var city_value = $(".quote_city").map(function () {
            return $(this).val();
        }).get();

        var button=$(this)
         $(this).typeahead({
            source: function (city_name, process) {
                return $.get(APP_URL + "/autocomplete", { city_name: city_name }, function (data) {
                    return process(data);
                });
            }
        });
    if(propertysource=='packagehoteldatabase')
    {
    	fetch_hotel_name(city_name,propertytype,hotel_class)
    }
   
          
       
       //


        //
       

    })
 function fetch_hotel_name(city_name,propertytype,hotel_class)
 {
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
 $(document).on("change",".quote_hotel",function(){
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

 })
</script>
<!-- /.content-wrapper -->
@endsection
