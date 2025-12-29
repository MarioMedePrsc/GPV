<?php

namespace App\Filament\Resources\EstatusResource\Pages;

use App\Filament\Resources\EstatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstatuses extends ListRecords
{
    protected static string $resource = EstatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
