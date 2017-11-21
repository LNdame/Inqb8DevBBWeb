<?php

namespace App\Http\Controllers;

use App\BeerLover;
use Illuminate\Http\Request;
use App\User;

use DB;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public function index(){
        return view('users.index');
    }

    public function CreateUser(){
        return view('users.create_user');
    }

    public function SaveUser(Request $request){
        $input = $request->all();
//        dd($input);
        $input['password'] = bcrypt('beerly');
        DB::beginTransaction();
        try{
            $user = User::create($input);
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        return redirect('/list_users');
    }

    public function EditUser(User $user){
        dd($user);
    }

    public function DeleteUser(User $user){
        dd("Let thee be Calm ...deleting coming soon");
    }

    public function ViewUser(User $user){
        dd("Let thee be Calm ...Viewing coming soon");
    }

    public function getUsers(){
        $users = DB::table('users')->select('*');
        return DataTables::of($users)
            ->addColumn('action',function($user){
                return '<a href="view_user/'.$user->id.'" title="View User" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_user/'.$user->id.'" style="margin-left:0.5em" title="Edit User" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_user/'.$user->id.'" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    public function GetBeerLovers()
    {
        $beer_lovers = DB::table('beer_lovers')
            ->join('users', 'beer_lovers.user_id', 'users.id')
            ->select('beer_lovers.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.username', 'users.email')
            ->get();
        return $beer_lovers;
    }

    public function GetBeerLover($firebase_id)
    {
        $beer_lover = DB::table('beer_lovers')
            ->join('users', 'beer_lovers.user_id', 'users.id')
            ->where('beer_lovers.firebase_id', $firebase_id)
            ->select('beer_lovers.*', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.username', 'users.email')
            ->get();
        if ($beer_lover != null) {
            return response()->json($beer_lover, 201);
        } else {
            return response()->json($beer_lover, 404);
        }

        return $beer_lover;
    }

    public function GetUser(User $user){
        return $user;
    }

    public function apiUsers()
    {
        return User::all();
    }

    public function SaveBeerLoverApi(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try{

            $input = $request->all();
            $user_accoount['first_name'] = $input['first_name'];
            $user_accoount['last_name'] = $input['last_name'];
            $user_accoount['email'] = $input['email'];
            $user_accoount['username'] = $input['username'];
            $user_accoount['password'] = bcrypt('123456');
            $user = User::create($user_accoount);

            $beer_lover_account['user_id'] = $user->id;
            $beer_lover_account['status'] = $input['status'];
            $beer_lover_account['date_of_birth'] = $input['date_of_birth'];
            $beer_lover_account['terms_conditions_accept'] = $input['terms_conditions_accept'];
            $beer_lover_account['gender'] = $input['gender'];
            $beer_lover_account['home_city'] = $input['home_city'];
            $beer_lover_account['referal_code'] = $input['referal_code'];
            $beer_lover_account['firebase_id'] = $input['firebase_id'];
            $beer_lover_account['cocktail'] = $input['cocktail'];
            $beer_lover_account['cocktail_type'] = $input['cocktail_type'];
            $beer_lover_account['shot'] = $input['shot'];
            $beer_lover_account['shot_type'] = $input['shot_type'];

            $beer_lover = BeerLover::create($beer_lover_account);
            DB::commit();
            return response()->json($beer_lover, 201);
        }catch(\Exception $e){
            return response()->json($e, 400);
        }

    }

    public function EditBeerLoverApi($firebase_id, Request $request)
    {
        $beer_lover = BeerLover::where('firebase_id', $firebase_id)->first();
//        dd($beer_lover);
        $user = User::where('id', $beer_lover->user_id)->first();
//        dd($user);
        DB::beginTransaction();
        try {
//            dd($request->all());
            $input = $request->all();
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
//            $user->email = $input['email'];
            $user->username = $input['username'];
//            $user_accoount['password'] = bcrypt('123456');
            $users = $user->save();
//            dd($users);
            $beer_lover_account['status'] = $input['status'];
//            dd($beer_lover_account);
            $beer_lover->date_of_birth = $input['date_of_birth'];
            $beer_lover->terms_conditions_accept = $input['terms_conditions_accept'];
            $beer_lover->gender = $input['gender'];
            $beer_lover->home_city = $input['home_city'];
            $beer_lover->cocktail = $input['cocktail'];
            $beer_lover->cocktail_type = $input['cocktail_type'];
            $beer_lover->shot = $input['shot'];
            $beer_lover->shot_type = $input['shot_type'];
            $beer_lover->save();

            DB::commit();
            return response()->json($beer_lover, 201);
        } catch (\Exception $e) {
            return response()->json($e, 400);
        }
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
