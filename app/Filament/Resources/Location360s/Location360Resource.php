<?php

namespace App\Filament\Resources\Location360s;

use App\Filament\Resources\Location360s\Pages;
use App\Models\Location360;

use Filament\Forms;
use Filament\Resources\Resource;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Tables;
use Filament\Tables\Table;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class Location360Resource extends Resource
{
    protected static ?string $model = Location360::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Location 360';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Lokasi VR')
                    ->description('Kelola aset panorama 360 untuk Samsung A07.')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lokasi')
                            ->required()
                            ->placeholder('Contoh: Pintu Masuk Politani'),
                            
                            Forms\Components\FileUpload::make('image_path')
                               ->label('Foto Panorama 360')
                               ->image()
                               ->disk('public')
                               ->directory('locations-360')
                               ->visibility('public')
                             // 🎯 AMUNISI HIDUP: Paksa Livewire v3 menahan proses upload otomatis di background yang bikin eror Ngrok!
                               ->live(false)
                             // 🎯 AMUNISI CADANGAN: Gunakan nama asli file biar gampang disinkronkan frontend
                                ->preserveFilenames()
                                ->maxSize(25600) // Naikkan limit form Filament sampai 25MB demi foto panorama raksasa lo
                                ->required(),

                        Forms\Components\Textarea::make('ai_description')
                            ->label('Informasi untuk AI')
                            ->placeholder('Detail lokasi untuk dibaca AI...')
                            ->rows(5)
                            ->required(),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lokasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Preview 360')
                    // 🎯 AMUNISI SAKTI: Kita paksa Filament merender URL gambar lewat rute proxy internal Laravel 
                    // sehingga terbebas dari blokir 403 Forbidden Apache!
                  ->state(function ($record) {
                    // Ambil nama filenya saja (misal: bromo.jpg)
                    $filename = basename($record->image_path);
                   return url('/get-locations-image/' . $filename);
                      })
                 ->square(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocation360s::route('/'),
            'create' => Pages\CreateLocation360::route('/create'),
            'edit' => Pages\EditLocation360::route('/{record}/edit'),
        ];
    }
}