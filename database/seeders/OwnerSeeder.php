<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Propietario;
use App\Models\Terreno;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Propietario::factory()
            ->count(30)
            ->create()
            ->each(function (Propietario $propietario) {
                Terreno::factory()
                    ->count(30)
                    ->create(['owner_id' => $propietario->id])
                    ->each(function (Terreno $terreno) {
                        Balance::factory()
                            ->count(1)
                            ->create(['ground_id' => $terreno->id]);
                    })
                ;
            });

    }
}
