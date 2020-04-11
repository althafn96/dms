<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        if ($request->email == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'email cant be empty'
            ]);
        }
        if ($request->password == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'password cant be empty'
            ]);
        }

        $credentials = array('email' => $request->email, 'password' => $request->password, 'status' => '1');

        if ($request->has('remember')) {

            if (Auth::attempt($credentials, $request->remember)) {
                return response()->json([
                    'type' => 'Success',
                    'text' => 'logged in successfully'
                ]);
            } else {
                return response()->json([
                    'type' => 'Error',
                    'text' => 'login failed'
                ]);
            }
        } else {

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'type' => 'Success',
                    'text' => 'logged in successfully'
                ]);
            } else {
                return response()->json([
                    'type' => 'Error',
                    'text' => 'login failed'
                ]);
            }
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }
}
