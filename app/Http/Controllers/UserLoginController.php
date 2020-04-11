<?php

namespace App\Http\Controllers;

use App\UserLogin;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function saveUserLogin($attributes, $user_id, $type)
    {
        if ($type == 'insert') {
            $user_login = new UserLogin;

            $user_login->password = $attributes->password;
        } else {
            $user_login = UserLogin::where('user_id', $user_id)->first();

            $user_login->password = $attributes->password == '' ? $user_login->password : $attributes->password;
        }

        $user_login->email = $attributes->email;
        $user_login->user_id = $user_id;

        $user_login->save();
    }

    public function saveDriverUserLogin($attributes, $user_id, $type)
    {
        if ($type == 'insert') {
            $user_login = new UserLogin;

            $user_login->password = $attributes->nic;
        } else {
            $user_login = UserLogin::where('user_id', $user_id)->first();

            $user_login->password = $attributes->nic == '' ? $user_login->password : $attributes->nic;
        }

        $user_login->email = $attributes->vehicle_num;
        $user_login->user_id = $user_id;

        $user_login->save();
    }

    public function changeUserStatus(Request $request)
    {
        $user_login = UserLogin::where('user_id', $request->id)->first();

        $user_login->status = $request->changeTo;

        $user_login->save();

        if ($user_login->status == '1') {
            $class = 'kt-badge--success';
            $title = 'Enabled';
            $action = 'Disable';
            $change = '0';
        } else {
            $class = 'kt-badge--danger';
            $title = 'Disabled';
            $action = 'Enable';
            $change = '1';
        }

        return response()->json([
            'type' => 'Success',
            'text' => 'status changed successfully',
            'class' => $class,
            'title' => $title,
            'action' => $action,
            'change' => $change
        ]);
    }

    public function disableUser($id)
    {
        $user_login = UserLogin::where('user_id', $id)->first();

        $user_login->status = '0';

        $user_login->save();
    }

    public function compareEmail($email)
    {
        if (UserLogin::where('email', $email)->get()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
