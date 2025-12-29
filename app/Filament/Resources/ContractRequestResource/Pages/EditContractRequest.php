<?php

namespace App\Filament\Resources\ContractRequestResource\Pages;

use App\Filament\Resources\ContractRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContractRequest extends EditRecord
{
    protected static string $resource = ContractRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
