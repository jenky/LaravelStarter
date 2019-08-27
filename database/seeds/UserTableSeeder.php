<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(
            User::class,
            intval($this->command->ask('How many records do you want to create', 10))
        )->create();
    }
}
