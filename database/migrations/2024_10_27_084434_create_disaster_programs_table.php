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
        Schema::create('disaster_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('category_id')->constrained('disaster_program_categories')->onDelete('cascade');
            $table->foreignId('disaster_id')->nullable()->constrained('disasters')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained(table: config('laravolt.indonesia.table_prefix') . 'cities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster_programs');
    }
};
