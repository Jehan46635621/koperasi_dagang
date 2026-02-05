<?php

namespace App\Filament\Resources\SavingsProductResource\Pages;

use App\Filament\Resources\SavingsProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSavingsProduct extends EditRecord
{
    protected static string $resource = SavingsProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
