<?php

namespace App\Filament\Resources\LegalCoverResource\Pages;

use App\Filament\Resources\LegalCoverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegalCovers extends ListRecords
{
    protected static string $resource = LegalCoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
