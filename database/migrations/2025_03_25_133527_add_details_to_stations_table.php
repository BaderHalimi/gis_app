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
        Schema::table('stations', function (Blueprint $table) {
            $table->string('address')->nullable()->after('lng');
            $table->text('description')->nullable()->after('address');
            $table->json('prices')->nullable()->after('description');
            $table->json('images')->nullable()->after('prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->dropColumn(['address', 'description', 'prices', 'images']);
        });
    }
};
