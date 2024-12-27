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
        Schema::table('covered_areas', function (Blueprint $table) {
            $table->string('image')->nullable()->after('province_id');
            $table->json('image_galleries')->nullable()->after('image');
            $table->text('description')->nullable()->after('image_galleries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('covered_areas', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('image_galleries');
            $table->dropColumn('description');
        });
    }
};
