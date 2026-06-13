<?php

namespace App\Filament\Resources\JadwalOps\Pages;

use App\Filament\Resources\JadwalOps\JadwalOpResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalOp extends EditRecord
{
    protected static string $resource = JadwalOpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}