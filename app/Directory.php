<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Directory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'parent_directory_id', 'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function subDirectories()
    {
        return $this->hasMany(Directory::class, 'parent_directory_id');
    }
}
