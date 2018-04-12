<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'folder_name',
        'folder_uid',
        'parent_folder_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function childrenFolders()
    {
        return $this->hasMany(get_class($this), 'parent_folder_id');
    }

    public function parentFolder()
    {
        return $this->belongsTo(get_class($this), 'parent_folder_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->folder_uid = uniqid(null, true);
        });
    }

}
