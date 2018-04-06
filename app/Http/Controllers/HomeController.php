<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super_admin')) {
            return view('adminlte::home');
        } else if ($user->hasRole('admin')) {
            return view('adminlte::admin_home');
        } else if ($user->hasRole('establishment_owner')) {
            return view('adminlte::establishment_home');
        }
//        if ($user) {
//            $role = $user->role;
//            if ($role == "1") {
//                return view('adminlte::home');
//            } else if ($role == "2") {
//                return view('establishment_home');
//            } else {
//                return view('welcome');
//            }
//
//        }
        return;

    }
}