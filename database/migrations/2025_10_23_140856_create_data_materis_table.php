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
        Schema::create('data_materis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreignId('id_apps')->constrained('data_apps','id');
            $table->foreignId('id_bidangs')->constrained('bidangs','id');
            $table->foreignId('id_authors')->constrained('users','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisoner_pertanyaans');
        Schema::dropIfExists('data_kuisoners');
        Schema::dropIfExists('data_kategoris');
        Schema::dropIfExists('data_materis');
    }
};
