<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function products() 
    {
    	return $this->belongsToMany("App\Models\Product", 'category_product', 'category_id', 'product_id');
    }

    public function news()
    {
    	return $this->belongsToMany("App\Models\News", 'category_news', 'category_id', 'news_id');
    }

    public function events()
    {
        return $this->belongsToMany("App\Models\Event", 'category_event', 'category_id', 'event_id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
