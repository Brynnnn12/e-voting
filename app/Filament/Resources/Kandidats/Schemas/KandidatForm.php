<?php

namespace App\Filament\Resources\Kandidats\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Http\UploadedFile;

class KandidatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Select::make('pemilihan_id')
                    ->relationship('pemilihan', 'nama')
                    ->searchable()
                    ->required(),
                TextInput::make('visi')
                    ->required(),
                TextInput::make('misi')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->maxSize(1024)
                    ->disk('public')
                    ->directory('kandidats')
                    ->preserveFilenames(false)
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ])
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->visibility('public')
                    ->downloadable()
                    ->openable()


            ]);
    }
}
