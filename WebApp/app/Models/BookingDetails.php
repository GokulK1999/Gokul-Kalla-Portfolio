<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    protected $table = 'bookingdetails';
    protected $primaryKey = 'id';
    protected $fillable = ['BookingTheme', 'BookingType', 'BookingDate','CustomerName','CustomerEmail','PhoneNumber',
    'FoodOrderList','Status','Remarks','CustomerSign','SignDate'];}