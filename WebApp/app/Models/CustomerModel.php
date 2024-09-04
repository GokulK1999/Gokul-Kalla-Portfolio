<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'photo',
        'user_id',
        'address',
        'phone_number',
        'details',
        'membership'
    ];

    /**
     * Get the user that owns the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //this is necessary so that we can define a relationship with user
    //public function user()
    //{
    //    return $this->belongsTo(\App\Models\User::class, 'user_id');
    //}

}