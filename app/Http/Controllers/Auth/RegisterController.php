<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Naux\Mail\SendCloudTemplate;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => null,
            'avatar' => '/uploads/images/default.png',
            'password' => bcrypt($data['password']),
            'confirmation_token' => str_random(40),
            'api_token' => str_random(64),
            'verify_code' => str_random(6)
        ]);
        $this -> SendActiveLinkTo($user);
        return $user;
    }


    public function SendActiveLinkTo($user)
    {
        $data = [
            'url' => route('verifyLink',['token' => $user -> confirmation_token]),
            'name' => $user -> name,
        ];
        // 模板变量
        $template = new SendCloudTemplate('app_account_register', $data);

        Mail::raw($template, function ($message) use($user) {

            $message->from('server@zhunkaopu.com', '准靠谱');

            $message->to($user->email);
        });
    }



}
