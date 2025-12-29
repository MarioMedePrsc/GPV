<?php

namespace App\Filament\Resources;


use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Filament\Resources\PropertyResource\RelationManagers\PropertyTaxesRelationManager;

use App\Models\Property;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Template;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Get;

use App\Models\Municipality;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Propiedad';
    protected static ?string $pluralModelLabel = 'Propiedades';

    protected static ?string $navigationLabel = 'Propiedades';
    protected static ?string $navigationGroup = 'Inventario';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Estatus')
                    ->schema([
                        Toggle::make('estatusId')
                            ->label('Activo')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->required(),

                        Select::make('propertyEstatusId')
                            ->label('Estatus de Renta')
                            ->options([
                                0 => 'No Rentado',
                                1 => 'Rentado',
                            ])
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Información General')
                    ->schema([
                        TextInput::make('propertyRecordNumber')
                            ->label('Expediente Catastral')
                            ->maxLength(20)
                            ->required(),

                        Select::make('propertyTypeId')
                            ->label('Tipo de Propiedad')
                            ->relationship('propertyType', 'description')
                            ->preload()
                            ->required(),

                        Textarea::make('address')
                            ->label('Dirección')
                            ->rows(2)
                            ->columnSpanFull()
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Dimensiones')
                    ->schema([
                        TextInput::make('area')
                            ->label('Área del Terreno (m²)')
                            ->numeric()
                            ->required(),

                        TextInput::make('builtArea')
                            ->label('Área Construida (m²)')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Ubicación Interna')
                    ->schema([
                        Select::make('residentialDevelopmentId')
                            ->label('Fraccionamiento')
                            ->relationship('ResidentialDevelopment', 'description')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('block')
                            ->label('Manzana')
                            ->maxLength(30),

                        TextInput::make('lot')
                            ->label('Lote')
                            ->maxLength(30),
                    ])
                    ->columns(2),

                Section::make('Información Adicional')
                    ->schema(self::dynamicFields())
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('propertyRecordNumber')
                    ->label('Expediente')
                    ->searchable()
                    ->sortable(),
                 TextColumn::make('ResidentialDevelopment.short_name')
                    ->label('Fraccionamiento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('area')
                    ->label('Terreno (m²)')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                TextColumn::make('builtArea')
                    ->label('Construcción (m²)')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                TextColumn::make('propertyType.description')
                    ->label('Tipo de Propiedad')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('propertyEstatusId')
                    ->label('Renta')
                    ->badge()
                    ->formatStateUsing(fn ($state) =>
                        $state == 1 ? 'Rentado' : 'No Rentado'
                    )
                    ->color(fn ($state) =>
                        $state == 1 ? 'success' : 'gray'
                    ),
                IconColumn::make('estatusId')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('propertyEstatusId')
                    ->label('Estatus de Renta')
                    ->options([
                        0 => 'No Rentado',
                        1 => 'Rentado',
                    ]),

                SelectFilter::make('estatusId')
                    ->label('Activo')
                    ->options([
                        1 => 'Activo',
                        0 => 'Inactivo',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            PropertyTaxesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    protected static function dynamicFields(): array
    {
        $template = Template::where('name', 'properties')
            ->with('fields')
            ->first();

        if (! $template) {
            return [];
        }

        return $template->fields->map(function ($field) {

            return match ($field->type) {

                'text' => TextInput::make("dynamic_data.{$field->name}")
                    ->label($field->label)
                    ->required($field->required),

                'number' => TextInput::make("dynamic_data.{$field->name}")
                    ->label($field->label)
                    ->numeric()
                    ->required($field->required),

                'date' => DatePicker::make("dynamic_data.{$field->name}")
                    ->label($field->label)
                    ->required($field->required),

                'checkbox' => Toggle::make("dynamic_data.{$field->name}")
                    ->label($field->label),

                'select' => Select::make("dynamic_data.{$field->name}")
                    ->label($field->label)
                    ->options(array_combine($field->options ?? [], $field->options ?? []))
                    ->required($field->required),

                default => null,
            };

        })->filter()->toArray();
    }
    
    

}
