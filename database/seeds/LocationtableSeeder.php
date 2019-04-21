<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationtableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' => 'F2'
        ]);

        Location::create([
            'name' => 'X1'
        ]);

        Location::create([
            'name' => 'F1'
        ]);

        Location::create([
            'name' => 'F5'
        ]);

        Location::create([
            'name' => 'F7'
        ]);
    }
}
