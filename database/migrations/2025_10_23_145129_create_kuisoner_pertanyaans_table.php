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
        Schema::create('kuisoner_pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->text('soal');
            $table->enum('tipe',['P','N','A']);
            $table->timestamps();

            $table->foreignId('id_materi')->constrained('data_materis','id');
        });

        Schema::table('data_rekomendasis',function(Blueprint $table){
            $table->foreignId('id_pertanyaan')->constrained('kuisoner_pertanyaans','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
