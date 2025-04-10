@extends('layouts.front.masternofooter')
@section('content')
<!-- myaccount -->
<style type="text/css">
.ui-datepicker {
    z-index: 1042!important;
    }
</style>

<!-- user profile info -->
<link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/css/userprofileinfo.css') }}" />

<!--my-profile page starts-->
<!--Breadcrumps-->
<!-- <div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="packagelist_head">
                <ul class="breadcrumbs ">
                    <li><a href="#">Home /</a></li>
                    <li class="active">My Account</li>
                </ul>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div> -->
<?php 
    $user_details=DB::table('users_details')->where('user_id',Sentinel::getUser()->id)->first();
?>
<section class="myProfilePage">
    <div class="myPofileBannerWrapper">
        <div class="dPageContainer">
            <!--Breadcrumps-->
            <div class="item-content">
                <ul>
                    <li>My Profile</li>
                </ul>
            </div>
                <!-- <div class="col-md-12 appendTop10">
                    <h3 class="pfwmt fontWeight500 skin-color">Hi {{Sentinel::getUser()->first_name}}, Welcome !</h3>
                </div> -->
        </div>
    </div>
    <div class="dPageContainer">
        <div class="contentWrapper topMargin">

            <!-- left section -->
            <div class="leftSection">
                <div class="profileSideBar profilSideBar-sticky">
                    <div>
                        <div class="relativeCont">
                            <div class="profilelImageBox">
                                @if(Sentinel::getUser()->profile_image!='' && Sentinel::getUser()->social_picture!='')
                                    <img id="imgPreview" src="{{ url('/public/uploads/user_profiles/'.Sentinel::getUser()->profile_image) }}" alt="user-pic"/>
                                @elseif(Sentinel::getUser()->profile_image!='' && Sentinel::getUser()->social_picture=='')
                                    <img id="imgPreview"src="{{ url('/public/uploads/user_profiles/'.Sentinel::getUser()->profile_image) }}" alt="user-pic"/>
                                @elseif(Sentinel::getUser()->profile_image=='' && Sentinel::getUser()->social_picture!='')
                                    <img id="imgPreview" src="{{ Sentinel::getUser()->social_picture }}" alt="user-pic"/>
                                @else
                                <div class="profilelImageBox_nameInitials">
                                    <?php
                                        $name = Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name;
                                        $name = explode(' ', $name);
                                        $firstName = $name[0];
                                        $lastName = (isset($name[count($name)-1])) ? $name[count($name)-1] : '';
                                        echo substr($firstName,0,1);
                                        echo substr($lastName,0,1);
                                    ?>
                                    <!-- <img id="imgPreview" src="{{url('/resources/admin_logo.png')}}" alt="pic"/> -->
                                </div>
                                @endif
                            </div>

                            <div class="imageBox_editIcn imageBox_icnPostn">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="file" id="file" name="profile_pic" accept="image/jpeg, image/png, image/gif, image/bmp" class="profilelImageBox_imgUpload">
                            </div>

                            <!-- file size -->
                            <div id="size" style="display: none;"></div>
                        </div>

                        <div class="contentWrap">
                            <p class="guestName">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                            <p class="guestNameTag">Personal profile</p>
                        </div>
                    </div>
                    
                    <div class="flexOne">
                        <ul class="sideBarNav">
                            <a href="#userProfileDetails" class="sidebarLink">
                                <li class="sideBarItem active">
                                    <span class="sideBarIconBox">
                                        <span class=""><i class="fa fa-user-o profileuserIcon" aria-hidden="true"></i></span>
                                    </span>Profile
                                </li>
                            </a>
                            <a href="#userLoginDetails" class="sidebarLink">
                                <li class="sideBarItem">
                                   <span class="sideBarIconBox">
                                        <img class="profileloginIcon" src="{{ url('/resources/assets/frontend/images/icon/loginIcon.png') }}" alt="login">
                                    </span>Login Details
                                </li>
                            </a>
                            <a href="#userTravellerDetails" class="sidebarLink">
                                <li class="sideBarItem">
                                    <span class="sideBarIconBox">
                                        <img width="25" height="20"  src="{{ url('/resources/assets/frontend/images/icon/TravellerIcon_Black.png') }}" alt="traveller">
                                    </span>Save Travellers                            
                                </li>
                                <!-- <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="30" r="25" fill="#007bff" />
                                    <path d="M50 60c15.5 0 28 12.5 28 28H22c0-15.5 12.5-28 28-28z" fill="#007bff" />
                                </svg> -->
                            </a>
                             <a onclick="document.getElementById('logout-form').submit()" class="sidebarLink">
                                <li class="sideBarItem">
                                    <span class="sideBarIconBox">
                                        <img width="24" height="24" src="{{ url('/resources/assets/frontend/images/icon/logout.png') }}" alt="logout">
                                    </span>Logout
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div> 

            <!-- right section -->
            <?php
                $width=0;
                if(Sentinel::getUser()->email_activation!=0):
                    $width=(int)$width+(int)25;
                endif;
                if($user_details!='' && $user_details->gender!='' && $user_details->dob!=''):
                    $width=(int)$width+(int)50;
                endif;
                if($user_details!='' && $user_details->phone_no!='' && $user_details->mobile_verify!=0):
                    $width=(int)$width+(int)25;
                endif;
            ?>
            <div class="rightSection">
                <!-- profile summary -->
                <div class="profileSumryCont">
                    <div class="profileComplte_prctagBox">
                        <div class="title">
                            <div>Complete your Profile</div>
                            <div class="fontWeight900">{{ $width }}%</div>
                        </div>
                        <div class="progressBar">
                            <div class="progressBarFill complete" style="width: {{ $width }}%"></div>
                        </div> 
                    </div>
                    <div class="tagline">Get the best out by adding the remaining details!</div>
                    <ul class="profileComplte_statusList">
                        <!-- email id -->
                        <li class="profileComplte_statusListItem">
                            @if(Sentinel::getUser()->email_activation!=0)
                                <span class="verifiedItem">
                                    <div class="wrapper">
                                      <div class="circle">
                                        <div class="checkMark"></div>
                                      </div>
                                    </div>Verified Email ID
                                </span>
                                @else
                                <span class="non-verified addProfile" data-toggle="modal" data-target="#email_verify_modal">
                                    <div class="wrapper">
                                        <div class="circle"></div>
                                    </div>Verify Email ID
                                </span>
                            @endif
                        </li>
                        <!-- mobile no -->
                        <li class="profileComplte_statusListItem">
                            @if($user_details!='' && $user_details->phone_no!='' && $user_details->mobile_verify!=0)
                                <span class="verifiedItem">
                                    <div class="wrapper">
                                      <div class="circle">
                                        <div class="checkMark"></div>
                                      </div>
                                    </div>Verified Mobile No
                                </span>
                                @else
                                <span class="non-verified" data-toggle="modal" data-target="#profile_mobile_modal">
                                    <div class="wrapper">
                                        <div class="circle"></div>
                                    </div>Verify Mobile No
                                </span>
                            @endif
                        </li>
                        <!-- basic info -->
                        <li class="profileComplte_statusListItem">
                            @if($user_details!='' && $user_details->gender!='' && $user_details->dob!='')
                                <span class="verifiedItem">
                                    <div class="wrapper">
                                      <div class="circle">
                                        <div class="checkMark"></div>
                                      </div>
                                    </div>Completed Basic Info
                                </span>
                                @else
                                <span class="non-verified" data-toggle="modal" data-target="#profile_modal">
                                    <div class="wrapper">
                                        <div class="circle"></div>
                                    </div>Complete Basic Info
                            @endif
                        </li>
                    </ul>
                </div>

                <!--Profile-->
                <div class="profileCompontCont" id="userProfileDetails">
                    <div class="titleWrapper">
                        <div>
                            <h3>Profile</h3>
                            <p>Basic info, for a faster booking experience</p>
                        </div>
                        <div>
                            <button type="button" data-toggle="modal" data-target="#profile_modal" class="btn_EditDetail">
                                <i class="fa fa-pencil appendRight5" aria-hidden="true"></i>Edit
                            </button>
                        </div>
                    </div>
                    <ul class="detailList">
                        <!-- name -->
                        <li class="item">
                            <span class="title">Name</span>
                            <span class="itemDetails">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</span>
                        </li>
                        <!-- birthday -->
                        <li class="item">
                            <span class="title">BIRTHDAY</span>
                            @if($user_details!='' && $user_details->dob!='')  
                                <span class="itemDetails">
                                    {{ date('d-m-Y', strtotime($user_details->dob)) }}
                                </span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Edit</span>
                                @else
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                            @endif
                        </li>
                        <!-- gender -->
                        <li class="item">
                            <span class="title">Gender</span>
                            @if($user_details!='' && $user_details->gender!='')
                                <span class="itemDetails">
                                    @if($user_details->gender=='male')
                                    Male
                                    @elseif($user_details->gender=='female')
                                    Female
                                    @endif
                                </span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Edit</span>
                                @else
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                            @endif
                        </li>
                        <!-- marital status -->
                        <li class="item">
                            <span class="title">Marital status</span>
                            @if($user_details!='' && $user_details->marital_status!='')
                                <span class="itemDetails">
                                    @if($user_details->marital_status=='married')
                                        Married
                                        @elseif($user_details->marital_status=='single')
                                        Single
                                    @endif
                                </span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Edit</span>
                                @else
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                            @endif
                        </li>
                        <!-- city -->
                        <li class="item">
                            <span class="title">City</span>
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                        </li>
                        <!-- state -->
                        <li class="item">
                            <span class="title">State</span>
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                        </li>
                        <!-- pincode -->
                        <li class="item">
                            <span class="title">Pin Code</span>
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                        </li>
                        <!-- address -->
                        <li class="item">
                            <span class="title">Address</span>
                                <span class="itemDetails"></span>
                                <span data-toggle="modal" data-target="#profile_modal" class="addItemDetails">+ Add</span>
                        </li>
                    </ul>
                </div>

                <!--Login Details-->
                <div class="profileCompontCont loginCompon" id="userLoginDetails">
                    <div class="titleWrapper">
                        <div>
                            <h3>Login Details</h3>
                            <p>Manage your email address, mobile number and password</p>
                        </div>
                        <div>
                            <!-- <button type="button" class="btn_EditDetail"><i class="fa fa-pencil appendRight5" aria-hidden="true"></i>Edit</button> -->
                        </div>
                    </div>
                    <ul class="detailList">
                        <!-- login mobile number -->
                        <li class="item mobscroll mobScrollX">
                            <span class="title">Mobile Number</span>
                            <span class="itemDetails">
                                @if($user_details!='' && $user_details->phone_no!='')
                                +{{ $user_details->country_code }} {{ $user_details->phone_no }}
                                @else
                                <span data-toggle="modal" data-target="#profile_mobile_modal" class="addItemDetails">+ Add</span>
                                @endif
                            </span>
                            @if($user_details!='' && $user_details->phone_no!='') 
                               @if($user_details->mobile_verify==0)
                                <span class="itemDetails-nonVerified mobile_verify">Verify Mobile No.</span>
                                @else
                                <span class="itemDetails-Verified">
                                    <div class="wrapper">
                                      <div class="circle">
                                        <div class="checkMark"></div>
                                      </div>
                                    </div>Verified
                                </span>
                                <div class="deleteMobileNoCont">
                                    <div class="deleteMobileNo_delBtn" tabindex="0">
                                        <p class="clickDelete" id="clickDelete">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></p>
                                        <div class="tooltip" id="tooltip" style="display: none;">
                                            <!-- delete confirmation -->
                                            <p>Are you sure you want to delete?</p>
                                            <div class="">
                                                <span class="appendRight30" role="button" tabindex="0" id="cancelBtn">Cancel</span>
                                                <span class="delete_mobile_no redText" role="button" tabindex="0">Yes, Remove</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @else
                            @endif
                        </li>
                        <!-- login email -->
                        <li class="item mobscroll mobScrollX">
                            <span class="title">Email Id</span>
                            <span class="itemDetails">
                                {{ Sentinel::getUser()->email }}
                            </span>
                            <!-- <span class="fontSize14 lineHeight14 color008 fontWeight700 appendRight30 cursorPointer">+ Add</span> -->
                            @if(Sentinel::getUser()->email_activation==0)
                            <span class="itemDetails-nonVerified email_verify">Verify Email ID</span>
                            @else
                            <span class="itemDetails-Verified">
                                <div class="wrapper">
                                  <div class="circle">
                                    <div class="checkMark"></div>
                                  </div>
                                </div>Verified
                            </span>
                            @endif
                        </li>
                        <!-- login password -->
                        <li class="item mobscroll mobScrollX">
                            <span class="title">Password</span>
                            <span class="loginPwdText">.....</span>
                            <span data-toggle="modal" data-target="#change_password_modal" class="btnChangePwd">Change Password?</span>
                        </li>
                    </ul>  
                </div>

                <?php
                    $travellers=DB::table('query_lead_traveller')->join('query_traveller','query_traveller.lead_traveller_id','=','query_lead_traveller.id')->where('query_lead_traveller.email',Sentinel::getUser()->email)->select('query_traveller.*')->get();
                    ?>
                <!--Traveller Details-->
                <div class="profileCompontCont" id="userTravellerDetails">
                    <div class="titleWrapper">
                        <div>
                            <h3>Save Traveller(s)</h3>
                            <p>You have <span>{{ count($travellers) }}</span> Traveller(s)</p>
                        </div>
                        <div>
                            <button type="button" data-toggle="modal" data-target="#addtraveller" class="btn_EditDetail"><i class="fa fa-pencil appendRight5" aria-hidden="true"></i>Add Traveller</button>
                        </div>
                    </div>
                    <ul class="detailList">
                        @foreach($travellers as $traveller)
                        <li class="item mobscroll mobScrollX">
                            <div class="trvlrIconCont">
                                <img width="25" height="25" src="{{ url('/resources/assets/frontend/images/icon/malePerson.png') }}" alt="traveller">
                            </div>
                            <div class="flexOne">
                                <p class="travellerInfo makeflex">
                                    <span class="nameCont">
                                        <span class="userName">{{ $traveller->firstname }} {{ $traveller->lastname }}</span>
                                        <!-- traveller type -->
                                        <!-- <?php
                                            $current_year = date('Y');
                                            $birth_year = date('Y', strtotime($traveller->dob));
                                            $years = (int) $current_year - (int) $birth_year;

                                            // Determine the label based on age
                                            if ($years >= 12) {
                                                $shortlabel = 'A';
                                                $label = 'Adult';
                                                } elseif ($years >= 2 && $years < 12) {
                                                    $shortlabel = 'C';
                                                    $label = 'Child';
                                                } else {
                                                    $shortlabel = 'I';
                                                    $label = 'Infant';
                                                }
                                        ?>
                                        <span title="{{ $label }}">({{ $shortlabel }})</span> -->
                                    </span>
                                    <span class="genderInfo">
                                    @if($traveller->gender=='male')
                                        Male
                                        @elseif($traveller->gender=='female')
                                        Female
                                    @endif
                                    </span>
                                    <span class="ageInfo">
                                        <?php
                                            $current_year=date('Y');
                                            $birth_year=date('Y', strtotime($traveller->dob));
                                            $years=(int)$current_year-(int)$birth_year
                                        ?>
                                        {{ $years }} Years
                                    </span>
                                </p>
                            </div>
                            <div  class="viewDtlCont">
                                <button type="button" class="viewDtlBtn view_traveller_details" id="{{ $traveller->id }}">View Detail</button>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</section>

<!-- my-profile modal -->
@include('home.profile_pages.edit_profile')
@include('home.profile_pages.edit_mobile')
@include('home.profile_pages.email_verify')
@include('home.profile_pages.mobile_verify')
@include('home.profile_pages.mobile_verify_delete')
@include('home.profile_pages.processing')
@include('home.profile_pages.change_password')
@include('home.profile_pages.addtraveller')
@include('home.profile_pages.edittraveller')

<!--my-profile page ends-->

@endsection

@section('custom_js')

<script type="text/javascript" src='{{ asset ("/resources/assets/frontend/js/userprofileinfo.js") }}'></script>

<!-- user-profile-js -->
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@endsection