<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanProductResource\Pages;
use App\Filament\Resources\LoanProductResource\RelationManagers;
use App\Models\LoanProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LoanProductResource extends Resource
{
    protected static ?string $model = LoanProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Product Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('e.g., LP-001')
                            ->hint('Unique identifier for the loan product'),
                        
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('type')
                            ->options([
                                'productive' => 'Productive',
                                'consumptive' => 'Consumptive',
                                'emergency' => 'Emergency',
                                'vehicle' => 'Vehicle',
                                'housing' => 'Housing',
                            ])
                            ->default('consumptive')
                            ->required(),
                        
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull()
                            ->maxLength(500),
                    ]),

                Forms\Components\Section::make('Interest Configuration')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('interest_rate')
                            ->label('Interest Rate (%)')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0),
                        
                        Forms\Components\Select::make('interest_calculation_method')
                            ->options([
                                'flat' => 'Flat',
                                'effective' => 'Effective',
                                'declining_balance' => 'Declining Balance',
                            ])
                            ->default('flat')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Loan Limits')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('minimum_amount')
                            ->label('Minimum Amount')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0)
                            ->prefix('Rp'),
                        
                        Forms\Components\TextInput::make('maximum_amount')
                            ->label('Maximum Amount')
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0)
                            ->prefix('Rp')
                            ->nullable(),
                        
                        Forms\Components\TextInput::make('minimum_term_months')
                            ->label('Minimum Term (Months)')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1),
                        
                        Forms\Components\TextInput::make('maximum_term_months')
                            ->label('Maximum Term (Months)')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(60),
                    ]),

                Forms\Components\Section::make('Fees & Penalties')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('administration_fee_rate')
                            ->label('Administration Fee (%)')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0)
                            ->default(0),
                        
                        Forms\Components\TextInput::make('insurance_fee_rate')
                            ->label('Insurance Fee (%)')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0)
                            ->default(0),
                        
                        Forms\Components\TextInput::make('late_payment_penalty_rate')
                            ->label('Late Payment Penalty (% per day)')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0)
                            ->default(0),
                        
                        Forms\Components\TextInput::make('late_payment_fine_amount')
                            ->label('Late Payment Fine Amount')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->minValue(0)
                            ->default(0)
                            ->prefix('Rp'),
                    ]),

                Forms\Components\Section::make('Collateral & Approval')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('requires_collateral')
                            ->label('Requires Collateral')
                            ->default(false),
                        
                        Forms\Components\Textarea::make('collateral_requirements')
                            ->label('Collateral Requirements')
                            ->columnSpanFull()
                            ->maxLength(500)
                            ->nullable(),
                        
                        Forms\Components\Toggle::make('requires_committee_approval')
                            ->label('Requires Committee Approval')
                            ->default(true),
                        
                        Forms\Components\TextInput::make('max_approval_days')
                            ->label('Max Approval Days')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(7),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'productive',
                        'success' => 'consumptive',
                        'warning' => 'emergency',
                        'info' => 'vehicle',
                        'gray' => 'housing',
                    ]),
                
                Tables\Columns\TextColumn::make('interest_rate')
                    ->label('Interest (%)')
                    ->formatStateUsing(fn ($state) => number_format($state, 2, '.', ''))
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('minimum_amount')
                    ->label('Min Amount')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('maximum_amount')
                    ->label('Max Amount')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
                
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'productive' => 'Productive',
                        'consumptive' => 'Consumptive',
                        'emergency' => 'Emergency',
                        'vehicle' => 'Vehicle',
                        'housing' => 'Housing',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListLoanProducts::route('/'),
            'create' => Pages\CreateLoanProduct::route('/create'),
            'edit' => Pages\EditLoanProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}
