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
        Schema::create('data_materi_details', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('tipe',[
                'video',
                'audio',
                'gambar',
                'teks',
                'file'
            ]);
            $table->longText('isi');

            $table->boolean('tugas');
            $table->boolean('exp')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('stop')->nullable();
            $table->timestamps();

            $table->foreignId('id_materi')->constrained('data_materis','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_materi_details');
    }
};
