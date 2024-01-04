<?php

namespace Database\Seeders;

use App\Models\FederalSurcharge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class FederalSurchargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'year' => 2014,
                'value' => 118.7
            ],
            [
                'year' => 2015,
                'value' => 107.4
            ],
            [
                'year' => 2016,
                'value' => 96.10
            ],
            [
                'year' => 2017,
                'value' => 84.80
            ],
            [
                'year' => 2018,
                'value' => 86.73
            ],
            [
                'year' => 2019,
                'value' => 72.03
            ],
            [
                'year' => 2020,
                'value' => 57.33
            ],
            [
                'year' => 2021,
                'value' => 42.63
            ],
            [
                'year' => 2022,
                'value' => 27.93
            ],
        ];

        foreach ($data as $element) {
            FederalSurcharge::create([
                'year' => $element['year'],
                'value' => $element['value'] / 100
            ]);
        }
    }
}
