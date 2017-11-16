<?php

namespace App\Http\Controllers;

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
    public function apiUsers(){
        return User::all();
    }
    public function GetUser(User $user){
        return $user;
    }

    public function Store(Request $request){
        DB::beginTransaciton();
        try{
            $user = User::create($request->all());
            return response()->json($user, 201);
        }catch(\Exception $e){
            return response()->json($user, 400);
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
