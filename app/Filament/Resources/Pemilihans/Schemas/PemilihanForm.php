<?php

namespace App\Filament\Resources\Pemilihans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PemilihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                DateTimePicker::make('tanggal_mulai')
                    ->required(),
                DateTimePicker::make('tanggal_selesai')
                    ->required(),
                Select::make('status')
                    ->options([
                        'nonaktif' => 'Non Aktif',
                        'aktif' => 'Aktif',
                        'selesai' => 'Selesai',
                    ])
                    ->default('nonaktif'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
