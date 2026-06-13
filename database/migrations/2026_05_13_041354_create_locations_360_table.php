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
    Schema::create('locations_360', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Gedung Direktorat
        $table->string('image_path'); // File foto 360
        $table->text('ai_description'); // Data mentah untuk "Otak" AI kamu nanti 
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations_360');
    }
};
