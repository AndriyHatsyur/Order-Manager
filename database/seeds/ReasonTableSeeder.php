<?php

use Illuminate\Database\Seeder;
use App\Reason;


class ReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reason::create([
            'name' => 'Prio1'
        ]);

        Reason::create([
            'name' => 'Prio2'
        ]);
    }
}
