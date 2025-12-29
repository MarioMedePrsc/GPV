<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientTypeResource\Pages;
use App\Filament\Resources\ClientTypeResource\RelationManagers;
use App\Models\ClientType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ClientTypeResource extends Resource
{
    protected static ?string $model = ClientType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Tipo de Cliente';
    protected static ?string $pluralModelLabel = 'Tipos de Clientes';

    protected static ?string $navigationLabel = 'Tipos de Clientes';
    protected static ?string $navigationGroup = 'Clientes';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->label('Tipo de cliente')
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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Tipo de cliente')
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
            'index' => Pages\ListClientTypes::route('/'),
            'create' => Pages\CreateClientType::route('/create'),
            'edit' => Pages\EditClientType::route('/{record}/edit'),
        ];
    }
}
