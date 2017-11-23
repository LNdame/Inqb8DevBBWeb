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
        $promotions = DB::table('promotions')->select('*');
        return DataTables::of($promotions)->make(true);
    }

    public function createPromotions()
    {
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.add_promotion', compact('establishments', 'beers'));
    }

    public function apiPromotions()
    {
        return Promotion::all();
    }

    public function apiPromotion($establishment_id)
    {
        $promotion = Promotion::where('establishment_id', $establishment_id)->get();
        if ($promotion != null) {
            return $promotion;
        } else {
            return [];
        }

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
