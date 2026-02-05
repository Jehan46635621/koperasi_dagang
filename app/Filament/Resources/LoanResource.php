<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Pinjaman';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Peminjam')
                    ->schema([
                        Forms\Components\TextInput::make('loan_number')
                            ->label('Nomor Pinjaman')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\Select::make('member_id')
                            ->label('Anggota')
                            ->relationship('member', 'full_name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('loan_product_id')
                            ->label('Produk Pinjaman')
                            ->relationship('loanProduct', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->reactive(),
                        Forms\Components\Select::make('branch_id')
                            ->label('Cabang')
                            ->relationship('branch', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Pinjaman')
                    ->schema([
                        Forms\Components\TextInput::make('principal_amount')
                            ->label('Jumlah Pokok Pinjaman')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        Forms\Components\TextInput::make('interest_rate')
                            ->label('Suku Bunga (% per tahun)')
                            ->numeric()
                            ->suffix('%')
                            ->required(),
                        Forms\Components\Select::make('interest_method')
                            ->label('Metode Bunga')
                            ->options([
                                'flat' => 'Flat',
                                'reducing_balance' => 'Anuitas',
                                'effective' => 'Efektif',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('tenor_months')
                            ->label('Tenor (Bulan)')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('monthly_installment')
                            ->label('Angsuran per Bulan')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly(),
                        Forms\Components\TextInput::make('total_interest')
                            ->label('Total Bunga')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly(),
                    ])->columns(2),

                Forms\Components\Section::make('Biaya & Potongan')
                    ->schema([
                        Forms\Components\TextInput::make('admin_fee')
                            ->label('Biaya Admin')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('provision_fee')
                            ->label('Biaya Provisi')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('insurance_fee')
                            ->label('Biaya Asuransi')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('other_fees')
                            ->label('Biaya Lain')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        Forms\Components\TextInput::make('disbursement_amount')
                            ->label('Jumlah Pencairan')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly(),
                    ])->columns(2),

                Forms\Components\Section::make('Tanggal Penting')
                    ->schema([
                        Forms\Components\DatePicker::make('application_date')
                            ->label('Tanggal Pengajuan')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                        Forms\Components\DatePicker::make('approval_date')
                            ->label('Tanggal Disetujui')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('disbursement_date')
                            ->label('Tanggal Pencairan')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('first_payment_date')
                            ->label('Tanggal Angsuran Pertama')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('maturity_date')
                            ->label('Tanggal Jatuh Tempo')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                    ])->columns(2),

                Forms\Components\Section::make('Status & Approval')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'disbursed' => 'Dicairkan',
                                'active' => 'Aktif',
                                'completed' => 'Lunas',
                                'written_off' => 'Hapus Buku',
                            ])
                            ->required()
                            ->default('pending'),
                        Forms\Components\Select::make('approved_by')
                            ->label('Disetujui Oleh')
                            ->relationship('approver', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('purpose')
                            ->label('Tujuan Pinjaman')
                            ->rows(3)
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('loan_number')
                    ->label('No. Pinjaman')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('member.full_name')
                    ->label('Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('member.member_number')
                    ->label('No. Anggota')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('loanProduct.name')
                    ->label('Produk')
                    ->sortable(),
                Tables\Columns\TextColumn::make('principal_amount')
                    ->label('Pokok Pinjaman')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('remaining_balance')
                    ->label('Sisa Pinjaman')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('monthly_installment')
                    ->label('Angsuran')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'info',
                        'rejected' => 'danger',
                        'disbursed' => 'info',
                        'active' => 'success',
                        'completed' => 'success',
                        'written_off' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'disbursed' => 'Dicairkan',
                        'active' => 'Aktif',
                        'completed' => 'Lunas',
                        'written_off' => 'Hapus Buku',
                    }),
                Tables\Columns\TextColumn::make('application_date')
                    ->label('Tgl Pengajuan')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('disbursement_date')
                    ->label('Tgl Pencairan')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'disbursed' => 'Dicairkan',
                        'active' => 'Aktif',
                        'completed' => 'Lunas',
                        'written_off' => 'Hapus Buku',
                    ]),
                Tables\Filters\SelectFilter::make('loan_product_id')
                    ->label('Produk Pinjaman')
                    ->relationship('loanProduct', 'name')
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
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
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
