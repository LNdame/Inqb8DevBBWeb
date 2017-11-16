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

    public function getEstablishmentAccountIndex(){
        return view('establishments.accounts');
    }

    public function getEstablishmentsAccounts(){
        $establishments_accounts = DB::table('establishment_accounts')->select('*');
        return DataTables::of($establishments_accounts)->make(true);
    }

    public function getEstablishmentTypeIndex(){
        return view('establishments.types');
    }

    public function getEstablishmentsTypes(){
        $establishment_types = DB::table('establishment_types')->select('*');
        return DataTables::of($establishment_types)->make(true);
    }
}
