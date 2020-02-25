<?php

use App\Models\VehicleMake;
use Illuminate\Database\Seeder;

class VehicleModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleModels = [
            'Dodge' => [
                [
                    'title' => 'Ram 1500',
                ],
                [
                    'title' => 'Ram Rebel',
                ],
            ],
            'Toyota' => [
                [
                    'title' => 'Tacoma',
                ],
                [
                    'title' => 'Tundra',
                ],
            ],
        ];

        foreach ($vehicleModels as $index => $model) {
            VehicleMake::whereTitle($index)->first()->vehicleModels()->createMany($model);
        }
    }
}
