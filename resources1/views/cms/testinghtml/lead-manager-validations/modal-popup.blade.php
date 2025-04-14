@extends('layouts.front.master')
@if(env("WEBSITENAME")==1)
@section("title", 'The World Gateway')
@elseif(env("WEBSITENAME")==0)
@section("title", 'RapidexTravels')
@endif

@section('content')

 <style type="text/css">
.leadModalbox {
	padding: 20px;
	background: #f2f2f2;
	margin: 0px auto;
	display: flex;
    justify-content: center;
	}
</style>
<style type="text/css">
/*Lead Validation Modal Box CSS*/
</style>

<!-- Lead Modal Popup CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/views/cms/testinghtml/lead-manager-validations/modal-popup/css/modal-popup.css') }}" />
<!-- Lead Modal CSS -->
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/views/cms/testinghtml/lead-manager-validations/modal-popup/css/leadvalidation.css') }}" />

<section>
<div class="leadModalbox">
	<button class="btn_lead_modal_update" id="addModal">Service Status</button>
	<!-- <button class="btn_lead_modal_update" id="addModal">Lead Cancelled</button> -->
	<!-- <button class="btn_lead_modal_update" id="addModal">Lead Follow-up</button> -->
	<!-- <button class="btn_lead_modal_update" id="addModal">Add Payment</button> -->
</div>

</section>
<!--Lead Cancelled Modal starts-->
@include('cms.testinghtml.lead-manager-validations.modal-popup.service-status')
<!--Lead Cancelled Modal ends-->

<!--Lead Cancelled Modal starts-->
@include('cms.testinghtml.lead-manager-validations.modal-popup.lead-cancelled')
<!--Lead Cancelled Modal ends-->

<!--Lead Follow-up Modal starts-->
@include('cms.testinghtml.lead-manager-validations.modal-popup.lead-follow-up')
<!--Lead Follow-up Modal ends-->

<!--Add Payment Modal starts-->
@include('cms.testinghtml.lead-manager-validations.modal-popup.add-payment')
<!--Add Payment Modal ends-->

<script type="text/javascript" src='{{ asset ("/resources/views/cms/testinghtml/lead-manager-validations/modal-popup/css/modalpopup.js") }}'></script>
<script>
//Modal Popup
//<!--collapsible button script-->
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
	coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var contents = this.nextElementSibling;
		if (contents.style.maxHeight){
			contents.style.maxHeight = null;
			}
		else {
			contents.style.maxHeight = contents.scrollHeight + "px";
			}
		});
	}
</script>
@endsection