<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LegalCoverResource\Pages;
use App\Models\LegalCover;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Exports\LegalCoverTemplateExport;
use Filament\Tables\Actions\Action;

class LegalCoverResource extends Resource
{
    protected static ?string $model = LegalCover::class;
    protected static ?string $navigationLabel = 'Carátula Legal';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form->schema([

            /* ===================== GENERALES ===================== */
            Forms\Components\Section::make('Datos Generales')->schema([
                Forms\Components\Select::make('project_id')
                            ->relationship('project', 'description')
                            ->label('Proyecto')
                            ->required(),
                Forms\Components\DatePicker::make('fecha')->label('Fecha'),
                Forms\Components\TextInput::make('nombre_contrato')->label('Nombre del Contrato'),
                Forms\Components\TextInput::make('finalidad')->label('Finalidad'),
            ])->columns(2),

            /* ===================== CARÁTULA CONTRATO ===================== */
            Forms\Components\Section::make('Carátula del Contrato')->schema([
                Forms\Components\DatePicker::make('fecha_firma')->label('Fecha de Firma'),
                Forms\Components\TextInput::make('arrendadora')->label('Arrendadora'),
                Forms\Components\TextInput::make('arrendataria')->label('Arrendataria'),
                Forms\Components\TextInput::make('obligado_solidario')->label('Obligado Solidario'),
                Forms\Components\TextInput::make('cesionario_renta')->label('Cesionario de Renta'),
            ])->columns(2),

            /* ===================== CONDICIONES ===================== */
            Forms\Components\Section::make('Condiciones')->schema([
                Forms\Components\TextInput::make('objeto')->label('Objeto'),
                Forms\Components\TextInput::make('expediente_catastral')->label('Expediente Catastral'),
                Forms\Components\TextInput::make('fraccionamiento')->label('Fraccionamiento'),
                Forms\Components\TextInput::make('municipio')->label('Municipio'),
                Forms\Components\TextInput::make('estado')->label('Estado'),

                Forms\Components\TextInput::make('superficie_terreno')->numeric()->label('Superficie del Terreno (m²)'),
                Forms\Components\TextInput::make('superficie_construccion')->numeric()->label('Superficie de Construcción (m²)'),

                Forms\Components\TextInput::make('renta_m2')->numeric()->label('Renta por m² (sin IVA)'),
                Forms\Components\TextInput::make('renta_mensual')->numeric()->label('Renta Mensual'),
                Forms\Components\Toggle::make('renta_mensual_iva')->label('Renta Mensual Aplica IVA'),

                Forms\Components\TextInput::make('renta_porcentaje')->numeric()->label('Renta sobre Porcentaje'),
                Forms\Components\Toggle::make('porcentaje_incluye_ecommerce')->label('Incluye E-commerce'),

                Forms\Components\TextInput::make('indexacion')->label('Indexación'),
                Forms\Components\DatePicker::make('fecha_inicio_indexacion')->label('Inicio de Indexación'),

                Forms\Components\TextInput::make('periodo_gracia_meses')->numeric()->label('Periodo de Gracia (meses)'),
                Forms\Components\TextInput::make('inicio_periodo_gracia')->label('Inicio Periodo de Gracia'),
                Forms\Components\DatePicker::make('fecha_inicio_gracia')->label('Fecha Inicio Gracia'),

                Forms\Components\TextInput::make('vigencia_contrato_anios')->numeric()->label('Vigencia del Contrato (años)'),
                Forms\Components\DatePicker::make('inicio_vigencia')->label('Inicio de Vigencia'),

                Forms\Components\TextInput::make('plazo_forzoso_arrendador')->numeric()->label('Plazo Forzoso Arrendador'),
                Forms\Components\TextInput::make('plazo_forzoso_arrendataria')->numeric()->label('Plazo Forzoso Arrendataria'),

                Forms\Components\TextInput::make('prorroga_vigencia')->numeric()->label('Prórroga de Vigencia'),
                Forms\Components\TextInput::make('tipo_prorroga')->label('Tipo de Prórroga'),
                Forms\Components\TextInput::make('plazo_solicitud_prorroga_dias')->numeric()->label('Plazo Solicitud Prórroga (días)'),
                Forms\Components\TextInput::make('incremento_renta_prorroga')->label('Incremento de Renta en Prórroga'),

                Forms\Components\Toggle::make('riesgo_no_pago')->label('Riesgo de No Pago'),
                Forms\Components\DatePicker::make('fecha_entrega_posesion')->label('Entrega de Posesión'),

                Forms\Components\TextInput::make('responsable_licencias')->label('Responsable de Licencias'),
                Forms\Components\DatePicker::make('fecha_entrega_licencias')->label('Entrega de Licencias'),

                Forms\Components\TextInput::make('mantenimiento')->label('Mantenimiento (sin IVA)'),
                Forms\Components\TextInput::make('indexacion_mantenimiento')->label('Indexación Mantenimiento'),
            ])->columns(2),

            /* ===================== RIESGOS ECONÓMICOS ===================== */
            Forms\Components\Section::make('Riesgos Económicos')->schema([
                Forms\Components\TextInput::make('deposito_meses')->numeric()->label('Depósito en Garantía (meses)'),
                Forms\Components\TextInput::make('cantidad_deposito')->numeric()->label('Cantidad Depósito'),
                Forms\Components\TextInput::make('actualizacion_deposito')->label('Actualización Depósito'),

                Forms\Components\TextInput::make('renta_anticipada_meses')->numeric()->label('Renta Anticipada (meses)'),
                Forms\Components\TextInput::make('cantidad_renta_anticipada')->numeric()->label('Cantidad Renta Anticipada'),
                Forms\Components\TextInput::make('tasa_moratoria')->numeric()->label('Tasa Moratoria Mensual'),
            ])->columns(2),

            /* ===================== MITIGACIÓN ===================== */
            Forms\Components\Section::make('Mitigación de Riesgos')->schema([
                Forms\Components\TextInput::make('giro_negocio')->label('Giro de Negocio'),
                Forms\Components\Toggle::make('riesgo_distancia')->label('Riesgo por Distancia'),
                Forms\Components\TextInput::make('distancia_vivienda')->label('Distancia a Vivienda'),
                Forms\Components\Toggle::make('riesgo_olores')->label('Riesgo de Olores'),
                Forms\Components\TextInput::make('visto_bueno_ventas')->label('Visto Bueno Ventas'),
                Forms\Components\Toggle::make('riesgo_trafico')->label('Riesgo de Tráfico'),
                Forms\Components\TextInput::make('visto_bueno_proyectos')->label('Visto Bueno Proyectos'),
                Forms\Components\Toggle::make('riesgo_residuos')->label('Riesgo Residuos'),
                Forms\Components\Toggle::make('remediacion_suelo')->label('Remediación Suelo'),
                Forms\Components\Toggle::make('riesgo_contaminacion')->label('Riesgo Contaminación'),
                Forms\Components\Toggle::make('seguro_obligatorio')->label('Seguro Obligatorio'),
                Forms\Components\Toggle::make('disminucion_renta')->label('Disminución de Renta'),
                Forms\Components\TextInput::make('supuesto_disminucion')->label('Supuesto Disminución'),
                Forms\Components\Toggle::make('giros_prohibidos')->label('Giros Prohibidos'),
                Forms\Components\TextInput::make('listado_giros_prohibidos')->label('Listado Giros Prohibidos'),
                Forms\Components\TextInput::make('lotes_giros_prohibidos')->label('Lotes Afectados'),
                Forms\Components\Toggle::make('exclusividad_giros')->label('Exclusividad de Giros'),
                Forms\Components\TextInput::make('lotes_exclusividad')->label('Lotes Exclusividad'),
                Forms\Components\TextInput::make('giros_exclusivos')->label('Giros Exclusivos'),
                Forms\Components\Toggle::make('incumple_exclusivos')->label('Incumple Giros'),
                Forms\Components\TextInput::make('estado_devolucion')->label('Estado Devolución'),
            ])->columns(2),

            /* ===================== CONSTRUCCIÓN ===================== */
            Forms\Components\Section::make('Construcción por GP')->schema([
                Forms\Components\Toggle::make('gp_construye')->label('GP Construye'),
                Forms\Components\TextInput::make('superficie_construir')->numeric()->label('Superficie a Construir'),
                Forms\Components\Toggle::make('incluye_estacionamiento')->label('Incluye Estacionamiento'),
                Forms\Components\Toggle::make('servicio_agua')->label('Servicio Agua y Drenaje'),
                Forms\Components\Toggle::make('administra_agua')->label('GP Administra Agua'),
                Forms\Components\Toggle::make('servicio_electricidad')->label('Servicio Electricidad'),
                Forms\Components\Toggle::make('preparacion_electrica')->label('Preparación Eléctrica'),
                Forms\Components\DatePicker::make('fecha_entrega_inmueble')->label('Entrega Inmueble'),
                Forms\Components\Toggle::make('entrega_parcial')->label('Entrega Parcial'),
                Forms\Components\Toggle::make('terminacion_por_no_entrega')->label('Terminación por No Entrega'),
                Forms\Components\TextInput::make('licencias_a_cargo')->label('Licencias a Cargo'),
                Forms\Components\Toggle::make('construccion_totem')->label('Construcción de Tótem'),
                Forms\Components\TextInput::make('posicion_rotulo')->label('Posición del Rótulo'),
            ])->columns(2),

            /* ===================== OBLIGACIONES ===================== */
            Forms\Components\Section::make('Obligaciones de la Arrendataria')->schema([
                Forms\Components\Toggle::make('entrega_planos')->label('Entrega de Planos'),
                Forms\Components\DatePicker::make('fecha_entrega_planos')->label('Fecha Entrega Planos'),
            ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nombre_contrato')->searchable(),
                Tables\Columns\TextColumn::make('arrendataria')->searchable(),
                Tables\Columns\TextColumn::make('fecha_firma')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                 Action::make('exportar_excel')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn ($record) => LegalCoverTemplateExport::download($record)),
                    
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLegalCovers::route('/'),
            'create' => Pages\CreateLegalCover::route('/create'),
            'edit' => Pages\EditLegalCover::route('/{record}/edit'),
        ];
    }
}
