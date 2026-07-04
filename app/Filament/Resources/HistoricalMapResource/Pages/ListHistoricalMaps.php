<?php

namespace App\Filament\Resources\HistoricalMapResource\Pages;

use App\Filament\Resources\HistoricalMapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoricalMaps extends ListRecords
{
    protected static string $resource = HistoricalMapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
