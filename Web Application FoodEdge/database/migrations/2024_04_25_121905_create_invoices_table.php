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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            //$table->string('invoice_number'); //->unique may be deprecated
            //$table->decimal('total_amount', 10, 2);
            $table->string('name');
            $table->string('item');
            $table->string('totalPaid');
            $table->text('description');
            $table->boolean('status')->default(true); // Adding 'paid' column as boolean
            $table->unsignedBigInteger('user_id')->unique(); // foreign key, unique
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};