<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

//     public function up()
// {
//     Schema::table('users', function (Blueprint $table) {
//         $table->string('username')->default('default_username')->change();
//     });
// }

// public function down()
// {
//     Schema::table('users', function (Blueprint $table) {
//         $table->string('username')->default(null)->change();
//     });
// }
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 22)->primary(); // Primary key tanpa auto-increment
            $table->string('nama', 100);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->enum('role_user', ['dosen', 'mahasiswa']); // Sesuaikan peran pengguna
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }

    
};
