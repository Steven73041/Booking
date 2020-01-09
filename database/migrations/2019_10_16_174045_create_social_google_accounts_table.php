<?php
// create_social_google_accounts.php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialGoogleAccountsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('social_google_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('user_id')->unsigned();
            $table->string('provider_user_id');
            $table->string('provider');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('social_google_accounts');
    }
}
