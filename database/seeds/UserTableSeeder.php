<?php
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();
        $users = factory(User::class, 10)->create();
        $users = factory(User::class, 1)->create([
            'firstName' => 'Anastasis',
            'lastName' => 'Mastoris',
            'role' => '1',
            'password' => Hash::make("Str0ngP4ss"),//'$2y$10$3mAoxPfGx.jyzzQq5qKUdOfdnkB58WjtiRW4epvi7AKoO4q0AOS5O',
            'email' => 'mclaren730@gmail.com',
            'remember_token' => Str::random(10),
            'age' => '26',
        ]);
    }

}
