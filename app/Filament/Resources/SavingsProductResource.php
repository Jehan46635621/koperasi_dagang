<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SavingsProductResource\Pages;
use App\Filament\Resources\SavingsProductResource\RelationManagers;
use App\Models\SavingsProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SavingsProductResource extends Resource
{
    protected static ?string $model = SavingsProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Simpanan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Produk')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Kode Produk')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('product_type')
                            ->label('Jenis Produk')
                            ->options([
                                'savings' => 'Simpanan Biasa',
                                'deposit' => 'Simpanan Berjangka',
                                'voluntary' => 'Simpanan Sukarela',
                                'mandatory' => 'Simpanan Wajib',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan Keuangan')
                    ->schema([
                        Forms\Components\TextInput::make('minimum_balance')
                            ->label('Saldo Minimum')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('minimum_deposit')
                            ->label('Setoran Minimum')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('minimum_withdrawal')
                            ->label('Penarikan Minimum')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('maximum_withdrawal_per_day')
                            ->label('Batas Penarikan per Hari')
                            ->numeric()
                            ->prefix('Rp'),
                    ])->columns(2),

                Forms\Components\Section::make('Bunga')
                    ->schema([
                        Forms\Components\TextInput::make('interest_rate')
                            ->label('Suku Bunga (% per tahun)')
                            ->numeric()
                            ->suffix('%')
                            ->default(0),
                        Forms\Components\Select::make('interest_calculation_method')
                            ->label('Metode Perhitungan Bunga')
                            ->options([
                                'daily' => 'Harian',
                                'monthly' => 'Bulanan',
                                'annual' => 'Tahunan',
                            ])
                            ->default('monthly'),
                        Forms\Components\Toggle::make('auto_credit_interest')
                            ->label('Otomatis Kredit Bunga')
                            ->default(false),
                    ])->columns(3),

                Forms\Components\Section::make('Deskripsi')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'savings' => 'Simpanan Biasa',
                        'deposit' => 'Simpanan Berjangka',
                        'voluntary' => 'Simpanan Sukarela',
                        'mandatory' => 'Simpanan Wajib',
                    }),
                Tables\Columns\TextColumn::make('interest_rate')
                    ->label('Bunga')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('minimum_balance')
                    ->label('Saldo Min')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_type')
                    ->label('Jenis Produk')
                    ->options([
                        'savings' => 'Simpanan Biasa',
                        'deposit' => 'Simpanan Berjangka',
                        'voluntary' => 'Simpanan Sukarela',
                        'mandatory' => 'Simpanan Wajib',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListSavingsProducts::route('/'),
            'create' => Pages\CreateSavingsProduct::route('/create'),
            'edit' => Pages\EditSavingsProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
