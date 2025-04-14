<div class="row">
<div class="col-md-12">
	<div style="text-align: right;">
	<button class="btn dCallBackBtn user_quote_accept" content_id="{{CustomHelpers::custom_encrypt($data1->id)}}" content_action="{{url('quote_reject')}}">Call Back Request</button>
	<!--<button class="btn dBookReqst user_quote_accept" content_id="{{CustomHelpers::custom_encrypt($data1->id)}}" content_action="{{url('quote_accept')}}">Request to Book</button>-->
	<input type="hidden" name="quote_no" class="quote_no" value="{{CustomHelpers::custom_encrypt(1)}}"> 
    @if(CustomHelpers::get_remaining_amount_second(1)==0)
		<button class="btn btn-success">Paid</button>
	</div>
	@else
		<button class=" btnPayBook pay_now" content_action="{{route('bookingreview')}}">Pay Now</button>
	</div>
    @endif
</div>
</div>