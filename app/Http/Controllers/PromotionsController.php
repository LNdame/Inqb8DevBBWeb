<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Promotion;
use App\Beer;
use App\Establishment;

class PromotionsController extends Controller
{
    public function getPromotionsIndex(){
        return view('promotions.index');
    }

    public function getPromotions(){
        $promotions = DB::table('promotions')
            ->join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as est_name');
        return DataTables::of($promotions)
            ->addColumn('action', function ($promotion) {
                return '<a href="view_promotion/' . $promotion->id . '" style="margin-top:1em;"
            title="View Promo" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a><a href="edit_promotion/' . $promotion->id . '" style="margin-left:0.5em;margin-top: 1em;" title="Edit Promo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_promotion/' . $promotion->id . '"  style="margin-left:0.5em;margin-top: 1em;" class="btn btn-xs btn-danger" title="Edit Promo"><i class="glyphicon glyphicon-trash "></i></a>';
            })->make(true);
    }

    public function editPromotion(Promotion $promotion)
    {
//        dd($promotion);
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.edit_promotion', compact('promotion', 'establishments', 'beers'));
    }

    public function updatePromotion(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());
        return redirect('get_promotions');
    }

    public function deletePromotion(Promotion $promotion)
    {
        $promotion->delete();
        return redirect('get_promotions');
    }

    public function viewPromotion(Promotion $promotion)
    {
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.view_promotion', compact('establishments', 'beers', 'promotion'));

    }
    public function createPromotions()
    {
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.add_promotion', compact('establishments', 'beers'));
    }

    public function apiPromotions()
    {
        $promotions = DB::table('promotions')
            ->join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.beer_id', 'promotions.establishment_id', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as establishment_name')->get();
//        dd($promotions);
        return response()->json($promotions);
    }

    public function apiPromotion($establishment_id)
    {
        $promotion = Promotion::join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->where('establishment_id', $establishment_id)
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.beer_id', 'promotions.establishment_id', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as establishment_name')->get();
//
        return response()->json($promotion);

    }

    public function savePromotion(Request $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();
            $promotion = Promotion::create($input);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect('get_promotions');
    }

}
