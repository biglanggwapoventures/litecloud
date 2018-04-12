<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Directory extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes;

    protected $fillable = [
        'name', 'parent_directory_id', 'owner_id',
    ];

    /**
     * Retrieves the directory's owner
     * @return User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Retrieves the directory's subdirectories
     * @return Collection<Directory>
     */
    public function subDirectories()
    {
        return $this->hasMany(Directory::class, 'parent_directory_id');
    }
}
