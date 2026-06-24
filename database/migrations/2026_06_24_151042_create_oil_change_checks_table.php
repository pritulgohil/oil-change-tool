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
        Schema::create('oil_change_checks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->unsignedBigInteger('current_odometer');
            $table->date('previous_oil_change_date');
            $table->unsignedBigInteger('previous_oil_change_odometer');
            $table->unsignedBigInteger('kilometres_since_last_change');
            $table->boolean('due_to_distance');
            $table->boolean('due_to_time');
            $table->boolean('is_due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oil_change_checks');
    }
};
