<?php

namespace App\Http\Controllers\Auth;

use App\Establishment;
use App\Jobs\InviteUsers;
use App\Jobs\SendAdminMailApprovals;
use App\Jobs\SendVerificationEmail;
use App\Role;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Toastr;
/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('adminlte::auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        dd($data);
        $email_token = base64_encode($data['email']);
        $initial_password = $data['password'];
        $role_id = Role::where('name', 'establishment_owner')->first();
        $fields = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'contact_number' => $data['contact_number'],
            'establishment_id' => $data['establishment_id'],
            'email_token' => $email_token,
            'creator_id' => 4,
            'role_id' => $role_id->id,
            'admin_approval' => 0,
            'verified' => 0,
            'email'    => $data['email'],
            'username' => $data['email'],
            'password' => bcrypt($data['password']),
        ];
        if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
            $fields['username'] = $data['username'];
        }
        DB::BeginTransaction();
        try {
            $user = User::create($fields);
            DB::commit();
            $user->attachRole($role_id);
            event($user);
            dispatch(new SendVerificationEmail($user));
            $establishment = Establishment::where('id', $user->establishment_id)->first();
            dispatch(new SendAdminMailApprovals($user, $establishment));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('login');
    }

    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();
        DB::beginTransaction();
        try {
            $user->update(['verified' => 1]);
            DB::commit();
            return redirect('login');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function approveEstablishment($id)
    {
        $establishment = Establishment::where('id', $id)->first();
        DB::BeginTransaction();
        try {
            $establishment->update(['admin_approval' => 1]);
            DB::commit();
        } catch (\Exception $e) {
            throw $e;
        }
        $notification = array(
            'message' => 'Account Verified Successfully',
            'alert-type' => 'success'
        );
        Toastr::success('Account Verified Successfully', 'Account Verified Successfully', ["positionClass" => "toast-top-center"]);
        return redirect('login');
    }
}
