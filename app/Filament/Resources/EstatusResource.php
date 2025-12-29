<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstatusResource\Pages;
use App\Filament\Resources\EstatusResource\RelationManagers;
use App\Models\Estatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstatusResource extends Resource
{
    protected static ?string $model = Estatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
     protected static ?string $modelLabel = 'Estatus';
    protected static ?string $pluralModelLabel = 'Estatuses';

    protected static ?string $navigationLabel = 'Estatuses';
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEstatuses::route('/'),
            'create' => Pages\CreateEstatus::route('/create'),
            'edit' => Pages\EditEstatus::route('/{record}/edit'),
        ];
    }
}
