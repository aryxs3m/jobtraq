<?php

use App\Models\Location;
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
        Schema::table('job_listings', function (Blueprint $table) {
            if (config('database.default') === 'sqlite') {
                $table->renameColumn('location', 'original_location');
            } else {
                \DB::statement('ALTER TABLE `job_listings` CHANGE `location` `original_location` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');
            }
            $table->foreignIdFor(Location::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropForeignIdFor(Location::class);
            if (config('database.default') === 'sqlite') {
                $table->renameColumn('original_location', 'location');
            } else {
                \DB::statement('ALTER TABLE `job_listings` CHANGE `original_location` `location` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');
            }
        });
    }
};
