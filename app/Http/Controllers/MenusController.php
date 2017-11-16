<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Menu;

class MenusController extends Controller
{
    public function getMenusIndex(){
        return view('menus.index');
    }

    public function getMenus(){
        $menus = DB::table('menus')->select('*');
        return DataTables::of($menus)->make(true);
    }
}
