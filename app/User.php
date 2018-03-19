<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files()
    {
        return $this->hasOne(Object::class, 'owner_id');
    }

    public function getRootFolder()
    {
        # code...
    }

    public function createRootFolder()
    {
        $root = $this->files()->create([
            'object' => 'folder',
            'is_root_folder' => true,
            'filename' => $this->email,
            'path' => $this->email,
        ]);

        Storage::makeDirectory($this->email, 0755, true);

        return $root;
    }

    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = bcrypt($val);
    }
}
