<div class="modal fade my-profile-modal" id="addtraveller" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content cont">
      <div class="make-sticky-header whitebg" style="border-radius: 5px 5px 0 0;">
        <div class="modal-header wrapper">
          <button type="button" class="close close-my-profile-modal" data-dismiss="modal">&times;</button>
          <h4>Add Traveller's Info</h4>
        </div>
      </div>
      <!-- traveller info tab -->
      <div class="make-sticky-header whitebg" style="top: ;">
        <div class="col-md-12">
          <div class="infoCont">
            <ul class="infoTab">
              <a href="#basicinfo" class="scrollLink">
                <li class="scrollItem active">BASIC INFO</li>
              </a>
              <a href="#passportinfo" class="scrollLink">
                <li class="scrollItem">PASSPORT</li>
            </a>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-body traveller-box">
      <form action="{{ url('/add_user_traveller') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="Cont" style="min-height: 1050px;">
          <!--Basic Info-->
          <div id="basicinfo" class="">
            <div class="col-md-12">
              <div class="form-group">
                <div class="basicInfoBox">
                  <h5>Basic Information</h5>
                  <h6>Basic info, like your email and number that you use on Personal Profile</h6>
                </div>
              </div>
            </div>
            <!-- first name -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">First Name <span class="requiredcolor">*</span></label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter first name" required>
              </div>
            </div>
            <!-- last name -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name <span class="requiredcolor">*</span></label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter last name" required>
              </div>
            </div>
            <!-- date of birth -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="dob_traveller">Birthday <span class="requiredcolor">*</span> </label>
                <!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
                <input type="date" id="dob_traveller" name="dob" placeholder="Enter date of birth" required>
              </div>
            </div>
            <!-- gender -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="gender">Gender <span class="requiredcolor">*</span></label>
                <div class="select-arrow down">
                  <select id="gender" name="gender" required>
                    <option selected disabled >Select</option>
                    <option value="male">MALE</option>
                    <option value="female">FEMALE</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="lineSeparator"></div> -->
          <!--Passport Info-->
          <div id="passportinfo">
            <div class="col-md-12">
              <div class="form-group">
                <div class="passportInfoBox">
                  <h5>Passport Details</h5>
                  <h6>Add your Passport details for a faster flight booking experience</h6>
                </div>
              </div>
            </div>
            <!-- passport number -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="passportnumber">Passport Number</label>
              <input type="text" id="passportnumber" name="passportnumber" placeholder="Enter passport number" />
              <span id='validpassport'></span>
              </div>
            </div>
            <!-- passport country -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="passportcountry">Issuing Country</label>
              <div class="select-arrow down">
              <select id="passportcountry" name="passportcountry" disabled>
                <option selected disabled>Select</option>
              </select>
              </div>
            </div>
            </div>
            <div class="col-md-12"></div>
            <!-- passport expiry date -->
            <div class="col-md-6">
              <div class="form-group">
              <label for="passportexpirydate">Expiry Date</label>
              <!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE-->
              <input type="date" id="passportexpirydate" name="passport_expire_date" placeholder="Enter passport expiry date" disabled />
              </div>
            </div>
          </div>
        </div>
        <!-- footer -->
        <div class="make-sticky-footer">
          <div class="modal-footer wrapper">
            <button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
            <!-- <input type="submit" id="" name="submit" value="SAVE" class="btnMain btnSave"/> -->
            <button type="submit" name="save" class="btn-main save">Save</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>