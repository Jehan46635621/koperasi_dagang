<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SavingsAccountResource\Pages;
use App\Filament\Resources\SavingsAccountResource\RelationManagers;
use App\Models\SavingsAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SavingsAccountResource extends Resource
{
    protected static ?string $model = SavingsAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationGroup = 'Simpanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Rekening')
                    ->schema([
                        Forms\Components\TextInput::make('account_number')
                            ->label('Nomor Rekening')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\Select::make('member_id')
                            ->label('Anggota')
                            ->relationship('member', 'full_name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('savings_product_id')
                            ->label('Produk Simpanan')
                            ->relationship('savingsProduct', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('branch_id')
                            ->label('Cabang')
                            ->relationship('branch', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Saldo & Status')
                    ->schema([
                        Forms\Components\TextInput::make('current_balance')
                            ->label('Saldo Saat Ini')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->readOnly(),
                        Forms\Components\TextInput::make('total_interest')
                            ->label('Total Bunga')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0)
                            ->readOnly(),
                        Forms\Components\DatePicker::make('last_interest_date')
                            ->label('Tanggal Bunga Terakhir')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktif',
                                'dormant' => 'Tidak Aktif',
                                'blocked' => 'Diblokir',
                                'closed' => 'Ditutup',
                            ])
                            ->required()
                            ->default('active'),
                    ])->columns(2),

                Forms\Components\Section::make('Tanggal')
                    ->schema([
                        Forms\Components\DatePicker::make('opened_date')
                            ->label('Tanggal Buka')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                        Forms\Components\DatePicker::make('closed_date')
                            ->label('Tanggal Tutup')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account_number')
                    ->label('No. Rekening')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('member.full_name')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('member.member_number')
                    ->label('No. Anggota')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('savingsProduct.name')
                    ->label('Produk')
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Cabang')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('current_balance')
                    ->label('Saldo')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'dormant' => 'warning',
                        'blocked' => 'danger',
                        'closed' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('opened_date')
                    ->label('Tgl Buka')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'dormant' => 'Tidak Aktif',
                        'blocked' => 'Diblokir',
                        'closed' => 'Ditutup',
                    ]),
                Tables\Filters\SelectFilter::make('savings_product_id')
                    ->label('Produk Simpanan')
                    ->relationship('savingsProduct', 'name')
                    ->preload(),
                Tables\Filters\SelectFilter::make('branch_id')
                    ->label('Cabang')
                    ->relationship('branch', 'name')
                    ->preload(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListSavingsAccounts::route('/'),
            'create' => Pages\CreateSavingsAccount::route('/create'),
            'edit' => Pages\EditSavingsAccount::route('/{record}/edit'),
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
