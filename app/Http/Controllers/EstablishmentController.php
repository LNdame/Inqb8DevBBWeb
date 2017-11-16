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

    public function AddEstablishment(){
        return view('establishments.add_establishment');
    }
    public function SaveEstablishment(Request $request){
        DB::beginTransaction();
        try{
            $input = $request->all();
            $establishment = Establishment::create($input);
           DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        return redirect('/get_establishments');
    }
    public function getEstablishments(){
        $establishments = DB::table('establishments')->select('*');
        return DataTables::of($establishments)
            ->addColumn('action',function($establishment){
                return '<a href="view_establishment/'.$establishment->id.'" title="View Establishment" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_establishment/'.$establishment->id.'" style="margin-left:0.5em" title="Edit Establishment" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_establishment/'.$establishment->id.'" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Edit Establishment"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    public function EditEstablishment(Establishment $establishment){
        dd($establishment);
    }

    public function DeleteEstablishment(Establishment $establishment){
        dd("Let thee be Calm ...deleting coming soon");
    }

    public function ViewEstablishment(Establishment $establishment){
        dd("Let thee be Calm ...Viewing coming soon");
    }

    public function getEstablishmentsApi(){
        $establishments = Establishment::all();
        return $establishments;
    }

    public function getEstablishmentApi(Establishment $establishment){
        return $establishment;
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
