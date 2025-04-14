<div class="modal fade my-profile-modal" id="change_password_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content cont">
      <div class="make-sticky-header whitebg" style="border-radius: 5px 5px 0 0;">
        <div class="modal-header wrapper">
          <button type="button" class="close close-my-profile-modal" data-dismiss="modal">&times;</button>
          <h4>Change Password</h4>
        </div>
      </div>
      <div class="modal-body box">
        <form action="{{ url('/Change-Password') }}" id="passwordChangeForm" name="change_password" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="Cont flex-column" style="row-gap: 10px;">
            <!-- old password -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="old_password" class="mandatoryField">Old Password</label>
                <input type="text" id="old_password" name="old_password" autocomplete="off" placeholder="Enter old password" required />
              </div>
            </div>
            <!-- new password -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="changePswrdNew">New Password</label>
                <div class="relativeCont">
                  <input type="password" class="active" id="changePswrdNew" name="new_password" autocomplete="off" placeholder="Enter new password" />
                  <button type="button" class="showPassword" id="toggleChangePswrdNew">
                    <i id="eyeIconNewPwd" class="fa fa-eye" aria-hidden="true"></i>
                  </button>
                  <p id="changePswrdNewErrorMessage" class="error-message"></p>
                </div>
              </div>
            </div>
            <!-- confirm new password -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="changePswrdConfirm">Confirm New Password</label>
                <div class="relativeCont">
                  <input type="password" class="active" id="changePswrdConfirm" name="confirm_password" autocomplete="off" placeholder="Re-enter new password" />
                  <button type="button" class="showPassword" id="togglechangePswrdConfirm">
                    <i id="eyeIconReconfmPwd" class="fa fa-eye" aria-hidden="true"></i>
                  </button>
                  <p id="changePswrdConfirmErrorMessage" class="error-message"></p>
              </div>
              </div>
            </div>
          </div>
          <!-- footer -->
          <div class="make-sticky-footer">
            <div class="modal-footer wrapper">
              <button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
              <button type="submit" name="save" class="btn-main save disabled" id="btn-change-pwd" disabled="disabled">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>