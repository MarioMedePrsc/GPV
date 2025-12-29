<?php

namespace App\Filament\Resources\LeaseRecordResource\Pages;

use App\Filament\Resources\LeaseRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaseRecord extends EditRecord
{
    protected static string $resource = LeaseRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
