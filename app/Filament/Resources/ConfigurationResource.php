<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigurationResource\Pages;
use App\Filament\Resources\ConfigurationResource\RelationManagers;
use App\Models\Configuration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigurationResource extends Resource
{
    protected static ?string $model = Configuration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Konfigurasi';
    protected static ?string $pluralModelLabel = 'Konfigurasi';
    protected static ?string $modelLabel = 'Konfigurasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('logo')
                    ->label('Logo Perusahaan')
                    ->image()
                    ->directory('logos')
                    ->required(),

                Forms\Components\TextInput::make('latitude')
                    ->label('Latitude Kantor')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('longitude')
                    ->label('Longitude Kantor')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('radius_meter')
                    ->label('Radius Absensi (Meter)')
                    ->numeric()
                    ->default(20)
                    ->required(),

                // jam kerja: gunakan TimePicker agar admin memilih jam lebih rapi
                TimePicker::make('masuk_start')->label('Jam Masuk - Mulai')->required(),
                TimePicker::make('masuk_end')->label('Jam Masuk - Selesai')->required(),
                TimePicker::make('pulang_start')->label('Jam Pulang - Mulai')->required(),
                TimePicker::make('pulang_end')->label('Jam Pulang - Selesai')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_perusahaan')->label('Nama Perusahaan'),
                Tables\Columns\ImageColumn::make('logo')->label('Logo'),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude'),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude'),
                Tables\Columns\TextColumn::make('radius_meter')->label('Radius'),
                TextColumn::make('masuk_start')->label('Masuk Mulai'),
                TextColumn::make('masuk_end')->label('Masuk Selesai'),
                TextColumn::make('pulang_start')->label('Pulang Mulai'),
                TextColumn::make('pulang_end')->label('Pulang Selesai'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make
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
            'index' => Pages\ManageConfigurations::route('/'),
        ];
    }
}
