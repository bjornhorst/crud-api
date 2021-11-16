<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ArtistSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Eloquent::unguard();

        //$this->call('UserTableSeeder');
        //$this->command->info('User table seeded!');

        $path = 'resources/sql/songs.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Country table seeded!');
    }
}
