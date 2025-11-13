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
        Schema::create('data_kuisoners', function (Blueprint $table) {
            $table->id();
            $table->float('nilai');
            $table->text('rekomendasi');
            $table->string('kategori');
            $table->string('tipe');
            $table->timestamps();

            $table->foreignId('id_user')->constrained('users','id');
            $table->foreignId('id_materi')->constrained('data_materis','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kuisoners');
    }
};
