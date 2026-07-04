<?php

namespace App\Filament\Resources\KingResource\Pages;

use App\Filament\Resources\KingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKings extends ManageRecords
{
    protected static string $resource = KingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
