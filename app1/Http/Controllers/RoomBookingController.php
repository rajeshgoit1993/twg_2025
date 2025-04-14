<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\Hotel;
use App\HotelUploads;
use App\Room;
use App\RoomBooking;
use App\User;
use App\UserDetails;
use App\Http\Controllers\MailController;
use Carbon;
class RoomBookingController extends Controller
{
    public function index()
    {
    }
    public function CheckUserAvailblity(Request $request)
    {
        //return response()->json($request);
        if(Sentinel::check()){
            $userId = Sentinel::getUser()->id;
            return response()->json($userId);
        }else{
            $user = User::where('email', $request->email)->first();
            if ($user === null) {
                $credentials = [
                    'first_name' => $request->name,
                    'email'    => $request->email,
                    'password' => '123456',
                ];
                // Register New user
                $user = Sentinel::registerAndActivate($credentials);
                // Assign a New Role To New User
                $role = Sentinel::findRoleBySlug('customer');
                // Attach New user a Role
                $role->users()->attach($user);
                // Assign user Details
                $UserDetails = UserDetails::updateOrCreate(
                    ['user_id' => $user->id],
                    ['phone_no'=>$request->phone,
                    'dob'=>'',
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'streetname'=>'',
                    'country'=>$request->country,
                    'state'=>$request->state,
                    'zipcode'=>$request->zip,
                    'about'=>''
                    ]
                );
                return response()->json($user->id);
            }else{
                return response()->json($user->id);
            }
        }
    }
    public function bookRooms(Request $request)
    {
        //$userDetails = UserDetails::where('user_id', Sentinel::getUser()->id)->get();
        $hoteldata = Hotel::find($request->hotelId);
        $HotelUploads = HotelUploads::where('hotel_id',$request->hotelId)->get();
       // dd($userDetails);
    	return view('hotels.hotelBooking',[
            //'userinfo'=>$userDetails,
            'allBookingDetail'=>$request,
            'HotelDetail'=>$hoteldata,
            'images'=>$HotelUploads
            ]);
    }
    public function ConfirmCancelBooking(Request $request)
    {
        //return response()->json($request);
    	return view('hotels.confirmCancelBooking',['request'=>$request]);
    }
    public function cancelBooking(Request $request)
    {
        //return response()->json($request->order_id);
        $cancelData = RoomBooking::where('cca_order_id', '=', $request->order_id)->update([
            'bookingStatus' => 'cancelled',
            'refundAmount' => $request->refundAmount,
            'cancellationCharges' => $request->deductedAmount,
            'bookingCancelDate' => $request->cancelDate,
            ]);
        // $mail = new MailController;
        // $mail->html_email();
        return redirect('/customer-panel')->with('success','Booking Cancelled Successfully');
    }
}