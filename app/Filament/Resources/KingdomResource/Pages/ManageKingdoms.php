<?php

namespace App\Filament\Resources\KingdomResource\Pages;

use App\Filament\Resources\KingdomResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKingdoms extends ManageRecords
{
    protected static string $resource = KingdomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
