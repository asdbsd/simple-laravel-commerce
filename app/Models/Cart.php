<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }
    
    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    
}
