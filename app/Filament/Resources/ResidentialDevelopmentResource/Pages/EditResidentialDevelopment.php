<?php

namespace App\Filament\Resources\ResidentialDevelopmentResource\Pages;

use App\Filament\Resources\ResidentialDevelopmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResidentialDevelopment extends EditRecord
{
    protected static string $resource = ResidentialDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
