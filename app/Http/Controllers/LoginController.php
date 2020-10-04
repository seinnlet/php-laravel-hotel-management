<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
    		return view('auth.adminlogin');
    }

    public function changepassword()
    {
    		return view('auth.changepassword');
    }

    public function updatepassword(Request $request)
    {
    		$messages = [
            'password.required' => '* Please enter New Password.',
            'confirmpassword.required' => '* Please enter Confirm Password.',
            'confirmpassword.same' => 'Confirm password does not match.',
        ];

        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password'
        ], $messages);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('staff.show', Auth::id())->withSuccessMessage('New Password is Successfully Updated.');
    }
}
