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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });

        Schema::create('equipment_workloads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');

            $table->dateTime('date_of_download')->default(now());
            $table->string('working_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_workload');
        Schema::dropIfExists('equipment');
    }
};
