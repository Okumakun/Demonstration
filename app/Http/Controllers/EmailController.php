<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function Verify($token)
    {
        $user = User::where('confirmation_token',$token)->first();

        if (is_null($user)){

            return redirect('/');

        }
        $user->is_active = 'T';
        $user->confirmation_token = str_random(40);
        $user->save();
        Auth::login($user);
        return redirect('/');
    }
}
