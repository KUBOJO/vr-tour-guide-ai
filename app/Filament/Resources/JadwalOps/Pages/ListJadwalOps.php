<?php

namespace App\Filament\Resources\JadwalOps\Pages;

use App\Filament\Resources\JadwalOps\JadwalOpResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalOps extends ListRecords
{
    protected static string $resource = JadwalOpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}