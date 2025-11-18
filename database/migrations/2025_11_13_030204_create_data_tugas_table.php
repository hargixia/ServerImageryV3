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
        Schema::create('data_tugas', function (Blueprint $table) {
            $table->id();
            $table->longText('isi');
            $table->boolean('status');
            $table->float('nilai');
            $table->timestamps();

            $table->foreignId('id_materi_detail')->references('id')->on('data_materi_details');
            $table->foreignId('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tugas');
    }
};
