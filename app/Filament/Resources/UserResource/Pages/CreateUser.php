<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    // Tambahkan method ini
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // kembali ke list setelah save
    }
}
