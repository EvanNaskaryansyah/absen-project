<?php

namespace App\Filament\Resources\ConfigurationResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\ConfigurationResource;

class ManageConfigurations extends ManageRecords
{
    protected static string $resource = ConfigurationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function canCreate(): bool
    {
        // Batasi hanya satu konfigurasi
        return \App\Models\Configuration::count() === 0;
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
        ];
    }
}
