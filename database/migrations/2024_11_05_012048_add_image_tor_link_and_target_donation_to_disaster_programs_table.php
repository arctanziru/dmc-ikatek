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
        Schema::table('disaster_programs', function (Blueprint $table) {
            $table->string('image')->nullable()->after('status');
            $table->string('tor_link')->nullable()->after('image');
            $table->unsignedBigInteger('target_donation')->nullable()->after('tor_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disaster_programs', function (Blueprint $table) {
            $table->dropColumn(['image', 'tor_link', 'target_donation']);
        });
    }
};
