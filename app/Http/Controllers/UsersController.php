<?php

namespace App\Http\Controllers;

use App\Beer;
use App\BeerLover;
use App\Discount;
use App\Establishment;
use App\Jobs\InviteUsers;
use App\Preference;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
//use App\Discount;
use File;
Use Image;


use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public function index(){
        return view('users.index');
    }

    public function CreateUser(){
        $roles = Role::where('name', '!=', 'super_admin')->get();
        $establishments = Establishment::all();
        return view('users.create_user', compact('roles', 'establishments'));
    }

    public function SaveUser(Request $request){
        $input = $request->all();
//        dd($input);
        $initial_password = $input['password'];
        $input['email_token'] = base64_encode($input['email']);
        $input['password'] = bcrypt($initial_password);
        $input['admin_approval'] = 1;
        $role_id = $input['role_id'];
        $input['verified'] = 1;
        $role = Role::where('id', $role_id)->first();
        DB::beginTransaction();
        try{
            $user = User::create($input);
            DB::commit();
            $user->attachRole($role);
            event($user);
            dispatch(new InviteUsers($user, $initial_password));
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        return redirect('/list_users');
    }

    public function manageUserProfile(User $user)
    {
//        dd($user);
        $establishment = Establishment::where('id', $user->establishment_id)->first();
        return view('users.update_user_profile', compact('user', 'establishment'));
    }

    public function saveUpdatedUserProfile(Request $request, User $user)
    {
        $input = $request->all();
//        dd($input);
        $main_picture_url = $request->file('picture_url');
        if ($main_picture_url != null) {
            $dir = "photos/";

            if (File::exists(public_path($dir)) == false) {
                File::makeDirectory(public_path($dir), 0777, true);
            }
            $img = Image::make($main_picture_url->path());
            $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
            $input['picture_url'] = $path;
            $img->save(public_path($path));

            DB::beginTransaction();
            try {
                $user_updated = $user->update(['contact_number' => $input['contact_number'], 'picture_url' => $path]);
//            dd($user);
                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            DB::beginTransaction();
            try {
                $user_updated = $user->update(['contact_number' => $input['contact_number']]);
//            dd($user);
                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }

        return redirect('home');
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
        $users = null;
        if (Auth::user()->hasRole('super_admin')) {
            $users = DB::table('users')->select('*')->get();
        } else {
            $users = DB::table('users')->where('creator_id', Auth::user()->id)->get();
        }

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
            $user_accoount['contact_number'] = '0123456789';
            $user_accoount['username'] = $input['username'];
            $user_accoount['password'] = bcrypt('123456');
            $user_accoount['role'] = "3";
            $user_accoount['establishment_id'] = 61;
            $user_accoount['creator_id'] = 4;
            $user_accoount['email_token'] = $input['email'];
            $user_accoount['picture_url'] = "none";
            $user_accoount['verified'] = 1;
            $user_accoount['admin_approval'] = 1;
            $user = User::create($user_accoount);
            $input['user_id'] = $user->id;

            $beer_lover = BeerLover::create($input);

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
            $user->update($input);
            $beer_lover->update($request->all());
            DB::commit();
            return response()->json($beer_lover, 201);
        } catch (\Exception $e) {
            throw $e;
            return response()->json($e, 400);
        }
    }

    public function storePreferences(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $input = $request->all();
            $user = BeerLover::where('firebase_id', $input['firebase_id'])->first();
            $input['beer_lover_id'] = $user->id;
            $preference = Preference::create($input);
            DB::commit();
//            $preference =
            return response()->json($preference, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([], 400);
//            throw $e;
        }

    }

    public function storeDiscount(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $input = $request->all();
            $user = BeerLover::where('firebase_id', $input['firebase_id'])->first();
            $input['beer_lover_id'] = $user->id;
            $discount = Discount::create($input);
//            dd($discount);
            DB::commit();
            return response()->json($discount, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([], 400);
//            throw $e;
        }
    }

    public function getDiscounts($firebase_id)
    {
        $user = BeerLover::where('firebase_id', $firebase_id)->first();
        $preferences = Discount::join('establishments', 'establishments.id', 'discounts.establishment_id')
            ->where('beer_lover_id', $user->id)
            ->where('discounts.created_at', '>=', Carbon::now()->subHours(12))
            ->select('discounts.id', 'discounts.establishment_id', 'establishments.name', 'discounts.created_at')->get();
        return response()->json($preferences, 201);
    }

    public function getPreferences($firebase_id)
    {
        $user = BeerLover::where('firebase_id', $firebase_id)->first();
        $preferences = Preference::join('beers', 'beers.id', 'preferences.beer_id')
            ->where('beer_lover_id', $user->id)->select('preferences.*', 'beers.name', 'beers.vendor', 'preferences.preference_number')->get();
        return response()->json($preferences, 201);
    }

    public function editPreferences(Request $request, $firebase_id)
    {
//
        $input = $request->all();
        DB::beginTransaction();
        try {
            $user = BeerLover::where('firebase_id', $firebase_id)->first();
            $preference_del = Preference::where('beer_lover_id', $user->id)->delete();
//            dd($preference_del);
            $preference = Preference::create(['beer_lover_id' => $user->id, 'beer_id' => $input['preference_1'], 'preference_number' => 1]);
            $preference_1 = Preference::create(['beer_lover_id' => $user->id, 'beer_id' => $input['preference_2'], 'preference_number' => 2]);
            $preference_2 = Preference::create(['beer_lover_id' => $user->id, 'beer_id' => $input['preference_3'], 'preference_number' => 3]);
//
            DB::commit();
            $preferences = Preference::where('beer_lover_id', $user->id)->get();
            return response()->json($preferences, 200);

        } catch (\Exception $e) {
            throw $e;
            DB::rollback();
            return response()->json([], 400);
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
