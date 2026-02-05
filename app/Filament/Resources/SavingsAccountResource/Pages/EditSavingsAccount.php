<?php

namespace App\Filament\Resources\SavingsAccountResource\Pages;

use App\Filament\Resources\SavingsAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSavingsAccount extends EditRecord
{
    protected static string $resource = SavingsAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
