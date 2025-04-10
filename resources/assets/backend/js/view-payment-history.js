/*quotation*/

//view payment history
$(document).ready(function() {
	$(document).on("click",".payment_history",function(e) {
		e.preventDefault()
		var id = $(this).attr('query_id');
		$.ajax ({
			type:'get',
			url: APP_URL+'/get_payment_history',
			// dataType: 'json',
			data: {id:id},
			success:function(data) {
				$(".view_payment_history_body").html(data)
				$('#view_payment_history_modal').modal('toggle');
				},
			error: function (data) {
				//console.log('Error : '+data);
				}
			});
	});
});