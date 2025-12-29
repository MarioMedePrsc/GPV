<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhaseResource\Pages;
use App\Filament\Resources\PhaseResource\RelationManagers;
use App\Models\Phase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhaseResource extends Resource
{
    protected static ?string $model = Phase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Fase';
    protected static ?string $pluralModelLabel = 'Fases';

    protected static ?string $navigationLabel = 'Fases';
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
            'index' => Pages\ListPhases::route('/'),
            'create' => Pages\CreatePhase::route('/create'),
            'edit' => Pages\EditPhase::route('/{record}/edit'),
        ];
    }
}
