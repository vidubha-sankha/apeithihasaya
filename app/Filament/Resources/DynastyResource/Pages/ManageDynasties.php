<?php

namespace App\Filament\Resources\DynastyResource\Pages;

use App\Filament\Resources\DynastyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDynasties extends ManageRecords
{
    protected static string $resource = DynastyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
