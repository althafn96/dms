<?php

namespace App\Http\Controllers;

use App\User;
use App\Courier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;

use DataTables;

class CourierController extends Controller
{
    public function index(Request $request)
    {
        $title = array(
            'menu' => 'Couriers',
            'page' => 'Couriers'
        );

        if ($request->ajax()) {
            $couriers = DB::table('users')
                ->join('couriers', 'couriers.user_id', '=', 'users.id')
                ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
                ->select('users.*', 'couriers.id as courier_id', 'user_logins.email', 'user_logins.status')
                ->where('is_deleted', '0')
                ->get();

            return DataTables::of($couriers)
                ->addColumn('email', function ($courier) {

                    return $courier->email;
                })
                ->addColumn('address', function ($courier) {
                    return $courier->residency_no . ' ' . $courier->street . ' ' . $courier->city . ' ' . $courier->province;
                })
                ->addColumn('mobile', function ($courier) {
                    return $courier->mobile . ', ' . $courier->mobile_2;
                })
                ->addColumn('action', function ($courier) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('couriers.index', compact('title'));
    }

    public function create()
    {
        $title = array(
            'menu' => 'Couriers',
            'page' => 'Create Courier'
        );

        DB::table('courier_drivers_temp')->where('added_user_id', auth()->user()->user_id)->delete();

        return view('couriers.create', compact('title'));
    }

    public function store(Request $request)
    {
        $user_login_controller = new UserLoginController;
        $if_email_exists = $user_login_controller->compareEmail($request->email);

        if ($if_email_exists) {
            return response()->json([
                'type' => 'Error',
                'text' => 'email already exists'
            ]);
        }

        $user_controller = new UserController;
        $user = $user_controller->saveUser($request, '3');

        $user_login_controller->saveUserLogin($request, $user->id, 'insert');

        $courier = new Courier;

        $courier->user_id = $user->id;

        $courier->save();

        $temp_drivers = DB::table('courier_drivers_temp')->where('added_user_id', auth()->user()->user_id)->get();

        foreach ($temp_drivers as $driver) {
            $driver_user_controller = new UserController;
            $driver_user = $driver_user_controller->saveDriverUser($driver, '5');

            $user_login_controller = new UserLoginController;
            $user_login_controller->saveDriverUserLogin($driver, $driver_user->id, 'insert');

            $courier_driver_controller = new CourierDriverController;
            $courier_driver = $courier_driver_controller->saveCourierDriver($driver, $driver_user->id, $courier->id);
        }
        DB::table('courier_drivers_temp')->where('added_user_id', auth()->user()->user_id)->delete();

        return response()->json([
            'type' => 'Success',
            'text' => 'courier added successfully'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = array(
            'menu' => 'Couriers',
            'page' => 'Edit Couriers'
        );

        $courier_user = User::find($id);
        $courier = Courier::where('user_id', $id)->first();


        $courier_drivers = DB::table('users')
            ->join('courier_drivers', 'courier_drivers.user_id', '=', 'users.id')
            ->select('courier_drivers.*')
            ->where('courier_drivers.courier_id', $courier->id)
            ->where('courier_drivers.status', '1')
            ->get();

        return view('couriers.edit', compact('title', 'courier_user', 'courier_drivers', 'courier'));
    }

    public function update(Request $request, $id)
    {
        $user_controller = new UserController;
        $user = $user_controller->saveUser($request, '3', $id);

        $user_login_controller = new UserLoginController;
        $user_login_controller->saveUserLogin($request, $id, 'update');

        return response()->json([
            'type' => 'Success',
            'text' => 'courier updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $user_controller = new UserController;
        $user = $user_controller->deleteUser($id);

        $user_login_controller = new UserLoginController;
        $user_login_controller->disableUser($id);

        return response()->json([
            'type' => 'Success',
            'text' => 'courier removed successfully'
        ]);
    }
}
