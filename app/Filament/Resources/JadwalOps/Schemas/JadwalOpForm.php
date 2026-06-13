<?php

namespace App\Filament\Resources\JadwalOps\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JadwalOpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Form Jadwal Operasional')
                    ->description('Kelola jadwal operasional VR Tour Guide')
                    ->schema([

                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required(),

                        TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->placeholder('Contoh: Bromo')
                            ->required(),

                        Textarea::make('kegiatan')
                            ->label('Kegiatan')
                            ->rows(5)
                            ->required(),

                        Select::make('status')
                            ->options([
                                'Rencana' => 'Rencana',
                                'Berjalan' => 'Berjalan',
                                'Selesai' => 'Selesai',
                            ])
                            ->default('Rencana')
                            ->required(),

                    ]),
            ]);
    }
}