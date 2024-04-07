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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lname')->nullable(); // Agregado el campo 'lname'
            $table->string('Fname')->nullable(); // Corregido el nombre del campo
            $table->string('avatar')->nullable(); // Agregado el campo 'avatar'
            $table->string('google_id')->nullable();
            $table->string('email')->unique();
            $table->string('phoneno')->nullable(); // Agregado el campo 'phone'
            $table->string('address1')->nullable(); // Agregado el campo 'address1'
            $table->string('address2')->nullable(); // Agregado el campo 'address2'
            $table->string('city')->nullable(); // Agregado el campo 'city'
            $table->string('state')->nullable(); // Agregado el campo 'state'
            $table->string('country')->nullable(); // Agregado el campo 'country'
            $table->string('pincode')->nullable(); // Agregado el campo 'pincode'
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default(null);
            $table->tinyInteger('role_as')->default(0); // Quité las comillas al valor 0
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
