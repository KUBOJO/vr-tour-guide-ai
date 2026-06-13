<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void {
    Schema::create('jadwal_ops', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('lokasi'); // Contoh: Surabaya, Malang, Bromo
        $table->text('kegiatan');
        $table->string('status')->default('Rencana');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ops');
    }
};
