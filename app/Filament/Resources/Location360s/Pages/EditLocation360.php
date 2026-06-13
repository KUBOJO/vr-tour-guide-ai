<?php

namespace App\Filament\Resources\Location360s\Pages;

use App\Filament\Resources\Location360s\Location360Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocation360 extends EditRecord
{
    protected static string $resource = Location360Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}