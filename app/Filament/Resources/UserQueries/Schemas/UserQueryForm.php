<?php

namespace App\Filament\Resources\UserQueries\Schemas;

use App\Models\Location360;
use Filament\Forms;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString; // 🎯 PENTING: Untuk render pemutar audio HTML kustom

class UserQueryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Forms\Components\TextInput::make('user_name')
                    ->required(),

                Forms\Components\Select::make('location_id')
                    ->label('Lokasi VR')
                    ->options(
                        Location360::pluck('name', 'id')
                    )
                    ->searchable(),

                Forms\Components\Textarea::make('question')
                    ->rows(4)
                    ->required(),

                Forms\Components\Textarea::make('ai_response')
                    ->rows(6),

                // 🎯 PERBAIKAN UTAMA: Ubah FileUpload menjadi kombinasi teks URL + Player Audio Langsung!
                Forms\Components\TextInput::make('audio_path')
                    ->label('URL Audio AI (Ngrok/Python)')
                    ->disabled() // Kita kunci biar admin gak bisa asal ubah link API-nya
                    ->placeholder('Tidak ada rekaman suara'),

                Forms\Components\Placeholder::make('audio_player')
                    ->label('Pemutar Suara AI')
                    ->content(function ($record) {
                        // Jika ada data audio_path yang tersimpan di database, kita render tag <audio> HTML
                        if ($record && $record->audio_path) {
                            return new HtmlString("
                                <audio controls class='w-full mt-2' style='max-width: 300px;'>
                                    <source src='{$record->audio_path}' type='audio/mpeg'>
                                    Browser tidak mendukung pemutar audio.
                                </audio>
                            ");
                        }
                        return 'Tidak ada berkas audio untuk diputar.';
                    }),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'answered' => 'Answered',
                    ])
                    ->default('pending')
                    ->required(),

            ]);
    }
}