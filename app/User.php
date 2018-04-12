<?php

namespace App;

use App\Directory;
use App\FileObject;
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

    public function ownedDirectories()
    {
        return $this->hasMany(Directory::class, 'owner_id');
    }

    public function files()
    {
        return $this->hasMany(FileObject::class, 'owner_id');
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

    /**
     * Creates an empty folder
     * @param  string $filename The name of the folder to create
     * @return FileObject
     */
    public function createFolder($filename, $props = [])
    {
        $props += [
            'object_type' => 'folder',
            'filename' => $filename,
        ];

        return $this->files()->create($props);
    }

    /**
     * Checks if the owns a folder given the uid
     * @param  String  $uid The folder uid
     * @return boolean
     */
    public function hasFolder($uid)
    {
        return $this->files()
            ->whereFileUid($uid)
            ->whereObjectType('folder')
            ->exists();
    }

    /**
     * Retrieves the user's folders on root
     * @return Collection
     */
    public function rootFolders()
    {
        return $this->files()
            ->whereNull('object_parent')
            ->whereObjectType('folder');
    }
}
