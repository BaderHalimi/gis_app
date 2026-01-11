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
            $table->enum('status', ['operational', 'damaged_operational', 'damaged_non_operational'])
                  ->default('operational')
                  ->after('type')
                  ->comment('حالة المحطة: سليمة، متضررة تعمل، متضررة لا تعمل');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
