<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function viewRegister()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|min:6|max:255|email',
            'password' => 'required|min:6|max:255'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect('/dashboard');
            } else {
                return redirect('/')->withErrors('Invalid credentials');
            }
        }
    }

    // Register Method
    public function adminRegister(Request $request)
    {
        $rules = array(
            'name' => 'required|min:6|max:255',
            'userType' => 'required',
            'email' => 'required|min:6|max:255|email|unique:users',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|max:255'
        );
        $validator = $request->validate($rules); {
            if (!$validator) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $user = new User;
                $user->names = $request->input('name');
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->type = $request->input('userType');
                $user->status = 1;
                $user->save();

                return redirect('/')->with('success', 'Success; Account created successfully.');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
