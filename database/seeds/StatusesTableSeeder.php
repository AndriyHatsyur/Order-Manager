<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'code' => 100,
            'name' => 'New'
        ]);

        Status::create([
            'code' => 200,
            'name' => 'In-Process'
        ]);

        Status::create([
            'code' => 250,
            'name' => 'Incomplete'
        ]);

        Status::create([
            'code' => 275,
            'name' => 'No-component'
        ]);

        Status::create([
            'code' => 300,
            'name' => 'In-Transport'
        ]);

        Status::create([
            'code' => 400,
            'name' => 'Finished'
        ]);

        Status::create([
            'code' => 500,
            'name' => 'Canceled'
        ]);
    }
}
