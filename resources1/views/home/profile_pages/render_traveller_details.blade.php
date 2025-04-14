<form action="{{ url('/update_user_traveller') }}" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="Cont" style="min-height: 1050px;">
    <!--Basic Info-->
    <div id="basicinfoedit">
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
            <input type="text" id="firstname" name="firstname" value="{{ $data->firstname }}" placeholder="Enter first name" required>
          </div>
      </div>
        <!-- last name -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="lastname">Last Name <span class="requiredcolor">*</span></label>
          <input type="text" id="lastname" name="lastname" value="{{ $data->lastname }}" placeholder="Enter last name" required>
        </div>
      </div>
      <!-- date of birth -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="dob_traveller">Birthday <span class="requiredcolor">*</span> </label>
          <!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
          <input type="date" id="dob_traveller" name="dob" value="{{ $data->dob }}" placeholder="Enter date of birth" required>
        </div>
      </div>
      <!-- gender -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="gender">Gender <span class="requiredcolor">*</span></label>
          <div class="select-arrow down">
            <select id="gender" name="gender" required>
              <option selected disabled >Select</option>
              <option value="male" @if($data->gender=='male') selected @endif>MALE</option>
              <option value="female" @if($data->gender=='female') selected @endif>FEMALE</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div id="passportinfoedit">
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
          <label for="passportnumberedit">Passport Number</label>
          <input type="text" id="passportnumberedit" value="{{ $data->passportnumber }}" name="passportnumber" placeholder="Enter passport number" />
          <span id='validpassportedit'></span>
        </div>
      </div>
      <!-- passport country -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="passportcountryedit">Issuing Country</label>
          <div class="select-arrow down">
            <select id="passportcountryedit" name="passportcountry">
              <?php
                echo "<option value='0'>Select Nationality</option>";
                foreach($countries as $single):
                  if($single->name==$data->passportcountry):
                    echo "<option value='".$single->name."' selected>".$single->name."</option>";
                    else:
                    echo "<option value='".$single->name."'>".$single->name."</option>";
                  endif;
                endforeach;
              ?>
            </select>
            </div>
        </div>
      </div>
      <div class="col-md-12"></div>
      <!-- passport expiry date -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="passportexpirydateedit">Expiry Date</label>
          <!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE-->
          <input type="date" id="passportexpirydateedit" value="{{ $data->passport_expire_date }}" name="passport_expire_date" placeholder="Enter passport expiry date"/>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <div class="make-sticky-footer">
    <div class="modal-footer wrapper">
      <button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
      <button type="submit" name="save" class="btn-main save">Update</button>
    </div>
  </div>
  <!-- </div> -->
<!--</div>-->
</form>