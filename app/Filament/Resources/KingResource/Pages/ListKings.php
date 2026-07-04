<?php

namespace App\Filament\Resources\KingResource\Pages;

use App\Filament\Resources\KingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKings extends ListRecords
{
    protected static string $resource = KingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
