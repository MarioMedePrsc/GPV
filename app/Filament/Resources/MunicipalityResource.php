<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalityResource\Pages;
use App\Filament\Resources\MunicipalityResource\RelationManagers;
use App\Models\Municipality;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;


class MunicipalityResource extends Resource
{
    protected static ?string $model = Municipality::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Municipio';
    protected static ?string $pluralModelLabel = 'Municipios';

    protected static ?string $navigationLabel = 'Municipios';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('state_id')
                    ->label('Estado')
                    ->relationship('state', 'descripcion')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('clave_municipio')
                    ->label('Clave Municipio')
                    ->numeric()
                    ->required(),

                TextInput::make('descripcion')
                    ->label('Municipio')
                    ->maxLength(80)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('state.descripcion')
                    ->label('Estado')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('clave_municipio')
                    ->label('Clave')
                    ->sortable(),

                TextColumn::make('descripcion')
                    ->label('Municipio')
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
            'index' => Pages\ListMunicipalities::route('/'),
            'create' => Pages\CreateMunicipality::route('/create'),
            'edit' => Pages\EditMunicipality::route('/{record}/edit'),
        ];
    }
}
