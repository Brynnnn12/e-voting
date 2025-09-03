<?php

namespace App\Filament\Resources\Pemilihans\Pages;

use App\Filament\Resources\Pemilihans\PemilihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPemilihans extends ListRecords
{
    protected static string $resource = PemilihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
