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
        Schema::table('configurations', function (Blueprint $table) {
            // menyimpan jam sebagai string 'HH:MM'
            $table->string('masuk_start')->nullable()->after('radius_meter');   // contoh: '06:30'
            $table->string('masuk_end')->nullable()->after('masuk_start');     // contoh: '10:00'
            $table->string('pulang_start')->nullable()->after('masuk_end');    // contoh: '15:00'
            $table->string('pulang_end')->nullable()->after('pulang_start');   // contoh: '19:00'
        });
    }

    public function down(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropColumn(['masuk_start', 'masuk_end', 'pulang_start', 'pulang_end']);
        });
    }
};
