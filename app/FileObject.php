<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class FileObject extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'objects';

    protected $fillable = [
        'object_type',
        'filesize',
        'original_filename',
        'mime_type',
        'is_root_folder',
        'object_parent',
        'owner_id',
        'filename',
        'file_uid',
        'path',
    ];

    protected $dates = [
        'created_at', 'deleted_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'file_uid';
    }

    public function subObjects()
    {
        return $this->hasMany(get_class($this), 'object_parent');
    }

    public function subFolders()
    {
        return $this->hasMany(get_class($this), 'object_parent')
            ->whereObjectType('folder');
    }

    public function is($objectType)
    {
        return $this->object_type === $objectType;
    }

    public function createFolder($filename, $props = [])
    {
        $props += [
            'object_type' => 'folder',
            'filename' => $filename,
        ];

        return $this->subFolders()->create($props);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->file_uid = uniqid(null, true);
        });
    }
}
