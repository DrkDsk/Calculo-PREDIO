<?php

namespace Database\Seeders;

use App\Models\Propietario;
use Database\Factories\PropietarioFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Propietario::factory(10)->create();
    }
}
