<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    public function show()
    {
        return view('registration.login');
    }

    public function post()
    {
        $validator = validator()->make(request()->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = auth()->attempt(request()->only(['email', 'password']));

        if ($user) {
            return redirect(route('directory.browse'));
        }

        $validator->after(function ($validator) {
            $validator->errors()->add('password', 'Invalid password');
        });

        return redirect()
            ->route('login.show')
            ->withErrors($validator)
            ->withInput();
    }
}
