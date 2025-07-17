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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi user
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->string('size');
            $table->integer('kuantitas');
            $table->string('nama_penerima');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('nama_jalan');
            $table->string('kode_pos');
            $table->text('pesan')->nullable();
            $table->string('email');
            $table->string('no_hp');
            $table->enum('pembayaran', ['COD'])->default('COD');
            $table->enum('status', ['diproses', 'diterima', 'dikemas', 'dalam perjalanan', 'pesanan selesai', 'ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
