<?php

namespace App;

use App\Company;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyUser extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_id', 'user_id'];

    public function user()
    {
        return $this->belogsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belogsTo(Company::class, 'company_id');
    }
}
