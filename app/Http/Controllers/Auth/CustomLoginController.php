<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Validator;

class CustomLoginController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function show()
    {
        return view('welcome');
    }

    public function post()
    {
        $validator = Validator::make($this->request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = Auth::attempt($this->request->only(['email', 'password']));

        if ($user) {
            return redirect()->route('browse.files');
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
