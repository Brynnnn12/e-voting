<?php

namespace App\Filament\Resources\Votings\Pages;

use App\Filament\Resources\Votings\VotingResource;
use Filament\Resources\Pages\ListRecords;

class ListVotings extends ListRecords
{
    protected static string $resource = VotingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Admin hanya bisa melihat data voting, tidak bisa create/edit
        ];
    }
}
