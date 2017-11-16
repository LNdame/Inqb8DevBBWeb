<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\BeerLover;

class BeerLoversController extends Controller
{
    public function getBeerLoversIndex(){
        return view('users.beer_lovers');
    }

    public function getBeerLovers(){
        $beer_lovers = DB::table('beer_lovers')->select('*');
        return DataTables::of($beer_lovers)->make(true);
    }
}
