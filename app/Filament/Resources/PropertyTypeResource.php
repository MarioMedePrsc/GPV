<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyTypeResource\Pages;
use App\Filament\Resources\PropertyTypeResource\RelationManagers;
use App\Models\PropertyType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PropertyTypeResource extends Resource
{
    protected static ?string $model = PropertyType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Tipo de Propiedad';
    protected static ?string $pluralModelLabel = 'Tipos de Propiedad';

    protected static ?string $navigationLabel = 'Tipos de Propiedad';
    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                ->label('Descripción')
                ->required()
                ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('ID')
                ->sortable(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListPropertyTypes::route('/'),
            'create' => Pages\CreatePropertyType::route('/create'),
            'edit' => Pages\EditPropertyType::route('/{record}/edit'),
        ];
    }
}
