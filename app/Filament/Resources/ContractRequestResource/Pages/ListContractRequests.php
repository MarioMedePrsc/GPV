<?php

namespace App\Filament\Resources\ContractRequestResource\Pages;

use App\Filament\Resources\ContractRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContractRequests extends ListRecords
{
    protected static string $resource = ContractRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
