<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Photos;
use App\Rooms;
use Faker\Generator as Faker;
class PhotosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) {
    DB::table('photos')->delete();
        $room_ids = Rooms::all()->pluck('id')->toArray();
        for($k=0; $k<30; $k++){
            for($i = 0; $i < 3; $i++){
                Photos::create([
                'room_id' => $faker->randomElement($room_ids),
                'src' => 'images/room-'.rand(1, 10).'.jpg',
                    ]);
                }
            }

        }
    }

