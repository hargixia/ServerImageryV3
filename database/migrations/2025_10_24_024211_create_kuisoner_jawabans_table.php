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
        Schema::create('kuisoner_jawabans', function (Blueprint $table) {
            $table->id();
            $table->integer('pos');
            $table->float('jawaban');
            $table->timestamps();

            $table->foreignId('id_pertanyaan')->constrained('kuisoner_pertanyaans','id');
            $table->foreignId('id_user')->constrained('users','id');
            $table->foreignId('id_rekomendasi')->constrained('data_rekomendasis','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisoner_jawabans');
    }
};
