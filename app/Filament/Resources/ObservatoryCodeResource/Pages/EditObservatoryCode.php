<?php

namespace App\Filament\Resources\ObservatoryCodeResource\Pages;

use App\Filament\Resources\ObservatoryCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObservatoryCode extends EditRecord
{
    protected static string $resource = ObservatoryCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
