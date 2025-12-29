<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;

class PropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    protected static ?string $title = 'Propiedades';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('propertyRecordNumber')
                    ->label('Clave catastral')
                    ->searchable(),

                TextColumn::make('area')
                    ->label('Área')
                    ->numeric(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Asignar propiedad')
                    ->recordSelectSearchColumns(['propertyRecordNumber'])
                    ->recordTitle(fn ($record) => $record->propertyRecordNumber),
            ])
            ->actions([
                DetachAction::make()
                    ->label('Quitar'),
            ]);
    }
}
