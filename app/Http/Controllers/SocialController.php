<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function index()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('vkontakte')->user();
        $email = $user->getEmail();
        $name = $user->getName();

        $password = Hash::make('12345678');

        $u = User::firstOrCreate(
            ['email' => $email],
            ['email' => $email, 'password' => $password, 'name' =>$name ]
        );

        Auth::login($u);

        return redirect()->route('index');
    }
}
