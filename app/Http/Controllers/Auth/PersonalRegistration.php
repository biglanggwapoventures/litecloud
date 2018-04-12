<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;

class PersonalRegistration extends Controller
{
    public function show()
    {
        return view('registration.personal');
    }

    public function post()
    {
        $input = request()->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|max:200',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create($input);

        Auth::login($user);
    }
}
