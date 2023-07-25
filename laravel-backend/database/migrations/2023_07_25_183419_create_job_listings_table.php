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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->enum('salary_type', ['GROSS', 'NET'])->index();
            $table->integer('salary_low');
            $table->integer('salary_high');
            $table->string('salary_currency');
            $table->string('location')->index();
            $table->string('level')->index();
            $table->string('position')->index();
            $table->string('stack')->index();
            $table->string('crawler')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
