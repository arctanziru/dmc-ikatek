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
        Schema::create('covered_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained(table: config(key: 'laravolt.indonesia.table_prefix') . 'cities')->onDelete('cascade');
            $table->foreignId('province_id')->constrained(table: config(key: 'laravolt.indonesia.table_prefix') . 'provinces')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covered_areas');
    }
};
