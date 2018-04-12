<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class CompanyRegistration extends Controller
{
    public function show()
    {
        return view('registration.corporate');
    }

    public function post()
    {
        // this is going to be a multiple save so let's contain it in a transaction
        $result = DB::transaction(function () {

            //validate input
            $companyDetails = request()->validate([
                'email' => 'required|email|unique:companies',
                'name' => 'required|max:200',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]);

            // create the company
            $company = Company::create($companyDetails);
            // create new user
            $user = User::create($companyDetails);
            // associate new user to company
            $company->users()->create(['user_id' => $user->id]);

            // log the new user in
            Auth::login($user);

        }, 3);

        return redirect(route('directory.browse'));
    }
}
