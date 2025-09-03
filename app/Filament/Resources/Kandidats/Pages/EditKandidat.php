<?php

namespace App\Filament\Resources\Kandidats\Pages;

use App\Filament\Resources\Kandidats\KandidatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKandidat extends EditRecord
{
    protected static string $resource = KandidatResource::class;
}
