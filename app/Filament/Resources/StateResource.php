<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Estado';
    protected static ?string $pluralModelLabel = 'Estados';

    protected static ?string $navigationLabel = 'Estados';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('clave_estado')
                    ->label('Clave Estado')
                    ->numeric()
                    ->required(),

                TextInput::make('abreviacion_estado')
                    ->label('Abreviación')
                    ->maxLength(10)
                    ->required(),

                TextInput::make('descripcion')
                    ->label('Descripción')
                    ->maxLength(80)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clave_estado')
                    ->label('Clave')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('abreviacion_estado')
                    ->label('Abrev.')
                    ->sortable(),

                TextColumn::make('descripcion')
                    ->label('Estado')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
