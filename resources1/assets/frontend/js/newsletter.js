/*newsletter starts*/
$(document).ready(function() {
    jQuery("#sub").submit(function(e) {

            e.preventDefault();

            var sub_email=jQuery("#sub_email").val();
            var APP_URL=jQuery("#testvalue_footer").val();
            var url=APP_URL+'/newsletter';
            var data={sub_email:sub_email,_token:"{{ csrf_token() }}"};

            jQuery.post(url,data,function(rdata) {
                console.log(rdata)
                alert(rdata);
                })
            })
    });
/*newsletter ends*/