<?php

namespace App\Filament\Resources\KingResource\Pages;

use App\Filament\Resources\KingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKing extends EditRecord
{
    protected static string $resource = KingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
