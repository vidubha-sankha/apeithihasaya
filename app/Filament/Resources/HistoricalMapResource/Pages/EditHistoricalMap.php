<?php

namespace App\Filament\Resources\HistoricalMapResource\Pages;

use App\Filament\Resources\HistoricalMapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoricalMap extends EditRecord
{
    protected static string $resource = HistoricalMapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
