<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nip', 22)->primary(); // Primary key
            $table->enum('status_dosen', ['aktif', 'nonaktif'])->notNull(); // Sesuaikan status_dosen
            $table->enum('role_dosen', ['dosen', 'koordinator_ta', 'kajur', 'kaprodi'])->notNull(); // Sesuaikan role_dosen
            
            // Foreign key ke tabel users (username)
            $table->foreign('nip')->references('username')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim', 22)->primary(); // Primary key
            $table->year('tahun_masuk'); // Tahun masuk
            $table->string('kelas', 4)->notNull(); // Kelas
            $table->string('prodi', 100)->notNull(); // Program studi
            $table->enum('status_ta', ['mahasiswa_ta', 'mahasiswa_non_ta'])->notNull(); // Status tugas akhir
            $table->unsignedInteger('id_kota'); // ID Kota sebagai foreign key
            
            // Foreign keys
            $table->foreign('nim')->references('username')->on('users')->onDelete('cascade');            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('dosen');
    }
};
