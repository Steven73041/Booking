<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('rooms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('name');
            $table->string('area');
            $table->bigInteger('room_type')->unsigned();
            $table->float('price');
            $table->string('address');
            $table->float('lat_location');
            $table->float('lng_location');
            $table->text('short_description')->collation('utf8_unicode_ci');
            $table->longText('long_description')->collation('utf8_unicode_ci');
            $table->string('parking')->default('No');
            $table->string('wifi')->default('No');
            $table->string('pet_friendly')->default('No');
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->foreign('room_type')->references('id')->on('room_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rooms');
    }
}

