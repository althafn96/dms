<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function saveUser($attributes, $role_id, $id = null)
    {
        if ($id == null) {
            $user = new User;
        } else {
            $user = User::find($id);
        }

        $user->fname = $attributes->name;
        $user->residency_no = $attributes->residency_no;
        $user->street = $attributes->street_name;
        $user->city = $attributes->city;
        $user->province = $attributes->province;
        $user->mobile = $attributes->mobile_1;
        $user->mobile_2 = $attributes->mobile_2;
        $user->user_role_id = $role_id;

        $user->save();

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        $user->is_deleted = '1';

        $user->save();
    }

    public function saveDriverUser($driver, $role_id, $type, $id = null)
    {
        if ($type == 'insert') {
            $user = new User;
        } else {
            $user = User::find($id);
        }

        $user->fname = $driver->driver_name;
        $user->user_role_id = $role_id;

        $user->save();

        return $user;
    }
}
