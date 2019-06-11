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
        $email  = empty($params['email']) ? null : $params['email'];
        $pass   = empty($params['pass']) ? null : $params['pass'];

        if(is_null($email) || is_null($pass) || empty($email) || empty($pass)){
            return [
                'message' => 'data input null or empty. Require data email and password!',
                'code' => 0
            ];
        }

        $model = User::where('email', $email)->where('password', $pass)->first();
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

    public function loginSocial(Request $request){
        $params = $request->all();
        $email  = empty($params['email']) ? null : $params['email'];
        $name   = empty($params['name'])  ? null : $params['name'];

        /*return [
            'name'  => $name,
            'email' => $email
        ];*/

        if(is_null($email) || is_null($name) || empty($email) || empty($name)){
            return [
                'message' => 'data input null or empty. Require data email and name!',
                'code' => 0
            ];
        }

        $model = User::where('email', $email)->first();
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
            $result = User::create([
                'name'  => $name,
                'email' => $email,
                'pass'  => '',
                'phone' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1
            ]);
            return [
                'message' => 'login success',
                'code' => 1,
                'data' => [
                    'id'    => $result->id,
                    'name'  => $result->name,
                    'email' => $result->email,
                    'phone' => $result->phone
                ]
            ];
        }

    }
}
