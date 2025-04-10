<!-- Lead Service Status Modal -->
<form class="user" id="update_service_status" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <div id="service_type_modal" class="modal modal_js">
        <div class="modalContent lead-modalbox">
            <!-- Modal content starts-->

            <!-- Modal header -->
            <div class="make_top_bar_sticky">
                <div class="lead-modalheader">
                    <h2>Service Status</h2>
                </div>
            </div>

            <!-- enq ref no and quote ref no -->
            <div class="col-md-12">
				<div class="form-group">
					<!-- enquiry ref no -->
					<i><div class="enq-ref-no">Enquiry Ref No: #<span class="enq_ref_no"></span></div></i>

					<!-- quote ref no -->
					<div class="quote-ref-no">Quote Ref No: #<span class="quote_ref_no"></span></div>
				</div>
			</div>

            <!-- Modal body -->
            <div class="lead-modalbody lead_modalbody_service_status">
                <!-- Dynamic content will be injected here -->
            </div>

            <!-- Modal footer -->
            <div class="make_bottom_bar_sticky">
                <div class="lead-modalfooter">
                    <button type="button" class="btn_lead_modal_close btn_service_type_close" id="btn_service_type_close">Cancel</button>
                    <button type="submit" class="btn_lead_modal_update">Update</button>
                </div>
            </div>

            <!-- Modal content ends -->
        </div>
    </div>
</form>


<script type="text/javascript">
/* Collapsible Button Script for Bootstrap Modal */

/*$(document).ready(function () {
    // Get all elements with the class "collapsible"
    var coll = document.getElementsByClassName("collapsible");
    var i;

    // Loop through each collapsible element
    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class to change button appearance
            this.classList.toggle("active");

            // Get the next sibling element which should be the content to show/hide
            var contents = this.nextElementSibling;

            // If the content is already expanded, collapse it by setting maxHeight to null
            if (contents.style.maxHeight) {
                contents.style.maxHeight = null;
            } 
            // Otherwise, expand the content by setting its maxHeight to its scrollHeight
            else {
                contents.style.maxHeight = contents.scrollHeight + "px";
            }
        });
    }
    
    // Ensure collapsible elements work correctly within Bootstrap modals
    $('#update_service_status').on('shown.bs.modal', function () {
        var coll = document.getElementsByClassName("collapsible");
        for (i = 0; i < coll.length; i++) {
            var contents = coll[i].nextElementSibling;
            if (coll[i].classList.contains("active")) {
                contents.style.maxHeight = contents.scrollHeight + "px";
            }
        }
    });
});*/

</script>
<script type="text/javascript">
/*collapsible button script*/
	/*var coll = document.getElementsByClassName("collapsible");
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
		}*/
</script>