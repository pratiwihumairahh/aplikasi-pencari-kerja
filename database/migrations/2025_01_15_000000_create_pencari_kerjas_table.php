<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pencari_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat');
            $table->string('telepon', 15);
            $table->string('email')->unique();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('keahlian')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->enum('status', ['aktif', 'bekerja'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pencari_kerjas');
    }
};
