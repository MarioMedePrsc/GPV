<?php

namespace App\Filament\Resources\TechnicalRequestResource\Pages;

use App\Filament\Resources\TechnicalRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechnicalRequests extends ListRecords
{
    protected static string $resource = TechnicalRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
