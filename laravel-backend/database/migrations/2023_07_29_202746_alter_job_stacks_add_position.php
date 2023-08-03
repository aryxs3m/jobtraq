<?php

use App\Models\JobPosition;
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
        Schema::table('job_stacks', function (Blueprint $table) {
            if (config('database.default') === 'sqlite') {
                $table->bigInteger('job_position_id')->unsigned()->nullable();
            } else {
                $table->foreignIdFor(JobPosition::class)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_stacks', function (Blueprint $table) {
            $table->dropForeignIdFor(JobPosition::class);
        });
    }
};
