<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Owner;
use App\Models\Ground;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Owner::factory()
            ->count(30)
            ->create()
            ->each(function (Owner $propietario) {
                Ground::factory()
                    ->count(30)
                    ->create(['owner_id' => $propietario->id])
                    ->each(function (Ground $terreno) {
                        Balance::factory()
                            ->count(1)
                            ->create(['ground_id' => $terreno->id]);
                    })
                ;
            });

    }
}
