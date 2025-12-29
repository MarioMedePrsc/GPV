<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaseRecordResource\Pages;
use App\Models\LeaseRecord;
use App\Exports\LeaseRecordTemplateExport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\LeaseRecordResource\RelationManagers\DetailsRelationManager;

class LeaseRecordResource extends Resource
{
    protected static ?string $model = LeaseRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Ficha de Arrendamiento';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?string $pluralModelLabel = 'Fichas de Arrendamiento';
    protected static ?string $modelLabel = 'Ficha de Arrendamiento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | GENERALES
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Generales')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'description')
                            ->label('Proyecto')
                            ->required(),

                        Forms\Components\TextInput::make('lessor')
                            ->label('Arrendador'),

                        Forms\Components\TextInput::make('rent_assignment')
                            ->label('Cesión de renta'),

                        Forms\Components\TextInput::make('client_legal_name')
                            ->label('Razón social del cliente'),

                        Forms\Components\TextInput::make('trade_name')
                            ->label('Nombre comercial'),

                        Forms\Components\TextInput::make('subdivision')
                            ->label('Fraccionamiento'),

                        Forms\Components\TextInput::make('cadastral_file')
                            ->label('Expediente catastral'),

                        Forms\Components\TextInput::make('project_name')
                            ->label('Nombre del proyecto'),

                        Forms\Components\TextInput::make('location')
                            ->label('Ubicación'),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | DATOS DEL CONTRATO
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Datos del contrato')
                    ->schema([
                        Forms\Components\TextInput::make('enkontrol_contract_number')
                            ->label('No. contrato Enkontrol'),

                        Forms\Components\DatePicker::make('contract_sign_date')
                            ->label('Fecha de firma'),

                        Forms\Components\TextInput::make('contract_term_years')
                            ->label('Vigencia (años)')
                            ->numeric(),

                        Forms\Components\TextInput::make('grace_period_months')
                            ->label('Periodo de gracia (meses)')
                            ->numeric(),

                        Forms\Components\DatePicker::make('property_delivery_date')
                            ->label('Entrega del inmueble'),

                        Forms\Components\DatePicker::make('grace_period_start_date')
                            ->label('Inicio periodo de gracia'),

                        Forms\Components\DatePicker::make('grace_period_end_date')
                            ->label('Final periodo de gracia'),

                        Forms\Components\DatePicker::make('opening_date')
                            ->label('Fecha de apertura'),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | DETALLE DE ARRENDAMIENTO
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Detalle de arrendamiento')
                    ->schema([
                        Forms\Components\DatePicker::make('first_invoice_month')
                            ->label('Mes de la primera factura'),

                        Forms\Components\TextInput::make('leased_area_m2')
                            ->label('Superficie arrendada (m²)')
                            ->numeric(),

                        Forms\Components\TextInput::make('rent_mechanism')
                            ->label('Mecánica de renta'),

                        Forms\Components\TextInput::make('rent_update_month')
                            ->label('Mes de actualización'),

                        Forms\Components\TextInput::make('incp_month')
                            ->label('Mes INCP'),

                        Forms\Components\TextInput::make('total_rent_without_vat')
                            ->label('Renta total sin IVA')
                            ->numeric(),

                        Forms\Components\TextInput::make('vat_16_percent')
                            ->label('IVA 16%')
                            ->numeric(),

                        Forms\Components\TextInput::make('total_rent_with_vat')
                            ->label('Renta total con IVA')
                            ->numeric(),

                        Forms\Components\TextInput::make('rent_type')
                            ->label('Tipo de renta'),

                        Forms\Components\TextInput::make('staggered_rent')
                            ->label('Escalonada'),

                        Forms\Components\TextInput::make('price_per_m2')
                            ->label('Precio por m²')
                            ->numeric(),

                        Forms\Components\TextInput::make('annual_update_from')
                            ->label('Actualización anual a partir de'),

                        Forms\Components\TextInput::make('increase_mechanism')
                            ->label('Mecánica de incremento'),

                        Forms\Components\TextInput::make('update_factor')
                            ->label('Factor de actualización'),

                        Forms\Components\TextInput::make('updated_rent_to_invoice_without_vat')
                            ->label('Renta actualizada sin IVA'),

                        Forms\Components\TextInput::make('updated_vat_16_percent')
                            ->label('IVA 16% actualizado'),

                        Forms\Components\TextInput::make('updated_rent_to_invoice_with_vat')
                            ->label('Renta actualizada con IVA'),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | DEPÓSITO EN GARANTÍA
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Actualización de depósito en garantía (sin IVA)')
                    ->schema([
                        Forms\Components\TextInput::make('updated_security_deposit_amount')
                            ->label('Importe actualizado del depósito')
                            ->numeric(),

                        Forms\Components\TextInput::make('deposit_update_increase')
                            ->label('Incremento por actualización')
                            ->numeric(),

                        Forms\Components\DatePicker::make('security_deposit_date')
                            ->label('Fecha del depósito'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('project_name')->label('Proyecto')->searchable(),
                Tables\Columns\TextColumn::make('client_legal_name')->label('Cliente')->searchable(),
                Tables\Columns\TextColumn::make('contract_sign_date')->label('Firma')->date(),
                Tables\Columns\TextColumn::make('total_rent_with_vat')->label('Renta con IVA'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('export')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (LeaseRecord $record) {
                        $export = new LeaseRecordTemplateExport($record);
                        $filePath = $export->export();

                        return response()
                            ->download($filePath)
                            ->deleteFileAfterSend(true);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaseRecords::route('/'),
            'create' => Pages\CreateLeaseRecord::route('/create'),
            'edit' => Pages\EditLeaseRecord::route('/{record}/edit'),
        ];
    }
    public static function getRelations(): array
    {
        return [
            DetailsRelationManager::class,
        ];
    }
}
