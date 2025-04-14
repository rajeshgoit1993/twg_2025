 <form action="{{url('/update_user_traveller')}}" name="change_password" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id" value="{{$data->id}}">
  <div class="addGuestInfoCont">
    <div class="addGuestInfoBox">
    <!--Traveller's Information-->
    <div class="boxHeader">
      <div>
        <h1 class="">Add Traveller's Info</h1>
      </div>
      <div class="deleteInfo delete_traveller" id="{{$data->id}}" style="display: block"><i class="fa-trash" aria-hidden="true"></i>Delete</div>
    </div>
    <div class="infoCont">
      <ul>
        <li><a class="active" href="#basicinfo">BASIC INFO</a></li>
        <li><a href="#passportinfo">PASSPORT</a></li>
      </ul>
    </div>
    <!--Basic Info-->
    <div id="basicinfo" class="paddingTop20">
      <div class="basicInfoBox">
        <h1>Basic Information</h1>
        <h2>Basic info, like your email and number that you use on Personal Profile</h2>
      </div>
      <div class="row">
      <div class="makeflex">
        <div class="guestInputBox">
          <label for="firstname">First Name <span class="requiredcolor">*</span></label>
          <input type="text" name="firstname" value="{{$data->firstname}}" placeholder="Enter First Name" required>
        </div>
        <div class="guestInputBox">       
          <label for="lastname">Last Name <span class="requiredcolor">*</span></label>
          <input type="text" name="lastname" value="{{$data->lastname}}" placeholder="Enter Last Name" required>
        </div>
      </div>
      <div class="makeflex">
        <div class="guestInputBox">
          <label for="birthday">Birthday <span class="requiredcolor">*</span> </label>
          <!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
          <input type="date" name="dob" value="{{$data->dob}}" placeholder="Enter Date of Birth" required> 
        </div>
        <div class="guestInputBox">
          <label for="gender">Gender <span class="requiredcolor">*</span></label>
          <select name="gender" required>
            <option selected disabled >Select</option>
            <option value="male" @if($data->gender=='male') selected @endif>MALE</option>
            <option value="female" @if($data->gender=='female') selected @endif>FEMALE</option>
          </select>
        </div>
      </div>
      </div>
    </div>
    <div class="lineSeparator"></div>
    <!--Passport Info-->
    <div id="passportinfo" style="margin-bottom: 275px;">
      <div class="passportInfoBox">
        <h1>Passport Details</h1>
        <h2>Add your Passport details for a faster flight booking experience</h2>
      </div>
      <div class="row">
        <div class="makeflex">
        <div class="guestInputBox">
          <label for="passportnumber">Passport Number</label>
          <input type="text" value="{{$data->passportnumber}}" id="passportnumber" name="passportnumber" placeholder="Enter Passport Number" onkeyup="EnableDisable(this)" />
          <span id='validpassport'></span>
        </div>
        <div class="guestInputBox">
          <label for="passportcountry">Issuing Country</label>
          <!--ADD VALIDATION: SHOW COUNTRY LIST-->
          <select id="passportcountry" name="passportcountry">
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
        <div class="makeflex">
        <div class="guestInputBox">
          <label for="passportexpirydate">Expiry Date</label>
          <!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE-->
          <input type="date" value="{{$data->passport_expire_date}}" id="passportexpirydate" name="passport_expire_date" placeholder="Enter Passport Expiry Date"  />
        </div>
        </div>
      </div>
    </div>
    </div>
    <div class="profile_stickyFooter">
      <div class="profileFooterCont">
        <button type="button" class="btnMain btnCancel appendRight30">Cancel</button>
        <input type="submit" id="" name="submit" value="Update" class="btnMain btnSave"/>
      </div>
    </div>
  </div>
<!--</div>-->
</form>