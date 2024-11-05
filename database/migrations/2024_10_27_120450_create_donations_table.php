<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('donor_organization')->nullable();
            $table->string('donor_email')->nullable();
            $table->unsignedBigInteger('amount');
            $table->text('message')->nullable();
            $table->string('transfer_evidence');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->date('donation_date')->nullable();
            $table->foreignId('disaster_program_id')->nullable()->constrained('disaster_programs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
