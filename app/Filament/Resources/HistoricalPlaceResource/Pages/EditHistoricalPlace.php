<?php

namespace App\Filament\Resources\HistoricalPlaceResource\Pages;

use App\Filament\Resources\HistoricalPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoricalPlace extends EditRecord
{
    protected static string $resource = HistoricalPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
