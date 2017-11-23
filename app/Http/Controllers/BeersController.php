<?php

namespace App\Http\Controllers;

use App\Beer;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class BeersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Beer::all());
        return view('beers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('beers.create_beer');
    }

    public function getBeers()
    {
        $beers = DB::table('beers')->select('*');
        return DataTables::of($beers)
            ->addColumn('action', function ($beer) {
                return '<a href="view_beer/' . $beer->id . '" title="View Beer" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_beer/' . $beer->id . '" style="margin-left:0.5em" title="Edit Beer" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_beer/' . $beer->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Beer"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $beer = Beer::create($request->all());
//            dd($beer);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

        }

        return redirect('get_beers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        return view('beers.view_beer', compact('beer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        return view('beers.edit_beer', compact('beer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer)
    {
        $beer->update($request->all());
        return redirect('get_beers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beer $beer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beer $beer)
    {
        //
    }

    public function apiBeers()
    {
//        dd(Beer::all());
        return Beer::all();
    }

    public function apiBeer($beer)
    {
        $beer_drink = Beer::where('id', $beer)->get();
        if ($beer_drink != null) {
            return $beer_drink;
        }
        return [];
    }
}
