<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        $index = 1;
        $users = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->where('email', '!=', Auth::user()->email)
            ->get();
        return view('dashboard.users.users', ['users' => $users, 'index' => $index]);
    }

    public function addUser(Request $request)
    {
        $rules = array(
            'rank' => 'required',
            'names' => 'required|min:6|max:255',
            'gender' => 'required',
            'email' => 'required|min:6|max:255|email|unique:users',
            'password' => 'required|min:6|max:255',
            // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|max:255',
            'phone' => 'required',
            'function' => 'required',
            'unit' => 'required',
            'userType' => 'required',
            'department' => 'required',
        );
        $validator = $request->validate($rules); {
            if (!$validator) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $user = new User;
                $user->serv_no = $request->input('serv_no');
                $user->rank = $request->input('rank');
                $user->names = $request->input('names');
                $user->gender = $request->input('gender');
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->phone = $request->input('phone');
                $user->function = $request->input('function');
                $user->unit = $request->input('unit');
                $user->type = $request->input('userType');
                $user->department = $request->input('department');
                $user->status = 1;
                $user->save();

                return Redirect::back()->with('success', 'Success; Account created successfully.');
            }
        }
    }

    public function viewDetails($id)
    {
        $details = DB::select("SELECT * FROM users WHERE id = '$id'");
        return View::make('dashboard.users.details')->with('details', $details);
    }

    public function editUser($id)
    {
        $detail = DB::table("users")->where('id', $id)->get();
        return View::make('dashboard.users.edit')->with('detail', $detail);
    }

    public function updateUser(Request $request)
    {

        $id = $request->input('id');
        $serv_no = $request->input('serv_no');
        $rank = $request->input('rank');
        $names = $request->input('names');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $function = $request->input('function');
        $unit = $request->input('unit');
        $type = $request->input('userType');
        $department = $request->input('department');

        $update = User::where('id', $id)->update(
            array(
                'serv_no' => $serv_no,
                'rank' => $rank,
                'names' => $names,
                'gender' => $gender,
                'email' => $email,
                'phone' => $phone,
                'function' => $function,
                'unit' => $unit,
                'type' => $type,
                'department' => $department,
            )
        );

        if ($update) {
            return redirect()->back()->with('success', 'User successfully update');
        }
    }

    public function suspend($id)
    {
        $pend = DB::update("UPDATE users SET status = 0 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'User successfully suspended');
        }
    }

    public function activate($id)
    {
        $pend = DB::update("UPDATE users SET status = 1 WHERE id = '$id'");
        if ($pend) {
            return redirect()->back()->with('success', 'User successfully activated');
        }
    }

    public function delete($id)
    {
        $delete = DB::delete("DELETE FROM users WHERE id = '$id'");
        if ($delete) {
            return redirect()->back()->with('success', 'User successfully deleted');
        }
    }
}
