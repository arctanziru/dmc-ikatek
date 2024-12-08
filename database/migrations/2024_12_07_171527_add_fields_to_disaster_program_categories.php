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
        Schema::table('disaster_program_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('area_of_work_id')->nullable();
            $table->foreign('area_of_work_id')->references('id')->on('area_of_works')->onDelete('set null');
            $table->string('cover_image')->nullable();
            $table->string('image')->nullable();
            $table->text('image_galleries')->nullable();
            $table->text('short_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disaster_program_categories', function (Blueprint $table) {
            $table->dropForeign(['area_of_work_id']);
            $table->dropColumn(['area_of_work_id', 'cover_image', 'image', 'image_galleries', 'short_description']);
        });
    }
};
