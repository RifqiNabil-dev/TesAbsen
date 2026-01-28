<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            // Status lokasi absen
            $table->enum('location_status', [
                'berada dilokasi magang',
                'diluar lokasi magang'
            ])->nullable()->after('status');

            // Jarak ke lokasi magang (meter)
            $table->double('distance')
                  ->nullable()
                  ->after('location_status')
                  ->comment('Jarak mahasiswa ke lokasi magang (meter)');

            // Koordinat mahasiswa saat absen
            $table->decimal('latitude', 10, 7)
                  ->nullable()
                  ->after('distance');

            $table->decimal('longitude', 10, 7)
                  ->nullable()
                  ->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'location_status',
                'distance',
                'latitude',
                'longitude'
            ]);
        });
    }
};
