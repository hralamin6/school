<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setup extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('avatar')->width('300')->height('200')->performOnCollections('logo')->nonQueued();
    }

}
