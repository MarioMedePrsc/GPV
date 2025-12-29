<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentialDevelopmentResource\Pages;
use App\Filament\Resources\ResidentialDevelopmentResource\RelationManagers;
use App\Models\ResidentialDevelopment;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use App\Models\Municipality;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;

class ResidentialDevelopmentResource extends Resource
{
    protected static ?string $model = ResidentialDevelopment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Fraccionamiento';
    protected static ?string $pluralModelLabel = 'Fraccionamientos';

    protected static ?string $navigationLabel = 'Fraccionamientos';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Información General')
                ->schema([
                    TextInput::make('description')
                        ->label('Fraccionamiento')
                        ->required()
                        ->maxLength(120),

                    TextInput::make('short_name')
                        ->label('Abreviatura')
                        ->maxLength(50),

                    Select::make('state_id')
                        ->label('Estado')
                        ->relationship('state', 'descripcion')
                        ->searchable()
                        ->preload()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('municipality_id', null)
                        )
                        ->required(),

                    Select::make('municipality_id')
                        ->label('Municipio')
                        ->options(function (Get $get) {
                            $stateId = $get('state_id');

                            if (!$stateId) {
                                return [];
                            }

                            return Municipality::where('state_id', $stateId)
                                ->orderBy('descripcion')
                                ->pluck('descripcion', 'id');
                        })
                        ->searchable()
                        ->disabled(fn (Get $get) => !$get('state_id'))
                        ->required(),
            ])
            ->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')
                    ->label('Desarrollo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('short_name')
                    ->label('Nombre Corto')
                    ->sortable(),

                TextColumn::make('state.descripcion')
                    ->label('Estado')
                    ->sortable(),

                TextColumn::make('municipality.descripcion')
                    ->label('Municipio')
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
            'index' => Pages\ListResidentialDevelopments::route('/'),
            'create' => Pages\CreateResidentialDevelopment::route('/create'),
            'edit' => Pages\EditResidentialDevelopment::route('/{record}/edit'),
        ];
    }
}
