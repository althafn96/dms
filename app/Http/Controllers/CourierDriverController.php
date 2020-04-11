<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use App\Courier;
use App\CourierDriver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourierDriverController extends Controller
{
    public function saveCourierDriver($driver, $user_id, $courier_id, $type)
    {
        if ($type == 'insert') {
            $courier_driver = new CourierDriver;
            $courier_driver->courier_id = $courier_id;
        } else {
            $courier_driver = CourierDriver::where('user_id', $user_id)->first();
        }

        $courier_driver->driver_name = $driver->driver_name;
        $courier_driver->vehicle_num = $driver->vehicle_num;
        $courier_driver->nic = $driver->nic;
        $courier_driver->vehicle = $driver->vehicle;
        $courier_driver->user_id = $user_id;

        $courier_driver->save();

        return $courier_driver;
    }

    public function viewOrEdit(Request $request, $id)
    {
        $title = array(
            'menu' => 'Couriers',
            'page' => 'View and Edit Courier Drivers'
        );

        $courier_user = User::find($id);
        $courier = Courier::where('user_id', $id)->first();

        if ($request->ajax()) {
            $courier = Courier::where('user_id', $id)->first();

            $courier_drivers = DB::table('users')
                ->join('courier_drivers', 'courier_drivers.user_id', '=', 'users.id')
                ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
                ->select('users.id', 'courier_drivers.driver_name', 'courier_drivers.vehicle', 'courier_drivers.vehicle_num', 'courier_drivers.nic', 'user_logins.status')
                ->where('courier_drivers.courier_id', $courier->id)
                ->where('users.is_deleted', '0')
                ->get();

            return DataTables::of($courier_drivers)
                ->addColumn('action', function ($courier_driver) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('couriers.drivers.index', compact('title', 'courier_user', 'courier'));
    }

    public function getCourierDrivers(Request $request)
    {
    }

    public function addCourierDriverTemp(Request $request)
    {
        if ($request->driver_name == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'driver name cant be empty'
            ]);
        }
        if ($request->vehicle_num == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'vehicle number cant be empty'
            ]);
        }
        if ($request->nic == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'nic cant be empty'
            ]);
        }

        $insert_id = DB::table('courier_drivers_temp')->insertGetId([
            'driver_name' => $request->driver_name,
            'vehicle' => $request->vehicle,
            'vehicle_num' => $request->vehicle_num,
            'nic' => $request->nic,
            'added_user_id' => auth()->user()->user_id,
        ]);

        return response()->json([
            'type' => 'Success',
            'text' => 'driver added successfully',
            'id' => $insert_id
        ]);
    }

    public function addCourierDriver(Request $request)
    {
        if ($request->driver_name == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'driver name cant be empty'
            ]);
        }
        if ($request->vehicle_num == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'vehicle number cant be empty'
            ]);
        }
        if ($request->nic == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'nic cant be empty'
            ]);
        }

        $driver_user_controller = new UserController;
        $driver_user = $driver_user_controller->saveDriverUser($request, '5', 'insert');

        $user_login_controller = new UserLoginController;
        $user_login_controller->saveDriverUserLogin($request, $driver_user->id, 'insert');

        $courier_id = Courier::where('user_id', $request->courier_id)->first()->id;

        $courier_driver = $this->saveCourierDriver($request, $driver_user->id, $courier_id, 'insert');

        return response()->json([
            'type' => 'Success',
            'text' => 'driver added successfully'
        ]);
    }

    public function editCourierDriverTemp(Request $request, $id)
    {
        $temp_driver = DB::table('courier_drivers_temp')->where('id', $id)->first();

        return response()->json([
            'type' => 'Success',
            'temp_driver' => $temp_driver
        ]);
    }

    public function editCourierDriver(Request $request, $id)
    {
        $courier = Courier::where('user_id', $id)->first();

        $courier_driver = DB::table('users')
            ->join('courier_drivers', 'courier_drivers.user_id', '=', 'users.id')
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->select('users.id', 'courier_drivers.driver_name', 'courier_drivers.vehicle', 'courier_drivers.vehicle_num', 'courier_drivers.nic')
            ->where('users.id', $id)
            ->first();

        return response()->json([
            'type' => 'Success',
            'courier_driver' => $courier_driver
        ]);
    }

    public function updateCourierDriverTemp(Request $request, $id)
    {
        if ($request->driver_name == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'driver name cant be empty'
            ]);
        }
        if ($request->vehicle_num == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'vehicle number cant be empty'
            ]);
        }
        if ($request->nic == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'nic cant be empty'
            ]);
        }

        DB::table('courier_drivers_temp')->where('id', $id)->update([
            'driver_name' => $request->driver_name,
            'vehicle' => $request->vehicle,
            'vehicle_num' => $request->vehicle_num,
            'nic' => $request->nic,
            'added_user_id' => auth()->user()->user_id,
        ]);

        return response()->json([
            'type' => 'Success',
            'text' => 'driver updated successfully',
            'id' => $id
        ]);
    }

    public function updateCourierDriver(Request $request, $id)
    {
        if ($request->driver_name == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'driver name cant be empty'
            ]);
        }
        if ($request->vehicle_num == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'vehicle number cant be empty'
            ]);
        }
        if ($request->nic == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'nic cant be empty'
            ]);
        }

        $user_controller = new UserController;
        $driver_user = $user_controller->saveDriverUser($request, '5', 'update', $id);

        $user_login_controller = new UserLoginController;
        $user_login_controller->saveDriverUserLogin($request, $driver_user->id, 'update');

        $courier_driver = $this->saveCourierDriver($request, $driver_user->id, '', 'update');

        return response()->json([
            'type' => 'Success',
            'text' => 'driver updated successfully',
            'id' => $id
        ]);
    }

    public function removeCourierDriverTemp(Request $request, $id)
    {
        $temp_driver = DB::table('courier_drivers_temp')->where('id', $id)->delete();

        $count = DB::table('courier_drivers_temp')->where('added_user_id', auth()->user()->user_id)->get()->count();

        return response()->json([
            'type' => 'Success',
            'text' => 'driver removed successfully',
            'count' => $count
        ]);
    }

    public function removeCourierDriver(Request $request, $id)
    {
        // $courier_driver = DB::table()

        // $driver = DB::table('courier_drivers')->where('id', $id)->update([
        //     'is_deleted' => '1'
        // ]);

        $user_controller = new UserController;
        $user = $user_controller->deleteUser($id);

        $user_login_controller = new UserLoginController;
        $user_login_controller->disableUser($id);

        return response()->json([
            'type' => 'Success',
            'text' => 'driver removed successfully'
        ]);
    }
}
