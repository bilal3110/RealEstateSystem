<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view("html.showEmailForm");
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found in our records.']);
        }

        return redirect()->route('reset.form', ['email' => $user->email]);
    }

    public function showResetForm($email)
    {
        return view("html.showResetForm", ['email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('loginPage')->with('success', 'Password updated successfully. Please login.');
    }
}
