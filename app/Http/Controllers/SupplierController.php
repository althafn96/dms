<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use App\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $title = array(
            'menu' => 'Suppliers',
            'page' => 'Suppliers'
        );

        if ($request->ajax()) {
            $suppliers = DB::table('users')
                ->join('suppliers', 'suppliers.user_id', '=', 'users.id')
                ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
                ->select('users.*', 'suppliers.id as supplier_id', 'user_logins.email', 'user_logins.status')
                ->where('is_deleted', '0')
                ->get();

            return DataTables::of($suppliers)
                ->addColumn('email', function ($supplier) {

                    return $supplier->email;
                })
                ->addColumn('address', function ($supplier) {
                    return $supplier->residency_no . ' ' . $supplier->street . ' ' . $supplier->city . ' ' . $supplier->province;
                })
                ->addColumn('mobile', function ($supplier) {
                    return $supplier->mobile . ', ' . $supplier->mobile_2;
                })
                ->addColumn('action', function ($supplier) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('suppliers.index', compact('title'));
    }

    public function create()
    {
        $title = array(
            'menu' => 'Suppliers',
            'page' => 'Create Supplier'
        );

        return view('suppliers.create', compact('title'));
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
        $user = $user_controller->saveUser($request, '2');

        $user_login_controller->saveUserLogin($request, $user->id, 'insert');

        $supplier = new Supplier;

        $supplier->user_id = $user->id;

        $supplier->save();

        return response()->json([
            'type' => 'Success',
            'text' => 'supplier added successfully'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = array(
            'menu' => 'Suppliers',
            'page' => 'Edit Supplier'
        );

        $supplier_user = User::find($id);

        return view('suppliers.edit', compact('title', 'supplier_user'));
    }

    public function update(Request $request, $id)
    {
        $user_controller = new UserController;
        $user = $user_controller->saveUser($request, '2', $id);

        $user_login_controller = new UserLoginController;
        $user_login_controller->saveUserLogin($request, $id, 'update');

        return response()->json([
            'type' => 'Success',
            'text' => 'supplier updated successfully'
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
            'text' => 'supplier removed successfully'
        ]);
    }
}
