<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) { // Cambié 'order' a 'orders'
            $table->id();
            $table->unsignedBigInteger('user_id'); // Cambié 'string' a 'unsignedBigInteger'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Agregué clave foránea
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('phoneno');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode');
            $table->decimal('total_price', 8, 2); // Cambié 'string' a 'decimal'
            $table->tinyInteger('status')->default(0);
            $table->string('message')->nullable();
            $table->string('tracking_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders'); // Cambié 'order' a 'orders'
    }
};
