<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Promotion;

class PromotionsController extends Controller
{
    public function getPromotionsIndex(){
        return view('promotions.index');
    }

    public function getPromotions(){
        $promotions = DB::table('promotions')->select('*');
        return DataTables::of($promotions)->make(true);
    }
}
