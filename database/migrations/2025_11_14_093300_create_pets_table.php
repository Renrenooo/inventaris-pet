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
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relasi ke akun
            $table->unsignedBigInteger('account_id');

            // Kolom sesuai permintaan terbaru
            $table->string('nama_pet');  // jenis pet
            $table->integer('berat');    // Berat per ekor
            $table->integer('jumlah');   // jumlah pet 

            $table->timestamps();

            // Foreign key ke users.id
            $table->foreign('account_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
