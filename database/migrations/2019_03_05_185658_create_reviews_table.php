<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('rate');
            $table->text('review')->collation('utf8_unicode_ci');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reviews');
    }
}
