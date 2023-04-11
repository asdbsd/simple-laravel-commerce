<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'excerpt', 'description', 'user_id', 'image', 'category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // hasOne, hasMany, belongsTo, belongsToMany
    public function owner() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
