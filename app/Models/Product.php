<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'price', 'old_price', 'stock', 'images', 'is_featured'
    ];

    // Important: Tells Laravel to treat the 'images' column as an array (JSON)
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Relationship: A Product belongs to a Category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}