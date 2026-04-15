<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    // These are the fields allowed to be saved during checkout
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_status',
        'payment_proof',
        'payment_method',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'state',
        'city'
    ];

    /**
     * Relationship: An Order belongs to a User (if logged in).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: An Order has many items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}