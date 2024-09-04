<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetails extends Model
{
    protected $table = 'itemdetails';
    protected $primaryKey = 'ID';
    protected $fillable = ['ItemName', 'Category', 'Price','Code','Photo'];
}
