<?php

namespace App\Http\Controllers;
use App\Establishment;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        attemptLogin as attemptLoginAtAuthenticatesUsers;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('adminlte::auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    public function username()
    {
        return config('auth.providers.users.field','email');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
//        dd($request->all());
        $input = $request->all();
        $user = User::where('email', $input['email'])->first();
//        dd($user);
        if($user==null){
            return response()->json(["message"=>"Account not found","status"=>"413"]);
        }
        try {
            if ($user->verified == 0) {
                return response()->json(["message"=>"Account not yet verified","status"=>"412"]);
            } else if ($user->hasRole('establishment_owner') && $user->admin_approval == 0) {
                return response()->json(["message"=>"Account not yet approved by Beerly admin","status"=>"412"]);
            } else {
                if ($this->username() === 'email'){
                    if($this->attemptLoginAtAuthenticatesUsers($request)){
//                        dd("hit");
                        $establishment_info = Establishment::join('users','users.establishment_id','establishments.id')
                                                ->where('establishments.id',$user->establishment_id)->first();
                        return response()->json(["message"=>"Login Successfull","status"=>"200","user"=>$user,"establishment_information"=>$establishment_info]);
                    }else{
                        return response()->json(["message"=>"Wrong Password","status"=>"414"]);
                    }
                }

                if (!$this->attemptLoginAtAuthenticatesUsers($request)) {
                    return $this->attempLoginUsingUsernameAsAnEmail($request);
                }
                return false;
            }
        } catch (\Exception $e) {
            throw $e;
            return response()->json(["message"=>"An error occured please contact Beerly Admin","status"=>"500"]);
        }
    }

    /**
     * Attempt to log the user into application using username as an email.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attempLoginUsingUsernameAsAnEmail(Request $request)
    {
        return $this->guard()->attempt(
            ['email' => $request->input('username'), 'password' => $request->input('password')],
            $request->has('remember'));
    }


}
