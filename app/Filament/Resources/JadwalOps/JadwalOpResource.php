<?php

namespace App\Filament\Resources\JadwalOps;

use App\Filament\Resources\JadwalOps\Pages\CreateJadwalOp;
use App\Filament\Resources\JadwalOps\Pages\EditJadwalOp;
use App\Filament\Resources\JadwalOps\Pages\ListJadwalOps;

use App\Filament\Resources\JadwalOps\Schemas\JadwalOpForm;
use App\Filament\Resources\JadwalOps\Tables\JadwalOpsTable;

use App\Models\JadwalOp;

use BackedEnum;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JadwalOpResource extends Resource
{
    protected static ?string $model = JadwalOp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $navigationLabel = 'Jadwal Operasional';

    protected static ?string $recordTitleAttribute = 'lokasi';

    public static function form(Schema $schema): Schema
    {
        return JadwalOpForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalOpsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJadwalOps::route('/'),
            'create' => CreateJadwalOp::route('/create'),
            'edit' => EditJadwalOp::route('/{record}/edit'),
        ];
    }
}