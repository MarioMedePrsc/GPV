<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers\PropertiesRelationManager;
use App\Models\Project;
use App\Models\Estatus;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Proyecto';
    protected static ?string $pluralModelLabel = 'Proyectos';

    protected static ?string $navigationLabel = 'Proyectos';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->label('Proyecto')
                    ->maxLength(50)
                    ->required(),

                TextInput::make('shortName')
                    ->label('Abreviación')
                    ->maxLength(20),

                Select::make('clientId')
                    ->label('Cliente')
                    ->relationship('client', 'description')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('phaseId')
                    ->label('Fase')
                    ->relationship('phase', 'description')
                    ->live()
                    ->required(),

                Select::make('estatusId')
                    ->label('Estatus')
                    ->options(fn (Get $get) =>
                        Estatus::where('phaseId', $get('phaseId'))
                            ->pluck('description', 'id')
                    )
                    ->required(),

                TextInput::make('rentalPrice')
                    ->label('Precio de renta')
                    ->numeric(),

                TextInput::make('rentalAreaProposed')
                    ->label('Área de renta propuesta')
                    ->numeric(),

                TextInput::make('monthlyRental')
                    ->label('Renta mensual')
                    ->numeric(),

                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')
                    ->label('Proyecto')
                    ->searchable(),

                TextColumn::make('client.description')
                    ->label('Cliente'),

                TextColumn::make('area')
                    ->label('Área total')
                    ->numeric(2),

                TextColumn::make('estatus.description')
                    ->label('Estatus'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PropertiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
