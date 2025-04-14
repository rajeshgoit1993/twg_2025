<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade

use Illuminate\Http\Request;
use Sentinel;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\User;

class LoginController extends Controller
{
    public function login()
    {
    	return view('authentication.login');
    }

    // login
    public function postLogin(Request $request)
    {
        $error = [];

        try {
            // Attempt to authenticate the user with the provided credentials
            if (Sentinel::authenticate($request->all())) {
                // Cache the authenticated user
                $user = Sentinel::getUser();

                // Define the allowed roles
                $allowedRoles = ['super_admin', 'administrator', 'supervisor', 'agent', 'employee'];

                // Check if the user has any of the allowed roles
                foreach ($allowedRoles as $role) {
                    if ($user->inRole($role)) {

                        // Update the login status to active (1)
                        $user->login_status = 1;
                        $user->save();

                        // Redirect to the backend dashboard if the user has an appropriate role
                        return redirect('/dashboard');
                    }
                }

                // If the user does not have an appropriate role, redirect to the homepage
                $error['error'] = 'You do not have permission to access the backend.';
                return redirect('/')->with($error);
            } else {
                // Authentication failed, set an error message
                $error['error'] = "Either username or password is incorrect.";
            }
        } catch (NotActivatedException $e) {
            // Handle the case where the user account is not activated
            $error['error'] = 'This account is not activated!';
        } catch (ThrottlingException $e) {
            // Handle the case where the user has been temporarily blocked
            $delay = $e->getDelay();
            $error['error'] = "Your account is blocked for {$delay} second(s).";
        }

        // If authentication or role check failed, redirect back with the error message
        return redirect()->back()->with($error);
    }

    // logout
    /*public function logout() 
    {
        // Get the current user
        $user = Sentinel::getUser();

        // Check if the user is authenticated
        if ($user) {
            // Find the user by ID and update login status
            $user_data = Sentinel::findById($user->id);
            $user_data->login_status = 0;
            $user_data->save();

            // Log out the user
            Sentinel::logout($user, true);
        }

        // Redirect to the home page or login page
        return redirect('/');
    }*/
    public function logout() 
    {
        // Get the current user
        $user = Sentinel::getUser();

        // Check if the user is authenticated
        if ($user) {
            //Log::info('User is authenticated, proceeding with logout.');

            // Find the user by ID and update login status
            $user_data = Sentinel::findById($user->id);
            $user_data->login_status = 0;
            $user_data->save();

            // Log out the user
            Sentinel::logout($user, true);
        } else {
            Log::info('User is not authenticated.');
        }

        // Redirect to the home page or login page
        return redirect('/login');
    }
}