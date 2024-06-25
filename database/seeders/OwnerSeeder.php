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
            ->count(10)
            ->create()
            ->each(function (Owner $owner) {
                Ground::factory()
                    ->count(2)
                    ->create(['owner_id' => $owner->id])
                    ->each(function (Ground $ground) {
                        Balance::factory()
                            ->count(20)
                            ->create(['ground_id' => $ground->id]);
                    })
                ;
            });
    }
}
