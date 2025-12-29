<?php

namespace App\Filament\Resources\LeaseRecordResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    protected static ?string $title = 'Detalle de renta';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('num')
                ->label('Número')
                ->numeric(),

            Forms\Components\TextInput::make('year')
                ->label('Año')
                ->numeric(),

            Forms\Components\TextInput::make('month')
                ->label('Mes')
                ->numeric(),

            Forms\Components\TextInput::make('factor')
                ->label('Factor')
                ->numeric(),

            Forms\Components\TextInput::make('increment')
                ->label('Incremento')
                ->numeric(),

            Forms\Components\TextInput::make('updated_rent')
                ->label('Renta actualizada')
                ->numeric(),

            Forms\Components\TextInput::make('charge_percentage')
                ->label('% Cobro')
                ->numeric(),

            Forms\Components\TextInput::make('rent_to_charge')
                ->label('Renta a cobrar')
                ->numeric(),
        ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('num')->label('No.'),
                Tables\Columns\TextColumn::make('year')->label('Año'),
                Tables\Columns\TextColumn::make('month')->label('Mes'),
                Tables\Columns\TextColumn::make('updated_rent')->label('Renta actualizada'),
                Tables\Columns\TextColumn::make('rent_to_charge')->label('Renta a cobrar'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
