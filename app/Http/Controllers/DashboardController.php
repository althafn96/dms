<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = array(
            'menu' => 'Dashboard',
            'page' => 'Dashboard'
        );
        // $authenticated_user = Controller::get_authenticated_user();

        return view('dashboard.admin', compact('title'));
    }
}
