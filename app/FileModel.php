<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'objects';

    protected $fillable = [
        'object_type',
        'is_root_folder',
        'object_parent',
        'owner_id',
        'filename',
        'path',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
