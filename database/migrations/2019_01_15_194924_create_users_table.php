<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->string('email', 100);
            $table->unique('email');
            $table->dateTime('email_verified_at')->default(now());
            $table->string('phone', 20)->nullable();
            $table->string('age')->nullable();
            $table->string('city')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
