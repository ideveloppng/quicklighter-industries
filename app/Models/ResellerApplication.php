<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ResellerApplication extends Model {
    protected $fillable = ['business_name', 'contact_person', 'email', 'phone', 'territory', 'description'];
}