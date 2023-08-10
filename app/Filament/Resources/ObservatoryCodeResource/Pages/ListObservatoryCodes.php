<?php

namespace App\Filament\Resources\ObservatoryCodeResource\Pages;

use App\Filament\Resources\ObservatoryCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObservatoryCodes extends ListRecords
{
    protected static string $resource = ObservatoryCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
