<?php

namespace App\Filament\Resources\JadwalOps\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;

use Filament\Tables\Table;

class JadwalOpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kegiatan')
                    ->limit(40),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Rencana',
                        'success' => 'Selesai',
                        'primary' => 'Berjalan',
                    ]),

            ])
            ->filters([])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}