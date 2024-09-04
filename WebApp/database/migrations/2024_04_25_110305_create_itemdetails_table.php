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
        Schema::create('itemdetails', function (Blueprint $table) {
            $table->id('ID');
            $table->string('ItemName');
            $table->string('Category');
            $table->string('Price');
            $table->string('Code');
            $table->string('Photo',300);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemdetails');
    }
};