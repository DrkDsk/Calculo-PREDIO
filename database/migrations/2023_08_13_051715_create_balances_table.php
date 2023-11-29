<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ground_id')
                ->references('id')->on('grounds')
                ->onDelete('cascade');
            $table->double('amount');
            $table->double('updated_charge');
            $table->double('surcharge');
            $table->double('amount_to_pay');
            $table->string('month_at_operation_date');
            $table->string('month_of_pay');
            $table->double('INCP_at_operation_date');
            $table->double('INCP_applied');
            $table->double('surcharge_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
