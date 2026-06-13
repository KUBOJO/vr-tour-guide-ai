<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_queries', function (Blueprint $table) {

            $table->id();

            // Nama user / visitor
            $table->string('user_name');

            // Pertanyaan hasil STT Whisper
            $table->text('question');

            // Jawaban AI GPT / Gemini
            $table->longText('ai_response')
                ->nullable();

            // File audio user
            $table->string('audio_path')
                ->nullable();

            // Lokasi panorama VR terkait
            $table->foreignId('location_id')
                ->nullable()
                ->constrained('locations_360')
                ->nullOnDelete();

            // Status AI
            $table->string('status')
                ->default('pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_queries');
    }
};