<?php

use Illuminate\Database\Seeder;
use App\Reviews;

class ReviewsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('reviews')->delete();
        $reviews = factory(Reviews::class, 100)->create();
    }
}
