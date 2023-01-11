<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.settings');
    }

    public function updateInfo(Request $request)
    {
        $id = Auth::user()->id;
        $names = $request->input('names');
        $phone = $request->input('phone');

        $update = User::where('id', $id)->update(
            array(
                'names' => $names,
                'phone' => $phone,
            )
        );

        if ($update) {
            return redirect()->back()->with('success', 'Personal info successfully updated ');
        }
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $new_password = $request->input('new-password');

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|min:6|same:new-password-confirm',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            }
            if (strcmp($request->get('new-password'), $request->get('new-password-confirm')) !== 0) {
                return redirect()->back()->with("error", "Password confirmation doesn't matcg");
            }

            $update = User::where('id', $id)->update(
                array(
                    'password' => bcrypt($new_password),
                )
            );

            if ($update) {
                return redirect()->back()->with('success', 'Password successfully updated ');
            }
        }
    }
}
