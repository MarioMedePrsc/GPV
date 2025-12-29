<?php

namespace App\Filament\Resources\LeaseRecordResource\Pages;

use App\Filament\Resources\LeaseRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaseRecords extends ListRecords
{
    protected static string $resource = LeaseRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
