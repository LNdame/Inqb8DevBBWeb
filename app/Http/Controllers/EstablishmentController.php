<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Establishment;

class EstablishmentController extends Controller
{
    public function index(){
        return view('establishments.index');
    }

    public function getEstablishments(){
        $establishments = DB::table('establishments')->select('*');
        return DataTables::of($establishments)->make(true);
    }
}
