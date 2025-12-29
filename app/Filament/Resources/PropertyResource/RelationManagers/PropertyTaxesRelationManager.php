<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class PropertyTaxesRelationManager extends RelationManager
{
    protected static string $relationship = 'propertyTaxes';
    protected static ?string $title = 'Prediales';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('taxYear')
                ->label('Año')
                ->numeric()
                ->required(),

            TextInput::make('taxAmount')
                ->label('Impuesto')
                ->numeric(),

            TextInput::make('penalties')
                ->label('Recargos')
                ->numeric(),

            TextInput::make('discount')
                ->label('Descuento')
                ->numeric(),

            TextInput::make('totalTax')
                ->label('Total')
                ->numeric(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('taxYear')->label('Año'),
                TextColumn::make('taxAmount')->label('Impuesto'),
                TextColumn::make('totalTax')->label('Total'),
                TextColumn::make('created_at')->date(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar impuesto'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}

