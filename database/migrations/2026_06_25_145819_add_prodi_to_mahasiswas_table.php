<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('mahasiswas', 'prodi')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->string('prodi')->nullable()->after('nim');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('mahasiswas', 'prodi')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->dropColumn('prodi');
            });
        }
    }
};