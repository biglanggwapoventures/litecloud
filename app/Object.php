<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $fillable = [
        'object_type',
        'is_root_folder',
        'object_parent',
        'owner_id',
        'filename',
        'path',
    ];

    protected $dates = [
        'created_at', 'deleted_at',
    ];

    public function subObjects()
    {
        return $this->hasMany(get_class($this), 'object_parent');
    }

    public function is($objectType)
    {
        return $this->object_type === $objectType;
    }
}
