<?php

namespace App\Filament\Resources\Location360s\Pages;

use App\Filament\Resources\Location360s\Location360Resource;
use Filament\Resources\Pages\CreateRecord;

class CreateLocation360 extends CreateRecord
{
    protected static string $resource = Location360Resource::class;

    // Pastikan tidak ada deklarasi Resource manual di sini yang bisa bikin bentrok
}