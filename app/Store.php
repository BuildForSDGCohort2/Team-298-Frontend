<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'address', 'support_phone', 'theme_id', 'category_id', 'user_id', 'about_text', 'banner_img', 'logo', 'gallery'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
