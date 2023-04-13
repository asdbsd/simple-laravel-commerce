<?php

namespace App\Models;

use App\Contracts\Favorable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'excerpt', 'description', 'user_id', 'image', 'category_id'];
    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {

        $query
            ->when(
                $filters['search'] ?? false,
                fn ($query, $search) =>
                    $query->where(fn ($query) =>
                        $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                            ->orWhereHas('category', fn ($query) => $query->where('name', 'like', '%' . $search . '%'))    
                    )
            );

        $query
            ->when(
                $filters['category'] ?? false,
                fn ($query, $category) =>
                    $query->whereHas('category', fn ($query) => $query->where('slug', $category))
            );


        $query
            ->when($filters['orderBy'] ?? false,
                fn ($query, $order) => $query->orderBy('name', $order));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // hasOne, hasMany, belongsTo, belongsToMany
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function favorites() 
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite(String $userId)
    {
        $attributes = ['user_id' => $userId];
        if(! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }

    }
}
