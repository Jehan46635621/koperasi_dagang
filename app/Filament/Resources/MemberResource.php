<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Keanggotaan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('member_number')
                            ->label('Nomor Anggota')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\Select::make('member_type_id')
                            ->label('Jenis Anggota')
                            ->relationship('memberType', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('branch_id')
                            ->label('Cabang')
                            ->relationship('branch', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'suspended' => 'Ditangguhkan',
                            ])
                            ->required()
                            ->default('active'),
                    ])->columns(2),

                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK (KTP)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->length(16)
                            ->numeric(),
                        Forms\Components\TextInput::make('npwp')
                            ->label('NPWP')
                            ->maxLength(20),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\TextInput::make('birth_place')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\Select::make('marital_status')
                            ->label('Status Perkawinan')
                            ->options([
                                'single' => 'Belum Menikah',
                                'married' => 'Menikah',
                                'divorced' => 'Cerai',
                                'widowed' => 'Duda/Janda',
                            ])
                            ->required(),
                        Forms\Components\Select::make('religion')
                            ->label('Agama')
                            ->options([
                                'islam' => 'Islam',
                                'christian' => 'Kristen',
                                'catholic' => 'Katolik',
                                'hindu' => 'Hindu',
                                'buddha' => 'Buddha',
                                'confucius' => 'Konghucu',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('city')
                            ->label('Kota')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('province')
                            ->label('Provinsi')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('Kode Pos')
                            ->maxLength(10),
                    ])->columns(3),

                Forms\Components\Section::make('Informasi Pekerjaan')
                    ->schema([
                        Forms\Components\TextInput::make('occupation')
                            ->label('Pekerjaan')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('employer_name')
                            ->label('Nama Perusahaan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('employee_id')
                            ->label('NIP/ID Karyawan')
                            ->maxLength(50),
                        Forms\Components\Textarea::make('employer_address')
                            ->label('Alamat Perusahaan')
                            ->rows(2),
                        Forms\Components\TextInput::make('monthly_income')
                            ->label('Pendapatan per Bulan')
                            ->numeric()
                            ->prefix('Rp'),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak Darurat')
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name')
                            ->label('Nama Kontak Darurat')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergency_contact_relation')
                            ->label('Hubungan')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('emergency_contact_phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(20),
                    ])->columns(3),

                Forms\Components\Section::make('Tanggal Penting')
                    ->schema([
                        Forms\Components\DatePicker::make('join_date')
                            ->label('Tanggal Bergabung')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now()),
                        Forms\Components\DatePicker::make('resign_date')
                            ->label('Tanggal Keluar')
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
                Tables\Columns\TextColumn::make('member_number')
                    ->label('No. Anggota')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('memberType.name')
                    ->label('Jenis Anggota')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Cabang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'gray',
                        'suspended' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('join_date')
                    ->label('Tgl Bergabung')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'suspended' => 'Ditangguhkan',
                    ]),
                Tables\Filters\SelectFilter::make('member_type_id')
                    ->label('Jenis Anggota')
                    ->relationship('memberType', 'name')
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
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
