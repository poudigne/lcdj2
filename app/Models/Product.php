<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;
    public function images() { 
    	return $this->hasMany("App/Images");
    }

    public function categories()
    {
    	return $this->belongsToMany("App\Models\Category", 'category_product', 'product_id', 'category_id');
    }

    public function inventory()
    {
        return $this->hasOne('App\Models\Inventory');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('adminthumb')
            ->fit(Manipulations::FIT_CROP, 242, 200)
            ->nonQueued();
            // ->performOnCollections('images');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
