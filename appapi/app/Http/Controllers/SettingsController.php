<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    //view settings page
    public function settings()
    {
        return view('settings');
    }
    //Update edit profile
    public function adminEditProfile(Request $request)
    {

        //   $request->validate(['name' => 'required|string', 'email|string' => 'required'], []);
        if ($request['firstname'] != null &&$request['lastname'] != null  && $request['email'] == null) {
            auth()->user()->update([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],

            ]);
            return back()->with('editProfileSuccess', 'Name changed successfully');

        }else if ($request['firstname'] != null &&$request['lastname'] == null  && $request['email'] == null) {
            auth()->user()->update([
                'firstname' => $request['firstname'],

            ]);
            return back()->with('editProfileSuccess', 'Firstname changed successfully');

        }
        
        else if ($request['lastname'] != null &&$request['firstname'] == null && $request['email'] == null) {
           
            auth()->user()->update([
                'lastname' => $request['lastname'],

            ]);
            return back()->with('editProfileSuccess', 'Lastname changed successfully');

        } else if ($request['firstname'] == null &&$request['lastname'] == null  && $request['email'] != null) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
            ]);

            $user = $request->user();
            $ownemail = auth()->user();
            if ($validator->fails() && $ownemail->email != $request->email) {
                return back()->with('editProfileError', 'Email already exist');
            }
            if ($validator->fails() && $ownemail->email == $request->email) {
                return back()->with('editProfileError', 'Your email is already in use');

            }
            if (Hash::check($request->email, $user->email)) {
                return back()->with('editProfileError', 'Email already exist');

            } else if (Hash::check($request->email, $ownemail->email)) {
                return back()->with('editProfileError', 'Your email is already in use');

            } else {
                $user->update([
                    'email' => $request->email
                ]);

                return back()->with('editProfileSuccess', 'Email changed successfully');
            }

        } else if ($request['firstname'] != null &&$request['lastname'] != null && $request['email'] != null) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
            ]);

            $user = $request->user();
            $ownemail = auth()->user();
            if ($validator->fails() && $ownemail->email != $request->email) {
                return back()->with('editProfileError', 'Email already exist');
            }
            if ($validator->fails() && $ownemail->email == $request->email) {
                return back()->with('editProfileError', 'Your email is already in use');

            }
            if (Hash::check($request->email, $user->email)) {
                return back()->with('editProfileError', 'Email already exist');

            } else if (Hash::check($request->email, $ownemail->email)) {
                return back()->with('editProfileError', 'Your email is already in use');

            } else {
                $user->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request->email
                ]);

                return back()->with('editProfileSuccess', 'Name & Email changed successfully');
            }
        } else {
            return back()->with('editProfileError', 'Input required fields');
        }
    }


    //change password settings 
    public function adminChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'newPassword' => 'required',
            'confPassword' => 'required'
            //|same:newPassword'

        ]);

        if ($validator->fails()) {
            return  back()->with('changePassError', 'Input all fields');

        }
        if ($request['confPassword'] != $request['newPassword']) {
           
            return back()->with('changePassError', 'Passwords does not match');

        }

        $user = $request->user();
        if (Hash::check($request->password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with('changePassSuccess', 'Password changed succesfully');


        } else {

            return back()->with('changePassError', 'Wrong Password');

        }


    }
}
