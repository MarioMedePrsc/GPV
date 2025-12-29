<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractRequestResource\Pages;
use App\Models\ContractRequest;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Exports\ContractRequestTemplateExport;
use Filament\Tables\Actions\Action;



class ContractRequestResource extends Resource
{
    protected static ?string $model = ContractRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Solicitudes de Contrato';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?string $pluralModelLabel = 'Solicitudes de Contrato';
    protected static ?string $modelLabel = 'Solicitud de Contrato';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /* =============================
                 * DATOS GENERALES
                 * ============================= */
                Forms\Components\Section::make('Datos Generales')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'description')
                            ->label('Proyecto')
                            ->required(),

                        Forms\Components\TextInput::make('commercial_activity')
                            ->label('Giro Comercial'),

                        Forms\Components\DatePicker::make('request_date')
                            ->label('Fecha de solicitud'),
                    ])
                    ->columns(3),

                /* =============================
                 * PERSONA MORAL
                 * ============================= */
                Forms\Components\Section::make('Persona Moral')
                    ->schema([
                        Forms\Components\Checkbox::make('pm_constitutive_act')->label('Acta constitutiva con inscripción RPP'),
                        Forms\Components\Checkbox::make('pm_legal_power')->label('Poder del representante legal con inscripción RPP'),
                        Forms\Components\Checkbox::make('pm_official_id')->label('Identificación oficial vigente'),
                        Forms\Components\Checkbox::make('pm_address_proof')->label('Comprobante de domicilio (≤ 3 meses)'),
                        Forms\Components\Checkbox::make('pm_rfc')->label('RFC'),
                        Forms\Components\Checkbox::make('pm_bank_statement')->label('Estado de cuenta bancario'),
                        Forms\Components\Checkbox::make('pm_other')->label('Otro'),
                    ])
                    ->columns(3),

                /* =============================
                 * PERSONA FÍSICA
                 * ============================= */
                Forms\Components\Section::make('Persona Física')
                    ->schema([
                        Forms\Components\Checkbox::make('pf_official_id')->label('Identificación oficial vigente'),
                        Forms\Components\Checkbox::make('pf_address_proof')->label('Comprobante de domicilio (≤ 3 meses)'),
                        Forms\Components\Checkbox::make('pf_rfc')->label('RFC'),
                        Forms\Components\Checkbox::make('pf_bank_statement')->label('Estado de cuenta bancario'),
                        Forms\Components\Checkbox::make('pf_other')->label('Otro'),
                    ])
                    ->columns(3),

                /* =============================
                 * CONTACTO
                 * ============================= */
                Forms\Components\Section::make('Datos de Contacto')
                    ->schema([
                        Forms\Components\TextInput::make('contact_name')->label('Nombre de contacto'),
                        Forms\Components\TextInput::make('email')->label('Correo electrónico'),
                        Forms\Components\TextInput::make('phone')->label('Teléfono'),
                    ])
                    ->columns(3),

                /* =============================
                 * GARANTÍA
                 * ============================= */
                Forms\Components\Section::make('Garantía del Arrendamiento')
                    ->schema([
                        Forms\Components\Select::make('guarantee_type')
                            ->label('Garantiza arrendamiento con')
                            ->options([
                                'propiedad' => 'Propiedad libre de gravamen',
                                'financieros' => 'Estados financieros',
                                'obligado' => 'Obligado solidario',
                                'anticipadas' => 'Rentas anticipadas',
                                'sin' => 'Sin garantía',
                            ]),

                        Forms\Components\TextInput::make('solidary_obligor_name')->label('Nombre del obligado solidario'),
                        Forms\Components\TextInput::make('property_deed')->label('Escritura de propiedad'),
                        Forms\Components\TextInput::make('guarantee_address')->label('Dirección de la garantía'),

                        Forms\Components\Checkbox::make('guarantee_official_id')->label('Identificación vigente'),
                        Forms\Components\Checkbox::make('guarantee_address_proof')->label('Comprobante de domicilio'),
                        Forms\Components\Checkbox::make('guarantee_property_deed')->label('Escritura de la propiedad en garantía'),
                    ])
                    ->columns(3),

                /* =============================
                 * PROPIETARIOS DEL INMUEBLE
                 * ============================= */
                Forms\Components\Section::make('Propietarios del Inmueble a Arrendar')
                    ->schema([
                        Forms\Components\Select::make('property_owners')
                            ->label('Propietarios')
                            ->multiple()
                            ->options(Client::query()->pluck('description', 'id'))
                            ->searchable(),

                        Forms\Components\Toggle::make('pactum_commissorium')
                            ->label('Pacto comisorio'),

                        Forms\Components\Toggle::make('rent_assignment_fimsa')
                            ->label('Cesión de renta a FIMSA'),
                    ])
                    ->columns(3),

                /* =============================
                 * INMUEBLE A ARRENDAR
                 * ============================= */
                Forms\Components\Section::make('Inmueble a Arrendar')
                    ->schema([
                        Forms\Components\TextInput::make('leased_property')->label('Inmueble a arrendar'),
                        Forms\Components\TextInput::make('purchase_deed')->label('Escritura de compraventa'),
                        Forms\Components\TextInput::make('cadastral_file')->label('Expediente catastral'),
                        Forms\Components\TextInput::make('total_area')->numeric()->label('Superficie total'),
                        Forms\Components\TextInput::make('leased_area')->numeric()->label('Superficie en arrendamiento'),
                        Forms\Components\TextInput::make('property_address')->label('Domicilio del inmueble'),
                    ])
                    ->columns(3),

                /* =============================
                 * CONDICIONES ECONÓMICAS
                 * ============================= */
                Forms\Components\Section::make('Condiciones Económicas')
                    ->schema([
                        Forms\Components\Checkbox::make('first_contract')->label('Primer contrato'),
                        Forms\Components\Checkbox::make('renewal')->label('Renovación'),

                        Forms\Components\TextInput::make('monthly_rent')->numeric()->label('Renta mensual'),
                        Forms\Components\TextInput::make('previous_rent')->numeric()->label('Renta anterior'),
                        Forms\Components\TextInput::make('price_per_m2')->numeric()->label('Precio por m²'),
                        Forms\Components\TextInput::make('increase_percentage')->numeric()->label('Porcentaje de incremento'),
                        Forms\Components\TextInput::make('price_list_reference')->numeric()->label('Referencia lista de precios'),
                        Forms\Components\TextInput::make('maintenance_fee')->numeric()->label('Cuota de mantenimiento'),
                        Forms\Components\Toggle::make('meets_minimum_authorized')->label('Cumple mínimo autorizado'),
                    ])
                    ->columns(3),

                /* =============================
                 * PLAZOS E INCREMENTOS
                 * ============================= */
                Forms\Components\Section::make('Plazos e Incrementos')
                    ->schema([
                        Forms\Components\TextInput::make('term')->label('Vigencia'),
                        Forms\Components\Toggle::make('extension')->label('Prórroga'),
                        Forms\Components\Toggle::make('automatic_extension')->label('Automática'),
                        Forms\Components\TextInput::make('mandatory_term')->label('Plazo forzoso'),
                        Forms\Components\TextInput::make('tenant_mandatory_term')->label('Plazo forzoso arrendatario'),
                        Forms\Components\TextInput::make('annual_increase')->label('Incremento anual'),
                        Forms\Components\TextInput::make('increase_from')->label('Incremento a partir de'),
                        Forms\Components\TextInput::make('additional_increase')->label('Incremento adicional'),
                        Forms\Components\TextInput::make('increase_when')->label('Cuándo'),
                    ])
                    ->columns(3),

                /* =============================
                 * FECHAS Y DEPÓSITOS
                 * ============================= */
                Forms\Components\Section::make('Fechas y Depósitos')
                    ->schema([
                        Forms\Components\DatePicker::make('contract_signing_date')->label('Fecha de firma de contrato'),
                        Forms\Components\TextInput::make('security_deposit_months')->numeric()->label('Depósito en garantía (meses)'),
                        Forms\Components\TextInput::make('advance_rent_months')->numeric()->label('Renta anticipada (meses)'),
                        Forms\Components\DatePicker::make('rent_payment_start')->label('Inicio de pago de renta'),
                        Forms\Components\TextInput::make('grace_period_months')->numeric()->label('Periodo de gracia (meses)'),
                        Forms\Components\Toggle::make('meets_pg_table')->label('Cumple tabla autorizada PG'),
                        Forms\Components\TextInput::make('pg_start_when')->label('Cuándo inicia PG'),
                    ])
                    ->columns(3),

                /* =============================
                 * CONDICIONES LEGALES
                 * ============================= */
                Forms\Components\Section::make('Condiciones Legales')
                    ->schema([
                        Forms\Components\Toggle::make('delivery_act_required')->label('Firmar acta de entrega'),
                        Forms\Components\Toggle::make('proportional_property_tax')->label('Paga predial proporcional'),

                        Forms\Components\Select::make('right_of_first_refusal')
                            ->label('Derecho de preferencia en venta')
                            ->options([
                                'no_no_aviso' => 'No tiene derecho, no se le avisa',
                                'no_si_aviso' => 'No tiene derecho, sí se le avisa',
                                'si_no_aviso' => 'Sí tiene derecho, no aplica entre filiales GP, no se le avisa',
                                'si_si_aviso' => 'Sí tiene derecho, no aplica entre filiales GP, sí se le avisa',
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.description')->label('Proyecto'),
                Tables\Columns\TextColumn::make('contact_name')->label('Contacto'),
                Tables\Columns\TextColumn::make('email')->label('Correo'),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha')->date(),
            ])
            
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('exportar_excel')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn ($record) => ContractRequestTemplateExport::download($record)),
                    
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContractRequests::route('/'),
            'create' => Pages\CreateContractRequest::route('/create'),
            'edit' => Pages\EditContractRequest::route('/{record}/edit'),
        ];
    }
}
