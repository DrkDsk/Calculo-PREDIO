<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $yearOperationDate = $this->faker->numberBetween(2000, 2025);

        return [
            'amount' => $this->faker->randomFloat(2, 10),
            'updated_charge' => $this->faker->randomFloat(2, 10),
            'surcharge' => $this->faker->randomFloat(2, 10),
            'year_at_operation_date' => $yearOperationDate,
            'due_payment_year' => $yearOperationDate -1,
            'amount_to_pay' => $this->faker->randomFloat(2, 10),
            'month_at_operation_date' => $this->faker->date("F"),
            'month_of_pay' => $this->faker->date("F"),
            'INCP_at_operation_date' => $this->faker->randomFloat(2, 10),
            'INCP_applied' => $this->faker->randomFloat(2, 10),
            'surcharge_rate' => $this->faker->randomFloat(2, 10),
        ];
    }
}
