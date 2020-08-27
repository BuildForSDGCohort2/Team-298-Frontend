<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'price', 'discount', 'discount_type', 'sku', 'collection_id', 'store_id', 'description', 'category_id', 'status', 'seo_title', 'seo_description', 'social_title', 'social_description', 'sizes', 'materials', 'colors'];

    // default route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function files()
    {
        return $this->hasMany(StoreFiles::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
