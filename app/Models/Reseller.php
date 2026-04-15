<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $fillable = ['name', 'state', 'location', 'phone', 'email', 'is_active'];
}
