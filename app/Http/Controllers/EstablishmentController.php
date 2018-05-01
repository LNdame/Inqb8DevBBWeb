<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Establishment;
use Image;
use File;
use App\User;

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
            $main_picture_url = $request->file('main_picture_url');
            $picture_2 = $request->file('picture_2');
            $picture_3 = $request->file('picture_3');
            $dir = "photos/";
            if ($main_picture_url != null) {
                if (File::exists(public_path($dir)) == false) {
                    File::makeDirectory(public_path($dir), 0777, true);
                }
                $img = Image::make($main_picture_url->path());
                $img_2 = Image::make($picture_2->path());
                $img_3 = Image::make($picture_3->path());

                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $path_2 = "{$dir}" . uniqid() . "." . $picture_2->getClientOriginalExtension();
                $path_3 = "{$dir}" . uniqid() . "." . $picture_3->getClientOriginalExtension();

                $img->save(public_path($path));
                $img_2->save(public_path($path_2));
                $img_3->save(public_path($path_3));

                $input['main_picture_url'] = $path;
                $input['picture_2'] = $path_2;
                $input['picture_3'] = $path_3;
                $establishment = Establishment::create($input);
            } else {
                $establishment = Establishment::create($input);
            }

//            dd($establishment);
//            $user_accoount['first_name'] = $input['name'];
//            $user_accoount['last_name'] = $input['name'];
//            $user_accoount['email'] = $input['user_name'];
//            $user_accoount['username'] = $input['user_name'];
//            $user_accoount['password'] = bcrypt($input['password']);
//            $user_accoount['role'] = "2";
//            $user_accoount['contact_number'] = $input['contact_number'];
//            $user = User::create($user_accoount);
           DB::commit();
//           return redirect('/get_establishments');
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        return redirect('/get_establishments');
    }
    public function getEstablishments(){
        if (Auth::user()->hasRole('super_admin')) {
            $establishments = DB::table('establishments')->select('*');
        } else {
            $establishments = DB::table('establishments')->where('creator_id', Auth::user()->id)->get();
        }

        return DataTables::of($establishments)
            ->addColumn('action',function($establishment){
                return '<a href="view_establishment/' . $establishment->id . '" style="margin-top:1em;"
            title="View Establishment" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a><a href="edit_establishment/' . $establishment->id . '" style="margin-left:0.5em;margin-top: 1em;" title="Edit Establishment" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            })
            ->make(true);
    }

    public function getEstablishmentByID(Establishment $establishment)
    {

        return view('establishments.view_establishment', compact('establishment'));
    }

    public function EditEstablishment(Establishment $establishment){
        return view('establishments.edit_establishment', compact('establishment'));
    }

    public function updateEstablishment(Request $request, Establishment $establishment)
    {
        $establishment_id = $establishment->id;
        DB::beginTransaction();
        try {
            $input = $request->all();
//            dd($input);
            $main_picture_url = $request->file('main_picture_url');
            $picture_2 = $request->file('picture_2');
            $picture_3 = $request->file('picture_3');
            $dir = "photos/";
            $img = null;
            $img_2 = null;
            $img_3 = null;

            $path = null;
            $path_2 = null;
            $path_3 = null;

            if (File::exists(public_path($dir)) == false) {
                File::makeDirectory(public_path($dir), 0777, true);
            }

            if ($main_picture_url != null) {
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $img->save(public_path($path));
            } else {
                $path = $establishment->main_picture_url;
            }

            if ($picture_2 != null) {
                $img_2 = Image::make($picture_2->path());
                $path_2 = "{$dir}" . uniqid() . "." . $picture_2->getClientOriginalExtension();
                $img_2->save(public_path($path_2));
            } else {
                $path_2 = $establishment->picture_2;
            }
            if ($picture_3 != null) {
                $img_3 = Image::make($picture_3->path());
                $path_3 = "{$dir}" . uniqid() . "." . $picture_3->getClientOriginalExtension();
                $img_3->save(public_path($path_3));
            } else {
                $path_3 = $establishment->picture_3;
            }
            $input['main_picture_url'] = $path;
            $input['picture_2'] = $path_2;
            $input['picture_3'] = $path_3;
            $establishment = $establishment->update($input);
//            dd($establishment);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        if (Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('admin')) {
            return redirect('/get_establishments');
        } else {
            $establishment = Establishment::where('id', $establishment_id)->first();
            return view('establishments.view_establishment', compact('establishment'));
        }

    }

    public function DeleteEstablishment(Establishment $establishment){
        dd("Let thee be Calm ...deleting coming soon");
    }

    public function ViewEstablishment(Establishment $establishment){
//        dd($establishment);
        return view('establishments.view_establishment', compact('establishment'));
    }

    public function getEstablishmentsApi(){
        $establishments = Establishment::where('status', 'active')->get();
        return $establishments;
    }

    public function getEstablishmentApi($establishment)
    {
        $est = Establishment::where('id', $establishment)->get();
        if ($est != null) {
            return $est;
        }
        return [];

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
