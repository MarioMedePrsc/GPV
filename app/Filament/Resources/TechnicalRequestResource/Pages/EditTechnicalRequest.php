<?php

namespace App\Filament\Resources\TechnicalRequestResource\Pages;

use App\Filament\Resources\TechnicalRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechnicalRequest extends EditRecord
{
    protected static string $resource = TechnicalRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
