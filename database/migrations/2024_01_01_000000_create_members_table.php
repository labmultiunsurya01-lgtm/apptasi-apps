<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('email')->unique();
            $table->string('no_hp', 20);
            $table->text('alamat');
            $table->string('institusi');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('nomor_anggota')->nullable()->unique();
            $table->date('tanggal_bergabung')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
