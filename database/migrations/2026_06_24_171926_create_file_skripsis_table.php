<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete();
            $table->foreignId('bimbingan_id')->nullable()->constrained('bimbingans')->nullOnDelete();
            $table->string('nama_file');
            $table->string('file_path');
            $table->string('jenis_file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_skripsis');
    }
};