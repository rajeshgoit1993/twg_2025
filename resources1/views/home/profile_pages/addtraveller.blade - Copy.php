<style type="text/css">
/*Add Traveller Info (Desktop-Mobile)-popup*/
.appendB275 {
  margin-bottom: 275px;
  }
.addGuestInfoCont {
  /*max-width: 100% !important;
  margin: 0 auto;*/
  }

.addGuestInfoBox {
  padding: 0 13px;
  background-color: #fff;
  }

.boxHeader {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  }
.boxHeader h1 {
  font-size: 25px;
  line-height: 25px;
  color: #000001;
  font-weight: 900;
  text-align: left;
  margin-bottom: 0;
  }


.deleteInfo {
  font-size: 16px;
  line-height: 16px;
  color: #eb2026;
  font-Weight: 900;
  cursor: pointer;
  position: absolute;
  top: 30px;
  right: 20px;
  }


.fa-trash:before {
  content: "\f014";
  display: inline-block;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  color: #eb2026;
  font-size: 18px;
  cursor: unset;
  margin-top: 0;
  margin-right: 5px;
  }
.infoCont {
  /*position: sticky;
  position: -webkit-sticky;
  top: 0;
  z-index: 2;*/
  background-color: #fff;
  border-bottom: 1px solid #ccc;
  padding: 20px 0 0;
  }
.sticky-wrapper {
  position: sticky;
  position: -webkit-sticky;
  top: 0;
  z-index: 2;
  background: #fff;
  /*border-radius: 10px 10px 0 0;*/
  border-bottom: 1px solid #ccc;
  padding-bottom: 0;
  }
.infoCont ul {
  display: flex;
  align-items: center;
  padding-top: 15px;
  }
.infoCont ul li {
  font-size: 16px;
  line-height: 16px;
  color: #000001;
  font-weight: 900;
  cursor: pointer;
  text-align: left;
  padding-bottom: 15px;
  margin-right: 30px;
  }

.infoCont ul li.active {
  color: #008cff;
  padding-bottom: 17px;
  border-bottom: 3px solid #008cff;
  }

.infoCont a.active {
  color: #008cff;
  padding-bottom: 13px;
  border-bottom: 3px solid #008cff;
  }
.infoCont a:hover, a:focus {
  color: #008cff;
  }
.basicInfoBox, .passportInfoBox {
  padding-top: 20px;
  padding-bottom: 20px;
  }
.basicInfoBox h5, .passportInfoBox h5 {
  font-size: 18px;
  line-height: 18px;
  color: #000001;
  font-weight: 900;
  text-align: left;
  margin-bottom: 5px;
  }
.basicInfoBox h6, .passportInfoBox h6 {
  font-size: 14px;
  line-height: 14px;
  color: #4a4a4a;
  font-weight: 500;
  text-align: left;
  margin-bottom: 0;
  }
.guestInputBox {
  width: 50%;
  padding-left: 15px;
  padding-right: 15px;
  margin-bottom: 10px;
  }
.guestInputBox label {
  color: #000001 !important;
  font-size: 14px !important;
  line-height: 14px !important;
  }
.guestInputBox input[type="text"], .guestInputBox select, .guestInputBox input[type=date] {
  width: 100%;
  text-transform: capitalize;
  font-size: 14px;
  line-height: 14px;
  color: #000001;
  font-weight: 500;
  text-align: left;
  background: #fff;
  border: 1px solid #9b9b9b;
  border-radius: 4px;
  height: 43px;
  outline: none
  }
.guestInputBox input:focus, .guestInputBox select:focus {
  border-color: #008cff;
  box-shadow: none;
  }
.lineSeparator {
  border-bottom: 4px solid #f0f0f0;
  margin-top: 15px;
  margin-bottom: 20px;
  }
.profile_stickyFooter {
  position: sticky;
  z-index: 1;
  bottom: 0;
  position: relative;
  /*background-color: #fff;
  border-radius: 0 0 10px 10px;*/
  }
.profileFooterCont {
  padding: 10px 20px;
  border-top: 1px solid #CED0D4;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  }
.btnCancel {
    cursor: pointer;
  flex-shrink: 0;
  outline: 0;
  text-transform: none;
  color: #4a4a4a;
  font-weight: 500;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 20px;
  border: 1px solid #fff;
  border-radius: 4px;
  background: #fff;
  }
.btnCancel:hover {
  background: #fff;
  color: #4a4a4a;
  }
.btnSave {
  cursor: pointer;
  flex-shrink: 0;
  outline: 0;
  text-transform: uppercase;
  color: #fff;
  font-weight: 900;
  padding: 6px 12px;
  font-size: 18px;
  line-height: 20px;
  border: 1px solid #fff;
  border-radius: 20px;
  background: #008cff;
  width: 120px;
  height: 40px;
  }
.btnSave:hover {
  background: #008cff;
  color: #fff;
  }
/*Add Traveller Info (Desktop-Mobile)-popup ENDS*/

.ui-datepicker {
  z-index: 1040!important;
}

.inftoTab {
  display: flex;
  align-items: center;
  padding-top: 15px;
  overflow: hidden;
  background-color: #fff;
  }
/* Style the tab content */
.tabContent {
  display: none;
  border-top: none;
  }
</style>

<!-- <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.t_tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style> -->


<div class="modal fade my-profile-modal" id="addtraveller" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content cont">
      <div class="make-sticky" style="border-radius: 5px 5px 0 0;">
        <div class="modal-header wrapper">
        <!-- <button type="button" class="close close-my-profile-modal">&times;</button> -->
        <h4>Add Traveller's Info</h4>
        <div class="deleteInfo"><i class="fa-trash" aria-hidden="true"></i>Delete</div>
      </div>
    </div>
      <form action="{{ url('/add_user_traveller') }}" id="traveller_info" name="change_password" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body box" style="min-height: 600px;padding-top: 0;">
        <!-- <div class="addGuestInfoCont"> -->
        <!-- <div> -->
        <!-- <div class="addGuestInfoBox" style="padding-top: 0;"> -->
        <!-- <div style="height: 700px"> -->
        <!--Traveller's Information-->
        <!-- <div class="boxHeader">
        <div>
        <h1 class="">Add Traveller's Info</h1>
        </div>
        <div class="deleteInfo" style="display: block"><i class="fa-trash" aria-hidden="true"></i>Delete</div>
        </div> -->
        <!-- traveller info tab -->
        <div class=" make-sticky" style="top: 75px;">
          <div class="col-md-12">
          <div class="infoCont">
            <ul class="inftoTab" style="padding-top: 0">
              <li class="tablinks" id="defaultOpen" onclick="openInfo(event, 'basicinfo')">BASIC INFO</li>
              <li class="tablinks" onclick="openInfo(event, 'passportinfo')">PASSPORT</li>
            </ul>
          </div>
          </div>
          <!-- <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'basicInfo')" id="defaultOpen">Basic Info</button>
          <button class="tablinks" onclick="openTab(event, 'passportInfo')">Passport Info</button>
          </div> -->
          <!-- <ul>
            <li><a class="active" href="#basicinfo">BASIC INFO</a></li>
            <li><a href="#passportinfo">PASSPORT</a></li>
          </ul> -->
        </div>
        <!--Basic Info-->
        <!-- <div id="basicinfo" class="paddingTop20 t_tabcontent"> -->
        <div id="basicinfo" class="tabContent paddingTop20">
          <div class="col-md-12">
            <div class="form-group">
            <div class="basicInfoBox">
              <h5>Basic Information</h5>
              <h6>Basic info, like your email and number that you use on Personal Profile</h6>
            </div>
            </div>
          </div>
          <!-- <div class="row"> -->
          <!-- <div class="makeflex"> -->
            <!-- <div class="guestInputBox"> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">First Name <span class="requiredcolor">*</span></label>
                <input type="text" name="firstname" placeholder="Enter First Name" required>
              </div>
            </div>
            <!-- <div class="guestInputBox"> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name <span class="requiredcolor">*</span></label>
                <input type="text" name="lastname" placeholder="Enter Last Name" required>
              </div>
            </div>
          <!-- </div> -->
          <!-- <div class="makeflex"> -->
            <!-- <div class="guestInputBox"> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="profile_dob">Birthday <span class="requiredcolor">*</span> </label>
                <!--ADD VALIDATION: BIRTHDAY CANNOT BE GREATER THAN TODAY-->
                <!-- <input type="date" name="dob" placeholder="Enter Date of Birth" required> -->
                <input type="text" id="profile_dob" name="dob">
              </div>
            </div>
            <!-- <div class="guestInputBox"> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="gender">Gender <span class="requiredcolor">*</span></label>
                <div class="select-arrow down">
                <select name="gender" required>
                  <option selected disabled >Select</option>
                  <option value="male">MALE</option>
                  <option value="female">FEMALE</option>
                </select>
                </div>
              </div>
            </div>
          <!-- </div> -->
          <!-- </div> -->
        </div>
        <!-- <div class="lineSeparator"></div> -->
        <!--Passport Info-->
        <!-- <div id="passportinfo" class="t_tabcontent" style="margin-bottom: 275px;"> -->
        <div id="passportinfo" class="tabContent paddingTop20">
          <div class="col-md-12">
            <div class="form-group">
            <div class="passportInfoBox">
            <h5>Passport Details</h5>
            <h6>Add your Passport details for a faster flight booking experience</h6>
            </div>
            </div>
          </div>
          <!-- <div class="row"> -->
          <!-- <div class="makeflex"> -->
          <!-- passport number -->
          <!-- <div class="guestInputBox"> -->
          <div class="col-md-6">
            <div class="form-group">
            <label for="passportnumber">Passport Number</label>
            <input type="text" id="passportnumber" name="passportnumber" placeholder="Enter Passport Number" onkeyup="EnableDisable(this)" />
            <span id='validpassport'></span>
            </div>
          </div>
          <!-- passport country -->
          <!-- <div class="guestInputBox"> -->
          <div class="col-md-6">
            <div class="form-group">
            <label for="passportcountry">Issuing Country</label>
            <!--ADD VALIDATION: SHOW COUNTRY LIST-->
            <div class="select-arrow down">
            <select id="passportcountry" name="passportcountry">
              <option selected disabled>Select</option>
            </select>
            </div>
          </div>
          </div>
          <!-- </div> -->
          <!-- <div class="makeflex"> -->
          <!-- passport expiry date -->
          <!-- <div class="guestInputBox"> -->
          <div class="col-md-6">
            <div class="form-group">
            <label for="passportexpirydate">Expiry Date</label>
            <!--ADD VALIDATION: EXPIRY DATE CANNOT BE GREATER THAN 10 YEARS, COUNT FROM CURRENT DATE-->
            <input type="date" id="passportexpirydate" name="passport_expire_date" placeholder="Enter Passport Expiry Date"  />
            </div>
          </div>
          <!-- </div> -->
          <!-- </div> -->
        </div>
        <!-- </div> -->
        <!-- </div> -->
        </div>
        <!--</div>-->
        <!-- footer -->
        <div class="col-md-12">
        <div class="profile_stickyFooter" style="position: relative;">
          <div class="modal-footer editProfile profileFooterCont">
            <button type="button" class="btn-main cancel" data-dismiss="modal">Cancel</button>
            <!-- <input type="submit" id="" name="submit" value="SAVE" class="btnMain btnSave"/> -->
            <button type="submit" name="save" class="btn-main save">Save</button>
          </div>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript">
//Add Passport No Validation-Pop up
function EnableDisable(passportnumber) {
  var psptnumber = document.getElementById("passportnumber");
  var psptcountry = document.getElementById("passportcountry");
  var psptexpirydate = document.getElementById("passportexpirydate");
  var validpsptmsg = document.getElementById('validpassport');
  
  if (psptnumber.value.trim() != "") {
    //Enable the TextBox when TextBox has value.
    psptcountry.disabled = false;
    psptexpirydate.disabled = false;
    psptcountry.style.borderColor = 'red';
    psptexpirydate.style.borderColor = 'red';
    //ADD VALIDATION: IF DATA LENGTH LESS THAN 2 CHARACTERS THEN ONLY MESSAGE APPEARED AND VICE VERSA
    validpsptmsg.innerHTML = 'Please enter a valid passport number';
    validpsptmsg.style.color = 'red';
    } else {
      //Disable the TextBox when TextBox is empty.
      psptcountry.disabled = true;
      psptexpirydate.disabled = true;
      psptcountry.style.borderColor = '#9b9b9b';
      psptexpirydate.style.borderColor = '#9b9b9b';
      validpsptmsg.innerHTML = '';
      }
    };
</script>

<!-- <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("t_tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script> -->

<script>
function openInfo(evt, profileInfo) {
  var i, tabContent, tablinks;
  tabContent = document.getElementsByClassName("tabContent");
  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(profileInfo).style.display = "block";
  evt.currentTarget.className += " active";

  // Scroll into view
  /*document.getElementById(profileInfo).scrollIntoView({ behavior: "smooth", block: "start" });*/

  // Scroll into view with a little offset from the top
  /*var yOffset = -50; // Adjust this value as needed
  var element = document.getElementById(profileInfo);
  var modalBody = document.querySelector('.modal-body'); // Adjust this selector to your modal body
  var y = element.getBoundingClientRect().top + modalBody.scrollTop + window.pageYOffset + yOffset;
  modalBody.scrollTo({ top: y, behavior: 'smooth' });*/
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
  $(function() {
    $("#profile_dob").datepicker({
      dateFormat: "yy-mm-dd"
    });
    
    $("#traveller_info").submit(function(event) {
      // Prevent the default form submission
      event.preventDefault();
      
      // Get the value of the date input
      var dateInput = $("#profile_dob").val();
      
      // Submit the form with the formatted date
      $(this).unbind('submit').submit();
    });
  });
</script>