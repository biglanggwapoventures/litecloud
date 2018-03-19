<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CustomRegistrationController extends Controller
{
    protected $request;
    protected $model;

    public function __construct(Request $request, User $model)
    {
        $this->request = $request;
        $this->model = $model;
    }

    public function show()
    {
        return view('register');
    }

    public function post()
    {
        $input = $this->request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|max:200',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = $this->model->create($input);

        $user->createRootFolder();

        Auth::login($user);

        return redirect()->route('browse.files');
    }
}
