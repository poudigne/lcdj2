<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Product extends Model implements HasMedia, HasMediaConversions
{
    use HasMediaTrait, SoftDeletes;
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

    public function registerMediaConversions()
    {
        $this->addMediaConversion('adminthumb')
            ->setManipulations(['w' => 242, 'h' => 200])
            ->performOnCollections('images');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
