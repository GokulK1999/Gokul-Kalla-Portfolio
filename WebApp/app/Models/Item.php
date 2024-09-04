<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'quantity', 'price']; // Add 'name' to the fillable property

    // Any other code in your Item model
}