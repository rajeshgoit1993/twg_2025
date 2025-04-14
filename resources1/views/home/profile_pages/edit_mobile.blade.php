<div class="modal fade my-profile-modal" id="profile_mobile_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content cont">
      <div class="make-sticky-header whitebg" style="border-radius: 5px 5px 0 0;">
        <div class="modal-header wrapper">
          <button type="button" class="close close-my-profile-modal" data-dismiss="modal">&times;</button>
          <h4>Add Mobile No.</h4>
        </div>
      </div>
      <div class="modal-body box">
        <form action="{{ url('update_user_mobile') }}" method="post" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="clearfix">
            <!-- country code -->
            <div class="col-md-3">
              <div class="form-group select-arrow down">
              	<label for="country_code">Country Code</label>
                <select id="country_code" name="country_code" required></select>
                <!-- <p class="error" id="country_code_error"></p> -->
              </div>
            </div>
            <!-- mobile no -->
            <div class="col-md-9">
              <div class="form-group">
                <label for="phone_no">Mobile No</label>
                <div class="relativeCont">
                  <input type="text" id="phone_no" name="mobile" maxlength="10" pattern="[0-9]{1,10}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter mobile no." @if($user_details!='' && $user_details->phone_no!='') value="{{ $user_details->phone_no }}" @endif required>
                  <!-- <p class="error" id="mobile_error"></p> -->
                </div>
              </div>
            </div>
          </div>
          <!-- footer -->
          <div class="make-sticky-footer">
            <div class="modal-footer wrapper">
              <button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
              <button type="submit" name="save" class="btn-main save">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>