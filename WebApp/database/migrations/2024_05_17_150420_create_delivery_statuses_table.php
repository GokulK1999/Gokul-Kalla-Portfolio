<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->enum('status', ['pending', 'successful', 'completed']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_statuses');
    }
}

