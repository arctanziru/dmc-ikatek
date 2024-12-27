<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('disasters', function (Blueprint $table) {
            $table->datetime('time_of_disaster')->default(DB::raw('CURRENT_TIMESTAMP'))->after('longitude');
            $table->string('image')->nullable()->after('time_of_disaster');
            $table->json('image_galleries')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disasters', function (Blueprint $table) {
            $table->dropColumn('time_of_disaster');
            $table->dropColumn('image');
            $table->dropColumn('image_galleries');
        });
    }
};
