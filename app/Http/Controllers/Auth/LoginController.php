<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request){
        $params = $request->all();
        $user = empty($params['user']) ? null : $params['user'];
        $pass = empty($params['pass']) ? null : $params['pass'];

        if(is_null($user) || is_null($pass) || empty($user) || empty($pass)){
            return [
                'message' => 'data input null or empty. Require data username and password!',
                'code' => 0
            ];
        }

        $model = User::where('name', $user)->where('password', $pass)->first();
        if($model){
            return [
                'message' => 'login success',
                'code' => 1,
                'data' => [
                    'id'    => $model->id,
                    'name'  => $model->name,
                    'email' => $model->email,
                    'phone' => $model->phone
                ]
            ];
        }else{
            return [
                'message' => 'Wrong username or password',
                'code' => 0
            ];
        }

    }
}
