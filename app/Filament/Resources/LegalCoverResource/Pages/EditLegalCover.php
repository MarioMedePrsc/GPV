<?php

namespace App\Filament\Resources\LegalCoverResource\Pages;

use App\Filament\Resources\LegalCoverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLegalCover extends EditRecord
{
    protected static string $resource = LegalCoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
