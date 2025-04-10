<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\Role;
use App\User;
use Activation;
use DB;
use App\UserDetails;
use App\Helpers\CustomHelpers;
use App\ActivateService;
use App\QuotationHeader;
use App\QuotationFooter;
use App\countries;
use App\City;
use App\QueryLeadTraveller;
use App\QueryTraveller;
use Mail;

class UsersController extends Controller
{
    public function get_cities(Request $request)
    {
        $data=City::where('name', 'like', $request->searchTerm . '%')->take(10)->get();
        $json=[];
        foreach($data as $datas):
        $json[] = ['id'=>$datas->name,'text'=>$datas->name];
        endforeach;
        echo json_encode($json);
    }
    
    public function users()
    {
        $all_roles = Role::all();
        $all_users = User::all();
        $role_id=DB::table('roles')->where('slug','=','customer')->first();
        $role = Sentinel::findRoleById($role_id->id);
        $employee = $role->users()->with('roles')->get();
        return view('users.users',['roles'=>$all_roles,'users'=>$all_users]);
    }
    
    public function users_data($id)
    {
        $check_data_managerole=ActivateService::where('services','=','manage_roles')->first();
        if($check_data_managerole->activation==1):
        $all_roles = Role::all();
        $role_id=DB::table('roles')->where('slug','=',$id)->first();
        $role = Sentinel::findRoleById($role_id->id);
        $all_users = $role->users()->with('roles')->get();
        return view('users.users',['roles'=>$all_roles,'users'=>$all_users]);
        else:
        return response()->view('error.404', [], 404);
        endif;
    }
    
    public function create()
    {
        $roles = Role::all();
        $quotation_header=QuotationHeader::all();
        $quotation_footer=QuotationFooter::all();
        $counties=countries::all();
        $cities=City::all();
        return view('users.create',compact('roles','quotation_header','quotation_footer','counties','cities'));
    }
    
    public function get_country(Request $request)
    {
        $data=City::where('name', 'like', $request->searchTerm . '%')->take(10)->get();
        $json=[];
        foreach($data as $datas):
        $json[] = ['id'=>$datas->name,'text'=>$datas->name];
        endforeach;
        echo json_encode($json);
    }
    
    // check user
    public function user_data_check(Request $request)
    {
        if($request->input('id')) {
            $id=$request->input('id');
            if($request->input('password')) {
                $validator = Validator::make($request->all(), [
                    'email'=>"required|email|unique:users,email,$id",
                    'mobile'=>"required|unique:users,mobile,$id",
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'email'=>"required|email|unique:users,email,$id",
                    'mobile'=>"required|unique:users,mobile,$id",
                ]);
            }
            if($validator->fails()) {
                $messages=$validator->messages();
                foreach ($messages->all() as $message) {
                    echo $message.",";
                }
            } else {
                echo 'success';
            }
        } else {
            $validator = Validator::make($request->all(),
            [
            'email'=>"required|unique:users",
            'mobile'=>"required|unique:users",
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            ]);
            if($validator->fails())
            {
            $messages=$validator->messages();
            foreach ($messages->all() as $message)
            {
            echo $message.",";
            }
            }
            else
            {
            echo 'success';
            }
        }
    }
    
    /* Add User*/
    public function postUsers(Request $request)
    {
        if($request->input('id')) {

            // dd($request);
            if($request->input('password')) {
                $this->validate($request, [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile' => 'required',
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password'
                ]);
            
                //
                $data = Sentinel::findById($request->input('id'));
                $profile=$data->profile_image;
                if($request->hasFile('profile_pic')) {
                    $image=$request->file("profile_pic");
                    $name=time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/uploads/user_profiles/', $name);
                    $profile=$name;
                }
                
                //
                $dataEdit = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'password' => $request->input('password'),
                    'mobile' => $request->input('mobile'),
                    'signature' => $request->input('signature'),
                    'profile_image' => $profile,
                    'usercategory' => $request->usercategory,
                    'subscription' => $request->subscription,
                    'subscription_service' => serialize($request->subscription_service),
                    'tourpackage' => $request->tourpackage,
                    'visa' => $request->visa,
                    'lock_header' => $request->lock_header,
                    'quotation_header' => $request->quotation_header,
                    'lock_header_email' => $request->lock_header_email,
                    'signature_header' => $request->signature_header,
                    'lock_footer' => $request->lock_footer,
                    'quotation_footer' => $request->quotation_footer,
                    'lock_footer_email' => $request->lock_footer_email,
                    'destination' => serialize($request->destination),
                    'visadestination' => serialize($request->visadestination),
                    'lock_before_quote_send' => $request->lock_before_quote_send,
                    'lock_after_quote_send' => $request->lock_after_quote_send,
                    ];
            } else {
                $this->validate($request, [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile' => 'required',
                ]);
            
                //
                $data = Sentinel::findById($request->input('id'));
                $profile=$data->profile_image;
                if($request->hasFile('profile_pic'))
                {
                    $image=$request->file("profile_pic");
                    $name=time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/uploads/user_profiles/', $name);
                    $profile=$name;
                }

                //
                if((Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($request->input('id'))=='supervisor') || (Sentinel::getUser()->inRole('employee') && CustomHelpers::get_user_role($request->input('id'))=='employee') || (Sentinel::getUser()->inRole('agent') && CustomHelpers::get_user_role($request->input('id'))=='agent') || Sentinel::getUser()->inRole('customer') && CustomHelpers::get_user_role($request->input('id'))=='customer'):
                $user_data = Sentinel::findById($request->input('id'));
                $dataEdit = [
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'mobile' => $user_data->mobile,
                    'signature' => $user_data->signature,
                    'profile_image' => $profile,
                ];
                else:
                $dataEdit = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'mobile' => $request->input('mobile'),
                    'signature' => $request->input('signature'),
                    'profile_image' => $profile,
                    'usercategory' => $request->usercategory,
                    'subscription' => $request->subscription,
                    'subscription_service' => serialize($request->subscription_service),
                    'tourpackage' => $request->tourpackage,
                    'visa' => $request->visa,
                    'lock_header' => $request->lock_header,
                    'quotation_header' => $request->quotation_header,
                    'lock_header_email' => $request->lock_header_email,
                    'signature_header' => $request->signature_header,
                    'lock_footer' => $request->lock_footer,
                    'quotation_footer' => $request->quotation_footer,
                    'lock_footer_email' => $request->lock_footer_email,
                    'destination' => serialize($request->destination),
                    'visadestination' => serialize($request->visadestination),
                    'lock_before_quote_send' => $request->lock_before_quote_send,
                    'lock_after_quote_send' => $request->lock_after_quote_send,
                ];
                endif;
            }
        
            //
            if(Sentinel::getUser()->inRole('supervisor') && ($request->user_role=='administrator' || $request->user_role=='super_admin' || $request->user_role=='supervisor')):
            return redirect("/")->with('error','Access Denied');
            endif;

            //
            if(Sentinel::getUser()->inRole('supervisor') && (CustomHelpers::get_user_role($request->input('id'))=='employee' || CustomHelpers::get_user_role($request->input('id'))=='agent' || CustomHelpers::get_user_role($request->input('id'))=='customer')):
                $role_pre = Sentinel::findRoleBySlug($request->input('pre_user_role')); // previous role
                $role_pre->users()->detach($request->input('id')); // Detach previous Role
                $role = Sentinel::findRoleBySlug($request->input('user_role'));  // New Row
                $role->users()->attach($request->input('id')); // Attach new role
            
            elseif(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin')):
                $role_pre = Sentinel::findRoleBySlug($request->input('pre_user_role')); // previous role
                $role_pre->users()->detach($request->input('id')); // Detach previous Role
                $role = Sentinel::findRoleBySlug($request->input('user_role'));  // New Row
                $role->users()->attach($request->input('id')); // Attach new role
            
            elseif((Sentinel::getUser()->inRole('supervisor') && CustomHelpers::get_user_role($request->input('id'))=='supervisor') || (Sentinel::getUser()->inRole('employee') && CustomHelpers::get_user_role($request->input('id'))=='employee') || (Sentinel::getUser()->inRole('agent') && CustomHelpers::get_user_role($request->input('id'))=='agent') || Sentinel::getUser()->inRole('customer') && CustomHelpers::get_user_role($request->input('id'))=='customer'):
                $role = Sentinel::findRoleBySlug(CustomHelpers::get_user_role($request->input('id')));
            endif;
            
                $user = Sentinel::findById($request->input('id'));
                //
                $data_activations=DB::table('activations')
                ->where('user_id','=',$request->input('id'))
                ->first();
                $status_activation=$request->status;
                if($status_activation=="0") {
                    Activation::remove($user);
                } else {
                    if($data_activations!='') {
                        Activation::complete($user,$data_activations->code);
                    } else {
                        $activation=Activation::create($user);
                        Activation::complete($user,$activation->code);
                    }
                }
            
                //
                $save = Sentinel::update($user, $dataEdit);
                if ($save) {
                    return redirect("/roles/$role->slug")->with('success','User has been updated successfully!');
                }
            } else { //Create Part
                $this->validate($request, [
                    'email' => 'required|email|unique:users,email',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password',
                    'mobile' => 'required',
                    'profile_pic'=>'required',
                ]);
                
                //
                if(Sentinel::getUser()->inRole('supervisor') && ($request->user_role=='administrator' || $request->user_role=='super_admin' || $request->user_role=='supervisor')):
                return redirect("/")->with('error','Access Denied');
                endif;
                //
                if($request->hasFile('profile_pic')) {
                    $image=$request->file("profile_pic");
                    $name=time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/uploads/user_profiles/', $name);
                    $request['profile_image']=$name;
                }
                
                //
                $request['subscription_service']=serialize($request->subscription_service);
                if($request->has('tourpackage')) {
                    $request['tourpackage']=$request->tourpackage;
                }
                if($request->has('visa')) {
                    $request['visa']=$request->visa;
                }
                $request['destination']=serialize($request->destination);
                $request['visadestination']=serialize($request->visadestination);
                $user= Sentinel::registerAndActivate($request->all());
                $role = Sentinel::findRoleBySlug($request->input('user_role'));
                $role->users()->attach($user);
                if ($user) {
                    return redirect("/roles/$role->slug")->with('success','User has been created successfully!');
                }
        }
    }

    //update user profile
    public function update_user_profile(Request $request)
    {
        $dataEdit = [
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
        ];
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $save = Sentinel::update($user, $dataEdit);
        $user_details=UserDetails::where('user_id',Sentinel::getUser()->id)->first();
        if($user_details=='') {
            $user_details=new  UserDetails;
        }
        $user_details->user_id=Sentinel::getUser()->id;
        $user_details->dob=$request->birthday;
        $user_details->gender=$request->gender;
        $user_details->marital_status=$request->maritalstatus;
        if ($request->has('anniversary')) {
            $user_details->anniversary=$request->anniversary;
        }
        $user_details->save();
        return redirect("/customer-panel")->with('success','Details has been updated successfully!');
    }

    // update user mobile number
    public function update_user_mobile(Request $request) {
        $dataEdit = [
            'mobile' => $request->mobile,
        ];
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $save = Sentinel::update($user, $dataEdit);
        $user_details=UserDetails::where('user_id',Sentinel::getUser()->id)->first();
        if($user_details=='') {
            $user_details=new  UserDetails;
        }
        $user_details->user_id=Sentinel::getUser()->id;
        $user_details->country_code=$request->country_code;
        $user_details->phone_no=$request->mobile;
        $user_details->save();
        return redirect("/customer-panel")->with('success','Details has been updated successfully!');
    }

    // delete user mobile number
    public function delete_user_mobile(Request $request)
    {
        $enter_otp=$request->otp_value;
        $captured_otp=$_COOKIE['otp'];
        if($captured_otp==$enter_otp):
        $user_details=UserDetails::where('user_id',Sentinel::getUser()->id)->first();
        if($user_details!='') {
            $user_details->phone_no='';
            $user_details->mobile_verify=0;
            $user_details->save();
            $dataEdit = [
            'mobile' => '',
            ];
            $user = Sentinel::findById(Sentinel::getUser()->id);
            $save = Sentinel::update($user, $dataEdit);
        }
        echo 'success';
        else:
        echo 'error';
        endif;
    }

    //--------------------

    // user email verify via otp
    /*public function user_email_verify()
    {
        $otp=mt_rand(10000,99999);
        $user=Sentinel::getUser();
        setcookie('otp',$otp);
        setcookie('email',Sentinel::getUser()->email);
        Mail::raw("Hello $user->first_name,  Your OTP is: $otp" , function ($message) use ($user) {
        $message->to($user->email);
        //$message->from($user->email,"The WorldGateway");
        $message->from($user->email,"Your Travel Partner");
        $message->subject("Hello $user->first_name,  Your Email Verify OTP.");
        });
        echo "success";
    }*/

    // User email verification via OTP
    public function user_email_verify()
    {
        // Generate a random OTP between 10000 and 99999
        $otp = random_int(10000, 99999); // Use random_int for better security

        // Get the currently authenticated user
        $user = Sentinel::getUser();

        // Store the OTP and email in session for security
        session(['otp' => $otp, 'email' => $user->email]);

        // Prepare the OTP email content
        $emailContent = "Hello {$user->first_name}, your OTP is: $otp";

        // Determine the sender name based on the WEBSITENAME environment variable
        $senderName = env("WEBSITENAME") == 1 ? 'The World Gateway' : 'Rapidex Travels';

        // Send the OTP email
        Mail::raw($emailContent, function ($message) use ($user, $senderName) {
            $message->to($user->email);
            $message->from($user->email, $senderName); // Use the determined sender name
            $message->subject("Hello {$user->first_name}, Your Email Verification OTP.");
        });

        // Return a success response
        return response()->json(['status' => 'success', 'message' => 'OTP sent successfully.']);
    }

    //--------------------

    /*// Email verification via OTP
    public function email_verify(Request $request)
    {
        $otp=$request->otp_value;
        $old_otp=$_COOKIE['otp'];
        if($otp==$old_otp):
        $dataEdit = [
            'email_activation' => 1,
        ];
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $save = Sentinel::update($user, $dataEdit);
        echo 'success';
        else:
        echo 'Enter Correct OTP';
        endif;
    }*/

    // Email verification via OTP
    public function email_verify(Request $request)
    {
        // Validate incoming request to ensure 'otp_value' is present
        $request->validate([
            'otp_value' => 'required|numeric', // Ensure the OTP is a required numeric field
        ]);

        // Retrieve the OTP from the request and the previously stored OTP from cookies
        $otp = $request->otp_value;
        $old_otp = $_COOKIE['otp'] ?? null; // Use null coalescing to avoid undefined index notice

        // Check if the OTP provided matches the stored OTP
        if ($otp == $old_otp) {
            // Prepare data for user update
            $dataEdit = [
                'email_activation' => 1,
            ];

            // Find the currently authenticated user
            $user = Sentinel::getUser();

            if ($user) { // Ensure that the user is authenticated
                // Update the user's email activation status
                $save = Sentinel::update($user, $dataEdit);

                // You may want to handle the success of the update operation
                if ($save) {
                    return response()->json(['status' => 'success', 'message' => 'Email verified successfully.']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Failed to update email verification status.']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'User not found.']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Enter Correct OTP']);
        }
    }
    
    //--------------------

    /*// User mobile number verification via OTP
    public function user_mobile_verify()
    {
        $status=CustomHelpers::otp_send(Sentinel::getUser()->mobile,0);
        echo $status;
    }*/

    // User mobile number verification via OTP
    public function user_mobile_verify()
    {
        // Get the currently authenticated user
        $user = Sentinel::getUser();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not authenticated.'], 401);
        }

        // Ensure the user has a mobile number before attempting to send OTP
        if (empty($user->mobile)) {
            return response()->json(['status' => 'error', 'message' => 'Mobile number is not set.'], 400);
        }

        // Send OTP using a custom helper function
        $status = CustomHelpers::otp_send($user->mobile, 0);

        // Return a JSON response based on the status
        if ($status) {
            return response()->json(['status' => 'success', 'message' => 'OTP sent successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to send OTP.']);
        }
    }

    //--------------------

    /*// Verify mobile number via OTP
    public function mobile_verify(Request $request)
    {
        $enter_otp=$request->otp_value;
        $captured_otp=$_COOKIE['otp'];
        if($captured_otp==$enter_otp):
        $user_details=UserDetails::where('user_id',Sentinel::getUser()->id)->first();
        if($user_details=='') {
            $user_details=new  UserDetails;
        }
        $user_details->user_id=Sentinel::getUser()->id;
        $user_details->mobile_verify=1;
        $user_details->save();
        echo 'success';
        else:
        echo 'error';
        endif;
    }*/

    // Verify mobile number via OTP
    public function mobile_verify(Request $request)
    {
        $enteredOtp = $request->otp_value; // Get the OTP value from the request
        $capturedOtp = $_COOKIE['otp'] ?? null; // Retrieve the OTP from the cookie

        // Check if the entered OTP matches the captured OTP
        if ($capturedOtp && $enteredOtp === $capturedOtp) {
            // Retrieve the user's details based on the logged-in user
            $userDetails = UserDetails::where('user_id', Sentinel::getUser()->id)->first();

            // If user details are not found, create a new instance
            if (!$userDetails) {
                $userDetails = new UserDetails;
            }

            // Update user details to mark the mobile as verified
            $userDetails->user_id = Sentinel::getUser()->id;
            $userDetails->mobile_verify = 1;
            $userDetails->save();

            return response()->json(['status' => 'success']);
        } else {
            // Return error if OTP does not match
            return response()->json(['status' => 'error', 'message' => 'Incorrect OTP']);
        }
    }

    //--------------------

    // change subscription
    public function change_subscription(Request $request)
    {
        $id=$request->id;
        $value=$request->value;
        $user = Sentinel::findById($id);
        $dataEdit=[];
        $dataEdit['subscription']=$value;
        if($value=='subscribed') {
            $dataEdit['subscription_service'] ='a:3:{i:0;s:5:"email";i:1;s:3:"sms";i:2;s:8:"whatsapp";}';
        } else {
            $dataEdit['subscription_service'] ='N;';
        }
        $save = Sentinel::update($user, $dataEdit);
    }

    //--------------------

    /*// Update User Status
    public function updateUserStatus(Request $request)
    {
        // Find the user by ID
        $user = Sentinel::findById($request->id);
        
        // Update the user's status
        $user->status = $request->status;
        $user->save();

        // Check the activation status
        $activation = Activation::completed($user);
        $activationStatus = $activation ? 'activated' : 'de-activated';

        // Return the response as JSON
        return response()->json([
            'success' => true,
            'activation' => $activationStatus
        ]);
    }*/

    // Change User Status (enable/disable) (not working)
    public function changeUserStatus(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $user = Sentinel::findById($id);

        // Update the user's status
        $dataEdit = ['status' => $value];
        $save = Sentinel::update($user, $dataEdit);

        // Check if the user activation is completed
        $activation = Activation::completed($user);
        $activationStatus = $activation ? 'activated' : 'de-activated';

        // Return a JSON response indicating the new activation status
        return response()->json([
            'success' => true,
            'activation' => $activationStatus,
        ]);
    }

    // user login status (not working)
    public function getUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            return response()->json([
                'login_status' => $user->login_status,
                'last_login' => $user->last_login,
            ]);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    //--------------------

    public function edit($id) 
    {
        // Retrieve the user by ID, throwing a 404 error if the user doesn't exist
        $user = User::findOrFail($id); 

        // Fetch all roles from the Role model
        $roles = Role::all();

        // Retrieve all quotation headers from the QuotationHeader model
        $quotation_header = QuotationHeader::all();

        // Retrieve all quotation footers from the QuotationFooter model
        $quotation_footer = QuotationFooter::all();

        // Return the edit view with the fetched data
        return view('users.edit', compact('roles', 'user', 'quotation_header', 'quotation_footer'));
    }

    //--------------------

    /*// Delete User (old)
    public function deleteUser(Request $request) {
        $user = Sentinel::findById($request->id);
        $user->delete();
        return redirect()->back()->with('success','User has been deleted successfully!');
    }*/

    // Delete User
    public function deleteUser(Request $request) {
        // Find the user by ID using Sentinel
        $user = Sentinel::findById($request->id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Attempt to delete the user
        try {
            $user->delete();
            return redirect()->back()->with('success', 'User has been deleted successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions during the deletion process
            return redirect()->back()->with('error', 'An error occurred while trying to delete the user. Please try again.');
        }
    }

    //--------------------

    // view user details
    public function view_traveller_details(Request $request)
    {
        $id=$request->id;
        $data=QueryTraveller::find($id);
        $countries=countries::all();
        $pac_data= view('home.profile_pages.render_traveller_details',compact('data','countries'))->render();
        echo $pac_data;
    }

    // add user traveller details
    public function add_user_traveller(Request $request)
    {
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $email_id=$user->email;
        $query_lead_traveller=QueryLeadTraveller::where('email',$email_id)->first();
        if($query_lead_traveller==''):
            $query_lead_traveller=new QueryLeadTraveller;
            $query_lead_traveller->email=$email_id;
            $query_lead_traveller->save();
        endif;
        $lead_traveller_id=$query_lead_traveller->id;
        $data = new QueryTraveller;
        $data->lead_traveller_id=$lead_traveller_id;
        $data->firstname=$request->firstname;
        $data->lastname=$request->lastname;
        $data->dob=$request->dob;
        $data->gender=$request->gender;
        $data->passportnumber=$request->passportnumber;
        $data->passportcountry=$request->passportcountry;
        $data->passport_expire_date=$request->passport_expire_date;
        $data->save();
        return redirect("/customer-panel")->with('success','Traveller has been added successfully!');
    }

    // update user traveller details
    public function update_user_traveller(Request $request)
    {
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $email_id=$user->email;
        $query_lead_traveller=QueryLeadTraveller::where('email',$email_id)->first();
        if($query_lead_traveller==''):
            $query_lead_traveller=new QueryLeadTraveller;
            $query_lead_traveller->email=$email_id;
            $query_lead_traveller->save();
        endif;
        $lead_traveller_id=$query_lead_traveller->id;
        $id=$request->id;
        $data=QueryTraveller::where([['id',$id],['lead_traveller_id',$lead_traveller_id]])->first();
        if($data!='') {
            $data->lead_traveller_id=$lead_traveller_id;
            $data->firstname=$request->firstname;
            $data->lastname=$request->lastname;
            $data->dob=$request->dob;
            $data->gender=$request->gender;
            $data->passportnumber=$request->passportnumber;
            $data->passportcountry=$request->passportcountry;
            $data->passport_expire_date=$request->passport_expire_date;
            $data->save();
        }
        return redirect("/customer-panel")->with('success','Traveller has been updated successfully!');
    }

    // delete user traveller
    public function delete_user_traveller(Request $request)
    {
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $email_id=$user->email;
        $query_lead_traveller=QueryLeadTraveller::where('email',$email_id)->first();
        if($query_lead_traveller==''):
            $query_lead_traveller=new QueryLeadTraveller;
            $query_lead_traveller->email=$email_id;
            $query_lead_traveller->save();
        endif;
        $lead_traveller_id=$query_lead_traveller->id;
        $id=$request->id;
        $data=QueryTraveller::where([['id',$id],['lead_traveller_id',$lead_traveller_id]])->first();
        if($data!='') {
            QueryTraveller::destroy($data->id);
        }
        echo 'success';
    }

    /*// upload user profile pic
    public function upload_profile_image(Request $request)
    {
        if($request->hasFile('file')) {
            $image=$request->file("file");
            $name=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path().'/uploads/user_profiles/', $name);
            $profile=$name;
            if(Sentinel::getUser()->profile_image!='') {
                $file_path = public_path()."/uploads/user_profiles/".Sentinel::getUser()->profile_image;
                unlink($file_path);
            }
            $dataEdit = [
                'profile_image' => $profile,
            ];
            $user = Sentinel::findById(Sentinel::getUser()->id);
            $save = Sentinel::update($user, $dataEdit);
            $user_details=UserDetails::where('user_id',Sentinel::getUser()->id)->first();
            if($user_details=='') {
                $user_details=new  UserDetails;
            }
            $user_details->user_id=Sentinel::getUser()->id;
            $user_details->profile_image=$profile;
            $user_details->save();
        }
    }*/

    // Upload user profile pic
    public function upload_profile_image(Request $request)
    {
        // Validate the request to allow specific image types and size
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,webp|max:1024', // Allowing JPEG, JPG, PNG, and WEBP images
        ]);

        // Check if a file is uploaded
        if ($request->hasFile('file')) {
            $image = $request->file("file");
            
            // Get the original file extension
            $originalExtension = $image->getClientOriginalExtension();
            
            // Generate a new filename (you may want to add a prefix or timestamp to avoid conflicts)
            $newFileName = 'profile_image.' . $originalExtension;

            // Define the full path for the profile image
            $profileImagePath = public_path('/uploads/user_profiles/' . $newFileName);

            // Delete the old image if it exists
            if (file_exists($profileImagePath)) {
                unlink($profileImagePath);
            }

            // Move the new image to the desired location
            $image->move(public_path('/uploads/user_profiles/'), $newFileName);

            // Update user profile information
            $dataEdit = [
                'profile_image' => $newFileName,
            ];
            
            $user = Sentinel::getUser();
            Sentinel::update($user, $dataEdit);

            // Update UserDetails model
            $userDetails = UserDetails::firstOrNew(['user_id' => $user->id]);
            $userDetails->profile_image = $newFileName;
            $userDetails->save();
            
            return response()->json(['success' => 'Profile image updated successfully.']);
        }

        return response()->json(['error' => 'No file was uploaded.'], 400);
    }

}