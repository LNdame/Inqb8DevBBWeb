<?php

namespace App\Http\Controllers;

use App\BeerLover;
use App\Discount;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Promotion;
use App\Beer;
use App\Establishment;
use Auth;

class PromotionsController extends Controller
{
    public function getPromotionsIndex(){
        return view('promotions.index');
    }

    public function getEstablishmentPromotionsIndex()
    {
        return view('promotions.establishment_promotions_index');
    }

    public function getPromotions(){
        $promotions = null;
        if (Auth::user()->hasRole('super_admin')) {
            $promotions = DB::table('promotions')
                ->join('establishments', 'establishments.id', 'promotions.establishment_id')
                ->join('beers', 'beers.id', 'promotions.beer_id')
                ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as est_name')->get();

        } else if (Auth::user()->hasRole('establishment_owner')) {
            $promotions = DB::table('promotions')
                ->join('establishments', 'establishments.id', 'promotions.establishment_id')
                ->join('users', 'users.id', 'promotions.creator_id')
                ->join('beers', 'beers.id', 'promotions.beer_id')
                ->where('promotions.creator_id',Auth::user()->id)
                ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as est_name')->get();
        } else {
            $promotions = DB::table('promotions')
                ->join('establishments', 'establishments.id', 'promotions.establishment_id')
                ->join('beers', 'beers.id', 'promotions.beer_id')
                ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as est_name')->get();
            return DataTables::of($promotions)
                ->addColumn('action', function ($promotion) {
                    return '<a href="view_promotion/' . $promotion->id . '" style="margin-top:1em;"
            title="View Promo" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a>';
                })->make(true);
        }

        return DataTables::of($promotions)
            ->addColumn('action', function ($promotion) {
                return '<a href="view_promotion/' . $promotion->id . '" style="margin-top:1em;"
            title="View Promo" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a><a href="edit_promotion/' . $promotion->id . '" style="margin-left:0.5em;margin-top: 1em;" title="Edit Promo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_promotion/' . $promotion->id . '"  style="margin-left:0.5em;margin-top: 1em;" class="btn btn-xs btn-danger" title="Edit Promo"><i class="glyphicon glyphicon-trash "></i></a>';
            })->make(true);
    }

    public function getEstablishmentPromotions()
    {
        $user = Auth::user();
        $establishment_id = Establishment::where('user_name', $user->email)->first();
        $promotions = DB::table('promotions')
            ->join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->where('establishments.id', $establishment_id->id)
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as est_name');
        return DataTables::of($promotions)
            ->addColumn('action', function ($promotion) {
                return '<a href="view_establishment_promotion/' . $promotion->id . '" style="margin-top:1em;"
            title="View Promo" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a><a href="edit_establishment_promotion/' . $promotion->id . '" style="margin-left:0.5em;margin-top: 1em;" title="Edit Promo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_establishment_promotion/' . $promotion->id . '"  style="margin-left:0.5em;margin-top: 1em;" class="btn btn-xs btn-danger" title="Edit Promo"><i class="glyphicon glyphicon-trash "></i></a>';
            })->make(true);
    }


    public function getPromoCountApi($id){
        $promos = Promotion::where('establishment_id',$id)->get();
        return response()->json(["promotions_count"=>count($promos)]);
    }

    public function editPromotion(Promotion $promotion)
    {
//        dd($promotion);
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.edit_promotion', compact('promotion', 'establishments', 'beers'));
    }

    public function editEstablishmentPromotion(Promotion $promotion)
    {
        $user = Auth::user();
        $establishment = Establishment::where('user_name', $user->email)->first();
        $beers = Beer::all();
        return view('promotions.edit_establishment_promotion', compact('promotion', 'establishment', 'beers'));
    }

    public function updatePromotion(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());
        return redirect('get_promotions');
    }

    public function updateEstablishmentPromotion(Request $request, Promotion $promotion)
    {
        $promotion->update($request->all());
        return redirect('get_establishment_promotions');

    }
    public function updateEstablishmentPromotionApi(Request $request, Promotion $promotion)
    {
        DB::beginTransaction();

        try {
            $promotion->update($request->all());

            DB::commit();
            return response()->json(["message"=>"promotion updated successfully","status"=>200,"promotion"=>$promotion]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>"An error occurred, please contact Admin","status"=>500,"promotion"=>null]);
        }
    }
    public function deletePromotion(Promotion $promotion)
    {
        $promotion->delete();
        return redirect('get_promotions');
    }

    public function deleteEstablishmentPromotionApi(Promotion $promotion)
    {

        DB::beginTransaction();

        try {
            $promotion->delete();

            DB::commit();
            return response()->json(["message"=>"promotion deleted successfully","status"=>200,"promotion"=>null]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>"An error occurred, please contact Admin","status"=>500,"promotion"=>null]);
        }
    }
    public function deleteEstablishmentPromotion(Promotion $promotion)
    {
        $promotion->delete();

    }
    public function viewPromotion(Promotion $promotion)
    {
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.view_promotion', compact('establishments', 'beers', 'promotion'));

    }

    public function viewEstablishmentPromotion(Promotion $promotion)
    {
        $user = Auth::user();
        $establishment = Establishment::where('user_name', $user->email)->first();
        $beers = Beer::all();
        return view('promotions.view_establishment_promotion', compact('establishment', 'beers', 'promotion'));

    }

    public function createPromotions()
    {
        $establishments = Establishment::all();
        $beers = Beer::all();
        return view('promotions.add_promotion', compact('establishments', 'beers'));
    }

    public function createEstablishmentPromotions()
    {
        $user = Auth::user();
        $establishment = Establishment::where('user_name', $user->email)->first();
        $beers = Beer::all();
        return view('promotions.add_establishment_promotion', compact('establishment', 'beers'));
    }


    public function apiPromotions()
    {
        $promotions = DB::table('promotions')
            ->join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->where('promotions.status','active')
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.beer_id', 'promotions.establishment_id', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as establishment_name')->get();
//        dd($promotions);
        return response()->json($promotions);
    }

    public function apiPromotion($establishment_id)
    {
        $promotion = Promotion::join('establishments', 'establishments.id', 'promotions.establishment_id')
            ->join('beers', 'beers.id', 'promotions.beer_id')
            ->where('establishment_id', $establishment_id)
            ->where('promotions.status','active')
            ->select('title', 'promotions.id', 'start_date', 'end_date', 'promotions.beer_id', 'promotions.establishment_id', 'promotions.status', 'promotions.price', 'beers.name as beer_name', 'establishments.name as establishment_name')->get();
//
        return response()->json($promotion);

    }

    public function getReferalCount($referal_code)
    {
        $count = count(BeerLover::where('referal_code', $referal_code)->get());
        return response()->json($count);
    }

    public function getDiscountsCounter($id)
    {
        $count = count(Discount::where('beer_lover_id', $id)->get());
        return response()->json($count);
    }

    public function savePromotion(Request $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();
//
            $promotion = Promotion::create($input);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect('get_promotions');
    }
    public function savePromotionApi(Request $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();
            $promotion = Promotion::create($input);
            DB::commit();
            return response()->json(["message"=>"promotion saved successfully","status"=>200,"promotion"=>$promotion]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>"An error occurred, please contact Admin","status"=>500,"promotion"=>null]);
        }

//        return redirect('get_promotions');
    }
    public function saveEstablishmentPromotion(Request $request)
    {
        DB::beginTransaction();

        try {
            $input = $request->all();
//            dd($input);
            $promotion = Promotion::create($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect('get_establishment_promotions');
    }


}
