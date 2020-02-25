<?php

use App\Models\VehicleMake;
use Illuminate\Database\Seeder;

class VehicleMakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleMakes = ['Dodge', 'Toyota'];

        foreach ($vehicleMakes as $vehicle) {
            VehicleMake::create(['title' => $vehicle]);
        }
    }
}
