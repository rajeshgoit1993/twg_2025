<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\User;
use App\UserDetails;
use App\Packages;
use App\RoomBooking;
use App\Mid_Image;
use App\Testimonial;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Illuminate\Support\Facades\DB;
use App\Helpers\CustomHelpers;
use Mail;
use Hash;
use Reminder;
use Activation;
use App\Option1Quotation;
use App\Option2Quotation;
use App\Option3Quotation;
use App\Option4Quotation;
use App\Query;
use App\QueryLeadTraveller;
use App\QueryLeadTravellerInfo;
use App\QueryTraveller;
use App\Passengerinfo;
use Session;
use Laravel\Socialite\Facades\Socialite;
use Jenssegers\Agent\Agent; // for mobile and desktop view
use Illuminate\Support\Facades\Cache; // Laravel Cache (Cache::remember), application-level caching


class HomeController extends Controller 
{

    /*//public $mail_from_ids="tourquotes@theworldgateway.com";
    public $mail_from_ids="rapidextravels@hotmail.com";
    //public $mail_to_cc="helpdesk@theworldgateway.com";
    public $mail_to_cc="helpdesk@theworldgateway.com";
    //public $mail_from_id="reservations@theworldgaeway.com";
    public $mail_from_id="rapidextravels@hotmail.com";*/

    /*check with queryController for more details*/
    public $mail_from_sender;
    public $mail_from_reservations;
    public $mail_to_cc;
    public $webnotation;

    public function __construct()
    {
        // Determine webnotation (1 = The World Gateway, 0 = Rapidex Travels)
        $this->webnotation = env("WEBSITENAME") == 1 ? 1 : 0;

        // Get website-specific email details dynamically
        $this->mail_from_sender = getWebsiteData('sender_email');
        $this->mail_from_reservations = getWebsiteData('reservation_email');
        $this->mail_to_cc = getWebsiteData('cc_email'); // Fetch support email dynamically
    }


    /**********************/


    public function login_with_google() 
    {
        return Socialite::driver('google')->redirect();
    }

    // user login via gmail
    public function gmaillogin() 
    {
        try {
            $user= Socialite::driver('google')->user();
            $email=$user->email;
            $user_data=$user->user;
            $check_data=DB::table('users')->where('email',$email)->first();
            if($check_data=='') {
                $dataEdit = [
                'first_name' => $user_data['given_name'],
                'last_name' => $user_data['family_name'],
                'social_id' => $user_data['id'],
                'social_nickname' => $user->nickname,
                'social_picture' =>$user_data['picture'],
                'social_locale' =>$user_data['locale'],
                'password' => 123456,
                'email' => $email,
                'email_activation'=>1,
                'register_type'=>1,
                ];
                $user= Sentinel::registerAndActivate($dataEdit);
                $role = Sentinel::findRoleBySlug('customer');
                $role->users()->attach($user);
                $loginuser=User::whereEmail($email)->first();
                $to=$email;
                Mail::send('query.mail.enquiry_mail.newregistration',compact("loginuser"),function($message) use ($to) {
                    $message->from($this->mail_from_id);
                    $message->to($to)->subject("New Registration");
                    });
                $user_name = Sentinel::findById($loginuser->id);
                Sentinel::login($user_name);
                return redirect('/customer-panel');
                } else {
                    $dataEdit = [
                        'social_id' => $user_data['id'],
                        'social_nickname' => $user->nickname,
                        'social_picture' => $user_data['picture'],
                        'social_locale' => $user_data['locale'],
                        ];
                    $user= Sentinel::registerAndActivate($dataEdit);
                    $role = Sentinel::findRoleBySlug('customer');
                    $role->users()->attach($user);
                    $loginuser=User::whereEmail($email)->first();
                    $user_name = Sentinel::findById($loginuser->id);
                    Sentinel::login($user_name);
                    if(Sentinel::getUser()->inRole("super_admin") | Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('agent') || Sentinel::getUser()->inRole('employee')) {
                        $user = Sentinel::findById(Sentinel::getUser()->id);
                        $user->login_status=1;
                        $user->save();
                        return redirect('/dashboard');
                        } else {
                            return redirect('/customer-panel');
                            }
                    }
        }
        catch(\Throwable $th) {
            return redirect('/');
            // throw $th;
            }
    }

    /******************************************/

    // home page packages
    /*public function index() 
    {
        $exclude_emails = [
            ['status','=' ,'1'],
            ['front_show','=' ,'1'],
            ['rt_packages.country' ,'not like','%'.'India'.'%'],
            ['rt_packages.country' ,'not like','%'.'Nepal'.'%'],
            ['rt_packages.country' ,'not like','%'.'Bhutan'.'%'],
            ];
        $packages=\DB::table("rt_packages")
        ->where($exclude_emails)
        ->inRandomOrder()->limit(8)->get();
        $country = array('India','Nepal','Bhutan');
        $packages_domestic = DB::Table('rt_packages')
        ->Where(function ($query) use($country) {
            for ($i = 0; $i < count($country); $i++) {
                $query->orwhere([['status','=' ,'1'],['front_show','=' ,'1'],['country', 'like',  '%' . $country[$i] .'%']]);
                }
            })
        ->inRandomOrder()->limit(8)->get();
        $img_data=Mid_Image::all();
        $testimonial=Testimonial::where('status',1)->get();

        // dd($packages);
        return view('home.home',['packages'=>$packages,'packages_domestic'=>$packages_domestic,'img_data'=>$img_data,'testimonial'=>$testimonial]);
    }*/

    // home page (one view, using width js using client-side)
    /*public function index() 
    {
        // Define the countries to exclude
        $excludedCountries = ['India', 'Nepal', 'Bhutan'];

        // Fetch packages excluding certain criteria
        $packages = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountries) {
                foreach ($excludedCountries as $country) {
                    $query->where('country', 'not like', "%$country%");
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Fetch domestic packages including certain countries
        $packages_domestic = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountries) {
                foreach ($excludedCountries as $country) {
                    $query->orWhere('country', 'like', "%$country%");
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Fetch image data
        $img_data = Mid_Image::all();

        // Fetch testimonials
        $testimonial = Testimonial::where('status', 1)->get();

        // Return view with data
        return view('home.home', [
            'packages' => $packages,
            'packages_domestic' => $packages_domestic,
            'img_data' => $img_data,
            'testimonial' => $testimonial
        ]);
    }*/

    // home page (mobile and desktop view using server-side)
    /*public function index()
    {
        $agent = new Agent();

        // Determine device type
        $isMobile = $agent->isMobile();

        // Define countries to exclude
        $excludedCountries = ['India', 'Nepal', 'Bhutan'];

        // Fetch international packages
        $packages = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountries) {
                foreach ($excludedCountries as $country) {
                    $query->where('country', 'not like', "%$country%");
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Fetch domestic packages
        $packages_domestic = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountries) {
                foreach ($excludedCountries as $country) {
                    $query->orWhere('country', 'like', "%$country%");
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Fetch image data
        $img_data = Mid_Image::all();

        // Fetch testimonials
        $testimonial = Testimonial::where('status', 1)->get();

        $data = [
            'packages' => $packages,
            'packages_domestic' => $packages_domestic,
            'img_data' => $img_data,
            'testimonial' => $testimonial
        ];

        // Return mobile or desktop view
        if ($isMobile) {
            return view('home.mobile.home', $data);
        } else {
            return view('home.desktop.home', $data);
        }
    }*/

    /*public function index()
    {
        // Fetch IDs of countries to exclude (e.g., India, Nepal, Bhutan)
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', ['India', 'Nepal', 'Bhutan'])
            ->pluck('id')
            ->toArray();

        // International packages (exclude certain country IDs)
        $packages = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountryIds) {
                foreach ($excludedCountryIds as $countryId) {
                    $query->whereRaw("NOT FIND_IN_SET(?, REPLACE(REPLACE(country, '\"', ''), ',', ','))", [$countryId]);
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Domestic packages (include only certain country IDs)
        $packages_domestic = DB::table('rt_packages')
            ->where('status', '1')
            ->where('front_show', '1')
            ->where(function ($query) use ($excludedCountryIds) {
                foreach ($excludedCountryIds as $countryId) {
                    $query->orWhereRaw("FIND_IN_SET(?, REPLACE(REPLACE(country, '\"', ''), ',', ','))", [$countryId]);
                }
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();


        // Other data
        $img_data = Mid_Image::all();
        $testimonial = Testimonial::where('status', 1)->get();

        // View decision (device-based rendering)
        //$agent = new \Jenssegers\Agent\Agent;
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        $view = $isMobile ? 'home.mobile.home' : 'home.desktop.home';

        return view($view, compact('packages', 'packages_domestic', 'img_data', 'testimonial'));
    }*/

    // public function index()
    // {
    //     $agent = new Agent();

    //     // Determine device type
    //     $isMobile = $agent->isMobile();


    //     // ******if want to fetch based on country*********

    //     // ✅ Define country names to exclude
    //     $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

    //     // ✅ Fetch their corresponding IDs from `countries` table
    //     $excludedCountryIds = DB::table('countries')
    //         ->whereIn('name', $excludedCountryNames)
    //         ->pluck('id')
    //         ->toArray();

    //     // 🌐 International packages: exclude if country contains any of these IDs
    //     $packages_international = DB::table('rt_packages')
    //         ->where('status', '1')
    //         ->where('front_show', '1')
    //         ->where(function ($query) use ($excludedCountryIds) {
    //             foreach ($excludedCountryIds as $id) {
    //                 $query->where('country', 'not like', "%$id%");
    //             }
    //         })
    //         ->inRandomOrder()
    //         ->limit(8)
    //         ->get();

    //     // 🇮🇳 Domestic packages: include if country contains any of these IDs
    //     $packages_domestic = DB::table('rt_packages')
    //         ->where('status', '1')
    //         ->where('front_show', '1')
    //         ->where(function ($query) use ($excludedCountryIds) {
    //             foreach ($excludedCountryIds as $id) {
    //                 $query->orWhere('country', 'like', "%$id%");
    //             }
    //         })
    //         ->inRandomOrder()
    //         ->limit(8)
    //         ->get();


    //     // ******if want to fetch based on city (some issues, will have to check for intl pkgs)*********

    //     // // Define city names to include for domestic packages
    //     // $includedCityNames = ['Shimla', 'Manali', 'Darjeeling', 'Munnar'];

    //     // // Define country names to exclude for international packages
    //     // $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

    //     // // 🏙️ Get city IDs from names
    //     // $includedCityIds = DB::table('city')
    //     //     ->whereIn('name', $includedCityNames)
    //     //     ->pluck('id')
    //     //     ->toArray();

    //     // // 🌍 Get country IDs from names
    //     // $excludedCountryIds = DB::table('countries')
    //     //     ->whereIn('name', $excludedCountryNames)
    //     //     ->pluck('id')
    //     //     ->toArray();

    //     // // 🌐 International Packages (exclude country IDs)
    //     // $packages_international = DB::table('rt_packages')
    //     //     ->where('status', '1')
    //     //     ->where('front_show', '1')
    //     //     ->where(function ($query) use ($excludedCountryIds) {
    //     //         foreach ($excludedCountryIds as $countryId) {
    //     //             $query->where('country', 'not like', "%$countryId%");
    //     //         }
    //     //     })
    //     //     ->inRandomOrder()
    //     //     ->limit(8)
    //     //     ->get();

    //     // // 🇮🇳 Domestic Packages (include only selected city IDs)
    //     // $packages_domestic = DB::table('rt_packages')
    //     //     ->where('status', '1')
    //     //     ->where('front_show', '1')
    //     //     ->where(function ($query) use ($includedCityIds) {
    //     //         foreach ($includedCityIds as $cityId) {
    //     //             $query->orWhere('city', 'like', "%$cityId%");
    //     //         }
    //     //     })
    //     //     ->inRandomOrder()
    //     //     ->limit(8)
    //     //     ->get();

    //     // *****************************

    //     // Fetch image data (world popular destinations)
    //     $world_popular_destinations = Mid_Image::all();

    //     // Fetch testimonials
    //     $testimonial = Testimonial::where('status', 1)->get();

    //     // Pass everything to the view
    //     $data = [
    //         'packages' => $packages_international,
    //         'packages_domestic' => $packages_domestic,
    //         'img_data' => $world_popular_destinations,
    //         'testimonial' => $testimonial
    //     ];

    //     //return view($isMobile ? 'home.mobile.home' : 'home.desktop.home', $data);
    //     // Return mobile or desktop view
    //     if ($isMobile) {
    //         return view('home.mobile.home', $data);
    //     } else {
    //         return view('home.desktop.home', $data);
    //     }
    // }

    /*public function index()
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        // Countries to exclude for international packages
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->where('front_show', 1)
            ->get();

        $packages_international = [];
        $packages_domestic = [];

        foreach ($allPackages as $pkg) {
            //$countryIds = @unserialize($pkg->country);
            $countryIds = is_string($pkg->country) ? @unserialize($pkg->country) : null;
            if (!is_array($countryIds)) continue;

            // If package has any country in the excluded list — it's domestic
            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if (!empty($intersect)) {
                $packages_domestic[] = $pkg;
            } else {
                $packages_international[] = $pkg;
            }
        }

        // Random 8 packages from each group
        $packages_domestic = collect($packages_domestic)->shuffle()->take(8);
        $packages_international = collect($packages_international)->shuffle()->take(8);

        $world_popular_destinations = Mid_Image::all();
        $testimonial = Testimonial::where('status', 1)->get();

        $data = [
            'packages' => $packages_international,
            'packages_domestic' => $packages_domestic,
            'img_data' => $world_popular_destinations,
            'testimonial' => $testimonial,
        ];

        return view($isMobile ? 'home.mobile.home' : 'home.desktop.home', $data);
    }*/

    // with cache (php artisan cache:clear)
    /*public function index()
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];
        $excludedCountryIds = Cache::remember('excluded_country_ids', 60 * 60, function () use ($excludedCountryNames) {
            return DB::table('countries')
                ->whereIn('name', $excludedCountryNames)
                ->pluck('id')
                ->toArray();
        });

        $packagesData = Cache::remember('home_packages', 60 * 60, function () use ($excludedCountryIds) {
            $allPackages = DB::table('rt_packages')
                ->where('status', 1)
                ->where('front_show', 1)
                ->get();

            $packages_international = [];
            $packages_domestic = [];

            foreach ($allPackages as $pkg) {
                $countryIds = @unserialize($pkg->country);
                if (!is_array($countryIds)) continue;

                $intersect = array_intersect($excludedCountryIds, $countryIds);
                if (!empty($intersect)) {
                    $packages_domestic[] = $pkg;
                } else {
                    $packages_international[] = $pkg;
                }
            }

            return [
                'domestic' => collect($packages_domestic)->shuffle()->take(8),
                'international' => collect($packages_international)->shuffle()->take(8),
            ];
        });

        // world popular destinations
        $world_popular_destinations = Cache::remember('world_popular_destinations_pkgs', 60 * 60, function () {
            return Mid_Image::all();
        });

        // testimonials
        $testimonial = Cache::remember('home_testimonials', 60 * 60, function () {
            return Testimonial::where('status', 1)->get();
        });

        $data = [
            'packages' => $packagesData['international'],
            'packages_domestic' => $packagesData['domestic'],
            'img_data' => $world_popular_destinations,
            'testimonial' => $testimonial,
        ];

        return view($isMobile ? 'home.mobile.home' : 'home.desktop.home', $data);
    }*/

    // home page (mobile and desktop view using server-side)
    // Because this list also doesn’t change every few seconds — it’s okay to refresh once an hour. But we still want the final 8 random packages to change every page load, so we don’t cache the final random selection.
    public function index()
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        // Countries to exclude for domestic (India + nearby)
        // Cache excluded countries
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];
        $excludedCountryIds = Cache::remember('excluded_country_ids', 1440, function () use ($excludedCountryNames) { // 24hrs*60mins
            return DB::table('countries')
                ->whereIn('name', $excludedCountryNames)
                ->pluck('id')
                ->toArray();
        });

        // Fetch all front-showing active packages from DB or cache (raw list only)
        // Cache all front packages
        $allPackages = Cache::remember('all_front_packages', 60, function () { // 60mins
            return DB::table('rt_packages')
                ->where('status', 1)
                ->where('front_show', 1)
                ->get();
        });

        // Separate domestic and international based on country intersection
        $packages_domestic = [];
        $packages_international = [];

        foreach ($allPackages as $pkg) {
            $countryIds = @unserialize($pkg->country);
            if (!is_array($countryIds)) continue;

            // If package has any country in the excluded list — it's domestic
            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if (!empty($intersect)) {
                $packages_domestic[] = $pkg;
            } else {
                $packages_international[] = $pkg;
            }
        }

        // Shuffle fresh on each request - Random 8 packages from each group
        $packages_domestic = collect($packages_domestic)->shuffle()->take(8);
        $packages_international = collect($packages_international)->shuffle()->take(8);

        // Cache world popular destinations
        $world_popular_destinations = Cache::remember('world_popular_destinations_pkgs', 60 * 60, function () {
            return Mid_Image::all(); // Fetch all images from the database
        });

        // Cache testimonials
        $testimonial = Cache::remember('home_testimonials', 60 * 60, function () {
            return Testimonial::where('status', 1)->get(); // Fetch active testimonials
        });

        $data = [
            'packages'              => $packages_international,
            'packages_domestic'     => $packages_domestic,
            'img_data'              => $world_popular_destinations,
            'testimonial'           => $testimonial,
        ];

        return view($isMobile ? 'home.home' : 'home.home', $data);
    }

    // add more packages (home page) (enhanced) (using add more package button)
    public function add_package(Request $request)
    {
        $content_type = $request->input('content_type');
        $alreadyLoadedIds = $request->input('already_loaded_ids', []); // loaded pkgs will not repeat (linked to pageone.js)
        $limit = $request->input('limit', 4); // default to 4

        // Define excluded countries for "domestic"
        $excludedCountryNames = ['India', 'Nepal', 'Bhutan'];

        // Get their IDs
        $excludedCountryIds = DB::table('countries')
            ->whereIn('name', $excludedCountryNames)
            ->pluck('id')
            ->toArray();

        // Fetch all eligible packages
        $allPackages = DB::table('rt_packages')
            ->where('status', 1)
            ->where('front_show', 1)
            ->whereNotIn('id', $alreadyLoadedIds) // exclude already shown
            ->get();

        $packages = [];

        foreach ($allPackages as $pkg) {
            $countryIds = @unserialize($pkg->country);
            if (!is_array($countryIds)) continue;

            $intersect = array_intersect($excludedCountryIds, $countryIds);

            if ($content_type === 'international' || $content_type === 'international_mobile') {
                // International: Should NOT match any excluded
                if (empty($intersect)) {
                    $packages[] = $pkg;
                }
            } else {
                // Domestic: Should include any excluded
                if (!empty($intersect)) {
                    $packages[] = $pkg;
                }
            }
        }

        // Shuffle and take up to 4
        $packages = collect($packages)->shuffle()->take($limit);

        // Render view
        $output = view('home.add_more_data.index', [
            'content_type' => $content_type,
            'packages' => $packages
        ])->render();

        return response()->json(['html' => $output]);
    }


    /******************************************/


    // home page- not in use
    /*public function home_index($id) 
    {
        if(is_numeric($id)):
        $package_count=$id+3;
        $packages = Packages::all()->where('status','1')->take($package_count);
        $img_data=Mid_Image::all();
        $testimonial=Testimonial::all();

        // dd($packages);
        return view('home.home',['packages'=>$packages,'img_data'=>$img_data,'testimonial'=>$testimonial]);
        else:
        endif;
    }*/

    // user (post) login
    public function postLogin(Request $request) 
    {
        // $currentURL = $request->currentURL;
        $currentURL=url()->previous();
        $error = array();
        try {
            if (Sentinel::authenticate($request->all())) {
                if(Sentinel::getUser()->inRole('customer')) {
                echo 'user';
                // return redirect($currentURL);
                } else {
                    echo 'admin';
                    // return redirect('/dashboard');
                    }
                } else {
                    echo 'Either Username or Password is incorrect, try again';
                    // $error['error'] ="Username or Password incorrect.";
                    // return redirect($currentURL)->with($error);
                    }
            }
        catch (NotActivatedException $e) {
            echo 'This account is not activated, contact the administrator';
            // $error['error'] = 'Account is not activated!';
            }
        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            echo "Your account is blocked for {$delay} second(s)";
            // $error['error'] = "Your account is blocked for {$delay} second(s).";
            }
        // return redirect()->back()->with($error);
    }

    /******************************************/

    // forget password
    /* public function forget_password(Request $request) {
        $user=User::whereEmail($request->email)->first();
        if(count($user)=="0") {
            $error['error']='Invalid email id, enter correct email id';
            return redirect('/')->with($error);
            } else {
                $sentinal_user=Sentinel::findById($user->id);
                if(count($sentinal_user)=="0") {
                    $error["error"]="This email id does not exist";
                    return redirect('/')->with($error);
                }
                $reminder=Reminder::exists($sentinal_user) ? : Reminder::create($sentinal_user);
                $this->send_Email($sentinal_user,$reminder->code);
                return redirect('/')->with(["success"=>"Password reset Code sent on registered email id"]);
                }
        } */
    
    // forget password
    public function forget_password(Request $request) 
    {
        $user=User::whereEmail($request->email)->first();
        if($user=="") {
            echo 'Enter Correct Email Id';
            // $error['error']='Enter Correct Email Id';
            // return redirect('/')->with($error);
            } else {
                $sentinal_user=Sentinel::findById($user->id);
                if($sentinal_user=="") {
                    echo 'Email Id Not Exit';
                    // $error["error"]="Email Id Not Exit";
                    // return redirect('/')->with($error);
                    }
                $reminder=Reminder::exists($sentinal_user) ? : Reminder::create($sentinal_user);
                $this->send_Email($sentinal_user,$reminder->code);
                echo 'success';
                // return redirect('/')->with(["success"=>"Reset Code Sended Your Email"]);
                }
    }
    
    /******************************************/

    // forget password email instructions on email
    public function send_Email($user,$code) 
    {
        Mail::send("layouts.front.emaillink",
            [
            'user'=>$user,
            'code'=>$code
            ],
        function($message) use ($user){
            $message->to($user->email);
            $message->subject("Dear $user->first_name, Reset your password");
            });
    }

    // reset password email instructions on email
    /* public function send_Email($user,$code) 
    {
        Mail::send("layouts.front.emaillink",['user'=>$user,
                                              'code'=>$code],function($message) use ($user){
                                                $message->to($user->email);
                                                $message->subject("Hello $user->first_name, Reset your password");
                                              });
    } */

    /******************************************/

    // reset password by user
    public function reset_password($email,$code) {
        $user=User::whereEmail($email)->first();
        if($user=="") {
            abort(404);
            }
            $sentinal_user=Sentinel::findById($user->id);
            if($reminder=Reminder::exists($sentinal_user)) {
                if($code==$reminder->code) {
                    return view("layouts.front.passwordreset");
                    } else {
                        return redirect('/');
                        }
                } else {
                    return redirect('/');
                    }
        }

    // user reset password
    /* public function reset_password($email,$code) {
        $user=User::whereEmail($email)->first();
        if(count($user)=="0") {
            abort(404);
            }
        $sentinal_user=Sentinel::findById($user->id);
        if($reminder=Reminder::exists($sentinal_user)) {
            if($code==$reminder->code) {
                return view("layouts.front.passwordreset");
                } else {
                    return redirect('/');
                    }
            } else {
                return redirect('/');
                }
        } */
    
    /******************************************/

    // login with new (reset) password
    public function password_reset($email, $code ,Request $request) 
    {
        $this->validate($request,[
            'password'=>'required|min:6',
            'cpassword'=>'required|same:password']);
        $user=User::whereEmail($email)->first();
        //if(count($user)=="0") {
        if($user=="") {
            abort(404);
            }
        $sentinal_user=Sentinel::findById($user->id);
        if($reminder=Reminder::exists($sentinal_user)) {
            if($code == $reminder->code) {
                Reminder::complete($sentinal_user,$code,$request->password);
                return redirect('/')->with(["success"=>"Please Login with new password "]);
                } else {
                return redirect('/');
                }
            } else {
            return redirect('/');
            }
    }

    // user signup email otp verification
    public function postRegisterCustomer(Request $request) 
    {
        $validator = Validator::make($request->all(),
            ['email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
            ]);
        if($validator->fails()) {
            $a='';
            $messages = $validator->messages();
            foreach ($messages->all(':message') as $message) {
                $a= $message;
                }
            echo $a;
            } else {
                if(Session::has('signup_info')) {
                    Session::forget('signup_info');
                    }
                Session::set('signup_info',$request->all());
                $otp=mt_rand(10000,99999);
                $login_email=$request->email;
                setcookie('signup_otp',$otp);
                setcookie('signup_email',$login_email);
                Mail::raw("Hello User, OTP is: $otp" , function ($message) use ($login_email) {
                    $message->to($login_email);
                    $message->from($login_email,"The WorldGateway");
                    $message->subject("Hello User, Email verification OTP");
                    });
                echo 'success';
                }
    }
   
    // user signup with otp   
    public function signup_with_otp(Request $request) 
    {
        $otp=$request->otp_value;

        $old_otp=$_COOKIE['signup_otp'];
        if($otp==$old_otp):

        $email=$_COOKIE['signup_email'];

        $user= Sentinel::registerAndActivate(Session::get('signup_info'));
        $role = Sentinel::findRoleBySlug('customer');
        $role->users()->attach($user);
        $loginuser=User::whereEmail($email)->first();
        $to=$email;
        $user=User::whereEmail($_COOKIE['email'])->first();
        $user->email_activation=1;
        $user->save();
        $user_name = Sentinel::findById($user->id);
        Sentinel::login($user_name);
        echo 'success';

        // Mail::send('query.mail.enquiry_mail.newregistration',compact("loginuser"),function($message) use ($to)
        //   {
        //  $message->from($this->mail_from_id);
        //  $message->to($to)->subject("New Registration");

        //  });
        else:
        echo 'Invalid OTP, enter correct OTP';
        endif;
    }

    // new user activation email
    private function sendActivationMail($user,$code) 
    {
        Mail::send('home.activation.activation',['user'=>$user,'code'=>$code],
        function($message) use ($user) {
            $message->to($user->email);
            $message->from($user->email,"Account activation");
            $message->subject("Hello $user->first_name activate your account.");
            });
    }

    // new user activation status
    public function activation($email, $code) {
        $user=User::whereEmail($email)->first();
        if(count($user)=="0") {
            abort(404);
            }
            $sentinal_user=Sentinel::findById($user->id);
            $data_activations=DB::table('activations')
            ->where('user_id','=',$user->id)
            ->first();
            if($code == $data_activations->code) {
                Activation::complete($sentinal_user, $data_activations->code);
                return redirect('/')->with(["success"=>"Welcome! Your account has been successfully activated!"]);
                } else {
                    return redirect('/')->with(["error"=>"This account is not activated, contact helpdesk"]);
                    }
            }

    // user dashboard
    public function customerPanel() {
        $userDetails = UserDetails::where('user_id', Sentinel::getUser()->id)->get();
        $myBookings = RoomBooking::where('customerId', Sentinel::getUser()->id)->orderBy('id', 'desc')->get();;
        return view('home.myaccount',[
            'userifo'=>$userDetails,
            'myBookings'=>$myBookings
            ]);
        }

    // user booking
    public function mybooking() {
        $upcoming=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1],['rt_package_query.email','=',Sentinel::getUser()->email]])
        ->whereIn('rt_package_query.status', ['process_booking','issue_voucher','voucher_issued'])
        ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')
        ->get();
                  
        $unsuccess_or_some_payments=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1],['rt_package_query.email','=',Sentinel::getUser()->email]])
        ->select('option1_quotation.*','rt_package_query.accept_quote_no','rt_package_query.accept_quote_id')
        ->get();

        $cancelled=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([["option1_quotation.webnotation","=",env("WEBSITENAME")],['option1_quotation.del_status','=',1],['rt_package_query.email','=',Sentinel::getUser()->email]])
        ->whereIn('rt_package_query.status', ['booked_with_other','tour_cancelled','quote_rejected','no_response','lead_cancelled'])
       ->select('option1_quotation.*','rt_package_query.destinations','rt_package_query.booking_label')
      ->get();

       //      $previous_amount = DB::table('rt_payments')
       // ->where([['quote_ref_no','=',912023270413],['status','=',1]])
       // ->sum('amount');
       // dd($unsuccess_or_some_payments);
        return view('home.mybooking',compact('upcoming','unsuccess_or_some_payments','cancelled'));
        }
    
    // user manage booking
    public function manage_booking($id) {
        $ref_no=$id;
        $enq_data=DB::table('option1_quotation')->join('rt_package_query','rt_package_query.id' , '=', 'option1_quotation.query_reference')->where([['option1_quotation.del_status','=',1],['option1_quotation.send_option','=',1],['rt_package_query.email','=',Sentinel::getUser()->email],['option1_quotation.quo_ref','=',$ref_no]])

        ->select('rt_package_query.*','rt_package_query.destinations','rt_package_query.booking_label')
        ->first();
                      
           if($enq_data!='')  {
            $quote_no=$enq_data->accept_quote_no;
            if($quote_no==1) {
                $data=Option1Quotation::find((int)$enq_data->accept_quote_id);
                $quote_ref_no=$data->quo_ref;
                $price=$data->option1_price;
                $price_data=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller); 
                } elseif($quote_no==2) {
                    $data=Option2Quotation::find((int)$enq_data->accept_quote_id);
                    $quote_ref_no=$data->quotation_ref_no;
                    $price=$data->option2_price;
                    } elseif($quote_no==3) {
                        $data=Option3Quotation::find((int)$enq_data->accept_quote_id);
                        $quote_ref_no=$data->quotation_ref_no;
                        $price=$data->option3_price;
                        } elseif($quote_no==4) {
                            $data=Option4Quotation::find((int)$enq_data->accept_quote_id);
                            $quote_ref_no=$data->quotation_ref_no;
                            $price=$data->option4_price;
                            }
                            $amount=$price_data['query_pricetopay_adult'];
                            $query_reference=$data->query_reference;
                            $query=Query::find($query_reference);

                            $lead_passenger=QueryLeadTraveller::where('email',$data->email)->first();
                            $lead_passenger_info=QueryLeadTravellerInfo::where([['lead_traveller_id',$lead_passenger->id],['quote_id',$data->id],['qquote_no',$quote_no],['query_id',$data->query_reference]])->first();
                            $passengers=QueryTraveller::where('lead_traveller_id',$lead_passenger->id)->get();
                            $room_passenger[]='';
                            $passengers_infos=Passengerinfo::where([['lead_traveller_id','=',$lead_passenger->id],['quotation_ref_no','=',$quote_ref_no]])->first();
                            if($passengers_infos!='') {
                                $room_passenger=unserialize($passengers_infos->room_passenger);
                                }
                                $payments_histories = DB::table('rt_payments')
                                ->where([['quote_ref_no','=',$quote_ref_no],['status','=',1]])
                                ->get();

                                return view("home.bookingdetails",compact('query','amount','price','data','quote_ref_no','lead_passenger','lead_passenger_info','passengers','room_passenger','passengers_infos','payments_histories'));
                            } else {
                                return redirect('/');
                                }
        }

    // change password
    public function change_password(Request $request) {
        $this->validate($request,[
            'old_password'=>'required',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|same:new_password']);
        $user=User::find(Sentinel::getUser()->id);
        if(Hash::check($request->old_password ,$user['password']) && $request->new_password==$request->confirm_password):
            $user->password=bcrypt($request->new_password);
            $user->save();
            return redirect('/')->with("success","Password reset successfully");
            else:
            return redirect('/')->with("error",'Enter correct password');
        endif;
        }

    // save user profile
    public function postSaveProfile(Request $request) {
        $UserDetails = UserDetails::updateOrCreate(
            ['user_id' => Sentinel::getUser()->id],
            ['phone_no'=>$request->phone,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'city'=>$request->city,
            'streetname'=>$request->streetname,
            'country'=>$request->country,
            'state'=>$request->state,
            'zipcode'=>$request->zipcode,
            'about'=>$request->about
            ]
            );
            return response ()->json ($request);
        }

    // save user profile image
    public function postSaveProfileImage(Request $request) {
        //get the file from the post request
        $file = $request->file('file');
        $user_id = $request->input('user_id');
        //set my file name
        $filename = uniqid(). $file->getClientOriginalName();
        $path = '/uploads/user_profiles/'.$filename;
        //move the file to correct location
        $file->move(public_path().'/uploads/user_profiles/', $filename);
        $UserDetails = UserDetails::updateOrCreate(
            ['user_id' => $user_id],
            ['profile_image' => $path]
            );
        // $UserDetails->save();
        return redirect('/customer-panel');
        }
    
    // logout
    public function logout() {
        //Sentinel::logout();
        $user = Sentinel::getUser();
        Sentinel::logout($user, true);
        return redirect('/');
        }
    
    // test otp
    public function test_otp() {
        $status=$this->otp_send(1234567890);
        echo $status;
        }

    // login with otp
    public function login_with_otp(Request $request) {
        $otp=$request->otp_value;
        $old_otp=$_COOKIE['otp'];
        if($otp==$old_otp):
        $email=$_COOKIE['email'];
        $check_data=DB::table('users')->where('email',$email)->first();
            if($check_data=='') {
            $dataEdit = [
                'email' => $email,
                'password' => 123456,
                'email_activation'=>1,
                ];
            $user= Sentinel::registerAndActivate($dataEdit);
            $role = Sentinel::findRoleBySlug('customer');
            $role->users()->attach($user);
            $loginuser=User::whereEmail($email)->first();
            $to=$email;
            $user=User::whereEmail($_COOKIE['email'])->first();
            $user_name = Sentinel::findById($user->id);
            Sentinel::login($user_name);
            echo 'success';
            Mail::send('query.mail.enquiry_mail.newregistration',compact("loginuser"),function($message) use ($to) {
                $message->from($this->mail_from_id);
                $message->to($to)->subject("New Registration");
                });
            } else {
                $user=User::whereEmail($_COOKIE['email'])->first();
                $user_name = Sentinel::findById($user->id);
                Sentinel::login($user_name);
                echo 'success';
                } else:
                    echo 'Invalid OTP! Please enter valid OTP';
            endif;
        }

    // user login OTP
    public function send_login_otp(Request $request) {
        $login_email=$request->login_email;
        $check_data=DB::table('users')->where('email',$login_email)->first();
        if($check_data!='') {
            $otp=mt_rand(10000,99999);
            $user=DB::table('users')->where('email',$login_email)->first();;
            setcookie('otp',$otp);
            setcookie('email',$user->email);
            Mail::raw("Hi $user->first_name, your OTP is: $otp. It's valid for 10 minutes." , function ($message) use ($user) {
                $message->to($user->email);
                $message->from($user->email,"The WorldGateway");
                $message->subject("Hi $user->first_name, Email OTP");
                });
            $status=CustomHelpers::otp_send($user->mobile,$otp);
            echo 'success';
            } else {
                $otp=mt_rand(10000,99999);
                setcookie('otp',$otp);
                setcookie('email',$login_email);
                Mail::raw("Hello User,  Your OTP is: $otp" , function ($message) use ($login_email) {
                    $message->to($login_email);
                    $message->from($login_email,"The WorldGateway");
                    $message->subject("Hi User, Email OTP");
                    });
                echo 'success';
                }
        }
}