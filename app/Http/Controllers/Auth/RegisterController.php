<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
     * Where to redirect users after registration.
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){

        $params = $request->all();

        $user = empty($params['user']) ? null : $params['user'];
        $pass = empty($params['pass']) ? null : $params['pass'];
        $email = empty($params['email']) ? null : $params['email'];
        $phone = empty($params['phone']) ? null : $params['phone'];

        if(is_null($user) || is_null($pass) || empty($user) || empty($pass)){
            return [
                'message' => 'data input null or empty. Require data username and password!',
                'code' => 0
            ];
        }

        if(is_null($email) || empty($email)){
            return [
                'message' => 'data input null or empty. Require data email!',
                'code' => 0
            ];
        }

        $model = User::where('name', $user)->first();
        if($model){
            return [
                'message' => $user . ' is already exists on system',
                'code' => 0
            ];
        }

        $model = User::where('email', $email)->first();
        if($model){
            return [
                'message' => $email . ' is already exists on system',
                'code' => 0
            ];
        }

        $entity = [
            'name'      => $user,
            'password'  => $pass,
            'email'     => $email,
            'phone'     => $phone
        ];

        return User::create($entity);
    }
}
