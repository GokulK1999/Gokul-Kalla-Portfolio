<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookingdetails', function (Blueprint $table) {
            $table->id();
            $table->string('BookingTheme');
            $table->string('BookingType');
            $table->string('BookingDate');
            $table->string('CustomerName');
            $table->string('CustomerEmail');
            $table->string('PhoneNumber');
            $table->string('FoodOrderList');
            $table->string('Status');
            $table->string('Remarks');        
                 

        });
    }   
  
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};