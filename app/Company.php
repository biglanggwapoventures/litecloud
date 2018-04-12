<?php

namespace App;

use App\CompanyUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['email', 'name'];

    public function users()
    {
        return $this->hasMany(CompanyUser::class, 'company_id');
    }
}
