<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicalRequestResource\Pages;
use App\Models\TechnicalRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Exports\TechnicalRequestTemplateExport;
use Filament\Tables\Actions\Action;

class TechnicalRequestResource extends Resource
{
    protected static ?string $model = TechnicalRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Solicitudes Técnicas';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?string $pluralModelLabel = 'Solicitudes Técnicas';
    protected static ?string $modelLabel = 'Solicitud Técnica';

    public static function form(Form $form): Form
    {
        return $form->schema([

            /* ======================================================
             * DATOS GENERALES
             * ====================================================== */
            Forms\Components\Section::make('Datos Generales')
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('project_id')
                        ->relationship('project', 'description')
                        ->label('Proyecto')
                        ->required(),

                    Forms\Components\Select::make('land_status')
                        ->label('Estatus del predio')
                        ->options([
                            'fuera_tramite' => 'Área fuera de trámite',
                            'lote_comercial' => 'Lote Comercial',
                        ]),

                    Forms\Components\Select::make('consideration')
                        ->label('Debe considerarse')
                        ->options([
                            'lote_unico' => 'Lote único donde se establecerá el negocio',
                            'fraccion' => 'Renta de una fracción de un predio',
                            'varios_predios' => 'Renta de más de un predio',
                            'local_comercial' => 'Renta de local comercial',
                            'pad' => 'Renta de pad',
                        ]),

                    Forms\Components\Toggle::make('paid_7_percent')
                        ->label('¿Está pagado el 7%?'),

                    Forms\Components\TextInput::make('paid_7_percent_time')
                        ->label('Tiempo estimado para pagarlo'),
                ]),

            /* ======================================================
             * ELECTRICIDAD
             * ====================================================== */
            Forms\Components\Section::make('Electricidad')
                ->columns(2)
                ->schema([
                    Forms\Components\Toggle::make('electric_infrastructure')
                        ->label('¿Existe infraestructura frente al predio?'),

                    Forms\Components\TextInput::make('electric_time')
                        ->label('Tiempo estimado para contar con infraestructura'),
                ]),

            /* ======================================================
             * AGUA Y DRENAJE
             * ====================================================== */
            Forms\Components\Section::make('Agua y Drenaje')
                ->columns(2)
                ->schema([
                    Forms\Components\Toggle::make('water_infrastructure')
                        ->label('¿Existe infraestructura frente al predio?'),

                    Forms\Components\Toggle::make('ayd_incorporation_paid')
                        ->label('¿Está pagada la incorporación AyD?'),

                    Forms\Components\Toggle::make('ayd_contribution_paid')
                        ->label('¿Está pagada la aportación AyD?'),

                    Forms\Components\Toggle::make('ayd_feasibility_required')
                        ->label('¿Se debe tramitar factibilidad?'),

                    Forms\Components\TextInput::make('ayd_feasibility_time')
                        ->label('Tiempo para tramitarla'),
                ]),

            /* ======================================================
             * GESTIONES REQUERIDAS
             * ====================================================== */
            Forms\Components\Section::make('Gestiones Requeridas')
                ->columns(2)
                ->schema([
                    Forms\Components\Toggle::make('glg')->label('GLG'),
                    Forms\Components\TextInput::make('glg_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('road_alignment')->label('Alineamiento vial'),
                    Forms\Components\TextInput::make('road_alignment_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('land_marking')->label('Amojonamiento'),
                    Forms\Components\TextInput::make('land_marking_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('licenses')->label('Licencias'),
                    Forms\Components\TextInput::make('licenses_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('fusion')->label('Fusión'),
                    Forms\Components\TextInput::make('fusion_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('subdivision')->label('Subdivisión'),
                    Forms\Components\TextInput::make('subdivision_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('land_use')->label('Uso de suelo'),
                    Forms\Components\TextInput::make('land_use_time')->label('Tiempo estimado'),

                    Forms\Components\Toggle::make('environmental_studies')->label('Estudios ambientales'),
                    Forms\Components\TextInput::make('environmental_studies_time')->label('Tiempo estimado'),
                ]),

            /* ======================================================
             * NOTAS
             * ====================================================== */
            Forms\Components\Section::make('Notas y Alcances')
                ->schema([
                    Forms\Components\Textarea::make('notes')
                        ->label('Notas')
                        ->rows(3),

                    Forms\Components\Textarea::make('additional_works')
                        ->label('Obras y alcances adicionales')
                        ->rows(3),
                ]),

            /* ======================================================
             * ANEXOS TÉCNICOS
             * ====================================================== */
            Forms\Components\Section::make('Anexos Técnicos para el Contrato')
                ->columns(3)
                ->schema([
                    Forms\Components\Checkbox::make('leased_polygon')->label('Poligonal arrendada'),
                    Forms\Components\Checkbox::make('prohibited_uses')->label('Giros prohibidos'),
                    Forms\Components\Checkbox::make('restrictions')->label('Restricciones'),
                    Forms\Components\Checkbox::make('work_obligations')->label('Obligaciones de obra'),
                    Forms\Components\Checkbox::make('site_plan')->label('Planta de conjunto'),
                    Forms\Components\Checkbox::make('property_detail')->label('Detalle del predio'),
                    Forms\Components\Checkbox::make('other_attachment')->label('Otro'),
                ]),

            /* ======================================================
             * ASPECTOS ADMINISTRATIVOS
             * ====================================================== */
            Forms\Components\Section::make('Aspectos Administrativos')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('client_identifier')->label('Identificador del cliente'),
                    Forms\Components\TextInput::make('billing_name')->label('Razón social para facturación'),
                    Forms\Components\TextInput::make('rfc')->label('RFC'),
                    Forms\Components\Textarea::make('fiscal_address')->label('Domicilio fiscal'),

                    Forms\Components\TextInput::make('business_activity')->label('Giro'),
                    Forms\Components\TextInput::make('trade_name')->label('Nombre comercial'),

                    Forms\Components\TextInput::make('bank_key')->label('Clave bancaria'),
                    Forms\Components\TextInput::make('bank')->label('Banco'),
                    Forms\Components\TextInput::make('rent_payment_account')->label('Cuenta para pago de rentas'),

                    Forms\Components\DatePicker::make('estimated_signing_date')->label('Fecha estimada de firma'),

                    Forms\Components\TextInput::make('grace_period_months')->numeric()->label('Periodo de gracia (meses)'),
                    Forms\Components\TextInput::make('advance_rent_months')->numeric()->label('Renta anticipada (meses)'),
                    Forms\Components\TextInput::make('advance_rent_amount')->numeric()->label('Renta anticipada ($)'),

                    Forms\Components\DatePicker::make('rent_start_date')->label('Inicio de cobro de renta'),

                    Forms\Components\TextInput::make('deposit_months')->numeric()->label('Depósito en garantía (meses)'),
                    Forms\Components\TextInput::make('deposit_amount')->numeric()->label('Depósito en garantía ($)'),

                    Forms\Components\Textarea::make('commercial_exception')
                        ->label('Excepción comercial')
                        ->rows(2),
                ]),

            /* ======================================================
             * CONTACTO
             * ====================================================== */
            Forms\Components\Section::make('Datos de Contacto')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('contact_name')->label('Nombre del contacto'),
                    Forms\Components\TextInput::make('contact_email')->label('Correo electrónico'),
                    Forms\Components\TextInput::make('contact_phone')->label('Teléfono celular'),

                    Forms\Components\Toggle::make('internal_lead')->label('Lead interno'),
                    Forms\Components\Toggle::make('broker_operation')->label('Operación con broker'),
                    Forms\Components\TextInput::make('commission_conditions')->label('Condiciones de la comisión'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.description')->label('Proyecto')->searchable(),
                Tables\Columns\IconColumn::make('paid_7_percent')->boolean()->label('7% Pagado'),
                Tables\Columns\TextColumn::make('created_at')->date()->label('Creado'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('exportar_excel')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn ($record) => TechnicalRequestTemplateExport::download($record)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTechnicalRequests::route('/'),
            'create' => Pages\CreateTechnicalRequest::route('/create'),
            'edit' => Pages\EditTechnicalRequest::route('/{record}/edit'),
        ];
    }
}
